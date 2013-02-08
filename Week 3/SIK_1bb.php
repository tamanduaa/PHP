<?php # Script 3.17 - sik.php
// Set the page title and include the HTML header.
$page_title = 'Shakespeare Insult Kit';
include ('./header.inc');

$myInsult;

if(isset($_POST['insult'])){
// handle form
echo "<b>Thou art a {$_POST['insult1']}, {$_POST['insult2']}, {$_POST['insult3']}</b>";
}else{

// This function makes three pull down menus
function make_insult_pulldown($this_insult1 = NULL,$this_insult2 = NULL,$this_insult3 = NULL) {

	// Make the multidimensional array.
	$insults = array(
	
		'insult_1' => array(1 => "artless","bawdy","beslubbering","bootless","churlish","cockered","clouted","craven","currish","dankish","dissembling","droning","errant","fawning","fobbing","froward","frothy","gleeking","goatish","gorbellied","impertienent","infectious","jarring","loggerheaded","lumpish","mammering","mangled","mewling","paunchy","pribbling","puking","puny","qualling","rank","reeky","roguish","ruttish","saucy","spleeny","spongy","surly","tottering","unmuzzled","vain","venomed","villianous","warped","wayward","weedy","yeasty"),
		
		'insult_2' => array(1 => "base-court","bat-fowling","beef-witted","beetle-headed","boil-brained","clapper-clawed","clay-brained","common-kissing","crook-pated","dismal-dreaming","dizzy-eyed","doghearted","dread-bolted","earth-vexing","elf-skinned","fat-kidneyed","fen-sucked","flap-mouthed","fly-bitten","folly-fallen","fool-born","full-gorged","guts-griping","half-faced","hasty-witted","hedge-born","hell-hated","idle-headed","ill-breeding","ill-nurtured","knotty-pated","milk-livered","motley-minded","onion-eyed","plume-plucked","pottle-deep","pox-marked","reeling-ripe","rough-hewn","rude-growing","rump-fed","shard-borne","sheep-biting","spur-galled","swag-bellied","tardy-gaited","tickle-brained","toad-spotted","unchin-snouted","weather-bitten"),
		
		'insult_3' => array(1 => "apple-john","baggage","barnacle","bladder","boar-pig","bugbear","bum-bailey","canker-blossom","clack-dish","clotpole","coxcomb","codpiece","death-token","dewberry","flap-dragon","flax-wench","flirt-gill","foot-licker","fustilarian","giglet","gudgeon","haggard","harpy","hedge-pig","horn-beast","hugger-mugger","joithead","lewdster","lout","maggot-pie","malt-worm","mammet","measle","minnow","miscreant","moldwarp","mimble-news","nut-hook","pigeon-egg","pignut","puttock","pumpion","ratsbane","scut","skainsmate","strumpet","varlet","vassal","whey-face","wagtail"),
	);
	
	// Make the pull down menus.
function createInsult($insults, $selectName){
	//this is writing the html:
	//<select name="insulted">
		//<option value="insulted">insultAry</option>
		//<option value="insulted">insultAry</option>
		//<option value="insulted">insultAry</option>
		//<option value="insulted">insultAry</option>
		//...for all insultArys
	//</select>
	echo "<select name=".$selectName.">";
	foreach ($insults as $insultAry) {
		echo "<option value=\"$insultAry\"";
		if ($insultAry == $this_myInsult){
			echo ' selected="selected"';
		}
		echo ">$insultAry</option>\n";
	}
	echo '</select>';
	}
	

createInsult($insults['insult_1'],'insult1');

createInsult($insults['insult_2'],'insult2');

createInsult($insults['insult_3'],'insult3');



}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<?


make_insult_pulldown(); // Make the insult.
echo '<div align="left"><input type="submit" name="insult" value="insult" /></div>';
echo '</form>'; // End of form.
}//end of if\else statement

include ('./footer.inc'); // Include the HTML footer.
?>