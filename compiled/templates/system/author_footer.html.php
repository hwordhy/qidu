<?php
echo '<div class="author-footer">
    '.$this->_tpl_vars['jieqi_sitename'].' 版权所有<br>
    <span>Copyright ? 2011-2018 '.$this->_tpl_vars['jieqi_url'].' All Rights Reserved.</span>
</div>
<div class="relation">
    <span class="ralamenu">联系客服</span>
    <p class="ralatxt">
                <span>
                       Q Q：2213788946<br>
                        电话：029-82285623<br>
                        邮箱：2213788946@qq.com
                </span>
    </p>

</div>
<script>
    $(\'.relation\').mouseenter(function(){
        $(\'.ralatxt\').stop(true).animate({ width : 180},500)
    }).mouseleave (function(){
        $(\'.ralatxt\').stop(true).animate({ width : 0},500)
    });
</script><script>
    $(function () {
        var height = $(\'.indexauthorhead_in\').outerHeight();
        $(\'.indexauthorhead_in\').css({height:0,overflow:\'hidden\',display:\'block\'});


        $(\'.indexauthorhead\').mouseenter(function () {
            $(\'.indexauthorhead_in\').stop().animate({
                height:height+\'px\'
            },\'fast\');
        })
        $(\'.indexauthorhead\').mouseleave(function () {
            $(\'.indexauthorhead_in\').stop().animate({
                height:0+\'px\'
            },\'fast\');
        });

        $(".goTop").removeClass(\'goTop\');

    })
</script>

</body>
</html>
';
?>