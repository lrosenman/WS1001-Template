<?php
/**
 * Project:   WU GRAPHS
 * Module:    lgen.php 
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


// GENERATE LANGLIST FOR WU GRAPHS

$lngfilename = './langlist.php';
  if (is_writable($lngfilename)) {
  $langOut = '<?php
  $langList = array(';
  foreach (glob('./WUG-language-*.php') as $LangFile) {     
    $shortLang = substr($LangFile, 15, -4);
    include($LangFile);
    $lName = mb_convert_encoding($languageName, "UTF-8" , "auto");
    //echo $shortLang.' => '.mb_detect_encoding($languageName).'<br>';
    $langOut .= '"'.$shortLang.'" => "'.$lName.'", ';
  }
  $langOut = substr($langOut,0,-1);
  $langOut .= ');
  ?>';
  $fo = fopen($lngfilename, "w");
  if (fwrite($fo, $langOut) === FALSE) {
    echo "Cannot write to file ($fo)";
    exit;
  } else {
    echo "Successfully generated file: langlist.php";
  }
  fclose($fo);
} else {
    echo "The file $lngfilename is not writable";
}

?>