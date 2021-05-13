<?php
/**
 * 后台徽章管理导航配置
 *
 * 后台徽章管理导航配置
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    badge
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: adminmenu.php 187 2008-11-24 09:30:03Z juny $
 */

/**
'layer'     - 菜单深度，默认 0
'caption'   - 菜单标题
'command'   - 链接的网址
'target'    - 点击链接是否打开新窗口(0-不新开；1-新开)
'publish'   - 是否显示（0-不显示；1-显示）
*/

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '参数设置', 'command'=>JIEQI_URL.'/admin/configs.php?mod=badge', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '权限设置', 'command'=>JIEQI_URL.'/admin/power.php?mod=badge', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '徽章管理', 'command'=>$GLOBALS['jieqiModules']['badge']['url'].'/admin/badgelist.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '授予记录', 'command'=>$GLOBALS['jieqiModules']['badge']['url'].'/admin/badgeaward.php', 'target' => 0, 'publish' => 1);
?>