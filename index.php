<?php
//获取参数
$file = $_GET['file'];
$uk = $_GET['uk'];
$shareid = $_GET['shareid'];
//生成 URL 地址
if ($file != '') {
	//URL 生成
	$url = 'http://pan.baidu.com/s/' . $file;
	$src = file_get_contents($url);
	//获取 uk
	$pattern = '/FileUtils.share_uk="(.+?)"/is';
	preg_match_all($pattern, $src, $result);
	$uk = $result[1][0];
	//获取 shareid
	$pattern = '/FileUtils.share_id="(.+?)"/is';
	preg_match_all($pattern, $src, $result);
	$shareid = $result[1][0];
	//URL 生成
	$url = 'http://pan.baidu.com/wap/link?shareid=' . $shareid . '&uk=' . $uk;
	//获取文件
	getFile(file_get_contents($url));
} elseif ($shareid != '' && $uk != '') {
	//URL 生成
	$url = 'http://pan.baidu.com/wap/link?shareid=' . $shareid . '&uk=' . $uk;
  	//获取文件
	getFile(file_get_contents($url));
} else {
	echo 'Parameter Error';
	return false;
}

function getFile($src) {
	//正则表达式
	$pattern = '/http:\/\/d.pcs.baidu.com\/[^\"]*expires=8h[^\"]*/is';
	preg_match_all($pattern, $src, $result);
	//字符替换
	$fileurl = str_replace("\\", "", $result[0][0]);
	$fileurl = str_replace("&amp;", "&", $fileurl);
	if ($fileurl == '') {
		echo 'File Not Found';
		return false;
	}
	header('location: ' . $fileurl);
}
?>