<?php 
include('WUG-inc-day.php');
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$WSTran .' '.$dayDateText[$ddFormat].' - '.$gSubtitle.'</title>
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
				<!--[if IE]>
			<script type="text/javascript" src="'.$jsPath.'excanvas.compiled.js"></script>
		<![endif]-->
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
			       margin: [50,30,60,60],  // top, right, bottom, left
                  padding: [0,0,0,0],  // top, right, bottom, left
                  width: [625],  // top, right, bottom, left
                   height: [370],  // top, right, bottom, left
                  zoomType: 'x'       
			   },
<?php 
echo '			   title: {
			      text: "'.$WSTran.$TperDay.' '.$dayDateText[$ddFormat].'"
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
			         text: '<?php echo $WSTran.' ( '.$TwindUnits.' )'; ?>'
			      },
            min: 0,
            labels: { formatter: function() {return this.value +''; } }
			   },
			   tooltip: {
			      formatter: function() {
			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:11px;">'+ this.y +'<?php echo $TwindUnits; ?><\/span>'+
                      '<br\/>Time: ['+Highcharts.dateFormat('<?php echo $hourFormText[$hourFormat]; ?>', this.x)+']'
;
			      }
			   },
       colors: [ '#df826b', '#66a1ba' ],
			   plotOptions: {
			      <?php echo $aspline ?>: {
			         pointInterval: 300000, // 5 minutes			         		         
			         marker: {
			           enabled: false,
                 states: {
  			            hover: {	
                      enabled: true,
                      symbol: 'circle',
                      radius: 5
  			            }
  			         }
               }
			      }
			   },
			   series: [ 
          {
          name: '<?php echo $WSGust; ?>', 
          data: comArr(dGustWS)
          },{
			      name: '<?php echo $Tavg.mb_strtolower($WSTran); ?>',
			      data: comArr(dAvgWS)			
          }]
			});
		});
		</script>
		

		<!-- 3. Add the container -->
<?php include('WUG-form.php')?>				
