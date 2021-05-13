<?php
/*
//作者vip分成计算方法
function jieqi_rule_article_mreportdivide(&$report){
	$report['authormoney'] = round($report['sumegold'] * 0.5 + $report['sumtip'] * 0.5);
	$report['agentmoney'] = 0;
	$report['sitemoney'] = $report['summoney'] - $report['authormoney'] - $report['agentmoney'];
	return $report;
}

//编辑作品信息限制(返回true或者false，或者禁止编辑的字段，如 array('intro'=>1))
function jieqi_rule_article_articleedit($article){
	$ret = true;
	if($article->getVar('issign', 'n') > 0){
		$delytime = 3600; //多少时间以内发现错误可以修改
		if($_SESSION['jieqiUserId'] > 0 && ($article->getVar('authorid') == $_SESSION['jieqiUserId'] || $article->getVar('posterid') == $_SESSION['jieqiUserId'])){
			$uptime = intval($article->getVar('postdate', 'n'));
			if(JIEQI_NOW_TIME - $uptime >= $delytime){
				$ret = false;
			}
		}
	}
	return $ret;
}
//删除作品限制
function jieqi_rule_article_articledelete($article){
	$ret = true;
	return $ret;
}

//作者编辑章节限制
function jieqi_rule_article_chapteredit($chapter, $article){
	$ret = true;
	if($article->getVar('issign', 'n') > 0){
		$delytime = 3600; //多少时间以内发现错误可以修改
		if($_SESSION['jieqiUserId'] > 0 && ($article->getVar('authorid') == $_SESSION['jieqiUserId'] || $article->getVar('posterid') == $_SESSION['jieqiUserId'])){
			$uptime = intval($chapter->getVar('postdate', 'n'));
			if(JIEQI_NOW_TIME - $uptime >= $delytime){
				$ret = false;
			}
		}
	}
	return $ret;
}
//作者删除章节限制
function jieqi_rule_article_chapterdelete($chapter, $article){
	return jieqi_rule_article_chapteredit($chapter, $article);
}
//作者设置章节状态限制
function jieqi_rule_article_chapterset($chapter, $article){
	return jieqi_rule_article_chapteredit($chapter, $article);
}
*/

