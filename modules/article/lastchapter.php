<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");

if (empty($_REQUEST["aid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["aid"] = intval($_REQUEST["aid"]);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
if (!empty($_REQUEST["acode"]) && preg_match("/^\w+$/", $_REQUEST["acode"])) {
	$tmpvar = $_REQUEST["acode"];
}
else {
	$tmpvar = "";
}

$jumpurl = jieqi_geturl("article", "article", $_REQUEST["aid"], "index", $tmpvar);

if (file_exists(jieqi_path_template("lastchapter.html", "article"))) {
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("articleid", $_REQUEST["aid"]);
	$jieqiTpl->assign("dynamic", $_REQUEST["dynamic"]);
	$jieqiTpl->assign("hasebook", $hasebook);
	$jieqiTpl->assign("isvip", $hasebook);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("jumpurl", $jumpurl);
	$jieqiTset["jieqi_page_template"] = jieqi_path_template("lastchapter.html", "article");
	include_once jieqi_path_common("footer.php");
}
else {
	header("Location: " . jieqi_headstr($jumpurl));
}

?>
