<?php
echo '
<?xml version="1.0" encoding="'.$this->_tpl_vars['jieqi_charset'].'"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
	<meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'">
	<meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link  rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/core.css" media="all" />
	<link rel="shortcut icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/mobile_index.js"></script>
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.lazyload.js"></script>
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/layer.js"></script>
	<title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
	<!--[if IE]>
	<link href="" rel="stylesheet" type="text/css" />
	<![endif]-->

</head>
<style type="text/css">
	/**input{-webkit-appearance:none;-moz-appearance:none;}**/
	input:-webkit-autofill {-webkit-box-shadow: 0 0 0px 1000px white inset;}
	::-webkit-input-placeholder { /* WebKit browsers */color:#ccc;font-family:"微软雅黑";}
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */color:#ccc;font-family:"微软雅黑";}
	::-moz-placeholder { /* Mozilla Firefox 19+ */color:#ccc;font-family:"微软雅黑";}
	:-ms-input-placeholder { /* Internet Explorer 10+ */color:#ccc;font-family:"微软雅黑";}
	.login_header{background:#505050;height:48px;line-height:48px;display:-moz-box;display:-webkit-box;display:box;width:100%;overflow:hidden;}.login_header a{color:#fff;}
	.login_header .ll{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;padding-left:10px;}
	.login_header .cc{text-align:center !important;-moz-box-flex:2.0;-webkit-box-flex:2.0;box-flex:2.0;font-size:18px;}
	.login_header .rr{text-align:right !important;-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;padding-right:10px;font-size:14px;}
	.alert {width:88%;color: red;padding: 0px 0 10px 25px !important;height: 20px;margin:0px !important}
	.alert-error {background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/ico_error_login.png) no-repeat 0px 3px !important;border: none !important;}
	.email_box,.password_box{width:100%;display:-moz-box;display:-webkit-box;display:box;background:#fff;border:solid 1px #ccc;height:38px;line-height:38px;margin-bottom:10px;}
	.email_box .ico,.password_box .ico{padding:2px 6px 0 10px;}
	.email_box .username input,.password_box .password input{height:36px !important;border:none;}
	.email_box .username,.password_box .password{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;}
	.username input,.password input{width:100%;}
	.forget{font-size:14px;}.forget_check{background: #419bf5;}
	.result_but_n {background: #419af4;color: #fff!important;height:40px;line-height:40px;border: none;-webkit-appearance:none;-moz-appearance:none;font-weight: bold;width:100%;text-align:center;}
	input[type=checkbox]{width:15px;height:15px;vertical-align:middle;background:#c00;}
	.login_third{height:13px;margin:20px 0;font-size:14px;background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_tt.png) repeat-x 0 5px;text-align:center;}
	.login_third span{background:#f4f4f4;padding:0 30px;}.login_ul{overflow:hidden;}
	.login_ul li{width:33.3333333333333333%;float:left;text-align:center;}
</style>
<body>
<div class="wrapper">
	<!-- header start -->
	<div class="login_header">
		<div class="ll"><a href="'.$this->_tpl_vars['jieqi_url'].'/"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_arrow.png"></a></div>
		<div class="cc"><a href="javascript:;">登录</a></div>
		<div class="rr"><a href="'.$this->_tpl_vars['jieqi_url'].'/register.php">注册</a></div>
	</div>
	<div id="bd" style="padding:15px 10px 10px;">
		<div class="mod">
			<div class="bd">
				<form action="" method="post" autocomplete="off" id="login_form" >
					<div class="item">
						<div class="email_box">
							<div class="ico"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/new_ico_usename.png"></div>
							<div class="username"><input type="text" maxlength="100" name="username" placeholder="用户名/邮箱/手机号" autocomplete="off"  /></div>
						</div>

						<div class="password_box">
							<div class="ico" style="padding:2px 10px 0 10px"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/new_ico_password.png"></div>
							<div class="password"><input type="password" maxlength="20" name="password" placeholder="密码" autocomplete="off"  /></div>
						</div>
						';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
						<div class="email_box">
							<div class="ico"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/yanzhengma.png"></div>
							<div class="username" style=""><input type="text" maxlength="100" name="checkcode" placeholder="验证码" autocomplete="off"  /></div>
							<img id="checkcode" src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand='.$this->_tpl_vars['jieqi_time'].'" class="fl" alt="" />
							<a href="javascript:;" class="code_text color-0682c7" id="refresh" >换一张</a>
						</div>
						';
}
echo '
						<div class="forget">
							<input type="checkbox" name="usecookie" value="1" class="forget_check" checked/> 记住我
							<a href="'.$this->_tpl_vars['url_getpass'].'" class="blue" style="float:right;display:block">忘记密码？</a>&nbsp;&nbsp;
						</div>

					</div>
					<div class="submit-item" style="margin-top: 10px;">
						<div>
							<input type="button" value="登录" class="result_but_n" onclick="login()" />
						</div>
						';
if($this->_tpl_vars['jieqi_api_sites']['weixin']['publish'] > 0 || $this->_tpl_vars['jieqi_api_sites']['qq']['publish'] > 0 || $this->_tpl_vars['jieqi_api_sites']['weibo']['publish'] > 0){
echo '
						<div class="login_third"><span>合作方一键登录</span></div>
						<ul class="login_ul">
							';
if($this->_tpl_vars['jieqi_api_sites']['weixin']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_url'].'/api/wxmp/login.php'.$this->_tpl_vars['jumpquery'].'" ><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_weixin.png" title="微信登陆"></a></li>';
}
echo '
							';
if($this->_tpl_vars['jieqi_api_sites']['qq']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_url'].'/api/qq/login.php'.$this->_tpl_vars['jumpquery'].'" ><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_qq.png" title="QQ登陆"></a></li>';
}
echo '
							';
if($this->_tpl_vars['jieqi_api_sites']['weibo']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_url'].'/api/weibo/login.php'.$this->_tpl_vars['jumpquery'].'" ><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_weibo.png" title="新浪微博登录"></a></li>';
}
echo '
							<!--';
if($this->_tpl_vars['jieqi_api_sites']['baidu']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_url'].'/api/baidu/login.php'.$this->_tpl_vars['jumpquery'].'"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_baidu.png" title="百度账号登陆"></a></li>';
}
echo '-->
						</ul>
						';
}
echo '
					</div>
					<input type="hidden" value="login" name="act" class="result_but_n" />
					<input type="hidden" value="1" name="ajax_gets" class="result_but_n" />
				</form>
			</div>

		</div>

	</div>

</div>

<script type="application/javascript">
    $(function(){
        $("#refresh").click(function(){
            $("#checkcode").attr("src", "'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand="+ Math.random());
        });
    })

    function login(){
        var data = $("#login_form").serialize();
        $.ajax({
            type: \'post\',
            url: "'.$this->_tpl_vars['url_login'].'",
            dataType: \'json\',
            data: data,
            success: function (data) {
                if(data.success == true){
                    data.message = data.message == \'\' ? \'登录成功\' : data.message;
                    layer.open({
                        content: data.message
                        ,skin: \'msg\'
                        ,time: 3 //2秒后自动关闭
                    });
                    setTimeout(window.location.href = ""+data.backUrl+"",6000);
                }
                else{
                    layer.open({
                        content: data.message
                        ,skin: \'msg\'
                        ,time: 3 //2秒后自动关闭
                    });
                }
            },
        });
    }
</script>
</body>
</html>
';
?>