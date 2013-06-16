<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$hour = clean($in->hour);
	$min = clean($in->min);
	$sec = clean($in->sec);
	
	$time = $hour * 3600 + $min * 60 + $sec;

	mysql_query("UPDATE settings SET time='$time'") or die(mysql_error());

	echo "Time set!";
}