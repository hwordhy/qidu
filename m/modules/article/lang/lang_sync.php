<?php
/**
 * 语言包-小说同步
 *
 * 语言包-小说同步
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: lang_sync.php 228 2008-11-27 06:44:31Z juny $
 */

$jieqiLang['article']['sync']=1; //表示本语言包已经包含

$jieqiLang['article']['sync_start_notice']='同步晓恋悦读小说可能会需要比较长时间，请耐心等待！<br />默认将打开新窗口运行，程序执行结束前请勿关闭，也不要同时打开多个窗口执行同步，否则可能造成数据错乱。<br /><br /><a href="%s" target="_blank">&gt;&gt;点击这里开始同步</a><br /><br />';
$jieqiLang['article']['sync_jieqi_nojoin']='对不起，您尚未加入晓恋悦读，请访问晓恋悦读申请加入！<br /><br /><a href="http://www.jieqi.net" target="_blank">点击进入晓恋悦读</a>';
$jieqiLang['article']['sync_need_confirm']='本功能用于将晓恋悦读的小说同步到本地，可能会需要比较长时间，默认点击以下链接会打开新窗口运行。<br /><br />注意：同一时间请不要打开多个窗口执行本程序。<br /><br /><a href="%s" target="_blank">点击这里开始同步</a><br /><br />';
$jieqiLang['article']['sync_article_noupdate']='检查完成，没有需要更新的小说！';
$jieqiLang['article']['sync_cachefile_openfailed']='打开缓存文件 %s 失败，请检查改文件及目录是否可写！';
$jieqiLang['article']['sync_article_updatenum']='共有 %s 本小说需要同步，稍后将逐本开始同步。';
$jieqiLang['article']['sync_allarticle_success']='恭喜您，全部小说同步完成，本次共同步小说 %s 本!';
$jieqiLang['article']['sync_next_html']='<html><head><title>小说同步</title><meta http-equiv="Content-Type" content="text/html; charset=%s"></head><body><br /><br />&nbsp;&nbsp;开始同步小说，本次预计同步 %s 本，即将同步第 %s 本。请耐心等待......<br /><br /><a href="%s">如浏览器确实不支持转换，点击这里同步下一本。</a><script type="text/javascript">document.location="%s";</script></body></html>';
$jieqiLang['article']['sync_cfile_notexists']='对不起，同步缓存文件不存在！';
$jieqiLang['article']['sync_cfile_formaterror']='对不起，同步缓存文件格式错误！';
$jieqiLang['article']['sync_log_notexists']='对不起，同步日志不存在！';
$jieqiLang['article']['sync_maybe_doing']='前一次同步可能正在进行中，请不要同时执行多个同步程序。<br /><br />如果您确认上次同步已经结束，请等待3分钟后再继续尝试同步！';
$jieqiLang['article']['sync_article_notneed']='《%s》的本站内容和对方站相同，不需要同步。';
$jieqiLang['article']['sync_article_begin']='《%s》开始同步...';
$jieqiLang['article']['sync_return_formaterror']='返回内容格式错误！';
$jieqiLang['article']['sync_savearticle_failure']='创建或更新小说信息失败！';
$jieqiLang['article']['sync_chaptercontent_nourl']='解析章节内容网址失败！';
$jieqiLang['article']['sync_chaptercontent_failure']='获取章节内容失败！<br />章节名称：%s';
$jieqiLang['article']['sync_chapteradd_failure']='保存章节信息到数据库失败！';

$jieqiLang['article']['sync_site_notexists']='对不起，该站点不存在！';
$jieqiLang['article']['sync_ret_errorformat']='返回的格式错误！';
$jieqiLang['article']['sync_ret_errorparse']='返回的内容解析错误！';
$jieqiLang['article']['sync_allpage_finish']='所有列表页已采集完成！';
$jieqiLang['article']['sync_articlelist_start']='开始同步小说更新列表！';
$jieqiLang['article']['sync_articleeach_start']='开始逐本同步小说：';
$jieqiLang['article']['sync_page_next']='第 %s 页采集完成，继续同步下一页的小说。';
$jieqiLang['article']['sync_page_html']='<html><head><title>小说同步</title><meta http-equiv="Content-Type" content="text/html; charset=%s"></head><body><br /><br />&nbsp;&nbsp;%s<br /><br /><a href="%s">如浏览器不能自动转换，点击这里采集下一页。</a><script type="text/javascript">document.location="%s";</script></body></html>';
$jieqiLang['article']['sync_page_success']='恭喜您，全部小说同步完成!';
?>