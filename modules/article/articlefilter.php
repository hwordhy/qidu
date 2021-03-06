<?php

function jieqi_article_joinobook_replace($sql)
{
	$freeorders = array("display", "fullflag", "siteid", "sourceid", "sortid", "typeid", "rgroup", "original", "authorid", "progress", "isvip", "issign", "articleid", "initial", "lastupdate", "infoupdate", "freetime", "viptime", "postdate", "toptime", "goodnum", "reviewsnum", "ratenum", "ratesum", "allsize", "monthsize", "weeksize", "daysize", "allvipvote", "monthvipvote", "weekvipvote", "dayvipvote", "previpvote", "allvisit", "monthvisit", "weekvisit", "dayvisit", "allvote", "monthvote", "weekvote", "dayvote", "allflower", "monthflower", "weekflower", "dayflower", "allegg", "monthegg", "weekegg", "dayegg", "alldown", "monthdown", "weekdown", "daydown");
	$viporders = array("lastsale", "allsale", "monthsale", "weeksale", "daysale", "normalsale", "vipsale", "freesale", "bespsale", "totalsale", "sumegold", "sumesilver", "sumtip", "sumhurry", "sumbesp", "sumaward", "sumagent", "sumgift", "sumother", "sumemoney", "summoney");
	$orderfrom = array();
	$orderto = array();

	foreach ($freeorders as $order ) {
		$orderfrom[] = $order;
		$orderto[] = "a." . $order;
	}

	foreach ($viporders as $order ) {
		$orderfrom[] = $order;
		$orderto[] = "o." . $order;
	}

	$sql = preg_replace("/(^|[^a-z])size($|[^a-z])/i", "\$1allsize\$2", $sql);
	$sql = str_replace($orderfrom, $orderto, $sql);
	$sql = str_replace("allsize", "size", $sql);
	return $sql;
}

define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs("article", "configs", "jieqiConfigs");
jieqi_getconfigs("article", "sort", "jieqiSort");
jieqi_getconfigs("article", "option", "jieqiOption");
jieqi_getconfigs("article", "filter", "jieqiFilter");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("articlefilter.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
include_once jieqi_path_inc("include/funarticle.php", "article");
$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));
$filterary = array();
$filtersql = " WHERE display = 0 AND size > 0";
$_GET = jieqi_funtoarray("trim", $_GET);
$filterary["order"] = "lastupdate";

if (isset($_GET["order"])) {
	if (isset($jieqiFilter["article"]["order"][$_GET["order"]])) {
		$filterary["order"] = $_GET["order"];
	}
	else {
		unset($_GET["order"]);
	}
}

$_GET["order"] = $filterary["order"];
$orderrows = array();
$varary = $_GET;

if (isset($varary["order"])) {
	unset($varary["order"]);
}

$i = 1;

foreach ($jieqiFilter["article"]["order"] as $k => $v ) {
	$orderrows[$i]["name"] = $v["caption"];
	$varary["order"] = $k;
	$orderrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$orderrows[$i]["selected"] = (isset($filterary["order"]) && ($filterary["order"] == $k) ? 1 : 0);
    $orderrows[$i]["id"] = $varary["order"];
	$i++;
}

$jieqiTpl->assign_by_ref("orderrows", $orderrows);
$jieqiTpl->assign("ordername", jieqi_htmlstr($jieqiFilter["article"]["order"][$filterary["order"]]["caption"]));

if (!isset($jieqiFilter["article"]["order"][$filterary["order"]]["sort"])) {
	$tmpary = preg_split("/asc|desc/i", $jieqiFilter["article"]["order"][$filterary["order"]]["order"]);
	$jieqiFilter["article"]["order"][$filterary["order"]]["sort"] = trim($tmpary[0]);
}

