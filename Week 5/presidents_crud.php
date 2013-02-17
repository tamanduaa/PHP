<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'US Presidents - All CRUD IN ONE PAGE';
require_once('./header.inc');
require_once('./html.php');

// CONNECT TO DB
if ($dbc = @mysql_connect ('wts2010b.ovid.u.washington.edu:2931', 'lperry87', 'lperry87')) {
  print '<p>Successfully connected to MySQL!</p>';
} else {
  print '<p style="color: red;">Could not connect to MySQL:<br />' .  mysql_error() . '.</p>';
}
$dbconn = mysql_select_db("lperry87");
	if(!$dbconn)
	{
		echo "Could not connect to database " . "presidents";
	   exit;
	}
// END CONNECT TO DB SECTION

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

	$first_name = db_prepare_input($_POST['first_name']);
	$last_name = db_prepare_input($_POST['last_name']);
	$startdate = db_prepare_input($_POST['startdate']);
	$enddate = db_prepare_input($_POST['enddate']);

	//INSERT INTO DB

	$query = "INSERT INTO presidents (first_name, last_name, startdate, enddate) VALUES ('$first_name', '$last_name','$startdate','$enddate')";
	$result = mysql_query($query);

	if($result){
		echo "<p>Thank you for submitting a new president.  We think ". $first_name . " ".$last_name ." is an odd name</p>";
	}else{
		echo "<p>There has been an error in inserting into the database:  ".mysql_error()."</p>";
	};
// END ADD SECTION


// EDIT
}else if($dbaction == "edit"){
	
	$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : 'show');
	/* above statement is same as 
		if(isset($_POST['dbaction'])){
		$dbaction = $_POST['dbaction'];
		}else{
		$dbaction = 'show';	
	*/
if($dbaction == "show"){


		  $query = "SELECT id, CONCAT(last_name, ', ', first_name) AS name, startdate, enddate FROM presidents ORDER BY id";		
		  $result = mysql_query ($query, $dbc); // Run the query.
		  if ($result) { // If it ran OK, display the records.

		  	?>
			<form name="form1"  action="http://depts.washington.edu/wts2010b/students/lperry87/lesson_4_all.php" method="POST">
			<?		
			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
			<thead> 
			<tr> 
				<th>ID</th> 
			    <th>Name</th> 
			    <th>Start</th> 
			    <th>End</th>
			    <th>Update</th>	 
			</tr> 
			</thead>';


			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["startdate"]."</td><td>".$row["enddate"]."</td><td><input name=\"update[]\" type=\"radio\" value=". $row["id"] ."></td></tr>\n";
			}

			echo '</table>';
			echo '<table align="center" cellspacing="2" cellpadding="2"><tr><td align="left">';
			echo '<input type="hidden" name="dbaction" value="edit" />';
			echo '<input type="submit" name="Submit" value="update records!" />';
			echo '</td></tr></table>';
			echo '</form>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The presidents could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}

		//mysql_close(); // Close the database connection.


}else if($dbaction == "edit"){

    ?>
	<div id="formarea">
	<form name="form1" action="http://depts.washington.edu/wts2010b/students/lperry87/lesson_4_all.php" method="post">
	<?

	foreach($_POST['update'] as $value){

		 $id = mysql_real_escape_string($value);

		 $query = "SELECT id, last_name,  first_name, startdate, enddate, party FROM presidents WHERE id IN (".$id.") ORDER BY id";		
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
	
}else{
	echo "error: no action";
}
?>	
	  </p>
      </td>
  </tr>
</table>
<?
// END EDIT SECTION


}else if($dbaction == "delete"){
	
    if (isset($_POST['presidents']) && is_array($_POST['presidents'])) {
      $presidents = db_prepare_input($_POST['presidents']);

      for ($i=0, $n=sizeof($presidents); $i<$n; $i++) {

		$query = "DELETE FROM presidents WHERE ID = ". (int)$presidents[$i] . "";
		$result = mysql_query($query);

		if($result){
			echo "<p>You have successfully updated the presents by removing ". $i+1 . " entries </p>";
		}else{
			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
		};



      }

    }


	
}else{
}




$action = (isset($_GET['action']) ? $_GET['action'] : '');

if ($action) {
	
	if($action == "add"){
		echo "Add A President to the Database";
		
		echo draw_form("register",$_SERVER['PHP_SELF'],"POST");
		echo "<fieldset>";
		echo "<p>Enter your information in the form below:</p>";
		echo "<p><b>First Name:</b>". draw_input_field("first_name","first_name","","text",true) ."</p>";
		echo "<p><b>Last Name:</b>". draw_input_field("last_name","last_name","","text",true) ."</p>";
		echo "<p><b>Start Date:</b>". draw_input_field("startdate","startdate","","text",true) ."</p>";
		echo "<p><b>End Date:</b>". draw_input_field("enddate","enddate","","text",true) ."</p>";
		echo draw_hidden_field("dbaction", $value = 'add');
		echo "</fieldset>";
		echo '<div align="center"><input type="submit" name="submit" /></div>';
		echo '</form><!-- End of Form -->';
		
		
		show_presidents();
	}else if($action == "edit"){
		echo "edit";
		show_presidents();
	}else if($action == "delete"){
		
		
		  $query = "SELECT ID, CONCAT(last_name, ', ', first_name) AS name, startdate, enddate FROM presidents ORDER BY startdate";		
		  $result = mysql_query($query); // Run the query.
		  if ($result) { // If it ran OK, display the records.

		  	echo draw_form("register",$_SERVER['PHP_SELF'],"POST");			
			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
			<thead> 
			<tr> 
			    <th>Name</th> 
			    <th>Start</th> 
			    <th>End</th> 
			    <th>Delete</th> 			
			</tr> 
			</thead>';
			
			
			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td align=\"left\">$row[1]</td><td align=\"left\">$row[2]</td><td align=\"left\">$row[3]</td><td align=\"left\"> ".draw_checkbox_field('presidents[]', $row[0], false) ."</td></tr>\n";
			}

			echo '</table>';
			echo '<table align="center" cellspacing="2" cellpadding="2"><tr><td align="left">';
			echo "<input type=\"submit\" name=\"Submit\" value=\"delete records!\" class=\"butt\" alt=\"Delete\"/>";
			echo '</td></tr></table>';
			echo draw_hidden_field("dbaction", $value = 'delete');
			echo '</form>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The presidents could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}
		
	}else{
		echo "Woah Buddy, hold back, I can see something went wrong here! Let's just all calm down";
		show_presidents();
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

	show_presidents();

}  // end page view if\else

?>

	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>