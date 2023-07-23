<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8" />
<title>box-orient_CSS参考手册_web前端开发参考手册系列</title>
<meta name="author" content="Joy Du(飘零雾雨), dooyoe@gmail.com, www.doyoe.com" />
<style>
h1{font:bold 20px/1.5 georgia,simsun,sans-serif;}
.box{display:-webkit-box;display:-moz-box;display:-ms-box;width:600px;height:180px;margin:0;padding:0;list-style:none;}
#box{-webkit-box-orient:horizontal;-moz-box-orient:horizontal;-ms-box-orient:horizontal;}
#box2{-webkit-box-orient:vertical;-moz-box-orient:vertical;-ms-box-orient:vertical;}
.box li:nth-child(1){-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;background:#666;}
.box li:nth-child(2){-webkit-box-flex:2;-moz-box-flex:2;-ms-box-flex:2;background:#999;}
.box li:nth-child(3){-webkit-box-flex:3;-moz-box-flex:3;-ms-box-flex:3;background:#ccc;}
</style>
</head>
<body>
<h1>子元素横向排列 box-orient:horizontal;</h1>
<ul id="box" class="box">
	<li>1</li>
	<li>2</li>
	<li>3</li>
</ul>
<h1>子元素纵向排列 box-orient:vertical;</h1>
<ul id="box2" class="box">
	<li>1</li>
	<li>2</li>
	<li>3</li>
</ul>
</body>
</html>