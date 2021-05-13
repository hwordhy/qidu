<?php
echo '
<style type="text/css">
.list_li_i{background:#fff;width:100%;margin:0 auto;}
.list_li_i li{position:relative}
.list_li_i li.act{border-left:5px solid #E25858;background:#feefec}
.list_li_i li.act a{color:#E25858}
.list_li_i li.act em{position:absolute;top:2px;right:5px;background-position:0 -110px}
.list_li_i li.two{background:#f9f9f9}
.list_li_i li a{white-space:nowrap;overflow:hidden;font-size:14px;text-overflow:ellipsis;padding:0 3px;height:41px;line-height:41px;}
.list_li_i li em {color:#E25858}
</style>
<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>管理《'.$this->_tpl_vars['articlename'].'》</h4>
		</div>
<form name="chapterdel" id="chapterdel" action="'.$this->_tpl_vars['url_chaptersdel'].'" method="post">
<div class="ft fcc"><a class="btn btn-auto btn-blue" href="'.$this->_tpl_vars['article_static_url'].'/newvolume.php?aid='.$this->_tpl_vars['articleid'].'">新建分卷</a> </div>
<div class="ft fcc"><a class="btn btn-auto btn-blue" href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articleid'].'">增加章节</a> </div>
<div class="ft fcc"><a class="btn btn-auto btn-blue" href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articleid'].'">编辑小说</a> </div>

 <tr>
 <td>
 <ul class="list_li_i">
 ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
 <li>
 <input type="checkbox" class="checkbox" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterread'].'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a>
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<em>vip</em>';
}
echo ' 
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="编辑章节">[编]</a> 
 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该章节么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="删除章节">[删]</a> 
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '
 <a id="act_free_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为免费么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetfree'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="设为免费章节">[免]</a>
 ';
}else{
echo '
 <a id="act_vip_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为VIP么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetvip'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="设为VIP章节">[VIP]</a>
 ';
}
echo ' 
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '
 <a id="act_hide_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要隐藏本章节内容么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersethide'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="隐藏章节内容">[隐]</a>
 ';
}else{
echo '
 <a id="act_show_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要显示本章节内容么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetshow'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="显示章节内容">[显]</a>
 ';
}
echo '
 </li>
 ';
}else{
echo '
 <li>
 <input type="checkbox" class="checkbox" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterread'].'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a> 
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="编辑分卷">[编]</a> 
 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该分卷么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="删除分卷">[删]</a>
 </li>
 ';
}
echo '
 ';
}
echo '
 </ul>

<div class="ft fcc"> <input type="hidden" name="articleid" id="articleid" value="'.$this->_tpl_vars['articleid'].'" />
   <input type="button" name="allcheck" value="选择全部章节" class="btn btn-auto btn-blue" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }"></div>
<div class="ft fcc">  <input type="button" name="nocheck" value="取消全部选中" class="btn btn-auto btn-blue" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }"></div>
<div class="ft fcc">  <input type="button" name="delcheck" value="批量删除章节" class="btn btn-auto btn-blue" onclick="if(confirm(\'确实要批量删除章节么？\')){this.form.submit();}">
   <input type="hidden" name="act" value="delete" />'.$this->_tpl_vars['jieqi_token_input'].'
</div>
</form>
</div>
</div>

<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>章节排序</h4>
		</div>
<form name="chaptersort" id="chaptersort" action="'.$this->_tpl_vars['url_chaptersort'].'" method="post">
<div class="mail-zc">
<div class="phone-name"> 
  <h3>选择章节或分卷</h3>
  
  <select class="select"  size="1" name="fromid" id="fromid">
  ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">|-'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}else{
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}
echo '
  ';
}
echo '
  </select>
  
</div>
  <div class="phone-name"> 
  <h3>移动到</h3>
  <select class="select"  size="1" name="toid" id="toid">
  <option value="0">--最前面--</option>
  ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">|-'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}else{
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}
echo '
  ';
}
echo '
  </select>
  <span>之后</span>
  
</div>
<div class="ft fcc">
  <input type="submit" class="btn btn-auto btn-blue" name="submit_sort"  id="submit_sort" value="确 定" />
  <input type="hidden" name="aid" id="aid" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="sort" />'.$this->_tpl_vars['jieqi_token_input'].'
  
</div>
</div>
</form>
</div>
</div>

<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>重新生成</h4>
		</div>
<form name="repack" id="repack" action="'.$this->_tpl_vars['url_repack'].'" method="post">
<div class="phone-name"> 
  <h3>生成选项</h3>
  
  <ul class="am_packflag">
  ';
if (empty($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = array();
elseif (!is_array($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = (array)$this->_tpl_vars['packflag'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['packflag']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['packflag']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['packflag']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <li><input type="checkbox" class="checkbox" name="packflag[]" value="'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['value'].'" />'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['title'].' </li>
  ';
}
echo '
  </ul>
  
</div>
<div class="ft fcc">
  <input type="submit" class="btn btn-auto btn-blue" name="submit_repack" id="submit_repack" value="确 定" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="repack" />'.$this->_tpl_vars['jieqi_token_input'].'
  
</div>
</form>

	</div>
</div>';
?>