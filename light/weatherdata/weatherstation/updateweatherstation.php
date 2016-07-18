<?php
$wunderground = file_get_contents("http://rtupdate.wunderground.com/weatherstation/updateweatherstation.php?" . $_SERVER['QUERY_STRING']);
echo $wunderground;

	//disable error logging if you get erver errors
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set(“display_errors”,”off”);
	// extras added march June 2016 ws1001 clones //
date_default_timezone_set('Europe/Istanbul');
$date = date_create();
$data = array(
     
    "timestamp" => date_timestamp_get($date),
	"updated" => date("G:i:s"),
	"outsideTemp" => $_GET['tempf'],
	"outsideHumidity" => $_GET['humidity'],
	"humiditytrend" => $_GET['humidity'],
	"dewpoint" => $_GET['dewptf'],
	"dewpointtrend" => $_GET['dewptf'],
	"windchill" => $_GET['windchillf'],
	"heatindex" => $_GET['heatindex'],
	"realfeel" => $_GET['realfeel'],
	"windDir" => $_GET['winddir'],
	"windSpeed" => $_GET['windspeedmph'],
	"windGust" => $_GET['windgustmph'],
	"rainrate" => $_GET['rainin'],
	"raintoday" => $_GET['dailyrainin'],
	"rainweek" => $_GET['weeklyrainin'],
	"rainmonth" => $_GET['monthlyrainin'],	
	"rainyear" => $_GET['yearlyrainin'],
	"radiation" => $_GET['solarradiation'],
	"UV" => $_GET['UV'],
	"UVtrend" => $_GET['UV'],
	"indoorTemp" => $_GET['indoortempf'],
	"indoorfeel" => $_GET['indoorfeel'],
	"indoorHumidity" => $_GET['indoorhumidity'],
	"barometer" => $_GET['baromin'],
	"absbarometer" => $_GET['absbaromin'],
	"indoortrendTemp" => $_GET['indoortempf'],
	"indoortrendHumidity" => $_GET['indoorhumidity'],
	"trendTemp" => $_GET['tempf'],
	"windtrend" => $_GET['windspeedmph'],
	"windgusttrend" => $_GET['windgustmph'],
	"trendbarometer" => $_GET['baromin'],
	"solartrend" => $_GET['solarradiation'],
	"softwaretype" => $_GET['softwaretype'],
	"month"=> date("F"),
	"year"=> date("Y"),
	"day"=> date("l"),
	"realtime" => $_GET['realtime'],
	"rtfreq" => $_GET['rtfreq'],
	"status" => $_GET['action'],
	"timeutc"=> $_GET['dateutc'],	
	"power" => $_GET['action']== "updateraw",
	);
//start the heat index & real feel
$t=$data["outsideTemp"];
$rh=$data["outsideHumidity"];
// realfeel
$data["realfeel"] = round((0.5 * ($t + 61.0 + (($t -68.0) * 1.2) +  ($rh *0.094))),1);
// heat index
$data["heatindex"]= round((-42.379 + 2.04901523 * $t + 10.1433127*$rh - .22475441*$t*$rh - .00683783 *$t * $t - .05481717 * $rh * $rh + .00122874*$t*$t*$rh + .00085282 *$t * $rh *$rh - .00000199 *$t *$t *$rh * $rh),1);

//start the indoor real feel
$it=$data["indoorTemp"];
$irh=$data["indoorHumidity"];
// realfeel
$data["indoorfeel"] = round((0.5 * ($it + 61.0 + (($it -68.0) * 1.2) +  ($irh *0.094))),1);

//output the file
$json = json_encode($data);

$file = 'ws1001.json';
file_put_contents($file, $json);
?>
