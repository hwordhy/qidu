<?php

define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

if (empty($_REQUEST["tagid"]) && (!isset($_REQUEST["tag"]) || (strlen($_REQUEST["tag"]) == 0))) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["tag"] = (isset($_REQUEST["tag"]) ? trim($_REQUEST["tag"]) : "");
$_REQUEST["tagid"] = (empty($_REQUEST["tagid"]) ? 0 : intval($_REQUEST["tagid"]));
if ((0 < strlen($_REQUEST["tag"])) && isset($_REQUEST["encode"]) && ($jieqi_charset_map[$_REQUEST["encode"]] == "utf8") && ($jieqi_charset_map[JIEQI_CHAR_SET] != "utf8")) {
	include_once jieqi_path_inc("include/changecode.php", "system");
	$charset_convert_ajax = "jieqi_" . $jieqi_charset_map["utf8"] . "2" . $jieqi_charset_map[JIEQI_CHAR_SET];
	$_REQUEST["tag"] = &jieqi_funtoarray($charset_convert_ajax, $_REQUEST["tag"]);
}

jieqi_loadlang("tag", JIEQI_MODULE_NAME);
jieqi_getconfigs("article", "configs");
jieqi_getconfigs("article", "sort");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

if (0 < strlen($_REQUEST["tag"])) {
	$sql = "SELECT * FROM " . jieqi_dbprefix("article_tag") . " WHERE tagname = '" . jieqi_dbslashes($_REQUEST["tag"]) . "' LIMIT 0,1";
}
else {
	$sql = "SELECT * FROM " . jieqi_dbprefix("article_tag") . " WHERE tagid = " . $_REQUEST["tagid"] . " LIMIT 0,1";
}

$query->execute($sql);
$tagrow = $query->getRow();

if (!$tagrow) {
	jieqi_printfail($jieqiLang["article"]["tag_not_exists"]);
}
else {
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("tagarticle.html", "article");
	include_once jieqi_path_common("header.php");
	$jieqiPset = jieqi_get_pageset();
	$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
	$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);

	foreach ($tagrow as $k => $v ) {
		$jieqiTpl->assign($k, jieqi_htmlstr($v));
	}

	$_REQUEST["tagid"] = intval($tagrow["tagid"]);
	$_REQUEST["tag"] = $tagrow["tagname"];
	$sql = jieqi_dbprefix("article_taglink") . " l RIGHT JOIN " . jieqi_dbprefix("article_article") . " a ON l.articleid = a.articleid WHERE l.tagid = " . $_REQUEST["tagid"];
	$sqlcot = "SELECT count(*) AS cot FROM " . $sql;
	$query->execute($sqlcot);
	$rowcot = $query->getRow();
	$articlecount = intval($rowcot["cot"]);
	$sql = "SELECT * FROM " . $sql . " ORDER BY a.lastupdate DESC LIMIT " . intval($jieqiPset["start"]) . ", " . intval($jieqiPset["rows"]);
	$query->execute($sql);
	include_once jieqi_path_inc("include/funarticle.php", "article");
	$articlerows = array();
	$k = 0;

	while ($v = $query->getObject()) {
		$articlerows[$k] = jieqi_article_vars($v);
		$k++;
	}

	$jieqiTpl->assign_by_ref("articlerows", $articlerows);
	include_once jieqi_path_lib("html/page.php");
	$jieqiPset["count"] = $articlecount;
	$jumppage = new JieqiPage($jieqiPset);
	$jumppage->setlink(jieqi_geturl("article", "tagarticle", 0, $_REQUEST["tag"], $_REQUEST["tagid"]));
	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
	include_once jieqi_path_inc("tagvisit.php", "article");
	$jieqiTpl->setCaching(0);
	include_once jieqi_path_common("footer.php");
}

?>
