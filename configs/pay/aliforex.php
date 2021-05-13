<?php
//支付宝境外充值相关参数

$jieqiPayset['aliforex']['payid'] = '000000';  //签约的支付宝账号唯一用户号（PID）（请输入实际申请的值）

$jieqiPayset['aliforex']['paykey'] = '000000';  //通讯密钥值（KEY）（请输入实际申请的值）

$jieqiPayset['aliforex']['payurl'] = 'https://mapi.alipay.com/gateway.do';  //提交到支付网站的网址

$jieqiPayset['aliforex']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/aliforexreturn.php';  //本站接收返回的网址

$jieqiPayset['aliforex']['payrate'] = 100; //默认充值1元钱兑换虚拟币的值
$jieqiPayset['aliforex']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['aliforex']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元
$jieqiPayset['aliforex']['paydefault'] = '1000'; //默认充值虚拟币

//以下私有参数
$jieqiPayset['aliforex']['service'] = 'create_forex_trade';  //交易类型 create_direct_pay_by_user 即时到帐，create_forex_trade 境外收款
$jieqiPayset['aliforex']['_input_charset'] = 'GBK';  //字符集
$jieqiPayset['aliforex']['subject'] = JIEQI_EGOLD_NAME;  //商品名称（默认显示虚拟币名）
$jieqiPayset['aliforex']['body'] = '';  //商品描述，可以留空
$jieqiPayset['aliforex']['currency'] = 'USD'; // 货币类型 
//GBP 英镑,HKD 港币,USD 美元,CHF 瑞士法郎,SGD 新加坡元,SEK 瑞典克朗,DKK 丹麦克朗,NOK 挪威克朗,JPY 日元,CAD 加拿大元,AUD 澳大利亚元,EUR 欧元,NZD 新西兰元,RUB 俄罗斯卢布,MOP 澳门元
$jieqiPayset['aliforex']['payrmb'] = '0'; // 是否使用人民币金额，0-使用以上货币金额，1-使用人民币金额
$jieqiPayset['aliforex']['timeout_rule'] = ''; //交易超时规则 可选值有 5m 10m 15m 30m 1h 2h 3h 5h 10h 12h。 （忽略大小写）默认为12h

$jieqiPayset['aliforex']['specified_pay_channel'] = 'debitcard-cmb-mb2c'; //网银前置,可留空
//中国银行 debitcard-boc-mb2c, 中国建设银行 debitcard-ccb-mb2c,中国光大银行 debitcard-ceb-mb2c, 兴业银行 debitcard-cib-mb2c,中信银行 debitcard-citic-mb2c, 招商银行 debitcard-cmb-mb2c, 交通银行 debitcard-comm-mb2c, 广东发展银行, debitcard-gdb-mb2c, 杭州银行 debitcard-hzcb-mb2c, 中国工商银行 debitcard-icbc-mb2c, 宁波银行 debitcard-nbbank-mb2c, 深圳发展银行 debitcard-sdb-mb2c, 上海银行 debitcard-shbank-mb2c, 上海浦东发展银行 debitcard-spdb-mb2c

//$jieqiPayset['aliforex']['payment_type'] = '1';  // 商品支付类型 1＝商品购买 2＝服务购买 3＝网络拍卖 4＝捐赠 5＝邮费补偿 6＝奖金
//$jieqiPayset['aliforex']['show_url'] = JIEQI_LOCAL_URL;  //商品相关网站公司
//$jieqiPayset['aliforex']['seller_email'] = 'neleta320@gmail.com';  //卖家邮箱，必须填写
$jieqiPayset['aliforex']['sign_type'] = 'MD5';  //签名方式

$jieqiPayset['aliforex']['notify_url'] = JIEQI_LOCAL_URL.'/modules/pay/aliforexnotify.php'; //本站接收异步返回的网址
$jieqiPayset['aliforex']['notifycheck'] = 'http://notify.alipay.com/trade/notify_query.do';  //支付宝通知验证网址

$jieqiPayset['aliforex']['addvars'] = array();  //附加参数
?>