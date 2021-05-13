<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("myreviews.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
include_once jieqi_path_lib("text/textfunction.php");
$criteria = new CriteriaCompo();
$criteria->setFields("t.*, a.articleid, a.articlename, a.imgflag, a.authorid, a.author");
$criteria->setTables(jieqi_dbprefix("article_reviews") . " AS t LEFT JOIN " . jieqi_dbprefix("article_article") . " AS a ON t.ownerid = a.articleid");
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
		$criteria->add(new Criteria("a.articlename", $_REQUEST["keyword"], "="));
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
$ptopicrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$ptopicrows[$k] = jieqi_topic_vars($v);
    $ptopicrows[$k]["url_articleinfo"] = jieqi_geturl("article", "article", $ptopicrows[$k]["articleid"], "info", $ptopicrows[$k]["articlecode"]);
    $ptopicrows[$k]["url_image"] = jieqi_geturl("article", "cover", $v->getVar("articleid"), "s", $v->getVar("imgflag"));
    $data[] = array("title"=>$ptopicrows[$k]["title"],"url_review"=>$jieqiModules["article"]["url"]."/reviewshow.php?tid=".$ptopicrows[$k]["topicid"],"url_articleinfo"=>jieqi_geturl("article", "article", $ptopicrows[$k]["articleid"], "info", $ptopicrows[$k]["articlecode"]),"articlename"=>$ptopicrows[$k]["articlename"],"replies"=>$ptopicrows[$k]["replies"],"views"=>$ptopicrows[$k]["views"],"posttime"=>date("Y-m-d H:i:s", $ptopicrows[$k]["posttime"]),"author"=>$ptopicrows[$k]["author"],"authorid"=>$ptopicrows[$k]["authorid"],"url_image"=>$ptopicrows[$k]["url_image"]);
	$k++;
}

$jieqiTpl->assign_by_ref("ptopicrows", $ptopicrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//    $articlevals["postdate"] = date('Y-m-d', $articlevals["postdate"]);
//    echo json_encode(array("success" => true, "data" => $ptopicrows, "totalpage" => $jumppage->totalpages, "message" => '获取成功'));
    echo json_encode(array_merge($jumppage->whole_bar(), array("items"=>$data)));
    return false;

}
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
