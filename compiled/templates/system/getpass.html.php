<?php
echo '
<!doctype html>
<head>
  <meta content="zh-cn" http-equiv="Content-Language">
  <meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
  <meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
  <title>忘记密码_'.$this->_tpl_vars['jieqi_sitename'].'</title>

  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
  <link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/register.css" type="text/css" />
  <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/yy.css" type="text/css"/>
</head>
<body class="wrapregister yy_site_body" >
<div class="w1200">
  <a href="/" class="login-logo">
    <img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/logo.png"/>
  </a>
</div>
<div class="reg-box">
  <div class="tab-menu">
    <ul>
      <!--<li class="f1 on">手机找回</li>-->
      <li class="f2 on">邮箱找回</li>
    </ul>
  </div>
  <div class="tabcont forgetpwd forgetpwdmail" id="mailforget">
    <input type="hidden" id="mail_t">
    <div class="forget1" >
      <p>忘记密码第一步</p>
      <form action=""  method="">
        <ul class="tabcontbox">
          <li class="voiduname">
            <label class="u-name">账户名</label><span class="ipt"><input id="uname_txt" type="text" class="w257 mailcheck" placeholder="请输入您注册的账户名"/><i class="successtips"></i></span><em class="erromsg">账户名错误</em>
          </li>
          <li class="voidmail">
            <label class="u-name">邮箱</label><span class="ipt"><input id="mail_txt" type="text" class="w257 mailcheck" placeholder="请输入您注册的邮箱"/><i class="successtips"></i></span><em class="erromsg">邮箱错误</em>
          </li>
        </ul>
      </form>
      <span id="mail_step1_error" class="suberror"></span>
      <a href="javascript:void(0);" class="goregister ui_bgcolor"   id="mstep1">提交</a>
    </div>
    <div class="forget2" style="display: none">
      <p>忘记密码第二步</p>
      <form action=""  method="">
        <ul class="tabcontbox">
          <li>
            <label class="u-name">账户昵称: </label><span class="ipt" id="mail_name"></span>
          </li>
          <li>
            <label class="u-name">邮件已发送至:</label><span class="ipt" id="mail_des" ></span>
          </li>
        </ul>
      </form>


    </div>
    <div class="forget3"  style="display: none">
      <p>忘记密码第三步</p>
      <form action=""  method="">
        <ul class="tabcontbox">
          <li class="voidpwd">
            <label class="u-name">新登录密码</label>
            <span class="ipt">
                    <input id="mail_pass1" type="password" class="w257 pwdcheck" placeholder="6-18位大小写字母、符号或数字"/>
                        <i class="successtips"></i>
                    </span>
            <em  class="erromsg">6-18位大小写字母、符号或数字</em>
          </li>
          <li class="voidaffirmPwd">
            <label class="u-name">确认新密码</label>
            <span class="ipt">
                        <input id="mail_pass2" type="password" class="w257 affirmcheck" placeholder="请再次输入密码"/><i class="successtips"></i>
                    </span>
            <em  class="erromsg">两次密码输入不一致</em>
          </li>
        </ul>
      </form>
      <span id="mail_step3_error"></span>
      <a href="javascript:void(0);" class="goregister ui_bgcolor"   id="mstep3">提交</a>
    </div>
    <div class="forget4" style="display: none">
      <p>忘记密码第一步</p>
      <div class="tabcontbox for4">
        <span class="succ-tips">新密码设置成功</span>
        <span class="succ-back">请牢记您设置的新密码  <a href="#" class="red">返回首页</a></span>
      </div>
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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/template-web.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>



<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/register.js"></script>
<script>
    $(function () {

//短信获取验证码
        var timer =60;
        var isSend = false;
        var Countdown = function(){
            if (timer >= 1) {
                timer -= 1;
                $("#mobilcode").text("重新发送("+timer+")");
                setTimeout(function() {
                    Countdown();
                }, 1000);
            }else{
                $(\'#mobilcode\').html("重新发送");
                timer = 60;
                $(\'#mobilcode\').attr("disabled",false);
                $(\'#mobilcode\').css("background-color","");
                isSend = false;
            }
        }
        $(\'#mobilcode\').on(\'click\',function(){
            var parmPhone = $(\'#u_mobile\').text();
            if(isSend) return;
            if(!parmPhone){   return;}
            $(\'#mobilcode\').attr("disabled",true);
            $(\'#mobilcode\').css("background-color","#b1b1b1");
            var url = "/ajax/accounts/forgetGetCode";
            $.ajax({
                url: url,
                type: \'GET\',
                data: {mobile: parmPhone},
                success: function(data){
                    if(data != null && data.code == "error"){
                        $(\'.notecode\').addClass(\'has-error\').removeClass(\'has-success\');
                        $(\'.notecode .erromsg\').html(\'\');
                        $(\'.notecode .erromsg\').html(data.message);
                    }else{
                        isSend = true;
                        Countdown();
                    }
                }
            });

            return false;

        });
        var init=function () {
            var t=1520952974255;
            createImg($("#mailValidateImg"), $("#code_mail"), t);
        };
        init();

    })




</script>
</body>
</html>
';
?>