<?php
	if (!function_exists('_alert')) {
	exit('_alert()函数不存在，请检查！');
	}

/**
 *_checkmusicname用于检测并过滤用户名
 *@access public
 *
*/
function _check_musicname($_string, $_min_num, $_max_num){
	//去掉头尾空格
	$_string = trim($_string);

	//判断是否越界
	if ((mb_strlen($_string) < $_min_num) || (mb_strlen($_string) > $_max_num)) {
		_alert('歌曲名称长度不得小于'.$_min_num.'位或大于'.$_max_num.'位');
	}

	//限制非法字符
	$_char_pattern = '/[<>\'\"\ \	]/';
	if (preg_match($_char_pattern, $_string)) {
		_alert('歌曲名不得包含非法字符');
	}

/*	//限制敏感歌曲名
	$_mg[0] = ''；
	foreach ($_mg as $value) {
		$_mg_string = 
	}chp1.0*/

	return $_string;
}


/**
 *_check_album()检测专辑名称是否合法
*/
function _check_album($_string, $_min_num, $_max_num){
	//去掉头尾空格
	$_string = trim($_string);

	//判断是否越界
	if ((mb_strlen($_string) < $_min_num) || (mb_strlen($_string) > $_max_num)) {
		_alert('专辑名称长度不得小于'.$_min_num.'位或大于'.$_max_num.'位');
	}

	//限制非法字符
	$_char_pattern = '/[<>\'\"\ \	]/';
	if (preg_match($_char_pattern, $_string)) {
		_alert('专辑名不得包含非法字符');
	}

	return $_string;
}

function _check_names($_string, $_min_num, $_max_num){
	//去掉头尾空格
	$_string = trim($_string);

	//判断是否越界
	if ((mb_strlen($_string) < $_min_num) || (mb_strlen($_string) > $_max_num)) {
		_alert('创作者人名长度不得小于'.$_min_num.'位或大于'.$_max_num.'位');
	}

	//限制非法字符
	$_char_pattern = '/[<>\'\"\ \	]/';
	if (preg_match($_char_pattern, $_string)) {
		_alert('创作者名不得包含非法字符');
	}

	return $_string;
}

function _check_owner($_string){
	
}

function _check_words($_string, $_max_num){
	//去掉头尾空格
	$_string = trim($_string);
	//判断是否越界
	if (mb_strlen($_string) > $_max_num) {
		_alert('歌词长度不得大于'.$_max_num.'位');
	}

	return $_string;	
}


?>