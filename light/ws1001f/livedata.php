<?php include_once('settings.php');?>
<?php
//disable error logging
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set(“display_errors”,”off”);
//parsing indoor weather and outdoor sensors for ws1001 homeweather station template May 2016 with conversions NON METRIC VERSION
$json_string             =file_get_contents($livedata);
$parsed_json             =json_decode($json_string);
//ws1001 clones output & conversion from non metric to metric//
$update =$parsed_json->{'updated'};
//outside temp,humidity,chill,dewpoint //
$temp_c  =$parsed_json->{'outsideTemp'};
$humidity=$parsed_json->{'outsideHumidity'};
$dewpoint_c=$parsed_json->{'dewpoint'};
$windchill=$parsed_json->{'windchill'};
$heatindex=$parsed_json->{'heatindex'};
//indoor//
$temp_indoor=$parsed_json->{'indoorTemp'};
$indoorhumidity=$parsed_json->{'indoorHumidity'};
//barometer//
$barometer =$parsed_json->{'barometer'};
$absbarometer =$parsed_json->{'absbarometer'};
//wind//
$wind_degrees=$parsed_json->{'windDir'};
$wind_kph=$parsed_json->{'windSpeed'};
$wind_gust_kph=$parsed_json->{'windGust'};
//rain//
$rainrate =$parsed_json->{'rainrate'};
$raintoday =$parsed_json->{'raintoday'};
$rainweek =$parsed_json->{'rainweek'};
$rainmonth =$parsed_json->{'rainmonth'};
$rainyear =$parsed_json->{'rainyear'};
//solar//
$solarradiation=$parsed_json->{'radiation'};
$UV=$parsed_json->{'UV'};

//extras//
$software=$parsed_json->{'softwaretype'};
$realtime=$parsed_json->{'realtime'};
$rtfreq=$parsed_json->{'rtfreq'};
$timestamp =$parsed_json->{'timestamp'};
$day=$parsed_json->{'day'};
$month=$parsed_json->{'month'};
$year=$parsed_json->{'year'};
$power=$parsed_json->{'power'};
$status=$parsed_json->{'status'};
//feels//
$realfeel=$parsed_json->{'realfeel'};
function realfeel($realfeel){if(!isset($realfeel)){return false;}return number_format((float)$realfeel,1,'.','');}$realfeel=realfeel($realfeel);
$indoorfeel=$parsed_json->{'indoorfeel'};
function indoorfeel($indoorfeel){if(!isset($indoorfeel)){return false;}return number_format((float)$indoorfeel,1,'.','');}$indoorfeel=indoorfeel($indoorfeel);
?>

<?php
//barometer trend PER HOUR//
$json_string=file_get_contents("jsondata/trend.json");
$parsed_json=json_decode($json_string);
$trendbarometer=$parsed_json->{'trendbarometer'};

?>
<?php
//temp trend PER 10 MINUTES//
$json_string=file_get_contents("jsondata/temptrend.json");
$parsed_json=json_decode($json_string);
$trendTemp  =$parsed_json->{'trendTemp'};
$humiditytrend=$parsed_json->{'humiditytrend'};
$dewpointtrend=$parsed_json->{'dewpointtrend'};
$temp_indoortrend=$parsed_json->{'indoortrendTemp'};
$wind_degreesavg=$parsed_json->{'windDir'};
$solartrend=$parsed_json->{'radiation'};
$windtrend=$parsed_json->{'windSpeed'};
$windgusttrend=$parsed_json->{'windGust'};
$indoortrendhumidity=$parsed_json->{'indoortrendHumidity'};
$UVtrend=$parsed_json->{'UV'};
?>

