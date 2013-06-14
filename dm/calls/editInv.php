<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	foreach ($in as $item) {
		$invName = clean($item->name);
		$invDesc = clean($item->desc);
		$invQuantity = clean($item->quantity);
		$invID = clean($item->id);
		$invWeight = clean($item->weight);
		mysql_query("UPDATE `inventory` SET `name` = '".$invName."', `desc` = '".$invDesc."', `qty` = '".$invQuantity."', `weight` = '".$invWeight."' WHERE  `id` = '".$invID."'") or die(mysql_error());
	}

	echo "Character inventory updated!";
}