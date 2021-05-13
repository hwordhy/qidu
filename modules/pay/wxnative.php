<?php

@define("JIEQI_MODULE_NAME", "pay");
@define("JIEQI_PAY_TYPE", "wxnative");
require_once ("../../global.php");
jieqi_loadlang("pay", "pay");

if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang["pay"]["need_login"]);
}

jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
include jieqi_path_inc("include/funpay.php", "pay");
$paylog = jieqi_pay_start();
include_once jieqi_path_lib("WxPay/WxPay.Api.php");
include_once jieqi_path_lib("WxPay/WxPay.NativePay.php");
include_once jieqi_path_inc("wxpaylog.php", "pay");
$out_trade_no = $paylog->getVar("payid");

if (strlen($out_trade_no) < 2) {
	$out_trade_no = "0" . $out_trade_no;
}

$notify = new NativePay();
$input = new WxPayUnifiedOrder();
$tmpvar = (empty($jieqiPayset[JIEQI_PAY_TYPE]["body"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["body"]);
$tmpvar = jieqi_charsetconvert($tmpvar, JIEQI_SYSTEM_CHARSET, "utf-8");
$input->SetBody($tmpvar);
$input->SetAttach("");
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($_REQUEST["money"]);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("");
$input->SetNotify_url(JIEQI_LOCAL_URL . "/modules/pay/wxnativenotify.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("egold_" . $_REQUEST["money"]);
$result = $notify->GetPayUrl($input);

if ($result["return_code"] == "FAIL") {
	jieqi_printfail($result["return_msg"]);
}
else {
	$url_qrcode = $result["code_url"];
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("buyname", $_SESSION["jieqiUserName"]);
	$jieqiTpl->assign("egold", $_REQUEST["egold"]);
	$jieqiTpl->assign("money", $_REQUEST["amount"]);
	$jieqiTpl->assign("url_qrcode", $url_qrcode);
	$subject = (empty($jieqiPayset[JIEQI_PAY_TYPE]["subject"]) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]["subject"]);
	$jieqiTpl->assign("subject", $subject);
	$jieqiTpl->assign("jumpurl", jieqi_htmlstr($_REQUEST["jumpurl"]));
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("wxnative.html", "pay");
//    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//        $success = ($result["result_code"] == "FAIL") ? false : true;
//        echo json_encode(array("success" => $success, "data" => $result, "message" => '获取成功'));
//        return false;
//
//    }
    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '' && isset($url_qrcode)) {
        echo json_encode(array("success"=>true, "msg"=>'', "obj"=>$url_qrcode));
        return false;
    }
    else{
        echo json_encode(array("success"=>false, "msg"=>$result["err_code_des"]));
        return false;
    }
	$jieqiTpl->setCaching(0);
	include_once jieqi_path_common("footer.php");
}

?>
