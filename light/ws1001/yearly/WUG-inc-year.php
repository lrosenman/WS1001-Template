<?php
/**
 * Project:   WU GRAPHS
 * Module:    WUG-inc-year.php 
 * Copyright: (C) 2010 Radomir Luza
 * Email: luzar(a-t)post(d-o-t)cz
 * WeatherWeb: http://pocasi.hovnet.cz 
 */
################################################################################
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 3
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>. 
################################################################################
include_once('WUG-settings.php');
header('Content-Type: text/html; charset=utf-8');

// set actual date
$actYear = date('Y');

// old a b c url compatibility
$idy = $_GET['c'] ? $_GET['c'] : $_GET['y'];

// get and validate (only numbers) date from URL
$yearURL  = is_number($idy) ? $idy : "";

//get date from cookie
$cookieY = (!empty($_COOKIE['wu_graph_y']) ? $_COOKIE['wu_graph_y'] : $actYear);

//set date from URL or cookie
$year  = (!empty($yearURL)  ? $yearURL  : $cookieY );;

// If is imput higher than today set 
$year = $year > date('Y') ? $cookieY : $year;

if ($metric) {
  $unitsLnk = 'metric';
} else {
  $unitsLnk = 'english';
}

// HEADER with cookie for changing units
$opts = array( 
    'http' => array( 
        'method' => 'GET', 
        'header' => 'Cookie: Units='.$unitsLnk 
    ) 
);  
$context = stream_context_create($opts); 

// - only for months in tooltip (especially rain graph) -
$mnthNames = explode(",", $jsMnth); // create array
foreach ($mnthNames  as &$value) {
    $value = str_replace( '"', '', $value); // remove double quote
    $value = my_mb_ucfirst($value); // first letter Big
}
function my_mb_ucfirst($str, $e='utf-8') { // UTF-8 support
    global $no_mb;
    if (!$no_mb) {
    $fc = mb_strtoupper(mb_substr($str, 0, 1, $e), $e); 
    return $fc.mb_substr($str, 1, mb_strlen($str, $e), $e);
    } else {
    return $str;
    }
}
$mnthOut = implode("\",\"", $mnthNames);
$mnthOut = '"'.$mnthOut.'"';


$WUsourceFile = 'https://www.wunderground.com/weatherstation/WXDailyHistory.asp?ID='.$WUID.'&graphspan=year&year=&format=1&units='.$unitsLnk;
$WUrequest = $year;
$thisYear = date('Y');
$endOfYear = strtotime($year.'-12-31 23:59:59'); 
$WUcacheFile = $WUcacheDir . $WUID.'-year-' . $WUrequest . '.txt';

// Cookies
if ($cookieEnabled) {
  SetCookie ("wu_graph_y", $year, time()+3600*24*$cookieExp, "/");
}

//get cookie for datepicker init
//year
//$cookieY = (!empty($_COOKIE['wu_graph'.$cookie_i.'_y']) ? $_COOKIE['wu_graph'.$cookie_i.'_y'] : $actYear);


$timeStampImput = strtotime($year.'-01-01 00:00:01');
$WDsinceTS = strtotime($wdSinceY.'-01-01 00:00:01');
if ($dataSource == 'wutowdmysql' && $timeStampImput > $WDsinceTS) {
  $dataSource = 'mysql'; // switch to mysql mode  
}
if ($dataSource == 'mysql') {
  $precache = false; // Disable precaching for mysql datasource
  $cacheWUfiles = false; // Disable creating of cache files for mysql datasource
}

// CACHING
if ($cacheWUfiles and $WUrequest<=$thisYear) { //second condition is for wrong user imput in URL parameters (wunderground.com generate empty data and will be shown empty graph); third condition disable copyWUfile for mysql
  if ($_REQUEST['force'] != '1') { // force recreating of cache file
    if (!is_file($WUcacheFile) || @filesize($WUcacheFile) == 0) {
      if ($WUrequest != $thisYear) { // create cache file (exclude this year)
        $copied = copyWUfile();
      } 
    }
    if (is_file($WUcacheFile) and $WUrequest != $thisYear and $WUrequest < $thisYear) { // for rebuild incomplete old this year cache; extra if for better performance
      if (filemtime($WUcacheFile) < $endOfYear) { // determine if is cache file complete
        $copied = copyWUfile();  
      }
    } 
    if ($tYearCache and $WUrequest == $thisYear and (@filemtime($WUcacheFile) + ($tYearCacheT*3600)) < time()) { // then create this year cache file
      $copied = copyWUfile();
    } 
  } else {
  $copied = copyWUfile();
  }
} else { // without caching
  $WUcacheFile = $WUsourceFile;
}

