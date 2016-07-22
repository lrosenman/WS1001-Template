<?php
include_once('livedata.php');?><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>  <div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?> </div>
<div class="averagetemp"><span></span>
<?php
$sum_total = number_format($temp_c - $trendTemp,2);
if ($sum_total>0)echo "+$sum_total&deg <span><br>last 15 minutes</span>";
else if ($sum_total<0)echo "$sum_total &deg <span><br>last 15 minutes</span>";
?>
</div>
<!-- start animated temperature for homeweather station--> 
                <div class="tempcontainer"><div class="circleOut">
  
<?php echo "";if($temp_c>150){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextveryhot\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<35){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextfreezing\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<40){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextcold\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<45){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextgettingcolder\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<50){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextcolder\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<60){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextcooler\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<70){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextmild\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<80){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextgettingcooler\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<85){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextwarm\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<90){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextwarmer\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<95){echo "<div class=\"temperaturecircle\"></div><div class=\"temptexthot\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<100){echo "<div class=\"temperaturecircle\"></div><div class=\"temptexthotter\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<105){echo "<div class=\"temperaturecircle\"></div><div class=\"temptexthotter\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<110){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextveryhot\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<155){echo "<div class=\"temperaturecircle\"></div><div class=\"temptextextremehot\">${temp_c}<suptemp>&deg;</suptemp></div>";}?>

</div>
<div class="max">Feels 
<?php echo "";
if($windchill <40) {echo "Colder \n";}

else if($realfeel >90) {echo "Warmer \n";}

else {echo "${realfeel}&deg;</span>\n";}

?>
    </div>
<div class="temptrend">
<?php
// for WS1001 clones compares the reading from 10 minutes ago( or based on the stationcron update interval and compares it to the current realtime reading //
//echo $trendTemp;
if ($temp_c === $trendTemp) {
    echo "Temp&nbsp;<span style='font-size:1em;color:#ccc;'><i class='wi wi-wind towards-90-deg'></i>&nbsp;Steady</span>";
}

if ($temp_c > $trendTemp) {
    echo "Temp&nbsp;<span style='font-size:1em;color:#f26c4f;'><i class='wi wi-wind towards-45-deg'></i></span>&nbsp;Rising</span>";
}

if($temp_c < $trendTemp) {
     echo "Temp&nbsp;<span style='font-size:1em;color:#66a1ba'><i class='wi  wi-wind towards-225-deg'></i></span>&nbsp;Falling</span>";
}
 ?>
    </span></div>
</div>
<div class="heatcircle">
<div class="heatcircle-content"><?php echo "";
if ($heatindex >90 ) {
    echo "HeatIndex <br><span style='color:#f26c4f;font-weight:600;'>${heatindex}${templateunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span> \n";
}
else if($windchill <40) {
    echo "Windchill <br><span style='color:#5395b5;font-weight:600;'>${windchill}${templateunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span> \n";
}

else  {
    echo "Temp Factors <br><span style='color:#f26c4f;font-weight:600;'>No Cautions</span>\n";
}
	

    ?></span>
<div class="heatcircle-content">Humidity <br><span style="color:#51b1a5;font-weight:600;"><?php echo "${humidity}%\n"; ?>
<?php if ($humidity === $humiditytrend) {
    echo "<span style='color:#ccc;'><i class='wi wi-wind towards-90-deg'></i></span>";
}

if ($humidity > $humiditytrend) {
    echo "<span style='color:#f26c4f;'><i class='wi wi-wind towards-45-deg'></i></span>";
}

if($humidity < $humiditytrend) {
     echo "<span style='color:#66a1ba;'><i class='wi wi-wind towards-225-deg'></i></span>";
}
?>
</span>
<div class="heatcircle-content">Dewpoint <br><span style="color:#66a1ba;font-weight:600;">
<?php echo "${dewpoint_c}${templateunit}\n"; ?>
<?php if ($dewpoint_c === $dewpointtrend) {
    echo "<span style='color:#ccc;'><i class='wi wi-wind towards-90-deg'></i></span>";
}

if ($dewpoint_c > $dewpointtrend) {
    echo "<span style='color:#f26c4f;'><i class='wi wi-wind towards-45-deg'></i></span>";
}

if($dewpoint_c < $dewpointtrend) {
     echo "<span style='color:#66a1ba;'><i class='wi wi-wind towards-225-deg'></i></span>";
}
?>
</span>

