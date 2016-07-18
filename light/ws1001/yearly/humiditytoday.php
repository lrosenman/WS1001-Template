<?php 
include('WUG-inc-day.php');
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$HumTran .' '.$dayDateText[$ddFormat].' - '.$gSubtitle.'</title>
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
			      defaultSeriesType: '<?php echo $aspline ?>',
			      zoomType: 'x'
			   },
<?php 
echo $hchExport;
echo '			   title: {
			      text: "'.$HumTran.$TperDay.' '.$dayDateText[$ddFormat].'"
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
              enabled: true,
			        text: '<?php echo $HumTran.' '.$Tpercents; ?>'
			      },			      
            max: 100,
            min: 0,
            labels: {
              formatter: function() {
              return this.value +'%';
              }
            }
			   },
			   tooltip: {
			      formatter: function() {
			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:12pt;">'+ this.y +'%<\/span>'+
                      '<br\/>['+Highcharts.dateFormat('<?php echo $hourFormText[$hourFormat]; ?>', this.x)+']'
;
			      }
			   },
colors: [ '#3D96AE', '#4572A7', '#AA4643', '#89A54E', '#80699B',  '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92' ],
			   plotOptions: {
			      <?php echo $aspline ?>: {
			         marker: {
			           enabled: false,
  			         states: {
  			            hover: {
  			              enabled: true,                    
                      symbol: 'circle',
                      radius: 5
  			            }
  			         }
			         },
			         lineWidth: 3
			      }
			   },
			   series: [{
			      name: '<?php echo $HumTran; ?>',
			      data: comArr(dHum)			
			   }]
			});		
		});
		</script>


		<!-- 3. Add the container -->
<?php include('WUG-form.php')?>				
