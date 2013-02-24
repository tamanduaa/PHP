<?
session_start();

// remove a single session var
unset($_SESSION['username']);

// kill off all session dat
$_SESSION = array();
session_destroy();
setcookie('PHPSESSID', '', time()-300, '/', 0);



?>