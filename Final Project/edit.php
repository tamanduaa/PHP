<div id="formarea">
	<form name="form1" action="http://depts.washington.edu/wts2010b/students/lperry87/Final%20Project/edit.php" method="post">
	<?

	foreach($_POST['update'] as $value){

		 $id = mysql_real_escape_string($value);

		 $query = "SELECT id, survey_id, sequence, question, description FROM questions WHERE id IN (".$id.") ORDER BY id";		
		 $result = mysql_query ($query); // Run the query.
		
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

				?>
				<label for="first_name">First Name:  *</label><br />
				<input type="text" name="first_name" id="first_name" size="50" maxlength="128" value="<? echo $row["first_name"]; ?>"/><br />
				<label for="last_name">Last Name:  *</label><br />
				<input type="text" name="last_name" id="last_name" size="50" maxlength="128" value="<? echo $row["last_name"]; ?>"  /><br />
				<label for="startdate">Start Date:  *</label><br />
				<input type="text" name="startdate" id="start" size="50" maxlength="128" value="<? echo $row["startdate"]; ?>"/><br />
				<label for="enddate">End Date:  *</label><br />
				<input type="text" name="enddate" id="end" size="50" maxlength="128" value="<? echo $row["enddate"]; ?>" /><br />
				<label for="party">Party:  *</label><br />
				<input type="text" name="party" id="party" size="50" maxlength="128" value="<? echo $row["party"]; ?>"/><br />
				<input type="hidden" name="id" value="<? echo $row['id']; ?>" />
				<br />
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


	

	//define post vars and sanitize.
	$first_name = mysql_real_escape_string($_POST['first_name']);
	$last_name = mysql_real_escape_string($_POST['last_name']);
	$startdate = mysql_real_escape_string($_POST['startdate']);
	$enddate = mysql_real_escape_string($_POST['enddate']);
	$party = mysql_real_escape_string($_POST['party']);
	$id = mysql_real_escape_string($_POST['id']);	

	//INSERT INTO DB.  note that ID will auto_increment 

	$query = "UPDATE presidents SET first_name = '".$first_name."', last_name ='".$last_name."', startdate = '".$enddate."', enddate = '".$enddate."', party = '".$party."' WHERE id = ".$id;

	$result = mysql_query($query);

	if($result){
		echo "<h1>Thank you for updating the president</h1>";
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
	};

	// show the results again
	$query = "SELECT CONCAT(last_name, ', ', first_name) AS name, startdate, enddate, party FROM presidents ORDER BY startdate";		
	$result = mysql_query ($query); 
	if ($result) { 

		echo '
		<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
		<thead> 
		<tr> 
		    <th>Name</th> 
		    <th>Dates</th> 
			<th>Party</th> 
		</tr> 
		</thead>';

		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td>". $row[0]. "</td><td>". $row[1] . " - " . $row[2] ."</td><td>".$row[3]."</td></tr>\n";
		}
		echo '</table>';
		mysql_free_result ($result); // Free up the resources.	
	} else {
		echo '<p>The presidents could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
	}
	


?>	
	  </p>
      </td>
  </tr>
</table>
<?