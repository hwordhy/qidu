<?php
function splitword($string, $minwords, $maxwords) {
    if ($minwords > 0 && mb_strlen($string) <= $minwords) return false;
    if ($maxwords <= 0 || mb_strlen($string) <= $maxwords) return $string;
    preg_match_all('/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/', $string, $match);
    return array_map('implode', array_chunk($match[0], $maxwords));
}

function prepareText($content_dir,&$arrError)
{
    global $jieqiConfigs;

    $content = $content_dir;
    if (!is_string($content)){

        return $arrError[] = "打开文件失败";
    }

    // 替换空行
    $content = str_replace("\r\n\r\n","\r\n", $content);
    $content = str_replace("\r\n\r\n","\r\n", $content);
    $content = str_replace("\t", ' ', $content);
    $content = str_replace("\r", "\n", $content);
    $content = preg_replace('/\n(?:(?:VIP|最新|防采集|网友上传)\s*(?:卷|分卷|章节)|正文|作品相关)\s*/i', "\n", $content);

    if (!empty($jieqiConfigs["article"]["postdenywords"])) {
        include_once (JIEQI_ROOT_PATH . "/include/checker.php");
        $checker = new JieqiChecker();
        $content = $checker->replace_words($content, $jieqiConfigs['article']['postdenywords'], '***');
    }

    return $content;

}

// 将TXT文本解析成数组
function toArray($content_dir,&$arrError)
{
    global $jieqiConfigs;
    $list = array();

    //判断TXT文本是否编码匹配
    if (empty(mb_detect_encoding($content_dir, JIEQI_CHAR_SET))) {
        return $arrError[] = "请确定TXT文本编码是否为：" . JIEQI_CHAR_SET;
    }

    //判断文本字符串是否有乱码
    if (empty(json_encode($content_dir))) {
        return $arrError[] = "文本中包含乱码，请确定TXT文本编码是否为" . JIEQI_CHAR_SET . "再上传";
    }

    $content = prepareText($content_dir, $arrError);
    $content = trim($content);

    if (preg_match_all('/\n.{0,20}(第(?:一|二|三|四|五|六|七|八|九|十|百|千|万|两|廿|卅|卌|零|〇|１|２|３|４|５|６|７|８|９|０|[0-9])+(?:章|节|回).{0,50})\n/', $content, $match, PREG_OFFSET_CAPTURE) || preg_match_all('/\n((?:d|第|弟|递|滴|低|地|底|帝|的)*(?:一|二|三|四|五|六|七|八|九|十|百|千|万|两|廿|卅|卌|零|〇|１|２|３|４|５|６|７|８|９|０|[0-9])+(?:部|卷|集|篇|册|章|节|回).{0,50})\n/', $content, $match, PREG_OFFSET_CAPTURE)) {
        if ($match[0][0][1] > 1000) {
            array_unshift($match[0], array('作品相关', -8));
            array_unshift($match[1], array('作品相关', -8));
        }

        $c = 0;

        foreach ($match[1] as $key => $val) {
            $start = $match[0][$key][1] + strlen($match[0][$key][0]);
            $end = isset($match[0][$key + 1]) ? $match[0][$key + 1][1] : strlen($content);
            $chapter = splitword(substr($content, $start, $end - $start), $jieqiConfigs['article']['minwords'], $jieqiConfigs['article']['maxwords']);

            if (is_array($chapter)) {
                foreach ($chapter as $k => $v) {
                    $list[$c] = array('name' => trim($val[0]) . " (" . ($k + 1) . ")", 'size' => strlen($v), 'content' => "    " . str_replace("\n", "\r\n\r\n    ", $v));
                    $c++;
                }
            } else {
                if (empty($chapter)) continue;
                $list[$c] = array('name' => trim($val[0]), 'size' => $end - $start, 'content' => "    " . str_replace("\n", "\r\n\r\n    ", $chapter));
                $c++;
            }
        }
    } else {
        $chapter = splitword($content, 0, $jieqiConfigs['article']['splitwords']);
        if (!empty($chapter)) {
            $chapter = is_array($chapter) ? $chapter : array($chapter);
            foreach ($chapter as $key => $val) {
                $list[] = array('name' => "第 " . ($key + 1) . " 章节", 'size' => strlen($val), 'content' => "    " . str_replace("\n", "\r\n\r\n    ", $val));
            }
        }
    }

    return $list;
}

?>