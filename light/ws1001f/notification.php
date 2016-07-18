<?php
include_once('livedata.php');?>
<div class="updatedtimealert"><span>Updated</span> <?php 
 echo $update;
?> </div>
<div class="info"></div>
      <?php echo " ";
// 15th June 2016 homeweather station notifications alerts and cautions you can set the value to your preferred setting  //
// or what you term as an alert by increasing or decreasing the numbers below >45 etc..// 
 //windgust 
 if($wind_gust_kph >30 ) {echo "<div class='homeweathernotify'>
 
  <br> 
  <img src='img/windgust.png' width='35px'></img> Wind Gusts at <hv> ${wind_gust_kph} </hv><span>${windunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";}  
 
  //windchill
 else  if($windchill <40 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/windchill.png' width='35px'></img><hvcold> ${windchill}&deg</hvcold><span> Wind Chill Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  //uv 
 else  if($UV >6 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/uvi.png' width='35px'></img><hv>${UV} </hv><span> UVINDEX Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";}   
  
  //heatindex
 else  if($heatindex > $temp_c ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/heatindex.png' width='35px'></img><hv>${heatindex}&deg </hv><span> HEAT INDEX Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  //rainrate
 else  if($rainrate>0.4 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/rain.png' width='35px'></img><hv>${rainrate}</hv> per/hr<span> Rainfall  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  //no cautions
 else  {
    echo "<div class='homeweathernotify'>
	<br>
	<hvempty> No Current Alerts </hvempty> \n";
}
 
  ?>
</div>