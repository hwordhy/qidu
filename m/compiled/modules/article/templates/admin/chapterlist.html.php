<?php
echo '<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_chapter'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="0" maxlength="50"> <input name="keytype" type="radio" class="radio" value="0" checked="checked">
            小说名称
			<input type="radio" name="keytype" class="radio" value="1">
            发表者 &nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="搜 索">
            &nbsp;&nbsp;&nbsp; <a href="'.$this->_tpl_vars['url_chapter'].'">显示全部章节</a></td>
    </tr>
</table>
</form>
<br />
<form action="'.$this->_tpl_vars['url_article'].'" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>'.$this->_tpl_vars['articletitle'].'</caption>
  <tr align="center">
    <th width="5%"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></th>
    <th width="18%">小说名称</th>
    <th width="28%">章节名称</th>
    <th width="11%">发表者</th>
    <th width="11%">字数</th>
    <th width="17%">更新</th>
    <th width="10%">类型</th>
  </tr>
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
  <tr>
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td>';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '<a href="'.jieqi_geturl('article','chapter',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'],$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['articleid'],$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n']).'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a>';
}else{
echo '<strong>'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</strong>';
}
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<span class="hot">vip</span>';
}
echo '</td>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['posterid']).'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['poster'].'</a></td>
    <td align="center">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'</td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
    <td align="center">';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] > 0){
echo '分卷';
}else{
echo '章节';
}
echo '</td>
  </tr>
  ';
}
echo '
</table>
</form>
<table width="100%"  border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="12%" align="right"><!--<input type="submit" name="Submit" value="批量删除" class="button">
                <input name="batchdel" type="hidden" value="1">--></td>
    <td width="88%" align="right">'.$this->_tpl_vars['url_jumppage'].'</td>
  </tr>
</table>

';
?>