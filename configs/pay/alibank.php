<?php
//支付宝网银充值相关参数

$jieqiPayset['alibank']['payid'] = '123456';  //签约的支付宝账号唯一用户号（PID），以2088开头的16位纯数字组成（请输入实际申请的值）

$jieqiPayset['alibank']['paykey'] = '000000';  //通讯密钥值（KEY）（请输入实际申请的值）

$jieqiPayset['alibank']['payurl'] = 'https://mapi.alipay.com/gateway.do';  //提交到支付网站的网址

$jieqiPayset['alibank']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/alibankreturn.php';  //本站接收返回的网址

$jieqiPayset['alibank']['payrate'] = 100; //默认充值1元钱兑换虚拟币的值
$jieqiPayset['alibank']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['alibank']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元
$jieqiPayset['alibank']['paydefault'] = '1000'; //默认充值虚拟币

//以下私有参数
$jieqiPayset['alibank']['service'] = 'create_direct_pay_by_user';  //交易类型，无需修改
$jieqiPayset['alibank']['_input_charset'] = 'GBK';  //字符集，无需修改
$jieqiPayset['alibank']['subject'] = JIEQI_EGOLD_NAME;  //商品名称（默认显示虚拟币名）
$jieqiPayset['alibank']['body'] = '';  //商品描述，可以留空
$jieqiPayset['alibank']['payment_type'] = '1';  // 商品支付类型 1-商品购买 4-捐赠 47-电子卡券，无需修改
$jieqiPayset['alibank']['show_url'] = JIEQI_LOCAL_URL;  //商品相关网站公司
$jieqiPayset['alibank']['seller_id'] = '';  //卖家支付宝用户号，以2088开头的纯16位数字，默认留空，表示跟上面的签约的支付宝账号相同
$jieqiPayset['alibank']['seller_email'] = '';  //卖家支付宝账号，格式为邮箱或手机号，默认留空，表示跟上面的签约的支付宝账号相同
$jieqiPayset['alibank']['sign_type'] = 'MD5';  //签名方式
$jieqiPayset['alibank']['paymethod'] = 'bankPay'; //默认支付方式：bankPay=网银支付，directPay-余额支付，纯网银接口必须使用bankPay
$jieqiPayset['alibank']['defaultbank'] = 'CMB'; //默认网银
/*
银行简码——混合渠道(B2B代表企业银行)
ICBCBTB=中国工商银行（B2B）
ABCBTB=中国农业银行（B2B）
CCBBTB=中国建设银行（B2B）
SPDBB2B=上海浦东发展银行（B2B）
BOCBTB=中国银行（B2B）
CMBBTB=招商银行（B2B）
BOCB2C=中国银行
ICBCB2C=中国工商银行
CMB=招商银行
CCB=中国建设银行
ABC=中国农业银行
SPDB=上海浦东发展银行
CIB=兴业银行
GDB=广发银行
FDB=富滇银行
HZCBB2C=杭州银行
SHBANK=上海银行
NBBANK=宁波银行
SPABANK=平安银行
POSTGC=中国邮政储蓄银行
abc1003=visa
abc1004=master

银行简码——纯借记卡渠道
CMB-DEBIT=招商银行
CCB-DEBIT=中国建设银行
ICBC-DEBIT=中国工商银行
COMM-DEBIT=交通银行
GDB-DEBIT=广发银行
BOC-DEBIT=中国银行
CEB-DEBIT=中国光大银行
SPDB-DEBIT=上海浦东发展银行
PSBC-DEBIT=中国邮政储蓄银行
BJBANK=北京银行
SHRCB=上海农商银行
WZCBB2C-DEBIT=温州银行
COMM=交通银行
CMBC=中国民生银行
BJRCB=北京农村商业银行
SPA-DEBIT=平安银行
CITIC-DEBIT=中信银行

交通银行简码COMM、COMM-DEBIT都代表纯借记卡渠道，二者没有区别，建议使用COMM-DEBIT。
*/

$jieqiPayset['alibank']['notify_url'] = JIEQI_LOCAL_URL.'/modules/pay/alibanknotify.php'; //本站接收异步返回的网址
$jieqiPayset['alibank']['notifycheck'] = 'http://notify.alipay.com/trade/notify_query.do';  //支付宝通知验证网址

$jieqiPayset['alibank']['addvars'] = array();  //附加参数
?>