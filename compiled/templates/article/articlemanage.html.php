<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<style>
    .submit{
        width: 98px;
        height: 34px;
        line-height: 35px;
        color: #ffffff;
        font-size: 16px;
        margin: 5px;
        background: #21ade5;
        border: none;
    }
    .submit:hover{
        background:#337ab7;
        color:#ffffff;
    }
    .submit_2{
        width: 120px;
        height: 34px;
        line-height: 35px;
        color: #ffffff;
        font-size: 16px;
        margin: 5px;
        background: #21ade5;
        border: none;
    }
    .submit_2:hover{
        background:#337ab7;
        color:#ffffff;
    }
    .span_checkbox{
        width: 300px;
        display: inline-block;
        float: left;
    }
</style>
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
            <h1 class="page-header"><span class="f22">作品管理<img style="margin:0 15px;" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/arrow_1.png" /></span><span class="book_name_box">'.$this->_tpl_vars['articlename'].'</span></h1>
            <div class="manage-bar">
                <a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'" id="manage-bar-1">作品管理</a>
                <a href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articleid'].'" id="manage-bar-2">新建章节</a>
                <a href="'.$this->_tpl_vars['article_static_url'].'/newvolume.php?aid='.$this->_tpl_vars['articleid'].'" id="manage-bar-3">新建分卷</a>
                <a href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articleid'].'" id="manage-bar-4">作品信息</a>
            </div>

            <script type="text/javascript">
                //处理左侧菜单的样式
                $(document).ready(function() {
                    $(".n02 a").addClass(\'active\');


                });

            </script>
            <div style="position: relative;margin-left: 40px;margin-right: 40px;padding-bottom: 30px;">
                <div class="book-catalogue-title">章节排序</div>
                <div style="border: 1px solid #b1b1b1;font-size: 16px;height:60px;overflow-y: auto;">
                    <form name="chaptersort" id="chaptersort" action="'.$this->_tpl_vars['url_chaptersort'].'" method="post">
                        <tr>
                            <td class="article-title">&nbsp;&nbsp;选择章节或分卷：</td>
                            <td class="article-title">
                                <select style="height: 34px; margin-top: 10px;width: 280px;"  size="1" name="fromid" id="fromid">
                                    ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['chapterrows']);
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
                            </td>
                        </tr>
                        <tr valign="middle" align="left">
                            <td class="article-title">&nbsp;&nbsp;移动到：</td>
                            <td class="article-title">
                                <select style="height: 34px; margin-top: 10px;width: 280px;"  size="1" name="toid" id="toid" style="width: 280px;">
                                    <option value="0">--最前面--</option>
                                    ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['chapterrows']);
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
                                <span class="hot">之后</span>
                            </td>
                        </tr>
                        <tr valign="middle" align="left">
                            <td class="tdl">&nbsp;</td>
                            <td class="tdr">
                                <input type="submit" class="submit fr" name="submit_sort"  id="submit_sort" value="确 定"/>
                                <input type="hidden" name="aid" id="aid" value="'.$this->_tpl_vars['articleid'].'" />
                                <input type="hidden" name="act" value="sort" />'.$this->_tpl_vars['jieqi_token_input'].'
                            </td>
                        </tr>
                    </form>
                </div>
            </div>
            <div style="position: relative;margin-left: 40px;margin-right: 40px;padding-bottom: 30px;">
                <div class="book-catalogue-title">重新生成</div>
                <div style="border: 1px solid #b1b1b1;font-size: 16px;height:105px;overflow-y: auto;">
                    <form name="repack" id="repack" action="'.$this->_tpl_vars['url_repack'].'" method="post">
                            <div style="margin-left: 10px;">选择标签：</div>
                            <div>
                                ';
