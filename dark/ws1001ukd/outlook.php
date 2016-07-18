<?php
include_once('settings.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>TODAY OUTLOOK FORECAST</title>
		
		 
<link href="css/main.min.css" rel="stylesheet">  
<script src="js/jquery.js"></script> 

	
		<style>
		body {
			background-color: #3d3d3d;
			}
			</style>	
       
       <p style="height:400px;width:100%;background-color: #3d3d3d;background-size:cover;padding:0px;top:10px; background: url(css/logos/graphlogo.png) left 10px bottom 10px no-repeat;">
       <div class="outlook" style="background-color: #3d3d3d;"><div class="outlooktitle">   
  <span><i class="fa fa-map-marker1"></i>    <?php
echo "${stationName} \n";
?> </span>Outlook Today & <span>Tomorrow</span></div>
   <!-- day outlook --->
   <section id='dayicon' style="background-repeat:no-repeat !important;margin-left:5px;margin-top:5px;color:#ccc; ">
  <section id='day' style="margin-left:55px;z-index:1;color:#ccc; "></section></section>
  <!-- night outlook --->
  <section id='nticon' style="background-repeat:no-repeat !important;margin-top:15px;margin-left:5px;color:#ccc;  ">
  <section id='night' style="margin-left:55px;z-index:1;color:#ccc; "></section></section></p>
   <section id='tomoicon' style="background-repeat:no-repeat !important;background-size:60px;margin-top:15px;margin-left:5px;color:#ccc;  ">
  <section id='tomo' style="margin-left:55px;z-index:1;color:#ccc; "></section></section></div></div></div></p>
  
  
  	
	</body>
    <script>
	

<!-- dashboard outlook script for homeweather station --->
 $(document).ready(function(t){t.ajax({url:"jsondata/forecast10day.json",dataType:"json",success:function(c){var a=c.forecast.txt_forecast.forecastday,a=c.forecast.txt_forecast.icon,a=c.forecast.txt_forecast.icon_url;for(period in a){var o=""+a[period].fcttext_metric,e=t("<p/>").text(o);t(".homeweatheroutlook").append(e)}var a=c.forecast.txt_forecast.forecastday;for(index in a){var r="./css/icons/";
 t("#dayicon").css("background-image","url("+r+a[0].icon+".png)"),
 t("#day").html("<span>Today</span>  "+a[0].fcttext_metric),
 t("#night").html("<span>Tonight </span>  "+a[1].fcttext_metric),
 t("#nticon").css("background-image","url("+r+a[1].icon+".png)")
 t("#tomo").html("<span>Tomorrow </span>  "+a[2].fcttext_metric),
 t("#tomoicon").css("background-image","url("+r+a[2].icon+".png)") 
 }}})});
 
 
 </script>
</html>