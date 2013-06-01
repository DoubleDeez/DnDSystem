<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$name = $in->name;
	$type = $in->type;
	$hp = $in->hp;
	$mask = $in->mask;
	$hide = $in->hide;

	mysql_query("INSERT INTO enemies (name, type, hp, maxhp, hide, mask, disable) VALUES('$name', '$type', '$hp', '$hp', '$hide', '$mask', '0') ") or die(mysql_error());
	
	echo "Enemy created!";
}