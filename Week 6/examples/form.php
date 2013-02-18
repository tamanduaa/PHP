<div id="formarea">
	<form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <table  border="0" bgcolor="#EAEAEA">

      <tr bgcolor="#F4F4F4">
        <td colspan="5">log in</td>
      </tr>

      <tr>
        <td>username:</td>
        <td><input type="text" name="user_name" id="user_name" size="15" maxlength="128" /></td>
        <td>password:</td>
		<td><input type="password" name="user_pass" id="user_pass" size="15" maxlength="128" /></td>
		<td><input type="submit" name="Submit" value="login" class="butt" alt="Login! We'll send you a link via email." title="Login! We'll send you a link via email." /></td>
      </tr>

      <tr bgcolor="#F4F4F4">
        <td colspan="5" align="center">not a member? <a href="register.php">click here</a></td>
      </tr>
    </table>

</form>
</div>