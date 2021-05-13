<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_checklogin();
if (empty($_REQUEST["id"]) && empty($_REQUEST["name"])) {
	$_REQUEST["id"] = intval($_SESSION["jieqiUserId"]);
}

include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

if (!empty($_REQUEST["id"])) {
	$userobj = $users_handler->get($_REQUEST["id"]);
}
else {
	$_REQUEST["name"] = trim($_REQUEST["name"]);
	$userobj = $users_handler->getByname($_REQUEST["name"]);
}

if (is_object($userobj)) {
	$_REQUEST["uid"] = $userobj->getVar("uid", "n");
	$_REQUEST["id"] = $_REQUEST["uid"];
	jieqi_getconfigs("system", "honors");
	include_once jieqi_path_common("header.php");
	include_once jieqi_path_inc("include/funusers.php", "system");
	$uservals = jieqi_system_usersvars($userobj);
	$jieqiTpl->assign_by_ref("uservals", $uservals);

	foreach ($uservals as $k => $v ) {
		$jieqiTpl->assign_by_ref($k, $uservals[$k]);
	}

	$jieqiTpl->assign("authorid", $_REQUEST["id"]);
	$jieqiTpl->assign("author", $userobj->getVar("name"));
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("userpage.html", "system");
	include_once jieqi_path_common("footer.php");
}
else {
	jieqi_printfail(LANG_NO_USER);
}

?>
