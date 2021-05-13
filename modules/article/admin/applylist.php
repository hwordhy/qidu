<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["setwriter"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("applywriter", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");

if (!empty($_POST["act"])) {
	jieqi_checkpost();
}

include_once jieqi_path_inc("class/applywriter.php", "article");
$apply_handler = &JieqiApplywriterHandler::getInstance("JieqiApplywriterHandler");
if (isset($_POST["act"]) && !empty($_REQUEST["id"])) {
	$apply = $apply_handler->get($_REQUEST["id"]);

	if (!is_object($apply)) {
		jieqi_printfail($jieqiLang["article"]["apply_not_exists"]);
	}

	switch ($_POST["act"]) {
	case "confirm":
		$apply->setVar("authtime", JIEQI_NOW_TIME);
		$apply->setVar("authuid", $_SESSION["jieqiUserId"]);
		$apply->setVar("authname", $_SESSION["jieqiUserName"]);
		$apply->setVar("applyflag", 1);
		$apply_handler->insert($apply);
		include_once jieqi_path_inc("class/groups.php", "system");
		$key = array_search($jieqiConfigs["article"]["writergroup"], $jieqiGroups);

		if ($key == false) {
			jieqi_printfail($jieqiLang["article"]["no_writer_group"]);
		}
		else if ($key == JIEQI_GROUP_ADMIN) {
			jieqi_printfail($jieqiLang["article"]["no_writer_admin"]);
		}

		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
		$jieqiUsers = $users_handler->get($apply->getVar("applyuid", "n"));

		if (is_object($jieqiUsers)) {
			$jieqiUsers->setVar("groupid", $key);
			$users_handler->insert($jieqiUsers);
		}

		include_once jieqi_path_inc("include/funmessage.php", "system");
		jieqi_sendmessage($apply->getVar("applyuid", "n"), $apply->getVar("applyname", "n"), $jieqiLang["article"]["apply_confirm_title"], $jieqiLang["article"]["apply_confirm_text"]);

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "refuse":
		$apply->setVar("authtime", JIEQI_NOW_TIME);
		$apply->setVar("authuid", $_SESSION["jieqiUserId"]);
		$apply->setVar("authname", $_SESSION["jieqiUserName"]);
		$apply->setVar("applyflag", 2);
		$apply_handler->insert($apply);
		include_once jieqi_path_inc("include/funmessage.php", "system");
		jieqi_sendmessage($apply->getVar("applyuid", "n"), $apply->getVar("applyname", "n"), $jieqiLang["article"]["apply_refuse_title"], $jieqiLang["article"]["apply_refuse_text"]);

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "delete":
		$apply_handler->delete($_REQUEST["id"]);
		jieqi_jumppage($jieqiModules["article"]["url"] . "/admin/applylist.php", "", "", true);
		break;
	}

	unset($criteria);
}
else {
	if (isset($_POST["act"]) && ($_POST["act"] == "batchdel") && is_array($_REQUEST["applyid"]) && (0 < jieqi_count($_REQUEST["applyid"]))) {
		$where = "";

		foreach ($_REQUEST["applyid"] as $v ) {
			if (is_numeric($v)) {
				$v = intval($v);

				if (!empty($where)) {
					$where .= ", ";
				}

				$where .= $v;
			}
		}

		if (!empty($where)) {
			$sql = "DELETE FROM " . jieqi_dbprefix("article_applywriter") . " WHERE applyid IN (" . $where . ")";
			$apply_handler->execute($sql);
		}

		jieqi_jumppage($jieqiModules["article"]["url"] . "/admin/applylist.php", "", "", true);
	}
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/applylist.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$criteria = new CriteriaCompo();

switch ($_REQUEST["display"]) {
case "ready":
	$criteria->add(new Criteria("applyflag", 0));
	break;

case "success":
	$criteria->add(new Criteria("applyflag", 1));
	break;

case "failure":
	$criteria->add(new Criteria("applyflag", 2));
	break;
}

$criteria->setSort("applyid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$apply_handler->queryObjects($criteria);
$applyrows = array();
$k = 0;

while ($v = $apply_handler->getObject()) {
	$applyrows[$k] = jieqi_query_rowvars($v);
	$applyrows[$k]["applysize_c"] = jieqi_sizeformat($v->getVar("applysize"), "c");
	$applyrows[$k]["applysize_k"] = jieqi_sizeformat($v->getVar("applysize"), "k");
	$applyrows[$k]["applysize_w"] = jieqi_sizeformat($v->getVar("applysize"), "w");

	if ($applyrows[$k]["applyflag"] == 2) {
		$applyrows[$k]["authstatus"] = $jieqiLang["article"]["apply_status_failure"];
	}
	else if ($applyrows[$k]["applyflag"] == 1) {
		$applyrows[$k]["authstatus"] = $jieqiLang["article"]["apply_status_success"];
	}
	else {
		$applyrows[$k]["authstatus"] = $jieqiLang["article"]["apply_status_ready"];
	}

	$k++;
}

$jieqiTpl->assign_by_ref("applyrows", $applyrows);
$jieqiTpl->assign("url_jump", jieqi_addurlvars(array()));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $apply_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = "";

if (!empty($_REQUEST["display"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "display=" . urlencode($_REQUEST["display"]);
}

if (empty($pagelink)) {
	$pagelink .= "?page=";
}
else {
	$pagelink .= "&page=";
}

$jumppage->setlink($jieqiModules["article"]["url"] . "/admin/applylist.php" . $pagelink, false, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
