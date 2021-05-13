<?php
echo '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="'.$this->_tpl_vars['jieqi_charset'].'">
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
    <meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
    <meta content="zh-cn" http-equiv="Content-Language">
    <meta name="applicable-device"content="pc,mobile">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = \'orientationchange\' in window ? \'orientationchange\' : \'resize\',
                ddesignWidth = 750,
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    docEl.style.fontSize = 20 * (clientWidth / ddesignWidth) + \'px\';
                };
            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener(\'DOMContentLoaded\', recalc, false);

        })(document, window);
    </script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/touchslide.1.1.js"></script>
    <script src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/swiper.min.js"></script>
    <script>
        function lazy(clssName){
            $(clssName).lazyload({
                effect: "fadeIn",
                placeholder : "'.$this->_tpl_vars['jieqi_url'].'/style/m/images/146915821024398292_160_224.png",
                threshold:200
            });

        }
        var $currentUrl=window.location.pathname;
        var $sUrl = $currentUrl.substr(5,$currentUrl.length);
        var nowHref = $(\'#go_topup\').attr(\'href\');
        nowHref += (\'&backUrl=\'+ $sUrl);
        $(\'#go_topup\').attr(\'href\',nowHref);






    </script>
    <script>

        $(function(){

            $(\'body\').css(\'visibility\',\'visible\')
            var isWeixin = false; //${isWeixin};
            if(location.href.indexOf(\'wap_publish\')>-1){
                isWeixin = false;
            }

            // if(!!isWeixin){
            //  这是微信
            $(\'.j_wxtab\').show();
            $(\'.j_wap_header\').remove();
            $(\'.j_wx_header\').show();
            $(\'.bookshelf_entry\').remove();
            $(\'.j_searchbox\').hide();
            setTimeout(function() {

                $(\'.cateclose\').on(\'click\',function(){
                    $(\'.catebox\').hide();
                    $(\'html,body\').removeClass(\'ovfHiden\');
                })


                $(\'#wx_list\').on(\'click\',function(){
                    $(\'.catebox\').show();
                    $(\'html,body\').addClass(\'ovfHiden\');
                })

            }, 10);


            // }else{
            //     $(\'.j_searchbox\').show();
            //     $(\'.j_wap_header\').show();
            //     $(\'.j_wx_header\').remove();
            //     $(\'.j_wxtab\').remove();
            //     $(\'.bookshelf_entry\').show();
            //     $(\'.mod_tit1\').hide();
            //     $(\'.brandbox\').hide();
            //
            //
            // }
        });

        $(function () {
            var jieqi_userid = \''.$this->_tpl_vars['jieqi_userid'].'\';
            if(jieqi_userid > 0) {
                $(\'.j_wap_header .wx_list\').find(\'img\').attr(\'src\',"'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'");
            }
        });

    </script>
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/swiper.min.css">
    <style>
        body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td, img {
            margin: 0;
            padding: 0
        }

        body {
            background: #f4f4f4;
            font: 16px/1.5 \'Microsoft Yahei\', Verdana, Helvetica, Arial;
            color: #666;

        }

        em {
            font-style: normal
        }

        input, textarea, button {
            font-size: 14px
        }

        h1 {
            font-size: 16px;
            color: #333
        }

        h2, h3 {
            font-size: 16px;
            margin: 10px 0
        }

        h3 {
            color: #333;
            padding-top: 5px;
            font-weight: 700;
            text-align: center
        }

        ul li {
            list-style: none
        }

        .title {
            color: #060;
            font-weight: 400
        }

        .type {
            padding-right: 5px;
            color: #63676a
        }

        .vm {
            vertical-align: middle !important
        }

        h1 span, h2 span, h3 span {
            font-size: 16px;
            font-weight: 400;
            color: #999
        }

        .clear {
            clear: both
        }

        img {
            border: 0
        }

        a {
            text-decoration: none;
            color: #666
        }

        a img {
            border: 0
        }

        td {
            vertical-align: top
        }



        html,
        body{
            font-size: 62.5%;
            color: #666;
        }
        .wx_header{/*margin-bottom:10rem;*/}
        .wx_nav_box{background:#fff;position:relative;height:4rem;}
        .wx_nav_box a.logo{
            position: absolute;
            left: 1.0rem;
            top: 1rem;
            display: block;
            font-size: 1.8rem;
            padding-top:.11rem;
        }

        .wx_nav_box a.logo img{
            height:1.8rem;
        }
        .wx_nav_box .wx_list{position:absolute;right:.3rem;top:0;width:4.0rem;height:4.4rem;z-index:9999;}
        .wx_list img{
            width:1.9rem;height:1.9rem;display:block;padding:1.2rem 1.0rem 0 1.2rem;
        }
        .wx_list span{
            width:1.9rem;height:1.9rem;display:block;margin:1.2rem 1.0rem 0 1.2rem;
            overflow:hidden;
            border-radius:100%;
        }
        .wx_list span img{
            width:1.9rem;height:1.9rem;display:block;padding:0;
        }
        .wx_nav_box .wx_search {position:absolute;right:4rem;top:.2rem;width:4.0rem;height:4.4rem;}.wx_search a{display:block;width:4.0rem;height:4.4rem;}.wx_search img{width:1.8rem;height:1.8rem;display:block;padding:1.2rem 0 0 2.1rem;}
        .wx_line{width:.1rem;background:#fff;height:1.7rem;margin:0 .5rem;position:absolute;right:3.3rem;top:1.6rem;}
        .sexchannel{
            height: 4rem;
            line-height: 4rem;
            overflow: hidden;
            text-align: center;
            font-size: 1.5rem;
            color: #666;
            padding-left:4rem;
        }
        .sexchannel span{
            width:4rem;
            display:inline-block;
            text-align:center;
        }
        .sexchannel a.on{
            height:3.8rem;
            display: inline-block;
            border-bottom: .2rem solid #ee5048;
        }


        .record{
            position: relative;
            height: 5.0rem;
            background: #fff;
            -ms-box-orient: horizontal;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -moz-flex;
            display: -webkit-flex;
            display: flex;
        }
        .record dt{
            line-height: 5.0rem;
            width: 9.8rem;
            text-align: center;
            border-right: .1rem solid #e6e6e6;
        }
        .record dt a{
            color: #ee5048;
            font-size: 1.5rem;
        }
        .record dd{
            margin-left: 1.5rem;
            -webkit-box-flex: 1;
            box-flex: 1;
            flex:1;
            cursor: pointer;
        }
        .record dd a{
            padding-top: 0.3rem;
            display: block;
            height: 4.4rem;
            cursor: pointer;
        }
        .record dd .recordtxtname{
            color: #333;
            font-size: 1.6rem;
        }
        .record dd .recordtxtcot{
            font-size: 1.2rem;
            color: #333;
        }
        .rightarrow {
            position: absolute;
            right: 1.7rem;
            top: 2.0rem;
        }
        .rightarrow img{
            width: .6rem;
            height: 1.1rem;
        }


        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 1.8rem;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            width: 13.8rem;
        }

        .searchbox{
            background:#fff;
            width:100%;
            height:4rem;
            padding-top:1rem;
        }
        .searchcontent{
            height:3rem;
            width:85%;
            background:#f2f2f2;
            border-radius: 5px;
            margin:0 auto;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .searchtext{
            color:#ccc;

            position: absolute;
            width:100%;
            left:0;
            top:50%;
            transform:translateY(-50%);
            font-size:1.4rem;

            line-height:1;

        }
        .searchicon{
            position: absolute;
            width:11%;
            right:0;
            top:.15rem;
            height:30px;
            z-index: 10;
            background:url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAAsSAAALEgHS3X78AAADmklEQVRYw73YS6hVVRzH8c89Sg+lMilzkGKmEaZNGhUEikFYKthDiZ67+tMky5Led9IDQguv9KBgG5uaFEGTcKCZSYKihNWk7IFBYVJimWVlop0Ge5/YZ3nuvcfbuf1m//Vfa+3v/u+11/r/V58uVeT5RCzAFbgc5+McHMNP2IMd2Ir3sogj3c7dUl8XEJfgcVyPU7uc9xDW4fks4of/DFPk+RlYhXvQONm3rHQYT2Igizg+Ipgiz+fgHcwcZNxR7MfeKlqTMQljBum/BUuziAMnBVPk+WXYjLMS1294A29jZxbxV4dIzsMtWIKxyfivMD+L2NsVTBWRD5QLs6UmXkV/FvHzcKGu5pmJAVybuD7HlYPN01ebYBx24eKa/1csyyI2dAORAPVhBZ7T/vnWY3EW0UzH1Bfm6gTkEOaOBASyiGYWMYCsim5LC3HHoJEp8nw2Pq29QRMLsoiNIwHpEKUn8Eyt6UfMyCIOd4rMo0ko1/UKpNKzyg2xpfNwV9qpUeT5BNxQa/tTuTf0TFnE31iZNN99AgwWad9Ziyzi+17CVEDb8VGtaXaR57NSmHnJuLd6DVLTm4k9N4W5tGYfwc5RhPkwseekMNNq9p4s4ugownyR2BekMBNq9sFRBJFF/KH8QVo6M4UZ9jTtsepbSNuzG/ilZk8eTYpqGzml1tT2JRr4umZPK/J8/CjyzEnsb1KYj2v2WMnv1mPNT+z6szXwftLh5tGgKPK8kczdVKYrbTAbta+bG4s8nz4KPEswo2ZvSxOtRpWxvVZrG4u1PY7KOGVeU9dLab/Wqb1GmTy3tKjI8+U95HlZ+wb3mTLHPhEmi9iHpxPfQJHnS3sQldXak6kmlmcRx9K+9bRzDDZpPziPox+rOqWJw0CMwyu4LXE9l0U83GlMmpCfi+3aFxrl0f9YFrG5C4gGbsVTmJq438V1g9VQnUqVKdiAWR3671CmGFuxO4s4UkV0Ei7EVbgJF3UYux7LcDquwbdZxNYhYSqgiXhdmTwPpd9xmsGLN8o1MoBHlLXYJ5hS+dZkEf9mgB3L1qquWYw7MVQVOH4YkC9xdRaxslqwC2sg8GCR5wNDwlRAzSyiwHQ8gN26UxPblJ9rdhaxqebb06H/ihbQsLcQdVU3EvOU2eFUnK28EjmoPPR2YUsW8d0Qc6zF/R1c/ScF0wtVleYLuDdxHRjpVceIVe1X9+HFxLX/f49MS1WE+vEQ9uH2fwBKbRAHjoe0TQAAAABJRU5ErkJggg==\') no-repeat center center ;
            /*background-size:18px 18px;*/
            background-size:1.6rem 1.6rem;
        }


        .m-n-channel {
            display: -moz-box;
            display: -webkit-box;
            display: box;
            width: 100%;
            padding: 1.8rem 0 1.6rem;
            background: #fafafa;
            font-size: 1.6rem;
            overflow: hidden
        }

        .m-n-channel li {
            -moz-box-flex: 1.0;
            -webkit-box-flex: 1.0;
            box-flex: 1.0;
            text-align: center
        }

        .m-n-channel li span {
            display: block;
            padding-top: .6rem;
            font-size:1.4rem;
            color:#666;
        }

        .m-n-channel li a {color: #000;display: block}
        .m-n-channel li img {
            width: 4.0rem;
            height: 4.0rem;
            display: block;
            margin: 0 auto;
        }

        #ad_banner1 {
            position: relative;
            overflow: hidden
        }

        #ad_banner1 .change_ico {
            position: absolute;
            right: 1.0rem;
            top: 1.0rem;
            z-index: 9
        }

        .wx_header {
            overflow: hidden
        }

        #ad_banner1 .hd{position:absolute;bottom:.8rem;right:.8rem;}
        #ad_banner1 .hd li{display:inline-block;text-indent:-9999rem;width:.8rem;height:.8rem;border-radius:.5rem;border-radius:.5rem;background:#ddd;margin:0 0 0 .6rem;overflow:hidden;}
        #ad_banner1 img,#slider_ban a{display:block;width:100%;}
        #ad_banner1 img{
            height:12rem;
        }
        #ad_banner1 .hd li.on{background:#fd6974}

        .swiper-wrapper1{
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            overflow: hidden;
        }

        .recommendbox1 .ul-mod {
            -ms-box-orient: horizontal;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -moz-flex;
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            padding: 1.5rem 0 0 0;
        }
        .recommendbox .ul-mod li img,
        .recommendbox1 .ul-mod li img{
            width: 100%;
            max-width: 8.0rem;
            box-shadow: .1rem .1rem .1rem #cacaca;
        }
        .recommendbox .ul-mod li span.name,
        .recommendbox1 .ul-mod li span.name{
            display: block;
            font-size: 1.2rem;
        }
        .recommendbox,
        .recommendbox1{
            position: relative;
            background: #fff;
            overflow:hidden;
            padding-bottom: 2.0rem;

        }


        .seciton-bd .ul-mod {text-align: center;padding: 1.5rem 0 1rem;overflow: hidden; display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;flex-wrap:wrap;}
        .ul-mod li {width: 33.33333333333%;float: left;padding-bottom: 0;margin-bottom:.5rem;}
        .recommendbox1 .ul-mod li{
            margin-bottom:0;
        }

        .ul-mod li span.name {
            line-height: 1.6rem;
            display: block;
            padding-top: .6rem;
            overflow: hidden;
            font-size: 1.2rem;
        // height: 3.4rem;
        }
        .ul-mod li img {width:100%;max-width:8.0rem;box-shadow:.1rem .1rem .1rem #cacaca;display:block;}
        .ul-mod li a,.ul-mod-list li a {color: #333;display: block}
        .ul-mod li a{width:8.0rem;margin:0 auto;}

        .mod_tit {
            color: #333;
            position: relative;
            padding-left: 1.5rem;
            height: 4.2rem;
            line-height: 4.2rem;
            margin-top: 1.0rem;
            font-size: 1.6rem;
            background: #fff;
            padding-top:0.5rem;
        }

        .mod_tit span {
            position: absolute;
            bottom: 0;
            left: 1.5rem;
            display: block;
            background: #fd6974;
            width: 3.0rem;
            height: 2px;
        }
        .booktxt1{
            margin: 0 1.5rem;
            padding-bottom: 1rem;
        }
        .booktxt1 a {
            font-size: 1.4rem;
            color: #333;
            display: block;
            border: 1px solid #dcdcdc;
            border-radius: 2.0rem;
            height: 3.0rem;
            line-height: 3.0rem;
            overflow: hidden;
            text-indent: 1.4rem;
        }

        .seciton-bd .editor-b-dl2{
            padding:1.5rem 1.5rem 0rem;
        }
        .seciton-bd .editor-b-dl a {
            width: 100%;
            display: -moz-box;
            display: -webkit-box;
            display: box
        }

        .editor-b-dl dt {
            padding-right: 1.0rem;
            width:8.0rem;height:11.2rem;
            position: relative
        }

        .editor-b-dl dt span {
            display: block;
            position: absolute;
            right: 1.0rem;
            bottom:0;
            border-radius:1.5rem 0 0 0;width:4.8rem;padding-left:.2rem;height:1.8rem;line-height:1.8rem;font-size:1.0rem;color:#fff;text-align:center;
        }

        .editor-b-dl img {
            width: 8.0rem;box-shadow:.1rem .1rem .1rem #cacaca
        }

        .editor-b-dl dd {
            -moz-box-flex: 1.0;
            -webkit-box-flex: 1.0;
            box-flex: 1.0;
            position: relative;
            overflow: hidden;
            margin-top:-.4rem;
        }

        .editor-b-dl dd span {
            display: block
        }

        .editor-b-dl dd span.book-name {
            font-size: 1.6rem;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 13rem;
        }

        .editor-b-dl dd span.author-name {
            font-size: 1.2rem;
            padding: .3rem 0 .3rem;
            position: relative
        }

        .editor-b-dl dd span.book-brief {
            color: #999;
            line-height: 1.6rem;
            font-size: 1.2rem;
            height: 4.6rem;
            margin-bottom: .5rem;
            overflow: hidden;
            word-break: break-all!important;
            word-wrap: break-word!important;
        }
        .editor-b-dl1 dd span.book-brief{
            color: #999;
            line-height: 1.8rem;
            font-size: 1.2rem;
            height: 5.5rem;
            margin-bottom: .5rem;
            overflow: hidden;
        }
        .editor-b-dl dd p{color: #999;position:relative;width:100%;}
        .editor-b-dl dd p span{float:left;display:block;color:#fff;font-size:1.2rem;}
        .editor-b-dl dd p span.left{background:#f88265;border-radius:.3rem;padding:0rem .5rem;margin-right:.6rem;line-height:2.0rem;}
        .editor-b-dl dd p i{font-style:normal;display:inline-block;margin-right:.6rem;border-radius:.3rem;
            padding:0 .5rem;line-height:2.0rem;background:#fd6974}/*阃氱敤*/

        .editor-b-dl dd p i:nth-child(1){background:#72bfeb}
        .editor-b-dl dd p i:nth-child(2){background:#83d598}

        .infotext .editor-b-dl{
            padding: 0rem 1.5rem .5rem;
        }
        #editor-b-dl:last-child {
            padding-bottom: 1.5rem
        }
        .pv{font-weight:normal}
        .box-wrap{
            padding: .5rem 0 1rem 0;
        }
        .readbtnwrap{
            position: relative;
            padding: 1rem 1.5rem 1rem;
            overflow: hidden;
        }
        .readbtn{
            width: 6rem;
            height: 1.9rem;
            line-height:1.9rem;
            border: 1px solid #ee5048;
            color: #ee5048;
            border-radius: .5rem;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            text-align: center;
            font-size:1.2rem;
        }

        .mod_more{
            display: block;
            width: 100%;
            height: 4.0rem;
            line-height: 4.0rem;
            text-align: center;
            background: #fafafa;
            font-size: 1.4rem;
            color: #ee5048;
            margin-bottom:-1.2rem;
        }
        .mod_more a{
            font-size: 1.4rem;
            color: #ee5048;
        }
        .mod_more span{
            display: inline-block;
            line-height: 4.0rem;
            height: 4.0rem;
            font-size: 0;
        }
        .mod_more span img{
            width: 1.7rem;
            height: 1.4rem;
            display: inline-block;
            margin-top: 1.3rem;
            position: absolute;
        }
        .mod_more span em{
            font-size: 1.2rem;
            display: inline-block;
            margin-left: 2.1rem;
            font-style: normal;
        }
        .tempui {
            background: #fff;
        }
        .booktxt1 .editor-b-dl{
            margin-bottom: 1rem;
        }


        .brandbox{
            padding: 1.0rem 0;
            background: #fff;
            margin:1rem;
        }
        .brandbox ul{
            -ms-box-orient: horizontal!important;
            display: -webkit-box!important;
            display: -moz-box!important;
            display: -ms-flexbox!important;
            display: -moz-flex!important;
            display: -webkit-flex!important;
            display: flex!important;
            -webkit-justify-content: space-between!important;
            justify-content: space-between!important;
        }
        .brandbox ul li{
            padding: .8rem .5rem;
            border: .1rem solid #dcdcdc;
            color: #999;
            line-height: 2.0rem;
            -webkit-box-flex: 1;
            box-flex: 1;
            width: 100%;
            margin:.5rem;
        }
        .brandbox ul li span{
            display: block;
            font-size: 1.7rem;
        }
        .brandbox ul li p{
            margin-top: .5rem;
            font-size: 1.2rem;
            color:#999;
        }

        body{
            position: relative;
        }
        .static-nav-mod {
            position: fixed;
            background: #fafafa;
            bottom: 0rem;
            z-index: 9999;
            width: 100%;
            height:5.0rem;
            font-size:1.4rem;
        }
        .static-nav-mod ul {
            display: -webkit-box;
            display: -moz-box;
            display: box;
            overflow: hidden;
        }
        .static-nav-mod ul li {
            -webkit-box-flex: 1.0;
            -moz-box-flex: 1.0;
            box-flex: 1.0;
            text-align: center;
            background:#fafafa;
        }
        .static-nav-mod ul li.on{
            background:#fff;
            height:5.0rem;
        }
        .static-nav-mod ul li p{
            margin-top:.5rem;
        }
        .static-nav-mod ul li a {
            display:block;
            height:5.0rem;
            color: #999;
        }
        .static-nav-mod ul li a img {
            width:2.8rem;
        }
        .static-nav-mod ul li.on a {
            display:block;
            height:100%;
            color: #fd6974;
            font-weight:bold;
        }
        .mm_mod ul li.on a{
            color: #00b9ef;
        }
        .jw_mod ul li.on a{
            color: #0fb295;
        }
        .static-nav-mod ul li em{
            display: inline-block;
            margin: 1.5rem auto auto auto;
            height: 1.7rem;
        }
        .static-nav-mod .m1 .bot1{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/14875915593686341_41_41.png) no-repeat left top;
            background-size: 1.7rem 1.7rem;
            line-height: 1.7rem;
            padding-left: 2.5rem;
        }
        .static-nav-mod .m2 .bot2{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/148759151425335146_40_41.png) no-repeat left top;
            background-size: 1.7rem 1.7rem;
            line-height: 1.7rem;
            padding-left: 2.5rem;
        }
        .static-nav-mod .m3 .bot3{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/14875915595529179_32_41.png) no-repeat left top;
            background-size: 1.7rem 1.7rem;
            line-height: 1.7rem;
            padding-left: 2.5rem;
        }

        .static-nav-mod .on span{
            color: #999;
        }
        .static-nav-mod .on .bot1{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/148428771460898972_46_46.png) no-repeat;
            background-size: 1.7rem 1.7rem;
        }
        .static-nav-mod .on .bot2{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/148759151425335146_40_41.png) no-repeat;
            background-size: 1.7rem 1.7rem;
        }
        .static-nav-mod .on .bot3{
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/14842877536245740_46_46.png) no-repeat;
            background-size: 1.7rem 1.7rem;
        }

        .mobile_foot {padding:1.5rem 1.0rem 2.0rem;margin-top:1.0rem;text-align:center;font-size:1.4rem;background: #fff;color:#ccc;position:relative;}.mobile_foot .gotop{position:absolute;right:1.0rem;top:2.0rem;}.mobile_foot a {color: #333 !important;}.mobile_foot .slogan{padding-top:1.5rem;}

        .mod_tit1 {
            text-align: center;
        }
        .mod_tit1 span{
            left: 50%;
            margin-left: -1.5rem;
        }
        .swiper-container{
            overflow: visible;
        }
        .swiper-container-horizontal>.swiper-pagination {
            top: -2.6rem;
            right: 2.5rem;
            text-align: right;
            width: auto;
            z-index:0;
        }
        /*棣栭〉凿滃崟*/
        .catebox{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #000;
            background: rgba(0,0,0,0.8);
            z-index: 111111111111;
        }
        .cateclose img{
            width: 3.0rem;
            height: 3.0rem;
            margin: 0 auto;
            display: block;
        }
        .catenav h3,
        .catenav span,
        .catenav p{
            color: #fff;
        }
        .catenav ul li{
            padding: 1.5rem 0;
            position: relative;
            padding-left: 2.7rem;
            text-align: left;
            border-bottom: .1rem solid #5a5758;
        }
        .catenav ul li a{
            display: block;
        }
        .catenav h3{
            height: 5.0rem;
            line-height: 5.0rem;
            text-align: center;
            font-size: 1.8rem;
            border-bottom: .1rem solid #706e6c;
        }
        .catenav span{
            font-size: 1.4rem;

        }
        .catenav p{
            font-size: 1.2rem;
        }
        .catenav span.catebtn {
            position: absolute;
            right: 1.5rem;
            top: 2.0rem;
            width: 8.0rem;
            height: 2.5rem;
            line-height: 2.5rem;
            border: .1rem solid #f4654c;
            color: #ee5048;
            border-radius: .5rem;
            text-align: center;
        }
        .catenav span.curr{
            background: #ee5048;
            color: #fff;
        }
        .cateclose{
            margin-top: 1.5rem;
            display: block;
        }
        .swiper-pagination-bullet-active{
            background: #ee5048;
        }
        .swiper-pagination-bullet{
            width: 5px;
            height: 5px;
        }
        .line{
            height: .1rem;
            background: #e8e8e8;
            display: block;
            margin: 1.5rem 1.5rem;
        }
        .recommendbox1 .mod_tit{
            margin-top:-.5rem;
        }
        #change1 .ul-mod{
            padding-bottom:1rem;
        }
        .infotext1{
            margin-bottom:1rem;
            padding-bottom: 1rem;
        }

        .wx_home input::-webkit-input-placeholder{color:#ccc;font-size:12px;}
        .wx_home input::-moz-placeholder{color:#ccc;font-size:12px;}
        .wx_home input:-moz-placeholder{color:#ccc;font-size:12px;}
        .wx_home input:-ms-input-placeholder{color:#ccc;font-size:12px;}

        .wx_home {
            position: absolute;
            left: 50%;
            top: 0.5rem;background: #eee;
            margin-left: -70px;
            border-radius: 16px;
            width: 174px;
            height: 30px;
            line-height: 30px
        }


        #zui-search {
            display: block;
            width: 30px;
            height: 30px;
            float: right;
            border: 0;
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/148792591916857723_20_20.png) 5px 4px no-repeat
        }

        #zui-input {
            display: block;
            width: 144px;
            background: 0;outline:0;
            border: 0;
            float: left;
            height: 30px;
            line-height: 30px;
            color: #ccc;
            text-indent: 10px;
        }
        #changebox .ul-mod li span.name{
            height:3.0rem;
        }

        .right-arrow1,.right-arrow2{
            width: 0;
            height: 0;
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            border-top: 6px transparent dashed;
            border-right: 6px transparent dashed;
            border-bottom: 6px transparent dashed;
            border-left: 6px white solid;
            overflow: hidden;
        }
        .right-arrow1{
            left: 2px;
            border-left: 6px #ee5048 solid;
        }
        .right-arrow2{
            border-left: 6px white solid;
        }

    </style>

</head>
<body>
<div id="blockId661" class="tempui404 tempui">
    <style>
    .motie-app-download,
    .motieread-app-download{
        width: 100%;
        background: rgba(0,0,0,0.74);
        z-index: 100;
    }
    .motie-app-download{
        position: relative;
        top:0;
    }
    .motieread-app-download{
        position: fixed;
        bottom: 0;
    }
    .motieread-app-download img,
    .motie-app-download img{
        display:block;
        width:100%;
        /*height:44px;*/
    }
    .motieread-app-download .link,
    .motie-app-download .link{
        position: absolute;
        top: 50%;
        margin-top: -4%;
        right: 4.8%;
        width: 22.666666666666666%;
        height: 58%;
        display: block;
    }
    .motie-app-download .link{
        right: 8%;

    }
    .motie-app-download b{
        position: absolute;
        top: 0;
        background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/icon-closed-app-download-index.png\') no-repeat;
        -webkit-background-size: 100%;
        background-size: 100%;
        display: block;
        width: 21px;
        height: 21px;
        right: 0;
    }
    .motieread-app-download b{
        position: absolute;
        background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/icon-closed-app-download.png\') no-repeat;
        background-size: 100%;
        top: 32.7%;
        display: block;
        width: 19px;
        height: 19px;
        left: 2.3%;
    }
    .andriod-download-tips {
        position: fixed;
        z-index: 1000000;
        background: rgba(0,0,0,.8);
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .andriod-download-tips span {
        position: absolute;
        right: -10%;
        top: 0;
        width: 327.5px;
        height: 233.5px;
        background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/bg-download-tip.png\') left top no-repeat;
        -webkit-background-size: 100% auto;
        background-size: 100% auto;
    }
</style>
    <div class="andriod-download-tips" style="display: none;"><span></span></div>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jwsjs-2.0.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jws-3.3.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jsrsasign-latest-all-min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/wap-octopus.js"></script>
    <script>
        $(function() {
            var u = navigator.userAgent;
            var isAndroid = u.indexOf(\'Android\') > -1 || u.indexOf(\'Linux\') > -1 || u.indexOf(\'Adr\') > -1;
            var isIOS = !!u.match(/\\(i[^;]+;( U;)? CPU.+Mac OS X/);
            var ua = navigator.userAgent.toLowerCase();
            var isWeixin = ua.indexOf(\'micromessenger\') != -1;


            /*$(\'body\').on(\'touchend\', \'.collect-data\', function () {
                var $this = $(this),
                    userId = $this.data(\'user-id\') || 0,
                    position = $this.data("position"),
                    collectData = $this.data(\'collect-data\');

                    console.log(userId,position,collectData);

                    if (collectData == undefined) {
                        collectData = [];
                    }

                    if(position){
                        sendMessage(userId,position,collectData);
                    }
            });*/

            var countDown = function ($this) {
                var userId = $this.data(\'user-id\') || 0,
                    position = $this.data("position"),
                    collectData = $this.data(\'collect-data\');

                console.log(userId,position,collectData);

                if (collectData == undefined) {
                    collectData = [];
                }

                if(position){
                    sendMessage(userId,position,collectData);
                }
            };
            $(\'body\').on(\'touchend\',\'#closed\',function () {
                var $this = $(this);
                countDown($this);
                $this.parent(\'.motie-app-download\').hide();
                //$(\'#j_commonHeader\').css(\'top\',\'0\');
            });
            $(\'body\').on(\'touchend\',\'#downLink\',function () {

                //alert(url);
                var href=$(this).data(\'href\');
                var $this = $(this);
                countDown($this);
                setTimeout(function(){
                    location.href = href;
                },1000);
            })

        });
        $(\'body\').on(\'touchend\',\'.andriod-download-tips\', function(event){
            window.history.go(-1);
            $(this).hide();
            event.stopPropagation();
        });



    </script></div>
<div id="blockId446" class="tempui191 tempui"><div id="hd" class="wx_header j_wap_header" style="display:none;">
    <div class="wx_nav_box">
        <a href="#" class="logo"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14878507417971314_159_34.png" /></a>
        <div class="sexchannel">
            <span><a href="#" class="on">男生</a></span>
            <span><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/group.php?id=2">女生</a></span>
        </div>
        <!--<div class="wx_search"><a href="http://m.motie.com/wechat/rest/?weixin_mark=w_male"><img src="static/picture/148759201314459311_40_40.png" /></a></div>-->
        <div class="wx_line"></div>
        <a href="';
if($this->_tpl_vars['jieqi_userid'] > 0){
echo $this->_tpl_vars['jieqi_url'].'/userdetail.php';
}else{
echo $this->_tpl_vars['jieqi_url'].'/login.php';
}
echo '">
            <div class="wx_list "  id="wx_list"><span><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/personicon1.png" /></span></div>
        </a>

    </div>
</div>
</div>
<div id="blockId517" class="tempui264 tempui"><div id="hd" class="wx_header j_wx_header">
    <div class="wx_nav_box">
        <a href="#" class="logo"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14878507417971314_159_34.png" /></a>
        <div class="sexchannel">
            <span><a href="#" class="on">男生</a></span>
            <span><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/group.php?id=2">女生</a></span>
        </div>
        <div class="wx_search"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148759201314459311_40_40.png" /></a></div>
        <div class="wx_line"></div>
        <div class="wx_list" id="wx_list"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148759202084820894_40_40.png" /></div>
    </div>
</div>
</div>
<div id="blockId618" class="tempui376 tempui"><div class="m_vip" id="ad_banner1">
    <div class="bd">
        <ul>

        </ul>
    </div>
    <div class="hd"><ul class="book_ul"></ul></div>
</div>

    <script type="text/javascript">
        $(function(){
            var linkeArr = ['.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'];
            var blockId = \'blockId618\';
            var str = "";
            $.each(linkeArr,function(index,obj){
                str += \'<li>\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<img src="\'+ obj.picUrl1 +\'">\'
                    +\'</a>\'
                    +\'</li>\';

            })
            $(\'#\'+blockId).find(\'.bd ul\').append(str);

            if(linkeArr.length>1){
                TouchSlide({
                    slideCell:"#ad_banner1",
                    titCell : ".hd ul",
                    mainCell : ".bd ul",
                    effect : "leftLoop",
                    autoPage : true,
                    autoPlay : true,
                    interTime:4000
                })
            }else{
                $(\'.hd ul.book_ul\').hide();
            }




        })
    </script></div>
<div id="blockId464" class="tempui210 tempui"><div class="searchbox j_searchbox" style="display:none;">
    <form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php" method="post" id="searchform">
        <div class="searchcontent">
            <input type="hidden" value="" name="queryString" id="searchinput" />
            <span class="searchtext" ></span>
            <span class="searchicon" ></span>
        </div>
    </form>

</div>
    <script>
        $(function () {
            $(\'.searchtext\').click(function () {
                $(\'#searchform\').attr(\'action\',"'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php");

                $(\'#searchform\').submit();
            });
            $(\'.searchicon\').click(function () {

                $(\'#searchform\').attr(\'action\',"'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php");
                $(\'#searchform\').submit();
            });
        })
    </script></div>
<div id="blockId619" class="tempui194 tempui"><div class="m_search" style="background:#fafafa;">
    <ul class="m-n-channel">
        <li><a href="'.jieqi_geturl('article','articlefilter','1','').'"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148767081007254523_80_80.png" /><span>分类</span></a></li>
        <li><a href="'.jieqi_geturl('article','toplist','1','toplist').'"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14876708477472149_80_80.png" /><span>排行</span></a></li>
        <li>
            <a href="'.jieqi_geturl('article','articlelist','1','','1').'" style="margin:0 auto;width:40px;position:relative;">
                <!--<img src="static/picture/best-ico.gif" style="position:absolute;top:0px;right:-15px;width:22px;height:12px;" />-->
                <img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14876708378230165_80_80.png" /><span>全本</span>
            </a>
        </li>
        <li><a href="'.jieqi_geturl('news','newslist','1','').'"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/wenzhang.png" /><span>短篇</span></a></li>
    </ul>
</div></div>
<div id="blockId450" class="tempui202 tempui"><div class="recommendbox1">
    <div class="mod_tit" style="display:none;"></div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>


    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'];
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['2']['title'].'";
            var blockId = \'blockId450\';
            var url = \'\';
            var str = "";
            var title="";
            var more="";
            title +=\'<span></span>\'
                + uiTitle;

            $.each(bookList,function(index,obj){
                str += \'<div class="swiper-slide">\'
                    +\'<ul class="ul-mod">\'
                    +\'<li>\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<img class="lazy" src="\'+ obj.iconUrlDefault +\'" />\'
                    +\'<span class="name">\'+ obj.name +\'</span>\'
                    +\'</a>\'
                    +\'</li>\'
                    +\'</ul>\'
                    +\'</div>\';

            })
            if(uiTitle != \'\'){
                //$(\'.mod_tit\').show();
                $(\'#\'+blockId).find(\'.mod_tit\').css(\'display\',\'block\').append(title);
            }
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">进入更多分类></a>\'
                +\'</div>\';
            if(url != \'\'){
                $(\'#\'+blockId).append(more);
            }
            $(\'#\'+blockId).find(\'.swiper-wrapper\').append(str);
            lazy(\'img.lazy\');
            var swiper = new Swiper(\'.swiper-container\', {
                paginationClickable: true,
                loop: false,
                autoplay : 5000,
                pagination: \'.swiper-pagination\',
                slidesPerView : 3,
                slidesPerGroup : 3,
                touchMoveStopPropagation : true
            });
        })
    </script>
</div>
<div id="blockId452" class="tempui206 tempui"><div class="m-title"></div>
    <div class="box-wrap"></div>
    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'];
            var blockId = \'blockId452\';
            var uiIntroduce = \'进入完本频道 >\';
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['3']['title'].'";
            var url = "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php";
            var str = "";
            var title="";
            var more="";

            title +=\'<div class="mod_tit">\'
                +\'<span></span>\'
                + uiTitle
                +\'</div>\';

            $.each(bookList,function(index,obj){
                var tagName = obj.tagName;
                str += \'<div class="zui_cont seciton-bd readbtnwrap">\'
                    +\'<dl class="editor-b-dl editor-b-dl1">\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<dt>\'
                    +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" border="0" />\'
                    +\'</dt>\'
                    +\'<dd>\'
                    +\'<span class="book-name">\'+ obj.name +\'</span>\'
                    +\'<span class="author-name">\'+obj.authorName+\'</span>\'
                    +\'<span class="book-brief">\'+ obj.intrduce +\'</span>\'
                    +\'</dd>\'
                    +\'</a></dl>\'
                    +\'<a href="\'+obj.url_index+\'" class="readbtn">立即阅读</a>\'
                    +\'</div>\';

            });
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">\'+ uiIntroduce +\'></a>\'
                +\'</div>\';
            if(uiTitle != \'\'){
                $(\'#\'+blockId).find(\'.m-title\').append(title);
            }
            $(\'#\'+blockId).find(\'.box-wrap\').append(str);
            if(uiIntroduce != \'\'){
                $(\'#\'+blockId).append(more);
            }

            lazy(\'img.lazy\');





        })
    </script></div>
<div id="blockId454" class="tempui196 tempui"><div class="m-title"></div>
    <div class="box-wrap"></div>
    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'];
            var blockId = \'blockId454\';
            var uiIntroduce = \'\';
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['4']['title'].'";
            var url = \'\';
            var str = "";
            var title="";
            var more="";

            title +=\'<div class="mod_tit">\'
                +\'<span></span>\'
                + uiTitle
                +\'</div>\';

            $.each(bookList,function(index,obj){
                var tagName = obj.tagName;
                str += \'<div class="zui_cont seciton-bd readbtnwrap">\'
                    +\'<dl class="editor-b-dl">\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<dt>\'
                    +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" border="0" />\'
                    +\'</dt>\'
                    +\'<dd>\'
                    +\'<span class="book-name">\'+ obj.name +\'</span>\'
                    +\'<span class="author-name">\'+obj.authorName+\'</span>\'
                    +\'<span class="book-brief">\'+ obj.intrduce +\'</span>\';
                str +=\'<p><span>\';
                for(i=0;i<tagName.length && i<2;i++){
                    var tagNameStr= tagName[i];
                    if(tagNameStr==\'宫斗\'){
                        str += \'<i class="guyan">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'悬疑\'){
                        str += \'<i class="xuanyi">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'穿越\' || tagNameStr==\'后宫\' || tagNameStr==\'情感\' || tagNameStr==\'婚恋\'){
                        str += \'<i class="xuanhuan">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'仙侠\' || tagNameStr==\'言情\'){
                        str += \'<i class="xianxia">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'都市\' || tagNameStr==\'爽文\'){
                        str += \'<i class="dushi">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'纯爱\' || tagNameStr==\'青春\' || tagNameStr==\'先婚后爱\'){
                        str += \'<i class="xiaoyuan">\'+tagNameStr+\'</i>\'
                    }else{
                        str += \'<i>\'+tagNameStr+\'</i>\'
                    }
                }
                str +=\'</span>\'
                    +\'</p>\'
                    +\'</dd>\'
                    +\'</a></dl>\'
                    +\'<a href="\'+obj.url_index+\'" class="readbtn">立即阅读</a>\'
                    +\'</div>\';

            });
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">\'+ uiIntroduce +\'&nbsp;></a>\'
                +\'</div>\';
            if(uiTitle != \'\'){
                $(\'#\'+blockId).find(\'.m-title\').append(title);
            }
            $(\'#\'+blockId).find(\'.box-wrap\').append(str);
            if(uiIntroduce != \'\'){
                $(\'#\'+blockId).append(more);
            }


            lazy(\'img.lazy\');





        })
    </script></div>
<div id="blockId455" class="tempui192 tempui"><div class="mod_tit" style="display:none;"></div>
    <div class="zui_cont seciton-bd">
        <ul class="ul-mod">
        </ul>
    </div>

    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'];
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['5']['title'].'";
            var blockId = \'blockId455\';
            var uiIntroduce = \'查看人气前100名\';
            var url = \''.jieqi_geturl('article','toplist','1','allvisit').'\';
            var str = "";
            var title="";
            var more="";
            title +=\'<span></span>\'
                + uiTitle;

            $.each(bookList,function(index,obj){
                str += \'<li>\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" />\'
                    +\'<span class="name">\'+ obj.name +\'</span>\'
                    +\'</a></li>\';

            })
            if(uiTitle != \'\'){
                //$(\'.mod_tit\').show();
                $(\'#\'+blockId).find(\'.mod_tit\').css(\'display\',\'block\').append(title);
            }
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">\'+ uiIntroduce +\'&nbsp;></a>\'
                +\'</div>\';
            if(uiIntroduce != \'\'){
                $(\'#\'+blockId).append(more);
            }
            $(\'#\'+blockId).find(\'.ul-mod\').append(str);
            lazy(\'img.lazy\');

        })
    </script></div>
<div id="blockId456" class="tempui196 tempui"><div class="m-title"></div>
    <div class="box-wrap"></div>
    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['6']['content'].'];
            var blockId = \'blockId456\';
            var uiIntroduce = \'\';
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['6']['title'].'";
            var url = \'\';
            var str = "";
            var title="";
            var more="";

            title +=\'<div class="mod_tit">\'
                +\'<span></span>\'
                + uiTitle
                +\'</div>\';

            $.each(bookList,function(index,obj){
                var tagName = obj.tagName;
                str += \'<div class="zui_cont seciton-bd readbtnwrap">\'
                    +\'<dl class="editor-b-dl">\'
                    +\'<a href="\'+ obj.url +\'">\'
                    +\'<dt>\'
                    +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" border="0" />\'
                    +\'</dt>\'
                    +\'<dd>\'
                    +\'<span class="book-name">\'+ obj.name +\'</span>\'
                    +\'<span class="author-name">\'+obj.authorName+\'</span>\'
                    +\'<span class="book-brief">\'+ obj.intrduce +\'</span>\';
                str +=\'<p><span>\';
                for(i=0;i<tagName.length && i<2;i++){
                    var tagNameStr= tagName[i];
                    if(tagNameStr==\'宫斗\'){
                        str += \'<i class="guyan">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'悬疑\'){
                        str += \'<i class="xuanyi">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'穿越\' || tagNameStr==\'后宫\' || tagNameStr==\'情感\' || tagNameStr==\'婚恋\'){
                        str += \'<i class="xuanhuan">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'仙侠\' || tagNameStr==\'言情\'){
                        str += \'<i class="xianxia">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'都市\' || tagNameStr==\'爽文\'){
                        str += \'<i class="dushi">\'+tagNameStr+\'</i>\'
                    }else if(tagNameStr==\'纯爱\' || tagNameStr==\'青春\' || tagNameStr==\'先婚后爱\'){
                        str += \'<i class="xiaoyuan">\'+tagNameStr+\'</i>\'
                    }else{
                        str += \'<i>\'+tagNameStr+\'</i>\'
                    }
                }
                str +=\'</span>\'
                    +\'</p>\'
                    +\'</dd>\'
                    +\'</a></dl>\'
                    +\'<a href="\'+obj.url_index+\'" class="readbtn">立即阅读</a>\'
                    +\'</div>\';

            });
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">\'+ uiIntroduce +\'&nbsp;></a>\'
                +\'</div>\';
            if(uiTitle != \'\'){
                $(\'#\'+blockId).find(\'.m-title\').append(title);
            }
            $(\'#\'+blockId).find(\'.box-wrap\').append(str);
            if(uiIntroduce != \'\'){
                $(\'#\'+blockId).append(more);
            }


            lazy(\'img.lazy\');





        })
    </script></div>
<div id="blockId457" class="tempui203 tempui"><div class="mod_tit" style="display:none;"></div>
    <div class="zui_cont seciton-bd"  id="changebox">
        <div id="change1" class="change">
            <ul class="ul-mod">
            </ul>
        </div>
        <!-- <div id="change2" class="change" style="display:none">
             <ul class="ul-mod">
             </ul>
         </div>
         <div id="change3" class="change" style="display:none">
             <ul class="ul-mod">
             </ul>
         </div>
         <a class="mod_more" id="button" href="javascript:;"><span><img src="static/picture/14876719865774602_34_28.png"><em>鎹竴镓?gt;</em></span></a>-->
    </div>

    <script type="text/javascript">
        $(function(){
            var bookList = ['.$this->_tpl_vars['jieqi_pageblocks']['7']['content'].'];
            var uiTitle = "'.$this->_tpl_vars['jieqi_pageblocks']['7']['title'].'";
            var blockId = \'blockId457\';
            var uiIntroduce = \'\';
            var url = \'\';
            var str = "";
            var str2 ="";
            var str3 ="";
            var title="";
            var more="";
            var changebtn="";

            title +=\'<span></span>\'
                + uiTitle;

            for(var i = 0, len = bookList.length; i < len; i++){
                var rand = parseInt(Math.random() * len);
                var temp = bookList[rand];
                bookList[rand] = bookList[i];
                bookList[i] = temp;
            }

            $.each(bookList,function(index,obj){

                if( index <= 5 ){
                    str += \'<li>\'
                        +\'<a href="\'+ obj.url +\'">\'
                        +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" />\'
                        +\'<span class="name">\'+ obj.name +\'</span>\'
                        +\'</a></li>\';
                }else if(index > 5 && index < 12){
                    str2 += \'<li>\'
                        +\'<a href="\'+ obj.url +\'">\'
                        +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" />\'
                        +\'<span class="name">\'+ obj.name +\'</span>\'
                        +\'</a></li>\';
                }else if(index >= 12 && index < 18){
                    str3 += \'<li>\'
                        +\'<a href="\'+ obj.url +\'">\'
                        +\'<img class="lazy" data-original="\'+ obj.iconUrlDefault +\'" />\'
                        +\'<span class="name">\'+ obj.name +\'</span>\'
                        +\'</a></li>\';
                }

            })
            if(uiTitle != \'\'){
                //$(\'.mod_tit\').show();
                $(\'#\'+blockId).find(\'.mod_tit\').css(\'display\',\'block\').append(title);
            }
            more +=\'<div class="mod_more">\'
                +\'<a href="\'+url+\'">\'+ uiIntroduce +\'</a>\'
                +\'</div>\';
            if(url != \'\'){
                $(\'#\'+blockId).append(more);
            }
            //console.log(str3.length);

            $(\'#\'+blockId).find(\'#change1 .ul-mod\').append(str);

            $(\'#\'+blockId).find(\'#change2 .ul-mod\').append(str2);

            $(\'#\'+blockId).find(\'#change3 .ul-mod\').append(str3);




            lazy(\'img.lazy\');

            /*var i=1;
            var count=$(\'#changebox .change\').length;
            var liLen=$(\'#changebox .change ul li\');
            var showPic = false;
            function change () {
                if(i > count){
                    i=1;
                }
                for (var j=1; j<=count; j++) {
                    $(\'#change\'+j).hide();
                }
                $(\'#change\'+i).show();


            }

            $(\'#button\').click(function(){
                i++;
                change();
                if(!showPic){
                    showPic = true;
                    $(\'#changebox\').find(\'img\').each(function(){
                        $(this).attr(\'src\',$(this).data(\'original\'));
                    })

                }
            });*/




        })


    </script></div>
<div id="blockId459" class="tempui205 tempui"><style>
    .gotop {
        width: 32px;
        height: 21px;
        display: inline-block;
        background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/footer_top_ico.png) no-repeat;
        background-size: 30px 21px;
        background-position: 0 0;
        position: fixed;
        right: 9px;
        bottom: 70px;
        z-index: 9999;
    }

    .bookshelf_entry{
        width:4rem;
        height:4rem;
        background:#ee5048;
        border-radius: 100%;
        position: fixed;
        right:1.2rem;
        top:28.4rem;

        box-shadow:  0 3px 10px #ccc;
        text-align:center;
        line-height:4.1rem;
        color:#fff;
        font-size:1.4rem;
        z-index:100;
    // display:none;
    }
</style>
    <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="bookshelf_entry">书架</a>
    <a id="back-to-top" class="gotop" href="#hd" style="display:none;"></a>
    <script>


        $(window).scroll(function() {
            var clientHeight = $(window).height();
            var offsetTo = $(\'body\').scrollTop();
            if(offsetTo > clientHeight) {
                $(\'#back-to-top\').show();
            } else {
                $(\'#back-to-top\').hide();
            }
        });

    </script></div>
<div id="blockId626" class="tempui384 tempui"><style>
    .bot_ecode{

        padding: 30px 0;
        text-align: center;
        width: 100%;
    }
    .bot_ecode img{
        width: 110px;
        height: 110px;
        margin: 0 auto;
        text-align: center;
        clear: both;
        border: 1px solid #ddd;
        margin: 7px;
    }
    .bot_ecode span,
    .bot_ecode em{
        display: block;
    }
    .bot_ecode .ecot_t1{
        margin-bottom: 15px;
        font-size: 16px;
        color: #333;
    }
    .bot_ecode .ecot_t2{
        margin-top: 10px;
        font-size: 14px;
        color: #999;
    }
</style>
    <div class="bot_ecode">
        <span class="ecot_t1">关注官方微信公众号【'.$this->_tpl_vars['jieqi_sitename'].'】，方便下次阅读</span>
        <img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/weixin.jpg" border="0">
        <em class="ecot_t2">— 微信内可长按识别 —</em>
    </div>
</div>
<div id="blockId460" class="tempui197 tempui"><style>
    .ovfHiden{overflow: hidden;height: 100%;}
</style>
    <div class="mobile_foot">
        <a href="'.$this->_tpl_vars['jieqi_url'].'/">首页</a>
        &nbsp;&nbsp;|&nbsp;&nbsp;<a id="go_topup" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" rel="nofollow">书架</a>
        <!--<a href="#hd" class="gotop"><img src="static/picture/footer_top_ico.png" border="0" width="32"  align="right"/></a>
         <!--<p class="clear slogan"><img src="static/picture/footer_zyq_n_solgan.png" border="0" width="180" /></p>-->
        <p style="font-size:1.2rem;margin-top: .5rem;">@2018 '.$this->_tpl_vars['jieqi_sitename'].'</p>
    </div>

</div>
<div id="blockId518" class="tempui198 tempui"><div style="height:5rem;" class="j_wxtab"></div>
    <div class="static-nav-mod j_wxtab" style="">
        <ul>
            <li class="m1">
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" id="persion">
                <em class="bot1">书架</em>
                </a>
            </li>

            <li class="m2 on">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/">
                    <em class="bot2">精选</em>
                </a>
            </li>

            <li class="m3">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php">
                    <em class="bot3">我的</em>
                </a>
            </li>
        </ul>
    </div>
</div>
</body>
</html>



';
?>