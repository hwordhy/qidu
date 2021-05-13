<?php

@define("JIEQI_MODULE_NAME", "pay");
@define("JIEQI_PAY_TYPE", "ipnwap");
require_once ("../../global.php");
jieqi_loadlang("pay", "pay");

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
if (!empty($_REQUEST["payChannelType"]) && is_numeric($_REQUEST["payChannelType"])) {
	define("JIEQI_PAY_SUBTYPE", $_REQUEST["payChannelType"] . $jieqiPayset[JIEQI_PAY_TYPE]["deviceType"]);
}

include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include jieqi_path_inc("include/funipaynow.php", "pay");

if ($jieqi_charset_map[JIEQI_SYSTEM_CHARSET] != "utf8") {
	include_once jieqi_path_inc("include/changecode.php", "system");
	$charset_convert_payin = "jieqi_" . $jieqi_charset_map["utf8"] . "2" . $jieqi_charset_map[JIEQI_SYSTEM_CHARSET];
	$charset_convert_payout = "jieqi_" . $jieqi_charset_map[JIEQI_SYSTEM_CHARSET] . "2" . $jieqi_charset_map["utf8"];
}

$payvars = array();
$payvars["funcode"] = $jieqiPayset[JIEQI_PAY_TYPE]["funcode"];
$payvars["appId"] = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$payvars["mhtOrderNo"] = $paylog->getVar("payid");
$payvars["mhtOrderName"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["mhtOrderName"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["mhtOrderName"]);
$payvars["mhtOrderName"] = jieqi_pay_charsetconvert($payvars["mhtOrderName"], JIEQI_SYSTEM_CHARSET, "utf-8");
$payvars["mhtOrderType"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtOrderType"];
$payvars["mhtCurrencyType"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtCurrencyType"];
$payvars["mhtOrderAmt"] = $_REQUEST["money"];
$payvars["mhtOrderDetail"] = sprintf($jieqiPayset[JIEQI_PAY_TYPE]["mhtOrderDetail"], $_REQUEST["egold"], $_REQUEST["amount"]);
$payvars["mhtOrderDetail"] = jieqi_pay_charsetconvert($payvars["mhtOrderDetail"], JIEQI_SYSTEM_CHARSET, "utf-8");
$payvars["mhtOrderTimeOut"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtOrderTimeOut"];
$payvars["mhtOrderStartTime"] = date("YmdHis", JIEQI_NOW_TIME);
$payvars["notifyUrl"] = $jieqiPayset[JIEQI_PAY_TYPE]["paynotify"];
$payvars["frontNotifyUrl"] = $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"];
$payvars["mhtCharset"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtCharset"];
$payvars["deviceType"] = $jieqiPayset[JIEQI_PAY_TYPE]["deviceType"];

if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["payChannelType"])) {
	$payvars["payChannelType"] = $jieqiPayset[JIEQI_PAY_TYPE]["payChannelType"];
}
else if (!empty($_REQUEST["payChannelType"])) {
	$payvars["payChannelType"] = $_REQUEST["payChannelType"];
}
else {
	$payvars["payChannelType"] = "";
}

if (isset($jieqiPayset[JIEQI_PAY_TYPE]["mhtReserved"]) && (0 < strlen($jieqiPayset[JIEQI_PAY_TYPE]["mhtReserved"]))) {
	$payvars["mhtReserved"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtReserved"];
}

$payvars["mhtSignType"] = $jieqiPayset[JIEQI_PAY_TYPE]["mhtSignType"];
$payvars["mhtSignature"] = jieqi_pay_makesign($payvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);
$query = $jieqiPayset[JIEQI_PAY_TYPE]["payurl"] . "?" . jieqi_pay_makequery($payvars, true);
include_once jieqi_path_common("header.php");
$jieqiTpl->assign("buyname", $_SESSION["jieqiUserName"]);
$jieqiTpl->assign("egold", $_REQUEST["egold"]);
$jieqiTpl->assign("money", $_REQUEST["amount"]);
$jieqiTpl->assign("url_pay", $jieqiPayset[JIEQI_PAY_TYPE]["payurl"]);
$jieqiTpl->assign("url_query", $query);

foreach ($payvars as $k => $v ) {
	$payvars[$k] = jieqi_htmlchars($v, ENT_QUOTES);
}

$jieqiTpl->assign("payvars", $payvars);
$jieqiTpl->assign("jumpurl", jieqi_htmlstr($_REQUEST["jumpurl"]));
if (($payvars["deviceType"] == "02") && ($payvars["payChannelType"] == "13")) {
	$qrdata = trim(file_get_contents($query));
	if ((12 < strlen($qrdata)) && (substr($qrdata, 0, 10) == "callback('")) {
		$qrdata = substr($qrdata, 10, -2);
	}
	else {
		jieqi_printfail("获取二维码失败：" . jieqi_htmlstr($qrdata));
	}

	$jieqiTpl->assign("qrdata", jieqi_htmlstr($qrdata));
	$jieqiTset["jieqi_page_template"] = jieqi_path_template("ipnwxsm.html", "pay");
}
else {
	$jieqiTset["jieqi_page_template"] = jieqi_path_template("ipnwap.html", "pay");
}

$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
