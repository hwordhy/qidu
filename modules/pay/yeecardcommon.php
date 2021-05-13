<?php

function getReqHmacString($p0_Cmd, $p2_Order, $p3_Amt, $p4_verifyAmt, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pa7_cardAmt, $pa8_cardNo, $pa9_cardPwd, $pd_FrpId, $pr_NeedResponse, $pz_userId, $pz1_userRegTime)
{
	global $p1_MerId;
	global $merchantKey;
	global $logName;
	global $reqURL_SNDApro;
	$sbOld = "";
	$sbOld = $sbOld . $p0_Cmd;
	$sbOld = $sbOld . $p1_MerId;
	$sbOld = $sbOld . $p2_Order;
	$sbOld = $sbOld . $p3_Amt;
	$sbOld = $sbOld . $p4_verifyAmt;
	$sbOld = $sbOld . $p5_Pid;
	$sbOld = $sbOld . $p6_Pcat;
	$sbOld = $sbOld . $p7_Pdesc;
	$sbOld = $sbOld . $p8_Url;
	$sbOld = $sbOld . $pa_MP;
	$sbOld = $sbOld . $pa7_cardAmt;
	$sbOld = $sbOld . $pa8_cardNo;
	$sbOld = $sbOld . $pa9_cardPwd;
	$sbOld = $sbOld . $pd_FrpId;
	$sbOld = $sbOld . $pr_NeedResponse;
	$sbOld = $sbOld . $pz_userId;
	$sbOld = $sbOld . $pz1_userRegTime;
	logstr($p2_Order, $sbOld, hmacmd5($sbOld, $merchantKey), $merchantKey);
	return hmacmd5($sbOld, $merchantKey);
}

function annulCard($p2_Order, $p3_Amt, $p4_verifyAmt, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pa7_cardAmt, $pa8_cardNo, $pa9_cardPwd, $pd_FrpId, $pz_userId, $pz1_userRegTime)
{
	global $p1_MerId;
	global $merchantKey;
	global $logName;
	global $reqURL_SNDApro;
	global $jieqiLang;
	include_once ("HttpClient.class.php");
	$p0_Cmd = "ChargeCardDirect";
	$pr_NeedResponse = "1";
	$hmac = getreqhmacstring($p0_Cmd, $p2_Order, $p3_Amt, $p4_verifyAmt, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pa7_cardAmt, $pa8_cardNo, $pa9_cardPwd, $pd_FrpId, $pr_NeedResponse, $pz_userId, $pz1_userRegTime);
	$params = array("p0_Cmd" => $p0_Cmd, "p1_MerId" => $p1_MerId, "p2_Order" => $p2_Order, "p3_Amt" => $p3_Amt, "p4_verifyAmt" => $p4_verifyAmt, "p5_Pid" => $p5_Pid, "p6_Pcat" => $p6_Pcat, "p7_Pdesc" => $p7_Pdesc, "p8_Url" => $p8_Url, "pa_MP" => $pa_MP, "pa7_cardAmt" => $pa7_cardAmt, "pa8_cardNo" => $pa8_cardNo, "pa9_cardPwd" => $pa9_cardPwd, "pd_FrpId" => $pd_FrpId, "pr_NeedResponse" => $pr_NeedResponse, "hmac" => $hmac, "pz_userId" => $pz_userId, "pz1_userRegTime" => $pz1_userRegTime);
	$pageContents = HttpClient::quickPost($reqURL_SNDApro, $params);
	$result = explode("\n", $pageContents);
	$r0_Cmd = "";
	$r1_Code = "";
	$r2_TrxId = "";
	$r6_Order = "";
	$rq_ReturnMsg = "";
	$hmac = "";
	$unkonw = "";

	for ($index = 0; $index < jieqi_count($result); $index++) {
		$result[$index] = trim($result[$index]);

		if (strlen($result[$index]) == 0) {
			continue;
		}

		$aryReturn = explode("=", $result[$index]);
		$sKey = $aryReturn[0];
		$sValue = $aryReturn[1];

		if ($sKey == "r0_Cmd") {
			$r0_Cmd = $sValue;
		}
		else if ($sKey == "r1_Code") {
			$r1_Code = $sValue;
		}
		else if ($sKey == "r2_TrxId") {
			$r2_TrxId = $sValue;
		}
		else if ($sKey == "r6_Order") {
			$r6_Order = $sValue;
		}
		else if ($sKey == "rq_ReturnMsg") {
			$rq_ReturnMsg = $sValue;
		}
		else if ($sKey == "hmac") {
			$hmac = $sValue;
		}
	}

	$sbOld = "";
	$sbOld = $sbOld . $r0_Cmd;
	$sbOld = $sbOld . $r1_Code;
	$sbOld = $sbOld . $r6_Order;
	$sbOld = $sbOld . $rq_ReturnMsg;
	$sNewString = hmacmd5($sbOld, $merchantKey);
	logstr($r6_Order, $sbOld, hmacmd5($sbOld, $merchantKey), $merchantKey);

	if ($sNewString == $hmac) {
		if ($r1_Code == "1") {
			return true;
		}
		else {
			if (($r1_Code == "2") || ($r1_Code == "7")) {
				return $jieqiLang["pay"]["error_cardpwd"];
			}
			else if ($r1_Code == "11") {
				return $jieqiLang["pay"]["orderid_repeat"];
			}
			else if ($r1_Code == "66") {
				return $jieqiLang["pay"]["error_money"];
			}
			else {
				if (($r1_Code == "95") || ($r1_Code == "112")) {
					return $jieqiLang["pay"]["paytype_notallow"];
				}
				else {
					return $jieqiLang["pay"]["pay_failure"];
				}
			}
		}
	}
	else {
		return $jieqiLang["pay"]["error_sign"];
	}
}

