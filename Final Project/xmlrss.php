<?php # Script 3.4 - index.php

// Set the page title and include the HTML header.
$page_title = 'Questions - XML RSS';
include ('./header.inc');
require_once('db_config_inc.php');
?>
<table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
  <tr bgcolor="#333333"> 
    <td> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;!&nbsp;</td>
          <td width="100%"> <font color="#CCCCCC"> <b>XML RSS Question List</b></font></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="90%" border="0" cellspacing="4" cellpadding="4" align="center">
  <tr> 
    <td width="70%" valign="top"> <p><b>XML RSS Question List</b></p>
      <hr /> 
      <p>	  
	  <?php
	  
	    $query = "SELECT * FROM rss_questions ORDER BY ID desc LIMIT 5";		
		$result = mysql_query ($query); // Run the query.
		$num = mysql_num_rows($result);
		if ($num != 0) {
			$file = fopen("rss.xml", "w");
			$_roll = "<?xml version=\"1.0\"?>\r\n";
			$_roll .= "\t<rss version='2.0'>\r\n";
			$_roll .= "\t\t<channel>\r\n";
			$_roll .= "\t\t\t<title>Survey Question News</title>\r\n";
			$_roll .= "\t\t\t<link>http://140.142.222.8/~mongillo/</link>\r\n";
			$_roll .= "\t\t\t<description>List latest question activity</description>\r\n";
			$_roll .= "\t\t\t<language>en-us</language>\r\n";
			
			
			while ($row = mysql_fetch_array($result)) {
				if ($row["first_name"]) {
					$_roll .= "\t\t\t\t<item>\r\n";
					$headline = $row["ID"];
					$content = $row["desc"];
					$item_link = "http://140.142.222.8/~mongillo/";
					$_roll .= "\t\t\t\t\t<title>$headline</title>\r\n";
					$_roll .= "\t\t\t\t\t<description>$content</description>\r\n";
					$_roll .= "\t\t\t\t\t<link>$item_link</link>\r\n";
					$_roll .= "\t\t\t\t</item>\r\n";
				}
			}
			
			$_roll .= "\t\t</channel>\r\n";
			$_roll .= "\t</rss>\r\n";
	 		fwrite($file, $_roll);
			fclose($file);
			echo "RSS has been written.  <a href=\"rss.xml\">View the RSS-XML.</a>";
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