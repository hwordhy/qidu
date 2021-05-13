<?php

jieqi_includedb();
class jieqibadge extends jieqiobjectdata
{
	public function __construct()
	{
		$this->jieqiobjectdata();
		$this->initvar("badgeid", JIEQI_TYPE_INT, 0, "序号", false, 11);
		$this->initvar("btypeid", JIEQI_TYPE_INT, 0, "类型", false, 11);
		$this->initvar("caption", JIEQI_TYPE_TXTBOX, "", "勋章名称", true, 100);
		$this->initvar("description", JIEQI_TYPE_TXTAREA, "", "描述", false, NULL);
		$this->initvar("linkid", JIEQI_TYPE_INT, 0, "关联序号", false, 11);
		$this->initvar("imagetype", JIEQI_TYPE_INT, 0, "图片类型", false, 3);
		$this->initvar("maxnum", JIEQI_TYPE_INT, 0, "徽章数量", false, 11);
		$this->initvar("usenum", JIEQI_TYPE_INT, 0, "颁发数量", false, 11);
		$this->initvar("uptime", JIEQI_TYPE_INT, 0, "更新时间", false, 11);
	}
}

class jieqibadgehandler extends jieqiobjecthandler
{
	public function __construct($db = "")
	{
        parent::__construct($db);
		$this->basename = "badge";
		$this->autoid = "badgeid";
		$this->dbname = "badge_badge";
	}
}

?>
