<?php
echo '<div class="chapter-page"
	 data-chapterid="'.$this->_tpl_vars['chapterid'].'"
	 data-nextisvip="'.$this->_tpl_vars['next_isvip'].'"
	 data-isvip="'.$this->_tpl_vars['chapterisvip'].'"
	 data-nextchapter="'.$this->_tpl_vars['next_chapterid'].'"
	 data-prechapterid="'.$this->_tpl_vars['previous_chapterid'].'">

	<h3 class="bookname">'.$this->_tpl_vars['articlename'].'</h3>
	<h4 class="chaptername">'.$this->_tpl_vars['jieqi_title'].'</h4>

	<p class="author">
		<span>作者：<a href="javascript:;">'.$this->_tpl_vars['author'].'</a></span>
		<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;字数：'.$this->_tpl_vars['chaptersize_c'].'</span>
	</p>
	<p class="publishtime">发布时间： '.date('Y-m-d H:i',$this->_tpl_vars['chaptertime']).'</p>
	<div class="page-content">
		<p style="font-size:19px; line-height:50px;" class="note">'.$this->_tpl_vars['jieqi_content'].'</p
	</div>
	<ul class="chapter-behavior">
		<li class="behavior-comment"><span></span>评论</li>
		<li class="behavior-donate"><span></span>打赏</li>
	</ul>
</div>
 ';
?>