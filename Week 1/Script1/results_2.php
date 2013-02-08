<?php # Cookie Survey

$cookie = $_POST['fave_cookie'];



$description = $_POST['desc'];


$like = $_POST['like'];
?>

<html>
<head><title>Cookie Survey</title></head>
<STYLE TYPE="text/css">
body	{
background-color: #EDF9FF;
color: #515758;
}

#wrapper {
padding:50px;
	margin:0px auto;
	text-align:center;
	width:700px;
	height:100%;
	background-color:#fff;
	font-family: Verdana, Arial, Helvetica;
}

tr, p {
	width:400px;
	padding:10px 150px 10px 150px;
}
</STYLE>


<body>
<div id="wrapper">

<h3>Cookie Survey</h3>


<form action="part1.php" method="post">
<p>
<?
echo "Your favorite cookie is $cookie. <br/>";

echo "Your explanation is: $description <br/>";

echo "You like $like cookies.";
?>
</p>
</div>

</body>
</html>

