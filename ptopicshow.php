<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
if (empty($_REQUEST["tid"]) || !is_numeric($_REQUEST["tid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

if (!empty($_POST["act"])) {
	jieqi_checkpost();
}

jieqi_loadlang("parlar", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/users.php", "system");
$post_query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$criteria = new CriteriaCompo(new Criteria("t.topicid", $_REQUEST["tid"]));
$criteria->setTables(jieqi_dbprefix("system_ptopics") . " t LEFT JOIN " . jieqi_dbprefix("system_users") . " u ON t.ownerid=u.uid");
$post_query->queryObjects($criteria);
$ptopic = $post_query->getObject();
unset($criteria);

if (!$ptopic) {
	jieqi_printfail($jieqiLang["system"]["ptopic_not_exists"]);
}

$ownerid = $ptopic->getVar("ownerid", "n");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$ismanager = jieqi_checkpower($jieqiPower["system"]["manageallparlor"], $jieqiUsersStatus, $jieqiUsersGroup, true);

if ($ptopic->getVar("display", "n") != 0) {
	if (!$ismanager) {
		if ($ptopic->getVar("display", "n") == 1) {
			jieqi_printfail($jieqiLang["system"]["ptopic_not_audit"]);
		}
		else {
			jieqi_printfail($jieqiLang["system"]["ptopic_not_exists"]);
		}
	}
}

if (jieqi_checkpower($jieqiPower["system"]["parlorpost"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
	$enablepost = 1;
}
else {
	$enablepost = 0;
}

jieqi_getconfigs("system", "action", "jieqiAction");

if ($_POST["act"] == "newpost") {
	if (empty($_POST["pcontent"])) {
		jieqi_printfail($jieqiLang["system"]["ppost_need_pcontent"]);
	}

	if (!$enablepost) {
		jieqi_printfail($jieqiLang["system"]["parlor_noper_post"]);
	}

	if (!empty($jieqiAction["system"]["ptopic"]["minscore"]) && ($_SESSION["jieqiUserScore"] < intval($jieqiAction["system"]["ptopic"]["minscore"]))) {
		jieqi_printfail(sprintf($jieqiLang["system"]["ptopic_score_limit"], intval($jieqiAction["system"]["ptopic"]["minscore"])));
	}
}

include_once jieqi_path_inc("include/funpost.php", JIEQI_MODULE_NAME);
$addnewreply = 0;

if ($_POST["act"] == "newpost") {
	$check_errors = array();
	$post_set = array("module" => JIEQI_MODULE_NAME, "ownerid" => intval($ownerid), "topicid" => intval($_REQUEST["tid"]), "postid" => 0, "posttime" => JIEQI_NOW_TIME, "topictitle" => &$_POST["ptitle"], "posttext" => &$_POST["pcontent"], "attachment" => "", "isnew" => true, "istopic" => 0, "istop" => 0, "sname" => "jieqiSystemParlorTime", "attachfile" => "", "oldattach" => "", "checkcode" => $_POST["checkcode"]);
	jieqi_post_checkvar($post_set, $jieqiConfigs["system"], $check_errors);

	if (empty($check_errors)) {
		include_once jieqi_path_inc("class/pposts.php", JIEQI_MODULE_NAME);
		$pposts_handler = &JieqiPpostsHandler::getInstance("JieqiPpostsHandler");
		$newPost = $pposts_handler->create();
		jieqi_post_newset($post_set, $newPost);
		$pposts_handler->insert($newPost);
		$postdisplay = intval($newPost->getVar("display", "n"));
		$postresult = (0 < $postdisplay ? $jieqiLang["system"]["ppost_post_needaudit"] : $jieqiLang["system"]["ppost_post_success"]);
		$addnewreply = 1;
		$_REQUEST["page"] = "last";
		include_once jieqi_path_inc("include/funaction.php", JIEQI_MODULE_NAME);
		$actions = array("actname" => "ptopic", "actnum" => 1);
		jieqi_system_actiondo($actions, $_SESSION["jieqiUserId"]);

		if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, $postresult);
		}
	}
	else {
		jieqi_printfail(implode("<br />", $check_errors));
	}
}

$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	if (!empty($_SESSION["jieqiUserId"]) && ($_SESSION["jieqiUserId"] == $ownerid)) {
		$canedit = true;
	}
}

if (isset($_POST["act"]) && ($_POST["act"] == "del") && !empty($_REQUEST["pid"])) {
	$_REQUEST["pid"] = intval($_REQUEST["pid"]);
	include_once jieqi_path_inc("class/pposts.php", JIEQI_MODULE_NAME);
	$pposts_handler = &JieqiPpostsHandler::getInstance("JieqiPpostsHandler");
	$ppost = $pposts_handler->get($_REQUEST["pid"]);

	if (!$ppost) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	if ($ppost->getVar("topicid", "n") != $ptopic->getVar("topicid", "n")) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	if (!$canedit && (empty($_SESSION["jieqiUserId"]) || ($_SESSION["jieqiUserId"] != $ppost->getVar("posterid", "n")))) {
		jieqi_printfail(LANG_NO_PERMISSION);
	}

	if (!empty($jieqiAction["system"]["ptopic"]["earnscore"])) {
		$ppostobj = $pposts_handler->get(intval($_REQUEST["pid"]));

		if (is_object($ppostobj)) {
			include_once jieqi_path_inc("class/users.php", "system");
			$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
			$users_handler->changeScore(intval($ppostobj->getVar("posterid", "n")), $jieqiAction["system"]["ptopic"]["earnscore"], false);
		}
	}

	$pposts_handler->delete(intval($_REQUEST["pid"]));
	$post_query->execute("UPDATE " . jieqi_dbprefix("system_ptopics") . " SET replies = replies - 1 WHERE topicid = " . $_REQUEST["tid"]);
	jieqi_jumppage(JIEQI_URL . "/ptopicshow.php?tid=" . urlencode($_REQUEST["tid"]), "", "", true);
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("ptopicshow.html", JIEQI_MODULE_NAME);
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("tid", $_REQUEST["tid"]);
$jieqiTpl->assign("ownerid", $ptopic->getVar("ownerid"));
$jieqiTpl->assign("owneruname", $ptopic->getVar("uname"));
$ownername = (strlen($ptopic->getVar("name")) == 0 ? $ptopic->getVar("uname") : $ptopic->getVar("name"));
$jieqiTpl->assign("ownername", $ownername);
$jieqiTpl->assign("topicid", $ptopic->getVar("topicid"));
$jieqiTpl->assign("title", $ptopic->getVar("title"));

if ($_POST["act"] == "newpost") {
	$jieqiTpl->assign("newpost", 1);
	$jieqiTpl->assign("postdisplay", $postdisplay);
	$jieqiTpl->assign("postresult", $postresult);
}
else {
	$jieqiTpl->assign("newpost", 0);
}

$jieqiTpl->assign("canedit", intval($canedit));
$jieqiTpl->assign("ismaster", intval($canedit));
$jieqiTpl->assign("ismanager", intval($ismanager));
jieqi_getconfigs("system", "honors");

if (!isset($jieqiConfigs["system"])) {
	jieqi_getconfigs("system", "configs");
}

if (!empty($jieqiModules["badge"]["publish"]) && is_file(jieqi_path_inc("include/badgefunction.php","badge"))) {
	include_once jieqi_path_inc("include/badgefunction.php","badge");
	$jieqi_use_badge = 1;
	$jieqiTpl->assign("jieqi_use_badge", 1);
}
else {
	$jieqi_use_badge = 0;
	$jieqiTpl->assign("jieqi_use_badge", 0);
}

$criteria = new CriteriaCompo(new Criteria("p.topicid", $_REQUEST["tid"]));
$criteria->add(new Criteria("p.display", 0));
$criteria->setTables(jieqi_dbprefix("system_pposts") . " p LEFT JOIN " . jieqi_dbprefix("system_users") . " u ON p.posterid=u.uid");
$criteria->setSort("p.postid");
$criteria->setOrder("ASC");
$criteria->setLimit($jieqiPset["rows"]);
$jieqiPset["count"] = $post_query->getCount($criteria);

if ($_REQUEST["page"] == "last") {
	$_REQUEST["page"] = ceil($jieqiPset["count"] / $jieqiPset["rows"]);
	$jieqiPset["page"] = $_REQUEST["page"];
	$jieqiPset["start"] = ($jieqiPset["page"] - 1) * $jieqiPset["rows"];
}

$criteria->setStart($jieqiPset["start"]);
$post_query->queryObjects($criteria);
$ppostrows = array();
$k = 0;

while ($ppost = $post_query->getObject()) {
	$addvars = array("order" => (($jieqiPset["page"] - 1) * $jieqiPset["rows"]) + $k + 1);
	$ppostrows[$k] = jieqi_post_vars($ppost, $jieqiConfigs["system"], $addvars, true);
	$k++;
}

$jieqiTpl->assign_by_ref("ppostrows", $ppostrows);
$jieqiTpl->assign("enablepost", $enablepost);

if (!isset($jieqiConfigs["system"])) {
	jieqi_getconfigs("system", "configs");
}

$jieqiTpl->assign("postcheckcode", $jieqiConfigs["system"]["postcheckcode"]);
include_once jieqi_path_lib("html/page.php");
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());

if (0 < $addnewreply) {
	$lastinfo = serialize(array("time" => JIEQI_NOW_TIME, "uid" => intval($_SESSION["jieqiUserId"]), "uname" => strval($_SESSION["jieqiUserName"])));
	$post_query->execute("UPDATE " . jieqi_dbprefix("system_ptopics") . " SET views = views + 1, replies = replies + 1, replytime = " . JIEQI_NOW_TIME . ", lastinfo = '" . jieqi_dbslashes($lastinfo) . "' WHERE topicid = " . $_REQUEST["tid"]);
}
else if ($addnewreply < 0) {
	$post_query->execute("UPDATE " . jieqi_dbprefix("system_ptopics") . " SET views = views + 1, replies = replies - 1 WHERE topicid = " . $_REQUEST["tid"]);
}
else {
	include_once jieqi_path_inc("include/funstat.php", JIEQI_MODULE_NAME);
	jieqi_visit_stat($_REQUEST["tid"], jieqi_dbprefix("system_ptopics"), "views", "topicid", $post_query);
}

$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
