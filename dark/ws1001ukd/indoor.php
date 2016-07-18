<?php
include_once('livedata.php');?>
<div class="tempcontainer1"><div class="circleOut">
  <span style="font-size:0px;">  
  <?php echo "Indoor \n"?>
<?php echo " ${temp_indoor}&deg;</span> \n";
if($temp_indoor>25){echo "<div class=\"\"></div><div class=\"indoortemptexthot\"> ${temp_indoor}<suptemp1>&deg;</suptemp1></div>";}
else if($temp_indoor<25){echo "<div class=\"\"></div><div class=\"indoortemptextcool\"> ${temp_indoor}<suptemp1>&deg;</suptemp1></div>";}
else if($temp_indoor<20){echo "<div class=\"\"></div><div class=\"indoortemptextcooler\"> ${temp_indoor}<suptemp1>&deg;</suptemp1></div>";}
?>   
<div class="indoortrend"><?php if ($temp_indoor === $temp_indoortrend) {
    echo "<span style='color:#ccc;font-size:0.35em'><i class='wi wi-wind towards-90-deg'></i></span>";
}

if ($temp_indoor > $temp_indoortrend) {
    echo "<span style='color:#f26c4f;font-size:0.35em'><i class='wi wi-wind towards-45-deg'></i></span>";
}

if($temp_indoor < $temp_indoortrend) {
     echo "<span style='color:#66a1ba;font-size:0.35em'><i class='wi wi-wind towards-225-deg'></i></span>";
}
?> </div> 
</div></div>
<div class="humidityindoor">
<span>Humidity</span> <?php echo " ${indoorhumidity}%";?>  <span>Feels</span> <?php echo " ${indoorfeel}&deg;";?>
</div>

