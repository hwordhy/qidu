<?php
echo '
<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
    <meta content="zh-cn" http-equiv="Content-Language">
    <meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/mt.css" type="text/css"/>

    <title>用户登录_'.$this->_tpl_vars['jieqi_sitename'].'</title>
<body class="wraplogin motie_site_body">
<div class="w1200">
    <a href="/" class="login-logo">
        <img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/logo.png"/>
    </a>
</div>
<div class="w1200">
    <div class="yellow-bg">
        <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/login.css" type="text/css" />

        <div class="login-box-warp">
            <span class="closeb"></span>
            <form id="loginForm" name="form1" method="post" action="">
                <div class="login-box-n">
                    <div class="checkText" id="errInfo"></div>
                    <div class="login-box">

                        <div class="field username-field">
                            <input type="text" name="username" id="username" class="login-text " value="" maxlength="32" tabindex="1" placeholder="账号">
                        </div>
                        <div class="field pwd-field">
                            <input type="password" name="password" id="password" class="login-text" maxlength="40" tabindex="2" placeholder="密码">
                        </div>
                        ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
                        <div id="ecodebox" class="ecodebox">
                            <div class="input-b fl">
                                <input type="text" maxlength="4" class="codetext" name="checkcode" value="" id="code" tabindex="3" placeholder="验证码">
                                <input type="hidden" id="codeHidden" checked name="t" value="'.$this->_tpl_vars['show_checkcode'].'">
                            </div>
                            <a href="javascript:void(0);" class="change-code fl" style="color:#999">
                                <img id="validateImg" src="'.$this->_tpl_vars['url_checkcode'].'" alt="">
                            </a>
                        </div>
                        ';
}
echo '
                        <div class="login-submit">
                            <div class="checkText"></div>
                            <input type="hidden" name="act" value="login">
                            <input type="hidden" name="ajax_gets" value="1">
                            <input type="button" value="登 录" class="btn-submit ui_bgcolor"  id="btn_submit">
                        </div>
                        <div class="login-links">
                            <label class="rememberecod fl"><input type="checkbox" value="on" checked="checked" style="display: none" name="remember"/></label>
                            <span class="fr">
                            <a href="'.$this->_tpl_vars['url_register'].'" class="register-1">我要注册</a>
                            <a href="'.$this->_tpl_vars['url_getpass'].'" class="forget-pwd">忘记密码 </a>
                        </span>
                        </div>
                    </div>
                    <div class="other-login">
                        <div class="entries">
                            <div class="c-box">
                                <a href="'.$this->_tpl_vars['jieqi_url'].'/api/qq/login.php"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/qq.png"></a>
                                <a href="'.$this->_tpl_vars['jieqi_url'].'/api/weixin/login.php"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/weixin.png"></a>
                                <a href="'.$this->_tpl_vars['jieqi_url'].'/api/sina/login.php"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/sina.png"></a>
                                <a href="'.$this->_tpl_vars['jieqi_url'].'/api/baidu/login.php"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/baidu.png" title="百度账号登陆"></a>
                                <!--<a href="/alipay/login"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/zfb.png"></a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
</body>
</html>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/layer.css" />
<script>
    function _addConfig(json) {
        if(window.page_config){
            for(var i in json){
                if(page_config[i] === undefined){
                    window.page_config[i] = json[i];
                }
            }
        }else{
            window.page_config = json;
        }
    }
    _addConfig({
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        sitestate:"7",
        userId:"'.$this->_tpl_vars['jieqi_userid'].'",
        coinName:"'.$this->_tpl_vars['egoldname'].'",
        siteValue:"yy",
        toTop_page:true
    });
    var isPeople = location.href.indexOf(\'/people\')>-1;
    if(isPeople){
        page_config.toTop_page=false;
    }

</script><script type="text/javascript">
    var _loginUser = \'basic\';
    var _config = \'\';
</script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>



<script>
    $(function () {
        var createImg = function (t ) {
            if(!t){
                t = Math.random();
            }
            $("#validateImg").attr("src", "'.$this->_tpl_vars['url_checkcode'].'?"+ t);
            $("#codeHidden").val(t);
        }

        $("#validateImg").click(function(){
            createImg();
            return false;
        });
        $(".login-box .field .login-text").on(\'focus\',function(){
            $(this).parents(\'.field\').addClass(\'active\');
        }).on(\'blur\',function () {
            $(this).parents(\'.field\').removeClass(\'active\');
        }).on(\'keydown\',function (ev) {
            if(ev.keyCode == 13){
                doSubmit();
            }
        });


        var doSubmit = function () {
            var username =  $("#username").val();
            if(!username){
                $("#errInfo").html("请输入账户名");
                return ;
            }
            var password =  $("#password").val();
            if(!password){
                $("#errInfo").html("请输入密码");
                return ;
            }
            var codeHidden =    $("#codeHidden").val();
            var code =    $("#code").val();
            if(codeHidden && !code){
                $("#errInfo").html("请输入验证码");
                return ;
            }
            $("#btn_submit").val(\'登录中···\');
            $.ajax({
                url: "'.$this->_tpl_vars['url_login'].'",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                    checkcode: code,
                    act: \'login\',
                    ajax_gets: 1
                },
				dataType: "json",
                success: function(e) {
                    if (e.success === true) {
                        $("#errInfo").html(e.message);
                        window.location.href = e.backUrl;
                    }
                    else{
                        $("#errInfo").html(e.message);
                        $("#btn_submit").val(\'登 录\');
                    }
                },
                error: function(t) {}
            })
        };

        //登录
        $("#btn_submit").on(\'click\',function(){
            doSubmit();
        })
        //回车登录
        $(\'body\').on(\'keydown\',function(event){
            if(event.keyCode==13){
                doSubmit();
            }

        });

    })

</script>
';
?>