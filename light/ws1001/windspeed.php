<?php include_once('livedata.php');?>

<div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?> </div>

<span style="color:#f26c4f;">
<?php //units 
echo "${windunit}"; ?> </span>
<div class="windicons">  
<?php
//beaufort icon
echo "${wind_kph}</windgust> \n";if($wind_kph<1){echo "<img src='css/windspeed/Wind Speed Less 1.png' width='25px'></img>";}else if($wind_kph<2){echo "<img src='css/windspeed/windspeed2.png' width='25px'></img>";}else if($wind_kph<7){echo "<img src='css/windspeed/Wind Speed 3-7 Filled.png' width='25px'></img>";}else if($wind_kph<12){echo "<img src='css/windspeed/Wind Speed 8-12 Filled.png' width='25px'></img>";}else if($wind_kph<17){echo "<img src='css/windspeed/Wind Speed 13-17 Filled.png' width='25px'></img>";}else if($wind_kph<22){echo "<img src='css/windspeed/Wind Speed 18-22 Filled.png' width='25px'></img>";}else if($wind_kph<27){echo "<img src='css/windspeed/Wind Speed 23-27 Filled.png' width='25px'></img>";}else if($wind_kph<32){echo "<img src='css/windspeed/Wind Speed 28-32 Filled.png' width='25px'></img>";}else if($wind_kph<37){echo "<img src='css/windspeed/Wind Speed 33-37 Filled.png' width='25px'></img>";}else if($wind_kph<42){echo "<img src='css/windspeed/Wind Speed 38-42 Filled.png' width='25px'></img>";}else if($wind_kph<47){echo "<img src='css/windspeed/Wind Speed 43-47 Filled.png' width='25px'></img>";}else if($wind_kph<52){echo "<img src='css/windspeed/Wind Speed 48-52 Filled.png' width='25px'></img>";}else if($wind_kph<57){echo "<img src='css/windspeed/Wind Speed 53-57 Filled.png' width='25px'></img>";}else if($wind_kph<62){echo "<img src='css/windspeed/Wind Speed 58-62 Filled.png' width='25px'></img>";}else if($wind_kph<102){echo "<img src='css/windspeed/Wind Speed 98-102 Filled.png' width='25px'></img>";}else if($wind_kph<107){echo "<img src='css/windspeed/Wind Speed 103-107 Filled.png' width='25px'></img>";}?></div> <!-- end wind speed icons -->

<span style="position:absolute;margin-top:23px;margin-left:-95px;font-size:0.8em;color:#777;"><?php echo "Blowing at";?></span>
<h2 style="padding-bottom:5px;line-height:1em;height:50px;font-size:2.5em;font-family:'weathertext',Helvetica,Arial;">
<?php // wind speed & unit
echo "${wind_kph}";?>
<span style="font-size:0.3em;font-weight:100;color:#bbb;"><?php echo "${windunit}"; ?></span>  
<span style="font-size:0.9em;font-weight:100;color:#eee;"> |</span> 

<span style="color:#a0a5a9">
<?php 
//gust values & unit
echo "${wind_gust_kph}";?>
<span style="font-size:0.3em;font-weight:100;color:#bbb;"><?php echo "${windunit}"; ?></span>  
</span></h2>

<span style="position:absolute;margin-top:-77px;margin-left:25px;font-size:0.8em;color:#777;"><?php echo "Gusting at";?></span>

<span style="position:absolute;margin-top:-25px;margin-left:20px;font-size:0.8em;color:#777;">
<?php echo "";
//alarm
if($wind_gust_kph>45){echo "Strong Gusts <i class='fa fa-exclamation-triangle' aria-hidden='true'></i>" ;} ?>
</span>

<span style="position:absolute;margin-top:-25px;margin-left:-95px;font-size:0.8em;color:#777;">
<?php
//wind phrase
echo "";
if($wind_kph<1){echo "&nbsp;&nbsp;Calm";}
else if($wind_kph<5){echo " &nbsp;Light Breeze";}
else if($wind_kph<11){echo "&nbsp;Light Breeze";}
else if($wind_kph<19){echo "&nbsp;Gentle Breeze";}
else if($wind_kph<28){echo "Moderate Breeze";}
else if($wind_kph<38){echo "&nbsp;Fresh Breeze";}
else if($wind_kph<49){echo "&nbsp;Strong Breeze";}
else if($wind_kph<61){echo "&nbsp;Near Gale";}
else if($wind_kph<74){echo "&nbsp;Gale Force";}
else if($wind_kph<88){echo "&nbsp;Strong Gale";}
else if($wind_kph<102){echo "&nbsp;&nbsp;Storm";}
else if($wind_kph<117){echo "&nbsp;Violent Storm";}
else if($wind_kph<300){echo "&nbsp;Hurricane";}?>
</span>



<div class="windspeedtrend">

<?php 
//wind speed trend
$windgain = number_format($wind_kph - $windtrend,2 ); 
if ($windgain>0)echo "     +$windgain <supmb>${windunit}</supmb>";
else echo "";
?></div>
<div class="gustspeedtrend">
<?php
// wind gust trend
$windgain1 = number_format($wind_gust_kph - $windgusttrend,2 ); 
if ($windgain1>0)echo "     +$windgain1 <supmb>${windunit}</supmb>";
else echo "";
?></div>

 