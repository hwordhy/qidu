<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<meta name="generator" content="jieqi.com" />
	<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['jieqi_url'].'/scripts/layuiadmin/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['jieqi_url'].'/scripts/layuiadmin/style/admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['jieqi_url'].'/css/frame.css" />
</head>
<body class="layui-layout-body">
<div id="LAY_app">
	<div class="layui-layout layui-layout-admin">
		<div class="layui-header">
			<!-- 头部区域 -->
			<ul class="layui-nav layui-layout-left">
				<li class="layui-nav-item layadmin-flexible" lay-unselect>
					<a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
						<i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
					</a>
				</li>
				<li class="layui-nav-item layui-hide-xs" lay-unselect>
					<a href="/" target="_blank" title="前台">
						<i class="layui-icon layui-icon-website"></i>
					</a>
				</li>
				<li class="layui-nav-item" lay-unselect>
					<a href="javascript:;" layadmin-event="refresh" title="刷新">
						<i class="layui-icon layui-icon-refresh-3"></i>
					</a>
				</li>
			</ul>
			<ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
				<!--
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                -->
				<li class="layui-nav-item layui-hide-xs" lay-unselect>
					<a href="javascript:;" layadmin-event="fullscreen">
						<i class="layui-icon layui-icon-screen-full"></i>
					</a>
				</li>
				<li class="layui-nav-item" lay-unselect>
					<a href="javascript:;">
						<cite>'.$this->_tpl_vars['username'].'</cite>
					</a>
					<dl class="layui-nav-child">
						<dd style="text-align: center;">
							<a href="'.$this->_tpl_vars['jieqi_url'].'/logout.php" target="_top">退出</a>
						</dd>
					</dl>
				</li>

				<li class="layui-nav-item layui-hide-xs" lay-unselect>
					<a href="/" target="_blank">JIEQI CMS '.$this->_tpl_vars['jieqi_version'].' '.$this->_tpl_vars['jieqi_vtype'].'</a>
				</li>

			</ul>
		</div>

		<!-- 侧边菜单 -->
		<div class="layui-side layui-side-menu">
			<div class="layui-side-scroll">
				<div class="jieqi-logo" lay-href="/admin/main.php">
					<span>'.$this->_tpl_vars['jieqi_sitename'].'</span>
				</div>

				<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
					<!--
                    <li data-name="home" class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;" lay-tips="主页" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>主页</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd data-name="console" class="layui-this">
                                <a lay-href="/admin/main.php">后台首页</a>
                            </dd>
                            <dd data-name="front">
                                <a href="/" target="_blank">前台首页</a>
                            </dd>
                        </dl>
                    </li>
                    -->
					<li data-name="system" class="layui-nav-item">
						<a href="javascript:;" lay-tips="系统设置" lay-direction="2">
							<i class="layui-icon layui-icon-set"></i>
							<cite>系统设置</cite>
						</a>
						<dl class="layui-nav-child">
							';
if (empty($this->_tpl_vars['adminmenus']['system'])) $this->_tpl_vars['adminmenus']['system'] = array();
elseif (!is_array($this->_tpl_vars['adminmenus']['system'])) $this->_tpl_vars['adminmenus']['system'] = (array)$this->_tpl_vars['adminmenus']['system'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['adminmenus']['system']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['adminmenus']['system']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['adminmenus']['system']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus']['system']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['adminmenus']['system']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
							';
if($this->_tpl_vars['adminmenus']['system'][$this->_tpl_vars['j']['key']]['publish'] == 1){
echo '
							<dd><a lay-href="'.$this->_tpl_vars['adminmenus']['system'][$this->_tpl_vars['j']['key']]['command'].'">'.$this->_tpl_vars['adminmenus']['system'][$this->_tpl_vars['j']['key']]['caption'].'</a></dd>
							';
}
echo '
							';
}
echo '
						</dl>
					</li>
					<li data-name="users" class="layui-nav-item">
						<a href="javascript:;" lay-tips="用户管理" lay-direction="2">
							<i class="layui-icon layui-icon-user"></i>
							<cite>用户管理</cite>
						</a>
						<dl class="layui-nav-child">
							';
if (empty($this->_tpl_vars['adminmenus']['users'])) $this->_tpl_vars['adminmenus']['users'] = array();
elseif (!is_array($this->_tpl_vars['adminmenus']['users'])) $this->_tpl_vars['adminmenus']['users'] = (array)$this->_tpl_vars['adminmenus']['users'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['adminmenus']['users']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['adminmenus']['users']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['adminmenus']['users']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus']['users']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['adminmenus']['users']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
							';
if($this->_tpl_vars['adminmenus']['users'][$this->_tpl_vars['j']['key']]['publish'] == 1){
echo '
							<dd><a lay-href="'.$this->_tpl_vars['adminmenus']['users'][$this->_tpl_vars['j']['key']]['command'].'">'.$this->_tpl_vars['adminmenus']['users'][$this->_tpl_vars['j']['key']]['caption'].'</a></dd>
							';
}
echo '
							';
}
echo '
						</dl>
					</li>
					<li data-name="modules" class="layui-nav-item">
						<a href="javascript:;" lay-tips="模块管理" lay-direction="2">
							<i class="layui-icon layui-icon-app"></i>
							<cite>模块管理</cite>
						</a>
						<dl class="layui-nav-child">
							';
