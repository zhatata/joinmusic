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
	<form>
		<div class="weui-cells weui-cells_form">
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="username-login" placeholder="请输入用户名"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="password" name="pwd-login" placeholder="请输入密码"/>
		        </div>
		    </div>
		    <div class="weui-cell weui-cell_vcode">
		        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="number" placeholder="请输入验证码"/>
		        </div>
		        <div class="weui-cell__ft">
		            <img class="weui-vcode-img" src="./images/vcode.jpg" />
		        </div>
		    </div>
		</div>
		<div class="weui-btn-area">
    		<input type="submit" name="login" class="weui-btn weui-btn_primary" value="登陆">
		</div>				
	</form>
	<div class="weui-cells__tips">无可用的用户名与密码？请点击注册</div>
	<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="./signup.php" id="showTooltips">注册</a>
	</div>
</body>
</html>