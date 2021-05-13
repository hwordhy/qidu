<?php

function jieqi_read_confusion($text, $config)
{
	if (isset($config['textwatermark'])) {
		$config['textwatermark'] = trim($config['textwatermark']);
	}
	if (isset($config['textwaterwords'])) {
		$config['textwaterwords'] = trim($config['textwaterwords']);
	}
	if (!empty($config['textreplacewords'])) {
		include_once jieqi_path_inc('include/checker.php', 'system');
		$checker = new JieqiChecker();
		$checker->replace_words($text, $config['textreplacewords']);
	}
	if (!empty($config['textwatermark'])) {
		$contentary = preg_split('/<br\\s*\\/?>\\s*<br\\s*\\/?>/is', $text);
		$text = '';
		foreach ($contentary as $v) {
			if (empty($text)) {
				$text .= $v;
			} else {
				if (!isset($config['textwaterwords']) || empty($config['textwaterwords'])) {
					srand((double) microtime() * 1000000);
					$randstr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$randlen = rand(10, 20);
					$randtext = '';
					$maxidx = strlen($randstr) - 1;
					for ($i = 0; $i < $randlen; $i++) {
						$num = rand(0, $maxidx);
						$randtext .= $randstr[$num];
					}
				} else {
					$lineary = preg_split('/[\\r\\n]+/is', $config['textwaterwords']);
					$maxidx = jieqi_count($lineary) - 1;
					if (0 < $maxidx) {
						$num = rand(0, $maxidx);
						$randtext = trim($lineary[$num]);
					} else {
						$wordary = preg_split('/\\s+/is', $config['textwaterwords']);
						$randlen = rand(4, 8);
						$randtext = '';
						$maxidx = jieqi_count($wordary) - 1;
						for ($i = 0; $i < $randlen; $i++) {
							$num = rand(0, $maxidx);
							$randtext .= trim($wordary[$num]);
						}
					}
				}
				$textwatermark = str_replace('<{$randtext}>', $randtext, $config['textwatermark']);
				$num = rand(1, 5);
				if (2 < $num) {
					$text .= $textwatermark . "<br />\r\n<br />" . $v;
				} else {
					if ($num == 2) {
						if (substr($v, 0, 26) == "\r\n&nbsp;&nbsp;&nbsp;&nbsp;") {
							$text .= "<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;" . $textwatermark . substr($v, 26);
						} else {
							$text .= "<br />\r\n<br />" . $textwatermark . $v;
						}
					} else {
						$text .= "<br />\r\n<br />" . $v;
					}
				}
			}
		}
	}
	return $text;
}
function jieqi_socket_url($url)
{
	if (!function_exists('fsockopen')) {
		return false;
	}
	$method = 'GET';
	$url_array = parse_url($url);
	$port = isset($url_array['port']) ? $url_array['port'] : 80;
	$fp = fsockopen($url_array['host'], $port, $errno, $errstr, 30);
	if (!$fp) {
		return false;
	}
	$getPath = $url_array['path'];
	if (!empty($url_array['query'])) {
		$getPath .= '?' . $url_array['query'];
	}
	$header = $method . ' ' . $getPath;
	$header .= " HTTP/1.1\r\n";
	$header .= 'Host: ' . $url_array['host'] . "\r\n";
	$header .= "Connection:Close\r\n\r\n";
	fwrite($fp, $header);
	if (!feof($fp)) {
		fgets($fp, 8);
	}
	fclose($fp);
	return true;
}
function jieqi_save_achapterc($articleid, $chapterid, $content, $isvip = 0, $chaptertype = 0)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $ocontent_handler;
	if ($isvip == 0) {
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		}
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;

		jieqi_checkdir($txtdir, true);
		return jieqi_writefile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'], $content);
	} else {
		if (!is_a($ocontent_handler, 'JieqiOcontentHandler')) {
			include_once jieqi_path_inc('class/ocontent.php', 'obook');
			$ocontent_handler =& JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
		}
		$cobj = $ocontent_handler->create();
		$cobj->setVar('ochapterid', $chapterid);
		$cobj->setVar('ocontent', $content);
		return $ocontent_handler->insert($cobj);
	}
}
function jieqi_edit_achapterc($articleid, $chapterid, $content, $isvip = 0, $chaptertype = 0)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $ocontent_handler;
	if ($isvip == 0) {
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		}
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
		jieqi_checkdir($txtdir, true);
		return jieqi_writefile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'], $content);
	} else {
		if (!is_a($ocontent_handler, 'JieqiOcontentHandler')) {
			include_once jieqi_path_inc('class/ocontent.php', 'obook');
			$ocontent_handler =& JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
		}
		$cobj = $ocontent_handler->get($chapterid, 'ochapterid');
		if (is_object($cobj)) {
			$cobj->setVar('ocontent', $content);
		} else {
			$cobj = $ocontent_handler->create();
			$cobj->setVar('ochapterid', $chapterid);
			$cobj->setVar('ocontent', $content);
		}
		return $ocontent_handler->insert($cobj);
	}
}
function jieqi_delete_achapterc($articleid, $chapterid = 0, $isvip = 0, $chaptertype = 0)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $query;
	global $ocontent_handler;
	$articleid = intval($articleid);
	$chapterid = intval($chapterid);
	if ($chapterid < 0) {
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		}
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
		@jieqi_delfolder($txtdir);
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_ochapter') . ' WHERE articleid = ' . $articleid . ' LIMIT 0, 1';
		$res = $query->execute($sql);
		$obook = $query->getRow($res);
		if (is_array($obook)) {
			if ($obook['sumemoney'] == 0 && $obook['sumegold'] == 0) {
				$sql = 'DELETE FROM ' . jieqi_dbprefix('obook_obook') . ' WHERE obookid = ' . intval($obook['obookid']);
				$sql = 'DELETE FROM ' . jieqi_dbprefix('obook_ochapter') . ' WHERE obookid = ' . intval($obook['obookid']);
			} else {
				$sql = 'SELECT ochapterid FROM ' . jieqi_dbprefix('obook_ochapter') . ' WHERE obookid = ' . intval($obook['obookid']) . ' AND sumegold = 0';
				$res = $query->execute($sql);
				$cids = array();
				while ($row = $query->getRow($res)) {
					$cids[] = intval($row['ochapterid']);
				}
				$delcnum = jieqi_count($cids);
				if (!empty($cids)) {
					$cidstr = implode(',', $cids);
					$sql = 'DELETE FROM  ' . jieqi_dbprefix('obook_ochapter') . ' WHERE ochapterid IN (' . $cidstr . ')';
					$query->execute($sql);
					$sql = 'DELETE FROM  ' . jieqi_dbprefix('obook_ocontent') . ' WHERE ochapterid IN (' . $cidstr . ')';
					$query->execute($sql);
				}
				$sql = 'UPDATE  ' . jieqi_dbprefix('obook_ochapter') . ' SET display = 2 WHERE obookid = ' . intval($obook['obookid']);
				$query->execute($sql);
				$sql = 'UPDATE  ' . jieqi_dbprefix('obook_obook') . ' SET display = 2, chapters = chapters - ' . $delcnum . ' WHERE obookid = ' . intval($obook['obookid']);
				$query->execute($sql);
			}
		}
		return true;
	} else {
		if ($isvip == 0) {
			if (!isset($jieqiConfigs['article'])) {
				jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
			}
			$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;

			return @jieqi_delfile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt']);
		} else {
			include_once jieqi_path_inc('class/ochapter.php', 'obook');
			$ochapter_handler =& JieqiOchapterHandler::getInstance('JieqiOchapterHandler');
			$ochapter = $ochapter_handler->get($chapterid, 'chapterid');
			if (is_object($ochapter)) {
				if (intval($ochapter->getVar('sumegold', 'n')) == 0) {
					$ochapter_handler->delete($chapterid, 'chapterid');
					if (!is_a($ocontent_handler, 'JieqiOcontentHandler')) {
						include_once jieqi_path_inc('class/ocontent.php', 'obook');
						$ocontent_handler =& JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
					}
					return $ocontent_handler->delete($chapterid, 'ochapterid');
					$sql = 'UPDATE  ' . jieqi_dbprefix('obook_obook') . ' SET chapters = chapters - 1 WHERE articleid = ' . intval($articleid);
					$query->execute($sql);
				} else {
					$ochapter->setVar('display', '2');
					return $ochapter_handler->insert($ochapter);
				}
			}
			return true;
		}
	}
}
function jieqi_get_achapterc($chapterinfo)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqi_file_postfix;
	global $ocontent_handler;
	if (!is_array($chapterinfo) || !isset($chapterinfo['articleid']) || !is_numeric($chapterinfo['articleid']) || !isset($chapterinfo['chapterid']) || !is_numeric($chapterinfo['chapterid'])) {
		return false;
	}
	if (!isset($chapterinfo['isvip'])) {
		$chapterinfo['isvip'] = 0;
	}
	if (!isset($chapterinfo['chaptertype'])) {
		$chapterinfo['chaptertype'] = 0;
	}
	if (!isset($chapterinfo['display'])) {
		$chapterinfo['display'] = 0;
	}
	if (!isset($chapterinfo['getformat'])) {
		$chapterinfo['getformat'] = 'txt';
	}
	if ($chapterinfo['display'] != 0) {
		jieqi_loadlang('article', JIEQI_MODULE_NAME);
		return $jieqiLang['article']['chapter_is_hide'];
	}
	if ($chapterinfo['isvip'] == 0) {
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		}
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($chapterinfo['articleid']) . '/' . $chapterinfo['articleid'];
		return jieqi_readfile($txtdir . '/' . $chapterinfo['chapterid'] . $jieqi_file_postfix['txt']);
	} else {
		if ($chapterinfo['getformat'] == 'url') {
			$url = jieqi_geturl('article', 'chapter', $chapterinfo['chapterid'], $chapterinfo['articleid'], $chapterinfo['isvip'], $chapterinfo['articlecode']);
			if (strpos($url, JIEQI_LOCAL_URL) !== 0) {
				$url = JIEQI_LOCAL_URL . $url;
			}
			return $url;
		} else {
			if (!is_a($ocontent_handler, 'JieqiOcontentHandler')) {
				include_once jieqi_path_inc('class/ocontent.php', 'obook');
				$ocontent_handler =& JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
			}
			$content = $ocontent_handler->get($chapterinfo['chapterid'], 'ochapterid');
			if (is_object($content)) {
				return $content->getVar('ocontent', 'n');
			} else {
				return '';
			}
		}
	}
}
function jieqi_info_achapterc($articleid, $chapterid, $isvip = 0, $chaptertype = 0)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	if (!isset($jieqiConfigs['article'])) {
		jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	}
	$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
	$txtfile = $txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'];
	if (is_file($txtfile)) {
		$ret = array();
		$ret['time'] = filemtime($txtfile);
		$ret['size'] = filesize($txtfile);
		return $ret;
	} else {
		return false;
	}
}
function jieqi_convert_achapterc($articleid, $chapterid, $action)
{
	switch ($action) {
		case 'free':
			$content = jieqi_get_achapterc(array('articleid' => $articleid, 'articlecode' => '', 'chapterid' => $chapterid, 'isvip' => 1, 'chaptertype' => 0, 'display' => 0, 'getformat' => 'txt'));
			return jieqi_save_achapterc($articleid, $chapterid, $content, 0);
			break;
		case 'vip':
			$content = jieqi_get_achapterc(array('articleid' => $articleid, 'articlecode' => '', 'chapterid' => $chapterid, 'isvip' => 0, 'chaptertype' => 0, 'display' => 0, 'getformat' => 'txt'));
			jieqi_delete_achapterc($articleid, $chapterid, 0);
			return jieqi_edit_achapterc($articleid, $chapterid, $content, 1);
			break;
		default:
			return false;
			break;
	}
}
include_once jieqi_path_lib('xml/xml.php');
include_once jieqi_path_common('header.php');
include_once jieqi_path_inc('include/funarticle.php', 'article');
global $jieqiConfigs;
jieqi_getconfigs('article', 'configs');
if (!isset($jieqiConfigs['article']['packdbattach'])) {
	$jieqiConfigs['article']['packdbattach'] = 0;
}
if (!$jieqiConfigs['article']['packdbattach'] && preg_match('/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is', $jieqiConfigs['article']['attachdir'])) {
	$jieqiConfigs['article']['packdbattach'] = 1;
}
global $query;
jieqi_includedb();
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
if (!empty($jieqiConfigs['article']['dynamicurl'])) {
	define('ARTICLE_DYNAMIC_URL', $jieqiConfigs['article']['dynamicurl']);
} else {
	define('ARTICLE_DYNAMIC_URL', $jieqiModules['article']['url']);
}
$article_dynamic_rooturl = ARTICLE_DYNAMIC_URL;
if (0 < strpos($article_dynamic_rooturl, '/modules')) {
	$article_dynamic_rooturl = substr($article_dynamic_rooturl, 0, strpos($article_dynamic_rooturl, '/modules'));
}
define('ARTICLE_DYNAMIC_ROOTURL', $article_dynamic_rooturl);
if (!empty($jieqiConfigs['article']['staticurl'])) {
	define('ARTICLE_STATIC_URL', $jieqiConfigs['article']['staticurl']);
} else {
	define('ARTICLE_STATIC_URL', $jieqiModules['article']['url']);
}
class JieqiPackage extends JieqiObject
{
	public $id = 0;
	public $xml;
	public $metas = array();
	public $chapters = array();
	public $isload = false;
	public $nowid = 0;
	public $preid = 0;
	public $nextid = 0;
	public function __construct($id = 0)
	{
		parent::__construct();
		$this->id = intval($id);
		$this->isload = false;
	}
	public function setId($id = 0)
	{
		$this->id = intval($id);
	}
	public function getId()
	{
		return $this->id;
	}
	public function getDir($dirtype = 'txtdir', $idasdir = true, $automake = true)
	{
		global $jieqiConfigs;
		$retdir = jieqi_uploadpath($jieqiConfigs['article'][$dirtype], 'article');
		if ($automake && !file_exists($retdir)) {
			jieqi_createdir($retdir);
		}
		$retdir .= jieqi_getsubdir($this->id);
		if ($automake && !file_exists($retdir)) {
			jieqi_createdir($retdir);
		}
		if ($idasdir) {
			$retdir .= '/' . $this->id;
			if ($automake && !file_exists($retdir)) {
				jieqi_createdir($retdir);
			}
		}
		return $retdir;
	}
	public function initPackage($infoary = array(), $save = true)
	{
		foreach ($infoary as $k => $v) {
			$this->metas[$k] = $v;
		}
		$this->chapters = array();
		if ($save) {
			$this->createOPF();
		}
	}
	public function editPackage($infoary = array(), $save = true)
	{
		global $jieqiConfigs;
		if (!$this->isload) {
			$this->loadOPF();
		}
		$tmpstr = $this->metas['articlename'];
		foreach ($infoary as $k => $v) {
			$this->metas[$k] = $v;
		}
		if ($save) {
			$this->createOPF();
		}
		if ($jieqiConfigs['article']['makehtml']) {
			$this->makeIndex();
			if ($tmpstr != $infoary['articlename']) {
				for ($i = 1; $i <= jieqi_count($this->chapters); $i++) {
					$this->makeHtml($i);
				}
			}
		}
	}
	public function createOPF($save = true)
	{
		$this->xml = new XML();
		$this->xml->encoding = 'ISO-8859-1';
		$this->xml->xmlDecl = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$package = $this->xml->createElement('package');
		$package->attributes['id'] = $this->id;
		$this->xml->appendChild($package);
		$articleinfo = $this->xml->createElement('articleinfo');
		$package->appendChild($articleinfo);
		$i = 0;
		foreach ($this->metas as $key => $val) {
			${'meta' . $i} = $this->xml->createElement($key);
			${'meta' . $i}->appendChild($this->xml->createTextNode($val));
			$articleinfo->appendChild(${'meta' . $i});
			$i++;
		}
		$chapters = $this->xml->createElement('chapters');
		$package->appendChild($chapters);
		$i = 0;
		foreach ($this->chapters as $val) {
			${'item' . $i} = $this->xml->createElement('item');
			${'item' . $i}->attributes = $val;
			$chapters->appendChild(${'item' . $i});
			$i++;
		}
		if ($save) {
			$this->saveOPF();
		}
	}
	public function saveOPF()
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$opfdir = $this->getDir('opfdir');
		jieqi_writefile($opfdir . '/index' . $jieqi_file_postfix['opf'], $this->xml->toString());
	}
	public function isOPF()
    {
        global $query;
        $this->metas = array();
        $sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . intval($this->id);
        $res = $query->execute($sql);
        $arow = $query->getRow($res);

        if (!is_array($arow)) {
            return false;
        }

        $this->initPackage($arow, false);
        $this->chapters = array();
        $sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . intval($this->id) . " ORDER BY chapterorder ASC";
        $res = $query->execute($sql);

        while ($crow = $query->getRow($res)) {
            $this->chapters[] = $crow;
        }
        if (!empty(count($this->chapters))) {
            $this->isload = true;
            return true;
        }
    }

	public function loadOPF()
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;

        require_once jieqi_path_lib("Oss/Alioss/alioss.php");
        $Oss = new AliUpload();
        if ($jieqiConfigs["system"]["oss"] && !file_exists($this->getDir('opfdir', true, false) . '/index' . $jieqi_file_postfix['opf'])){
            $to_file = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', str_replace("\\", "/", $this->getDir('opfdir', true, false) . '/index' . $jieqi_file_postfix['opf']));
            if (!$Oss->IsExist($to_file)) {
                return false;
            }
            $opfdir = $Oss->ReadFile($to_file);
        }else{
            $opfdir = $this->getDir('opfdir', true, false) . '/index' . $jieqi_file_postfix['opf'];
            if (!file_exists($opfdir)) {
                return false;
            }
        }

        $this->xml = new XML();
        $this->xml->load($opfdir);
        $this->metas = array();
        $meta = $this->xml->firstChild->firstChild->firstChild;
        while ($meta) {
            $this->metas[$meta->nodeName] = $meta->firstChild->nodeValue;
            $meta = $meta->nextSibling;
        }
        unset($meta);
        if (!isset($this->metas['articleid'])) {
            global $query;
            $this->metas = array();
            $sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article') . ' WHERE articleid = ' . intval($this->id);
            $res = $query->execute($sql);
            $arow = $query->getRow($res);
            if (!is_array($arow)) {
                return false;
            }
            $this->initPackage($arow, false);
            $this->chapters = array();
            $sql = 'SELECT * FROM ' . jieqi_dbprefix('article_chapter') . ' WHERE articleid = ' . intval($this->id) . ' ORDER BY chapterorder ASC';
            $res = $query->execute($sql);
            while ($crow = $query->getRow($res)) {
                $this->chapters[] = $crow;
            }
            $this->createOPF();
        } else {
            $chapter = $this->xml->firstChild->firstChild->nextSibling->firstChild;
            $this->chapters = array();
            $i = 0;
            while ($chapter) {
                $this->chapters[$i] = $chapter->attributes;
                $chapter = $chapter->nextSibling;
                $i++;
            }
            unset($chapter);
        }
        $this->isload = true;
        return true;
    }

	public function showChapter($cid, $showvip = 0)
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$i = 0;
		$num = jieqi_count($this->chapters);
		while ($i < $num) {
			$tmpvar = intval($this->chapters[$i]['chapterid']);
			if ($tmpvar == $cid) {
				if (!empty($showvip) && !empty($this->chapters[$i]['isvip'])) {
					if ($showvip == 1) {
						$this->makeVippage($i + 1, true);
					} else {
						$this->makeVippage($i + 1, true, true);
					}
				} else {
					// if (!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && !empty($this->metas['lastupdate']) && date('D, d M Y H:i:s', $this->metas['lastupdate']) . ' GMT' == $_SERVER['HTTP_IF_MODIFIED_SINCE']) {
					// 	header('HTTP/1.1 304 Not Modified');
					// 	return true;
					// } else {
					// 	header('Last-Modified: ' . date('D, d M Y H:i:s', $this->metas['lastupdate']) . ' GMT');
					// }
					$this->makeHtml($i + 1, true);
				}
				return true;
			}
			$i++;
		}
		return false;
	}
	public function makeHtml($nowid, $show = false)
	{
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqiTset;
		global $jieqi_file_postfix;
		global $article_static_url;

		if (!isset($jieqiSort['article'])) {
			jieqi_getconfigs('article', 'sort');
		}
		if ($nowid <= 0) {
			return false;
		}
		$chaptercount = jieqi_count($this->chapters);
		if ($chaptercount < $nowid) {
			return false;
		}
		if (!empty($this->chapters[$nowid - 1]['isvip'])) {
			return true;
		}
		if ($this->chapters[$nowid - 1]['chaptertype'] == 1) {
			return true;
		}
		if (!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) {
			$jieqiConfigs['article']['htmlfile'] = '.html';
		}
		$chapter = jieqi_htmlstr($this->chapters[$nowid - 1]['chaptername']);
		$void = $nowid - 2;
		$volume = '';
		while (0 <= $void && $this->chapters[$void]['chaptertype'] != 1) {
			$void--;
		}
		if (0 <= $void) {
			$volume = jieqi_htmlstr($this->chapters[$void]['chaptername']);
		}
		$preid = $nowid - 2;
		while (0 <= $preid && $this->chapters[$preid]['chaptertype'] == 1) {
			$preid--;
		}
		$preid++;
		$nextid = $nowid;
		while ($nextid < $chaptercount && $this->chapters[$nextid]['chaptertype'] == 1) {
			$nextid++;
		}
		if ($chaptercount <= $nextid) {
			$nextid = 0;
		} else {
			$nextid++;
		}
		if (!is_object($jieqiTpl)) {
			include_once jieqi_path_lib('template/template.php');
			$jieqiTpl =& JieqiTpl::getInstance();
		}
		$jieqi_page_template = jieqi_path_template('style.html', 'article');
		if (defined('JIEQI_THEME_ROOTNEW') && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template))) {
			$jieqi_page_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template);
		}
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);
		$jieqiTpl->assign('article_title', jieqi_htmlstr($this->metas['articlename']));
		$jieqiTpl->assign('jieqi_title', $volume . ' ' . $chapter);
		$jieqiTpl->assign('chaptertitle', $volume . ' ' . $chapter);
		$jieqiTpl->assign('jieqi_volume', $volume);
		$jieqiTpl->assign('volumename', $volume);
		$jieqiTpl->assign('jieqi_chapter', $chapter);
		$jieqiTpl->assign('chaptername', $chapter);
		include_once jieqi_path_inc('class/article.php', 'article');
		include_once jieqi_path_inc('include/funarticle.php', 'article');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach ($articlevals as $k => $v) {
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}
        $chapterid = intval($this->chapters[$nowid - 1]['chapterid']);
		$jieqiTpl->assign('article_id', $this->id);
		$jieqiTpl->assign('chapter_id', $chapterid);
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));
		$jieqiTpl->assign('chaptertime', $this->chapters[$nowid - 1]['lastupdate']);
		$jieqiTpl->assign('chaptersize', intval($this->chapters[$nowid - 1]['size']));
		$jieqiTpl->assign('chaptersize_c', jieqi_sizeformat($this->chapters[$nowid - 1]['size']));
		$jieqiTpl->assign('chapterid', $chapterid);
		$chapterisvip = intval($this->chapters[$nowid - 1]['isvip']);
		$jieqiTpl->assign('chapterisvip', $chapterisvip);
		if (isset($this->chapters[$nowid - 1]['summary'])) {
			$jieqiTpl->assign('summary', jieqi_htmlchars($this->chapters[$nowid - 1]['summary'], ENT_QUOTES));
		}
		if (isset($this->chapters[$nowid - 1]['preface'])) {
			$jieqiTpl->assign('preface', jieqi_htmlstr($this->chapters[$nowid - 1]['preface']));
		}
		if (isset($this->chapters[$nowid - 1]['notice'])) {
			$jieqiTpl->assign('notice', jieqi_htmlstr($this->chapters[$nowid - 1]['notice']));
		}
		if (isset($this->chapters[$nowid - 1]['foreword'])) {
			$jieqiTpl->assign('foreword', jieqi_htmlstr($this->chapters[$nowid - 1]['foreword']));
		}
		if (isset($this->chapters[$nowid - 1]['isbody'])) {
			$jieqiTpl->assign('isbody', intval($this->chapters[$nowid - 1]['isbody']));
		}
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$jieqiTpl->assign('url_fullpage', jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']));
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		$tmpurl = jieqi_geturl('article', 'chapter', $chapterid, $this->id, $chapterisvip, $this->metas['articlecode']);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_articlechapter', $tmpurl);
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		$chapterdisplay = intval($this->chapters[$nowid - 1]['display']);
		if (empty($jieqiConfigs['article']['usetxtjs']) || $chapterdisplay != 0) {
			$chaptertype = $this->chapters[$nowid - 1]['chaptertype'] == 1 ? 1 : 0;
			$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($this->chapters[$nowid - 1]['chapterid']), 'isvip' => intval($this->chapters[$nowid - 1]['isvip']), 'chaptertype' => $chaptertype, 'display' => $chapterdisplay, 'getformat' => 'url'));
			$tmpvar = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
			$tmpvar = str_replace('&nbsp;&nbsp;&nbsp;&nbsp;', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $tmpvar);
			if ((!empty($jieqiConfigs['article']['textwatermark']) || !empty($jieqiConfigs['article']['readreplacewords'])) && JIEQI_MODULE_VTYPE != '' && JIEQI_MODULE_VTYPE != 'Free') {
				$tmpvar = jieqi_read_confusion($tmpvar, $jieqiConfigs['article']);
			}
			$attachary = array();
			if ($chapterdisplay == 0) {
				$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
				if (!$jieqiConfigs['article']['packdbattach']) {
					$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
					if (is_dir($attachdir)) {
						$files = array();
						$handle = @opendir($attachdir);
						while ($handle !== false && ($file = @readdir($handle)) !== false) {
							if ($file != '.' && $file != '..') {
								$files[] = $file;
							}
						}
						@closedir($handle);
						sort($files);
						foreach ($files as $file) {
							if (is_file($attachdir . '/' . $file)) {
								$matches = array();
								if (preg_match('/^(\\d+)\\.(gif|jpg|jpeg|png|bmp)$/i', $file, $matches)) {
									$attachary[] = array('name' => $file, 'class' => 'image', 'postfix' => $matches[2], 'size' => 0, 'attachid' => $matches[1]);
								} else {
									if (preg_match('/^(\\d+)\\.(\\w+)$/i', $file, $matches)) {
										$attachary[] = array('name' => $file, 'class' => 'file', 'postfix' => $matches[2], 'size' => filesize($attachdir . '/' . $file), 'attachid' => $matches[1]);
									}
								}
							}
						}
					}
				} else {
					global $query;
					$sql = 'SELECT attachment FROM ' . jieqi_dbprefix('article_chapter') . ' WHERE chapterid=' . intval($chapterid);
					$res = $query->execute($sql);
					$row = $query->getRow($res);
					if (!empty($row['attachment'])) {
						$attachary = jieqi_unserialize($row['attachment']);
					}
					if (!is_array($attachary)) {
						$attachary = array();
					}
				}
				if (!empty($attachary)) {
					$image_code = $jieqiConfigs['article']['pageimagecode'];
					if (empty($image_code) || !preg_match('/\\<img/is', $image_code)) {
						$image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
					}
					$attachimage = '';
					$attachfile = '';
					foreach ($attachary as $attachvar) {
						$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
						if ($attachvar['class'] == 'image') {
							$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
						} else {
							$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
						}
					}
					if (!empty($attachimage) || !empty($attachfile)) {
						if (!empty($tmpvar)) {
							$tmpvar .= '<br /><br />';
						}
						$tmpvar .= $attachimage . $attachfile;
					}
				}
			}
		} else {
			$url_txtjs = jieqi_uploadurl($jieqiConfigs['article']['txtjsdir'], $jieqiConfigs['article']['txtjsurl'], 'article', $article_static_url) . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid . $jieqi_file_postfix['js'];
			$tmpvar = '<script type="text/javascript" src="' . $url_txtjs . '"></script>';
		}
		
		if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
			$tmpvar = strip_tags($tmpvar);
		}
		$tmpvar = str_replace('&emsp;&emsp;', '', $tmpvar);
		$tmpvar = str_replace("<br />", "", $tmpvar);
		$tmpvar = str_replace("\r\n", "\n", $tmpvar);
		$tmpvar = str_replace("\n\n", "\n", $tmpvar);
		$tmpvar = nl2br($tmpvar);

		$jieqiTpl->assign('jieqi_content', $tmpvar);
		if (0 < $preid) {
			$tmpcid = intval($this->chapters[$preid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$preid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', $tmpcid);
			$jieqiTpl->assign('previous_chaptername', jieqi_htmlstr($this->chapters[$preid - 1]['chaptername']));
			$jieqiTpl->assign('previous_isvip', $tmpisvip);
			$jieqiTpl->assign('first_page', 0);
		} else {
			$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', 0);
			$jieqiTpl->assign('previous_chaptername', '');
			$jieqiTpl->assign('previous_isvip', 0);
			$jieqiTpl->assign('first_page', 1);
		}
		$jieqiTpl->assign('preview_page', $tmpurl);
		$jieqiTpl->assign('url_preview', $tmpurl);
		$jieqiTpl->assign('url_previous', $tmpurl);
		if (0 < $nextid) {
			$tmpcid = intval($this->chapters[$nextid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$nextid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', $tmpcid);
			$jieqiTpl->assign('next_chaptername', jieqi_htmlstr($this->chapters[$nextid - 1]['chaptername']));
			$jieqiTpl->assign('next_isvip', $tmpisvip);
			$jieqiTpl->assign('last_page', 0);
		} else {
			$tmpurl = ARTICLE_STATIC_URL . '/lastchapter.php?aid=' . $this->id . '&dynamic=' . intval($show) . '&acode=' . urlencode($this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', 0);
			$jieqiTpl->assign('next_chaptername', '');
			$jieqiTpl->assign('next_isvip', 0);
			$jieqiTpl->assign('last_page', 1);
		}
		$jieqiTpl->assign('next_page', $tmpurl);
		$jieqiTpl->assign('url_next', $tmpurl);
		$jieqiTpl->setCaching(0);
		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
		if (!empty($jieqiTset['jieqi_page_template'])) {
			$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqi_page_template));
			if ($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':') {
				if (strpos($jieqiTset['jieqi_page_template'], '/') === false) {
					$jieqi_page_template = jieqi_path_template(JIEQI_THEME_NAME . '/' . $jieqiTset['jieqi_page_template'], "themes");
				} else {
					$jieqi_page_template = JIEQI_ROOT_PATH . '/' . $jieqiTset['jieqi_page_template'];
				}
			} else {
				$jieqi_page_template = $jieqiTset['jieqi_page_template'];
			}
		}
		if ($show) {
            //最近阅读记录2018.11.02
            if(isset($_COOKIE["jieqiHistoryBooks"])){
                $jieqiHistoryBooks = object_array(json_decode(stripslashes($_COOKIE["jieqiHistoryBooks"])));
                foreach ($jieqiHistoryBooks as $k => $v){

                    $book_id[$k] = $v['articleid'];

                    if ($book_id[$k] == $this->id) {
                        $jieqiHistoryBooks[$k]['chapterid'] = $chapterid;

                    }
                }

                if (!in_array($this->id, $book_id)) {
                    $keys = array("articleid" => $this->id, "chapterid" => $chapterid, "isvip" => $chapterisvip);
                    array_push($jieqiHistoryBooks, $keys);
                }
                setcookie("jieqiHistoryBooks", json_encode($jieqiHistoryBooks), time()+365*86400, "/");
            }
            else{
                $jieqiHistoryBooks = json_encode(array(array("articleid" => $this->id, "chapterid" => $chapterid, "isvip" => $chapterisvip)));
                setcookie("jieqiHistoryBooks", $jieqiHistoryBooks, time()+365*86400, "/");
            }

            if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
                //echo json_encode(array("success" => true, "data" => array("size_c"=>jieqi_sizeformat($this->chapters[$nowid - 1]["size"]), "author"=>$articlevals["author"], "articleid"=>$this->chapters[$nowid - 1]["articleid"], "articlename"=>$this->chapters[$nowid - 1]["articlename"], "content"=>$tmpvar, "chapterid"=>$this->chapters[$nowid - 1]["chapterid"], "chaptername"=>$this->chapters[$nowid - 1]["chaptername"], "isvip"=>$this->chapters[$nowid - 1]["isvip"], "next_chapterid"=>intval($this->chapters[$nextid - 1]['chapterid']), "next_isvip"=>intval($this->chapters[$nextid - 1]['isvip']), "prev_chapterid"=>intval($this->chapters[$preid - 1]['chapterid']), "prev_isvip"=>intval($this->chapters[$preid - 1]['isvip']), "price"=>$this->chapters[$nowid - 1]["saleprice"], "lastupdate"=>date('Y-m-d H:i:s', $this->chapters[$nowid - 1]["lastupdate"]), "is_monthly"=>$articlevals["monthly_n"]), "message" => '获取成功'));
                header('Content-type: application/html; charset='.JIEQI_SYSTEM_CHARSET);
                $jieqi_page_template = jieqi_path_template("style_ajax.html", "article");
            }
			$jieqiTpl->display($jieqi_page_template);
		} else {
			$htmldir = $this->getDir('htmldir');
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($jieqi_page_template));
		}
	}
	public function makeVippage($nowid, $show = true, $nopay = false)
	{
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiLang;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqiTset;
		global $jieqi_file_postfix;
		global $jieqiVips;
		if (!isset($jieqiSort['article'])) {
			jieqi_getconfigs('article', 'sort');
		}
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs');
		}
		if (!isset($jieqiConfigs['obook'])) {
			jieqi_getconfigs('article', 'obook');
		}
        jieqi_getconfigs("system", "vips");

		if ($nowid <= 0) {
			return false;
		}
		$chaptercount = jieqi_count($this->chapters);
		if ($chaptercount < $nowid) {
			return false;
		}
		if (empty($this->chapters[$nowid - 1]['isvip'])) {
			return $this->makeHtml($nowid, $show);
		}
		if ($this->chapters[$nowid - 1]['chaptertype'] == 1) {
			return true;
		}
		if (!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) {
			$jieqiConfigs['article']['htmlfile'] = '.html';
		}
		$chapter = jieqi_htmlstr($this->chapters[$nowid - 1]['chaptername']);
		$void = $nowid - 2;
		$volume = '';
		while (0 <= $void && $this->chapters[$void]['chaptertype'] != 1) {
			$void--;
		}
		if (0 <= $void) {
			$volume = jieqi_htmlstr($this->chapters[$void]['chaptername']);
		}
		$preid = $nowid - 2;
		while (0 <= $preid && $this->chapters[$preid]['chaptertype'] == 1) {
			$preid--;
		}
		$preid++;
		$nextid = $nowid;
		while ($nextid < $chaptercount && $this->chapters[$nextid]['chaptertype'] == 1) {
			$nextid++;
		}
		if ($chaptercount <= $nextid) {
			$nextid = 0;
		} else {
			$nextid++;
		}
		if (!is_object($jieqiTpl)) {
			include_once jieqi_path_lib('template/template.php');
			$jieqiTpl =& JieqiTpl::getInstance();
		}
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);
		$jieqiTpl->assign('article_title', jieqi_htmlstr($this->metas['articlename']));
		$jieqiTpl->assign('jieqi_title', $volume . ' ' . $chapter);
		$jieqiTpl->assign('chaptertitle', $volume . ' ' . $chapter);
		$jieqiTpl->assign('jieqi_volume', $volume);
		$jieqiTpl->assign('volumename', $volume);
		$jieqiTpl->assign('jieqi_chapter', $chapter);
		$jieqiTpl->assign('chaptername', $chapter);
		include_once jieqi_path_inc('class/article.php', 'article');
		include_once jieqi_path_inc('include/funarticle.php', 'article');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach ($articlevals as $k => $v) {
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}
		$jieqiTpl->assign('article_id', $this->id);
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));
		$obookid = intval($articlevals['vipid']);
		$jieqiTpl->assign('obookid', $obookid);
		$jieqiTpl->assign('chaptertime', $this->chapters[$nowid - 1]['lastupdate']);
		$jieqiTpl->assign('chaptersize', intval($this->chapters[$nowid - 1]['size']));
		$jieqiTpl->assign('chaptersize_c', jieqi_sizeformat($this->chapters[$nowid - 1]["size"]));
		$chapterid = intval($this->chapters[$nowid - 1]['chapterid']);
		$jieqiTpl->assign('chapterid', $chapterid);
		$jieqiTpl->assign('chapter_id', $chapterid);
		$chapterisvip = intval($this->chapters[$nowid - 1]['isvip']);
		$jieqiTpl->assign('chapterisvip', $chapterisvip);
		$jieqiTpl->assign('saleprice', intval($this->chapters[$nowid - 1]['saleprice']));
		$jieqiTpl->assign("disprice", ceil(intval($this->chapters[$nowid - 1]['saleprice']) * ($jieqiVips[$_SESSION['jieqiUserVipId']]['viptype'] / 10)));
		$jieqiTpl->assign('vipprice', intval($this->chapters[$nowid - 1]['vipprice']));
		$jieqiTpl->assign('summary', jieqi_htmlchars($this->chapters[$nowid - 1]['summary'], ENT_QUOTES));
		$jieqiTpl->assign('chapterdisplay', intval($this->chapters[$nowid - 1]['display']));
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$jieqiTpl->assign('url_fullpage', jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']));
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		$tmpurl = jieqi_geturl('article', 'chapter', $chapterid, $this->id, $chapterisvip, $this->metas['articlecode']);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_articlechapter', $tmpurl);
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		if (0 < $preid) {
			$tmpcid = intval($this->chapters[$preid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$preid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', $tmpcid);
			$jieqiTpl->assign('previous_chaptername', jieqi_htmlstr($this->chapters[$preid - 1]['chaptername']));
			$jieqiTpl->assign('previous_isvip', $tmpisvip);
			$jieqiTpl->assign('first_page', 0);
		} else {
			$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', 0);
			$jieqiTpl->assign('previous_chaptername', '');
			$jieqiTpl->assign('previous_isvip', 0);
			$jieqiTpl->assign('first_page', 1);
		}
		$jieqiTpl->assign('preview_page', $tmpurl);
		$jieqiTpl->assign('url_preview', $tmpurl);
		$jieqiTpl->assign('url_previous', $tmpurl);
		if (0 < $nextid) {
			$tmpcid = intval($this->chapters[$nextid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$nextid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', $tmpcid);
			$jieqiTpl->assign('next_chaptername', jieqi_htmlstr($this->chapters[$nextid - 1]['chaptername']));
			$jieqiTpl->assign('next_isvip', $tmpisvip);
			$jieqiTpl->assign('last_page', 0);
		} else {
			$tmpurl = ARTICLE_STATIC_URL . '/lastchapter.php?aid=' . $this->id . '&dynamic=' . intval($show) . '&acode=' . urlencode($this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', 0);
			$jieqiTpl->assign('next_chaptername', '');
			$jieqiTpl->assign('next_isvip', 0);
			$jieqiTpl->assign('last_page', 1);
		}
		$jieqiTpl->assign('next_page', $tmpurl);
		$jieqiTpl->assign('url_next', $tmpurl);
		$jieqiTpl->setCaching(1);
		if ($nopay) {
			$obookprice = 0;
			if (!isset($jieqiConfigs['article'])) {
				jieqi_getconfigs('article', 'configs');
			}
			if (!empty($jieqiConfigs['article']['wholebuy'])) {
				include_once jieqi_path_inc('class/obook.php', 'obook');
				$obook_handler =& JieqiObookHandler::getInstance('JieqiObookHandler');
				$obook = $obook_handler->get($obookid);
				if (is_object($obook)) {
					$obookprice = intval($obook->getVar('saleprice', 'n'));
				}
				if ($obookprice < 0) {
					$obookprice = 0;
				}
			}
			$jieqiTpl->assign('obookprice', $obookprice);
            if(isset($_REQUEST["ajax_gets"])) {
                header('Content-type: application/html; charset=' . JIEQI_SYSTEM_CHARSET);
                $jieqi_page_template = jieqi_path_template('readbuy_ajax.html', 'obook');
            }else{
                $jieqi_page_template = jieqi_path_template('readbuy.html', 'obook');
            }
			if (defined('JIEQI_THEME_ROOTNEW') && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template))) {
				$jieqi_page_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template);
			}
		} else {
			jieqi_getconfigs('obook', 'configs');
			include_once jieqi_path_inc('include/funbuy.php', 'obook');
			$ochapter = array('sourceid' => $this->chapters[$nowid - 1]['sourceid'], 'articleid' => $this->chapters[$nowid - 1]['articleid'], 'ochapterid' => $this->chapters[$nowid - 1]['chapterid'], 'chapterid' => $this->chapters[$nowid - 1]['chapterid'], 'display' => $this->chapters[$nowid - 1]['display']);
			if ($ochapter['display'] != 0) {
				if (!isset($jieqiLang['obook']['obook'])) {
					jieqi_loadlang('obook', 'obook');
				}
				if ($ochapter['display'] == 1) {
					$ocontent = $jieqiLang['obook']['chapter_is_hide'];
				} else {
					$ocontent = $jieqiLang['obook']['chapter_not_insale'];
				}
			} else {
				$ocontent = jieqi_obook_getocontent($ochapter);
				if ($ocontent === false) {
					return false;
				}
			}
			$attachary = array();
			if ($ochapter['display'] == 0) {
				$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
				if (!$jieqiConfigs['article']['packdbattach']) {
					$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
					if (is_dir($attachdir)) {
						$files = array();
						$handle = @opendir($attachdir);
						while ($handle !== false && ($file = @readdir($handle)) !== false) {
							if ($file != '.' && $file != '..') {
								$files[] = $file;
							}
						}
						@closedir($handle);
						sort($files);
						foreach ($files as $file) {
							if (is_file($attachdir . '/' . $file)) {
								$matches = array();
								if (preg_match('/^(\\d+)\\.(gif|jpg|jpeg|png|bmp)$/i', $file, $matches)) {
									$attachary[] = array('name' => $file, 'class' => 'image', 'postfix' => $matches[2], 'size' => 0, 'attachid' => $matches[1]);
								} else {
									if (preg_match('/^(\\d+)\\.(\\w+)$/i', $file, $matches)) {
										$attachary[] = array('name' => $file, 'class' => 'file', 'postfix' => $matches[2], 'size' => filesize($attachdir . '/' . $file), 'attachid' => $matches[1]);
									}
								}
							}
						}
					}
				} else {
					global $query;
					$sql = 'SELECT attachment FROM ' . jieqi_dbprefix('article_chapter') . ' WHERE chapterid=' . intval($chapterid);
					$res = $query->execute($sql);
					$row = $query->getRow($res);
					if (!empty($row['attachment'])) {
						$attachary = jieqi_unserialize($row['attachment']);
					}
					if (!is_array($attachary)) {
						$attachary = array();
					}
				}
			}
			$jieqiTpl->assign('url_obookimage', $obook_static_url . '/obookimage.php?cid=' . $_REQUEST['cid']);
			$jieqiTpl->assign('content_showtype', $jieqiConfigs['obook']['obkimagetype']);
			if (isset($ocontent) && is_string($ocontent)) {
				$jieqi_content = jieqi_htmlstr($ocontent);
				if ((!empty($jieqiConfigs['obook']['textwatermark']) || !empty($jieqiConfigs['obook']['readreplacewords'])) && JIEQI_MODULE_VTYPE != '' && JIEQI_MODULE_VTYPE != 'Free') {
					$jieqi_content = jieqi_read_confusion($jieqi_content, $jieqiConfigs['obook']);
				}
				if (!empty($jieqiConfigs['obook']['obookreadhead'])) {
					$jieqi_content = jieqi_htmlstr($jieqiConfigs['obook']['obookreadhead']) . '<br />' . $jieqi_content;
				}
				if (!empty($jieqiConfigs['obook']['obookreadfoot'])) {
					$jieqi_content .= '<br />' . jieqi_htmlstr($jieqiConfigs['obook']['obookreadfoot']);
				}
				$jieqi_content = jieqi_htmlclickable($jieqi_content);
				if (!empty($attachary)) {
					$image_code = $jieqiConfigs['article']['pageimagecode'];
					if (empty($image_code) || !preg_match('/\\<img/is', $image_code)) {
						$image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
					}
					$attachimage = '';
					$attachfile = '';
					foreach ($attachary as $attachvar) {
						$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
						if ($attachvar['class'] == 'image') {
							$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
						} else {
							$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
						}
					}
					if (!empty($attachimage) || !empty($attachfile)) {
						if (!empty($jieqi_content)) {
							$jieqi_content .= '<br /><br />';
						}
						$jieqi_content .= $attachimage . $attachfile;
					}
				}
				$jieqiTpl->assign('jieqi_content', $jieqi_content);
			}
			$jieqi_page_template = jieqi_path_template('reader.html', 'obook');
			if (defined('JIEQI_THEME_ROOTNEW') && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template))) {
				$jieqi_page_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template);
			}
			if ($jieqiConfigs['obook']['obkimagetype'] == 'txt' && is_string($ocontent)) {
			} else {
				$picnum = jieqi_count($ocontent);
				if (!empty($attachary)) {
					foreach ($attachary as $attachvar) {
						$picnum++;
						$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
						if ($attachvar['class'] == 'image') {
							$ocontent[$picnum] = array('order' => $picnum, 'class' => 'image', 'url' => $url);
						} else {
							$ocontent[$picnum] = array('order' => $picnum, 'class' => 'file', 'url' => $url, 'size' => ceil($attachvar['size'] / 1024) . 'K');
						}
					}
				}
				$jieqiTpl->assign('picnum', $picnum);
				$jieqiTpl->assign_by_ref('picrows', $ocontent);
			}
		}
        //最近阅读记录2018.11.02
        if (isset($_COOKIE["jieqiHistoryBooks"])) {

            $jieqiHistoryBooks = object_array(json_decode(stripslashes($_COOKIE["jieqiHistoryBooks"])));
            foreach ($jieqiHistoryBooks as $k => $v) {

                $book_id[$k] = $v['articleid'];

                if ($book_id[$k] == $this->id) {
                    $jieqiHistoryBooks[$k]['chapterid'] = $chapterid;

                }
            }

            if (!in_array($this->id, $book_id)) {
                $keys = array("articleid" => $this->id, "chapterid" => $chapterid, "isvip" => $chapterisvip);
                array_push($jieqiHistoryBooks, $keys);
            }
            setcookie("jieqiHistoryBooks", json_encode($jieqiHistoryBooks), time() + 365 * 86400, "/");
        } else {
            $jieqiHistoryBooks = json_encode(array(array("articleid" => $this->id, "chapterid" => $chapterid, "isvip" => $chapterisvip)));
            setcookie("jieqiHistoryBooks", $jieqiHistoryBooks, time() + 365 * 86400, "/");
        }

        if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//            $is_buy = 0;
