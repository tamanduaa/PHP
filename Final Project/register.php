<?php # Register

$page_title = 'Register!';
include ('./header.inc');

?>

<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
	<tr bgcolor="#333333"> 
		<td> 
			<table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr> 
				<td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
				<td width="100%"> <font color="#CCCCCC"> <label>User Auth with  MySQL and PHP</label></font></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
	<tr> 
		<td width="70%" valign="top"> <p><label>User Authentication - Login </label></p>
		  <hr /> 
		<p>Login</p>
		
<?

// if submit has been set/clicked
if (isset($_POST['submit'])) {
	
	// clear message
	$message = NULL;
	
	// clean entries and assign to variables
	$first_name = mysql_real_escape_string($_POST['fname']);
	$last_name = mysql_real_escape_string($_POST['lname']);
	$email_address = mysql_real_escape_string($_POST['email_address']);
	$user_name = mysql_real_escape_string($_POST['username']);
	$password_1 = mysql_real_escape_string($_POST['password_1']);
	$password_2 = mysql_real_escape_string($_POST['password_2']);
	$passhint = mysql_real_escape_string($_POST['passhint']);
	$ip = $_SERVER['REMOTE_ADDR'];

	// Check if first name is blank.
	if (strlen($first_name) > 0) {
		$fname = TRUE;
	} else {
		$fname = FALSE;
		$message .= 'first name';
	}	
	
	// Check if last name is blank.
	if (strlen($last_name) > 0) {
		$lname = TRUE;
	} else {
		$lname = FALSE;
		$message .= ', last name';
	}	
	
	// Check if email is blank
	if (strlen($email_address) > 0) {
		$email = TRUE;
	} else {
		$email = FALSE;
		$message .= ', email address';
	}
	
	// Check if username is blank.
	if (strlen($user_name) > 0) {
		$username = TRUE;
	} else {
		$username = FALSE;
		$message .= ', user name';
	}
	
	// Check for a password and match against the confirmed password.
	// Check that password is not blank
	if (strlen($password_1) > 0) {
		//perform string compare
		$pass_test = strcasecmp($password_1,$password_2);
		if($pass_test != 0){
			$password = FALSE;
			$message .= '<p class="warn">Also, your password did not match the confirmed password!</p>';
		}else{
			$password = TRUE;			
		}
	} else {
		$password = FALSE;
		$message .= ', your password!';
	}
	
	// If all entries passed the above checks
	if ($fname && $lname && $email && $username && $password) {
		
		// Register the user
		$password_1 = md5($password_1);
		
		$query = "INSERT INTO userauth (first_name, last_name, user_name, user_pass, pass_hint, email_address, user_ip, signup_date) VALUES('$first_name', '$last_name', '$user_name','$password_1','$passhint', '$email_address','$ip', now())";
		
		$result = mysql_query($query);
		
		if($result){
			
			// Send an email.
			$body = "Thank you for registering with our site!\nYour username is ". $_POST['user_name'] ." and your password is ". $_POST['password_1'] .".\n\nSincerely,\nUs";
			mail($email_address, 'Thank you for registering!', $body, 'From: wts@uw.com');
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."secure.php");
			echo "Thanks for registering!";
			exit();
			
		}else{

			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";

		};
		
	} else {
		$message .= '<p class="warn">Please try again.</p>';		
	}
}	
// If the error message has been set, print it
if (isset($message)) {
	echo '<p class="warn"> You forgot to enter in your '. $message  .'</p>';
}
?>

<p>To access the private materials, please become a member by submitting your name and E-mail address. A link to the materials will be sent to your E-mail address. Sign up!</p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset>

		<legend>Enter your information in the form below:</legend>

		<div id="name">
			<label>First Name:</label> <input type="text" name="fname" size="20" maxlength="20" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" />
		</div>	

		<div id="name">
			<label>Last Name:</label> <input type="text" name="lname" size="20" maxlength="20" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" />
		</div>
			
		<div id="email">
			<label>Email Address:</label><input type="text" name="email_address" size="20" maxlength="60" value="<?php if (isset($_POST['email_address'])) echo $_POST['email_address']; ?>" /> 
		</div>

		<div id="username">
			<label>User Name:</label> <input type="text" name="username" size="20" maxlength="40" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
		</div>

		<div id="pass">
			<label>Password:</label> <input type="password" name="password_1" size="20" maxlength="40" />
		</div>

		<div id="pass">
			<label>Confirm Password:</label> <input type="password" name="password_2" size="20" maxlength="40" />
		</div>

		<div id="passhint">
			<label>Password Hint:</label> <input type="text" name="passhint" id="passhint" size="20" maxlength="128" />
		</div>

	</fieldset>

<div align="center"><input type="submit" name="submit" value="Submit Information" /></div>

</td>

</tr>

</table>

<?php
include ('./footer.inc'); // Include the HTML footer.
?>
</form><!-- End of Form -->