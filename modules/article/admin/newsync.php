<?php
@ignore_user_abort(true);
@set_time_limit(0);
@session_write_close();

require_once ("../../../global.php");

if($_SERVER['argv']['1']){
	$id = str_replace("id=","",$_SERVER['argv']['1']);
}else{
	$id = intval($_GET['id']);
}



$log_path = JIEQI_ROOT_PATH."/files/sync/json".$id.'/';
if(!is_readable($log_path))  
{  
	if(!is_dir($log_path)){
        mkdir($log_path,0777,true);
	}
} 

$logfile = $log_path.date('y_m_d').'.log';

$log_file_size = '5242880';

//检测日志文件大小，超过配置大小则备份日志文件重新生成
if(is_file($logfile) && floor($log_file_size) <= filesize($logfile)){
	rename($logfile,$log_path.time().'-'.basename($logfile));
}

if(empty($id)){
	file_put_contents($logfile, date('Y-m-d H:i:s')."同步 id 为空".PHP_EOL, FILE_APPEND);
	echo "id 不能为空";
	exit();
}

jieqi_getconfigs("article", "syncsite", "syncsite");
jieqi_getconfigs("article", "sync_".$syncsite[$id]['config']."_site", "sync");
if($sync["config"]=="yuelu"){
	$sid = 28;
}elseif($sync["config"]=="shucong"){
	$sid = 30;
}else{
	$sid = $id;
}

$key = $sync['key'];
$uptime = $sync['uptime'];

include_once jieqi_path_inc("include/funsync2.php", "article");
include_once jieqi_path_lib("text/textfunction.php");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

jieqi_getconfigs("article", "configs");
jieqi_getconfigs("system", "setting", "jieqiSetting");
jieqi_getconfigs('article', 'sort', 'jieqiSort');

