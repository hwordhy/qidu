<?php

include_once jieqi_path_inc("class/article.php", "article");
include_once jieqi_path_inc("class/chapter.php", "article");
include_once jieqi_path_inc("class/package.php", "article");

function article_repack($id, $params = array(), $syn = 0)
{
	global $jieqiConfigs;
	global $jieqiModules;
	global $jieqi_file_postfix;
	global $jieqiTpl;
	global $jieqiSort;

	if (!$syn) {
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$url = $article_static_url . "/makepack.php?key=" . urlencode(md5(JIEQI_DB_USER . JIEQI_DB_PASS . JIEQI_DB_NAME)) . "&id=" . intval($id);
		$url = trim($url);

		if (strtolower(substr($url, 0, 7)) != "http://") {
			$url = "http://" . $_SERVER["HTTP_HOST"] . $url;
		}

		foreach ($params as $k => $v ) {
			if ($v) {
				$url .= "&packflag[]=" . urlencode($k);
			}
		}

		return jieqi_socket_url($url);
	}
	else {
		$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
		$article = $article_handler->get($id);

		if (!is_object($article)) {
			return false;
		}
		else {
			$package = new JieqiPackage($id);
			$package->initPackage($article->getVars("n"), false);
			$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
			$criteria = new CriteriaCompo(new Criteria("articleid", $id, "="));
			$criteria->setSort("chapterorder ASC, chapterid");
			$criteria->setOrder("ASC");
			$res = $chapter_handler->queryObjects($criteria);
			$i = 0;
			$articlesize = 0;

			while ($chapter = $chapter_handler->getObject($res)) {
				$package->chapters[$i] = $chapter->getVars("n");
				$i++;

				if ($chapter->getVar("chaptertype", "n") == 0) {
					$articlesize = $articlesize + intval($chapter->getVar("size", "n"));
				}

				if ($chapter->getVar("chapterorder", "n") != $i) {
					$chapter->setVar("chapterorder", $i);
					$chapter_handler->insert($chapter);
				}
			}

			$changeflag = false;

			if ($article->getVar("chapters", "n") != $i) {
				$article->setVar("chapters", $i);
				$changeflag = true;
			}

			if (intval($article->getVar("size", "n")) < $articlesize) {
				$article->setVar("size", $articlesize);
				$changeflag = true;
			}

			if ($articlesize != intval($article->getVar("freesize", "n"))) {
				$article->setVar("freesize", $articlesize);
				$changeflag = true;
			}

			if ($changeflag) {
				$article_handler->insert($article);
			}

			$package->isload = true;

			if ($params["makeopf"]) {
				$package->createOPF();
			}

			if ($params["makehtml"]) {
				$chaptercount = jieqi_count($package->chapters);

				for ($i = 1; $i <= $chaptercount; $i++) {
					if ($package->chapters[$i - 1]["chaptertype"] == 0) {
						$package->makeHtml($i, false, false, true);
					}
				}

				$package->makeIndex();
			}
			else {
				if ($params["makeindex"]) {
					$package->makeIndex();
				}

				if ($params["makechapter"]) {
					$chaptercount = jieqi_count($package->chapters);

					for ($i = 1; $i <= $chaptercount; $i++) {
						if ($package->chapters[$i - 1]["chaptertype"] == 0) {
							$package->makeHtml($i, false, false, true);
						}
					}
				}
			}

			if ($params["maketxtjs"]) {
				$chaptercount = jieqi_count($package->chapters);

				for ($i = 1; $i <= $chaptercount; $i++) {
					if ($package->chapters[$i - 1]["chaptertype"] == 0) {
						$package->makeTxtjs($i, true);
					}
				}
			}

			if ($params["makezip"]) {
				$package->makezip();
			}

			if ($params["makefull"]) {
				$package->makefulltext();
			}

			if ($params["makeumd"]) {
				$package->makeumd();
			}

			if ($params["maketxtfull"]) {
				$package->maketxtfull();
			}

			if ($params["makejar"]) {
				$package->makejar();
			}

			return true;
		}
	}
}

?>
