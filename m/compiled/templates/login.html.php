<?php
echo '
<link rel="stylesheet" href="/sink/css/reglogin.css">
				<section class="reg">
<div class="container" style="width:96%">
	<div class="mod block form reg" style="margin-top:15px;">
				<form action="'.$this->_tpl_vars['url_login'].'" method="post" name="frmlogin" id="frmlogin" class="form-horizontal">
					<div class="bd">				
						<div class="item col-xs-12" style="margin-top:10px;">
							<div class="item-control ">
								<li><input class="col-xs-12 form-control" class="user_name"  placeholder="用户名" type="text" maxlength="60" size="28" class="text" name="username" value=""></li>	
							</div>
						</div>
                        <div class="item col-xs-12" style="margin-top:10px;">
							<div class="item-control">
						<li>	<input class="col-xs-12 form-control" placeholder="密码" type="password" maxlength="60" size="28" class="text" name="password" value=""></li>	
							</div>
						</div>
						<ul>
						<li class="lostpsd">
								<span class="rems">
										<label for="keeplogin" style="margin-top:10px;"><input name="usecookie" type="checkbox" checked="checked" /> 记住密码</label></span>
									<a href="http://m.9wus.com/User/findps" class="fr">忘记密码?</a>
						</li>
					</ul>
									<input type="hidden" name="act" value="login">
									<input type="submit" value="立即登陆" class="btn btn-auto btn-blue col-xs-6 btn btn-primary">
				</form>
			</div>
		
	</div></section>
<script type="text/javascript">
$(function(){
		$(\'#frmlogin\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'加载中\'});
				GPage.postForm(\'frmlogin\', $("#frmlogin").attr("action"),
			   function(data){
					if(data.status==\'OK\'){
					    layer.close(tips);
						$.ajaxSetup ({ cache: false });
						jumpurl(data.jumpurl);
					}else{
					    layer.close(tips);
		                openMsg(data.msg);
					}
			   });
//			}
		});
});
$(\'#recode\').click(function(){
	$(\'#checkcode\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random());
});
</script>';
?>