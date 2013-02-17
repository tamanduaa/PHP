<?php # Script 3.4 - index.php



// Set the page title and include the HTML header.

$page_title = 'User Auth Help';

include ('./header.inc');



?>

<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">

  <tr bgcolor="#333333"> 

    <td> 

   <table width="100%" border="0" cellspacing="0" cellpadding="4">

        <tr> 

          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>

          <td width="100%"> <font color="#CCCCCC"> <b>User Auth with  MySQL and PHP</b></font></td>

        </tr>

      </table></td>

  </tr>

</table>

<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">

  <tr> 

    <td width="70%" valign="top"> <p><b>User Authentication - Help </b></p>

      <hr /> 

      <p>Have you forgot your password?</p>

	  <p>For added security, if you've forgot your password, we can reset it for you by having you input your user name and password hint. Once you've entered this information, your password will be reset and
	  you'll be sent an email with the new password.</p>

	  

<?



if(isset($_POST['Submit'])){


	$name = mysql_real_escape_string($_POST['user_name']);
	$pass = mysql_real_escape_string($_POST['pass_hint']);

	$query = "SELECT * FROM userauth WHERE user_name = '$name' AND pass_hint = '$pass'"; 

	$result = mysql_query($query); // Run the query.



	if ($result) { // If it ran OK, display the records.	



	// Fetch and print all the records.

	$row = mysql_fetch_array($result,MYSQL_BOTH);



		if($row){ // SUCCESSFUL MATCH OF USER NAME
			$uid = $row['ID'];
			$uemail = $row['email_address'];
			$new_pass = substr(uniqid(rand(),1),3,10);
			$new_db_pass = md5($new_pass);
			$query = "UPDATE userauth SET user_pass='$new_db_pass' WHERE ID=$uid";
			$result = mysql_query($query);
				if(mysql_affected_rows() == 1){
					// success send email
					echo "We're not going to just show you someone's password here! We're not fools. We're going to send an email to the account and let them know what their password is.";
					// SEND EMAIL WITH PASSWORD
					$subject = "Web Tech Password Help!";
					$message = "Here is your password:". $new_pass ." \n\n-webtech
					\nUniversity of Washington Educational Outreach.\n
					http://www.extension.washington.edu/\n
					This is an automated response, please do not reply!";
					mail($uemail, $subject, $message, "From: webtech<webtech@u.washington.edu>\nX-Mailer: PHP/" . phpversion());
			
				}else{
						echo '<p>The login result could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
				} 


		}else{

			echo "<b class='red'>username and password hint did not match</b>";

			unset($_POST['Submit']);

			include('forgot_form.php');

		}

	} else { // If it did not run OK.



	echo '<p>The login result could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 



}



	mysql_close(); // Close the database connection.



	





}else{   // THE BIG IF ELSE STATEMENT FOR THE FORM





include('forgot_form.php');

}

?>





    </td>

  </tr>

</table>

<br/><br/>



<?php



include ('./footer.inc'); // Include the HTML footer.

?>