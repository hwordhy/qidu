<?php
echo '<form name="frmexport" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/articleexport.php">
<table width="100%" class="grid" align="center">
<caption>小说批量导出成EXCEL</caption>
<tr>
  <td class="tdl">小说分类：</td>
  <td class="tdr">
	<select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
		<option value="0">不限分类</option>
		';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		<option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['_request']['sortid'] == $this->_tpl_vars['i']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'</option>
		';
}
echo '
		</select>
		<span id="typeselect" name="typeselect"></span>
        <script type="text/javascript">
        function showtypes(obj){
          var typeselect=document.getElementById(\'typeselect\');
          typeselect.innerHTML=\'\';
          ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	      ';
if($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] != ''){
echo '
	      if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML=\'<select class="select" size="1" name="typeid" id="typeid"><option value="0">不限子类</option>';
if (empty($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['_request']['typeid'] == $this->_tpl_vars['j']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
	      ';
}
echo '
          ';
}
echo '
         }
		 ';
if($this->_tpl_vars['_request']['sortid'] > 0){
echo 'showtypes(document.getElementById(\'sortid\'));';
}
echo '
	</script>
  </td>
</tr>
<tr>
  <td class="tdl">签约状态：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="issign" value="-1" checked="checked" />不限
  <input type="radio" class="radio" name="issign" value="0" />未签约
  <input type="radio" class="radio" name="issign" value="1" />已签约
  <input type="radio" class="radio" name="issign" value="10" />VIP签约
  </td>
</tr>
<tr>
  <td class="tdl">时间限制：</td>
  <td class="tdr">
  <input name="upfield" type="radio" value="0" checked="checked">更新时间 &nbsp;<input name="upfield" type="radio" value="1">入库时间 <br />
  <input name="upday" type="text" id="upday" size="10" maxlength="11" class="text"> 天以内 <span class="hot">（留空表示不限）</span>
  </td>
</tr>
<tr>
  <td class="tdl">关键字：<br />小说名称或ID<br /><br />多个小说名则是每个一行，如：<br />小说一<br />小说二<br />小说三<br />
  多个ID用英文逗号分开，不要换行，如：<br />12,34,56,78<br /></td>
  <td class="tdr"><input name="idname" type="radio" value="1" checked="checked">按小说名，每个一行 &nbsp; <input name="idname" type="radio" value="0">按小说序号，逗号分隔<br />
  <textarea class="textarea" name="articles" id="articles" rows="20" cols="70"></textarea></td>
</tr>
<tr>
  <td class="tdl">排序条件：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="order" value="articlename" checked="checked" />小说名称
  <input type="radio" class="radio" name="order" value="articleid" />小说序号(ID)
  <input type="radio" class="radio" name="order" value="postdate" />入库时间
  <input type="radio" class="radio" name="order" value="lastupdate" />更新时间
  <input type="radio" class="radio" name="order" value="size" />总字数
  <input type="radio" class="radio" name="order" value="monthsize" />本月更新字数
  <input type="radio" class="radio" name="order" value="weeksize" />本周更新字数
  <input type="radio" class="radio" name="order" value="allvisit" />总点击
  <input type="radio" class="radio" name="order" value="monthvisit" />月点击
  <input type="radio" class="radio" name="order" value="weekvisit" />周点击
  </td>
</tr>
<tr>
  <td class="tdl">排列顺序：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="asc" value="1" checked="checked" />正序（从小到大）
  <input type="radio" class="radio" name="asc" value="0" />倒序（从大到小）
  </td>
</tr>
<tr>
  <td class="tdl">&nbsp;<input type="hidden" name="act" value="export" />'.$this->_tpl_vars['jieqi_token_input'].'</td>
  <td class="tdr"><input type="submit" name="btnsearch" class="button" value="导出成EXCEL"> <span class="hot">点击导出后请耐心等待，稍后会提示EXCEL文件下载</span></td>
</tr>
</table>
</form>';
?>