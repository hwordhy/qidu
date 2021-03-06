<?php

define("JIEQI_MODULE_NAME", "news");
require_once ("../../global.php");

if (isset($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);
}

if (!empty($_REQUEST["keyword"])) {
	jieqi_getconfigs(JIEQI_MODULE_NAME, "configs", "jieqiConfigs");
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
	jieqi_loadlang("news", JIEQI_MODULE_NAME);
	include_once jieqi_path_inc("class/topic.php", "news");
	$topic_handler = &JieqiNewstopicHandler::getInstance("JieqiNewstopicHandler");
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("searchresult.html", "news");
	include_once jieqi_path_common("header.php");
	$jieqiPset = jieqi_get_pageset();
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("display", 0, "="));

	if (empty($_REQUEST["keytype"])) {
		$_REQUEST["keytype"] = 0;
	}

	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("poster", $_REQUEST["keyword"], "="));
	}
	else {
		$criteria->add(new Criteria("title", "%" . $_REQUEST["keyword"] . "%", "LIKE"));
	}

	$criteria->setSort("topicid");
	$criteria->setOrder("DESC");
	$criteria->setLimit($jieqiPset["rows"]);
	$criteria->setStart($jieqiPset["start"]);
	$topic_handler->queryObjects($criteria);
	$newsrows = array();
	$k = 0;
	include_once jieqi_path_inc("include/funnews.php", "news");

	while ($v = $topic_handler->getObject()) {
		$newsrows[$k] = jieqi_news_vars($v);
		$k++;
	}

	$jieqiTpl->assign_by_ref("newsrows", $newsrows);
	$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["news"]));
	include_once jieqi_path_lib("html/page.php");
	$jieqiPset["count"] = $topic_handler->getCount($criteria);
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

	$jumppage->setlink($jieqiModules["news"]["url"] . "/search.php" . $pagelink, false, true);
	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
	$jieqiTpl->setCaching(0);
	include_once jieqi_path_common("footer.php");
}
else {
	include_once jieqi_path_common("header.php");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("search.html", "news");
	include_once jieqi_path_common("footer.php");
}

?>
