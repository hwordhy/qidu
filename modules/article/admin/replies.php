<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallreview"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs("article", "action", "jieqiAction");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

if (isset($_POST["act"])) {
	jieqi_checkpost();
	$actionids = array();

	if (!empty($_REQUEST["pid"])) {
		$actionids[] = intval($_REQUEST["pid"]);
	}
	else {
		if (!empty($_REQUEST["checkid"]) && is_array($_REQUEST["checkid"])) {
			foreach ($_REQUEST["checkid"] as $v ) {
				if (is_numeric($v)) {
					$actionids[] = intval($v);
				}
			}
		}
	}

	if (!empty($actionids)) {
		if (jieqi_count($actionids) == 1) {
			$where = "postid = " . $actionids[0];
		}
		else {
			$where = "postid IN (" . implode(", ", $actionids) . ")";
		}

		$sql = "SELECT topicid FROM " . jieqi_dbprefix("article_replies") . " WHERE " . $where . " AND istopic = 1";
		$query->execute($sql);
		$topicids = array();

		while ($row = $query->getRow()) {
			$topicids[] = intval($row["topicid"]);
		}

		switch ($_POST["act"]) {
		case "audit":
			if (!empty($topicids)) {
				$query->execute("UPDATE " . jieqi_dbprefix("article_reviews") . " SET display = 0 WHERE topicid IN (" . implode(", ", $topicids) . ")");
			}

			$query->execute("UPDATE " . jieqi_dbprefix("article_replies") . " SET display = 0 WHERE " . $where);

			if (!empty($_REQUEST["ajax_request"])) {
				jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
			}

			break;

		case "delete":
			if (!empty($topicids)) {
				$query->execute("DELETE FROM " . jieqi_dbprefix("article_reviews") . " WHERE topicid IN (" . implode(", ", $topicids) . ")");
			}

			$query->execute("DELETE FROM " . jieqi_dbprefix("article_replies") . " WHERE " . $where);
			jieqi_jumppage($jieqiModules["article"]["url"] . "/admin/replies.php?display=" . urlencode($_REQUEST["display"]), "", "", true);
			break;
		}
	}
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/replies.html", "article");
include_once jieqi_path_common("admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
include_once jieqi_path_lib("text/textfunction.php");
$criteria = new CriteriaCompo();
$criteria->setTables(jieqi_dbprefix("article_reviews") . " t RIGHT JOIN " . jieqi_dbprefix("article_replies") . " p ON t.topicid=p.topicid");
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
$replyrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$replyrows[$k] = jieqi_query_rowvars($v);
	$k++;
}

$jieqiTpl->assign_by_ref("replyrows", $replyrows);
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