if (empty($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = array();
elseif (!is_array($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = (array)$this->_tpl_vars['packflag'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['packflag']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['packflag']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['packflag']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                                <div class="radiobox radiobox-time" style="display: inline-block;">
                                    <label>
                                        &nbsp;&nbsp;<input type="checkbox" name="packflag[]" id="check-timing" value="'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['value'].'" style="margin-right:17px">'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['title'].'</label>
                                </div>
                                ';
}
echo '
                                <input type="submit" class="submit fr" name="submit_repack" id="submit_repack" value="确 定" />
                            </div>
                            <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />
                            <input type="hidden" name="act" value="repack" />'.$this->_tpl_vars['jieqi_token_input'].'
                    </form>
                </div>
            </div>
            <div class="container-wrap chapter-txt book-catalogue-wrap">
            <div class="book-sidebar">
                <form name="chapterdel" id="chapterdel" action="'.$this->_tpl_vars['url_chaptersdel'].'" method="post">
                    <input type="hidden" name="articleid" id="articleid" value="'.$this->_tpl_vars['articleid'].'" />
                    <input type="button" name="allcheck" value="选择全部章节" class="submit_2" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }">&nbsp;&nbsp;
                    <input type="button" name="nocheck" value="取消全部选中" class="submit_2" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }">&nbsp;&nbsp;
                    <select style="height: 34px;"  size="1" name="act" id="act">
                        <option value="">--选择操作--</option>
                        <option value="delete">批量删除章节</option>
                        <option value="free">批量改为免费章节</option>
                        <option value="vip">批量改为VIP章节</option>
                        <option value="show">批量显示章节</option>
                        <option value="hide">批量隐藏章节</option>
                    </select>
                    '.$this->_tpl_vars['jieqi_token_input'].'
                    <input type="submit" name="submit" value="确定" class="submit">
                    <div class="book-catalogue-title">目录</div>
                    <div class="book-catalogue">
                        ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                        ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 1){
echo '
                        ';
if($this->_tpl_vars['i']['order'] > 1){
echo '</ul></div>';
}
echo '
                        <div class="book-title" id="menu'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'">
                            <input type="checkbox" style="position: absolute;margin-top: 15px;" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
                            <a href="javascript:;" style="position: absolute;width:150px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;margin-left: 20px;">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a><a href="javascript:delchapter(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\', 1);" style="color: #fff;width: 60px; background: #ff0000;margin-right: 50px;padding-top: 0px !important;margin-top: 10px;" class="setup">删除</a><a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" style="color: #fff;width: 60px;padding-top: 0px !important;margin-top: 10px;" class="setup">编辑</a>
                            <div class="panelctl" data-volume-id="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" data-chapter-num="1">
                                <div  class="triangle-up"></div>
                            </div>
                        </div>
                        <div id="list'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="article-title" style="display: block;">
                            <ul>
                                ';
}else{
echo '
                                ';
if($this->_tpl_vars['i']['order'] == 1){
echo '
                                <div id="list'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="article-title" style="display: block;">
                                    <ul>
                                ';
}
echo '
                                <li onmouseover="showTip(this)" onmouseleave="hiddentip(this)" data-words="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'" data-price="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['saleprice'].'" data-publishTime="'.date('Y-m-d H:i',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'" data-chapter_type_name="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip'].'" data-isvip="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'].'" data-open="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'].'" data-id="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'"><input type="checkbox" style="position: absolute;margin-top: 15px;" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
                                    <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterread'].'" target="_blank" style="position: absolute; margin-left: 20px;"><i ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo 'style="color:#ff0000;"';
}
echo '>'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</i></a><a href="javascript:delchapter(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\', 0);" style="color: #fff;width: 60px; background: #ff0000;" class="setup">删除</a> ';
if($this->_tpl_vars['ismanager'] > 0){
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display_n'] > 0){
echo '<a href="javascript:hideshow(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'show\');" style="background-color: #09BA07;color: #fff;width: 60px;padding-top: 0px !important;" id="hideshow'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="setup setbtn">显示</a>';
}else{
echo '<a href="javascript:hideshow(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'hide\');" style="background-color: #09BA07;color: #fff;width: 60px;padding-top: 0px !important;" id="hideshow'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="setup setbtn">隐藏</a>';
}
}
if($this->_tpl_vars['issign_n'] >= 10 && $this->_tpl_vars['candelete'] > 0){
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<a href="javascript:vipfree(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'free\');" style="color: #fff;width: 60px;padding-top: 0px !important;" id="vipfree_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="setup setbtn">免费</a>';
}else{
echo '<a href="javascript:vipfree(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'vip\');" style="color: #fff;width: 60px;padding-top: 0px !important;" id="vipfree_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="setup setbtn">VIP</a>';
}
}
echo '<a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" style="color: #fff;width: 60px;" class="setup">编辑</a>

                                </li>
                                ';
}
echo '
                                ';
}
echo '
                            </ul>
                        </div>
                        <div class="timingshow" style="width:220px;height:110px;display: none;z-index: 1111">
                            <p class="textshow"  style="height:110px;">
                                <span class="arrowleft"></span>
                                <span class="fname"><em id="chapterTypeName"></em> <em id="words" style="margin-left: 8px"></em>字</span>
                                <span class="fdata" id="createTime"></span>
                                <span class="fdata" id="publishTime"></span>
                                <span class="fdata" id="readNum"><em style="font-style: normal"></em></span>
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <script type="text/javascript">
                // function changeAction(){
                //     //默认是login.action，当select改变时同时改变from的action属性
                //     //我这里直接把列表的value赋值到form的action，你可以根据需要改改
                //     var selectValue=document.getElementById(\'act\').value;
                //     var deletes = \''.$this->_tpl_vars['url_chaptersdel'].'\';
                //     var types = \''.$this->_tpl_vars['article_static_url'].'/chaptersset.php\';
                //     if(selectValue == \'delete\'){
                //         document.chapterdel.action=deletes;
                //     }
                //     else{
                //         document.chapterdel.action=types;
                //     }
                // }

                $(function() {


                    //侧边栏
                    $(\'body\').on(\'click\', \'.panelctl\', function () {

                        var menuDiv = $(this).parents().next(\'.article-title\');
                        var hasDiv = $(this).children().hasClass(\'triangle-up\');
                        $(this).children().removeClass(\'triangle-up\');
                        $(this).children().addClass(\'triangle-down\');
                        if ( hasDiv) {
                            $(this).children().removeClass(\'triangle-up\');
                            $(this).children().addClass(\'triangle-down\');
                            menuDiv.hide();
                        }else{
                            $(this).children().addClass(\'triangle-up\');
                            $(this).children().removeClass(\'triangle-down\');
                            menuDiv.show();
                        }
                    })

                })



                var  showTip = function (obj) {
                    var words = $(obj).data(\'words\');
                    var open = $(obj).data(\'open\');
                    var price = $(obj).data(\'price\');
                    var isvip = $(obj).data(\'isvip\');
                    var publishTime = $(obj).data(\'publishtime\');
                    var chapter_type_name = $(obj).data(\'chapter_type_name\');
                    $(\'#chapterTypeName\').html(chapter_type_name);
                    $(\'#words\').html(words);
                    $(\'#createTime\').html("状态："+open);
                    $(\'#publishTime\').html("发布时间："+publishTime);
                    if (isvip == 1){
                        $(\'#readNum em\').html("销售单价：" + price);
                    }
                    else{
                        $(\'#readNum em\').html("");
                    }



                    var liTop =$(obj).position().top;

                    var liLen = ($(\'.article-title ul li\').height()-$(\'.timingshow\').height())/2;
                    var totleTop = liTop + liLen;
                    $(\'.timingshow\').css({\'top\':totleTop}).show();

                }

                var  hiddentip = function (obj) {

                    $(\'#words\').html(\'\');

                    $(\'#chapterTypeName\').html(\'\');

                    $(\'#publishTime\').html(\'\');

                    $(\'.timingshow\').hide();

                    $(\'#readNum em\').html(\'\');

                }
            </script>
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
<script type="text/javascript">

    function delchapter(id, type) {
        layer.confirm(type > 0 ? \'您确实要删除该分卷么？\' : \'您确实要删除该章节么？\', {
            btn: [\'是\',\'否\'] //按钮
        }, function(){
            layer.closeAll(\'dialog\');
            $.post("/modules/article/chapterdel.php",
                {"id":id,"chaptertype":type,"act":"delete","jieqi_token":"'.$this->_tpl_vars['jieqi_token'].'","ajax_gets":1},
                function(data){
                    if (data.success) {
                        layer.msg(data.message, {
                            time: 3000000, //3s后自动关闭

                    });
                        window.location.reload();//刷新当前页面.
                    }
                    else {
                        layer.msg(data.message, {
                            time: 3000, //3s后自动关闭
                            offset: \'170px\',
                        });
                    }
                }
            ,\'json\');
        });
    }

    function vipfree(id, type) {
            layer.confirm(type == "free" ? \'您确实要将本章节设为免费么？\' : \'您确实要将本章节设为VIP么？\', {
                btn: [\'是\',\'否\'] //按钮
            }, function(){
                layer.closeAll(\'dialog\');
                var types = type == "free" ? "vip" : "free";
            $.post("/modules/article/chapterset.php",
                {"id":id,"chaptertype":0,"act":type,"jieqi_token":"'.$this->_tpl_vars['jieqi_token'].'","ajax_gets":1},
                function(data){
                    if (data.success) {
                        layer.msg(data.message);
                        $(\'#vipfree_\'+id).attr("href", "javascript:vipfree(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'"+types+"\');"),$(\'#vipfree_\'+id).text(type == "free" ? \'VIP\' : \'免费\');

                    }
                    else {
                        layer.msg(data.message, {
                            time: 3000, //3s后自动关闭
                            offset: \'170px\',
                        });
                    }
                },\'json\'
            );
        });
    }

    function hideshow(id, type) {
        layer.confirm(type == "show" ? \'您确实要显示本章节么？\' : \'您确实要隐藏本章节么？\', {
            btn: [\'是\',\'否\'] //按钮
        }, function(){
            layer.closeAll(\'dialog\');
            var types = type == "show" ? "hide" : "show";
            $.post("/modules/article/chapterset.php",
                {"id":id,"chaptertype":0,"act":type,"jieqi_token":"'.$this->_tpl_vars['jieqi_token'].'","ajax_gets":1},
                function(data){
                    if (data.success) {
                        layer.msg(data.message);
                        $(\'#hideshow\'+id).attr("href", "javascript:hideshow(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'\',\'"+types+"\');").text(type == "show" ? \'隐藏\' : \'显示\');
                        type = null;
                    }
                    else {
                        layer.msg(data.message, {
                            time: 3000, //3s后自动关闭
                            offset: \'170px\',
                        });
                    }
                },\'json\'
            );
        });
    }

    //处理左侧菜单的样式
    $(document).ready(function() {
        $("#manage-bar-1").addClass(\'m-currunt\');
    });




</script>
';
?>