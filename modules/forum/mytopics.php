<?php

define("JIEQI_MODULE_NAME", "forum");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("mytopics.html", "forum");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
include_once jieqi_path_lib("text/textfunction.php");
$criteria = new CriteriaCompo();
$criteria->setFields("t.*, f.forumid, f.forumname");
$criteria->setTables(jieqi_dbprefix("forum_forumtopics") . " AS t LEFT JOIN " . jieqi_dbprefix("forum_forums") . " AS f ON t.ownerid = f.forumid");
$criteria->add(new Criteria("t.posterid", intval($_SESSION["jieqiUserId"]), "="));
if (isset($_REQUEST["display"]) && is_numeric($_REQUEST["display"])) {
	$criteria->add(new Criteria("t.display", intval($_REQUEST["display"])));
	$jieqiTpl->assign("display", intval($_REQUEST["display"]));
}
else {
	$jieqiTpl->assign("display", "");
}

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 2) {
		$criteria->add(new Criteria("t.title", "%" . $_REQUEST["keyword"] . "%", "LIKE"));
	}
	else {
		$criteria->add(new Criteria("u.name", $_REQUEST["keyword"], "="));
	}
}

if (isset($_REQUEST["type"]) && ($_REQUEST["type"] == "good")) {
	$jieqiTpl->assign("type", "good");
	$criteria->add(new Criteria("t.isgood", 1));
}
else {
	$_REQUEST["type"] = "all";
	$jieqiTpl->assign("type", "all");
}

include_once jieqi_path_inc("include/funpost.php", "system");
$criteria->setSort("t.topicid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$query->queryObjects($criteria);
$topicrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$topicrows[$k] = jieqi_topic_vars($v);
	$topicrows[$k]["ownername"] = (strlen($v->getVar("name")) == 0 ? $v->getVar("uname") : $v->getVar("name"));
	$k++;
}

$jieqiTpl->assign_by_ref("topicrows", $topicrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
