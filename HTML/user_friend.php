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
							<input type="text" max="10" placeholder="请输入你要查找的好友的名字" name="searchtext">
							<input type="submit" name="search" value="">
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
						
						</form>
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>
