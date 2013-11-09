<?php
//获取参数
$file = $_GET['file'];
$uk = $_GET['uk'];
$shareid = $_GET['shareid'];
$jsonpcallback = $_GET['jsonpcallback'];
//生成 URL 地址
if ($file != '') {
	$url = 'http://pan.baidu.com/s/' . $file;
} elseif ($shareid != '' && $uk != '') {
	$url = 'http://pan.baidu.com/share/link?shareid=' . $shareid . '&uk=' . $uk;
} else {
	echo 'Parameter Error';
	return false;
}
//读取内容
$src = file_get_contents($url);
//匹配文件名
$pattern = '/server_filename="(.+?)"/is';
preg_match_all($pattern, $src, $result);
$filename = $result[1][0];
//输出 JSON
$info = array(
	'filename' => $filename,
);
echo $jsonpcallback, '(', json_encode($info), ')';
?>