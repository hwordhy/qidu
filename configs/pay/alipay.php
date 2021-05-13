<?php
//支付宝充值相关参数

$jieqiPayset['alipay']['payid'] = '2088531471053274';  //签约的支付宝账号唯一用户号（PID），以2088开头的16位纯数字组成（请输入实际申请的值）

$jieqiPayset['alipay']['paykey'] = 'l0dxmoprfysk88djwjsii4uz381gkpbv';  //通讯密钥值（KEY）（请输入实际申请的值）

$jieqiPayset['alipay']['payurl'] = 'https://mapi.alipay.com/gateway.do';  //提交到支付网站的网址

$jieqiPayset['alipay']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/alipayreturn.php';  //本站接收返回的网址

$jieqiPayset['alipay']['payrate'] = 100; //默认充值1元钱兑换虚拟币的值
$jieqiPayset['alipay']['paycustom'] = 1; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['alipay']['paylimit'] = array('3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500', '100000'=>'1000'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元
$jieqiPayset['alipay']['paydefault'] = '3000'; //默认充值虚拟币


//以下私有参数
$jieqiPayset['alipay']['service'] = 'create_direct_pay_by_user';  //交易类型，无需修改
$jieqiPayset['alipay']['_input_charset'] = 'UTF-8';  //字符集，无需修改
$jieqiPayset['alipay']['subject'] = JIEQI_EGOLD_NAME;  //商品名称（默认显示虚拟币名）
$jieqiPayset['alipay']['body'] = '';  //商品描述，可以留空
$jieqiPayset['alipay']['payment_type'] = '1';  // 商品支付类型 1-商品购买 4-捐赠 47-电子卡券，无需修改
$jieqiPayset['alipay']['show_url'] = JIEQI_LOCAL_URL;  //商品相关网站公司
$jieqiPayset['alipay']['seller_id'] = '';  //卖家支付宝用户号，以2088开头的纯16位数字，默认留空，表示跟上面的签约的支付宝账号相同
$jieqiPayset['alipay']['seller_email'] = '';  //卖家支付宝账号，格式为邮箱或手机号，默认留空，表示跟上面的签约的支付宝账号相同
$jieqiPayset['alipay']['sign_type'] = 'MD5';  //签名方式
$jieqiPayset['alipay']['paymethod'] = ''; //默认支付方式：creditPay=信用支付，directPay-余额支付，可以留空表示默认使用余额支付
$jieqiPayset['alipay']['enable_paymethod'] = ''; //支付渠道，可支持多种支付渠道显示，以“^”分隔，如directPay^bankPay^cartoon^cash（留空默认支持多渠道）
//支付渠道选项  directPay-支付宝账户余额，cartoon-卡通，bankPay-网银，cash-现金，creditCardExpress-信用卡快捷，debitCardExpress-借记卡快捷，coupon-红包

$jieqiPayset['alipay']['notify_url'] = JIEQI_LOCAL_URL.'/modules/pay/alipaynotify.php'; //本站接收异步返回的网址
$jieqiPayset['alipay']['notifycheck'] = 'http://notify.alipay.com/trade/notify_query.do';  //支付宝通知验证网址

$jieqiPayset['alipay']['addvars'] = array();  //附加参数


?>
