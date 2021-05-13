<?php

class BlockArticleAreviews extends JieqiBlock
{
	public $module = "article";
	public $template = "block_areviews.html";
	public $exevars = array("listnum" => 10, "istop" => 0, "isgood" => 0, "articleid" => 0);

	public function __construct(&$vars)
	{
		parent::__construct($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = jieqi_count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (is_numeric($varary[0])) {
					$this->exevars["listnum"] = intval($varary[0]);
				}
			}

			if (1 < $arynum) {
				$varary[1] = trim($varary[1]);

				if (in_array($varary[1], array("0", "1", "2"))) {
					$this->exevars["istop"] = $varary[1];
				}
			}

			if (2 < $arynum) {
				$varary[2] = trim($varary[2]);

				if (in_array($varary[2], array("0", "1", "2"))) {
					$this->exevars["isgood"] = $varary[2];
				}
			}

			if (3 < $arynum) {
				$varary[3] = trim($varary[3]);

				if (is_numeric($varary[3])) {
					$this->exevars["articleid"] = intval($varary[3]);
				}
				else if (substr($varary[3], 0, 1) == "\$") {
					$tmpvar1 = $jieqiTpl->get_assign(substr($varary[3], 1));
					$this->exevars["articleid"] = intval($tmpvar1);
				}
				else {
					if (isset($_REQUEST[$varary[3]]) && is_numeric($_REQUEST[$varary[3]])) {
						$this->exevars["articleid"] = intval($_REQUEST[$varary[3]]);
					}
				}
			}
		}

		if ($this->exevars["articleid"] == 0) {
			$this->blockvars["cacheid"] = md5(serialize($this->exevars) . "|" . $this->blockvars["template"]);
		}
		else {
			$this->cachetime = -1;
			$this->blockvars["cachetime"] = -1;
		}
	}

	public function setContent($isreturn = false)
	{
		global $jieqiTpl;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiOption;

		if (!isset($jieqiConfigs["article"])) {
			jieqi_getconfigs("article", "configs");
		}

		if (!isset($jieqiSort["article"])) {
			jieqi_getconfigs("article", "sort");
		}

		if (!isset($jieqiOption["article"])) {
			jieqi_getconfigs("article", "option", "jieqiOption");
		}

		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
		include_once jieqi_path_inc("include/funpost.php", "system");
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria("t.display", "0"));

		if (0 < $this->exevars["articleid"]) {
			$criteria->add(new Criteria("t.ownerid", intval($this->exevars["articleid"])));
		}

		if ($this->exevars["istop"] == 1) {
			$criteria->add(new Criteria("t.istop", "1"));
		}
		else if ($this->exevars["istop"] == 2) {
			$criteria->add(new Criteria("t.istop", "0"));
		}

		if ($this->exevars["isgood"] == 1) {
			$criteria->add(new Criteria("t.isgood", "1"));
		}
		else if ($this->exevars["isgood"] == 2) {
			$criteria->add(new Criteria("t.isgood", "0"));
		}

		$criteria->add(new Criteria("p.istopic", 1));
		$criteria->setTables(jieqi_dbprefix("article_reviews") . " t LEFT JOIN " . jieqi_dbprefix("article_replies") . " p ON t.topicid=p.topicid");
		$criteria->setSort("t.istop DESC, t.replytime");
		$criteria->setOrder("DESC");
		$criteria->setLimit($this->exevars["listnum"]);
		$criteria->setStart(0);
		$query->queryObjects($criteria);
		$reviewrows = array();
		$k = 0;

		while ($v = $query->getObject()) {
			$reviewrows[$k] = jieqi_topic_vars($v);
			$k++;
		}

		$jieqiTpl->assign_by_ref("reviewrows", $reviewrows);
		$jieqiTpl->assign_by_ref("reviewaid", $this->exevars["articleid"]);

		if (0 < $this->exevars["articleid"]) {
			$jieqiTpl->assign("url_more", $article_dynamic_url . "/reviews.php?aid=" . $this->exevars["articleid"]);
		}
		else {
			$jieqiTpl->assign("url_more", $article_dynamic_url . "/reviewslist.php");
		}
	}
}


?>
