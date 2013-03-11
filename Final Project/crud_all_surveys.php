<?php # crud_all_surveys

// Set the page title and include the HTML header.
$page_title = 'CRUD_ALL_SURVEYS';
require_once('./header.inc');
require_once('./html.php');
?>

<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>Add, Edit or Delete a Survey</b></p>
      <hr /> 
      <p>
	  
	  
	  
	  
<?php

$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : '');
                            
if($dbaction == "add"){
	echo "Add A Survey to the Database";
	
	echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
	echo "<fieldset>";
	echo "<p>Enter your information in the form below:</p>";
	echo "<p><b>Status:</b>". draw_input_field("status","","","text",true) ."</p>";
	echo "<p><b>Start Date:</b>". draw_input_field("start_date","","","text",true) ."</p>";
	echo "<p><b>End Date:</b>". draw_input_field("end_date","","","text",true) ."</p>";
	echo "<p><b>Description:</b>". draw_input_field("description","","","text",true) ."</p>";
	
	echo draw_hidden_field("dbaction", $value = 'add_confirm');
	echo "</fieldset>";
	echo '<div align="center"><input type="submit" name="submit" /></div>';
	echo '</form><!-- End of Form -->';
	
	
	show_surveys(); 
	
}elseif($dbaction == "add_confirm"){

	// Define post fields into simple variables

	$status = db_prepare_input($_POST['status']);
	$start_date = db_prepare_input($_POST['start_date']);
	$end_date = db_prepare_input($_POST['end_date']);
	$description = db_prepare_input($_POST['description']);
	

	//INSERT INTO DB

	// insert surveys into surveys DB
	$query = "INSERT INTO surveys (status, start_date, end_date, description) VALUES ('$status', '$start_date','$end_date','$description')";
	$result = mysql_query($query);
	
	if($result){
		echo "<p>Thank you for submitting a new survey.</p>";
			
		show_surveys();
		
	}else{
		echo "<p>There has been an error in inserting into the database:  ".mysql_error()."</p>";
	};

}else if($dbaction == "edit"){
	
	  $query = "SELECT id, status, start_date, end_date, description FROM surveys ORDER BY id";		
	  $result = mysql_query ($query); // Run the query.
	  if ($result) { // If it ran OK, display the records.

		echo draw_form("edit",$_SERVER['PHP_SELF'],"POST");    
		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
			<th>ID</th> 
		    <th>Status</th> 
		    <th>Start Date</th> 
		    <th>End Date</th>
		    <th>Update</th>	 
		</tr> 
		</thead>';


		// Fetch and print all the records.
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<tr><td>".$row["id"]."</td><td>".$row["status"]."</td><td>".$row["start_date"]."</td><td>".$row["end_date"]."</td><td><input name=\"update[]\" type=\"radio\" value=". $row["id"] ."></td></tr>\n";
		}

		echo '</table>';
		echo '<table align="center" cellspacing="2" cellpadding="2"><tr><td align="left">';
		echo '<input type="hidden" name="dbaction" value="edit_confirm" />';
		echo '<input type="submit" name="Submit" value="update records!" />';
		echo '</td></tr></table>';
		echo '</form>';
		mysql_free_result ($result); // Free up the resources.
      }

}else if($dbaction == "edit_confirm"){     
	echo draw_form("edit_confirm",$_SERVER['PHP_SELF'],"POST");    
   
	$myUpdate = $_POST['update']; 
	    if(isset($myUpdate)){


		foreach($myUpdate as $value){

			 $id = (int)($value);

			 $query = "SELECT id, status, start_date, end_date, description FROM surveys WHERE id IN (".$id.") ORDER BY id";		
			 $result = mysql_query ($query); // Run the query.
			 

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

					?>
					<label for="status">Status:  *</label><br />
					<input type="text" name="status" id="status" size="50" maxlength="128" value="<? echo $row["status"]; ?>"/><br />
					<label for="start_date">Start Date:  *</label><br />
					<input type="text" name="start_date" id="start" size="50" maxlength="128" value="<? echo $row["start_date"]; ?>"/><br />
					<label for="end_date">End Date:  *</label><br />
					<input type="text" name="end_date" id="end" size="50" maxlength="128" value="<? echo $row["end_date"]; ?>" /><br />
					<label for="description">Description:  *</label><br />
					<input type="text" name="description" id="description" size="50" maxlength="128" value="<? echo $row["description"]; ?>"  /><br />
					<input type="hidden" name="id" value="<? echo $row['id']; ?>" />
					<input type="submit" name="submit" value="Update"/> 
					<br />
					<?			
					echo draw_hidden_field("dbaction", $value = 'update_confirm');
		
				}
		}

	} 

}else if($dbaction == "update_confirm"){

	//define post vars and sanitize.
	$status = mysql_real_escape_string($_POST['status']);
	$start_date = mysql_real_escape_string($_POST['start_date']);
	$end_date = mysql_real_escape_string($_POST['end_date']);
	$description = mysql_real_escape_string($_POST['description']);
	$id = mysql_real_escape_string($_POST['id']);	

	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "UPDATE surveys SET status = '".$status."', start_date ='".$start_date."', end_date = '".$end_date."', description = '".$description."' WHERE id = ".$id;

	$result = mysql_query($query);

	if($result){
		echo "<h1>Thank you for updating the survey.</h1>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};
	show_surveys();


}else if($dbaction == "delete"){
	
	
	
	  $query = "SELECT ID, status, start_date, end_date, description FROM surveys ORDER BY start_date";		
	  $result = mysql_query($query); // Run the query.
	  if ($result) { // If it ran OK, display the records.

	  	echo draw_form("register",$_SERVER['PHP_SELF'],"POST");			
		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
		    <th>Status</th> 
		    <th>Start Date</th> 
		    <th>End Date</th> 
			<th>Description</th>
		</tr> 
		</thead>';
		
		
		// Fetch and print all the records.
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\">$row[1]</td><td align=\"left\">$row[2]</td><td align=\"left\">$row[3]</td><td align=\"left\"> ".draw_checkbox_field('surveys[]', $row[0], false) ."</td></tr>\n";
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
	
    if (isset($_POST['surveys']) && is_array($_POST['surveys'])) {
      $surveys = db_prepare_input($_POST['surveys']);

      for ($i=0, $n=sizeof($surveys); $i<$n; $i++) {

		$query = "DELETE FROM surveys WHERE ID = ". (int)$surveys[$i] . "";
		$result = mysql_query($query);
		}
		if($result){
			echo "<p>You have successfully updated the surveys by removing ". $i+1 . " entries </p>";
			show_surveys();
		}else{
			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
		};



      

    }


	
}else{       
// show all surveys	
echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
echo "<fieldset>";
echo "<p>Welcome to the Edit Surveys Page! Please select Add, Edit or Delete.</p>";
echo "<p><b>Add:</b>" .draw_radio_field("dbaction","add")."<b>Edit:</b>". draw_radio_field("dbaction","edit") .  "<b>Delete:</b>". draw_radio_field("dbaction","delete") . "</p>";
echo "</fieldset>";
echo '<div align="center"><input type="submit" name="submit" /></div>';
echo '</form><!-- End of Form -->';

show_surveys();

	
}
?>

	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>