<?php
include_once('WUG-inc-year.php');	
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$PrecTran.$TperYear.$year.' - '.$gSubtitle.'</title>
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
		
		<!--[if IE]>
			<script type="text/javascript" src="'.$jsPath.'excanvas.compiled.js"></script>
		<![endif]-->
';
if (!function_exists('mb_strlen')) {
  function mb_strlen ($string) {
    return strlen($string);
  }
}

// Text for Precipitation Total
if (mb_strlen($PrecTran, 'UTF-8') > 6 && !$no_mb) {
  $sumRainText = mb_substr($PrecTran,0,6,'UTF-8').'. '.$Ttotal;
} else {
  $sumRainText = $PrecTran.' '.$Ttotal;
}
?>
		<script type="text/javascript">
<?php
echo $JSdata;
?>
    // block errors for flat line (no data)
    function stopError() {
      return true;
    }
    window.onerror = stopError;		

    tmonths = new Array(<?php echo $mnthOut; ?>) // month translation in tooltip		
		
		$(document).ready(function() {
<?php echo $langChart; ?>
      var chart = new Highcharts.Chart({
			   chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'column',
			     margin: [50,30,60,60],  // top, right, bottom, left
                  padding: [0,0,0,0],  // top, right, bottom, left
                  width: [625],  // top, right, bottom, left
                   height: [370],  // top, right, bottom, left
                  zoomType: 'x'
			   },
<?php 

echo '			   title: {
			      text: "'.$PrecTran.$TperYear. $year.'"
			   },
			   credits: {
			      enabled: '.$creditsEnabled.',
			      text: "'.$credits.'",
			      href: "'.$creditsURL.'"
			   },
			   subtitle: {
			      text: "'.$gSubtitle.'"
			   },
';
?>
			   xAxis: {
            categories: ['0', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tickInterval: 1, // instead categories use tickinterval 
            labels: {         
               align: 'center',
               style: {
                   font: 'normal 12px Helvetica, sans-serif'
               }
            }
         },
			   yAxis: [{
			      min: 0,
			      title: {
			         text: '<?php echo $PrecTran.' ( '.$TsizeUnits.' )'; ?>'
			      }
			   
         }],
			   legend: {
			      enabled: true
			   },
         tooltip: {
            formatter: function() {
                var sumtext = '<b>'+' <?php echo "rainfall"; ?><\/b><br\/>';
                if((this.series.name.search(/<?php echo 'rainfall'; ?>/)) != -1) {
                  var sumtext = '<b>'+tmonths[precipS]+'-'+tmonths[this.x-1]+'<\/b><br\/>';
                }
			          return sumtext + this.y + ' <?php echo $TsizeUnits; ?>';
			      }
			   },colors: [ '#66a1ba' ],
			        series: [{
			      name: '<?php echo $PrecTran; ?>',
			      data: precipC,
			      dataLabels: {
			         enabled: false,
			         rotation: 0,
			         color: '#66a1ba',
			         align: 'right',
			         x: 15,
			         y: 50,
			         formatter: function() {
			            return this.y;
			         },
			         style: {
			            font: 'normal 13px Verdana, sans-serif'
			         }
			      }         
			  
			   }]
			});		
		});
		</script>
		
		
		<!-- 3. Add the container -->
<?php include_once('WUG-form.php')?>