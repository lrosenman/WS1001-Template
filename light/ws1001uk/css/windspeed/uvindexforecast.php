<?php
include_once('settings.php');
?>

<?php
//import UV Forecast
// Script by Ken True - saratoga-weather.org
// Version 1.00 - 25-Feb-2008 - Initial Release
// Version 1.01 - 01-Mar-2008 - fixed logic to skip header row
// Version 1.02 - 03-Mar-2008 - added logic to adjust return arrays so [0] is always 'today's forecast
//                              based on timezone setting in $ourTZ (or $SITE['tz'] for templates
// Version 1.03 - 03-Jul-2009 - PHP5 support for timezone set
// Version 1.04 - 26-Jan-2011 - added support for $cacheFileDir for cache file
// Version 1.05 - 15-Feb-2011 - fixed undefined index Notice: errata
// Version 1.06 - 18-Feb-2011 - added support for comma decimal point in returned UVfcstUVI array
//
// error_reporting(E_ALL); // uncomment for error checking
//   
//
// the script does no printing other than the HTML comments on status and the
// required copyright info.
//
//  to print values in your page, just:
//
//   echo "UV Forecast $UVfcstDate[0] is $UVfcstUVI[0]\n";
//
//  Returns Arrays:
//
//  $UVfcstDate[n]  -- date of forecast in dd Mon yyyy format
//  $UVfcstUVI[n]   -- forecast UVI in dd.d format
//                     n=0...8 (usually)
//  $UVfcstDOW[n]   -- forecast DayOfWeek ('Sunday' ... 'Saturday') from date('l',time());
//  $UVfcstISO[n]   -- forecast date in YYYYMMDD format.
//  will return $UVfcstUVI[n] = 'n/a' if forecast is not available.
// 
// -------------Settings ---------------------------------
  $cacheFileDir = 'jsondata/';      // default cache file directory
 // translate UTC times to your LOCAL time for the displays.
//  http://us.php.net/manual/en/timezones.php  has the list of timezone names
//  pick the one that is closest to your location and put in $ourTZ like:
//   $ourTZ = "Europe/Paris";
//   $ourTZ = "Pacific/Auckland";
  $commaDecimal = false;     // =true to use comma as decimal point in UVfcstUVI
// -------------End Settings -----------------------------
//
// the following note is required by agreement with the authors of the website www.temis.nl
/* -----------------------------------------------------------------------------------------
Date: Wed, 20 Feb 2008 11:30:43 +0100
From: Ronald van der A <avander@knmi.nl>
Organization: KNMI
To: webmaster@saratoga-weather.org
CC: Ronald.van.der.A@knmi.nl, Jos.van.Geffen@knmi.nl
Subject: Re: Request to use data

Dear Ken,

If you change the line into

<p>UV forecast courtesy of and <a href="http://www.temis.nl/">Copyright
&copy; KNMI/ESA</a>. Used with permission.</p>

then it is ok for us. In this way KNMI is acknowledged, who have done
the major part of the UV product development.

Best regards,
Ronald van der A
 ----------------------------------------------------------------------------------------- */
$requiredNote = 'UV forecast courtesy of and Copyright &copy; KNMI/ESA (http://www.temis.nl/). Used with permission.';
//
//
$UV_URL = "http://www.temis.nl/uvradiation/nrt/uvindex.php?lon=$lon&lat=$lat";
//
// create a 'uv-forecast.txt' file in the same directory as the script.
// you may have to set the permissions on the file to '666' so it is writable
// by the webserver.
$UVcacheName = $cacheFileDir."uv-forecast.txt";
$UVrefetchSeconds = 3600;
// ---------- end of settings -----------------------

if (isset($_REQUEST['sce']) && strtolower($_REQUEST['sce']) == 'view' ) {
   //--self downloader --
   $filenameReal = __FILE__;
   $download_size = filesize($filenameReal);
   header('Pragma: public');
   header('Cache-Control: private');
   header('Cache-Control: no-cache, must-revalidate');
   header("Content-type: text/plain");
   header("Accept-Ranges: bytes");
   header("Content-Length: $download_size");
   header('Connection: close');
   
   readfile($filenameReal);
   exit;
}

