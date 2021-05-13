<?php

define("JIEQI_MODULE_NAME", "system");
if (!isset($_REQUEST["act"]) && isset($_REQUEST["action"])) {
	$_REQUEST["act"] = $_REQUEST["action"];
}

if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	define("JIEQI_NEED_SESSION", 1);
}

require_once ("global.php");
if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	@session_regenerate_id();
}

jieqi_loadlang("users", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	if ((strlen($_REQUEST["username"]) == 0) || (strlen($_REQUEST["password"]) == 0)) {
		jieqi_printfail($jieqiLang["system"]["need_userpass"]);
	}
	else {
		//2018.04.10 新增使用手机、邮箱登录
		if ((filter_var($_REQUEST["username"], FILTER_VALIDATE_EMAIL) == true) || (preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $_REQUEST["username"]) == true)){
            $_REQUEST["uidtype"] = -1;
		}

		jieqi_useraction("login", $_REQUEST);
	}
}
else {
	include_once jieqi_path_common("header.php");
	$jumpurl = "";
	if (!empty($_REQUEST["jumpurl"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["jumpurl"])) {
		$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["jumpurl"]));
		$jumpurl = $_REQUEST["jumpurl"];
	}
	else {
		if (!empty($_REQUEST["forward"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["forward"])) {
			$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["forward"]));
			$jumpurl = $_REQUEST["forward"];
		}
		else {
			if (!empty($_SERVER["HTTP_REFERER"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_SERVER["HTTP_REFERER"]) && !preg_match("/(login\.php|register\.php|getpass\.php|setpass\.php)/i", $_SERVER["HTTP_REFERER"])) {
				$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_SERVER["HTTP_REFERER"]));
				$jumpurl = $_SERVER["HTTP_REFERER"];
			}
			else {
				$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit");
			}
		}
	}

	$jieqiTpl->assign("jumpurl", jieqi_htmlstr($jumpurl));
	$jieqiTpl->assign("jumpurl_n", $jumpurl);
	$jumpquery = (empty($jumpurl) ? "" : "?jumpurl=" . urlencode($jumpurl));
	$jieqiTpl->assign("jumpquery", $jumpquery);
	$jieqiTpl->assign("url_register", JIEQI_USER_URL . "/register.php");
	$jieqiTpl->assign("url_getpass", JIEQI_USER_URL . "/getpass.php");
	$show_checkcode = (defined("JIEQI_LOGIN_CHECKCODE") && !defined("JIEQI_NO_CHECKCODE") ? JIEQI_LOGIN_CHECKCODE : 0);
	$jieqiTpl->assign("show_checkcode", $show_checkcode);
	$jieqiTpl->assign("url_checkcode", JIEQI_USER_URL . "/checkcode.php");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("login.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
}

?>
