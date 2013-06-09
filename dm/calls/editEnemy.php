<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$id = clean($in->id);
	$name = clean($in->name);
	$type = clean($in->type);
	$hp = clean($in->hp);
	$temphp = clean($in->temphp);
	$maxhp = clean($in->maxhp);
	$initroll = clean($in->initroll);
	$mask = clean($in->mask);
	$hide = clean($in->hide);
	$disable = clean($in->disable);

	mysql_query("UPDATE enemies SET name='$name', maxhp='$maxhp', hp='$hp', temphp='$temphp', initroll='$initroll', type='$type', mask='$mask', hide='$hide', disable='$disable' WHERE id='$id'") or die(mysql_error());

	echo "Enemy updated!";
}