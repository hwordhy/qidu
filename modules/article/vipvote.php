<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");

if (empty($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang("vipvote", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "action");
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$users = $users_handler->get($_SESSION["jieqiUserId"]);

if (!is_object($users)) {
	jieqi_printfail(LANG_NO_USER);
}
else if ($users->getvar("isvip") == 0) {
	jieqi_printfail($jieqiLang["article"]["need_vip_user"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
include_once jieqi_path_inc("include/funstat.php", "system");
$userset = unserialize($users->getVar("setting", "n"));
$thismonth = date("Y-m", JIEQI_NOW_TIME);
$maxvote = $jieqiConfigs["article"]["vipvotenums"];

if (isset($_SESSION["jieqiEgoldMonth"])) {
	$egoldmonth = $_SESSION["jieqiEgoldMonth"];
}
else {
	$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
	$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
	$tmpvar = explode("-", date("Y-m-d", strtotime("+1 month", JIEQI_NOW_TIME)));
	$monthend = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
	$sql = "SELECT SUM(egold) as egoldmonth FROM " . jieqi_dbprefix("article_actlog") . " WHERE tid=" . $_SESSION["jieqiUserId"] . " AND addtime>=" . $monthstart . " AND addtime<" . $monthend;
	$query = jieqiqueryhandler::getinstance("JieqiQueryHandler");
	$query->execute($sql);
	$res = $query->getobject();

	if (is_object($res)) {
		$egoldmonth = intval($res->getvar("egoldmonth", "n"));
	}
	else {
		$egoldmonth = 0;
	}

	$GLOBALS["_SESSION"]["jieqiEgoldMonth"] = $egoldmonth;
}

if (0 < $jieqiConfigs["article"]["vipvoteegold"]) {
	$vipvote = floor($maxvote + ($egoldmonth / intval($jieqiConfigs["article"]["vipvoteegold"])));

	if (($userset["gift"]["vipmonth"] != $thismonth) && is_object($users)) {
		$userset["gift"]["vipvote"] = $vipvote;
		$userset["gift"]["vipmonth"] = $thismonth;
		$users->setVar("setting", serialize($userset));
		$users->saveToSession();
		$users_handler->insert($users);
	}
}

include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &jieqiarticlehandler::getinstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}
//else if ($article->getvar("authorid") == 0) {
//	jieqi_printfail($jieqiLang["article"]["article_not_self"]);
//}

$addnum = intval($_REQUEST["num"]);
$lasttime = $article->getVar("lastvipvote", "n");
$addorup = jieqi_visit_addorup($lasttime);
$dayvipvote = ($addorup["day"] ? $addnum : $article->getVar("dayvipvote", "n") + $addnum);
$weekvipvote = ($addorup["week"] ? $addnum : $article->getVar("weekvipvote", "n") + $addnum);
$monthvipvote = ($addorup["month"] ? $addnum : $article->getVar("monthvipvote", "n") + $addnum);
$allvipvote = $article->getVar("allvipvote", "n") + $addnum;

if (!isset($_REQUEST["action"])) {
	$_REQUEST["action"] = "show";
}

switch ($_REQUEST["act"]) {
case "post":
	$errtext = "";
	$_REQUEST["num"] = intval(trim($_REQUEST["num"]));

	if ($_REQUEST["num"] <= 0) {
		$errtext .= $jieqiLang["article"]["vote_over_zero"];
	}
	else if ($userset["gift"]["vipvote"] < $_REQUEST["num"]) {
		$errtext .= $jieqiLang["article"]["vote_over_emoney"];
	}

	if (empty($errtext)) {
		$criteria = new CriteriaCompo(new Criteria("articleid", $_REQUEST["id"]));
		$article_handler->updatefields(array("lastvipvote" => JIEQI_NOW_TIME, "dayvipvote" => $dayvipvote, "weekvipvote" => $weekvipvote, "monthvipvote" => $monthvipvote, "allvipvote" => $allvipvote), $criteria);

		if (is_object($users)) {
			$userset["gift"]["vipvote"] = intval($userset["gift"]["vipvote"]) - $_REQUEST["num"];
			$userset["gift"]["vipmonth"] = date("Y-m", JIEQI_NOW_TIME);
			$users->setVar("setting", serialize($userset));
			$users->saveToSession();
			$ret = $users_handler->insert($users);
		}

		if (!$ret) {
			jieqi_printfail($jieqiLang["article"]["user_payout_failure"]);
		}

		$name = "张月票";
		$tid = (0 < $article->getVar("authorid", "n") ? $article->getVar("authorid", "n") : $article->getVar("posterid", "n"));
		$tname = (0 < $article->getVar("authorid", "n") ? $article->getVar("author", "n") : $article->getVar("poster", "n"));
		include_once jieqi_path_inc("include/funbuy.php", "obook");
		jieqi_obook_upincome(array("articleid" => $article->getVar("articleid", "n"), "egold" => 0, "etype" => 0, "intype" => "vipvote", "salenum" => 0));
		include_once jieqi_path_inc("include/funaction.php", "article");
		$actions = array("actname" => "vipvote", "actnum" => $_REQUEST["num"], "actegold" => 0, "actbuy" => 0, "tid" => $tid, "tname" => $tname, "aname" => $article->getVar("articlename", "n"));
		jieqi_loadlang("action", "article");
		$actions["review_title"] = (empty($_REQUEST["title"]) ? sprintf($jieqiLang["article"]["vipvote_review_title"], $_SESSION["jieqiUserName"], $actions["aname"], $_REQUEST["num"] . $name) : $_REQUEST["title"]);
		$actions["review_content"] = (empty($_REQUEST["content"]) ? sprintf($jieqiLang["article"]["vipvote_review_content"], $_SESSION["jieqiUserName"], $actions["aname"], $_REQUEST["num"] . $name) : $_REQUEST["content"]);
		$actions["message_title"] = sprintf($jieqiLang["article"]["vipvote_message_title"], $_SESSION["jieqiUserName"], $actions["aname"], $_REQUEST["num"] . $name);
		$actions["message_content"] = sprintf($jieqiLang["article"]["vipvote_message_content"], $_SESSION["jieqiUserName"], $actions["aname"], $_REQUEST["num"] . $name);
		jieqi_article_actiondo($actions, $article);
		$sql = "SELECT count(distinct monthvipvote) as ranking FROM " . jieqi_dbprefix("article_article") . " WHERE monthvipvote > " . $article->getVar("monthvipvote");
		$res = $article_handler->execute($sql);
		$row = $article_handler->getRow($res);
		jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang["article"]["vipvote_success"], $_REQUEST["num"], $userset["gift"]["vipvote"]), array("monthvipvote" => $article->getvar("monthvipvote"), "vipvotenums" => $userset["gift"]["vipvote"], "ranking" => $row["ranking"]));
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "show":
default:
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("articleid", $article->getVar("articleid"));
	$jieqiTpl->assign("articlename", $article->getVar("articlename"));
	$jieqiTpl->assign("vipid", $article->getVar("vipid"));
	$jieqiTpl->assign("postdate", date(JIEQI_DATE_FORMAT, $article->getVar("postdate")));
	$jieqiTpl->assign("lastupdate", date(JIEQI_DATE_FORMAT, $article->getVar("lastupdate")));
	$jieqiTpl->assign("authorid", $article->getVar("authorid"));
	$jieqiTpl->assign("author", $article->getVar("author"));
	$jieqiTpl->assign("vipvote", $userset["gift"]["vipvote"]);

	if (empty($_REQUEST["ajax_request"])) {
		$jieqiTpl->assign("ajax_request", 0);
	}
	else {
		$jieqiTpl->assign("ajax_request", 1);
	}

	$jieqiTpl->setCaching(0);
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template("vipvote.html", "article");
	include_once jieqi_path_common("footer.php");
	break;
}

?>
