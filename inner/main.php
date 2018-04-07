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
	    	<!-- 发现页面 -->
	        <div class="page" id="page1">
	        	<div class="weui-search-bar" id="search_bar">
				    <form class="weui-search-bar__form">
				        <div class="weui-search-bar__box">
				            <i class="weui-icon-search"></i>
				            <input type="search" class="weui-search-bar__input" id="search_input" placeholder="搜索" />
				            <a href="javascript:" class="weui-icon-clear" id="search_clear"></a>
				        </div>
				        <label for="search_input" class="weui-search-bar__label" id="search_text">
				            <i class="weui-icon-search"></i>
				            <span>搜索</span>
				        </label>
				    </form>
				    <a href="javascript:" class="weui-search-bar__cancel-btn" id="search_cancel">取消</a>
				</div>
				<div class="weui-grids">
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_tab.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            我的收藏
				        </p>
				    </a>
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_cell.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            我的歌单
				        </p>
				    </a>
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_panel.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            每日榜单
				        </p>
				    </a>
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_icons.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            听歌识曲
				        </p>
				    </a>
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_button.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            猜你喜欢
				        </p>
				    </a>
				    <a href="javascript:;" class="weui-grid">
				        <div class="weui-grid__icon">
				            <img src="./images/icon_nav_actionSheet.png" alt="">
				        </div>
				        <p class="weui-grid__label">
				            曲库
				        </p>
				    </a>

				</div>
	        </div>
	        <!-- 歌曲发布页面 -->
	        <div class="page" id="page2">Page 2</div>

	        <!-- 个人中心页面 -->
	        <div class="page" id="page3">
	        	<div class="login-before">
	        		
	        	</div>
	        	<div>
				<div class="weui-cells" id="userline">
				    <div class="weui-cell">
				    <a class="weui-cell weui-cell_access" href="./userinfo.php">
				        <div class="weui-cell__hd"><img src="./images/pic_160.png" alt=""></div>
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
	        </div>
	    </div>


	    <!-- 底部导航 -->
	    <div class="weui-tabbar">
	        <a href="javascript:;" class="weui-tabbar__item weui-bar__item_on" id="tab1">
	            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">发现</p>
	        </a>	     
	        <a href="javascript:;" class="weui-tabbar__item" id="tab2">
	            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">发布</p>
	        </a>
	        <a href="javascript:;" class="weui-tabbar__item" id="tab3">
	            <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我</p>
	        </a>
	    </div>
	</div>
</div>
</body>
</html>