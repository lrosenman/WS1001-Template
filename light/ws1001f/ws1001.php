<?php include_once('livedata.php');?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo "${stationName} \n";?> HOME WEATHER STATION </title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="description" content="Current Weather & Forecast via Home Weather Station,Hardware is a WS1001 clone manufactured by Fine Offset Electronics ">
   <meta property=og:type content="website">
   <meta name="revisit-after" content="7 days">
   <meta name="distribution" content="web">
   <meta property="og:url" content="">
   <meta property="og:site_name" content="Current Weather & Forecast via Home Weather Station">
   <meta property="og:description" content="Current Weather & Forecast via Home Weather Station,Hardware is a WS1001 clone manufactured by Fine Offset Electronics">
   <meta name=author content="brian underdown" />
   <meta name="robots" content="INDEX,FOLLOW"/>
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="mobile-web-app-capable" content="yes">
   <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
   <meta name="viewport" content="width=1008",initial-scale=1/> 
   <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="css/main.min.css" rel="stylesheet prefetch">
  <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet prefetch" type="text/css">
  <script  src="js/jquery.js"></script>
   <script src="js/combi.js"></script> 
</head>

<body>
		
			
<header>
  <input data-function='swipe' id='swipe' type='checkbox'>
  <label data-function='swipe' for='swipe'>&#xf0c9;</label>
  <h1> <i class="fa fa-map-marker1 fa-1x"></i> 
 <strong><?php echo "${stationName} \n";?></strong> HOME<strong>WEATHER</strong>STATION</h1>
  
 <button class="button right"><a href="#"><img src="img/smalllogo.png" ></a></button>
				
                
               
      <div class='sidebar'>
    <nav class='menu'>
      <li><a href="info/info.php" data-featherlight="iframe"><img src="img/info2.png" width="40px"> Location Info</a></li>
      <li><a href="info/info.php" data-featherlight="iframe"><img src="img/info3.png" width="40px"> Contact Info</a></li>
      <li><a href="<?php echo "$weatherunderground \n";?>" target="_blank"><img src="img/wu.png" width="40px"> WU Station</a></li>
     <li><a href="moon.php" data-featherlight="iframe"><img src="img/moon.png" width="40px"> Sun/Moon Info</a></li>
      
     <!--respect this line its not a lot to ask --->
      <span style="font-size:10px;margin-left:5px;background:#fff;border:none;color:#66a1ba;"><?php echo "$moonify \n";?></span>
    </nav>
  </div>
           
                
                
</header>
				

  

<!-- begin top layout for homeweatherstation template-->
<!--indoor temperature for homeweatherstation template-->
<div class="weather2-container">
  <div class="weather2-item" style="background-image:url(css/homepageicons/temp.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;"><i class="fa fa-home" aria-hidden="true"></i> Temperature Indoor
  <div class="indoorvalues">
  <script async type="text/livescript">
  $(document).ready(function() {indoor();});
  function indoor(){$('#indoor').load('indoor.php');        }
  var refreshId = setInterval(indoor,60000);      
   </script>    
  <div id="indoor" ></div></div>
  <div class="indoorunit"><?php echo "${indoorunit} \n";?></div>
  </div>
  
  <!--realtime clock for homeweatherstation template-->
  <div class="weather2-item" style="background-image:url(css/homepageicons/time.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;">HOME<strong>WEATHER</strong>STATION<br>
  <div class="clock-container">
               <span style="position:absolute;margin-left:40px;font-size:11px;margin-top:-25px;">
			   <?php echo date('D M jS');?></span>    
               <ul> <li><span></span></li></ul>  </div>
    

               
               
            <!-- homeweather end local time  -->   
            <div class="indoorlocation">
                     
            <i class="fa fa-map-marker1"></i> 
			<?php echo "${stationName} \n";?></div></div>
            
            
   <!-- notifications cautions/alerts for homeweatherstation template-->
  <div class="weather2-item" style="background-image:url(css/homepageicons/caution.png);background-repeat:no-repeat;background-position:bottom left;font-size:12px;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Notification Alerts
  <div class="indoorvalues">  
   <script async type="text/livescript">
  $(document).ready(function() {notification();});
  function notification(){$('#notification').load('notification.php');        }
  var refreshId = setInterval(notification, 26000);      
   </script>
   <div id="notification" ></div></div> 
   </div></div>
            
