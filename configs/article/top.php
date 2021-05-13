<?php
//排行榜类型配置
$jieqiTop['article']['toplist'] = array('caption'=>'全部榜单', 'description'=>'', 'where'=>'', 'sort'=>'articleid', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['allvisit'] = array('caption'=>'总点击榜', 'description'=>'', 'where'=>'', 'sort'=>'allvisit', 'order'=>'DESC', 'isvip'=>0, 'default'=>1, 'publish' => '1');
$jieqiTop['article']['monthvisit'] = array('caption'=>'月点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$monthstart}>', 'sort'=>'monthvisit', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvisit'] = array('caption'=>'周点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$weekstart}>', 'sort'=>'weekvisit', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['dayvisit'] = array('caption'=>'日点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$daystart}>', 'sort'=>'dayvisit', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');

$jieqiTop['article']['allvote'] = array('caption'=>'总推荐榜', 'description'=>'', 'where'=>'', 'sort'=>'allvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvote'] = array('caption'=>'月推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$monthstart}>', 'sort'=>'monthvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvote'] = array('caption'=>'周推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$weekstart}>', 'sort'=>'weekvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['dayvote'] = array('caption'=>'日推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$daystart}>', 'sort'=>'dayvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');

$jieqiTop['article']['allvipvote'] = array('caption'=>'总月票榜', 'description'=>'', 'where'=>'', 'sort'=>'allvipvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvipvote'] = array('caption'=>'月月票榜', 'description'=>'', 'where'=>'lastvipvote >= <{$monthstart}>', 'sort'=>'monthvipvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['previpvote'] = array('caption'=>'上月月票榜', 'description'=>'', 'where'=>'', 'sort'=>'previpvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weekvipvote'] = array('caption'=>'周月票榜', 'description'=>'', 'where'=>'lastvipvote >= <{$weekstart}>', 'sort'=>'weekvipvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['dayvipvote'] = array('caption'=>'日月票榜', 'description'=>'', 'where'=>'lastvipvote >= <{$daystart}>', 'sort'=>'dayvipvote', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');


$jieqiTop['article']['allflower'] = array('caption'=>'总鲜花榜', 'description'=>'', 'where'=>'', 'sort'=>'allflower', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthflower'] = array('caption'=>'月鲜花榜', 'description'=>'', 'where'=>'lastflower >= <{$monthstart}>', 'sort'=>'monthflower', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weekflower'] = array('caption'=>'周鲜花榜', 'description'=>'', 'where'=>'lastflower >= <{$weekstart}>', 'sort'=>'weekflower', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['dayflower'] = array('caption'=>'日鲜花榜', 'description'=>'', 'where'=>'lastflower >= <{$daystart}>', 'sort'=>'dayflower', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');


$jieqiTop['article']['allegg'] = array('caption'=>'总鸡蛋榜', 'description'=>'', 'where'=>'', 'sort'=>'allegg', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthegg'] = array('caption'=>'月鸡蛋榜', 'description'=>'', 'where'=>'lastegg >= <{$monthstart}>', 'sort'=>'monthegg', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weekegg'] = array('caption'=>'周鸡蛋榜', 'description'=>'', 'where'=>'lastegg >= <{$weekstart}>', 'sort'=>'weekegg', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['dayegg'] = array('caption'=>'日鸡蛋榜', 'description'=>'', 'where'=>'lastegg >= <{$daystart}>', 'sort'=>'dayegg', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');

$jieqiTop['article']['monthsize'] = array('caption'=>'月勤更榜', 'description'=>'', 'where'=>'lastupdate >= <{$monthstart}>', 'sort'=>'monthsize', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weeksize'] = array('caption'=>'周勤更榜', 'description'=>'', 'where'=>'lastupdate >= <{$weekstart}>', 'sort'=>'weeksize', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['daysize'] = array('caption'=>'日勤更榜', 'description'=>'', 'where'=>'lastupdate >= <{$daystart}>', 'sort'=>'daysize', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');

$jieqiTop['article']['allsale'] = array('caption'=>'总销售榜', 'description'=>'', 'where'=>'', 'sort'=>'allsale', 'order'=>'DESC', 'isvip'=>1, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthsale'] = array('caption'=>'月销售榜', 'description'=>'', 'where'=>'lastsale >= <{$monthstart}>', 'sort'=>'monthsale', 'order'=>'DESC', 'isvip'=>1, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weeksale'] = array('caption'=>'周销售榜', 'description'=>'', 'where'=>'lastsale >= <{$weekstart}>', 'sort'=>'weeksale', 'order'=>'DESC', 'isvip'=>1, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['daysale'] = array('caption'=>'日销售榜', 'description'=>'', 'where'=>'lastsale >= <{$daystart}>', 'sort'=>'daysale', 'order'=>'DESC', 'isvip'=>1, 'default'=>0, 'publish' => '1');

$jieqiTop['article']['lastupdate'] = array('caption'=>'最近更新', 'description'=>'', 'where'=>'', 'sort'=>'lastupdate', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['postdate'] = array('caption'=>'最新入库', 'description'=>'', 'where'=>'', 'sort'=>'postdate', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['signtime'] = array('caption'=>'最新上架', 'description'=>'', 'where'=>'vipid > 0', 'sort'=>'signtime', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['goodnum'] = array('caption'=>'收藏榜', 'description'=>'', 'where'=>'', 'sort'=>'goodnum', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['size'] = array('caption'=>'字数榜', 'description'=>'', 'where'=>'', 'sort'=>'size', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '1');
$jieqiTop['article']['toptime'] = array('caption'=>'本站推荐', 'description'=>'', 'where'=>'', 'sort'=>'toptime', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['newhot'] = array('caption'=>'新书榜', 'description'=>'', 'where'=>'postdate >= '.(time() - 2592000), 'sort'=>'allvisit', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');
$jieqiTop['article']['sumtip'] = array('caption'=>'打赏榜', 'description'=>'', 'where'=>'', 'sort'=>'sumtip', 'order'=>'DESC', 'isvip'=>1, 'default'=>0, 'publish' => '1');

$jieqiTop['article']['ratenum'] = array('caption'=>'评分', 'description'=>'', 'where'=>'', 'sort'=>'ratenum', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');

$jieqiTop['article']['reviewsnum'] = array('caption'=>'评论', 'description'=>'', 'where'=>'', 'sort'=>'reviewsnum', 'order'=>'DESC', 'isvip'=>0, 'default'=>0, 'publish' => '0');

?>
