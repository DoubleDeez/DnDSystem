<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$ownerid = $in->ownerid;
	$charid = $in->charid;

	mysql_query("UPDATE characters SET userid='$ownerid' WHERE id='$charid'") or die(mysql_error());

	echo "Owner changed!";
}