<!--end indoor section for homeweatherstation template-->
<!--begin outside/station data section for homeweatherstation template-->
<div class="weather-container">



  <div class="weather-item">
  <div class="chartforecast">
         <a href="yearly/yeartemp.php" data-featherlight="iframe" ><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${year}\n";?></span> </a>  
         <a href="yearly/monthtemp.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${month}\n";?></span> </a>  
         <a href="yearly/temptoday.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;">
         <?php echo "${day}\n";?></span> </a>  
      </div>
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Temperature 
  <?php echo "${templateunit} \n";?><br /></span>  
   <script async type="text/livescript">
  $(document).ready(function() {temperaturerefresh();});
  function temperaturerefresh(){$('#temperature').load('temperature.php');}
  var refreshId = setInterval(temperaturerefresh, 20000);
   </script>
  <div id="temperature"></div>
  
  </div>
  <!--forecast for homeweatherstation template-->
  <div class="weather-item">
  <div class="chartforecast">   
         <a href="graphs/forecast10.php" data-featherlight="iframe" ><i class="fa fa-dot-circle-o fa-1x"></i><span style="color:#66a1ba;"> Forecast Ahead</span> </a>  
          <a href="outlook.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-dot-circle-o fa-1x"></i><span style="color:#66a1ba;"> 
		  <?php echo "${day}\n";?> Outlook</span> </a>
      </div>
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)"><i class="fa fa-map-marker"></i>
            <?php echo "${stationlocation} \n";
?>Forecast</span><br />  
  <div class="updatedtime"><span>Updated</span> <?php echo $update;?>  </div> <br />
         <div id="wuforecasts"></div>
  </div>
  <!--currentsky for homeweatherstation template-->
  <div class="weather-item">
   <div class="chartforecast">
         <!-- HOURLY & Outlook for homeweather station-->  
         <a href="graphs/hour.php" data-featherlight="iframe"><i class="fa fa-dot-circle-o fa-1x"></i><span style="color:#66a1ba;"> Hourly Forecast</span> </a> 
          <a href="moon.php" data-featherlight="iframe" style="margin-left:20px;"><span style="color:#777;"><i class='wi wi-moon-alt-waning-crescent-3' ></i><span style="color:#66a1ba;"> Sun/Moon Info</span> </a> 
          
      </div>  
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Current Conditions</span><br />  
   <script async type="text/livescript">
  $(document).ready(function() {currentskyrefresh();});
  function currentskyrefresh(){$('#currentsky').load('currentsky.php');    }
  var refreshId = setInterval(currentskyrefresh, 16500);  
   </script>
   <div id="currentsky">
   
    <div class="loadingtheweather">
    <div class="dot dot-1"></div>
    <div class="dot dot-2"></div>
    <div class="dot dot-3"></div>
    <div class="dot dot-4"></div>
</div>
  
  
  </div>
         
 </div></div>
 <!--windspeed for homeweatherstation template-->
<div class="weather-container">
  <div class="weather-item">
  <div class="chartforecast">
         <a href="yearly/windyear.php" data-featherlight="iframe" ><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${year}\n";?></span> </a>  
         <a href="yearly/windmonth.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${month}\n";?></span> </a>  
         <a href="yearly/windtoday.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${day}\n";?></span> </a> 
      </div>
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Wind Speed</span><br />
   <script async type="text/livescript">
  $(document).ready(function() {refreshwind();});
  function refreshwind(){$('#windspeed').load('windspeed.php');}
  var refreshId = setInterval(refreshwind, 16100);
   </script>
   <div id="windspeed"></div>
         
         
      </div>
       <!--barometer for homeweatherstation template-->
  <div class="weather-item">
   <div class="chartforecast">
         <a href="yearly/yearbarometer.php" data-featherlight="iframe" ><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${year}\n";?></span> </a>  
         <a href="yearly/monthbarometer.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${month}\n";?></span> </a>  
         <a href="yearly/barometertoday.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${day}\n";?></span> </a>  
      </div>
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Barometer</span><br />
<script async type="text/livescript">
  $(document).ready(function() {barometer();});
  function barometer(){$('#barometer').load('barometer.php');    }
  var refreshId = setInterval(barometer, 21000);      
   </script>                       
  <div id="barometer"></div>
  </div>
        <!--wind direction for homeweatherstation template-->
  <div class="weather-item">
  <div class="chartforecast">
         <i class="fa fa-dot-circle-o fa-1x"></i> 360&deg; Direction         
      </div>
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Wind Direction</span><br />
  <script async type="text/livescript">
  $(document).ready(function() {windirection();    });
  function windirection(){$('#windirection').load('windirection.php');}
  var refreshId = setInterval(windirection, 16200);      
   </script> 
   <div class="windirection">
   <div id="windirection"></div></div></div>
   </div>
  
 <!--rainfall for homeweatherstation template-->
