<?php

define("JIEQI_MODULE_NAME", "system");
if (isset($_POST["act"]) && ($_POST["act"] == "newuser")) {
	define("JIEQI_NEED_SESSION", 1);
}

require_once ("global.php");
jieqi_loadlang("users", JIEQI_MODULE_NAME);
if (!defined("JIEQI_ALLOW_REGISTER") || (JIEQI_ALLOW_REGISTER != 1)) {
	jieqi_printfail($jieqiLang["system"]["user_stop_register"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");

if (!isset($_POST["act"])) {
	$_POST["act"] = "input";
}

switch ($_POST["act"]) {
case "newuser":
	jieqi_useraction("register", $_REQUEST);
	break;

case "input":
default:
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("form_action", JIEQI_USER_URL . "/register.php");
	$jieqiTpl->assign("check_url", JIEQI_USER_URL . "/regcheck.php");

	foreach ($jieqiOption["system"] as $k => $v ) {
		$jieqiTpl->assign($k, $jieqiOption["system"][$k]);
	}

	$show_checkcode = (defined("JIEQI_REGISTER_CHECKCODE") && (JIEQI_REGISTER_CHECKCODE == 1 || JIEQI_REGISTER_CHECKCODE == 3) && !defined("JIEQI_NO_CHECKCODE") ? 1 : 0);

    $show_emailrand = (defined("JIEQI_REGISTER_CHECKCODE") && JIEQI_REGISTER_CHECKCODE >= 2 && !defined("JIEQI_NO_CHECKCODE") ? 1 : 0);

	$jieqiTpl->assign("show_checkcode", $show_checkcode);
    $jieqiTpl->assign("show_emailrand", $show_emailrand);
	$jieqiTpl->assign("url_checkcode", JIEQI_USER_URL . "/checkcode.php");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("register.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
	break;
}

?>
