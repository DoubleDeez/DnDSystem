<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$name = clean($in->name);
	$type = clean($in->type);
	$hp = clean($in->hp);
	$mask = clean($in->mask);
	$hide = clean($in->hide);

	mysql_query("INSERT INTO enemies (name, type, hp, maxhp, hide, mask, disable) VALUES('$name', '$type', '$hp', '$hp', '$hide', '$mask', '0') ") or die(mysql_error());
	
	echo "Enemy created!";
}