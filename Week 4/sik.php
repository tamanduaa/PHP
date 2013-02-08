<?php # Script 3.17 - sik.php
// Set the page title and include the HTML header.
$page_title = 'Shakespear Insult Kit';
include ('header.inc');

if(isset($_POST['insult'])){

// handle form

echo "<b>Thou art a {$_POST['insult1']}, {$_POST['insult2']}, {$_POST['insult3']}!!</b>";


}else{



// This function makes three pull down menus

function make_insult_pulldown($this_insult1 = NULL,$this_insult2 = NULL,$this_insult3 = NULL) {

$query = "SELECT list_1,list_2,list_3 FROM insult";		
$result = mysql_query ($query); // Run the query.

if ($result) { // If it ran OK, display the records.

	// Fetch and print all the records.
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		//the short hand array syntax will allow you to populate an array with a numerical key.
		$insult_1[] = $row[0];
		$insult_2[] = $row[1];
		$insult_3[] = $row[2];
	}

	mysql_free_result ($result); // Free up the resources.	

} else { // If it did not run OK.
	echo '<p>The insult could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
}

	// We previously contained the data in hard coded arrays.  Now with a simple SELECT statement we can dynamically adjust this data.
	//$insult_1 = array(1 => "artless","bawdy","beslubbering","bootless","churlish","cockered","clouted","craven","currish","dankish","dissembling","droning","errant","fawning","fobbing","froward","frothy","gleeking","goatish","gorbellied","impertienent","infectious","jarring","loggerheaded","lumpish","mammering","mangled","mewling","paunchy","pribbling","puking","puny","qualling","rank","reeky","roguish","ruttish","saucy","spleeny","spongy","surly","tottering","unmuzzled","vain","venomed","villianous","warped","wayward","weedy","yeasty");
	//$insult_2 = array(1 => "base-court","bat-fowling","beef-witted","beetle-headed","boil-brained","clapper-clawed","clay-brained","common-kissing","crook-pated","dismal-dreaming","dizzy-eyed","doghearted","dread-bolted","earth-vexing","elf-skinned","fat-kidneyed","fen-sucked","flap-mouthed","fly-bitten","folly-fallen","fool-born","full-gorged","guts-griping","half-faced","hasty-witted","hedge-born","hell-hated","idle-headed","ill-breeding","ill-nurtured","knotty-pated","milk-livered","motley-minded","onion-eyed","plume-plucked","pottle-deep","pox-marked","reeling-ripe","rough-hewn","rude-growing","rump-fed","shard-borne","sheep-biting","spur-galled","swag-bellied","tardy-gaited","tickle-brained","toad-spotted","unchin-snouted","weather-bitten");
	//$insult_3 = array(1 => "apple-john","baggage","barnacle","bladder","boar-pig","bugbear","bum-bailey","canker-blossom","clack-dish","clotpole","coxcomb","codpiece","death-token","dewberry","flap-dragon","flax-wench","flirt-gill","foot-licker","fustilarian","giglet","gudgeon","haggard","harpy","hedge-pig","horn-beast","hugger-mugger","joithead","lewdster","lout","maggot-pie","malt-worm","mammet","measle","minnow","miscreant","moldwarp","mimble-news","nut-hook","pigeon-egg","pignut","puttock","pumpion","ratsbane","scut","skainsmate","strumpet","varlet","vassal","whey-face","wagtail");

	

	// Make the pull down menus.

echo '<select name="insult1">';

	foreach ($insult_1 as $key => $value) {

		echo "<option value=\"$value\"";

		if ($value == $this_insult1) {

			echo ' selected="selected"';

		}
		
			echo ">$value</option>\n";
	

	}

	echo '</select>';

	

echo '<select name="insult2">';

	foreach ($insult_2 as $key => $value) {

		echo "<option value=\"$value\"";

		if ($value == $this_insult2) {

			echo ' selected="selected"';

		}

		echo ">$value</option>\n";

	}

	echo '</select>';

	

	

echo '<select name="insult3">';

	foreach ($insult_3 as $key => $value) {

		echo "<option value=\"$value\"";

		if ($value == $this_insult3) {

			echo ' selected="selected"';

		}

		echo ">$value</option>\n";

	}

	echo '</select>';

	

} // End of the make_insult_pulldown() function.



?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<?

make_insult_pulldown(); // Make the insult.

echo '<div align="left"><input type="submit" name="insult" value="insult!" /></div>';

echo '</form>'; // End of form.

}//end of if\else statement

	

include ('footer.inc'); // Include the HTML footer.

?>