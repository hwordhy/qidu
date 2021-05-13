<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
if (!isset($_REQUEST["tid"]) && isset($_REQUEST["rid"])) {
	$_REQUEST["tid"] = $_REQUEST["rid"];
}

if (empty($_REQUEST["tid"]) || !is_numeric($_REQUEST["tid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

if (!empty($_POST["act"])) {
	jieqi_checkpost();
}

jieqi_loadlang("review", JIEQI_MODULE_NAME);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$criteria = new CriteriaCompo(new Criteria("r.topicid", $_REQUEST["tid"]));
$criteria->setTables(jieqi_dbprefix("article_reviews") . " r LEFT JOIN " . jieqi_dbprefix("article_article") . " a ON r.ownerid=a.articleid");
$query->queryObjects($criteria);
$topic = $query->getObject();
unset($criteria);

if (!$topic) {
	jieqi_printfail($jieqiLang["article"]["review_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallreview"], $jieqiUsersStatus, $jieqiUsersGroup, true);

if ($topic->getVar("display", "n") != 0) {
	if (!$ismanager) {
		if ($topic->getVar("display", "n") == 1) {
			jieqi_printfail($jieqiLang["article"]["review_not_audit"]);
		}
		else {
			jieqi_printfail($jieqiLang["article"]["review_not_exists"]);
		}
	}
}

$ownerid = $topic->getVar("ownerid", "n");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs("article", "action", "jieqiAction");

if (jieqi_checkpower($jieqiPower["article"]["newreview"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
	$enablepost = 1;
}
else {
	$enablepost = 0;
}

if ($_POST["act"] == "newpost") {
	if (empty($_POST["pcontent"])) {
		jieqi_printfail($jieqiLang["article"]["review_need_pcontent"]);
	}

	if (!$enablepost) {
		jieqi_printfail($jieqiLang["article"]["review_noper_post"]);
	}

	if (!empty($jieqiAction["article"]["reviewadd"]["minscore"]) && ($_SESSION["jieqiUserScore"] < intval($jieqiAction["article"]["reviewadd"]["minscore"]))) {
		jieqi_printfail(sprintf($jieqiLang["article"]["review_score_limit"], intval($jieqiAction["article"]["reviewadd"]["minscore"])));
	}
}

include_once jieqi_path_inc("include/funpost.php", "system");
$addnewreply = 0;

if ($_POST["act"] == "newpost") {
	$check_errors = array();
	$post_set = array("module" => JIEQI_MODULE_NAME, "ownerid" => intval($ownerid), "topicid" => intval($_REQUEST["tid"]), "postid" => 0, "posttime" => JIEQI_NOW_TIME, "topictitle" => &$_POST["ptitle"], "posttext" => &$_POST["pcontent"], "attachment" => "", "isnew" => true, "istopic" => 0, "istop" => 0, "sname" => "jieqiArticleReviewTime", "attachfile" => "", "oldattach" => "", "checkcode" => $_POST["checkcode"]);
	jieqi_post_checkvar($post_set, $jieqiConfigs["article"], $check_errors);

	if (empty($check_errors)) {
		include_once jieqi_path_inc("class/replies.php", "article");
		$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
		$newReply = $replies_handler->create();
		jieqi_post_newset($post_set, $newReply);
		$replies_handler->insert($newReply);
		$postdisplay = intval($newReply->getVar("display", "n"));
		$postresult = (0 < $postdisplay ? $jieqiLang["article"]["review_post_needaudit"] : $jieqiLang["article"]["review_post_success"]);
		$addnewreply = 1;
		$_REQUEST["page"] = "last";
		$taskmodule = "article";
		$taskname = "replyadd";
		jieqi_getconfigs("system", "tasks", "jieqiTasks");
		if (!empty($jieqiTasks[$taskmodule][$taskname]["score"]) && empty($_SESSION["jieqiUserSet"]["tasks"][$taskmodule][$taskname])) {
			include_once jieqi_path_inc("class/users.php", "system");
			$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
			$jieqiUsers = $users_handler->get($_SESSION["jieqiUserId"]);
			$userset = jieqi_unserialize($jieqiUsers->getVar("setting", "n"));
			$userset["tasks"][$taskmodule][$taskname] = 1;
			$jieqiUsers->setVar("setting", serialize($userset));
			$jieqiUsers->setVar("score", intval($jieqiUsers->getVar("score", "n")) + intval($jieqiTasks[$taskmodule][$taskname]["score"]));
			$jieqiUsers->saveToSession();
			$users_handler->insert($jieqiUsers);
		}

        if (0 < $addnewreply) {
            $lastinfo = serialize(array("time" => JIEQI_NOW_TIME, "uid" => intval($_SESSION["jieqiUserId"]), "uname" => strval($_SESSION["jieqiUserName"])));
            $query->execute("UPDATE " . jieqi_dbprefix("article_reviews") . " SET views=views+1,replies=replies+1,replierid=" . intval($_SESSION["jieqiUserId"]) . ",replier='" . jieqi_dbslashes(strval($_SESSION["jieqiUserName"])) . "',replytime=" . JIEQI_NOW_TIME . ",lastinfo='" . jieqi_dbslashes($lastinfo) . "' WHERE topicid=" . $_REQUEST["tid"]);
        }
        else if ($addnewreply < 0) {
            $query->execute("UPDATE " . jieqi_dbprefix("article_reviews") . " SET views=views+1,replies=replies-1 WHERE topicid=" . $_REQUEST["tid"]);
        }
        else {
            include_once jieqi_path_inc("include/funstat.php", "system");
            jieqi_visit_stat($_REQUEST["tid"], jieqi_dbprefix("article_reviews"), "views", "topicid", $query);
        }

		include_once jieqi_path_inc("include/funaction.php", "article");
		$actions = array("actname" => "replyadd", "actnum" => 1);
		jieqi_article_actiondo($actions, $article);

		if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
			$newsre = array("posterid" => $newReply->getVar("posterid", "n"), "poster"=>$newReply->getVar("poster"), "posttext" => $newReply->getVar("posttext"), "topicid" => $newReply->getVar("topicid", "n"), "replypid" => $newReply->getVar("replypid"), "posttime" => date('Y-m-d H:i:s', $newReply->getVar("posttime")));
			jieqi_msgwin(LANG_DO_SUCCESS, $postresult, array('newreply' => $newsre));
		}
	}
	else {
		jieqi_printfail(implode("<br />", $check_errors));
	}
}

$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	if (!empty($_SESSION["jieqiUserId"]) && (($topic->getVar("authorid") == $_SESSION["jieqiUserId"]) || ($topic->getVar("posterid") == $_SESSION["jieqiUserId"]) || ($topic->getVar("agentid") == $_SESSION["jieqiUserId"]))) {
		$canedit = true;
	}
}

if (isset($_POST["act"]) && ($_POST["act"] == "del") && !empty($_REQUEST["did"])) {
	$_REQUEST["did"] = intval($_REQUEST["did"]);
	include_once jieqi_path_inc("class/replies.php", "article");
	$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
	$reply = $replies_handler->get($_REQUEST["did"]);

	if (!$reply) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	if ($reply->getVar("topicid", "n") != $topic->getVar("topicid", "n")) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	if (!$canedit && (empty($_SESSION["jieqiUserId"]) || ($_SESSION["jieqiUserId"] != $reply->getVar("posterid", "n")))) {
		jieqi_printfail(LANG_NO_PERMISSION);
	}

	if (!empty($jieqiAction["article"]["reviewadd"]["earnscore"])) {
		$replyobj = $replies_handler->get(intval($_REQUEST["did"]));

		if (is_object($replyobj)) {
			include_once jieqi_path_inc("class/users.php", "system");
			$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
			$users_handler->changeScore(intval($replyobj->getVar("posterid", "n")), $jieqiAction["article"]["reviewadd"]["earnscore"], false);
		}
	}

	$replies_handler->delete(intval($_REQUEST["did"]));
	$query->execute("UPDATE " . jieqi_dbprefix("article_reviews") . " SET replies = replies - 1 WHERE topicid = " . $_REQUEST["tid"]);
	jieqi_jumppage($jieqiModules["article"]["url"] . "/reviewshow.php?tid=" . urlencode($_REQUEST["tid"]), "", "", true);
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("reviewshow.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->assign("ownerid", $topic->getVar("ownerid"));
$jieqiTpl->assign("articleid", $topic->getVar("articleid"));
$jieqiTpl->assign("articlename", $topic->getVar("articlename"));
$jieqiTpl->assign("topicid", $topic->getVar("topicid"));
$jieqiTpl->assign("title", $topic->getVar("title"));
$jieqiTpl->assign("authorid", $topic->getVar("authorid"));
$jieqiTpl->assign("author", $topic->getVar("author"));
$jieqiTpl->assign("fullflag", $topic->getVar("fullflag"));
$jieqiTpl->assign("sortid", $topic->getVar("sortid"));
$jieqiTpl->assign("sort", isset($jieqiSort["article"][$topic->getVar("sortid")]["caption"]) ? $jieqiSort["article"][$topic->getVar("sortid")]["caption"] : "");
$jieqiTpl->assign("url_image", jieqi_geturl("article", "cover", $topic->getVar("articleid"), "s", $topic->getVar("imgflag")));
$jieqiTpl->assign("intro", htmlspecialchars(jieqi_substr($topic->getVar("intro", "n"), 0, 500)));

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
$jieqiTpl->assign("url_articleinfo", jieqi_geturl("article", "article", $topic->getVar("ownerid"), "info", $topic->getVar("articlecode", "n")));
include_once jieqi_path_inc("class/users.php", "system");
jieqi_getconfigs("system", "honors");

if (!isset($jieqiConfigs["system"])) {
	jieqi_getconfigs("system", "configs");
}

if (!empty($_SESSION["jieqiUserId"])) {
    //获取当前用户是否收藏本书
    $is_bookcase = false;
    include_once jieqi_path_inc("/class/bookcase.php", "article");
    $bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
    $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
    $criteria->add(new Criteria("articleid", $topic->getVar("articleid")));
    $bookcase_handler->queryObjects($criteria);
    $bookcase = $bookcase_handler->getObject();
    if (is_object($bookcase)) {
        $is_bookcase = true;
    }
    unset($criteria);
}
$jieqiTpl->assign("is_bookcase", $is_bookcase);

if (!empty($jieqiModules["badge"]["publish"]) && is_file(jieqi_path_inc("include/badgefunction.php", "badge"))) {
	include_once jieqi_path_inc("include/badgefunction.php", "badge");
	$jieqi_use_badge = 1;
	$jieqiTpl->assign("jieqi_use_badge", 1);
}
else {
	$jieqi_use_badge = 0;
	$jieqiTpl->assign("jieqi_use_badge", 0);
}

$criteria = new CriteriaCompo(new Criteria("r.topicid", $_REQUEST["tid"]));
$criteria->add(new Criteria("r.display", 0));
$criteria->setTables(jieqi_dbprefix("article_replies") . " r LEFT JOIN " . jieqi_dbprefix("system_users") . " u ON r.posterid=u.uid");
$criteria->setSort("r.postid");
$criteria->setOrder("ASC");
$criteria->setLimit($jieqiPset["rows"]);
$jieqiPset["count"] = $query->getCount($criteria);
if (isset($_REQUEST["page"]) && ($_REQUEST["page"] == "last")) {
	$_REQUEST["page"] = ceil($jieqiPset["count"] / $jieqiPset["rows"]);
	$jieqiPset["page"] = $_REQUEST["page"];
	$jieqiPset["start"] = ($jieqiPset["page"] - 1) * $jieqiPset["rows"];
}

$criteria->setStart($jieqiPset["start"]);
$query->queryObjects($criteria);
$replyrows = array();
$k = 0;
include_once jieqi_path_lib("text/textconvert.php");
$jieqiTxtcvt = TextConvert::getInstance("TextConvert");

while ($review = $query->getObject()) {
	$addvars = array("order" => (($jieqiPset["page"] - 1) * $jieqiPset["rows"]) + $k + 1);
	$replyrows[$k] = jieqi_post_vars($review, $jieqiConfigs["article"], $addvars, true);
    $replyrows[$k]["posttext"] = $jieqiTxtcvt->smile($replyrows[$k]["posttext"]);
    if($replyrows[$k]["posterid"] > 0){
        include_once jieqi_path_inc("class/users.php", "system");
        $users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
        $users = $users_handler->get($replyrows[$k]["posterid"]);
        $replyrows[$k]["avatar"] = intval($users->getVar('avatar', 'n'));
    }
	$k++;
}

$jieqiTpl->assign_by_ref("replyrows", $replyrows);
$jieqiTpl->assign("enablepost", $enablepost);

if (!isset($jieqiConfigs["system"])) {
	jieqi_getconfigs("system", "configs");
}

$jieqiTpl->assign("postcheckcode", $jieqiConfigs["system"]["postcheckcode"]);
if (isset($_POST["act"]) && is_string($_POST["act"])) {
	$jieqiTpl->assign("act", jieqi_htmlstr($_POST["act"]));
}

include_once jieqi_path_lib("html/page.php");
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("istop", $topic->getVar("istop"));
$jieqiTpl->assign("isgood", $topic->getVar("isgood"));
$jieqiTpl->assign("current", $jieqiPset["page"]);
$jieqiTpl->assign("totalpages", $jumppage->totalpages);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
