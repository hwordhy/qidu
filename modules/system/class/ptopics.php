<?php

jieqi_includedb();
include_once jieqi_path_inc("class/topics.php", "system");
class JieqiPtopics extends JieqiTopics
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiPtopicsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "ptopics";
		$this->autoid = "topicid";
		$this->dbname = "system_ptopics";
	}
}

?>
