<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("hurry", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/articlehurry.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$slimit = "1";

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 1) {
		$slimit .= " AND uname = '" . jieqi_dbslashes($_REQUEST["keyword"]) . "'";
	}
	else {
		$where .= " AND articlename = '" . jieqi_dbslashes($_REQUEST["keyword"]) . "'";
	}
}

if ($_REQUEST["payflag"] == 1) {
	$slimit .= " AND payflag = 1";
}
else if ($_REQUEST["payflag"] == 2) {
	$slimit .= " AND payflag = 2";
}
else {
	$slimit .= " AND payflag = 0";
}

$sql = "SELECT * FROM " . jieqi_dbprefix("article_hurry") . " WHERE $slimit ORDER BY hurryid DESC LIMIT {$jieqiPset["start"]},{$jieqiPset["rows"]}";
$query->execute($sql);
$hurryrows = array();
$k = 0;

while ($row = $query->getRow()) {
	$hurryrows[$k] = jieqi_query_rowvars($row);
	$k++;
}

$jieqiTpl->assign_by_ref("hurryrows", $hurryrows);
include_once jieqi_path_lib("html/page.php");
$sql = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("article_hurry") . " WHERE $slimit";
$query->execute($sql);
$row = $query->getRow();
$jieqiPset["count"] = intval($row["cot"]);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
