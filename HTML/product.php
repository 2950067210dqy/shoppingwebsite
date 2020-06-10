<?php
require '../PHP/conn.php';
$row3 = null;
//如果用户登陆了 就把此商品加入到历史足迹中去
if (isset($_SESSION['id'])) {
	$sql = "select id from history where product_id={$_GET['id']} and product_type ='{$_GET['type']}' and user_id = {$_SESSION['id']}";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
		$row = $result -> fetch_assoc();
		$sql = "update history set time = null where id ={$row['id']}";
		$conn -> query($sql);
	} else {
		$sql = "insert into history values (null,{$_GET['id']},'{$_GET['type']}',{$_SESSION['id']},null)";
		$conn -> query($sql);
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/product.css" rel="stylesheet" type="text/css">
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js" id="js1"></script>
	<script type="text/javascript" src="../JSLIB/vue.js" id="js2"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js" id="js3"></script>
	<script src="../JSLIB/bootstrap.js" id="js4"></script>

</head>
<body>

<!--
			存储数据
-->
<!--用来存储这个商品的多级评论条数-->
<input type="hidden" value="
<?php
$RecordCounts=null;
if(isset($_GET['id'])){
	$sql="select * from reply where diary_id in (select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}')";
	$result=$conn->query($sql);
	$RecordCounts=$result->num_rows;
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
<!--用来存储登录的状态-->
<input type="hidden" value="<?php
if (isset($_SESSION['id'])) {
	echo 'yes';
} else {
	echo 'no';
}
?>" id="isLogin">
<!--用来存储当前商品的ID-->
<input type="hidden" value="<?php echo $_GET['id'] ?>" id="productid">
<!--用来存储当前商品的类型-->
<input type="hidden" value="<?php echo $_GET['type'] ?>" id="producttype">
<!--用来存储评论的从哪显示-->
<!--<input type="hidden" value="5" id="postNum">-->


<!--网页主体-->
<div class="main">
	<div class="topnav">
		<div class="topnavin">
			<div class="place">
				<a href="websitedir.php">网站目录文件</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='../../index.html' target='_self'>返回网站导航</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href='index.php' target='_self'>返回主页</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						你是第<span class="visitsum" id="visitsum">
                            <?php
                            $count = "";
                            //数字输出网页计数器
                            $row = selectAllNoWhere("count" , 1 , $conn);
                            $count = (int)$row['num'];
                            if (!isset($_SESSION['connected'])) {
	                            $count ++;
	                            updateOne("count" , "num" , (string)$count , "num" , $row['num'] , $conn);
	                            $_SESSION['connected'] = true;
                            }
                            $countlen = strlen($count);
                            $num = null;
                            for ($i = 0; $i < $countlen; $i ++) {
	                            $num = $num . "<img src='../IMG/" . substr($count , $i , 1) . ".png' width='17' height='20'>";
                            }
                            echo $num;

                            ?>


                        </span>
						位访客
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						echo date('Y-m-d' , time());
						?>
					</li>
					<?php
					if (isset($_SESSION['isadmin'])) {
						if ($_SESSION['isadmin'] == 'merchant') {
							echo "<li style=\"color: rgb(157,157,157); font-weight: bold\">/</li><li><a href=\"merchant.php?id={$_SESSION['id']}\"> 我的店铺</a></li>";
						}
					}
					
					?>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						if (isset($_SESSION['isadmin'])) {
							if ($_SESSION['isadmin'] == 'merchant' || $_SESSION['isadmin'] == 'true') {
								
								echo "<a href=\"../Background/main.php\"> 后台管理</a>";
								
							}
						} else {
							echo "<a href=\"../PHP/indexLocation.php\"> 更多</a>";
						}
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					
					<?php
					if ((isset($_SESSION['isadmin']))) {
						echo "<li id='message_num'><a href='user_message.php'><span >我的消息</span></a></li>
					<li style=\"color: rgb(157,157,157); font-weight: bold\">
						/
					</li>";
					}
					?>
					
					
					<?php
					if ((isset($_SESSION['isadmin']))) {
						echo "<li><a href='user_friend.php'>我的好友</a></li>
					<li style=\"color: rgb(157,157,157); font-weight: bold\">
						/
					</li>";
					}
					?>
					
					<li>
						<a href="#"> 我的订单</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="product_collected.php"> 我的收藏</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="javascript:void(0)" class="shopcar">
							我的购物车<span
								class="shopcar_msg badge"><?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
								else {
									$sql = "select id from shopcar where user_id = {$_SESSION['id']}";
									$result = $conn -> query($sql);
									echo $result -> num_rows;
								} ?></span></a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php? id=index_signin"> 注册</a>
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
	                        <span class="shopcar_msg">
		                      <?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
		                      else {
			                      $sql = "select id from shopcar where user_id = {$_SESSION['id']}";
			                      $result = $conn -> query($sql);
			                      echo $result -> num_rows;
		                      } ?>
	                        </span>
                        </a>
                    </span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!--	商品详情信息-->
	<?php
	if (isset($_GET['id'])) {
		$id = intval($_GET['id']);
	}
	$result = $conn -> query("select * from  products,shop where id = $id and merchant_id =shop_id");
	$row = $result -> fetch_assoc();
	?>
	<form action="../PHP/close_account.php" method="post">
		<div class="product_information">
			<div class="product_img ">
				<img src="<?php echo $row['img_addre']; ?> " width="350" height="450" class="old_img">
				<img src="<?php echo $row['img_addre']; ?> " width="500" height="620" class="new_img">
			</div>
			<div class="information">
				<div class="product_title">
					<?php echo $row['title']; ?>
					<!--				判断是否已经被收藏-->
					<?php
					$isCollected = 1;
					if (!isset($_SESSION['id'])) {
						$isCollected = 0;
					} else {
						$sql = "select id from product_collected where product_id={$_GET['id']} and product_type='{$_GET['type']}' and user_id={$_SESSION['id']}";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							$isCollected = 1;
						} else {
							$isCollected = 0;
						}
					}
					
					?>
					<?php
					if ($isCollected) {
						echo "<a href=\"javascript:void(0)\" class=\"btn btn-warning\" id='isCollected' >已收藏</a>";
					} else {
						echo "<a href=\"javascript:void(0)\" class=\"btn btn-success\"  id='isCollect'>收藏</a>";
					}
					?>
					<!--				判断是否已经被加入购物车-->
					<?php
					$isShopcar = 1;
					if (!isset($_SESSION['id'])) {
						$isShopcar = 0;
					} else {
						$sql = "select id from shopcar where product_id={$_GET['id']} and product_type='{$_GET['type']}' and user_id={$_SESSION['id']}";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							$isShopcar = 1;
						} else {
							$isShopcar = 0;
						}
					}
					
					?>
					<?php
					if ($isShopcar) {
						echo "<a href=\"#inshopcar\" class=\"btn btn-warning\"  id='isShopcar'>已加入购物车</a>";
					} else {
						echo "<a href=\"#inshopcar\" class=\"btn btn-danger\"  id='isShopcar'>未加入购物车</a>";
					}
					?>
				
				</div>
				<div class="product_title">
					<font size="2px" color="#999999"><a
								href="shop.php?id=<?php echo $row['shop_id'] ?>">❥<?php echo $row['shop_name']; ?></a></font>
				</div>
				<div class="sale_price">
					<div class="price">
						<font size="2px" color="#999999">沁&nbsp;&nbsp;柚&nbsp;&nbsp;价</font>
						<font style="margin-left: 2%;" color="#e4393c" size="6px">
							￥<font id="price"><?php echo intval($row['price']); ?></font>
						</font>
					</div>
					<div class="sale">
						<font size="2px" color="#999999">促&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;销</font>
						<font style="margin-left: 3%;">暂无促销</font>
					</div>
				</div>
				
				
				<div class="num" id="inshopcar">
					<font size="2px" color="#999999">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量</font>
					<input type="button" value="-" id="cut">
					<input type="tel" value="1" id="product_num">
					<input type="button" value="+" id="add">
					<br>
					<br>
					<br>
					<font size="2px" color="#999999">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</font>
					<font style="margin-left: 2%;" color="#e4393c" size="6px">
						￥<font id="all_price"><?php echo intval($row['price']); ?></font>
					</font>
				</div>
				
				<div class="buy_shopcar">
					<button type="submit">立即购买</button>
					<button type="button" id="addShopCar">加入购物车</button>
				</div>
				
				<div class="tip">
					<font size="2px" color="#999999">温馨提示</font>
					<font style="margin-left: 2%;" color="#999999" size="2px">
						·支持7天无理由退货
					</font>
				</div>
			
			</div>
		</div>
	</form>
	
	<!--	推荐区-->
	<div class="shopRecommend text-center" id="container">
		<table>
			<tr>
				<th colspan="5">
					<div class="text-center">猜你喜欢<a href="javascript:void(0)"
					                                style="cursor: pointer;background-color: transparent;font-size: 12px;color: white"
					                                id="<?php echo $_GET['type'] ?>" onclick="loadXMLDoc(this.id)">点击刷新...</a>
					</div>
				</th>
			</tr>
			<?php
			//随机生成10个推荐，并显示出来
			$sql = "select id from products where type =  '{$_GET['type']}'";
			$result = $conn -> query($sql);
			$num = $result -> num_rows;
			$random = mt_rand(0 , $num - 15);
			$sql = "select products.id as p_id,user.id as u_id,img_addre,price,title,shop_id,img_addr,username,shop_name,type from products,shop,user where type='{$_GET['type']}' and shop_id=merchant_id and user.id=user_id  limit {$random},15";
			$result = $conn -> query($sql);
			$i = 1;
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					if ($i % 5 == 1) {
						echo "<tr>";
					}
					?>
					<td>
						<div class="shopItem text-left">
							<a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"><img
										src="<?php echo $row['img_addre']; ?>"></a>
							<span style="font-size: 20px;color: #e4393c;">￥&nbsp;&nbsp;<?php echo $row['price']; ?></span>
							<p><a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"
							      class="item_title"><?php if (strlen($row['title']) > 80) echo substr($row['title'] , 0 , 80) . '....'; else echo $row['title']; ?></a>
							</p>
							<p><a href="shop.php?id=<?php echo $row['shop_id']; ?>" class="item_merchant"><font
											color="#4d88ff">●</font><?php echo $row['shop_name']; ?></a><br>
								<span class="item_merchant_place"><a
											href="user_other.php?id=<?php echo $row['u_id'] ?>"> <img
												src="<?php echo $row['img_addr'] ?>"
												style="width: 30px;height: 30px;display: inline;border-radius: 50%"><?php echo $row['username'] ?></a></span>
							</p>
						</div>
					</td>
					<?php
					if ($i % 10 == 0) {
						echo "</tr>";
					}
					$i ++;
				}}
			?>
		</table>
	</div>
	
	<!--	刷新猜你喜欢-->
	<div class="text-center" id="refresh">
	<a href="javascript:void(0)" style="cursor: pointer" id="<?php echo $_GET['type']?>" onclick="loadXMLDoc(this.id)">点击刷新...</a>
	</div>
	<script>
		function loadXMLDoc(id) {
			var xmlhttp;
			if (window.XMLHttpRequest) {
				//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
				xmlhttp = new XMLHttpRequest();
			} else {
				// IE6, IE5 浏览器执行代码
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("container").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "../PRODUCTHTML/product_like.php?type=" + id, true);
			xmlhttp.send();
		}
	</script>
	
	<!--	评论区-->
	<?php
