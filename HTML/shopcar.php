<?php
include '../CLASS/product.php';
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
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main" >
	<div class="topnav">
		<div class="topnavin">
			<div class="place" onclick="">
				<a href="#">九江市</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='index.php' target='_self'>返回首页</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						总访问量<span class="visitsum" id="visitsum">
                            <?php

                            //数字输出网页计数器
                            $row = selectAllNoWhere("count",1,$conn);
                            $count=(int)$row['num'];
                            $count++;
                            echo $count;
                            if(updateOne("count","num",(string)$count,"num",$row['num'],$conn))
                            ?>


                        </span>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						echo  date('Y-m-d', time());
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">  更多</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">   客户服务</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../BILIBILI/bilibili.php">  会员俱乐部</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/perinfor/index.php">   我的特卖</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/myBBS/index.php">    我的订单</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../BILIBILI/bilibili.php">   签到有礼</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php? id=index_signin">   注册</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						
						if((isset($_SESSION['isadmin']))){
							echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>
										<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;'>
										&nbsp;&nbsp;&nbsp;&nbsp;<a  target='_self' onclick=\"location.assign('../PHP/update_userinfo.php?exit=true');\" href='javascript:void(0)'>退出登录</a>

						";
						}
						else{
							echo '<a href="../HTML/logoin.php" >请登录</a>';
						}
						?>
					
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	
	
	<!--	logo-->
	<div style="width: 100%;height: 110px;">
		<div class="logo_search">
			<div class="logoleft">
				<a href="#" >
					<img height="100" src="../IMG/logo.png" alt="唯品会">
				</a>
			</div>
			<div class="logoright">
				<a href="#" >
					<img height="60"  width="90" src="../IMG/logo2.png" alt="100%正品">
				</a>
				<a href="#">
					<img height="60" width="90" src="../IMG/logo3.png" alt="七天放心">
				</a>
				<a href="#">
					<img height="60" width="90" src="../IMG/logo4.png" alt="3亿会员">
				</a>
			</div>
		</div>
	</div>
	
	
	<div class="container">
		<div class="row text-left">
			<div class="col-lg-12"><font size="6"><b>购物车</b></font></div>
		</div>
		<div class="row">
			<div class="col-lg-12 center-block">
				<table class="table table-striped table-hover table-condensed ">
					<thead>
					<tr class="info">
						<th colspan="2"><input onclick='allok(this)' type='checkbox'>全选</th>
						<th colspan="2">商品信息</th>
						<th>单价</th>
						<th>数量</th>
						<th>金额</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$sql = "select id,product_id,product_type,product_num from shopcar where user_id = {$_SESSION['id']}";
					$result = $conn -> query($sql);
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							$sql2 = "select * from {$row['product_type']} where id = {$row['product_id']}";
							$result2 = $conn -> query($sql2);
							$row2 = $result2 -> fetch_assoc();
							if ($row2) {
								?>
								<tr id="shopcar<?php echo $row['id'] ?>">
									<td><input type='checkbox' id='choose' name='choose[]'
									           value="<?php echo $row['id'] ?>"></td>
									<td>店铺：<a
											href="<?php echo $row2['merchant_addre'] ?>"><?php echo $row2['merchant'] ?></a>
									</td>
									<td><a href="<?php echo $row2['product_addre'] ?>"><img
												src="<?php echo $row2['img_addre'] ?>" width="100" height="100"></a>
									</td>
									<td width="30%"><a
											href="<?php echo $row2['product_addre'] ?>"><?php echo $row2['title'] ?></a>
									</td>
									<td><font color="black" size="3"><b>￥<?php echo $row2['price'] ?></b></font></td>
									<td><?php echo $row['product_num'] ?></td>
									<td><font color="#ff4500"
									          size="3"><b>￥<?php echo $row['product_num'] * $row2['price'] ?></b></font>
									</td>
									<td>
										<p><a class="btn btn-danger"
										      href="delete_shopcar.php?id=<?php echo $row['id']; ?>">删除</a></p>
										<p><a class="btn btn-success"
										      href="insert_collect_product.php?product_id=<?php echo $row['product_id']; ?>&product_type=<?php echo $row['product_type']; ?>">加入收藏</a>
										</p>
									</td>
								</tr>
								<?php
							}
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<hr size="10">
		<div class="row " style="border: silver solid 2px;background-color: rgb(229,229,229);">
			<div class="col-lg-1 " style="background-color: inherit"><input onclick='allok(this)' type='checkbox'>全选
			</div>
			<div class="col-lg-1" style="background-color: inherit"><a class="btn btn-danger" href="#">删除</a></div>
			<div class="col-lg-1" style="background-color: inherit"><a class="btn btn-success" href="#">移入收藏夹</a></div>
			<div class="col-lg-2 col-lg-offset-3" style="background-color: inherit">已选商品：<font color="#ff4500" size="3"
			                                                                                   style="background-color: inherit">0</font>件
			</div>
			<div class="col-lg-2" style="background-color: inherit">合计：<font color="#ff4500" size="3"
			                                                                 style="background-color: inherit">￥0.00</font>
			</div>
			<div class="col-lg-2 text-right" style="background-color: inherit">
				<button type="submit" class="btn btn-danger btn-block">结&nbsp;&nbsp;算</button>
			</div>
		</div>
	</div>
	<?php
	
	
	//	session方法获取购物车 弃用
	//	  if(isset($_SESSION['product'])){
	//		    foreach ($_SESSION['product']->product_id as $value){
	//		    	echo $value+" ";
	//		    }
	//		    echo "<br>";
	//		  foreach ($_SESSION['product']->product_type as $value){
	//			  echo $value+" ";
	//		  }
	//		  echo "<br>";
	//		  foreach ($_SESSION['product']->product_price as $value){
	//			  echo $value+" ";
	//		  }
	//		  echo "<br>";
	//		  foreach ($_SESSION['product']->product_num as $value){
	//			  echo $value+" ";
	//		  }
	//		  echo "<br>";
	//		  echo $_SESSION['product']->shopnum;
	//	  }
	?>
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
</body>
</html>
