<?php

class JieqiPage extends JieqiObject
{
	public $totalrows;
	public $pagerows;
	public $pagelinks;
	public $totalpages;
	public $linkurl;
	public $pagevar;
	public $useajax;
	public $ajax_parm = "{outid:'content', tipid:'pagestats', onLoading:'loading...', parameters:'ajax_gets=jieqi_contents'}";
	public $current;
	public $currenturl;
	public $previous;
	public $previousurl;
	public $next;
	public $nexturl;
	public $pagestyle = 1;
	public $pagecontents = "jieqi_page_contents";

	public function __construct($totalrows, $pagerows = 0, $current = 1, $pagelinks = 0, $pagevar = "page", $pageajax = 0)
	{
		if (defined("JIEQI_PAGE_STYLE")) {
			$this->pagestyle = JIEQI_PAGE_STYLE;
		}

		if (!is_array($totalrows)) {
			$this->totalrows = $totalrows;
			$this->pagerows = $pagerows;
			$this->current = $current;
			$this->pagelinks = $pagelinks;
			$this->pagevar = $pagevar;
			if ((0 < $pageajax) || (defined("JIEQI_AJAX_PAGE") && (0 < JIEQI_AJAX_PAGE))) {
				$this->useajax = 0;
			}
			else {
				$this->useajax = 0;
			}
		}
		else {
			if (isset($totalrows["style"])) {
				$this->pagestyle = $totalrows["style"];
			}

			if (isset($totalrows["contents"])) {
				$this->pagecontents = $totalrows["contents"];
			}

			$this->totalrows = (isset($totalrows["count"]) ? $totalrows["count"] : 1);
			$this->pagerows = (isset($totalrows["rows"]) ? $totalrows["rows"] : $pagerows);
			$this->current = (isset($totalrows["page"]) ? $totalrows["page"] : $current);
			$this->pagelinks = (isset($totalrows["links"]) ? $totalrows["links"] : $pagelinks);
			$this->pagevar = (isset($totalrows["var"]) ? $totalrows["var"] : $pagevar);
			if ((0 < $pageajax) || !empty($totalrows["ajax"]) || (defined("JIEQI_AJAX_PAGE") && (0 < JIEQI_AJAX_PAGE))) {
				$this->useajax = 0;
			}
			else {
				$this->useajax = 0;
			}
		}

		if (defined("JIEQI_PAGE_LINKS") && empty($this->pagelinks)) {
			$this->pagelinks = JIEQI_PAGE_LINKS;
		}

		if (defined("JIEQI_PAGE_ROWS") && empty($this->pagerows)) {
			$this->pagerows = JIEQI_PAGE_ROWS;
		}

		$this->totalpages = @ceil($this->totalrows / $this->pagerows);
		if (defined("JIEQI_MAX_PAGES") && (0 < JIEQI_MAX_PAGES) && (JIEQI_MAX_PAGES < $this->totalpages)) {
			$this->totalpages = intval(JIEQI_MAX_PAGES);
		}

		if ($this->totalpages <= 1) {
			$this->totalpages = 1;
		}

		$this->linkurl = jieqi_addurlvars(array($this->pagevar => ""), true, false);
		$this->currenturl = $this->pageurl($this->current);
		$this->previous = (1 < $this->current ? $this->current - 1 : 0);
		$this->previousurl = (0 < $this->previous ? $this->pageurl($this->previous) : "");
		$this->next = ($this->current < $this->totalpages ? $this->current + 1 : 0);
		$this->nexturl = (0 < $this->next ? $this->pageurl($this->next) : "");
	}

	public function setlink($link = "", $addget = true, $addpost = false)
	{
		if (!empty($link)) {
			$this->linkurl = $link;
		}
		else {
			$this->linkurl = jieqi_addurlvars(array($this->pagevar => ""), $addget, $addpost);
		}
	}

	public function pageurl($page)
	{
		if (strpos($this->linkurl, "<{\$" . $this->pagevar) === false) {
			$url = $this->linkurl . $page;
		}
		else {
			$url = str_replace(array("<{\$" . $this->pagevar . "|subdirectory}>", "<{\$" . $this->pagevar . "}>"), array(jieqi_getsubdir($page), $page), $this->linkurl);
		}

		if ($this->useajax == 1) {
			$url = "javascript:Ajax.Update('" . urldecode($url) . "'," . $this->ajax_parm . ");";
		}

		return $url;
	}