//            $is_auto = 0;
//
//            if(!empty($_SESSION["jieqiUserId"]) && empty($_SESSION["freeread"])){
//                $isunbuy = jieqi_obook_getobuyinfo($this->chapters[$nowid - 1]["chapterid"], $obookid, $_SESSION["jieqiUserId"]);
//                $isauto = jieqi_obook_isautobuy($this->chapters[$nowid - 1]["chapterid"], $_SESSION["jieqiUserId"]);
//                $is_buy = is_object($isunbuy) ? 0 : 1;
//                $is_auto = ($isauto == true) ? 1 : 0;
//            }
//
//            echo json_encode(array("success" => true, "data" => array("size_c"=>jieqi_sizeformat($this->chapters[$nowid - 1]["size"]), "author"=>$articlevals["author"], "articleid"=>$this->chapters[$nowid - 1]["articleid"], "articlename"=>$this->chapters[$nowid - 1]["articlename"], "content"=>empty($jieqi_content) ? '<p></p>' : $jieqi_content, "chapterid"=>$this->chapters[$nowid - 1]["chapterid"], "chaptername"=>$this->chapters[$nowid - 1]["chaptername"], "isvip"=>$this->chapters[$nowid - 1]["isvip"], "next_chapterid"=>intval($this->chapters[$nextid - 1]['chapterid']), "next_isvip"=>intval($this->chapters[$nextid - 1]['isvip']), "prev_chapterid"=>intval($this->chapters[$preid - 1]['chapterid']), "prev_isvip"=>intval($this->chapters[$preid - 1]['isvip']), "price"=>$this->chapters[$nowid - 1]["saleprice"], "lastupdate"=>date('Y-m-d H:i:s', $this->chapters[$nowid - 1]["lastupdate"]), "is_buy"=>$is_buy, "is_auto"=>$is_auto, "is_monthly"=>$articlevals["monthly_n"]), "message" => '获取成功'));
//            return false;
            header('Content-type: application/html; charset='.JIEQI_SYSTEM_CHARSET);
            $jieqi_page_template = jieqi_path_template("readtext_ajax.html", "obook");

        }

		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
		if (!empty($jieqiTset['jieqi_page_template'])) {
			$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqi_page_template));
			$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
			if ($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':') {
				if (strpos($jieqiTset['jieqi_page_template'], '/') === false) {
					$jieqi_page_template = jieqi_path_template(JIEQI_THEME_NAME . '/' . $jieqiTset['jieqi_page_template'], "themes");
				} else {
					$jieqi_page_template = JIEQI_ROOT_PATH . '/' . $jieqiTset['jieqi_page_template'];
				}
			} else {
				$jieqi_page_template = $jieqiTset['jieqi_page_template'];
			}
		}
		$jieqiTpl->display($jieqi_page_template);
	}
	public function makeTxtjs($nowid)
	{
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqi_file_postfix;
		if ($nowid <= 0) {
			return false;
		}
		$chaptercount = jieqi_count($this->chapters);
		if ($chaptercount < $nowid) {
			return false;
		}
		if (!empty($this->chapters[$nowid - 1]['isvip'])) {
			return true;
		}
		if ($this->chapters[$nowid - 1]['chaptertype'] == 1) {
			return true;
		}
		$chapterid = intval($this->chapters[$nowid - 1]['chapterid']);
		$chaptertype = $this->chapters[$nowid - 1]['chaptertype'] == 1 ? 1 : 0;
		$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($this->chapters[$nowid - 1]['chapterid']), 'isvip' => intval($this->chapters[$nowid - 1]['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($this->chapters[$nowid - 1]['display']), 'getformat' => 'url'));
		$tmpvar = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
		if ((!empty($jieqiConfigs['article']['textwatermark']) || !empty($jieqiConfigs['article']['readreplacewords'])) && JIEQI_MODULE_VTYPE != '' && JIEQI_MODULE_VTYPE != 'Free') {
			$tmpvar = jieqi_read_confusion($tmpvar, $jieqiConfigs['article']);
		}
		$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
		if (!$jieqiConfigs['article']['packdbattach']) {
			$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
			if (is_dir($attachdir)) {
				$attachimage = '';
				$attachfile = '';
				$files = array();
				$handle = @opendir($attachdir);
				while ($handle !== false && ($file = @readdir($handle)) !== false) {
					if ($file != '.' && $file != '..') {
						$files[] = $file;
					}
				}
				@closedir($handle);
				sort($files);
				$image_code = $jieqiConfigs['article']['pageimagecode'];
				if (empty($image_code) || !preg_match('/\\<img/is', $image_code)) {
					$image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
				}
				foreach ($files as $file) {
					if (is_file($attachdir . '/' . $file)) {
						$url = $attachurl . '/' . $file;
						if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $file)) {
							$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
						} else {
							$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)<br /><br />';
						}
					}
				}
				if (!empty($attachimage) || !empty($attachfile)) {
					if (!empty($tmpvar)) {
						$tmpvar .= '<br /><br />';
					}
					$tmpvar .= $attachimage . $attachfile;
				}
			}
		} else {
			global $query;
			$sql = 'SELECT attachment FROM ' . jieqi_dbprefix('article_chapter') . ' WHERE chapterid=' . intval($chapterid);
			$res = $query->execute($sql);
			$row = $query->db->fetchArray($res);
			$attachary = array();
			if (!empty($row['attachment'])) {
				$attachary = jieqi_unserialize($row['attachment']);
			}
			if (is_array($attachary) && 0 < jieqi_count($attachary)) {
				$attachimage = '';
				$attachfile = '';
				$image_code = $jieqiConfigs['article']['pageimagecode'];
				if (empty($image_code) || !preg_match('/\\<img/is', $image_code)) {
					$image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
				}
				foreach ($attachary as $attachvar) {
					$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
					if ($attachvar['class'] == 'image') {
						$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
					} else {
						$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
					}
				}
				if (!empty($attachimage) || !empty($attachfile)) {
					if (!empty($tmpvar)) {
						$tmpvar .= '<br /><br />';
					}
					$tmpvar .= $attachimage . $attachfile;
				}
			}
		}
		$tmpvar = 'document.write(\'' . addslashes(str_replace(array("\r", "\n"), '', $tmpvar)) . '\');';
		$txtjsdir = $this->getDir('txtjsdir');
		jieqi_writefile($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js'], $tmpvar);
	}
	public function showIndex()
	{
		if (!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && !empty($this->metas['lastupdate']) && date('D, d M Y H:i:s', $this->metas['lastupdate']) . ' GMT' == $_SERVER['HTTP_IF_MODIFIED_SINCE']) {
			header('HTTP/1.1 304 Not Modified');
			return true;
		} else {
			header('Last-Modified: ' . date('D, d M Y H:i:s', $this->metas['lastupdate']) . ' GMT');
		}
		$this->makeIndex(true);
	}
	public function makeIndex($show = false)
	{
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqiOption;
		global $jieqiModules;
		global $jieqiPset;
		global $jieqiTset;
		if (!isset($jieqiConfigs['article'])) {
			jieqi_getconfigs('article', 'configs');
		}
		if (!isset($jieqiSort['article'])) {
			jieqi_getconfigs('article', 'sort');
		}
		if (!isset($jieqiOption['article'])) {
			jieqi_getconfigs('article', 'option', 'jieqiOption');
		}
		if (!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) {
			$jieqiConfigs['article']['htmlfile'] = '.html';
		}
		if (!is_object($jieqiTpl)) {
			include_once jieqi_path_lib('template/template.php');
			$jieqiTpl =& JieqiTpl::getInstance();
		}
		$jieqi_page_template = jieqi_path_template('index.html', 'article');
		if (defined('JIEQI_THEME_ROOTNEW') && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template))) {
			$jieqi_page_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template);
		}
		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
		if (!$this->isload) {
			$this->loadOPF();
		}
		$this->preid = 0;
		$this->nextid = 0;
		$chapterrows = jieqi_funtoarray('jieqi_htmlstr', $this->chapters);
		if (isset($_REQUEST['desc']) && !isset($_REQUEST['order'])) {
			$_REQUEST['order'] = $_REQUEST['desc'];
		}
		if (!empty($_REQUEST['order']) && ($_REQUEST['order'] == 1 || $_REQUEST['order'] == 'desc')) {
			$chapterrows = array_reverse($chapterrows);
			$jieqiTpl->assign('index_desc', 1);
			$jieqiTpl->assign('index_order', 'desc');
		} else {
			$_REQUEST['order'] = '';
			$jieqiTpl->assign('index_desc', 0);
			$jieqiTpl->assign('index_order', 'asc');
		}
		$firstchapterid = 0;
		$firstchapter = '';
		if (!empty($jieqiConfigs['article']['indexcols'])) {
			$rown = 0;
			$coln = 0;
			$cols = intval($jieqiConfigs['article']['indexcols']);
			if ($cols < 1) {
				$cols = 4;
			}
		}
		$preid = 0;
		$nextid = 0;
		$volumeorder = 0;
		$chaptervorder = 0;
		$chaptercorder = 0;
		foreach ($chapterrows as $k => $v) {
			if ($firstchapterid == 0 && $chapterrows[$k]['chaptertype'] == 0) {
				$firstchapterid = $chapterrows[$k]['chapterid'];
				$firstchapter = $chapterrows[$k]['chaptername'];
			}
			if (0 < $chapterrows[$k]['chaptertype']) {
				$chaptervorder = 0;
				$chapterrows[$k]['volumeorder'] = ++$volumeorder;
				$chapterrows[$k]['chaptervorder'] = $chaptervorder;
				$chapterrows[$k]['chaptercorder'] = 0;
			} else {
				$chapterrows[$k]['volumeorder'] = $volumeorder;
				$chapterrows[$k]['chaptervorder'] = ++$chaptervorder;
				$chapterrows[$k]['chaptercorder'] = ++$chaptercorder;
			}
			$chapterrows[$k]['size_c'] = jieqi_sizeformat($chapterrows[$k]['size'], 'c');
			$chapterrows[$k]['url_chapter'] = jieqi_geturl('article', 'chapter', $chapterrows[$k]['chapterid'], $chapterrows[$k]['articleid'], $chapterrows[$k]['isvip'], $this->metas['articlecode']);
			if ($chapterrows[$k]['chaptertype'] == 0) {
				if ($nextid == 0) {
					$nextid = $k + 1;
				}
				$preid = $k + 1;
			}
			if ($chapterrows[$k]['chaptertype'] == 0) {
				$j = $k + 1;
				if ($j < $this->nowid) {
					$this->preid = $j;
				} else {
					if ($this->nowid < $j && $this->nextid == 0) {
						$this->nextid = $j;
					}
				}
			}
			if (!empty($jieqiConfigs['article']['indexcols'])) {
				if (0 < $chapterrows[$k]['chaptertype']) {
					if (0 < $coln) {
						$rown++;
					}
					$coln = 0;
					$indexrows[$rown]['isvip'] = $chapterrows[$k]['isvip'];
					$indexrows[$rown]['ctype'] = 'volume';
					$indexrows[$rown]['vurl'] = '';
					$indexrows[$rown]['vname'] = $chapterrows[$k]['chaptername'];
					$indexrows[$rown]['vid'] = $chapterrows[$k]['chapterid'];
					$rown++;
				} else {
					$coln++;
					$indexrows[$rown]['ctype'] = 'chapter';
					$indexrows[$rown]['isvip' . $coln] = $chapterrows[$k]['isvip'];
					$indexrows[$rown]['cname' . $coln] = $chapterrows[$k]['chaptername'];
					$indexrows[$rown]['cid' . $coln] = $chapterrows[$k]['chapterid'];
					$indexrows[$rown]['time' . $coln] = $chapterrows[$k]['postdate'];
					$indexrows[$rown]['size' . $coln] = $chapterrows[$k]['size'];
					$indexrows[$rown]['size_c' . $coln] = $chapterrows[$k]['size_c'];
					$indexrows[$rown]['curl' . $coln] = $chapterrows[$k]['url_chapter'];
					$indexrows[$rown]['price' . $coln] = $chapterrows[$k]['saleprice'];
					if ($coln == $cols) {
						$rown++;
						$coln = 0;
					}
				}
			}
		}
		if ($show) {
			if (!isset($jieqiTset['jieqi_page_rows']) && isset($jieqiConfigs['article']['indexprows'])) {
				$jieqiTset['jieqi_page_rows'] = $jieqiConfigs['article']['indexprows'];
			}
			if (isset($jieqiTset['jieqi_page_rows'])) {
				$jieqiTset['jieqi_page_rows'] = intval($jieqiTset['jieqi_page_rows']);
			}
			if (!empty($jieqiTset['jieqi_page_rows'])) {
				if (empty($_REQUEST['page']) || intval($_REQUEST['page']) < 1) {
					$_REQUEST['page'] = 1;
				} else {
					$_REQUEST['page'] = intval($_REQUEST['page']);
				}
				$maxpage = ceil($chaptercorder / $jieqiTset['jieqi_page_rows']);
				if ($maxpage < $_REQUEST['page']) {
					$_REQUEST['page'] = $maxpage;
				}
				$jieqiPset = jieqi_get_pageset();
				$jieqiPset['count'] = $chaptercorder;
				include_once jieqi_path_lib('html/page.php');
				$jumppage = new JieqiPage($jieqiPset);
				$jumppage->setlink(jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode'], 0, $_REQUEST['order']));
				$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
                $jieqiTpl->assign('totalpage', $maxpage);
				$pend = $_REQUEST['page'] * $jieqiTset['jieqi_page_rows'];
				$pstart = $pend - $jieqiTset['jieqi_page_rows'];
				foreach ($chapterrows as $k => $v) {
					if (0 < $chapterrows[$k]['chaptertype'] || $chapterrows[$k]['chaptercorder'] <= $pstart || $pend < $chapterrows[$k]['chaptercorder']) {
						unset($chapterrows[$k]);
					}
				}
			}
		}
        $chapterrows = array_values($chapterrows);
        if (isset($_REQUEST["ajax_gets"])  && JIEQI_COVER_DIR != ''){
            echo json_encode($chapterrows);
            return false;
        }
		$jieqiTpl->assign_by_ref('chapterrows', $chapterrows);
		if (!empty($jieqiConfigs['article']['indexcols'])) {
			$jieqiTpl->assign_by_ref('indexrows', $indexrows);
		}
		if (0 < $preid) {
			$tmpcid = intval($this->chapters[$preid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$preid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', $tmpcid);
			$jieqiTpl->assign('first_page', 0);
		} else {
			$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', 0);
			$jieqiTpl->assign('first_page', 1);
		}
		$jieqiTpl->assign('preview_page', $tmpurl);
		$jieqiTpl->assign('url_preview', $tmpurl);
		$jieqiTpl->assign('url_previous', $tmpurl);
		if (0 < $nextid) {
			$tmpcid = intval($this->chapters[$nextid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$nextid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', $tmpcid);
			$jieqiTpl->assign('last_page', 0);
		} else {
			$tmpurl = ARTICLE_STATIC_URL . '/lastchapter.php?aid=' . $this->id . '&dynamic=' . intval($show) . '&acode=' . urlencode($this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', 0);
			$jieqiTpl->assign('last_page', 1);
		}
		$jieqiTpl->assign('next_page', $tmpurl);
		$jieqiTpl->assign('url_next', $tmpurl);
		include_once jieqi_path_inc('class/article.php', 'article');
		include_once jieqi_path_inc('include/funarticle.php', 'article');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		if (0 < $firstchapterid) {
			$articlevals['firstchapterid'] = $firstchapterid;
			$articlevals['firstchapter'] = $firstchapter;
			$articlevals['url_firstchapter'] = jieqi_geturl('article', 'chapter', $firstchapterid, $articlevals['articleid'], $this->metas['articlecode']);
		} else {
			$articlevals['firstchapterid'] = 0;
			$articlevals['firstchapter'] = '';
			$articlevals['url_firstchapter'] = '';
		}
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach ($articlevals as $k => $v) {
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);
		$jieqiTpl->assign('copy_info', JIEQI_META_COPYRIGHT);
		$jieqiTpl->assign('article_title', $articlevals['articlename']);
		$jieqiTpl->assign('chapterid', 0);
		$jieqiTpl->assign('article_id', $this->id);
		$jieqiTpl->assign('chapter_id', '0');
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$jieqiTpl->assign('url_fullpage', jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']));
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		$jieqiTpl->setCaching(0);
		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
		if (!empty($jieqiTset['jieqi_page_template'])) {
			$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqi_page_template));
			if ($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':') {
				if (strpos($jieqiTset['jieqi_page_template'], '/') === false) {
					$jieqi_page_template = jieqi_path_template(JIEQI_THEME_NAME . '/' . $jieqiTset['jieqi_page_template'], "themes");
				} else {
					$jieqi_page_template = JIEQI_ROOT_PATH . '/' . $jieqiTset['jieqi_page_template'];
				}
			} else {
				$jieqi_page_template = $jieqiTset['jieqi_page_template'];
			}
		}

		if ($show) {
            if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
//                $chapterrows["postdate"] = date('Y-m-d', $chapterrows["postdate"]);
//                echo json_encode(array("success" => true, "data" => $chapterrows, "chapters" =>jieqi_count($this->chapters), "message" => '获取成功'));
//                return false;
                header('Content-type: application/html; charset='.JIEQI_SYSTEM_CHARSET);
                $jieqiTpl->assign("cid", $_REQUEST["currcid"]);
                $jieqi_page_template = jieqi_path_template("index_ajax.html", "article");
            }
			$jieqiTpl->display($jieqi_page_template);
		} else {
			$htmldir = $this->getDir('htmldir');
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/index' . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($jieqi_page_template));
		}
	}
	public function showVolume($vid)
	{
		$this->makefulltext(true, $vid);
	}
	public function makefulltext($show = false, $vid = 0)
	{
		if (JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') {
			return true;
		}
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqiTset;
		global $jieqi_file_postfix;
		if (!isset($jieqiSort['article'])) {
			jieqi_getconfigs('article', 'sort');
		}
		if (!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) {
			$jieqiConfigs['article']['htmlfile'] = '.html';
		}
		if (!is_object($jieqiTpl)) {
			include_once jieqi_path_lib('template/template.php');
			$jieqiTpl =& JieqiTpl::getInstance();
		}
		$jieqi_page_template = jieqi_path_template('fulltext.html', 'article');
		if (defined('JIEQI_THEME_ROOTNEW') && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template))) {
			$jieqi_page_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $jieqi_page_template);
		}
		if (!$this->isload) {
			$this->loadOPF();
		}
		include_once jieqi_path_inc('class/article.php', 'article');
		include_once jieqi_path_inc('include/funarticle.php', 'article');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach ($articlevals as $k => $v) {
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}
		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('article_title', $articlename);
		$jieqiTpl->assign('book_title', '<a name="articletitle">' . $articlename . '</a>');
		$jieqiTpl->assign('copy_info', JIEQI_META_COPYRIGHT);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']);
		$jieqiTpl->assign('url_fullpage', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		$chapterrows = array();
		$chapters = array();
		$idx = 0;
		$n = 0;
		$vname = '';
		if (0 < $vid) {
			$cstart = false;
		} else {
			$cstart = true;
		}
		foreach ($this->chapters as $k => $chapter) {
			$chapterid = intval($this->chapters[$k]['chapterid']);
			if (0 < $vid) {
				if ($chapterid == $vid) {
					$cstart = true;
				} else {
					if ($cstart == true && $chapter['chaptertype'] == 1) {
						$cstart = false;
					}
				}
				if (!$cstart) {
					continue;
				}
			}
			if ($chapter['chaptertype'] == 1) {
				$chapterrows[$idx] = jieqi_funtoarray('jieqi_htmlstr', $chapter);
				$idx++;
				if ($chapter['chaptername'] != $vname) {
					$vname = $chapter['chaptername'];
				}
			} else {
				$chapterrows[$idx] = jieqi_funtoarray('jieqi_htmlstr', $chapter);
				$chapterrows[$idx]['url_chapter'] = '#' . $chapter['chapterid'];
				$idx++;
				if (!empty($vname)) {
					$tmpvar = $vname . ' ';
				} else {
					$tmpvar = '';
				}
				$chapters[$n]['title'] = '<a name="' . $chapterid . '">' . $tmpvar . $chapter['chaptername'] . '</a>';
				$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
				$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
				if (0 < strlen($tmpvar)) {
					$chapters[$n]['content'] = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
				} else {
					$chapters[$n]['content'] = '';
				}
				$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
				if (!$jieqiConfigs['article']['packdbattach']) {
					$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
					if (is_dir($attachdir)) {
						$attachimage = '';
						$attachfile = '';
						$files = array();
						$handle = @opendir($attachdir);
						while ($handle !== false && ($file = @readdir($handle)) !== false) {
							if ($file != '.' && $file != '..') {
								$files[] = $file;
							}
						}
						@closedir($handle);
						sort($files);
						foreach ($files as $file) {
							if (is_file($attachdir . '/' . $file)) {
								$url = $attachurl . '/' . $file;
								if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $file)) {
									$attachimage .= '<div class="divimage" id="' . $file . '" title="' . $url . '"><a style="cursor: pointer;" onclick="imgclickshow(\'' . $file . '\', \'' . $url . '\')">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)</div>';
								} else {
									$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)<br /><br />';
								}
							}
						}
						if (!empty($attachimage) || !empty($attachfile)) {
							if (!empty($chapters[$n]['content'])) {
								$chapters[$n]['content'] .= '<br /><br />';
							}
							$chapters[$n]['content'] .= $attachimage . $attachfile;
						}
					}
				} else {
					global $query;
					$sql = 'SELECT attachment FROM ' . jieqi_dbprefix('article_chapter') . ' WHERE chapterid=' . intval($chapterid);
					$res = $query->execute($sql);
					$row = $query->db->fetchArray($res);
					$attachary = array();
					if (!empty($row['attachment'])) {
						$attachary = jieqi_unserialize($row['attachment']);
					}
					if (is_array($attachary) && 0 < jieqi_count($attachary)) {
						$attachimage = '';
						$attachfile = '';
						foreach ($attachary as $attachvar) {
							$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
							if ($attachvar['class'] == 'image') {
								$attachimage .= '<strong>image:</strong><a href="' . $url . '" target="_blank">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
							} else {
								$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
							}
						}
						if (!empty($attachimage) || !empty($attachfile)) {
							if (!empty($chapters[$n]['content'])) {
								$chapters[$n]['content'] .= '<br /><br />';
							}
							$chapters[$n]['content'] .= $attachimage . $attachfile;
						}
					}
				}
				$n++;
			}
		}
		$jieqiTpl->assign_by_ref('chapterrows', $chapterrows);
		$jieqiTpl->assign_by_ref('chapters', $chapters);
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		$jieqiTpl->setCaching(0);
		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
		if (!empty($jieqiTset['jieqi_page_template'])) {
			$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqi_page_template));
			$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);
			if ($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':') {
				if (strpos($jieqiTset['jieqi_page_template'], '/') === false) {
					$jieqi_page_template = jieqi_path_template(JIEQI_THEME_NAME . '/' . $jieqiTset['jieqi_page_template'], "themes");
				} else {
					$jieqi_page_template = JIEQI_ROOT_PATH . '/' . $jieqiTset['jieqi_page_template'];
				}
			} else {
				$jieqi_page_template = $jieqiTset['jieqi_page_template'];
			}
		}
		if ($show) {
			$jieqiTpl->display($jieqi_page_template);
		} else {
			$htmldir = $this->getDir('fulldir', false);
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/' . $this->id . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($jieqi_page_template));
		}
	}
	public function maketxtfull()
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		$txtfulldir = $this->getDir('txtfulldir', false);
		$br = "\r\n";
		$data = '';
		if (!empty($jieqiConfigs['article']['txtarticlehead'])) {
			$data .= $jieqiConfigs['article']['txtarticlehead'] . $br . $br;
		}
		$data .= '<' . $this->metas['articlename'] . '>' . $br;
		$volume = '';
		foreach ($this->chapters as $k => $chapter) {
			if ($chapter['chaptertype'] == 1) {
				$volume = $chapter['chaptername'];
			} else {
				$data .= $br . $br . $volume . ' ' . $chapter['chaptername'] . $br . $br;
				$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
				$data .= jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
			}
		}
		if (!empty($jieqiConfigs['article']['txtarticlefoot'])) {
			$data .= $br . $jieqiConfigs['article']['txtarticlefoot'];
		}
		jieqi_writefile($txtfulldir . '/' . $this->id . $jieqi_file_postfix['txt'], $data);
	}
	public function makezip()
	{
		if (JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') {
			return true;
		}
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		global $jieqiModules;
		if (@function_exists('gzcompress') && 0 < $jieqiConfigs['article']['makehtml']) {
			$dir = $this->getDir('htmldir', true, false);
			$filelist = array();
			if (file_exists($dir)) {
				$handle = opendir($dir);
				while ($handle !== false && ($files = readdir($handle)) !== false) {
					if ($files != '.' && $files != '..' && !is_dir($dir . '/' . $files)) {
						$filelist[] = $dir . '/' . $files;
					}
				}
				closedir($handle);
			}
			if (0 < jieqi_count($filelist)) {
				include_once jieqi_path_lib('compress/zip.php');
				$zip = new JieqiZip();
				$zipfilename = $this->getDir('zipdir', false) . '/' . $this->id . $jieqi_file_postfix['zip'];
				if (!$zip->zipstart($zipfilename)) {
					return false;
				}
				foreach ($filelist as $filename) {
					if (is_file($filename)) {
						$content = jieqi_readfile($filename);
						$zip->zipadd(basename($filename), $content);
					}
				}
				if ($zip->zipend()) {
					@chmod($zipfilename, 511);
				}
			}
			return true;
		} else {
			return false;
		}
	}
	public function makeumd_volume($vk = 0)
	{
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		if (!function_exists('gzcompress') || !function_exists('iconv')) {
			return false;
		}
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		if (!isset($jieqiSort['article'])) {
			jieqi_getconfigs('article', 'sort');
		}
		include_once jieqi_path_lib('compress/umd.php');
		$umddir = $this->getDir('umddir', true);
		$vk = intval($vk);
		$vd = 1;
		$vc = 0.58;
		$vinfo = array();
		if (empty($vk) || $vk < $vd) {
			$umd = new JieqiUmd();
			$umd->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
			if (!empty($jieqiSort['article'][$this->metas['sortid']]['caption'])) {
				$sort = $jieqiSort['article'][$this->metas['sortid']]['caption'];
			} else {
				$sort = '';
			}
			$umd->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'], 'author' => $this->metas['author'], 'sort' => $sort, 'publisher' => JIEQI_SITE_NAME, 'corver' => ''));
			$volume = '';
			$fromvolume = '';
			$fromchapter = '';
			$fromchapterid = 0;
			$tovolume = '';
			$tochapter = '';
			$tochapterid = 0;
			$chapters = 0;
			$volumes = 0;
			$firstflag = true;
			foreach ($this->chapters as $k => $chapter) {
				if ($chapter['chaptertype'] == 1) {
					$volume = $chapter['chaptername'];
					if ($firstflag) {
						$fromvolume = $volume;
					}
					$tovolume = $volume;
					$volumes++;
				} else {
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$umd->addchapter($volume . ' ' . $chapter['chaptername'], '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\n" . $filedata);
					if ($fromchapter == '') {
						$fromchapter = $chapter['chaptername'];
					}
					$tochapter = $chapter['chaptername'];
					$tmpcid = intval($chapter['chapterid']);
					if ($fromchapterid == 0) {
						$fromchapterid = $tmpcid;
					}
					$tochapterid = $tmpcid;
					$chapters++;
				}
				$firstflag = false;
			}
			$umd->makeumd($umddir . '/' . $this->id . $jieqi_file_postfix['umd']);
			unset($umd);
			$vinfo['chapters'] = $chapters;
			$vinfo['volumes'] = $volumes;
			$vinfo['fromvolume'] = $fromvolume;
			$vinfo['fromchapter'] = $fromchapter;
			$vinfo['fromchapterid'] = $fromchapterid;
			$vinfo['tovolume'] = $tovolume;
			$vinfo['tochapter'] = $tochapter;
			$vinfo['tochapterid'] = $tochapterid;
			$vinfo['maketime'] = JIEQI_NOW_TIME;
			$vinfo['filesize'] = filesize($umddir . '/' . $this->id . $jieqi_file_postfix['umd']);
			include_once jieqi_path_lib('xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($umddir . '/' . $this->id . '.xml', $xmldata);
		} else {
			if ($vd < $vk) {
				$vid = 1;
				$vnew = true;
				$vsize = 0;
				$volume = '';
				foreach ($this->chapters as $k => $chapter) {
					if ($chapter['chaptertype'] == 1) {
						$volume = $chapter['chaptername'];
						$vinfo[$vid]['volumes']++;
					} else {
						$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
						$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
						$vcdata = '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\n";
						$filelen = strlen($filedata) + strlen($vcdata);
						if (0 < $vsize && $vk - $vd < ($vsize + $filelen) / 1024 * $vc) {
							$umd->makeumd($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
							unset($umd);
							$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
							$vinfo[$vid]['filesize'] = filesize($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
							$vid++;
							$vsize = 0;
							$vnew = true;
						}
						if ($vnew) {
							$umd = new JieqiUmd();
							$umd->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
							if (!empty($jieqiSort['article'][$this->metas['sortid']]['caption'])) {
								$sort = $jieqiSort['article'][$this->metas['sortid']]['caption'];
							} else {
								$sort = '';
							}
							$umd->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'] . '_' . $vk . '_' . $vid, 'author' => $this->metas['author'], 'sort' => $sort, 'publisher' => JIEQI_SITE_NAME, 'corver' => ''));
							$vnew = false;
							$vinfo[$vid]['chapters'] = 0;
							$vinfo[$vid]['volumes'] = 0;
							$vinfo[$vid]['fromvolume'] = $volume;
							$vinfo[$vid]['fromchapter'] = $chapter['chaptername'];
							$vinfo[$vid]['fromchapterid'] = intval($chapter['chapterid']);
						}
						$umd->addchapter($volume . ' ' . $chapter['chaptername'], $vcdata . $filedata);
						$vsize = $vsize + $filelen;
						$vinfo[$vid]['chapters']++;
						$vinfo[$vid]['tovolume'] = $volume;
						$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
						$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
					}
				}
				if (!$vnew) {
					$umd->makeumd($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
					$vinfo[$vid]['tovolume'] = $volume;
					$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
					$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
					$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
					$vinfo[$vid]['filesize'] = filesize($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
					unset($umd);
				}
				include_once jieqi_path_lib('xml/xmlarray.php');
				$xmlarray = new XMLArray();
				$xmldata = $xmlarray->array2xml($vinfo);
				jieqi_writefile($umddir . '/' . $this->id . '_' . $vk . '.xml', $xmldata);
			} else {
				return false;
			}
		}
	}
	public function makeumd()
	{
		global $jieqiConfigs;
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		if (!function_exists('gzcompress') || !function_exists('iconv')) {
			return false;
		}
		$jieqiConfigs['article']['makeumd'] = intval($jieqiConfigs['article']['makeumd']);
		if (empty($jieqiConfigs['article']['makeumd'])) {
			$jieqiConfigs['article']['makeumd'] = 1;
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 1)) {
			$this->makeumd_volume();
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 2)) {
			$this->makeumd_volume(64);
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 4)) {
			$this->makeumd_volume(128);
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 8)) {
			$this->makeumd_volume(256);
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 16)) {
			$this->makeumd_volume(512);
		}
		if (0 < ($jieqiConfigs['article']['makeumd'] & 32)) {
			$this->makeumd_volume(1024);
		}
	}
	public function makejar_volume($vk = 0)
	{
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		if (!function_exists('gzcompress') || !function_exists('iconv')) {
			return false;
		}
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		include_once jieqi_path_lib('compress/jar.php');
		$jardir = $this->getDir('jardir', true, true);
		$vk = intval($vk);
		$vd = intval(JIEQI_JAR_DEFAULT_SIZE);
		$vc = floatval(JIEQI_JAR_COMPRESS_RATE);
		$vinfo = array();
		if (empty($vk) || $vk < $vd) {
			$jar = new JieqiJar();
			$jar->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
			$jar->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'], 'author' => $this->metas['author'], 'publisher' => JIEQI_SITE_NAME, 'corver' => ''));
			$volume = '';
			$fromvolume = '';
			$fromchapter = '';
			$fromchapterid = 0;
			$tovolume = '';
			$tochapter = '';
			$tochapterid = 0;
			$chapters = 0;
			$volumes = 0;
			$firstflag = true;
			foreach ($this->chapters as $k => $chapter) {
				if ($chapter['chaptertype'] == 1) {
					$volume = $chapter['chaptername'];
					if ($firstflag) {
						$fromvolume = $volume;
					}
					$tovolume = $volume;
					$volumes++;
				} else {
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$jar->addchapter($volume . ' ' . $chapter['chaptername'], '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\r\n" . $filedata);
					if ($fromchapter == '') {
						$fromchapter = $chapter['chaptername'];
					}
					$tochapter = $chapter['chaptername'];
					$tmpcid = intval($chapter['chapterid']);
					if ($fromchapterid == 0) {
						$fromchapterid = $tmpcid;
					}
					$tochapterid = $tmpcid;
					$chapters++;
				}
				$firstflag = false;
			}
			$jar->makejar($jardir . '/' . $this->id . $jieqi_file_postfix['jar']);
			unset($jar);
			$vinfo['chapters'] = $chapters;
			$vinfo['volumes'] = $volumes;
			$vinfo['fromvolume'] = $fromvolume;
			$vinfo['fromchapter'] = $fromchapter;
			$vinfo['fromchapterid'] = $fromchapterid;
			$vinfo['tovolume'] = $tovolume;
			$vinfo['tochapter'] = $tochapter;
			$vinfo['tochapterid'] = $tochapterid;
			$vinfo['maketime'] = JIEQI_NOW_TIME;
			$vinfo['filesize'] = filesize($jardir . '/' . $this->id . $jieqi_file_postfix['jar']);
			$vinfo['jadsize'] = filesize($jardir . '/' . $this->id . $jieqi_file_postfix['jad']);
			include_once jieqi_path_lib('xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($jardir . '/' . $this->id . '.xml', $xmldata);
		} else {
			if ($vd < $vk) {
				$vid = 1;
				$vnew = true;
				$vsize = 0;
				$volume = '';
				foreach ($this->chapters as $k => $chapter) {
					if ($chapter['chaptertype'] == 1) {
						$volume = $chapter['chaptername'];
						$vinfo[$vid]['volumes']++;
					} else {
						$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
						$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
						$vcdata = '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\r\n";
						$filelen = strlen($filedata) + strlen($vcdata);
						if (0 < $vsize && $vk - $vd < ($vsize + $filelen) / 1024 * $vc) {
							$jar->makejar($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
							unset($jar);
							$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
							$vinfo[$vid]['filesize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
							$vinfo[$vid]['jadsize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jad']);
							$vid++;
							$vsize = 0;
							$vnew = true;
						}
						if ($vnew) {
							$jar = new JieqiJar();
							$jar->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
							$jar->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'] . '_' . $vk . '_' . $vid, 'author' => $this->metas['author'], 'publisher' => JIEQI_SITE_NAME, 'corver' => ''));
							$vnew = false;
							$vinfo[$vid]['chapters'] = 0;
							$vinfo[$vid]['volumes'] = 0;
							$vinfo[$vid]['fromvolume'] = $volume;
							$vinfo[$vid]['fromchapter'] = $chapter['chaptername'];
							$vinfo[$vid]['fromchapterid'] = intval($chapter['chapterid']);
						}
						$jar->addchapter($volume . ' ' . $chapter['chaptername'], $vcdata . $filedata);
						$vsize = $vsize + $filelen;
						$vinfo[$vid]['chapters']++;
						$vinfo[$vid]['tovolume'] = $volume;
						$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
						$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
					}
				}
				if (!$vnew) {
					$jar->makejar($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
					$vinfo[$vid]['tovolume'] = $volume;
					$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
					$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
					$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
					$vinfo[$vid]['filesize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
					$vinfo[$vid]['jadsize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jad']);
					unset($jar);
				}
				include_once jieqi_path_lib('xml/xmlarray.php');
				$xmlarray = new XMLArray();
				$xmldata = $xmlarray->array2xml($vinfo);
				jieqi_writefile($jardir . '/' . $this->id . '_' . $vk . '.xml', $xmldata);
			} else {
				return false;
			}
		}
	}
	public function makejar()
	{
		global $jieqiConfigs;
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		if (!function_exists('gzcompress') || !function_exists('iconv')) {
			return false;
		}
		$jieqiConfigs['article']['makejar'] = intval($jieqiConfigs['article']['makejar']);
		if (empty($jieqiConfigs['article']['makejar'])) {
			$jieqiConfigs['article']['makejar'] = 1;
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 1)) {
			$this->makejar_volume();
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 2)) {
			$this->makejar_volume(64);
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 4)) {
			$this->makejar_volume(128);
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 8)) {
			$this->makejar_volume(256);
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 16)) {
			$this->makejar_volume(512);
		}
		if (0 < ($jieqiConfigs['article']['makejar'] & 32)) {
			$this->makejar_volume(1024);
		}
	}
	public function makepack()
	{
		if ((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && empty($GLOBALS['jieqi_license_modules']['waparticle']) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') {
			return true;
		}
		global $jieqiConfigs;
		global $jieqiModules;
		$article_static_url = empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
		$url = $article_static_url . '/makepack.php?key=' . urlencode(md5(JIEQI_DB_USER . JIEQI_DB_PASS . JIEQI_DB_NAME)) . '&id=' . intval($this->id);
		$url = trim($url);
		if (strtolower(substr($url, 0, 7)) != 'http://') {
			$url = 'http://' . $_SERVER['HTTP_HOST'] . $url;
		}
		$tmpurl = $url;
		if ($jieqiConfigs['article']['makezip']) {
			$url .= '&packflag[]=makezip';
		}
		if ($jieqiConfigs['article']['makefull']) {
			$url .= '&packflag[]=makefull';
		}
		if ($jieqiConfigs['article']['maketxtfull']) {
			$url .= '&packflag[]=maketxtfull';
		}
		if ($jieqiConfigs['article']['makeumd']) {
			$url .= '&packflag[]=makeumd';
		}
		if ($jieqiConfigs['article']['makejar']) {
			$url .= '&packflag[]=makejar';
		}
		if ($url == $tmpurl) {
			return true;
		} else {
			return jieqi_socket_url($url);
		}
	}
	public function makepack_dist()
	{
		global $jieqiConfigs;
		if ($jieqiConfigs['article']['makezip']) {
			$this->makezip();
		}
		if ($jieqiConfigs['article']['makefull']) {
			$this->makefulltext();
		}
		if ($jieqiConfigs['article']['maketxtfull']) {
			$this->maketxtfull();
		}
		if ($jieqiConfigs['article']['makeumd']) {
			$this->makeumd();
		}
		if ($jieqiConfigs['article']['makejar']) {
			$this->makejar();
		}
	}
	public function addChapter($chapter, &$content, $article = NULL)
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));
		jieqi_save_achapterc($this->id, $chapterid, $content, $isvip, $chaptertype);
		if (!$this->isload) {
			$this->loadOPF();
		}
		$articlename = jieqi_htmlstr($this->metas['articlename']);
		if (is_object($article)) {
			$this->metas = $article->getVars('n');
		}
		$chaptercount = jieqi_count($this->chapters);
		if (0 < $chapterorder) {
			if ($chaptercount < $chapterorder) {
				$chapterorder = $chaptercount + 1;
			} else {
				while ($chapterorder <= $chaptercount && $this->chapters[$chapterorder - 1]['chaptertype'] != 1) {
					$chapterorder++;
				}
			}
		} else {
			$chapterorder = $chaptercount + 1;
		}
		if ($chaptercount < $chapterorder) {
			$this->chapters[] = $chapter->getVars('n');
		} else {
			for ($i = $chaptercount; $chapterorder <= $i; $i--) {
				$this->chapters[$i] = $this->chapters[$i - 1];
			}
			$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		}
		$this->createOPF();
		$this->nowid = $chapterorder;
		if ($jieqiConfigs['article']['makehtml']) {
			$this->makeIndex();
			if (!$chaptertype) {
				if (0 < $this->preid) {
					$this->makeHtml($this->preid);
				}
				if (0 < $this->nextid) {
					$this->makeHtml($this->nextid);
				}
				$this->makeHtml($this->nowid);
			}
		}
		if (!$chaptertype && !$isvip) {
			if ($jieqiConfigs['article']['maketxtjs']) {
				$this->makeTxtjs($this->nowid);
			}
			$this->makepack();
		}
	}
	public function editChapter($chapter, &$content)
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));
		jieqi_edit_achapterc($this->id, $chapterid, $content, $isvip, $chaptertype);
		$this->loadOPF();
		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		$this->createOPF();
		$this->nowid = $chapterorder;
		if ($jieqiConfigs['article']['makehtml']) {
			$this->makeIndex();
			if (!$chaptertype && !$isvip) {
				$this->makeHtml($this->nowid);
			}
		}
		if (!$chaptertype && !$isvip) {
			if ($jieqiConfigs['article']['maketxtjs']) {
				$this->makeTxtjs($this->nowid);
			}
			$this->makepack();
		}
	}
	public function setChapter($chapter)
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));
		$this->loadOPF();
		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		$this->createOPF();
		$this->nowid = $chapterorder;
		if ($jieqiConfigs['article']['makehtml']) {
			$this->makeIndex();
			if (!$chaptertype) {
				if (0 < $this->preid) {
					$this->makeHtml($this->preid);
				}
				if (0 < $this->nextid) {
					$this->makeHtml($this->nextid);
				}
				$this->makeHtml($this->nowid);
			}
		}
		if (!$chaptertype && !$isvip) {
			if ($jieqiConfigs['article']['maketxtjs']) {
				$this->makeTxtjs($this->nowid);
			}
			$this->makepack();
		}
	}
	public function delChapter($chapter)
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$txtjsdir = $this->getDir('txtjsdir', true, false);
		jieqi_delete_achapterc($this->id, $chapterid, $isvip, $chaptertype);
		if ($isvip == 0 && file_exists($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js'])) {
			jieqi_delfile($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js']);
		}
		$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
		if (is_dir($attachdir)) {
			jieqi_delfolder($attachdir);
		}
		$this->loadOPF();
		$chaptercount = jieqi_count($this->chapters);
		for ($i = $chapterorder; $i < $chaptercount; $i++) {
			$this->chapters[$i - 1] = $this->chapters[$i];
		}
		array_pop($this->chapters);
		$this->createOPF();
		if ($jieqiConfigs['article']['makehtml']) {
			if ($chaptercount <= $chapterorder) {
				$chapterorder = $chaptercount - 1;
			}
			$this->nowid = $chapterorder;
			$this->makeIndex();
			$htmldir = $this->getDir('htmldir', true, false);
			if (file_exists($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile'])) {
				jieqi_delfile($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile']);
			}
			if (0 < $this->preid) {
				$this->makeHtml($this->preid);
			}
			if ($this->chapters[$chapterorder - 1]['chaptertype'] != 1) {
				$this->makeHtml($chapterorder);
			} else {
				if (0 < $this->nextid) {
					$this->makeHtml($this->nextid);
				}
			}
		}
		$this->makepack();
	}
	public function sortChapter($fromid, $toid)
	{
		global $jieqiConfigs;
		$this->loadOPF();
		$chaptercount = jieqi_count($this->chapters);
		if ($fromid < 1 || $chaptercount < $fromid || $toid < 0 || $chaptercount < $toid) {
			return false;
		}
		if ($fromid == $toid || $fromid == $toid + 1) {
			return true;
		}
		if ($this->chapters[$fromid - 1]['chaptertype'] == 1) {
			$type = 0;
		} else {
			$type = 1;
		}
		if ($fromid < $toid) {
			$tmpvar = $this->chapters[$fromid - 1];
			for ($i = $fromid; $i < $toid; $i++) {
				$this->chapters[$i - 1] = $this->chapters[$i];
			}
			$this->chapters[$toid - 1] = $tmpvar;
		} else {
			$tmpvar = $this->chapters[$fromid - 1];
			for ($i = $fromid - 1; $toid < $i; $i--) {
				$this->chapters[$i] = $this->chapters[$i - 1];
			}
			$this->chapters[$toid] = $tmpvar;
		}
		$this->createOPF();
		if ($jieqiConfigs['article']['makehtml']) {
			$this->makeIndex();
			if ($type) {
				if ($toid < $fromid) {
					$toid++;
				}
				$chgarray = array();
				if ($this->chapters[$fromid - 1]['chaptertype'] != 1) {
					$this->makeHtml($fromid);
					$chgarray[] = $fromid;
				}
				if ($this->chapters[$toid - 1]['chaptertype'] != 1) {
					$this->makeHtml($toid);
					$chgarray[] = $toid;
				}
				$preid = 0;
				$nextid = 0;
				for ($i = 1; $i <= $chaptercount; $i++) {
					if ($this->chapters[$i - 1]['chaptertype'] != 1) {
						if ($i < $fromid) {
							$preid = $i;
						} else {
							if ($fromid < $i && $nextid == 0) {
								$nextid = $i;
								$i = $chaptercount + 1;
							}
						}
					}
				}
				if (0 < $preid) {
					if (!in_array($preid, $chgarray)) {
						$this->makeHtml($preid);
						$chgarray[] = $preid;
					}
				}
				if (0 < $nextid) {
					if (!in_array($nextid, $chgarray)) {
						$this->makeHtml($nextid);
						$chgarray[] = $nextid;
					}
				}
				$preid = 0;
				$nextid = 0;
				for ($i = 1; $i <= $chaptercount; $i++) {
					if ($this->chapters[$i - 1]['chaptertype'] != 1) {
						if ($i < $toid) {
							$preid = $i;
						} else {
							if ($toid < $i && $nextid == 0) {
								$nextid = $i;
								$i = $chaptercount + 1;
							}
						}
					}
				}
				if (0 < $preid) {
					if (!in_array($preid, $chgarray)) {
						$this->makeHtml($preid);
						$chgarray[] = $preid;
					}
				}
				if (0 < $nextid) {
					if (!in_array($nextid, $chgarray)) {
						$this->makeHtml($nextid);
						$chgarray[] = $nextid;
					}
				}
			}
			$this->makepack();
		}
	}
	public function delete()
	{
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		jieqi_delete_achapterc($this->id, -1);
		$deldir = $this->getDir('opfdir', true, false);
		if (is_dir($deldir)) {
			jieqi_delfolder($deldir);
		}
		if (is_dir('.' . $deldir)) {
			jieqi_delfolder('.' . $deldir);
		}
		if ($jieqiConfigs['article']['makehtml']) {
			$deldir = $this->getDir('htmldir', true, false);
			if (is_dir($deldir)) {
				jieqi_delfolder($deldir);
			}
			if (is_dir('.' . $deldir)) {
				jieqi_delfolder('.' . $deldir);
			}
		}
		if ($jieqiConfigs['article']['makefull']) {
			$delfile = $this->getDir('fulldir', false, false) . '/' . $this->id . $jieqiConfigs['article']['htmlfile'];
			if (is_file($delfile)) {
				jieqi_delfile($delfile);
			}
			if (is_file('.' . $delfile)) {
				jieqi_delfile('.' . $delfile);
			}
		}
		if ($jieqiConfigs['article']['maketxtjs']) {
			jieqi_delfolder($this->getDir('txtjsdir', true, false));
		}
		if ($jieqiConfigs['article']['makezip']) {
			jieqi_delfile($this->getDir('zipdir', false, false) . '/' . $this->id . $jieqi_file_postfix['zip']);
		}
		if ($jieqiConfigs['article']['maketxtfull']) {
			jieqi_delfile($this->getDir('txtfulldir', false, false) . '/' . $this->id . $jieqi_file_postfix['txt']);
		}
		if ($jieqiConfigs['article']['makeumd']) {
			jieqi_delfolder($this->getDir('umddir', true, false));
		}
		if ($jieqiConfigs['article']['makejar']) {
			jieqi_delfolder($this->getDir('jardir', true, false));
			jieqi_delfolder($this->getDir('jardir', true, false));
		}
		$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id;
		if (is_dir($attachdir)) {
			jieqi_delfolder($attachdir);
		}
	}
	public function repack()
	{
		if (!$this->isload) {
			$this->loadOPF();
		}
		$this->createOPF();
	}
}
