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
		<div id='menu'><a href='#' id='infoBtn'>Info</a> | <a href='#' id='addCharBtn'>Add a Character</a> | <a href='#' id='editCharBtn'>Edit a Character</a> | <a href='#' id='manageEnemiesBtn'>Manage Enemies</a> | <a href='#' id='logoutBtn'>Log Out</a></div>
		<div id='main'>
			<div id='info'>This is basic as shit for now, I'll work on making the entire thing better later.</div>
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
			<div id='editChar'>
				<div id="editCharList">
				</div>
				<br />
				<input type="hidden" id="editid" />
				<label for="name">Name: </label>
				<input type="text" id="editname" />
				<br />
				<label for="name">Class: </label>
				<input type="text" id="editclass" />
				<br />
				<label for="name">Current Health Points: </label>
				<input type="text" id="edithp" />
				<br />
				<label for="name">Max Health Points: </label>
				<input type="text" id="editmaxhp" />
				<br />
				<label for="name">AC: </label>
				<input type="text" id="editac" />
				<br />
				<label for="name">Fortitude: </label>
				<input type="text" id="editfort" />
				<br />
				<label for="name">Reflex: </label>
				<input type="text" id="editreflex" />
				<br />
				<label for="name">Will: </label>
				<input type="text" id="editwill" />
				<br />
				<label for="name">EXP: </label>
				<input type="text" id="editexp" />
				<br />
				<input type="button" id="editCharAction" value="Update Character" />
				<br />
				<br />
				<input type="button" id="delCharAction" value="Delete Character" />
			</div>
			<div id='manageEnemies'></div>
		</div>
		<div id='footer'></div>
		<script>
			dnd.init();
		</script>
    </body>
</html>