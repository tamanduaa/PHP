<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	  <title>View A Quotation</title>
	</head>
	<body>
		<h1>Random Quotation</h1>
		<?php // Script 11.3 - view_quote.php
		
		// Read the file contents and store them as an array
		$data = file('../quotes.txt');
		
		// Pick a random number base on the number of elements in $data
		$n = count($data);
		$rand = rand(0, ($n - 1));
		
		// Print the quotation
		print '<p>' . trim($data[$rand]) . '</p>';
		
		readfile('../quotes.txt');
		
		?>
	</body>
</html>
