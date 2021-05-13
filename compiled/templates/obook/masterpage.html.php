<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<div class="container-fluid container-box author_cash_sum">
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
      <h1 class="page-header">收入管理</h1>
      <div class="container-wrap">
        <div class="bd">
          <div class="cashtable">
            <span class="fb18">合计：</span> <span class="r16" style="margin-left: 25px;">'.$this->_tpl_vars['obookstat']['sumegold'].'</span> <span class="h16">'.$this->_tpl_vars['egoldname'].'</span><span style="font-size: 16px;float: right;"> 总打赏：<span class="r16">'.$this->_tpl_vars['obookstat']['sumtip'].'</span> 总礼物：<span class="r16">'.intval($this->_tpl_vars['obookstat']['sumgift']).' </span>总收入：<span class="r16">'.intval($this->_tpl_vars['obookstat']['sumemoney']).'</span></span>
          </div>
          <table class="cash_table">
            <tbody>
            <tr class="tit">
              <td class="bg">书名</td>
              <td class="bg">订阅收入</td>
              <td class="bg">打赏收入</td>
              <td class="bg">总收入</td>
              <td class="bg" style="width: 200px;">操作</td>
            </tr>
            ';
if (empty($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = array();
elseif (!is_array($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = (array)$this->_tpl_vars['obookrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['obookrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obookrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['obookrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <tr>
              <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
              <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumegold'].'</td>
              <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumtip'].'</td>
              <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
              <td align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleactlog.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'&act=tip">打赏记录</a> <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/chapterstat.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">销售明细</a> <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/mreport.php?obookid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">销售月报</a></td>
            </tr>
            ';
}
echo '
            </tbody>
          </table>
          <div class="pages_bottom" style="display: block;">
            '.$this->_tpl_vars['url_jumppage'].'
          </div>
          <div class="exp">
            <ul>
              <li class="exp_txt">温馨提示：</li>
              <li>1. 每月1日开始结算上月收入，一般截止到10日发放完毕（节假日顺延）；</li>
              <li>2. 作品捧场及订阅等才会产生收入；</li>
              <li>3. <span style="color:#ff0000;">本页显示的数据为：未计算分成前的数据，分成比例请查看-><a href="'.$this->_tpl_vars['jieqi_url'].'/persondetail.php" style="color: blue;text-decoration: underline;" target="_blank">基本信息</a>；</span></li>
              <li>4. 对收入明细或福利如有疑问，请联系客服。</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $(".n04 a").addClass(\'active\');

    });
    function showLoading() {
        popUp.openLoading(\'正在查询\');
    }


</script>

';
?>