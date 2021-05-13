<?php
echo '
<link rel="stylesheet" type="text/css" href="/wap/css/yue.css" media="all"/>
<link rel="stylesheet" href="/themes/jieqi220/css/shuku.css">
<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/book.css" />

<div class="cont" style="width: 96%;margin: 0 auto;">
<div class="js-month-list">    
<div class="within-book">     
<h3 class="column">热书强推</h3>     
          		<div class="bd">
				<section class="book_stack">
						<section class="container" style="width: 96%;">
								<ul class="list">
'.$this->_tpl_vars['jieqi_pageblocks']['bid1001']['content'].'    
								</ul>
	
						 <!--列表 end-->
						</section>
					   </section>
		</div>
  

</div>   

<div class="within-book">     
<h3 class="column">女生最爱</h3>     
          		<div class="bd">
				<section class="book_stack">
						<section class="container" style="width: 96%;">
								<ul class="list">
'.$this->_tpl_vars['jieqi_pageblocks']['bid1002']['content'].'    
								</ul>
	
						 <!--列表 end-->
						</section>
					   </section>
		</div>
</div>  

<div class="within-book">     
<h3 class="column">女生精品</h3>     
          		<div class="bd">
				<section class="book_stack">
						<section class="container" style="width: 96%;">
								<ul class="list">
'.$this->_tpl_vars['jieqi_pageblocks']['bid1003']['content'].'    
								</ul>
	
						 <!--列表 end-->
						</section>
					   </section>
		</div>
</div>  

</div>

</div>';
?>