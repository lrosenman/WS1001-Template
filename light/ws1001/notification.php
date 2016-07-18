<?php
include_once('livedata.php');?>
<div class="updatedtimealert"><span>Updated</span> <?php 
 echo $update;
?> </div>
<?php
$sum_total = number_format($temp_c - $trendTemp,2);
?>
<div class="info"></div>
      <?php echo " ";
// 15th June 2016 homeweather station notifications alerts and cautions you can set the value to your preferred setting  //
// or what you term as an alert by increasing or decreasing the numbers below >45 etc..// 
 //windgust 
 if($wind_gust_kph >45 ) {echo "<div class='homeweathernotify'>
 
  <br> 
  <img src='img/windgust.png' width='35px'></img> Wind Gusts at <hv> ${wind_gust_kph} </hv><span>${windunit} <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";}  
 
  //windchill
 else  if($windchill <10 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/windchill.png' width='35px'></img><hvcold> ${windchill}&deg</hvcold><span> Wind Chill Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  //uv 
 else  if($UV >8 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/uvi.png' width='35px'></img><hv>${UV} </hv><span> UVINDEX Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";}   
  
  //heatindex
 else  if($heatindex >30 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/heatindex.png' width='35px'></img><hv>${heatindex}&deg </hv><span> HEAT INDEX Caution <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  //rainrate
 else  if($rainrate>10 ) {echo "<div class='homeweathernotify'>
   
  <br> 
  <img src='img/rain.png' width='35px'></img><hv>${rainrate}</hv> per/hr<span> Rainfall  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span><br>
  ";} 
  
  
  //temp rate increase per 10 minutes 
  else if ($sum_total>0.5){echo  "<div class='homeweathernotify'>   
  <br><span style='font-size:1.2em;color:#f26c4f;'> 
  <hv>+$sum_total&deg</hv></span> 
  <description>last 10 minutes <warmer>temperature</warmer><br>has rapidy risen <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></description>
  "
  ;}
  
  //temp rate decrease per 10 minutes 
  else if ($sum_total<-0.5){echo  "<div class='homeweathernotify'>  <br> 
  <span style='font-size:1.2em;color:#66a1ba;'> 
  <hvcold>$sum_total&deg</hvcold></span>
  <description>last 10 minutes <colder>temperature</colder><br>has rapidy fallen <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></description>
  "
  ;}
  
  
  //no cautions
 else  {
    echo "<div class='homeweathernotify'>
	<br>
	<hvempty> No Current Alerts </hvempty> \n";
}
 
  ?>
</div></div>