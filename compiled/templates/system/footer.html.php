<?php
if($this->_tpl_vars['jieqi_thisurl'] != '/'){
echo '
<div class="to_top ui-toTop" style="display: none;"></div>
<div class="rfloat">
    <ul>
        <li class="r-1"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookshelf.php"><i></i><span>最近阅读</span></a></li>
        <li class="r-2"><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php"
        >
            <i></i><span>充值</span></a></li>
        <!--<li class="r-3">-->
        <!--<a href="/about/contactus"><i></i><span>客服</span></a>-->
        <!--</li>-->

    </ul>
</div>
<!--footer-->
<div class="footer-box" style="clear:both;">	<p class="channel-font"><a href="/page.php?template=c_about" target="_blank">关于我们</a>            <a href="/page.php?template=c_contactus" target="_blank">联系我们</a>            <a href="/page.php?template=c_joinUs" target="_blank">加入我们</a>        </p>
    <p class="footer-announce">
        Copyright © 2018 '.$this->_tpl_vars['jieqi_url'].' All Rights Reserved. 陕西春墨秋香文化传播有限公司 版权所有<br>        请作者发布作品时，务必遵守国家互联网信息管理办法规定，本站拒绝任何色情内容，一经发现，即作删除。<br>        陕ICP备19012676号
    </p>
</div>
<script language="javascript">
    function AddFavorite(sURL, sTitle)
    {
        try
        {
            window.external.addFavorite(sURL, sTitle);
        }
        catch (e)
        {
            try
            {
                window.sidebar.addPanel(sTitle, sURL, "");
            }
            catch (e)
            {
                alert("加入收藏失败，请使用Ctrl D进行添加");
            }
        }
    }
</script>
';
}

?>