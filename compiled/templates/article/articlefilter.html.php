<?php
echo '
<div class="block10"></div>
<div class="wrap1200 ranklist">
  <input type="hidden" value="'.$this->_tpl_vars['_request']['sortid'].'" id="sortId">
  <input type="hidden" value="'.$this->_tpl_vars['_request']['size'].'" id="Size">
  <input type="hidden" value="'.$this->_tpl_vars['_request']['isvip'].'" id="Isvip">
  <input type="hidden" value="'.$this->_tpl_vars['_request']['isfull'].'" id="Isfull">
  <input type="hidden" value="'.$this->_tpl_vars['_request']['update'].'" id="Update" />
  <input type="hidden" value="'.$this->_tpl_vars['_request']['order'].'" id="Order" />
  <input type="hidden" value="'.$this->_tpl_vars['_request']['keywords'].'" id="Keywords" />
  <div class="leftbar fl">
    <div class="select selected">
      <span class="tname">已选</span>
      <p class="textlist">

        <a href="javascript:;" data-size="" class="all on">
          <em>全部</em>
        </a>
        <a href="javascript:;" data-size="catestyle" class="seled1" style="display: none">
          <em>分类</em><b style="display:none;"></b><i class="selclose"></i>
        </a>
        <a href="javascript:;" data-size="sizenum" class="seled2" style="display: none">
          <em>字数</em><i class="selclose"></i>
        </a>
        <a href="javascript:;" data-size="selattribute" class="seled3" style="display: none">
          <em>属性</em><i class="selclose"></i>
        </a>
        <a href="javascript:;" data-size="selstatus" class="seled4" style="display: none">
          <em>状态</em><i class="selclose"></i>
        </a>
        <a href="javascript:;" data-size="updatetime" class="seled5" style="display: none">
          <em>更新时间</em><i class="selclose"></i>
        </a>
      </p>
    </div>
    <div class="selectlist">
      <div class="select selstyle" data-size="catestyle">
        <span class="tname">分类</span>
        <ul class="textlist">
          ';
