<?php # Final Project - Insert a New Survey - add_survey.php

// Set the page title and include the HTML header.
$page_title = 'Final Project - Insert a New Survey';
include ('./header.inc');
?>
<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>Add Survey to Database</b></font></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>Add to List</b></p>
      <hr /> 
      <p>
	  
	  
	  
	  
	  <?php


if(isset($_POST['Submit'])){

	//define post vars and sanitize.
	$status = mysql_real_escape_string($_POST['status']);
	$start_date = mysql_real_escape_string($_POST['start_date']);
	$end_date = mysql_real_escape_string($_POST['end_date']);
	$description = mysql_real_escape_string($_POST['description']);
	$created = mysql_real_escape_string($_POST['created']);
	$modified = mysql_real_escape_string($_POST['modified']);

	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "INSERT INTO surveys (status, start_date, end_date, description, created, modified) VALUES ('$status', '$start_date', '$end_date', '$description', '$created', '$modified')"; 
	$result = mysql_query($query);

	if($result){
		echo "<p>Thank you for submitting a new survey</p>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};

	// show the results again
	$query = "SELECT status, start_date, end_date, description, created, modified FROM surveys ORDER BY modified";		
	$result = mysql_query ($query); 
	if ($result) { 

		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
			<th>Status</th> 
			<th>Start Date</th> 
		    <th>End Date</th> 
		    <th>Description</th> 
			<th>Created</th> 
			<th>Modified</th> 
		</tr> 
		</thead>';

		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td>" . $row[0] . "</td><td>". $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>\n";
		}
		echo '</table>';
		mysql_free_result ($result); // Free up the resources.	
	} else {
		echo '<p>The surveys could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
	}
	mysql_close(); // Close the database connection.

}else{
//show form field
?>


<p>Insert a New Survey</p>
Information (required *):
<div id="formarea"><form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="status">Status:  *</label><br />
<input type="text" name="status" id="status" size="50" maxlength="128" /><br />
<label for="start_date">Start Date:  *</label><br />
<input type="text" name="start_date" id="start_date" size="50" maxlength="128" /><br />
<label for="end_date">End Date:  *</label><br />
<input type="text" name="end_date" id="end_date" size="50" maxlength="128" /><br />
<label for="description">Description:  *</label><br />
<input type="text" name="description" id="description" size="50" maxlength="128" /><br />
<label for="created">Created:  *</label><br />
<input type="text" name="created" id="created" size="50" maxlength="128" /><br />
<label for="modified">Modified:  *</label><br />
<input type="text" name="modified" id="modified" size="50" maxlength="128" /><br /><br />
<input type="submit" name="Submit" value="add" class="butt" alt="." title="." />
</form>

	 
<?php
}
?>

	  

	  
	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>