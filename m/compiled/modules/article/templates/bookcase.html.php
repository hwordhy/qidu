<?php
echo '
<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/mybook.css" />
<style>
    
/*5元*/
.reading{
    position: relative;
} 
.fivermb{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,.6);
    z-index: 10000;
    width: 100%;  
    display: none;
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}
.fivermb .rmbcont{
    background: #fff;
    width: 90%;
    margin: 5% auto;  
    -webkit-border-radius: 5px;
    border-radius: 5px;
    overflow: hidden;
    max-width: 750px; 
}
.fivermb p{ 
    color: #663c3c;
    font-size: 1.6rem;
    line-height: 2.8rem;
    margin: 30px;
    text-align: -webkit-justify;
    text-align: justify;
}
.fivermb h2{ 
    color: #fff; 
    background: -webkit-linear-gradient(30deg,#fd4145,#ff7234);
    background: linear-gradient(30deg,#fd4145,#ff7234);
    padding: 15px 0;
    text-align: center;
    font-size: 2rem;
    margin: 0 30px 30px;
    -webkit-border-radius: 50px;
    border-radius: 50px;
}
.fivermb h1{
    background: url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_rmb.png) no-repeat center top;
    background-size:100%;
    height: 200px; 
    overflow: hidden;
    position: relative;
   -webkit-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}
@media(max-width:750px){
    .fivermb .rmbcont{ 
    margin: 30% auto;   
}
    .fivermb h1{ 
    height: 8.8rem;  
}
}
.fivermb .fivecose{
    background: url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_cose.png) no-repeat center;
    background-size:100%;
    width: 1.5rem;
    height: 1.5rem;
    position: absolute;
    top: 1rem;
    right: 1rem;
}
    .new_newman{
        background:url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_newman.png) no-repeat right center;
        background-size:contain;
        position:fixed;
        bottom:2rem;
        left:0;
        right:10px;
        width:100%;
        max-width:750px;
        height:5.06rem;
        z-index:1000;
        margin:0 auto;
    }
    </style>
<script type="text/javascript">
function check_confirm(){
	var checkform = document.getElementById(\'checkform\');
	var checknum = 0;
	for (var i=0; i < checkform.elements.length; i++){
	 if (checkform.elements[i].name == \'checkid[]\' && checkform.elements[i].checked == true) checknum++;
	}
	if(checknum == 0){
		alert(\'请先选择要操作的书目！\');
		return false;
	}
	var newclassid = document.getElementById(\'newclassid\');
	if(newclassid.value == -1){
		if(confirm(\'确实要将选中书目移出书架么？\')) return true;
		else return false;
	}else{
		return true;
	}
}
//删除
function act_delete(url){
	var o = getTarget();
	var param = {
		method: \'POST\',
		onReturn: function(){
			$_(o.parentNode.parentNode).remove();
		}
	}
	if(confirm(\'确实要将本书移出书架么？\')) Ajax.Tip(url, param);
	return false;
}
</script>

            <section class="mybook">
            <div class="container" style="width: 96%;">
            <div class="bookcats">
                <a  class="active">我的收藏</a>
                <a href="/ssss.php">最近阅读历史</a>
            </div>
            <p class="here">
                <a href="/"  title="" style="text-align:center;display:block;font-size:1.2rem;color:#f60">签到领积分，赢取1000金币！ </a>  
                <b  class="dels fr bd3" style="position:relative;top:-2rem">管理</b>
                </p>
                 <ul class="my_list">
                        ';
if (empty($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = array();
elseif (!is_array($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = (array)$this->_tpl_vars['bookcaserows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['bookcaserows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['bookcaserows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['bookcaserows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    <li style="width:100%;text-align:left;">
                                <h3><a  href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></h3>
                                <p class="wordhide"><a>最近更新：';
if($this->_tpl_vars['lastvolume'] != ''){
echo ' ';
}
echo $this->_tpl_vars['lastchapter'].'
								'.date('m-d H:i',$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</a></p>
                                <p><a style="color:#21a7ee" href="javascript:;" onclick="act_delete(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php?bid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['caseid'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\');" class="btn-gray">移除书架</a></p>
                    </li>    ';
}
echo '           
                 </ul>
            </div>
            </section>
        <!--我的书架 end-->    
    ';
?>