	public function pagelink($page, $char, $class = "")
	{
		$link_url = $this->pageurl($page);

        if (empty($class)) {
            return "<li><a href=\"" . $link_url . "\">" . $char . "</a></li>";

        }
        else {
            return "<li class=\"" . $class . "\"><a href=\"" . $link_url . "\">" . $char . "</a></li>";
        }
	}

	public function first_page($link = 1, $char = "")
	{
		if ($char == "") {
			$char = "??????";
		}

		if ($link == 1) {
			return $this->pagelink(1, $char, "");
		}
		else {
			return 1;
		}
	}

	public function total_page($link = 1, $char = "")
	{
		if ($char == "") {
			$char = '??????';
		}

		if ($link == 1) {
			return $this->pagelink($this->totalpages, $char, "");
		}
		else {
			return $this->totalpages;
		}
	}

	public function pre_page($char = "")
	{
		if ($char == "") {
			$char = "?????????";
		}

		if (1 < $this->current) {
			return $this->pagelink($this->current - 1, $char, "");
		}
		else {
			return "";
		}
	}

	public function next_page($char = "")
	{
		if ($char == "") {
			$char = "?????????";
		}

		if ($this->current < $this->totalpages) {
			return $this->pagelink($this->current + 1, $char, "");
		}
		else {
			return "";
		}
	}

	public function num_bar()
	{
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$last = $pagelinks - 1;
		$current = &$this->current;
		$totalpage = &$this->totalpages;
		$linkurl = &$this->linkurl;
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$maxpage = $minpage + $last;

		if ($totalpage < $maxpage) {
			$maxpage = &$totalpage;
			$minpage = $maxpage - $last;
			$minpage = ($minpage < 1 ? 1 : $minpage);
		}

		$linkbar = "";

		for ($i = $minpage; $i <= $maxpage; $i++) {
			$char = $i;

			if ($i == $current) {
                $linkchar = $this->pagelink($i, $char, "on");
			}
			else {
				$linkchar = $this->pagelink($i, $char);
			}

			$linkbar .= $linkchar;
		}

		return $linkbar;
	}

	public function pre_group($char = "")
	{
		$current = &$this->current;
		$linkurl = &$this->linkurl;
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$char = ($char == "" ? "&lt;&lt;" : $char);
		$pgpage = ($pagelinks < $minpage ? $minpage - $mid : 1);
		return $this->pagelink($pgpage, $char, "pgroup");
	}

	public function next_group($char = "")
	{
		$current = &$this->current;
		$linkurl = &$this->linkurl;
		$totalpage = &$this->totalpages;
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$last = $pagelinks;
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$maxpage = $minpage + $last;

		if ($totalpage < $maxpage) {
			$maxpage = &$totalpage;
			$minpage = $maxpage - $last;
			$minpage = ($minpage < 1 ? 1 : $minpage);
		}

		$char = ($char == "" ? "&gt;&gt;" : $char);
		$ngpage = (($maxpage + $last) < $totalpage ? $maxpage + $mid : $totalpage);
		return $this->pagelink($ngpage, $char, "ngroup");
	}

	public function jump_js()
	{
		if ($this->useajax == 1) {
			$linkurl = urldecode($this->linkurl);
		}
		else {
			$linkurl = $this->linkurl;
		}

		$pos = strpos($linkurl, "<{\$" . $this->pagevar);

		if ($pos === false) {
			$urlcode = "'" . $linkurl . "'+this.parentNode.getElementsByTagName('input')[0].value";
		}
		else {
			$urlcode = "'" . $linkurl . "'.replace('<{\$" . $this->pagevar . "|subdirectory}>', '/' + Math.floor(this.parentNode.getElementsByTagName('input')[0].value / 1000)).replace('<{\$" . $this->pagevar . "}>', this.parentNode.getElementsByTagName('input')[0].value)";
		}

		if ($this->useajax == 1) {
			$js = "Ajax.Update(" . $urlcode . "," . $this->ajax_parm . ");";
		}
		else {
			$js = "window.location.href=" . $urlcode . ";";
		}

		return $js;
	}

