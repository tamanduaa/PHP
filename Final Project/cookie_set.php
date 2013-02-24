<?
//setcookie (  $name, $value, $expire, $path, $domain, $secure);

setcookie('username','Bob',time()+3600, '/');
echo "user name is " .  $_COOKIE['username'];




?>