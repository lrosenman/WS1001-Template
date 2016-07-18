<!--- cron job files are a essential part of this home weather simplicity template without them set 
up correctly the template will always use sample data suppied 
you do not need to edit anything below for the template to work properly

RUN THIS EVERY 2 HOURS OR 3 HOURS ETC 

brian underdown March 2016 http://idesign34.com --->


<?php
include_once('../settings.php');
?>

<?php
//homeweather station trend data//
$json = file_get_contents($livedata);
$data = json_decode($json,true);
file_put_contents('../jsondata/max.json',json_encode($data));
?>





