<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("myreplies.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
include_once jieqi_path_lib("text/textfunction.php");
include_once jieqi_path_lib("text/textconvert.php");
$jieqiTxtcvt = TextConvert::getInstance("TextConvert");
$criteria = new CriteriaCompo();
$criteria->setTables(jieqi_dbprefix("article_reviews") . " t LEFT JOIN " . jieqi_dbprefix("article_replies") . " p ON t.topicid=p.topicid");
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

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    $criteria->add(new Criteria("p.istopic", 0));
}

$criteria->setSort("p.postid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$query->queryObjects($criteria);
$postrows = array();
$k = 0;

while ($v = $query->getObject()) {
	$postrows[$k] = jieqi_query_rowvars($v);
    $postrows[$k]["posttext"] = $jieqiTxtcvt->smile($postrows[$k]["posttext"]);
    $postrows[$k]["url_articleinfo"] = jieqi_geturl("article", "article", $postrows[$k]["ownerid"], "info", $postrows[$k]["articlecode"]);
	$k++;
}

include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
foreach ($postrows as $k => $v) {
    $article = $article_handler->get($v["ownerid"], "articleid");
    $postrows[$k]["articlename"] = $article->getVar("articlename", "n");
    $data[] = array("replierid"=>$postrows[$k]["topicid"], "replier"=>$postrows[$k]["poster"], "posttext"=>$postrows[$k]["posttext"], "posttime"=>date("Y-m-d H:i:s", $postrows[$k]["posttime"]));
}

$jieqiTpl->assign_by_ref("postrows", $postrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//    $articlevals["postdate"] = date('Y-m-d', $articlevals["postdate"]);
//    echo json_encode(array("success" => true, "data" => $postrows, "totalpage" => $jumppage->totalpages, "message" => '获取成功'));
    echo json_encode(array_merge($jumppage->whole_bar(), array("items"=>$data)));
    return false;

}

$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
