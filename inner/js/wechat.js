$(function(){
	
	//首页三个主页面的隐藏和显示
	$("#tab1").bind("click",function(){
		$("#page1").css({
			"display":"inline"
		});
		$("#page2").css({
			"display":"none"
		});
		$("#page3").css({
			"display":"none"
		});
		//变色无效！！！
/*		$("#tab1>.weui-tabbar__label").css({
			"color":"#09bb07"
		});
		$("#tab2>.weui-tabbar__label").css({
			"color":"#999"
		});
		$("#tab3>.weui-tabbar__label").css({
			"color":"#999"
		});*/
	});

	$("#tab2").bind("click",function(){
		$("#page2").css({
			"display":"inline"
		});
		$("#page1").css({
			"display":"none"
		});
		$("#page3").css({
			"display":"none"
		});
/*		$("#tab1>.weui-tabbar__label").css({
			"color":"#999"
		});
		$("#tab2>.weui-tabbar__label").css({
			"color":"#09bb07"
		});
		$("#tab3>.weui-tabbar__label").css({
			"color":"#999"
		});*/
	});

	$("#tab3").bind("click",function(){
		$("#page3").css({
			"display":"inline"
		});
		$("#page1").css({
			"display":"none"
		});
		$("#page2").css({
			"display":"none"
		});
		/*$("#tab1>.weui-tabbar__label").css({
			"color":"#999"
		});
		$("#tab2>.weui-tabbar__label").css({
			"color":"#999"
		});
		$("#tab3>.weui-tabbar__label").css({
			"color":"#09bb07"
		});*/
	});	

	$("#search").bind("click",function(){
		$("#search_form").submit();
	});

	$("#music_detail_submit").bind("click",function(){
		$("#search_form").submit();
	});
});