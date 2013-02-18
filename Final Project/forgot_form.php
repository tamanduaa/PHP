<div id="formarea"><form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	<table width="90%" border="0" align="center" bgcolor="#EAEAEA">
	
      <tr bgcolor="#F4F4F4">
        <td colspan="5">log in</td>
      </tr>
	  
      <tr>
        <td width="60">username:</td>
        <td width="150"><input type="text" name="user_name" id="user_name" size="15" maxlength="128" /></td>
        <td width="182">hint (pet's name):</td>
		<td width="150"><input type="text" name="pass_hint" id="pass_hint" size="15" maxlength="128" /></td>
		<td width="160"><input type="submit" name="Submit" value="submit" class="butt" alt="Submit" title="Submit" /></td>
      </tr>

      <tr bgcolor="#F4F4F4">
        <td colspan="5" align="center">not a member? <a href="register.php">click here</a></td>
      </tr>

  </table>    

</form>