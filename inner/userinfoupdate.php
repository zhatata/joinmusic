<?php
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';  
?>

<!DOCTYPE html>
<html lang='zh-CN'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>音乐分享平台</title>
	<link rel="stylesheet" type="text/css" href="./css/weui.min.css">
	<link rel="stylesheet" type="text/css" href="./css/mystyle.css">
	
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/weui.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
	<div class="weui-cells" id="userline">
		<div class="weui-cell">
			<a class="weui-cell weui-cell_access" href="./userinfo.html">
			<div class="weui-cell__hd"><img src="./images/pic_160.png" alt=""></div>
			<div class="weui-cell__bd">
				<p>头像</p>
			</div>
			</a>
		</div>
	</div>	
	<div class="weui-cells">
		<div class="weui-cell">
		    <div class="weui-cell__bd">
		        <p></p>
		    </div>
		    <div class="weui-cell__ft">用户名</div>
		</div>
		<div class="weui-cell">
		    <div class="weui-cell__bd">
		        <p></p>
		    </div>
		    <div class="weui-cell__ft">微信号</div>
		</div>
		<div class="weui-cell">
		    <div class="weui-cell__bd">
		        <p></p>
		    </div>
		    <div class="weui-cell__ft">性别</div>
		</div>
		<div class="weui-cell">
		    <div class="weui-cell__bd">
		        <p></p>
		    </div>
		    <div class="weui-cell__ft">生日</div>
		</div>
		<div class="weui-cell">
		    <div class="weui-cell__bd">
		        <p></p>
		    </div>
		    <div class="weui-cell__ft">地区</div>
		</div>
	</div>
	<div class="weui-btn-area">
    	<a class="weui-btn weui-btn_primary" href="./userinfoupdate.php" id="showTooltips">保存</a>
	</div>

</body>
</html>