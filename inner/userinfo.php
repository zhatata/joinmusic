<?php
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';  
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
	<script type="text/javascript" src="./js/weui.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
	<?php
	 if (isset($_COOKIE['username'])) {
	     $_rows = _fetch_array("SELECT we_username,we_wechatid,we_logo,we_birth,we_area,we_reg_time FROM we_user WHERE we_username='{$_COOKIE['username']}'", $_conn);
		if ($_rows) {
			$_html = array();
			$_html['username'] = $_rows['we_username'];
			$_html['wechatid'] = $_rows['we_wechatid'];
			$_html['logo'] = $_rows['we_logo'];
			$_html['birth'] = $_rows['we_birth'];
			$_html['area'] = $_rows['we_area'];
			$_html['reg_time'] = $_rows['we_reg_time'];
					 		
		}
		else{
			_alert('此用户不存在');
		}?>	
		<div class="weui-cells" id="userinfo">
			<div class="weui-cell">
				<div class="weui-cell__bd">
					<?php echo '<img src="'.$_html['logo'].'">';?>			
				</div>
				<div class="weui-cell__ft">
					<p>头像</p>
				</div>
			</div>
			<div class="weui-cell">
			    <div class="weui-cell__bd">
			        <p><?php echo $_html['username'];?></p>
			    </div>
			    <div class="weui-cell__ft">用户名</div>
			</div>
			<div class="weui-cell">
			    <div class="weui-cell__bd">
			        <p><?php echo $_html['wechatid'];?></p>
			    </div>
			    <div class="weui-cell__ft">微信号</div>
			</div>
			<div class="weui-cell">
			    <div class="weui-cell__bd">
			        <p><?php echo $_html['birth'];?></p>
			    </div>
			    <div class="weui-cell__ft">生日</div>
			</div>
			<div class="weui-cell">
			    <div class="weui-cell__bd">
			        <p><?php echo $_html['area'];?></p>
			    </div>
			    <div class="weui-cell__ft">地区</div>
			</div>
			<div class="weui-cell">
			    <div class="weui-cell__bd">
			        <p><?php echo $_html['reg_time'];?></p>
			    </div>
			    <div class="weui-cell__ft">注册时间</div>
			</div>
		</div>


	<?php  
	}else{
	
		_location('此用户不存在', 'login.php');
	}


 	?>
	

</body>
</html>