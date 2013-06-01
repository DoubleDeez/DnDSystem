<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	foreach ($in as $item) {
		$invName = $item->name;
		$invDesc = $item->desc;
		$invQuantity = $item->quantity;
		$invID = $item->id;
		mysql_query("UPDATE `inventory` SET `name` = '".$invName."', `desc` = '".$invDesc."', `qty` = '".$invQuantity."' WHERE  `id` = '".$invID."'") or die(mysql_error());
	}

	echo "Character inventory updated!";
}