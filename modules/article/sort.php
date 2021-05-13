<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("article", "sort");
if (empty($_REQUEST["sortid"]) || !is_numeric($_REQUEST["sortid"]) || !isset($jieqiSort["article"][$_REQUEST["sortid"]])) {
	$_REQUEST["sortid"] = 0;
}

$_REQUEST["sortid"] = intval($_REQUEST["sortid"]);

if (empty($_REQUEST["sortid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

if (is_file(jieqi_path_config("sortindex" . $_REQUEST["sortid"], "article"))) {
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sortindex" . $_REQUEST["sortid"], "jieqiBlocks");
}
else if (is_file(jieqi_path_config("sortindex", "article"))) {
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sortindex", "jieqiBlocks");
}

include_once jieqi_path_common("header.php");
$jieqiTpl->assign("sortid", $_REQUEST["sortid"]);

if (0 < $_REQUEST["sortid"]) {
	$sort = $jieqiSort["article"][$_REQUEST["sortid"]]["caption"];
}
else {
	$sort = "";
}

$jieqiTpl->assign("sort", $sort);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("sort.html", "article");
include_once jieqi_path_common("footer.php");

?>
