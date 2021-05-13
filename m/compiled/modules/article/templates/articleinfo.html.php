<?php
echo '
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/wxintro.css" />
<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/feedback.css" />
<link type="text/css" rel="stylesheet" href="/sink/css/base.css" />
<style>
	.tdr{
		width: 200px;
	}
</style>

 <!--�鱾��Ϣ-->
 <section class="book_info clearfix">
		<section class="container">
		 <div class="clearfix">
		  <div class="info_left fl">
		   <img src="'.$this->_tpl_vars['url_simage'].'" alt="'.$this->_tpl_vars['articlename'].'" />
		  </div>
		  <div class="info_right fl ">
				<h2>'.$this->_tpl_vars['articlename'].'</h2>
				<p>���ߣ�'.$this->_tpl_vars['author'].'</p>
				<p>������'.$this->_tpl_vars['size_c'].'</p>
				<p>�����'.$this->_tpl_vars['allvisit'].'</p>
				<p>���£�'.$this->_tpl_vars['lastchapter'].'</p>

		   <p><a href="'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['url'].'" title="">'.$this->_tpl_vars['sort'].'</a>';
if($this->_tpl_vars['fullflag'] =='����'){
echo '<b>����</b>';
}else{
echo '<b>���</b>';
}
echo '<b>'.$this->_tpl_vars['isvip'].'</b></p>
		  </div>
		 </div>
		 <!--����-->
		 <section class="intro clearfix">
		  <h1><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/articleread.php?id='.$this->_tpl_vars['articleid'].'">�Ķ�</a><a id="a_addbookcase" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(\''.$this->_tpl_vars['url_bookcase'].'\', {method: \'POST\',eid: \'a_addbookcase\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);" class="intro_fav fr">+����ղ�</a></h1>
		  <div class="con clearfix">

		   <!--<h3><b>���ܾ���</b><a>��ů��ҹ����֮���һ����Թ����</a></h3>-->
		   <h2>���</h2>
		   <div class="con_con">
			<p style="text-indent:2em;">'.htmlclickable($this->_tpl_vars['intro']).'</p>

		   </div>
		  </div>
		 </section>
		 <!--���� end-->
		 <!--����-->
		 <!--���� end-->
		 <!--Ŀ¼-->
		 <div class="catalog">
				<h2><a href="'.$this->_tpl_vars['url_read'].'" title="�鿴Ŀ¼">�鿴Ŀ¼</a><a class="fr" href="'.$this->_tpl_vars['url_lastchapter'].'" title="">';