<div class="weather-container">
  <div class="weather-item">
  
  <div class="chartforecast">
         <a href="yearly/yearrain.php" data-featherlight="iframe" ><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${year}\n";?></span> </a>  
         <a href="yearly/monthrain.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${month}\n";?></span> </a>  
         <a href="yearly/rainfalltoday.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> 
		 <?php echo "${day}\n";?></span> </a>  
      </div>
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">Rainfall Today</span><br />
  <script async type="text/livescript">
  $(document).ready(function() {rain();    });    
  function rain(){$('#rain').load('rainrate.php');}
  var refreshId = setInterval(rain, 22000);      
  </script>   
  <div id="rain"></div>
  
      </div>
  <!--solar for homeweatherstation template-->     
  <div class="weather-item">
  <div class="chartforecast">
         <i class="fa fa-dot-circle-o fa-1x"></i><a href="uvinfo/solarhour.php" data-featherlight="iframe"> <span style="color:#F26C4F">UVINDEX <span style="color:#66a1ba;"> <?php echo "${day}\n";?></span></span> &nbsp;
         <a href="yearly/solartoday.php" data-featherlight="iframe" style="margin-left:20px;"><i class="fa fa-line-chart fa-1x"></i><span style="color:#66a1ba;"> Solar 
		 <?php echo "${day}\n";?></span> </a> 
    </div>
  
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)">UV | <span style="color:#F26C4F">Solar Data</span></span><br />
 <script async type="text/livescript">
    $(document).ready(function() {solar();});
    function solar(){$('#solar').load('solar.php');}
    var refreshId = setInterval(solar, 19500);      
   </script>                      
    <div id="solar"></div>
  
  </div>
       <!--earthquake for homeweatherstation template-->
  <div class="weather-item">
  <div class="chartforecast">
 <i class="fa fa-map-marker fa-1x"></i>
 <span style="color:#777;font-weight:600;"> Regional <span style="color:#F26C4F;"> & <span style="color:#66a1ba;">Significant  Earthquakes</span>
    </div>
  
  <span style="font-size:11px;font-weight:600;text-transform:uppercase;color:rgba(95,96,97,0.8)"><span style="color:#66a1ba;">Earthquake</span> Data</span><br />
  <div class="updatedtime"><span>Updated</span> 
  <?php echo $update;?>  </div>
  <div id="deprem"></div>
         <!-- regional earthquake scripts homeweather station --->
         <script async id="deprem-template" type="text/x-handlebars-template">
            <div class="deprem">                
                        {{#each features}}    
                        <div class="magnitude">                    
                        <span class ="mag"><span class ="content">                    
                        {{properties.mag}}<br><div class="magtext"> magnitude</div></span>                        
                        <div class="place">
                        <i class="fa fa-map-marker "></i>
                        {{properties.flynn_region}}<br>
                        <span style="color:#F26C4F;font-weight:400;font-size:11px;font-family:'Helvetica', Arial;">
                        {{datetime properties.time}}<br>    
                        <i class="fa fa-map-marker "></i> <span style="font-size:11px;font-family:'Helvetica', Arial;color:#777;line-height:15px;">Lat:
                        {{properties.lat}}&deg;- Lon:{{properties.lon}}&deg;        
                        </span>
                        </div>
                        {{/each}}
                          </div>
         </script>
        <!--significant worldwide earthquakes--->
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
                        <i class="fa fa-map-marker "></i> <span style="font-size:10px;font-family:'Helvetica', Arial;color:#777;line-height:15px;">Lat:
                        {{properties.lat}}&deg;- Lon:{{properties.lon}}&deg;        
                        </span>
                        </div>
                        {{/each}}
                          </div>
         </script>         
         <div id="deprem2"></div>
  </div>
</div>
 <!--end outdoor data for homeweatherstation template-->
  <!--footer are for homeweatherstation template-->
<div class="weatherfooter-container">
  <div class="weatherfooter-item"><br>
  <span style="float:right;padding:10px;font-size:10px;"> 
  <id onclick="launchFullscreen(document.documentElement);"><i class="fa fa-expand fa-lg" aria-hidden="true"></i> Fullscreen</id>
    <id onclick="exitFullscreen();" ><i class="fa fa-compress fa-lg " aria-hidden="true"></i> Minimize</id>  </span>
                
         <div style="color:#66a1ba;margin-left:100px;font-size:11px;"><i class="fa fa-map-marker fa-1x"> </i> <span style="color:#F26C4F;"> Location : </span> <span style="color:#66a1ba;font-weight:600;"> 
		 <?php echo "${lat} \n";?></span>
         <span style="color:#F26C4F;"><?php echo "${lon} \n";?></span> <i class="fa fa-dot-circle-o fa-1x"> </i><span style="color:#66a1ba;font-weight:600;"> ASL : <span style="color:#F26C4F;">
         <?php echo "${elevation} \n";?></span></div>
         
         <div style="margin-left:100px;font-size:11px;"><i class="fa fa-dot-circle-o fa-1x"> </i><span style="color:#66a1ba;font-size:11px;"> Data Source: <span style="color:#F26C4F;font-size:11px;">
            <?php echo "${version} \n";?></span></span>
            <i class="fa fa-dot-circle-o fa-1x"> </i><span style="color:#66a1ba;font-size:11px;"> Hardware: <span style="color:#F26C4F;font-size:11px;"> 
            <?php echo "${hardware} \n";?><span style="color:#5f6061;font-weight:normal;font-size:11px;">
			<?php 
			//Hardware status
			echo "";if ($realtime =1)echo "Online";else echo "Offline";?></span></span> 
         </div> 
        
       <!--- footer credits---><center>
         <span style="margin-left:90px;"><?php echo "$moonify \n";?><span style="font-size:10px;"> |</span> <span style="font-size:10px;"> &nbsp; <a href="http://www.foshk.com/Weather_Professional/HP1000.htm" title="Fine Offset hardware" target="_blank"><?php echo "$templateversion \n";?></a> &copy; 2015-<?php echo date("Y") ?>&nbsp;&nbsp; |</span>
            <span style="color:#5f6061;font-weight:normal;font-size:10px;"> &nbsp;Built with <strong style="color:#66a1ba;"><a href="http://learnlayout.com/flexbox.html" title="http://learnlayout.com/flexbox.html" target="_blank">FLEX</a></strong> Webkit <?php echo "&copy; ${year}\n";?></span></span></div></center>
        
            
            
   <script src="js/gauge.js" ></script>
   <script>  /*utc clock*/
      !function(t,n,o){function e(){var t=new i;t.startClock()}function i(){this.time=""}o(function(){e()}),i.prototype={startClock:function(){var t=this;setInterval(this.updateClock.bind(this,t),500)},updateClock:function(t){var n=t.getTime();this.updateClockView(n)},updateClockView:function(t){for(var n=o(".clock-container>ul>li>span"),e=0;5>e;e++)n.eq(e).html(t[e])},getTime:function(){var t=new Date,n=t.getUTCHours(),o=t.getUTCMinutes(),e=t.getUTCSeconds(),i=this.convertHourByTimeZone(n);o=this.fixLayout(o),e=this.fixLayout(e);for(var r=[],u=0;5>u;u++){var c=i[u]+":"+o+":"+e;r.push(c)}return r},convertHourByTimeZone:function(t){for(var n=[<?php
echo $UTC;
?>],o=[],e=0;5>e;e++){var i=t+n[e];i>=24?i-=24:0>i&&(i=24+i),o.push(i)}return o},fixLayout:function(t){return 10>t&&(t="0"+t),t}}}(window,document,window.jQuery);
   </script>   
   <script>
   function launchFullscreen(e){e.requestFullscreen?e.requestFullscreen():e.mozRequestFullScreen?e.mozRequestFullScreen():e.webkitRequestFullscreen?e.webkitRequestFullscreen():e.msRequestFullscreen&&e.msRequestFullscreen()}function exitFullscreen(){document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen()}function dumpFullscreen(){console.log("document.fullscreenElement is: ",document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement),console.log("document.fullscreenEnabled is: ",document.fullscreenEnabled||document.mozFullScreenEnabled||document.webkitFullscreenEnabled||document.msFullscreenEnabled)}document.addEventListener("fullscreenchange",function(e){console.log("fullscreenchange event! ",e)}),document.addEventListener("mozfullscreenchange",function(e){console.log("mozfullscreenchange event! ",e)}),document.addEventListener("webkitfullscreenchange",function(e){console.log("webkitfullscreenchange event! ",e)}),document.addEventListener("msfullscreenchange",function(e){console.log("msfullscreenchange event! ",e)});</script>
      
        </body>

</html>