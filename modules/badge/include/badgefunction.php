<?php

function getbadgetype($zym_hacxpwiy)
{
	global $jieqiType;

	if (!isset($jieqiType["badge"])) {
		jieqi_getconfigs("badge", "type");
	}

	if (isset($jieqiType["badge"][$zym_hacxpwiy]["title"])) {
		return $jieqiType["badge"][$zym_hacxpwiy]["title"];
	}

	return "";
}

function getbadgeurl($btypeid, $linkid, $imagetype = 0, $checkfile = false)
{
	global $jieqiConfigs;
	global $jieqi_image_type;

	if (!isset($jieqiConfigs["badge"])) {
		jieqi_getconfigs("badge", "configs");
	}

	if (empty($jieqi_image_type)) {
		$image_types = array(1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp");
	}
	else {
		$image_types = $jieqi_image_type;
	}

	if (($btypeid == 1) || ($btypeid == 2) || ($btypeid == 3) || ($btypeid == 4) || ($btypeid == 5)) {
		$ConstructedNavigationFactory = $jieqiConfigs["badge"]["sysimgtype"];
	}
	else {
		$ConstructedNavigationFactory = (is_numeric($imagetype) ? $image_types[$imagetype] : $imagetype);
	}

	$image_url = jieqi_uploadurl($jieqiConfigs["badge"]["imagedir"], "", "badge") . "/" . $btypeid . jieqi_getsubdir($linkid) . "/" . $linkid . $ConstructedNavigationFactory;

	if ($checkfile) {
		$image_file = jieqi_uploadpath($jieqiConfigs["badge"]["imagedir"], "badge") . "/" . $btypeid . jieqi_getsubdir($linkid) . "/" . $linkid . $ConstructedNavigationFactory;

		if (is_file($image_file)) {
			return $image_url;
		}

		return "";
	}

	return $image_url;
}

function getbadgepath($btypeid, $linkid, $imagetype = 0)
{
	global $jieqiConfigs;
	global $jieqi_image_type;

	if (!isset($jieqiConfigs["badge"])) {
		jieqi_getconfigs("badge", "configs");
	}

	if (empty($jieqi_image_type)) {
		$image_types = array(1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp");
	}
	else {
		$image_types = $jieqi_image_type;
	}

	if (($btypeid == 1) || ($btypeid == 2) || ($btypeid == 3) || ($btypeid == 4) || ($btypeid == 5)) {
		$ConstructedNavigationFactory = $jieqiConfigs["badge"]["sysimgtype"];
	}
	else {
		$ConstructedNavigationFactory = (is_numeric($imagetype) ? $image_types[$imagetype] : $imagetype);
	}

	$image_file = jieqi_uploadpath($jieqiConfigs["badge"]["imagedir"], "badge") . "/" . $btypeid . jieqi_getsubdir($linkid) . "/" . $linkid . $ConstructedNavigationFactory;
	return $image_file;
}

function upuserbadge($uid)
{
	global $jieqiConfigs;
	$uid = intval($uid);

	if (!isset($jieqiConfigs["badge"])) {
		jieqi_getconfigs("badge", "configs");
	}

	$jieqiConfigs["badge"]["userbadgenum"] = intval($jieqiConfigs["badge"]["userbadgenum"]);

	if ($jieqiConfigs["badge"]["userbadgenum"] <= 0) {
		return true;
	}

	jieqi_includedb();
	$award_query = jieqiqueryhandler::getinstance("JieqiQueryHandler");
	$infoary = array();
	$criteria = new criteriacompo();
	$criteria->settables(jieqi_dbprefix("badge_award") . " a LEFT JOIN " . jieqi_dbprefix("badge_badge") . " b ON a.badgeid=b.badgeid");
	$criteria->add(new criteria("a.toid", $uid));
	$criteria->setsort("b.btypeid ASC, a.awardid");
	$criteria->setorder("ASC");
	$criteria->setlimit($jieqiConfigs["badge"]["userbadgenum"]);
	$award_query->queryobjects($criteria);
	$append_editor = 0;

	while ($award = $award_query->getobject()) {
		$infoary[$append_editor]["btypeid"] = $award->getvar("btypeid", "n");
		$infoary[$append_editor]["linkid"] = $award->getvar("linkid", "n");
		$infoary[$append_editor]["imagetype"] = $award->getvar("imagetype", "n");
		$infoary[$append_editor]["caption"] = $award->getvar("caption", "n");
		$append_editor++;
	}

	if (0 < jieqi_count($infoary)) {
		$zym_dzivkegabafz = serialize($infoary);
	}
	else {
		$zym_dzivkegabafz = "";
	}

	$sql = "UPDATE " . jieqi_dbprefix("system_users") . " SET badges='" . jieqi_dbslashes($zym_dzivkegabafz) . "' WHERE uid=" . $uid;
	$award_query->execute($sql);
}


?>
