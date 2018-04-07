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
		<div class="weui-cells__title">填写注册信息</div>
		<div class="weui-cells weui-cells_form">
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="username" maxlength="18" placeholder="请输入用户名"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">微信号</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="wechatid" placeholder="请输入微信号"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="password" name="pwd" maxlength="18" placeholder="请输入密码"/>
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
		<div class="weui-cells__tips">请注意保管用户名与密码，暂无找回功能哟</div>

		<label for="weuiAgree" class="weui-agree">
		    <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox">
		    <span class="weui-agree__text">
		        阅读并同意<a href="javascript:void(0);">《相关条款》</a>
		    </span>
		</label>

		<div class="weui-btn-area">
		    <input class="weui-btn weui-btn_primary" id="showTooltips" type="submit" name="signup-btn" value="注册">
		</div>
	</form>
</body>
</html>