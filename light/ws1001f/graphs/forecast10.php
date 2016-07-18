<?php
include_once('../settings.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ISTANBUL FORECAST AHEAD</title>
		
		 <link rel="stylesheet" type="text/css" href="forecast.css">
         <link href="../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet prefetch" type="text/css">
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="10dayweather.js"></script>
        <script src="../js/combi.js" type="text/javascript" charset="utf-8"></script>
        
		<!--[if IE]>
			<script type="text/javascript" src="./js/excanvas.compiled.js"></script>
		<![endif]-->
			
			<div class="titleforecast"><i class="fa fa-map-marker1"></i><span style="color:#777"> <?php
echo "${stationName} \n";
?><span style="color:#f27260">Forecast</span><span style="color:#59a6c2"> Ahead</span></div>
		<section id=wuforecasts style="font-weight:600;"></section>


	</head>
	<body>

		<!-- 3. Add the container -->
		<div id="container" style="width: 600px; height: 450px;background-image:url(../css/homepageicons/fail.png);background-repeat:no-repeat;background-position:center;"></div>	
				
	</body>
</html>
