<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'Questions - XML';
include ('./header.inc');
require_once('db_config_inc.php');
?>
<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>XML Questions List</b></font></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>XML President List</b></p>
      <hr /> 
      <p>	  
	  <?php
	  
	    $query = "SELECT * FROM rss_questions";		
		$result = @mysql_query ($query); // Run the query.
		$num = mysql_num_rows($result);
		if ($num != 0) {
			$file= fopen("questions.xml", "w");
			$_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
			$_xml .="<questions>\r\n";
			while ($row = mysql_fetch_array($result)) {
				if ($row["survey_id"]) {
					$_xml .="\t<survey_id=\"" . $row["survey_id"] . "\">\r\n";
					$_xml .="\t\t<sequence>" . $row["sequence"] . "</sequence>\r\n";
					$_xml .="\t\t<question>" . $row["question"] . "</question>\r\n";
					$_xml .="\t\t<description>" . $row["description"] . "</description>\r\n";
					$_xml .="\t\t<response_type>" . $row["response_type"] . "</response_type>\r\n";
					$_xml .="\t\t<response_value>" . $row["response_value"] . "</response_value>\r\n";
					$_xml .="\t</question>\r\n";
			 	} else {
 					$_xml .="\t<survey_id=\"Nothing Returned\">\r\n";
					$_xml .="\t\t<sequence>none</sequence>\r\n";
					$_xml .="\t</question>\r\n";
 				} 
			}
			$_xml .="</questions>";
	 		fwrite($file, $_xml);
			fclose($file);
			echo "XML has been written.  <a href=\"questions.xml\">View the XML.</a>";
		} else {
		 	echo "No Records found";
		} 
 		?>
	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>