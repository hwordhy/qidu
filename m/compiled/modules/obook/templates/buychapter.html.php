<?php
echo '  ';
echo '
	<link rel="stylesheet" href="/themes/jieqi220/css/read.css">
	<section class="reading">
	<div class="container">
	<form name="frmbuychapter" id="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'" class="form-horizontal">
	<p class="here"><a >'.$this->_tpl_vars['obookname'].'</a>
	<b>&gt;</b><a href="http://m.9wus.com/Book/directory/book_id/37834" title="">订阅章节 </a>
	</p><h1>'.$this->_tpl_vars['chaptername'].'</h1>

	</h3><!--收费章节支付-->
	<section class="read_pay">
	<p class="read_zj">本章价格：<b>'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</b></p>
	<p class="read_myicon">账户余额：<b>'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</b><em>(1元=1000金币)</em></p>
	<p class="read_nobook">
	<input type="checkbox" name="autobuy" value="1"> <b>自动订阅本书其它VIP章节</b></p>
	<p>
		  <input type="hidden" name="act" value="buy">'.$this->_tpl_vars['jieqi_token_input'].'
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">
	  <input type="submit" style="width:100%;height:55px;border:1px solid #fd8c02" class="only20 bd3 tick_orderAll" value="确定购买并阅读" name="submit">
	</p><!--3.8-->
	<div class="rptips"><h6>温馨提示：</h6>        1、此书为优质出版图书，按照全本定价折扣销售，购买之后可以阅读该书全部章节。
                <br>2、支付金币即可阅读收费章节，没有金币的需要先充值。 
                <br>3、QQ、微信、微博3种账号之间的数据不互通，如果你发现充值成功但没有金币到账，请切换账号查看是否充到了别的账号中
            </div><!--3.8-->
</div>
</form>
	
</section>

<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>购买VIP章节</h4>
		</div>

<form name="frmbuychapter" id="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'" class="form-horizontal">
<div class="bd">
				<div class="item">
					<div class="item-label">章节名称：</div>
					<div class="item-control">《'.$this->_tpl_vars['obookname'].' - '.$this->_tpl_vars['chaptername'].'》</div>
				</div>
				<div class="item">
					<div class="item-label">
                    价格：</div>
					<div class="item-control">'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</div>
				</div>
				<div class="item">
					<div class="item-label">购买用户：</div>
					<div class="item-control">'.$this->_tpl_vars['username'].'</div>
				</div>
				<div class="item">
					<div class="item-label">现有余额：</div>
					<div class="item-control">'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</div>
				</div>
				<div class="item">
					<div class="item-label">订阅选项：</div>
					<div class="item-control"><input type="checkbox" name="autobuy" value="1"> 
					<span title="选择自动订阅，则本书所有VIP章节在点击阅读时自动购买，不需要每次购买后再阅读。">自动订阅本书其它VIP章节</span></div>
			</div>
	<div class="ft">
	  <input type="hidden" name="act" value="buy">'.$this->_tpl_vars['jieqi_token_input'].'
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">
	  <input type="submit" class="btn btn-auto btn-blue" value="确定购买并阅读" name="submit">
	  </div>
</form>
	
</div>
</div>

<script type="text/javascript">
$(function(){
		$(\'#frmbuychapter\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'加载中\'});
				GPage.postForm(\'frmbuychapter\', $("#frmbuychapter").attr("action"),
			   function(data){
					if(data.status==\'OK\'){
                        $.ajaxSetup ({ cache: false });
					    layer.close(tips);
                        jumpurl(data.jumpurl);
					}else{
					    layer.close(tips);
		                openMsgs(data.msg);
					}
			   });
//			}
		});
});
</script> ';
?>