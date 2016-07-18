<?php
/**
 * Project:   WU GRAPHS
 * Module:    WUG-inc-hour.php 
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
//$debug = true;
if ($debug) {
  $stimer = explode(' ', microtime());
  $stimer = $stimer[1] + $stimer[0];
}
// Day date text formating
// 0 = d.m.yyyy; 1 = m.d.yyyy; 2 = m/d/yyyy; 3 = d.m.yy; 4 = m.d.yy; 5 = m/d/yy
$dayDateText = array(
$day .'.'. $month .'.'. $year, 
$month .'.'. $day .'.'. $year, 
$month .'/'. $day .'/'. $year,
$day .'.'. $month .'.'. substr($year, -2), 
$month .'.'. $day .'.'. substr($year, -2), 
$month .'/'. $day .'/'. substr($year, -2)
);
// Hour format
// 0 = 24 hours format; 1 = 12 hour format (am/pm)
// $hourFormText[$hourFormat]
$hourFormText = array(
'%H:%M',
'%I:%M%P'
);

// title for each graphs
//$ghtitle = $hourGraphs == 'craw' ? $Twhole.' ' : $Thour2;
$ghtitle = $Thour2;

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

// PARSE GRAPH DATA

## WD MySQL data
if ($hourGraphs == 'db') {
  require_once('wdmysql-h.php');
} else { 
  /*
  Clientrawhour.txt: (updated at 59 minutes every hour)
  ------------------
  last 60 minutes windspeed (kts), 1 minute resolution (i.e 60 numbers)
  last 60 minutes gustspeed (kts)
  last 60 minutes direction
  last 60 minutes temperature (oC)
  last 60 minutes humidity
  last 60 minutes barometer (hpa)
  last 60 minutes daily rain total (mm)
  last 60 minutes of solar data (wm/2) 
  last 24 hours of solar data (wm/2), every 15 minutes (95 data points)
  */
  
  if (is_file($clientRawHpath.'clientrawhour.txt')) {
    // unit conversion
    $mwind = !$metric ? 1.15 : 1.8214; // kts to mph or kmh
    $mbaro = !$metric ? 0.0295 : 1; // hpa to inhg
    $mrain = !$metric ? 25.4 : 1; // mm to inch
    function convcf ($cval) { // convert Celsius to Farenheit
      global $metric;
      if (!$metric) {
        return round(($cval * 9) / 5 + 32, 1); // C to F
      } else{
        return $cval;
      }
    }
    
    // extract data
    $clRawData = @file_get_contents($clientRawHpath.'clientrawhour.txt');
    // data to array
    $Data = explode(' ', $clRawData);
    // remove header and footer
    unset($Data[0]); // ID code: '12345'
    $dataC = count($Data);
    unset($Data[$dataC]); // one spacebar: ' '
    unset($Data[$dataC-1]); // version info: '!!H10.37P!!'
  
    
    // get graph start time
    //$dateSstring = date('Y-m-d H'.':00:00',@filemtime($clientRawHpath.'clientrawhour.txt'));
    //date_default_timezone_set('UTC');
    //$startTime = strtotime($dateSstring);
    date_default_timezone_set($TZconf);
    $startTime = (@filemtime($clientRawHpath.'clientrawhour.txt')-60*60)+date('Z');
    //$startTime = strtotime(date('Y-m-d H').':00:00');
    //echo date('Y-m-d H',$startTime).':00:00'; 
    
    // time array
    $timeArray[] = $startTime*1000;
    $chtimeArray[] = $startTime*1000; //only for bad value comparsion
    for ($i=1;$i<=59;$i++) {
      $startTime += 60;
      $timeArray[] = $startTime*1000;
      $chtimeArray[] = $startTime*1000; //only for bad value comparsion
    }
    // create measured values array
    $vc = 1; // each measured value separator
    $dc = 0; // 1 minute separator
    foreach ($Data as &$value) {
      if ($dc == 60*$vc and $vc != 9) { // separate weather units
        $vc++;
      }
      switch ($vc) {
        case 1:
          $windSpd[] = mxround($value*$mwind*$windcon, 1);
          $chwindSpd[] = $value; //only for bad value comparsion
          break; 
        case 2:
          $windGst[] = mxround($value*$mwind*$windcon, 1);
          $chwindGst[] = $value; //only for bad value comparsion
          break; 
        case 3:
          $windDir[] = $value;
          $chwindDir[] = $value; //only for bad value comparsion
          break; 
        case 4:
          $temp[] = convcf($value);
          $chtemp[] = $value; // ...
          break;
        case 5:
          $humi[] = $value;
          $chhumi[] = $value;
          break;
        case 6:
          $baro[] = mxround($value*$mbaro, 2);
          $chbaro[] = $value;
          break;
        case 7:
          $rain[] = mxround($value*$mrain, 2);
          $chrain[] = $value;
          break; 
        case 8:
          $solar[] = $value;
          $chsolar[] = $value;
          break; 
        case 9:
          $solar24[] = $value;
          $chsolar24[] = $value;
          break; 
      }
      $dc++;  
    }
  
    // dewpoint calculation
    $c = 0;
    foreach ($temp as $val) {
      $gtrh = ((17.271*$val)/(237.7+$val))+log($humi[$c]/100);
      $dewp[] = round((237.7*$gtrh)/(17.271-$gtrh), 1);
      //$dewp[] = $val-((100-$humi[$c])/5); // low accuracy (+/- 1degC and more under of 50% humidity)
      $chdewp[] = round((237.7*$gtrh)/(17.271-$gtrh), 1); 
      $c++;  
    }
    // condition (only empty values - error fix for solar graph)
    for ($i=1;$i<=60;$i++) {
      $cond[] = "' '";
      $chcond[] = "' '";
    }
    
    // PREPARE FOR OUTPUT
    // remove bad values from arrays
    $prevals1 = array('chwindSpd', 'chwindGst', 'chwindDir', 'chtemp', 'chhumi', 'chbaro', 'chrain', 'chsolar', 'chdewp', 'chcond', 'chtimeArray');
    $prevals = array('windSpd', 'windGst', 'windDir', 'temp', 'humi', 'baro', 'rain', 'solar', 'dewp', 'cond', 'timeArray');
    foreach ($prevals1 as $prename) {
      foreach ($$prename as $nr => $val) {
        if ($val == '-') { // bad values
          foreach ($prevals as $a) { //remove bad value from all arrays for output
            $prc = &$$a; // because unset($$a[$nr]) didn't work
            unset($prc[$nr]);
          }
        }
      }
    }
    
    // arrays to output string
    $avals = array('dAvgWS' => $windSpd, 'dGustWS' => $windGst, 'dWindDir' => $windDir, 'dTemp' => $temp, 'dHum' => $humi, 'dBaro' => $baro, 'dRainT' => $rain, 'dSolar' => $solar, 'dDP' => $dewp, 'dCond' => $cond, 'dTimeArray' => $timeArray);
    // array to string
    foreach ($avals as $key => $value) {
      foreach ($value as $oval) {
        $$key .= $oval.",";
      }
    }
  } else {
    $errorReport = 'Error: file clientrawhour.txt not found.';  
  }
  
  $JSdata =
  '
  // PHP WU DATA STRINGS TO JS ARRAYS
  var dTemp    = ['.substr($dTemp, 0, -1).'];
  var dDP      = ['.substr($dDP, 0, -1).'];
  var dBaro    = ['.substr($dBaro, 0, -1).'];
  var dWindDir = ['.substr($dWindDir, 0, -1).'];
  var dAvgWS   = ['.substr($dAvgWS, 0, -1).'];
  var dGustWS  = ['.substr($dGustWS, 0, -1).'];
  var dHum     = ['.substr($dHum, 0, -1).'];
  var dRainT   = ['.substr($dRainT, 0, -1).'];
  var dSolar   = ['.substr($dSolar, 0, -1).'];
  var dCond    = ['.substr($dCond, 0, -1).'];
  var timeArray = ['.substr($dTimeArray, 0, -1).']; 
  
  // Function for creating graph array
  function comArr(unitsArray) { 
      var outarr = [];
      for (var i = 0; i < timeArray.length; i++) {
       outarr[i] = [timeArray[i], unitsArray[i]];
      }
    return outarr;
  } 
  ';
}

if ($debug) {
  $etimer = explode(' ', microtime());
  $etimer = $etimer[1] + $etimer[0];
  printf("Script timer: <b>%f</b> seconds.", ($etimer - $stimer));
  echo mysql_error().'<br>';
}

function convUnk($value) {
  if ($value == '-' || is_nan($value)) {
    return 0;
  } else {
    return $value;
  }
}
function mxround($value,$rval) {
  if (is_string($value)) {
    return $value;
  } else {
    return round($value, $rval);
  }
}
?>