$sort_list = array(1=>8,2=>13,3=>3,4=>8,5=>9,6=>1,7=>18,8=>14,9=>10,10=>11,11=>5,12=>9,13=>9,14=>15,15=>15);
//获取列表
$page=1;
do {
    if (!$uptime) {
       $para = 'page='.$page.'&sid='.$sid; 
    } else {
        $para = 'page='.$page.'&sid='.$sid.'&uptime='.$uptime;
    }
	
	//阅路
	if($sync["config"]=="yuelu"){
		$cp_id = $sync["sid"];
		$key =$sync["key"];
		$apikey=md5($cp_id.$key);
		$url = str_replace(array("{cp_id}","{api_key}"),array($cp_id,$apikey),$sync['alist']);
	}else{
		$sign = md5($para.'&key='.$key);
		$url = $sync['alist'].'?'.$para.'&sign='.$sign;
	}
    
    //echo $url;

	if($sync["format"]=="xml"){
		$xml =jieqi_sync_geturlcontent($url);
		$result =json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		$list = $result["items"]["item"];
	}else{
		$result = json_decode(jieqi_sync_geturlcontent($url),true);
		$list = $result['data'];
	}
	
	if(empty($list)){
		file_put_contents($logfile, date('Y-m-d H:i:s')."小说列表为空，同步失败".PHP_EOL, FILE_APPEND);
		jieqi_printfail("小说列表为空，同步失败");
	}

    foreach ($list as $k=>$v) {
		
		$aindex = $k + 1;
		$sourceupdate = time();

		if($sync["config"]=="yuelu"){
			$articleid = $v['book_id'];
			$apikey=md5($cp_id.$key.$articleid);
			
			$url = str_replace(array("{cp_id}","{api_key}","{book_id}"),array($cp_id,$apikey,$articleid),$sync['ainfo']);
		}elseif($sync["config"]=="shucong"){
			$articleid = $v['bookid'];
			$url = str_replace("{bookid}",$articleid,$sync['ainfo']);
		}else{
			$articleid = $v['articleid'];
			$para = 'BookId='.$v['articleid'];
			$url = $sync['ainfo'].$para;
		}
		
		
		//echo $url.PHP_EOL;
		//exit();
		if($sync["format"]=="xml"){
			$articleinfodata =json_decode(json_encode(simplexml_load_string(jieqi_sync_geturlcontent($url), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		}else{
			$articleinfodata = json_decode(jieqi_sync_geturlcontent($url),true);
		}
		
		
		if($sync["config"]=="yuelu"){
			$articledata = $articleinfodata['data'];
		}elseif($sync["config"]=="shucong"){
			$articledata = $articleinfodata["info"];
		}else{
			$articledata = $articleinfodata['data'][0];
			
			if(empty($articledata)){
				$articledata = $articleinfodata['data'];
			}
		}
		
		
		if($sync["config"]=="yuelu"){
			$articledata["articleid"] = $articledata["book_id"];
			$articledata["articlename"] =$articledata["book_name"];
			$articledata["author"] = $articledata["author_name"];
			$articledata["words"] =$articledata["book_word_count"];
			$articledata["keywords"] =str_replace("&",",",$articledata["book_tags"]);
			$articledata["intro"] = $articledata["introduction"];
			$articledata["cover"] =$articledata["cover_url"];
			$articledata["fullflag"] =$articledata["book_state"];
			$articledata["isvip"] =$articledata["book_need_pay"];
		}elseif($sync["config"]=="shucong"){
			$articledata["articleid"] = $articledata["bookid"];
			$articledata["articlename"] =$articledata["title"];
			$articledata["words"] =$articledata["size"];
			$articledata["keywords"] =$articledata["category"].",".$articledata["second_category"];
			$articledata["intro"] = $articledata["comment"];
			$articledata["cover"] =$articledata["image_small"];
			
		}

		
		
		$sync_article = array();

		$sync_article["siteid"] = $sid;
		$sync_article["sourceid"] = $articledata["articleid"];
		$sync_article["lastupdate"] = $sourceupdate;

		if($sync["config"]=="yuelu"){
			$correspond=array(
				1=>9,
				2=>8,
				3=>9,
				4=>9,
				5=>9,
				6=>9,
				7=>5,
				8=>6,
				9=>7,
				10=>9,
				11=>3,
				12=>3,
				13=>1,
				14=>2,
				15=>6,
				16=>4,
				17=>6,
				18=>7
			);
			
			$sync_article["sortid"] =$correspond[$articledata["book_category_id"]];
			$sync_article["rgroup"] =$jieqiSort['article'][$correspond[$articledata["book_category_id"]]]["rgroup"];
		}elseif($sync["config"]=="shucong"){
			$cate=array(
				1=>1,
				2=>3,
				3=>5,
				4=>6,
				5=>2,
				6=>4,
				7=>4,
				101=>8,
				102=>9,
				103=>9,
				104=>8,
				105=>8,
				106=>5
			);
			if(array_key_exists($articledata["sortid"],$cate)){
				$sync_article["sortid"] =$cate[$articledata["sortid"]];
			}else{
				$sync_article["sortid"] =1;
			}
		}else{
			$sync_article["sortid"] = isset($sort_list[intval($articledata["Sortid"])]) ? $sort_list[intval($articledata["Sortid"])] : $sort_list[1];
			$sync_article["rgroup"] = $jieqiSort['article'][$sync_article["sortid"]]['group'];
		}
		
		$sync_article["typeid"] = 0;
		if ( isset($articledata["type"]) && is_array($jieqiSetting["type"])) {
				$sync_article["typeid"] = (isset($jieqiSetting["type"][$articledata["type"]]) ? intval($jieqiSetting["type"][$articledata["type"]]) : intval($jieqiSetting["type"]["default"]));
		}
		
		if($sync["config"]=="yuelu"){
			$sync_article["posterid"] = 28;
			$sync_article["poster"] = "阅路";
		}elseif($sync["config"]=="shucong"){
			$sync_article["posterid"] = $sid;
			$sync_article["poster"] = "品书";
		}
		$sync_article["articlename"] = $articledata["articlename"];
		$sync_article["author"] = $articledata["author"];
		$sync_article["authorid"] = $articledata["authorid"];
		$sync_article["keywords"] = $articledata["keywords"];
		$sync_article["permission"] = 0;
		$sync_article["firstflag"] = 0;
		$sync_article["intro"] = $articledata["intro"];
		$sync_article["size"] = $articledata["words"];
		$sync_article["notice"] = (isset($articledata["notice"]) ? $articledata["notice"] : "");
		$sync_article["cover"] = (isset($articledata["cover"]) ? $articledata["cover"] : "");
		$sync_article["fullflag"] = intval($articledata["fullflag"]);
		$sync_article["isvip"] = intval($articledata["isvip"]);
		
		if (empty($sync_article["articlename"])) {
			file_put_contents($logfile, date('Y-m-d H:i:s')."小说ID:".$articleid."接口数据为空，同步失败".PHP_EOL, FILE_APPEND);
			jieqi_printfail($jieqiLang["article"]["sync_savearticle_failure"]);
		}
		
		
		$myarticle = jieqi_sync_articleinfo($sync_article);

		if (!is_object($myarticle)) {
			jieqi_printfail($jieqiLang["article"]["sync_savearticle_failure"]);
		}
		file_put_contents($logfile, date('Y-m-d H:i:s')." - 同步小说(".$aindex."/".count($list).")<".$sync_article["articlename"].">\r\n", FILE_APPEND);
		
		//获取章节列表
		//$para = 'aid='.$v['articleid'].'&sid='.$sid;
		//$sign = md5($para.'&key='.$key);
		//$url = $sync['clist'].'?'.$para.'&sign='.$sign;
		 
		if($sync["config"]=="yuelu"){
			$apikey=md5($cp_id.$key.$v["book_id"]);
			$url = str_replace(array("{cp_id}","{api_key}","{book_id}"),array($cp_id,$apikey,$v["book_id"]),$sync['clist']);
			$chapterlist = json_decode(jieqi_sync_geturlcontent($url),true);
			
            $chapterlist = $chapterlist["data"];
			if($chapterlist){
				$i=1;
				$j=0;
				$chapterlistdata = array();
				foreach ($chapterlist as $ck=>$cv){
					foreach ($cv["chapters"] as $ko=>$vo){
						$chapterlistdata[] = array(
							"chapterid"=>$vo["chapter_id"],
							"chaptername"=>$vo["chapter_name"],
							"words"=>$vo["chapter_word_count"],
							"chapterorder"=>$i,
							"isvip"=>$vo["chapter_need_pay"],
							"chaptertype"=>0,
							"summary"=>"",
							"lastupdate"=>$vo["chapter_last_update_time"]
						);
						$i++;
					}
					
				}
			}
		}elseif($sync["config"]=="shucong"){
			$url = str_replace("{bookid}",$articleid,$sync['clist']);
			
			$chapterlistdata = json_decode(json_encode(simplexml_load_string(jieqi_sync_geturlcontent($url), 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			$chapterlistdata = $chapterlistdata["items"]["item"];
		}else{
			$para = 'BookId='.$v['articleid'];
			$url = $sync['clist'].$para;
			$chapterlistdata = json_decode(jieqi_sync_geturlcontent($url),true);
            $chapterlistdata = $chapterlistdata['data'];
		}
		
            //echo $url;
		
            
			
            if (count($chapterlistdata)>1) {
                $sync_chapters = null;
                foreach ($chapterlistdata as $k => $chapterone ) {
					
					if($sync["config"]=="shucong"){
						$sync_chapters[$k]["siteid"] = $sid;
						$sync_chapters[$k]["sourceid"] = $sync_article["sourceid"];
						$sync_chapters[$k]["sourcecid"] = $chapterone["cid"];
						
						$sync_chapters[$k]["chapterorder"] = $k + 1;
						$sync_chapters[$k]["articleid"] = $myarticle->getVar("articleid", "n");
						$sync_chapters[$k]["chaptername"] = $chapterone["chaptername"];
						$sync_chapters[$k]["size"] = 0;
						$sync_chapters[$k]["postdate"] = $chapterone["postdate"];
						$sync_chapters[$k]["lastupdate"] = $chapterone["lastupdate"];
						$sync_chapters[$k]["isvip"] = intval($chapterone["isvip"]);
						$sync_chapters[$k]["chaptertype"] = intval($chapterone["chaptertype"]);
						
					}else{
						$chapterone["chaptername"] =$chapterone["chaptername"];
						$chapterone["summary"] = $chapterone["summary"];
						$sync_chapters[$k]["siteid"] = $sid;
						$sync_chapters[$k]["sourceid"] = $sync_article["sourceid"];
						$sync_chapters[$k]["sourcecid"] = $chapterone["chapterid"];
						$sync_chapters[$k]["sourcecorder"] = $chapterone["chapterorder"];
						$sync_chapters[$k]["chapterorder"] = $k + 1;
						$sync_chapters[$k]["articleid"] = $myarticle->getVar("articleid", "n");
						$sync_chapters[$k]["chaptername"] = $chapterone["chaptername"];
						$sync_chapters[$k]["size"] = $chapterone["words"] * 3;
						$sync_chapters[$k]["lastupdate"] = $chapterone["lastupdate"];
						$sync_chapters[$k]["isvip"] = intval($chapterone["isvip"]);
						$sync_chapters[$k]["saleprice"] = round($chapterone["words"]/1000*5);
						$sync_chapters[$k]["pages"] = intval($chapterone["pages"]);
						$sync_chapters[$k]["chaptertype"] = intval($chapterone["chaptertype"]);
						$sync_chapters[$k]["summary"] = $chapterone["summary"];
                    }
					if($sync["config"]=="yuelu"){
						$apikey=md5($cp_id.$key.$v["book_id"].$chapterone["chapterid"]);
						$url_content = str_replace(array("{cp_id}","{api_key}","{book_id}","{chapter_id}"),array($cp_id,$apikey,$v["book_id"],$chapterone["chapterid"]),$sync['content']);
						$sync_chapters[$k]["url_content"] =$url_content;
					}elseif($sync["config"]=="shucong"){
						$sync_chapters[$k]["url_content"] =$chapterone["chapterurl"];
					}else{
						$para = 'BookId='.$v['articleid'].'/ChapterId='.$chapterone['chapterid'];
						$sync_chapters[$k]["url_content"] = $sync['content'].$para;
					}
                }
               
                    $myarticleid = intval($myarticle->getVar("articleid", "n"));
                    $up_chapternum = 0;
                    $old_chapters = array();
                    $map_cids = array();
                    $sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = $myarticleid ORDER BY chapterorder ASC";
                    $query->execute($sql);
                    $k = 0;

                    while ($row = $query->getRow()) {
                        if ($row["sourcecid"] == 0) {
                                $cidx = "i" . $row["chapterid"];
                        }
                        else if (0 < $row["chaptertype"]) {
                                $cidx = "v" . $row["sourcecid"];
                        }
                        else {
                                $cidx = "c" . $row["sourcecid"];
                        }

                        $map_cids[$cidx] = array("key" => $k, "check" => 0, "chapterid" => $row["chapterid"], "isvip" => $row["isvip"], "chaptertype" => $row["chaptertype"]);
                        $old_chapters[$k] = $row;
                        $k++;
                    }
                    
                    $up_corders = array();

                    foreach ($sync_chapters as $sk => $sv ) {
                        $cidx = (0 < $sv["chaptertype"] ? "v" . intval($sv["sourcecid"]) : "c" . intval($sv["sourcecid"]));

                        if (isset($map_cids[$cidx])) {
                                $ret = jieqi_sync_chapterupdate($sv, $old_chapters[$map_cids[$cidx]["key"]],$sync["format"],$logfile);

                                if ($ret === true) {
                                        $up_chapternum++;
                                        $up_corders[] = $sv["chapterorder"];
                                        file_put_contents($logfile, date('Y-m-d H:i:s')." - 更新章节(".($sk + 1)."/".count($sync_chapters).")<".$sync_article["articlename"]."> ".$sv['chaptername']."\r\n", FILE_APPEND);

                                }
                                else if (is_string($ret)) {
                                        $check_allchapters = $ret;
                                        break;
                                }

                                $map_cids[$cidx]["check"] = 1;
                        }
                        else {
                                $ret = jieqi_sync_chapternew($sv, $myarticle,$sync["format"],$logfile);

                                if ($ret === true) {
                                        $up_chapternum++;
                                        $up_corders[] = $sv["chapterorder"];
                                        file_put_contents($logfile, date('Y-m-d H:i:s')." - 同步章节(".($sk + 1)."/".count($sync_chapters).")<".$sync_article["articlename"]."> ".$sv['chaptername']."\r\n", FILE_APPEND);
                                }
                                else {
                                        $check_allchapters = $ret;
                                        break;
                                }
                        }
                    }
                    
                    if ($check_allchapters === true) {
                        $del_cids = array();

                        foreach ($map_cids as $vv ) {
                                if ($vv["check"] == 0) {
                                        $del_cids[] = $vv;
                                }
                        }

                        if (0 < count($del_cids)) {
                                $up_chapternum += count($del_cids);
                                jieqi_sync_delchapters($del_cids, $myarticle);
                        }
                    }
                    
                    if (0 < $up_chapternum) {
                        include_once jieqi_path_inc("include/actarticle.php", "article");
                        $lastinfo = jieqi_article_searchlast($myarticle, "full");
                        $sql = $query->makeupsql(jieqi_dbprefix("article_article"), $lastinfo, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
                        $query->execute($sql);
                        if ((0 < $myarticle->getVar("vipid", "n")) || (0 < $lastinfo["isvip"])) {
                                $lastobook = array("lastupdate" => $lastinfo["viptime"], "chapters" => $lastinfo["vipchapters"], "size" => $lastinfo["vipsize"], "lastvolumeid" => $lastinfo["vipvolumeid"], "lastvolume" => $lastinfo["vipvolume"], "lastchapterid" => $lastinfo["vipchapterid"], "lastchapter" => $lastinfo["vipchapter"], "lastsummary" => $lastinfo["vipsummary"]);
                                $sql = $query->makeupsql(jieqi_dbprefix("obook_obook"), $lastobook, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
                                $query->execute($sql);
                        }

                        include_once jieqi_path_inc("include/repack.php", "article");
                        article_repack($myarticleid, array("makeopf" => 1), 1);
                        $package = new JieqiPackage($myarticleid);
                        $package->loadOPF();
                        $makeparams = array("makezip" => intval($jieqiConfigs["article"]["makezip"]), "makefull" => intval($jieqiConfigs["article"]["makefull"]), "maketxtfull" => intval($jieqiConfigs["article"]["maketxtfull"]), "makeumd" => intval($jieqiConfigs["article"]["makeumd"]), "makejar" => intval($jieqiConfigs["article"]["makejar"]), "makeindex" => intval($jieqiConfigs["article"]["makehtml"]));
                        if (empty($del_cids) && !empty($up_corders)) {
                            $make_orders = array();
                            $max_order = count($sync_chapters);
                        }
                        else {
                            $makeparams["makechapter"] = intval($jieqiConfigs["article"]["makehtml"]);
                            $makeparams["maketxtjs"] = intval($jieqiConfigs["article"]["maketxtjs"]);
                        }
                    }
                file_put_contents($logfile, date('Y-m-d H:i:s')." - 同步完成(".$aindex."/".count($list).")<".$sync_article["articlename"].">\r\n\r\n", FILE_APPEND);

            } else {
                $sql = "update " . jieqi_dbprefix("article_article") . " set lastupdate=0 WHERE sourceid = " . $v['articleid'] . " LIMIT 0, 1";
                $query->execute($sql);
            }
		
    }
    $count = count($list);
    ++$page;
} while (true);
//} while ($count>=100);



