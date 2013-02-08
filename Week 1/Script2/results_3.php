<?php # Contact Information

# Get Variables
$firstname = $_GET['fname'];

$lastname = $_GET['lname'];

$fullname = $firstname . " " . $lastname;

$email = $_GET['email'];

$message = $_GET['message'];

$break = "<br/>";


# Set Info for php page and email
$info_mail = "You entered the following information:
Name: $fullname
Email: $email
Message: $message";

$info_page = "You entered the following information:<br/>
Name: $fullname<br/>
Email: $email<br/>
Message: $message<br/>";


?>

<html>
<head><title>Contact Information</title></head>
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

p {
	padding:30px 150px 30px 150px;
}
</STYLE>
<body>
<div id="wrapper">

<h1 align="center">Contact Information</h3>

<hr />
<form action="part1.php" method="get">
<p>
<?

echo $info_page;

mail($email, 'Contact Information', $info_mail, "From:".$email."\nX-Mailer: PHP/" . phpversion());

?>
</p>
</div>

</body>
</html>