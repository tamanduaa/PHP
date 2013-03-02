<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'Add a Question';
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
	$survey_id = mysql_real_escape_string($_POST['survey_id']);
	$sequence = mysql_real_escape_string($_POST['sequence']);
	$question = mysql_real_escape_string($_POST['question']);
	$description = mysql_real_escape_string($_POST['description']);
	$created = mysql_real_escape_string($_POST['created']);
	$modified = mysql_real_escape_string($_POST['modified']);

	$question_id = mysql_real_escape_string($_POST['question_id']);
	$q_sequence = mysql_real_escape_string($_POST['sequence']);
	$response_type = mysql_real_escape_string($_POST['response_type']);
	$response_value = mysql_real_escape_string($_POST['response_value']);
	
	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "INSERT INTO questions (survey_id, sequence, question, description, created, modified) VALUES ('$survey_id', '$sequence', '$question', '$description', NOW(), NOW())"; 
	$result = mysql_query($query);
	
	if($result){
		echo "<p>Thank you for submitting a new question</p>";
	}else{
		echo "<p>There has been an error in updating the question database:  ".mysql_error()."</p>";
	};
	
	// Insert into answers DB
	$query = "INSERT INTO answers (question_id, sequence, response_type, response_value) VALUES ( '$question_id', '$q_sequence', '$response_type', '$response_value')";
	$result = mysql_query($query);
	

	if($result){
		echo "<p>Thank you for submitting a new answer</p>";
	}else{
		echo "<p>There has been an error in updating the answer database:  ".mysql_error()."</p>";
	};

	// show the results again
	$query = "SELECT survey_id, sequence, question, description, created, modified FROM questions ORDER BY modified";		
	$result = mysql_query ($query); 
	if ($result) { 

		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
			<th>Survey ID</th> 
			<th>Sequence</th> 
		    <th>Question</th> 
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
		echo '<p>The presidents could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
	}
	mysql_close(); // Close the database connection.

}else{
//show form field
?>


<p>Insert a New Question</p>
Information (required *):
<div id="formarea"><form name="form1" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="survey_id">Survey ID:  *</label><br />
<input type="text" name="survey_id" id="survey_id" size="50" maxlength="128" /><br />
<label for="sequence">Sequence:  *</label><br />
<input type="text" name="sequence" id="sequence" size="50" maxlength="128" /><br />
<label for="question">Question:  *</label><br />
<input type="text" name="question" id="question" size="50" maxlength="128" /><br />
<label for="description">Description:  *</label><br />
<input type="text" name="description" id="description" size="50" maxlength="128" /><br />
<label for="qtype">Question Type:  *</label><br />
<input type="radio" name="response_type" id="response_type" value="radio" size="50" maxlength="128" />Radio<br />
<input type="radio" name="response_type" id="response_type" value="text box" size="50" maxlength="128" />Text Box<br />
<input type="radio" name="response_type" id="response_type" value="checkbox" size="50" maxlength="128" />Checkbox<br />
<input type="radio" name="response_type" id="response_type" value="dropdown" size="50" maxlength="128" />Dropdown<br />
<input type="radio" name="response_type" id="response_type" value="short input field" size="50" maxlength="128" />Short Input Field<br />
<label for="response_value">Response Value:</label><br />
<input type="text" name="response_value" id="response_value" size="50" maxlength="128" /><br />
<input type="text" name="response_value" id="response_value" size="50" maxlength="128" /><br />
<input type="text" name="response_value" id="response_value" size="50" maxlength="128" /><br />
<input type="text" name="response_value" id="response_value" size="50" maxlength="128" /><br />
<input type="text" name="response_value" id="response_value" size="50" maxlength="128" /><br />

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