<?php
session_start();
require '../../conn.php';
$id = $_GET['product_id'];
$shop_id = $_GET['shop_id'];

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
	
	<script type="text/javascript" src="../../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../../CSSLIB/bootstrap.css" rel="stylesheet">
	<style>
		table {
			font-size: 18px;
			border-bottom: 2px silver solid;
			}
		
		/**
评论区
**/
		.Media {
			width: 67%;margin: 0 auto;
			display: flex;
			align-items: flex-start;
			border-top: 1px solid #999999;
			}
		
		.Media input[type=button] {
			width: 50px;
			}
		
		.Media input[type=submit] {
			width: 50px;
			float: right;
			border: none;
			border-bottom: 1px solid silver;
			cursor: pointer;
			color: red;
			}
		
		.Media-figure {
			margin-right: 1em;
			
			}
		
		.Media-body {
			flex: 1;
			margin-left: 5%;
			}
	
	
	</style>
</head>
<body>
<!--用来存储这个商品的多级评论条数-->
<input type="hidden" value="
<?php
$sql = "";
$RecordCounts = null;
if (isset($_GET['id'])) {
	$sql = "select * from reply where diary_id in (select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}')";
	$result = $conn -> query($sql);
	$RecordCounts = $result -> num_rows;
	echo $RecordCounts;
}
?>" id="multiNums">
<!--用来存储这个商品的一级评论条数-->
<input type="hidden" value="
<?php
//一级评论数
$RecordCount = null;
if (isset($_GET['id'])) {
	$sql = "select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}'";
	$result = $conn -> query($sql);
	$RecordCount = $result -> num_rows;
	echo $RecordCount;
}
?>" id="singleNums">
<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 2px silver solid;height: 50px;color: #5e5e5e">
		<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>商品评论<span
			class="badge"><?php echo $RecordCount + $RecordCounts ?></span>
	</div>
	
	<div class="admininformation" style="background-color: rgb(245,245,245)">
		<form class="navbar-form navbar-left">
			<a href="#foot" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 修改评论</psan></a>
		</form>
		<form class="navbar-form navbar-right" style="margin-right: 2%;" action="search_post.php" method="get">
			<div class="text-center" STYLE="position: relative">
				<input type="hidden" value="<?php echo $id ?>" name="id">
				<input type="hidden" value="<?php echo $shop_id ?>" name="shop_id">
				<input type="hidden" value="<?php echo $_GET['type'] ?>" name="type">
				<input type="text" name="searchtext" class="form-control" placeholder="您输入要查找字段的名字">
				<select class="form-control" name="sel">
					<option value="username">账号</option>
					<option value="name">用户名</option>
					<option value="content">评论内容</option>
					<option value="time">评论时间</option>
				</select>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> 查询
				</button>
				<?php
				echo "<a href='product_post_items.php?id={$id}&type={$_GET['type']}&shop_id=$shop_id' class='btn btn-default'>返回</a>";
				?>
			</div>
		</form>
		
		<!--		展示该评论区的商品-->
		<?php
		//			(不是显示全部评论才显示当前评论区商品商品)
		if ($_GET['product_id'] != "all") {
			
			?>
			<table class="table table-hover table-striped  text-center">
				<tr>
					<td>
						序号
					</td>
					<td>
						商品图片
					</td>
					<td>
						商品价格
					</td>
					<td>
						商品介绍
					</td>
					<tD>
						商品类型
					</tD>
					<td>
						店铺名
					</td>
					<td>
						店铺图标
					</td>
					<td>
						创建时间
					</td>
				</tr>
				<?php
				$product_id = null;
				if (isset($_GET['product_id'])) {
					$product_id = intval($_GET['product_id']);
				}
				$sql = "select id,title,price,img_addre,time,type,shop_id,shop_name,shop_img_addr from products,shop where id = {$product_id} and shop.shop_id=products.merchant_id";
				$result = $conn -> query($sql);
				if ($result -> num_rows > 0) {
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							?>
							<tr>
								<td>
									<em><?php echo $row['id'] ?></em>
								</td>
								<td>
									<a href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><img
											src="<?php if (substr($row['img_addre'] , 0 , 1) == ".") echo "../../" . $row['img_addre']; else echo $row['img_addre'] ?>"
											width="86" height="86" style="border-radius: 10%"></a>
								</td>
								<td>
									<span style="color: orangered">￥<?php echo $row['price'] ?></span>
								</td>
								<td>
									<a href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php echo $row['title'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php getNameByType($row['type']); ?></a>
								</td>
								<td>
									<a href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php echo $row['shop_name'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><img
											src="../../<?php echo $row['shop_img_addr'] ?>" width="86" height="86"
											style="border-radius: 10%"></a></a>
								</td>
								<td>
									<?php echo $row['time'] ?>
								</td>
							</tr>
							<?php
						}
					}
				}
				$result -> free_result();
				?>
				<tr>
					<td colspan="8" class="text-center">
						您要修改的评论为
					</td>
				</tr>
				<?php
				$sql = "";
				if ($_GET['reply'] == 'pinglun') {
					$sql = "select * from user,diary where user.id=diary.user_id and diary_id={$_GET['diary_id']}";
				} else {
					$sql = "select * from user,reply where user.id=reply.user_id  and reply_id={$_GET['reply_id']}";
				}
				$result = $conn -> query($sql);
				$row = $result -> fetch_assoc();
				?>
				<tr>
					<td colspan="8">
						<!--			要修改的评论-->
						<!--				一级评论-->
						<div class="Media">
							<img class="Media-figure" src="../../<?php echo $row['img_addr'] ?>" alt="默认头像" width="100"
							     height="100">
							<!--	            评论区楼层id-->
							<font color="#808080"><?php echo "#{$_GET['floor_id']}&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
							<?php
							//					检测是否为管理员
							if ($row['isadmin'] == 'true') {
								if ($row['user_id'] == $_SESSION['id']) {
									echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
								} else {
									echo "<font color='red' size='4'>[管理员]</font>{$row['name']}({$row['username']}):";
								}
								
							} //					检测是否为当前用户
							elseif ($row['user_id'] == $_SESSION['id']) {
								echo "<font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
							} else {
								echo "{$row['name']}({$row['username']}):";
							}
							?>
							<p class="Media-body">
								<?php if ($_GET['reply'] == "pinglun") echo $row['content']; else echo $row['reply_content']; ?>
								<br>
								<br>
								<br>
								<span style="float: left">		<?php echo $row['time'] ?></span>
							</p>
						</div>
						
						<!--				修改评论框-->
						<div class="recommendTA pinglun">
							<form
								action="../PHP/updatePost_post.php?reply=<?php echo $_GET['reply']; ?>&post_id=<?php if ($_GET['reply'] == 'pinglun') echo $_GET['diary_id']; else echo $_GET['reply_id']; ?>&url=<?php echo urlencode($_SERVER['HTTP_REFERER']); ?>"
								method="post">
								<textarea id="foot" rows="5" cols="20" placeholder="请发表您的评论哦！"
								          name="textarea"><?php if ($_GET['reply'] == "pinglun") echo $row['content']; else echo $row['reply_content']; ?></textarea>
								<input type="submit" name="submit" value="修改评论" class="submit btn btn-success">
								<input type="reset" name="reset" value="重置评论" class="reset btn btn-primary">
							</form>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="8" style="height: 50%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="8" style="height: 50%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="8" style="height: 50%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="8" style="height: 50%">&nbsp;</td>
				</tr>
			</table>
		<?php } ?>
		<!--	评论区-->
	
	
	</div>

</div>
</body>
</html>
