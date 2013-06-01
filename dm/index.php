<?php
include("../include/vars.php");
include("../include/func.php");

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
        <title>DnD Manager System</title>
    </head>
    <body>
		<div id='menu'><a href='#' id='infoBtn'>Info</a> | <a href='#' id='addCharBtn'>Add a Character</a> | <a href='#' id='editCharBtn'>Edit a Character</a> | <a href='#' id='addEnemiesBtn'>Add an Enemy</a> | <a href='#' id='editEnemiesBtn'>Edit Enemies</a> | <a href='#' id='logoutBtn'>Log Out</a></div>
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
				<input type="button" id="addCharAction" value="Create Character" />
			</div>
			<!-- Edit Character Page -->
			<div id='editChar'>
				<div id="editCharList">
				</div>
				<br />
				<div style="float:left;">
					<input type="hidden" id="editid" />
					<label for="name">Name: </label>
					<input type="text" id="editname" />
					<br />
					<label for="editclass">Class: </label>
					<input type="text" id="editclass" />
					<br />
					<label for="edithp">Current Health Points: </label>
					<input type="text" id="edithp" />
					<br />
					<label for="editmaxhp">Max Health Points: </label>
					<input type="text" id="editmaxhp" />
					<br />
					<label for="editac">AC: </label>
					<input type="text" id="editac" />
					<br />
					<label for="editfort">Fortitude: </label>
					<input type="text" id="editfort" />
					<br />
					<label for="editreflex">Reflex: </label>
					<input type="text" id="editreflex" />
					<br />
					<label for="editwill">Will: </label>
					<input type="text" id="editwill" />
					<br />
					<label for="editexp">EXP: </label>
					<input type="text" id="editexp" />
				</div>
				<div id="inventoryList" style="float:left;">
				</div>
				<br style="clear: both;" />
				<br/>
				<div style="float:left;">
					<input type="button" id="editCharAction" value="Update Character" />
				</div>
				<div style="float:left;">
					<input type="button" id="editInvAction" value="Update Inventory" />
					<br />
				</div>
				<br style="clear: both;" />
				<br />
				<br />
				<div>
					<label for="invAddName">Name</label>
					<input type="text" id="invAddName">&nbsp;
					<input type="hidden" id="invAddCharID">
					<label for="invAddDesc">Desc</label>
					<input type="text" id="invAddDesc">&nbsp;
					<label for="invAddQty">Quantity</label>
					<input type="text" id="invAddQty"><br />
					<input type="button" id="addInvAction" value="Add to Inventory" />
					<br />
				</div>
			</div>
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
		</div>
		<div id='footer'></div>
		<script>
			dnd.init();
		</script>
    </body>
</html>