<?
ob_start();
require_once('db_config_inc.php');
//require_once('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $page_title; ?></title>
	 <style type="text/css" media="all">@import "css/css.css";</style>
</head>
<body>
<div id="wrapper">
	<p>Hello, <? echo $_SESSION['username'] ?>!</p>
<div id="menu">
	<ul>
		<li class="first"><a href="index.php">Home</a></li>
		<li><a href="help.php">Help</a></li>
		<li><a href="register.php">Register</a></li>
		<li><a href="crud_all_surveys.php">Surveys</a></li>
		<li><a href="crud_all_questions.php">Questions</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>
<div id="body">
<div id="content">
	<!-- PAGE SPECIFIC CONTENT STARTS HERE. -->