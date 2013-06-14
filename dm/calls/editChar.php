<?php

include("../../include/vars.php");
include("../../include/funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$in = json_decode((file_get_contents("php://input")));

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());

	$id = clean($in->id);
	$name = clean($in->name);
	$hp = clean($in->hp);
	$maxhp = clean($in->maxhp);
	$maxweight = clean($in->maxweight);
	$class = clean($in->class);
	$ac = clean($in->ac);
	$fort = clean($in->fort);
	$reflex = clean($in->reflex);
	$will = clean($in->will);
	$exp = clean($in->exp);
	$temphp = clean($in->temphp);
	$speed = clean($in->speed);
	$ap = clean($in->ap);
	$vision = clean($in->vision);
	$initiative = clean($in->initiative);
	$initroll = clean($in->initroll);
	$str = clean($in->str);
	$strMod = clean($in->strMod);
	$con = clean($in->con);
	$conMod = clean($in->conMod);
	$dex = clean($in->dex);
	$dexMod = clean($in->dexMod);
	$int = clean($in->int);
	$intMod = clean($in->intMod);
	$wis = clean($in->wis);
	$wisMod = clean($in->wisMod);
	$cha = clean($in->cha);
	$chaMod = clean($in->chaMod);
	$languages = clean($in->languages);
	$vul = clean($in->vul);
	$resist = clean($in->resist);
	$diet = clean($in->diet);
	$align = clean($in->align);
	$acr = clean($in->acr);
	$arc = clean($in->arc);
	$ath = clean($in->ath);
	$blu = clean($in->blu);
	$dip = clean($in->dip);
	$dun = clean($in->dun);
	$end = clean($in->end);
	$hea = clean($in->hea);
	$his = clean($in->his);
	$ins = clean($in->ins);
	$itd = clean($in->itd);
	$nat = clean($in->nat);
	$per = clean($in->per);
	$rel = clean($in->rel);
	$ste = clean($in->ste);
	$stw = clean($in->stw);
	$thi = clean($in->thi);
	$hsval = clean($in->hsval);
	$hsdaily = clean($in->hsdaily);
	$hsleft = clean($in->hsleft);
	$hswind = clean($in->hswind);
	$disable = clean($in->disable);

	mysql_query("UPDATE characters SET name='$name', maxhp='$maxhp', maxweight='$maxweight', hp='$hp', class='$class', ac='$ac', fortitude='$fort', reflex='$reflex', will='$will', exp='$exp', temphp='$temphp', speed='$speed', initiative='$initiative', initroll='$initroll', ap='$ap', vision='$vision', str='$str', strMod='$strMod', con='$con', conMod='$conMod', dex='$dex', dexMod='$dexMod', `int`='$int', intMod='$intMod', wis='$wis', wisMod='$wisMod', cha='$cha', chaMod='$chaMod', languages='$languages', vulnerable='$vul', resist='$resist', diety='$diet', alignment='$align', acr='$acr', arc='$arc', ath='$ath', blu='$blu', dip='$dip', dun='$dun', end='$end', hea='$hea', his='$his', ins='$ins', itd='$itd', nat='$nat', per='$per', rel='$rel', ste='$ste', stw='$stw', thi='$thi', hsval='$hsval', hsdaily='$hsdaily', hsleft='$hsleft', hswind='$hswind', disable='$disable' WHERE id='$id'") or die(mysql_error());

	echo "Character updated!";
}