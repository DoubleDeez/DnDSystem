<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	mysql_query("UPDATE `characters` SET `initroll` = '0'") or die(mysql_error());
	mysql_query("UPDATE `enemies` SET `initroll` = '0'") or die(mysql_error());

	echo "Initiatives reset!";
}