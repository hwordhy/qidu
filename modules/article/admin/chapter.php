<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["viewuplog"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_inc("include/funchapter.php", "article");
include_once jieqi_path_inc("class/chapter.php", "article");
$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/chapterlist.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$criteria = new CriteriaCompo();

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("poster", $_REQUEST["keyword"], "="));
	}
	else {
		$criteria->add(new Criteria("articlename", $_REQUEST["keyword"], "="));
	}
}

$jieqiTpl->assign("articletitle", $jieqiLang["article"]["chapter_update_list"]);
$jieqiTpl->assign("url_chapter", $article_dynamic_url . "/admin/chapter.php");
$criteria->setSort("chapterid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$chapter_handler->queryObjects($criteria);
$chapterrows = array();
$k = 0;

while ($v = $chapter_handler->getObject()) {
	$chapterrows[$k] = jieqi_article_chaptervars($v);
	$k++;
}

$jieqiTpl->assign_by_ref("chapterrows", $chapterrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $chapter_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = "";

if (!empty($_REQUEST["keyword"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "keyword=" . urlencode($_REQUEST["keyword"]);
	$pagelink .= "&keytype=" . urlencode($_REQUEST["keytype"]);
}

if (empty($pagelink)) {
	$pagelink .= "?page=";
}
else {
	$pagelink .= "&page=";
}

$jumppage->setlink($article_dynamic_url . "/admin/chapter.php" . $pagelink, false, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
