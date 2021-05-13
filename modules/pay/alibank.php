<?php

@define("JIEQI_MODULE_NAME", "pay");
@define("JIEQI_PAY_TYPE", "alibank");
require_once ("../../global.php");
jieqi_loadlang("pay", "pay");

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include jieqi_path_inc("include/funalipay.php", "pay");
$payvars = array();
$payvars["service"] = $jieqiPayset[JIEQI_PAY_TYPE]["service"];
$payvars["partner"] = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$payvars["return_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"];
$payvars["notify_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["notify_url"];
$payvars["_input_charset"] = $jieqiPayset[JIEQI_PAY_TYPE]["_input_charset"];
$payvars["subject"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["subject"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["subject"]);
$payvars["out_trade_no"] = $paylog->getVar("payid");
$payvars["total_fee"] = $_REQUEST["amount"];
$payvars["payment_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["payment_type"];
$payvars["show_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["show_url"];
$payvars["seller_id"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["seller_id"]) ? $jieqiPayset[JIEQI_PAY_TYPE]["payid"] : $jieqiPayset[JIEQI_PAY_TYPE]["seller_id"]);

if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["body"])) {
	$payvars["body"] = $jieqiPayset[JIEQI_PAY_TYPE]["body"];
}

if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["seller_email"])) {
	$payvars["seller_email"] = $jieqiPayset[JIEQI_PAY_TYPE]["seller_email"];
}

if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["paymethod"])) {
	$payvars["paymethod"] = $jieqiPayset[JIEQI_PAY_TYPE]["paymethod"];
}

$sign = jieqi_pay_makesign($payvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);
$payvars["sign_type"] = $jieqiPayset[JIEQI_PAY_TYPE]["sign_type"];
$payvars["sign"] = $sign;
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
$jieqiTset["jieqi_page_template"] = jieqi_path_template("alibank.html", "pay");
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
