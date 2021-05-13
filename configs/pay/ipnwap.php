<?php
//现在支付手机网页版充值相关参数

$jieqiPayset['ipnwap']['payid'] = '000000';  //签约的现在支付账号唯一用户号（PID），以2088开头的16位纯数字组成（请输入实际申请的值）

$jieqiPayset['ipnwap']['paykey'] = '111111';  //通讯密钥值（KEY）（请输入实际申请的值）

$jieqiPayset['ipnwap']['payurl'] = 'http://api.ipaynow.cn';  //提交到支付网站的网址

$jieqiPayset['ipnwap']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/ipnwapreturn.php';  //本站接收返回的网址
$jieqiPayset['ipnwap']['paynotify'] = JIEQI_LOCAL_URL.'/modules/pay/ipnwapnotify.php'; //本站接收异步返回的网址

$jieqiPayset['ipnwap']['payrate'] = 100; //默认充值1元钱兑换虚拟币的值
$jieqiPayset['ipnwap']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['ipnwap']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元
$jieqiPayset['ipnwap']['paydefault'] = '1000'; //默认充值虚拟币

//以下私有参数
$jieqiPayset['ipnwap']['funcode'] = 'WP001';  //固定值
$jieqiPayset['ipnwap']['mhtOrderName'] = JIEQI_EGOLD_NAME;  //商品名称，默认用虚拟币名
$jieqiPayset['ipnwap']['mhtOrderType'] = '01';  //商户交易类型 01普通消费
$jieqiPayset['ipnwap']['mhtCurrencyType'] = '156';  //商户订单币种类型  156人民币
$jieqiPayset['ipnwap']['mhtOrderDetail'] = '您选择了充值%s'.JIEQI_EGOLD_NAME.'（%s元）';  //商户订单详情
$jieqiPayset['ipnwap']['mhtOrderTimeOut'] = '3600';  //商户订单超时时间 3600 秒，默认3600
$jieqiPayset['ipnwap']['mhtCharset'] = 'UTF-8';  //商户字符编码，目前只能用 UTF-8
$jieqiPayset['ipnwap']['deviceType'] = '06';  //设备类型 06-手机网  02-电脑
$jieqiPayset['ipnwap']['payChannelType'] = '';  //用户所选渠道类型 11银联 12支付宝 13微信 25手Q，留空表示下一步选择
$jieqiPayset['ipnwap']['mhtReserved'] = '';  //商户保留域 使用的字段，商户可以对交易进行标记，现在支付将原样返回
$jieqiPayset['ipnwap']['mhtSignType'] = 'MD5';  //商户签名方法 MD5


$jieqiPayset['ipnwap']['addvars'] = array();  //附加参数
?>