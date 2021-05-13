<?php

jieqi_includedb();
include_once jieqi_path_inc("class/topics.php", "system");
class JieqiReviews extends JieqiTopics
{
	public function __construct()
	{
		parent::__construct();
	}
}

class JieqiReviewsHandler extends JieqiObjectHandler
{
	public function __construct($db = "")
	{
		parent::__construct($db);
		$this->basename = "reviews";
		$this->autoid = "topicid";
		$this->dbname = "article_reviews";
	}
}

?>
