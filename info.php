<?php
$file = $_GET['file'];
$uk = $_GET['uk'];
$shareid = $_GET['shareid'];
$jsonpcallback = $_GET['jsonpcallback'];
//get url
if ($file != '') {
	$url = 'http://pan.baidu.com/s/' . $file;
} elseif ($shareid != '' && $uk != '') {
	$url = 'http://pan.baidu.com/share/link?shareid=' . $shareid . '&uk=' . $uk;
} else {
	echo 'Parameter Error';
	return false;
}
//get html content
$src = file_get_contents($url);
//get filename
$pattern = '/server_filename="(.+?)"/is';
preg_match_all($pattern, $src, $result);
$filename = $result[1][0];
//get uk
$pattern = '/FileUtils.share_uk="(.+?)"/is';
preg_match_all($pattern, $src, $result);
$uk = $result[1][0];
//get shareid
$pattern = '/FileUtils.share_id="(.+?)"/is';
preg_match_all($pattern, $src, $result);
$shareid = $result[1][0];
//output json
$info = array(
	'filename' => $filename,
	'uk' => $uk,
	'shareid' => $shareid,
);
echo $jsonpcallback, '(', json_encode($info), ')';
?>