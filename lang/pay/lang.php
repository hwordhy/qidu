<?php

$jieqiLang["pay"]["egold"] = 1;
$jieqiLang["pay"]["change_egold_title"] = "手工充值虚拟币";
$jieqiLang["pay"]["change_egold_userid"] = "用户ID";
$jieqiLang["pay"]["change_egold_username"] = "用户名";
$jieqiLang["pay"]["add_egold_label"] = "增加虚拟币";
$jieqiLang["pay"]["add_egold_desc"] = "<br />只能输入整数，比如：123 表示增加123点虚拟币，-123 表示扣除123点虚拟币";
$jieqiLang["pay"]["change_egold_success"] = "修改用户 [%s] 的虚拟币成功！<br />系统将自动跳转到用户信息页面。";
$jieqiLang["pay"]["change_egold_failure"] = "修改用户[%s]的虚拟币失败！";
$jieqiLang["pay"]["change_egold_notenough"] = "对不起，该用户虚拟币余额不足！";
$jieqiLang["pay"]["mreport"] = 1;
$jieqiLang["pay"]["mreport_allow_premonth"] = "您选择的年月不对，只允许生成本月之前的统计报表！";
$jieqiLang["pay"]["mreport_already_make"] = "%s这个月的报表已经生成过，请不要重复生成！";
$jieqiLang["pay"]["mreport_make_success"] = "恭喜您，月报表生成成功！";
$jieqiLang["pay"]["pay"] = 1;
$jieqiLang["pay"]["need_login"] = "对不起，必须注册成为本站会员并登录才能使用本功能！<br /><br /><a class=\"btnlink b_note\" href=\"" . JIEQI_URL . "/login.php\">用户登录</a> &nbsp;&nbsp; <a class=\"btnlink b_note\" href=\"/register.php\">注册新用户</a>";
$jieqiLang["pay"]["buy_type_error"] = "对不起，您选择的购买金额类型不存在！";
$jieqiLang["pay"]["add_paylog_error"] = "数据库处理失败，请与管理员联系！";
$jieqiLang["pay"]["need_buy_type"] = "对不起，请先选择您要购买的金额！";
$jieqiLang["pay"]["no_buy_record"] = "对不起，无此交易记录！";
$jieqiLang["pay"]["save_paylog_failure"] = "充值成功，保存交易记录失败！<br /><br />请检查您的帐号，如有问题请与管理员联系。";
$jieqiLang["pay"]["return_checkcode_error"] = "对不起，信息校验错误，请与管理员联系！";
$jieqiLang["pay"]["buy_egold_success"] = "恭喜您，%s:<br /><br />您选择购买%s：%s 点已经入帐，请检查您的帐户余额。感谢您对我们的支持！<br /><br /><a class=\"btnlink b_note\" href=\"" . JIEQI_URL . "/userdetail.php\">查看我的帐户</a>";
$jieqiLang["pay"]["buy_already_success"] = "恭喜您，%s:<br /><br />您选择购买%s：%s 点已经入帐，请检查您的帐户余额。感谢您对我们的支持！<br /><br /><a class=\"btnlink b_note\" href=\"/userdetail.php\">查看我的帐户</a>";
$jieqiLang["pay"]["buy_return_success"] = "恭喜您，%s:<br /><br />交易成功，入账可能需要几秒钟，请稍后检查您的帐户余额。感谢您对我们的支持！<br /><br /><a class=\"btnlink b_note\" href=\"" . JIEQI_URL . "/userdetail.php\">查看我的帐户</a>";
$jieqiLang["pay"]["already_add_egold"] = "恭喜您，本次交易已经完成充值,请检查您的帐户余额！";
$jieqiLang["pay"]["add_egold_success"] = "%s 购买 %s 成功";
$jieqiLang["pay"]["add_egold_failure"] = "%s 购买 %s 失败";
$jieqiLang["pay"]["state_unconfirm"] = "未确认";
$jieqiLang["pay"]["state_paysuccess"] = "支付成功";
$jieqiLang["pay"]["state_handconfirm"] = "手工确认";
$jieqiLang["pay"]["state_unknow"] = "未知状态";
$jieqiLang["pay"]["paytype_unknow"] = "未知方式";
$jieqiLang["pay"]["hand_confirm_confirm"] = "确实要手工确认该订单么？";
$jieqiLang["pay"]["hand_confirm"] = "手工处理";
$jieqiLang["pay"]["delete_pay_confirm"] = "确实要删除么";
$jieqiLang["pay"]["delete_pay"] = "删除";
$jieqiLang["pay"]["customer_id_error"] = "对不起，商户编号对应不上，请与管理员联系！";
$jieqiLang["pay"]["pay_return_error"] = "对不起，交易返回失败，可能余额不足或转帐过程出错！";
$jieqiLang["pay"]["card_foreign"] = "外币卡";
$jieqiLang["pay"]["card_local"] = "人民币卡";
$jieqiLang["pay"]["pay_failure_message"] = "对不起，交易失败！<br>%s";
$jieqiLang["pay"]["need_pay_type"] = "请选择支付类型";
$jieqiLang["pay"]["need_card_nopwd"] = "请输入卡号和密码！";
$jieqiLang["pay"]["paylog_clean_success"] = "恭喜您，过期的未成功充值记录已经清理完成！";
$jieqiLang["pay"]["pay_request_error"] = "对不起交易请求失败，可能是提交的参数错误或者服务器没有及时响应！";
$jieqiLang["pay"]["payaction_type_error"] = "对不起，您选择的购买的类型不存在！";
$jieqiLang["pay"]["payaction_deny_group"] = "对不起，您所在的用户组不需要或者不允许购买本项目！";
$jieqiLang["pay"]["payaction_expire_time"] = "对不起，您选择购买的项目截止日期为%s，目前已经下线！";
$jieqiLang["pay"]["paycard"] = 1;
$jieqiLang["pay"]["paycard_startid_neednum"] = "起始序号必须是一个数字！";
$jieqiLang["pay"]["paycard_endid_neednum"] = "结束序号必须是个数字!";
$jieqiLang["pay"]["endid_less_startid"] = "结束序号不能小于起始序号！";
$jieqiLang["pay"]["card_len_limit"] = "卡号长度必须在0到30之间！";
$jieqiLang["pay"]["pass_len_limit"] = "密码长度必须在0到30之间！";
$jieqiLang["pay"]["paycard_payemoney_neednum"] = "充值金额必须是一个数字！";
$jieqiLang["pay"]["paycard_add_failure"] = "<hr />保存卡号失败，可能是卡号重复。<br />当前已生成的序号为从 %s 到 %s，共 %s 个。";
$jieqiLang["pay"]["paycard_make_success"] = "<hr />全部卡号生成完成，本次共生成卡号 %s 个！";
$jieqiLang["pay"]["start_make_paycard"] = "开始生成卡号....<br /><hr />";
$jieqiLang["pay"]["card_list_format"] = "%s %s<br />";
$jieqiLang["pay"]["need_card_no"] = "卡号必须输入！";
$jieqiLang["pay"]["need_card_pass"] = "密码必须输入！";
$jieqiLang["pay"]["card_nor_exists"] = "对不起，卡号错误！";
$jieqiLang["pay"]["error_card_pass"] = "对不起，密码错误！";
$jieqiLang["pay"]["card_is_pay"] = "对不起，该卡号已经被使用，请不要重复充值！";
$jieqiLang["pay"]["income_egold_failure"] = "增加虚拟货币失败，请与管理员联系！";
$jieqiLang["pay"]["update_paycard_failure"] = "更新卡号标记失败，请于管理员联系！";
$jieqiLang["pay"]["paypal"] = 1;
$jieqiLang["pay"]["paypal_request_success"] = "恭喜您，您已经完成本次交易！<br />充值是否成功需要稍后经过验证才能确认，请稍后查看自己的帐户余额。<a href=\"/userdetail.php\">点击查看我的账户信息</a>";
$jieqiLang["pay"]["paypal_request_cancel"] = "您已经取消了本次充值交易，如有问题，请联系网站管理员！";
$jieqiLang["pay"]["yeecard"] = 1;
$jieqiLang["pay"]["request_success"] = "恭喜您，提交成功！充值是否成功需要稍后经过验证才能确认，请等待几分钟后再查看自己的帐户余额。<a href=\"/userdetail.php\">点击查看我的账户信息</a>";
$jieqiLang["pay"]["error_sign"] = "交易签名无效!";
$jieqiLang["pay"]["pay_failure"] = "提交失败，请稍后再试!";
$jieqiLang["pay"]["orderid_repeat"] = "订单号重复!";
$jieqiLang["pay"]["error_cardpwd"] = "支付卡密无效!";
$jieqiLang["pay"]["error_money"] = "支付金额有误!";
$jieqiLang["pay"]["paytype_notallow"] = "未开通此类支付方式!";

?>
