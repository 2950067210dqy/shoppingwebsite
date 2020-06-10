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
	<?php
	$sql = "select * from count";
	$result = $conn -> query($sql);
	$row = $result -> fetch_assoc();
	?>
	<tr>
		<td colspan="2">
			<h2>沁柚网后台管理&nbsp;&nbsp;<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>网站浏览量:<span
					class="badge"><h5><?php echo $row['num'] ?></h5></span></h2>
		</td>
	</tr>
	<?php
	$sql = "select * from user where id ={$_SESSION['id']}";
	$result = $conn -> query($sql);
	$rows = $result -> fetch_assoc();
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户注册时间:
		</td>
		<td>
			<em>
				<?php echo $rows['sign_time'] ?>
			</em>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>用户类别:
		</td>
		<td>
			<em><?php getadminType($rows['isadmin']); ?></em>
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
			<em><?php echo $rows['username'] ?></em>
		</td>
	</tr>
	<?php
	$sql = "select * from shop  order by shop_sign_time asc";
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
			<em>
				<?php if ($result -> num_rows > 0) {
					$row3 = $result -> fetch_assoc();
					echo $row3['shop_sign_time'];
				} else echo "暂未创建" ?>
			</em>
		</td>
	</tr>
	<?php
	$sql = "select time from products  order by time asc";
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
			<em>
				<?php if ($result -> num_rows > 0) {
					$row4 = $result -> fetch_assoc();
					echo $row4['time'];
				} else echo "暂未创建" ?>
			</em>
		</td>
	</tr>
	<?php
	$num = 0;
	$sql = "select diary_id,time from diary  order by time";
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
			$sql = "select reply_id from reply  ";
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
			<em>
				<?php echo $time ?>
			</em>
		</td>
	</tr>
	<?php
	$sql = "select id,sign_time from user where isadmin='false' order by sign_time asc";
	$result = $conn -> query($sql);
	$row = $result -> fetch_assoc();
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>用户数量:
		</td>
		<td>
			<em>
				<span class="badge"><h5><?php echo $result -> num_rows ?></h5></span>
			</em>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>用户首次创建时间:
		</td>
		<td>
			<em>
				<?php echo $row['sign_time'] ?>
			</em>
		</td>
	</tr>
	<?php
	$sql = "select id,sign_time from user where isadmin='merchant' order by sign_time asc";
	$result = $conn -> query($sql);
	$row = $result -> fetch_assoc();
	?>
	<tr>
		<td>
			<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>商家数量:
		</td>
		<td>
			<em>
				<span class="badge"><h5><?php echo $result -> num_rows ?></h5></span>
			</em>
		</td>
	</tr>
	<tr>
		<td>
			<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>商家首次创建时间:
		</td>
		<td>
			<em>
				<?php echo $row['sign_time'] ?>
			</em>
		</td>
	</tr>
	<?php
	if ($_SESSION['name'] == 'admin' && $_SESSION['username'] == 'admin' && $_SESSION['email'] == "admin" && $_SESSION['phone'] == "admin") {
		$sql = "select id,sign_time from user where isadmin='true' order by sign_time asc";
		$result = $conn -> query($sql);
		$row = $result -> fetch_assoc();
		?>
		<tr>
			<td>
				<span class="glyphicon glyphicon-th" aria-hidden="true"></span>管理员数量:
			</td>
			<td>
				<em>
					<span class="badge"><h5><?php echo $result -> num_rows ?></h5></span>
				</em>
			</td>
		</tr>
		<tr>
			<td>
				<span class="glyphicon glyphicon-th" aria-hidden="true"></span>管理员首次创建时间:
			</td>
			<td>
				<em>
					<?php echo $row['sign_time'] ?>
				</em>
			</td>
		</tr>
		<?php
	}
	?>

</table>

</body>
</html>
