<?php
if (!function_exists('_alert')) {
	exit('_alert()函数不存在，请检查！');
}

/**
 *_setcookies()保存登录的cookie
*/
function _setcookies($_username, $_uniqid){
	setcookie('username', $_username);
	setcookie('uniqid', $_uniqid);
} 

/**
 *_checkusername用于检测并过滤用户名
 *@access public
 *
*/
function _check_username($_string, $_min_num, $_max_num){
	//去掉头尾空格
	$_string = trim($_string);


	//判断是否越界
	if ((mb_strlen($_string) < $_min_num) || (mb_strlen($_string) > $_max_num)) {
		_alert('用户名长度不得小于'.$_min_num.'位或大于'.$_max_num.'位');
	}

	//限制非法字符
	$_char_pattern = '/[<>\'\"\ \	]/';
	if (preg_match($_char_pattern, $_string)) {
		_alert('用户名不得包含非法字符');
	}

/*	//限制敏感用户名
	$_mg[0] = ''；
	foreach ($_mg as $value) {
		$_mg_string = 
	}chp1.0*/

	//return mysqli_real_escape_string($localhost, $_string);
	return $_string;
	//return _mysql_string($_string);
}

function _check_password($_password, $_min_pass, $_max_pass){
	if (strlen($_password) < $_min_pass) {
		_alert('密码不小于6位');
	}

	return sha1($_password);
}
?>