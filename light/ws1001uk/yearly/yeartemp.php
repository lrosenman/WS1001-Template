<?php 
include_once('WUG-inc-year.php');	
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$TempTran.$TperYear.$year.' - '.$gSubtitle.'</title>
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
';
?>
		<script type="text/javascript">
<?php echo $JSdata; ?>		
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
			       defaultSeriesType: '<?php echo $aspline ?>',
				   margin: [50,30,60,70],  // top, right, bottom, left
                  padding: [0,0,0,0],  // top, right, bottom, left
                  width: [625],  // top, right, bottom, left
                   height: [370],  // top, right, bottom, left
                  zoomType: 'x' 
			   },
<?php 
echo '			   title: {
			      text: "'. $TempTran.$TperYear . $year .'"
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
			         text: '<?php echo $TempTran.' ( '.$TtempUnits.' )' ;?>'
			      },
            labels: { formatter: function() { return this.value +'<?php echo $TtempUnits; ?>' } }
			      			   },

			     tooltip: {
  			      formatter: function() {
  			      var tdx = new Date(this.x);
              tdx = tdx.getDay()+'. '+tdx.getMonth()+'. '+tdx.getFullYear(); 
  			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:11px;">'+ this.y +'<?php echo $TtempUnits; ?><\/span>'+'<br\/>'+ Highcharts.dateFormat('<?php echo $ttDateText[$ddFormat]; ?>', this.x);
  			      }
			     },
         colors: [ '#df826b', '#66a1ba' ],

			   plotOptions: {
			      <?php echo $aspline ?>: {
			         lineWidth: 0,
			         marker: {
			           enabled: false,
  			         states: {
  			            hover: {
  	                  enabled: true,
  	                  symbol: 'circle',
  	                  radius: 5,
  	                  lineWidth: 0
  			            }
  			         }
			         }
			      }
			   },
			   series: [{
			      name: '<?php echo $Tmax.mb_strtolower($TempTran); ?>',
			      data: comArr(maxTemp)
            },{
            name: '<?php echo $Tmin.mb_strtolower($TempTran); ?>',
            data: comArr(minTemp)
            }]
			});	
		});
		</script>
		

		<!-- 3. Add the container -->
<?php include_once('WUG-form.php');?>		
				
