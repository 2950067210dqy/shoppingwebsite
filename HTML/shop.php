<?php
require("../PHP/conn.php");
$url = "";


$pageSize = 20;
if (isset($_GET['Page']) && (int)$_GET['Page'] > 0) {
	$page = $_GET['Page'];
} else {
	$page = 1;
}
$sql = "select id from products where merchant_id= {$_GET['id']}";
$result = $conn -> query($sql);
$RecordCount = $result -> num_rows;
$page == 1 ? $limitindex = 0 : $limitindex = ($page - 1) * $pageSize;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<link href="../CSSLIB/bootstrap-theme.css" rel="stylesheet">
	
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">
	<style>
		table {
			font-size: 20px;
			border-top: 3px silver solid;
			border-bottom: 3px silver solid;
			
			}
	</style>
</head>
<body>
<a href="#" class="btn btn-danger text-center" style="position: fixed;z-index: 99;top: 30%;right: 3%;">返回顶部</a>
<div class="main">
	<!--用来存储登录的状态-->
	<input type="hidden" value="<?php
	if (isset($_SESSION['id'])) {
		echo 'yes';
	} else {
		echo 'no';
	}
	?>" id="isLogin">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
	<div style="width: 100%;height: 110px;">
		<div class="logo_search">
			<div class="logoleft">
				<a href="index.php">
					<img height="100" src="../IMG/logo.png" alt="唯品会">
				</a>
			</div>
			<div class="logoright">
				<a href="index.php">
					<img height="60" width="90" src="../IMG/logo2.png" alt="100%正品">
				</a>
				<a href="index.php">
					<img height="60" width="90" src="../IMG/logo3.png" alt="七天放心">
				</a>
				<a href="index.php">
					<img height="60" width="90" src="../IMG/logo4.png" alt="3亿会员">
				</a>
			
			
			</div>
			<!--			搜索框/购物车-->
			<div style="margin-top: 25px">
				<div class="search">
					<div class="searchinput_shopcarinput">
						
							
							<span class="shopcar">
                        <a href="javascript:void(0)" class="shopcar">
                            <span class="shopcar_img"><img src="../IMG/shopcar.png" width="25" height="25"> </span>
                            <span class="shopcar_word">购物车</span>
                            <span
	                            class="shopcar_msg"><?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
	                            else {
		                            $sql = "select id from shopcar where user_id = {$_SESSION['id']}";
		                            $result = $conn -> query($sql);
		                            echo $result -> num_rows;
	                            } ?></span>
                        </a>
                        </span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--	店铺信息-->
	<table>
		<table class=" table table-hover table-striped  text-center">
			<form action="../PHP/delete_shop.php" method="post">
				<tr>
					<Td colspan="5">
					</Td>
					<?php
					$sql = "select * from user  where id in (select user_id from shop where shop_id ={$_GET['id']})";
					$result = $conn -> query($sql);
					$row = $result -> fetch_assoc();
					?>
					<Td>
						商家：<a href="user_other.php?id=<?php echo $row['id'] ?>"><img
								src="<?php echo $row['img_addr'] ?>" width="124" height="124"
								style="border-radius: 50%"><?php echo $row['name'] ?>(<?php echo $row['username'] ?>
						                                                             )</a>
					</Td>
				</tr>
				<tr>
					<td>
						序号
					</td>
					<td>
						店铺图标
					</td>
					<td>
						店铺名
					</td>
					<td>
						店铺介绍
					</td>
					<td>
						店铺主要类型
					</td>
					<td>
						创建时间
					</td>
				</tr>
				<?php
				//			根据是否选择价钱排序查询
				
				//			根据搜索结果查询
				$sql = "select * from shop where shop_id = {$_GET['id']}";
				$result = $conn -> query($sql);
				if ($result -> num_rows > 0) {
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							?>
							<tr>
								<td>
									<em><?php echo $row['shop_id'] ?></em>
								</td>
								<td>
									<img src="<?php echo $row['shop_img_addr'] ?>" width="86"
									     height="86" style="border-radius: 10%">
								</td>
								<td>
									
									<?php echo $row['shop_name'] ?>
								</td>
								<td>
									<?php echo $row['shop_text'] ?>
								</td>
								<td>
									<?php echo $row['shop_maintype'] ?>
								</td>
								<td>
									<?php echo $row['shop_sign_time'] ?>
								</td>
							</tr>
							<?php
						}
					}
				}
				?>
				<tr>
					<Td colspan="6" class="text-center">
						该店铺有<?php echo $RecordCount ?>个商品
					</Td>
				</tr>
		</table>
		
		<!--	信息-->
		<div class="container" style="margin-top: 1%">
			<!--			类别-->
			<div class="row">
				
				<!--			信息容器-->
				<?php
				$sql = "select products.id as p_id,type,img_addre,price,title,shop_id,shop_name,user.id as u_id,img_addr,username from shop,products,user where merchant_id ={$_GET['id']} and merchant_id = shop_id and user_id =user.id";
				$sql = $sql . " order by time desc limit $limitindex,$pageSize ";
				$result = $conn -> query($sql);
				while ($row = $result -> fetch_assoc()) {
					?>
					<div class="col-sm-4 col-xs-6 col-md-2">
						<div class="thumbnail" style="height: 380px">
							<a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"><img
									src="<?php echo $row['img_addre']; ?>"></a>
							<div class="caption">
								<span style="font-size: 20px;color: #e4393c;">￥<?php echo $row['price']; ?></span>
								<p>
									<a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"
									   class="item_title"><?php if (strlen($row['title']) > 150) echo substr($row['title'] , 0 , 150) . '....'; else echo $row['title']; ?></a>
								</p>
								<p><a href="shop.php?id=<?php echo $row['shop_id']; ?>" class="item_merchant"><font
											color="#4d88ff">●</font><?php echo $row['shop_name']; ?></a><br>
									<span class="item_merchant_place"> <a
											href="user_other.php?id=<?php echo $row['u_id'] ?>"><img
												src="<?php echo $row['img_addr'] ?>"
												style="width: 30px;height: 30px;display: inline;border-radius: 50%"><?php echo $row['username'] ?></a></span>
								</p>
							</div>
						</div>
					</div>
					
					<?php
					
				}
				?>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<!--		分页-->
					<nav class="text-center">
						<ul class="pagination">
							<?php
							if ($RecordCount > 0) {
								$url = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'];//获取当前页的URL
								$PageCount = ceil($RecordCount / $pageSize);//总页数
								page($RecordCount , $pageSize , $page , $url);
								echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
								echo " $page/$PageCount 页";
							}
							?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="footer">
			<div
				style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
				Copyright &nbsp;© &nbsp;
				2019-2020 &nbsp; qinyou.com， &nbsp;All &nbsp;Rights &nbsp; Reserved &nbsp;
				使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
				<br>
				九江学院 20180101981号 &nbsp; 赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
				<br>
				自营主体经营证照（暂无） &nbsp; 风险监测信息（暂无） &nbsp; 互联网药品信息服务资格证书：（暂无）-学习性-（暂无）&nbsp; 网络交易第三方平台备案凭证：（暂无）
				<br>
				亲爱的学生老师，九江警方反诈劝阻电话“962110”系专门针对避免您财产被骗受损而设，请您一旦收到来电，立即接听。
				<br>
				公司名称：江西九江沁柚有限公司 | 公司地址：江西省九江市濂溪区九江学院主校区 | 电话：159-7067-4596
				<br>
				注明：本网站为学生于2019年12月制作的PHP大作业，未经本人同意请勿擅自将此网站商用,否则后果自负
			</div>
		</div>
</div>
<script src="../JS/index_jquery.js"></script>
</body>

</html>
