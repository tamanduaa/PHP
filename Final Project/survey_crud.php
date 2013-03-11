<?php # Survey CRUD

// Set the page title and include the HTML header.
$page_title = 'Survey CRUD';
require_once('./header.inc');
//require_once('./html.php');

?>

<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>Total CRUD on a single page</b></font></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>All CRUD in one page</b></p>
      <hr /> 
      <p>	   	 	 
<?php

$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : '');

// ADD
if($dbaction == "add"){
	
	// Define post fields into simple variables
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

	//INSERT INTO DB
	$query = "INSERT INTO questions (survey_id, sequence, question, description, created, modified) VALUES ('$survey_id', '$sequence', '$question', '$description', NOW(), NOW())"; 
	$result = mysql_query($query);

	if($result){
		echo "<p>Thank you for submitting a new question</p>";
	}else{
		echo "<p>There has been an error in updating the question database:  ".mysql_error()."</p>";
	};
// END ADD SECTION


// EDIT



}else if($dbaction == "edit"){

	$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : 'show');

    ?>
	<div id="formarea">
	<form name="form1" action="https://depts.washington.edu/wts2010b/students/lperry87/Final%20Project/survey_crud.php" method="post">
	<?

	foreach($_POST['update'] as $value){

		 $id = mysql_real_escape_string($value);

		 $query = "SELECT survey_id, sequence, question, description, created, modified FROM questions WHERE id IN (".$id.") ORDER BY id";		
		 $result = mysql_query ($query); // Run the query.
		
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

				?>
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

				
				<?			
			
			}
	}

	?>

	<input type="hidden" name="dbaction" value="edit_confirm" />
	<input type="submit" name="submit" value="Update"/>
	</form>
	</div>
	
	<?
	unset($_POST);
}else if($dbaction == "edit_confirm"){

	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "UPDATE questions SET survey_id = '".$survey_id."', sequence ='".$sequence."', question = '".$question."', description = '".$description."' WHERE id = ".$id;

	$result = mysql_query($query);

	if($result){
		echo "<h1>Thank you for updating the question</h1>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
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
			echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . " - " . $row[2] . "</td><td>". $row[3] . "</td><td>". $row[4] . "</td><td>". $row[5] . "</td></tr>\n";
		}
		echo '</table>';
		mysql_free_result ($result); // Free up the resources.	
	} else {
		echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
	}
	


?>	
	  </p>
      </td>
  </tr>
</table>
<?
// END EDIT SECTION


}else if($dbaction == "delete"){
	
    if (isset($_POST['questions']) && is_array($_POST['questions'])) {
      $questions = db_prepare_input($_POST['questions']);

      for ($i=0, $n=sizeof($questions); $i<$n; $i++) {

		$query = "DELETE FROM questions WHERE ID = ". (int)$questions[$i] . "";
		$result = mysql_query($query);

		if($result){
			echo "<p>You have successfully updated the questions by removing ". $i+1 . " entries </p>";
		}else{
			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
		};



      }

    }


	
}else{
}

// Define show_questions function.  In the future, move this to a separate functions or html doc
/****************************

Show presidents by Start date

*****************************/
	function show_questions(){
		$query = "SELECT survey_id, sequence, question, description, created, modified FROM questions ORDER BY modified";		
		$result = mysql_query ($query); // Run the query.
		if ($result) { // If it ran OK, display the records.


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
			

			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td<td>$row[4]</td<td>$row[5]</td</tr>\n";
			}

			echo '</table>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}

		mysql_close(); // Close the database connection.
	}





function show_questions(){
		$query = "SELECT survey_id, sequence, question, description, created, modified FROM questions ORDER BY modified";		
		$result = mysql_query ($query); // Run the query.
		if ($result) { // If it ran OK, display the records.


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
			

			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td<td>$row[5]</td</tr>\n";
			}

			echo '</table>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}

		//mysql_close(); // Close the database connection.
	} // End function


$action = (isset($_GET['action']) ? $_GET['action'] : '');

