<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "yeecard");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
jieqi_loadlang("yeecard", JIEQI_MODULE_NAME);

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
$_REQUEST["cardno"] = (isset($_REQUEST["cardno"]) ? trim($_REQUEST["cardno"]) : "");
$_REQUEST["cardpwd"] = (isset($_REQUEST["cardpwd"]) ? trim($_REQUEST["cardpwd"]) : "");
if (($_REQUEST["act"] == "pay") && (empty($_REQUEST["cardno"]) || empty($_REQUEST["cardpwd"]))) {
	jieqi_printfail($jieqiLang["pay"]["need_card_nopwd"]);
}

$_REQUEST["buyinfo"] = $_REQUEST["cardno"] . "||" . $_REQUEST["cardpwd"];
include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
$messageType = $jieqiPayset[JIEQI_PAY_TYPE]["messageType"];
$p1_MerId = $jieqiPayset[JIEQI_PAY_TYPE]["payid"];
$merchantKey = $jieqiPayset[JIEQI_PAY_TYPE]["paykey"];
$logName = "YeePay_CARD.log";
$reqURL_SNDApro = $jieqiPayset[JIEQI_PAY_TYPE]["payurl"];
require_once ("yeecardcommon.php");
$p2_Order = $paylog->getVar("payid");
$p3_Amt = $_REQUEST["amount"];
$p4_verifyAmt = $jieqiPayset[JIEQI_PAY_TYPE]["verifyAmt"];
$p5_Pid = (empty($jieqiPayset[JIEQI_PAY_TYPE]["productId"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["productId"]);
$p6_Pcat = $jieqiPayset[JIEQI_PAY_TYPE]["productCat"];
$p7_Pdesc = $jieqiPayset[JIEQI_PAY_TYPE]["productDesc"];
$p8_Url = $jieqiPayset[JIEQI_PAY_TYPE]["payreturn"];
$pa_MP = $jieqiPayset[JIEQI_PAY_TYPE]["sMctProperties"];
$pa7_cardAmt = $_REQUEST["amount"];
$pa8_cardNo = $_REQUEST["cardno"];
$pa9_cardPwd = $_REQUEST["cardpwd"];
$pd_FrpId = (trim($_REQUEST["cardtype"]) != "" ? trim($_REQUEST["cardtype"]) : $jieqiPayset[JIEQI_PAY_TYPE]["frpId"]);
$pr_NeedResponse = $jieqiPayset[JIEQI_PAY_TYPE]["needResponse"];
$pz_userId = $jieqiPayset[JIEQI_PAY_TYPE]["pz_userId"];
$pz1_userRegTime = $jieqiPayset[JIEQI_PAY_TYPE]["pz1_userRegTime"];
$ret = annulcard($p2_Order, $p3_Amt, $p4_verifyAmt, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pa7_cardAmt, $pa8_cardNo, $pa9_cardPwd, $pd_FrpId, $pz_userId, $pz1_userRegTime);

if ($ret === true) {
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("jieqi_contents", jieqi_msgbox(LANG_DO_SUCCESS, $jieqiLang["pay"]["request_success"]));
	$jieqiTpl->assign("jumpurl", jieqi_htmlstr($_REQUEST["jumpurl"]));
	$jieqiTpl->setCaching(0);
	include_once jieqi_path_common("footer.php");
}
else {
	jieqi_printfail($ret);
}

?>
