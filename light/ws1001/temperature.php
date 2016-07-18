<?php
include_once('livedata.php');?><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>  <div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?> </div>
<div class="average"><span></span>
<?php
$sum_total = number_format($temp_c - $trendTemp,2);
if ($sum_total>0)echo "+$sum_total &deg";
else if ($sum_total<0)echo "$sum_total &deg";
?>
</div>
<!-- start animated temperature for homeweather station--> 
                <div class="tempcontainer"><div class="circleOut">
  <span style="font-size:0px;">   
<?php echo "${temp_c}&deg;</span> \n";if($temp_c>100){echo "<div class=\"veryhot\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<2){echo "<div class=\"freezing\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<5){echo "<div class=\"cold\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<7){echo "<div class=\"gettingcolder\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<10){echo "<div class=\"colder\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<12){echo "<div class=\"cooler\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<15){echo "<div class=\"mild\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<18){echo "<div class=\"milder\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<20){echo "<div class=\"gettingcooler\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<23){echo "<div class=\"warm\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<25){echo "<div class=\"warmer\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<27){echo "<div class=\"hot\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<30){echo "<div class=\"hotter\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<35){echo "<div class=\"hotter\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<40){echo "<div class=\"veryhot\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}
else if($temp_c<55){echo "<div class=\"extremehot\"></div><div class=\"temptext\">${temp_c}<suptemp>&deg;</suptemp></div>";}?>
</div>
<div class="max">Feels 
<?php echo "";
if($windchill <10) {echo " Colder \n";}

else if($realfeel >28) {echo " Warmer \n";}

else {echo "${realfeel}&deg;</span>\n";}

?>
    </div>
<div class="temptrend">
<?php
// for WS1001 clones compares the reading from 10 minutes ago( or based on the stationcron update interval and compares it to the current realtime reading //
//echo $trendTemp;
if ($temp_c === $trendTemp) {
    echo "Temp&nbsp;<span style='font-size:1em;'><i class='wi wi-wind towards-90-deg'></i></span>&nbsp;Steady";
}

if ($temp_c > $trendTemp) {
    echo "Temp&nbsp;<span style='font-size:1em;'><i class='wi wi-wind towards-45-deg'></i></span>&nbsp;Rising";
}

if($temp_c < $trendTemp) {
     echo "Temp&nbsp;<span style='font-size:1em;'><i class='wi  wi-wind towards-225-deg'></i></span>&nbsp;Falling";
}
 ?>
    </span></div>
</div>
<div class="heatcircle">
<div class="heatcircle-content"><?php echo "";
if ($heatindex >30 ) {
    echo "HeatIndex <br><span style='color:#df826b;font-weight:600;'>${heatindex}${templateunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span> \n";
}
else if($windchill <10) {
    echo "Windchill <br><span style='color:#5395b5;font-weight:600;'>${windchill}${templateunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span> \n";
}

else  {
    echo "Temp Factors <br><span style='color:#df826b;font-weight:600;'>No Cautions</span>\n";
}
	

    ?></span>
<div class="heatcircle-content">Humidity <br><span style="color:#51b1a5;font-weight:600;"><?php echo "${humidity}%\n"; ?>
<?php if ($humidity === $humiditytrend) {
    echo "<span style='color:#ccc;'><i class='wi wi-wind towards-90-deg'></i></span>";
}

if ($humidity > $humiditytrend) {
    echo "<span style='color:#df826b;'><i class='wi wi-wind towards-45-deg'></i></span>";
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
    echo "<span style='color:#df826b;'><i class='wi wi-wind towards-45-deg'></i></span>";
}

if($dewpoint_c < $dewpointtrend) {
     echo "<span style='color:#66a1ba;'><i class='wi wi-wind towards-225-deg'></i></span>";
}
?>
</span>
