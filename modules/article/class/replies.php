<?php

jieqi_includedb();
include_once jieqi_path_inc("class/posts.php", "system");
class JieqiReplies extends JieqiPosts
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiRepliesHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "replies";
		$this->autoid = "postid";
		$this->dbname = "article_replies";
	}
}

?>
