<?php
include_once('WUG-inc-year.php');	
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$HumTran.$TperYear.$year.' - '.$gSubtitle.'</title>	
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
		<script type="text/javascript" src="'.$jsPath.'exporting.js"></script>
		<!--[if IE]>
			<script type="text/javascript" src="'.$jsPath.'excanvas.compiled.js"></script>
		<![endif]-->
';
?>
		<script type="text/javascript">
<?php echo $JSdata; ?>		
		//block errors for flat line (no data)
    function stopError() {
    return true;
    }
    window.onerror = stopError;
		
		$(document).ready(function() {
<?php echo $langChart; ?>
      var chart = new Highcharts.Chart({
			   chart: {
			      renderTo: 'container',
			      defaultSeriesType: '<?php echo $spline ?>',
			      zoomType: 'x'
			   },
<?php 
echo $hchExport;
echo '			   title: {
			      text: "'. $HumTran.$TperYear . $year.'"
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
             type: 'datetime',
			       maxPadding: 0.005,
             minPadding: 0.005,
             maxZoom: <?php echo $maxZoomYear; ?> * 24 * 3600000
   },

			   yAxis: {
			      title: {
			         text: '<?php echo $HumTran.' '.$Tpercents; ?>'
			      },min: 0, max: 100,
labels: { formatter: function() { return this.value +'%' } }
			      			   },

			   tooltip: {
			      formatter: function() {
  			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:12pt;">'+ this.y +'%<\/span>'+'<br\/>'+ Highcharts.dateFormat('<?php echo $ttDateText[$ddFormat]; ?>', this.x);
			      }
			   },
        colors: [ '#AA4643', '#89A54E', '#4572A7','#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92' ],
			   plotOptions: {
			      <?php echo $spline ?>: {
			         lineWidth: 3,
			         marker: {
			           enabled: false,
    		         states: {
    		            hover: {
                      enabled: true,
                      symbol: 'circle',
                      radius: 5,
                      lineWidth: 1
    		            }
    		         }
			         }
			      }
			   },
			   series: [{
			      name: '<?php echo $Tmax.mb_strtolower($HumTran); ?>',
			      data: comArr(maxHum)			
			      },{
            name: '<?php echo $Tavg.mb_strtolower($HumTran); ?>',
            data: comArr(avgHum)
            },{
            name: '<?php echo $Tmin.mb_strtolower($HumTran); ?>',
            data: comArr(minHum)
            }]
			});
		});
		</script>
		

		<!-- 3. Add the container -->
<?php include_once('WUG-form.php')?>			