// days in this year
for ($g=1;$g<=12;$g++){
  if ($g == date('n')) {
    $dayscy += date('j');
    break;
  } else {
    $dayscy += date('t', strtotime("$year-$g-01"));
  }
}
// Average year Baro + switch for Solar & Wind direction
if ($calcMbaroAvg && $dataSource != 'mysql') {  // create baro output  
$ambFile = $WUcacheDir.$WUID.'-year-ab-'.$year.'.txt'; // same must be in WUG-parser-d.php
  if (is_file($ambFile)) {
    $avgBaro = substr(file_get_contents($ambFile),0,-1);
  }
  if ($testOn) { // experimental features
    if (count(explode(']', $avgBaro)) >= ($dayscy-5)) {  // test - autoswitch Min & Max v.s. Avg
      $showAvgBaro = 'true';
      $showMMBaro = 'false';
    } else {
      $showAvgBaro = 'false';
      $showMMBaro = 'true'; 
    }
  } else {
    $showMMBaro = 'true';
    $showAvgBaro = 'false';
  }
} elseif ($dataSource == 'mysql') {
  $showAvgBaro = 'true';
  $showMMBaro = 'false';
} else {
  $showAvgBaro = 'false';
  $showMMBaro = 'true';
  $avgBaro = ""; // changed from "0";
}

