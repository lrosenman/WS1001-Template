<?php
include_once('livedata.php');?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
  
<div class="tempcontainer1"><div class="circleOut">
  <span style="font-size:0px;">  
  <?php echo "Indoor \n"?>
<?php echo " ${indoorhumidity}%</span> \n";if($indoorhumidity>0){echo "<div class=\"\"></div><div class=\"temptext1\"> ${indoorhumidity}<suptemp1>%</suptemp1></div>";}
else if($indoorhumidity<50){echo "<div class=\"\"></div><div class=\"temptext1\"> ${indoorhumidity}<suptemp1>%</suptemp1></div>";}
?>    
 </div>
</div></div>