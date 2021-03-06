<?php
echo '<form name="frmbatchclecn" method="post" action="'.$this->_tpl_vars['url_batchclean'].'" target="_blank" onsubmit="return confirm(\'本功能中涉及数据删除操作不可恢复，确定要执行么？\');">
<table class="grid" width="100%" align="center">
<caption>小说批量清理</caption>
<tr>
  <td class="tdl" width="25%">执行的操作：</td>
  <td class="tdr" width="75%">
  <input name="operate" type="radio" value="delarticle"> 删除小说，包括对应章节、书评及阅读文件<br />
  <input name="operate" type="radio" value="delchapter"> 删除小说的所有章节，包括阅读文件，保留小说信息和书评<br />
  <input name="operate" type="radio" value="delattach"> 删除小说中有附件的章节，通常是指图片附件<br />  
  <input name="operate" type="radio" value="hidearticle"> 隐藏符合条件小说<br />  
  <input name="operate" type="radio" value="showarticle" checked="checked"> 显示符合条件小说<br />  
  </td>
</tr>
<tr>
  <td class="tdl">小说ID：</td>
  <td class="tdr">从 <input name="startid" type="text" id="startid" size="10" maxlength="11" class="text"> 到 <input name="stopid" type="text" id="stopid" size="10" maxlength="11" class="text"> 的小说</td>
</tr>
<tr>
  <td class="tdl">更新时间：</td>
  <td class="tdr">最近 <input name="upday" type="text" id="upday" size="10" maxlength="11" class="text"> 天内 <select name="upflag">
    <option value="0">未更新</option>
    <option value="1">更新过</option>
  </select> 
    的小说</td>
</tr>
<tr>
  <td class="tdl">点击统计：</td>
  <td class="tdr">
  <select name="visittype">
    <option value="allvisit">总点击</option>
    <option value="monthvisit">月点击</option>
	<option value="weekvisit">周点击</option>
	<option value="allvote">总推荐</option>
    <option value="monthvote">月推荐</option>
	<option value="weekvote">周推荐</option>
  </select>
  <select name="visitflag">
    <option value="0">小于</option>
    <option value="1">大于</option>
  </select>
  <input name="visitnum" type="text" id="visitnum" size="10" maxlength="11" class="text"> 的小说  </td>
</tr>
<tr>
  <td class="tdl">小说类型：</td>
  <td class="tdr">
  <input name="authorflag" type="radio" value="0" checked="checked"> 不限 
  <input name="authorflag" type="radio" value="1"> 原创小说
  <input name="authorflag" type="radio" value="2"> 转载小说  
  <input name="authorflag" type="radio" value="3"> 书盟小说  
  </td>
</tr>
<tr>
  <td class="tdl">分类：</td>
  <td class="tdr">
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
  <input type="checkbox" class="checkbox" name="sortid[]" value="'.$this->_tpl_vars['i']['key'].'" />'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'&nbsp;&nbsp; 
  ';
}
echo '
  </td>
</tr>
<tr>
  <td class="tdl">关键字：<br />查询小说序号(ID)或者小说名<br />多个ID用英文逗号分开，不要换行，如：<br />12,34,56,78<br /><br />多本小说名则是每本一行，如：<br />小说一<br />小说二<br />小说三</td>
  <td class="tdr"><input name="idname" type="radio" value="0">按小说序号，逗号分隔 &nbsp;<input name="idname" type="radio" value="1" checked="checked">按小说名，每本一行 <br />
  <textarea class="textarea" name="articles" id="articles" rows="10" cols="70"></textarea></td>
</tr>
<tr>
  <td class="tdl">特别说明：</td>
  <td class="tdr"><span class="hot">以上限制条件可选择多个，如果全部留空不填，则针对所有小说进行处理。<br />数据清理不可恢复，请谨慎使用！</span></td> 
</tr> 
<tr> 
  <td class="tdl">&nbsp;</td>
  <td class="tdr">
  <input type="submit" name="btnclecn" value="开始清理" class="button">
  <input type="hidden" name="act" value="clean">'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
</tr>
</table>
</form> ';
?>