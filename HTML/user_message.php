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
<!--用来存储当前登录用户的id-->
<input type="hidden" value="<?php
echo $_SESSION['id'];

?>" id="login_user_id">

<div class="main">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
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
			<div style="margin-top: 25px;width:100%">
				<div class="search">
					<div class="searchinput_shopcarinput">
						<input type="text" placeholder="请输入用户名" name="searchtext" style="display: inline;width: 20%"
						       id="search_text">
						
						<select id="search_sel" name="search_sel">
							<option value="username">用户名</option>
							<option value="email">邮箱</option>
							<option value="name">名字</option>
						</select>
						普通用户<input type="radio" class="radios" name="radio" value="false" checked="checked">
						管理员<input type="radio" class="radios" name="radio" value="true">
						<input type="image" name="search" src="../IMG/search.png"
						       style="width: 50px;height:30px;display: inline" id="search_btn">
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
	
	<!--		查找好友结果显示容器-->
	<div class="container">
		<div class="row" id="search_result">
		
		</div>
	</div>
	
	
	<div class="container">
		<div class="row" style="border-bottom: 5px black solid">
			<div class="col-lg-2" style="font-size: 22px">
				我的信息
			</div>
			<div class="col-lg-1">
				<a href="javascript:void(0)" class="btn btn-primary"
				   onclick="if(confirm('确定要清空您的消息吗?'))location.assign('../PHP/delete_user_message.php?allclean=true');">清空消息</a>
			</div>
			<div class="col-lg-1" id="batch_delete">
				<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-link">返回</a>
			</div>
		</div>
	</div>
	<div class="container" id="container">
		<?php
		$sql = "select * from add_user_message,user where user_id ={$_SESSION['id']} and add_user_message.send_user_id = user.id order by time asc";
		$result = $conn -> query($sql);
		$user_friend_nums = $result -> num_rows;
		if ($user_friend_nums > 0) {
			while ($row = $result -> fetch_assoc()) {
				?>
				<div class="row rowcontainer" style="border-bottom: 2px solid silver">
					<div class="col-lg-4">
						<div class="row">
							<div class="col-lg-12 text-center">
								<a href="user_other.php?id=<?php echo $row['id']; ?>"><img
											src="<?php echo $row['img_addr']; ?>"
											style="width: 50%;height: 50%;max-height: 50px;max-width: 50px;">
								</a>
								<span style="position: absolute;right: 0;top: 0;opacity:0.8;">
										<a href="../PHP/delete_user_message.php?id=<?php echo $row['add_user_message_id'] ?>"
										   class="btn btn-danger delete" style="display: none">删除消息</a>
									</span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<?php if ($row['sex'] == "男") echo "<span style='color: dodgerblue'>♂</span>"; else echo "<span style='color: deeppink'>♀</span>"; ?>
								<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
									<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<?php if ($row['type'] === "add") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									请求添加您为好友
								</div>
							</div>
							<div class="row result">
								<div class="col-lg-6 text-left">
									<p class="agree">
										<a class="btn btn-success btn-block " href="javascript:void(0)">同意请求</a>
										<!--										存储发信息用户的id-->
										<input type="hidden" value="<?php echo $row['id'] ?>" class="agree_user_id">
										<!--										存储当前登录用户的id-->
										<input type="hidden" value="<?php echo $_SESSION['id'] ?>"
										       class="agree_send_user_id">
										<!--										存储当前信息的id-->
										<input type="hidden" value="<?php echo $row['add_user_message_id'] ?>"
										       class="agree_add_user_message_id">
									</p>
								
								</div>
								<div class="col-lg-6 text-left">
									<p class="disagree">
										<a class="btn btn-danger btn-block " href="javascript:void(0)">拒绝请求</a>
										<!--										存储发信息用户的id-->
										<input type="hidden" value="<?php echo $row['id'] ?>" class="disagree_user_id">
										<!--存储当前登录用户的id-->
										<input type="hidden" value="<?php echo $_SESSION['id'] ?>"
										       class="disagree_send_user_id">
										<!--存储当前信息的id-->
										<input type="hidden" value="<?php echo $row['add_user_message_id'] ?>"
										       class="disagree_add_user_message_id">
									
									
									</p>
								
								</div>
							</div>
						<?php } elseif ($row['type'] === "add_true") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									请求添加您为好友
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 text-center">
									<a class="btn btn-success btn-block" href="javascript:void(0)">已经同意该请求</a>
								</div>
							</div>
						<?php } elseif ($row['type'] === "add_false") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									请求添加您为好友
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 text-center">
									<a class="btn btn-danger btn-block" href="javascript:void(0)">已经拒绝该请求</a>
								</div>
							</div>
						<?php } elseif ($row['type'] === "send_false") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									已经拒绝了您的好友请求
								</div>
							</div>
						<?php } elseif ($row['type'] === "send_true") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									已经同意了您的好友请求
								</div>
							</div>
						<?php } elseif ($row['type'] === "reply") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									<a class="btn btn-block btn-default"
									   href="product.php?id=<?php echo $row['product_id'] ?>&type=<?php echo $row['product_type'] ?>">对您的评论进行回复了,快去查看吧</a>
								</div>
							</div>
						<?php } elseif ($row['type'] === "message") { ?>
							<div class="row">
								<div class="col-lg-12 text-left">
									<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
										<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
									</a>
									<a class="btn btn-block btn-default"
									   href="message.php?id=<?php echo $row['send_user_id'] ?>">对您发消息了,快去查看吧</a>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-lg-1 ">
						<?php echo $row['time'] ?>
					</div>
				</div>
				
				
				<?php
			}
		} else {
			echo "<div class='row'><div class='col-lg-12 text-center' style='font-size: 22px'>当前暂无信息！</div></div>";
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
<script src="../JS/user_message.js"></script>
</body>
</html>

