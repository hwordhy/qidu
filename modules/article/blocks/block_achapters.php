<?php

class BlockArticleAchapters extends JieqiBlock
{
	public $module = "article";
	public $template = "block_achapters.html";
	public $cachetime = -1;
	public $exevars = array("field" => "chapterorder", "listnum" => 10, "asc" => 0, "articleid" => "id", "chaptertype" => 0);

	public function __construct(&$vars)
	{
		global $jieqiTpl;
		parent::__construct($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = jieqi_count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (in_array($varary[0], array("chapterorder"))) {
					$this->exevars["field"] = $varary[0];
				}
			}

			if (1 < $arynum) {
				$varary[1] = trim($varary[1]);

				if (is_numeric($varary[1])) {
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

			if (4 < $arynum) {
				$varary[4] = trim($varary[4]);

				if (in_array($varary[4], array("0", "1", "2"))) {
					$this->exevars["chaptertype"] = $varary[4];
				}
			}
		}
	}

	public function setContent($isreturn = false)
	{
		global $jieqiTpl;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiModules;

		if (!isset($jieqiConfigs["article"])) {
			jieqi_getconfigs("article", "configs", "jieqiConfigs");
		}

		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
		$chapterrows = array();
		$url_more = "";
		$articlecode = "";

		if (0 < $this->exevars["articleid"]) {
			include_once jieqi_path_inc("include/funchapter.php", "article");
			include_once jieqi_path_inc("class/package.php", "article");
			$package = new JieqiPackage($this->exevars["articleid"]);

			if ($package->loadOPF()) {
				$articlecode = $package->metas["articlecode"];
				$k = 0;
				$chaptercount = jieqi_count($package->chapters);

				if ($this->exevars["asc"] == 0) {
					$start = $chaptercount - 1;

					while (0 <= $start) {
						if (($this->exevars["chaptertype"] == 0) || (($this->exevars["chaptertype"] == 1) && ($package->chapters[$start]["chaptertype"] == 0)) || (($this->exevars["chaptertype"] == 2) && ($package->chapters[$start]["chaptertype"] == 1))) {
							$chapterrows[$k] = jieqi_article_chaptervars($package->chapters[$start]);
							$k++;
							if ((0 < $this->exevars["listnum"]) && ($this->exevars["listnum"] <= $k)) {
								break;
							}
						}

						$start--;
					}
				}
				else {
					$start = 0;

					while ($start < $chaptercount) {
						if (($this->exevars["chaptertype"] == 0) || (($this->exevars["chaptertype"] == 1) && ($package->chapters[$start]["chaptertype"] == 0)) || (($this->exevars["chaptertype"] == 2) && ($package->chapters[$start]["chaptertype"] == 1))) {
							$chapterrows[$k] = jieqi_article_chaptervars($package->chapters[$start]);
							$k++;
							if ((0 < $this->exevars["listnum"]) && ($this->exevars["listnum"] <= $k)) {
								break;
							}
						}

						$start++;
					}
				}
			}
			else {
				include_once jieqi_path_inc("class/chapter.php", "article");
				$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria("articleid", $this->exevars["articleid"]));

				if ($this->exevars["chaptertype"] == 1) {
					$criteria->add(new Criteria("chaptertype", 0));
				}
				else if ($this->exevars["chaptertype"] == 2) {
					$criteria->add(new Criteria("chaptertype", 1));
				}

				$criteria->setSort($this->exevars["field"]);

				if ($this->exevars["asc"] == 0) {
					$criteria->setOrder("DESC");
				}
				else {
					$criteria->setOrder("ASC");
				}

				if (0 < $this->exevars["listnum"]) {
					$criteria->setLimit($this->exevars["listnum"]);
				}

				$chapter_handler->queryObjects($criteria);
				$k = 0;

				while ($v = $chapter_handler->getObject()) {
					$chapterrows[$k] = jieqi_article_chaptervars($v);
					$k++;
				}
			}

			$order = (empty($this->exevars["asc"]) ? "desc" : "asc");
			$url_more = jieqi_geturl("article", "article", $this->exevars["articleid"], "index", $articlecode, 1, $order);
		}

		$jieqiTpl->assign_by_ref("chapterrows", $chapterrows);
		$jieqiTpl->assign("url_more", $url_more);
	}
}


?>
