<?php

class feedcontrol extends base
{
	public function __construct()
	{
		$this->feedcontrol();
	}

	public function feedcontrol()
	{
		parent::__construct();
		$this->init_input();
	}

	public function onadd()
	{
		$this->load("misc");
		$appid = intval($this->input("appid"));
		$icon = $this->input("icon");
		$uid = intval($this->input("uid"));
		$username = $this->input("username");
		$body_data = $_ENV["misc"]->array2string($this->input("body_data"));
		$title_data = $_ENV["misc"]->array2string($this->input("title_data"));
		$title_template = $this->_parsetemplate($this->input("title_template"));
		$body_template = $this->_parsetemplate($this->input("body_template"));
		$body_general = $this->input("body_general");
		$target_ids = $this->input("target_ids");
		$image_1 = $this->input("image_1");
		$image_1_link = $this->input("image_1_link");
		$image_2 = $this->input("image_2");
		$image_2_link = $this->input("image_2_link");
		$image_3 = $this->input("image_3");
		$image_3_link = $this->input("image_3_link");
		$image_4 = $this->input("image_4");
		$image_4_link = $this->input("image_4_link");
		$hash_template = md5($title_template . $body_template);
		$hash_data = md5($title_template . $title_data . $body_template . $body_data);
		$dateline = $this->time;
		$this->db->query("INSERT INTO " . UC_DBTABLEPRE . "feeds SET appid='$appid', icon='$icon', uid='$uid', username='$username',\r\n\t\t\ttitle_template='$title_template', title_data='$title_data', body_template='$body_template', body_data='$body_data', body_general='$body_general',\r\n\t\t\timage_1='$image_1', image_1_link='$image_1_link', image_2='$image_2', image_2_link='$image_2_link',\r\n\t\t\timage_3='$image_3', image_3_link='$image_3_link', image_4='$image_4', image_4_link='$image_4_link',\r\n\t\t\thash_template='$hash_template', hash_data='$hash_data', target_ids='$target_ids', dateline='$dateline'");
		return $this->db->insert_id();
	}

	public function ondelete()
	{
		$start = $this->input("start");
		$limit = $this->input("limit");
		$end = $start + $limit;
		$this->db->query("DELETE FROM " . UC_DBTABLEPRE . "feeds WHERE feedid>'$start' AND feedid<'$end'");
	}

	public function onget()
	{
		$this->load("misc");
		$limit = intval($this->input("limit"));
		$delete = $this->input("delete");
		$feedlist = $this->db->fetch_all("SELECT * FROM " . UC_DBTABLEPRE . "feeds ORDER BY feedid DESC LIMIT $limit");

		if ($feedlist) {
			$maxfeedid = $feedlist[0]["feedid"];

			foreach ($feedlist as $key => $feed ) {
				$feed["body_data"] = $_ENV["misc"]->string2array($feed["body_data"]);
				$feed["title_data"] = $_ENV["misc"]->string2array($feed["title_data"]);
				$feedlist[$key] = $feed;
			}
		}

		if (!empty($feedlist)) {
			if (!isset($delete) || $delete) {
				$this->_delete(0, $maxfeedid);
			}
		}

		return $feedlist;
	}

	public function _delete($start, $end)
	{
		$this->db->query("DELETE FROM " . UC_DBTABLEPRE . "feeds WHERE feedid>='$start' AND feedid<='$end'");
	}

	public function _parsetemplate($template)
	{
		$template = str_replace(array("\r", "\n"), "", $template);
		$template = str_replace(array("<br>", "<br />", "<BR>", "<BR />"), "\n", $template);
		$template = str_replace(array("<b>", "<B>"), "[B]", $template);
		$template = str_replace(array("<i>", "<I>"), "[I]", $template);
		$template = str_replace(array("<u>", "<U>"), "[U]", $template);
		$template = str_replace(array("</b>", "</B>"), "[/B]", $template);
		$template = str_replace(array("</i>", "</I>"), "[/I]", $template);
		$template = str_replace(array("</u>", "</U>"), "[/U]", $template);
		$template = htmlspecialchars($template);
		$template = nl2br($template);
		$template = str_replace(array("[B]", "[I]", "[U]", "[/B]", "[/I]", "[/U]"), array("<b>", "<i>", "<u>", "</b>", "</i>", "</u>"), $template);
		return $template;
	}
}

!defined("IN_UC") && exit("Access Denied");

?>
