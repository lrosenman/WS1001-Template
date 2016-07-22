<!--- cron job files are a essential part of this home weather simplicity template without them set 
up correctly the template will always use sample data suppied 
you do not need to edit anything below for the template to work properly

RUN EVERY 10 MINUTES 
brian underdown March 2016 http://idesign34.com --->


<?php
include_once('../settings.php');
?>
<?php
//homeweather station trend data//
$json = file_get_contents($livedata);
$data = json_decode($json);
file_put_contents('../jsondata/temptrend.json',json_encode($data));
?>

<?php 
//disable error logging
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set(“display_errors”,”off”);
	// extras added march 23rd 2016 //
date_default_timezone_set($TZ);
$date = date_create();
//***get station id weather every 10 minutes for home weather station***//
$json = file_get_contents('http://api.wunderground.com/api/'.$api.'/conditions_v11/q/pws:'.$id.'.json');
$data = json_encode($json);
$file = '../jsondata/weather.json';
//if ( json.length == 0 ) {
//       console.log("OFFLINE!");}
file_put_contents($file, $json);

?>


<?php 
// local regional extras added march 23rd 2016 //
date_default_timezone_set($TZ);
$date = date_create();
	//*** last 1 earthquake home weather station***//
$json = file_get_contents('http://www.seismicportal.eu/fdsnws/event/1/query?limit=1&lat='.$lat.'&lon='.$lon.'&maxradius=10&format=json&nodata=204&minmag=2');
$data = json_encode($json);
$file = '../jsondata/eq.json';
file_put_contents($file, $json);
?>

<?php 
// significant worldwide extras added April 2016 //
date_default_timezone_set($TZ);
$date = date_create();
	//***last 3 eaerthquakes for home weather station***//
	 $json = file_get_contents('http://www.seismicportal.eu/fdsnws/event/1/query?limit=1&lat='.$lat.'&lon='.$lon.'&maxradius=100000&format=json&nodata=204&minmag=5');
$data = json_encode($json);
$file = '../jsondata/eq3.json';
file_put_contents($file, $json);
?>
