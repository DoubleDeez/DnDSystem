<?php


include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	foreach ($in as $feat) {
		$featName = clean($feat->name);
		$featDesc = clean($feat->desc);
		$featID = clean($feat->id);
		mysql_query("UPDATE `feats` SET `name` = '".$featName."', `description` = '".$featDesc."' WHERE  `id` = '".$featID."'") or die(mysql_error());
	}

	echo "Character feats & traits updated!";
}