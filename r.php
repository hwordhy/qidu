<?php
header("Content-type: text/html; charset=UTF-8");
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&per=0&spd=5&text=
$scont=file_get_contents("http://www.novelrd.cn/modules/article/reader.php?cid=".$_GET["b"]."&aid=".$_GET["a"]."&ajax_gets=1");
$scont=explode('<p style="font-size:19px; line-height:50px;" class="note">',$scont);
$scont=explode('</p>',$scont[1]);
$scont=str_replace("<br />","",$scont[0]);

function mbStrSplit ($string, $len = 1) { //对内容进行分割
    $start = 0;
    $strlen = mb_strlen($string);
    while ($strlen) {
    $array[] = mb_substr($string,$start,$len,"utf8");
    $string = mb_substr($string, $len, $strlen,"utf8");
    $strlen = mb_strlen($string);
    }
    return $array;
    }
function match_chinese($chars,$encoding = 'utf8') //过滤特殊字符串
    {
    $pattern = ($encoding == 'utf8')?'/[\x{4e00}-\x{9fa5}a-zA-Z0-9,，。 ]/u':'/[\x80-\xFF]/';
    preg_match_all($pattern,$chars,$result);
    $temp = join('',$result[0]);
    return $temp;
    }
   // $str=$post->post_content;//typecho需要改成$str=$this->excerpt;
    $str=$scont;//typecho需要改成$str=$this->excerpt;
    $str = strip_tags($str);
    $str = str_replace("、","，",$str); //保留顿号
    $str = match_chinese($str);
    $zishu = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($str))),'UTF-8');
    $r = mbStrSplit($str, 900);
    $qian = "https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&per=".$_GET["per"]."&pdt=311&tex=";

//$qian.$r[0];
echo ' <audio name="audio" src="'.$qian.$r[0].'" controls="controls" preload id="music1" hidden></audio><audio   name="audio"  src="'.$qian.$r[1].'" controls="controls" preload id="music2" hidden></audio><audio  name="audio"  src="'.$qian.$r[2].'" controls="controls" preload id="music3" hidden></audio>';

?>