$orderfield = $jieqiFilter["article"]["order"][$filterary["order"]]["sort"];
$jieqiTpl->assign("orderfield", $orderfield);
if (!empty($_GET["sortid"]) && isset($jieqiSort["article"][$_GET["sortid"]])) {
	$filterary["sortid"] = $_GET["sortid"];
	$filtersql .= " AND sortid = " . intval($filterary["sortid"]);
	if (isset($_GET["typeid"]) && isset($jieqiSort["article"][$_GET["sortid"]]["types"][$_GET["typeid"]])) {
		$filterary["typeid"] = $_GET["typeid"];
		$filtersql .= " AND typeid = " . intval($filterary["typeid"]);
	}
	else if (isset($_GET["typeid"])) {
		unset($_GET["typeid"]);
	}
}
else {
	if (isset($_GET["sortid"])) {
		unset($_GET["sortid"]);
	}

	if (isset($_GET["typeid"])) {
		unset($_GET["typeid"]);
	}
}

$sortidrows = array();
$sortidrows[0]["name"] = $jieqiLang["article"]["article_filter_all"];
$varary = $_GET;

if (isset($varary["sortid"])) {
	unset($varary["sortid"]);
}

if (isset($varary["typeid"])) {
	unset($varary["typeid"]);
}

$sortidrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
$sortidrows[0]["selected"] = (isset($filterary["sortid"]) ? 0 : 1);
$i = 1;

foreach ($jieqiSort["article"] as $k => $v ) {
	$sortidrows[$i]["name"] = $v["caption"];
	$varary["sortid"] = $k;
	$sortidrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$sortidrows[$i]["selected"] = (isset($filterary["sortid"]) && ($filterary["sortid"] == $k) ? 1 : 0);
    $sortidrows[$i]["rgroup"] = $v["rgroup"];
    $sortidrows[$i]["id"] = $varary["sortid"];
	$i++;
}

