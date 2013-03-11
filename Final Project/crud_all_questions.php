<?php # crud_all_questions

// Set the page title and include the HTML header.
$page_title = 'CRUD_ALL';
require_once('./header.inc');
require_once('./html.php');
?>

<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>Add, Edit or Delete a Question</b></p>
      <hr /> 
      <p>
	  
	  
	  
	  
<?php

$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : '');
                            
if($dbaction == "add"){
	echo "Add A Question to the Database";
	
	echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
	echo "<fieldset>";
	echo "<p>Enter your information in the form below:</p>";
	echo "<p><b>Survey ID:</b>". draw_input_field("survey_id","","","text",true) ."</p>";
	echo "<p><b>Sequence:</b>". draw_input_field("sequence","","","text",true) ."</p>";
	echo "<p><b>Question:</b>". draw_input_field("question","","","text",true) ."</p>";
	echo "<p><b>Description:</b>". draw_input_field("description","","","text",true) ."</p>";
	
	//echo "Question Type";
	//echo "<p><b>Radio</b>". draw_radio_field($response_type, $value = 'radio', $checked = false, $parameters = '') ."</p>";
	//echo "<p><b>Checkbox</b>". draw_radio_field($response_type, $value = 'checkbox', $checked = false, $parameters = '') ."</p>";
	//echo "<p><b>Text Area</b>". draw_radio_field($response_type, $value = 'textarea', $checked = false, $parameters = '') ."</p>";
	//draw_hidden_field($name, $value = '', $parameters = '')
	
	echo '<input type="radio" name="response_type" id="response_type" value="radio" size="50" maxlength="128" />Radio<br />';
	echo '<input type="radio" name="response_type" id="response_type" value="text box" size="50" maxlength="128" />Text Box<br />';
	echo '<input type="radio" name="response_type" id="response_type" value="checkbox" size="50" maxlength="128" />Checkbox<br />';
	echo '<input type="radio" name="response_type" id="response_type" value="dropdown" size="50" maxlength="128" />Dropdown<br />';
	echo '<input type="radio" name="response_type" id="response_type" value="short input field" size="50" maxlength="128" />Short Input Field<br />';
	
	
	echo "<p><b>Response 1:</b>". draw_input_field("response_value_1","","","text",true) ."</p>";
	echo "<p><b>Response 2:</b>". draw_input_field("response_value_2","","","text",true) ."</p>";
	echo "<p><b>Response 3:</b>". draw_input_field("response_value_3","","","text",true) ."</p>";
	
	echo draw_hidden_field("dbaction", $value = 'add_confirm');
	echo "</fieldset>";
	echo '<div align="center"><input type="submit" name="submit" /></div>';
	echo '</form><!-- End of Form -->';
	
	
	show_questions(); 
	
}elseif($dbaction == "add_confirm"){

	// Define post fields into simple variables

	$survey_id = db_prepare_input($_POST['survey_id']);
	$sequence = db_prepare_input($_POST['sequence']);
	$question = db_prepare_input($_POST['question']);
	$description = db_prepare_input($_POST['description']);
	
	$question_id = db_prepare_input($_POST['question_id']);
	//$sequence = db_prepare_input($_POST['sequence']);
	$response_type = db_prepare_input($_POST['response_type']);
	$response_value_1 = db_prepare_input($_POST['response_value_1']);
	$response_value_2 = db_prepare_input($_POST['response_value_2']);
	$response_value_3 = db_prepare_input($_POST['response_value_3']);
	
	$id = mysql_real_escape_string($_POST['id']);

	//INSERT INTO DB

	// insert questions into questions DB
	$query = "INSERT INTO questions (survey_id, sequence, question, description) VALUES ('$survey_id', '$sequence','$question','$description')";
	$result = mysql_query($query);
	
	if($result){
		echo "<p>Thank you for submitting a new question.</p>";
		
		// grab id from questions so we can associate it with answers
		//$query = "SELECT id FROM questions";
		//$result = mysql_query($query);
		//	echo "This is the ID result: " . $result;	
		
		// insert answers to the appropriate question
		$query = "INSERT INTO answers (question_id, sequence, response_type, response_value_1, response_value_2, response_value_3 ) VALUES (LAST_INSERT_ID(), '$sequence','$response_type','$response_value_1', '$response_value_2', '$response_value_3')";
		$result = mysql_query($query);
		
		if($result){
			echo "<p>Thank you for submitting a new answer.</p>"; 
		}
		show_questions();
		
	}else{
		echo "<p>There has been an error in inserting into the database:  ".mysql_error()."</p>";
	};

}else if($dbaction == "edit"){
	
	$query = "SELECT id, survey_id, sequence, question, description FROM questions ORDER BY survey_id";		
	$result = mysql_query ($query); // Run the query.
		if ($result) { // If it ran OK, display the records.

			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
				<thead> 
					<tr> 
						<th>ID</th> 
						<th>Sequence</th> 
						<th>Question</th> 
						<th>Description</th>
						<th>Update Question</th>
					</tr> 
				</thead>';
			
			
		
			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "<tr><td>".$row["survey_id"]."</td><td>".$row["sequence"]."</td><td>".$row["question"]."</td><td>".$row["description"]."</td><td><input name=\"update[]\" type=\"radio\" value=". $row["id"] ."></td></tr>\n";
			}
			echo '</table>';
			mysql_free_result ($result); // Free up the resources.
				echo draw_form("edit",$_SERVER['PHP_SELF'],"POST"); 
				echo '<input type="submit" name="Submit" value="update records!" />';
				
			echo '<input type="hidden" name="dbaction" value="edit_confirm_questions" />';
			echo '</td></tr></table>';
			echo '</form>';
		
			$query = "SELECT id, question_id, sequence, response_type, response_value_1, response_value_2, response_value_3 FROM answers ORDER BY question_id";		
			$result = mysql_query ($query); // Run the query.
			if ($result) { // If it ran OK, display the records.
		
				echo '
				<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
					<thead> 
						<tr> 
							<th>Question ID</th>
							<th>Sequence</th>
							<th>Response Type</th> 
							<th>Response 1</th> 
							<th>Response 2</th> 
							<th>Response 3</th> 
							<th>Update Answer</th>
						</tr> 
					</thead>';
								
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						echo "<tr><td>".$row["question_id"]."</td><td>".$row["sequence"]."</td><td>".$row["response_type"]."</td><td>".$row["response_value_1"]."</td><td>".$row["response_value_2"]."</td><td>".$row["response_value_3"]."</td><td><input name=\"update[]\" type=\"radio\" value=". $row["id"] ."></td></tr>\n";
					}
					echo '</table>';
				echo '<input type="hidden" name="dbaction" value="edit_confirm_answers" />';
				echo '</td></tr></table>';
				echo '</form>';
				echo draw_form("edit",$_SERVER['PHP_SELF'],"POST"); 
				echo '<input type="submit" name="Submit" value="update records!" />';				
			}	
		}

}else if($dbaction == "edit_confirm_questions"){     
	 
   	$myUpdate = $_POST['update']; 
	    if(isset($myUpdate)){


		foreach($myUpdate as $value){

			 $id = (int)($value);

			 
			 $query = "SELECT survey_id, sequence, question, description FROM questions WHERE id IN (".$id.") ORDER BY id";		
			 $result = mysql_query ($query); // Run the query.
			 

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

					?>
					<label for="survey_id">Survey ID:  *</label><br />
					<input type="text" name="survey_id" id="survey_id" size="50" maxlength="128" value="<? echo $row["survey_id"]; ?>"/><br />
					<label for="sequence">Sequence:  *</label><br />
					<input type="text" name="sequence" id="sequence" size="50" maxlength="128" value="<? echo $row["sequence"]; ?>"  /><br />
					<label for="question">Question:  *</label><br />
					<input type="text" name="question" id="start" size="50" maxlength="128" value="<? echo $row["question"]; ?>"/><br />
					<label for="description">Description:  *</label><br />
					<input type="text" name="description" id="end" size="50" maxlength="128" value="<? echo $row["description"]; ?>" /><br />
					<input type="hidden" name="id" value="<? echo $row['id']; ?>" />
					<input type="submit" name="submit" value="Update Question"/> 
					<br />
					<?			
					echo draw_hidden_field("dbaction", $value = 'update_confirm_questions');
					echo draw_form("edit_confirm_questions",$_SERVER['PHP_SELF'],"POST");   
				}
		}
		}
}else if($dbaction == "edit_confirm_answers"){     
	
	$myUpdate = $_POST['update']; 
	    if(isset($myUpdate)){


		foreach($myUpdate as $value){

			$id = (int)($value);
			
			$query = "SELECT question_id, sequence, response_type, response_value_1, response_value_2, response_value_3 FROM answers WHERE question_id IN (".$id.") ORDER BY question_id";		
			$result = mysql_query ($query); // Run the query.
			 

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					
					?>
					<label for="question_id">Question ID:  *</label><br />
					<input type="text" name="question_id" id="question_id" size="50" maxlength="128" value="<? echo $row["question_id"]; ?>"/><br />
					<label for="sequence">Sequence:  *</label><br />
					<input type="text" name="sequence" id="sequence" size="50" maxlength="128" value="<? echo $row["sequence"]; ?>"/><br />
					<label for="response_type">Response Type:  *</label><br />
					<input type="text" name="response_type" id="response_type" size="50" maxlength="128" value="<? echo $row["response_type"]; ?>"/><br />
					<label for="response_value_1">Response Value 1:  *</label><br />
					<input type="text" name="response_value_1" id="response_value_1" size="50" maxlength="128" value="<? echo $row["response_value_1"]; ?>"/><br />
					<label for="response_value_2">Response Value_2:  *</label><br />
					<input type="text" name="response_value_2" id="response_value_2" size="50" maxlength="128" value="<? echo $row["response_value_2"]; ?>"/><br />
					<label for="response_value_3">Response Value_3:  *</label><br />
					<input type="text" name="response_value_3" id="response_value_3" size="50" maxlength="128" value="<? echo $row["response_value_3"]; ?>"/><br />
					<input type="hidden" name="id" value="<? echo $row['id']; ?>" />
					<input type="submit" name="submit" value="Update Answer"/> 
					
					<?
					echo draw_hidden_field("dbaction", $value = 'update_confirm_answers');
					echo draw_form("edit_confirm_answers",$_SERVER['PHP_SELF'],"POST"); 
				}
		}
		}
	 

}else if($dbaction == "update_confirm_questions"){

	//define post vars and sanitize.
	$survey_id = mysql_real_escape_string($_POST['survey_id']);
	$sequence = mysql_real_escape_string($_POST['sequence']);
	$question = mysql_real_escape_string($_POST['question']);
	$description = mysql_real_escape_string($_POST['description']);
	$id = mysql_real_escape_string($_POST['id']);	
	
	
	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "UPDATE questions SET survey_id = '".$survey_id."', sequence ='".$sequence."', question = '".$question."', description = '".$description."' WHERE id = ".$id;

	$result = mysql_query($query);

	if($result){
		echo "<h1>Thank you for updating the question</h1>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};
	show_questions();


}else if($dbaction == "update_confirm_answers"){

	//define post vars and sanitize.$question_id = mysql_real_escape_string($_POST['question_id']);
	$sequence = mysql_real_escape_string($_POST['sequence']);
	$response_type = mysql_real_escape_string($_POST['response_type']);
	$response_value_1 = mysql_real_escape_string($_POST['response_value_1']);
	$response_value_2 = mysql_real_escape_string($_POST['response_value_2']);
	$response_value_3 = mysql_real_escape_string($_POST['response_value_3']);
	
	//INSERT INTO DB.  note that ID will auto_increment 
	$query = "UPDATE answers SET question_id = '".$question_id."', sequence ='".$sequence."', response_type = '".$response_type."', response_value_1 = '".$response_value_1."', response_value_2 = '".$response_value_2."', response_value_3 = '".$response_value_3."' WHERE id = ".$id;

	$result = mysql_query($query);

	if($result){
		echo "<h1>Thank you for updating the answer</h1>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};
	show_questions();

	
}else if($dbaction == "delete"){
	
	
	
	  $query = "SELECT ID, survey_id, sequence, question, description FROM questions ORDER BY question";		
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
			<th>Delete</th>
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
		echo draw_hidden_field("dbaction", $value = 'delete_confirm');
		echo '</form>';
		mysql_free_result ($result); // Free up the resources.
 	 }    

}else if($dbaction == "delete_confirm"){
	
    if (isset($_POST['questions']) && is_array($_POST['questions'])) {
      $questions = db_prepare_input($_POST['questions']);

      for ($i=0, $n=sizeof($questions); $i<$n; $i++) {

		$query = "DELETE FROM questions WHERE ID = ". (int)$questions[$i] . "";
		$result = mysql_query($query);
		}
		if($result){
			echo "<p>You have successfully updated the presents by removing ". $i+1 . " entries </p>";
			show_questions();
		}else{
			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
		};



      

    }


	
}else{       
// show all questions	
echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
echo "<fieldset>";
echo "<p>Welcome to the Edit Questions Page! Please select Add, Edit or Delete.</p>";
echo "<p><b>Add:</b>" .draw_radio_field("dbaction","add")."<b>Edit:</b>". draw_radio_field("dbaction","edit") .  "<b>Delete:</b>". draw_radio_field("dbaction","delete") . "</p>";
echo "</fieldset>";
echo '<div align="center"><input type="submit" name="submit" /></div>';
echo '</form><!-- End of Form -->';

show_questions();

	
}
?>

	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>