<?php
// current sky
$json_string=file_get_contents("jsondata/weather.json");
$parsed_json=json_decode($json_string);
$weather=$parsed_json->{'current_observation'}->{'weather'};
$icon=$parsed_json->{'current_observation'}->{'icon'};
?>
<?php //moon phase 
date_default_timezone_set($TZ);function isdayofmonth($month,$day,$year){$dim=array(31,29,31,30,31,30,31,31,30,31,30,31);if($month!=2){if(1<=$day&&$day<=$dim[$month-1])return true;else return false;}$feb=$dim[0];if(isleapyear($year)){$feb++;}if(1<=$day&&$day<=$feb){return true;}return false;}function isleapyear($year){$a=floor($year-4*floor($year/4));$b=floor($year-100*floor($year/100));$c=floor($year-400*floor($year/400));if($a==0){if($b==0&&$c!=0)return false;else return true;}return false;}function moon_posit($month=null,$day=null,$year=null){$moon=array();if(!isdayofmonth($month,$day,$year)){$moon['errors']='Invalid date';}else {$moon['errors']=null;$phase='';$YY=0;$MM=0;$K1=0;$K2=0;$K3=0;$JD=0;$IP=0.0;$DP=0.0;$NP=0.0;$RP=0.0;$YY=$year-floor((12-$month)/10);$MM=$month+9;if($MM>=12){$MM=$MM-12;}$K1=floor(365.25*($YY+4712));$K2=floor(30.6*$MM+0.5);$K3=floor(floor(($YY/100)+49)*0.75)-38;$JD=$K1+$K2+$day+59;if($JD>2299160){$JD=$JD-$K3;}$IP=normalize(($JD-2451550.1)/29.530588853);$age=$IP*29.53;
if($age<1.24566)$phase='&nbsp;New Moon';
else if($age<5.53699)$phase='&nbsp;Waxing Crescent';
else if($age<8.5)$phase='&nbsp;First Quarter';
else if($age<14.11963)$phase='&nbsp;Waxing Gibbous';
else if($age<15.61096)$phase='&nbsp;Full Moon';
else if($age<23.99361)$phase='&nbsp;Waning Gibbous';
else if($age<28.90000)$phase='&nbsp;Waning Crescent';
else $phase='&nbsp;New Moon';}$moon=$phase;$ageofmoon=round($age,0);$ageofmoon;
if($ageofmoon<1.2){echo "<div class=\"wi   wi-moon-alt-new\"></div>";}
else if($ageofmoon<5){echo " <div class=\"wi wi-moon-alt-waxing-cresent-1\"></div> ";}
else if($ageofmoon<8){echo " <div class=\"wi wi-moon-alt-waxing-cresent-5\"></div>";}
else if($ageofmoon<9){echo "<div class=\"wi wi-moon-alt-first-quarter\"></div>";}
else if($ageofmoon<11){echo "<div class=\"wi wi-moon-alt-waxing-gibbous-2\"></div>";}
else if($ageofmoon<12){echo "<div class=\"wi wi-moon-alt-waxing-gibbous-3\"></div>";}
else if($ageofmoon<13){echo "<div class=\"wi wi-moon-alt-waxing-gibbous-5\"></div>";}
else if($ageofmoon<14){echo "<div class=\"wi wi-moon-alt-waxing-gibbous-6\"></div>";}
else if($ageofmoon<16){echo "<div class=\"wi wi-moon-alt-full\"></div>";}
else if($ageofmoon<20){echo "<div class=\"wi wi-moon-alt-waning-gibbous-1\"></div>";}
else if($ageofmoon<21){echo "<div class=\"wi wi-moon-alt-waning-gibbous-2\"></div>";}
else if($ageofmoon<22){echo "<div class=\"wi wi-moon-alt-waning-gibbous-4\"></div>";}
else if($ageofmoon<23){echo "<div class=\"wi wi-moon-alt-waning-gibbous-5\"></div>";}
else if($ageofmoon<24){echo "<div class=\"wi wi-moon-alt-waning-crescent-1\"></div>";}
else if($ageofmoon<25){echo "<div class=\"wi wi-moon-alt-waning-crescent-3\"></div>";}
else if($ageofmoon<26){echo "<div class=\"wi wi-moon-alt-waning-crescent-4\"></div>";}
else if($ageofmoon<27){echo "<div class=\"wi wi-moon-alt-waning-crescent-5\"></div>";}
else if($ageofmoon<29){echo "<div class=\"wi wi-moon-alt-waning-crescent-6\"></div>";}
else if($ageofmoon<33){echo " <div class=\"wi wi-moon-alt-new\"></div>";}
echo " <span style='color:#777;font-weight:normal;font-size:13px'>  ${moon} </span> \n";}
$moonify="${stationName} Weather Station";
function normalize($v){$v=$v-floor($v);if($v<0){$v+1;}return $v;}$date=time();$years=date('Y',$date);$months=date('n',$date);$days=date('j',$date);define('ERR_UNDEF',-1);define('EPOCH',2444238.5);define('ELONGE',278.833540);define('ELONGP',282.596403);define('ECCENT',0.016718);define('SUNSMAX',1.495985e8);define('SUNANGSIZ',0.533128);define('MMLONG',64.975464);define('MMLONGP',349.383063);define('MLNODE',151.950429);define('MINC',5.145396);define('MECC',0.054900);define('MANGSIZ',0.5181);define('MSMAX',384401.0);define('MPARALLAX',0.9507);define('SYNMONTH',29.53058868);function sgn($arg){return (($arg<0)?-1:($arg>0?1:0));}function fixangle($arg){return ($arg-360.0*(floor($arg/360.0)));}function torad($arg){return ($arg*(pi()/180.0));}function todeg($arg){return ($arg*(180.0/pi()));}function dsin($arg){return (sin(torad($arg)));}function dcos($arg){return (cos(torad($arg)));}function jtime($timestamp){$julian=($timestamp/86400)+2440587.5;return $julian;}function jdaytosecs($jday=0){$stamp=($jday-2440587.5)*86400;return $stamp;}function jyear($td,&$yy,&$mm,&$dd){$td+=0.5;$z=floor($td);$f=$td-$z;if($z<2299161.0){$a=$z;}else {$alpha=floor(($z-1867216.25)/36524.25);$a=$z+1+$alpha-floor($alpha/4);}$b=$a+1524;$c=floor(($b-122.1)/365.25);$d=floor(365.25*$c);$e=floor(($b-$d)/30.6001);$dd=$b-$d-floor(30.6001*$e)+$f;$mm=$e<14?$e-1:$e-13;$yy=$mm>2?$c-4716:$c-4715;}function meanphase($sdate,$k){$t=($sdate-2415020.0)/36525;$t2=$t*$t;$t3=$t2*$t;$nt1=2415020.75933+SYNMONTH*$k+0.0001178*$t2-0.000000155*$t3+0.00033*dsin(166.56+132.87*$t-0.009173*$t2);return ($nt1);}function truephase($k,$phase){$apcor=0;$k+=$phase;$t=$k/1236.85;$t2=$t*$t;$t3=$t2*$t;$pt=2415020.75933+SYNMONTH*$k+0.0001178*$t2-0.000000155*$t3+0.00033*dsin(166.56+132.87*$t-0.009173*$t2);$m=359.2242+29.10535608*$k-0.0000333*$t2-0.00000347*$t3;$mprime=306.0253+385.81691806*$k+0.0107306*$t2+0.00001236*$t3;$f=21.2964+390.67050646*$k-0.0016528*$t2-0.00000239*$t3;if(($phase<0.01)||(abs($phase-0.5)<0.01)){$pt+=(0.1734-0.000393*$t)*dsin($m)+0.0021*dsin(2*$m)-0.4068*dsin($mprime)+0.0161*dsin(2*$mprime)-0.0004*dsin(3*$mprime)+0.0104*dsin(2*$f)-0.0051*dsin($m+$mprime)-0.0074*dsin($m-$mprime)+0.0004*dsin(2*$f+$m)-0.0004*dsin(2*$f-$m)-0.0006*dsin(2*$f+$mprime)+0.0010*dsin(2*$f-$mprime)+0.0005*dsin($m+2*$mprime);$apcor=1;}elseif((abs($phase-0.25)<0.01||(abs($phase-0.75)<0.01))){$pt+=(0.1721-0.0004*$t)*dsin($m)+0.0021*dsin(2*$m)-0.6280*dsin($mprime)+0.0089*dsin(2*$mprime)-0.0004*dsin(3*$mprime)+0.0079*dsin(2*$f)-0.0119*dsin($m+$mprime)-0.0047*dsin($m-$mprime)+0.0003*dsin(2*$f+$m)-0.0004*dsin(2*$f-$m)-0.0006*dsin(2*$f+$mprime)+0.0021*dsin(2*$f-$mprime)+0.0003*dsin($m+2*$mprime)+0.0004*dsin($m-2*$mprime)-0.0003*dsin(2*$m+$mprime);if($phase<0.5){$pt+=0.0028-0.0004*dcos($m)+0.0003*dcos($mprime);}else {$pt+=-0.0028+0.0004*dcos($m)-0.0003*dcos($mprime);}$apcor=1;}if(!$apcor){print"truephase() called with invalid phase selector ($phase).\n";exit(ERR_UNDEF);}return ($pt);}function phasehunt($time=-1){if(empty($time)||$time==-1){$time=time();}$sdate=jtime($time);$adate=$sdate-45;jyear($adate,$yy,$mm,$dd);$k1=floor(($yy+(($mm-1)*(1.0/12.0))-1900)*12.3685);$adate=$nt1=meanphase($adate,$k1);while(1){$adate+=SYNMONTH;$k2=$k1+1;$nt2=meanphase($adate,$k2);if(($nt1<=$sdate)&&($nt2>$sdate)){break;}$nt1=$nt2;$k1=$k2;}return array(jdaytosecs(truephase($k1,0.0)),jdaytosecs(truephase($k1,0.25)),jdaytosecs(truephase($k1,0.5)),jdaytosecs(truephase($k1,0.75)),jdaytosecs(truephase($k2,0.0)));}function phaselist($sdate,$edate){if(empty($sdate)||empty($edate)){return array();}$sdate=jtime($sdate);$edate=jtime($edate);$phases=array();$d=$k=$yy=$mm=0;jyear($sdate,$yy,$mm,$d);$k=floor(($yy+(($mm-1)*(1.0/12.0))-1900)*12.3685)-2;while(1){++$k;foreach(array(0.0,0.25,0.5,0.75) as $phase){$d=truephase($k,$phase);if($d>=$edate){return $phases;}if($d>=$sdate){if(empty($phases)){array_push($phases,floor(4*$phase));}array_push($phases,jdaytosecs($d));}}}}function kepler($m,$ecc){$EPSILON=1e-6;$m=torad($m);$e=$m;do{$delta=$e-$ecc*sin($e)-$m;$e-=$delta/(1-$ecc*cos($e));}while(abs($delta)>$EPSILON);return ($e);}function phase($time=0){if(empty($time)||$time==0){$time=time();}$pdate=jtime($time);$pphase;$mage;$dist;$angdia;$sudist;$suangdia;$Day=$pdate-EPOCH;$N=fixangle((360/365.2422)*$Day);$M=fixangle($N+ELONGE-ELONGP);$Ec=kepler($M,ECCENT);$Ec=sqrt((1+ECCENT)/(1-ECCENT))*tan($Ec/2);$Ec=2*todeg(atan($Ec));$Lambdasun=fixangle($Ec+ELONGP);$F=((1+ECCENT*cos(torad($Ec)))/(1-ECCENT*ECCENT));$SunDist=SUNSMAX/$F;$SunAng=$F*SUNANGSIZ;$ml=fixangle(13.1763966*$Day+MMLONG);$MM=fixangle($ml-0.1114041*$Day-MMLONGP);$MN=fixangle(MLNODE-0.0529539*$Day);$Ev=1.2739*sin(torad(2*($ml-$Lambdasun)-$MM));$Ae=0.1858*sin(torad($M));$A3=0.37*sin(torad($M));$MmP=$MM+$Ev-$Ae-$A3;$mEc=6.2886*sin(torad($MmP));$A4=0.214*sin(torad(2*$MmP));$lP=$ml+$Ev+$mEc-$Ae+$A4;$V=0.6583*sin(torad(2*($lP-$Lambdasun)));$lPP=$lP+$V;$NP=$MN-0.16*sin(torad($M));$y=sin(torad($lPP-$NP))*cos(torad(MINC));$x=cos(torad($lPP-$NP));$Lambdamoon=todeg(atan2($y,$x));$Lambdamoon+=$NP;$BetaM=todeg(asin(sin(torad($lPP-$NP))*sin(torad(MINC))));$MoonAge=$lPP-$Lambdasun;$MoonPhase=(1-cos(torad($MoonAge)))/2;$MoonDist=(MSMAX*(1-MECC*MECC))/(1+MECC*cos(torad($MmP+$mEc)));$MoonDFrac=$MoonDist/MSMAX;$MoonAng=MANGSIZ/$MoonDFrac;$MoonPar=MPARALLAX/$MoonDFrac;$pphase=$MoonPhase;$mage=SYNMONTH*(fixangle($MoonAge)/360.0);$dist=$MoonDist;$angdia=$MoonAng;$sudist=$SunDist;$suangdia=$SunAng;$mpfrac=fixangle($MoonAge)/360.0;return array($mpfrac,$pphase,$mage,$dist,$angdia,$sudist,$suangdia);}?>
<?php // get moonrise/set // 
class Moon{public static function calculateMoonTimes($months,$day,$year,$lat,$lon){$utrise=$utset=0;$date=self::modifiedJulianDate($months,$day,$year);$latRad=deg2rad($lat);$sinho=0.0023271056;$sglat=sin($latRad);$cglat=cos($latRad);$rise=false;$set=false;$above=false;$hour=1;$ym=self::sinAlt($date,$hour - 1,$lon,$cglat,$sglat)- $sinho;$above=$ym>0;while($hour<=25&&(true==$set||false==$rise)){$yz=self::sinAlt($date,$hour,$lon,$cglat,$sglat)- $sinho;$yp=self::sinAlt($date,$hour + 1,$lon,$cglat,$sglat)- $sinho;$quadout=self::quad($ym,$yz,$yp);$nz=$quadout[0];$z1=$quadout[1];$z2=$quadout[2];$xe=$quadout[3];$ye=$quadout[4];if($nz==1){if($ym<0){$utrise=$hour + $z1;$rise=true;}else{$utset=$hour + $z1;$set=true;}}if($nz==2){if($ye<0){$utrise=$hour + $z2;$utset=$hour + $z1;}else{$utrise=$hour + $z1;$utset=$hour + $z2;}}$ym=$yp;$hour+=2.0;}$retVal=new stdClass();$utrise=self::convertTime($utrise);$utset=self::convertTime($utset);$retVal->moonrise=$rise?gmmktime($utrise['hrs'],$utrise['min'],0,$months,$day,$year):gmmktime(0,0,0,$months,$day + 1,$year);$retVal->moonset=$set?gmmktime($utset['hrs'],$utset['min'],0,$months,$day,$year):gmmktime(0,0,0,$months,$day + 1,$year);return $retVal;}private static function quad($ym,$yz,$yp){$nz=$z1=$z2=0;$a=0.5 *($ym + $yp)- $yz;$b=0.5 *($yp - $ym);$c=$yz;$xe=-$b /(2 * $a);$ye=($a * $xe + $b)* $xe + $c;$dis=$b * $b - 4 * $a * $c;if($dis>0){$dx=0.5 * sqrt($dis)/ abs($a);$z1=$xe - $dx;$z2=$xe + $dx;$nz=abs($z1)<1?$nz + 1:$nz;$nz=abs($z2)<1?$nz + 1:$nz;$z1=$z1<-1?$z2:$z1;}return array($nz,$z1,$z2,$xe,$ye);}private static function sinAlt($mjd,$hour,$glon,$cglat,$sglat){$mjd+=$hour / 24;$t=($mjd - 51544.5)/ 36525;$objpos=self::minimoon($t);$ra=$objpos[1];$dec=$objpos[0];$decRad=deg2rad($dec);$tau=15 *(self::lmst($mjd,$glon)- $ra);return $sglat * sin($decRad)+ $cglat * cos($decRad)* cos(deg2rad($tau));}private static function degRange($x){$b=$x / 360;$a=360 *($b -(int)$b);$retVal=$a<0?$a + 360:$a;return $retVal;}private static function lmst($mjd,$glon){$d=$mjd - 51544.5;$t=$d / 36525;$lst=self::degRange(280.46061839 + 360.98564736629 * $d + 0.000387933 * $t * $t - $t * $t * $t / 38710000);return $lst / 15 + $glon / 15;}private static function minimoon($t){$p2=6.283185307;$arc=206264.8062;$coseps=0.91748;$sineps=0.39778;$lo=self::frac(0.606433 + 1336.855225 * $t);$l=$p2 * self::frac(0.374897 + 1325.552410 * $t);$l2=$l * 2;$ls=$p2 * self::frac(0.993133 + 99.997361 * $t);$d=$p2 * self::frac(0.827361 + 1236.853086 * $t);$d2=$d * 2;$f=$p2 * self::frac(0.259086 + 1342.227825 * $t);$f2=$f * 2;$sinls=sin($ls);$sinf2=sin($f2);$dl=22640 * sin($l);$dl+=-4586 * sin($l - $d2);$dl+=2370 * sin($d2);$dl+=769 * sin($l2);$dl+=-668 * $sinls;$dl+=-412 * $sinf2;$dl+=-212 * sin($l2 - $d2);$dl+=-206 * sin($l + $ls - $d2);$dl+=192 * sin($l + $d2);$dl+=-165 * sin($ls - $d2);$dl+=-125 * sin($d);$dl+=-110 * sin($l + $ls);$dl+=148 * sin($l - $ls);$dl+=-55 * sin($f2 - $d2);$s=$f +($dl + 412 * $sinf2 + 541 * $sinls)/ $arc;$h=$f - $d2;$n=-526 * sin($h);$n+=44 * sin($l + $h);$n+=-31 * sin(-$l + $h);$n+=-23 * sin($ls + $h);$n+=11 * sin(-$ls + $h);$n+=-25 * sin(-$l2 + $f);$n+=21 * sin(-$l + $f);$L_moon=$p2 * self::frac($lo + $dl / 1296000);$B_moon=(18520.0 * sin($s)+ $n)/ $arc;$cb=cos($B_moon);$x=$cb * cos($L_moon);$v=$cb * sin($L_moon);$w=sin($B_moon);$y=$coseps * $v - $sineps * $w;$z=$sineps * $v + $coseps * $w;$rho=sqrt(1 - $z * $z);$dec=(360 / $p2)* atan($z / $rho);$ra=(48 / $p2)* atan($y /($x + $rho));$ra=$ra<0?$ra + 24:$ra;return array($dec,$ra);}private static function frac($x){$x-=(int)$x;return $x<0?$x + 1:$x;}private static function modifiedJulianDate($months,$day,$year){if($months<=2){$months+=12;$year--;}$a=10000 * $year + 100 * $months + $day;$b=0;if($a<=15821004.1){$b=-2 *(int)(($year + 4716)/ 4)- 1179;}else{$b=(int)($year / 400)-(int)($year / 100)+(int)($year / 4);}$a=365 * $year - 679004;return $a + $b +(int)(30.6001 *($months + 1))+ $day;}private static function convertTime($hours){$hrs=(int)($hours * 60 + 0.5)/ 60.0;$h=(int)($hrs);$m=(int)(60 *($hrs - $h)+ 0.5);return array('hrs'=>$h,'min'=>$m);}}$Moon=Moon::calculateMoonTimes($months,$days,$years,$lat,$lon);$MoonRise=$Moon->moonrise;$MoonSet=$Moon->moonset;$MoonRise=date($MoonRise);$MoonSet=date($MoonSet);?>