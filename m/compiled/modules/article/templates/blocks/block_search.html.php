<?php
echo '<form name="articlesearch" method="post" action="'.$this->_tpl_vars['url_articlesearch'].'" target="_blank">
<ul class="ulrow">
<li><input name="searchkey" type="text" class="text" id="searchkey" size="12" maxlength="50"> <input type="submit" name="Submit" class="button" value="????"></li>
<li><input type="radio" class="radio" name="searchtype" value="articlename" checked="checked" />???? &nbsp;&nbsp; <input type="radio" class="radio" name="searchtype" value="author" />????</li>
</ul>
</form>';
?>