//	评论区楼层
	$postid=1;
	$postinid=1;
	?>
	<div class="shoppost">
		<div class="shoppost_title">商品评价</div>
		<!--		评价容器 异步请求获取-->
		<div id="postcontainer" class="container" style="width: 80%">
			<?PHP
			//			页码
			$pageSize=8;
			if(isset($_GET['Page'])&&(int)$_GET['Page']>0){
				$page=$_GET['Page'];
			}
			else{
				$page=1;
			}
			//		查找一级评论
			$sql="select * from user,diary where user.id=diary.user_id and product_id=$id and product_type='{$_GET['type']}' order by diary_id";
			$result=$conn->query($sql);
			$result->data_seek(($page-1)*$pageSize);
			for ($j=0;$j<$pageSize;$j++)
			{
				$row=$result->fetch_assoc();
				if ($row) {
					?>
					<div class="row text-left" style="border-bottom: 1px solid silver">
						<!--						一级评论楼层号-->
						<div class="col-lg-1 col-lg-offset-1">
							<font color="#808080">#<?php echo ($page - 1) * $pageSize + $postid . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
						</div>
						<!--						一级评论头像图-->
						<div class="col-lg-2">
							<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id']) echo 'user.php'; else echo "user_other.php?id={$row['id']}" ?>">
								<img src="<?php echo $row['img_addr'] ?>" alt="默认头像" width="100" height="100">
							</a>
						</div>
						<div class="col-lg-8">
							<div class="row">
								<!--								一级评论用户名-->
								<div class="col-lg-6">
									<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id']) echo 'user.php'; else echo "user_other.php?id={$row['id']}" ?>">
										<?php
										//					检测是否为管理员
										if ($row['isadmin'] == 'true') {
											if (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
												echo "<span class='btn btn-success' >管理员</span><span class='btn btn-warning' href='javascript:void(0)'>自己</span>{$row['name']}({$row['username']}):";
											} else {
												echo "<span class='btn btn-success' >管理员</span>{$row['name']}({$row['username']}):";
											}
											
										} //					检测是否为当前用户
										elseif (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
											echo "<span class='btn btn-warning' >自己</span>{$row['name']}({$row['username']}):";
										} else {
											echo "{$row['name']}({$row['username']}):";
										}
										?>
									</a>
								</div>
								<!--								一级评论删除评论和修改评论按钮-->
								<div class="col-lg-offset-2 col-lg-4 text-right">
									<!--								一级评论(删除评论按钮)(修改评论按钮)当为管理员或当前用户才会显示-->
									<?php
									if (isset($_SESSION['id']) && ($_SESSION['isadmin'] == 'true' || $row['user_id'] == $_SESSION['id'])) {
										echo "
								<a href='../HTML/updatepost.php?diary_id={$row['diary_id']}&reply=pinglun&product_id=$id&floor_id=$postid&type={$_GET['type']}' class='btn btn-primary'>修改</a>
								<a href='../PHP/deletePost.php?diary_id={$row['diary_id']}&reply=pinglun' class='btn btn-danger'>X</a>
";
									}
									?>
								</div>
							</div>
							<!--						一级评论用户评论内容-->
							<div class="row text-center" style="margin-top: 5%">
								<div class="col-lg-12">
									<?php echo $row['content'] ?>
								</div>
							</div>
							<!--						一级评论用户评论时间和回复按钮-->
							<div class="row" style="margin-top: 5%">
								<div class="col-lg-4 col-lg-offset-2">
									<?php echo $row['time'] ?>
								</div>
								<div class="col-lg-offset-4 col-lg-2 text-right">
									<a href="javascript:void(0)"
									   id="setMessage<?php echo $row['diary_id'] ?>"
									   class="btn btn-default setMessage">评论</a>
								</div>
							</div>
							<!--						展示这条一级评论有多少条多级评论	-->
							<?php
							//		         查找多级评论		通过一级评论来查找是否有一级评论的回复评论
							$sql2 = " select * from user u  join reply r on r.diary_id={$row['diary_id']} and r.user_id=u.id order by reply_id";
							$result2 = $conn -> query($sql2);
							$row2 = null;
							if ($result2 -> num_rows > 0) {
								echo "	<div class=\"row text-center\" style='margin-top: 3%;margin-bottom: 3%'>
								<div class=\"col-lg-12\">
									<a   class='tipOfReplyShow' href='javascript:void(0)' >--------该楼还有{$result2->num_rows}条评论，请点击查看详情--------</a>
								</div>
							</div>
							<div class=\"replypost container\" style=\"display: none;width: 135%\" >
							";
							} ?>
							<!--					多级评论-->
							
							<?php
							if ($result2 -> num_rows > 0) {
								while ($row2 = $result2 -> fetch_assoc()) {
									?>
									<div class="row text-left" style="border-top: 1px solid silver;">
										<!--						多级评论楼层-->
										<div class="col-lg-1 col-lg-offset-1">
											<font color="#808080">#<?php echo $postinid . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
										</div>
										<!--						多级评论头像图-->
										<div class="col-lg-2">
											<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row2['id']) echo 'user.php'; else echo "user_other.php?id={$row2['id']}" ?>">
												<img src="<?php echo $row2['img_addr'] ?>" alt="默认头像" width="50"
												     height="50">
											</a>
										</div>
										<div class="col-lg-8">
											<div class="row">
												<!--	多级评论用户名-->
												<div class="col-lg-8 text-left">
													<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row2['id']) echo 'user.php'; else echo "user_other.php?id={$row2['id']}" ?>">
														<?php
														//					检测是否为管理员
														if ($row2['isadmin'] == 'true') {
															if ($row2['user_id'] == $_SESSION['id']) {
																echo "<span class='btn btn-success' >管理员</span><span class='btn btn-warning' >自己</span>{$row2['name']}({$row2['username']}):";
															} else {
																echo "<span class='btn btn-success' >管理员</span>{$row2['name']}({$row2['username']}):";
															}
															
														} //					检测是否为当前用户
														elseif ($row2['user_id'] == $_SESSION['id']) {
															echo "<span class='btn btn-warning' >自己</span>{$row2['name']}({$row2['username']}):";
														} else {
															echo "{$row2['name']}({$row2['username']}):";
														}
														?>
													</a>
													<?php
													if ($row2['last_id'] != 0) {
														$sql3 = "select * from user where id = (select user_id from reply where reply_id={$row2['last_id']}) ";
														$result3 = $conn -> query($sql3);
														
														if ($result3 -> num_rows > 0) {
															$row3 = $result3 -> fetch_assoc();
															?>
															<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row3['id']) echo 'user.php'; else echo "user_other.php?id={$row3['id']}" ?>">
																<?php
																//检测是否为管理员
																if ($row3['isadmin'] == 'true') {
																	if (isset($_SESSION['id']) && $row3['id'] == $_SESSION['id']) {
																		echo "回复<a class='btn btn-success' href='javascript:void(0)'>管理员</a><a class='btn btn-warning' href='javascript:void(0)'>自己</a>@{$row3['name']}({$row3['username']}):";
																	} else {
																		echo "回复<a class='btn btn-success' href='javascript:void(0)'>管理员</a>@{$row3['name']}({$row3['username']}):";
																	}
																} //					检测是否为当前用户
																elseif (isset($_SESSION['id']) && $row3['id'] == $_SESSION['id']) {
																	echo "回复<a class='btn btn-warning' href='javascript:void(0)'>自己</a>@{$row3['name']}({$row3['username']}):";
																} else {
																	echo "回复@{$row3['name']}({$row3['username']}):";
																}
																echo "";
																?>
															</a>
															<?php
														} else {
															echo '出错了！';
														}
													}
													?>
												</div>
												<!--								多级评论删除评论和修改评论按钮-->
												<div class="col-lg-4 text-right">
													<!--					多级评论(删除评论按钮)（修改按钮）当为管理员或当前用户才会显示-->
													<?php
													if (isset($_SESSION['id']) && ($_SESSION['isadmin'] == 'true' || $row2['user_id'] == $_SESSION['id'])) {
														echo "
													<a href='../HTML/updatepost.php?reply_id={$row2['reply_id']}&reply=huifu&product_id=$id&floor_id=$postinid&type={$_GET['type']}' class='btn btn-primary'>修改</a>
													<a href='../PHP/deletePost.php?reply_id={$row2['reply_id']}&reply=huifu' class='btn btn-danger ' style='display: inline'>X</a>";
													}
													?>
												</div>
											</div>
											<!--多级评论用户评论内容-->
											<div class="row text-center" style="margin-top: 9%">
												<div class="col-lg-12">
													<?php echo $row2['reply_content'] ?>
												</div>
											</div>
											<!--多级评论用户评论时间和回复按钮-->
											<div class="row" style="margin-top: 5%">
												<div class="col-lg-5 col-lg-offset-1" style="margin-top: 5%">
													<?php echo $row2['time'] ?>
												</div>
												<div class="col-lg-offset-4 col-lg-2 text-right">
													<a href="javascript:void(0)"
													   class="btn btn-default setMessageIn"
													   id="setMessageIn<?php echo $row2['reply_id'] ?>">回复</a>
												</div>
											</div>
											<div class="huifus recommendTA row" style="display: none;">
												<!--回复框（多级）-->
												<form method="post"
												      action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id= <?php echo $row2['diary_id'] ?>&last_id= <?php echo $row2['reply_id'] ?>&reply_id= <?php echo $row2['reply_id'] ?>&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>">
													<div class="col-lg-12">
													<textarea
															placeholder="回复层主   <?php echo $row2['name'] ?>(<?php echo $row2['username'] ?>):	   对      <?php if ($row3['name'] != '') echo "层主    @" . $row3['name']; else echo "楼主     @" . $row['name']; ?>(<?php if ($row3['username'] != '') echo $row3['username']; else echo $row['username']; ?>)：的回复
														'<?php echo $row2['reply_content'] ?>'"
															name="textarea"></textarea>
													</div>
													<div class="col-lg-6">
														<input class="btn-block" type="submit" name="submit"
														       value="发表评论" class="submit">
													</div>
													<div class="col-lg-6">
														<input class="btn-block" type="reset" name="reset" value="重置评论"
														       class="reset">
													</div>
												</form>
											</div>
										
										</div>
									</div>
									<?php
									//		    多级评论区楼层自增
									$postinid ++;
								}
								echo "
	<!--							折叠多级评论-->
								<div class=\"row text-center\">
									<div class=\"col-lg-12\">
										<a  class='tipOfReplyHiden tipOfReply Media text-right ' style='width: 20%;border: none;color: #0000ee;' href='javascript:void(0)'>----点击折叠评论----</a>
									</div>
								</div>
							</div>
						";
							} ?>
						
						</div>
						<div class="huifu recommendTA" style="display: none">
							<!--	                回复框（一级）-->
							<form action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id=<?php echo $row['diary_id'] ?>&last_id=0&reply_id=null&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>"
							      method="post">
								<div class="col-lg-12 text-center">
							<textarea placeholder="回复楼主   <?php echo $row['name'] ?>(<?php echo $row['username'] ?>):
								'<?php echo $row['content'] ?>'" name="textarea"></textarea>
								</div>
								<div class="col-lg-6">
									<input class="btn-block" type="submit" name="submit" value="发表评论" class="submit">
								</div>
								<div class="col-lg-6">
									<input class="btn-block" type="reset" name="reset" value="重置评论" class="reset">
								</div>
							</form>
						</div>
					</div>
					
					
					<?php
