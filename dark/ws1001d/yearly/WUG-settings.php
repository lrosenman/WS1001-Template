<?php
include_once('../settings.php');
?>


<?php

$baroMinMax = true; // true or false - Disable minimum and maximum limits for barometric pressure graphs and informational bands/strips about intensity of pressure.
$showSolar = true; // if you don't have solar sensor, set this value to false (graph will be disabled/hidded in graph selection and tabs)
$wugWinW = '900'; //pixels; Default WIDTH of graph opened in a new window (default: '900' eq. for Netbooks or small notebooks/laptops)
$wugWinH = '350'; //pixels; Default HEIGHT of graph opened in a new window (default: '350' eq. for Netbooks with few toolbars in browser)
$cookieExp = 0.5; // 1 = 1 day;  expiration time for cookies in day/month/year selection (default: 0.5)

$ddFormat = 0; // 0 = dd.mm.yyyy; 1 = mm.dd.yyyy; 2 = mm/dd/yyyy; 3 = d.m.yy; 4 = mm.dd.yy; 5 = mm/dd/yy
$hourFormat = 0; // 0 = 24 hours format; 1 = 12 hour format (am/pm)

### GRAPH SIZE ###
$wugWidth = '640'; // graph width in pixels (default: '640')
$wugHeight = '380'; // graph height in pixels (default: '380')

### Language / Translation ###
$defaultWUGlang = 'en'; // default language
$langSwitch = false; // show language switch



### EXTRA GRAPHS/VALUES for month/year graphs recalculated from day WU cache files
# used only for 'wunderground' datasource
$calcMbaroAvg = true; // Calculate month/year average barometric pressure
$calcSolar = true; // Calculate month/year average solar radiation 
$calcWindDir = true; // Calculate month/year average wind direction

### SPIKE DATA REMOVING for Day,Month,Year graphs
//Note: Spike data will be replaced with last 'non-spiked' value. Maximum for correction is 3 spiked values in row.
$removeSpikes = true; // true or false;
# SPIKED DATA TRESHOLDS
// Values for day spiked data corrector (must be in metric units - converted later in code)
// This is a max accepted change in measured values of the interval for DAY graphs (interval is usually 5 minutes + potential station data sending failure)
// Higher value mean a less sensitivity for spike corector.
$dsp = array('temp' => 1.4, 'baro' => 1.8, 'rain_rate' => 150, 'rain_total' => 35, 'humi' => 8);
// This is a max change in measured values of the interval (usually 1 day) for MONTH/YEAR graphs
// Higher value mean a less sensitivity for spike corector.
$mysp = array("temp" => 10, "baro" => 30, "humi" => 70);

### CACHING CONFIGURATION FOR 'wunderground' datasource ###
# Global cache control - for 'wunderground' datasource
$IcacheWUfiles = false; // enable global WU file caching (improve speed)  true or false
// CACHE DIRECTORY MUST BE WRITABLE FOR PHP (most often chmod 777)
// ABSOLUTE path with slashes
$WUcacheDirI = 'auto'; // If you do not know the absolute path to your site, try set to 'auto' (cache directory will be in wxwugraphs) Default value: 'auto'

## PRECACHING - for 'wunderground' datasource
# create WU cache files for other days, when visitor browsing in graph pages 
$Iprecache = false; // true = enabled; false = disabled 
$pause = 120; //seconds; minimal value: 120; pause between creating next cache file 
$maxPre = 1; // maximum precached years backward - default: 2; max: 5 years;




### REFRESH PAGE
/* Use 'force=1' URL parameter to refresh button?
Force parameter to recreate WU cache file. 
Useful if you want to recreate any data every time it is clicked to Refresh the icon.
However, if wundergroud lost your data, a problem may arise. */
$refreshForced = false; //true for using force parameter in refresh button link

//$autoRefreshT = '15'; // graph auto refresh in minutes. If is used MySQL datasource without caching, is better use higher values (eg. 60) for lower CPU server usage. 


