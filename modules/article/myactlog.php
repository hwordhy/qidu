<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "action");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("myactlog.html", "article");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$slimit = "uid = " . intval($_SESSION["jieqiUserId"]);

if (!empty($_REQUEST["aid"])) {
	$slimit .= " AND articleid = " . intval($_REQUEST["aid"]);
}

if (!empty($_REQUEST["aname"])) {
	$slimit .= " AND articlename = '" . jieqi_dbslashes($_REQUEST["aname"]) . "'";
}

$actname = "";
if (!empty($_REQUEST["act"]) && isset($jieqiAction["article"][$_REQUEST["act"]])) {
	$actname = jieqi_htmlstr($jieqiAction["article"][$_REQUEST["act"]]["acttitle"]);
	$slimit .= " AND actname = '" . jieqi_dbslashes($_REQUEST["act"]) . "'";
}

$jieqiTpl->assign("actname", $actname);

if (!empty($_REQUEST["datestart"])) {
	$tmpvar = @strtotime($_REQUEST["datestart"]);

	if (0 < $tmpvar) {
		$slimit .= " AND addtime >= " . intval($tmpvar);
	}
}

if (!empty($_REQUEST["dateend"])) {
	$tmpvar = @strtotime($_REQUEST["dateend"]);

	if (0 < $tmpvar) {
		$slimit .= " AND addtime <= " . intval($tmpvar);
	}
}

$sql = "SELECT * FROM " . jieqi_dbprefix("article_actlog") . " WHERE $slimit ORDER BY actlogid DESC LIMIT {$jieqiPset["start"]},{$jieqiPset["rows"]}";
$query->execute($sql);
$actlogrows = array();
$k = 0;

while ($row = $query->getRow()) {
	$actlogrows[$k] = jieqi_query_rowvars($row);
	$actlogrows[$k]["actname_n"] = $actlogrows[$k]["actname"];

	if (isset($jieqiAction["article"][$actlogrows[$k]["actname_n"]])) {
		$actlogrows[$k]["actname"] = jieqi_htmlstr($jieqiAction["article"][$actlogrows[$k]["actname_n"]]["acttitle"]);
	}
    $actlogrows[$k]["add_time"] = date("Y-m-d H:i:s", $actlogrows[$k]["addtime"]);
	$k++;
}

$jieqiTpl->assign_by_ref("actlogrows", $actlogrows);
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
$jieqiTpl->assign("actionrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiAction["article"]));
include_once jieqi_path_lib("html/page.php");
$sql = "SELECT count(*) AS cot, sum(actnum) as sumactnum FROM " . jieqi_dbprefix("article_actlog") . " WHERE $slimit";
$query->execute($sql);
$row = $query->getRow();
$jieqiTpl->assign("actlogstat", jieqi_funtoarray("jieqi_htmlstr", $row));
$jieqiPset["count"] = intval($row["cot"]);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    echo json_encode(array("success" => true, "data" => array("list" => $actlogrows, "totalpage" => $jumppage->totalpages, "totalrows"=>$jumppage->totalrows), "message" => '????????????'));
    return false;
}

$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
