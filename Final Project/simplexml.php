<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'Questions - View';
include ('./header.inc');
require_once('db_config_inc.php');
?>
<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>View Question List</b></font></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>View Question List</b></p>
      <hr /> 
      <p>	  
	  <?php
	
		if (file_exists('questions.xml')) {
		    $xml = simplexml_load_file('questions.xml');
		
				//$pres = new SimpleXMLElement($xml);
				//echo $pres->president->last_name; // "PHP solves all my web problems"
				echo $xml->questions[3]->question;
				echo "<pre>";
		    print_r($xml);
				echo "</pre>";
		} else {
		    exit('Failed to open questions.xml.');
		}
	

	  
	  ?>
	  </p>
      </td>
  </tr>
</table>
<?php
include ('./footer.inc'); // Include the HTML footer.
?>