	public function more_js()
	{
		if ($this->current < $this->totalpages) {
			$page = $this->current + 1;

			if (strpos($this->linkurl, "<{\$" . $this->pagevar) === false) {
				$url = $this->linkurl . $page;
			}
			else {
				$url = str_replace(array("<{\$" . $this->pagevar . "|subdirectory}>", "<{\$" . $this->pagevar . "}>"), array(jieqi_getsubdir($page), $page), $this->linkurl);
			}

			$js = "Ajax.Request('" . urldecode($url) . "',{onLoading:function(){},onComplete:function(){var c = document.getElementById('" . $this->pagecontents . "') ? document.getElementById('" . $this->pagecontents . "').innerHTML : null; document.getElementsByTagName('body')[0].innerHTML = this.response.match(/<body[^>]*>([\s\S]*)<\/body>/i)[1]; if(typeof c == 'string') document.getElementById('" . $this->pagecontents . "').innerHTML = c + document.getElementById('" . $this->pagecontents . "').innerHTML;}});";
		}
		else {
			$js = "this.parentNode.innerHTML = '';";
		}

		return $js;
	}

	public function whole_bar()
	{
		global $jieqiTpl;

		switch ($this->pagestyle) {
		case 3:
			if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
                $html_template = array("totalCount"=>$this->totalrows, "pageSize"=>$this->pagerows, "pageCount"=>$this->totalpages, "currentPage"=>$this->current, "haveNextPage"=>true, "havePrePage"=>false, "beginNavigatorIndex"=>1, "endNavigatorIndex"=>6, "startPage"=>1, "endPage"=>10, "showLength"=>10, "next"=>$this->next, "attributes"=>array(), "last"=>1);
            }
            else {
                $html_template = "<div><a class=\"pagemore\" href=\"javascript:;\" onclick=\"" . $this->more_js() . "\">" . LANG_PAGE_MORE . "</a></div>";
            }
			break;

		case 2:
			if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
                $html_template = array("totalCount"=>$this->totalrows, "pageSize"=>$this->pagerows, "pageCount"=>$this->totalpages, "currentPage"=>$this->current, "haveNextPage"=>true, "havePrePage"=>false, "beginNavigatorIndex"=>1, "endNavigatorIndex"=>6, "startPage"=>1, "endPage"=>10, "showLength"=>10, "next"=>$this->next, "attributes"=>array(), "last"=>1);
            }
			elseif(JIEQI_COVER_DIR == '') {
                $html_template = "<ul><li><a>{?\$jieqi_page_current?}/{?\$jieqi_page_totalpages?}</a></li><li><a href=\"{?\$jieqi_page_previousurl?}\">{?\$jieqi_page_previouslang?}</a></li><li><a href=\"{?\$jieqi_page_nexturl?}\">{?\$jieqi_page_nextlang?}</a></li></ul><div class=\"pageform\" id=\"pageForm\"><span>??????</span><input type=\"text\" name=\"" . $this->pagevar . "\" id=\"pageNum\" class=\"pageNum\" value=\"1\" onkeydown=\"if(event.keyCode==13){{?\$jieqi_page_jumpjs?} return false;}\"><span>???</span><span class=\"gobtn\" id=\"gobtn\" onclick=\"{?\$jieqi_page_jumpjs?}\">go</span></div>";
            }
            else{
                $html_template = "<div class=\"pagelink\" id=\"pagelink\"><a href=\"{?\$jieqi_page_previousurl?}\" class=\"prev\">{?\$jieqi_page_previouslang?}</a><em id=\"pagestats\"><kbd><input name=\"" . $this->pagevar . "\" type=\"text\" size=\"3\" value=\"{?\$jieqi_page_current?}\" onkeydown=\"if(event.keyCode==13){{?\$jieqi_page_jumpjs?} return false;}\" onfocus=\"if(this.value==this.getAttribute('dftval'))this.value='';\" onblur=\"if(this.value=='')this.value=this.getAttribute('dftval');\" dftval=\"{?\$jieqi_page_current?}\" /></kbd>/{?\$jieqi_page_totalpages?}<a href=\"javascript:;\" onclick=\"{?\$jieqi_page_jumpjs?}\">{?\$jieqi_page_submitlang?}</a></em><a href=\"{?\$jieqi_page_nexturl?}\" class=\"next\">{?\$jieqi_page_nextlang?}</a></div>";
			}
			break;

