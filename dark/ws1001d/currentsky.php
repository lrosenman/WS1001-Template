<?php
include_once('livedata.php');?><head>
<div class="updatedtime"><span>Updated</span> <?php 
 echo $update;?> </div>
 <div class="iconcurrent" style="font-size:0px">
<?php echo "${icon} <img src='css/icons/$icon.png' > \n";?></div>
<div class="iconh3"><?php echo "${weather}   \n";?></div></div>

<!-- sunrise/set for homeweather station--> 
<?php
 // sunrise/set simple script
date_default_timezone_set($TZ);
$result = date_sun_info( time(), $lat, $lon );
?> 
<div class="sun"> Sunrise <br>
<span style="color:#ccc;font-weight:600;">
&nbsp;&nbsp;<?php echo  date('H:i',$result['sunrise'] ),"\n";?><i class='wi wi-sunrise'></i><br></span>
Sunset <br><span style="color:#ccc;font-weight:600;">
&nbsp;&nbsp;<?php echo date('H:i',$result['sunset'] ),"\n";?><i class='wi wi-sunset'></i></span>
</div><br></sun>
<!-- MOON  phase for homeweather station--> 
<div class="luminance" style="font-size:13px;">
<?php  $date="";$time="";$tzone="$TZ";do_phase($date,$time,$tzone);function do_phase($date,$time,$tzone){$moondata=phase(strtotime($date.' '.$time.' '.$tzone));
$MoonIllum=$moondata[1];$MoonIllum=round($MoonIllum,2);$MoonIllum*=100;if($MoonIllum==0){$phase="New Moon";}if($MoonIllum==100){$phase="Full Moon";}print"$MoonIllum%\n";}?><span style="font-size:13px;"><?php echo  $moon = moon_posit($months, $days, $years);?></span>
 </div>
<div class="moonrise"><i class='wi wi-moonrise'></i> Moonrise <span style="color:#f26c4f;">
<?php  echo  date('H:i',$MoonRise ),"\n";?>&nbsp;&nbsp;&nbsp;</span> 
 Moonset<span style="color:#66a1ba;">
<?php echo  date('H:i',$MoonSet ),"\n";?></span> <i class='wi wi-moonset'></i> 
 </span>
</div>