if (empty($this->_tpl_vars['jieqimodules'])) $this->_tpl_vars['jieqimodules'] = array();
elseif (!is_array($this->_tpl_vars['jieqimodules'])) $this->_tpl_vars['jieqimodules'] = (array)$this->_tpl_vars['jieqimodules'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqimodules']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqimodules']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqimodules']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqimodules']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqimodules']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
							<dd data-name="grid">
								<a href="javascript:;">'.$this->_tpl_vars['jieqimodules'][$this->_tpl_vars['i']['key']]['caption'].'</a>
								<dl class="layui-nav-child">

									';
if (empty($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']] = array();
elseif (!is_array($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']] = (array)$this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']]);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']]);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']]);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
									';
if($this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['publish'] == 1){
echo '
									<dd><a lay-href="'.$this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['command'].'">'.$this->_tpl_vars['adminmenus'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['caption'].'</a></dd>
									';
}
echo '
									';
}
echo '

								</dl>
							</dd>
							';
}
echo '
						</dl>
					</li>
					<li data-name="tools" class="layui-nav-item">
						<a href="javascript:;" lay-tips="系统工具" lay-direction="2">
							<i class="layui-icon layui-icon-util"></i>
							<cite>系统工具</cite>
						</a>
						<dl class="layui-nav-child">

							';
if (empty($this->_tpl_vars['adminmenus']['tools'])) $this->_tpl_vars['adminmenus']['tools'] = array();
elseif (!is_array($this->_tpl_vars['adminmenus']['tools'])) $this->_tpl_vars['adminmenus']['tools'] = (array)$this->_tpl_vars['adminmenus']['tools'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['adminmenus']['tools']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['adminmenus']['tools']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['adminmenus']['tools']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus']['tools']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['adminmenus']['tools']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
							';
if($this->_tpl_vars['adminmenus']['tools'][$this->_tpl_vars['j']['key']]['publish'] == 1){
echo '
							<dd><a lay-href="'.$this->_tpl_vars['adminmenus']['tools'][$this->_tpl_vars['j']['key']]['command'].'">'.$this->_tpl_vars['adminmenus']['tools'][$this->_tpl_vars['j']['key']]['caption'].'</a></dd>
							';
}
echo '
							';
}
echo '

						</dl>
					</li>
					<li data-name="users" class="layui-nav-item">
						<a href="javascript:;" lay-tips="用户管理" lay-direction="2">
							<i class="layui-icon layui-icon-senior"></i>
							<cite>数据维护</cite>
						</a>
						<dl class="layui-nav-child">
							';
if (empty($this->_tpl_vars['adminmenus']['database'])) $this->_tpl_vars['adminmenus']['database'] = array();
elseif (!is_array($this->_tpl_vars['adminmenus']['database'])) $this->_tpl_vars['adminmenus']['database'] = (array)$this->_tpl_vars['adminmenus']['database'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['adminmenus']['database']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['adminmenus']['database']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['adminmenus']['database']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus']['database']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['adminmenus']['database']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
							';
if($this->_tpl_vars['adminmenus']['database'][$this->_tpl_vars['j']['key']]['publish'] == 1){
echo '
							<dd><a lay-href="'.$this->_tpl_vars['adminmenus']['database'][$this->_tpl_vars['j']['key']]['command'].'">'.$this->_tpl_vars['adminmenus']['database'][$this->_tpl_vars['j']['key']]['caption'].'</a></dd>
							';
}
echo '
							';
}
echo '
						</dl>
					</li>
					<li data-name="help" class="layui-nav-item">
						<a href="javascript:;" lay-tips="关于" lay-direction="2">
							<i class="layui-icon layui-icon-about"></i>
							<cite>关于</cite>
						</a>
						<dl class="layui-nav-child">
							<dd><a href="http://www.jieqi.com" target="_blank">官方网站</a></dd>
							<dd><a href="http://help.jieqi.com" target="_blank">帮助中心</a></dd>
							<dd><a lay-href="'.$this->_tpl_vars['jieqi_url'].'/admin/faq.php">使用技巧</a></dd>
							<dd class="layui-this"><a lay-href="'.$this->_tpl_vars['jieqi_url'].'/admin/license.php">授权信息</a></dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>

		<!-- 页面标签 -->
		<div class="layadmin-pagetabs" id="LAY_app_tabs">
			<div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
			<div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
			<div class="layui-icon layadmin-tabs-control layui-icon-down">
				<ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
					<li class="layui-nav-item" lay-unselect>
						<a href="javascript:;"></a>
						<dl class="layui-nav-child layui-anim-fadein">
							<dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
							<dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
							<dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
				<ul class="layui-tab-title" id="LAY_app_tabsheader">
					<li lay-id="'.$this->_tpl_vars['jieqi_url'].'/admin/main.php" lay-attr="'.$this->_tpl_vars['jieqi_url'].'/admin/main.php" class="layui-this">
						<i class="layui-icon layui-icon-home"></i></li>
				</ul>
			</div>
		</div>


		<!-- 主体内容 -->
		<div class="layui-body" id="LAY_app_body">
			<div class="layadmin-tabsbody-item layui-show">
				<iframe src="'.$this->_tpl_vars['jieqi_url'].'/admin/main.php" frameborder="0" class="layadmin-iframe"></iframe>
			</div>
		</div>

		<!-- 辅助元素，一般用于移动设备下遮罩 -->
		<div class="layadmin-body-shade" layadmin-event="shade"></div>
	</div>
</div>

<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/layuiadmin/layui/layui.js" charset="UTF-8"></script>
<script type="text/javascript">
    layui.config({
        base: \'/scripts/layuiadmin/\' //静态资源所在路径
    }).extend({
        index: \'lib/index\' //主入口模块
    }).use(\'index\');
</script>

</body>

</html>
';
?>