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
			<div id='info'>Attacks are added and show on front page. This will become a list of useful shit, once someone writes it.</div>
			<!-- Add Character Page -->
			<div id='addChar'></div>
			<!-- Edit Character Page -->
			<div id='editChar'></div>
			<?php if ($_SESSION['rank'] >= 10) { ?>
				<!-- Add Enemy Page -->
				<div id='addEnemies'></div>
				<!-- Edit Enemies Page -->
				<div id='editEnemies'></div>
				<!-- User list Page -->
				<div id='userList'>
				</div>
				<!-- DM tools Page -->
				<div id='dmTools'></div>
			<?php } ?>
		</div>
		<div id='footer'></div>
		<script>
			dnd.init();
		</script>
    </body>
</html>