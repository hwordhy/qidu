<?php
//财付通支付相关参数

$jieqiPayset['tenpay']['payid'] = '123456'; //商户编号

$jieqiPayset['tenpay']['paykey'] = '000000'; //密钥值

$jieqiPayset['tenpay']['payurl'] = 'https://gw.tenpay.com/gateway/pay.htm'; //提交到对方的网址

$jieqiPayset['tenpay']['payreturn'] = JIEQI_LOCAL_URL . '/modules/pay/tenpayreturn.php'; //本站接收返回的网址

$jieqiPayset['tenpay']['paylimit'] = array('1000' => '10', '2000' => '20', '3000' => '30', '5000' => '50', '10000' => '100'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元
$jieqiPayset['tenpay']['paydefault'] = '1000'; //默认充值虚拟币

$jieqiPayset['tenpay']['moneytype'] = '0'; //金额类型：0-人民币 1-美元

$jieqiPayset['tenpay']['paysilver'] = '0'; //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

$jieqiPayset['tenpay']['paynotify'] = JIEQI_LOCAL_URL . '/modules/pay/tenpaynotify.php'; //本站接受支付结果通知网址

$jieqiPayset['tenpay']['payverify'] = 'https://gw.tenpay.com/gateway/simpleverifynotifyid.xml'; //通知信息验证网址

$jieqiPayset['tenpay']['sign_type'] = 'MD5'; //签名类型，取值：MD5、RSA，默认：MD5

$jieqiPayset['tenpay']['service_version'] = '1.0'; //版本号，默认为1.0

$jieqiPayset['tenpay']['input_charset'] = 'GBK'; //字符编码,取值：GBK、UTF-8，默认：GBK。

$jieqiPayset['tenpay']['sign_key_index'] = '1'; //多密钥支持的密钥序号，默认1

$jieqiPayset['tenpay']['bank_type'] = 'DEFAULT'; //银行类型，默认为“DEFAULT”－财付通支付中心。银行直连编码及额度请与技术支持联系 交易模式为中介担保时此参数无效


$jieqiPayset['tenpay']['attach'] = ''; //附加数据，原样返回

$jieqiPayset['tenpay']['fee_type'] = '1'; //现金支付币种,取值：1（人民币）,默认值是1，暂只支持1

$jieqiPayset['tenpay']['trade_mode'] = '1'; //交易模式:1即时到账(默认) 2中介担保 3后台选择（买家进支付中心列表选择）

$jieqiPayset['tenpay']['trans_type'] = '2'; //交易类型：1、实物交易 2、虚拟交易 交易模式为中介担保时此参数有效

$jieqiPayset['tenpay']['addvars'] = array(); //附加参数
?>