<?php
	ini_set("error_reporting",E_ALL ^ E_NOTICE);//
	session_start();

	define('IN_TG', true);

	require dirname(__FILE__).'/includes/common.inc.php';

	_code();

?>