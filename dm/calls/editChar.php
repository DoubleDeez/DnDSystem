<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$id = $in->id;
	$name = $in->name;
	$hp = $in->hp;
	$maxhp = $in->maxhp;
	$class = $in->class;
	$ac = $in->ac;
	$fort = $in->fort;
	$reflex = $in->reflex;
	$will = $in->will;
	$exp = $in->exp;

	mysql_query("UPDATE characters SET name='$name', maxhp='$maxhp', hp='$hp', class='$class', ac='$ac', fortitude='$fort', reflex='$reflex', will='$will', exp='$exp' WHERE id='$id'") or die(mysql_error());

	echo "Character updated!";
}