<?php

jieqi_includedb();
include_once jieqi_path_inc("class/topics.php","system");
class JieqiForumtopics extends JieqiTopics
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiForumtopicsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "forumtopics";
		$this->autoid = "topicid";
		$this->dbname = "forum_forumtopics";
	}
}

?>
