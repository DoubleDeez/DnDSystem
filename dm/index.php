<?php
include("../include/vars.php");
include("../include/func.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

session_start();