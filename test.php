<?php

//根据接口返回数据信息测试
header("Content-type: text/html; charset=UTF-8");
$scont=file_get_contents("http://www.novelrd.cn/modules/article/reader.php?cid=".$_GET['b']."&aid=".$_GET['a']."&ajax_gets=1");
//echo $scont;
$scont=explode('<pre class="note">',$scont);
$scont=explode('</pre>',$scont[1]);
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
    $qian = "https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&tex=";
?>

<?php if ($zishu <= 2700): ?>

<video id="langdu" style="display:none"  webkit-playsinline="true" playsinline="true">
    <source id="source" src="<?php echo $qian.$r[0]; ?>" type="video/mp4">
</video>

<script type="text/javascript">
    function playPause() {
    var music = document.getElementById('langdu');
    var music_btn = document.getElementById('music_btn01');
    if (music.paused) {
        music.play();
        music_btn.src = 'pause.png';
        var aud = document.getElementById("langdu");
        aud.onended = function() {
        aud.src = "<?php echo $qian.$r[1]; ?>"
        aud.play();
        aud.addEventListener("ended", function() {
        aud.src = "<?php echo $qian.$r[2]; ?>"
        aud.play();
        aud.addEventListener("ended", function() {
        aud.pause();
        }, false);
        }, false);
        };
    } else {
        music.pause();
        music_btn.src = 'play.png';
    }}
</script>

<span style="height: 58px;text-align: center;line-height: 58px;font-size: 18px;position: relative; cursor: pointer;">
    <a href="javascript:playPause();"><img src="play.png" style="margin-left:5px;margin-top:5px;" width="30" height="30" id="music_btn01" border="0"></a>
</span>

<?php endif; ?>

