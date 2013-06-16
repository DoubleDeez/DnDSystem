<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
	
	$tRes = mysql_query("SELECT time FROM settings") or die(mysql_error());
	$tRow = mysql_fetch_assoc($tRes);

	$hour = clean($in->hour);
	$min = clean($in->min);
	$sec = clean($in->sec);
	
	$time = $hour * 3600 + $min * 60 + $sec;
	
	if(($tRow['time'] + $time) >= 86400) {
		$time = ($tRow['time'] + $time) - 86400;
		mysql_query("UPDATE settings SET time='$time'") or die(mysql_error());
	} else if(($tRow['time'] + $time) < 0) {
		$time = 86400 + ($tRow['time'] + $time);
		mysql_query("UPDATE settings SET time='$time'") or die(mysql_error());
	} else {
		mysql_query("UPDATE settings SET time=time+'$time'") or die(mysql_error());
	}

	echo "Time added!";
}