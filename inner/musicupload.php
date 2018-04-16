<?php
	//关闭php未定义变量报错
	ini_set("error_reporting",E_ALL ^ E_NOTICE);
	define('IN_TG', true);
	require dirname(__FILE__).'/includes/common.inc.php';

	//登录后才有发布权限
	if (isset($_COOKIE['username'])) {
		$_userid = _fetch_array("SELECT we_id FROM we_user WHERE we_username='{$_COOKIE['username']}'", $_conn);
		//判断提交
		if ($_GET['action'] == 'musicupload') {
		  	//引入验证文件
			require ROOT_PATH.'/includes/musicupload.func.php';
		  	
		  	date_default_timezone_set('Asia/Shanghai');

		  	//空数组存放合法数据
		  	$_clean = array();
		  	$_clean['musicname'] = _check_musicname($_POST['musicname'], 1, 40);
		  	$_clean['album'] = _check_album($_POST['album'], 1, 40);
		  	$_clean['singer'] = _check_names($_POST['singer'], 1, 20);
		  	$_clean['composer'] = _check_names($_POST['composer'], 0, 20);
		  	$_clean['writer'] = _check_names($_POST['writer'], 0, 20);
		  	$_clean['arrangement'] = _check_names($_POST['arrangement'], 0, 20);
		  	$_clean['producer'] = _check_names($_POST['producer'], 0, 20);
		  	$_clean['owner'] = $_POST['owner'];
		  	$_clean['words'] = _check_words($_POST['words'], 255);
		  	$_clean['up_userid'] = $_userid['we_id'];
		  	$_clean['up_time'] = date('Y-m-d H:i:s', time());
		  
		  	//检查歌曲是否已经存在
		  	_is_repeat("SELECT we_musicname FROM we_music WHERE we_musicname='{$_clean['musicname']}'", '此歌曲信息已存在', $_conn);

		  	//插入新歌曲数据
		  	$result = _query(
		  				"INSERT we_music
		  							(
		  								we_musicname,
		  								we_album,
		  								we_singer,
		  								we_composer,
		  								we_writer,
		  								we_arrangement,
		  								we_producer,
		  								we_owner,
		  								we_words,
		  								we_up_userid,
		  								we_up_time
		  							)
		  						VALUES
		  							(
		  								'{$_clean['musicname']}',
		  								'{$_clean['album']}',
		  								'{$_clean['singer']}',
		  								'{$_clean['composer']}',
		  								'{$_clean['writer']}',
		  								'{$_clean['arrangement']}',
		  								'{$_clean['producer']}',
		  								'{$_clean['owner']}',
		  								'{$_clean['words']}',
		  								'{$_clean['up_userid']}',
		  								'{$_clean['up_time']}'
		  							)", $_conn);
			  if ($result) {
			  	//跳转并关闭
			  	$_conn -> close();
			  	_location('歌曲添加成功','main.php');
			  }else {
			  	die("提交失败".$_conn->error);
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
	<script type="text/javascript" src="./js/signup.js"></script>
</head>
<body>
	<form method="post" action="musicupload.php?action=musicupload" name="musicupload">
		<div class="weui-cells__title">填写歌曲信息</div>
		<div class="weui-cells weui-cells_form">
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">曲名</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="musicname" maxlength="40" placeholder="请输入歌曲名"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">专辑</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="album" maxlength="40" placeholder="请输入专辑名称"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">歌手</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="singer" maxlength="20" placeholder="请输入歌手名"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">作曲</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="composer" maxlength="20" placeholder="请输入作曲"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">作词</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="writer" maxlength="20" placeholder="请输入作词"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">编曲</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="arrangement" maxlength="20" placeholder="请输入编曲"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">制作人</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="producer" maxlength="20" placeholder="请输入制作人"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">播放渠道</label></div>
		        <div class="weui-cell__bd">
		            <input class="weui-input" type="text" name="owner" maxlength="20" placeholder="请输入播放渠道"/>
		        </div>
		    </div>
		    <div class="weui-cell">
		        <div class="weui-cell__hd"><label class="weui-label">歌词</label></div>
		        <div class="weui-cell__bd">
		            <textarea class="weui-input" type="text" name="words"></textarea>
		        </div>
		    </div>
		</div>

		<div class="weui-btn-area">
		    <input class="weui-btn weui-btn_primary" id="showTooltips" type="submit" name="signup-btn" value="提交">
		</div>
	</form>
</body>
</html>
<?php
	}
	else{
		_location('登录后才有发布权限', 'login.php');
	}
?>