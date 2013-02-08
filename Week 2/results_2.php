<?php # Cookie Survey

$cookie = $_POST['fave_cookie'];
$description = $_POST['desc'];
$like = $_POST['like'];
$bake = $_POST['bake'];
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
	width:600px;
	padding:10px 60px 10px 60px;
}
</STYLE>


<body>
<div id="wrapper">

<h3>Cookie Survey</h3>


<form action="part1.php" method="post">
<p>
<?

//print out favorite 
echo "Your favorite cookie is $cookie." . " ";
//respond to favorite
switch($cookie) { 
	case 'chocolate chip':
		echo "That's my favorite too!";
		break;
	case 'peanut butter':
		echo "Nice choice!";
		break;
	case 'oatmeal':
		echo "Aaaah....crunchy!";
		break;
default:
	echo "You didn't choose a favorite cookie!";
	}
echo "<br />";
//end favorite section

//explanation section
if (isset($_POST['desc']) && !empty($_POST['desc'])){
echo "You prefer $cookie cookies because:<br/> $description <br/>";
} else {
echo "You did not provide an explanation.";
}//end explanation section

//checkbox section
if (isset($_POST['like']) && !empty($_POST['like'])){
	echo "You like the following types of cookie:<br/>";
	foreach ($like as $value) {
		echo "<em>$value</em><br/>";
	}
} else {
	echo "You do not like any of these types of cookie.<br/>";
}//end checkbox section

//respond to info from baking question
if($bake == "Yes!"){
	echo "You like to bake cookies. Me too!";
	} elseif ($bake == "No way!"){
	echo "You don't like to bake cookies.  Ah well.";
}//end baking section
	


?>
</p>
</div>

</body>
</html>

