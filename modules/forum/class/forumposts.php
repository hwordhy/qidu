<?php

jieqi_includedb();
include_once jieqi_path_inc("class/posts.php", "system");
class JieqiForumposts extends JieqiPosts
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiForumpostsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "forumposts";
		$this->autoid = "postid";
		$this->dbname = "forum_forumposts";
	}
}


?>
