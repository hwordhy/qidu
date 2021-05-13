<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "tenpay");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include_once jieqi_path_common("header.php");
$jieqiTpl->assign("url_pay", $jieqiPayset[JIEQI_PAY_TYPE]["payurl"]);
$jieqiTpl->assign("buyname", $_SESSION["jieqiUserName"]);
$jieqiTpl->assign("egold", $_REQUEST["egold"]);
$jieqiTpl->assign("egoldname", JIEQI_EGOLD_NAME);
$jieqiTpl->assign("money", $_REQUEST["amount"]);
$payvars = array();
$payvars["partner"] = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$payvars["out_trade_no"] = $paylog->getVar("payid");
$payvars["total_fee"] = $_REQUEST["money"];
$payvars["return_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"];
$payvars["notify_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["paynotify"];
$payvars["body"] = JIEQI_EGOLD_NAME;
$payvars["bank_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["bank_type"];
$payvars["spbill_create_ip"] = jieqi_userip();
$payvars["fee_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["fee_type"];
$payvars["subject"] = JIEQI_EGOLD_NAME;
$payvars["sign_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["sign_type"];
$payvars["service_version"] = $jieqiPayset[JIEQI_PAY_TYPE]["service_version"];
$payvars["input_charset"] = $jieqiPayset[JIEQI_PAY_TYPE]["input_charset"];
$payvars["sign_key_index"] = $jieqiPayset[JIEQI_PAY_TYPE]["sign_key_index"];
$payvars["attach"] = $jieqiPayset[JIEQI_PAY_TYPE]["attach"];
$payvars["product_fee"] = "";
$payvars["transport_fee"] = "0";
$payvars["time_start"] = date("YmdHis");
$payvars["time_expire"] = "";
$payvars["buyer_id"] = "";
$payvars["goods_tag"] = "";
$payvars["trade_mode"] = $jieqiPayset[JIEQI_PAY_TYPE]["trade_mode"];
$payvars["transport_desc"] = "";
$payvars["trans_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["trans_type"];
$payvars["agentid"] = "";
$payvars["agent_type"] = "0";
$payvars["seller_id"] = "";
ksort($payvars);
$sign = "";

foreach ($payvars as $k => $v ) {
	if (($k != "sign") && (0 < strlen($v))) {
		$sign .= $k . "=" . $v . "&";
	}
}

$sign = strtoupper(md5($sign . "key=" . $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]));
$payvars["sign"] = $sign;
$jieqiTpl->assign_by_ref("payvars", $payvars);

foreach ($payvars as $k => $v ) {
	$jieqiTpl->assign($k, $v);
}

if (is_array($jieqiPayset[JIEQI_PAY_TYPE]["addvars"])) {
	foreach ($jieqiPayset[JIEQI_PAY_TYPE]["addvars"] as $k => $v ) {
		$jieqiTpl->assign($k, $v);
	}
}

$jieqiTpl->assign("jumpurl", jieqi_htmlstr($_REQUEST["jumpurl"]));
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("tenpay.html", "pay");
include_once jieqi_path_common("footer.php");

?>
