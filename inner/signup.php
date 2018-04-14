<?php
//关闭php未定义变量报错
ini_set("error_reporting",E_ALL ^ E_NOTICE);

session_start();

//验证非法调用
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';

 //判断是否提交
 if ($_GET['action'] == 'signup') {
  	
   	//验证码校验
   	_check_code($_POST['checkcode'], $_SESSION['checkcode']);

   	//引入验证文件
   	require ROOT_PATH.'/includes/signup.func.php';

   	//中国时间
	date_default_timezone_set('Asia/Shanghai');
   	//空数组存放合法数据
   	$_clean = array();
   	$_clean['username'] = _check_username($_POST['username'], 4, 20);
   	$_clean['password'] = _check_password($_POST['password'], $_POST['repassword'], 6, 20);
   	$_clean['wechatid'] = $_POST['wechatid'];
   	$_clean['reg_time'] = date('Y-m-d H:i:s', time());
   	$_clean['uniqid'] = _check_uniqid($_POST['uniqid'], $_SESSION['uniqid']);
   
   	//检查用户名是否已被占用
   	_is_repeat("SELECT we_username FROM we_user WHERE we_username='{$_clean['username']}'", '此用户名已存在', $_conn);

   	//插入新用户数据
   	$result = _query(
				"INSERT INTO we_user 
	 							(
	 								we_uniqid,
	 								we_username,
	 								we_password,
	 								we_wechatid,
	 								we_reg_time
	 							) 
	 						VALUES 
	 							(
	 								'{$_clean['uniqid']}',
	 								'{$_clean['username']}',
	 								'{$_clean['password']}',
	 								'{$_clean['wechatid']}',
	 								'{$_clean['reg_time']}'
	 							)", $_conn);
	if ($result) {
		//关闭并跳转
		$_conn -> close();
		_location('注册成功','login.php');
	}else{
	die("提交失败".$_conn->error);
	}

   }

//防止if验证之前会导致值不一样
$_uniqid = sha1(uniqid(rand(), true));
$_SESSION['uniqid'] = $_uniqid;
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
	<script type="text/javascript" src="./js/signup.js"></script>
<!-- 	<script type="text/javascript" src="./js/weui.min.js"></script>
<script type="text/javascript" src="./js/wechat.js"></script> -->
</head>
<body>
	<form method="post" action="signup.php?action=signup" name="signup">
		<input type="hidden" name="uniqid" value="<?php echo $_uniqid;?>">
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
		            <input class="weui-input" type="password" name="password" maxlength="18" placeholder="请输入密码"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">确认密码</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="password" name="repassword" maxlength="18" placeholder="请重复密码"/>
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