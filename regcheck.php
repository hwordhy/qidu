<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
header("Content-Type:text/html;charset=" . JIEQI_CHAR_SET);
include_once jieqi_path_lib("text/textfunction.php");
include_once jieqi_path_inc("class/users.php", "system");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs("system", "action", "jieqiAction");
jieqi_loadlang("users", JIEQI_MODULE_NAME);
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$imageright = sprintf($jieqiLang["system"]["register_check_right"], JIEQI_URL);
$imageerror = sprintf($jieqiLang["system"]["register_check_error"], JIEQI_URL);
$_GET = jieqi_funtoarray("trim", $_GET);

switch ($_GET["item"]) {
case "u":
case "username":
	$ret = $users_handler->validField("username", $_GET["value"]);

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

case "n":
case "nickname":
	$ret = $users_handler->validField("nickname", $_GET["value"]);

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

case "p":
case "password":
	$ret = $users_handler->validField("password", $_GET["value"]);

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

case "r":
case "repassword":
	$ret = $users_handler->validField("password", array("password" => $_GET["reference"], "repassword" => $_GET["value"]));

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

case "m":
case "email":
	$ret = $users_handler->validField("email", $_GET["value"]);

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

case "c":
case "mobile":
	$ret = $users_handler->validField("mobile", $_GET["value"]);

	if (empty($ret)) {
		$htmlstring = $imageright;
	}
	else {
		$htmlstring = $imageerror . $ret[0];
	}

	echo $htmlstring;
	break;

default:
	break;
}

exit();

?>
