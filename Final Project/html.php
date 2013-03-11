<?php # Script 4.5 - html.php

function parse_input_field_data($data, $parse) {
  return strtr(trim($data), $parse);
}

function output_string($string, $translate = false, $protected = false) {
  if ($protected == true) {
    return htmlspecialchars($string);
  } else {
    if ($translate == false) {
      return parse_input_field_data($string, array('"' => '&quot;'));
    } else {
      return parse_input_field_data($string, $translate);
    }
  }
}

function output_string_protected($string) {
  return output_string($string, false, true);
}

function sanitize_string($string) {
  $string = ereg_replace(' +', ' ', trim($string));
  return preg_replace("/[<>]/", '_', $string);
}

// Output a form
  function draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . output_string($name) . '" action="' . output_string($action) . '" method="' . output_string($method) . '"';

    if (!is_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }


 function draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (!is_null($value)) {
      $field .= ' value="' . output_string($value) . '"';
    }

    if (!is_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Output a form password field
  function draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for draw_checkbox_field() and draw_radio_field()
  function draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    $selection = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if (!is_null($value)) $selection .= ' value="' . output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
      $selection .= ' CHECKED';
    }

    if (!is_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . output_string($name) . '" wrap="' . output_string($wrap) . '" cols="' . output_string($width) . '" rows="' . output_string($height) . '"';

    if (!is_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= stripslashes($GLOBALS[$name]);
    } elseif (!is_null($text)) {
      $field .= $text;
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . output_string($name) . '"';

    if (!is_null($value)) {
      $field .= ' value="' . output_string($value) . '"';
    } elseif (isset($GLOBALS[$name])) {
      $field .= ' value="' . output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (!is_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

/****************************

Database Function that cleans strings for usage safely in mysql statements.
Recursive abilities to loop through arrays

*****************************/

  function db_prepare_input($string) {
    if (is_string($string)) {
      return trim(mysql_real_escape_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }




/****************************

Show questions by Start date

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
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>\n";
			}

			echo '</table>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}

		mysql_close(); // Close the database connection.
	}
	
	
/****************************

Show surveys by Start date

*****************************/
	function show_surveys(){
		$query = "SELECT status, start_date, end_date, description, created, modified FROM surveys ORDER BY modified";		
		$result = mysql_query ($query); // Run the query.
		if ($result) { // If it ran OK, display the records.


			echo '
			<table align="center" cellspacing="2" cellpadding="2" id="tablesorter" class="tablesorter">
			<thead> 
				<tr> 
					<th>Status</th> 
					<th>Sequence</th> 
					<th>Question</th> 
					<th>Description</th>
					<th>Created</th>
					<th>Modified</th>		
				</tr> 
			</thead>';
			

			// Fetch and print all the records.
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>\n";
			}

			echo '</table>';
			mysql_free_result ($result); // Free up the resources.	

		} else { // If it did not run OK.
			echo '<p>The questions could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}

		mysql_close(); // Close the database connection.
	}



?>