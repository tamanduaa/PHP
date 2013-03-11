<?php // index page
// Set the page title and include the HTML header.
$page_title = 'Energy Savings';
include ('./sessions/session_value.php');// use this just to open the session. do the work later on the page
include ('./header.inc');
?>

<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">

  <tr bgcolor="#333333"> 

    <td> 

   <table width="100%" border="0" cellspacing="0" cellpadding="4">

        <tr> 

          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>

          <td width="100%"> <font color="#CCCCCC"> <b>Energy Savings in Your Building!</b></font></td>

        </tr>

      </table></td>

  </tr>

</table>

<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">

  <tr> 

    <td width="70%" valign="top"> <p><b>Welcome! </b></p>

      <hr /> 

      <p>This site will help you track energy usage in your building!  Take the surveys to record data on your buildings usage over time.</p>



<?

if (isset($_SESSION['username'])){
	header('Location: secure.php');
} else if(isset($_POST['Submit'])){

	//Define post fields into simple variables	

	$name = mysql_real_escape_string($_POST['user_name']);
	$pass = mysql_real_escape_string($_POST['user_pass']);
	//$perm = mysql_real_escape_string($_POST['permission']);
	
	$pass = md5($pass);
	
	
	$query = "SELECT * FROM userauth WHERE user_name = '$name' AND user_pass = '$pass'"; 
	echo $query;


	$result = mysql_query($query); // Run the query.

	if ($result) { // If it ran OK, display the records.	

	// Fetch and print all the records.
	$row = mysql_fetch_array($result,MYSQL_BOTH);
		if($row){
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['username'] = $row['user_name'];
			$_SESSION['permission'] = $row['permission'];
			echo $_SESSION['user_id'] . $_SESSION['username'] . $_SESSION['permission']; 
				if ( $_SESSION['permission'] == "admin"){
				header("Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."secure_a.php");
				} else {
				header("Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."secure.php");
				}
				mysql_free_result ($result);
				exit();
		}else{
			echo "<b class='red'>username and password did not match</b>";
			unset($_POST['Submit']);
			include('form.php');
		}
	} else { // If it did not run OK.

	if (isset($_GET['logout']) && $_GET['logout']==1) {
	$message = "You are now logged out.";
	}
	
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