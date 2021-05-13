<?php

define("JIEQI_MODULE_NAME", "system");
define("JIEQI_ADMIN_LOGIN", 1);
define("JIEQI_ADMIN_FRAME", 1);
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminpanel"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once jieqi_path_common("admin/header.php");

if (!empty($_SESSION["jieqiUserId"])) {
	$jieqiTpl->assign("username", jieqi_htmlstr($_SESSION["jieqiUserName"]));
	$jieqiTpl->assign("usergroup", $jieqiGroups[$_SESSION["jieqiUserGroup"]]);
}

include_once jieqi_path_inc("class/modules.php", "system");
$modules_handler = &JieqiModulesHandler::getInstance("JieqiModulesHandler");
$criteria = new CriteriaCompo(new Criteria("publish", 1, "="));
$criteria->setSort("weight");
$criteria->setOrder("ASC");
$modules_handler->queryObjects($criteria);
unset($criteria);
$jieqiModary = array();

while ($v = $modules_handler->getObject()) {
	$jieqiModary[$v->getVar("name", "n")] = array("name" => $v->getVar("name", "n"), "caption" => $v->getVar("caption", "n"), "description" => $v->getVar("description", "n"), "version" => sprintf("%0.2f", intval($v->getVar("version", "n")) / 100), "vtype" => $v->getVar("vtype", "n"), "publish" => $v->getVar("publish", "n"));
	jieqi_getconfigs($v->getVar("name", "n"), "adminmenu");
}

jieqi_getconfigs("system", "adminmenu", "jieqiAdminmenu");
$jieqiTpl->assign("jieqimodules", $jieqiModary);
$jieqiTpl->assign("adminmenus", $jieqiAdminmenu);
$jieqiTpl->assign("jieqi_adminurl", JIEQI_URL . "/admin/main.php");
$jieqiTpl->setCaching(0);
$jieqiTpl->display(jieqi_path_template("admin/left.html", "system"));

?>