### JS and CSS jQuery support
//$jQueryFile = '../js/jquery.js'; // Custom path to jQuery libary (always needed)
$jQueryFile = 'js/j23.js'; // Custom path to jQuery libary (always needed)
$loadJQuery = true; // if you have own jQuery library set to false
$incTabsStyle = false; // if you set $loadJQuery to false, then you may want to use own default CSS style for jQuery tabs. In this case set to false.

### SPECIAL ###
// Enable tested/unstable functions/features
$testOn = false; // false to disable, true to enable

### Version auto checker
// to work correctly, caching must be enabled 
$updateCheck = false; // if there is a new version, v. info on bottom of the page will be red.
$SendName = false; // send station name ($gSubtitle) with first update check for better support

## GRAPH APPEREANCE PROBLEMS ##
// Height correction in tabbed mode 
$heightCorr = '20'; // pixels;(defaut value: '20')

$standAlone = true;  // true = use wugraphs.php (also you may need set $loadJQuery and $incTabsStyle to true); false = using wxwughraph.php for saratoga carterlake templates
$includeMode = false; // true = included by PHP include function (eg: include('wugraphs.php'); ) 

##### OTHER OR MALFUNCTION SETTINGS
$spline_graphs = true; // spline or line graph type; true (spline) = better look, but low accuracy and possible problems with gaps in graphs data.
$fopenOff = true; // Enable if you have allow_url_fopen = Off in PHP configuration. But you may have problems with units in graphs (Metric vs Imperial - may depend on your server location).
//Directory for used javascripts (jquery, higcharts, ui.datepicker, ui.core ...) in graphxx.php pages
$jsPath = './js/'; // with trailing slashes (default is './js/')
$cookieEnabled = false; // set to false if you have cookie MOD_SECURITY problems in WUG-test.php
$sendAgent = false; // If you have allow_url_fopen On in PHP configuration and still you have empty graphs or cache files
$no_mb = false; // disable MB string support - only if you get some MB errors in WUG-test.php
$debug = false; // if true, all notices and errors will be shown
##################################################################################
# end settings                                                                   #
##################################################################################
define('VERSION', '1.8.0');

//fix a bad url parameter interpreting on some PHP servers (eq: default config in XAMPP)  
@ini_set('arg_separator.output', '&');

$conFile = realpath(dirname(__FILE__)).'../settings.php'; // path to configuration file
// Load config
@include($conFile);

// CHANGE STATION from cookies
$WUID   = empty($_COOKIE['wuid']) ? $WUID : $_COOKIE['wuid']; 
$stationName = empty($_COOKIE['stn']) ? $stationName : $_COOKIE['stn'];
$wugWidth = empty($_COOKIE['wdth']) ? $wugWidth : $_COOKIE['wdth'];

$WUGcharset = 'UTF-8';
if (!$standAlone) {
  $SITE['charset'] = $SITE['charset'] == '' ? 'UTF-8' : $SITE['charset'];  // for saratoga/carterlake templates
}

$WUcacheDir = $WUcacheDirI == 'auto' ? realpath(dirname(__FILE__)).'/cache/' : $WUcacheDirI;

$langDir = './languages/'; // with trailing slashes
$mainDir = './';
$outpath = false;
if (!is_file('./WUG-settings.php')) { //resolve path
  $outpath = true;
  $langDir = './wxwugraphs/languages/';
  $mainDir = './wxwugraphs/';
}

// metric / imperial (engligsh) units text switch
if ($metric) {
  $TtempUnits = '°C';
  $TbaroUnits = 'hPa';
  $TwindUnits = $windmu;
  $TsizeUnits = 'mm';
  $TsunUnits = 'watt/m2';
  $TprecSpd = 'mm/h';
} else {
  $TtempUnits = '°F';
  $TbaroUnits = 'in.Hg';
  $TwindUnits = 'mph';
  $TsizeUnits = 'in.';
  $TsunUnits = 'watt/m2';
  $TprecSpd = 'in/h';
}
if ($windmu == 'km/h' and $metric) {
  $windcon = 1;
} elseif ($windmu == 'm/s' and $metric) {
  $windcon = 0.277778;
} else {
  $windcon = 1;
}

