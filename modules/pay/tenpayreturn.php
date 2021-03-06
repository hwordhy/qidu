<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "tenpay");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
$logflag = (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE) ? 1 : 0);

if ($logflag) {
	$logfile = JIEQI_ROOT_PATH . "/files/pay/log/" . JIEQI_PAY_TYPE . "_return.txt";
	jieqi_checkdir(dirname($logfile), true);
	$log = print_r($_REQUEST, true);
	jieqi_writefile($logfile, $log, "ab");
}

$payid = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$payvars = array();

foreach ($_GET as $k => $v ) {
	$payvars[$k] = $v;
}

foreach ($_POST as $k => $v ) {
	$payvars[$k] = $v;
}

ksort($payvars);
$sign = "";

foreach ($payvars as $k => $v ) {
	if (($k != "sign") && (0 < strlen($v))) {
		$sign .= $k . "=" . $v . "&";
	}
}

$sign = strtoupper(md5($sign . "key=" . $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]));
$partner = $payvars["partner"];
$notify_id = $payvars["notify_id"];
$out_trade_no = $payvars["out_trade_no"];
$transaction_id = $payvars["transaction_id"];
$total_fee = $payvars["total_fee"];
$discount = $payvars["discount"];
$trade_state = $payvars["trade_state"];
$trade_mode = $payvars["trade_mode"];

if (strtoupper($payvars["sign"]) != strtoupper($sign)) {
	jieqi_printfail($jieqiLang["pay"]["return_checkcode_error"]);
}
else if ($partner != $jieqiPayset[JIEQI_PAY_TYPE]["payid"]) {
	jieqi_printfail($jieqiLang["pay"]["customer_id_error"]);
}
else if ($trade_state != "0") {
	jieqi_printfail($jieqiLang["pay"]["pay_return_error"]);
}
else {
	include jieqi_path_inc("include/funpay.php", "pay");
	$payinfo = array("orderid" => intval($out_trade_no), "retserialno" => $transaction_id, "retaccount" => $notify_id, "retinfo" => $total_fee, "return" => false);
	jieqi_pay_return($payinfo);
}

?>