if($this->_tpl_vars['lastvolume'] != ''){
echo ' ';
}
echo $this->_tpl_vars['lastchapter'].' </a></h2>
		 </div>
		 <!--Ŀ¼ end-->
		</section>
	   </section>
	   <!--�鱾��Ϣend-->
	   <!--�Ƽ�3.8-->
	   <div class="pusgtop clearfix">
		<div class="left fl">
		 <a id="a_tip" href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'&ajax_gets=jieqi_contents\', false);" class="bd3">��Ҫ����</a>
		</div>
		<div class="right fl">
		 <a id="a_uservote" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(event, \''.$this->_tpl_vars['url_uservote'].'\', {method: \'POST\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);" class="toupiao" rel="0">��ҪͶƱ</a>
		 <b><i>'.$this->_tpl_vars['allvote'].'</i></b>
		 <em>��ƷƱ��</em>
		</div>
		<!--��ʾ-->
		<div class="pushtips"></div>
		<!--����Ʊ�ù���-->
		<!--��ʾ end-->
	   </div>
	   <!--�Ƽ�3.8 end-->
	   <!--����Ƽ�-->
	   <!--����Ƽ� end-->
	   <!--����-->
	   <section class="wapcomment" id="wapcomment">
		<div class="container">
		 <h2>ȫ������(<b>'.$this->_tpl_vars['reviewsnum'].'</b>) <a href="javascript:;" class="publish fr">��������</a></h2>

				 <ul> 
						'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'��������', 'module'=>'article', 'filename'=>'block_areviews', 'classname'=>'BlockArticleAreviews', 'side'=>'-1', 'title'=>'��������', 'vars'=>'10,0,0,id', 'template'=>'block_areviews.html', 'contenttype'=>'4', 'custom'=>'0', 'publish'=>'3', 'hasvars'=>'1'), 1).'

				 </ul>

		 <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&type=all" class="lookmore">�鿴����</a>
		</div>
	   </section>
	   <!--
	   <section class="guessyou">
		<div class="container">
		 <h2>����ϲ��</h2>
		 <ul class="clearfix">
		  <li><a href="http://m.9wus.com/Book/detail/book_id/18048" title="�������С����" data-recommendid="94154"><img src="./С˵��-������ѧ_����С˵,����С˵,����С˵,�ÿ���С˵_files/18048_300_400.jpg" /><b>�������С����</b></a></li>
	
		 </ul>
		</div>
	   </section>
	-->

<!--���۵���--><section class="com_alert ">
	<section class="container">
		<div class="downs">
				<form class="form-base" name="frmreview" id="frmreview" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" target="_blank"> 
				';
if($this->_tpl_vars['jieqi_userid'] > 0){
echo '
				<div class="contxt bd3 ">
						<a href="javascript:" class="close"></a>
				<div class="puss">
					<h3>����(ѡ��)</h3>
					<input type="text" class="bd2"  name="ptitle" placeholder="����" maxlength="100"> 
					<h3>����</h3>
					<textarea name="pcontent" class="bd3" placeholder="����" style="overflow: hidden;"></textarea> 
					<input type="hidden" name="act" id="act" value="newpost" />'.$this->_tpl_vars['jieqi_token_input'].'
					<input type="button" value="�ύ" class="com_push bd3 style="cursor:pointer;" onclick="Ajax.Request(\'frmreview\',{onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));Form.reset(\'frmreview\');}});">
					</div><!--���۳ɹ�-->
					</div>
				</div>
					   ';
}else{
echo '
					   <div class="contxt bd3 ">
							<a href="javascript:" class="close"></a>
					   <div class="puss" style="color:#000;font-size:15px;">
							��ֻ��<a href="'.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" target="_blank" style="color:#09c">��½</a>��ſ��Է�������
						</div>
					</div>
					   ';
}
echo '
					</form> 
		</section>
	</section><!--���۵��� end--><!--β��-->
<style>
	.puss h3{
		color: #000;
	}
	.bd2{
		border-radius: 3px;
	    font-size: 1.3rem;
		border: 1px solid #e0e0e0;
		width: 50%;
		height: 30px;
		margin-bottom: 5px;
	}
</style>

	<script src="https://img2.9kus.com/wap_9wus/js/wapnew.js" type="text/javascript"></script>

<script>
			_inlineRun(function(){
				
				require(["kernel","mo/ui/Tabs"], 
				function(core, Tabs){
					var zone1 = $(".pattern-home-column3");
					
					new Tabs({
						toggleItem: zone1.find(".mask li"),
						handles: zone1.find(".handles img"),
						auto: true,
						handleCurrentClass: "active"
					});
					
					var updateList = $(".pattern-update-list");
					new Tabs({
						toggleItem: updateList.find("table"),
						handles: updateList.find(".handles span"),
						handleCurrentClass: "active"
					});
					
					var comList = $(".reviews");
					new Tabs({
						toggleItem: comList.find(".review-item"),
						handles: comList.find(".tab-choose a"),
						handleCurrentClass: "active"
					});
					
					var comList = $(".reviews");
					new Tabs({
						toggleItem: comList.find(".items"),
						handles: comList.find(".donate-item"),
						handleCurrentClass: "active"
					});
					
					$(".pattern-slide-ad").each(function(){
						var slideAd =  $(this);
						if( slideAd.length && slideAd.find("a").length > 1 ){
							new Tabs({
								toggleItem: slideAd.find("a"),
								handles: slideAd.find("span"),
								auto: true,
								handleCurrentClass: "active",
								animate: "opacity"
							})
						}
					});
					
					$(".pattern-rank").each(function(){
						var mod = $(this), handles = mod.find(".handles");
						if(handles.length){
							new Tabs({
								toggleItem: mod.find("ol"),
								handles: handles.find("span"),
								handleCurrentClass: "active"
							})
						}
					});
					
					var shelf = $(".shelf");
					if( shelf.length ){
						var shelflist = shelf.find(".bd"),
							table = shelflist.find("table tbody");
						
						var loaded = false;
						var getMoreShelf = function( callback ){
							$.ajax({
								url: "/ajax/home/book/reading",
								data: { bookIds: [shelf.find(".primary").data("book-id")], count: 5 },
								cache: false,
								success: function( html ){
									loaded = true;
									table.append( html );
									callback();
								}
							})
						}
						
						var showMoreBtn = shelf.find(".show");
						showMoreBtn.click(function(){
							if( !loaded ){
								getMoreShelf(function(){
									shelflist.slideToggle("fast");
									showMoreBtn.toggleClass("showed");
								});
							}else{
								shelflist.slideToggle("fast");
								showMoreBtn.toggleClass("showed");
							}
						});
						
						shelf.find(".bd").delegate("tr", "mouseenter", function(){
							//control ֻ��ʹ��Js����������ʾ
							//��Ϊ ie6 ��Ҫreflow ������ʾ
							$(this).addClass("hover").find(".control").show();
						}).delegate("tr", "mouseleave", function(){
							$(this).removeClass("hover").find(".control").hide();
						})
					}
				})
			})
		</script>
<script src="https://www.novelrd.cn/sink/js/jquery.min.js"></script>
<script src="https://www.novelrd.cn/sink/js/require.js"></script>';
?>