## PARSE WU DATA ## 
if ($dataSource == 'mysql') {
  include('wdmysql-y.php');
} else {  
  // Average solar radiation
  if ($calcSolar) {  // create baro output  
    $amsFile = $WUcacheDir.$WUID.'-year-sun-'.$year.'.txt'; // same must be in WUG-parser-d.php
    if (is_file($amsFile)) {
      $avgSolar = substr(file_get_contents($amsFile),0,-1);
    } else {
      $avgSolar = ""; // changed from "0";
    }
  } else {
    $avgSolar = ""; // changed from "0";
  }
  // for empty solar Month/Year data
  $thp = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
  if (($avgSolar == '0' || empty($avgSolar) || count(explode(',',$avgSolar)) <= 1) && $thp == 'graphy7a.php') {
    $emptyGraphTP = true;
  }

  date_default_timezone_set('UTC'); // Set timezone offset to 0 - do not change wunderground time
  $handle = fopen($WUcacheFile, "r");
 while ($data = fgetcsv($handle, 1000, ",")) {
  // while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    //skip first two rows
    if($rowCount++ < 2) { continue; }
    //day
    $datu = substr($data[0], -2, 2);
    if ($datu < 0) {
      $datu = abs($datu);
    }
    
    //month
    $datu2 = substr($data[0], 5, 2);
    if (substr($datu2, -1) == "-") {
      $datu2 = substr($datu2, 0, 1);
    }
    //year
    $datu3 = substr($data[0], 0, 4);
    
    // final date in js timestamp format (in miliseconds)
    $msdate = strtotime($datu.'-'.$datu2.'-'.$datu3) * 1000;
    
    // skip <br> and other unnecessary rows
    if(!preg_match('/[0-9]+/', $datu)) {        
      continue;
    }      
    $cRow++; // row counter
  
    // Add to string
    $timeArray.= $msdate   .",";
    $maxTemp  .= $data[1]  .",";
    $avgTemp  .= $data[2]  .",";
    $minTemp  .= $data[3]  .",";
    $maxDP    .= $data[4]  .",";
    $avgDP    .= $data[5]  .",";
    $minDP    .= $data[6]  .",";
    $maxHum   .= $data[7]  .",";
    $avgHum   .= $data[8]  .",";
    $minHum   .= $data[9]  .",";
    $maxBaro  .= $data[10] .",";
    $minBaro  .= $data[11] .",";
    $maxWS    .= round($data[12]*$windcon, 1) .",";
    $avgWS    .= round($data[13]*$windcon, 1) .",";
    $gustWS   .= round($data[14]*$windcon, 1) .",";   
    // DAYS RAIN DATA TO MONTH
    if (!isset($nextrM)) {
      $nextrM = $datu2+1;
      $ysign = $datu3;
      $precipStart = $datu2-1;
    }
    if ($datu2 == $nextrM) { // month changed, create previous month data
      $rainC    .= "[".$premo.','.$monthrSum."],";
      $rainS    += $monthrSum;
      $rainT    .= "[".$premo.','.$rainS."],";
      unset($monthrSum);
      $nextrM = $datu2+1;
      $ysign = $datu3;
    }
    $monthrSum += round($data[15]*$rainMultip, 2);
    $premo = $ysign == $datu3 ? $datu2 : 12; // WU have in this year also data from 1.1. of next year

  }
  if ($cRow <= 1) { // we need at least two values for drawing a line in graph
    if ($WUrequest == $thisYear) {
      $emptyGraph = true;
    } else {
      $emptyGraphTP = true;
    }
  } 
  
  // FINISH DAYS RAIN DATA TO MONTH - last month
  $rainC    .= "[".$premo.','.$monthrSum."],";
  $rainS    += $monthrSum;
  $rainT    .= "[".$premo.','.$rainS."],";
  
  //REPAIR STRINGS and REMOVE SPIKES
  // rmSpikeYM ($data, $diff, $multiple = 1)
  
  $baroSpike = $metric ? 1  : 33.86;
  $tempSpike = $metric ? 1  : 1.8 ;
  $windSpike = $metric ? 1  : 0.6214;
      
  $timeArray  = substr($timeArray, 0, -1);
  $maxTemp    = rmSpikeYM(substr($maxTemp, 0, -1), $mysp['temp']*$tempSpike );
  $avgTemp    = rmSpikeYM(substr($avgTemp, 0, -1), $mysp['temp']*$tempSpike );
  $minTemp    = rmSpikeYM(substr($minTemp, 0, -1), $mysp['temp']*$tempSpike );
  $maxDP      = rmSpikeYM(substr($maxDP, 0, -1), $mysp['temp']*$tempSpike );
  $avgDP      = rmSpikeYM(substr($avgDP, 0, -1), $mysp['temp']*$tempSpike );
  $minDP      = rmSpikeYM(substr($minDP, 0, -1), $mysp['temp']*$tempSpike );
  $maxHum     = rmSpikeYM(substr($maxHum, 0, -1), $mysp['humi'] );
  $avgHum     = rmSpikeYM(substr($avgHum, 0, -1), $mysp['humi'] );
  $minHum     = rmSpikeYM(substr($minHum, 0, -1), $mysp['humi'] );
  $maxBaro    = rmSpikeYM(substr($maxBaro, 0, -1), $mysp['baro']/$baroSpike );
  $minBaro    = rmSpikeYM(substr($minBaro, 0, -1), $mysp['baro']/$baroSpike );
  $maxWS      = substr($maxWS, 0, -1);
  $avgWS      = substr($avgWS, 0, -1);
  $gustWS     = substr($gustWS, 0, -1);
  $rainC      = substr($rainC, 0, -1);
  $rainT      = substr($rainT, 0, -1);
  
  $JSdata =
  '
  // PHP WU DATA STRINGS TO JS ARRAYS
  var maxTemp = ['.$maxTemp .'];
  var avgTemp = ['.$avgTemp .'];
  var minTemp = ['.$minTemp .'];
  var maxDP   = ['.$maxDP   .'];
  var avgDP   = ['.$avgDP   .'];
  var minDP   = ['.$minDP   .'];
  var maxHum  = ['.$maxHum  .'];
  var avgHum  = ['.$avgHum  .'];
  var minHum  = ['.$minHum  .'];
  var maxBaro = ['.$maxBaro .'];
  var avgBaro = ['.$avgBaro .'];
  var minBaro = ['.$minBaro .'];
  var maxWS   = ['.$maxWS   .'];
  var avgWS   = ['.$avgWS   .'];
  var gustWS  = ['.$gustWS  .'];
  var precipC = ['.$rainC   .'];
  var precipT = ['.$rainT   .'];
  var precipS = "'.$precipStart.'";
  var avgSolar = ['.$avgSolar.'];
  
  // Function for creating graph array
  function comArr(unitsArray) {
      var timeArray = ['.$timeArray.'];  
      var outarr = [];
      for (var i = 0; i < timeArray.length; i++) {
       outarr[i] = [timeArray[i], unitsArray[i]];
      }
    return outarr;
  }
  ';
  
  fclose($handle);
  date_default_timezone_set($TZconf); // Back to configured timezone
}
## END PARSE WU DATA ## 

