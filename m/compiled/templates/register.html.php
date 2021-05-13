<?php
echo '
<link rel="stylesheet" href="/sink/css/reglogin.css">

<div class="container">
<div class="mod block form">
		<section class="reg">
				<div class="container">
				<form name="frmregister" id="frmregister" action="'.$this->_tpl_vars['form_action'].'?do=submit" method="post" class="form-horizontal">
					<input value="37987" type="hidden" name="ID">
					<div class="bd" style="margin-top:10px;">		
							<h2>注册</h2>
						<ul>
						<li>	
						<div class="item">
							<div class="item-control">
								<input type="text" class="form-control" placeholder="用户名" maxlength="60" size="28" class="text" name="username" value="">
							</div>
						</div></li>
						<li>
                        <div class="item">
							<div class="item-control">
								<input type="password" class="form-control" placeholder="密码" maxlength="60" size="28" class="text" name="password" value="">
							</div>
						</div></li>
						<li>
                       <div class="item">
							<div class="item-control">
								<input type="password"  class="form-control" placeholder="确认密码" maxlength="60" size="28" class="text" name="repassword" value="">
							</div>
						</div></li>
						<li>
                        <div class="item">
							<div class="item-control">
								<input type="text" class="form-control" placeholder="电子邮箱"  maxlength="60" size="28" class="text" name="email">
							</div>
						</div>
					</div></li>
					<div class="ft fcc" style="margin-top:10px;">
					<input type="hidden" name="act" value="newuser" />
						<input class="col-xs-6 btn btn-primary" type="submit" value="立即注册" class="btn btn-auto btn-blue">
					</div>
				</ul>	
				</form>
			</div>
		</section>
			</div>

        </div>

		
<script type="text/javascript">
$(function(){
		$(\'#frmregister\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'加载中\'});
				GPage.postForm(\'frmregister\', $("#frmregister").attr("action"),
			   function(data){
					if(data.status==\'OK\'){
					    layer.close(tips);
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