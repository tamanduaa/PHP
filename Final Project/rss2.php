<?php
include('db.php');
$sql = "SELECT * FROM rss_survey ORDER BY id DESC LIMIT 20"; 
$query = mysql_query($sql) or die(mysql_error());

header("Content-type: text/xml"); 

echo "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0'>
<channel>
<title>Building Energy Savings</title>
<link>http://depts.washington.edu/wts2010b/students/lperry87/Final%20Project/</link>
<description>Building Energy Savings</description>
<language>en-us</language>"; 

while($row = mysql_fetch_array($query))
{
$title=$row['title']; 
$link=$row['link']; 
$description=$row['description']; 

echo "<item> 
<title>$title</title>
<link>$link</link>
<description>$description</description>
</item>"; 
} 
echo "</channel></rss>"; 
?>