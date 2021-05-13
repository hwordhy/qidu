<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once jieqi_path_inc("class/articlelog.php", "article");
$articlelog_handler = JieqiArticlelogHandler::getInstance("JieqiArticlelogHandler");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/articlelog.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$criteria = new CriteriaCompo();

if (!empty($_REQUEST["keyword"])) {
	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("articlename", $_REQUEST["keyword"], "="));
	}
	else {
		$criteria->add(new Criteria("username", $_REQUEST["keyword"], "="));
	}
}

$criteria->setSort("logid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$articlelog_handler->queryObjects($criteria);
$logrows = array();
$k = 0;

while ($v = $articlelog_handler->getObject()) {
	$logrows[$k] = jieqi_query_rowvars($v);
	$k++;
}

$jieqiTpl->assign_by_ref("logrows", $logrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $articlelog_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink("", true, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
