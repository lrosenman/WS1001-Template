<?php include_once('livedata.php');?>
<style>
.solarnotifications {
  position: fixed;
  right: 1%;
  top: 5px; 
  z-index:1; 
}

.solarnotifications:before {
 content: '';
  position: absolute;
  left: 287px;
  top: 60px;
  border-style: solid;
  border-width: 10px 14px 10px 0;
  border-color: rgba(0, 0, 0, 0) #66a1ba rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.solarnotify1 alert{
  display:none; }
.solarnotify {
  width: 300px;
  height: 95px;
  background-color: white;
  border-radius: 4px;
  box-shadow: 0 1px 3px #ccc;
  overflow: hidden;
  cursor: pointer;
  margin: 20px 0; font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; }
.solarnotify h3{
  font-size:16px;
  font-weight:normal; font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; }
.solarnotify hv{
  font-size:33px;
 font-weight: 600; font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; color:#f26c4f;
  font-weight:normal;
}
.solarnotify hvcold{	
  font-size:33px;
 font-weight: 600; font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; color:#66a1ba;
  font-weight:normal; 
}
.solarnotify hv10{
  font-size:33px;
  font-weight: 600;
    font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
  color:#8560a8;
  font-weight:normal;
}
.solarnotify span{	
margin-top:25px;
  font-size:12px;
  font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
}
.solarnotify:first-child {
  margin: 0 0 10px 0; font-weight: 600;
    font-family: "HelveticaNeue", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
}
.close { 
  margin-left:170px;
 
}
.close:before { 
  content:"CLOSE"; 
  color: #777; 
  
}
.close:after { 
  font-family:"FontAwesome";
  content:"  \f05c"; 
  color: #aaa; 
  font-weight:100;
  }
.alert { 
  display:none;
 }
</style>

<div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?>  </div>

<div class="average">
<?php
$sum_total = number_format($solarradiation - $solartrend,1 ); 
if ($sum_total>0)echo " +$sum_total <supmb>Wm/2</supmb>";
else if ($sum_total<0)echo "$sum_total <supmb>Wm/2</supmb>";
?>
</div>
<div class="averageuv"><span></span>
<?php
$sum_total = number_format($UV - $UVtrend,1 ); 
if ($sum_total>0)echo " +$sum_total <supmb>UVI</supmb>";
else if ($sum_total<0)echo "$sum_total <supmb>UVI</supmb>";
?>

</div><br /><br />

<!-- UV--> 
<?php
echo " \n";
// UV INDEX
if ($UV <= 0) {
    echo "<div class=\"uv01\">${UV }<uvi></uvi></div><div class=\"uvtext\">No <color>caution</color> required </div>";
} else if ($UV < 1) {
    echo "<div class=\"uv01\">${UV }<uvi></uvi></div><div class=\"uvtext\">No <color>caution</color> required </div>";
} else if ($UV < 2) {
    echo "<div class=\"uv03\">${UV }<uvi></uvi></div><div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";
} else if ($UV < 3) {
    echo "<div class=\"uv03\">${UV }<uvi></uvi></div><div class=\"uvtext\">Wear <color>sunglasses</color> on bright days </div>";
} else if ($UV < 4) {
    echo "<div class=\"uv35\">${UV }<uvi></uvi></div><div class=\"uvtext\">Stay in the shade near midday when the <color>sun</color> is strongest </div>";
} else if ($UV < 5) {
    echo "<div class=\"uv35\">${UV }<uvi></uvi></div><div class=\"uvtext\">Stay in the shade near midday when the <color>sun</color> is strongest <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 6) {
    echo "<div class=\"uv35\">${UV }<uvi></uvi></div><div class=\"uvtext\">Stay in the shade near midday when the <color>sun</color> is strongest <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 7) {
    echo "<div class=\"uv67\">${UV }<uvi></uvi></div><div class=\"uvtext\">Reduce time in the <color>sun</color> between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 8) {
    echo "<div class=\"uv67\">${UV }<uvi></uvi></div><div class=\"uvtext\">Reduce time in the <color>sun</color> between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 9) {
    echo "<div class=\"uv810\">${UV }<uvi></uvi></div><div class=\"uvtext\">Minimize <color>sun</color> exposure between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 10) {
    echo "<div class=\"uv810\">${UV }<uvi></uvi></div><div class=\"uvtext\">Minimize <color>sun</color> exposure between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 11) {
    echo "<div class=\"uv810\">${UV }<uvi></uvi></div><div class=\"uvtext\">Minimize <color>sun</color> exposure between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 12) {
    echo "<div class=\"uv1112\">${UV }<uvi></uvi></div><div class=\"uvtext\">Try to avoid<color>sun</color> exposure between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
} else if ($UV < 13) {
    echo "<div class=\"uv1112\">${UV }<uvi></uvi></div><div class=\"uvtext\">Try to avoid<color>sun</color> exposure between 10am-4pm <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>";
}
?> </span>

<?php echo "";
//solar radiation
if ($solarradiation >500){echo "<div class=\"solarcircle\">${solarradiation}<br><span>W/m&sup2</span></div><div class=\"solatext\">Solar Radiation<br><color>Good</color></div>";}
else if ($solarradiation >300){echo "<div class=\"solarcircle1\">${solarradiation}<br><span>W/m&sup2</span></div><div class=\"solatext\">Solar Radiation<br><color1>Moderate</color1></div>";}
else if ($solarradiation >150){echo "<div class=\"solarcircle2\">${solarradiation}<br><span>W/m&sup2</span></div><div class=\"solatext\">Solar Radiation<br><color2>Low</color2></div>";}
else if ($solarradiation <150){echo "<div class=\"solarcircle3\">${solarradiation}<br><span>W/m&sup2</span></div><div class=\"solatext\">Solar Radiation<br><color3>Poor</color3></div>";}
?>

