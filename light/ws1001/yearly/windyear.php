<?php
include_once('WUG-inc-year.php');	
echo '
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset='.$WUGcharset.'">
		<title>'.$WSTran.$TperYear.$year.' - '.$gSubtitle.'</title>	
		<script type="text/javascript" src="'.$jQueryFile.'"></script>
		<script type="text/javascript" src="'.$jsPath.'highcharts.js"></script>
		
		<!--[if IE]>
			<script type="text/javascript" src="'.$jsPath.'excanvas.compiled.js"></script>
		<![endif]-->
';
?>
		<script type="text/javascript">
<?php
echo $JSdata;
// wind direction
$mWindFile = $WUcacheDir.$WUID.'-month-wind-'.$year.$month.'.txt';
if (is_file($mWindFile)) {
  $dyWindOut = file_get_contents($mWindFile);
  echo 'var winddir =['.substr($dyWindOut,0,-1).'];';
}
if ($dataSource == 'mysql') {
  $dyWindOut = true;
  $WDirData = 'comArr(winddir)';
} else {
  $WDirData = 'winddir';
}
echo 'var Twindirs = new Array('.$TwindDir.');';
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
			     defaultSeriesType: '<?php echo $spline ?>',
			      margin: [50,30,60,60],  // top, right, bottom, left
                  padding: [0,0,0,0],  // top, right, bottom, left
                  width: [625],  // top, right, bottom, left
                   height: [370],  // top, right, bottom, left
                  zoomType: 'x' 
			   },
<?php 

echo '			   title: {
			      text: "'. $WSTran.$TperYear . $year.'"
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
			   yAxis: [{
			      title: {
              enabled: true,
			        text: '<?php echo $WSTran.' ( '.$TwindUnits.' )'; ?>'
			      },
            min: 0,
            labels: {
              formatter: function() {
                return this.value +'';
              }
            }
			  }
<?php
if ($dyWindOut) {
echo "         
         ,{ // wind dir
			      opposite: true,
            min: 0,
            max: 360,
            reversed: true,
			      title: {
			         text: '$windDirTran2'
			      }	   
         }
";
}
?>        
        ],
			   tooltip: {
			      formatter: function() {
			           var windunits = '<?php echo $TwindUnits; ?>';
			           // wind deg to word
                 var wword = '';
                 if(this.y > 348.75  || this.y <=  11.25) {wword = Twindirs[0];}
                 if(this.y > 11.25   && this.y <=  33.75) {wword = Twindirs[1];}
                 if(this.y > 33.75   && this.y <=  56.25) {wword = Twindirs[2];}
                 if(this.y > 56.25   && this.y <=  78.75) {wword = Twindirs[3];}
                 if(this.y > 78.75   && this.y <= 101.25) {wword = Twindirs[4];}
                 if(this.y > 101.25  && this.y <= 123.75) {wword = Twindirs[5];}
                 if(this.y > 123.75  && this.y <= 146.25) {wword = Twindirs[6];} 
                 if(this.y > 146.25  && this.y <= 168.75) {wword = Twindirs[7];} 
                 if(this.y > 168.75  && this.y <= 191.25) {wword = Twindirs[8];} 
                 if(this.y > 191.25  && this.y <= 213.75) {wword = Twindirs[9];} 
                 if(this.y > 213.75  && this.y <= 236.25) {wword = Twindirs[10];} 
                 if(this.y > 236.25  && this.y <= 258.75) {wword = Twindirs[11];} 
                 if(this.y > 258.75  && this.y <= 281.25) {wword = Twindirs[12];}                  
                 if(this.y > 281.25  && this.y <= 303.75) {wword = Twindirs[13];}
                 if(this.y > 303.75  && this.y <= 326.25) {wword = Twindirs[14];}
                 if(this.y > 326.25  && this.y <= 348.75) {wword = Twindirs[15];}  
                 // end deg to word
                 var degw = '';
			           if(this.series.name.search(/<?php echo $windDirTran; ?>/) != -1) {
                      var windunits = '<span style="font-size: 13pt;">°<\/span>';
                      var degw = wword+' - ';
                 }
  			                return '<b>'+ this.series.name +'<\/b><br\/><span style="font-size:11px;">'+ degw + this.y +'<\/span><b>'+windunits+'<\/b>'+'<br\/>'+ Highcharts.dateFormat('<?php echo $ttDateText[$ddFormat]; ?>', this.x);
			      }
			   },
         colors: [ '#f26c4f', '#66a1ba','#5f6061' ],
			   plotOptions: {
			      <?php echo $spline ?>: {
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
              lineWidth: 1
            }
			   },
			   series: [ 
          {
          name: '<?php echo $WSGust; ?>', 
          data: comArr(gustWS) 
          },{
			    name: '<?php echo $Tmax.mb_strtolower($WSTran); ?>',
			    data: comArr(maxWS)			
			    },{
			    name: '<?php echo $Tavg.mb_strtolower($WSTran); ?>',
			    data: comArr(avgWS)			
			   }
<?php
if ($dyWindOut) {
echo "          ,{
          name: '$windDirTran',
			    yAxis: 1,
			    type: '$spline',
			    visible: true,
			    data: $WDirData
			   }
";
}
?>         
         ]
			});
		});
		</script>
		

		<!-- 3. Add the container -->
<?php include_once('WUG-form.php')?>			
