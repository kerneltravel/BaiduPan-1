<?php
//匹配shareid和uk参数
preg_match('|\/(\d*)\/(\d*)\.|', $_SERVER["REQUEST_URI"], $res);
list($shareid, $uk) = array_slice($res, 1, 2);
 
//构造百度网盘分享网址获取源码
$url = "http://pan.baidu.com/share/link?shareid=$shareid&uk=$uk";
$src = file_get_contents($url);
 
//匹配源码里面的音乐地址并跳转
preg_match('|MusicPlayer\("(.*)"|U', $src, $res);
$songurl = $res[1];
//如果要外链其它格式的文件，可以反注释下面两行代码
//preg_match('|dlink\\\":\\\"(.*)\\\"|U', $src, $res);
//$songurl = str_replace("\\\\", "", $res[1]);
header("location:$songurl");
?>
