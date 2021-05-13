<?php
echo '
<!doctype html>
<html lang="zh-cmn-Hans">
    <head>
    <title>'.$this->_tpl_vars['article_title'].'-'.$this->_tpl_vars['jieqi_title'].'-'.$this->_tpl_vars['sortname'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
    <meta charset="gbk" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="Baiduspider" content="noarchive">
    <meta name="keywords" content="九舞文学,九舞小说,九舞小说网,言情小说,青春小说,玄幻小说,武侠小说,都市小说,历史小说,网络小说,原创网络文学" />
    <meta name="description" content="春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说最新章节免费小说阅读,精彩尽在九舞文学！" />
    <meta name="renderer" content="webkit">
    <meta name ="viewport" content ="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="九舞文学">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="wap-font-scale" content="no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="/themes/jieqi220/css/base.css">
	<link rel="stylesheet" href="/sink/css/sty.css">
    <!--<link type="text/css"  rel="stylesheet" href="css/wapjieri.css" />-->
  <script type="text/javascript" src="/wap/js/pagewap.js"></script>
  <script type="text/javascript" src="/scripts/common1.js"></script>
    <script src="/themes/jieqi220/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<link type="text/css"  rel="stylesheet" href="/themes/jieqi220/css/read.css" />
</head><body><!--内容区--><!--导航-->
        
                 <section class="wapheader othead"> 
                  <section class="container">
                   <a href="/" title="'.$this->_tpl_vars['jieqi_sitename'].'" class="fl logo"></a> 
                   <span class="right fr"><a href="/">首页</a>
                    <a href="/top">排行</a>
                     <a href="/modules/article/articlefilter.php">书库</a>
                     <a href="/sou.php">搜索</a>
                     <a href="/modules/pay/buyegold.php?t=paycardpay">充值</a></span>
                  </section>
                 </section>
                 <!--菜单-->
                 <section class="menu  newus clearfix">
                  <section class="container">
                   <div class="topmenu">
                    <!--登录后-->
                    ';
