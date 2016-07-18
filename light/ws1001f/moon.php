<?php //homeweatherstation sun & moon information kind of a unique approach 12th July July 2016// ?>
<?php include_once('livedata.php');?>
<style>.sunposition{display:inline;font-size:12px;margin-top:-110px;margin-left:115px;color:#f26c4f;line-height:11px}.sunsetposition{display:inline;font-size:12px;margin-top:-110px;margin-left:-130px;color:#66a1ba;line-height:11px}.sunup{position:absolute;margin-top:70px;margin-left:-100px}.sundown{position:absolute;margin-top:-5px;margin-left:210px}.sunpositionsunrise{position:absolute;font-size:12px;margin-top:-110px;margin-left:140px;color:#f26c4f;line-height:11px}.sunpositionsunset{position:absolute;font-size:12px;margin-top:-110px;margin-left:445px;color:#66a1ba;line-height:11px}.sunposition1{position:absolute;top:280px;left:260px}sm-progress-arc{display:block;width:150px;background-image:url(img/sunrisebac.png);background-repeat:no-repeat;}.hoursgoneby{position:absolute;top:40px;left:25px;font-size:12px;color:#777}
</style>
<link href="css/main.min.css" rel="stylesheet prefetch" type="text/css">
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet prefetch" type="text/css">
<?php class MoonPhase{private $timestamp;private $phase;private $illum;private $age;private $dist;private $angdia;private $sundist;private $sunangdia;private $synmonth;private $quarters=null;function __construct($pdate=null){if(is_null($pdate))$pdate=time();$epoch=2444238.5;$elonge=278.833540;$elongp=282.596403;$eccent=0.016718;$sunsmax=1.495985e8;$sunangsiz=0.533128;$mmlong=64.975464;$mmlongp=349.383063;$mlnode=151.950429;$minc=5.145396;$mecc=0.054900;$mangsiz=0.5181;$msmax=384401;$mparallax=0.9507;$synmonth=29.53058868;$zenith=90+(50/60);$this->synmonth=$synmonth;$lunatbase=2423436.0;$this->timestamp=$pdate;$pdate=$pdate / 86400 + 2440587.5;$Day=$pdate - $epoch;$N=$this->fixangle((360 / 365.2422)* $Day);$M=$this->fixangle($N + $elonge - $elongp);$Ec=$this->kepler($M,$eccent);$Ec=sqrt((1 + $eccent)/(1 - $eccent))* tan($Ec / 2);$Ec=2 * rad2deg(atan($Ec));$Lambdasun=$this->fixangle($Ec + $elongp);$F=((1 + $eccent * cos(deg2rad($Ec)))/(1 - $eccent * $eccent));$SunDist=$sunsmax / $F;$SunAng=$F * $sunangsiz;$ml=$this->fixangle(13.1763966 * $Day + $mmlong);$MM=$this->fixangle($ml - 0.1114041 * $Day - $mmlongp);$MN=$this->fixangle($mlnode - 0.0529539 * $Day);$Ev=1.2739 * sin(deg2rad(2 *($ml - $Lambdasun)- $MM));$Ae=0.1858 * sin(deg2rad($M));$A3=0.37 * sin(deg2rad($M));$MmP=$MM + $Ev - $Ae - $A3;$mEc=6.2886 * sin(deg2rad($MmP));$A4=0.214 * sin(deg2rad(2 * $MmP));$lP=$ml + $Ev + $mEc - $Ae + $A4;$V=0.6583 * sin(deg2rad(2 *($lP - $Lambdasun)));$lPP=$lP + $V;$NP=$MN - 0.16 * sin(deg2rad($M));$y=sin(deg2rad($lPP - $NP))* cos(deg2rad($minc));$x=cos(deg2rad($lPP - $NP));$Lambdamoon=rad2deg(atan2($y,$x))+ $NP;$BetaM=rad2deg(asin(sin(deg2rad($lPP - $NP))* sin(deg2rad($minc))));$MoonAge=$lPP - $Lambdasun;$MoonPhase=(1 - cos(deg2rad($MoonAge)))/ 2;$MoonDist=($msmax *(1 - $mecc * $mecc))/(1 + $mecc * cos(deg2rad($MmP + $mEc)));$MoonDFrac=$MoonDist / $msmax;$MoonAng=$mangsiz / $MoonDFrac;$this->phase=$this->fixangle($MoonAge)/ 360;$this->illum=$MoonPhase;$this->age=$synmonth * $this->phase;$this->dist=$MoonDist;$this->angdia=$MoonAng;$this->sundist=$SunDist;$this->sunangdia=$SunAng;}private function fixangle($a){return($a - 360 * floor($a / 360));}private function kepler($m,$ecc){$epsilon=0.000001;$e=$m=deg2rad($m);do{$delta=$e - $ecc * sin($e)- $m;$e-=$delta /(1 - $ecc * cos($e));}while(abs($delta)>$epsilon);return $e;}private function meanphase($sdate,$k){$t=($sdate - 2415020.0)/ 36525;$t2=$t * $t;$t3=$t2 * $t;$nt1=2415020.75933 + $this->synmonth * $k + 0.0001178 * $t2 - 0.000000155 * $t3 + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));return $nt1;}private function truephase($k,$phase){$apcor=false;$k+=$phase;$t=$k / 1236.85;$t2=$t * $t;$t3=$t2 * $t;$pt=2415020.75933 + $this->synmonth * $k + 0.0001178 * $t2 - 0.000000155 * $t3 + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));$m=359.2242 + 29.10535608 * $k - 0.0000333 * $t2 - 0.00000347 * $t3;$mprime=306.0253 + 385.81691806 * $k + 0.0107306 * $t2 + 0.00001236 * $t3;$f=21.2964 + 390.67050646 * $k - 0.0016528 * $t2 - 0.00000239 * $t3;if($phase<0.01||abs($phase - 0.5)<0.01){$pt+=(0.1734 - 0.000393 * $t)* sin(deg2rad($m))+ 0.0021 * sin(deg2rad(2 * $m))- 0.4068 * sin(deg2rad($mprime))+ 0.0161 * sin(deg2rad(2 * $mprime))- 0.0004 * sin(deg2rad(3 * $mprime))+ 0.0104 * sin(deg2rad(2 * $f))- 0.0051 * sin(deg2rad($m + $mprime))- 0.0074 * sin(deg2rad($m - $mprime))+ 0.0004 * sin(deg2rad(2 * $f + $m))- 0.0004 * sin(deg2rad(2 * $f - $m))- 0.0006 * sin(deg2rad(2 * $f + $mprime))+ 0.0010 * sin(deg2rad(2 * $f - $mprime))+ 0.0005 * sin(deg2rad($m + 2 * $mprime));$apcor=true;}else if(abs($phase - 0.25)<0.01||abs($phase - 0.75)<0.01){$pt+=(0.1721 - 0.0004 * $t)* sin(deg2rad($m))+ 0.0021 * sin(deg2rad(2 * $m))- 0.6280 * sin(deg2rad($mprime))+ 0.0089 * sin(deg2rad(2 * $mprime))- 0.0004 * sin(deg2rad(3 * $mprime))+ 0.0079 * sin(deg2rad(2 * $f))- 0.0119 * sin(deg2rad($m + $mprime))- 0.0047 * sin(deg2rad($m - $mprime))+ 0.0003 * sin(deg2rad(2 * $f + $m))- 0.0004 * sin(deg2rad(2 * $f - $m))- 0.0006 * sin(deg2rad(2 * $f + $mprime))+ 0.0021 * sin(deg2rad(2 * $f - $mprime))+ 0.0003 * sin(deg2rad($m + 2 * $mprime))+ 0.0004 * sin(deg2rad($m - 2 * $mprime))- 0.0003 * sin(deg2rad(2 * $m + $mprime));if($phase<0.5)$pt+=0.0028 - 0.0004 * cos(deg2rad($m))+ 0.0003 * cos(deg2rad($mprime));else $pt+=-0.0028 + 0.0004 * cos(deg2rad($m))- 0.0003 * cos(deg2rad($mprime));$apcor=true;}if(!$apcor)return false;return $pt;}private function phasehunt(){$sdate=$this->utctojulian($this->timestamp);$adate=$sdate - 45;$ats=$this->timestamp - 86400 * 45;$yy=(int)gmdate('Y',$ats);$mm=(int)gmdate('n',$ats);$k1=floor(($yy +(($mm - 1)*(1 / 12))- 1900)* 12.3685);$adate=$nt1=$this->meanphase($adate,$k1);while(true){$adate+=$this->synmonth;$k2=$k1 + 1;$nt2=$this->meanphase($adate,$k2);if(abs($nt2 - $sdate)<0.75)$nt2=$this->truephase($k2,0.0);if($nt1<=$sdate&&$nt2>$sdate)break;$nt1=$nt2;$k1=$k2;}$data=array($this->truephase($k1,0.0),$this->truephase($k1,0.25),$this->truephase($k1,0.5),$this->truephase($k1,0.75),$this->truephase($k2,0.0),$this->truephase($k2,0.25),$this->truephase($k2,0.5),$this->truephase($k2,0.75));$this->quarters=array();foreach($data as $v)$this->quarters[]=($v - 2440587.5)* 86400;}private function utctojulian($ts){return $ts / 86400 + 2440587.5;}private function get_phase($n){if(is_null($this->quarters))$this->phasehunt();return $this->quarters[$n];}function phase(){return $this->phase;}function illumination(){return $this->illum;}function age(){return $this->age;}function distance(){return $this->dist;}function diameter(){return $this->angdia;}function sundistance(){return $this->sundist;}function sundiameter(){return $this->sunangdia;}function new_moon(){return $this->get_phase(0);}function first_quarter(){return $this->get_phase(1);}function full_moon(){return $this->get_phase(2);}function last_quarter(){return $this->get_phase(3);}function next_new_moon(){return $this->get_phase(4);}function next_first_quarter(){return $this->get_phase(5);}function next_full_moon(){return $this->get_phase(6);}function next_last_quarter(){return $this->get_phase(7);}function phase_name(){$names=array('New Moon','Waxing Crescent','First Quarter','Waxing Gibbous','Full Moon','Waning Gibbous','Third Quarter','Waning Crescent','New Moon');return $names[ floor(($this->phase + 0.0625)* 8)];}}?> 
 <script src="js/jquery.js"></script> 
