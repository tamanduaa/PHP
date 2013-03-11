<?php # Secure ADMIN

// Set the page title and include the HTML header.
$page_title = 'Kangaroo Rat ADMIN';
include ('./sessions/session_value.php');
include ('./header.inc');

$name = mysql_real_escape_string($_POST['user_name']);
$pass = mysql_real_escape_string($_POST['user_pass']);

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
      <h1>Hello <? echo $_SESSION['username'];?>,</h1>
	  <h1>You are in a secure ADMIN area.</h1>
	
	
    </td>
  </tr>
</table>
<br/><br/>


<?php
include ('./footer.inc'); // Include the HTML footer.
?>