// charset config for PHP mb_ strings function
if (function_exists('mb_internal_encoding') and !$no_mb) {
  mb_internal_encoding($WUGcharset);
}

// Timezone PHP5 vs PHP4
if (!function_exists('date_default_timezone_set')) { //PHP4
   putenv("TZ=" . $TZconf);
} else { //PHP5
   date_default_timezone_set("$TZconf");
}

// Rain units conversion (cm to mm)
$rainMultip = $metric ? 10 : 1 ;

## language and mainDir switch
// include english language => no empty variables
include($langDir.'WUG-language-en.php');

$WUGLang = !empty($_COOKIE['cookie_lang']) ? $_COOKIE['cookie_lang'] : strtolower($defaultWUGlang) ; // if there's no cookie, set the default

$WUGlangFile = $langDir.'WUG-language-'.$WUGLang.'.php'; 
if (is_file($WUGlangFile)) {
  include_once($WUGlangFile);
  $errWUGlang = '<!-- WU Graphs: Language file is "'.$WUGlangFile.'" -->'."\n";
} else {
  $errWUGlang = '<!-- WU Graphs: File "'.$WUGlangFile.'" not found. Language file is set to english. -->'."\n";
  include_once($langDir.'WUG-language-en.php');
}

// Station name vs language
if (empty($TstationName)) {
  $gSubtitle = $stationName;
} else {
  $gSubtitle = $TstationName;
}

// datepicker language
$dpckFile = $langDir.'datepicker/jquery.ui.datepicker-'.$WUGLang.'.js';
if (is_file($dpckFile)) {
  $dpckLangFile = $dpckFile;
  $errWUGlang .= '<!-- WU Graphs: Datepicker language file is "'.$dpckLangFile.'". -->'."\n";
//$dpckLang = $WUGLang; 
} else {
  $errWUGlang .= '<!-- WU Graphs: ERROR - datepicker laguage file "'.$dpckFile.'" not found. Using english. -->'."\n";
  $dpckLangFile = $langDir.'datepicker/jquery.ui.datepicker-en.js';
//$dpckLang = 'en'; 
}





// These values must be respected, otherwise in certain cases can lead to bad graph plotting.
$maxZoomDay = '2*5*60'; // (WU recording interval 5 mintues)
$maxZoomMonth = '1'; // (WU recording interval 1 day) 
$maxZoomYear = '1'; // (WU recording interval 1 day)

$precache = $Iprecache;
$cacheWUfiles = $IcacheWUfiles;

// Debug info 
if ($debug) {
  error_reporting(E_ALL);
} else {
  error_reporting(E_ALL ^ E_NOTICE);
}
ini_set("display_errors", 0); // override 'bad' php error config in some webhostings
//echo ini_get('error_reporting');exit; //6135

if (!function_exists('mb_stroupper')) {
  function mb_stroupper ($string) {
    global $no_mb;
    if ($no_mb) {
      return $string;
    } else {
      return stroupper($string);
    }
  }
}
if (!function_exists('mb_strtolower')) {
  function mb_strtolower ($string) {
    global $no_mb;
    if ($no_mb) {
      return $string;
    }else{
      return strtolower($string);
    }
  }
}
if (!function_exists('mb_substr')) {
  function mb_substr ($string,$p1,$p2,$enc) {
    global $no_mb;
    if ($no_mb) {
      return $string;
    } else {
      return substr($string,$p1,$p2);
    }
  }
}
/*
if (!function_exists('mb_convert_encoding')) {
  function mb_substr ($string,$p1,$p2,$enc) {
    global $no_mb;
    if ($no_mb) {
      return $string;
    } else {
      return substr($string,$p1,$p2);
    }
  }
}
*/
// set user_agent if is there some problem with fopen 
if ($sendAgent) {
  ini_set ('user_agent', $_SERVER['HTTP_USER_AGENT']);
}



// spline or line graph switch
$spline = $spline_graphs ? 'spline' : 'line';
$aspline = $spline_graphs ? 'areaspline' : 'area';



session_start();
?>