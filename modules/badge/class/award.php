<?php

jieqi_includedb();

class jieqiaward extends jieqiobjectdata
{
	public function __construct()
	{
		$this->jieqiobjectdata();
		$this->initvar("awardid", JIEQI_TYPE_INT, 0, "序号", false, 11);
		$this->initvar("addtime", JIEQI_TYPE_INT, 0, "颁发时间", false, 11);
		$this->initvar("fromid", JIEQI_TYPE_INT, 0, "颁发者id", false, 11);
		$this->initvar("fromname", JIEQI_TYPE_TXTBOX, "", "颁发者", false, 30);
		$this->initvar("toid", JIEQI_TYPE_INT, 0, "授予者id", false, 11);
		$this->initvar("toname", JIEQI_TYPE_TXTBOX, "", "授予者", false, 30);
		$this->initvar("badgeid", JIEQI_TYPE_INT, 0, "徽章id", false, 11);
	}
}

class jieqiawardhandler extends jieqiobjecthandler
{
	public function __construct($db = "")
	{
        parent::__construct($db);
		$this->basename = "award";
		$this->autoid = "awardid";
		$this->dbname = "badge_award";
	}
}

?>
