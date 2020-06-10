<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>lift</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
</head>
<style type="text/css">
	body {background: rgb(60, 68, 77);}
	
	.left {margin-top: 25px;margin-left: 30px;}
	
	a {color: snow;text-decoration: none;}
	
	a:hover {color: red;}
</style>
<body>
<div class="list-group " style="background: inherit">
	<a href="right.php" class="list-group-item active" target="right">
		<span class="glyphicon glyphicon-home" aria-hidden="true"></span> 主页
	</a>
	<a href="index/HTML/index.php" class="list-group-item " target="right">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 个人信息
	</a>
	<a href="shop/HTML/shop.php" class="list-group-item" target="right">
		<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 店 铺
	
	</a>
	<a href="product/HTML/product.php" class="list-group-item" target="right">
		<span class="glyphicon glyphicon-euro" aria-hidden="true"></span> 商品
	
	</a>
	<a href="product_post/HTML/product_post.php" class="list-group-item" target="right">
		<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 商品评论
	
	</a>
	<!--		<a href="shop_visited/HTML/shop_visited.php" class="list-group-item"  target="right">-->
	<!--			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>  店铺访问量-->
	<!--			<span class="badge">0</span>-->
	<!--		</a>-->
	<a href="../HTML/index.php" class="list-group-item" target="_parent">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span> 退出
	</a>
</div>
<script>
	//	选中菜单
	$(function () {
		var a = $('a');
		a.each(function (i) {
			$(this).on('click', function () {
				$('a').removeClass('active');
				$(this).addClass('active');
			});
		});
	});
</script>
</body>
</html>