if (empty($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = array();
elseif (!is_array($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = (array)$this->_tpl_vars['sortidrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sortidrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortidrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sortidrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li';
if($this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle on"';
}
echo '><a href="javascript:;" data-type="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</a></li>
          ';
}
echo '
        </ul>
        <div class="second-type selsubsel" style="display: none" data-size="subcatestyle">
          <div class="taglist"></div>
          <i class="arrow"></i>
        </div>
      </div>
      <div class="select selnum"  data-size="sizenum">
        <span class="tname">字数</span>
        <ul class="textlist">
          ';
if (empty($this->_tpl_vars['sizerows'])) $this->_tpl_vars['sizerows'] = array();
elseif (!is_array($this->_tpl_vars['sizerows'])) $this->_tpl_vars['sizerows'] = (array)$this->_tpl_vars['sizerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sizerows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sizerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sizerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sizerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sizerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li';
if($this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle on"';
}
echo '><a href="javascript:;" data-type="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['name'].'</a></li>
          ';
}
echo '
        </ul>
      </div>
      <div class="select selattribute"  data-size="free">
        <span class="tname">属性</span>
        <ul class="textlist">
          ';
if (empty($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = array();
elseif (!is_array($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = (array)$this->_tpl_vars['isviprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['isviprows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isviprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['isviprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li';
if($this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle on"';
}
echo '><a href="javascript:;" data-type="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['name'].'</a></li>
          ';
}
echo '
        </ul>
      </div>
      <div class="select selstatus"  data-size="finish">
        <span class="tname">状态</span>
        <ul class="textlist">
          ';
if (empty($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = array();
elseif (!is_array($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = (array)$this->_tpl_vars['isfullrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['isfullrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isfullrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['isfullrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li';
if($this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle on"';
}
echo '><a href="javascript:;" data-type="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['name'].'</a></li>
          ';
}
echo '
        </ul>
      </div>
      <div class="select seltime"  data-size="updatetime">
        <span class="tname">更新时间</span>
        <ul class="textlist">
          ';
if (empty($this->_tpl_vars['updaterows'])) $this->_tpl_vars['updaterows'] = array();
elseif (!is_array($this->_tpl_vars['updaterows'])) $this->_tpl_vars['updaterows'] = (array)$this->_tpl_vars['updaterows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['updaterows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['updaterows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['updaterows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['updaterows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['updaterows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li';
if($this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle on"';
}
echo '><a href="javascript:;" data-type="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['name'].'</a></li>
          ';
}
echo '
        </ul>
      </div>
    </div>

  </div>

  <div class="right-cont-box fr rankdata">
    <div class="comment-r-menu">
      <ul class="fl comment-status">
        <li class="human"  data-ordetype="lastupdate">
          <a href="javascript:;" class="firstname downj" id="human">排序</a>
          <div class="tipshover" style="display: none;">
            ';
if (empty($this->_tpl_vars['orderrows'])) $this->_tpl_vars['orderrows'] = array();
elseif (!is_array($this->_tpl_vars['orderrows'])) $this->_tpl_vars['orderrows'] = (array)$this->_tpl_vars['orderrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['orderrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['orderrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['orderrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['orderrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['orderrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <a href="javascript:;" data-type="'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['id'].'">'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
        ';
}
echo '
          </div>
        </li>
      </ul>
      <div class="tag-search">
        <div class="inner">
          <div class="input-wrap fl">
            <div class="input-bd">
              <input type="text" default-value="" id="bookgototag" class="text" name="tag" value=""/>
            </div>
          </div>
          <input type="button" class="fr btn-submit btn-search " value="标签直达" title="搜索" />
        </div>
        <p class="sresult">共<i class="totalcount"></i>本相关作品</p>
      </div>

    </div><div class="rankdatacont">
    <div class="tabsbox1">
      <div class="rankday">
        <ul class="clrbtn clrbtna">
          <li class="clrbtn1 on"><a href="javascript:;"></a></li>
          <li class="clrbtn2"><a href="javascript:;"></a></li>
        </ul>
        <div class="tabsday-cont">
          <div class="tab-cont-1 secd-rank-list">
            <div class="listboxw">

            </div>
          </div>
          <div class="tab-cont-1 tablist" style="display: none">
            <ul>
              <li class="tab-title">
                <a href="javascript:;" class="tr1">分类</a>
                <a href="javascript:;" class="tr2">书名</a>
                <a href="javascript:;" class="tr3">最新章节</a>
                <a href="javascript:;" class="tr4">作者</a>
                <a href="javascript:;" class="tr5">更新时间</a>
              </li>
            </ul>
            <ul class="listboxw textlistbox">

            </ul>
          </div>
          <div class="loading" style="display: none"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/loading.gif" /></div>
          <p class="errorshow" style="display: none"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/error.png"/></p>
        </div>
      </div>
    </div>
    <div class="pages_bottom">
      <ul>
      </ul>
      <div class="pageform" id="pageForm">
        <span>飞到</span>
        <input type="text" name="page" id="pageNum" class="pageNum" value="1">
        <span>页</span>
        <span class="gobtn" id="gobtn">go</span>
      </div>
    </div>
  </div>
  </div>
</div>
<div style="height: 20px;"></div>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/layer.css" />
<script>
    function _addConfig(json) {
        if(window.page_config){
            for(var i in json){
                if(page_config[i] === undefined){
                    window.page_config[i] = json[i];
                }
            }
        }else{
            window.page_config = json;
        }
    }
    _addConfig({
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        sitestate:"7",
        userId:"'.$this->_tpl_vars['jieqi_userid'].'",
        coinName:"'.$this->_tpl_vars['egoldname'].'",
        siteValue:"yy",
        toTop_page:true
    });
    var isPeople = location.href.indexOf(\'/people\')>-1;
    if(isPeople){
        page_config.toTop_page=false;
    }

</script><script type="text/javascript">
    var _loginUser = \'basic\';
    var _config = \'\';
</script>
<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" charset="'.$this->_tpl_vars['jieqi_charset'].'" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>
<script type="text/javascript" charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/book.js"></script>
<script charset="'.$this->_tpl_vars['jieqi_charset'].'" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/page.js"></script>
<script type="text/javascript">
    var doPage  = function (pageNum) {
        var parmpage = getDelbox();
        parmpage.page = pageNum;
        dataListpic(parmpage);
    };
    $(".nav_book").addClass("curr");
</script>
';
?>