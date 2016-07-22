<?php include('livedata.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Sinanoba Istanbul weather station</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="Home weather station providing current weather conditions " name="description">
	<meta content="website" property="og:type">
	<meta content="7 days" name="revisit-after">
	<meta content="web" name="distribution">
	<meta content="weather station" property="og:title">
	<meta content="weather station" property="og:site_name">
	<meta content="" property="og:url">
	<meta content="Home weather station providing current weather conditions " property="og:description">
	<meta content="img/weather34.jpg" property="og:image">
	<meta content="" property="fb:app_id">
	<meta content="place" property="og:type">
	<meta content="brian underdown" name="author">
	<meta content="INDEX,FOLLOW" name="robots">
	<meta content="width=device-width" name="viewport">
	<link href="img/apple-icon-57x57.png" rel="apple-touch-icon" sizes="57x57">
	<link href="img/apple-icon-60x60.png" rel="apple-touch-icon" sizes="60x60">
	<link href="img/apple-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
	<link href="img/apple-icon-76x76.png" rel="apple-touch-icon" sizes="76x76">
	<link href="img/apple-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
	<link href="img/apple-icon-120x120.png" rel="apple-touch-icon" sizes="120x120">
	<link href="img/apple-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
	<link href="img/apple-icon-152x152.png" rel="apple-touch-icon" sizes="152x152">
	<link href="img/apple-icon-180x180.png" rel="apple-touch-icon" sizes="180x180">
	<link href="img/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
	<link href="img/favicon-96x96.png" rel="icon" sizes="96x96" type="image/png">
	<link href="img/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link href="favicon.ico" rel="icon" type="image/x-icon">
	<link href="css/main.min.css" rel="stylesheet prefetch">
	<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet prefetch" type="text/css">
	<script src="js/jquery.js"></script>
	<script src="js/combi.js"></script>
	<script>
	$(document).ready(function(){$("#temperature").load("temperature.php");var a=setInterval(function(){$("#temperature").load("temperature.php")},30000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#indoor").load("indoor.php");var a=setInterval(function(){$("#indoor").load("indoor.php")},60000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#notification").load("notification.php");var a=setInterval(function(){$("#notification").load("notification.php")},30000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#currentsky").load("currentsky.php");var a=setInterval(function(){$("#currentsky").load("currentsky.php")},300000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#windspeed").load("windspeed.php");var a=setInterval(function(){$("#windspeed").load("windspeed.php")},17000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#barometer").load("barometer.php");var a=setInterval(function(){$("#barometer").load("barometer.php")},150000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#windirection").load("windirection.php");var a=setInterval(function(){$("#windirection").load("windirection.php")},17000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#rainfall").load("rainfall.php");var a=setInterval(function(){$("#rainfall").load("rainfall.php")},60000);$.ajaxSetup({cache:false})});$(document).ready(function(){$("#solar").load("solar.php");var a=setInterval(function(){$("#solar").load("solar.php")},30000);$.ajaxSetup({cache:false})});
	</script>
</head>
<body>
	<header>
  <input data-function='swipe' id='swipe' type='checkbox'>
  <label data-function='swipe' for='swipe'>&#xf0c9;</label>   
  <button class="button right">
 <i class="fa fa-map-marker1 fa-1x"></i> <span><?php echo "${stationName} \n";?> <br>WEATHER STATION</span> 
 </button>
               
      <div class='sidebar'>
    <nav class='menu'>
      <li><a href="info/info.php" data-featherlight="iframe"><img src="img/info2.png" width="40px"> Location Info</a></li>
      <li><a href="info/info.php" data-featherlight="iframe"><img src="img/info3.png" width="40px"> Contact Info</a></li>
      <li><a href="<?php echo "$weatherunderground \n";?>" target="_blank"><img src="img/wu.png" width="40px"> WU Station</a></li>
     <li><a href="moon.php" data-featherlight="iframe"><img src="img/moon.png" width="40px"> Sun/Moon Info</a></li>
      <li><?php echo "$templateversion";?></li>
  </div>
           
                
                
</header>

    <!-- begin top layout for homeweatherstation template-->
	<!--indoor temperature for homeweatherstation template-->
	<div class="weather2-container">
		<div class="weather2-item" style="background-image:url(css/homepageicons/temp.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;">
			<i aria-hidden="true" class="fa fa-home"></i> Temperature Indoor
			<div class="indoorvalues">
				<div id="indoor"></div>
			</div>
			<div class="indoorunit">
				<?php echo "${indoorunit} \n";?>
			</div>
		</div><!--realtime clock for homeweatherstation template-->
		<div class="weather2-item" style="background-image:url(css/homepageicons/time.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;">
			HOME<strong>WEATHER</strong>STATION<br>
			<div class="clock-container">
				<span style="position:absolute;margin-left:40px;font-size:11px;margin-top:-25px;"><?php echo date('D M jS');?></span>
				<ul>
					<li><span></span></li>
				</ul>
			</div><!-- homeweather end local time  -->
			<div class="indoorlocation">
				<i class="fa fa-map-marker1"></i> <?php echo "${stationName} \n";?>
			</div>
		</div><!-- notifications cautions/alerts for homeweatherstation template-->
		<div class="weather2-item" style="background-image:url(css/homepageicons/caution.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;">
			<i aria-hidden="true" class="fa fa-exclamation-circle"></i> Notification Alerts
			<div class="indoorvalues">
				<div id="notification"></div>
			</div>
		</div>
	</div><!--end indoor section for homeweatherstation template-->
	<!--begin outside/station data section for homeweatherstation template-->
	<div class="weather-container">
		<div class="weather-item">
			<div class="chartforecast">
				<a data-featherlight="iframe" href="yearly/yeartemp.php"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${year}\n";?></span></a> <a data-featherlight="iframe" href="yearly/monthtemp.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${month}\n";?></span></a> <a data-featherlight="iframe" href="yearly/temptoday.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${day}\n";?></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Temperature <?php echo "${templateunit} \n";?><br></span>
			<div id="temperature"></div>
		</div><!--forecast for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<a data-featherlight="iframe" href="graphs/forecast10.php"><i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;">Forecast Ahead</span></a> <a data-featherlight="iframe" href="outlook.php" style="margin-left:20px;"><i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${day}\n";?> Outlook</span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;"><i class="fa fa-map-marker"></i> <?php echo "${stationlocation} \n";
			?>Forecast</span><br>
			<div class="updatedtime">
				<span>Updated</span> <?php echo $update;?>
			</div><br>
			<div id="wuforecasts"></div>
		</div><!--currentsky for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<!-- HOURLY & Outlook for homeweather station--><a data-featherlight="iframe" href="graphs/hour.php"><i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;">Hourly Forecast</span></a> <a data-featherlight="iframe" href="moon.php" style="margin-left:20px;"><span style="color:#777;"><i class='wi wi-moon-alt-waning-crescent-3'></i> <span style="color:#66a1ba;">Sun/Moon Info</span></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Current Conditions</span><br>
			<div id="currentsky">
				<div class="loadingtheweather">
					<div class="dot dot-1"></div>
					<div class="dot dot-2"></div>
					<div class="dot dot-3"></div>
					<div class="dot dot-4"></div>
				</div>
			</div>
		</div>
	</div><!--windspeed for homeweatherstation template-->
	<div class="weather-container">
		<div class="weather-item">
			<div class="chartforecast">
				<a data-featherlight="iframe" href="yearly/windyear.php"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${year}\n";?></span></a> <a data-featherlight="iframe" href="yearly/windmonth.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${month}\n";?></span></a> <a data-featherlight="iframe" href="yearly/windtoday.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${day}\n";?></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Wind Speed</span><br>
			<div id="windspeed"></div>
		</div><!--barometer for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<a data-featherlight="iframe" href="yearly/yearbarometer.php"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${year}\n";?></span></a> <a data-featherlight="iframe" href="yearly/monthbarometer.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${month}\n";?></span></a> <a data-featherlight="iframe" href="yearly/barometertoday.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${day}\n";?></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Barometer</span><br>
			<div id="barometer"></div>
		</div><!--wind direction for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<i class="fa fa-dot-circle-o fa-1x"></i> 360&deg; Direction
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Wind Direction</span><br>
			<div class="windirection">
				<div id="windirection"></div>
			</div>
		</div>
	</div><!--rainfall for homeweatherstation template-->
	<div class="weather-container">
		<div class="weather-item">
			<div class="chartforecast">
				<a data-featherlight="iframe" href="yearly/yearrain.php"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${year}\n";?></span></a> <a data-featherlight="iframe" href="yearly/monthrain.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${month}\n";?></span></a> <a data-featherlight="iframe" href="yearly/rainfalltoday.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;"><?php echo "${day}\n";?></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">Rainfall Today</span><br>
			<div id="rainfall"></div>
		</div><!--solar for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<i class="fa fa-dot-circle-o fa-1x"></i> <a data-featherlight="iframe" href="uvinfo/solarhour.php"><span style="color:#F26C4F">UVINDEX <span style="color:#66a1ba;"><?php echo "${day}\n";?></span></span> &nbsp;</a> <a data-featherlight="iframe" href="yearly/solartoday.php" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i> <span style="color:#66a1ba;">Solar <?php echo "${day}\n";?></span></a>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;">UV | <span style="color:#F26C4F">Solar Data</span></span><br>
			<div id="solar"></div>
		</div><!--earthquake for homeweatherstation template-->
		<div class="weather-item">
			<div class="chartforecast">
				<i class="fa fa-map-marker fa-1x"></i> <span style="color:#777;font-weight:600;">Regional <span style="color:#F26C4F;">& <span style="color:#66a1ba;">Significant Earthquakes</span></span></span>
			</div><span style="font-size:11px;font-weight:600;text-transform:uppercase;color:#ccc;"><span style="color:#66a1ba;">Earthquake</span> Data</span><br>
			<div class="updatedtime">
				<span>Updated</span> <?php echo $update;?>
			</div>
			<div id="deprem"></div><!-- regional earthquake scripts homeweather station =-->
			<script async id="deprem-template" type="text/x-handlebars-template">
			         <div class="deprem">                
			                     {{#each features}}    
			                     <div class="magnitude">                    
			                     <span class ="mag">
			                     <span class ="content">                    
			                     {{properties.mag}}
			                     <br>
			                     <div class="magtext"> magnitude</div></span>                                               
			                     <div class="place">
			                     <i class="fa fa-map-marker "></i>
			                     {{properties.flynn_region}}<br>
			                     <span style="color:#F26C4F;font-weight:400;font-size:11px;font-family:'Helvetica', Arial;">
			                     {{datetime properties.time}}<br>    
			                     <i class="fa fa-map-marker "></i> <span style="font-size:11px;font-family:'Helvetica', Arial;color:#ccc;line-height:15px;">Lat:
			                     {{properties.lat}}&deg;- Lon:{{properties.lon}}&deg;        
			                     </span>
			                     </div>
			                     {{/each}}
			                       </div>
			</script> <!--significant worldwide earthquakes=-->
			 
			<script async id="deprem-template2" type="text/x-handlebars-template">
			         <div class="deprem2">                
			                     {{#each features}}    
			                     <div class="magnitude2">                    
			                     <span class ="mag2"><span class ="content2">                    
			                     {{properties.mag}}<br><div class="magtext2"> </div></span>                        
			                     <div class="place2">
			                     <i class="fa fa-map-marker "></i>
			                     {{properties.flynn_region}}<br>
			                     <span style="color:#F26C4F;font-weight:400;font-size:11px;">
			                     {{datetime properties.time}}<br>    
			                     <i class="fa fa-map-marker "></i> <span style="font-size:10px;font-family:'Helvetica', Arial;color:#ccc;line-height:15px;">Lat:
			                     {{properties.lat}}&deg;- Lon:{{properties.lon}}&deg;        
			                     </span>
			                     </div>
			                     {{/each}}
			                       </div>
			</script>
			<div id="deprem2"></div>
		</div>
	</div><!--end outdoor data for homeweatherstation template-->
	<!--footer are for homeweatherstation template-->
	<div class="weatherfooter-container">
		<div class="weatherfooter-item">
			<br>
			<span style="float:right;padding:10px;font-size:10px;"><i aria-hidden="true" class="fa fa-expand fa-lg"></i> Fullscreen <i aria-hidden="true" class="fa fa-compress fa-lg"></i> Minimize</span>
			<div style="color:#66a1ba;margin-left:100px;font-size:11px;font-family:Arial,Helvetica;">
				<i class="fa fa-map-marker fa-1x"></i> <span style="color:#F26C4F;font-family:Arial,Helvetica;">Location :</span> <span style="color:#66a1ba;font-weight:600;"><?php echo "${lat} \n";?></span> <span style="color:#F26C4F;font-family:Arial,Helvetica;"><?php echo "${lon} \n";?></span> <i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;font-weight:600;font-family:Arial,Helvetica;">ASL : <span style="color:#F26C4F;"><?php echo "${elevation} \n";?></span></span>
			</div>
			<div style="margin-left:100px;font-size:11px;font-family:Arial,Helvetica;">
				<i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;font-size:11px;">Data Source: <span style="color:#F26C4F;font-size:11px;"><?php echo "${version} \n";?></span></span> <i class="fa fa-dot-circle-o fa-1x"></i> <span style="color:#66a1ba;font-size:11px;font-family:Arial,Helvetica;">Hardware: <span style="color:#F26C4F;font-size:11px;"><?php echo "${hardware} \n";?> <span style="color:#5f6061;font-weight:normal;font-size:11px;"><?php 
				            //Hardware status
				            echo "";if ($realtime =1)echo "Online";else echo "Offline";?></span></span></span>
			</div><!--- footer credits=-->
			<center>
				<span style="margin-left:90px;"><?php echo "$moonify \n";?> <span style="font-size:10px;"><?php echo "&copy; ${year}\n";?></span></span>
			</center>
		</div>
		<script src="js/gauge.js">
		</script> 
		<script>
		/*utc clock*/
		    !function(t,n,o){function e(){var t=new i;t.startClock()}function i(){this.time=""}o(function(){e()}),i.prototype={startClock:function(){var t=this;setInterval(this.updateClock.bind(this,t),500)},updateClock:function(t){var n=t.getTime();this.updateClockView(n)},updateClockView:function(t){for(var n=o(".clock-container>ul>li>span"),e=0;5>e;e++)n.eq(e).html(t[e])},getTime:function(){var t=new Date,n=t.getUTCHours(),o=t.getUTCMinutes(),e=t.getUTCSeconds(),i=this.convertHourByTimeZone(n);o=this.fixLayout(o),e=this.fixLayout(e);for(var r=[],u=0;5>u;u++){var c=i[u]+":"+o+":"+e;r.push(c)}return r},convertHourByTimeZone:function(t){for(var n=[<?php
		echo $UTC;
		?>],o=[],e=0;5>e;e++){var i=t+n[e];i>=24?i-=24:0>i&&(i=24+i),o.push(i)}return o},fixLayout:function(t){return 10>t&&(t="0"+t),t}}}(window,document,window.jQuery);
		</script> 
		<script>
		 function launchFullscreen(e){e.requestFullscreen?e.requestFullscreen():e.mozRequestFullScreen?e.mozRequestFullScreen():e.webkitRequestFullscreen?e.webkitRequestFullscreen():e.msRequestFullscreen&&e.msRequestFullscreen()}function exitFullscreen(){document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen()}function dumpFullscreen(){console.log("document.fullscreenElement is: ",document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement),console.log("document.fullscreenEnabled is: ",document.fullscreenEnabled||document.mozFullScreenEnabled||document.webkitFullscreenEnabled||document.msFullscreenEnabled)}document.addEventListener("fullscreenchange",function(e){console.log("fullscreenchange event! ",e)}),document.addEventListener("mozfullscreenchange",function(e){console.log("mozfullscreenchange event! ",e)}),document.addEventListener("webkitfullscreenchange",function(e){console.log("webkitfullscreenchange event! ",e)}),document.addEventListener("msfullscreenchange",function(e){console.log("msfullscreenchange event! ",e)});
		</script> 
	</div>
</body>
</html>