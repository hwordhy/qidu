<?php
	define('JIEQI_MODULE_NAME', 'article');
	require_once ('../../../global.php');
	jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
	jieqi_checkpower($jieqiPower['article']['manageallarticle'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
	jieqi_loadlang('share', JIEQI_MODULE_NAME);
	jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
	$siteid = intval($_GET['id']);
	if(empty($siteid)){
		jieqi_printfail("��������");
		exit();
	}
	$act = $_REQUEST['act'];
	
	include_once ($jieqiModules["article"]["path"] . "/include/funsync2.php");
	include JIEQI_ROOT_PATH . "/configs/article/syncsite.php";
	include JIEQI_ROOT_PATH . "/configs/article/sync_" . $syncsite[$siteid]['config'] . "_site.php";
	$sid = $sync['sid'];
	$key = $sync['key'];
	$page = 1;
	$para = 'page=' . $page . '&sid=' . $sid;

	if($act == "articlelist"){
		$sign = md5($para . '&key=' . $key);
		$url = $sync['alist'] . '?' . $para . '&sign=' . $sign;
		$list = json_decode(jieqi_sync_geturlcontent($url) , true);
		if(array_key_exists("data",$list)){
			if($list['data']){
				$data = array();
				foreach ($list['data'] as $k=>&$v){
					if($siteid==4){
						$data[$k] = $v;
						$data[$k]['link'] = str_replace("{book_id}",$v['articleid'],$sync['ainfo']);
					}else{
						$para = 'aid=' . $v['articleid'] . '&sid=' . $sid . '';
						$sign = md5($para . '&key=' . $key);
						$v['link'] = $sync['ainfo'] . '?' . $para . '&sign=' . $sign;
					}
					
				}
			}
			echo json_encode(array("Success"=>1,"Data"=>$data));
			
		}else{
			if($list){
				foreach ($list as $k=>&$v){
					$para = 'aid=' . $v['articleid'] . '&sid=' . $sid . '';
					$sign = md5($para . '&key=' . $key);
					$v['link'] = $sync['ainfo'] . '?' . $para . '&sign=' . $sign;
				}
			}
			echo json_encode(array("Success"=>1,"Data"=>$list));
			
		}
		exit();
	}elseif($act == "articleinfo"){
		if($siteid==4){
			$articleid = $_REQUEST['articleid'];
			$url = str_replace("{book_id}",$articleid,$sync['ainfo']);
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			echo json_encode(array("Success"=>1,"Data"=>$list['data']));
		}else{
			$articleid = $_REQUEST['articleid'];
			$para = 'aid=' . $articleid . '&sid=' . $sid . '';
			$sign = md5($para . '&key=' . $key);
			$url = $sync['ainfo'] . '?' . $para . '&sign=' . $sign;
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			echo json_encode(array("Success"=>1,"Data"=>$list));
		}
		exit();
	}elseif($act == "chapterlist"){
		$articleid = $_REQUEST['articleid'];
		if($siteid==4){
			$url = str_replace("{book_id}",$articleid,$sync['clist']);
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			$chapterdata = array();
			if($list){
				foreach ($list['data'] as $k=>$v){
					$chapterid = $v["chapterid"];
					$chapterdata[$k] = $v;
					$chapterdata[$k]['link'] =str_replace(array("{book_id}","{chapter_id}"),array($articleid,$chapterid),$sync['content']);
				}
			}
			echo json_encode(array("Success"=>1,"Data"=>$chapterdata));
		}else{
			$para = 'aid=' . $articleid . '&sid=' . $sid;
			$sign = md5($para . '&key=' . $key);
			$url = $sync['clist'] . '?' . $para . '&sign=' . $sign;
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			if($list){
				foreach ($list as $k=>&$v){
					$para = 'aid=' . $articleid . '&cid=' . $v['chapterid'] . '&sid=' . $sid;
					$sign = md5($para . '&key=' . $key);
					$v['link'] = $sync['content'].'?'.$para.'&sign=' . $sign;
				}
			}
			echo json_encode(array("Success"=>1,"Data"=>$list));
			
		}
		exit();
	}elseif($act == "chapter"){
		$articleid = $_REQUEST['articleid'];
		$chapterid = $_REQUEST['chapterid'];

		if($siteid==4){
			$url =  str_replace(array("{book_id}","{chapter_id}"),array($articleid,$chapterid),$sync['content']);
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			echo json_encode(array("Success"=>1,"Data"=>$list["data"]));
		}else{			
			$para = 'aid=' . $articleid . '&cid=' . $chapterid. '&sid=' . $sid;
			$sign = md5($para . '&key=' . $key);
			$url = $sync['content'] . '?' . $para . '&sign=' . $sign;
			$list = json_decode(jieqi_sync_geturlcontent($url) , true);
			echo json_encode(array("Success"=>1,"Data"=>$list));
		}
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ͬ����������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" media="all" href="/css/admin_right.css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/scripts/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/scripts/admin.js"></script>
<style type="text/css">
    * {padding: 0;margin: 0;}
    ul { list-style-type: none;}
    
    .parentWrap {
      width: 100%;
      text-align:center;
      
    }
    
    .menuGroup {
      border:1px solid #cccccc;
      background-color:#fff;
    }
    
    .groupTitle {
      display:block;
      height:30px;
      line-height:30px;
      font-size: 16px;
      
      cursor:pointer;
    }
    
    .menuGroup > div {
      min-height: 200px;
      background-color:#fff;
      display:none;
    }
  
  </style>
<script>
      $(function () {
          //˼·������
          //1. �����е�spanע�����¼����õ�ǰspan���ֵ�div��ʾ����
          $(".groupTitle").click(function () {
            //��һ���ֵܣ�nextElementSibling
            
            //��ʽ��̣���jQuery���棬��������һֱ������ȥ��
            $(this).next().slideDown(200).parent().siblings().children("div").slideUp(200);
          });
      });
  </script>
</head>
<body >

<div id="content">
<div class="gridtop">�ӿڲ���</div>
<ul class="parentWrap">
  <li class="menuGroup">
    <span class="groupTitle" onclick="articlelist('<?php echo $sync["alist"]?>',<?php echo $siteid?>);"><?php echo $sync["alist"]?></span>
    <div id="articlelist"></div>
  </li>
  <li class="menuGroup">
    <span class="groupTitle"><?php echo $sync["ainfo"]?></span>
    <div id="articleinfo"></div>
  </li>
  <li class="menuGroup">
    <span class="groupTitle" id="uri_chapterlist" onclick="chapterlist();"><?php echo $sync["clist"]?></span>
    <div id="chapterlist"></div>
  </li>
  <li class="menuGroup">
    <span class="groupTitle" id="uri_chapter" onclick="chapter();"><?php echo $sync["content"]?></span>
    <div id="chapter"></div>
  </li>
</ul>
</div>
<script type="text/javascript">
	var bookid = 0;
	var chapterid = 0;
	var siteid = <?php echo $siteid?>;
<!--
	function articlelist(url,siteid) {
		var th = $(this)
		$.ajax({
			url: '/modules/article/admin/newsync_test.php?act=articlelist&id='+siteid,
			type: 'get',
			dataType:"json",
			success: function (result) {
				if(result.Success) {
					var data = result.Data;
					
					if(data.length>0) {
						var html = '';
						$.each(data, function (k, v) {
							if (k == 0) {
								bookid = v.articleid;
							}
							html += '<a href="javascript:void(0);" onclick="articleinfo(' + v.articleid+ ','+siteid+')">' + v.articleid + '��' + v.articlename + ': ' + v.lastupdate + ' ' + v.link + '</a><br/>';
						});
						$('#articlelist').html(html);
						
					}else{
						$('#articlelist').html("С˵�б�Ϊ�գ�");
					}
				}else{
					$("#uri_articlelist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(result.Msg);
					$("#uri_articlelist .icon i").attr("class","icon-remove");
					status_articlelist=0;
				}
			}
		});
    }

	 function articleinfo(articleid){
		
		if (articleid)
		{
			bookid = articleid;
			$.ajax({
				url:'/modules/article/admin/newsync_test.php?act=articleinfo&id='+siteid+'&articleid='+articleid,
				type: 'get',
				dataType:"json",
				success: function (result) {
					if(result.Success) {
						var data = result.Data;
						console.log(data);
						var html = '';
						html += 'С˵ID��'+data.articleid+"<br/>";
						html += '���ʱ�䣺'+data.postdate+"<br/>";
						html += '����ʱ�䣺'+data.lastupdate+"<br/>";
						html += 'С˵���ƣ�'+data.articlename+"<br/>";
						html += '���ߣ�'+data.author+"<br/>";
						html += '�ؼ��֣�'+data.keywords+"<br/>";
						html += '�����飺'+data.intro+"<br/>";
						html += '���鹫�棺'+data.notice+"<br/>";
						html += '����״̬��'+data.fullflag+"<br/>";
						html += '�½�����'+data.chapters+"<br/>";
						html += '��������'+data.words+"<br/>";
						html += '�Ƿ�ǩԼ��'+data.isvip+"<br/>";
						html += '����Ƶ����'+data.rgroup+"<br/>";
						html += '���ࣺ'+data.category+"<br/>";
						html += '���棺'+data.cover+"<br/>";
						html += '��������½�ID��'+data.freechapterid+"<br/>";
						html += '��������½�����'+data.freechapter+"<br/>";
						html += '���������ʱ�䣺'+data.freetime+"<br/>";
						html += 'VIP�����½�ID��'+data.vipchapterid+"<br/>";
						html += 'VIP�����½�����'+data.vipchapter+"<br/>";
						html += 'VIP������ʱ�䣺'+data.viptime+"<br/>";
						$("#uri_articleinfo .icon i").attr("class","icon-ok");
						$("#uri_articleinfo").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(html);
						$('#articleinfo').html(html);
						$('#articleinfo').slideDown(200).parent().siblings().children("div").slideUp(200);
						
					}else{
						$('#articleinfo').html("С˵�б��ȡ����");
					}
				}
			});
		}else{
			$('#articleinfo').html("�ɼ�ʧ��");
		}
    }

	 function chapterlist(){
		
        if(bookid==0){
            return;
        }
		$.ajax({
			url:'/modules/article/admin/newsync_test.php?act=chapterlist&id='+siteid+'&articleid='+bookid,
			type: 'get',
			dataType:"json",
			success: function (result) {
				if(result.Success) {
					var data = result.Data;
					if(data.length>0) {
						var html = '';
						//console.log(result);
						$.each(data, function (k, v) {
							if (k == 0) {
								chapterid = v.chapterid;
							}
							html += '<a href="javascript:void(0);" onclick="chapter(' + v.chapterid + ')">' + v.chapterid + '��' + v.chaptername + '��' + v.chaptertype + '��' + v.isvip + '��' + v.saleprice + '��' + v.postdate + '��' + v.lastupdate + '��' + v.words + ' ' + v.link + '</a><br/>';
						});
						$("#chapterlist").html(html);
						$("#chapterlist").slideDown(200).parent().siblings().children("div").slideUp(200);
					}else{
						$("#chapterlist").html("�ɼ��ɹ��������½��б�Ϊ�գ�");
					}
				}else{
					$("#chapterlist").html("�ɼ�ʧ��");
				}
			}
		});
    }

	 function chapter(chapterid){
        if(bookid==0){
            return;
        }
        if(chapterid==0){
            $("#uri_chapterlist").trigger("click");
            return;
        }

		$.ajax({
			url:'/modules/article/admin/newsync_test.php?act=chapter&id='+siteid+'&articleid='+bookid+'&chapterid='+chapterid,
			type: 'get',
			dataType:"json",
			success: function (result) {
				if(result.Success) {
					var html = '';
					var data = result.Data;
					html += '�½�ID��'+data.chapterid+"<br/>";
					html += '�½����ƣ�'+data.chaptername+"<br/>";
					html += '����ʱ�䣺'+data.postdate+"<br/>";
					html += '����ʱ�䣺'+data.lastupdate+"<br/>";
					html += '�½����ԣ�'+data.chaptertype+"<br/>";
					html += '�Ƿ���ѣ�'+data.isvip+"<br/>";
					html += '�½ڵ��ۣ�'+data.saleprice+"<br/>";
					html += '������'+data.words+"<br/>";
					html += '<p style="white-space: pre-wrap;">�½����ݣ�'+data.content+"</p>";
					$("#chapter").html(html);
					$("#chapter").slideDown(200).parent().siblings().children("div").slideUp(200);
				}else{
					$("#chapter").html("��ȡʧ��");
				}

			}
		});
    }
//-->
</script>
    
</body>
</html>
