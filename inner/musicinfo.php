<?php
ini_set("error_reporting",E_ALL ^ E_NOTICE);
define('IN_TG', true);

session_start();

require dirname(__FILE__).'/includes/common.inc.php';

$_aim = $_POST['search'];
$_sql1 = "SELECT we_musicid,we_musicname,we_album,we_singer,we_composer,we_writer,we_arrangement,we_producer,we_up_time,we_source1,we_source1_url,we_source2,we_source2_url,we_logo FROM we_music WHERE we_musicname='{$_aim}' or we_singer='{$_aim}'";

if (!!$_rows = _fetch_array($_sql1, $_conn)) {
	$_clean = array();
	$_clean['musicid'] =$_rows['we_musicid'];
	$_clean['musicname'] = $_rows['we_musicname'];
	$_clean['album'] = $_rows['we_album'];
	$_clean['singer'] = $_rows['we_singer'];
	$_clean['composer'] = $_rows['we_composer'];
	$_clean['writer'] = $_rows['we_writer'];
	$_clean['arrangement'] = $_rows['we_arrangement'];
	$_clean['producer'] = $_rows['we_producer'];
	$_clean['up_time'] = $_rows['we_up_time'];
	$_clean['source1'] = $_rows['we_source1'];
	$_clean['source1_url'] = $_rows['we_source1_url'];
	$_clean['source2'] = $_rows['we_source2'];
	$_clean['source2_url'] = $_rows['we_source2_url'];
	$_clean['logo'] = $_rows['we_logo'];
	
	
	$_sql2 = "SELECT we_musicid,we_username,we_com_time,we_message FROM we_comment WHERE we_musicid='{$_clean['musicid']}' ORDER BY we_comment_id DESC";
	$_result = $_conn -> query($_sql2);
	$_results = [];
	$_row = $_result -> fetch_array(MYSQLI_ASSOC);
	do{
		$_results[] = $_row;
		$_row = $_result -> fetch_array(MYSQLI_ASSOC);
	} while ($_row);
	_close($_conn);
}
else{
	_alert('no'.$_aim.'关键词不存在');
}

?>
<!DOCTYPE html>
<html lang='zh-CN'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>歌曲详情</title>
	<link rel="stylesheet" type="text/css" href="./css/weui.min.css">
	<link rel="stylesheet" type="text/css" href="./css/mystyle.css">
	
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/zepto.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
<div class="musicinfo-basic">
	<div class="musicinfo-head"></div>
	<div class="musicinfo-title" id="musicinfo-title">
		<img src="<?php echo $_clean['logo']?>">
		<div><?php echo $_clean['musicname']?></div>				
	</div>
	<div class="musicinfo-writers">
		<span>歌手：<?php echo $_clean['singer']?></span>
		&nbsp;&nbsp;
		<span>专辑：<?php echo $_clean['album']?></span>
		<br>
		<span>作曲：<?php echo $_clean['composer']?></span>
		<?php
			if ($_clean['writer'] != null) {
				 echo '<br><span>作词：'.$_clean['writer'].'</span>';
				}
			if ($_clean['arrangement'] != null) {
				 echo '<br><span>编曲：'.$_clean['arrangement'].'</span>';
				}
			if ($_clean['producer'] != null) {
				 echo '<br><span>制作：'.$_clean['producer'].'</span>';
				}  
		?>
	</div>
	<div class="musicinfo-source">
		<span>音源：</span>
		<a href="<?php echo $_clean['source1_url']?>"><?php echo $_clean['source1']?></a>
		<?php
			if ($_clean['source2'] != null) {
			 	?>
			 	<a href="<?php echo $_clean['source2_url']?>"><?phpecho $_clean['source2']?></a>
				 <?php
				} 
		?>
	</div>

</div>
<div class="musicinfo-comment-area">
	<form method="post" action="savecom.php">
		<textarea class="comment-input" name="content"></textarea>
		<input type="hidden" name="musicid" value="<?php echo $_clean['musicid']?>">
		<input type="submit" name="comment_submit" class="comment_submit weui-btn" value="评论">
	</form>		
</div>

<div class="musicinfo-comments">
	<div class="comment-title">
		<p>最新评论</p>
	</div>
	<?php
		foreach ($_results as $_row) {
	?>
	<div class="comment-box">
		<div class="comment-id"><?php echo $_row['we_username']?></div>
		<div class="comment-contend"><?php echo $_row['we_message']?></div>
		<div class="comment-time"><?php echo $_row['we_com_time']?></div>		
	</div>
	<?php
		}
	?>

</div>
</body>
</html>