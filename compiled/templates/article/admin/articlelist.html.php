<?php
echo '
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/js/jquery.js"></script>
<script type="text/javascript">
//隐藏显示
function act_hide(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onFinish: \'\'
	}
	if(o.getAttribute(\'switch\') == \'0\'){
		url = url.replace(\'act=show\', \'act=hide\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'1\');
				o.innerHTML = \'显示\';
			}
		}
	}else{
		url = url.replace(\'act=hide\', \'act=show\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'0\');
				o.innerHTML = \'隐藏\';
			}
		}
	}
	Ajax.Tip(url, param);
	return false;
}
//待审审核
function act_ready(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onFinish: \'\'
	}
	if(o.getAttribute(\'switch\') == \'0\'){
		url = url.replace(\'act=show\', \'act=ready\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'1\');
				o.innerHTML = \'审核\';
			}
		}
	}else{
		url = url.replace(\'act=ready\', \'act=show\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'0\');
				o.innerHTML = \'待审\';
			}
		}
	}
	Ajax.Tip(url, param);
	return false;
}
//推荐不荐
function act_toptime(url){
	Ajax.Tip(url, {method: \'POST\'});
	return false;
}
//删除
function act_delete(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onReturn: function(){
			$_(o.parentNode.parentNode).remove();
		}
	}
	if(confirm(\'确实要删除该小说么？\')) Ajax.Tip(url, param);
	return false;
}
//全本设置
function wholebuy(id) {
    var wholeprice = $("#wholeprice_"+id).val();
    $.ajax({
        type: "POST",
        url: \''.$this->_tpl_vars['url_article'].'\',
        data: {\'id\' : id, \'act\' : \'wholebuy\', \'wholeprice\' : wholeprice, \'jieqi_token\' : \''.$this->_tpl_vars['jieqi_token'].'\', \'ajax_gets\' : 1},
        global: false,
		dataType: "json",
        success: function (data) {
            if (data[\'success\'] == false) {
                $("#wholeprice_"+id).val(\'0\');
                return false
            }
            alert(data[\'message\']);
        }
    })
}
</script>
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_article'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>
		状态：
		<select class="select" size="1" name="display">
		  <option value="">全部</option>
		  <option value="ready"';
if($this->_tpl_vars['_request']['display'] == 'ready'){
echo ' selected="selected"';
}
echo '>待审</option>
		  <option value="show"';
if($this->_tpl_vars['_request']['display'] == 'show'){
echo ' selected="selected"';
}
echo '>已审</option>
		  <option value="hide"';
if($this->_tpl_vars['_request']['display'] == 'hide'){
echo ' selected="selected"';
}
echo '>隐藏</option>
		  <option value="empty"';
if($this->_tpl_vars['_request']['display'] == 'empty'){
echo ' selected="selected"';
}
echo '>无章节</option>
		  <option value="sign"';
if($this->_tpl_vars['_request']['display'] == 'sign'){
echo ' selected="selected"';
}
echo '>签约作品</option>
		  <option value="nosign"';
if($this->_tpl_vars['_request']['display'] == 'nosign'){
echo ' selected="selected"';
}
echo '>尚未签约</option>
		  <option value="vip"';
if($this->_tpl_vars['_request']['display'] == 'vip'){
echo ' selected="selected"';
}
echo '>VIP作品</option>
		  <option value="free"';
if($this->_tpl_vars['_request']['display'] == 'free'){
echo ' selected="selected"';
}
echo '>免费作品</option>
		</select>
		';
if(count($this->_tpl_vars['customsites']) > 0){
echo '
		来源：
		<select class="select" size="1" name="siteid">
		  <option value="0">不限</option>
		  <option value="-1"';
if($this->_tpl_vars['_request']['siteid'] == '-1'){
echo ' selected="selected"';
}
echo '>本站原创</option>
		  <option value="-2"';
if($this->_tpl_vars['_request']['siteid'] == '-2'){
echo ' selected="selected"';
}
echo '>他站作品</option>
		';
if (empty($this->_tpl_vars['customsites'])) $this->_tpl_vars['customsites'] = array();
elseif (!is_array($this->_tpl_vars['customsites'])) $this->_tpl_vars['customsites'] = (array)$this->_tpl_vars['customsites'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['customsites']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['customsites']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['customsites']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['customsites']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['customsites']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		  <option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['_request']['siteid'] == $this->_tpl_vars['i']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['customsites'][$this->_tpl_vars['i']['key']]['name'].'</option>
		';
}
echo '
		</select>
		';
}
echo '
		进度：
		<select class="select" size="1" name="isfull">
		  <option value="0">不限</option>
		  <option value="1"';
if($this->_tpl_vars['_request']['isfull'] == 1){
echo ' selected="selected"';
}
echo '>全本</option>
		  <option value="2"';
if($this->_tpl_vars['_request']['isfull'] == 2){
echo ' selected="selected"';
}
echo '>连载</option>
		</select>
		分类：
		<select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
		<option value="0">不限分类</option>
		';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sortrows']);
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
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sortrows']);
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
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
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
		排序：
		<select class="select" size="1" name="order">
		  <option value="lastupdate"';
if($this->_tpl_vars['_request']['order'] == 'lastupdate'){
echo ' selected="selected"';
}
echo '>最近更新</option>
		  <option value="postdate"';
if($this->_tpl_vars['_request']['order'] == 'postdate'){
echo ' selected="selected"';
}
echo '>入库时间</option>
		  <option value="toptime"';
if($this->_tpl_vars['_request']['order'] == 'toptime'){
echo ' selected="selected"';
}
echo '>编辑推荐</option>
		  <option value="goodnum"';
if($this->_tpl_vars['_request']['order'] == 'goodnum'){
echo ' selected="selected"';
}
echo '>收藏数</option>
		  <option value="size"';
if($this->_tpl_vars['_request']['order'] == 'words'){
echo ' selected="selected"';
}
echo '>小说字数</option>
		  <option value="allvisit"';
if($this->_tpl_vars['_request']['order'] == 'allvisit'){
echo ' selected="selected"';
}
echo '>总点击</option>
		  <option value="monthvisit"';
if($this->_tpl_vars['_request']['order'] == 'monthvisit'){
echo ' selected="selected"';
}
echo '>月点击</option>
		  <option value="allvote"';
if($this->_tpl_vars['_request']['order'] == 'allvote'){
echo ' selected="selected"';
}
echo '>总推荐</option>
		  <option value="monthvote"';
if($this->_tpl_vars['_request']['order'] == 'monthvote'){
echo ' selected="selected"';
}
echo '>月推荐</option>
		</select>
		<select class="select" size="1" name="asc">
		  <option value="0"';
if($this->_tpl_vars['_request']['asc'] == 0){
echo ' selected="selected"';
}
echo '>倒序</option>
		  <option value="1"';
if($this->_tpl_vars['_request']['asc'] == 1){
echo ' selected="selected"';
}
echo '>顺序</option>
		</select>

		<br />
		 搜索条件：
		<label class="radio"><input type="radio" name="keytype" value="0"';
if($this->_tpl_vars['_request']['keytype'] == 0){
echo ' checked="checked"';
}
echo '>小说名称</label>
    	<label class="radio"><input type="radio" name="keytype" value="1"';
if($this->_tpl_vars['_request']['keytype'] == 1){
echo ' checked="checked"';
}
echo '>作者</label> 
		<label class="radio"><input type="radio" name="keytype" value="2"';
if($this->_tpl_vars['_request']['keytype'] == 2){
echo ' checked="checked"';
}
echo '>发表者</label> 
		<label class="radio"><input type="radio" name="keytype" value="3"';
if($this->_tpl_vars['_request']['keytype'] == 3){
echo ' checked="checked"';
}
echo '>责任编辑</label> 
		&nbsp;&nbsp;
		<button type="submit" name="btnsearch" class="button">搜 索</button>
		<span class="hot">（下方允许多个关键字，用英文空格分隔）</span>
		<textarea class="textarea" name="keyword" style="width:80%;height:3em;">'.$this->_tpl_vars['_request']['keyword'].'</textarea>
        </td>
    </tr>
</table>
</form>
<form action="'.$this->_tpl_vars['url_batchaction'].'" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>小说列表<span class="fss">（共'.$this->_tpl_vars['rowcount'].'本）</span></caption>
  <tr align="center">
	  <th width="4%">&nbsp;</th>
	  <th width="15%">小说名称</th>
	  <th width="24%">最新章节</th>
	  <th width="8%">作者</th>
	  <th width="6%">字数</th>
	  <th width="10%">入库=&gt;更新</th>
	  <th width="13%">全本价格</th>
	  <th width="20%">操作</th>
  </tr>
  <tbody id="jieqi_page_contents">
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
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'],'info',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlecode']).'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<span class="hot">vip</span>';
}
echo '</td>
    <td>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_vipchapter'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a><span class="hot">vip</span>';
}else{
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>';
}
echo '</td>
    <td>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'] == 0){
echo $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'];
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>';
}
echo '</td>
    <td>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size_c'].'</td>
    <td align="center">'.date('Y-m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['postdate']).'=&gt;'.date('Y-m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
	  ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign_n'] == 10 && $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '
	  <td align="center"><input type="text" class="text" style="width: 50px;text-align:center;" name="wholeprice" id="wholeprice_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" size="25" maxlength="100" value="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['saleprice'].'">&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="wholebuy(\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\')" class="btnlink" href="javascript:;">提交设置</a></td>
	  ';
}else{
echo '
	  <td align="center">非VIP签约作品</td>
	  ';
}
echo '
    <td align="center">
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '
	<a id="act_hide_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_hide(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=hide'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="0">隐藏</a> 
	<a id="act_ready_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_ready(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=ready'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="0">待审</a>
	';
}elseif($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '
	<a id="act_hide_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_hide(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=hide'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="0">隐藏</a> 
	<a id="act_show_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_ready(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=show'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="1">审核</a>
	';
}else{
echo '
	<a id="act_show_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_hide(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=show'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="1">显示</a> 
	<a id="act_ready_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_ready(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=ready'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="0">待审</a>
	';
}
echo '
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo ' 
	<a id="act_toptime_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_toptime(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=toptime'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="0">推荐</a>/<a id="act_untoptime_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_toptime(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=untoptime'.$this->_tpl_vars['jieqi_token_url'].'\');" switch="1">不荐</a>
	';
}else{
echo ' 
	推荐/不荐
	';
}
echo ' 
	<a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">管理</a> 
	<a href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'" target="_blank">编辑</a> 
	<a id="act_del_'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" href="javascript:;" onclick="act_delete(\''.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['_request']['display'].'&act=del'.$this->_tpl_vars['jieqi_token_url'].'\');">删除</a>
	<a href="'.$this->_tpl_vars['article_static_url'].'/admin/txtarticle.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'">下载</a>
	</td>
  </tr>
  ';
}
echo '
  </tbody>
  <tr>
    <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="7" align="left">
	<input name="act" type="hidden" value="del">'.$this->_tpl_vars['jieqi_token_input'].'
	<input name="url_jump" type="hidden" value="'.$this->_tpl_vars['url_jump'].'">
	<button type="button" name="batchdel" class="button" onclick="if(confirm(\'确实要删除选中记录么？\')){ this.form.act.value=\'del\'; this.form.submit();}">批量删除</button> &nbsp;
	<button type="button" name="batchhide" class="button" onclick="if(confirm(\'确实要隐藏选中记录么？\')){ this.form.act.value=\'hide\'; this.form.submit();}">批量隐藏</button> &nbsp;
	<button type="button" name="batchshow" class="button" onclick="if(confirm(\'确实要把选中记录审核通过么？\')){ this.form.act.value=\'show\'; this.form.submit();}">批量审核</button> &nbsp;
	<button type="button" name="batchready" class="button" onclick="if(confirm(\'确实要把选中记录设为待审么？\')){ this.form.act.value=\'ready\'; this.form.submit();}">批量待审</button> &nbsp;
	</td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>