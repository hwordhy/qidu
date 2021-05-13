<?php
if($this->_tpl_vars['order'] == "toplist"){
echo '
<div class="block10"></div>
<div class="wrap1200 ranklist">
    <div class="leftbar fl">
        <ul data-type="">
            ';
if (empty($this->_tpl_vars['toprows'])) $this->_tpl_vars['toprows'] = array();
elseif (!is_array($this->_tpl_vars['toprows'])) $this->_tpl_vars['toprows'] = (array)$this->_tpl_vars['toprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['toprows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['toprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['toprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['toprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['toprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            ';
if($this->_tpl_vars['toprows'][$this->_tpl_vars['i']['key']]['publish'] > 0){
echo '
            <li class="a'.$this->_tpl_vars['i']['order'];
if($this->_tpl_vars['order'] == $this->_tpl_vars['i']['key']){
echo ' on';
}
echo '"><a href="'.jieqi_geturl('article','toplist','1',$this->_tpl_vars['i']['key'],$this->_tpl_vars['sortid'],$this->_tpl_vars['fullflag']).'"';
if($this->_tpl_vars['i']['order'] == 1){
echo ' class="alicon"';
}
echo '>'.$this->_tpl_vars['toprows'][$this->_tpl_vars['i']['key']]['caption'].'</a></li>
            ';
}
echo '
            ';
}
echo '
        </ul>
    </div>

    <div class="rightcont fr">
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['1']['title'].'</span>
            <ul class="tabs-menu-r">
                <li class="on">日</li>
                <li>周</li>
                <li>总</li>
            </ul>
            <div class="tabs-cont-r">
                <!-- 点击榜 日 -->
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                </ul>
                <!-- 点击榜 周 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
                </ul>
                <!-- 点击榜 总 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
                </ul>
            </div>
        </div>

        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['4']['title'].'</span>
            <ul class="tabs-menu-r">
                <li class="on">日</li>
                <li>周</li>
                <li>月</li>
            </ul>
            <div class="tabs-cont-r">
                <!-- 推荐榜 日 -->
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'
                </ul>
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
                </ul>
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['6']['content'].'
                </ul>
            </div>
        </div>
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['7']['title'].'</span>
            <div class="tabs-cont-r">
                <!-- 推荐榜 日 -->
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['7']['content'].'
                </ul>
            </div>
        </div>

        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['8']['title'].'</span>
            <ul class="tabs-menu-r">
                <li class="on">日</li>
                <li>周</li>
                <li>总</li>
            </ul>
            <div class="tabs-cont-r">
                <!-- 销售榜 日 -->
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['8']['content'].'
                </ul>
                <!-- 销售榜 周 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['9']['content'].'
                </ul>
                <!-- 销售榜 总 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['10']['content'].'
                </ul>
            </div>
        </div>
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['11']['title'].'</span>
            <div class="tabs-cont-r">
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['11']['content'].'
                </ul>
            </div>
        </div>
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['12']['title'].'</span>
            <div class="tabs-cont-r">
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['12']['content'].'
                </ul>
            </div>
        </div>
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['18']['title'].'</span>
            <ul class="tabs-menu-r">
                <li class="on">日</li>
                <li>周</li>
                <li>总</li>
            </ul>
            <div class="tabs-cont-r">
                <!-- 月票 日 -->
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['18']['content'].'
                </ul>
                <!-- 月票 周 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['19']['content'].'
                </ul>
                <!-- 月票 总 -->
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['20']['content'].'
                </ul>
            </div>
        </div>
        <div class="rank-list-w">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['14']['title'].'</span>
            <div class="tabs-cont-r">
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['14']['content'].'
                </ul>
            </div>
        </div>

        <div class="rank-list-w riches-rank">
            <span class="titmenu">'.$this->_tpl_vars['jieqi_pageblocks']['15']['title'].'</span>
            <ul class="tabs-menu-r">
                <li class="on">日</li>
                <li>周</li>
                <li>总</li>
            </ul>
            <div class="tabs-cont-r">
                <ul class="rank-1">
                    '.$this->_tpl_vars['jieqi_pageblocks']['15']['content'].'
                </ul>
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['16']['content'].'
                </ul>
                <ul class="rank-1" style="display: none">
                    '.$this->_tpl_vars['jieqi_pageblocks']['17']['content'].'
                </ul>
            </div>
        </div>
    </div>
</div>
';
}else{
echo '
<div class="block10"></div>
<div class="wrap1200 ranklist">
    <div class="leftbar fl">
        <ul data-type="dianji">
            ';
if (empty($this->_tpl_vars['toprows'])) $this->_tpl_vars['toprows'] = array();
elseif (!is_array($this->_tpl_vars['toprows'])) $this->_tpl_vars['toprows'] = (array)$this->_tpl_vars['toprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['toprows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['toprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['toprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['toprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['toprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            ';
if($this->_tpl_vars['toprows'][$this->_tpl_vars['i']['key']]['publish'] > 0){
echo '
            <li class="a'.$this->_tpl_vars['i']['order'];
if($this->_tpl_vars['order'] == $this->_tpl_vars['i']['key']){
echo ' on';
}
echo '"><a href="'.jieqi_geturl('article','toplist','1',$this->_tpl_vars['i']['key'],$this->_tpl_vars['sortid'],$this->_tpl_vars['fullflag']).'"';
if($this->_tpl_vars['i']['order'] == 1){
echo ' class="alicon"';
}
echo '>'.$this->_tpl_vars['toprows'][$this->_tpl_vars['i']['key']]['caption'].'</a></li>
            ';
}
echo '
            ';
}
echo '
        </ul>
    </div>

    <div class="right-cont-box fr rankdata">
        <div class="comment-r-menu">
            <span class=" fl r-c-t">'.$this->_tpl_vars['ordername'].'</span>
        </div>
        <div class="rankdatacont">
        <div class="tabsbox1">
            <div class="rankday">
                <ul class="clrbtn clrbtna">
                    <li class="clrbtn1 on"><a href="#"></a></li>
                    <li class="clrbtn2"><a href="#"></a></li>
                </ul>
                <div class="tabsday-cont">
                    <div class="tabs-cont-1">
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
                        <!-- 判断是不是点击 -->
                        <div class="secd-rank-list">
                            <dl>
                                <dt><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank"><img src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'"/></a></dt>
                                <dd>
                                    <a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" class="bigpic-book-name" target="_blank">
                                        <span class="num';
if($this->_tpl_vars['i']['order'] < 4){
echo ' red';
}
echo '">'.$this->_tpl_vars['i']['order'].'</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
                                    <p>
                                        <a href="javascript:;" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a> | <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortid']).'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sort'].'</a> | '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['fullflag'].' <span class="clicknum">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['allvisit'].' 点击</span></p>
                                    <p class="big-book-info">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'].'</p>
                                    <p>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_vipchapter'].'" target="_blank" class="red">最近更新 '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a>';
}else{
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank" class="red">最近更新 '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>';
}
echo '<span>| '.date('Y-m-d H:i:s',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</span></p>
                                </dd>
                            </dl>
                            <div class="bigbtn">
                                <a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" class="detailbtn" target="_blank">书籍详情</a>
                                ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['is_collection'] > 0){
echo '<a data-control="remove" href="javascript:;" data-Id="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="addbtn addshelf"><em>已在书架</em></a>';
}else{
echo '<a data-control="add" href="javascript:;" data-Id="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="addbtn addshelf">加入书架</a>';
}
echo '
                            </div>
                        </div>
                        ';
}
echo '
                    </div>
                    <div class="tablist">
                        <ul>
                            <li class="tab-title">
                                <a href="javascript:;" class="tr0">排名</a>
                                <a href="javascript:;" class="tr1">分类</a>
                                <a href="javascript:;" class="tr2">书名</a>
                                <a href="javascript:;" class="tr3">最新章节</a>
                                <a href="javascript:;" class="tr4">作者</a>
                                <a href="javascript:;" class="tr5">点击</a>
                                <a href="javascript:;" class="tr6">更新时间</a>
                                <a href="javascript:;" class="tr7">操作</a>
                            </li>
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
                            <!-- 判断是不是点击 -->
                            <li>
                                <a href="javascript:;" class="tr0"><span class="num';
if($this->_tpl_vars['i']['order'] < 4){
echo ' red';
}
echo '">'.$this->_tpl_vars['i']['order'].'</span></a>
                                <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortid']).'" target="_blank" class="tr1">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sort'].'</a>
                                <a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank" class="tr2">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
                                ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_vipchapter'].'" target="_blank" class="tr3">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a>';
}else{
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank" class="tr3">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>';
}
echo '
                                <a href="javascript:;" target="_blank" class="tr4">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>
                                <a href="javascript:;" class="tr5">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['allvisit'].'</a>
                                <a href="javascript:;" class="tr6">'.date('Y-m-d H:i:s',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</a>
                                ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['is_collection'] > 0){
echo '<a href="javascript:;" target="_blank" data-control="remove" data-Id="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="tr7 redcolor addshelf"><em>已在书架</em></a>';
}else{
}
echo '<a href="javascript:;" target="_blank" data-control="add" data-Id="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" class="tr7 redcolor addshelf">加入书架</a>
                            </li>
                            ';
}
echo '
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pages_bottom" style="display: block;">
                '.$this->_tpl_vars['url_jumppage'].'
            </div>
        </div>
    </div>
    </div>
</div>
';
}
echo '
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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/rank.js"></script>
<script>
    $(".nav_rank").addClass("curr");
</script>

';
?>