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
    <meta name="keywords" content="������ѧ,����С˵,����С˵��,����С˵,�ഺС˵,����С˵,����С˵,����С˵,��ʷС˵,����С˵,ԭ��������ѧ" />
    <meta name="description" content="��С˵,��ʷС˵,����С˵,����С˵,�ƻ�С˵,�ֲ�С˵,�׷�С˵�����½����С˵�Ķ�,���ʾ��ھ�����ѧ��" />
    <meta name="renderer" content="webkit">
    <meta name ="viewport" content ="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="������ѧ">
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
</head><body><!--������--><!--����-->
        
                 <section class="wapheader othead"> 
                  <section class="container">
                   <a href="/" title="'.$this->_tpl_vars['jieqi_sitename'].'" class="fl logo"></a> 
                   <span class="right fr"><a href="/">��ҳ</a>
                    <a href="/top">����</a>
                     <a href="/modules/article/articlefilter.php">���</a>
                     <a href="/sou.php">����</a>
                     <a href="/modules/pay/buyegold.php?t=paycardpay">��ֵ</a></span>
                  </section>
                 </section>
                 <!--�˵�-->
                 <section class="menu  newus clearfix">
                  <section class="container">
                   <div class="topmenu">
                    <!--��¼��-->
                    ';
if($this->_tpl_vars['jieqi_userid'] ==0){
echo ' 
                    <a href="/register.php">ע��</a>
                    <a href="/login.php">��¼</a>
                    <a href="/api/weixin/login.php" class="wechat"></a>
                    <a href="/api/qq/login.php" class="qq"></a>
                    <a href="/api/weibo/login.php" class="weibo"></a>
                        <!--��¼ǰ end-->
                    ';
}else{
echo '
                    <a href="/modules/article/bookcase.php">�ҵ��ղ�</a>
                    <a href="/userdetail.php" class="allways">
                        <img src="http://q.qlogo.cn/qqapp/101229138/1338A1D1A46947A2AF02FAE9C126CE08/100" class="bd50" /></a>
                        ';
}
echo '  
                    <!--��¼�� end-->
                   </div>
                  </section>
                 </section>
                 <!--�˵� end-->
                 <div class="readbg ">
                  <!-- ͷ��end -->
                  <!--�Ķ�ҳ-->
                  <section class="reading">
                   <!--֪ͨ
                   <section class="allnotice  notice_down">
                    <section class="container">
                     <a href="http://m.cmqxwx.com/Book/content/book_id/36514" data-recommendid="95290">α��÷������� ��������������</a>
                    </section>
                   </section>
                   ֪ͨ end-->
                   <div class="container">
                    <p class="here"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['article_title'].'&nbsp;</a><b>&gt;</b>
                        <a href="'.$this->_tpl_vars['url_index'].'" title="">�½�Ŀ¼ </a>
                        <a id="a_addbookcase" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(\''.$this->_tpl_vars['url_bookcase'].'\', {method: \'POST\',eid: \'a_addbookcase\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);" class="addfav  fr">����ղ�</a></p>
                    <h1>'.$this->_tpl_vars['jieqi_title'].'</h1>
                    <h3 class="clearfix"><b class="font_total">'.date('Y-m-d H:i',$this->_tpl_vars['chaptertime']).'���� | '.$this->_tpl_vars['chaptersize_c'].'��</b>
                        <a href="javascript:;" class=" fr wmores ">����</a></h3>
                    <h3 class="clearfix mcats"><a href="javascript:;" class="asmall fr bd3">-A</a>
                        <a href="javascript:;" class="abig fr bd3">+A</a>
                        <a href="javascript:;" class="daynight blacks fr " rel="night"><em></em></a>
                        <a href="javascript:;" class="daynight whites fr " rel="white"><em></em></a>
                        <a href="javascript:;" class="daynight yellows fr " rel="yellow"><em></em></a>
                        <a href="javascript:;" class="daynight greens fr " rel="green"><em></em></a>
                     <!--        <a href="" class="fr bd3">Ŀ¼</a>--></h3>
                    <div class="con_tent">
                         '.str_replace('<p>','<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$this->_tpl_vars['jieqi_content']).'

                    </div>
                    <!--����½�-->
                    <section class="free_book">
                     <div class="smtool clearfix">
                      <a href="javascript:;" class="comgo fr">����</a>
                      <a id="a_tip" href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'&ajax_gets=jieqi_contents\', false);" class="shangni fr">����</a>
                      <a id="a_uservote" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(event, \''.$this->_tpl_vars['url_uservote'].'\', {method: \'POST\'}); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);"  class="tuijian fr" rel="0">�Ƽ�</a>
                      <!--�ҵ��Ƽ�Ʊ-->
                     </div>
                     <!--��ע����-->
                     <!--��ע-->
                     <div class="alladdus">
                      <h3>APP������Ʒ��ʱ���</h3>
                      <h3><a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" class="dios" data-recommendid="6484">����ƻ���ͻ��� <i></i></a><a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" class="daz" data-recommendid="8620">���ذ�׿�ͻ��� <i></i></a></h3>
                    
                     </div>
                     <!--��ע end-->
                     <!--��ע���� end-->
                     <h4><a href="'.$this->_tpl_vars['url_previous'].'"><b>&lt; </b> ��һ��</a><a href="'.$this->_tpl_vars['url_next'].'" class="fr"> ��һ�� <b> &gt;</b></a></h4>
                     <p class="herebottom"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['article_title'].'</a><b>&gt;</b><a href="'.$this->_tpl_vars['url_index'].'" title="">�½�Ŀ¼</a></p>
                    </section>
                   </div>
                  </section>
                  <!--�Ķ�ҳ end-->
                  
<!--���۵���--><section class="com_alert comment">
	<section class="container">
            <div class="downs">
                    <form class="form-base" name="frmreview" id="frmreview" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" target="_blank"> 
                    ';
if($this->_tpl_vars['jieqi_userid'] > 0){
echo '
                    <div class="contxt bd3 ">
                            <a href="javascript:" class="close"></a>
                    <div class="puss">
                        <h3>����(ѡ��)</h3>
                        <input type="text" class="bd2"  name="ptitle" placeholder="����" maxlength="100"> 
                        <h3>����</h3>
                        <textarea name="pcontent" class="bd3" placeholder="����" style="overflow: hidden;"></textarea> 
                        <input type="hidden" name="act" id="act" value="newpost" />'.$this->_tpl_vars['jieqi_token_input'].'
                        <input type="button" value="�ύ" class="com_push bd3 style="cursor:pointer;" onclick="Ajax.Request(\'frmreview\',{onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));Form.reset(\'frmreview\');}});">
                        </div><!--���۳ɹ�-->
                        </div>
                    </div>
                           ';
}else{
echo '
                           <div class="contxt bd3 ">
                                <a href="javascript:" class="close"></a>
                           <div class="puss" style="color:#000;font-size:15px;">
                                ��ֻ��<a href="'.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" target="_blank" style="color:#09c">��½</a>��ſ��Է�������
                            </div>
                        </div>
                           ';
}
echo '
                        </form> 
            </section>
        </section><!--���۵��� end--><!--β��-->
                  <!--�ͻ�-->
                  <section class="sendflower">
                   <section class="container">
                    <div class="downs">
                     <div class="contxt bd3 ">
                      <a href="javascript:" class="close"></a>
                      <div class="flower">
                       <span class="fl"><img src="http://m.cmqxwx.com/wap_9kus/new_wap/images/readpay.png" /></span>
                       <span class="fl right"><h2>ȷ��֧��<b data-rel="100">100</b>���<br />��������һ���ʻ�</h2><h6 class="my_msg">����õ����������</h6></span>
                      </div>
                      <a href="javascript:;" class="sendfok bd3">ȷ��֧��</a>
                     </div>
                    </div>
                   </section>
                  </section>
                  <!--�ͻ� end-->
                  <!--β��-->
                  <section class="footer clearfix">
                   <section class="container">
                    <a href="https://www.bslyun.com/taSsqpOktLTE1Njg2NC0tMA%3D" id="down"><h1 class="bd3">����APP�����������</h1></a>
                    <p class="clearfix">
                        <a href="/">��ҳ</a>
                        <a href="/top">����</a>
                         <a href="/modules/article/articlefilter.php">���</a>
                         <a href="/sou.php">����</a>
                         <a href="/modules/pay/buyegold.php?t=paycardpay">��ֵ</a>
                    </p>
                    <p>&copy;2019  ��ī����</p>
                   </section>
                  </section>
                  <script src="/themes/jieqi220/js/wapnew.js" type="text/javascript"></script>

                 </div>
</div>
    </div><!-- <script src="http://m.cmqxwx.com/wap_9kus/js/read.js?v=0.112" type="text/javascript"></script> -->
    <script src="/themes/jieqi220/js/jquery.cookie.js" type="text/javascript"></script>
    <script>	//�Ƽ�Ʊ
            var userStatus = "1";
            //�Ķ�ҳ������
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
                    $(\'.comment .contxt h6\').show().html(\'ɶ����û�������ύ��\');return false;
                }
                if(com_alertZhi.length < 5){
                    $(\'.comment .contxt h6\').show().html(\'��������̫�٣�\');return false;
                }
            })
            //������ʽ
         $(function(){ 
        
                 //�ڰ�ҹ�л�
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
                     console.log(\'ʥ����\'+Rels)
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
               // ����� 
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
        
               // ���� С
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
        //����
        
         </script></body></html>';
?>