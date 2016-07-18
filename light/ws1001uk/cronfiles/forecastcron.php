<!--- cron job files are a essential part of this home weather simplicity template without them set 
up correctly the template will always use sample data suppied 
you do not need to edit anything below for the template to work properly

RUN EVERY 60 MINUTES 
brian underdown May 2016 http://idesign34.com --->


<?php
include_once('../settings.php');
?>

<?php 

//***10 day forecast for home weather simplicity template***//	  
$json = file_get_contents('http://api.wunderground.com/api/'.$api.'/forecast10day/q/pws:'.$id.'.json');
$data = json_encode($json);
$file = '../jsondata/forecast10day.json';
file_put_contents($file, $json);
?>
<?php 

	//***hourly forecast for home weather simplicity template***//
$json = file_get_contents('http://api.wunderground.com/api/'.$api.'/hourly_v11/q/pws:'.$id.'.json');
$data = json_encode($json);
$file = '../jsondata/hourly.json';
file_put_contents($file, $json);		
?>
