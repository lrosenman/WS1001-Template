<?php 
include_once('settings.php');
include 'uvindexforecast.php'; 
$file_live=file_get_contents($livedata);$cumulus=explode(" ",$file_live);

//<p>UV forecast courtesy of and <a href="http://www.temis.nl/">Copyright &copy; KNMI/ESA</a>. Used with permission.</p>//
// granted permission to use get-UV-forecast-inc.php UV INDEX SCRIPT MAY 14TH 2016 "this script is courtesy of Saratoga creator Ken True http://saratoga-weather.org"//

?>
    
    
        
        <style>
	
uviindex {
	position: absolute;
    font: 0px Helvetica, Helvetica, Arial, Helvetica;
    text-align:center;
	line-height:15px;    
    margin:-40px 0 0 -40px;
    position: absolute;
}

uviforecast {
	position: absolute;
    font: 10px Helvetica, Helvetica, Arial, Helvetica;
    text-align:center;
	line-height:15px;   
    margin: 35px 0 0 -52px;    
	
}

uviforecast span {
    
	font:600 11px Helvetica, Helvetica, Arial, Helvetica
}
uvi {
    font-size: .25em;
    text-align: center;
    margin: 40px auto 0 -50px;
    position: absolute
}

.uv01, .uv03 , .uv35 ,.uv67, .uv810, .uv1112 {
    padding: 22px 15px 15px 15px;
	
	font: 24px weathertext, Helvetica, Arial, Helvetica;
	color: #fff;
    margin-top: 20px;
    border-radius: 100%;
    margin-left: 10px;
	width:40px;
	height:30px;	
	text-align:center;
	line-height:20px;
}
.uv01 {
    border: 5px solid rgba(233, 235, 241, 1);
    background: rgba(78, 90, 105, 1)
}

.uv03 {
    border: 5px solid rgba(233, 235, 241, 1);
    background: rgba(79, 184, 123, 1)
}

.uv35 {
    border: 5px solid rgba(233, 235, 241, 1);
    background: rgba(238, 166, 89, 1);
   
}

.uv67 {
    border: 5px solid rgba(233, 235, 241, 1);
    background: rgba(238, 114, 89, 1);
	
}

.uv810 {
    border: 5px solid rgba(233, 235, 241, 1);
    background: rgba(209, 94, 82, 1);
	font-size:22px
}

.uv1112 {
     border: 5px solid rgba(233, 235, 241, 1);  
     background: rgba(148, 81, 136, 1);
	 font-size:22px
	
    
}

.uvtext color {
    font-weight: 600
}

.uvsup {
    font-size: 14px;
    color: #F26C4F
}

.uvtext {
    color: rgba(95,96,97,0.8);
    width: 100px;
    font: 10px / 1em Helvetica, Helvetica, Arial, Helvetica;
	margin-left:95px;
	margin-top:-60px;
}

.uvtext color, .uvtext color2 {
   
    color: #F26C4F
}

