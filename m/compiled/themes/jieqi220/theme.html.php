<?php
echo '<!DOCTYPE html>
<html lang="zh-cmn-Hans">
 <head>
  <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
  <meta charset="gbk" />
  <meta http-equiv="Cache-Control" content="no-transform" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'" />
  <meta name="description" content="'.$this->_tpl_vars['meta_description'].'" />
  <meta name="renderer" content="webkit" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no" />
  <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/base.css" />
  <!--<link type="text/css"  rel="stylesheet" href="css/wapjieri.css" />-->
  <script src="/themes/jieqi220/js/jquery-1.11.1.min.js" type="text/javascript"></script>
  <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/index.css" />
  <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/owl.carousel.css" />
<script src="/wap/js/jquery.min.js"></script>
<script type="text/javascript" src="/wap/js/fs.js"></script>
<script type="text/javascript" src="/wap/layer.m.js"></script>
<script type="text/javascript" src="/wap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/wap/js/pagewap.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
 </head>
 <body>

        <section class="wapheader">
            <section class="container">
                <a href="/" title="" class="fl logo"></a>
                <span class="right fr"><!--??¼??-->
                    ';
if($this->_tpl_vars['jieqi_userid'] ==0){
echo ' 
<!--??¼ǰ--><a href="/register.php">ע??</a>
<a href="/login.php">??¼</a>
<a href="/api/weixin/login.php" class="wechat"></a>
<a href="/api/qq/login.php" class="qq"></a>

<!--
<a href="/api/weibo/login.php" class="weibo"></a>
-->
<!--??¼ǰ end-->
<a class="history" href="/login.php">??½???ɲ鿴?Ķ???¼</a>
';
}else{
echo '
                    <a href="/modules/article/bookcase.php" class="mybook">????</a>
                    <a href="/userdetail.php" class="allways">
                        <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'s').'" class="bd50">
                        <a class="history" href="/ssss.php">?鿴?ҵ??Ķ???¼</a>
                        ';
}
echo '     
                    </span>
                    </section>
                </section>
        <section class="menu clearfix">
            <section class="container">
                <ul>
                    <li>
                        <a href="/"><em class="icon01"></em><b class="active">??ҳ</b></a></li>
                        <li><a href="/top"><em class="icon02"></em><b>????</b></a></li>
                        <li><a href="/modules/article/articlefilter.php"><em class="icon03"></em><b>????</b></a></li>
                        <li><a href="/sou.php"><em class="icon04"></em><b>????</b></a></li>
                        <li><a href="/modules/pay/buyegold.php"><em class="icon05"></em><b>??ֵ</b></a></li>
                    </ul>
                </section>
            </section>
      
  <!--?˵?-->
  ';
if($this->_tpl_vars['jieqi_contents'] != ""){
echo $this->_tpl_vars['jieqi_contents'];
}
echo '
    <!--β??-->
    <section class="footer clearfix">
        <section class="container">
         <a href="/" id="down" class="downChannelCount" data-recommendid="4531"><h1>ǩ???????????Ķ???????</h1></a>
         <p class="clearfix"><a href="http://m.cmqxwx.com/">??ҳ</a><a href="/modules/article/articlefilter.php">????</a><a href="/sou.php">????</a><a href="/modules/pay/buyegold.php">??ֵ</a><a href="http://www.cmqxwx.com/">????վ</a></p>
         <p>&copy;2019  ?????Ķ?</p>
		
		
        </section>
       </section>
	   <div style="display:none;">
  </div>
<script>
$(function(){
	var time = 4;	//??????ʱ?䣬????Ϊ??λ??ԽСԽ??

	var $progressBar, $bar, $elem, isPause, tick, percentTime;

	$(\'#owl-demo\').owlCarousel({
		slideSpeed: 500,
		paginationSpeed: 500,
		singleItem: true,
		afterInit: progressBar,
		afterMove: moved,
		startDragging: pauseOnDragging
	});

	function progressBar(elem){
		$elem = elem;
		buildProgressBar();
		start();
	}

	function buildProgressBar(){
		$progressBar = $(\'<div>\',{
			id:\'progressBar\'
		});
		$bar = $(\'<div>\',{
			id:\'bar\'
		});
		// $progressBar.append($bar).insertAfter($elem.children().eq(0));
	}

	function start(){
		percentTime = 0;
		isPause = false;
		tick = setInterval(interval, 10);
	}

	function interval(){
		if(isPause === false){
			percentTime += 1 / time;
			$bar.css({
				width: percentTime+\'%\'
			});
			if(percentTime >= 100){
				$elem.trigger(\'owl.next\')
			}
		}
	}

	function pauseOnDragging(){
		isPause = true;
	}

	function moved(){
		clearTimeout(tick);
		start();
	}

	$elem.on(\'mouseover\',function(){
		isPause = true;
	})

	$elem.on(\'mouseout\',function(){
		isPause = false;
	});

    if(is_weixn()){
        $(".down").attr(\'href\',\'http://a.app.qq.com/o/simple.jsp?pkgname=com.mengmengda.reader\');
    }

    $(\'#snotice\').marquee({
        auto: true,
        interval: 4000,
        showNum: 1,
        stepLen: 1,
        type: \'vertical\'
    });  
});

//????,???????Ƽ???
      $(\'.topsell .tab\').find(\'a\').each(function(index,element){
              $(element).on(\'click\',function(){
                     $(this).addClass(\'active\').parent(\'span\').siblings().children(\'a\').removeClass(\'active\');
                   $(\'.topsell .topul\').eq(index-1).removeClass(\'block\')
                  $(\'.topsell .topul\').eq(index).addClass(\'block\').siblings().removeClass(\'block\');
          })
      });


</script>
 
  <!--β?? end-->
<script src="/themes/jieqi220/js/owl.carousel.js" type="text/javascript"></script> 
<script src="/themes/jieqi220/js/wapnew.js" type="text/javascript"></script> 
<script src="/themes/jieqi220/js/marquee.js" type="text/javascript"></script> 

      </body>
     </html>';
?>