if($this->_tpl_vars['jieqi_userid'] ==0){
echo ' 
                    <a href="/register.php">注册</a>
                    <a href="/login.php">登录</a>
                    <a href="/api/weixin/login.php" class="wechat"></a>
                    <a href="/api/qq/login.php" class="qq"></a>
                    <a href="/api/weibo/login.php" class="weibo"></a>
                        <!--登录前 end-->
                    ';
}else{
echo '
                    <a href="/modules/article/bookcase.php">我的收藏</a>
                    <a href="/userdetail.php" class="allways">
                        <img src="http://q.qlogo.cn/qqapp/101229138/1338A1D1A46947A2AF02FAE9C126CE08/100" class="bd50" /></a>
                        ';
}
echo '  
                    <!--登录后 end-->
                   </div>
                  </section>
                 </section>
                 <!--菜单 end-->
                 <div class="readbg ">
                  <!-- 头部end -->
                  <!--阅读页-->
                  <section class="reading">
                   <!--通知
                   <section class="allnotice  notice_down">
                    <section class="container">
                     <a href="http://m.cmqxwx.com/Book/content/book_id/36514" data-recommendid="95290">伪青梅竹马宠文 ，贱人自有天收</a>
                    </section>
                   </section>
                   通知 end-->
                   <div class="container">
                    <p class="here"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['article_title'].'&nbsp;</a><b>&gt;</b>
                        <a href="'.$this->_tpl_vars['url_index'].'" title="">章节目录 </a>
                        <a id="a_addbookcase" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(\''.$this->_tpl_vars['url_bookcase'].'\', {method: \'POST\',eid: \'a_addbookcase\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);" class="addfav  fr">添加收藏</a></p>
                    <h1>'.$this->_tpl_vars['jieqi_title'].'</h1>
                    <h3 class="clearfix"><b class="font_total">'.date('Y-m-d H:i',$this->_tpl_vars['chaptertime']).'更新 | '.$this->_tpl_vars['chaptersize_c'].'字</b>
                        <a href="javascript:;" class=" fr wmores ">设置</a></h3>
                    <h3 class="clearfix mcats"><a href="javascript:;" class="asmall fr bd3">-A</a>
                        <a href="javascript:;" class="abig fr bd3">+A</a>
                        <a href="javascript:;" class="daynight blacks fr " rel="night"><em></em></a>
                        <a href="javascript:;" class="daynight whites fr " rel="white"><em></em></a>
                        <a href="javascript:;" class="daynight yellows fr " rel="yellow"><em></em></a>
                        <a href="javascript:;" class="daynight greens fr " rel="green"><em></em></a>
                     <!--        <a href="" class="fr bd3">目录</a>--></h3>
                    <div class="con_tent">
                         '.str_replace('<p>','<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$this->_tpl_vars['jieqi_content']).'

                    </div>
                    <!--免费章节-->
                    <section class="free_book">
                     <div class="smtool clearfix">
                      <a href="javascript:;" class="comgo fr">评论</a>
                      <a id="a_tip" href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'&ajax_gets=jieqi_contents\', false);" class="shangni fr">打赏</a>
                      <a id="a_uservote" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(event, \''.$this->_tpl_vars['url_uservote'].'\', {method: \'POST\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);"  class="tuijian fr" rel="0">推荐</a>
                      <!--我的推荐票-->
                     </div>
                     <!--关注我们-->
                     <!--关注-->
                     <div class="alladdus">
                      <h3>APP独享作品限时免费</h3>
                      <h3><a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" class="dios" data-recommendid="6484">下载苹果客户端 <i></i></a><a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" class="daz" data-recommendid="8620">下载安卓客户端 <i></i></a></h3>
                    
                     </div>
                     <!--关注 end-->
                     <!--关注我们 end-->
                     <h4><a href="'.$this->_tpl_vars['url_previous'].'"><b>&lt; </b> 上一章</a><a href="'.$this->_tpl_vars['url_next'].'" class="fr"> 下一章 <b> &gt;</b></a></h4>
                     <p class="herebottom"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['article_title'].'</a><b>&gt;</b><a href="'.$this->_tpl_vars['url_index'].'" title="">章节目录</a></p>
                    </section>
                   </div>
                  </section>
                  <!--阅读页 end-->
                  
<!--评论弹框--><section class="com_alert comment">
	<section class="container">
            <div class="downs">
                    <form class="form-base" name="frmreview" id="frmreview" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" target="_blank"> 
                    ';
if($this->_tpl_vars['jieqi_userid'] > 0){
echo '
                    <div class="contxt bd3 ">
                            <a href="javascript:" class="close"></a>
                    <div class="puss">
                        <h3>标题(选填)</h3>
                        <input type="text" class="bd2"  name="ptitle" placeholder="标题" maxlength="100"> 
                        <h3>内容</h3>
                        <textarea name="pcontent" class="bd3" placeholder="内容" style="overflow: hidden;"></textarea> 
                        <input type="hidden" name="act" id="act" value="newpost" />'.$this->_tpl_vars['jieqi_token_input'].'
                        <input type="button" value="提交" class="com_push bd3 style="cursor:pointer;" onclick="Ajax.Request(\'frmreview\',{onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));Form.reset(\'frmreview\');}});">
                        </div><!--评论成功-->
                        </div>
                    </div>
                           ';
}else{
echo '
                           <div class="contxt bd3 ">
                                <a href="javascript:" class="close"></a>
                           <div class="puss" style="color:#000;font-size:15px;">
                                您只有<a href="'.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" target="_blank" style="color:#09c">登陆</a>后才可以发表书评
                            </div>
                        </div>
                           ';
}
echo '
                        </form> 
            </section>
        </section><!--评论弹框 end--><!--尾部-->
                  <!--送花-->
                  <section class="sendflower">
                   <section class="container">
                    <div class="downs">
                     <div class="contxt bd3 ">
                      <a href="javascript:" class="close"></a>
                      <div class="flower">
                       <span class="fl"><img src="http://m.cmqxwx.com/wap_9kus/new_wap/images/readpay.png" /></span>
                       <span class="fl right"><h2>确认支付<b data-rel="100">100</b>金币<br />赠送作者一朵鲜花</h2><h6 class="my_msg">赠人玫瑰手留余香</h6></span>
                      </div>
                      <a href="javascript:;" class="sendfok bd3">确认支付</a>
                     </div>
                    </div>
                   </section>
                  </section>
                  <!--送花 end-->
                  <!--尾部-->
                  <section class="footer clearfix">
                   <section class="container">
                    <a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" id="down"><h1 class="bd3">下载APP，免费天天有</h1></a>
                    <p class="clearfix">
                        <a href="/">首页</a>
                        <a href="/top">排行</a>
                         <a href="/modules/article/articlefilter.php">书库</a>
                         <a href="/sou.php">搜索</a>
                         <a href="/modules/pay/buyegold.php?t=paycardpay">充值</a>
                    </p>
                    <p>&copy;2019  春墨秋香</p>
                   </section>
                  </section>
                  <script src="/themes/jieqi220/js/wapnew.js" type="text/javascript"></script>

                 </div>
</div>
    </div><!-- <script src="http://m.cmqxwx.com/wap_9kus/js/read.js?v=0.112" type="text/javascript"></script> -->
    <script src="/themes/jieqi220/js/jquery.cookie.js" type="text/javascript"></script>
    <script>	//推荐票
            var userStatus = "1";
            //阅读页打开评论
            var   com_alertH5 = $(\'.comment h5\');
            var   contxtPuss = $(\'.comment .contxt .puss\');
            $(\'.comgo\').on(\'click\',function(){
                if(userStatus == \'0\'){
                    var backurl = "/";
                    var login_url = "/"+backurl;
                    window.location.href=login_url;
                    return false;
                }
                $(\'.comment,.comment .contxt .puss\').show();
                    com_alertH5.hide();
                    $(\'.comment .downs\').addClass(\'bounceInDown\');
                   $(\'.comment .contxt textarea\').val(\'\');
            })
            $(\'.comment .com_push\').on(\'click\',function(){    
                var  com_alertZhi = $(\'.comment .contxt textarea\').val(); 
                if(com_alertZhi.length == 0 || com_alertZhi.match(/^\\s+$/g)){
                    $(\'.comment .contxt h6\').show().html(\'啥东西没？休想提交！\');return false;
                }
                if(com_alertZhi.length < 5){
                    $(\'.comment .contxt h6\').show().html(\'评论字数太少！\');return false;
                }
            })
            //控制样式
         $(function(){ 
        
                 //黑白夜切换
               var readbg = $.cookie(\'readbg\'); 
                $(\'.readbg\').attr(\'class\',\'readbg \'+readbg);  
                if(readbg== \'night\'){
                    $(\'.daynight\').eq(0).children(\'em\').addClass(\'active\')
                }else if(readbg== \'white\'){
                    $(\'.daynight\').eq(1).children(\'em\').addClass(\'active\')
                }else if(readbg== \'yellow\'){
                    $(\'.daynight\').eq(2).children(\'em\').addClass(\'active\')
                }else if(readbg== \'green\'){
                    $(\'.daynight\').eq(3).children(\'em\').addClass(\'active\')
                }
            
                $(\'.daynight\').on(\'click\',function(){
                    var Rels = $(this).attr(\'rel\') 
                    $(this).children().addClass(\'active\')
                    $(this).siblings().find(\'em\').removeClass(\'active\');
                     console.log(\'圣诞树\'+Rels)
                      $(\'.readbg\').attr(\'class\',\'readbg \'+Rels); 
                     $.cookie(\'readbg\',Rels,{expires:30,path:\'/\'}); 
                    $(\'.wapheader .fl\').hide();
                    $(\'.wapheader .logo\').show(); 
                });
                 $(\'.wmores\').on(\'click\',function(){
                 $(this).toggleClass(\'wmoresd\');
                 $(\'.mcats\').toggle();
             })
                
               var readfs = $.cookie(\'readfs\');
               var readlh = $.cookie(\'readlh\');
               if(readfs && readlh){
                   $(".reading .con_tent").css({"font-size":readfs+"rem",\'line-height\':readlh+\'rem\'});
               }
               // 字体大 
               $(".reading").delegate(".abig","click",function(){
                   var activeFontSize= parseInt($(".reading .con_tent").css("font-size"))/12;
                   var activeFH= parseInt($(".reading .con_tent").css("line-height"))/12;
                       activeFontSize +=0.1;
                       activeFH +=0.1; 
                   if ((activeFontSize +=0.1) >2.5){
                       activeFontSize = 2.5;
                       activeFH = 3.4; 
                   }
                   $.cookie(\'readfs\',activeFontSize,{expires:30,path:\'/\'});
                   $.cookie(\'readlh\',activeFH,{expires:30,path:\'/\'});
                   $(".reading .con_tent").css({"font-size":activeFontSize+"rem",\'line-height\':activeFH+\'rem\'});  
               });
        
               // 字体 小
               $(".reading ").delegate(".asmall","click",function(){
                   var activeFontSize= parseInt($(".reading .con_tent").css("font-size"))/12;
                   var activeFH= parseInt($(".reading .con_tent").css("line-height"))/12;
                       activeFontSize -=0.1;
                       activeFH -=0.1; 
                       if ((activeFontSize -=0.1) <1.42){
                           activeFontSize = 1.42;
                           activeFH = 2.8; 
                   }
                   $.cookie(\'readfs\',activeFontSize,{expires:30,path:\'/\'});
                   $.cookie(\'readlh\',activeFH,{expires:30,path:\'/\'});
                   $(".reading .con_tent").css({"font-size":activeFontSize+"rem",\'line-height\':activeFH+\'rem\'});  
               });
               
            

        })
        //端午
        
         </script></body></html>';
?>