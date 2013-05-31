<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$name = $in->name;
	$hp = $in->hp;
	$class = $in->class;
	$ac = $in->ac;
	$fort = $in->fort;
	$reflex = $in->reflex;
	$will = $in->will;

	mysql_query("INSERT INTO characters (name, maxhp, hp, class, ac, fortitude, reflex, will, exp) VALUES('$name', '$hp', '$hp', '$class', '$ac', '$fort', '$reflex', '$will', '0') ") or die(mysql_error());
	
	echo "Character created!";
}