<?php
ini_set("error_reporting",E_ALL ^ E_NOTICE);
session_start();

//检查非法调用
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';
//开始处理登录状态
if ($_GET['action'] == 'login') {
  	//验证码校验
  	_check_code($_POST['checkcode'], $_SESSION['checkcode']);
  	//引入验证文件
  	include ROOT_PATH.'/includes/login.func.php';

  	//接收数据
  	$_clean = array();
  	$_clean['username'] = _check_username($_POST['username'], 4, 20);
  	$_clean['password'] = _check_password($_POST['password'], 6, 20);

  	//数据库验证
  	if (!!$_rows = _fetch_array("SELECT we_username,we_uniqid FROM we_user WHERE we_username='{$_clean['username']}' and we_password='{$_clean['password']}'", $_conn)) {
  		_close($_conn);
  		_session_destroy();
  		_setcookies($_clean['username'], $_clean['uniqid']);
  		_location(null, 'main.php');
  	} else{
  		_close($_conn);
  		_session_destroy();
  		_location('用户名密码不正确', 'login.php');
  	}
  }  
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
	<script type="text/javascript" src="./js/login.js"></script>
</head>
<body>
	<form method="post" name="login" action="login.php?action=login">
		<div class="weui-cells weui-cells_form">
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="username" placeholder="请输入用户名"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="password" name="password" placeholder="请输入密码"/>
		        </div>
		    </div>
		    <div class="weui-cell weui-cell_vcode">
		        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="checkcode" placeholder="请输入验证码"/>
		        </div>
		        <div class="weui-cell__ft">
		            <img class="weui-vcode-img" src="./checkcode.php" id="checkcode" />
		        </div>
		    </div>
		</div>
		<div class="weui-btn-area">
    		<input type="submit" name="login" class="weui-btn weui-btn_primary" value="登录">
		</div>				
	</form>
	<div class="weui-cells__tips">无可用的用户名与密码？请点击注册</div>
	<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="./signup.php" id="showTooltips">注册</a>
	</div>
</body>
</html>