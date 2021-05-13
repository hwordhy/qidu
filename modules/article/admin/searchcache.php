<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("search", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_inc("class/searchcache.php", "article");
$searchcache_handler = &JieqiSearchcacheHandler::getInstance("JieqiSearchcacheHandler");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/searchcache.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$criteria = new CriteriaCompo();

switch ($_REQUEST["flag"]) {
case "title":
	$criteria->add(new Criteria("searchtype", 1, "="));
	break;

case "author":
	$criteria->add(new Criteria("searchtype", 2, "="));
	break;

case "notitle":
	$criteria->add(new Criteria("searchtype", 1, "="));
	$criteria->add(new Criteria("results", 0, "="));
	break;

case "noauthor":
	$criteria->add(new Criteria("searchtype", 2, "="));
	$criteria->add(new Criteria("results", 0, "="));
	break;

default:
	break;
}

$criteria->setSort("cacheid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$searchcache_handler->queryObjects($criteria);
$cacherows = array();
$k = 0;

while ($v = $searchcache_handler->getObject()) {
	$cacherows[$k]["searchtime"] = date(JIEQI_DATE_FORMAT . " " . JIEQI_TIME_FORMAT, $v->getVar("searchtime"));
	$cacherows[$k]["keywords"] = $v->getVar("keywords");
	$searchtype = $v->getVar("searchtype");

	if ($searchtype == 1) {
		$cacherows[$k]["searchtype"] = $jieqiLang["article"]["search_with_article"];
	}
	else if ($searchtype == 2) {
		$cacherows[$k]["searchtype"] = $jieqiLang["article"]["search_with_author"];
	}
	else {
		$cacherows[$k]["searchtype"] = $jieqiLang["article"]["search_with_all"];
	}

	$cacherows[$k]["results"] = $v->getVar("results");
	$k++;
}

$jieqiTpl->assign_by_ref("cacherows", $cacherows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $searchcache_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = "";

if (!empty($_REQUEST["flag"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "flag=" . urlencode($_REQUEST["flag"]);
}

if (empty($pagelink)) {
	$pagelink .= "?page=";
}
else {
	$pagelink .= "&page=";
}

$jumppage->setlink($article_dynamic_url . "/admin/searchcache.php" . $pagelink, false, false);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
