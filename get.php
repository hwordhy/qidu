<?php
$aid= $_GET['a'];
$cid=$_GET['c'];
echo get("http://c1.zsybook.com/index/book/bookcontent/chapeterid/".$cid."?".time(),'','_openid='.$cid.'; _chapeterid='.$cid.';_bookid='.$aid);
function get($url, $referer, $cookie) { 
    $header = array(); 
    $header[] = 'Accept: image/gif, image/jpeg, image/pjpeg, image/pjpeg, application/x-ms-application, application/x-ms-xbap, application/vnd.ms-xpsdocument, application/xaml+xml, */*'; 
    $header[] = 'Connection: Keep-Alive'; 
    $header[] = 'Accept-Language: zh-cn'; 
    $header[] = 'Cache-Control: no-cache'; 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Mobile/9B176 micromessenger/4.3.2'); 
    curl_setopt($ch, CURLOPT_REFERER, $referer); 
    curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
    $result = curl_exec($ch); 
    curl_close($ch); 
    return $result; 
} 

?>

