<?php

class BlockArticleAarticles extends JieqiBlock
{
	public $module = "article";
	public $template = "block_aarticles.html";
	public $exevars = array("order" => "lastupdate", "listnum" => 10, "asc" => 0, "author" => "\$author", "isfull" => 0);

	public function __construct(&$vars)
	{
		parent::__construct($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (in_array($varary[0], array("articleid", "postdate", "lastupdate", "allvisit", "monthvisit", "weekvisit", "dayvisit", "allvote", "monthvote", "weekvote", "dayvote", "size", "goodnum", "reviewsnum"))) {
					$this->exevars["order"] = $varary[0];
				}
			}

			if (1 < $arynum) {
				$varary[1] = trim($varary[1]);
				if (is_numeric($varary[1]) && (0 < $varary[1])) {
					$this->exevars["listnum"] = intval($varary[1]);
				}
			}

			if (2 < $arynum) {
				$varary[2] = trim($varary[2]);

				if (in_array($varary[2], array("0", "1"))) {
					$this->exevars["asc"] = $varary[2];
				}
			}

			if (3 < $arynum) {
				$varary[3] = trim($varary[3]);

				if (0 < strlen($varary[3])) {
					$this->exevars["author"] = $varary[3];
				}
			}

			if (4 < $arynum) {
				$varary[4] = trim($varary[4]);

				if (in_array($varary[4], array("0", "1", "2"))) {
					$this->exevars["isfull"] = $varary[4];
				}
			}
		}

		$this->getCacheid();
	}

	public function setContent($isreturn = false)
	{
		global $jieqiTpl;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiModules;

		jieqi_getconfigs("article", "configs");
		jieqi_getconfigs("article", "sort");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
		$articlerows = array();

		if ($this->blockvars["cacheid"] !== 0) {
			include_once jieqi_path_inc("class/article.php", "article");
			include_once jieqi_path_inc("include/funarticle.php", "article");
			$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
			$criteria = new CriteriaCompo();

			if (substr($this->exevars["author"], 0, 1) == "\$") {
				$author = str_replace(array("&amp;", "&quot;", "&#039;", "&lt;", "&gt;", "&nbsp;"), array("&", "\"", "'", "<", ">", " "), $jieqiTpl->get_assign(substr($this->exevars["author"], 1)));
			}
			else {
				$author = $_REQUEST[$this->exevars["author"]];
			}

			$criteria->add(new Criteria("author", $author));

			if ($this->exevars["isfull"] == 1) {
				$criteria->add(new Criteria("isfull", 1));
			}
			else if ($this->exevars["isfull"] == 2) {
				$criteria->add(new Criteria("isfull", 0));
			}

			$criteria->setSort($this->exevars["order"]);

			if ($this->exevars["asc"] == 1) {
				$criteria->setOrder("ASC");
			}
			else {
				$criteria->setOrder("DESC");
			}

			$criteria->setLimit($this->exevars["listnum"]);
			$criteria->setStart(0);
			$article_handler->queryObjects($criteria);
			$k = 0;

			while ($v = $article_handler->getObject()) {
				$articlerows[$k] = jieqi_article_vars($v);
				$articlerows[$k]["order"] = $k + 1;

				if (!isset($articlerows[$k]["ordervalue"])) {
					$articlerows[$k]["ordervalue"] = $v->getVar($this->exevars["order"]);
				}

				if ($articlerows[$k]["ordervalue"] === false) {
					$articlerows[$k]["ordervalue"] = "";
				}

				if (is_numeric($articlerows[$k]["ordervalue"])) {
					$articlerows[$k]["ordervalue"] = round($articlerows[$k]["ordervalue"]);
				}

				if ($this->exevars["order"] == "size") {
					$articlerows[$k]["ordervalue"] = jieqi_sizeformat($articlerows[$k]["ordervalue"], "c");
				}
				else {
					if (($this->exevars["order"] == "lastupdate") || ($this->exevars["order"] == "postdate") || ($this->exevars["order"] == "toptime") || ($this->exevars["order"] == "lastvote")) {
						$articlerows[$k]["ordervalue"] = date("m-d", $articlerows[$k]["ordervalue"]);
					}
				}

				$articlerows[$k]["visitnum"] = $articlerows[$k]["ordervalue"];
				$k++;
			}
		}

		$jieqiTpl->assign_by_ref("articlerows", $articlerows);
		$jieqiTpl->assign("ownerid", $this->blockvars["cacheid"]);
		$jieqiTpl->assign("author", jieqi_htmlstr($author));

		if (0 < strlen($author)) {
			$jieqiTpl->assign("url_more", $jieqiModules["article"]["url"] . "/authorarticle.php?author=" . urlencode($author));
		}
		else {
			$jieqiTpl->assign("url_more", jieqi_geturl("article", "articlefilter", 1, array()));
		}
	}

	public function getCacheid()
	{
		global $jieqiTpl;
		$this->blockvars["cacheid"] = 0;

		if (0 < strlen($this->exevars["author"])) {
			if (substr($this->exevars["author"], 0, 1) == "\$") {
				$this->blockvars["cacheid"] = md5(str_replace(array("&amp;", "&quot;", "&#039;", "&lt;", "&gt;", "&nbsp;"), array("&", "\"", "'", "<", ">", " "), $jieqiTpl->get_assign(substr($this->exevars["author"], 1))));
			}
			else {
				$this->blockvars["cacheid"] = md5($_REQUEST[$this->exevars["author"]]);
			}
		}

		return $this->blockvars["cacheid"];
	}
}


?>

