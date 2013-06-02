<?php

function clean($str) {

	if (!get_magic_quotes_gpc()) {

		$str = addslashes($str);
	}

	$str = strip_tags(htmlspecialchars($str));

	return $str;
}

function validEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function salt() {
    mt_srand(microtime(true)*100000 + memory_get_usage(true));
    return sha1(uniqid(mt_rand(), true));
}

function getLevel($exp) {
	if($exp < 1000) {
		return 1;
	} else if($exp < 2250) {
		return 2;
	} else if($exp < 3750) {
		return 3;
	} else if($exp < 5500) {
		return 4;
	} else if($exp < 7500) {
		return 5;
	} else if($exp < 10000) {
		return 6;
	} else if($exp < 13000) {
		return 7;
	} else if($exp < 16500) {
		return 8;
	} else if($exp < 20500) {
		return 9;
	} else if($exp < 26000) {
		return 10;
	} else if($exp < 32000) {
		return 11;
	} else if($exp < 39000) {
		return 12;
	} else if($exp < 47000) {
		return 13;
	} else if($exp < 57000) {
		return 14;
	} else if($exp < 69000) {
		return 15;
	} else if($exp < 83000) {
		return 16;
	} else if($exp < 99000) {
		return 17;
	} else if($exp < 119000) {
		return 18;
	} else if($exp < 143000) {
		return 19;
	} else if($exp < 175000) {
		return 20;
	} else if($exp < 210000) {
		return 21;
	} else if($exp < 255000) {
		return 22;
	} else if($exp < 310000) {
		return 23;
	} else if($exp < 375000) {
		return 24;
	} else if($exp < 450000) {
		return 25;
	} else if($exp < 550000) {
		return 26;
	} else if($exp < 675000) {
		return 27;
	} else if($exp < 825000) {
		return 28;
	} else if($exp < 1000000) {
		return 29;
	} else {
		return 30;
	}
}

function getExpToLevel($exp) {
	if($exp < 1000) {
		return $exp;
	} else if($exp < 2250) {
		return 2250 - $exp;
	} else if($exp < 3750) {
		return 3750 - $exp;
	} else if($exp < 5500) {
		return 5500 - $exp;
	} else if($exp < 7500) {
		return 7500 - $exp;
	} else if($exp < 10000) {
		return 10000 - $exp;
	} else if($exp < 13000) {
		return 13000 - $exp;
	} else if($exp < 16500) {
		return 16500 - $exp;
	} else if($exp < 20500) {
		return 20500 - $exp;
	} else if($exp < 26000) {
		return 26000 - $exp;
	} else if($exp < 32000) {
		return 32000 - $exp;
	} else if($exp < 39000) {
		return 39000 - $exp;
	} else if($exp < 47000) {
		return 47000 - $exp;
	} else if($exp < 57000) {
		return 57000 - $exp;
	} else if($exp < 69000) {
		return 69000 - $exp;
	} else if($exp < 83000) {
		return 83000 - $exp;
	} else if($exp < 99000) {
		return 99000 - $exp;
	} else if($exp < 119000) {
		return 119000 - $exp;
	} else if($exp < 143000) {
		return 143000 - $exp;
	} else if($exp < 175000) {
		return 175000 - $exp;
	} else if($exp < 210000) {
		return 210000 - $exp;
	} else if($exp < 255000) {
		return 255000 - $exp;
	} else if($exp < 310000) {
		return 310000 - $exp;
	} else if($exp < 375000) {
		return 375000 - $exp;
	} else if($exp < 450000) {
		return 450000 - $exp;
	} else if($exp < 550000) {
		return 550000 - $exp;
	} else if($exp < 675000) {
		return 675000 - $exp;
	} else if($exp < 825000) {
		return 825000 - $exp;
	} else if($exp < 1000000) {
		return 1000000 - $exp;
	} else {
		return 0;
	}
}