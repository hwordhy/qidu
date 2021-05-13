<?php

$phpsir_debug = 0;
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$time = microtime(true);
set_time_limit(3600);
ini_set("memory_limit", -1);
ini_set('upload_max_filesize',"15M");
ini_set('post_max_size',"15M");

if (empty($_POST["type"])) {
    exit();
}

if (empty($_POST["userid"])) {
    exit();
}

if (empty($_POST["token"])) {
    exit();
}

$data = unserialize(base64_decode(str_pad(strtr($_POST["token"], "-_", "+/"), strlen($_POST["token"]) % 4, "=", STR_PAD_RIGHT)));

if (empty($data)) {
    echo "校验码不存在!";
    exit();
}

$sign = array_pop($data);

if ($sign !== md5("mc_" . serialize($data))) {
    echo "校验码不匹配！";
    exit();
}

if ($data["userid"] != $_POST["userid"]) {
    echo "用户名不存在！";
    exit();
}

if ($data["ip"] !== $_SERVER["REMOTE_ADDR"]) {
    echo "IP地址不匹配！";
    exit();
}

if ($data["time"] < ($time - 3600)) {
    echo "等待超时，请刷新页面重试！";
    exit();
}

$type = strtolower(trim($_POST["type"]));

if (!in_array($type, array("cover", "ebook"))) {
    echo "上传类型错误，请刷新页面重试！";
    exit();
}

if (empty($_FILES[$type]["name"])) {
    echo "请上传文件！";
    exit();
}

jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
$query = $query_handler->db->query("SELECT * FROM " . jieqi_dbprefix("article_upload") . " WHERE type='$type' AND sign='$sign'");
$upinfo = $query_handler->getobject($query);
if (!empty($upinfo) && $upinfo->getvar("status")) {
    echo "数据不存在，请刷新重试！";
    exit();
}

if ($type === "cover") {
    if (!preg_match("/\.(jpg|jpeg|gif|png)$/i", $_FILES["cover"]["name"])) {
        echo "请上传有效格式图片！";
        exit();
    }

    $image = file_get_contents($_FILES["cover"]["tmp_name"]);
    jieqi_delfile($_FILES["cover"]["tmp_name"]);

    if (empty($image)) {
        echo "对不起，图片不存在！";
        exit();
    }

    $im = imagecreatefromstring($image);

    if (!is_resource($im)) {
        echo "图片处理失败，请上传有效格式图片";
        exit();
    }

    ob_start();
    imagejpeg($im);
    $data = ob_get_contents();
    ob_end_clean();
    imagedestroy($im);
}
else if ($type === "ebook") {
    if (!preg_match("/\.(txt|text)$/i", $_FILES["ebook"]["name"])) {
        echo "请上传TXT类型文本";
        exit();
    }

    if ((($jieqiConfigs["article"]["maxsize"] * 1024) < $_FILES["ebook"]["size"]) || ($_FILES["ebook"]["size"] < ($jieqiConfigs["article"]["minsize"] * 1024))) {
        echo "请上传小于".$jieqiConfigs["article"]["maxsize"]."大于".$jieqiConfigs["article"]["minsize"]."的TXT文本";
        exit();
    }

    $content = file_get_contents($_FILES["ebook"]["tmp_name"]);
    jieqi_delfile($_FILES["ebook"]["tmp_name"]);

    if (empty($content)) {
        echo "TXT文本不存在！";
        exit();
    }

    include_once jieqi_path_inc("class/ebook.php", "article");
    //$data = readList($content);
    $data = toArray($content,$arrTxtError);

    if(count($arrTxtError)>0){
        echo $arrTxtError[0];exit;
    }

    if (empty($data)) {
        echo "文本处理失败，请重试!";
        exit();
    }
}

if (empty($upinfo)) {
    $query = $query_handler->db->query("INSERT INTO " . jieqi_dbprefix("article_upload") . " (id, type, sign, uptime, status) VALUES (NULL, '$type', '$sign', '" . time() . "', '0')");

    if (empty($query)) {
        echo "数据写入失败，请联系管理员";
        exit();
    }

    $id = $query_handler->db->getinsertid();
}
else {
    $id = $upinfo->getvar("id");
    $query = $query_handler->db->query("UPDATE " . jieqi_dbprefix("article_upload") . " SET uptime='" . time() . "' WHERE id='$id'");

    if (empty($query)) {
        echo "数据更新失败，请联系管理员";
        exit();
    }
}

$datapath = jieqi_uploadpath($jieqiConfigs["article"]["uploaddir"], "article") . "/" . floor($id / 1000);
jieqi_checkdir($datapath, true);
jieqi_writefile($datapath . "/$id.tmp", serialize($data));
echo $id;

?>
