<?php
define('IN_TG', true);

require dirname(__FILE__).'/includes/common.inc.php';  
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
	<title>三站联合搜索</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/mixsearch.css">
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js""></script>
	<script type="text/javascript" src="./js/mixsearch.js"></script>
</head>
<body>
<div class="header"></div>
<!--搜索入口-->
<div id="search-area">
	<div class="search-title">
		<h2>站外音乐搜索</h2>
		<p>qq音乐、网易云音乐、虾米音乐</p>
		<p>三站联合搜索</p>	
	</div>
	<div class="search-inputs">
		<form method="post" action="getmixsearch.php">
			<div class="search-bars">
				<div>
					<input type="text" name="search-name" placeholder="搜索音乐" class="input-name">
				</div>
				<div>
					<input type="submit" name="submit-btn" value="搜索" class="search-btn">
				</div>	
			</div>
			<div class="musictype">		
				<span>
					<input type="radio" name="musictype" value="netease" checked="checked" id="netease">
					<label for="netease"></label>
					网易云音乐
				</span>

				<span>
					<input type="radio" name="musictype" value="qq" id="qq">
					<label for="qq"></label>
					qq音乐
				</span>			


				<span>
					<input type="radio" name="musictype" value="xiami" id="xiami">
					<label for="xiami"></label>
					虾米音乐
				</span>	
					
				<p>接口请求可能需要较长时间,请耐心等待或更换搜索源</p>
			</div>
		</form>
	</div>
</div>
<!--搜索结果-->
<div id="search-result">
	<div class="result-list">
		<div class="music-url">
			<span class="glyphicon glyphicon-music" aria-hidden="true"></span>
			<input readonly="">
			<a href=""><span class="glyphicon glyphicon-share" aria-hidden="true"></span></a>
		</div>
		<div class="music-download">
			<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
			<input readonly="">
			<a href="" ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
		</div>
		<div class="music-words">
			<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
			<input readonly="">
			<a href="" ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
		</div>
		<div class="music-tag">
			<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
			<input readonly="">
		</div>
		<div class="singer">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<input readonly="">
		</div>
	</div>
	<div class="result-show">
		<div class="media-play">
			

		</div>
		<div class="media-control">
			<audio controls="controls">
				<source src="" type="">
			</audio>
		</div>
		<div class="media-list">
			
		</div>
		
	</div>
</div>
</body>
</html>
