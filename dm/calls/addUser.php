<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$name = clean($in->name);
	$rank = clean($in->rank);
	$pass = clean($in->pass);
	$pass2 = clean($in->pass2);
	$salt = salt();

	if ($pass === $pass2) {

		$spass = sha1($salt . $pass);
		mysql_query("INSERT INTO users (name, rank, pass, salt) VALUES('$name', '$rank', '$spass', '$salt') ") or die(mysql_error());

		echo "User created!";
	} else {
		echo "The passwords do not match!";
	}
}