.uvfooter {
    position: relative;
    margin-top: 110px;
    text-align: center
}
 
 
  .demo-card-square.mdl-card {
    width: 200px;
    float: left;
    margin: 3em;
    position: relative;
  }
  
  .demo-card-square.mdl-card:hover {
    box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2);
  }
  
  .demo-card-square > .mdl-card__title {
    color: #fff;
    background: #4c9f83;
  }
  
  .demo-card-square > .mdl-card__accent {
    background: #ff9800;
  }
  
  /*uv index 3-5*/
  
  .demo-card-square2.mdl-card {
    width: 200px;
	height:140px;
    float: left;
    margin: 0.2rem;
    position: relative;
	border: 1px solid rgba(233, 235, 241, 1);
	border-radius:4px;
	
	
	
  }
  
  .demo-card-square2.mdl-card:hover {
    box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2);
  }
  
  .demo-card-square2 > .mdl-card__title2 {
    color: #fff;
    background: #4c9f83;
  }
  
  
  
  
  .demo-card-square2 > .mdl-card__accent2 {
    background: #ecc65b;
  }
  
  body {
    padding: 5px;
    background: #fff;
    position: relative;
	max-width:650px;
	padding-left:5px;
	font-family:'Helvetica',Arial, Helvetica, sans-serif;
	text-decoration:none;
	margin-top:30px;
	
	
  }
  
   .a {
	   text-decoration:none;color:#777}
 a {
	   text-decoration:none;color:#777}
 
		</style>

    

<body>

  <!-- uv 1-2 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2" >
  <span style="color:#fff;background:#66a1ba;padding:4px;border-radius:4px;font-size:12px;"><?php  $now = date("l-d-m-Y", strtotime('now'));
	 echo "$now" ?></span>
     <div class="mdl-card__title mdl-card--expand" >
      <span style='font-size:0px'>
<!-- UV--> 
<?php 
echo "${UVfcstUVTODAY}</span> \n";if($UVfcstUVTODAY<=0){echo "<div class=\"uv01\">${UVfcstUVTODAY}</div>";}
else if($UVfcstUVTODAY<1){echo "<div class=\"uv01\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUVTODAY<2){echo "<div class=\"uv03\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUVTODAY<3){echo "<div class=\"uv03\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTODAY<4){echo "<div class=\"uv35\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTODAY<5){echo "<div class=\"uv35\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTODAY<6){echo "<div class=\"uv35\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTODAY<7){echo "<div class=\"uv67\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTODAY<8){echo "<div class=\"uv67\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTODAY<9){echo "<div class=\"uv810\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTODAY<10){echo "<div class=\"uv810\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTODAY<11){echo "<div class=\"uv810\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTODAY<15){echo "<div class=\"uv1112\">${UVfcstUVTODAY}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
?></span>
 <!-- SOLAR --> 
    </div>
    
    
  </div>
  <!-- uv 3-5 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
   <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:12px;"><?php  $tomorrow = date("l-d-m-Y", strtotime('tomorrow'));
	 echo "$tomorrow" ?></span>
    <div class="mdl-card__title mdl-card--expand">
      <span style='font-size:0px'>
    <?php echo "${UVfcstUVTOMORROW}</span> \n";if($UVfcstUVTOMORROW<=0){echo "<div class=\"uv01\">${UVfcstUVTOMORROW}</div>";}
else if($UVfcstUVTOMORROW<1){echo "<div class=\"uv01\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUVTOMORROW<2){echo "<div class=\"uv03\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUVTOMORROW<3){echo "<div class=\"uv03\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTOMORROW<4){echo "<div class=\"uv35\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTOMORROW<5){echo "<div class=\"uv35\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTOMORROW<6){echo "<div class=\"uv35\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUVTOMORROW<7){echo "<div class=\"uv67\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<8){echo "<div class=\"uv67\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<9){echo "<div class=\"uv810\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<10){echo "<div class=\"uv810\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<11){echo "<div class=\"uv810\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<12){echo "<div class=\"uv1112\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUVTOMORROW<13){echo "<div class=\"uv1112\">${UVfcstUVTOMORROW}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}?></span>
    </div>
     
  </div>
   <!-- uv 6-7 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
  <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:12px;"><?php  $nextday2 = date("l-d-m-Y", strtotime("+2 day"));
	 echo "$nextday2" ?></span>
    <div class="mdl-card__title mdl-card--expand">
       <span style='font-size:0px'>
     <?php echo "${UVfcstUV2DAYS}</span> \n";if($UVfcstUV2DAYS<=0){echo "<div class=\"uv01\">${UVfcstUV2DAYS}</div>";}
else if($UVfcstUV2DAYS<1){echo "<div class=\"uv01\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV2DAYS<2){echo "<div class=\"uv03\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV2DAYS<3){echo "<div class=\"uv03\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV2DAYS<4){echo "<div class=\"uv35\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV2DAYS<5){echo "<div class=\"uv35\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV2DAYS<6){echo "<div class=\"uv35\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV2DAYS<7){echo "<div class=\"uv67\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<8){echo "<div class=\"uv67\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<9){echo "<div class=\"uv810\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<10){echo "<div class=\"uv810\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<11){echo "<div class=\"uv810\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<12){echo "<div class=\"uv1112\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV2DAYS<13){echo "<div class=\"uv1112\">${UVfcstUV2DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}?></span>
	
    </div>
    
        
  </div> <!-- uv 8-9 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
  <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:12px;"><?php  $nextday3 = date("l-d-m-Y", strtotime("+3 day"));
	 echo "$nextday3" ?></span>
    <div class="mdl-card__title mdl-card--expand">
      <span style='font-size:0px'>
     <?php echo "${UVfcstUV3DAYS}</span> \n";if($UVfcstUV3DAYS<=0){echo "<div class=\"uv01\">${UVfcstUV3DAYS}</div>";}
else if($UVfcstUV3DAYS<1){echo "<div class=\"uv01\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV3DAYS<2){echo "<div class=\"uv03\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV3DAYS<3){echo "<div class=\"uv03\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV3DAYS<4){echo "<div class=\"uv35\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV3DAYS<5){echo "<div class=\"uv35\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV3DAYS<6){echo "<div class=\"uv35\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV3DAYS<7){echo "<div class=\"uv67\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<8){echo "<div class=\"uv67\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<9){echo "<div class=\"uv810\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<10){echo "<div class=\"uv810\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<11){echo "<div class=\"uv810\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<12){echo "<div class=\"uv1112\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV3DAYS<13){echo "<div class=\"uv1112\">${UVfcstUV3DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}?></span>
	 
    </div>
    
         
  </div> <!-- uv 3-5 card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
  <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:12px;"><?php  $nextday4 = date("l-d-m-Y", strtotime("+4 day"));
	 echo "$nextday4" ?></span>
    <div class="mdl-card__title mdl-card--expand">
      <span style='font-size:0px'>
     <?php echo "${UVfcstUV4DAYS}</span> \n";if($UVfcstUV4DAYS<=0){echo "<div class=\"uv01\">${UVfcstUV4DAYS}</div>";}
else if($UVfcstUV4DAYS<1){echo "<div class=\"uv01\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV4DAYS<2){echo "<div class=\"uv03\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";}
else if($UVfcstUV4DAYS<3){echo "<div class=\"uv03\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV4DAYS<4){echo "<div class=\"uv35\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV4DAYS<5){echo "<div class=\"uv35\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV4DAYS<6){echo "<div class=\"uv35\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Stay in the shade near midday when the <color> sun</color> is strongest</div>";}
else if($UVfcstUV4DAYS<7){echo "<div class=\"uv67\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<8){echo "<div class=\"uv67\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<9){echo "<div class=\"uv810\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<10){echo "<div class=\"uv810\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<11){echo "<div class=\"uv810\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Minimize <color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<12){echo "<div class=\"uv1112\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}
else if($UVfcstUV4DAYS<13){echo "<div class=\"uv1112\">${UVfcstUV4DAYS}</div>
<div class=\"uvtext\">Try to avoid<color> sun</color> exposure between 10am-4pm</div>";}?></span>
	 
    </div>
     
    </div>
  </div> 
  
  <!-- info card -->
  <div class="mdl-card mdl-shadow--2dp demo-card-square2">
  <span style="color:#fff;background:#df826b;padding:4px;border-radius:4px;font-size:12px;">Information</span>
    <div class="mdl-card__title mdl-card--expand" style="font-size:12px;padding:15px;color:#666; ">
    
UV forecast courtesy & Copyright &copy; KNMI/ESA <a href="http://www.temis.nl" title="http://www.temis.nl" target="_blank">http://www.temis.nl</a>

"PHP script is courtesy of Saratoga creator Ken True <a href="http://saratoga-weather.org" title="http://saratoga-weather.org" target="_blank">http://saratoga-weather.org</a>"
</span>
	 
    </div>
    
  </div> <a href="https://github.com/lrosenman/WS1001-Template/" title="Home Weather Station Template info"><img src="css/logos/uvlogo.png" style="padding:5px;"></a><span style="font-size:11px;margin-left:10px;color:#5f6061;">UVINDEX HOME<strong>WEATHER</strong>STATION 5 DAY <span style="color:#f26c4f;">FORECAST</span></span>
</body>

</html>
    
    
    
    
    
  </body>
</html>
