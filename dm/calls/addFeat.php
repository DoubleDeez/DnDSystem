<?php


include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$charid = $in->charID;
	$name = $in->name;
	$desc = $in->desc;
	
	mysql_query("INSERT INTO feats (`name`, `description`, `charid`) VALUES('$name', '$desc', '$charid') ") or die(mysql_error());
	
	echo "Feat/Trait added!";
}