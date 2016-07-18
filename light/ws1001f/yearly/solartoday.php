<?php 
include('WUG-inc-day.php');
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$SunTran .' '.$dayDateText[$ddFormat].' - '.$gSubtitle.'</title>
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
		
		<!--[if IE]>
			<script type="text/javascript" src="'.$jsPath.'excanvas.compiled.js"></script>
		<![endif]-->
';
?>
		<script type="text/javascript">
<?php echo $JSdata; ?>			
// Function for creating icons array
function comArrIco(unitsArray) { 
    var outarr = [];
    for (var i = 0; i < timeArray.length; i++) {
     outarr[timeArray[i]] = unitsArray[i];
    }
  return outarr;
} 
var vico = comArrIco(dCond);
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
                  zoomType: 'x' ,
			      showAxes: false // show axes if series is not set
			   },
<?php 

echo '			   title: {
			      text: "'.$SunTran2.$TperDay.' '.$dayDateText[$ddFormat].'"
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
			   yAxis: [{
			      title: {
enabled: true,
			         text: '<?php echo $SunTran2.' ( '.$TsunUnits.' )'; ?>'
			      },
            min: 0,
            labels: { 
              formatter: function() { return this.value +''; }
            }
			  }
<?php       
if ($dataSource == 'mysql' && $db_suv) {
  echo '
  ,{ // UV
    opposite: true,
    min: 0,
    title: {
       text: "'.$TuvInd.'"
    }        
  }';
}
?>
        ],
			   tooltip: {
			      formatter: function() {
              if(this.series.name.search(/<?php echo $TuvInd; ?>/) != -1) {
                  sununits = ' ';
                  ttname = '<?php echo $TuvInd; ?>';
              } else {
                  sununits = '<?php echo $TsunUnits; ?>';
                  ttname = '<?php echo $SunTran2; ?>';
              }
			        return '<b>'+ ttname +'<\/b><br\/><span style="font-size:11px;">'+ this.y + sununits +'<\/span>'+'<br\/>Time: ['+Highcharts.dateFormat('<?php echo $hourFormText[$hourFormat]; ?>', this.x)+']'+
                      // UNCOMPLETED - I must find some small transparent 
                      //'<br\/><img src="./images/weather_icons/'+vico[this.x]+'.png" alt="condition" \/>'
                      '<br\/>'+vico[this.x] // text alternative without icon
;
			      }
			   },
          colors: [ '#f26c4f', '#66a1ba' ],
			   plotOptions: {
			      <?php echo $aspline ?>: {
			         pointInterval: 300000, // 5 minutes
               marker: {
			           enabled: false,
  			         states: {
  			            hover: {
            			      fillColor: '#66a1ba',
                        enabled: true,
                        symbol: 'circle',
                        radius: 5
  			            }
  			         }
			         }
			      },
            <?php echo $spline ?>: {
              marker: {
                enabled: false,
                states: {
                  hover: {
                    enabled: true,
                    radius: 5
                  }
                },
                symbol: 'circle',
                radius: 3
              },
              lineWidth: 2
            }			      
			   },
			   series: [{
			      name: '<?php echo 'Solar Radiation'; ?>',
			      yAxis: 0,
            data: 
<?php 
if ($parseCond) {
  echo "[".substr($dSolarC,0,-1)."]";
}
else {
  echo 'comArr(dSolar)'; 
}
if ($dataSource == 'mysql' && $db_suv) {
  echo '},{
  name: "'.$TuvInd.'",
  yAxis: 1,
  type: "'.$aspline.'",
  fillColor: {
      linearGradient: [0, 0, 0, 350],
      stops: [
          [0, "rgb(129, 85, 255)"],
          [1, "rgba(2,0,0,0)"]
      ]
  },
  data: comArr(dUV)
  ';
}
?> 			
			   }]
			});
		});
		</script>
		
		<!-- 3. Add the container -->

<?php include('WUG-form.php')?>