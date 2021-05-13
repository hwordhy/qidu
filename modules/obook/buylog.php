<?php

define("JIEQI_MODULE_NAME", "obook");
require_once ("../../global.php");
jieqi_checklogin();
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("buylog.html", "obook");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
jieqi_getconfigs("obook", "configs");
$obook_static_url = (empty($jieqiConfigs["obook"]["staticurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["staticurl"]);
$obook_dynamic_url = (empty($jieqiConfigs["obook"]["dynamicurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["dynamicurl"]);
$jieqiTpl->assign("obook_static_url", $obook_static_url);
$jieqiTpl->assign("obook_dynamic_url", $obook_dynamic_url);
include_once jieqi_path_inc("class/obuyinfo.php", "obook");
$obuyinfo_handler = &JieqiObuyinfoHandler::getInstance("JieqiObuyinfoHandler");
$criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));

if (!empty($_REQUEST["oid"])) {
	$criteria->add(new Criteria("obookid", intval($_REQUEST["oid"])));
}
else if (!empty($_REQUEST["aid"])) {
	$criteria->add(new Criteria("articleid", intval($_REQUEST["aid"])));
}
else if (!empty($_REQUEST["oname"])) {
	$criteria->add(new Criteria("obookname", $_REQUEST["oname"]));
}
else if (!empty($_REQUEST["aname"])) {
	$criteria->add(new Criteria("obookname", $_REQUEST["aname"]));
}

$criteria->setSort("obuyinfoid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$obuyinfo_handler->queryObjects($criteria);
$obuyinforows = array();
$k = 0;
$articleid = 0;
$obookid = 0;
$obookname = "";

while ($v = $obuyinfo_handler->getObject()) {
	$obuyinforows[$k] = jieqi_query_rowvars($v, "s");
	if (($obookname == "") && (!empty($_REQUEST["oid"]) || !empty($_REQUEST["aid"]) || !empty($_REQUEST["oname"]) || !empty($_REQUEST["aname"]))) {
		$articleid = $obuyinforows[$k]["articleid"];
		$obookid = $obuyinforows[$k]["obookid"];
		$obookname = $obuyinforows[$k]["obookname"];
	}
    $obuyinforows[$k]["buy_time"] = date("Y-m-d H:i:s", $obuyinforows[$k]["buytime"]);
	$k++;
}

$jieqiTpl->assign_by_ref("obuyinforows", $obuyinforows);
$jieqiTpl->assign_by_ref("articleid", $articleid);
$jieqiTpl->assign_by_ref("obookid", $obookid);
$jieqiTpl->assign_by_ref("obookname", $obookname);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $obuyinfo_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = "";

if (!empty($_REQUEST["oid"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "oid=" . urlencode($_REQUEST["oid"]);
}
else if (!empty($_REQUEST["aid"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "aid=" . urlencode($_REQUEST["aid"]);
}
else if (!empty($_REQUEST["oname"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "oname=" . urlencode($_REQUEST["oname"]);
}
else if (!empty($_REQUEST["aname"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "aname=" . urlencode($_REQUEST["aname"]);
}

if (empty($pagelink)) {
	$pagelink .= "?page=";
}
else {
	$pagelink .= "&page=";
}

$jumppage->setlink($obook_dynamic_url . "/buylog.php" . $pagelink, false, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    echo json_encode(array("success" => true, "data" => array("list" => $obuyinforows, "totalpage" => $jumppage->totalpages, "totalrows"=>$jumppage->totalrows), "message" => '获取成功'));
    return false;
}

$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