<!-- homeweatherstation moon info Add the container -->
<div id="container" style="width: 600px; height: 430px; border:0px;">
<div class="titleforecast"><span style="color:#777;font-size:1em;margin-left:120px;margin-top:25px;"><i class="fa fa-map-marker1 fa-1x"></i> <?php
echo "${stationName} \n";
?><strong>Current</strong> <i class='wi wi-moon-alt-waning-crescent-3' ></i> <span style="color:#59a6c2"> Moon  </span>  <span style="color:#f27260;"> 
<i class='wi wi-horizon-alt' ></i> Sun  </span>Information </span></span></div>
<div style="margin-left:-30px;width:600px;position:static;">
<!-- MOON  phase for homeweather station--> 
 <div class="mooncircle"><moonhead>
 Luminance</moonhead><br />
<?php  $date="";$time="";$tzone="$TZ </span>" ;do_phase($date,$time,$tzone);
function do_phase($date,$time,$tzone){
$moondata=phase(strtotime($date.' '.$time.' '.$tzone));
$MoonIllum=$moondata[1];$MoonIllum=round($MoonIllum,2);$MoonIllum*=100;
if($MoonIllum==0){$phase="New Moon";}
if($MoonIllum==100){$phase="Full Moon";}
print"$MoonIllum%\n";}?>
<?php echo $moon = moon_posit($months, $days, $years);?>
</div> 
<div class="mooninfo">
<span style="color:#ee7259;font-size:0.9em;"> Moonrise:
<span style="color:#777;font-weight:normal;">
<?php echo  date('d-m-Y H:i',$MoonRise ),"\n";?><i class='wi wi-moonrise'></i></span>
<span style="color:#66a1ba;">&nbsp;Moonset:<span style="color:#777;font-weight:normal;">
<?php echo date('d-m-Y H:i',$MoonSet ),"\n";?><i class='wi wi-moonset'></i></span>
<br />
</span></span>
<span style="color:#777;font-size:0.9em;"> 
<i class='wi wi-moon-new'></i> <?php
// homeweatherstation create an instance of the next full moon
$moon = new MoonPhase();
$nextfullmoon = date( 'jS-M-Y', $moon->full_moon() );
echo "Full Moon <span style='color:#ee7259;'>$nextfullmoon";?></span>
<span style="color:#777;"> 
<i class='wi wi-moon-full'></i> <?php
// homeweatherstation create an instance of the next new moon
$moon = new MoonPhase();
$nextnewmoon = date( 'jS-M-Y', $moon->next_new_moon() );
echo "New Moon <span style='color:#66a1ba;'>$nextnewmoon";?></span>
<br />
<i class='wi wi-moon-alt-waning-crescent-3' ></i> <?php
// homeweatherstation create an instance of the age of moon
$moon = new MoonPhase();
$moonage =round($moon->age(),2);
echo "Moon is <span style='color:#66a1ba;'>$moonage days old";?></span>
<br />
</span></span></span>
<div class="line"></div>
<!--- homeweather station animated beta sun hours designed by brian underdown June 2016 --->
<?php
 // homeweatherstation sunrise/set/first light/last light simple script using in built php 
