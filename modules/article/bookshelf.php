<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_loadlang("bookcase", JIEQI_MODULE_NAME);
include_once jieqi_path_common("header.php");
jieqi_getconfigs("article", "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
include_once jieqi_path_inc("include/funarticle.php", "article");
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$bookcaserows = array();
$i = 0;

if (isset($_COOKIE["jieqiHistoryBooks"])) {
	$jieqiHistoryBooks = object_array(json_decode(stripslashes($_COOKIE["jieqiHistoryBooks"])));
	foreach ($jieqiHistoryBooks as $k => $v ) {
		$sql = "SELECT a.*, b.* FROM " . jieqi_dbprefix("article_article") . " a LEFT JOIN " . jieqi_dbprefix("article_chapter") . " b ON a.articleid = b.articleid WHERE b.articleid = " . $v["articleid"] . " AND b.chapterid = " . $v["chapterid"] . " ORDER BY b.lastupdate DESC LIMIT 0,1";
		$query->execute($sql);

		while ($row = $query->getRow()) {
			$bookcaserows[$i] = jieqi_article_vars($row, true);
			$bookcaserows[$i]["articlemark"] = $bookcaserows[$i]["chaptername"];
			$bookcaserows[$i]["url_articlemark"] = $article_dynamic_url . "/readbookcase.php?aid=" . $bookcaserows[$i]["articleid"] . "&cid=" . $v["chapterid"] . "&acode=" . urlencode($bookcaserows[$i]["articlecode"]);
			$chapterorder = "SELECT count(chapterorder) FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $v["articleid"] . " AND chaptertype = 0 AND chapterorder <= " . $bookcaserows[$i]["chapterorder"] . " ORDER BY chapterorder DESC";
			$query->execute($chapterorder);
			$order = $query->getRow();
			$bookcaserows[$i]["chapterorder"] = $order["count(chapterorder)"];
            if (!empty($_SESSION["jieqiUserId"])) {
                //获取当前用户是否收藏本书
                $bookcaserows[$i]['book_case'] = false;
                include_once jieqi_path_inc("class/bookcase.php", "article");
                $bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
                $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
                $criteria->add(new Criteria("articleid", $bookcaserows[$i]["articleid"]));
                $bookcase_handler->queryObjects($criteria);
                $bookcase = $bookcase_handler->getObject();
                if (is_object($bookcase)) {
                    $bookcaserows[$i]['book_case'] = true;
                }
            }
			$i++;
		}
	}
}

$jieqiTpl->assign_by_ref("bookcaserows", $bookcaserows);
$jieqiTpl->setCaching(0);
if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
    header("Content-type: text/html; charset=".JIEQI_SYSTEM_CHARSET);
    $jieqiTset['jieqi_page_template'] = jieqi_path_template("bookshelf_ajax.html", "article");
}
else{
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template("bookshelf.html", "article");
}

include_once jieqi_path_common("footer.php");

?>

