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
	<script type="text/javascript" src="./js/zepto.min.js"></script>
	<script type="text/javascript" src="./js/wechat.js"></script>
</head>
<body>
<div class="change-page">
	<div class="weui-tab">
		<!-- 页面切换 -->
	    <div class="weui-tab__panel">
			   <!-- 底部导航 -->
			    <div class="weui-tabbar">
			        <a href="javascript:;" class="weui-tabbar__item weui-bar__item_on" id="tab1">
			            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
			            <p class="weui-tabbar__label">发现</p>
			        </a>	     
			        <a href="musicupload.php" class="weui-tabbar__item" id="tab2">
			            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
			            <p class="weui-tabbar__label">发布</p>
			        </a>
			        <a href="javascript:;" class="weui-tabbar__item" id="tab3">
			            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
			            <p class="weui-tabbar__label">我</p>
			        </a>
			    </div>
	    	<!-- 发现页面 -->
	        <div class="page" id="page1">
	        	<div class="weui-search-bar" id="search_bar">
				    <form class="weui-search-bar__form" id="search_form" method="post" action="musicinfo.php">
				        <div class="weui-search-bar__box">		    	
				        <input type="text" class="weui-search-bar__input" id="search_input" name="search" placeholder="搜索" />
 				          <a href="javascript:" class="weui-icon-search" id="search"></a>	
 				       </div>
				    </form>
				</div>
				<div class="weui-grids">
				    
				    <a href="dailyrank.php" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_dialog.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            每日榜单
				        </p>
				    </a>
<!-- 				    <a href="musicpush.php" class="weui-grid">
    <div class="weui-grid__icon">
        <img src="./images/icon_nav_icons.png" alt="">
    </div>
    <p class="weui-grid__label">
        猜你喜欢
    </p>
</a> -->
				    <a href="./music/index.php" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_button.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            聚合搜索				       
				        </p>
				    </a>
				    <a href="./musiclib.php" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_article.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            曲库
				        </p>
				    </a>

<!-- 				    <a href="mypost.php" class="weui-grid">
    <div class="weui-grid__icon">
        <img src="./images/icon_nav_cell.png" alt="">
    </div>
    <p class="weui-grid__label">
        未完待续
    </p>
</a> -->
				</div>
	        </div>
	        <!-- 歌曲发布页面 -->
	        <div class="page" id="page2">

	        </div>
	        <!-- 个人中心页面 -->
	        <div class="page" id="page3">
	        	<?php
	        		if (isset($_COOKIE['username'])) {
	        			$_rows = _fetch_array("SELECT we_username,we_wechatid,we_logo,we_birth,we_reg_time FROM we_user WHERE we_username='{$_COOKIE['username']}'", $_conn);
					 	if ($_rows) {
					 		$_html = array();
					 		$_html['username'] = $_rows['we_username'];
					 		$_html['logo'] = $_rows['we_logo'];
					 		
					 	}
					 	else
					 		{
					 			_alert('此用户不存在');
					 		}
					 	?>
					 	<div class="weui-cells" id="userline">
							<div class="weui-cell">
								<a class="weui-cell weui-cell_access" href="./userinfo.php">
									<div class="weui-cell__hd">
										<?php echo '<img src="'.$_html['logo'].'" alt="">';?>
									</div>
									<div class="weui-cell__bd">
										 <p><?php echo $_html['username'];?></p>
									</div>
								</a>
							</div>
						</div>
						<div class="weui-cells">
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
					 	<?php
	        		 	echo '<div class="weui-btn-area">
    							<a class="weui-btn weui-btn_primary" href="./logout.php">退出登录</a>
							</div>';


	        		 } 
	        		 else {
	        		 	echo '<div class="weui-cells" id="userline">
				    <div class="weui-cell">
				    <a class="weui-cell weui-cell_access" href="./userinfo.php">
				        <div class="weui-cell__hd"><img src="./images/icon_default/m01.png" alt=""></div>
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
				</div>';
	        		 }
	        	?>
	    	</div>
		</div>
	</div>
</div>
</body>
</html>