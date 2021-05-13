<?php
if (empty($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = array();
elseif (!is_array($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = (array)$this->_tpl_vars['bookcaserows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['bookcaserows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['bookcaserows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['bookcaserows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <li>
    <a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank" alt="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'" title="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'"><img src="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_image'].'" /></a>
    <p>
      <a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank"><span class="bookName">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'</span></a>
      <span class="bookStatus">
                                            <b class="authorSt">
                                                <em>

                                                            '.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['fullflag'].'

                                                    |

                                                            '.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['isvip'].'
                                                        </em>
                                                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank"><em class="none">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['author'].'</em></a>
                                            </b>
                                            <b class="authorSt chapterSt">
                                                <a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank"><em class="ct">最新章节：'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</em></a>
                                                <em class="time">'.date('Y-m-d H:i:s',$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastupdate']).'更新</em>
                                            </b>
                                        </span>
      <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleread.php?id='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank"><i class="goon">免费试读</i></a>
    </p>

  </li>
';
}

?>