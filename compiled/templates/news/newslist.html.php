<?php
echo '
<div class="wd1100 clr">
	<div class="zuozhe_success clr">
		<div class="zuozhe_success_lt fl clr">
			<div class="zuozhe_success_title">
				<div class="zuozhe_success_title_span">'.$this->_tpl_vars['jieqi_sitename'].'新闻中心</div>
			</div>
			<div class="wen_da clr" style="padding:10px;margin-bottom:10px">
				';
if (empty($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = array();
elseif (!is_array($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = (array)$this->_tpl_vars['newsrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['newsrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['newsrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['newsrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				<div class="top_new cl">
					<h2><a class="link" href="'.jieqi_geturl('news','info',$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['topicid']).'" target="_blank">'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'].'</a></h2>
					<div class="cl">
						<div class="new_body">'.truncate($this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['summary'],'190','...').'
							<div class="new_info">
								<span class="new_time">'.date('Y-m-d H:i:s',$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['addtime']).'</span>
							</div>
						</div>
					</div>
				</div>
				';
}
echo '
				<div class="page clr">
					'.$this->_tpl_vars['url_jumppage'].'
				</div>
			</div>
		</div>



		<div class="zuozhe_success_rt fr clr">
			<!--<uL class="zuozhe_success_rt_ul funcli clr">
				<li><a class="cur" href="javascript:;">帮助中心</a></li>
					<ul class="funcshow clr" style="display:none;">
						<li><a href="javascript:;">申请作者</a></li>
					</ul></li>
			</uL>-->
			'.jieqi_get_block(array('bid'=>'109', 'blockname'=>'联系方式', 'module'=>'system', 'filename'=>'', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'热推', 'vars'=>'', 'template'=>'', 'contenttype'=>'1', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
		</div>
	</div>
</div>
';
?>