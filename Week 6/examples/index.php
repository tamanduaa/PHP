<?php
// Set the page title and include the HTML header.
$page_title = 'User Auth';
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

    <td width="70%" valign="top"> <p><b>User Authentication </b></p>

      <hr /> 

      <p>In this lesson's exercise, we'll apply a basic user authentication script to maintain security in our site by restricting access to sensitive materials to only those that have logged in with a password or become a member.  Most every website has some sort of membership system in which a database stores your user name and password. This is a very real-world application.</p>

	<p>Once a user comes to our site, we'll ask them to login or become a member. Once they've successfully become a member, we can then direct them to the materials they are after or else deny them access.</p>

	<p>We'll also create a help script to reassign a forgotten password, cause who hasn't forgotten a password.</p>

<?

if(isset($_POST['Submit'])){

	//Define post fields into simple variables	

	$name = mysql_real_escape_string($_POST['user_name']);
	$pass = mysql_real_escape_string($_POST['user_pass']);
	
	$pass = md5($pass);
	

	$query = "SELECT * FROM userauth WHERE user_name = '$name' AND user_pass = '$pass'"; 
	echo $query;


	$result = mysql_query($query); // Run the query.

	if ($result) { // If it ran OK, display the records.	

	// Fetch and print all the records.
	$row = mysql_fetch_array($result,MYSQL_BOTH);
		if($row){
		
				header("Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."secure.php");
				
				
				mysql_free_result ($result);
				exit();
		}else{
			echo "<b class='red'>username and password did not match</b>";
			unset($_POST['Submit']);
			include('form.php');
		}
	} else { // If it did not run OK.

	echo '<p>The login result could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 

}

	mysql_close(); // Close the database connection.
}else{   // THE BIG IF ELSE STATEMENT FOR THE FORM
	include('form.php');
}
?>

	</td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>