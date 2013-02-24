<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'Final Project - View';
include ('./header.inc');
?>
<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>Add Record to Database</b></font></td>
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
	//$survey_id = mysql_real_escape_string($_POST['survey_id']);
	//$sequence = mysql_real_escape_string($_POST['sequence']);
	$question = mysql_real_escape_string($_POST['question']);
	$desc = mysql_real_escape_string($_POST['desc']);
	$created = mysql_real_escape_string($_POST['created']);
	$modified = mysql_real_escape_string($_POST['modified']);

	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "INSERT INTO questions (question, desc) VALUES ('$question', '$desc')";
	$result = mysql_query($query);

	if($result){
		echo "<p>Thank you for submitting a new question</p>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};

	// show the results again
	$query = "SELECT CONCAT(question, ', ', desc) AS question, desc FROM questions ORDER BY created";		
	$result = mysql_query ($query); 
	if ($result) { 

		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
		    <th>question</th> 
		    <th>desc</th> 
			<th>created</th> 
			<th>modified</th> 
		</tr> 
		</thead>';

		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td>". $row[0]. "</td><td>". $row[1] . " - " . $row[2] ."</td></tr>\n";
		}
		echo '</table>';
		mysql_free_result ($result); // Free up the resources.	
	} else {
		echo '<p>The presidents could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
	}
	mysql_close(); // Close the database connection.

}else{
//show form field
?>


<p>Insert a New Question</p>
Information (required *):
<div id="formarea"><form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="question">question:  *</label><br />
<input type="text" name="question" id="question" size="50" maxlength="128" /><br />
<label for="desc">desc:  *</label><br />
<input type="text" name="desc" id="desc" size="50" maxlength="128" /><br />
<label for="created">created:  *</label><br />
<input type="text" name="created" id="created" size="50" maxlength="128" /><br />
<label for="modified">modified:  *</label><br />
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