<?php
session_start();
require 'conn.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>我的信息</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="..//JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<style>
		table {
			font-size: 20px;
			width: 80%;
			height: 100%;
			}
	</style>
</head>
<body>


<table class="table table-hover table-striped text-center">
	<tr>
		<td colspan="2">
			<h2>沁柚网后台管理(当前用户数据)</h2>
		</td>
	</tr>
	<?php
	$sql = "select * from user where id ={$_SESSION['id']}";
	$result = $conn -> query($sql);
	$rows = $result -> fetch_assoc();
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户序号:
		</td>
		<td>
			<em><?php echo $rows['id'] ?></em>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户头像:
		</td>
		<td>
			<img src="<?php echo $rows['img_addr'] ?>" width="106" height="106" style="border-radius: 10%">
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户账号:
		</td>
		<td>
			<?php echo $rows['username'] ?>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户名:
		</td>
		<Td>
			<?php echo $rows['name'] ?>
		</Td>
	</tr>
	<?php
	$sql = "select * from shop where user_id = {$_SESSION['id']} order by shop_sign_time asc";
	$result = $conn -> query($sql);
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>店铺数量:
		</td>
		<td>
			<span class="badge"><h5><?php echo $result -> num_rows ?></h5></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>店铺首次创建时间:
		</td>
		<td>
			<?php if ($result -> num_rows > 0) {
				$row3 = $result -> fetch_assoc();
				echo $row3['shop_sign_time'];
			} else echo "暂未创建" ?>
		</td>
	</tr>
	<?php
	$sql = "select time from products where merchant_id in (select shop_id from shop where user_id={$_SESSION['id']}) order by time asc";
	$result = $conn -> query($sql);
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>商品数量:
		</td>
		<td>
			<span class="badge"><h5><?php echo $result -> num_rows ?></h5></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>商品首次创建时间:
		</td>
		<td>
			<?php if ($result -> num_rows > 0) {
				$row4 = $result -> fetch_assoc();
				echo $row4['time'];
			} else echo "暂未创建" ?>
		</td>
	</tr>
	<?php
	$num = 0;
	$sql = "select diary_id,time from diary where product_id in (select id from products where merchant_id in (select shop_id from shop where user_id ={$_SESSION['id']})) order by time";
	$result = $conn -> query($sql);
	$num = $num + ($result -> num_rows);
	$time = "暂未创建";
	$flag = true;
	if ($result -> num_rows > 0) {
		while ($row = $result -> fetch_assoc()) {
			if ($flag) {
				$time = $row['time'];
				$flag = false;
			}
			$sql = "select reply_id from reply where diary_id ={$row['diary_id']} ";
			$result2 = $conn -> query($sql);
			$num = $num + $result2 -> num_rows;
		}
	}
	
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>商品评论数量:
		</td>
		<td>
			<span class="badge"><h5><?php echo $num ?></h5></span>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>商品首次被评论时间:
		</td>
		<td>
			<?php echo $time ?>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户注册时间:
		</td>
		<td>
			<?php echo $rows['sign_time'] ?>
		</td>
	</tr>
</table>

</body>
</html>
