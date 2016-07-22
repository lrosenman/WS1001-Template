<?php include('livedata.php');?>
<div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?> </div>
<!-- start animated rain bucket for homeweather station--> 
  
  <div class="average"><span>Rate</span>
<?php 
 echo $rainrate;
?><supmb> <?php echo "${rainunit}\n"; ?></supmb>

</div>
  
   <style>
	   
   
#container1 {
  height: 170px;
  margin: 0 auto;
  overflow:hidden;
  position: absolute;
  margin-top: -30px;
  width: 210px;
  margin-left:10px;
}

#container1 div { position: absolute; }

.rainvalue {
	font-size:1.1em;
	color:#66a1ba;
	margin-left:30px;
	margin-top:2%;
	line-height:1em;
	font-family: "Helvetica", Arial, "Lucida Grande", sans-serif; font-weight: 600;
}

.rainvalue span{
	font-size:0.8em;
	
}


 
.norain {
	margin-left:-10px;
	margin-top:15%;
	background:none;
	height:60px;
	padding:4px;
	width:75px;
	background-image:url(css/homepageicons/norain.png);background-repeat:no-repeat;background-position:center;
}


.raintext1 {
	font-size:0.5em;
	color:#66a1ba;
	margin-left:0px;
	margin-top:3%;
	font-weight:600;
	line-height:10px;
	font-family:'Helvetica',Arial, Helvetica, sans-serif;
	
}

.raintext1 span{
	color:#df826b;
	font-size:1em;
	
}




#beaker {
  border: 5px solid #777;
  border-top: 0;
  border-radius: 5px 5px 5px 5px;
  height: 120px;
  left: 50px;
  bottom: 0;
  width: 125px;  
  background-image:url(css/rain/marker.png);
  background-repeat:no-repeat;
  
  
}

#beaker:before,
#beaker:after {
  border: 5px solid #777;
  border-bottom: 0;
  border-radius: 5px;
  content: '';
  height: 5px;
  position: absolute;
  top: -0px;
  width: 15px; 
}

#beaker:before { left: -15px;  }
#beaker:after { right: -15px;  }

#raintoday {
  background-color: #66a1ba;
  border: 1px solid #66a1ba;
  border-radius: 0 0 1px 1px;
  bottom: 0;
  width: 115px;
  margin-left:55px;
  margin-bottom:5px;
 
 
}



/*month*/
.maxrainfallmonth{position:absolute;background:none;border-radius:100%;height:60px;width:60px;padding:2px;float:right;
border:1px solid #555;
margin-top:10px;
margin-left:210px}
.maxrainfallmonth-content{float:left;line-height:1;margin-top:-7px;padding-top:30%;text-align:center;width:100%;color:#676e73;
font-family:"Helvetica", Arial;font-size:0.8em}
/*year*/
.maxrainfallyear{position:absolute;background:none;border-radius:100%;height:60px;width:60px;padding:2px;float:right;
border:1px solid #555;
margin-top:60px;
margin-left:-5px}
.maxrainfallyear-content{float:left;line-height:1;margin-top:-7px;padding-top:30%;text-align:center;
width:100%;color:#676e73;font-family:"Helvetica", Arial;font-size:0.8em}


</style>

   
   <div id="container1"> <div id="beaker">
    <div class="rainvalue"><?php echo "${raintoday} <span>${rainunit}</span>\n" ; 
	if ($raintoday <0.1){echo '<div class=\'norain fade-in norain\'></div>';}
	if ($raintoday >0.1){echo '<div class=\'raintext1\'>measured <span>today</div>';}
	?></div>    
   </div><div id="raintoday"></div></div>  
  
  
  
 <!-- simple jquery barometer donut full circle for homeweather station milliabars-->
 </span></span>

<!-- simple jquery barometer donut full circle for homeweather station milliabars-->
<div class="maxrainfallmonth">
<div class="maxrainfallmonth-content"><span style='color:#ccc;font-weight:700;font-size:11px;'><?php echo "${month}\n"; ?><br>
<span style='color:#66a1ba;font-weight:700;font-size:11px;'>
<?php echo "${rainmonth}\n"; ?><span style='font-size:10px;font-weight:500;'><?php echo "${rainunit}\n"; ?>
<br></span><span style='font-size:10px;color:#df826b;'>Total 
<div class='wi wi-raindrop wi-rotate-45'></div> 
<div class='wi wi-raindrop wi-rotate-45'></div></span></span></div>


<!-- simple jquery barometer donut full circle for homeweather station milliabars-->
<div class="maxrainfallyear">
<div class="maxrainfallyear-content" style="font-size:11px;color:#ccc;"><?php echo "${year}\n"; ?><br>
<span style='color:#66a1ba;font-weight:700;font-size:11px;'>
<?php echo "${rainyear}\n"; ?><span style='font-size:10px;font-weight:500;'><?php echo "${rainunit}\n"; ?>
<br></span><span style='font-size:10px;color:#df826b;'>Total 
<div class='wi wi-raindrop wi-rotate-45'></div> 
<div class='wi wi-raindrop wi-rotate-45'></div></span>



</div><div>

        <script>
        $(document).ready(function() {
 
  $('#raintoday') // fill the rain up
    .delay(0)
    .animate({
    height :'<?php print $raintoday * 1.5;?>px'
    }, 0); 
  
  });</script>
  