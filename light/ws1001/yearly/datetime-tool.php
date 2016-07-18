<?php

session_start();

$pages = $_REQUEST['pg'];

if ($pages == 'home1') {
  $_SESSION['host'] = $_REQUEST['host'];
  $_SESSION['user'] = $_REQUEST['user'];
  $_SESSION['pass'] = $_REQUEST['pass'];
  $_SESSION['name'] = $_REQUEST['name'];
  $_SESSION['table'] = $_REQUEST['table'];
}
$dbShost = $_SESSION['host'];
$dbSuser = $_SESSION['user'];
$dbSpass = $_SESSION['pass'];
$dbSname = $_SESSION['name'];
$dbStable = $_SESSION['table'];

// CONNECT TO DB
mysql_connect($dbShost, $dbSuser, $dbSpass) or die("Unable to connect mysql");
mysql_select_db($dbSname) or die("Unable to select database");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>DATETIME TOOL</title>
  <style type="text/css">
    .under {font-size:115%; text-decoration:underline;}
  </style>
  </head>
  <body>
<?php
if ($pages == 'home1' || $pages == 'home') {
  // SEARCH FOR SUPER PRIVILEGE
  $query = "SELECT * FROM `information_schema`.`USER_PRIVILEGES` WHERE GRANTEE REGEXP '.*$dbSuser.*' AND PRIVILEGE_TYPE='SUPER'";
  $result = mysql_query($query);
  $rarray = mysql_fetch_array($result);
  $superpriv = NULL == $rarray[0] ? false : true; 
  // SEARCH FOR TRIGGER PRIVILEGE (MySQL 5.1.6 implements the TRIGGER privilege)
  $query = mysql_query("select version() as ve");
  $result = mysql_fetch_object($query);
  $mver = $r->ve;
  if (version_compare($mver, '5.1.6', '<')) {
    $triggerpriv = false;
    $verLow = true; 
  } else {
    $query = "SELECT * FROM `information_schema`.`USER_PRIVILEGES` WHERE GRANTEE REGEXP '.*$dbSuser.*' AND PRIVILEGE_TYPE='TRIGGER'";
    $result = mysql_query($query); 
    $rarray = mysql_fetch_array($result);
    $triggerpriv = NULL == $rarray[0] ? false : true;
    $verLow = false;
  }
?>
    <h2>DATETIME TOOL for WU Graphs</h2>
    <div class="under">INSTALATION PROCEDURE</div>
      <dl>
        <dt><b>Method A) Use "WD MySQL" program</b><br>Require WDMYSQL version 8.9 or higher (<a href="./images/wdmysql-datetime.jpg" target="_blank">where I find version number?</a>)</dt>
        <dd>
          <ol>
            <li>Configure WD MySQL for use a "datetime" column as is shown in image below.<br><a href="./images/wdmysql-datetime.jpg" target="_blank"><img src="./images/wdmysql-datetime.jpg" width="200"></a>
            <li>Add necessary columns to database table and fill "datetime" values for older dates.<br><a href="<?php echo $_SERVER['PHP_SELF'].'?pg=wdcon'; ?>">CLICK HERE</a> to start the conversion.
          </ol>
        </dd>
        <br>
        <dt><b>Method B) Use MySQL TRIGGER function</b><br>Require SQL user with SUPER or TRIGGER privilege.</dt>
        <dd>
          <ol>
            <li>Add column "datetime" to database.
            <li>Add MySQL TRIGGER to database.
            <li>Fill "datetime" values for older dates.
          </ol>
<?php
  if ($superpriv || $triggerpriv){
    echo '<a href="'.$_SERVER['PHP_SELF'].'?pg=addDatetime">CLICK HERE</a> to start this procedure".';
  } else {
    echo '<br><span style="color:red;">Sorry, you don\'t have privileges to create MySQL TRIGGER.</span>';
    if (!$verLow) {
      echo ' But you can try to ask you webhosting provider to grant TRIGGER privilege for your MySQL account.';
    }
  }
?>        
        </dd>         
        <br><br>
        <dt><div style="font-size:120%;"><b>Return back changes made to the database</b></div></dt>
        <dd>
          <a href="<?php echo $_SERVER['PHP_SELF'].'?pg=undo'; ?>">CLICK HERE</a> for undo changes made by this program.
        </dd>
