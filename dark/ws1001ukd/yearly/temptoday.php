<?php 
include('WUG-inc-day.php');
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
    <!-- compat. mode for highcharts bug in IE8 + WinXP + Highcharts 2.0 -->
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$TempTran .' '.$dayDateText[$ddFormat].' - '.$gSubtitle.'</title>
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
   
		
';
?>		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
<?php
echo $JSdata;
?>		
		// block errors for flat line (no data)
    function stopError() {
      return true;
    }
    window.onerror = stopError;
		
		$(document).ready(function() {
<?php echo $langChart; ?>
      var chart = new Highcharts.Chart({
			   chart: {
			      renderTo: 'container',
			      defaultSeriesType: 'area',
			      margin: [50,30,80,60],  // top, right, bottom, left
				  padding: [0,0,0,0],  // top, right, bottom, left
				  width: [625],  // top, right, bottom, left
				   height: [370],  // top, right, bottom, left
				  zoomType: 'x'	  
			   },
<?php 
echo '			   title: {
			      text: "'.$TempTran .' '.$dayDateText[$ddFormat].'"
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
			      startOnTick: false,
			      maxPadding: 0.006,
			      maxZoom: <?php echo $maxZoomDay; ?>*1000
			   },
			   yAxis: {
			      title: {
			         text: '<?php echo $TempTran.' ( '.$TtempUnits.' )'; ?>'
			      },
labels: { formatter: function() { return this.value +'°' } }
			      			   },
			   tooltip: {
			      formatter: function() {
			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:10px;border:0px;font-family:Helvetica;color:#384244;">'+ this.y +'<?php echo $TtempUnits; ?><\/span>'+
                      '<br\/>Time: ['+Highcharts.dateFormat('<?php echo $hourFormText[$hourFormat]; ?>', this.x)+']'
;
			      }
			   },
        colors: [ '#f26c4f','#66a1ba' ],

			   plotOptions: {
			      area: {
			         lineWidth: 0,
					 threshold: 0,
        negativeColor: '#66a1ba',
			         marker: {
			            enabled: false
			         },
			         pointInterval: 300000, // one hour
			         
			         
			         states: {
			            hover: {
			               marker: {
			                  enabled: false,
			                  symbol: 'circle',
			                  radius: 0,
			                  lineWidth: 1
			               }
			            }
			         }
			      }
			   },
			         
  			 series: [{
  			  name: '<?php echo $TempTran; ?>',
  			  data: comArr(dTemp)  			
  			  }]


			});	
		});
		</script>

<?php include('WUG-form.php')?>
