<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$id = clean($in->id);
	$name = clean($in->name);
	$desc = clean($in->desc);
	$type = clean($in->type);
	$freq = clean($in->freq);
	$power = clean($in->power);
	$class = clean($in->class);
	$range = clean($in->range);
	$target = clean($in->target);
	$hit = clean($in->hit);
	$miss = clean($in->miss);
	$attack = clean($in->attack);
	$special = clean($in->special);

	mysql_query("INSERT INTO actions (name, description, frequency, power, actiontype, actionclass, rangetype, target, hit, miss, attack, special, charid) VALUES('$name', '$desc', '$freq', '$power', '$type', '$class', '$range', '$target', '$hit', '$miss', '$attack', '$special', '$id') ") or die(mysql_error());
	
	echo "Action added!";
}