print "<!-- $requiredNote -->\n";
// Establish timezone offset for time display
# Set timezone in PHP5/PHP4 manner
  if (!function_exists('date_default_timezone_set')) {
	putenv("TZ=" . $TZ);
#	$Status .= "<!-- using putenv(\"TZ=$ourTZ\") -->\n";
    } else {
	date_default_timezone_set("$TZ");
#	$Status .= "<!-- using date_default_timezone_set(\"$ourTZ\") -->\n";
   }
 $TZ = date('T',time()); // get our timezone abbr

// You can now force the cache to update by adding ?force=1 to the end of the URL

if ( empty($_REQUEST['force']) ) 
        $_REQUEST['force']="0";

$Force = $_REQUEST['force'];

if ($Force==1) {
      $html = fetchUVUrlWithoutHanging($UV_URL,$UVcacheName); 
      print "<!-- force reload from URL $UV_URL -->\n";
      $fp = fopen($UVcacheName, "w"); 
	  if($fp) {
        $write = fputs($fp, $html); 
        fclose($fp);
	  } else {
	    print "<!--Unable to write cache $UVcacheName -->\n";
	  }
} 


// refresh cached copy of page if needed
// fetch/cache code by Tom at carterlake.org

if (file_exists($UVcacheName) and filemtime($UVcacheName) + $UVrefetchSeconds > time()) {
      $WhereLoaded = "from cache $UVcacheName";
      $html = implode('', file($UVcacheName));
    } else {
      $WhereLoaded = "from URL $UV_URL";
      $html = fetchUVUrlWithoutHanging($UV_URL);
      $fp = fopen($UVcacheName, "w"); 
	  if($fp) {
        $write = fputs($fp, $html); 
        fclose($fp);
	  } else {
	    print "<!--Unable to write cache $UVcacheName -->\n";
	  }
	}
print "<!-- UV data load from $WhereLoaded -->\n";

/*$UVfcstDate = array_fill(0,9,'');   // initialize the return arrays
$UVfcstUVI  = array_fill(0,9,'n/a');
$UVfcstDOW  = array_fill(0,9,'');
$UVfcstYMD  = array_fill(0,9,'');
$UVfcstISO  = array_fill(0,9,'');
*/
$UVfcstDate = array();   // initialize the return arrays
$UVfcstUVI  = array();
$UVfcstDOW  = array();
$UVfcstYMD  = array();
$UVfcstISO  = array();
$UVfcstOZN  = array();

if(strlen($html) < 50 ) {
  print "<!-- data not available -->\n";
  return;
}
// now slice it up
// Get the table to use:
  preg_match_all('|<dl><dd>\s*<table(.*?)</table>|is',$html,$betweenspan);
//  print "<!-- betweenspan \n" . print_r($betweenspan[1],true) . " -->\n";

// slice the table into rows
  preg_match_all('|<tr>(.*)</tr>|Uis',$betweenspan[1][0],$uvsets);
  $uvsets = $uvsets[1];
//  print "<!-- uvsets \n" . print_r($uvsets,true) . " -->\n";
/*
<!-- uvsets 
Array
(
    [0] => <td align=left ><i>&nbsp;<br>&nbsp; Date</i> </td>
    <td align=right><i>UV <br>&nbsp; index</i> </td>
    <td align=right><i>ozone <br>column</i> </td>
    [1] => <td align=right nowrap>&nbsp; 25 Feb 2008 </td>
    <td align=right nowrap> 4.2 </td>
    <td align=right nowrap>&nbsp;  303.4 DU </td>

    [2] => <td align=right nowrap>&nbsp; 26 Feb 2008 </td>
    <td align=right nowrap> 4.5 </td>
    <td align=right nowrap>&nbsp;  291.8 DU </td>

    [3] => <td align=right nowrap>&nbsp; 27 Feb 2008 </td>
    <td align=right nowrap> 4.0 </td>
    <td align=right nowrap>&nbsp;  328.0 DU </td>
	...
*/  
// $headings = array_shift($uvsets);  // lose the headings row	

