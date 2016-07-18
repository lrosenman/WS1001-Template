<?php

include_once('WUG-settings.php');
if (!isset($cron)) {
  header('Content-Type: text/html; charset=utf-8');
  // HEADER - CACHING
  // seconds, minutes, hours, days
  /* disabled 
  $expires = 60*60*24*14;
  header("Pragma: public");
  header("Cache-Control: maxage=".$expires);
  header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT'); 
  */
  // set actual date
  $actYear = date('Y');
  $actMnth = date('m');
  $actDay  = date('d');
  
  // old a b c url compatibility
  $idy = $_GET['c'] ? $_GET['c'] : $_GET['y'];
  $idm = $_GET['b'] ? $_GET['b'] : $_GET['m'];
  $idd = $_GET['a'] ? $_GET['a'] : $_GET['d'];
  
  // get and validate (only numbers) date from URL
  $yearURL  = is_number($idy) ? $idy : "";
  $monthURL = is_number($idm) ? $idm : "";
  $dayURL   = is_number($idd) ? $idd : "";
  
  //get date from cookie
  $cookieY = (!empty($_COOKIE['wu_graph_y']) ? $_COOKIE['wu_graph_y'] : $actYear);
  $cookieM = (!empty($_COOKIE['wu_graph_m']) ? $_COOKIE['wu_graph_m'] : $actMnth);
  $cookieD = (!empty($_COOKIE['wu_graph_d']) ? $_COOKIE['wu_graph_d'] : $actDay);
  
  //set date from URL or cookie
  $year  = (!empty($yearURL)  ? $yearURL  : $cookieY );
  $month = (!empty($monthURL) ? $monthURL : $cookieM );
  $day   = (!empty($dayURL)   ? $dayURL   : $cookieD );
  
  // If is imput higher than today set 
  $timeStampImput = strtotime($year.'-'.$month.'-'.$day.' 00:00:01');
  if ($timeStampImput > time()) {
    $year = $cookieY;
    $month = $cookieM;
    $day = $cookieD;
  }
  
  // Cookies
  if ($cookieEnabled) {
    SetCookie ("wu_graph_y", $year, time()+3600*24*$cookieExp, "/");
    SetCookie ("wu_graph_m", $month, time()+3600*24*$cookieExp, "/");
    SetCookie ("wu_graph_d", $day, time()+3600*24*$cookieExp, "/");
  }
  
  if ($metric) {
    $unitsLnk = 'metric';
  } else {
    $unitsLnk = 'english';
  }
  
  // context HEADER with cookie for changing units
  $opts = array( 
      'http' => array( 
          'method' => 'GET', 
          'header' => 'Cookie: Units='.$unitsLnk 
      ) 
  );  
  $context = stream_context_create($opts); 
  
  $WUsourceFile = 'https://www.wunderground.com/weatherstation/WXDailyHistory.asp?ID='.$WUID.'&graphspan=day&day=&format=1&units='.$unitsLnk;
  $endOfDay = strtotime($year.'-'.$month.'-'.$day.' 23:59:59');
  
  // add zeros to date format
  $month = strlen($month) == 2 ? $month : "0".$month ;
  $day   = strlen($day)  == 2 ? $day   : "0".$day   ;
  
  $WUrequest = $year . $month . $day;
  $Today = $actYear . $actMnth . $actDay; 
  
  $monthsDir = $year.'-'.$month;
  if (!is_dir($WUcacheDir.$monthsDir) && $IcacheWUfiles) {
    mkdir($WUcacheDir.$monthsDir);
  } 
  $WUcacheFile = $WUcacheDir . $monthsDir . '/'.$WUID.'-day-' . $WUrequest . '.txt';
  
  $WDsinceTS = strtotime($wdSinceY.'-'.$wdSinceM.'-'.$wdSinceD.' 00:00:01');
  if ($dataSource == 'wutowdmysql' && $timeStampImput > $WDsinceTS) {
    $dataSource = 'mysql'; // switch to mysql mode  
  }
  if ($dataSource == 'mysql') {
    $precache = false; // Disable precaching for mysql datasource
    $cacheWUfiles = false; // Disable creating of cache files for mysql datasource    
  }

  // CACHING - save to cache file
  $doCalc = false;
  if ($cacheWUfiles and $WUrequest<=$Today) { //second condition is for wrong user imput in URL parameters (wunderground.com generate empty data and will be shown empty graph)
    if ($_REQUEST['force'] != '1') { // force recreating of cache file
      if (!is_file($WUcacheFile) || @filesize($WUcacheFile) == 0) { 
        if ($WUrequest != $Today) { // create cache file (exclude today)
          $copied = copyWUfile();
          $doCalc = true;
        } 
      }
      if (is_file($WUcacheFile) and $WUrequest != $Today and filemtime($WUcacheFile) < $endOfDay) { // for rebuild incomplete old today cache
        $copied = copyWUfile();
        $doCalc = true; 
      } 
      if ($todayCache and $WUrequest == $Today and (@filemtime($WUcacheFile) + ($todayCacheT*60)) < time()) { // then create today cache file
        $copied = copyWUfile();
      } 
    } else {
      $copied = copyWUfile();
      if ($WUrequest != $Today) {$doCalc = true; }  // BLBOST! kdyztak recalc kde se da soubor do array a nahradi se novy zaznam
    } 
  } else { // without caching
    $WUcacheFile = $WUsourceFile;
  }
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
if ($dataSource == 'mysql' || ($dataSource == 'wutowdmysql' && $timeStampImput > $WDsinceTS)) {
  require('wdmysql-d.php');
} else {
  require('WUG-parser-d.php');
  parse_wu_day($WUcacheFile, $year, $month, $day); // Output is global var. $JSdata 
  // $cRow is global in parse_wu_day
  if ($cRow <= 1) { // we need at least two values for drawing a line in graph
    if ($WUrequest==$Today) {
      $emptyGraph = true;
    } else {
      $emptyGraphTP = true;
    }
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
    if ($textlen==0) return 0;
    for ($i=0;$i < $textlen;$i++)
    { $ch = ord($text{$i});
       if (($ch<48) || ($ch>57)) return 0;
    }
    return 1;
}
?>