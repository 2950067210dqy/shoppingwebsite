<?php
session_start();
require '../PHP/conn.php';
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
	<script src="../JS/shopcar.js"></script>
	
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
	<!--	logo-->
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
		</div>
	</div>
	
	<form method="post" action="../PHP/delete_shopcar.php" id="form">
		<div class="container">
			<div class="row">
				<div class="col-lg-4"><font size="6"><b>购物车</b></font></div>
				<div class="col-lg-2 col-lg-offset-6 text-right"><a class="btn btn-link"
				                                                    href="<?php echo $_SERVER['HTTP_REFERER'] ?>">返回</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 center-block">
					<table class="table table-striped table-hover table-condensed ">
						<thead>
						<tr class="info">
							<th colspan="2"><input onclick='allok(this)' type='checkbox' name="allchecked">全选</th>
							<th colspan="2">商品信息</th>
							<th>单价</th>
							<th class="text-center">数量</th>
							<th>金额</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody id="container">
						<?php
						//				登陆了才会显示
						if (isset($_SESSION['id'])) {
							//						$final_num = 0;
							//						$final_price = 0;
							$sql = "select id,product_id,product_type,product_num from shopcar where user_id = {$_SESSION['id']} order by time desc";
							$result = $conn -> query($sql);
							while ($row = $result -> fetch_assoc()) {
								if ($row) {
									$sql2 = "select products.id as p_id,user.id as u_id,img_addre,price,title,shop_id,img_addr,username,shop_name,type from products,shop,user where products.id='{$row['product_id']}' and shop_id=merchant_id and user.id=user_id ";
									$result2 = $conn -> query($sql2);
									$row2 = $result2 -> fetch_assoc();
									if ($row2) {
//									$final_num += $row['product_num'];
//									$final_price += ($row['product_num'] * $row2['price']);
										?>
										
										<tr id="shopcar<?php echo $row['id'] ?>">
											<td><input type='checkbox' id='choose' class="chooseProduct" name='choose[]'
											           value="<?php echo $row['id'] ?>"></td>
											<td>店铺：<a
														href="shop.php?id=<?php echo $row2['shop_id'] ?>"><?php echo $row2['shop_name'] ?></a>
											</td>
											<td>
												<a href="../HTML/product.php?id=<?php echo $row2['p_id'] ?>&type=<?php echo $row2['type'] ?>"><img
															src="<?php echo $row2['img_addre'] ?>" width="100"
															height="100"></a>
											</td>
											<td width="30%"><a
														href="../HTML/product.php?id=<?php echo $row2['p_id'] ?>&type=<?php echo $row2['type'] ?>"><?php echo $row2['title'] ?></a>
											</td>
											<td><font color="black" size="3"><b>￥</b><b
															class="price"><?php echo $row2['price'] ?></b></font></td>
											<td class="text-center">
												<a href="javascript:void(0)" class="btn btn-default subtract"
												   title="<?php echo $row['id'] ?>">-</a>
												<input type="text" value="<?php echo $row['product_num'] ?>"
												       class="product_num"
												       style="width: 10%" title="<?php echo $row['id'] ?>">
												<a href="javascript:void(0)" class="btn btn-default add"
												   title="<?php echo $row['id'] ?>">+</a>
											</td>
											<td><font color="#ff4500"
											          size="3"><b>￥</b><b
														class="allprice"><?php echo $row['product_num'] * $row2['price'] ?></b></font>
											</td>
											<td>
												<p><a class="btn btn-danger"
												      href="../PHP/delete_shopcar.php?id=<?php echo $row['id']; ?>">删除</a>
												</p>
												<p><a class="btn btn-success"
												      href="../PHP/insert_collect_product.php?product_id=<?php echo $row['product_id']; ?>&product_type=<?php echo $row['product_type']; ?>&shopcar_id=<?php echo $row['id'] ?>">移入收藏</a>
												</p>
											</td>
										</tr>
										<?php
									}
								}
							}
						} else {
							echo "您暂未登录，登录后才能查看，快去<a href='logoin.php' class='btn btn-danger'>登录</a>吧";
						}
					?>
						</tbody>
					</table>
				</div>
			</div>
			<hr size="10">
			<div class="row " style="border: silver solid 2px;background-color: rgb(229,229,229);" id="container2">
				<div class="col-lg-1 " style="background-color: inherit"><input onclick='allok(this)' type='checkbox'
				                                                                name="allchecked">全选
				</div>
				<div class="col-lg-1" style="background-color: inherit">
					<button type="submit" class="btn btn-danger delete">删除</button>
				</div>
				<div class="col-lg-1" style="background-color: inherit">
					<button type="submit" class="btn btn-success product_collected" name="product_collected">移入收藏夹
					</button>
				</div>
				<div class="col-lg-2 col-lg-offset-3" style="background-color: inherit">已选商品：<font color="#ff4500"
				                                                                                   size="3"
				                                                                                   style="background-color: inherit"
				                                                                                   class="final_num">0</font>件
				</div>
				<div class="col-lg-2" style="background-color: inherit">合计：<font color="#ff4500" size="3"
				                                                                 style="background-color: inherit">￥<font
								color="#ff4500" size="3" style="background-color: inherit"
								class="final_price">0</font></font>
				</div>
				<div class="col-lg-2 text-right" style="background-color: inherit">
					<button type="submit" class="close_account btn btn-danger btn-block">结&nbsp;&nbsp;算</button>
				</div>
			</div>
		</div>
		
		<!--		侧边栏-->
		<div class="container"
		     style="position: fixed;top: 20%;right: 0;border: 1px black solid;width: 10%;border-radius: 5%">
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					<input onclick='allok(this)' type='checkbox' name="allchecked">全选
				</div>
			</div>
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					<button type="submit" class="delete btn btn-danger ">删除</button>
				</div>
			</div>
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					<button type="submit" class="product_collected btn btn-success " name="product_collected">移入收藏夹
					</button>
				</div>
			</div>
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					已选商品：<font color="#ff4500"
					           size="3"
					           style="background-color: inherit"
					           class="final_num">0</font>件
				</div>
			</div>
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					合计：<font color="#ff4500" size="3"
					         style="background-color: inherit">￥<font
								color="#ff4500" size="3" style="background-color: inherit"
								class="final_price">0</font></font>
				</div>
			</div>
			<div class="row text-center" style="border-bottom: 1px silver solid">
				<div class="col-lg-12">
					<button type="submit" class="close_account btn btn-danger btn-block">结&nbsp;&nbsp;算</button>
				</div>
			</div>
		</div>
	</form>
	<script>
		//			点击删除按钮 表单跳转至处理删除请求页面
		//          点击收藏按钮 表单跳转至处理收藏请求页面
		$(document).ready(function () {
			var delete1 = $('.delete');
			delete1.each(function (i) {
				$(this).on('click', function () {
					$('#form').attr('action', '../PHP/delete_shopcar.php');
				});
			});
			var product_collected = $('.product_collected');
			product_collected.each(function (i) {
				$(this).on('click', function () {
					$('#form').attr('action', '../PHP/insert_collect_product.php');
				});
			});
			var close_account = $('.close_account');
			close_account.each(function (i) {
				$(this).on('click', function () {
					$('#form').attr('action', '../PHP/close_account.php');
				});
			});
		});
	</script>
	
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
<script src="../JS/shopcar_jquery.js"></script>
</body>
</html>
