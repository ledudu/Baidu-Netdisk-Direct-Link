<?php
$file = $_GET['file'];
$uk = $_GET['uk'];
$shareid = $_GET['shareid'];
//get url
if ($file != '') {
	//get url
	$url = 'http://pan.baidu.com/s/' . $file;
	$src = file_get_contents($url);
	//get uk
	$pattern = '/FileUtils.share_uk="(.+?)"/is';
	preg_match_all($pattern, $src, $result);
	$uk = $result[1][0];
	//get shareid
	$pattern = '/FileUtils.share_id="(.+?)"/is';
	preg_match_all($pattern, $src, $result);
	$shareid = $result[1][0];
	//get url
	$url = 'http://pan.baidu.com/wap/link?shareid=' . $shareid . '&uk=' . $uk;
	//get file
	getFile(file_get_contents($url));
} elseif ($shareid != '' && $uk != '') {
	//get url
	$url = 'http://pan.baidu.com/wap/link?shareid=' . $shareid . '&uk=' . $uk;
	//get file
	getFile(file_get_contents($url));
} else {
	echo 'Parameter Error';
	return false;
}

function getFile($src) {
	//bulid regex
	$pattern = '/http:\/\/d.pcs.baidu.com\/[^\"]*expires=8h[^\"]*/is';
	preg_match_all($pattern, $src, $result);
	//replace
	$fileurl = str_replace("\\", "", $result[0][0]);
	$fileurl = str_replace("&amp;", "&", $fileurl);
	if ($fileurl == '') {
		echo 'File Not Found';
		return false;
	}
	header('location: ' . $fileurl);
}
?>