$jieqiTpl->assign_by_ref("sortidrows", $sortidrows);
$typeidrows = array();
if (isset($filterary["sortid"]) && !empty($jieqiSort["article"][$filterary["sortid"]]["types"])) {
	$typeidrows[0]["name"] = $jieqiLang["article"]["article_filter_all"];
	$varary = $_GET;

	if (isset($varary["typeid"])) {
		unset($varary["typeid"]);
	}

	$typeidrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$typeidrows[0]["selected"] = (isset($filterary["typeid"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiSort["article"][$filterary["sortid"]]["types"] as $k => $v ) {
		$typeidrows[$i]["name"] = $v;
		$varary["typeid"] = $k;
		$typeidrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$typeidrows[$i]["selected"] = (isset($filterary["typeid"]) && ($filterary["typeid"] == $k) ? 1 : 0);
        $typeidrows[$i]["id"] = $k;
            $i++;
	}
}

$jieqiTpl->assign_by_ref("typeidrows", $typeidrows);

if (isset($jieqiFilter["article"]["size"])) {
	if (isset($_GET["size"])) {
		if (isset($jieqiFilter["article"]["size"][$_GET["size"]])) {
			$filterary["size"] = $_GET["size"];
			$filtersql .= " AND " . $jieqiFilter["article"]["size"][$filterary["size"]]["limit"];
		}
		else {
			unset($_GET["size"]);
		}
	}

	$sizerows = array();
	$sizerows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["size"])) {
		unset($varary["size"]);
	}

	$sizerows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$sizerows[0]["selected"] = (isset($filterary["size"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["size"] as $k => $v ) {
		$sizerows[$i]["name"] = $v["caption"];
		$varary["size"] = $k;
		$sizerows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$sizerows[$i]["selected"] = (isset($filterary["size"]) && ($filterary["size"] == $k) ? 1 : 0);
        $sizerows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("sizerows", $sizerows);
}

if (isset($jieqiFilter["article"]["update"])) {
	if (isset($_GET["update"])) {
		if (isset($jieqiFilter["article"]["update"][$_GET["update"]])) {
			$filterary["update"] = $_GET["update"];
			$filtersql .= " AND lastupdate > " . (time() - (intval($jieqiFilter["article"]["update"][$filterary["update"]]["days"]) * 3600 * 24));
		}
		else {
			unset($_GET["update"]);
		}
	}

	$updaterows = array();
	$updaterows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["update"])) {
		unset($varary["update"]);
	}

	$updaterows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$updaterows[0]["selected"] = (isset($filterary["update"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["update"] as $k => $v ) {
		$updaterows[$i]["name"] = $v["caption"];
		$varary["update"] = $k;
		$updaterows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$updaterows[$i]["selected"] = (isset($filterary["update"]) && ($filterary["update"] == $k) ? 1 : 0);
        $updaterows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("updaterows", $updaterows);
}

if (isset($_GET["initial"])) {
	if (preg_match("/^[A-Z1]$/is", $_GET["initial"])) {
		$_GET["initial"] = strtoupper($_GET["initial"]);
		$filterary["initial"] = $_GET["initial"];
		$filtersql .= " AND initial = '" . strtoupper($filterary["initial"]) . "'";
	}
	else {
		unset($_GET["initial"]);
	}
}

$initialrows = array();
$initialrows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
$varary = $_GET;

if (isset($varary["initial"])) {
	unset($varary["initial"]);
}

$initialrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
$initialrows[0]["selected"] = (isset($filterary["initial"]) ? 0 : 1);
$i = 1;
$initials = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1");

foreach ($initials as $k => $v ) {
	$initialrows[$i]["name"] = "[" . $v . "]";
	$varary["initial"] = $v;
	$initialrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$initialrows[$i]["selected"] = (isset($filterary["initial"]) && ($filterary["initial"] == $v) ? 1 : 0);
    $initialrows[$i]["url"] = $v;
        $i++;
}

$jieqiTpl->assign_by_ref("initialrows", $initialrows);

if (isset($jieqiFilter["article"]["rgroup"])) {
	if (isset($_GET["rgroup"])) {
		if (isset($jieqiFilter["article"]["rgroup"][$_GET["rgroup"]])) {
			$filterary["rgroup"] = $_GET["rgroup"];
			$filtersql .= " AND " . $jieqiFilter["article"]["rgroup"][$filterary["rgroup"]]["limit"];
		}
		else {
			unset($_GET["rgroup"]);
		}
	}

	$rgrouprows = array();
	$rgrouprows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["rgroup"])) {
		unset($varary["rgroup"]);
	}

	$rgrouprows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$rgrouprows[0]["selected"] = (isset($filterary["rgroup"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["rgroup"] as $k => $v ) {
		$rgrouprows[$i]["name"] = $v["caption"];
		$varary["rgroup"] = $k;
		$rgrouprows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$rgrouprows[$i]["selected"] = (isset($filterary["rgroup"]) && ($filterary["rgroup"] == $k) ? 1 : 0);
        $rgrouprows[$i]["id"] = $k;
		$i++;
	}

	$jieqiTpl->assign_by_ref("rgrouprows", $rgrouprows);
}

if (isset($jieqiFilter["article"]["original"])) {
	if (isset($_GET["original"])) {
		if (isset($jieqiFilter["article"]["original"][$_GET["original"]])) {
			$filterary["original"] = $_GET["original"];
			$filtersql .= " AND " . $jieqiFilter["article"]["original"][$filterary["original"]]["limit"];
		}
		else {
			unset($_GET["original"]);
		}
	}

	$originalrows = array();
	$originalrows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["original"])) {
		unset($varary["original"]);
	}

	$originalrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$originalrows[0]["selected"] = (isset($filterary["original"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["original"] as $k => $v ) {
		$originalrows[$i]["name"] = $v["caption"];
		$varary["original"] = $k;
		$originalrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$originalrows[$i]["selected"] = (isset($filterary["original"]) && ($filterary["original"] == $k) ? 1 : 0);
        $originalrows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("originalrows", $originalrows);
}

if (isset($jieqiFilter["article"]["isfull"])) {
	if (isset($_GET["isfull"])) {
		if (isset($jieqiFilter["article"]["isfull"][$_GET["isfull"]])) {
			$filterary["isfull"] = $_GET["isfull"];
			$filtersql .= " AND " . $jieqiFilter["article"]["isfull"][$filterary["isfull"]]["limit"];
		}
		else {
			unset($_GET["isfull"]);
		}
	}

	$isfullrows = array();
	$isfullrows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["isfull"])) {
		unset($varary["isfull"]);
	}

	$isfullrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$isfullrows[0]["selected"] = (isset($filterary["isfull"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["isfull"] as $k => $v ) {
		$isfullrows[$i]["name"] = $v["caption"];
		$varary["isfull"] = $k;
		$isfullrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$isfullrows[$i]["selected"] = (isset($filterary["isfull"]) && ($filterary["isfull"] == $k) ? 1 : 0);
        $isfullrows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("isfullrows", $isfullrows);
}

if (isset($jieqiFilter["article"]["isvip"])) {
	if (isset($_GET["isvip"])) {
		if (isset($jieqiFilter["article"]["isvip"][$_GET["isvip"]])) {
			$filterary["isvip"] = $_GET["isvip"];
			$filtersql .= " AND " . $jieqiFilter["article"]["isvip"][$filterary["isvip"]]["limit"];
		}
		else {
			unset($_GET["isvip"]);
		}
	}

	$isviprows = array();
	$isviprows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["isvip"])) {
		unset($varary["isvip"]);
	}

	$isviprows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$isviprows[0]["selected"] = (isset($filterary["isvip"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["isvip"] as $k => $v ) {
		$isviprows[$i]["name"] = $v["caption"];
		$varary["isvip"] = $k;
		$isviprows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$isviprows[$i]["selected"] = (isset($filterary["isvip"]) && ($filterary["isvip"] == $k) ? 1 : 0);
        $isviprows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("isviprows", $isviprows);
}

if (isset($jieqiFilter["article"]["other"])) {
	if (isset($_GET["other"])) {
		if (isset($jieqiFilter["article"]["other"][$_GET["other"]])) {
			$filterary["other"] = $_GET["other"];
			$filtersql .= " AND " . $jieqiFilter["article"]["other"][$filterary["other"]]["limit"];
		}
		else {
			unset($_GET["other"]);
		}
	}

	$otherrows = array();
	$otherrows[0]["name"] = $jieqiLang["article"]["article_filter_unlimit"];
	$varary = $_GET;

	if (isset($varary["other"])) {
		unset($varary["other"]);
	}

	$otherrows[0]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$otherrows[0]["selected"] = (isset($filterary["other"]) ? 0 : 1);
	$i = 1;

	foreach ($jieqiFilter["article"]["other"] as $k => $v ) {
		$otherrows[$i]["name"] = $v["caption"];
		$varary["other"] = $k;
		$otherrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
		$otherrows[$i]["selected"] = (isset($filterary["other"]) && ($filterary["other"] == $k) ? 1 : 0);
        $otherrows[$i]["id"] = $k;
            $i++;
	}

	$jieqiTpl->assign_by_ref("otherrows", $otherrows);
}

if (!isset($jieqiConfigs["article"]["topcachenum"])) {
	$jieqiConfigs["article"]["topcachenum"] = $jieqiConfigs["article"]["cachenum"];
}

$content_used_cache = false;
$content_allow_cache = false;

if (jieqi_count($filterary) <= 3) {
	$content_allow_cache = true;
	$jieqiTset["jieqi_contents_cacheid"] = $_REQUEST["page"];

	foreach ($filterary as $k => $v ) {
		$jieqiTset["jieqi_contents_cacheid"] .= "_" . $k . "=" . $v;
	}

	$jieqiTset["jieqi_contents_cacheid"] = md5($jieqiTset["jieqi_contents_cacheid"]);
}

if (JIEQI_USE_CACHE && $content_allow_cache && ($_REQUEST["page"] <= $jieqiConfigs["article"]["topcachenum"])) {
	$jieqiTpl->setCaching(1);
	$jieqiTpl->setCachType(0);

	if ($jieqiTpl->getCacheTime() < 7200) {
		$jieqiTpl->setCacheTime(7200);
	}

	if ($jieqiTpl->is_cached($jieqiTset["jieqi_contents_template"], $jieqiTset["jieqi_contents_cacheid"], NULL, NULL, NULL, false)) {
		if (in_array($_GET["order"], array("lastupdate", "postdate"))) {
			$uptime = jieqi_article_getuptime();
			$cachedtime = $jieqiTpl->get_cachedtime($jieqiTset["jieqi_contents_template"], $jieqiTset["jieqi_contents_cacheid"]);
			if (($uptime < $cachedtime) || ((JIEQI_NOW_TIME - $cachedtime) < 15)) {
				$content_used_cache = true;
			}
			else {
				$jieqiTpl->setCaching(2);
			}
		}
		else {
			$content_used_cache = true;
		}
	}
}
else {
	$jieqiTpl->setCaching(0);
}

if (!$content_used_cache) {
	$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
	$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	include_once jieqi_path_inc("class/article.php", "article");
	$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");

	if (!empty($jieqiFilter["article"]["order"][$filterary["order"]]["limit"])) {
		$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
		$daystart = mktime(0, 0, 0, (int) $tmpvar[1], (int) $tmpvar[2], (int) $tmpvar[0]);
		$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
		$monthdays = date("t", $monthstart);
		$prestart = mktime(0, 0, 0, (int) $tmpvar[1] - 1, 1, (int) $tmpvar[0]);
		$predays = date("t", $prestart);
		$tmpvar = date("w", JIEQI_NOW_TIME);

		if ($tmpvar == 0) {
			$tmpvar = 7;
		}

		$weekstart = $daystart;

		if (1 < $tmpvar) {
			$weekstart -= ($tmpvar - 1) * 86400;
		}

		$repfrom = array("<{\$daystart}>", "<{\$weekstart}>", "<{\$monthstart}>", "<{\$prestart}>", "<{\$monthdays}>", "<{\$predays}>");
		$repto = array($daystart, $weekstart, $monthstart, $prestart, $monthdays, $predays);
		$filtersql .= " AND " . str_replace($repfrom, $repto, $jieqiFilter["article"]["order"][$filterary["order"]]["limit"]);
	}

	if (!empty($jieqiFilter["article"]["order"][$filterary["order"]]["isvip"])) {
		$cotsql = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("obook_obook") . " o LEFT JOIN " . jieqi_dbprefix("article_article") . " a ON o.articleid = a.articleid" . jieqi_article_joinobook_replace($filtersql);
		$filtersql .= " ORDER BY " . $jieqiFilter["article"]["order"][$filterary["order"]]["order"];
		$filtersql = jieqi_article_joinobook_replace($filtersql);
		$filtersql .= " LIMIT " . intval($jieqiPset["start"]) . ", " . intval($jieqiPset["rows"]);
		$filtersql = "SELECT *, " . jieqi_article_joinobook_replace($jieqiFilter["article"]["order"][$filterary["order"]]["sort"]) . " AS ordervalue FROM " . jieqi_dbprefix("obook_obook") . " o LEFT JOIN " . jieqi_dbprefix("article_article") . " a ON o.articleid = a.articleid" . $filtersql;
	}
	else {
		$cotsql = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("article_article") . $filtersql;
		$filtersql .= " ORDER BY " . $jieqiFilter["article"]["order"][$filterary["order"]]["order"];
		$filtersql .= " LIMIT " . intval($jieqiPset["start"]) . ", " . intval($jieqiPset["rows"]);
		$filtersql = "SELECT *, " . $jieqiFilter["article"]["order"][$filterary["order"]]["sort"] . " AS ordervalue FROM " . jieqi_dbprefix("article_article") . $filtersql;
	}

	$article_handler->execute($filtersql);
	// var_dump($article_handler->execute($filtersql));die();
	$articlerows = array();
    $data = array();
	$k = 0;

	while ($v = $article_handler->getObject()) {
		$articlerows[$k] = jieqi_article_vars($v);

		if (is_numeric($articlerows[$k]["ordervalue"])) {
			$articlerows[$k]["ordervalue"] = round($articlerows[$k]["ordervalue"]);
		}

		$sizeary = array("size", "freesize", "vipsize", "monthsize", "presize", "weeksize", "daysize");

		if (in_array($orderfield, $sizeary)) {
			$articlerows[$k]["ordervalue_n"] = $articlerows[$k]["ordervalue"];
			$articlerows[$k]["ordervalue"] = jieqi_sizeformat($articlerows[$k]["ordervalue"], "c");
			$articlerows[$k]["ordertype"] = "size";
		}
		else {
			if (($orderfield == "lastupdate") || ($orderfield == "postdate") || ($orderfield == "toptime")) {
				$articlerows[$k]["ordervalue_n"] = $articlerows[$k]["ordervalue"];
				$articlerows[$k]["ordervalue"] = date("Y-m-d", $articlerows[$k]["ordervalue"]);
				$articlerows[$k]["ordertype"] = "date";
			}
			else {
				$articlerows[$k]["ordertype"] = "int";
			}
		}

        $data[] = array("articlename"=>$articlerows[$k]["articlename"],"url_articleinfo"=>$articlerows[$k]["url_articleinfo"],"articleid"=>$articlerows[$k]["articleid"],"intro"=>$articlerows[$k]["intro"],"sortid"=>$articlerows[$k]["sortid"],"url_sort"=>jieqi_geturl("article", "articlelist", 1, $articlerows[$k]["sortid"], 0),"allvisit"=>$articlerows[$k]["allvisit"],"author"=>$articlerows[$k]["author"],"url_author"=>$articlerows[$k]["url_author"],"url_image"=>$articlerows[$k]["url_image"],"sort"=>$articlerows[$k]["sort"],"fullflag"=>$articlerows[$k]["fullflag"],"size_c"=>$articlerows[$k]["size_c"],"lastupdate"=>date("Y-m-d H:i:s", $articlerows[$k]["lastupdate"]),"url_lastchapter"=>$articlerows[$k]["url_lastchapter"],"lastchapter"=>$articlerows[$k]["lastchapter"],"allvote"=>$articlerows[$k]["allvote"]);

		$k++;
	}

	$jieqiTpl->assign_by_ref("articlerows", $articlerows);
	include_once jieqi_path_lib("html/page.php");

	if (JIEQI_USE_CACHE) {
		$pagecacheid = $jieqiTset["jieqi_contents_cacheid"];
		jieqi_getcachevars("article", "articlefilterlog");

		if (!is_array($jieqiArticlefilterlog)) {
			$jieqiArticlefilterlog = array();
		}

		$upfilterlog = false;
		if (!isset($jieqiArticlefilterlog[$pagecacheid]) || (JIEQI_CACHE_LIFETIME < (JIEQI_NOW_TIME - $jieqiArticlefilterlog[$pagecacheid]["time"]))) {
			$article_handler->execute($cotsql);
			$row = $article_handler->getRow();
			$jieqiArticlefilterlog[$pagecacheid] = array("rows" => intval($row["cot"]), "time" => JIEQI_NOW_TIME);
			$upfilterlog = true;
		}

		if (rand(1, 1000) == 1000) {
			foreach ($jieqiArticlefilterlog as $k => $v ) {
				if (JIEQI_CACHE_LIFETIME < (JIEQI_NOW_TIME - $jieqiArticlefilterlog[$k]["time"])) {
					unset($jieqiArticlefilterlog[$k]);
					$jieqiTpl->clear_cache($jieqiTset["jieqi_contents_template"], $k, NULL);
					$upfilterlog = true;
				}
			}
		}

		if ($upfilterlog) {
			jieqi_setcachevars("articlefilterlog", "jieqiArticlefilterlog", $jieqiArticlefilterlog, "article");
		}

		$toplistrows = $jieqiArticlefilterlog[$pagecacheid]["rows"];
	}
	else {
		$article_handler->execute($cotsql);
		$row = $article_handler->getRow();
		$toplistrows = intval($row["cot"]);
	}

	$jieqiPset["count"] = $toplistrows;
	$jumppage = new JieqiPage($jieqiPset);
	$jumppage->setlink(jieqi_geturl("article", "articlefilter", 0, $filterary));
	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
}

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    //echo json_encode(array("success" => true, "data" => array("list" => $articlerows, "totalpage" => $jumppage->totalpages), "message" => '????????????'));
    echo json_encode(array_merge($jumppage->whole_bar(), array("data"=>$data)));
    return false;

}
elseif (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR){
    echo json_encode(array("pageNo"=>$jumppage->current,"totalPage"=>$jumppage->totalpages, "bookList"=>array("totalCount"=>$jieqiPset["count"],"items"=>$articlerows)));
    return false;
}

$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_common("footer.php");

?>
