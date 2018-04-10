<?php
if (!defined('IN_TG')) {
 	exit("Access Denfined!");
 }

 /**
  *_connect()链接MySQL数据库
 */
 function _connect(){
 	 $_conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
	if ($_conn->connect_error) {
/*	    die('Connect Error (' . $_conn->connect_errno . ') '
	            . $_conn->connect_error);*/
	    exit('数据库连接失败');
	}

	return $_conn;
 }

 /**
  *_set_charset()用于设置字符编码
 */ 
function _set_charset($_conn){
	$tmp_set = $_conn -> query('SET NAMES UTF8');
	if (!$tmp_set) {
		exit("字符集错误") ;
	}
}

/*
*/
function _query($_sql, $_conn){
	if(!$result = $_conn -> query($_sql)){
		exit('SQL执行失败'.$_conn->error);
	}
	return $result;
}

/*
*/
function _fetch_array($_sql, $_conn){
	return mysqli_fetch_array(_query($_sql, $_conn));
}

/*
*/
function _is_repeat($_sql, $_info, $_conn){
	if (_fetch_array($_sql, $_conn)) {
		_alert($_info);
	}

}
?>