		case 1:
		default:
			if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
                $html_template = array("totalCount"=>$this->totalrows, "pageSize"=>$this->pagerows, "pageCount"=>$this->totalpages, "currentPage"=>$this->current, "haveNextPage"=>true, "havePrePage"=>false, "beginNavigatorIndex"=>1, "endNavigatorIndex"=>6, "startPage"=>1, "endPage"=>10, "showLength"=>10, "next"=>$this->next, "attributes"=>array(), "last"=>1);
            }
            elseif(JIEQI_COVER_DIR == '') {
                $html_template = "<ul>{?\$jieqi_page_firsthtm?}{?\$jieqi_page_previoushtm?}{?\$jieqi_page_numshtm?}{?\$jieqi_page_nexthtm?}{?\$jieqi_page_lasthtm?}</ul><div class=\"pageform\" id=\"pageForm\"><span>??????</span><input type=\"text\" name=\"" . $this->pagevar . "\" id=\"pageNum\" class=\"pageNum\" value=\"1\" onkeydown=\"if(event.keyCode==13){{?\$jieqi_page_jumpjs?} return false;}\"><span>???</span><span class=\"gobtn\" id=\"gobtn\" onclick=\"{?\$jieqi_page_jumpjs?}\">go</span></div>";
            }
            else{
                $html_template = "<div class=\"pagelink\" id=\"pagelink\"><em id=\"pagestats\">{?\$jieqi_page_current?}/{?\$jieqi_page_totalrows?}</em>{?\$jieqi_page_firsthtm?}{?\$jieqi_page_gprevioushtm?}{?\$jieqi_page_previoushtm?}{?\$jieqi_page_numshtm?}{?\$jieqi_page_nexthtm?}{?\$jieqi_page_gnexthtm?}{?\$jieqi_page_lasthtm?}<kbd><input name=\"" . $this->pagevar . "\" type=\"text\" size=\"3\" onkeydown=\"if(event.keyCode==13){{?\$jieqi_page_jumpjs?} return false;}\" title=\"{?\$jieqi_page_titlelang?}\" /></kbd></div>";
			}
			break;
		}

		$rep_from = array();
		$rep_to = array();
		$rep_from[] = "jieqi_page_totalrows";
		$rep_to[] = $this->totalrows;
		$rep_from[] = "jieqi_page_pagerows";
		$rep_to[] = $this->pagerows;
		$rep_from[] = "jieqi_page_totalpages";
		$rep_to[] = $this->totalpages;
		$rep_from[] = "jieqi_page_pagelinks";
		$rep_to[] = $this->pagelinks;
		$rep_from[] = "jieqi_page_pagevar";
		$rep_to[] = $this->pagevar;
		$rep_from[] = "jieqi_page_useajax";
		$rep_to[] = $this->useajax;
		$rep_from[] = "jieqi_page_linkurl";
		$rep_to[] = $this->linkurl;
		$rep_from[] = "jieqi_page_current";
		$rep_to[] = $this->current;
		$rep_from[] = "jieqi_page_currenturl";
		$rep_to[] = $this->currenturl;
		$rep_from[] = "jieqi_page_previous";
		$rep_to[] = $this->previous;
		$rep_from[] = "jieqi_page_previousurl";
		$rep_to[] = $this->previousurl;
		$rep_from[] = "jieqi_page_next";
		$rep_to[] = $this->next;
		$rep_from[] = "jieqi_page_nexturl";
		$rep_to[] = $this->nexturl;
		$rep_from[] = "jieqi_page_firsthtm";
		$rep_to[] = $this->first_page(1, "");
		$rep_from[] = "jieqi_page_lasthtm";
		$rep_to[] = $this->total_page(1, "");
		$rep_from[] = "jieqi_page_gprevioushtm";
		$rep_to[] = $this->pre_group();
		$rep_from[] = "jieqi_page_gnexthtm";
		$rep_to[] = $this->next_group();
		$rep_from[] = "jieqi_page_previoushtm";
		$rep_to[] = $this->pre_page();
		$rep_from[] = "jieqi_page_nexthtm";
		$rep_to[] = $this->next_page();
		$rep_from[] = "jieqi_page_numshtm";
		$rep_to[] = $this->num_bar();
		$rep_from[] = "jieqi_page_jumpjs";
		$rep_to[] = $this->jump_js();
		$rep_from[] = "jieqi_page_previouslang";
		$rep_to[] = LANG_PAGE_PREVIOUS;
		$rep_from[] = "jieqi_page_nextlang";
		$rep_to[] = LANG_PAGE_NEXT;
		$rep_from[] = "jieqi_page_submitlang";
		$rep_to[] = LANG_PAGE_SUBMIT;
		$rep_from[] = "jieqi_page_titlelang";
		$rep_to[] = LANG_PAGE_TITLE;
		if (isset($jieqiTpl) && is_a($jieqiTpl, "JieqiTpl")) {
			foreach ($rep_from as $k => $v ) {
				$jieqiTpl->assign($rep_from[$k], $rep_to[$k]);
				$rep_from[$k] = "{?\$" . $rep_from[$k] . "?}";
			}
		}

		return str_replace($rep_from, $rep_to, $html_template);
	}
}


?>