//				一级评论区楼层自增
					$postid ++;
//				多级评论区楼层置1
					$postinid = 1;
				}}
			$result->free_result();
			?>
			
		</div>
		
<!--		分页-->
		<nav class="text-center">
			<ul class="pagination">
				<?php
				if($RecordCount>0){
					$url=$_SERVER['PHP_SELF'].'?id='.$_GET['id'].'&type='.$_GET['type'];//获取当前页的URL
					page($RecordCount,$pageSize,$page,$url);
					$PageCount=ceil($RecordCount/$pageSize);
					$PageCountadd=$RecordCounts+$RecordCount;
					echo " &nbsp;共{$PageCountadd}条记录 &nbsp;  <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this . value , '{$url}' , '{$page}' , '{$PageCount}')\">/$PageCount 页";
				}
				?>
				<script>
					//	跳转页数
					function goPage(val,url,page,pagecount) {
						if(parseInt(val)<=0){
							document.getElementById('goPage').value=1;
						}
						if(parseInt(val)>pagecount){
							document.getElementById('goPage').value=pagecount;
						}
						if(document.getElementById('goPage').value!=parseInt(page))
							location.assign(url+'&Page='+document.getElementById('goPage').value+'#refresh');
					}
				</script>
			</ul>
		</nav>
		
		
