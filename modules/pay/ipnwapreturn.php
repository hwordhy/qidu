<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "ipnwap");
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

if (empty($_GET) || !isset($_GET["funcode"]) || !isset($_GET["appId"]) || !isset($_GET["mhtOrderNo"]) || !isset($_GET["tradeStatus"]) || !isset($_GET["signature"]) || ($_GET["funcode"] != "N002") || ($_GET["appId"] != $jieqiPayset[JIEQI_PAY_TYPE]["payid"])) {
	jieqi_printfail($jieqiLang["pay"]["pay_return_error"]);
}

include jieqi_path_inc("include/funpay.php", "pay");
include jieqi_path_inc("include/funipaynow.php", "pay");

if ($_GET["tradeStatus"] != "A001") {
	jieqi_printfail($jieqiLang["pay"]["pay_return_error"]);
}

$sign_new = jieqi_pay_makesign($_GET, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);

if (strtolower($_GET["signature"]) == strtolower($sign_new)) {
	$payinfo = array("orderid" => intval($_GET["mhtOrderNo"]), "retserialno" => "", "retaccount" => "", "retinfo" => "", "return" => false);

	if (isset($_GET["nowPayOrderNo"])) {
		$payinfo["retserialno"] = $_GET["nowPayOrderNo"];
	}

	if (isset($_GET["payChannelType"])) {
		$payinfo["retaccount"] = $_GET["payChannelType"];
	}

	if (isset($_GET["channelOrderNo"])) {
		$payinfo["retinfo"] = $_GET["channelOrderNo"];
	}

	jieqi_pay_return($payinfo);
}
else {
	jieqi_printfail($jieqiLang["pay"]["return_checkcode_error"]);
}

?>
