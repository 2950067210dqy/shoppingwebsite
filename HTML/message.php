<?php
require('../PHP/conn.php');
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
<body id="body">
<!--存储当前用户的id-->
<input type="hidden" id="reply_user_id" value="<?php echo $_SESSION['id'] ?>">
<!--存储跟当前用户通话的用户的id-->
<input type="hidden" id="user_id" value="<?php echo $_GET['id'] ?>">
<div class="main">
	<div class="topnav">
		<div class="topnavin">
			<div class="place" onclick="">
				<a href="#">九江市</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='index.php' target='_self'>返回主页</a>
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
					<script>
						$(document).ready(function () {
							$('.shopcar').click(
								function () {
									if ($('#isLogin').val() == "no") {
										if (confirm('进入购物车需要登录哦？是否前往登录？')) {
											location.assign('../HTML/logoin.php');
										}
									} else {
										location.assign('../HTML/shopcar.php');
									}
								}
							);
						});
					</script>
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
	
	
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70">
		<div class="sublogo">
			<img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
	</div>
	
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12">
				<?php
				$sql = "select name,username from user where id ={$_GET['id']}";
				$result = $conn -> query($sql);
				$row = $result -> fetch_assoc();
				?>
				<span class="btn btn-warning btn-block"
				      style="font-size: 20px">您正在与<?php echo "{$row['name']}({$row['username']})" ?>对话<a
							class="btn btn-link" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">返回</a></span>
			
			</div>
		</div>
	</div>
	<div class="container" id="container" style="font-size: 17px;border: 5px solid silver;">
		<?php
		
		$sql = "select * from (select * from message where (reply_user_id={$_SESSION['id']} and user_id={$_GET['id']} ) or (reply_user_id={$_GET['id']} and user_id={$_SESSION['id']})) as m,user where m.reply_user_id = user.id order by m.time asc ";
		$result = $conn -> query($sql);
		while ($row = $result -> fetch_assoc()) {
			if ($row) {
				?>
				<div class="row" style="margin-bottom: 5%">
					<?php if ($row['reply_user_id'] == $_SESSION['id']) { ?>
						<div class="col-lg-2 col-lg-offset-2 text-right">
							<img src="<?php echo $row['img_addr'] ?>" width="50%" height="50%"
							     style="max-width: 70px;max-height: 70px">
						</div>
					<?php } ?>
					<div class="col-lg-6 <?php if ($row['reply_user_id'] != $_SESSION['id']) echo " col-lg-offset-4 "; ?>"
					     style="background-color:<?php if ($row['reply_user_id'] == $_SESSION['id']) echo "silver"; else echo "rgb(1,158,210)" ?>;
							     color: <?php if ($row['reply_user_id'] == $_SESSION['id']) echo "black"; else echo "white" ?>;border-radius: 30%;
							     ">
						<div class="row <?php if ($row['reply_user_id'] == $_SESSION['id']) echo " text-left"; else echo " text-right"; ?>"
						     style="background-color: inherit;color: inherit;border-radius:inherit">
							<div class="col-lg-12  "
							     style="background-color: inherit;color: inherit;border-radius:inherit">
								<?php if ($row['reply_user_id'] == $_SESSION['id']) echo "{$row['name']}({$row['username']}):"; else echo ":({$row['username']}){$row['name']}" ?>
							</div>
						</div>
						<div class="row <?php if ($row['reply_user_id'] == $_SESSION['id']) echo " text-left"; else echo " text-right"; ?>"
						     style="margin-top: 5%;background-color: inherit;color: inherit;border-radius:inherit">
							<div class="col-lg-11 <?php if ($row['reply_user_id'] == $_SESSION['id']) echo "col-lg-offset-1"; ?>"
							     style="background-color: inherit;color: inherit;border-radius:inherit">
								<?php echo "{$row['message']}" ?>
							</div>
						</div>
						<div class="row  <?php if ($row['reply_user_id'] == $_SESSION['id']) echo " text-left"; else echo " text-right"; ?>"
						     style="margin-top: 5%;background-color: inherit;color: inherit;border-radius:inherit">
							<div class="col-lg-11 <?php if ($row['reply_user_id'] == $_SESSION['id']) echo "col-lg-offset-1"; ?>"
							     style="background-color: inherit;color: inherit;border-radius:inherit">
								<?php echo "{$row['time']}" ?>
							</div>
						</div>
					</div>
					<?php if ($row['reply_user_id'] != $_SESSION['id']) { ?>
						<div class="col-lg-2  text-leftt">
							<img src="<?php echo $row['img_addr'] ?>" width="50%" height="50%"
							     style="max-width: 70px;max-height: 70px">
						</div>
					<?php } ?>
				</div>
				
				
				<?php
			}
		}
		?>
	
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<textarea id="textarea" name="textarea"
				          style="margin-top: 5%;width: 70%;height: 250px;border: 5px solid white;outline: 5px solid #00a1d6;background-color: #F4F5F7;"></textarea>
				<button type="button" id="send" class="btn btn-success">发送</button>
			</div>
		</div>
	</div>
	
	
	<div class="footer">
		Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
	</div>
</div>
<script src="../JS/message.js"></script>

</body>
</html>
