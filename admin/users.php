<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminuser"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/users.html", "system");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$criteria = new CriteriaCompo();
$criteria->setSort("uid");
$criteria->setOrder("DESC");
if (isset($_REQUEST["keyword"]) && !empty($_REQUEST["keyword"])) {
	switch ($_REQUEST["keytype"]) {
	case "name":
		$criteria->add(new Criteria("name", $_REQUEST["keyword"], "="));
		break;

	case "email":
		$criteria->add(new Criteria("email", $_REQUEST["keyword"], "="));
		break;

	case "mobile":
		$criteria->add(new Criteria("mobile", $_REQUEST["keyword"], "="));
		break;

	case "channel":
		$criteria->add(new Criteria("channel", $_REQUEST["keyword"], "="));
		break;

	case "uname":
	default:
		$criteria->add(new Criteria("uname", $_REQUEST["keyword"], "="));
		break;
	}
}
else {
	if (isset($_REQUEST["groupid"]) && !empty($_REQUEST["groupid"])) {
		$criteria->add(new Criteria("groupid", intval($_REQUEST["groupid"]), "="));
	}
	else {
		if (isset($_REQUEST["isvip"]) && (0 < $_REQUEST["isvip"])) {
			$criteria->add(new Criteria("isvip", 0, ">"));
		}
		else {
			if (isset($_REQUEST["monthly"]) && (0 < $_REQUEST["monthly"])) {
				$criteria->add(new Criteria("overtime", JIEQI_NOW_TIME, ">"));
				$criteria->setSort("overtime");
				$criteria->setOrder("ASC");
			}
		}
	}
}

$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$users_handler->queryObjects($criteria);
$userrows = array();
$k = 0;
include_once jieqi_path_inc("include/funusers.php", "system");

$userstat = array("cot" => 0, "sumegold" => 0, "sumesilver" => 0);

while ($v = $users_handler->getObject()) {
	$userrows[$k] = jieqi_system_usersvars($v);
	if (empty($userrows[$k]["channel"])) {
		$userrows[$k]["channel"] = '';
	}
	
	$userstat["cot"] += 1;
	$userstat["sumegold"] += $userrows[$k]["egold"];
	$userstat["sumesilver"] += $userrows[$k]["esilver"];
	$k++;
}

$jieqiTpl->assign_by_ref("userrows", $userrows);
$jieqiTpl->assign_by_ref("userstat", $userstat);
$grouprows = array();
$i = 0;

foreach ($jieqiGroups as $k => $v ) {
	if (1 < $k) {
		$grouprows[$i]["groupid"] = $k;
		$grouprows[$i]["groupname"] = $v;
		$i++;
	}
}

$jieqiTpl->assign_by_ref("grouprows", $grouprows);
$rowcount = $users_handler->getCount($criteria);
$jieqiTpl->assign_by_ref("rowcount", $rowcount);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $rowcount;
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink("", true, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
