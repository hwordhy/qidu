<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
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
            <h1 class="page-header"><span class="f22">作品管理<img style="margin:0 15px;" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/arrow_1.png" /></span><span class="book_name_box">'.$this->_tpl_vars['articlename'].'</span>
            </h1>
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

            </script><div class="container-wrap chapter-txt">
            <form id="iform" name="iform" action="'.$this->_tpl_vars['url_newchapter'].'" method="post">
                <div class="txtbox">
                    <span class="wtitle">所在分卷:</span>
                    <div class="rbox">
                        <div id="parent" class="parent parentsel">
                            <select name="chapterorder" id="volumeId">
                                ';
if (empty($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = array();
elseif (!is_array($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = (array)$this->_tpl_vars['volumerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['volumerows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['volumerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['volumerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                                <option value="'.$this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['chapterorder'].'"';
if($this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['chapterorder'] == $this->_tpl_vars['chapterorder']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['volumename'].'</option>
                                ';
}
echo '
                            </select>
                            <i></i>
                        </div>
                        <em class="warning classMsg"></em>
                    </div>
                </div>
                <div class="txtbox">
                    <span class="wtitle">章节名称:</span>
                    <div class="rbox">
                        <input id="chapterName" name="chaptername" placeholder="第一章 XXX..." type="text"
                               value="'.$this->_tpl_vars['chaptername'].'" class="textbox" maxlength="50">
                    </div>
                    <em class="warning chapter-nameMsg"></em>

                </div>
                <div class="txtbox">
                    <span class="wtitle">保存草稿:</span>
                    <div class="rbox">
                        <div class="radiobox radiobox-time">
                            <label>
                                <input type="checkbox" name="caogao" id="caogao" checked />
                                开启自动本地保存（每30秒自动保存一次）
                            </label>
                        </div>
                        <div id="tipWrap" style="color: #ff0000;"><span class="tipMsg"></span></div>
                    </div>
                </div>
                <div style="position: relative;">
                    <div class="txtbox txtboxinfo">
                        <span class="wtitle"></span>
                        <div class="rbox" style="width: 760px;">
                                <textarea name="chaptercontent" id="content" maxlength="100000"
                                          class="textarea textarea-single Words-calculation"
                                          nospace="ture">'.$this->_tpl_vars['chaptercontent'].'</textarea>
                            <span class="contnumber"><em id="content-status"></em>/100000</span>

                        </div>
                        <p class="diffmark" style="display: none;width:760px;">
                            <span class="tipstit"></span>
                        </p>

                        <em class="warning introMsg"></em>
                    </div>
                    <div class="setcontbtn" style="display: none"><input type="button" name="" id="autoCompose"
                                                                         value="自动排版"></div>
                </div>
                <div class="txtbox txtboxinfo">
                    <span class="wtitle">作者本章说：</span>
                    <div class="rbox">
                        <textarea placeholder="请输入对作者对本章想说内容" name="notice" id="promote" class="textarea" maxlength="300"></textarea>
                        <span class="fb" id="promote-status"></span>
                    </div>
                    <em class="warning promoteMsg"></em>
                </div>
                ';
if($this->_tpl_vars['authtypeset'] == 1){
echo '
                <div class="txtbox">
                    <span class="wtitle">小说排版:</span>
                    <div class="rbox">
                        <div class="radiobox">
                            <label class="radio-l checked">
                                <input type="radio" name="typeset" id="typeset" value="1" checked>
                            </label>
                            自动排版
                        </div>
                        <div class="radiobox">
                            <label class="radio-l">
                                <input type="radio" name="typeset" id="typeset" value="0">
                            </label>
                            无需排版
                        </div>
                    </div>
                </div>
                ';
}
echo '
                ';
if($this->_tpl_vars['issign'] >= 10 && $this->_tpl_vars['isvip'] > 0){
echo '
                <div class="txtbox">
                    <span class="wtitle">章节类型:</span>
                    <div class="rbox">
                        <div class="radiobox">
                            <label class="radio-l ';
if($this->_tpl_vars['cvip'] == 0){
echo 'checked';
}
echo '">
                                <input type="radio" name="isvip" id="radio-free" value="0" ';
if($this->_tpl_vars['cvip'] == 0){
echo 'checked';
}
echo '  >
                            </label>
                            免费章节
                        </div>
                        <div class="radiobox">
                            <label class="radio-l ';
if($this->_tpl_vars['cvip'] > 0){
echo 'checked';
}
echo '">
                                <input type="radio" name="isvip" id="radio-notie" value="1" ';
if($this->_tpl_vars['cvip'] > 0){
echo 'checked';
}
echo '>
                            </label>
                            VIP章节
                        </div>
                    </div>
                </div>
                ';
if($this->_tpl_vars['customprice'] > 0){
echo '
                <div class="txtbox">
                    <span class="wtitle">本章价格:</span>
                    <div class="rbox">
                        <input id="price" name="saleprice" placeholder="" type="text" value="'.$this->_tpl_vars['saleprice'].'" class="textbox" maxlength="2" style="width: 100px;">&nbsp;&nbsp;枚'.$this->_tpl_vars['egoldname'].'
                    </div>
                </div>
                ';
}
echo '
                ';
}
echo '
                <div class="txtbox" style="overflow: visible;margin-top: 10px;">
                    <span class="wtitle">发表方式:</span>
                    <div class="rbox">
                        <div class="radiobox" onclick="$(\'#pubtime\').hide()">
                            <label class="radio-l checked">
                                <input type="radio" name="posttype" value="0">
                            </label>
                            直接发表
                        </div>
                        <div class="radiobox" onclick="$(\'#pubtime\').hide()">
                            <label class="radio-l">
                                <input type="radio" name="posttype" value="1">
                            </label>
                            存为草稿
                        </div>
                        <div class="radiobox" onclick="$(\'#pubtime\').show()">
                            <label class="radio-l">
                                <input type="radio" name="posttype" id="check-timing" value="2">
                            </label>
                            定时发布 <input type="text" id="pubtime" name="pubtime" style="width: 160px!important;height:30px;display: none;" class="text datepicker" value="'.date('Y-m-d H:i:s',$this->_tpl_vars['jieqi_time']).'"/>
                        </div>
                    </div>
                </div>
                ';
if($this->_tpl_vars['needupaudit'] > 0){
echo '
                <div class="exp">
                    <ul>
                        <li class="exp_txt">温馨提示：</li>
                        <li>直接发表的章节也会先保存在草稿箱待审章节列表中，管理员审核后才能正常显示。</li>
                    </ul>
                </div>
                ';
}
echo '
                <div class="submitbtn">
                    <input type="hidden" name="ajax_gets" value="1" />
                    <input type="hidden" name="act" value="newchapter" />'.$this->_tpl_vars['jieqi_token_input'].'
                    <input type="hidden" name="aid" value="'.$this->_tpl_vars['articleid'].'" />
                    ';
if($this->_tpl_vars['draftid'] > 0){
echo '<input type="hidden" name="draftid" value="'.$this->_tpl_vars['draftid'].'" />';
}
echo '
                    <input type="button" class="btn-submit" value="立即发布" title="立即发布" name="save" id="btsave">
                </div>
            </form>
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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/laydate/laydate.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/jquery_autosave.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/motie.editor.js"></script>

<script type="text/javascript">
    var chapterid = \''.$this->_tpl_vars['articleid'].'\';
    $(function () {
        var savedstr = $(\'#content\').val();
        $(\'#content\').autoSave({cbbox:\'caogao\'});
        var lastsave = $.fn.autoSave.getClientData("lastsave"+chapterid);
        if(lastsave!== null && lastsave !== "" && savedstr !== lastsave){
            layer.confirm(\'是否载入最近一次未保存的文章草稿？\', {
                btn: [\'是\',\'否\'] //按钮
            }, function(){
                $(\'#content\').val(lastsave);
                $(\'#content\').focus();
                $(\'#content\').keyup();
                layer.closeAll(\'dialog\');
            });
        }

        $(".btTip").click(function (){
            layer.msg(\'完本作品不能操作\', {
                time: 2000, //s后自动关闭
            });

        })

        //时间选择器
        laydate.render({
            elem: \'#pubtime\'
            ,type: \'datetime\'
        });

        var save = function (data) {
            var url = "'.$this->_tpl_vars['url_newchapter'].'";
            popUp.openLoading(\'正在提交..\');
            $.ajax({
                url: url,
                type: \'POST\',
                cache: false,
                data: data,
                dataType: "json",
                processData: false,
                contentType: false
            }).done(function(result) {
                if(result.success==true){
                    popUp.close();
                    popUp.openTips("发表成功！");
                    setTimeout(function(){
                        window.location.href=result.backUrl;
                    }, 3000);
                }
                else{
                    popUp.close();
                    popUp.openTips(result.message);
                }
            })
        };


        $(\'#btsave\').click(function () {
            if (preSave() == false) {
                return;
            }
            var data = new FormData($(\'#iform\')[0]);
            disabledButton(true);
            save(data);
        });

        var disabledButton = function (flag) {
            if (flag == true) {
                $("#btsave").attr("disabled", true);
                $("#btsavedraft").attr("disabled", true);
            } else {
                $("#btsave").attr("disabled", false);
                $("#btsavedraft").attr("disabled", false);
            }

        }


        //给所有的单选按钮点击添加处理
        $(".radiobox").click(function () {
            var checkedEle = $(\'.radiobox .checked\');

            if (checkedEle) {
                //\'freeType-vip\'==

                $(this).children(\'.radio-l\').addClass("checked");
                //$(this).addClass("radiotime");
                //$(this).siblings().removeClass("radiotime");
                var ele = $(this).children(\'.radio-l\').children(\'input[name="isvip"]\');
                if (ele) {
                    $(ele).attr("checked", true);
                }
                ele = $(this).children(\'.radio-l\').children(\'input[name="posttype"]\');
                if (ele) {
                    $(ele).attr("checked", true);
                }
                ele = $(this).children(\'.radio-l\').children(\'input[name="typeset"]\');
                if (ele) {
                    $(ele).attr("checked", true);
                }

                $(this).siblings().children(\'.radio-l\').removeClass("checked");
                ele = $(this).siblings().children(\'.radio-l\').children(\'input[name="freeType"]\');
                if (ele) {
                    $(ele).attr("checked", false);
                }
                /* ele = $(this).siblings().children(\'.radio-l\').children(\'input[name="submitType"]\');
                 if(ele){
                 $(ele).attr("checked",false);
                 }*/

            } else {
                $(this).children(\'.radio-l\').removeClass("checked");
                //$(this).removeClass("radiobox-time");
                $(this).siblings().children(\'.radio-l\').addClass("checked");

            }


        });

        var preSave = function () {

            $(".warning").empty();
            var inputName = $.trim($("input[name=\'chaptername\']").val()).length;
            if (inputName == 0) {
                $(".chapter-nameMsg").append(\'请填写章节名称！\');
                return false;
            } else {
                $(".chapter-nameMsg").append(\'<img src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/rgtdot.png" />\');
            }
            return true;

        };

        //编辑器
        Motie.editor.article({
            imgCount: 0
            , content: \'#content\'
            , imgAppendTo: \'#imageLabel ul\'
            , wordStatus: \'#content-status\'
            , uploadImgUrl: \'/ajax/image/temp/add\'
            , delImgUrl: \'/ajax/image/del\'
            , uploadImgHandle: \'#add_image_link\'
            , autoComposeHandle: \'#autoCompose\'
            , articleId: ( 0)
            , type: 4
        });

        $(\'#content\').blur(function () {
            $(\'#autoCompose\').click();
        })

    });

    $(document).ready(function () {
        $(".n02 a").addClass(\'active\');
        $("#manage-bar-2").addClass(\'m-currunt\');
    });
</script>

';
?>