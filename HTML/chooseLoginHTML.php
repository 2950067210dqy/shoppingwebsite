<?php
session_start();
require '../PHP/conn.php';

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>个人信息</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/user.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="../JS/update.js">
	
	</script>
</head>
<body>
<div class="main">
	<!--	获取网页顶部导航栏-->
	<!--	--><?php //require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70">
		<div class="sublogo">
			<img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
	</div>
	<div class="information ">
		<div class="position">
			<?php
			
			if ((isset($_SESSION['isadmin']))) {
				echo "<a href=\"../PHP/userLocation.php? id=user_user\" >{$_SESSION['name']},你好</a>
					<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \"
";
			} else {
				echo '<a href="../PHP/userLocation.php? id=user_logoin" >请登录</a>';
			}
			?>
			<span>您当前的位置: <a href="../PHP/userLocation.php? id=index_back">首页</a> <—— 选择</span>
		</div>
		
		<div class="container" style="margin-top: 150px;background: transparent">
			<div class="row" style="background: inherit">
				<div class="col-sm-6 col-md-6 " style="background: inherit">
					<div class="btn btn-primary" style="width: 100%;height: 200px;padding:25% 0px;font-size: 22px"
					     id="toFore">
						前往沁柚网网页
					</div>
				</div>
				<div class="col-sm-6 col-md-6 " style="background: inherit">
					<div class="btn btn-success" style="width: 100%;height: 200px;padding:25% 0px;font-size: 22px"
					     id="toBack">
						前往沁柚网后台管理端
					</div>
				</div>
			
			</div>
		</div>
	
	</div>
	<div class="footer">
		Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
	</div>
</div>
</div>
<script>
	$(function () {
		$('#toFore').on('click', function () {
			location.assign('index.php');
		});
		$('#toBack').on('click', function () {
			location.assign('../Background/main.php');
		});
	});


</script>
</body>
</html>
