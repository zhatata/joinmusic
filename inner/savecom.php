<?php
ini_set("error_reporting",E_ALL ^ E_NOTICE);
define('IN_TG', true);
require dirname(__FILE__).'/includes/common.inc.php';

if (!isset($_COOKIE['username'])) {
	_alert('登录后才可以评论！');
}

$_message = array();
$_message['user'] = $_COOKIE['username'];
$_message['content'] =$_POST['content'];
$_message['time'] = date('Y-m-d H:i:s',time());
$_message['musicid'] = $_POST['musicid'];

//var_dump($_message);

//评论入库
$_sql = "INSERT INTO we_comment (
									we_musicid,
									we_username,
									we_message,
									we_com_time
								)
							VALUES
								(
									'{$_message['musicid']}',
									'{$_message['user']}',
									'{$_message['content']}',
									'{$_message['time']}'
								)";
$result = _query($_sql, $_conn);

if ($result) {
	$_conn -> close();
	_location('评论成功','main.php');
}else{
	die("评论失败".$_conn->error);
}
 
?>