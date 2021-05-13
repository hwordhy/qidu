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

if (!empty($_POST["act"])) {
	jieqi_checkpost();
}

include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
include_once jieqi_path_inc("class/obook.php", "obook");
$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
if (isset($_POST["act"]) && !empty($_REQUEST["id"])) {
	include_once jieqi_path_inc("include/actarticle.php", "article");
	$_REQUEST["id"] = intval($_REQUEST["id"]);
	$criteria = new CriteriaCompo(new Criteria("articleid", $_REQUEST["id"]));

	switch ($_POST["act"]) {
	case "show":
		$article_handler->updatefields(array("display" => 0), $criteria);
		jieqi_article_updateinfo($_REQUEST["id"], "articleshow");

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "hide":
		$article_handler->updatefields(array("display" => 2), $criteria);
		jieqi_article_updateinfo($_REQUEST["id"], "articlehide");

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "ready":
		$article_handler->updatefields(array("display" => 1), $criteria);
		jieqi_article_updateinfo($_REQUEST["id"], "articlehide");

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "toptime":
		$article_handler->updatefields(array("toptime" => JIEQI_NOW_TIME), $criteria);

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "untoptime":
		$article_handler->updatefields(array("toptime" => 0), $criteria);

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;

	case "del":
		$canedit = jieqi_checkpower($jieqiPower["article"]["delallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true, true);

		if ($canedit) {
			$article = $article_handler->get($_REQUEST["id"]);

			if (is_object($article)) {
				jieqi_article_delete($_REQUEST["id"]);
			}
		}

		jieqi_jumppage($jieqiModules["article"]["url"] . "/admin/article.php?display=" . urlencode($_REQUEST["diaplay"]), "", "", true);
		break;

	case "wholebuy":
		$article_handler->updatefields(array("saleprice" => $_REQUEST["wholeprice"]), $criteria);
		$obook_handler->updatefields(array("saleprice" => $_REQUEST["wholeprice"]), $criteria);

		if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
		}

		break;
	}

	unset($criteria);
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/articlelist.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
jieqi_getconfigs("article", "sort");

if (empty($_REQUEST["sortid"])) {
	$_REQUEST["sortid"] = 0;
}

$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));

if (2 <= floatval(JIEQI_VERSION)) {
	jieqi_getconfigs("system", "sites", "jieqiSites");
	$customsites = array();

	if (is_array($jieqiSites)){
		foreach ($jieqiSites as $k => $v ) {
			if (!empty($v["custom"])) {
				$customsites[$k] = $v;
			}
		}
	}


	$jieqiTpl->assign("customsites", jieqi_funtoarray("jieqi_htmlstr", $customsites));
	$jieqiTpl->assign("customsitenum", jieqi_count($customsites));
	$jieqiTpl->assign("jieqisites", jieqi_funtoarray("jieqi_htmlstr", $jieqiSites));
}

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
$orderary = array("articleid", "articlename", "postdate", "lastupdaye", "toptime", "goodnum", "hotnum", "ratenum", "size", "monthsize", "weeksize", "daysize", "presize", "allvisit", "monthvisit", "weekvisit", "dayvisit", "allvote", "monthvote", "weekvote", "dayvote", "allvipvote", "monthvipvote", "weekvipvote", "dayvipvote", "previpvote", "allflower", "monthflower", "weekflower", "dayflower", "preflower", "allegg", "monthegg", "weekegg", "dayegg", "preegg");
if (!empty($_REQUEST["order"]) && in_array($_REQUEST["order"], $orderary)) {
	$c_sort = $_REQUEST["order"];
}
else {
	$c_sort = "lastupdate";
}

if (!empty($_REQUEST["asc"])) {
	$c_order = "ASC";
}
else {
	$c_order = "DESC";
}

$jieqiTpl->assign("sort", urlencode($c_sort));
$jieqiTpl->assign("order", urlencode($c_order));
$criteria->setSort(str_replace("lastupdate", "greatest(lastupdate, postdate)", $c_sort));
$criteria->setOrder($c_order);
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$article_handler->queryObjects($criteria);
$articlerows = array();
$k = 0;
$rowcount = 0;
while ($v = $article_handler->getObject()) {
	$articlerows[$k] = jieqi_article_vars($v);
	$rowcount += 1;
	$k++;
}
$jieqiTpl->assign_by_ref("articlerows", $articlerows);
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $article_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("rowcount", $jumppage->totalrows);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
