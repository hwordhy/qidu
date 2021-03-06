<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_loadlang("manage", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$canedit = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($article->getVar("posterid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail($jieqiLang["article"]["noper_manage_article"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("articlehurry.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$slimit = "articleid = " . $_REQUEST["id"];

if (isset($_REQUEST["payflag"])) {
	if ($_REQUEST["payflag"] == 1) {
		$slimit .= " AND payflag = 1";
	}
	else if ($_REQUEST["payflag"] == 2) {
		$slimit .= " AND payflag = 2";
	}
	else {
		$slimit .= " AND payflag = 0";
	}
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
$jieqiTpl->assign("articleid", $_REQUEST["id"]);

if (isset($_REQUEST["payflag"])) {
	$jieqiTpl->assign("payflag", $_REQUEST["payflag"]);
}
else {
	$jieqiTpl->assign("payflag", "");
}

$jieqiTpl->assign("isvip", $article->getVar("isvip"));
$jieqiTpl->assign("vipid", $article->getVar("vipid"));
$jieqiTpl->assign("articlename", $article->getVar("articlename"));
$sql = "SELECT count(*) as count, sum(minsize) as minsize, sum(payegold) as payegold  FROM " . jieqi_dbprefix("article_hurry") . " WHERE $slimit LIMIT 0,1";
$query->execute($sql);
$row = $query->getRow();
$hurrysum = (is_array($row) ? jieqi_query_rowvars($row) : array());
$jieqiTpl->assign_by_ref("hurrysum", $hurrysum);
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
