<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "alibank");
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
if (!empty($_POST["notify_id"]) && !empty($_POST["buyer_email"]) && !empty($_POST["out_trade_no"])) {
	$getvars = $_POST;
	echo "success";
}
else {
	echo "fail";
	exit();
}

if ((strtoupper($getvars["trade_status"]) != "TRADE_FINISHED") && (strtoupper($getvars["trade_status"]) != "TRADE_SUCCESS")) {
	exit();
}

include jieqi_path_inc("include/funpay.php", "pay");
include jieqi_path_inc("include/funalipay.php", "pay");
$sign_new = jieqi_pay_makesign($getvars, $jieqiPayset[JIEQI_PAY_TYPE]["paykey"]);

if (strtolower($getvars["sign"]) == strtolower($sign_new)) {
	$payinfo = array("orderid" => intval($getvars["out_trade_no"]), "retserialno" => $getvars["trade_no"], "retaccount" => $getvars["buyer_email"], "retinfo" => $getvars["buyer_id"], "return" => true);
	jieqi_pay_return($payinfo);
}

?>
