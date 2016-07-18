<?php 
include('WUG-inc-day.php');
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$windDirTran .' '.$dayDateText[$ddFormat].' - '.$gSubtitle.'</title>
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
      var contHeight = $('#container').height(); // for dynamic labels position
      var chart = new Highcharts.Chart({
			   chart: {
			      renderTo: 'container', 
			      defaultSeriesType: 'scatter',
			      zoomType: 'x'
			   },
<?php
echo $hchExport;
echo '			   title: {
			      text: "'.$windDirTran.$TperDay.' '.$dayDateText[$ddFormat].'"
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
			         text: '<?php echo $windDirTran2; ?>'
			      },
            reversed: true,
            max: 360,
            min: 0,
            endOnTick: false,            
            tickInterval:90,
            minorTickInterval:45,
            plotBands: [
            { // Noord
               from: 0,
               to: 45,
               color: 'rgba(68, 170, 213, .1)'
            }, { // Oost
               from: 46,
               to: 135,
               color: 'rgba(68, 170, 213, .3)'
            }, { // Zuid
               from: 136,
               to: 225,
               color: 'rgba(68, 170, 213, .5)'
            }, { // West
               from: 226,
               to: 315,
               color: 'rgba(68, 170, 213, .3)'
            }, { // Noord
               from: 316,
               to: 360,
               color: 'rgba(68, 170, 213, .1)'
            }]},
                        
         labels: {
              items: [{
                 html: '<b><?php echo $Tnorth; ?><\/b>',
                 style: {
                    left: '10px',
                    // for dynamic items text positioning
                    top: contHeight/1.446*Math.sqrt(contHeight/350)
                 }      
              }, {
                 html: '<b><?php echo $Twest; ?><\/b>',
                 style: {
                    left: '10px',
                    top: contHeight/1.82*Math.sqrt(contHeight/350)
                 }      
              }, {
                 html: '<b><?php echo $Tsouth; ?><\/b>',
                 style: {
                    left: '10px',
                    top: contHeight/2.76*Math.sqrt(contHeight/350)
                 }      
              }, {
                 html: '<b><?php echo $Teast; ?><\/b>',
                 style: {
                    left: '10px',
                    top: contHeight/6*Math.sqrt(contHeight/350)
                 }      
              }, {
                 html: '<b><?php echo $Tnorth; ?><\/b>',
                 style: {
                    left: '10px',
                    top: contHeight/38*Math.sqrt(contHeight/350)
                 }      
              }]
         },

			   tooltip: {
			      formatter: function() {
    			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:12pt;">'+ this.y +'°<\/span>'+'<br\/>['+Highcharts.dateFormat('<?php echo $hourFormText[$hourFormat]; ?>', this.x)+']';
			      }
			   },
			   legend: {
			      enabled: false,
			      layout: 'vertical',
			      style: {
			         left: '100px',
			         top: '70px',
			         bottom: 'auto'
			      },
			      backgroundColor: '#FFFFFF',
			      borderWidth: 1
			   },
			   plotOptions: {
			      scatter: {
			         marker: {
			            radius: 5
			         }
			      }
			   },
			   series: [{			     
			      name: '<?php echo $windDirTran; ?>',
			      color: 'rgba(223, 83, 83, .5)',
			      data: comArr(dWindDir)		
			   }]
			});					
		});
		</script>
		
		<!-- 3. Add the container -->
<?php include('WUG-form.php')?>