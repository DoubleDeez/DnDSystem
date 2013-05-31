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