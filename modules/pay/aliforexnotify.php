<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "aliforex");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
$logflag = (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE) ? 1 : 0);

if ($logflag) {
	$logfile = JIEQI_ROOT_PATH . "/files/pay/log/" . JIEQI_PAY_TYPE . "_notify.txt";
	jieqi_checkdir(dirname($logfile), true);
	$log = print_r($_REQUEST, true);
	jieqi_writefile($logfile, $log, "ab");
}

$mymerchant_id = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$key = $jieqiPayset[JIEQI_PAY_TYPE]["paykey"];
if (!empty($_POST["notify_id"]) && !empty($_POST["trade_status"]) && !empty($_POST["out_trade_no"])) {
	$getvars = $_POST;
	$showmode = 0;
	echo "success";
}
else {
	echo "fail";
	exit();
}

if ((strtoupper($getvars["trade_status"]) != "TRADE_FINISHED") && (strtoupper($getvars["trade_status"]) != "TRADE_SUCCESS")) {
	if ($showmode) {
		jieqi_printfail($jieqiLang["pay"]["pay_return_error"] . "<br /><br />RETCODE:" . $getvars["trade_status"]);
	}
	else {
		exit();
	}
}

include jieqi_path_inc("include/funpay.php", "pay");
include jieqi_path_inc("include/funalipay.php", "pay");
$sign_new = jieqi_pay_makesign($getvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);

if (strtolower($getvars["sign"]) == strtolower($sign_new)) {
	$payinfo = array("orderid" => intval($getvars["out_trade_no"]), "retserialno" => $getvars["trade_no"], "retaccount" => "", "retinfo" => $getvars["total_fee"], "return" => true);
	jieqi_pay_return($payinfo);
}

?>