function generationTestCallback($p2_Order, $p3_Amt, $p8_Url, $pa7_cardNo, $pa8_cardPwd, $pa_MP, $pz_userId, $pz1_userRegTime)
{
	global $p1_MerId;
	global $merchantKey;
	global $logName;
	global $reqURL_SNDApro;
	include_once ("HttpClient.class.php");
	$p0_Cmd = "AnnulCard";
	$pr_NeedResponse = "1";
	$reqURL_SNDApro = "http://tech.yeepay.com:8080/robot/generationCallback.action";
	$params = array("p0_Cmd" => $p0_Cmd, "p1_MerId" => $p1_MerId, "p2_Order" => $p2_Order, "p3_Amt" => $p3_Amt, "p8_Url" => $p8_Url, "pa7_cardNo" => $pa7_cardNo, "pa8_cardPwd" => $pa8_cardPwd, "pd_FrpId" => $pd_FrpId, "pr_NeedResponse" => $pr_NeedResponse, "pa_MP" => $pa_MP, "pz_userId" => $pz_userId, "pz1_userRegTime" => $pz1_userRegTime);
	$pageContents = HttpClient::quickPost($reqURL_SNDApro, $params);
	return $pageContents;
}

function getCallbackHmacString($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct)
{
	global $p1_MerId;
	global $merchantKey;
	global $logName;
	global $reqURL_SNDApro;
	$sbOld = "";
	$sbOld = $sbOld . $r0_Cmd;
	$sbOld = $sbOld . $r1_Code;
	$sbOld = $sbOld . $p1_MerId;
	$sbOld = $sbOld . $p2_Order;
	$sbOld = $sbOld . $p3_Amt;
	$sbOld = $sbOld . $p4_FrpId;
	$sbOld = $sbOld . $p5_CardNo;
	$sbOld = $sbOld . $p6_confirmAmount;
	$sbOld = $sbOld . $p7_realAmount;
	$sbOld = $sbOld . $p8_cardStatus;
	$sbOld = $sbOld . $p9_MP;
	$sbOld = $sbOld . $pb_BalanceAmt;
	$sbOld = $sbOld . $pc_BalanceAct;
	logstr($p2_Order, $sbOld, hmacmd5($sbOld, $merchantKey), $merchantKey);
	return hmacmd5($sbOld, $merchantKey);
}

function getCallBackValue(&$r0_Cmd, &$r1_Code, &$p1_MerId, &$p2_Order, &$p3_Amt, &$p4_FrpId, &$p5_CardNo, &$p6_confirmAmount, &$p7_realAmount, &$p8_cardStatus, &$p9_MP, &$pb_BalanceAmt, &$pc_BalanceAct, &$hmac)
{
	$r0_Cmd = $_REQUEST["r0_Cmd"];
	$r1_Code = $_REQUEST["r1_Code"];
	$p1_MerId = $_REQUEST["p1_MerId"];
	$p2_Order = $_REQUEST["p2_Order"];
	$p3_Amt = $_REQUEST["p3_Amt"];
	$p4_FrpId = $_REQUEST["p4_FrpId"];
	$p5_CardNo = $_REQUEST["p5_CardNo"];
	$p6_confirmAmount = $_REQUEST["p6_confirmAmount"];
	$p7_realAmount = $_REQUEST["p7_realAmount"];
	$p8_cardStatus = $_REQUEST["p8_cardStatus"];
	$p9_MP = $_REQUEST["p9_MP"];
	$pb_BalanceAmt = $_REQUEST["pb_BalanceAmt"];
	$pc_BalanceAct = $_REQUEST["pc_BalanceAct"];
	$hmac = $_REQUEST["hmac"];
	return NULL;
}

function CheckHmac($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct, $hmac)
{
	if ($hmac == getcallbackhmacstring($r0_Cmd, $r1_Code, $p1_MerId, $p2_Order, $p3_Amt, $p4_FrpId, $p5_CardNo, $p6_confirmAmount, $p7_realAmount, $p8_cardStatus, $p9_MP, $pb_BalanceAmt, $pc_BalanceAct)) {
		return true;
	}
	else {
		return false;
	}
}

function HmacMd5($data, $key)
{
	$key = iconv("GBK", "UTF-8", $key);
	$data = iconv("GBK", "UTF-8", $data);
	$b = 64;

	if ($b < strlen($key)) {
		$key = pack("H*", md5($key));
	}

	$key = str_pad($key, $b, chr(0));
	$ipad = str_pad("", $b, chr(54));
	$opad = str_pad("", $b, chr(92));
	$k_ipad = $key ^ $ipad;
	$k_opad = $key ^ $opad;
	return md5($k_opad . pack("H*", md5($k_ipad . $data)));
}

function logstr($orderid, $str, $hmac, $keyValue)
{
}

function arrToString($arr, $Separators)
{
	$returnString = "";

	foreach ($arr as $value ) {
		$returnString = $returnString . $value . $Separators;
	}

	return substr($returnString, 0, strlen($returnString) - strlen($Separators));
}

function arrToStringDefault($arr)
{
	return arrtostring($arr, ",");
}

echo " ";

?>
