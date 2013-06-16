<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$init = (clean($in->init) == "1") ? "1" : "0";

	mysql_query("UPDATE settings SET initiative='$init'") or die(mysql_error());

	echo "Settings applied!";
}