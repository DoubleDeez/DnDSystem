<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$result = mysql_query("SELECT * FROM characters WHERE disable='0' AND hp>='0'") or die(mysql_error());
	
		$numChars = mysql_num_rows($result);
		$exp = floor($in->exp / $numChars);
		
		while ($row = mysql_fetch_array($result)) {
			mysql_query("UPDATE `characters` SET `exp` =  `exp` + '".$exp."' WHERE  `id` = '".$row['id']."'") or die(mysql_error());
		}

	echo "EXP updated!";
}