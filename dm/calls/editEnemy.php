<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$id = $in->id;
	$name = $in->name;
	$type = $in->type;
	$hp = $in->hp;
	$temphp = $in->temphp;
	$maxhp = $in->maxhp;
	$mask = $in->mask;
	$hide = $in->hide;
	$disable = $in->disable;

	mysql_query("UPDATE enemies SET name='$name', maxhp='$maxhp', hp='$hp', temphp='$temphp', type='$type', mask='$mask', hide='$hide', disable='$disable' WHERE id='$id'") or die(mysql_error());

	echo "Enemy updated!";
}