date_default_timezone_set($TZ);$result = date_sun_info( time(), $lat, $lon );
?> 
<div class="sunpos">
       <div class="sunpos-times">       
       </div>        
    <div class="sunrisesunset">
        <div class="sunrise"> <i class='wi wi-sunrise'></i>
        Sunrise: <?php echo '', date( 'H:i', $result['sunrise'] ), " " ;?></div>
        <div class="sunset">
        Sunset: <?php echo '', date( 'H:i', $result['sunset'] ), " " ;?> <i class='wi wi-sunset'></i></div>
    </div>  
    <div class="firstlight">
        <div class="sunrise">
        <span style="color:#ee7259;"><i class='wi wi-horizon' ></i></span> 
        First Light:<?php echo '', date( 'H:i', $result['civil_twilight_begin'] ), " " ;?></div>
        <div class="sunset">
        Last Light: <?php echo '', date( 'H:i', $result['civil_twilight_end'] ), " " ;?><span style="color:#ee7259;"><i class='wi wi-horizon' ></i></span>
        </div></div></div></div></div></div> 

 <!--homeweatherstation daylight hours canvas circle designed by brian underdown june 23rd 2016--- updated june27th 2016-->
 <?php $zenith=90+(50/60);$sunrise=date_sunrise(time(),SUNFUNCS_RET_STRING,$lat,$lon,$zenith,$UTC);$sunrise_time=date(strtotime(date("H:i").' '.$sunrise));$sunset=date_sunset(time(),SUNFUNCS_RET_STRING,$lat,$lon,$zenith,$UTC);$sunset_time=date(strtotime(date("H:i").' '.$sunset));$date1=date_create("$sunset");$date2=date_create("$sunrise");$today=date('H.i:s');$diff=date_diff($date1,$date2);?>  
