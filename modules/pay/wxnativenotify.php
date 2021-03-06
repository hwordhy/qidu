<?php

define("JIEQI_MODULE_NAME", "pay");
define("JIEQI_PAY_TYPE", "wxnative");
require_once ("../../global.php");
jieqi_loadlang("pay", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, "jieqiPayset");
$logflag = (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE) ? 1 : 0);
include_once jieqi_path_lib("WxPay/WxPay.Api.php");
include_once jieqi_path_lib("WxPay/WxPay.Notify.php");
include_once jieqi_path_inc("wxpaylog.php", "pay");

if ($logflag) {
	$logHandler = new CLogFileHandler(JIEQI_ROOT_PATH . "/files/pay/log/" . JIEQI_PAY_TYPE . "_notify.txt");
	$log = Log::Init($logHandler, 15);
}
class PayNotifyCallBack extends WxPayNotify
{
	public function Queryorder($transaction_id)
	{
		global $logflag;
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);

		if ($logflag) {
			Log::DEBUG("query:" . json_encode($result));
		}

		if (array_key_exists("return_code", $result) && array_key_exists("result_code", $result) && ($result["return_code"] == "SUCCESS") && ($result["result_code"] == "SUCCESS")) {
			return true;
		}

		return false;
	}

	public function NotifyProcess($data, &$msg)
	{
		global $logflag;
		global $jieqiModules;
		global $jieqiPayset;
		global $jieqiLang;

		if ($logflag) {
			Log::DEBUG("call back:" . json_encode($data));
		}

		if (!array_key_exists("transaction_id", $data)) {
			$msg = "输入参数不正确";

			if ($logflag) {
				Log::DEBUG($msg);
			}

			return false;
		}

		if (!$this->Queryorder($data["transaction_id"])) {
			$msg = "订单查询失败";

			if ($logflag) {
				Log::DEBUG($msg);
			}

			return false;
		}

		if ($logflag) {
			Log::DEBUG("seart db process with payid=" . $data["out_trade_no"]);
		}

		include jieqi_path_inc("include/funpay.php", "pay");
		$payinfo = array("orderid" => intval($data["out_trade_no"]), "retserialno" => $data["transaction_id"], "retaccount" => $data["openid"], "retinfo" => $data["is_subscribe"], "return" => true);
		$payret = jieqi_pay_return($payinfo);

		switch ($payret) {
		case -1:
			$msg = "充值记录不存在";

			if ($logflag) {
				Log::DEBUG($msg);
			}

			return false;
			break;

		case -2:
			$msg = "保存充值记录失败";

			if ($logflag) {
				Log::DEBUG($msg);
			}

			return false;
			break;

		case 2:
			if ($logflag) {
				Log::DEBUG("already success with payid=" . $data["out_trade_no"]);
			}

			break;

		case 1:
		default:
			if ($logflag) {
				Log::DEBUG("pay success with payid=" . $data["out_trade_no"]);
			}

			break;
		}

		return true;
	}
}


if ($logflag) {
	Log::DEBUG("begin notify");
}

$notify = new PayNotifyCallBack();
$notify->Handle(false);

?>
