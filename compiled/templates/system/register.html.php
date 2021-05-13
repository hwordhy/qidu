<?php
echo '
<!DOCTYPE HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
  <meta content="zh-cn" http-equiv="Content-Language">
  <meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
  <meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
  <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/yy.css" type="text/css"/>
  <title>用户注册_'.$this->_tpl_vars['jieqi_sitename'].'</title>
  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/register.css" type="text/css" />
  <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/mt.css" type="text/css"/>

</head>
<body class="wrapregister motie_site_body">
<div class="w1200">
  <a href="/" class="login-logo">
    <img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/logo.png"/>
  </a>
</div>
<div class="reg-box">
  <div class="tab-menu" id="tab-menu">
    <ul>
      <li class="m1  on">用户注册</li>
    </ul>
  </div>
  <div class="tabcont" id="register" style="display:block">
    <div class="phonebox">
      <form action=""  method="" id="mobileForm">
        <ul class="tabcontbox">
          <li class="voidphone">
            <label class="u-name">用户名</label><span class="ipt"><input id="username" name="username" value="" class="w257 phonecheck" type="text" placeholder="输入用户名"/><i class="successtips"></i></span><em class="erromsg">该用户名已注册，请尝试直接登录</em>
          </li>
          <li class="voidmail">
            <label class="u-name">邮箱</label><span class="ipt"><input id="email" name="email" value="" class="w257  mailcheck" type="text" placeholder="请输入邮箱"/><i class="successtips"></i></span><em class="erromsg">邮箱格式不正确</em>
          </li>
          <li class="voidpwd">
            <label class="u-name">密码</label><span class="ipt"><input id = \'password\' name = \'password\'  maxlength="18"  class="w257 pwdcheck" type="password" placeholder="6-18位大小写字母、符号或数字"/><i class="successtips"></i></span><em  class="erromsg">6-18位大小写字母、符号或数字</em>
          </li>
          <li class="voidaffirmPwd">
            <label class="u-name">确认密码</label><span class="ipt"><input  id = \'repassword\' name = \'repassword\'   maxlength="18"  class="w257 affirmcheck" type="password"  placeholder="请再次输入密码"/><i class="successtips"></i></span><em  class="erromsg">两次密码输入不一致</em>
          </li>
          ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
          <li class="u-vcode mobile-code ">
            <label class="u-name">验证码</label><span class="ipt"><input id="code" maxlength="4" name="mobilecode" class="w168 ecodecheck" type="text"  placeholder="验证码"/><i class="successtips"></i></span> <img src="" id="mobileValidateImg" style="cursor:pointer"/><em  class="erromsg"></em>
          </li>
          ';
}
echo '
        </ul>
      </form>
      <span class="suberror"></span>
      <a href="javascript:void(0);" class="goregister ui_bgcolor" id="btMobileReg">立即注册</a>
      <p class="havuser">已有账号，<a href="'.$this->_tpl_vars['jieqi_url'].'/login.php" class="red ui_color" >立即登录</a></p>
    </div>

  </div>
</div>
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



<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/register.js"></script>
<script>
    $(function () {

        $(\'#mobileValidateImg\').on(\'click\',function(){
            createImg($("#mobileValidateImg"),$("#code_mobile",\'\'));
        });

        $(\'body\').on(\'click\',\'#tab-menu .m2\',function(){
            createImg($("#mailValidateImg"),$("#code_mail",\'\'));
        });

        $("#btMobileReg").click(function(){

            var flag = false;
            var    username = $("#username").val();
            flag =     PhoneCheckNull(username,\'#register\');
            if(flag==false){
                return ;
            }

            var password = $("#password").val();
            flag =  pwdCheckNull(password,\'#register\');
            if(flag==false){
                return ;
            }
            var repassword = $("#repassword").val();
            flag =  voidaffirmPwd(repassword,\'#register\');

            if(flag==false){
                return ;
            }

            var    email = $("#email").val();
            flag =     mailCheckNull(email, "#register");
            if(flag==false){
                return ;
            }

            flag =     voidMail(email, "#register");
            if(flag==false){
                return ;
            }

            var code = $("#code").val();

            $.ajax({
                url: "/register.php",
                type: "POST",
                data: {
                    do: "submit",
                    username: username,
                    password: password,
                    repassword: repassword,
                    email: email,
                    checkcode: code,
                    act: \'newuser\',
                    ajax_gets: 1
                },
				dataType: "json",
                success: function(e) {
                    if (e.success === true) {
                        layer.msg(e.message, {icon: 1,shade: .3});
                        window.location.href = e.backUrl;
                    }
                    else{
                        layer.msg(e.message, {icon: 2,shade: .3});
                    }
                },
                error: function(t) {}
            })
        });


        var init=function () {
            var on = "";
            var t=\'1506523546461\';
            if(on) {
                createImg($("#mailValidateImg"), $("#code_mail"), t);
                $(\'#mailregister\').show();
                $(\'#register\').hide();
            }else{
                $(\'#register\').show();
                $(\'#mailregister\').hide();
            }

            createImg($("#mobileValidateImg"), $("#code_mobile"), \'\');
        }();


    })


</script>


</body>
</html>


';
?>