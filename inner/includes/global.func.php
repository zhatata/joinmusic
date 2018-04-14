<?php
/**
 *_alert()浏览器的弹窗提示
 *param $_alert_info
*/
function _alert($_alert_info){
	echo "<script type='text/javascript'>alert('".$_alert_info."');history.back(-1)</script>;";
	exit;
}

/**
 *_check_code()用于校验验证码是否匹配
 *param string $_firtst_code
 *param string $_end_code
*/
function _check_code($_first_code, $_end_code){
	if (!($_POST['checkcode'] == $_SESSION['checkcode'])) {
		_alert(验证码不正确！);
	}
}

/**
*/
function _location($_info, $_url){
	if (empty($_info)) {
		header('Location:'.$_url);
	}
	else{
		echo "<script type='text/javascript'>alert('".$_info."');location.href='".$_url."';</script>";
	}
	
}

/**
 *_session_destroy()关闭会话
*/
function _session_destroy() {
	session_destroy();
}

/**
 *_unsetcookies()清除cookie
*/
function _unsetcookies(){
	setcookie('username', '', time()-1);
	setcookie('uniqid', '', time()-1);
	_location(null, 'main.php');
}

/**
 * _html() 函数表示对字符串进行HTML过滤显示，如果是数组按数组的方式过滤，
 * 如果是单独的字符串，那么就按单独的字符串过滤
 * @param unknown_type $_string
 */


function _html($_string) {
	if (is_array($_string)) {
		foreach ($_string as $_key => $_value) {
			$_string[$_key] = _html($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
		}
	} else {
		$_string = htmlspecialchars($_string);
	}
	return $_string;
}

/**
 *_code()用于生成随机的验证码
*/
function _code(){
	//创建随机码
	for ($i=0; $i < 4; $i++) { 
		$_numsg .= dechex(mt_rand(0,15));
	}

	//保存在session中
	$_SESSION['checkcode'] = $_numsg;

	//echo $_SESSION['code'];
	//保留输出会导致图片生成失败

	$_height = 53;
	$_width = 130;

	//创建一张图片
	$_img = imagecreatetruecolor($_width, $_height);

	//白色
	$_white = imagecolorallocate($_img, 255, 255, 255);

	//颜色填充
	imagefill($_img, 0, 0, $_white);

	//随机6个干扰线条
	for ($i=0; $i < 6; $i++) { 
		$_rnd_color = imagecolorallocate($_img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
		imageline($_img, mt_rand(0,$_width), mt_rand(0,$_height), mt_rand(0,$_width), mt_rand(0,$_height), $_rnd_color);
	}

	//随机雪花
	for ($i=0; $i < 50; $i++) { 
		$_rnd_color = imagecolorallocate($_img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
		imagestring($_img, 1, mt_rand(1,$_width), mt_rand(2,$_height), '*', $_rnd_color);
	}

	//输出验证码
	for ($i=0; $i < strlen($_SESSION['checkcode']); $i++) {
		$_rnd_color = imagecolorallocate($_img, mt_rand(0,100), mt_rand(0,150), mt_rand(0,200)); 
		imagestring($_img, mt_rand(4,5), $i*$_width/4+mt_rand(1,10),mt_rand(1, $_height/2), $_SESSION['checkcode'][$i], $_rnd_color);
	}

	//输出图像
	header('Content-Type: image/jpeg');
	imagejpeg($_img);

	//销毁图像
	imagedestroy($_img);
}

?>