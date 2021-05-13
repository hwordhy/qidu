<?php
echo '<!DOCTYPE html>
<html lang="zh-cmn-Hans">
 <head>
  <title>'.$this->_tpl_vars['articlename'].'-'.$this->_tpl_vars['author'].'-'.$this->_tpl_vars['sort'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
  <meta charset="gbk" />
  <meta http-equiv="Cache-Control" content="no-transform" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="Baiduspider" content="noarchive" />
  <meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'" />
  <meta name="description" content="'.$this->_tpl_vars['meta_description'].'" />
  <meta name="renderer" content="webkit" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no" />
  <meta name="format-detection" content="telephone=no" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="baidu-site-verification" content="4a8ExyTvbS" />
  <meta name="wap-font-scale" content="no" />
  <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/base.css" />
  <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/index.css" />
     <link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/catalog.css" />
 </head>
  <style>
.page em{
   text-align: center; 
}
#pagestats{
	position: relative;
	 left: 50px;
	 font-size: 14px;
	 font-style:normal;
}
.prev{
	font-size: 15px;
    float: left;
}
.next{
	font-size: 15px;
    float: right;
}
</style>
 <body>
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
  <section class="menu clearfix">
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
					                  <section class="container">
	<section class="catalog clearfix" style="width: 96%;/*! margin: 0 auto; */margin-left: -1px;">
        <div class="container" style="width: 96%;">
        <p class="here">
            <a>'.$this->_tpl_vars['articlename'].'</a><b>></b> 
            
            <a>Ŀ¼ </a>
            <b  class="  fr">����:&nbsp'.$this->_tpl_vars['author'].'</b>
            </p>
			';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] > 0){
echo '
			';
if($this->_tpl_vars['i']['order'] > 1){
echo '</ul>';
}
echo '
                ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip'] == 0){
}
echo '
                ';
if($this->_tpl_vars['i']['order'] < $this->_tpl_vars['i']['count']){
echo '
                <ul class="list_li" id="jsList1" style="display: block;">';
}
echo '
                    ';
}else{
echo '
			';
if($this->_tpl_vars['i']['order'] == 1){
echo '<ul class="list_li" id="jsList1" style="display: block;">';
}
echo '
                ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '
			<li style="width:100%;height:45px;text-align:left" id="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'] != 0){
echo 'act';
}
if($this->_tpl_vars['i']['order'] %2==0){
echo 'two';
}
echo '"><a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'"><img style="width:12px;height:10px;margin-right:8px;" src="http://www.novelrd.cn/sink/image/icon-chapter-vip.png" alt="vip">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a><em></em></li>';
}else{
echo '
			<li style="width:100%;height:45px;text-align:left" id="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" class="';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'] != 0){
echo 'act';
}
if($this->_tpl_vars['i']['order'] %2==0){
echo 'two';
}
echo '"><a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a><em></em></li>';
}
echo '
            ';
if($this->_tpl_vars['i']['order'] == $this->_tpl_vars['i']['count']){
echo '
        </ul>';
}
}
}
echo '
			</div>
			</div>
	<hr>
			'.$this->_tpl_vars['url_jumppage'].'
            <ul  >
            </ul>
      
        </div>
        </section>

    <!--β��-->
    <section class="footer clearfix" style="width: 96%;">
        <section class="container"  style="width: 96%;">
         <a href="/" id="down" class="downChannelCount" data-recommendid="4531"><h1>ǩ��������Ķ�������</h1></a>
                <p class="clearfix"><a href="http://m.novelrd.cn/">��ҳ</a><a href="/modules/article/articlefilter.php">���</a><a href="/sou.php">����</a><a href="/modules/pay/buyegold.php?t=paycardpay">��ֵ</a><a href="http://www.novelrd.cn/">����վ</a></p>
         <p>&copy;2019  ��ī����</p>
        </section>
       </section>
       <div style="display:none;">

       <!--β�� end-->
      </body>
     </html>';
?>