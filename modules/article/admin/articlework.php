<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("manage", JIEQI_MODULE_NAME);
jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
$monthdays = date("t", $monthstart);
$prestart = mktime(0, 0, 0, (int) $tmpvar[1] - 1, 1, (int) $tmpvar[0]);
$predays = date("t", $prestart);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql = "UPDATE " . jieqi_dbprefix("article_article") . " SET preupds = 0, preupdt = 0 WHERE lastupdate < $prestart AND preupds > 0";
$query->execute($sql);
$sql = "UPDATE " . jieqi_dbprefix("article_article") . " SET preupds = monthupds, preupdt = monthupdt WHERE lastupdate >= $prestart AND lastupdate < $monthstart AND preupds != monthupds";
$query->execute($sql);
include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/articlework.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
jieqi_getconfigs("article", "sort");

if (empty($_REQUEST["sortid"])) {
	$_REQUEST["sortid"] = 0;
}

$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));
$jieqiTpl->assign("monthdays", $monthdays);
$jieqiTpl->assign("predays", $predays);
$criteria = new CriteriaCompo();

if (isset($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);
}

if (!empty($_REQUEST["keyword"])) {
	switch ($_REQUEST["keytype"]) {
	case 1:
		$keyfield = "author";
		break;

	case 2:
		$keyfield = "poster";
		break;

	case 3:
		$keyfield = "agent";
		break;

	case 4:
		$keyfield = "master";
		break;

	case 10:
		$keyfield = "articleid";
		$_REQUEST["keyfull"] = 1;
		break;

	case 11:
		$keyfield = "authorid";
		$_REQUEST["keyfull"] = 1;
		break;

	case 12:
		$keyfield = "posterid";
		$_REQUEST["keyfull"] = 1;
		break;

	case 13:
		$keyfield = "agentid";
		$_REQUEST["keyfull"] = 1;
		break;

	case 14:
		$keyfield = "masterid";
		$_REQUEST["keyfull"] = 1;
		break;

	default:
		$keyfield = "articlename";
		break;
	}

	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);
	$tmpary = explode(" ", $_REQUEST["keyword"]);

	if (1 < jieqi_count($tmpary)) {
		foreach ($tmpary as $k => $v ) {
			$tmpary[$k] = "'" . jieqi_dbslashes($v) . "'";
		}

		$criteria->add(new Criteria($keyfield, "(" . implode(",", $tmpary) . ")", "IN"));
	}
	else if (empty($_REQUEST["keyfull"])) {
		$criteria->add(new Criteria($keyfield, "%" . $_REQUEST["keyword"] . "%", "LIKE"));
	}
	else {
		$criteria->add(new Criteria($keyfield, $_REQUEST["keyword"], "="));
	}
}

if (!empty($_REQUEST["siteid"])) {
	$_REQUEST["siteid"] = intval($_REQUEST["siteid"]);

	switch ($_REQUEST["siteid"]) {
	case -1:
		$criteria->add(new Criteria("siteid", 0, "="));
		break;

	case -2:
		$criteria->add(new Criteria("siteid", 0, ">"));
		break;

	default:
		$criteria->add(new Criteria("siteid", $_REQUEST["siteid"], "="));
		break;
	}
}

if (!empty($_REQUEST["sortid"])) {
	$criteria->add(new Criteria("sortid", $_REQUEST["sortid"], "="));
}

if (!empty($_REQUEST["typeid"])) {
	$criteria->add(new Criteria("typeid", $_REQUEST["typeid"], "="));
}

if (!empty($_REQUEST["isfull"])) {
	if ($_REQUEST["isfull"] == 1) {
		$criteria->add(new Criteria("fullflag", 1, "="));
	}
	else if ($_REQUEST["isfull"] == 2) {
		$criteria->add(new Criteria("fullflag", 0, "="));
	}
}

if (!empty($_REQUEST["display"])) {
	switch ($_REQUEST["display"]) {
	case "unshow":
		$criteria->add(new Criteria("display", 0, ">"));
		break;

	case "ready":
		$criteria->add(new Criteria("display", 1, "="));
		break;

	case "hide":
		$criteria->add(new Criteria("display", 2, "="));
		break;

	case "show":
		$criteria->add(new Criteria("display", 0, "="));
		break;

	case "empty":
		$criteria->add(new Criteria("size", 0, "="));
		break;

	case "agent":
		$criteria->add(new Criteria("siteid", 0, ">"));
		break;

	case "sign":
		$criteria->add(new Criteria("issign", 0, ">"));
		break;

	case "nosign":
		$criteria->add(new Criteria("issign", 0, "="));
		break;

	case "vip":
		$criteria->add(new Criteria("isvip", 0, ">"));
		break;

	case "free":
		$criteria->add(new Criteria("isvip", 0, "="));
		break;

	case "wholebuy":
		$criteria->add(new Criteria("isvip", 0, ">"));
		$criteria->add(new Criteria("saleprice", 0, ">"));
		break;
	}
}

include_once jieqi_path_inc("include/funarticle.php", "article");
$jieqiTpl->assign("articletitle", $articletitle);
$jieqiTpl->assign("display", urlencode($_REQUEST["display"]));
$jieqiTpl->assign("url_article", $jieqiModules["article"]["url"] . "/admin/article.php");
$jieqiTpl->assign("url_batchaction", $article_static_url . "/admin/batchaction.php");
$jieqiTpl->assign("url_jump", jieqi_addurlvars(array()));
if (!empty($_REQUEST["order"]) && ($_REQUEST["order"] == "monthupds")) {
	$c_sort = "monthupds";
	$criteria->add(new Criteria("lastupdate", $monthstart, ">="));
}
else {
	$c_sort = "preupds";
	$criteria->add(new Criteria("lastupdate", $prestart, ">="));
}

$criteria->setSort($c_sort . " DESC, size");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$article_handler->queryObjects($criteria);
$articlerows = array();
$k = 0;

while ($v = $article_handler->getObject()) {
	$articlerows[$k] = jieqi_article_vars($v);
	$k++;
}

$jieqiTpl->assign_by_ref("articlerows", $articlerows);
$jieqiTpl->assign("order", $c_sort);
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $article_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
