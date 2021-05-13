<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "yeecard");
require_once ("../../global.php");
require_once ("yeecardcommon.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
$logflag = (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE) ? 1 : 0);

if ($logflag) {
	$logfile = JIEQI_ROOT_PATH . "/files/pay/log/" . JIEQI_PAY_TYPE . "_return.txt";
	jieqi_checkdir(dirname($logfile), true);
	$log = print_r($_REQUEST, true);
	jieqi_writefile($logfile, $log, "ab");
}

$p1_MerId = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$merchantKey = $jieqiPayset[JIEQI_PAY_TYPE]["paykey"];
$reqURL_SNDApro = $jieqiPayset[JIEQI_PAY_TYPE]["payurl"];
$paytype = JIEQI_PAY_TYPE;
$return = getcallbackvalue($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct, $hmac);
$bRet = checkhmac($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct, $hmac);
include jieqi_path_inc("include/funpay.php", "pay");

if ($bRet) {
	echo "success";

	if ($r1_Code == "1") {
		$payinfo = array("orderid" => intval($p2_Order), "retserialno" => "", "retaccount" => $p5_CardNo, "retinfo" => $p4_FrpId, "return" => true);
		$payret = jieqi_pay_return($payinfo);
		exit();
	}
	else if ($r1_Code == "2") {
		echo "<br>支付失败!";
		echo "<br>商户订单号:" . $p2_Order;
		exit();
	}
}
else {
	$sNewString = getcallbackhmacstring($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct);
	echo "<br>localhost:" . $sNewString;
	echo "<br>YeePay:" . $hmac;
	echo "<br>交易签名无效!";
	exit();
}

?>
