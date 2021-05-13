<?php

define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_loadlang("article", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}
else {
	if (($article->getVar("display") != 0) && ($jieqiUsersStatus != JIEQI_GROUP_ADMIN)) {
		jieqi_printfail($jieqiLang["article"]["article_not_audit"]);
	}
	else {
		$jieqiTset["jieqi_contents_template"] = jieqi_path_template("creditlist.html", "article");
		include_once jieqi_path_common("header.php");
		jieqi_getconfigs("article", "sort", "jieqiSort");
		jieqi_getconfigs("article", "option", "jieqiOption");
		include_once jieqi_path_inc("include/funarticle.php", "article");
		$articlevals = jieqi_article_vars($article, true);
		$jieqiTpl->assign_by_ref("articlevals", $articlevals);

		foreach ($articlevals as $k => $v ) {
			$jieqiTpl->assign($k, $articlevals[$k]);
		}
	}
}

$jieqiPset = jieqi_get_pageset();
jieqi_getconfigs("article", "credit", "jieqiCredit");
$creditrows = array();
$slimit = "articleid = " . $_REQUEST["id"];
$sort = "point";
$order = "DESC";
$limitstart = intval($jieqiPset["start"]);
$listpnum = intval($jieqiPset["rows"]);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql = "SELECT * FROM " . jieqi_dbprefix("article_credit") . " WHERE $slimit ORDER BY $sort $order LIMIT $limitstart,$listpnum";
$cotsql = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("article_credit") . " WHERE $slimit";
$creditrows = array();
$query->execute($sql);
$k = 0;

while ($row = $query->getRow()) {
	$creditrows[$k] = jieqi_funtoarray("jieqi_htmlstr", $row);
	$creditrows[$k]["order"] = $limitstart + $k + 1;
	$mincredit = 0;
	$creditrows[$k]["rank"] = "";

	foreach ($jieqiCredit["article"] as $v ) {
		if (($v["minnum"] <= $creditrows[$k]["point"]) && ($mincredit <= $v["minnum"])) {
			$creditrows[$k]["rank"] = $v["caption"];
			$mincredit = $v["minnum"];
            if (!empty($creditrows[$k]["uid"])){
                include_once jieqi_path_inc("class/users.php", "system");
                $users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
                $users = $users_handler->get($creditrows[$k]["uid"]);
                $creditrows[$k]["avatar"] = intval($users->getVar('avatar', 'n'));
            }
		}
	}

    $data[] = array("user_avatar"=>jieqi_geturl("article", "cover", $creditrows[$k]["uid"], "s", $creditrows[$k]["avatar"]), "index"=>$k, "rank"=>$creditrows[$k]["rank"], "userId"=>$creditrows[$k]["uid"], "userName"=>$creditrows[$k]["uname"], "point"=>$creditrows[$k]["point"]);

	$k++;
}

if (!empty($_SESSION["jieqiUserId"])) {
    //获取当前用户是否收藏本书
    $is_bookcase = false;
    include_once jieqi_path_inc("class/bookcase.php", "article");
    $bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
    $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
    $criteria->add(new Criteria("articleid", $_REQUEST["id"]));
    $bookcase_handler->queryObjects($criteria);
    $bookcase = $bookcase_handler->getObject();
    if (is_object($bookcase)) {
        $is_bookcase = true;
    }
    unset($criteria);
}
$jieqiTpl->assign("is_bookcase", $is_bookcase);
$jieqiTpl->assign_by_ref("creditrows", $creditrows);
$jieqiTpl->assign("articleid", $_REQUEST["id"]);
include_once jieqi_path_lib("html/page.php");
$query->execute($cotsql);
$row = $query->getRow();
$jieqiPset["count"] = intval($row["cot"]);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    echo json_encode(array_merge($jumppage->whole_bar(), array("data"=>$data)));
    return false;
}
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
