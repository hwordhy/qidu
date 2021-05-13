<?php

define("JIEQI_MODULE_NAME", "forum");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("myposts.html", "forum");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
include_once jieqi_path_lib("text/textfunction.php");
include_once jieqi_path_inc("include/funpost.php", "system");
$criteria = new CriteriaCompo();
$criteria->setTables(jieqi_dbprefix("forum_forumtopics") . " t RIGHT JOIN " . jieqi_dbprefix("forum_forumposts") . " p ON t.topicid=p.topicid");
$criteria->add(new Criteria("p.posterid", intval($_SESSION["jieqiUserId"]), "="));
if (isset($_REQUEST["display"]) && is_numeric($_REQUEST["display"])) {
	$criteria->add(new Criteria("p.display", intval($_REQUEST["display"])));
	$jieqiTpl->assign("display", intval($_REQUEST["display"]));
}
else {
	$jieqiTpl->assign("display", "");
}

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("p.poster", $_REQUEST["keyword"], "="));
	}
}

$criteria->setSort("p.postid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$query->queryObjects($criteria);
$postrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$addvars = array("order" => (($jieqiPset["page"] - 1) * $jieqiPset["rows"]) + $k + 1);
	$postrows[$k] = jieqi_post_vars($v, $jieqiConfigs["forum"], $addvars, true);
	$k++;
}

$jieqiTpl->assign_by_ref("postrows", $postrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
