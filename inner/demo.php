<?php
require './includes/mysql.func.php';

if (isset($_COOKIE['username'])) {

 	$_rows = _fetch_array("SELECT we_username,we_wechatid,we_logo,we_birth,we_reg_time FROM we_user WHERE we_username='{$_COOKIE['username']}'");
 	if ($_rows) {
 		$_html = array();
 		$_html['username'] = $_rows['we_username'];
 		$_html['we_wechatid'] = $_rows['we_wechatid'];
 		$_html['we_logo'] = $_rows['we_logo'];
 		$_html['we_birth'] = $_rows['we_birth'];
 		$_html['we_reg_time'] = $_rows['we_reg_time'];
 		//$_html = _html($_html);
 	}
 	else
 		_alert('此用户不存在');
 } 
?>
<div class="weui-cells" id="userline">
	<div class="weui-cell">
		<a class="weui-cell weui-cell_access" href="./userinfo.php">
			<div class="weui-cell__hd">
				<?php echo '<img src="'.$_html['we_logo'].'" alt="">'?>
			</div>
				        <div class="weui-cell__bd">
				            <p>用户名</p>
				        </div>
				    </a>
					</div>
				</div>
				<!--<div class="weui-cells__title">带跳转的列表项</div>-->
				<div class="weui-cells">
				    <a class="weui-cell weui-cell_access" href="javascript:;">
				        <div class="weui-cell__bd">
				            <p>我的收藏</p>
				        </div>
				        <div class="weui-cell__ft">
				        </div>
				    </a>
				    <a class="weui-cell weui-cell_access" href="javascript:;">
				        <div class="weui-cell__bd">
				            <p>我的发布</p>
				        </div>
				        <div class="weui-cell__ft">
				        </div>
				    </a>
				    <a class="weui-cell weui-cell_access" href="javascript:;">
				        <div class="weui-cell__bd">
				            <p>我的互动</p>
				        </div>
				        <div class="weui-cell__ft">
				        </div>
				    </a>
				</div>
     			<div class="weui-btn-area">
    				<a class="weui-btn weui-btn_primary" href="./login.php" id="showTooltips">登陆注册</a>
				</div>