<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$name = clean($in->name);
	$hp = clean($in->hp);
	$class = clean($in->class);
	$ac = clean($in->ac);
	$fort = clean($in->fort);
	$reflex = clean($in->reflex);
	$will = clean($in->will);
	$userid = clean($in->userid);

	mysql_query("INSERT INTO characters (name, maxhp, hp, class, ac, fortitude, reflex, will, exp, userid) VALUES('$name', '$hp', '$hp', '$class', '$ac', '$fort', '$reflex', '$will', '0', '$userid') ") or die(mysql_error());
	
	echo "Character created!";
}

