$(function(){
	$("#checkcode").bind("click", function(){
		this.src = './checkcode.php?tm'+Math.random();
	});
});