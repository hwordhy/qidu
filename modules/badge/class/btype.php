<?php

jieqi_includedb();
class jieqibtype extends jieqiobjectdata
{
	public function __construct()
	{
		$this->jieqiobjectdata();
		$this->initvar("btypeid", JIEQI_TYPE_INT, 0, "类型序号", true, 11);
		$this->initvar("title", JIEQI_TYPE_TXTBOX, "", "类型名称", true, 100);
		$this->initvar("sysflag", JIEQI_TYPE_INT, 0, "类型标志", false, 1);
	}
}

class jieqibtypehandler extends jieqiobjecthandler
{
	public function __construct($db = "")
	{
        parent::__construct($db);
		$this->basename = "btype";
		$this->autoid = "btypeid";
		$this->dbname = "badge_btype";
	}
}

?>