if ($action) {
	
	if($action == "add"){
		echo "Add A Question to the Database";
		
		echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
		echo "<fieldset>";
		echo "<p>Enter your information in the form below:</p>";
		echo "<p><b>Survey ID:</b>". draw_input_field("survey_id","survey_id","","text",true) ."</p>";
		echo "<p><b>Sequence:</b>". draw_input_field("sequence","sequence","","text",true) ."</p>";
		echo "<p><b>Question:</b>". draw_input_field("question","question","","text",true) ."</p>";
		echo "<p><b>Description:</b>". draw_input_field("description","description","","text",true) ."</p>";
		
		echo "<p><b>Question Type:</b>". draw_input_field("response_type","response_type","","text",true) ."</p>";
		echo "<p><b>Response Value:</b>". draw_input_field("response_value","response_value","","text",true) ."</p>";
		
		echo draw_hidden_field("dbaction", $value = 'add');
		echo "</fieldset>";
		echo '<div align="center"><input type="submit" name="submit" /></div>';
		echo '</form><!-- End of Form -->';
		
		
		show_questions();
	}else if($action == "edit"){
		echo "edit";
		$query = "SELECT survey_id, sequence, question, description, created, modified FROM questions ORDER BY id";		
		  $result = mysql_query ($query); // Run the query.
		  if ($result) { // If it ran OK, display the records.

		  	?>
			<form name="form1"  action="https://depts.washington.edu/wts2010b/students/lperry87/Final%20Project/survey_crud.php" method="POST">
			<?		
			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
			<thead> 
			<tr> 
				<th>Survey ID</th> 
			    <th>Sequence</th> 
			    <th>Question</th> 
			    <th>Description</th>
			    <th>Update</th>	 
			</tr> 
			</thead>';


			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "<tr><td>".$row["survey_id"]."</td><td>".$row["sequence"]."</td><td>".$row["question"]."</td><td>".$row["description"]."</td><td><input name=\"update[]\" type=\"radio\" value=". $row["id"] ."></td></tr>\n";
			}

			echo '</table>';
			echo '<table align="center" cellspacing="2" cellpadding="2"><tr><td align="left">';
			echo '<input type="hidden" name="dbaction" value="edit" />';
			echo '<input type="submit" name="Submit" value="update records!" />';
			echo '</td></tr></table>';
			echo '</form>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
			show_questions();
		}
		
	}else if($action == "delete"){
		
		
		  $query = "SELECT ID, survey_id, sequence, question, description, created, modified FROM questions ORDER BY created";		
		  $result = mysql_query($query); // Run the query.
		  if ($result) { // If it ran OK, display the records.

		  	echo draw_form("register",$_SERVER['PHP_SELF'],"POST");			
			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
			<thead> 
			<tr> 
			    <th>Survey ID</th> 
			    <th>Sequence</th> 
			    <th>Question</th> 
			    <th>Description</th>
			    <th>Update</th>	 		
			</tr> 
			</thead>';
			
			
			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td align=\"left\">$row[1]</td><td align=\"left\">$row[2]</td><td align=\"left\">$row[3]</td><td align=\"left\"> ".draw_checkbox_field('questions[]', $row[0], false) ."</td></tr>\n";
			}

			echo '</table>';
			echo '<table align="center" cellspacing="2" cellpadding="2"><tr><td align="left">';
			echo "<input type=\"submit\" name=\"Submit\" value=\"delete records!\" class=\"butt\" alt=\"Delete\"/>";
			echo '</td></tr></table>';
			echo draw_hidden_field("dbaction", $value = 'delete');
			echo '</form>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}
		
	}else{
		echo "Woah Buddy, hold back, I can see something went wrong here! Let's just all calm down";
		show_questions();
	}


}else{  //show main page

	echo "show basic form";
	echo draw_form("register",$_SERVER['PHP_SELF'],"GET");
	echo "<fieldset>";
	echo "<p>Lets do all the CRUD on one page.   Also, lets use the nice HTML helpers from last week in this to speed up coding:</p>";
	echo "<p><b>Add:</b>" .draw_radio_field("action","add")."<b>Edit:</b>". draw_radio_field("action","edit") .  "<b>Delete:</b>". draw_radio_field("action","delete") . "</p>";
	echo "</fieldset>";
	echo '<div align="center"><input type="submit" name="submit" /></div>';
	echo '</form><!-- End of Form -->';

	show_questions();

}  // end page view if\else

?>

	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>