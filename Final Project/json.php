<?php # Script 3.4 - index.php
require_once('db_config_inc.php');
?>
   
	  <?php
	  
	    $query = "SELECT * FROM rss_questions";		
		$result = @mysql_query ($query); // Run the query.
		$num = mysql_num_rows($result);
		if ($num != 0) {
			$file= fopen("questions.xml", "w");
			$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
			$_xml .="<questions>\r\n";
			while ($row = mysql_fetch_array($result)) {
				  $questions[] = $row;
			}
			echo '{"presidents":'.json_encode($questions).'}';

		} else {
		 	echo "No Records found";
		} 
 		?>
  