<div class="daylight" id="daylight" data-percent="<?php print "".$diff->format("%h.%i")."";?>" color='#fff'></div>   
        <script>
		<!--minified homweatherstation daylight script june23rd 2016 --- updated june27th 2016 --->
		var el=document.getElementById("daylight"),options={percent:el.getAttribute("data-percent")||25,size:el.getAttribute("data-size")||160,lineWidth:el.getAttribute("data-line")||10,rotate:el.getAttribute("data-rotate")||0},canvas=document.createElement("canvas"),span=document.createElement("daylighthours");span.textContent=options.percent+" hrs","undefined"!=typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(canvas);var ctx=canvas.getContext("2d");canvas.width=canvas.height=options.size,el.appendChild(span),el.appendChild(canvas),ctx.translate(options.size/2,options.size/2),ctx.rotate((-0.5+options.rotate/180)*Math.PI);var radius=(options.size-options.lineWidth)/2,drawCircle=function(t,e,a){a=Math.min(Math.max(0,a||1),1),ctx.beginPath(),ctx.arc(0,0,radius,0,2*Math.PI*a,!1),ctx.strokeStyle=t,ctx.lineCap="square",ctx.lineWidth=e,ctx.stroke()};drawCircle("#555",options.lineWidth,1),drawCircle("#f26c4f",options.lineWidth,options.percent/24);      
        </script>
        <?php //homeweatherstation calculate sunrise/set times and differences
		date_default_timezone_set($TZ);
        $result = date_sun_info( time(), $lat, $lon );		
		// homeweatherstation sun hours graphic beta June27th 2016//
		$suns =date( 'H.i', $result['sunset'] );
		$sunr= date( 'H.i.s', $result['sunrise']  );
		$now =date('H.i.s');
		$diff3 = $now - $sunr ;	
		
		
		$suns =date( 'H.i', $result['sunset'] );
		$sunr= date( 'H.i.s', $result['sunrise']  );
		$now =date('H.i.s');
		$diff4 = $suns - $sunr ;		        	
        // homeweatherstation to sunset	(1)
        $startdate="$now"; 
        $enddate="$suns"; 
        $diff=strtotime($enddate)-strtotime($startdate); 
        $temp=$diff/86400; 
        $days1=floor($temp);  $temp=24*($temp-$days1); 
        $hours1=floor($temp);  $temp=60*($temp-$hours1); 
        $minutes1=floor($temp);  $temp=60*($temp-$minutes1);
        $seconds1=floor($temp); 		
		 // homeweatherstation from sunrise	(2)
        $startdate="$sunr"; 
        $enddate="$now"; 
        $diff=strtotime($enddate)-strtotime($startdate); 
        $temp=$diff/86400; 
        $days2=floor($temp);  $temp=24*($temp-$days2); 
        $hours2=floor($temp);  $temp=60*($temp-$hours2); 
        $minutes2=floor($temp);  $temp=60*($temp-$minutes2);
        $seconds2=floor($temp); 		
		 // homeweatherstation to sunrise after (00:00) midnight (3)	
        $startdate="$now"; 
        $enddate="$sunr"; 
        $diff=strtotime($enddate)-strtotime($startdate); 
        $temp=$diff/86400; 
        $days3=floor($temp);  $temp=24*($temp-$days3); 
        $hours3=floor($temp);  $temp=60*($temp-$hours3); 
        $minutes3=floor($temp);  $temp=60*($temp-$minutes3);
        $seconds3=floor($temp); 
		
		// end homeweatherstation calculations		 
