<?php

jieqi_includedb();
include_once jieqi_path_inc("class/attachs.php", "system");
class JieqiForumattachs extends JieqiAttachs
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiForumattachsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "forumattachs";
		$this->autoid = "attachid";
		$this->dbname = "forum_attachs";
	}
}

?>
