<?php # Create Form

$page_title = 'Create Form';
require_once('./header.inc');
require_once('./html.php');

//define variables

	$survey_id = mysql_real_escape_string($_POST['survey_id']);
	$sequence = mysql_real_escape_string($_POST['sequence']);
	$question = mysql_real_escape_string($_POST['question']);
	$description = mysql_real_escape_string($_POST['description']);
	
	$question_id = mysql_real_escape_string($_POST['question_id']);
	$response_type = mysql_real_escape_string($_POST['response_type']);
	$response_value_1 = mysql_real_escape_string($_POST['response_value_1']);
	$response_value_2 = mysql_real_escape_string($_POST['response_value_2']);
	$response_value_3 = mysql_real_escape_string($_POST['response_value_3']);
	
	$id = mysql_real_escape_string($_POST['id']);


// select questions from questions DB

$query = "SELECT * FROM questions WHERE survey_id = 1";
$result = mysql_query($query);


// select corresponding answers from answers DB


$query = "SELECT * FROM answers";
$result = mysql_query($query);

// write questions and answers to form


foreach ($question_id as $key => value)	
	echo "<p>$question:</p></br> . <p>$response_value_1:</p></br> . <p>$response_value_2:</p></br> . <p>$response_value_3:</p></br>"; 




?>