<!--		返回评论顶部-->
		<?php
		if($RecordCount>0){
			echo "	<div class=\"container text-center\" >
<!--			<a href=\"javascript:void(0);\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\" onclick=\"changePostNum();loadXMLDoc_post(parseInt(document.getElementById('productid').value),2,parseInt(document.getElementById('postNum').value));putscript()\" id=\"reonload\">加载更多...</a>-->
<!--			<a href=\"javascript:void(0);\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\"></a>-->
<!--			返回评论顶部-->
			<a href=\"#refresh\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\">返回评论顶部</a>
		</div>";
		}
		else{
			echo "	<div class=\"container text-center\" ><a href=\"javascript:void(0)\"  style=\"color: #999999;font-size: 20px;cursor: pointer;\">暂无评论,等着您来评价哦！！！！</a></div>";
		}
		?>
<!--	主评论框-->
<!--		必须登录才会显示主评论框，否则提示登录-->
		<?php
		if(isset($_SESSION['id'])) {
			?>
			<div class="recommendTA pinglun">
				<p>你想说点什么呢?</p>
				<form
					action="../PHP/insertPost.php?user_id=<?php if(isset($_SESSION['id'])) echo $_SESSION['id'] ?>&reply=pinglun&username=<?php if(isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type']?>"
					method="post">
					<textarea placeholder="请发表您的评论哦！" name="textarea" id="mainpinglun" class="form-control"
					          rows="8"></textarea>
					<input type="submit" name="submit" value="发表评论" class="submit">
					<input type="reset" name="reset" value="重置评论" class="reset">
				</form>
			</div>
			<div style="margin-top: 4%"></div>
			<?php
		}
		else{
			?>
			<div style="width: 67%;margin: auto auto;border-top: 2px solid black;text-align: center;">还没有登录不能评论哦，快去<a href="logoin.php" target="_self" style="color: #0000ee;font-size: 22px;" class="table-hover">登录</a>吧--.</div>
			<?php
		}
		?>
	</div>
	
	
	<div class="footer">
		<div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
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
<?php
if ((isset($_SESSION['isadmin']))) {
	echo "<script src=\"../JS/refresh_message_num.js\"></script>";
}
?>
<!--<script src="../JS/product_vue.js" id="js6"></script>-->

<script src="../JS/product_jquery.js" id="js7"></script>
</body>
</html>

