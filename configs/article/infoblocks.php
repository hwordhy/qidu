<?php 
$jieqiBlocks['1'] = array (
  'bid' => 0,
  'blockname' => '捧场、礼物等动态记录',
  'module' => 'article',
  'filename' => 'block_actlog',
  'classname' => 'BlockArticleActlog',
  'side' => -1,
  'title' => '捧场、礼物等动态记录',
  'vars' => 'addtime,20,0,id',
  'template' => 'block_book_actlog.html',
  'contenttype' => 4,
  'custom' => 0,
  'publish' => 3,
  'hasvars' => 1,
  'showtype' => 0,
);
$jieqiBlocks['2'] = array (
    'bid' => 0,
    'blockname' => '捧场前三',
    'module' => 'article',
    'filename' => 'block_credit',
    'classname' => 'BlockArticleCredit',
    'side' => -1,
    'title' => '捧场前三',
    'vars' => 'payegold,3,0,id',
    'template' => 'block_book_credit.html',
    'contenttype' => 4,
    'custom' => 0,
    'publish' => 3,
    'hasvars' => 1,
    'showtype' => 0,
);
$jieqiBlocks['3'] = array("bid" => 0, "blockname" => "关于作者", "module" => "system", "filename" => "block_uinfo", "classname" => "BlockSystemUinfo", "side" => -1, "title" => "关于作者", "vars" => "\$authorid", "template" => "block_book_uinfo.html", "contenttype" => 4, "custom" => 0, "publish" => 3, "hasvars" => 1, 'showtype' => 0,);

$jieqiBlocks['4']=array('bid'=>0, 'blockname'=>'作者其他作品', 'module'=>'article', 'filename'=>'block_uarticles', 'classname'=>'BlockArticleUarticles', 'side'=>-1, 'title'=>'作者其他作品', 'vars'=>'lastupdate,10,0,$authorid', 'template'=>'block_book_aarticles.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);

$jieqiBlocks['5']=array('bid'=>0, 'blockname'=>'粉丝排行榜', 'module'=>'article', 'filename'=>'block_credit', 'classname'=>'BlockArticleCredit', 'side'=>-1, 'title'=>'粉丝排行榜', 'vars'=>'point,10,0,$articleid', 'template'=>'block_book_credit2.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);

$jieqiBlocks['6']=array('bid'=>0, 'blockname'=>'同类推荐', 'module'=>'article', 'filename'=>'block_articlelist', 'classname'=>'BlockArticleArticlelist', 'side'=>-1, 'title'=>'同类推荐', 'vars'=>'allvote,6,$sortid,0,0,0', 'template'=>'block_book_sort.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);
$jieqiBlocks['7'] = array (
    'bid' => 0,
    'blockname' => '目录列表',
    'module' => 'article',
    'filename' => 'block_achapters',
    'classname' => 'BlockArticleAchapters',
    'side' => -1,
    'title' => '目录列表',
    'vars' => 'chapterorder,0,1,id,1',
    'template' => 'block_book_achapters.html',
    'contenttype' => 4,
    'custom' => 0,
    'publish' => 3,
    'hasvars' => 1,
    'showtype' => 0,
);
?>
