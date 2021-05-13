<?php

//充值后会员操作设置，可实现充值包月
global $jieqiPayAction;
$jieqiPayAction = array();

//启用包月需要在支付的配置文件中载入 global $jieqiPayaction; include_once __DIR__ . '/payaction.php';
//启用包月需要在模板中插入 <input name="payaction" value="$jieqiPayAction数组下标" ...>
//包月参数 amount - 充值金额（元）， addmonthly - 包几个月，caption - 包月类型标题， default - 是否默认选项(0-否，1-是)
//可选参数 expiretime - 本功能截止时间，留空表示不限制，设置格式为 YYYY-mm-dd HH:ii:ss，比如设置成 '2016-10-10 23:59:59'，表示2016-10-11 00:00:00开始本功能不能使用
//可选参数 denygroup - 禁止使用本功能的用户组，如：array(0,1,2,8,9,10)
//可选参数 updategroup - 充值成功后更新用户组，比如原来用户组ID为2，充值后更新为5，如：array(3=>5, 4=>5, 6=>7)
//可选参数 earnvipvote - 充值赠送月票
//可选参数 earnegold - 充值赠送虚拟币


/*
$jieqiPayAction[1] = array('amount' => 20, 'addmonthly' => 1, 'caption' => '购买1个月VIP阅读', 'default' => 0);
$jieqiPayAction[2] = array('amount' => 60, 'addmonthly' => 3, 'caption' => '购买3个月VIP阅读', 'default' => 1);
$jieqiPayAction[3] = array('amount' => 120, 'addmonthly' => 6, 'caption' => '购买6个月VIP阅读', 'default' => 0);
$jieqiPayAction[4] = array('amount' => 240, 'addmonthly' => 12, 'caption' => '购买12个月VIP阅读', 'default' => 0);
*/

