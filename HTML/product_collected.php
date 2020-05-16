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
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	
	
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">


</head>
<body>

<script src="../JS/index.js"></script>
<script src="../JS/index_jquery.js"></script>
<!--用来存储登录的状态-->
<input type="hidden" value="<?php
if (isset($_SESSION['id'])) {
	echo 'yes';
} else {
	echo 'no';
}
?>" id="isLogin">


<div class="main">
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
					<li>
						总访问量<span class="visitsum" id="visitsum">
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
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						echo date('Y-m-d' , time());
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php"> 更多</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php"> 客户服务</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						if ((isset($_SESSION['isadmin']))) {
							echo "<a href='user_friend.php'>我的好友</a>";
						} else {
							echo "<a href='#'>会员俱乐部</a>";
						}
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../../phpprojectplus/perinfor/index.php"> 我的订单</a>
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
							我的购物车<?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
							else {
								$sql = "select id from shopcar where user_id = {$_SESSION['id']}";
								$result = $conn -> query($sql);
								echo $result -> num_rows;
							} ?></a>
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
						
						if ((isset($_SESSION['isadmin']))) {
							echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>
										<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;'>
										&nbsp;&nbsp;&nbsp;&nbsp;<a  target='_self' onclick=\"location.assign('../PHP/update_userinfo.php?exit=true');\" href='javascript:void(0)'>退出登录</a>

						";
						} else {
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
				<a href="#">
					<img height="100" src="../IMG/logo.png" alt="唯品会">
				</a>
			</div>
			<div class="logoright">
				<a href="#">
					<img height="60" width="90" src="../IMG/logo2.png" alt="100%正品">
				</a>
				<a href="#">
					<img height="60" width="90" src="../IMG/logo3.png" alt="七天放心">
				</a>
				<a href="#">
					<img height="60" width="90" src="../IMG/logo4.png" alt="3亿会员">
				</a>
			</div>
			<!--	        搜索框/购物车-->
			<div style="margin-top: 25px">
				<div class="search">
					<div class="searchinput_shopcarinput">
						<form action="../PHP/server.php" method="post">
							<input type="text" max="10" placeholder="请输入你要查找的商品" name="searchtext">
							<input type="submit" name="search" value="">
							<span class="shopcar">
                        <a href="javascript:void(0)" class="shopcar">
                            <span class="shopcar_img"><img src="../IMG/shopcar.png" width="25" height="25"> </span>
                            <span class="shopcar_word">购物车</span>
                            <span class="shopcar_msg"><?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
	                            else {
		                            $sql = "select id from shopcar where user_id = {$_SESSION['id']}";
		                            $result = $conn -> query($sql);
		                            echo $result -> num_rows;
	                            } ?></span>
                        </a>
                    </span>
						
						</form>
					</div>
				</div>
				<!-- recommend 为推荐的意思-->
				<div class="recommend">
					<ul>
						<li>
							<a href="#">
								女靴
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#">
								皮衣/皮草
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#">
								女士羽绒服
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#" style="color:  rgb(250,42,131)">
								斯维奇
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#" style="color: rgb(250,42,131)">
								年终预付&nbsp;&nbsp;一件免邮
							</a>
						</li>
					
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<form action="../PHP/delete_product_collected.php" method="post">
			<div class="row" style="border-bottom: 2px silver solid  ">
				<div class="col-lg-2" style="font-size: 22px">
					我的收藏
				</div>
				<!--			留着之后查询字段-->
				<div class="col-lg-1">
					<button type="button" class="btn btn-default" id="batch_opreation">批量操作</button>
				</div>
				<div class="col-lg-1 col-lg-offset-6 text-left" style="display: none" id="batch_checkbox">
					全选<input style="width: 20px;height: 20px" type='checkbox' id='batch_choose'
					         class="checkbox-inline deletecheckbox">
				</div>
				<div class="col-lg-1" style="display: none" id="batch_delete">
					<button type="submit" class="btn btn-danger">删除商品</button>
				</div>
				<div class="col-lg-1" id="batch_delete">
					<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-link">返回</a>
				</div>
			</div>
			<div class="row">
				<?php
				//				登陆了才会显示
				if (isset($_SESSION['id'])) {
					$sql = "select id,product_id,product_type from product_collected where user_id = {$_SESSION['id']} order by time desc";
					$result = $conn -> query($sql);
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							$sql2 = "select * from {$row['product_type']} where id = {$row['product_id']}";
							$result2 = $conn -> query($sql2);
							$row2 = $result2 -> fetch_assoc();
							if ($row2) {
								?>
								<div class=" col-lg-2 text-left ">
									<div class=" product_container thumbnail"
									     style="position: relative;background-color: inherit">
										<a href="product.php?id=<?php echo $row2['id']; ?>&type=<?php echo $row2['type']; ?>"><img
													src="<?php echo $row2['img_addre']; ?>"></a>
										<div class="caption">
											<span style="font-size: 20px;color: #e4393c;">￥<?php echo $row2['price']; ?></span>
											<p>
												<a href="product.php?id=<?php echo $row2['id']; ?>&type=<?php echo $row2['type']; ?>"
												   class="item_title"
												   title="<?php echo $row2['title'] ?>"><?php if (strlen($row2['title']) > 50) echo substr($row2['title'] , 0 , 50) . '....'; else echo $row2['title']; ?></a>
											</p>
											<p><a href="<?php echo $row2['merchant_addre']; ?>"
											      title="<?php echo $row2['merchant'] ?>" class="item_merchant"><font
															color="#4d88ff">●店铺：</font><?php if (strlen($row2['merchant']) > 10) echo substr($row2['merchant'] , 0 , 10) . '....'; else echo $row2['merchant']; ?>
												</a>
											</p>
											<span style="position: absolute;right: 0;top: 0;opacity:0.8;">
							<a href="../PHP/delete_product_collected.php?id=<?php echo $row['id'] ?>"
							   class="btn btn-danger delete" style="display: none;">删除商品</a>
						</span>
											<span style="position: absolute;left: 0;top: 0;opacity:0.8;">
							<input style="display: none;width: 30px;height: 30px;" type='checkbox' id='choose'
							       class="deletecheckbox checkbox " name='choose[]' value="<?php echo $row['id'] ?>">
						</span>
										</div>
									</div>
								</div>
								<?php
							}
						}
					}
				} else {
					echo "您暂未登录，登录后才能查看，快去<a href='logoin.php' class='btn btn-danger'>登录</a>吧";
				}
				?>
			</div>
		</form>
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
<script src="../JS/product_collected.js"></script>
</body>
</html>