// Tooltip date formating
// 0 = d.m.yyyy; 1 = m.d.yyyy; 2 = m/d/yyyy; 3 = d.m.yy; 4 = m.d.yy; 5 = m/d/yy
$ttDateText = array(
//$day .'.'. $month .'.'. $year, 
'%d. %m. %Y',
'%m. %d. %Y',
'%m/%d/%Y',
'%d. %m. %y',
'%m. %d. %y',
'%m/%d/%y'
);

// PRECACHE
// asynchronous HTTP request 
if ($precache) {
  backgroundPost(curPageURL().substr($_SERVER["SCRIPT_NAME"],0,strrpos($_SERVER["SCRIPT_NAME"],"/")+1).'WU-precache.php?pg=1');
}

// FUNCTIONS

// run precache in background
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"];
 }
 return $pageURL;
}
function backgroundPost($url){
  $parts=parse_url($url);
 
  $fp = fsockopen($parts['host'], 
          isset($parts['port'])?$parts['port']:80, 
          $errno, $errstr, 30);
 
  if (!$fp) {
      return false;
  } else {
      $out = "POST ".$parts['path']." HTTP/1.1\r\n";
      $out.= "Host: ".$parts['host']."\r\n";
      $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
      $out.= "Content-Length: ".strlen($parts['query'])."\r\n";
      $out.= "Connection: Close\r\n\r\n";
      if (isset($parts['query'])) $out.= $parts['query'];
 
      fwrite($fp, $out);
      fclose($fp);
      return true;
  }
}

// Remove spikes
function rmSpikeYM ($data, $diff, $maxBadVal = 2) {
  global $removeSpikes;
  if ($removeSpikes) {
      $array = explode(",", $data);
      $c = 0;
      $Ncorr = 1; //after $maxBadVal times is bad value ignored, so $maxBadVal is maximum nr. of bad values
      foreach ($array as $value) {
        if (!isset($lv1)) {
          $lv1 = $value;
          $c++;
          continue;
        } 
        if ( abs($value-$lv1) > $diff and $Ncorr <= $maxBadVal ) { //    
          $array[$c] = $lv1; // replaces the current value of the last one
          $Ncorr++;
        } else {
          $lv1 = $value;
          $Ncorr = 0;
        }
        $c++;
      }
      return implode(",",$array);
  } else {
    return $data;
  }
}

// php copy with context parameter started up to version 5.3.0 (and it may be problematic for many people...) so must be enough fopen ...
function copyWUfile() {
  global $WUsourceFile, $context, $WUcacheFile, $fopenOff; 
  if ($fopenOff) {
    include('./fopener.php');
    $read = new HTTPRequest($WUsourceFile);
    $wsource = $read->DownloadToString(); 
  } else {
    $wsource = file_get_contents($WUsourceFile, 0, $context);  
  }
  $ctarget = fopen($WUcacheFile, "w");
  fwrite($ctarget, $wsource);
  fclose($ctarget);
  return true;
}

// Only number validating
function is_number($number) { 
  $text = (string)$number;
  $textlen = strlen($text);
  if ($textlen == 0) return 0;
  for ($i=0;$i < $textlen;$i++)
  { $ch = ord($text{$i});
     if (($ch<48) || ($ch>57)) return 0;
  }
  return 1;
}
?>