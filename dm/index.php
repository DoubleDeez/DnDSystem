<?php
include("../include/vars.php");
include("../include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

session_start();

if (isset($_SESSION['sid']) && isset($_SESSION['id'])) {
	$id = ($_SESSION['id']);
	$query = "SELECT * FROM users WHERE id='$id'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);

	if (!(isset($row['token'])) || ($row['token'] != $_SESSION['sid'])) {
		header("Location: login.php");
		exit();
	}
} else {
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
        <title>D&D Management System</title>
    </head>
    <body>
		<script>
			var rank = <?php echo $_SESSION['rank']; ?>;
			var id = <?php echo $_SESSION['id']; ?>;
		</script>
		<div id='menu'><a href='#' id='infoBtn'>Info</a> | <a href='#' id='addCharBtn'>Add a Character</a> | <a href='#' id='editCharBtn'>Edit a Character</a><?php if ($_SESSION['rank'] >= 10) { ?> | <a href='#' id='addEnemiesBtn'>Add an Enemy</a> | <a href='#' id='editEnemiesBtn'>Edit Enemies</a> | <a href='#' id='userListBtn'>User List</a> | <a href='#' id='dmToolsBtn'>DM Tools</a><?php } ?> | <a href='#' id='logoutBtn'>Log Out</a></div>
		<span id='message' class='errMsg'></span>
		<br/>
		<div id='main'>
			<div id='info'>This is basic as shit for now, I'll work on making the entire thing better later.</div>
			<!-- Add Character Page -->
			<div id='addChar'>
				<label for="name">Name: </label>
				<input type="text" id="name" />
				<br />
				<label for="name">Class: </label>
				<input type="text" id="class" />
				<br />
				<label for="name">Max Health Points: </label>
				<input type="text" id="maxhp" />
				<br />
				<label for="name">AC: </label>
				<input type="text" id="ac" />
				<br />
				<label for="name">Fortitude: </label>
				<input type="text" id="fort" />
				<br />
				<label for="name">Reflex: </label>
				<input type="text" id="reflex" />
				<br />
				<label for="name">Will: </label>
				<input type="text" id="will" />
				<br />
				<?php if ($_SESSION['rank'] >= 10) { ?>
					<label for="name">User ID: </label>
					<input type="text" id="userid" />
					<br />
				<?php } else { ?>
					<input type="hidden" id="userid" value="<?php echo $_SESSION['id']; ?>" />
				<?php } ?>
				<input type="button" id="addCharAction" value="Create Character" />
			</div>
			<!-- Edit Character Page -->
			<div id='editChar'>
				<div id="editCharList">
				</div>
				<br />
				<div style="float:left;padding-right:50px;">
					<input type="hidden" id="editid" />
					<label style="float:left;" for="name">Name: </label>
					<input style="float:right;" type="text" id="editname" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editclass">Class: </label>
					<input style="float:right;" type="text" id="editclass" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editinit">Initiative Bonus: </label>
					<input style="float:right;" type="text" id="editinit" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editinitroll">Encounter Initiative: </label>
					<input style="float:right;" type="text" id="editinitroll" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithp">Current Health Points: </label>
					<input style="float:right;" type="text" id="edithp" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editmaxhp">Max Health Points: </label>
					<input style="float:right;" type="text" id="editmaxhp" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edittemphp">Temporary Health Points: </label>
					<input style="float:right;" type="text" id="edittemphp" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithsval">Healing Surge Value: </label>
					<input style="float:right;" type="text" id="edithsval" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithsdaily">Healing Surges / day: </label>
					<input style="float:right;" type="text" id="edithsdaily" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithsleft">Healing Surges Remaining: </label>
					<input style="float:right;" type="text" id="edithsleft" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithswind">Second Wind Available? </label>
					<input style="float:right;" type="checkbox" id="edithswind" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editap">Action Points: </label>
					<input style="float:right;" type="text" id="editap" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editspeed">Speed: </label>
					<input style="float:right;" type="text" id="editspeed" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editvision">Vision: </label>
					<input style="float:right;" type="text" id="editvision" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editexp">Total EXP: </label>
					<input style="float:right;" type="text" id="editexp" class="editChar" />
					<br style="clear:both;" />
				</div>
				<div style="float:left;padding-right:50px;">
					<label style="float:left;" for="editac">AC: </label>
					<input style="float:right;" type="text" id="editac" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editfort">Fortitude: </label>
					<input style="float:right;" type="text" id="editfort" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editreflex">Reflex: </label>
					<input style="float:right;" type="text" id="editreflex" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editwill">Will: </label>
					<input style="float:right;" type="text" id="editwill" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editstr">Base Strength: </label>
					<input style="float:right;" type="text" id="editstr" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editstrMod">Strength Modifier: </label>
					<input style="float:right;" type="text" id="editstrMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editcon">Base Constitution: </label>
					<input style="float:right;" type="text" id="editcon" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editconMod">Constitution Modifier: </label>
					<input style="float:right;" type="text" id="editconMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editdex">Base Dexterity: </label>
					<input style="float:right;" type="text" id="editdex" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editdexMod">Dexterity Modifier: </label>
					<input style="float:right;" type="text" id="editdexMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editint">Base Intelligence: </label>
					<input style="float:right;" type="text" id="editint" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editintMod">Intelligence Modifier: </label>
					<input style="float:right;" type="text" id="editintMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editwis">Base Wisdom: </label>
					<input style="float:right;" type="text" id="editwis" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editwisMod">Wisdom Modifier: </label>
					<input style="float:right;" type="text" id="editwisMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editcha">Base Charisma: </label>
					<input style="float:right;" type="text" id="editcha" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editchaMod">Charisma Modifier: </label>
					<input style="float:right;" type="text" id="editchaMod" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editdisable">Exclude this player from action? </label>
					<input style="float:right;" type="checkbox" id="editdisable" class="editChar" />
					<br style="clear:both;" />
				</div>
				<div style="float:left;">
					<label style="float:left;" for="editacr">Acrobatics: </label>
					<input style="float:right;" type="text" id="editacr" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editarc">Arcana: </label>
					<input style="float:right;" type="text" id="editarc" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editath">Athletics: </label>
					<input style="float:right;" type="text" id="editath" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editblu">Bluff: </label>
					<input style="float:right;" type="text" id="editblu" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editdip">Diplomacy: </label>
					<input style="float:right;" type="text" id="editdip" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editdun">Dungeoneering: </label>
					<input style="float:right;" type="text" id="editdun" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editend">Endurance: </label>
					<input style="float:right;" type="text" id="editend" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithea">Heal: </label>
					<input style="float:right;" type="text" id="edithea" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edithis">History: </label>
					<input style="float:right;" type="text" id="edithis" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editins">Insight: </label>
					<input style="float:right;" type="text" id="editins" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="edititd">Intimidate: </label>
					<input style="float:right;" type="text" id="edititd" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editnat">Nature: </label>
					<input style="float:right;" type="text" id="editnat" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editper">Perception: </label>
					<input style="float:right;" type="text" id="editper" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editrel">Religion: </label>
					<input style="float:right;" type="text" id="editrel" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editste">Stealth: </label>
					<input style="float:right;" type="text" id="editste" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editstw">Streetwise: </label>
					<input style="float:right;" type="text" id="editstw" class="editChar" />
					<br style="clear:both;" />
					<label style="float:left;" for="editthi">Thievery: </label>
					<input style="float:right;" type="text" id="editthi" class="editChar" />
					<br style="clear:both;" />
				</div>
				<br style="clear: both;" />
				<div style="float:left;">
					<input type="button" id="editCharAction" value="Update Character" /><br/>
					<span id='editCharMessage' class='errMsg'></span>
				</div>
				<br style="clear: both;" />
				<br/><br/>
				<div style="float:left;">
					<div id="inventoryList"></div><br/>
					<input type="button" id="editInvAction" value="Update Inventory" /><br/>
					<span id='editInvMessage' class='errMsg'></span>
					<br/><br/>
					<div>
						<div style="float:left;">
							<label for="invAddName">Name:</label><br/>
							<input class="addInv" type="text" id="invAddName">&nbsp;
							<input type="hidden" id="invAddCharID">
						</div>
						<div style="float:left;">
							<label for="invAddDesc">Description:</label><br/>
							<input class="addInv" type="text" id="invAddDesc">&nbsp;
						</div>
						<div style="float:left;">
							<label for="invAddQty">Quantity:</label><br/>
							<input class="addInv" type="text" id="invAddQty">
						</div>
						<br style="clear: both;" />
						<input type="button" id="addInvAction" value="Add to Inventory" /><br/>
					<span id='addInvMessage' class='errMsg'></span>
						<br />
					</div>
				</div>
				<div style="float:left;padding-left:50px;">
					<div id="featList"></div><br/>
					<input type="button" id="editFeatAction" value="Update Feats & Traits" /><br/>
					<span id='editFeatMessage' class='errMsg'></span>
					<br/><br/>
					<div>
						<div style="float:left;">
							<label for="invAddName">Name:</label><br/>
							<input type="text" class="addFeat" id="featAddName">&nbsp;
							<input type="hidden" id="featAddCharID">
						</div>
						<div style="float:left;">
							<label for="invAddDesc">Description:</label><br/>
							<input type="text" class="addFeat" id="featAddDesc">&nbsp;
						</div>
						<br style="clear: both;" />
						<input type="button" id="addFeatAction" value="Add Feat/Trait" /><br/>
					<span id='addFeatMessage' class='errMsg'></span>
						<br />
					</div>
				</div>
				<br style="clear: both;" />
				<br/>
			</div>
			<?php if ($_SESSION['rank'] >= 10) { ?>
				<!-- Add Enemy Page -->
				<div id='addEnemies'>
					<label for="addEname">Name: </label>
					<input type="text" id="addEname" />
					<br />
					<label for="addEtype">Type: </label>
					<input type="text" id="addEtype" />
					<br />
					<label for="addEmaxhp">Max Health Points: </label>
					<input type="text" id="addEmaxhp" />
					<br />
					<label for="addEmaskDmg">Mask Damage Taken: </label>
					<input type="checkbox" id="addEmaskDmg" />
					<br />
					<label for="addEhide">Hide Enemy from Players: </label>
					<input type="checkbox" id="addEhide" />
					<br />
					<input type="button" id="addEnemyAction" value="Create Enemy" />
				</div>
				<!-- Edit Enemies Page -->
				<div id='editEnemies'>
					<div id="editEnemyList"></div>
					<br />
					<div style="float:left;">
						<input type="hidden" id="editEid" />
						<label for="editEname">Name: </label>
						<input type="text" id="editEname" />
						<br />
						<label for="editEtype">Type: </label>
						<input type="text" id="editEtype" />
						<br />
						<label for="editEhp">Current Health Points: </label>
						<input type="text" id="editEhp" />
						<br />
						<label for="editEmaxhp">Max Health Points: </label>
						<input type="text" id="editEmaxhp" />
						<br />
						<label for="editEtemphp">Temporary Health Points: </label>
						<input type="text" id="editEtemphp" />
						<br />
						<label for="editEinitroll">Encounter Initiative: </label>
						<input type="text" id="editEinitroll" />
						<br />
						<label for="editEmaskDmg">Mask Damage Taken: </label>
						<input type="checkbox" id="editEmaskDmg" />
						<br />
						<label for="editEhide">Hide Enemy from Players: </label>
						<input type="checkbox" id="editEhide" />
						<br />
						<label for="editEdisable">Disable this enemy forever: </label>
						<input type="checkbox" id="editEdisable" />
					</div>
					<br style="clear: both;" />
					<br/>
					<div style="float:left;">
						<input type="button" id="editEnemyAction" value="Update Enemy" />
					</div>
					<br style="clear: both;" />
					<br />
				</div>
				<!-- User list Page -->
				<div id='userList'>
				</div>
				<!-- DM tools Page -->
				<div id='dmTools'>
				</div>
			<?php } ?>
		</div>
		<div id='footer'></div>
		<script>
			dnd.init();
		</script>
    </body>
</html>