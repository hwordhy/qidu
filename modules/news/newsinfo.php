<?php

define("JIEQI_MODULE_NAME", "news");
require_once ("../../global.php");
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_loadlang("news", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/topic.php", "news");
if (!isset($jieqiConfigs["news"]["visitstatnum"]) || !empty($jieqiConfigs["news"]["visitstatnum"])) {
    include_once jieqi_path_inc("newsvisit.php", "news");
}
$topic_handler = &JieqiNewstopicHandler::getInstance("JieqiNewstopicHandler");
$topic = $topic_handler->get($_REQUEST["id"]);

if (!is_object($topic)) {
	jieqi_printfail($jieqiLang["news"]["news_not_exist"]);
}
else {
	if (($topic->getVar("display", "n") != 0) && ($jieqiUsersStatus != JIEQI_GROUP_ADMIN)) {
		jieqi_printfail($jieqiLang["news"]["news_not_audit"]);
	}
}

$gourl = trim($topic->getVar("gourl", "n"));

if (!empty($gourl)) {
	header("Location: " . jieqi_headstr($gourl));
	exit();
}

$_REQUEST["sortid"] = $topic->getVar("sortid", "n");
include_once jieqi_path_common("header.php");
include_once jieqi_path_inc("include/funnews.php", "news");
$news = jieqi_news_vars($topic);
include_once jieqi_path_inc("class/content.php", "news");
$content_handler = &JieqiNewscontentHandler::getInstance("JieqiNewscontentHandler");
$content = $content_handler->get($_REQUEST["id"]);

if (is_object($content)) {
	$news["contents"] = $content->getVar("contents", "n");
}

$jieqiTpl->assign_by_ref("news", $news);
include_once jieqi_path_inc("include/funsort.php", "system");
$sortroutes = jieqi_sort_routes($jieqiSort["news"], $topic->getVar("sortid"));
$jieqiTpl->assign_by_ref("sortroutes", $sortroutes);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_page_template"] = jieqi_path_template("newsinfo.html", "news");
include_once jieqi_path_common("footer.php");

?>
