<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$charid = clean($in->charID);
	$name = clean($in->name);
	$desc = clean($in->desc);
	$qty = clean($in->qty);
	$weight = clean($in->weight);
	
	mysql_query("INSERT INTO inventory (`name`, `desc`, `qty`, `weight`, `charid`) VALUES('$name', '$desc', '$qty', '$weight', '$charid') ") or die(mysql_error());
	
	echo "Item added!";
}