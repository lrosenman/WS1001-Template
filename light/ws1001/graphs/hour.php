<?php
include_once('../settings.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>HOUR FORECAST</title>
		
		 <link rel="stylesheet" type="text/css" href="forecast.css">
			
			<div class="titleforecast"><span style="color:#66a1ba"><?php
echo "${stationName} \n";
?><span style="color:#f27260">Todays</span><span style="color:#777777"> Hourly Forecast</span></span> </div>
        <br>
        <?php
		
$weather = file_get_contents('../jsondata/hourly.json');
$decoded = json_decode($weather, true);
$count = 0;
foreach ($decoded['hourly_forecast'] as $value)
{
    $count++;
    
  $hour = $value['FCTTIME']['civil'];
    $temp = $value['temp']['metric'];
    $condition = $value['condition']; 
	$icon = $value['icon'];  
	$pop = $value['pop'];   
    $uvi = $value['uvi'];
	$humidity = $value['humidity'];
	$wspd = $value['wspd']['metric'];  
	
    echo " <div id='wuforecasthour' <span style='color:#777;font-weight:normal;font-size:11px;line-height:11px;'> \r\n";
	echo "</span><span style='font-size:0px;float:right;'>${icon}<img src='../css/icons/$icon.png' width='50'></span>\n";
    echo ''.$hour.' <span style="color:#f26c4f;font-weight:600;font-size:11px;line-height:11px;"> ';
	echo ''.$temp.'°c </span><span style="font-weight:normql;font-size:11px;line-height:11px;"><br> ';
	echo ''.$condition.' <span style="color:#59a6c2;font-weight:600;font-size:10px;"><br>precip'; 
	echo ' '.$pop. '%<span style="color:#777;font-weight:600;font-size:10px;margin-left:2px;line-height:11px;"><br>Wind'; 
	echo ' '.$wspd.'<span style="font-size:9px;">kmh<span style="color:#f26c4f;font-weight:600;font-size:10px;margin-left:5px;">UVI'; 
	echo ' '.$uvi.'
	
	</div>'; 
	if ($count > 14)
        break;
}?>
					
	</body>
</html>