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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/touchslide.1.1.js"></script>
<style>
    input:-webkit-autofill {-webkit-box-shadow: 0 0 0px 1000px white inset;}
    ::-webkit-input-placeholder { /* WebKit browsers */color:#ccc;font-family:"微软雅黑";}
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */color:#ccc;font-family:"微软雅黑";}
    ::-moz-placeholder { /* Mozilla Firefox 19+ */color:#ccc;font-family:"微软雅黑";}
    :-ms-input-placeholder { /* Internet Explorer 10+ */color:#ccc;font-family:"微软雅黑";}
    .login_header{background:#505050;height:48px;line-height:48px;display:-moz-box;display:-webkit-box;display:box;width:100%;overflow:hidden;}.login_header a{color:#fff;}
    .login_header .ll{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;padding-left:10px;}
    .login_header .cc{text-align:center !important;-moz-box-flex:2.0;-webkit-box-flex:2.0;box-flex:2.0;font-size:18px;}
    .login_header .rr{text-align:right !important;-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;padding-right:10px;font-size:14px;}
    .alert {width: 88%;color: red;padding: 0px 0 10px 25px !important;height: 20px;margin:0px !important}
    .alert-error {background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/ico_error_login.png) no-repeat 0px 3px !important;border: none !important;}
    .font_14{font-size:14px;color:#999;}.tab_cont .item{font-family:"微软雅黑";}
    .tabBox .hd{ height:40px; line-height:40px;font-size:14px;background:#fff;margin-bottom:20px;padding-top:10px;}
    .tabBox .hd ul{height:40px;line-height:40px;overflow:hidden;  }
    .tabBox .hd ul li{ float:left;text-align:center;height:37px;line-height:37px;color:#333;border-bottom:3px solid #f4f4f4;width:50%;  }
    .tabBox .hd ul .on{ border-bottom:3px solid #419bf3;}
    .tabBox .bd ul{ padding:10px 0 10px 10px;}
    .tabBox .bd li{ height:33px; line-height:33px;}
    .tabBox .bd li a{ color:#666;  }.tab_cont table{width:100%;}.tab_cont table td{padding-bottom:10px;}.new_input{width:99%;height:38px;border:solid 1px #ccc;background:#fff;padding-left:1%;color:#ccc;font-size:14px;line-height:38px;}
    .phone_box .phone_input{width:67% !important;float:left;}.phone_input .new_input_c{width:98.5%;height:38px;border:solid 1px #ccc;background:#fff;padding-left:1.5%;color:#ccc;font-size:14px;line-height:38px;}
    .phone_box .phone_btn{float:right;width:30%;}.phone_input_btn{width:100%;background:#ddd;border:none;font-family:"微软雅黑";height:40px;line-height:40px;display:block;text-align:center;font-size:8px;}
    .result_but_n {background: #419af4;color: #fff!important;height:40px;line-height:40px;border: none;-webkit-appearance:none;-moz-appearance:none;font-weight: bold;width:100%;text-align:center;}
    .login_third{height:13px;margin:20px 0;font-size:14px;background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_tt.png) repeat-x 0 5px;text-align:center;}
    .login_third span{background:#f4f4f4;padding:0 30px;}.login_ul{overflow:hidden;}
    .login_ul li{width:33.3333333333333333%;float:left;text-align:center;}
    .code_box .code_input{float:left;width:35% !important;}
    .code_input .text-login{width:97%;padding-left:3%;background:#fff;border:solid 1px #ccc;height:38px;line-height:38px;}
    .code_box .code_pc{float:right;width:62%;padding-top:2px;line-height:38px;}.code_pc .code_text{cursor:pointer; background:none !important;border:none;color:#419bf5;font-size:12px;}
    .code_box .code_pc img{vertical-align:middle;}
    input[type="submit"]{font-family:"微软雅黑";}
</style>
<script type="text/javascript">

    $(function(){
        $(".color-0682c7").click(function(){
            $(".code_pc > img").attr("src", "'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand="+ Math.random());
        });
    })
</script>
<body>
<div class="wrapper">
    <!-- header start -->
    <div class="login_header">
        <div class="ll"><a href="'.$this->_tpl_vars['jieqi_url'].'/"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/login_arrow.png"></a></div>
        <div class="cc"><a href="javascript:;">注册</a></div>
        <div class="rr"><a href="'.$this->_tpl_vars['jieqi_url'].'/login.php">登录</a></div>
    </div>
    <div id="leftTabBox" class="tabBox">
        <div class="bd" style="padding:10px !important;">
            <!-- 手机号注册 start -->
            <div class="tab_cont">
                <form action="" method="post" id="register_form">
                    <div class="item" >
                        <table>
                            <tr>
                                <td>
                                    <input type="text" maxlength="60" name="username" class="new_input" value="" placeholder="请输入用户名"/>
                                </td>
                            </tr>
                            <tr><td><input type="password" maxlength="20" class="new_input" name="password" placeholder="请设置不少于6位的密码" value=""/></td></tr>

                            <tr><td><input type="password" maxlength="20" class="new_input" name="repassword" placeholder="请再次输入一遍密码" value=""/></td></tr>
                            <tr>
                                <td>
                                    <input type="text" maxlength="60" name="email" class="new_input" value="" placeholder="请输入电子邮箱"/>
                                </td>
                            </tr>
                            <!-- 验证码 -->
                            ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
                            <tr>
                                <td>
                                    <div class="code_box">
                                        <div class="code_input"><input type="text" maxlength="4" class="text-login" value="" id="code" placeholder="请输入验证码" /></div>
                                        <p class="code_pc">
                                            <img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand='.$this->_tpl_vars['jieqi_time'].'" class="fl" alt="" />
                                            <a href="javascript:;" class="code_text color-0682c7" id="refresh" >看不清？换一张</a>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            ';
}
echo '
                        </table>
                    </div>
                    <div class="submit-item" style="margin-right: 10px;">
                        <div>
                            <input type="hidden" name="act" value="newuser" />
                            <input type="hidden" name="accounttype" value="useremail" />
                            <input type="hidden" name="ajax_gets" value="1" />
                            <input type="button" value="注册" onclick="register()" class="result_but_n" />
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
                </form>
            </div>
            <!-- end 手机注册-->
        </div>
    </div>
</div>

<script type="application/javascript">

    function register(){
        var data = $("#register_form").serialize();
        $.ajax({
            type: \'post\',
            url: "'.$this->_tpl_vars['form_action'].'?do=submit",
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