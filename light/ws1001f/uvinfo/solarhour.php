<?php
include_once('../settings.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>HOUR FORECAST</title>
		
	<link rel="stylesheet" href="style.css">	 
			    
<style>
/* flex webkit usage UV FORECAST homeweatherstation css May 2016 */

.body {
	margin:0 auto;
	text-align:center;
	
}

.container1 {
	width:600px;
	display:inline;
	float:left;
	height:300px;
	background:#fff;
	margin-bottom:0px;
	padding:10px;
	margin:0 auto;
	text-align:center;
	margin-left:25px;
	}
	
	.container2 {
	width:650px;
	float:left;
	height:300px;
	background:#fff;
	margin-bottom:0px;
	padding:10px;
	margin-top:180px;
	text-align:center;
	position:absolute;
	display:inline;
	margin-left:-595px;
	}
	
.titleforecast {
	
	 font-size:0.9em;
	 font-family:' Helvetica', Arial;
	 margin-left:2%;
	 margin-top:15px;
	
	
}
	
	

uvi {
    font-size: 11px;
    text-align: center;
    margin: 35px auto 0 -32px;
    line-height:10px;
	width:25px;
	position: absolute;
	
}

uviforecast 
{
    font-size: 11px;
    text-align: center;
    margin: -5px auto 0 5px;
    position: absolute;
	line-height:10px;
	width:30px;
}
.uvi01 {
    padding-top: 5px;
    font: 1.4em Helvetica, Arial, Helvetica ;
	color: #777;
    margin-top: 15px;
    border-radius: 50%;
    margin-left: 15px;
	border: 2px solid rgba(233, 235, 241, 1);
	width:60px;
	height:55px;
	text-align:center;
	line-height:18px;
	display:inline;
	float:left;
	
	
	
}

.uvi01 span{
   position:absolute;
    font-size:0.48em;
	margin-top:0px;
	margin-left:-20px;
	color:#66a1ba;
	letter-spacing:0px;
	font-family:Helvetica,Arial,sans-serif
	
}

.uvi01 p{
   
    font-size:11px;
	margin-top:-5px;
	color:#f27260;
	
	
}


.uvi01 {
    background: rgba(255, 255, 255, 1)
}


</style>
			<div class="titleforecast"><span style="color:#66a1ba"><?php
echo "${stationName} \n";
?><span style="color:#f27260">Todays</span><span style="color:#66a1ba"> UVINDEX <span style="color:#777777">Hourly Forecast</span></span> </div>
       
    <div class="container1">    
        <?php
		
$weather = file_get_contents('../jsondata/hourly.json');
$decoded = json_decode($weather, true);
$count = 0;
foreach ($decoded['hourly_forecast'] as $value)
{
    $count++;
    
  $hour = $value['FCTTIME']['civil'];
   
    $uvi = $value['uvi'];
		
      echo "<div class=\"uvi01\"><span>$hour</span> <br> $uvi <p>UVI</div>";
	
		
	if ($count >13)
        break;
}
?>

	</div>
    
    <div class="container2"> 
     <!-- uv 1-2 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2" >
     <div class="mdl-card__title mdl-card--expand">
      <span style="background:#40B06E;width:40px;height:40px;border-radius:100%;top:10px;left:10px;bottom:0;right:0;font-size:0em;font-weight:normal;color:#ffffff;position:absolute;text-align:center;padding-top:0%;border:5px solid rgba(233, 235, 241, 1);       
      "><span style="font-size:16px;font-weight:normal;color:rgba(255, 255, 255, 1);position:absolute;text-align:center;padding-top:0%;background:none;top:27.5%;left:0;bottom:0;right:0;
      font-family:'Helvetica',Arial, Helvetica, sans-serif;">1-2</span>
    </div>
    <div class="mdl-card__supporting-text" >
      Wear sunglasses on bright days,use sunscreen in areas which reflects UV radiation.
    </div>
    <div class="mdl-card__actions mdl-card--border">
       <span style="color:#fff;background:#40B06E;padding:4px;border-radius:4px;font-size:10px;">Low</span>
       
    </div>
  </div>
  <!-- uv 3-5 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
    <div class="mdl-card__title mdl-card--expand">
     <span style="background:#EC9C4A;width:40px;height:40px;border-radius:100%;top:10px;left:10px;bottom:0;right:0;font-size:0em;font-weight:normal;color:#ffffff;position:absolute;text-align:center;padding-top:0%;border:5px solid rgba(233, 235, 241, 1);       
      "><span style="font-size:16px;font-weight:normal;color:rgba(255, 255, 255, 1);position:absolute;text-align:center;padding-top:0%;background:none;top:27.5%;left:0;bottom:0;right:0;
 font-family:'Helvetica',Arial, Helvetica, sans-serif;">3-5</span>
    </div>
    <div class="mdl-card__supporting-text">
      Try to take precautions.Stay in shade near midday when the sun is strongest.
    </div>
    <div class="mdl-card__actions mdl-card--border">
     <span style="color:#fff;background:#EC9C4A;padding:4px;border-radius:4px;font-size:10px;">Moderate</span>
    </div>
  </div>
   <!-- uv 6-7 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
    <div class="mdl-card__title mdl-card--expand">
     <span style="background:#df826b;width:40px;height:40px;border-radius:100%;top:10px;left:10px;bottom:0;right:0;font-size:0em;font-weight:normal;color:#ffffff;position:absolute;text-align:center;padding-top:0%;border:5px solid rgba(233, 235, 241, 1);       
      "><span style="font-size:16px;font-weight:normal;color:rgba(255, 255, 255, 1);position:absolute;text-align:center;padding-top:0%;background:none;top:27.5%;left:0;bottom:0;right:0;
 font-family:'Helvetica',Arial, Helvetica, sans-serif;">6-7</span>
    </div>
    <div class="mdl-card__supporting-text">
      Try to reduce time in the sun within three hours of noon, and wear sunglasses.
    </div>
    <div class="mdl-card__actions mdl-card--border">
       <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:10px;">High Risk</span>
    </div>
  </div> <!-- uv 8-9 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
    <div class="mdl-card__title mdl-card--expand">
      <span style="background:#b75c5c;width:40px;height:40px;border-radius:100%;top:10px;left:10px;bottom:0;right:0;font-size:0em;font-weight:normal;color:#ffffff;position:absolute;text-align:center;padding-top:0%;border:5px solid rgba(233, 235, 241, 1);       
      "><span style="font-size:16px;font-weight:normal;color:rgba(255, 255, 255, 1);position:absolute;text-align:center;padding-top:0%;background:none;top:27.5%;left:0;bottom:0;right:0;
 font-family:'Helvetica',Arial, Helvetica, sans-serif;">8-10</span>
    </div>
    <div class="mdl-card__supporting-text">
       Do not stay in the sun for long,wear sunglasses.Protect yourself from sunburn.
    </div>
         <div class="mdl-card__actions mdl-card--border">
       <span style="color:#fff;background:#b75c5c;padding:4px;border-radius:4px;font-size:10px;">Very High Risk</span>
    </div>
  </div> <!-- uv 3-5 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
    <div class="mdl-card__title mdl-card--expand">
     <span style="background:#8b74a2;width:40px;height:40px;border-radius:100%;top:10px;left:10px;bottom:0;right:0;font-size:0em;font-weight:normal;color:#ffffff;position:absolute;text-align:center;padding-top:0%;border:5px solid rgba(233, 235, 241, 1);       
      "><span style="font-size:16px;font-weight:normal;color:rgba(255, 255, 255, 1);position:absolute;text-align:center;padding-top:0%;background:none;top:27.5%;left:0;bottom:0;right:0;
 font-family:'Helvetica',Arial, Helvetica, sans-serif;">11+</span>
    </div>
    <div class="mdl-card__supporting-text">
     Avoid the sun within three hours of solar noon.Protect yourself from sunburn.
    </div>
    <div class="mdl-card__actions mdl-card--border">
      <span style="color:#fff;background:#8b74a2;padding:4px;border-radius:4px;font-size:10px;">Extreme Risk</span>
        </span>
    </div>
  </div> 
  <a href="http://www.idesign34.com/homepws/homeweather.html" title="Home Weather Station Template info"><img src="../css/logos/graphlogo.png" style="padding:10px;float:right;margin-right:45px;"></a>
  
    
	</body>
</html>