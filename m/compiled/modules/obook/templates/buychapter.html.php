<?php
echo '  ';
echo '
	<link rel="stylesheet" href="/themes/jieqi220/css/read.css">
	<section class="reading">
	<div class="container">
	<form name="frmbuychapter" id="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'" class="form-horizontal">
	<p class="here"><a >'.$this->_tpl_vars['obookname'].'</a>
	<b>&gt;</b><a href="http://m.9wus.com/Book/directory/book_id/37834" title="">�����½� </a>
	</p><h1>'.$this->_tpl_vars['chaptername'].'</h1>

	</h3><!--�շ��½�֧��-->
	<section class="read_pay">
	<p class="read_zj">���¼۸�<b>'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</b></p>
	<p class="read_myicon">�˻���<b>'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</b><em>(1Ԫ=1000���)</em></p>
	<p class="read_nobook">
	<input type="checkbox" name="autobuy" value="1"> <b>�Զ����ı�������VIP�½�</b></p>
	<p>
		  <input type="hidden" name="act" value="buy">'.$this->_tpl_vars['jieqi_token_input'].'
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">
	  <input type="submit" style="width:100%;height:55px;border:1px solid #fd8c02" class="only20 bd3 tick_orderAll" value="ȷ�������Ķ�" name="submit">
	</p><!--3.8-->
	<div class="rptips"><h6>��ܰ��ʾ��</h6>        1������Ϊ���ʳ���ͼ�飬����ȫ�������ۿ����ۣ�����֮������Ķ�����ȫ���½ڡ�
                <br>2��֧����Ҽ����Ķ��շ��½ڣ�û�н�ҵ���Ҫ�ȳ�ֵ�� 
                <br>3��QQ��΢�š�΢��3���˺�֮������ݲ���ͨ������㷢�ֳ�ֵ�ɹ���û�н�ҵ��ˣ����л��˺Ų鿴�Ƿ�䵽�˱���˺���
            </div><!--3.8-->
</div>
</form>
	
</section>

<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>����VIP�½�</h4>
		</div>

<form name="frmbuychapter" id="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'" class="form-horizontal">
<div class="bd">
				<div class="item">
					<div class="item-label">�½����ƣ�</div>
					<div class="item-control">��'.$this->_tpl_vars['obookname'].' - '.$this->_tpl_vars['chaptername'].'��</div>
				</div>
				<div class="item">
					<div class="item-label">
                    �۸�</div>
					<div class="item-control">'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</div>
				</div>
				<div class="item">
					<div class="item-label">�����û���</div>
					<div class="item-control">'.$this->_tpl_vars['username'].'</div>
				</div>
				<div class="item">
					<div class="item-label">������</div>
					<div class="item-control">'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</div>
				</div>
				<div class="item">
					<div class="item-label">����ѡ�</div>
					<div class="item-control"><input type="checkbox" name="autobuy" value="1"> 
					<span title="ѡ���Զ����ģ���������VIP�½��ڵ���Ķ�ʱ�Զ����򣬲���Ҫÿ�ι�������Ķ���">�Զ����ı�������VIP�½�</span></div>
			</div>
	<div class="ft">
	  <input type="hidden" name="act" value="buy">'.$this->_tpl_vars['jieqi_token_input'].'
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">
	  <input type="submit" class="btn btn-auto btn-blue" value="ȷ�������Ķ�" name="submit">
	  </div>
</form>
	
</div>
</div>

<script type="text/javascript">
$(function(){
		$(\'#frmbuychapter\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'������\'});
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