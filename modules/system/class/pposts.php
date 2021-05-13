<?php

jieqi_includedb();
include_once jieqi_path_inc("class/posts.php", "system");
class JieqiPposts extends JieqiPosts
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiPpostsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "pposts";
		$this->autoid = "postid";
		$this->dbname = "system_pposts";
	}
}

?>
