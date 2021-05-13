<?php

define("JIEQI_MODULE_NAME", "pay");
require_once ("../../global.php");
jieqi_checklogin();
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/paylog.php", "pay");
$paylog_handler = JieqiPaylogHandler::getInstance("JieqiPaylogHandler");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("paylog.html", "pay");
include_once jieqi_path_common("header.php");
$jieqiPset = jieqi_get_pageset();
$criteria = new CriteriaCompo();
$criteria->add(new Criteria("buyid", $_SESSION["jieqiUserId"], "="));

if ($_REQUEST["status"] == "finish") {
	$criteria->add(new Criteria("payflag", 0, ">"));
}
else if ($_REQUEST["status"] == "cancel") {
	$criteria->add(new Criteria("payflag", 0, "="));
}

$criteria->setSort("payid");
$criteria->setOrder("DESC");
$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$paylog_handler->queryObjects($criteria);
$paylogrows = array();
$k = 0;
$record = 0;
jieqi_getconfigs(JIEQI_MODULE_NAME, "paytype");

while ($v = $paylog_handler->getObject()) {
	$paylogrows[$k] = jieqi_query_rowvars($v);
    $paylogrows[$k]["buy_time"] = date("Y-m-d H:i:s", $paylogrows[$k]["buytime"]);
	if (isset($jieqiPaytype[$v->getVar("paytype", "n")])) {
		$paylogrows[$k]["paytype"] = $jieqiPaytype[$v->getVar("paytype", "n")]["shortname"];
	}
    $total += $paylogrows[$k]["egold"];
	$k++;
}

$jieqiTpl->assign_by_ref("paylogrows", $paylogrows);
include_once jieqi_path_lib("html/page.php");
$jieqiPset["count"] = $paylog_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink("", true, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    echo json_encode(array("success" => true, "data" => array("list" => $paylogrows, "totalpage" => $jumppage->totalpages, "totalrows"=>$jumppage->totalrows, "total"=>$total), "message" => '获取成功'));
    return false;
}
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
