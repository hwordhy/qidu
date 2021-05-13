<?php

define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

if (isset($_REQUEST["id"])) {
	$_REQUEST["id"] = intval($_REQUEST["id"]);
}

if (isset($_REQUEST["acode"]) && !preg_match("/^[a-z0-9_]+$/i", $_REQUEST["acode"])) {
	$_REQUEST["acode"] = "";
}

if ((empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) && empty($_REQUEST["acode"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

// var_dump(jieqi_path_template("articleinfo.html", "article")); exit;

include_once jieqi_path_common("header.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("articleinfo.html", "article");
if (empty($_REQUEST["id"]) && !empty($_REQUEST["acode"])) {
	$jieqiTset["jieqi_contents_cacheid"] = $_REQUEST["acode"];
}
else {
	$jieqiTset["jieqi_contents_cacheid"] = $_REQUEST["id"];
}

$content_used_cache = false;

if (JIEQI_USE_CACHE) {
	$jieqiTpl->setCaching(1);
	$jieqiTpl->setCachType(1);

	if ($jieqiTpl->is_cached($jieqiTset["jieqi_contents_template"], $jieqiTset["jieqi_contents_cacheid"], NULL, NULL, NULL, true)) {
		$content_used_cache = true;
	}
}
else {
	$jieqiTpl->setCaching(0);
}

if (!$content_used_cache) {
	jieqi_loadlang("article", JIEQI_MODULE_NAME);
	include_once jieqi_path_inc("class/article.php", "article");
	$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
	if (empty($_REQUEST["id"]) && !empty($_REQUEST["acode"])) {
		$article = $article_handler->get($_REQUEST["acode"], "articlecode");
	}
	else {
		$article = $article_handler->get($_REQUEST["id"]);
	}

	if (!$article) {
		jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
	}
	else if ($article->getVar("display") != 0) {
		jieqi_getconfigs(JIEQI_MODULE_NAME, "power");

		if (!jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
			if ($article->getVar("display") == 1) {
				jieqi_printfail($jieqiLang["article"]["article_not_audit"]);
			}
			else {
				jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
			}
		}
	}

	$_REQUEST["id"] = intval($article->getVar("articleid", "n"));

	if ($article->getVar("display") != 0) {
		$jieqiTpl->setCaching(0);
		$jieqiConfigs["article"]["makehtml"] = 0;
	}

	$_REQUEST["class"] = $article->getVar("sortid");
	$_REQUEST["sortid"] = $article->getVar("sortid");
	jieqi_getconfigs("article", "sort", "jieqiSort");
	jieqi_getconfigs("article", "option", "jieqiOption");
	$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
	$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("makefull", $jieqiConfigs["article"]["makefull"]);
	$jieqiTpl->assign("makezip", $jieqiConfigs["article"]["makezip"]);
	$jieqiTpl->assign("makejar", $jieqiConfigs["article"]["makejar"]);
	$jieqiTpl->assign("makeumd", $jieqiConfigs["article"]["makeumd"]);
	$jieqiTpl->assign("maketxtfull", $jieqiConfigs["article"]["maketxtfull"]);
	$jieqiTpl->assign("maketxt", $jieqiConfigs["article"]["maketxt"]);
	$jieqiTpl->assign("ratemax", intval($jieqiConfigs["article"]["maxrates"]));
	include_once jieqi_path_inc("include/funarticle.php", "article");
	$articlevals = jieqi_article_vars($article, true);
	$jieqiTpl->assign_by_ref("articlevals", $articlevals);

	foreach ($articlevals as $k => $v ) {
		$jieqiTpl->assign($k, $articlevals[$k]);
	}

    $articlevals["is_bookcase"] = false;
    $articlevals["is_autobuy"] = false;
    if (!empty($_SESSION["jieqiUserId"])) {
        //获取当前用户是否收藏本书
        include_once jieqi_path_inc("class/bookcase.php", "article");
        $bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
        $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
        $criteria->add(new Criteria("articleid", $_REQUEST["id"]));
        $bookcase_handler->queryObjects($criteria);
        $bookcase = $bookcase_handler->getObject();
        if (is_object($bookcase)) {
            $articlevals["is_bookcase"] = true;
        }
        unset($criteria);
        //获取当前用户是否对本书开启自动订阅
        include_once jieqi_path_inc("class/obuy.php", "obook");
        $obuy_handler = &JieqiObuyHandler::getInstance("JieqiObuyHandler");
        $criteria = new CriteriaCompo(new Criteria("userid", $_SESSION["jieqiUserId"]));
        $criteria->add(new Criteria("articleid", $_REQUEST["id"]));
        $criteria->setLimit(1);
        $obuy_handler->queryObjects($criteria);
        $obuy = $obuy_handler->getObject();
        if (is_object($obuy)) {
            if (!empty($obuy->getVar("autobuy"))) {
                $articlevals["is_autobuy"] = true;
            }
        }
        unset($criteria);

        $jieqiTpl->assign("is_bookcase", $articlevals["is_bookcase"]);
        $jieqiTpl->assign("is_autobuy", $articlevals["is_autobuy"]);
    }
    //获取打赏人次
    jieqi_includedb();
    $query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
    $tipsql = "SELECT *, count(uid) as tipnums FROM ".jieqi_dbprefix( "article_credit" )." WHERE articleid = ".$_REQUEST["id"]." AND vars like '%tip%' ";
    $query->execute($tipsql);
    $k = 0;
    $tiprows = array();
    while ($tip = $query->getRow()) {
        $tiprows[$k] = jieqi_query_rowvars($tip);
        $tipnums = $tip["tipnums"];
        $k++;
    }
    //获取月票排行名次
    $sql = "SELECT count(distinct monthvipvote) as ranking FROM ".jieqi_dbprefix( "article_article" )." WHERE monthvipvote > ".$article->getVar("monthvipvote");
    $res = $article_handler->execute($sql);
    $row = $article_handler->getRow($res);
    $_REQUEST["id"] = intval($article->getVar("articleid", "n"));

    if ($article->getVar("display") != 0) {
        $jieqiTpl->setCaching(0);
        $jieqiConfigs["article"]["makehtml"] = 0;
    }
    $jieqiTpl->assign("tipnums", $tipnums);
    $jieqiTpl->assign_by_ref("tiprows", $tiprows);

    $History = json_decode(stripslashes($_COOKIE["jieqiHistoryBooks"]),true);
    if (isset($History)) {
        foreach ($History as $k => $v) {
            if ($v['articleid'] == $_REQUEST["id"]) {
                jieqi_includedb();
                $query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
                $shelf = $v['articleid'];
                $chaptername = "SELECT chaptername FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $v["articleid"] . " AND chaptertype = 0 AND chapterid = " . $v['chapterid'];
                $query->execute($chaptername);
                $chaptername = $query->getRow();
                $jieqiTpl->assign("history_id", $v['articleid']);
                $jieqiTpl->assign("history_cid", $v['chapterid']);
                $jieqiTpl->assign("history_name", $chaptername['chaptername']);
                $jieqiTpl->assign("history_isvip", $v['isvip']);
            }

        }
    }
    //获取3章章节列表
    $articlevals["chapter"] = array();
    $k = 0;
    include_once jieqi_path_inc("class/chapter.php", "article");
    include_once jieqi_path_inc("include/funchapter.php", "article");
    $chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
    $criteria = new CriteriaCompo(new Criteria("articleid", $articlevals["articleid"]));
    $criteria->setSort("chapterorder");
    $criteria->setOrder("ASC");
    $criteria->setLimit(3);
    $chapter_handler->queryObjects($criteria);
    while ($v = $chapter_handler->getObject()) {
        $articlevals["chapter"][$k] = jieqi_article_chaptervars($v);
        $articlevals["chapter"][$k]["lastupdate"] = date('Y-m-d H:i:s', $articlevals["chapter"][$k]["lastupdate"]);
        $k++;
    }
	if (2 <= floatval(JIEQI_VERSION)) {
		$keywords = $article->getVar("keywords", "n");
		include_once jieqi_path_inc("include/funtag.php", "system");
		$tags = jieqi_tag_clean($keywords);
		$tagrows = array();

		foreach ($tags as $k => $v ) {
			$tagrows[$k]["tagname"] = jieqi_htmlstr($v);
			$tagrows[$k]["tagname_n"] = $v;
			$tagrows[$k]["tagencode"] = (empty($charset_convert_out) ? urlencode($v) : urlencode($charset_convert_out($v)));
			$tagrows[$k]["tagname_u"] = $tagrows[$k]["tagencode"];
		}
        $articlevals["keywords"] = $tags;
		$jieqiTpl->assign_by_ref("tagrows", $tagrows);
	}

	$setting = jieqi_unserialize($article->getVar("setting", "n"));

	if (0 < $jieqiConfigs["article"]["eachlinknum"]) {
		$eachlinkrows = array();
		$eachlinkcount = 0;

		if (!empty($setting["eachlink"]["ids"])) {
			foreach ($setting["eachlink"]["ids"] as $k => $v ) {
				$eachlinkrows[$eachlinkcount]["articleid"] = $v;
				$eachlinkrows[$eachlinkcount]["articlename"] = jieqi_htmlstr($setting["eachlink"]["names"][$k]);
				$eachlinkrows[$eachlinkcount]["articlesubdir"] = jieqi_getsubdir($v);
				$tmpvar = (isset($setting["eachlink"]["codes"][$k]) ? $setting["eachlink"]["codes"][$k] : "");
				$eachlinkrows[$eachlinkcount]["url_articleinfo"] = jieqi_geturl("article", "article", $v, "info", $tmpvar);
				$eachlinkcount++;
			}
		}

		$jieqiTpl->assign("eachlinknum", $jieqiConfigs["article"]["eachlinknum"]);
		$jieqiTpl->assign("eachlinkcount", $eachlinkcount);
		$jieqiTpl->assign_by_ref("eachlinkrows", $eachlinkrows);
	}
	else {
		$jieqiTpl->assign("eachlinknum", 0);
		$jieqiTpl->assign("eachlinkcount", 0);
	}

	$showvote = 0;
	$jieqiConfigs["article"]["articlevote"] = intval($jieqiConfigs["article"]["articlevote"]);
	if ((0 < $jieqiConfigs["article"]["articlevote"]) && isset($setting["avoteid"]) && (0 < $setting["avoteid"])) {
		include_once jieqi_path_inc("class/avote.php", "article");
		$avote_handler = &JieqiAvoteHandler::getInstance("JieqiAvoteHandler");
		$avote = $avote_handler->get($setting["avoteid"]);

		if (is_object($avote)) {
			$jieqiTpl->assign("voteid", $avote->getVar("voteid"));
			$jieqiTpl->assign("votetitle", $avote->getVar("title"));
			$jieqiTpl->assign("mulselect", $avote->getVar("mulselect"));
			$useitem = $avote->getVar("useitem", "n");
			$voteitemrows = array();

			for ($i = 1; $i <= $useitem; $i++) {
				$voteitemrows[$i - 1]["id"] = $i;
				$voteitemrows[$i - 1]["item"] = $avote->getVar("item" . $i);
			}

			$jieqiTpl->assign_by_ref("voteitemrows", $voteitemrows);
			$showvote = 1;
		}
	}

	$jieqiTpl->assign("showvote", $showvote);

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	$jieqiTpl->assign("postcheckcode", $jieqiConfigs["system"]["postcheckcode"]);
}

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
	$articlevals["postdate"] = date('Y-m-d', $articlevals["postdate"]);
    echo json_encode(array("success" => true, "data" => $articlevals, "message" => '获取成功'));
    return false;

}

if (!isset($jieqiConfigs["article"]["visitstatnum"]) || !empty($jieqiConfigs["article"]["visitstatnum"])) {
	include_once jieqi_path_inc("articlevisit.php", "article");
}

include_once jieqi_path_common("footer.php");

?>
