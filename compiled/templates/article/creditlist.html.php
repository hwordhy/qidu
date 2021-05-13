<?php
echo '
<div class="comment-box clearfixer">
  <div class="path ">
    <a href="/" target="_blank">首页</a>
    <span>></span>
    <a target="_blank" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a>
    <span>></span>
    <span>
            <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
        </span>
    <span>></span>
    <span>粉丝排行榜</span>
  </div>
  <div class="fl authorbox">
    <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'" class="authorimg" target="_blank"><img src="'.$this->_tpl_vars['url_image'].'"/></a>
    <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'" class="a-book-tit" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
    <a href="javascript:;" class="a-name" target="_blank">'.$this->_tpl_vars['author'].'</a>
    <p class="a-btn">
      <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleread.php?id='.$this->_tpl_vars['articleid'].'" class="a-free-btn btn ui_bgcolor ui_bg_bdcolor"
         target="_blank">免费试读</a>
      ';
if($this->_tpl_vars['is_bookcase'] > 0){
echo '
      <span class="a-bookshelf-btn onshelf btn">已在书架</span>
      ';
}else{
echo '
      <a href="javascript:;" class="addshelf a-bookshelf-btn btn">加入书架</a>
      ';
}
echo '
    </p>
  </div>
  <div class="reader_comments fr" id="comment-tab">
    <div class="comment_tit clearfixer">
      <span class="text fl">粉丝排行榜</span>
    </div>
    <div class="comment_con j-comment-main clear">
      <div class="fans_content">
      </div>
    </div>
    <div class="page-box">
      <div class="page-content"></div>
    </div>
  </div>
</div>
<div class="block20"></div>
<div id="floatbox">
  <div id="windowbg"></div>
</div>
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

<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/common_chapter.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/comment_list.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/template-web.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/page.js"></script>

<script>
    var page_config = {
        bookId:\''.$this->_tpl_vars['articleid'].'\',
        isInShelf:\''.$this->_tpl_vars['is_bookcase'].'\',  // true  表示已在书架
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        userLevel:"'.$this->_tpl_vars['jieqi_group'].'",
        userIcon:"'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'"
    }

</script>
<script type="text/html" id="fans_template">
  {{each data as his i}}
  <ul class="fans_table">
    <li class="fans_number ui_bg_bdcolor">{{his.index}}</li>
    <li class="fans_head"><a href="javascript:;" target="_blank"><img src="{{his.user_avatar}}"></a></li>
    <li class="fans_name"><a href="javascript:;" target="_blank">{{his.userName}}</a></li>
    <li class="fans_level">粉丝级别:<span>{{his.rank}}</span></li>
    <li class="fans_tip">粉丝值<span class="ui_color">{{his.point}}</span></li>
  </ul>
  {{/each}}
</script>
<script type="text/javascript">
    var ajaxObj, pageNo;
    //模板引用
    var template_Fn = function (data) {
        var html = template(\'fans_template\', data)
        $(".fans_content").html(html);
    }
    //DataAjax
    var DataAjax = function (pageNo) {
        ajaxObj = $.ajax({
            url: \'/modules/article/creditlist.php\',
            type: \'GET\',
            dataType: \'json\',
            async: true,
            data: {
                id: \''.$this->_tpl_vars['articleid'].'\',
                ajax_gets: 1,
                page: pageNo
            },
            success: function (data) {
                (data.pageCount > 0) ? $(\'.page-box\').show() : $(\'.page-box\').hide();
                template_Fn(data);//模板
                pageFn(data.pageCount, pageNo)//翻页

            }
        })
    }
    //翻页
    var pageFn = function (pageAll, current) {
        $(\'.page-content\').pagination({
            hoverCls: \'ui_hoverbgbd\',
            activeCls: \'ui_bg_bdcolor\',
            pageAll: pageAll,
            current: current,
            callback: function (page) {
                var pageCur = page.getCurrent();//当前页码
                if (ajaxObj) {
                    ajaxObj.abort();
                    ajaxObj = null;
                }
                DataAjax(pageCur);
            }
        }, function (page) {
        })
    }
    //初始  执行
    DataAjax(1);
    addShelf_zsy.initShelf($(\'.a-btn .a-bookshelf-btn\'));
</script>
';
?>