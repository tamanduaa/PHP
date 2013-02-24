<?
//setcookie (  $name, $value, $expire, $path, $domain, $secure);

setcookie('username','Bob',time()-3600, '/','',1);
echo "cookie value is " .  $_COOKIE['username'];
?>