<?

if(isset($_POST['Submit'])){

	require_once('db_config_inc.php');

	//Define post fields into simple variables	

	$name = $_POST['user_name'];

	$pass = $_POST['user_pass'];

	// Let's strip some slashes in case the user entered any escaped characters. 

	//$user_name = stripslashes($user_name);



$query = "SELECT * FROM userauth WHERE user_name = '$name' AND user_pass = '$pass'"; 



	$result = mysql_query($query); // Run the query.





	if ($result) { // If it ran OK, display the records.	

	// Fetch and print all the records.
	$row = mysql_fetch_array($result,MYSQL_NUM);
		if($row){
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."secure.php");
			mysql_free_result ($result); // Free up the resources.	
			exit();
		}else{
			echo "username and password did not match";
			unset($_POST['Submit']);
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."index.php");
		}
	} else { // If it did not run OK.

	echo '<p>The login result could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 

}

	mysql_close(); // Close the database connection.

	//header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."login.php");


}else{   // THE BIG IF ELSE STATEMENT FOR THE FORM

?>





<div id="formarea"><form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <table width="200" border="0" align="center" bgcolor="#EAEAEA">

      <tr bgcolor="#F4F4F4">

        <td colspan="5">log in</td>

        </tr>

      <tr>

        <td>username:</td>

        <td><input type="text" name="user_name" id="user_name" size="25" maxlength="128" /></td>

        <td>password:</td>

		<td><input type="password" name="user_pass" id="user_pass" size="25" maxlength="128" /></td>

		    <td><input type="submit" name="Submit" value="login" class="butt" alt="Login! We'll send you a link via email." title="Login! We'll send you a link via email." /></td>

      </tr>

      <tr bgcolor="#F4F4F4">

        <td colspan="5" align="center">not a member? <a href="register.php">click here</a></td>

        </tr>

    </table>    

</form>
<?
}
?>