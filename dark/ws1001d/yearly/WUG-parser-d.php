<?php
/**
 * Project:   WU GRAPHS
 * Module:    WUG-parser-d.php 
 * Copyright: (C) 2010 Radomir Luza
 * Email: luzar(a-t)post(d-o-t)cz
 * WeatherWeb: http://pocasi.hovnet.cz 
 */
################################################################################
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 3
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>. 
################################################################################
#
################################################################################
function parse_wu_day ($cachedData, $year, $month, $day, $forced = false) {
  global $emptyWUfile,$JSdata,$calcSolar,$calcWindDir,$calcMbaroAvg,$doCalc,$WUcacheDir,$rainMultip,$TZconf,$WUID,$calcAvgCond,$dsp,$cRow,$showSolar,$windcon;
  if ($forced) {$doCalc = true;}
  date_default_timezone_set('UTC'); // Set timezone offset to 0 - do not change wunderground time
  
  $handle = fopen($cachedData, "r");
  
  // empty file checker 
  if ($handle == '') { // empty file found  
      $emptyWUfile = true;
      @fclose($handle);  
  } else { // continue to data parsing
     while ($data = fgetcsv($handle, 1000, ",")) {
  // while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {      
      if($henk++ < 2) {
        continue;
      }     
      //hour
      $datum = substr($data[0], 11, 2);
      // minute
      $datum2 = substr($data[0], 14, 2);
      //day
      $datu = substr($data[0], 8, 2);
      //month
      $datu2 = substr($data[0], 5, 2);
      //year
      $datu3 = substr($data[0], 0, 4);
      // final date in js timestamp format (in miliseconds)
      $msdate = strtotime($datu.'-'.$datu2.'-'.$datu3.' '.$datum.':'.$datum2.':00' ) * 1000;
      
      if(!preg_match('/[0-9]+:[0-9]+/', $datum.':'.$datum2)) {
        continue;       
      }
      $cRow++; // row counter
      
      // Time,TemperatureC,DewpointC,PressurehPa,WindDirection,WindDirectionDegrees,WindSpeedKMH,WindSpeedGustKMH,Humidity,HourlyPrecipMM,Conditions,Clouds,dailyrainCM,SolarRadiationWatts/m^2,SoftwareType
      // Add to string
      $dTimeArray .= $msdate   .",";


      $TempCdiff = 2; // if is new temp value greather than [this value + last temp], last temp value will be used

      $dTemp1     .= $data[1]  .",";      
      $dDP        .= $data[2]  .",";
      $dBaro      .= $data[3]  .",";
      $dWindDir   .= $data[5] == "158" ? "159," : $data[5].",";
      $dAvgWS     .= round($data[6]*$windcon, 1).",";
      $dGustWS    .= round($data[7]*$windcon, 1).",";
      $dHum       .= $data[8]  .",";
      $dRainSpd   .= $data[9]  .",";        
      $dCond      .= "'".$data[10]."',";
      $dRainT     .= $data[12] .","; 
      if ($showSolar) {
        if ($data[13] == '') {
          $dSolar .= "0.0,";
        } elseif (strlen($data[13]) < 8) {
          $dSolar .= $data[13].",";        
        } else {
          $dSolar .= round($data[13], 2).",";
        }      
      } else { 
        $dSolar .= "0,";
      }   
    }
    
    //REPAIR STRINGS & REMOVE SPIKES    
    $baroSpike = $metric ? 1  : 33.86;
    $tempSpike = $metric ? 1  : 1.8 ;
    $rainSpike = $metric ? 1  : 2.54;
    $windSpike = $metric ? 1  : 0.6214;
        
    $dTimeArray   =          substr($dTimeArray, 0, -1);
    $dTemp        = rmSpike( substr($dTemp1,     0, -1), $dsp['temp']*$tempSpike );
    $dDP          = rmSpike( substr($dDP,        0, -1), $dsp['temp']*$tempSpike );
    $dBaro        = rmSpike( substr($dBaro,      0, -1), $dsp['baro']/$baroSpike );
    $dWindDir     =          substr($dWindDir,   0, -1);
    $dAvgWS       =          substr($dAvgWS,     0, -1);
    $dGustWS      =          substr($dGustWS,    0, -1); 
    $dHum         = rmSpike( substr($dHum,       0, -1), $dsp['humi'] );
    $dRainSpd     = rmSpike( substr($dRainSpd,   0, -1), $dsp['rain_rate']/$rainSpike);
    $dRainT       = rmSpike( substr($dRainT,     0, -1), $dsp['rain_total']/$rainSpike);
    $dCond        =          substr($dCond,     0, -1);
    $dSolar       =          substr($dSolar,     0, -1);
    
    $JSdata =
    '
    // PHP WU DATA STRINGS TO JS ARRAYS
    var dTemp    = ['.$dTemp   .'];
    var dDP      = ['.$dDP     .'];
    var dBaro    = ['.$dBaro   .'];
    var dWindDir = ['.$dWindDir.'];
    var dAvgWS   = ['.$dAvgWS  .'];
    var dGustWS  = ['.$dGustWS .'];
    var dHum     = ['.$dHum    .'];
    var dRainSpd = ['.$dRainSpd.'];
    var dRainT   = ['.$dRainT  .'];
    var dSolar   = ['.$dSolar  .'];
    var dCond    = ['.$dCond   .'];
    var timeArray = ['.$dTimeArray.']; 
    
    // Function for creating graph array
    function comArr(unitsArray) { 
        var outarr = [];
        for (var i = 0; i < timeArray.length; i++) {
         outarr[i] = [timeArray[i], unitsArray[i]];
        }
      return outarr;
    } 
     
    ';
    
    // Sun for months and years
    if ($calcSolar and $doCalc) {
      $mSolarFile = $WUcacheDir.$WUID.'-month-sun-'.$year.$month.'.txt'; // same must be in WUG-inc-month/year
      $ySolarFile= $WUcacheDir.$WUID.'-year-sun-'.$year.'.txt'; // same must be in graph(m/y)7a.php
      $arrSolar = explode(",",$dSolar);
      $dAvgSun = round(array_sum($arrSolar)/count($arrSolar), 1);
      $msSunTime = strtotime($year.'-'.$month.'-'.$day)*1000; // in ms
      // write month data
      $sDfile = fopen($mSolarFile, "a"); 
      fwrite($sDfile, '['.$msSunTime.', '.$dAvgSun.'],');
      fclose($sDfile);
      // write year data
      $sYfile = fopen($ySolarFile, "a"); 
      fwrite($sYfile, '['.$msSunTime.', '.$dAvgSun.'],');
      fclose($sYfile);          
    }
    
    // Wind direction for month and year
    if ($calcWindDir and $doCalc) {
      $mWindFile = $WUcacheDir.$WUID.'-month-wind-'.$year.$month.'.txt'; // same must be in WUG-inc-month/year
      $yWindFile = $WUcacheDir.$WUID.'-year-wind-'.$year.'.txt'; // same must be in graph(m/y).php
      $arrWindDir = explode(",",$dWindDir);
      $dAvgWind = round(array_sum($arrWindDir)/count($arrWindDir), 0);
      $msWindTime = strtotime($year.'-'.$month.'-'.$day)*1000; // in ms
      // write month data
      $wDfile = fopen($mWindFile, "a"); 
      fwrite($wDfile, '['.$msWindTime.', '.$dAvgWind.'],');
      fclose($wDfile);
      // write year data
      $wYfile = fopen($yWindFile, "a"); 
      fwrite($wYfile, '['.$msWindTime.', '.$dAvgWind.'],');
      fclose($wYfile);          
    }   
    
    // For average month baro
    if ($calcMbaroAvg and $doCalc) {
      $ambFile = $WUcacheDir.$WUID.'-month-ab-'.$year.$month.'.txt'; // same must be in WUG-inc-month.php
      $YambFile = $WUcacheDir.$WUID.'-year-ab-'.$year.'.txt';
      $arrBaro = explode(",",$dBaro);
      $dAvgBaro = round(array_sum($arrBaro)/count($arrBaro), 1);  // day average value
      $msBaroTime = strtotime($year.'-'.$month.'-'.$day)*1000; // in ms
      $BaroOut = '['.$msBaroTime.', '.$dAvgBaro.'],';
      // write month data
      $adbw = fopen($ambFile, "a");  
      fwrite($adbw, $BaroOut);
      fclose($adbw);
      // write year data
      $adbw = fopen($YambFile, "a");  
      fwrite($adbw, $BaroOut);
      fclose($adbw);        
    }
    
    // For average condition/clouds coverage
    /*
    if ($calcAvgCond and $doCalc) {
    // LEGEND: SKC | CLR  0/8 ;  FEW > 0 - 2/8 ; SCT 3/8 - 4/8 ; BKN 5/8 -<8/8 ; OVC 8/8 ; -RA | RA | +RA rain ; etc see -> http://www.unc.edu/~haines/metar.html
      $mCondFile = $WUcacheDir.$WUID.'-month-cond-'.$year.$month.'.txt'; 
    }
    */
    
    fclose($handle);
  }
  
  date_default_timezone_set($TZconf); // Back to configured timezone
}

// Remove spikes
function rmSpike ($data, $diff, $maxBadVal = 2) {
  global $removeSpikes;
  if ($removeSpikes) {
      $array = explode(",", $data);
      $c = 0;
      $Ncorr = 1; // after $maxBadVal times is bad value ignored, so $maxBadVal is maximum nr. of bad values 
      foreach ($array as $value) {
        if (!isset($lv1)) {
          $lv1 = $value;
          $c++;
          continue;
        } 
        if ( abs($value-$lv1) > $diff and $Ncorr <= $maxBadVal ) { //    
          $array[$c] = $lv1; // replaces the current value of the last one
          $Ncorr++;
        } else {
          $lv1 = $value;
          $Ncorr = 0;
        }
        $c++;
      }
      return implode(",",$array);
  } else {
    return $data;
  }
}

?>
