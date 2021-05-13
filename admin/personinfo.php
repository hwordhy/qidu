<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminuser"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);

if (empty($_REQUEST["id"])) {
	jieqi_printfail(LANG_NO_USER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_loadlang("users", "system");
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$users = $users_handler->get($_REQUEST["id"]);

if (!is_object($users)) {
	jieqi_printfail(LANG_NO_USER);
}

jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql = "SELECT * FROM " . jieqi_dbprefix("system_persons") . " WHERE uid = " . intval($_REQUEST["id"]) . " LIMIT 0, 1";
$res = $query->execute($sql);
$persons = $query->getRow($res);

if (!$persons) {
	jieqi_jumppage(JIEQI_LOCAL_URL . "/admin/personmanage.php?id=" . $_REQUEST["id"], LANG_DO_FAILURE, $jieqiLang["system"]["persons_no_info"]);
}
else {
	include_once jieqi_path_common("admin/header.php");
	include_once jieqi_path_inc("include/funpersons.php", "system");
	$personsvars = jieqi_system_personsvars($persons, "s");
	$jieqiTpl->assign_by_ref("personsvars", $personsvars);
	$uservals = jieqi_query_rowvars($users, "s");
	$jieqiTpl->assign_by_ref("uservals", $uservals);
	$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/personinfo.html";
	include_once jieqi_path_common("admin/footer.php");
}

?>
