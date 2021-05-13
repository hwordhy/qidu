<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<div class="container-fluid container-box worksmanage_wrapper">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_left.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">作品管理</h1>

			<div class="container-wrap">
				<div class="totlenum">作品总数'.$this->_tpl_vars['articlenums'].'本<a href="'.$this->_tpl_vars['article_static_url'].'/newebook.php" class="setup">上传作品</a><a href="'.$this->_tpl_vars['article_static_url'].'/newarticle.php" class="setup">新建作品</a></div>
				<div class="worksmanage">
					<table class="table table-bordered">
						<thead>
						<tr class="tit">
							<th width="140">书名</th>
							<th width="100">总字数</th>
							<th width="100">收藏数</th>
							<th width="100">显示状态</th>
							<th width="100">签约状态</th>
							<th width="90">VIP状态</th>
							<th width="90">作品状态</th>
							<th width="250">操作</th>
						</tr>
						</thead>
						<tbody>
						';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
						<tr>
							<td><span><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a> </span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size_c'].'</span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['goodnum'].'</span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display'].'</span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign'].'</span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'].'</span></td>
							<td><span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['fullflag'].'</span></td>
							<td>
								<a href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="setbtn" >新建章节</a><a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="setbtn setbtn1" >管理作品</a>
							</td>
						</tr>
						';
}
echo '
						</tbody>
					</table>
					<div class="pages_bottom" style="display: block;">
						'.$this->_tpl_vars['url_jumppage'].'
					</div>
					<!--<div class="exp">-->
						<!--<ul>-->
							<!--<li class="exp_txt">温馨提示：</li>-->
							<!--<li>当作品的发布章节字数达到5000字并且是审核通过状态时，作品将自动公开。</li>-->
						<!--</ul>-->
					<!--</div>-->
				</div>
			</div>
		</div>
	</div>
</div>

';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<!--<div class="ovlay"  style="display: none"></div>-->
<!--<div class="popup" id="popsucces" style="display: none">-->
	<!--<span class="ptit">请选择参赛类型：</span>-->
	<!--<span class="close"></span>-->
	<!--<div class="typelist">-->
	<!--</div>-->
	<!--<a href="###" class="popconfirm" data-bookid="" data-typeid="">朕知道了</a>-->
	<!--<span class="tipserr" style="display: none;">请选择参赛类型</span>-->
<!--</div>-->
<!--<div class="verrortips" id="verrortips" style="display: none;">-->
	<!--恭喜您，参赛报名成功<br>-->
	<!--工作人员正在审核请耐心等待-->
<!--</div>-->
<script type="text/javascript">
    // //参赛弹层
    // $(\'body\').on(\'click\',\'.goldbtnapply\',function() {
    //     var bookId = $(this).data(\'typeid\');
    //     var firstType = $(this).data(\'type\');
    //     $(\'.popconfirm\').attr(\'data-bookid\',bookId);
    //     console.log(firstType);
    //     $(\'.typelist\').append(\'<span class="firststyle" data-val="-1" data-typeid="\'+bookId+\'">\'+firstType+\'</span>\');
    //     $(\'#popsucces\').show();
    //     $(\'.ovlay\').show();
    // })
    //
    // $(\'body\').on(\'click\',\'.typelist span\',function () {
    //     if ($(this).hasClass(\'current\')){
    //         $(this).removeClass(\'current\');
    //     }else {
    //         $(this).addClass(\'current\');
    //         $(this).siblings().removeClass(\'current\');
    //     }
    //     /* $(this).each(function () {
    //      console.log($(\'.current\').text());
    //      })*/
    //
    // });
    // $(\'body\').on(\'click\',\'.popconfirm\',function () {
    //     var typeVal = $(\'.typelist span.current\').data(\'val\');
    //     var bookId = $(this).data(\'bookid\');
    //     if(!$(\'.typelist span\').hasClass(\'current\')){
    //         $(\'.tipserr\').show();
    //         return;
    //     }
    //     $.ajax({
    //         url:\'/author_area/ajax/gold/apply?bookId=\'+ bookId +\'&type=\'+ typeVal,
    //         data:\'\',
    //         type:\'POST\',
    //         beforeSend: function () {
    //             //alert(\'请求前\');
    //             // $(".loading").show();
    //         },
    //         success:function (data) {
    //
    //             // $(\'.popconfirm\').parent(\'#popsucces\').hide();
    //             if (data.success == \'200\'){
    //
    //                 $(\'#popsucces\').hide(500,function () {
    //                     setTimeout(function () {
    //                         //alert(\'111\');
    //                         $(\'.verrortips\').html(\'恭喜您，参赛报名成功<br>工作人员正在审核请耐心等待\');
    //                         $(\'.verrortips\').show(\'2000\',function () {
    //                             setTimeout(function () {
    //                                 window.location.reload();
    //                             },1000);
    //                         });
    //
    //                     },500);
    //                     $(\'.ovlay\').hide();
    //                 });
    //                 // console.log(\'成功\');
    //             }else{
    //                 console.log(\'失败\');
    //                 $(\'.verrortips\').html(data.error);
    //                 $(\'.verrortips\').show(1000,function () {
    //                     setTimeout(function () {
    //                         $(\'.verrortips\').hide(1000);
    //                     },3000);
    //                 });
    //                 return;
    //             }
    //         },
    //         complete: function () {
    //             //alert(\'加载完成\');
    //         },
    //         error:function () {
    //             console.log(\'啊哦，服务器挂了请稍等\');
    //         }
    //     })
    // })
    //
    // $(\'.popup .close\').click(function () {
    //     $(this).parent(\'#popsucces\').hide();
    //     $(\'.ovlay\').hide();
    //     window.location.reload();
    // })
    //
    // $(\'.goldbtnaudit\').on(\'mouseenter\', function () {
    //     $(this).find(\'.checktips\').show();
    //     /* $(\'this\').find(\'.pho-tabs\').sublings().hide();*/
    // })
    // $(\'.goldbtnaudit\').on(\'mouseleave\', function () {
    //     $(this).find(\'.checktips\').hide();
    // });
    // //处理左侧菜单的样式
    //
    // var onTip = function(){
    //     layer.msg(\'章节上传满5000字之后，将会进入到编辑审核后台，审核通过后作品将自动公开\');
    // }
    $(document).ready(function() {
        $(".n02 a").addClass(\'active\');
    });

</script>
';
?>