<?php
ini_set("error_reporting",E_ALL ^ E_NOTICE);
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';

$_aim = $_POST['search'];
$_sql = "SELECT we_musicname,we_album,we_singer,we_owner,we_words FROM we_music WHERE we_musicname='{$_aim}' or we_singer='{$_aim}'";
if (!!$_rows = _fetch_array($_sql, $_conn)) {
	$_clean = array();
	$_clean['musicname'] = $_rows['we_musicname'];
	$_clean['album'] = $_rows['we_album'];
	$_clean['singer'] = $_rows['we_singer'];
	$_clean['owner'] = $_rows['we_owner'];
	$_clean['words'] = $_rows['we_words'];
	_close($_conn);
}
else{
	_alert('no'.$_aim.'关键词不存在');
}

var_dump($_clean);

?>
<!DOCTYPE html>
<html lang='zh-CN'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>评论区</title>
	<link rel="stylesheet" type="text/css" href="./css/weui.min.css">
	<link rel="stylesheet" type="text/css" href="./css/mystyle.css">
	
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/zepto.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
<div class="musicinfo">
	<div class="musicinfo-basic">
		
	</div>
	<div class="musicinfo-comment-area">
		<form method="post" action="comsave.php">
			<textarea class="comment-input"></textarea>
			<input type="submit" name="comment_submit" class="comment_submit weui-btn" value="评论">
		</form>		
	</div>
	<div class="musicinfo-comments">
		<div class="comment-title">
			<p>最新评论</p>
		</div>
		<div class="comment-box">
			<div class="comment-id">用户aaaa:</div>
			<div class="comment-contend">这是留言内容。。。</div>
			<div class="comment-time">YYYY-MM-DD HH:MM:SS</div>		
		</div>
		<div class="comment-box">
			<div class="comment-id">用户aaaa:</div>
			<div class="comment-contend">这是留言内容。。。</div>
			<div class="comment-time">YYYY-MM-DD HH:MM:SS</div>		
		</div>
		<div class="comment-box">
			<div class="comment-id">用户aaaa:</div>
			<div class="comment-contend">这是留言内容。。。</div>
			<div class="comment-time">YYYY-MM-DD HH:MM:SS</div>		
		</div>
	</div>
	
</div>

</body>
</html>