<?php
echo '
<link rel="stylesheet" type="text/css" href="/wap/css/yue.css" media="all"/>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<div class="cont">

<div class="within-book">    <h3 class="column">包月说明</h3>    <p class="explain">订购包月，有效期内可阅读全部包月书籍。</p>   </div>
<div class="js-month-list">    
<div class="within-book">     
<h3 class="column">包月热书</h3>     
<ul class="column-ul">            
 '.$this->_tpl_vars['jieqi_pageblocks']['bid113']['content'].'
</ul>    
</div>   

<div class="within-book">     
<h3 class="column">包月精品</h3>     
<ul class="column-ul">            
'.$this->_tpl_vars['jieqi_pageblocks']['623']['content'].'        
</ul>    
</div>  

<div class="within-book">     
<h3 class="column">包月畅销</h3>     
<ul class="column-ul">            
'.$this->_tpl_vars['jieqi_pageblocks']['624']['content'].'          
</ul>    
</div>  

</div>

</div>';
?>