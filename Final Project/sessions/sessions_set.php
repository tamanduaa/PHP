<?
session_start();
$_SESSION['username'] = mysql_real_escape_string($_POST['user_name']);
echo "User name is " . $_SESSION['username'];
?>