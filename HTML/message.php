<?php
session_start();
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
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 40%;left: 100%;">返回顶部</a>
	<a href="#textarea" class="btn btn-success text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回底部</a>
	
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70">
		<div class="sublogo">
			<img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
	</div>
	<?php
	//判断该用户是否是当前用户的好友，不是则不能聊天
	$sql = "select user_friend_list_id from user_friend where user_friend_id={$_GET['id']} and user_id={$_SESSION['id']}";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0){
	?>
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
							class="btn btn-link" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">返回</a><a
							class="btn btn-link"
							href="../PHP/delete_message.php?id=<?php echo $_GET['id'] ?>">清空聊天记录</a></span>
			
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
<?php } else {
	echo "<span class=\"btn btn-warning btn-block\">您和他（她）暂不是好友哦，请成为好友再来聊天哦！<a class=\"btn btn-link\" href=\"{$_SERVER['HTTP_REFERER']}\">返回</a></span>";
} ?>
</body>
</html>
