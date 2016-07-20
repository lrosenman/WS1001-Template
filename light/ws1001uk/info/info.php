<?php include_once('../settings.php');?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Home Weather Station Information</title>
    
    
           <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>
<div style="margin-left:-50px;">
    <div class="card">
  <div class="image">
   <span class="title">WEATHER STATION INFO</span>
   
  </div>
  <div class="content">
    
          <p>Weather station is located in<br><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#f26c4f"><path d="M24 4c-7.73 0-14 6.27-14 14 0 10.5 14 26 14 26s14-15.5 14-26c0-7.73-6.27-14-14-14zm0 19c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/></svg><color><?php echo "${stationName} \n";?></color> elevated at approximately <color><?php echo "${elevation} \n"; ?></color> .<br> The hardware is a 
         <color><?php echo "${hardware} \n";?></color> using wireless remote sensors ,data is updated approximately every 5-60 seconds. Forecast data is provided by Weather underground and is updated every 60 minutes. </p>
  </div>
  <div class="action">
   <?php 
	date_default_timezone_set($TZ);
	echo date("Y"); ?> &copy;
  </div>
</div></div>

<div class="card2">
  <div class="image">
   <span class="title">Contact Info & Credits</span>
   
  </div>
  <div class="content">
  
  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M40 8H8c-2.21 0-3.98 1.79-3.98 4L4 36c0 2.21 1.79 4 4 4h32c2.21 0 4-1.79 4-4V12c0-2.21-1.79-4-4-4zm0 8L24 26 8 16v-4l16 10 16-10v4z"/></svg> <a href='mailto:<?php print "${email} \n";?>' >info@weather34.com</a><br>
  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba" ><path d="M6 10v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4H10c-2.21 0-4 1.79-4 4zm24 8c0 3.32-2.69 6-6 6s-6-2.68-6-6c0-3.31 2.69-6 6-6s6 2.69 6 6zM12 34c0-4 8-6.2 12-6.2S36 30 36 34v2H12v-2z"/></svg> @Twitter:<a target="_blank" href="http://www.twitter.com/<?php print "${twitter} \n"; ?>"><?php echo "${twitter} \n"; ?></a>
     <br> <br>    
  Credits:<br>
         <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://www.obsid.org/2009/02/calculate-moon-phase-data-with-php-iii.html' ><?php echo "Moonphase by Stephen A. Zarkos ";?></a><br>
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://www.emsc-csem.org/#2' ><?php echo "EMSC Earthquake Data";?></a><br>
           <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://noelboss.github.io/featherlight/' ><?php echo "Featherlight.js";?></a><br>
           <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://highcharts.com/' ><?php echo "Highcharts";?></a>
           <br>          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://wunderground.com' ><?php echo "WeatherUnderground";?></a><br>
           <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='http://obrienlabs.net/redirecting-weather-station-data-from-observerip/' ><?php echo "Pat O'Brien";?></a><br>
           <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='https://github.com/lrosenman/WS1001-Template' ><?php echo "Larry Rosenman";?></a><br>
           <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 48 48" fill="#66a1ba"><path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0-10C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/></svg> <a  target="_blank" href='https://weather34.com' ><?php echo "Developed by Brian Underdown ";?></a><br>
           
           
           <br>
           <center><img src="colorchart.png" width="150"></center>
          
          </p>
  </div>
  <div class="action">
   <?php 
	date_default_timezone_set($TZ);
	echo date("Y"); ?> &copy;
  </div>
</div>
    
    
    
  </body>
</html>
