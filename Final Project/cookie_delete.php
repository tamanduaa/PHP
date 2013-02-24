<?
setcookie("username", "", time()-3600);

echo "cooke value is " . $_COOKIE['username'];
?>