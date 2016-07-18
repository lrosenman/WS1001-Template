<?php
include_once('livedata.php');?>
<div class="updatedtime"><span>Updated</span> <?php 
 echo $update;
?>  </div> 
<div class="average"><span></span>
<?php
$sum_total = number_format($barometer - $trendbarometer,3 ); 
if ($sum_total>0)echo " +$sum_total <supmb>$pressureunit</supmb>";
else if ($sum_total<0)echo "$sum_total <supmb>$pressureunit</supmb>";
?></div>


         <div id="circularGaugeContainer" style="height:150px;"></div>
         <div class="barometertrend">
 <span style='font-size:0px;'>
<?php echo "${trendbarometer} </span>\n";
//echo $trendbarometer;
if ($barometer === $trendbarometer) {
    echo "<span style='color:#607d8b;'>trend
	<i class='wi wi-wind towards-90-deg'></i></span>
	<steady>steady</steady>";
}
 if ($barometer > $trendbarometer) {
    echo "<rising>rising</rising><span style='color:#607d8b;'>
	<i class='wi wi-wind towards-45-deg'></i>
	steadily</span>";
}

if($barometer < $trendbarometer) {
    echo "<falling>falling</falling><span style='color:#607d8b;'>
	<i class='wi wi-wind towards-225-deg'></i>
	steadily</span>";
}
 ?>
</div> 
 <div class="h2mbvalue"><?php echo "${barometer} <supunit>${pressureunit}</supunit>\n";?>
 
<script>
$("#circularGaugeContainer").dxCircularGauge({
  rangeContainer: { 
   width: 8,
    offset: -3,
    ranges: [
	 // { startValue: 960, endValue: 962, color: 'rgba(50,67,77,0.6)' },
     { startValue: 28, endValue:<?php print "${barometer}"?>,  color: 'rgba(242,108,79,0.8)'},
	 { startValue: <?php print "${barometer}"?> ,endValue: <?php print "${trendbarometer}"?>, color: 'rgba(102,161,186,1)' },
	 { startValue: <?php print "${trendbarometer}"?> ,endValue: <?php print "${barometer}"?>, color: 'rgba(102,161,186,1)' }
    ]
  },
  
  scale: {
    startValue:28,
	endValue:31,
    majorTick: { tickInterval: 0.5, visible: true, color: 'rgba(255,255,255,0.1)'},
	minorTick: {color: 'rgba(255,255,255,0.2)',visible: true,minorTickInterval: 0.25},
	label: {
	format: '',
	font:{size:10},
	
    }
  },
  
  valueIndicator: {
	    type: 'TriangleNeedle',
        color:'#999',
		secondColor:'#F26C4F',
		width:5,
		offset:-10,
		//secondFraction:15		
    },
	
	
	
	
  value: <?php print "${barometer}"?>,
  subvalues: <?php print "${trendbarometer}"?>,
    subvalueIndicator: {
        type: 'triangleMarker',
        color: 'rgba(255,255,255,0.6)',		
		space:0,length:12,width:8,offset:0,
    },
	  
});

</script>
