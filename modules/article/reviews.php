<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
if (empty($_REQUEST["aid"]) || !is_numeric($_REQUEST["aid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
jieqi_includedb();
$_REQUEST["aid"] = intval($_REQUEST["aid"]);
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_loadlang("review", JIEQI_MODULE_NAME);
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

include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["aid"]);

if (!$article) {
	if (!empty($_POST["act"])) {
		header("Location: reviewslist.php");
	}
	else {
		jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
	}
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_inc("class/reviews.php", "article");
$reviews_handler = &JieqiReviewsHandler::getInstance("JieqiReviewsHandler");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallreview"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"]) && is_object($article)) {
	if (!empty($_SESSION["jieqiUserId"]) && (($article->getVar("authorid") == $_SESSION["jieqiUserId"]) || ($article->getVar("posterid") == $_SESSION["jieqiUserId"]) || ($article->getVar("agentid") == $_SESSION["jieqiUserId"]))) {
		$canedit = true;
	}
}

if (isset($_POST["act"]) && !empty($_REQUEST["rid"])) {
	if (!$canedit && ($_POST["act"] != "del")) {
		jieqi_printfail(LANG_NO_PERMISSION);
	}

	$_REQUEST["rid"] = intval($_REQUEST["rid"]);
	$actreview = $reviews_handler->get($_REQUEST["rid"]);

	if (is_object($actreview)) {
		switch ($_POST["act"]) {
		case "top":
			$actreview->setVar("istop", 1);
			$reviews_handler->insert($actreview);

			if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
				jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
			}

			break;

		case "untop":
			$actreview->setVar("istop", 0);
			$reviews_handler->insert($actreview);

			if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
				jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
			}

			break;

		case "good":
			if ($actreview->getVar("isgood") == 0) {
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria("ownerid", $_REQUEST["aid"]));
				$allnum = $reviews_handler->getCount($criteria);
				$criteria->add(new Criteria("isgood", 1));
				$goodnum = $reviews_handler->getCount($criteria);
				unset($criteria);
				$maxnum = ceil(($allnum * $jieqiConfigs["article"]["goodreviewpercent"]) / 100);

				if ($maxnum <= $goodnum) {
					jieqi_printfail(sprintf($jieqiLang["article"]["review_rate_limit"], $jieqiConfigs["article"]["goodreviewpercent"]));
				}

				$actreview->setVar("isgood", 1);
				$reviews_handler->insert($actreview);

				if (!empty($jieqiAction["article"]["reviewgood"]["earnscore"])) {
					include_once jieqi_path_inc("class/users.php", "system");
					$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
					$users_handler->changeScore($actreview->getVar("posterid"), $jieqiAction["article"]["reviewgood"]["earnscore"], true);
				}
			}

			if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
				jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
			}

			break;

		case "normal":
			if ($actreview->getVar("isgood") == 1) {
				$actreview->setVar("isgood", 0);
				$reviews_handler->insert($actreview);

				if (!empty($jieqiAction["article"]["reviewgood"]["earnscore"])) {
					include_once jieqi_path_inc("class/users.php", "system");
					$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
					$users_handler->changeScore($actreview->getVar("posterid"), $jieqiAction["article"]["reviewgood"]["earnscore"], false);
				}
			}

			if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
				jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);
			}

			break;

		case "del":
			$review = $reviews_handler->get($_REQUEST["rid"]);

			if (!$review) {
				jieqi_printfail(LANG_ERROR_PARAMETER);
			}

			if ($review->getVar("ownerid", "n") != $_REQUEST["aid"]) {
				jieqi_printfail(LANG_ERROR_PARAMETER);
			}

			if (!$canedit && (empty($_SESSION["jieqiUserId"]) || ($_SESSION["jieqiUserId"] != $review->getVar("posterid", "n")))) {
				jieqi_printfail(LANG_NO_PERMISSION);
			}

			include_once jieqi_path_inc("class/replies.php", "article");
			$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
			$criteria = new Criteria("topicid", $_REQUEST["rid"]);

			if (!empty($jieqiAction["article"]["reviewadd"]["earnscore"])) {
				$replies_handler->queryObjects($criteria);
				$posterary = array();

				while ($replyobj = $replies_handler->getObject()) {
					$posterid = intval($replyobj->getVar("posterid"));

					if (isset($posterary[$posterid])) {
						$posterary[$posterid] += $jieqiAction["article"]["reviewadd"]["earnscore"];
					}
					else {
						$posterary[$posterid] = $jieqiAction["article"]["reviewadd"]["earnscore"];
					}
				}

				if (($actreview->getVar("isgood", "n") == 1) && !empty($jieqiAction["article"]["reviewgood"]["earnscore"])) {
					$posterid = intval($actreview->getVar("posterid"));

					if (isset($posterary[$posterid])) {
						$posterary[$posterid] += $jieqiAction["article"]["reviewgood"]["earnscore"];
					}
					else {
						$posterary[$posterid] = $jieqiAction["article"]["reviewgood"]["earnscore"];
					}
				}

				include_once jieqi_path_inc("class/users.php", "system");
				$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

				foreach ($posterary as $pid => $pscore ) {
					$users_handler->changeScore($pid, $pscore, false);
				}
			}

			$reviews_handler->delete($_REQUEST["rid"]);
			$replies_handler->delete($criteria);
			jieqi_jumppage($jieqiModules["article"]["url"] . "/reviews.php?aid=" . urlencode($_REQUEST["aid"]), "", "", true);
			break;
		}
	}
}

