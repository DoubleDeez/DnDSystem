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