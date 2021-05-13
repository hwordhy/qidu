<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "paypal");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");

if (empty($jieqiPayset[JIEQI_PAY_TYPE]["payid"])) {
	jieqi_printfail($jieqiLang["pay"]["paypal_not_open"]);
}

include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include_once jieqi_path_common("header.php");
include_once jieqi_path_lib("template/template.php");
$jieqiTpl = &JieqiTpl::getInstance();
$jieqiTpl->assign("url_pay", $jieqiPayset[JIEQI_PAY_TYPE]["payurl"]);
$jieqiTpl->assign("buyname", $_SESSION["jieqiUserName"]);
$jieqiTpl->assign("egold", $_REQUEST["egold"]);
$jieqiTpl->assign("egoldname", JIEQI_EGOLD_NAME);
$jieqiTpl->assign("money", $_REQUEST["amount"]);
$orderid = $paylog->getVar("payid");
$jieqiTpl->assign("orderid", $orderid);
$jieqiTpl->assign("cmd", $jieqiPayset[JIEQI_PAY_TYPE]["cmd"]);
$jieqiTpl->assign("business", $jieqiPayset[JIEQI_PAY_TYPE]["payid"]);
$jieqiTpl->assign("item_name", $jieqiPayset[JIEQI_PAY_TYPE]["item_name"]);
$jieqiTpl->assign("charset", $jieqiPayset[JIEQI_PAY_TYPE]["charset"]);
$jieqiTpl->assign("currency_code", $jieqiPayset[JIEQI_PAY_TYPE]["currency_code"]);
$jieqiTpl->assign("amount", $_REQUEST["amount"]);
$jieqiTpl->assign("item_number", $orderid);
$jieqiTpl->assign("custom", $orderid);
$jieqiTpl->assign("notify_url", $jieqiPayset[JIEQI_PAY_TYPE]["paynotify"]);
$jieqiTpl->assign("rm", $jieqiPayset[JIEQI_PAY_TYPE]["rm"]);
$jieqiTpl->assign("return", $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"]);
$jieqiTpl->assign("cancel_return", $jieqiPayset[JIEQI_PAY_TYPE]["cancel_return"]);
$jieqiTpl->assign("no_shipping", $jieqiPayset[JIEQI_PAY_TYPE]["no_shipping"]);
$jieqiTpl->assign("no_note", $jieqiPayset[JIEQI_PAY_TYPE]["no_note"]);
$jieqiTpl->assign("jumpurl", jieqi_htmlstr($_REQUEST["jumpurl"]));

if (is_array($jieqiPayset[JIEQI_PAY_TYPE]["addvars"])) {
	foreach ($jieqiPayset[JIEQI_PAY_TYPE]["addvars"] as $k => $v ) {
		$jieqiTpl->assign($k, $v);
	}
}

$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("paypal.html", "pay");
include_once jieqi_path_common("footer.php");

?>