$indx = 0;
foreach ($uvsets as $n => $uvtext) { // take each row forecast and slice it up

// extract the data from the current table row
   $uvtext = preg_replace('|&nbsp;|is','',$uvtext);
   preg_match_all('|<td.*?>(.*?)</td>|is',$uvtext,$matches);
   
//   print "<!-- $indx : matches \n" . print_r($matches,true) . " -->\n";
   if (is_numeric(trim($matches[1][1]))) {
     $UVfcstDate[$indx] = trim($matches[1][0]);  // save the values found
	 $UVfcstUVI[$indx] = trim($matches[1][1]);   // save UV index
     $UVfcstOZN[$indx] = trim($matches[1][2]);   // save Ozone index
     $result = substr($UVfcstOZN[$indx], 0, 5);
     $UVfcstOZN[$indx] = $result;   // save Ozone index
	 $t = strtotime($UVfcstDate[$indx]);
	 $UVfcstDOW[$indx] = date('l',$t); // sets to 'Sunday' thru 'Saturday'
	 $UVfcstYMD[$indx] = date('Ymd',$t);  // sets to YYYYMMDD
	 $indx++;
   }

}

foreach ($UVfcstDate as $i => $val) {
  print "<!-- Date='$val', UV='" . $UVfcstUVI[$i] . "' DOW='".$UVfcstDOW[$i]. "' YMD='".$UVfcstYMD[$i]."' -->\n";
}
// now fix up the array so 'today' is the [0] entry
$YMD = date('Ymd',time());
$shifted = 0;
foreach ($UVfcstYMD as $i => $uvYMD ) {
  if ($uvYMD < $YMD) {
    $junk = array_shift($UVfcstDate);
	$junk = array_shift($UVfcstUVI);
	$junk = array_shift($UVfcstDOW);
    $shifted++; 
  }
}
for ($i=0;$i<$shifted;$i++) { // clean up the YMD array after shifting
  $junk = array_shift($UVfcstYMD);
}
if ($shifted) {
  print "<!-- after date=$YMD processing, shifted $shifted entries -->\n";
  foreach ($UVfcstDate as $i => $val) {
    print "<!-- Date='$val', UV='" . $UVfcstUVI[$i] . "' DOW='".$UVfcstDOW[$i]. "' YMD='".$UVfcstYMD[$i]."' -->\n";
  }
}

if($commaDecimal) {
	foreach ($UVfcstUVI as $i => $uvi) {
		$UVfcstUVI[$i] = preg_replace('|\.|',',',$UVfcstUVI[$i]);
	}
   print "<!-- UVfcstUVI entries now use decimal comma format -->\n";
}
$UVfcstUVTODAY = ($UVfcstUVI[0]);
$UVfcstUVTOMORROW = ($UVfcstUVI[1]);
$UVfcstUV2DAYS = ($UVfcstUVI[2]);
$UVfcstUV3DAYS = ($UVfcstUVI[3]);
$UVfcstUV4DAYS = ($UVfcstUVI[4]);
$UVfcstUV5DAYS = ($UVfcstUVI[5]);
$UVfcstOZONE = $UVfcstOZN[0];

// ----------------------------functions ----------------------------------- 

 function fetchUVUrlWithoutHanging($url) // thanks to Tom at Carterlake.org for this script fragment
   {
   // Set maximum number of seconds (can have floating-point) to wait for feed before displaying page without feed
   $numberOfSeconds=4;   

   // Suppress error reporting so Web site visitors are unaware if the feed fails
   error_reporting(0);

   // Extract resource path and domain from URL ready for fsockopen

   $url = str_replace("http://","",$url);
   $urlComponents = explode("/",$url);
   $domain = $urlComponents[0];
   $resourcePath = str_replace($domain,"",$url);

   // Establish a connection
   $socketConnection = fsockopen($domain, 80, $errno, $errstr, $numberOfSeconds);

   if (!$socketConnection)
       {
       // You may wish to remove the following debugging line on a live Web site
        print("<!-- Network error: $errstr ($errno) -->\n");
       }    // end if
   else    {
       $xml = '';
       fputs($socketConnection, "GET $resourcePath HTTP/1.0\r\nHost: $domain\r\n\r\n");
   
       // Loop until end of file
       while (!feof($socketConnection))
           {
           $xml .= fgets($socketConnection, 4096);
           }    // end while

       fclose ($socketConnection);

       }    // end else
	  

   return($xml);

   }    // end function
   
// ----------------------------------------------------------
      
?>