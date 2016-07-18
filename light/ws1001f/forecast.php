<meta name="description" content="Istanbul Current Weather & Forecast via Sinanoba Weather Station @weatherist34 ">
<meta property=og:type content="website">
<meta name="revisit-after" content="7 days">
<meta name="distribution" content="web">
<meta property="og:url" content="http://bit.ly/istanbul161">
<meta property="og:site_name" content="Istanbul Current Weather & Forecast via Sinanoba Weather Station @weatherist34"> 
<meta property="og:description" content="Sinanoba,Istanbul,Turkey
 Weather station located in the Marmara region of Istanbul,Turkey.Position 300 metres from the Marmara sea in the district of Buyukcekmece.Hardware is a WS1001 clone manufactured by Fine Offset Electronics.">
<meta property="og:image" content="http://idesign34.com/pws/img/pws.jpg">
<link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="viewport" content = "width = device-width, initial-scale = 1.0, minimum-scale = 1, maximum-scale = 1, user-scalable = no" />

<meta name=author content="brian underdown" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<meta name="robots" content="INDEX, FOLLOW"/>
<!-- parsing weather underground output --->
<?php
$json_string             = file_get_contents("weather.json");
$parsed_json             = json_decode($json_string);
$temp_c                  = $parsed_json->{'current_observation'}->{'temp_c'};
$windchill_c             = $parsed_json->{'current_observation'}->{'windchill_c'};
$wind_degrees            = $parsed_json->{'current_observation'}->{'wind_degrees'};
$wind_kph                = $parsed_json->{'current_observation'}->{'wind_kph'};
$wind_mph                = $parsed_json->{'current_observation'}->{'wind_mph'};
$wind_gust_kph           = $parsed_json->{'current_observation'}->{'wind_gust_kph'};
$wind_gust_mph           = $parsed_json->{'current_observation'}->{'wind_gust_mph'};
$wind_string             = $parsed_json->{'current_observation'}->{'wind_string'};
$windchill_c             = $parsed_json->{'current_observation'}->{'windchill_c'};
$windchill_f             = $parsed_json->{'current_observation'}->{'windchill_f'};
$UV                      = $parsed_json->{'current_observation'}->{'UV'};
$pressure_mb             = $parsed_json->{'current_observation'}->{'pressure_mb'};
$pressure_in             = $parsed_json->{'current_observation'}->{'pressure_in'};
$pressure_trend          = $parsed_json->{'current_observation'}->{'pressure_trend'};
$dewpoint_c              = $parsed_json->{'current_observation'}->{'dewpoint_c'};
$heat_index_c            = $parsed_json->{'current_observation'}->{'heat_index_c'};
$precip_today_metric     = $parsed_json->{'current_observation'}->{'precip_today_metric'};
$precip_today_in         = $parsed_json->{'current_observation'}->{'precip_today_in'};
$precip_1hr_metric       = $parsed_json->{'current_observation'}->{'precip_1hr_metric'};
$relative_humidity       = $parsed_json->{'current_observation'}->{'relative_humidity'};
$weather                 = $parsed_json->{'current_observation'}->{'weather'};
$station_id              = $parsed_json->{'current_observation'}->{'station_id'};
$solarradiation          = $parsed_json->{'current_observation'}->{'solarradiation'};
$icon                    = $parsed_json->{'current_observation'}->{'icon'};
$feelslike_c             = $parsed_json->{'current_observation'}->{'feelslike_c'};
$observation_time_rfc822 = $parsed_json->{'current_observation'}->{'observation_time_rfc822'};
$moon_phase              = $parsed_json->{'moon_phase'}->{'phaseofMoon'};
$percentIlluminated      = $parsed_json->{'moon_phase'}->{'percentIlluminated'};
$ageOfMoon               = $parsed_json->{'moon_phase'}->{'ageOfMoon'};
$sunrise                 = $parsed_json->{'sun_phase'}->{'sunrise'}->{'hour'};
$sunrisem                = $parsed_json->{'sun_phase'}->{'sunrise'}->{'minute'};
$sunset                  = $parsed_json->{'sun_phase'}->{'sunset'}->{'hour'};
$sunsetm                 = $parsed_json->{'sun_phase'}->{'sunset'}->{'minute'};
$maxtempm                = $parsed_json->{'history'}->{'dailysummary'}{0}->{'maxtempm'};
$mintempm                = $parsed_json->{'history'}->{'dailysummary'}{0}->{'mintempm'};
$meanwindspdm            = $parsed_json->{'history'}->{'dailysummary'}{0}->{'meanwindspdm'};
$maxwspdm                = $parsed_json->{'history'}->{'dailysummary'}{0}->{'maxwspdm'};
$precipm                 = $parsed_json->{'history'}->{'dailysummary'}{0}->{'precipm'};
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.min.css" rel="stylesheet">    
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js"></script>
<script src="js/jqueryui.js"></script>
<script   defer  type="text/javascript" src="js/handlebars.js"></script>
<script   src="js/combi.js" type="text/javascript" charset="utf-8"></script>

<style>
.body {
	background:none;}
	
</style>

</head>  <body>

 
          
      <!-- temperature outdoors -->
      
                       
               <!-- start animated temperature-->    
               <section id=wuforecasts></section>
</div></div></div></div></div>
</body>

</html>