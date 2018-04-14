<?php
if (!function_exists('_alert')) {
	exit('_alert()函数不存在，请检查！');
}

/*if (!function_exists('_mysql_string')) {
	exit('_mysql_string()函数不存在，请检查！');
}*/

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

	return $_string;
}

/**
 *_check_password()用于检查密码是否合法
 *param $_first_pass
 *param $_end_pass
 *param $_min_pass
 *param $_max_pass
*/ 
function _check_password($_first_pass, $_end_pass, $_min_pass, $_max_pass){
	//判断密码
	if (strlen($_first_pass) < $_min_pass || strlen($_first_pass) > $_max_pass) {
		_alert('密码不小于6位,不大于20位');
	}

	if ($_first_pass != $_end_pass) {
		_alert('两次输入的密码不一致请确认');
	}

	return sha1($_first_pass);
} 

/**
 *_check_uniqid()用于验证唯一标识符
*/
function _check_uniqid($_first_uniqid, $_end_uniqid){
	if ((strlen($_first_uniqid) != 40) || ($_first_uniqid != $_end_uniqid)) {
		_alert('唯一标识符异常');
	}
	return $_first_uniqid;
}
?>