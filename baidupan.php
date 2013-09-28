<?php
//构造百度网盘分享网址
$uri = $_SERVER["REQUEST_URI"];
preg_match('|\/(\d+)\/(\d+)\.|', $uri, $res);
if ($res) {
    list($shareid, $uk) = array_slice($res, 1, 2);
    $url = "http://pan.baidu.com/share/link?shareid=$shareid&uk=$uk";
} else {
    preg_match('|\/.+\/(\w+)\.|', $uri, $res);
    $url = "http://pan.baidu.com/s/".$res[1];
}

//匹配源码里面的音乐地址并跳转
$src = file_get_contents($url);
preg_match('|MusicPlayer\("(.+)"|U', $src, $res);
$songurl = $res[1];

//如果要外链其它格式的文件，可以反注释下面两行代码
//preg_match('|dlink\\\":\\\"(.*)\\\"|U', $src, $res);
//$songurl = str_replace("\\\\", "", $res[1]);
header("location:$songurl");
?>
