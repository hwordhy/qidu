<?php
/**
 * 网站首页
 *
 * 网站首页，允许用户修改载入的区块和模板实现定制效果
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 
 
 $jieqiBlocks[]=array('bid'=>0, 'blockname'=>'WAP首页大图', 'module'=>'article', 'filename'=>'block_commend', 'classname'=>'BlockArticleCommend', 'side'=>-1, 'title'=>'WAP首页大图', 'vars'=>'1|2|3', 'template'=>'wap_shouye_datu.html', 'contenttype'=>1, 'custom'=>0, 'publish'=>3, 'hasvars'=>2);
 
 */

//定义本页面所属模块（请勿修改）
define("JIEQI_MODULE_NAME", "system");
require_once("global.php");

//包含区块参数，可修改第二个参数。默认 blocks 表示载入的区块配置文件是 /configs/blocks.php
//用户可创建自定义区块配置文件，比如叫 /configs/indexblocks.php，以下函数第二个参数改成 indexblocks 即可
jieqi_getconfigs(JIEQI_MODULE_NAME, "blocks", "jieqiBlocks");

//包含页头处理
include_once(JIEQI_ROOT_PATH."/header.php");

//设置首页标志，便于模板里面可以判断
$jieqiTpl->assign("jieqi_indexpage",1);  

//内容模板的赋值有三种方式
//1、不定义模板变量，表示默认按照区块配置文件的配置显示区块内容和位置
//$jieqiTset["jieqi_contents_template"] = "";  
//2、指定一个首页中间内容部分模板，页头和页尾部分用系统默认的theme，例子如下：
$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH."/wap/sou.html";
//3、指定整页模板，模板本身包含页头页尾部分代码，例子如下：
//$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/wap/wap.html";

//在使用首页模板时候，以下参数为 0 表示不缓存以上模板内容，1 表示缓存 （默认不缓存）
$jieqiTpl->setCaching(0);

//包含页尾，最终输出网页显示
include_once(JIEQI_ROOT_PATH."/footer.php");
?>