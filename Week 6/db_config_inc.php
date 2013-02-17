<?php
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
   error_reporting(E_ALL);
   $host = '';
   $dbuser = '';
   $dbpass = '';
   $dbname = '';
   $table = 'userauth';
   $db = mysql_connect($host,$dbuser,$dbpass,true) or die("error=could not connect to db $host");
   $db = mysql_select_db($dbname);
   if(!$db)
   {
      print "error=no table connect to $dbname table";
      exit;
   }
?>