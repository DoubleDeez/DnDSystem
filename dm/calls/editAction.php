<?php


include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	foreach ($in as $action) {
		$name = clean($action->name);
		$description = clean($action->desc);
		$frequency = clean($action->freq);
		$power = clean($action->power);
		$actiontype = clean($action->type);
		$actionclass = clean($action->class);
		$rangetype = clean($action->range);
		$target = clean($action->target);
		$hit = clean($action->hit);
		$miss = clean($action->miss);
		$attack = clean($action->attack);
		$special = clean($action->special);
		$id = clean($action->id);
		
		mysql_query("UPDATE actions SET name = '".$name."', description = '".$description."', frequency = '".$frequency."', power = '".$power."', actiontype = '".$actiontype."', actionclass = '".$actionclass."', rangetype = '".$rangetype."', target = '".$target."', hit = '".$hit."', miss = '".$miss."', attack = '".$attack."', special = '".$special."' WHERE  id = '".$id."'") or die(mysql_error());
	}

	echo "Character actions updated!";
}