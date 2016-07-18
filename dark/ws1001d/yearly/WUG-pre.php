<?php
/**
 * Project:   WU GRAPHS
 * Module:    WUG-pre.php 
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

// PRECACHING
require_once('WUG-parser-d.php'); // for calculation a creation Average baro, solar and wind cache files
if ($precache and !isset($copied)) { // $copied mean don't create if is active request to wundergroud server from wug-inc-day  
  ## create cache subdirectories
  $sYear = date('Y');
  if (!is_dir($WUcacheDir."/".$sinceY.'-'.zero_bd($sinceM))) {// create subdir at once
    $maxPre = $maxPre >= 5 ? 5 : $maxPre; //years backward
    $maxPre = date('Y')-$maxPre >= $sinceY ? $sinceY : date('Y')-$maxPre; // Stop Year
    while ($sYear >= $maxPre) { //actual year is bigger than stop year
      $gm = $sYear == $sinceY ? $sinceM : 1; // change month counting for station since/start date 
      while ($gm <= 12) {
        $gm2 = zero_bd($gm);
        if (!is_dir($WUcacheDir."/".$sYear.'-'.$gm2) and $sYear.$gm2 <= date('Y').date('m') ) {
          mkdir($WUcacheDir."/".$sYear.'-'.$gm2);
        }    
        $gm++;
      }
      $sYear--;
    }
  }
  $cpEnd = true; // create only one cache file in graphs pages
  $stopNr = $cronFiles <= 3 ? $cronFiles : 3; // maximum cache files per request
  ## get months directories
  foreach (array_reverse(glob( substr($WUcacheDir,0,-1).'/*',GLOB_ONLYDIR)) as $dirCont) {
     $cMnth = substr(substr($dirCont,-7), -2); //get month date from directory name
     $cYear = substr(substr($dirCont,-7), 0, 4); //get year ddate from dir name 
     if ($cYear.$cMnth == date('Y').date('m')) { // don't create future cache files
      $chckMdays = date('j')-1; // maximal nr. of days in month
      $uncompMonth = true; // flag for uncomplete month
     } else {
      //$chckMdays = $cMnth == 2 ? ($cYear  % 4 ? 28 : ($cYear  % 100 ? 29 : ($cYear  % 400 ? 28 : 29))) : (($cMnth - 1) % 7 % 2 ? 30 : 31)-1;
      $chckMdays = date('t',strtotime($cYear.'-'.$cMnth.'-01'))-1;
      //echo $chckMdays.' '.$cMnth.'-'.$cYear.'<br>';
      $uncompMonth = false;
     }
     $cDay = 0;
     $skipMonth = is_file($dirCont."/".$WUID."-completed.txt") || $cYear.$cMnth == date('Ym') ? false : true; // skip flag for completed month or for actual month
     ## find and create uncached files
     $pause = $_GET['pg'] == "1" ? $pause : 480; // switch pause time, 'pg=1' is from graphs page
     $pause = $pause <= 120 ? 120 : $pause; // pause time
     while ($cDay <= $chckMdays and $cpEnd and $sbl < $stopNr and $skipMonth) {  //$sbl is created cache files counter
       $cDay++;
       // echo $dirCont.'/day-'.$cYear.$cMnth.zero_bd($cDay).'.txt';
       if (!is_file($dirCont.'/'.$WUID.'-day-'.$cYear.$cMnth.zero_bd($cDay).'.txt')) { // create and parse or skip if cache file exists
          if (time()-@filemtime($dirCont.'/'.$WUID.'-day-'.$cYear.$cMnth.zero_bd($cDay-1).'.txt') < $pause and $cron and !isset($tloop) and $cDay-1 != 0) {
            exit("Error: This page can be reloaded only once every ".($pause/60).".minutes.");
          }
          $tloop = false;
          $unitsLnk =  $metric ? 'metric' : 'english';
          $WUsourceFile2 = 'http://www.wunderground.com/weatherstation/WXDailyHistory.asp?ID='.$WUID.'&graphspan=day&day='.zero_bd($cDay).'&year='.$cYear.'&month='.$cMnth.'&format=1&units='.$unitsLnk;
          $WUcacheFile2 = $dirCont.'/'.$WUID.'-day-'.$cYear.$cMnth.zero_bd($cDay).'.txt';
          ## cache file creation
          $opts = array( 
              'http' => array( 
                  'method' => 'GET', 
                  'header' => 'Cookie: Units='.$unitsLnk 
              ) 
          );  
          $context = stream_context_create($opts); // context HEADER with cookie for changing units 
          if ($fopenOff) {
            include('./fopener.php');
            $read = new HTTPRequest($WUsourceFile2);
            $wsource2 = $read->DownloadToString(); 
          } else {
            $wsource2 = file_get_contents($WUsourceFile2, 0, $context);  
          }
          $ctarget2 = fopen($WUcacheFile2, "w");
          fwrite($ctarget2, $wsource2);
          fclose($ctarget2);
          parse_wu_day($WUcacheFile2,$cYear,$cMnth,zero_bd($cDay),true); // for calculation a creation Average baro, solar and wind cache files
          $cpEnd = $cron ? true : false; // at once in WU pages and more steps in cron mode given by $cronFiles in WU-precache.php
          $sbl++;
          //echo '<br>copied<br>';
          continue;        
       } else {
        $fileExists++;
       }
       // create flag file for completed month
       if ($fileExists == $chckMdays+1 and !$uncompMonth) {
         $comfil = fopen ($dirCont."/".$WUID."-completed.txt", "w");
         fwrite($comfil, "This month is completely cached.");
         fclose($comfil);
       }     
     }
    unset($fileExists);
    if (!$cpEnd or $sbl >= $stopNr) {break;} // break whole sequence if all needed cached files are created
  }  
}
function zero_bd ($value) {
  if ($value <= 9) {
    return "0".$value;
  } else {
    return $value;
  }
}
?>