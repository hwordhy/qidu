<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallreview"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/reviewslist.html";
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
include_once jieqi_path_lib("text/textfunction.php");
include_once jieqi_path_inc("include/funpost.php", "system");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$criteria = new CriteriaCompo();
$criteria->setFields("r.*,a.articlename");
$criteria->setTables(jieqi_dbprefix("article_reviews") . " AS r LEFT JOIN " . jieqi_dbprefix("article_article") . " AS a ON r.ownerid=a.articleid");
$criteria->add(new Criteria("r.display", 0));

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("r.poster", $_REQUEST["keyword"], "="));
	}
	else if ($_REQUEST["keytype"] == 2) {
		$criteria->add(new Criteria("r.title", "%" . $_REQUEST["keyword"] . "%", "LIKE"));
	}
	else {
		$criteria->add(new Criteria("a.articlename", $_REQUEST["keyword"], "="));
	}
}

if (isset($_REQUEST["type"]) && ($_REQUEST["type"] == "good")) {
	$jieqiTpl->assign("type", "good");
	$criteria->add(new Criteria("r.isgood", 1));
}
else {
	$_REQUEST["type"] = "all";
	$jieqiTpl->assign("type", "all");
}

$criteria->setSort("topicid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$query->queryObjects($criteria);
$reviewrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$reviewrows[$k] = jieqi_topic_vars($v);
	$reviewrows[$k]["articlename"] = $v->getVar("articlename");
	$reviewrows[$k]["url_articleinfo"] = jieqi_geturl("article", "article", $v->getVar("ownerid"), "info", $v->getVar("articlecode", "n"));
	$k++;
}

$jieqiTpl->assign_by_ref("reviewrows", $reviewrows);
$jieqiTpl->assign("ismanager", intval($ismanager));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink("", true, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
