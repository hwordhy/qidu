<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("article", "power");
jieqi_checkpower($jieqiPower["article"]["newdraft"], $jieqiUsersStatus, $jieqiUsersGroup, false);
jieqi_getconfigs("article", "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("draft.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
include_once jieqi_path_inc("class/draft.php", "article");
$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");

if (!empty($_REQUEST["delid"])) {
	$_REQUEST["delid"] = intval($_REQUEST["delid"]);
	$draft = $draft_handler->get($_REQUEST["delid"]);
	if (is_object($draft) && ($draft->getVar("posterid", "n") == $_SESSION["jieqiUserId"])) {
		$draft_handler->delete($_REQUEST["delid"]);
		$tmpattachary = @jieqi_unserialize($draft->getVar("attachment", "n"));
		if (is_array($tmpattachary) && (0 < jieqi_count($tmpattachary))) {
			include_once jieqi_path_inc("class/articleattachs.php", "article");
			$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
			$criteria = new CriteriaCompo(new Criteria("chapterid", -$_REQUEST["delid"]));
			$attachs_handler->delete($criteria);
			$attach_dir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($draft->getVar("articleid", "n")) . "/" . $draft->getVar("articleid", "n") . "/0" . $draft->getVar("draftid", "n");

			if (is_dir($attach_dir)) {
				jieqi_delfolder($attach_dir, true);
			}
		}
	}
}

$criteria = new CriteriaCompo(new Criteria("posterid", $_SESSION["jieqiUserId"]));

switch ($_REQUEST["type"]) {
case 1:
	$criteria->add(new Criteria("display", 0));
	$criteria->add(new Criteria("ispub", 0));
	$criteria->setSort("draftid");
	$criteria->setOrder("DESC");
	break;

case 2:
	$criteria->add(new Criteria("ispub", 1));
	$criteria->setSort("draftid");
	$criteria->setOrder("ASC");
	break;

case 3:
	$criteria->add(new Criteria("display", 1));
	$criteria->setSort("draftid");
	$criteria->setOrder("DESC");
	break;

default:
	$criteria->setSort("draftid");
	$criteria->setOrder("DESC");
	break;
}

$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$draft_handler->queryObjects($criteria);
$draftrows = array();
$k = 0;

while ($v = $draft_handler->getObject()) {
	$draftrows[$k] = jieqi_query_rowvars($v);
	$draftrows[$k]["url_delete"] = jieqi_addurlvars(array("delid" => $v->getVar("draftid")));
	$k++;
}

$jieqiTpl->assign_by_ref("draftrows", $draftrows);
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $draft_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->assign("authorarea", 1);
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
