<?php
//��ȡ����
$file = $_GET['file'];
$uk = $_GET['uk'];
$shareid = $_GET['shareid'];
$jsonpcallback = $_GET['jsonpcallback'];
//���� URL ��ַ
if ($file != '') {
	$url = 'http://pan.baidu.com/s/' . $file;
} elseif ($shareid != '' && $uk != '') {
	$url = 'http://pan.baidu.com/share/link?shareid=' . $shareid . '&uk=' . $uk;
} else {
	echo 'Parameter Error';
	return false;
}
//��ȡ����
$src = file_get_contents($url);
//ƥ���ļ���
$pattern = '/server_filename="(.+?)"/is';
preg_match_all($pattern, $src, $result);
$filename = $result[1][0];
//��� JSON
$info = array(
	'filename' => $filename,
);
echo $jsonpcallback, '(', json_encode($info), ')';
?>