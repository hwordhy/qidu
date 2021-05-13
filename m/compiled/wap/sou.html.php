<?php
echo '
<link rel="stylesheet" href="themes/jieqi220/css/search.css">
<form method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php" class="search-form">
<section class="search">
  <section class="container">
    <div class="s_top">
      <h2>
        <input type="text" id="searchkey" value="" placeholder="请输入书名/作者名/关键词" class="SearchKey" name="searchkey" >
        <input type="submit" class="s_btn fr post_search">
      </h2>

    </div>
  </section>
</section>
</form>

     <section class="s_list">
      <section class="container">
       <h1>热搜作品 </h1>
       <ul class="return_hot">
          '.$this->_tpl_vars['jieqi_pageblocks']['bid1004']['content'].'
       
       </ul>
      </section>
     </section>
  ';
?>