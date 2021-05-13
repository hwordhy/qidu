<?php

define("JIEQI_MODULE_NAME", "system");
define("JIEQI_ADMIN_LOGIN", 1);
define("JIEQI_ADMIN_FRAME", 1);
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminpanel"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once (JIEQI_ROOT_PATH . "/admin/header.php");
$jieqiTpl->assign("jieqi_adminleft", JIEQI_URL . "/admin/left.php");
if (isset($_SESSION["adminurl"]) && !empty($_SESSION["adminurl"])) {
	$jieqiTpl->assign("jieqi_adminmain", $_SESSION["adminurl"]);
}
else {
	$jieqiTpl->assign("jieqi_adminmain", JIEQI_URL . "/admin/main.php");
}

if (!empty($_SESSION["jieqiUserId"])) {
	$jieqiTpl->assign("username", jieqi_htmlstr($_SESSION["jieqiUserName"]));
	$jieqiTpl->assign("usergroup", $jieqiGroups[$_SESSION["jieqiUserGroup"]]);
}

include_once jieqi_path_inc("class/modules.php", "system");
$modules_handler = &JieqiModulesHandler::getInstance("JieqiModulesHandler");
$criteria = new CriteriaCompo(new Criteria("publish", 1, "="));
$criteria->setSort("weight");
$criteria->setOrder("DESC");
$modules_handler->queryObjects($criteria);
unset($criteria);
$jieqiModary = array();

while ($v = $modules_handler->getObject()) {
	$jieqiModary[$v->getVar("name", "n")] = array("name" => $v->getVar("name", "n"), "caption" => $v->getVar("caption", "n"), "description" => $v->getVar("description", "n"), "version" => sprintf("%0.2f", intval($v->getVar("version", "n")) / 100), "vtype" => $v->getVar("vtype", "n"), "publish" => $v->getVar("publish", "n"));
    jieqi_getconfigs($v->getVar("name", "n"), "adminmenu", "jieqiAdminmenu");
}
jieqi_getconfigs("system", "adminmenu", "jieqiAdminmenu");
$jieqiTpl->assign("adminmenus", $jieqiAdminmenu);
$jieqiTpl->assign_by_ref("jieqimodules", $jieqiModary);
if (defined("JIEQI_VERSION_TYPE") && defined("LANG_VERSION_" . strtoupper(JIEQI_VERSION_TYPE))) {
	$jieqiTpl->assign("jieqi_vtype", constant("LANG_VERSION_" . strtoupper(JIEQI_VERSION_TYPE)));
}
else {
	$jieqiTpl->assign("jieqi_vtype", "");
}

$jieqiTpl->setCaching(0);
$jieqiTpl->display(jieqi_path_template("admin/index.html", "system"));

?>

