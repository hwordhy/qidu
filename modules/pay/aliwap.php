<?php

@define("JIEQI_MODULE_NAME", "pay");
@define("JIEQI_PAY_TYPE", "aliwap");
require_once ("../../global.php");
jieqi_loadlang("pay", "pay");

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include jieqi_path_inc("include/funalipay.php", "pay");

if ($jieqi_charset_map[JIEQI_SYSTEM_CHARSET] != "utf8") {
	include_once jieqi_path_inc("include/changecode.php", "system");
	$charset_convert_payin = "jieqi_" . $jieqi_charset_map["utf8"] . "2" . $jieqi_charset_map[JIEQI_SYSTEM_CHARSET];
	$charset_convert_payout = "jieqi_" . $jieqi_charset_map[JIEQI_SYSTEM_CHARSET] . "2" . $jieqi_charset_map["utf8"];
}

$payvars = array();
$payvars["service"] = $jieqiPayset[JIEQI_PAY_TYPE]["service_auth"];
$payvars["format"] = $jieqiPayset[JIEQI_PAY_TYPE]["format"];
$payvars["v"] = $jieqiPayset[JIEQI_PAY_TYPE]["v"];
$payvars["partner"] = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$payvars["req_id"] = $paylog->getVar("payid");
$payvars["sec_id"] = $jieqiPayset[JIEQI_PAY_TYPE]["sec_id"];
$payvars["_input_charset"] = $jieqiPayset[JIEQI_PAY_TYPE]["_input_charset"];
$reqvars = array();
$reqvars["notify_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["notify_url"];
$reqvars["call_back_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"];
$reqvars["seller_account_name"] = $jieqiPayset[JIEQI_PAY_TYPE]["seller_email"];
$reqvars["out_trade_no"] = $paylog->getVar("payid");
$reqvars["subject"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["subject"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["subject"]);
if (($jieqiPayset[JIEQI_PAY_TYPE]["_input_charset"] == "utf-8") && ($jieqi_charset_map[JIEQI_SYSTEM_CHARSET] != "utf8")) {
	$reqvars["subject"] = $charset_convert_payout($reqvars["subject"]);
}

$reqvars["total_fee"] = $_REQUEST["amount"];
$reqvars["merchant_url"] = $jieqiPayset[JIEQI_PAY_TYPE]["merchant_url"];
$reqvars = jieqi_funtoarray("jieqi_pay_xmltext", $reqvars);
$payvars["req_data"] = "<direct_trade_create_req>";

foreach ($reqvars as $k => $v ) {
	$payvars["req_data"] .= "<$k>$v</$k>";
}

$payvars["req_data"] .= "</direct_trade_create_req>";
$sign = jieqi_pay_makesign($payvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);
$query = $jieqiPayset[JIEQI_PAY_TYPE]["payurl"] . "?" . jieqi_pay_makequery($payvars, true) . "&sign=" . urldecode($sign);
$auth_ret = file_get_contents($query);

if (!$auth_ret) {
	jieqi_printfail($jieqiLang["pay"]["pay_request_error"]);
}

$auth_ary = jieqi_pay_parseres($auth_ret);

if (empty($auth_ary["request_token"]) && !empty($auth_ary["res_error"])) {
	if ($jieqi_charset_map[JIEQI_SYSTEM_CHARSET] != "utf8") {
		$auth_ary = &jieqi_funtoarray($charset_convert_payin, $auth_ary);
	}

	jieqi_printfail($auth_ary["res_error"]);
}

$request_token = $auth_ary["request_token"];

$payvars["req_data"] = "<auth_and_execute_req><request_token>" . $request_token . "</request_token></auth_and_execute_req>";
$payvars["service"] = $jieqiPayset[JIEQI_PAY_TYPE]["service_trade"];
$sign = jieqi_pay_makesign($payvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);
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
$jieqiTset["jieqi_page_template"] = jieqi_path_template("aliwap.html", "pay");
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
