<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/user_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<div class="i-right">
    <!--top mod -->
    <div class="i-top">
        <!--个人状态 mod -->
        <div class="iDetail">
            <dl style="padding-top:45px;" >
                <dt><a href="javascript:;" target="_blank"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" /></a></dt>
                <dd>
                    <p><a href="javascript:;" target="_blank">'.$this->_tpl_vars['uname'].'</a><a href="javascript:;" target="_blank">
                    </a></p>
                </dd>
            </dl>
            <p class="medal">
            </p>
        </div>
        <!--关注及粉丝 mod -->
        <div class="iAttend">
            <a href="javascript:;" target="_blank">
                等级
                <em></em>
                <b>'.$this->_tpl_vars['group'].'</b>
            </a>
            <a href="javascript:;" target="_blank">
                头衔
                <em></em>
                <b>'.$this->_tpl_vars['honor'].'</b>
            </a>
        </div>
        <!--书架&阅读 mod -->
        <div class="iBookshelf">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" target="_blank"><em>书架</em>'.$this->_tpl_vars['nowbookcase'].'</a>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookshelf.php" class="readed" target="_blank"><em>阅读</em>'.$this->_tpl_vars['historynums'].'</a>
        </div>
        <!-- mod -->
        <div class="iAttend iTicket">
            <a href="javascript:;" target="_blank">
                '.$this->_tpl_vars['egoldname'].'<em></em>
                <b class="red">'.$this->_tpl_vars['egold'].'</b>
            </a>
            <a href="javascript:;" target="_blank">
                月票
                <em></em>
                <b class="red">'.$this->_tpl_vars['jieqi_setting']["gift"]["vipvote"].'</b>
            </a>
            <a href="javascript:;" target="_blank">
                推荐票
                <em></em>
                <b class="red">'.$this->_tpl_vars['jieqi_votes'].'</b>
            </a>
        </div>
    </div>
    <!--bot mod -->
    <div class="i-bot">
        <!--left mod -->
        <div class="l-botMod">
            <!--我的书架 mod -->
            <div class="myMod"  id="myMod">
                <div class="i-title">我的书架<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="clickMore" target="_blank">查看更多>></a></div>
                <!--有书的情况 mod -->
                <ul class="bookUl">
                    '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'

                </ul>
            </div>
            <!--热读作品 mod -->
            <div class="myMod hotMod">
                <div class="i-title">
                    热读作品
                    <ul class="tabHd">
                        <li class="on"></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <!--有书的情况 mod -->
                <div class="tabBd">
                    <ul class="hotBookBd  ">
                        '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
                    </ul>
                    <ul class="hotBookBd hide ">
                        '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
                    </ul>
                    <ul class="hotBookBd hide ">
                        '.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'
                    </ul>
                </div>
            </div>
        </div>
        <!--right mod -->
        <div class="r-botMod">
            <!--我的作品 mod -->
            <!--猜你喜欢 mod -->
            <div class="myWorks myLike">
                <div class="i-title">'.$this->_tpl_vars['jieqi_pageblocks']['5']['title'].'</div>
                <ul>
                    '.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!--footer mod -->
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<script>
    $(\'a\').attr(\'data-namecard\',false);
    jQuery(".hotMod").slide({titCell:".tabHd li",mainCell:".tabBd",autoPlay:"auto",interTime: 2000});
</script>
</body>
</html>
';
?>