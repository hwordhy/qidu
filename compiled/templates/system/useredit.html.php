<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/user_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
  <div class="i-right">
    <div class="systemMod">
      <div class="i-title">
        <ul class="ulHd">
          <li class="on">基本信息<span></span></li>
        </ul>
      </div>
      <div class="accountsBd">
        <div class="basicAccounts">
          <form id="basicForm" action="" method="post">
            <table>
              <tr>
                <td class="label">用户ID：</td>
                <td>'.$this->_tpl_vars['jieqi_userid'].'</td>
              </tr>
              <tr>
                <td class="label">用户昵称：</td>
                <td>
                  <!--如果是作者将不能修改-->
                  <input name= "nickname" id= "nickname" type="text" value="'.$this->_tpl_vars['nickname'].'" ';
if($this->_tpl_vars['isauthor'] > 0){
echo 'readonly';
}
echo ' class="name"/>
                  <span class="text">已成为作者或编辑的无法修改</span>
                </td>
              </tr>
              <tr>
                <td class="label">电子邮箱：</td>
                <td>
                  <!--绑定后将无法修改email-->
                  ';
if($this->_tpl_vars['verify']['email'] > 0){
echo $this->_tpl_vars['email'].' 已绑定';
}else{
echo '<input name= "email" id= "email" type="text" value="'.$this->_tpl_vars['email'].'" placeholder="请输入您的电子邮箱" class="name"/><a href="javascript:;EmailSubmit()" >验证电子邮箱>></a>
                  <span class="text">为保障账户安全，请及时验证电子邮箱</span>
                  ';
}
echo '
                </td>
              </tr>
              <tr>
                <td class="label">手机：</td>
                <td>
                  <!--绑定后将无法修改手机-->
                  ';
if($this->_tpl_vars['verify']['mobile'] > 0){
echo $this->_tpl_vars['mobile'].' 已绑定';
}else{
echo '<input name= "mobile" id= "mobile" type="text" value="'.$this->_tpl_vars['mobile'].'" placeholder="请输入您的手机号" class="name"/>
                  <!--<a href="javascript:;" >验证手机>></a>-->
                  <!--<span class="text">为保障账户安全，请及时验证手机</span>-->
                  ';
}
echo '
                </td>
              </tr>
              <tr>
                <td class="label">QQ：</td>
                <td>
                  <!--如果是作者将不能修改-->
                  <input name= "qq" id= "qq" type="text" placeholder="请输入您的QQ" value="'.$this->_tpl_vars['qq'].'" class="name"/>
                  <span class="text"></span>
                </td>
              </tr>
              <tr>
                <td class="label">个人签名：</td>
                <td>
                  <textarea name="sign" id="sign" placeholder="请输入您的签名" class="textarea" maxlength="50">'.$this->_tpl_vars['sign'].'</textarea>
                </td>
              </tr>
              <tr>
                <td class="label">用户等级：</td>
                <td>

                  ';
if($this->_tpl_vars['isvip'] > 0){
echo '<span class="red">VIP用户</span>';
}else{
echo '您还不是VIP用户';
}
echo '
                </td>
              </tr>
              <!--邮箱登陆状态-->
              <tr>
                <td class="label">登录账号：</td>
                <td>'.$this->_tpl_vars['username'].'</td>
              </tr>
            </table>
            <input type="hidden" name="ajax_gets" value="1" />
            <input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
            <input type="button" class="accountsBtn" value="保存" onclick="baseFormSubmit()" />
          </form>
        </div>
    </div>
    </div>

  </div>
</div>

<!--footer mod -->
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery.jcrop.min.js"></script>

<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'">

    //baseForm 提交
    function baseFormSubmit() {
        var form = $("#basicForm").serializeArray();
        $.ajax({
            type:\'post\',
            url:\''.$this->_tpl_vars['jieqi_url'].'/useredit.php?do=submit\',
            data:form,
            dataType: "json",
            success:function(data){
                if (data.success === true) {

                    layer.msg(data.message == \'\' ? \'资料修改成功\' : data.message, {icon: 1,shade: .3});
                    location.reload();
                }
                else{
                    layer.msg(data.message, {icon: 2,shade: .3});
                }
            }
        });
    }

    function EmailSubmit() {
        $.ajax({
            type:\'post\',
            url:\''.$this->_tpl_vars['jieqi_url'].'/emailverify.php?sendemail=1\',
            data:{ajax_gets:1},
            dataType: "json",
            success:function(data){
                if (data.success === true) {
                    layer.msg(data.message, {icon: 1,shade: .3});
                }
                else{
                    layer.msg(data.message, {icon: 2,shade: .3});
                }
            }
        });
    }
</script>
</body>
</html>
';
?>