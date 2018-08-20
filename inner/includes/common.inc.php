<?php

//时区
date_default_timezone_set('Asia/Shanghai');

//防止页面恶意调用
if (!defined('IN_TG')) {
	exit('Secure Warning!');
}

//转换硬路径链接
define('ROOT_PATH', substr(dirname(__FILE__),0,-8));

//拒绝低版本php
if (PHP_VERSION < '5.6.0') {
	exit('This version is no supported!');
}

//引入核心函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';

//******数据库部分*****//
//数据库链接
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PWD', '');
define('DB_NAME', 'wechat');

//初始化数据库
global $_conn;
$_conn = _connect();
_set_charset($_conn); 
?>