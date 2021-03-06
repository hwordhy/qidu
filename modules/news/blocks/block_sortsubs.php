<?php

class BlockNewsSortsubs extends JieqiBlock
{
	public $module = "news";
	public $template = "block_sortsubs.html";
	public $exevars = array("parentid" => 0);

	public function __construct(&$vars)
	{
		parent::__construct($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = jieqi_count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (is_numeric($varary[0])) {
					$this->exevars["parentid"] = intval($varary[0]);
				}
				else if (substr($varary[0], 0, 1) == "\$") {
					$tmpvar1 = $jieqiTpl->get_assign(substr($varary[0], 1));

					if (is_numeric($tmpvar1)) {
						$this->exevars["parentid"] = intval($tmpvar1);
					}
				}
				else {
					if (isset($_REQUEST[$varary[0]]) && is_numeric($_REQUEST[$varary[0]])) {
						$this->exevars["parentid"] = intval($_REQUEST[$varary[0]]);
					}
				}
			}
		}
		else {
			if (isset($_REQUEST["sortid"]) && is_numeric($_REQUEST["sortid"])) {
				$this->exevars["parentid"] = intval($_REQUEST["sortid"]);
			}
		}

		$this->blockvars["cacheid"] = md5(serialize($this->exevars) . "|" . $this->blockvars["template"]);
	}

	public function setContent($isreturn = false)
	{
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqiConfigs;
		global $jieqiModules;

		if (!isset($jieqiSort["news"])) {
			jieqi_getconfigs("news", "sort", "jieqiSort");
		}

		include_once jieqi_path_inc("include/funsort.php", "system");
		$sortrows = jieqi_sort_subs($jieqiSort["news"], $this->exevars["parentid"]);
		if (empty($sortrows) && (0 < $this->exevars["parentid"]) && isset($jieqiSort["news"][$this->exevars["parentid"]]["parentid"])) {
			$sortrows = jieqi_sort_subs($jieqiSort["news"], $jieqiSort["news"][$this->exevars["parentid"]]["parentid"]);
		}

		$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $sortrows));
	}
}


?>