include_once jieqi_path_inc("include/funpost.php", "system");

if ($_POST["act"] == "newpost") {
	$check_errors = array();
	$istopic = (empty($_REQUEST["tid"]) ? 1 : 0);
	$istop = ($forum_type == 1 ? 2 : 0);
	$post_set = array("module" => JIEQI_MODULE_NAME, "ownerid" => intval($_REQUEST["aid"]), "topicid" => 0, "postid" => 0, "posttime" => JIEQI_NOW_TIME, "topictitle" => &$_POST["ptitle"], "posttext" => &$_POST["pcontent"], "attachment" => "", "emptytitle" => true, "isnew" => true, "istopic" => 1, "istop" => 0, "sname" => "jieqiArticleReviewTime", "attachfile" => "", "oldattach" => "", "checkcode" => $_POST["checkcode"]);
	jieqi_post_checkvar($post_set, $jieqiConfigs["article"], $check_errors);

	if (empty($check_errors)) {
		$newReview = $reviews_handler->create();
		jieqi_topic_newset($post_set, $newReview);
		$reviews_handler->insert($newReview);
		$post_set["topicid"] = $newReview->getVar("topicid", "n");
		include_once jieqi_path_inc("class/replies.php", "article");
		$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
		$newReply = $replies_handler->create();
		jieqi_post_newset($post_set, $newReply);
		$replies_handler->insert($newReply);
		$postdisplay = intval($newReply->getVar("display", "n"));
		$postresult = (0 < $postdisplay ? $jieqiLang["article"]["review_post_needaudit"] : $jieqiLang["article"]["review_post_success"]);
		$taskmodule = "article";
		$taskname = "reviewadd";
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

        $criteria = new CriteriaCompo(new Criteria("articleid", $_REQUEST["aid"]));
        $reviewsnum = $article->getVar("reviewsnum") + 1;
        $article_handler->updatefields(array("reviewsnum" => $reviewsnum), $criteria);
		include_once jieqi_path_inc("include/funaction.php", "article");
		$actions = array("actname" => "reviewadd", "actnum" => 1);
		jieqi_article_actiondo($actions, $article);
		include_once jieqi_path_inc("include/actarticle.php", "article");
		jieqi_article_updateinfo($article, "reviewnew");

		if (!empty($_REQUEST["ajax_request"]) || !empty($_REQUEST["ajax_gets"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, $postresult);
		}
	}
	else {
		jieqi_printfail(implode("<br />", $check_errors));
	}
}

if (isset($_REQUEST["ajax_gets"])  && JIEQI_COVER_DIR == '' && !is_Post()) {
    header("Content-type: text/html; charset=".JIEQI_SYSTEM_CHARSET);
    $jieqiTset["jieqi_page_template"] = jieqi_path_template("reviews_ajax.html", "article");
}
else if ($_REQUEST["ajax_gets_new"]  && JIEQI_COVER_DIR == '') {
    header("Content-type: text/html; charset=".JIEQI_SYSTEM_CHARSET);
    $jieqiTset["jieqi_page_template"] = jieqi_path_template("reviews_ajax_new.html", "article");
}
else {
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template("reviews.html", "article");
}

include_once jieqi_path_lib("text/textconvert.php");
$jieqiTxtcvt = TextConvert::getInstance("TextConvert");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->assign("ownerid", $article->getVar("articleid"));
$jieqiTpl->assign("articleid", $article->getVar("articleid"));
$jieqiTpl->assign("articlename", $article->getVar("articlename"));
$jieqiTpl->assign("articlecode", $article->getVar("articlecode"));

if (!empty($_SESSION["jieqiUserId"])) {
    //获取当前用户是否收藏本书
    $is_bookcase = false;
    include_once jieqi_path_inc("class/bookcase.php", "article");
    $bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
    $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
    $criteria->add(new Criteria("articleid", $_REQUEST["aid"]));
    $bookcase_handler->queryObjects($criteria);
    $bookcase = $bookcase_handler->getObject();
    if (is_object($bookcase)) {
        $is_bookcase = true;
    }
    unset($criteria);
}

$jieqiTpl->assign("is_bookcase", $is_bookcase);

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
$jieqiTpl->assign("url_articleinfo", jieqi_geturl("article", "article", $article->getVar("articleid"), "info", $article->getVar("articlecode", "n")));
$jieqiTpl->assign("url_articleindex", jieqi_geturl("article", "article", $article->getVar("articleid"), "index", $article->getVar("articlecode", "n")));
$jieqiTpl->assign("url_image", jieqi_geturl("article", "cover", $article->getVar("articleid"), "s", $article->getVar("imgflag")));
include_once jieqi_path_lib("text/textfunction.php");
$criteria = new CriteriaCompo();
$criteria->add(new Criteria("r.display", 0));
$criteria->add(new Criteria("r.ownerid", $_REQUEST["aid"]));
$criteria->add(new Criteria("a.istopic", 1));
$criteria->setTables(jieqi_dbprefix("article_reviews") . " r LEFT JOIN " . jieqi_dbprefix("article_replies") . " a ON r.topicid=a.topicid");
if (isset($_REQUEST["type"]) && ($_REQUEST["type"] == "good")) {
	$jieqiTpl->assign("type", "good");
	$criteria->add(new Criteria("r.isgood", 1));
}
else {
	$_REQUEST["type"] = "all";
	$jieqiTpl->assign("type", "all");
}

$criteria->setSort("r.istop DESC, r.replytime");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$article_query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$article_query->queryObjects($criteria);
$reviewrows = array();
$replyrows = array();
$i = 0;
$k = 0;
while ($v = $article_query->getObject()) {
	$reviewrows[$k] = jieqi_topic_vars($v);
    $reviewrows[$k]["posttext"] = $jieqiTxtcvt->smile($reviewrows[$k]["posttext"]);
    $reviewrows[$k]["posttime"] = date('Y-m-d H:i:s', $reviewrows[$k]["posttime"]);
    if (!empty($reviewrows[$k]["posterid"])) {
        include_once jieqi_path_inc("class/users.php", "system");
        $users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
        $users = $users_handler->get($reviewrows[$k]["posterid"]);
        $honorid = jieqi_gethonorid($users->getVar("score"), $jieqiHonors);
        include_once jieqi_path_inc("include/badgefunction.php", "badge");
        $reviewrows[$k]["honors"] = $jieqiHonors[$honorid]["name"][intval($users->getVar("workid", "n"))];
        $reviewrows[$k]["url_honors"] = getbadgeurl(2, $honorid, 0, true);
        $reviewrows[$k]["avatar"] = intval($users->getVar('avatar', 'n'));
        $reviewrows[$k]["url_avatar"] = jieqi_geturl("system", "avatar", $reviewrows[$k]["posterid"], "s", $reviewrows[$k]["avatar"]);
    }
	$k++;
}

foreach ($reviewrows as $k => $v) {
    $criteria1 = new CriteriaCompo();
    $criteria1->add(new Criteria("display", 0));
    $criteria1->add(new Criteria("topicid", $v['topicid']));
    $criteria1->add(new Criteria("istopic", 0));
    $criteria1->setTables(jieqi_dbprefix("article_replies"));
    $criteria1->setSort("posttime");
    $criteria1->setOrder("DESC");
    $article_query->queryObjects($criteria1);
    $row = $article_query->getObject();
	while ($row = $article_query->getObject()) {
        $replyrows[$i] = jieqi_topic_vars($row);
        $replyrows[$i]["posttime"] = date("Y-m-d H:i:s", $replyrows[$i]["posttime"]);
        if ($reviewrows[$k]["topicid"] == $replyrows[$i]["topicid"]) {
            $reviewrows[$k]["relist"][] = $replyrows[$i];
		}
		$i++;
	}
}

$jieqiTpl->assign_by_ref("reviewrows", $reviewrows);
$jieqiTpl->assign("enablepost", $enablepost);

if (!isset($jieqiConfigs["system"])) {
	jieqi_getconfigs("system", "configs");
}

$jieqiTpl->assign("postcheckcode", $jieqiConfigs["system"]["postcheckcode"]);
if (isset($_POST["act"]) && is_string($_POST["act"])) {
	$jieqiTpl->assign("act", jieqi_htmlstr($_POST["act"]));
}

include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $article_query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("reviewsnum", $jieqiPset["count"]);
$jieqiTpl->assign("current", $jieqiPset["page"]);
$jieqiTpl->assign("totalpages", $jumppage->totalpages);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());

//if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//    echo json_encode(array("success" => true, "data" => $reviewrows, "page" =>$jumppage->totalpages, "rank"=>$jumppage->totalrows, "message" => '获取成功'));
//    return false;
//
//}
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
