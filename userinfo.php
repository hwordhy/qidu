<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_checklogin();
if (empty($_REQUEST["id"]) && empty($_REQUEST["username"])) {
	jieqi_printfail(LANG_NO_USER);
}

include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

if (!empty($_REQUEST["id"])) {
	$userobj = $users_handler->get($_REQUEST["id"]);
}
else {
	$_REQUEST["username"] = trim($_REQUEST["username"]);
	$userobj = $users_handler->getByname($_REQUEST["username"]);
}

if (is_object($userobj)) {
	if (!isset($_REQUEST["id"])) {
		$_REQUEST["id"] = $userobj->getVar("uid");
	}

	jieqi_getconfigs("system", "honors");
	include_once jieqi_path_common("header.php");
	include_once jieqi_path_inc("include/funusers.php", JIEQI_MODULE_NAME);
	$uservals = jieqi_system_usersvars($userobj);
	$jieqiTpl->assign_by_ref("uservals", $uservals);

	foreach ($uservals as $k => $v ) {
		$jieqiTpl->assign_by_ref($k, $uservals[$k]);
	}

	jieqi_getconfigs(JIEQI_MODULE_NAME, "power");

	if (jieqi_checkpower($jieqiPower["system"]["adminuser"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
		$ismaster = 1;
	}
	else {
		$ismaster = 0;
	}

	$jieqiTpl->assign("ismaster", $ismaster);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("userinfo.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
}
else {
	jieqi_printfail(LANG_NO_USER);
}

?>
