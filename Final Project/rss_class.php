<?
	header("Content-Type: application/xml; charset=UTF-8");
	include("rss.class.php");
	$rss = new RSS();
	echo $rss->GetFeed();
?>