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
            <h1 class="page-header"><span class="f22">作品管理<img style="margin:0 15px;" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/arrow_1.png" /></span><span class="book_name_box">';
if($this->_tpl_vars['chaptertype'] == 1){
echo '编辑分卷';
}else{
echo '编辑章节';
}
echo '</span>
            </h1>

            <script type="text/javascript">
                //处理左侧菜单的样式
                $(document).ready(function() {
                    $(".n02 a").addClass(\'active\');


                });

            </script><div class="container-wrap chapter-txt">
            <form id="iform" name="iform" action="'.$this->_tpl_vars['url_chapteredit'].'" method="post">
                <div class="txtbox">
                    <span class="wtitle">作品名称:</span>
                    <div class="rbox">
                        <input type="text" value="'.$this->_tpl_vars['articlename'].'" class="textbox" maxlength="50" disabled>
                    </div>
                </div>
                <div class="txtbox">
                    <span class="wtitle">';
if($this->_tpl_vars['chaptertype'] == 1){
echo '分卷名称:';
}else{
echo '章节名称:';
}
echo '</span>
                    <div class="rbox">
                        <input id="chapterName" name="chaptername" placeholder="第一章 XXX..." type="text"
                               value="'.$this->_tpl_vars['chaptername'].'" class="textbox" maxlength="50">';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['chaptertype'] == 0){
echo '<span style="color: #ff0000;">VIP</span>';
}
echo '
                    </div>
                    <em class="warning chapter-nameMsg"></em>
                </div>
                ';
if($this->_tpl_vars['chaptertype'] != 1){
echo '
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
                        <textarea placeholder="请输入对作者对本章想说内容" name="notice" id="promote" class="textarea" maxlength="300">'.$this->_tpl_vars['notice'].'</textarea>
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
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '
                <div class="txtbox">
                    <span class="wtitle">本章价格:</span>
                    <div class="rbox">
                        <input id="price" name="saleprice" placeholder="" type="text" value="';
if($this->_tpl_vars['autoprice'] == 0){
echo $this->_tpl_vars['saleprice'];
}
echo '" class="textbox" maxlength="2" style="width: 100px;">&nbsp;&nbsp;枚'.$this->_tpl_vars['egoldname'].'
                    </div>
                </div>
                ';
}
echo '
                ';
}
echo '
                <div class="submitbtn">
                    <input type="hidden" name="ajax_gets" value="1" />
                    <input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
                    <input type="hidden" name="id" value="'.$this->_tpl_vars['chapterid'].'" />
                    <input type="hidden" name="chaptertype" value="'.$this->_tpl_vars['chaptertype'].'" />
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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/motie.editor.js"></script>
<script type="text/javascript">
    $(function () {
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
            var url = "'.$this->_tpl_vars['url_chapteredit'].'";
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
                    popUp.openTips("修改成功！");
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
                var ele = $(this).children(\'.radio-l\').children(\'input[name="typeset"]\');
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