?>
<div class="sunpositionsunrise">
<?php  // homeweatherstation sunrise info output
echo "";
if(date('H.i')  < $sunr) {echo "${hours3}hrs ${minutes3} mins<br>to Sunrise ";}
else if(date('H.i')  > $suns) {echo 'Darkness<br>Hours';}
else echo "Sunrise was ${hours2}hrs<br>${minutes2} mins ago";
?></div>  
<div class="sunpositionsunset">
<?php // homeweatherstation sunset/horizon 
echo "";
if(date('H.i')  < $sunr) {echo 'Sun is below<br>horizon';}
else if(date('H.i')  > $suns) {echo 'Sun is below<br>horizon';}
else echo "${hours1}hrs ${minutes1} mins<br>till Sunset ";
?>
</div>
<div class="sunposition1">
<div class="sunup"> 
 <img src="img/sunup.png" width="35" height="35" alt="homeweatherstation sunrise"/></div>
 <div ng-app="app">
 <sm-progress-arc progress="
  <?php // simple progess for daylight hours passed for homeweatherstation
  if ($now<$sunr)print "0";  
  else if ($now>$suns)print "0";  
  else print $hours2;  
  ?>
  "> 
  </sm-progress-arc>     
</div>
<div class="sundown"> 
 <img src="img/sundown.png" width="35" height="35" alt="homeweatherstation sunset"/></div> 
</div>
<div style="margin-top:-25px;">
<Script Language='Javascript'>document.write(unescape('%3C%61%20%68%72%65%66%3D%22%68%74%74%70%3A%2F%2F%77%65%61%74%68%65%72%2D%64%69%73%70%6C%61%79%2E%63%6F%6D%22%20%74%61%72%67%65%74%3D%22%5F%62%6C%61%6E%6B%22%3E%20%3C%69%6D%67%20%73%72%63%3D%22%69%6D%67%2F%73%6D%61%6C%6C%6C%6F%67%6F%2E%70%6E%67%22%20%3E%3C%2F%61%3E'));</Script></div>
 <script src='js/angular.js'></script>
 <script src='js/d3.js'></script>
  <script>
  "use strict";angular.module("app",[]).directive("smProgressArc",function(){return{scope:{progress:"="},restrict:"AE",link:function link(scope,elem,attrs){console.log(scope.progress);var container=elem[0];var pi=Math.PI,width=container.offsetWidth;var outerRadius=width/2;var innerRadius=0*outerRadius;console.log("width",width);var svg=d3.select(container).append("svg").attr("width",width).attr("height",width/2).append("g").attr("transform","translate("+width/2+","+width/2+")");var arc=d3.svg.arc().innerRadius(outerRadius).outerRadius(innerRadius).startAngle(-pi/2).endAngle(pi/2);svg.append("path").attr("class","arc").attr("d",arc).attr("fill","rgba(233, 235, 241, 0.5)");var percent=-pi/2+scope.progress*pi/<?php print $diff4;?>;arc.endAngle(percent);svg.append("path").attr("d",arc).attr("fill","rgba(242, 108, 79, 0.8)");}};});   
  </script>
  
  
</div></div></div>
<!--- Homeweatherstation respect the design and the time it took to make the code ---->
