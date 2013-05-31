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
		<script src="script.js"></script>
        <title>DnD Manager System</title>
    </head>
    <body>
		<div id='menu'><a href='#' id='infoBtn'>Info</a> | <a href='#' id='addCharBtn'>Add a Character</a> | <a href='#' id='editCharBtn'>Edit a Character</a> | <a href='#' id='manageEnemiesBtn'>Manage Enemies</a> | <a href='#' id='logoutBtn'>Log Out</a></div>
		<div id='main'>
			<div id='info'>This is basic as shit for now, I'll work on making the entire thing better later.</div>
			<div id='addChar'></div>
			<div id='editChar'></div>
			<div id='manageEnemies'></div>
		</div>
		<div id='footer'></div>
		<script>
			init();
		</script>
    </body>
</html>