<?php
define('IN_TG', True);
require dirname(__FILE__).'/includes/common.inc.php'; 

$count = 0;
$_sql = "SELECT we_musicname,we_album,we_singer,we_up_time FROM we_music ORDER BY we_musicid DESC LIMIT 10";
$_result = $_conn -> query($_sql);
$_rows = [];
$_row = $_result -> fetch_array(MYSQLI_ASSOC);
do{
	$_rows[] = $_row;
	$count ++;
	$_row = $_result -> fetch_array(MYSQLI_ASSOC);
} while ($count <10 && $_row);
/*var_dump($_rows);*/
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
	<script type="text/javascript" src="./js/zepto.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
<div class="musiclib">
	<div class="weui-search-bar" id="search_bar">
		<form class="weui-search-bar__form" id="search_form" method="post" action="musicinfo.php">
			<div class="weui-search-bar__box">		    	
				<input type="text" class="weui-search-bar__input" id="search_input" name="search" placeholder="搜索" />
 				<a href="javascript:" class="weui-icon-search" id="search"></a>	
 			</div>
		</form>
	</div>
	<div class="musiclib-showbox">
		<?php foreach ($_rows as $_row) {
		?>
		<div class="musiclib-item">
			<div><a href="" class="musiclib-name" id="musiclib-name"><?php echo $_row['we_musicname']?></span></a></div>
			<div><a href="" class="musiclib-singer"><?php echo $_row['we_singer']?></a></div>
			<div><span class="musiclib-album"><?php echo $_row['we_album']?></span></div>		
			<div><span class="musiclib-uptime"><?php echo $_row['we_up_time']?></span></div>
			<form method="post" action="musicinfo.php" name="search_info">
				<input type="hidden" name="search" value="<?php echo $_row['we_musicname'];?>">
				<a href="musicinfo.php" id="music_detail_submit">more>></a>
			</form>
		</div>
		<?php	
		}?>
	</div>
	
</div>
</body>
</html>