<?php
}
$backText = '<br><br><a href="'.$_SERVER['PHP_SELF'].'?pg=home">BACK</a> to index of this script.';
if ($pages == 'wdcon') {
  echo '<div class="under">Converting database</div><br><div>Please wait...</div>';
  flush();
  // Add new column "datetime" and set INDEX + add new column 'year'
  // add year
  $query = ("SHOW COLUMNS ".
            "FROM $dbStable ".
            "LIKE 'year'");
  $result = mysql_query($query) or die("Select table $dbStable "."in function addColumnIfItDoesNotExist() not successful: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  if (NULL == $rarray[0]) {
    $query = ("ALTER TABLE $dbStable ".
              "ADD COLUMN year SMALLINT(20) NOT NULL ".
              "AFTER month;");
    $result = mysql_query($query) or die("Altering table $dbStable not successful: ".mysql_error().$backText);
  }
  // add datetime + index
  $query = ("SHOW COLUMNS ".
            "FROM $dbStable ".
            "LIKE 'datetime'");
  $result = mysql_query($query) or die("Select table $dbStable "."in function addColumnIfItDoesNotExist() not successful: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  if (NULL == $rarray[0]) {
    $query = ("ALTER TABLE $dbStable ".
              "ADD COLUMN datetime VARCHAR(20) NOT NULL ".
              "AFTER year;");
    $result = mysql_query($query) or die("altering table $dbStable not successful: ".mysql_error().$backText);
    $query = ("ALTER TABLE `$dbStable` ADD INDEX ( `datetime` );");      
    $result = mysql_query($query) or die("altering table $dbStable not successful: ".mysql_error().$backText);
  }
  
  // CONVERT DB - FILL DATETIME COLUMN
  $query = "UPDATE `$dbSname`.`$dbStable` SET datetime=CONCAT(date,' ',time)";
  mysql_query($query) or die("MySQL Error: ".mysql_error().$backText);  
  
  // CONVERT DB - FILL YEAR COLUMN
  //$query = "UPDATE `$dbSname`.`$dbStable` SET year=DATE_FORMAT(CONCAT(date,' ',time),'%Y')";
  //mysql_query($query) or die("MySQL Error: ".mysql_error());
  
  echo '<div style="font-weight:bold; color: green;">DONE</div><div>Now you can close this window and save configuration in WU Graphs Configurator.</div>';
}
if ($pages == 'addDatetime') {
  echo '<div class="under">Adding datetime column</div><br><div>Please wait...</div>';
  flush();
  // add datetime + index
  $query = ("SHOW COLUMNS ".
            "FROM $dbStable ".
            "LIKE 'datetime'");
  $result = mysql_query($query) or die("select table $dbStable "."in function addColumnIfItDoesNotExist() not successful: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  if (NULL == $rarray[0]) {
    $query = ("ALTER TABLE $dbStable ".
              "ADD COLUMN datetime VARCHAR(20) NOT NULL");
    $result = mysql_query($query) or die("altering table $dbStable not successful: ".mysql_error().$backText);
    $query = ("ALTER TABLE `$dbStable` ADD INDEX ( `datetime` );");      
    $result = mysql_query($query) or die("altering table $dbStable not successful: ".mysql_error().$backText);
  }
  echo '<div style="font-weight:bold; color: green;">DONE</div><br><div><a href="'.$_SERVER['PHP_SELF'].'?pg=addTrigger">NEXT STEP</a> (add MySQL trigger)</div>';
}
if ($pages == 'addTrigger') {
  echo '<div class="under">Adding MySQL TRIGGER</div><br><div>Please wait...</div>';
  flush();
  // SEARCH FOR SUPER PRIVILEGE
  $query = "SELECT * FROM `information_schema`.`USER_PRIVILEGES` WHERE GRANTEE REGEXP '.*$dbSuser.*' AND PRIVILEGE_TYPE='SUPER'";
  $result = mysql_query($query) or die("MySQL Error: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  $superpriv = NULL == $rarray[0] ? false : true;
  
  // SEARCH FOR TRIGGER PRIVILEGE (MySQL 5.1.6 implements the TRIGGER privilege)
  $query = mysql_query("select version() as ve") or die("MySQL Error: ".mysql_error().$backText);
  $result = mysql_fetch_object($query);
  $mver = $r->ve;
  if (version_compare($mver, '5.1.6', '<')) {
    $triggerpriv = false; 
  } else {
    $query = "SELECT * FROM `information_schema`.`USER_PRIVILEGES` WHERE GRANTEE REGEXP '.*$dbSuser.*' AND PRIVILEGE_TYPE='TRIGGER'";
    $result = mysql_query($query) or die("MySQL Error: ".mysql_error().$backText); 
    $rarray = mysql_fetch_array($result);
    $triggerpriv = NULL == $rarray[0] ? false : true;
  }
  
  // Set SQL TRIGGER
  if ($superpriv || $triggerpriv){
    $query = "SELECT * FROM `information_schema`.`TRIGGERS` WHERE TRIGGER_NAME='wugtrigger' AND TRIGGER_SCHEMA='$dbSname' AND EVENT_OBJECT_TABLE='$dbStable'";
    $result = mysql_query($query) or die("MySQL Error: ".mysql_error().$backText); 
    if (mysql_num_rows($result) != 0) {
      $dbSc = new mysqli($dbShost, $dbSuser, $dbSpass, $dbSname); 
      $trigger = "CREATE TRIGGER wugtrigger BEFORE INSERT ON $dbStable 
      FOR EACH ROW 
      BEGIN 
      SET NEW.DATETIME=CONCAT(NEW.date,' ',NEW.time);
      END; 
      "; 
      $dbSc->multi_query($trigger);
      echo '<div style="font-weight:bold; color: green;">DONE</div><br><div><a href="'.$_SERVER['PHP_SELF'].'?pg=recalculate">NEXT STEP</a> (fill datetime column)</div>';
    } else {
      echo 'trigger already exists';
    }
  } else {
    echo "Sorry, you don't have privileges to create MySQL TRIGGER.";
  }
}
if ($pages == 'recalculate') {
  echo '<div class="under">Filling datetime column</div><br><div>Please wait...</div>';
  flush();
  // CONVERT DB - FILL DATETIME COLUMN
  $query = "UPDATE `$dbSname`.`$dbStable` SET datetime=CONCAT(date,' ',time)";
  mysql_query($query) or die("MySQL Error: ".mysql_error().$backText);
  echo '<div style="font-weight:bold; color: green;">DONE</div><br><div>Now you can close this window and save configuration in WU Graphs Configurator.</div>';  
}
if ($pages == 'undo') {
  echo '<div class="under">Returning back changes made to database</div><br><div>Please wait...</div>';
  flush();
  // REMOVE TRIGGER
  $query = "SELECT * FROM `information_schema`.`TRIGGERS` WHERE TRIGGER_NAME='wugtrigger' AND TRIGGER_SCHEMA='$dbSname' AND EVENT_OBJECT_TABLE='$dbStable'";
  $result = mysql_query($query) or die("MySQL Error: ".mysql_error().$backText); 
  if (mysql_num_rows($result) != 0) {
    $query = ("DROP TRIGGER `wugtrigger`");
    $result = mysql_query($query) or die("Removing trigger 'wugtrigger' in table '$dbStable' not successful: ".mysql_error().$backText);
    echo 'Trigger removed.<br>';
  }

  // remove year column
  $query = ("SHOW COLUMNS ".
            "FROM $dbStable ".
            "LIKE 'year'");
  $result = mysql_query($query) or die("Select table $dbStable "."in function addColumnIfItDoesNotExist() not successful: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  if (NULL != $rarray[0]) {
    $query = ("ALTER TABLE `$dbStable` DROP `year`");
    $result = mysql_query($query) or die("Removing column datetime in table '$dbStable' not successful: ".mysql_error().$backText);
    echo 'Column "year" removed.<br>';
  }

  // remove datetime
  $query = ("SHOW COLUMNS ".
            "FROM $dbStable ".
            "LIKE 'datetime'");
  $result = mysql_query($query) or die("Select table $dbStable "."in function addColumnIfItDoesNotExist() not successful: ".mysql_error().$backText);
  $rarray = mysql_fetch_array($result);
  if (NULL != $rarray[0]) {
    $query = ("ALTER TABLE `$dbStable` DROP `datetime`");
    $result = mysql_query($query) or die("Removing column datetime in table '$dbStable' not successful: ".mysql_error().$backText);
    echo 'Column "datetime" removed<br>';
  }
  echo '<div style="font-weight:bold; color: green;">DONE</div><br><div>Now you can close this window and save configuration in WU Graphs Configurator.</div>';  
}
?>
  </body>
</html>



<?php
// for security remove session config
if ($pages == 'undo' || $pages == 'wdcon' || $pages == 'recalculate') {
  $_SESSION['host'] = '';
  $_SESSION['user'] = '';
  $_SESSION['pass'] = '';
  $_SESSION['name'] = '';
  $_SESSION['table'] = '';
}


/*
// CONVERT DB - FILL DATETIME COLUMN
$query = "UPDATE `$dbSname`.`$dbStable` SET datetime=CONCAT(date,' ',time)";
//$query = "UPDATE `$dbSname`.`$dbStable` SET datetime=DATE_FORMAT(CONCAT(date,' ',time),'%Y%m%d%H%i%S')";
//$query = "UPDATE `$dbSname`.`$dbStable` SET datetime=DATE_FORMAT(CONCAT(date,' ',time),'%Y-%m-%d %H:%i:%S')";
mysql_query($query) or die("MySQL Error: ".mysql_error());

// CONVERT DB - FILL YEAR COLUMN
$query = "UPDATE `$dbSname`.`$dbStable` SET year=DATE_FORMAT(CONCAT(date,' ',time),'%Y')";
//$query = "UPDATE `$dbSname`.`$dbStable` SET datetime=DATE_FORMAT(CONCAT(date,' ',time),'%Y-%m-%d %H:%i:%S')";
mysql_query($query) or die("MySQL Error: ".mysql_error());
*/


?>
