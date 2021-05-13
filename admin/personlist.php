<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminuser"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/personlist.html", "system");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$slimit = "1";
$ssort = "uid";
$sorder = "DESC";
$spstart = intval($jieqiPset["start"]);
$sprows = intval($jieqiPset["rows"]);
if (isset($_REQUEST["keyword"]) && !empty($_REQUEST["keyword"])) {
	switch ($_REQUEST["keytype"]) {
	case "idcard":
		$slimit = "idcard = '" . jieqi_dbslashes($_REQUEST["keyword"]) . "'";
		break;

	case "telephone":
		$slimit = "telephone LIKE '%" . jieqi_dbslashes($_REQUEST["keyword"]) . "%'";
		break;

	case "mobilephone":
		$slimit = "mobilephone = '" . jieqi_dbslashes($_REQUEST["keyword"]) . "'";
		break;

	case "realname":
	default:
		$slimit = "realname = '" . jieqi_dbslashes($_REQUEST["keyword"]) . "'";
		break;
	}
}

$sql = "SELECT * FROM " . jieqi_dbprefix("system_persons") . " WHERE $slimit ORDER BY $ssort $sorder LIMIT $spstart,$sprows";
$sqlcot = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("system_persons") . " WHERE $slimit";
$query->execute($sql);
$personsrows = array();
$k = 0;
include_once jieqi_path_inc("include/funpersons.php", "system");

while ($row = $query->getRow()) {
	$personsrows[$k] = jieqi_system_personsvars($row);
	$k++;
}

$jieqiTpl->assign_by_ref("personsrows", $personsrows);
include_once jieqi_path_lib("html/page.php");
$query->execute($sqlcot);
$row = $query->getRow();
$jieqiPset["count"] = intval($row["cot"]);
$jieqiTpl->assign_by_ref("rowcount", $jieqiPset["count"]);
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink("", true, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
