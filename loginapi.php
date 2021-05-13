<?php

define("JIEQI_MODULE_NAME", "system");

if ($_REQUEST["act"] == "login") {
	define("JIEQI_NEED_SESSION", 1);
}

require_once ("global.php");
if (!isset($_REQUEST["act"]) && isset($_REQUEST["action"])) {
	$_REQUEST["act"] = $_REQUEST["action"];
}

if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	@session_regenerate_id();
}

jieqi_loadlang("users", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login") && !empty($_REQUEST["username"]) && !empty($_REQUEST["password"])) {
	jieqi_useraction("login", $_REQUEST);
}
else {
	include_once jieqi_path_common("header.php");

	if (!empty($_REQUEST["jumpurl"])) {
		$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["jumpurl"]));
	}
	else if (!empty($_REQUEST["forward"])) {
		$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["forward"]));
	}
	else {
		$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit");
	}

	$jieqiTpl->assign("url_register", JIEQI_USER_URL . "/register.php");
	$jieqiTpl->assign("url_getpass", JIEQI_USER_URL . "/getpass.php");
	$show_checkcode = (defined("JIEQI_LOGIN_CHECKCODE") && !defined("JIEQI_NO_CHECKCODE") ? JIEQI_LOGIN_CHECKCODE : 0);
	$jieqiTpl->assign("show_checkcode", $show_checkcode);
	$jieqiTpl->assign("url_checkcode", JIEQI_USER_URL . "/checkcode.php");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("loginapi.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
}

?>
