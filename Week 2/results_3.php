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

//set Variable
$break = "<br/>";

//validate name
if (!empty($_GET['fname'])){
	$firstname = $_GET['fname'];
	}else {
	$firstname = NULL;
	echo '<p class="error">You forgot to enter your first name!</p>';
}
if (!empty($_GET['lname'])){
	$lastname = $_GET['lname'];
	}else {
	$lastname = NULL;
	echo '<p class="error">You forgot to enter your last name!</p>';
}//end validate name

//set fullname variable
$fullname = $firstname . " " . $lastname;

//validate email
if (isset($_GET['email'])){
$email = $_GET['email'];
} else {
	$email = NULL;
	echo '<p class="error">You forgot to enter your email address!</p>';
}//end validate email

//validate message
if (isset($_GET['message']) && is_string($_GET['message']) && !empty($_GET['message'])){
$message = $_GET['message'];
} else {
  $message = NULL;
  echo '<p class="error">You forgot to enter your message!</p>';
}//end validate message

//validate phone number
if (isset($_GET['phone_num']) && is_numeric($_GET['phone_num'])){
$phone_num = $_GET['phone_num'];
} else {
	$phone_num = NULL;
	echo '<p class="error">You forgot to enter your phone number!</p>';
}//end validate phone number


# Set Info for php page and email
$info_mail = "You entered the following information:
Name: $fullname
Email: $email
Phone #: $phone_num
Message: $message";

$info_page = "You entered the following information:<br/>
Name: $fullname<br/>
Email: $email<br/>
Phone #: $phone_num<br/>
Message: $message<br/>";
echo $info_page;

mail($email, 'Contact Information', $info_mail, "From:".$email."\nX-Mailer: PHP/" . phpversion());

?>
</p>
</div>

</body>
</html>