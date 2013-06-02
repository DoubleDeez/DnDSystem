<?php

include("../../include/vars.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$id = $in->id;
	$name = $in->name;
	$hp = $in->hp;
	$maxhp = $in->maxhp;
	$class = $in->class;
	$ac = $in->ac;
	$fort = $in->fort;
	$reflex = $in->reflex;
	$will = $in->will;
	$exp = $in->exp;
	$temphp = $in->temphp;
	$speed = $in->speed;
	$ap = $in->ap;
	$vision = $in->vision;
	$initiative = $in->initiative;
	$str = $in->str;
	$strMod = $in->strMode;
	$con = $in->con;
	$conMod = $in->conMod;
	$dex = $in->dex;
	$dexMod = $in->dexMod;
	$int = $in->int;
	$intMod = $in->intMod;
	$wis = $in->wis;
	$wisMod = $in->wisMod;
	$cha = $in->cha;
	$chaMod = $in->chaMod;

	mysql_query("UPDATE characters SET name='$name', maxhp='$maxhp', hp='$hp', class='$class', ac='$ac', fortitude='$fort', reflex='$reflex', will='$will', exp='$exp', temphp='$temphp', speed='$speed', initiative='$initiative', ap='$ap', vision='$vision', str='$str', strMod='$strMod', con='$con', conMod='$conMod', dex='$dex', dexMod='$dexMod', `int`='$int', intMod='$intMod', wis='$wis', wisMod='$wisMod', cha='$cha', chaMod='$chaMod' WHERE id='$id'") or die(mysql_error());

	echo "Character updated!";
}