<?php
### HOME WEATHER STATION TEMPLATE SETUP please set up and check thoroughly all 
### settings incorrect settings will show incorrect data (updated May 2016) ####

$TZ= 'Europe/London'; // important set your time zone America/New_York for example go here to find your http://php.net/manual/en/timezones.php
$TZconf = 'Europe/London';  // Your timezone for charts data 
$UTC = '1';  // NUMBER of hours betweeen your location and UTC ,EXAMPLE new york -4 london 0 istanbul 3 
$api= 'xxxxxxx'; // important Weather Underground api key developer key '1234567890'
$stationName = 'London,UK'; // This can be also changed for each language in translation files.
$stationlocation = 'London'; // add your relative location city,town,village,district, or region 
$WUID = 'ISTANBUL161'; // YOUR Weather Underground station ID this is used for charts
$id   = 'ISTANBUL161'; // YOUR Weather Underground station ID this is used for forecast
$lat  = '41.000736'; // you can use google maps to determine your lat
$lon  = '28.542501'; // you can use google maps to determine your lon
$elevation   = '45.041m'; //add your elevation  ft or metres eg ..45.041m or 133ft
$dataSource = 'wunderground'; // 'wunderground' = weather underground server ; 
$metric = true; // true for metric units, false for imperial units
$unitsLnk= 'metric'; // metric or english for non metric
$templateunit ='&deg;c'; // template temperatures units &deg;c or &deg;f
$indoorunit ='Celsius'; // template temperatures units Celsius or Fahrenheit
$windmu = 'mph'; // 'm/s' or 'km/h or mph' for units selection
$windunit = 'MPH'; // template wind unit KMH,MPH,M/S
$rainunit = 'mm'; // template rain unit mm or in
$pressureunit = 'hPa'; // template pressure unit hph or inHg
$livedata           = 'ws1001.json'; // path to raw data
$version            = 'Realtime'; // type of source// 
$hardware           = 'Fine Offset (HP2000)'; // hardware type i.e Davis VP2,Ambient,Accurite,Fine Offset,Aercus etc// 
$email              = 'youremail@com'; // contact email for form
$twitter            = '@yourtwitter'; // twitter username used on form if available
$weatherunderground = "https://www.wunderground.com/personal-weather-station/dashboard?ID=xxxxxxxx" ; // add your weatherunderground station url https://www.wunderground.com/personal-weather-station/dashboard?ID=ISTANBUL161 

// please note there is no requirement to edit below this line unless you really know what your doing //
$sinceY = '2016'; 
$sinceM = '1'; // month without leading zero
$sinceD = '1'; // day without leading zero
$wdMonthLim = 12;
$wdYearLim = 12;
$wugTheme = "default";
$ddFormat = 0;
$hourFormat = 0; 
$wugWidth = "640";
$wugHeight = "380";
$defaultWUGlang = "en";
$langSwitch = false;
$showSolar = true;
$wugWinW = "900";
$wugWinH = "350";
$cookieExp = 0.1;
$calcMbaroAvg = true;
$calcSolar = false;
$calcWindDir = false;
$removeSpikes = true;
$dsp = array("temp" => 10, "baro" => 1.8, "rain_rate" => 150, "rain_total" => 35, "humi" => 8);
$mysp = array("temp" => 10, "baro" => 30, "humi" => 70);
$IcacheWUfiles = false;
$WUcacheDirI = "auto";
$Iprecache = false;
$pause = 120;
$maxPre = 2;
$creditsEnabled = "true";
$creditsURL = "";
$credits = "Data Supplied via Weather Underground";
//$jQueryFile = "";
$loadJQuery = true;
$incTabsStyle = false;
$updateCheck = false;
$SendName = false;
$heightCorr = "20";
$standAlone = true;

$spline_graphs = true;
$fopenOff = false;
$cookieEnabled = false;
$sendAgent = false;
$no_mb = false;
$db_i_temp = false;
$db_suv = false;
$CustomFontTheme = false;
$colorpickerFontVal = "#000000";
$CustomBgTheme = 'transparent';
$colorpickerBgVal = "#ffffff";
$baroMinMax = false;
$templateinfo    = 'https://github.com/lrosenman/WS1001-Template'; // template information page
$templateversion = 'Version 4.36UK';

?>

