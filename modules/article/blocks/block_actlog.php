<?php

class BlockArticleActlog extends JieqiBlock
{
	public $module = "article";
	public $template = "block_actlog.html";
	public $exevars = array("field" => "actlogid", "listnum" => 10, "asc" => 0, "articleid" => "0", "actname" => "");

	public function __construct(&$vars)
	{
		global $jieqiTpl;
		parent::__construct($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = jieqi_count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (in_array($varary[0], array("actlogid", "articleid", "uid", "uptime"))) {
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

				if (0 < strlen($varary[4])) {
					$this->exevars["actname"] = $varary[4];
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
		global $jieqiModules;
		global $jieqiConfigs;
		global $query;
		global $jieqiAction;

        if (!is_a($query, "JieqiQueryHandler")) {
            jieqi_includedb();
            $query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
        }

        if (!isset($jieqiConfigs["article"])) {
            @jieqi_getconfigs("article", "configs", "jieqiConfigs");
        }

        if (!isset($jieqiActlog["article"])) {
            @jieqi_getconfigs("article", "actlog", "jieqiActlog");
        }

        if (!isset($jieqiAction["article"])) {
            @jieqi_getconfigs("article", "action", "jieqiAction");
        }

		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
		$actlogrows = array();
		$slimit = "1";
		if (is_numeric($this->exevars["articleid"]) && (0 < $this->exevars["articleid"])) {
			$slimit .= " AND articleid = " . intval($this->exevars["articleid"]);
		}

		if (0 < strlen($this->exevars["actname"])) {
			$slimit .= " AND actname = '" . jieqi_dbslashes($this->exevars["actname"]) . "'";
		}

		$sort = $this->exevars["field"];

		if ($this->exevars["asc"] == 0) {
			$order = "DESC";
		}
		else {
			$order = "ASC";
		}

		$limitstart = 0;
		$listpnum = intval($this->exevars["listnum"]);
		$sql = "SELECT * FROM " . jieqi_dbprefix("article_actlog") . " WHERE $slimit ORDER BY $sort $order LIMIT $limitstart,$listpnum";
		$actlogrows = array();
		$query->execute($sql);
		$k = 0;

		while ($row = $query->getRow()) {
			$actlogrows[$k] = jieqi_funtoarray("jieqi_htmlstr", $row);
            $actlogrows[$k]["actname_n"] = $actlogrows[$k]["actname"];
            if (isset($jieqiAction["article"][$actlogrows[$k]["actname_n"]])) {
                $actlogrows[$k]["actname"] = jieqi_htmlstr($jieqiAction["article"][$actlogrows[$k]["actname_n"]]["paytitle"]);
                include_once jieqi_path_inc("include/badgefunction.php", "badge");
                $actlogrows[$k]["icourl"] = getbadgeurl(5, $actlogrows[$k]["actname_n"], 0, true);
            }
			$k++;
		}

		$jieqiTpl->assign_by_ref("actlogrows", $actlogrows);
	}
}


?>
