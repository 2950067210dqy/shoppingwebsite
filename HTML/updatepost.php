<?php
require '../PHP/conn.php';
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/updatepost.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script src="../JS/index.js"></script>

</head>
<body>

<!--
			存储数据
-->
<!--用来存储登录的状态-->
<input type="hidden" value="<?php
if (isset($_SESSION['id'])) {
	echo 'yes';
} else {
	echo 'no';
}
?>" id="isLogin">
<!--网页主体-->
<div class="main">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70">
		<div class="sublogo">
			<img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
	</div>
	
	<div class="update_tittle">修改评论<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">返回评论</a></div>
	
	<!--	商品详情信息-->
	<?php
	if (isset($_GET['product_id'])) {
		$product_id = intval($_GET['product_id']);
	}
	$result = $conn -> query("select * from  products where id = $product_id");
	$row = $result -> fetch_assoc();
	?>
	<div class="product_information">
		<div class="product_img">
			<img src="<?php echo $row['img_addre']; ?> " width="350" height="450" class="old_img">
			<img src="<?php echo $row['img_addre']; ?> " width="500" height="620" class="new_img">
		</div>
		<div class="information">
			<div class="product_title">
				<?php echo $row['title']; ?>
			</div>
			
			<!--			要修改的评论-->
			<!--根据传过来的商品ID和是否是一级评论区的值来分别展示要修改的评论-->
			<?php
			$sql="";
			if($_GET['reply']=='pinglun'){
				$sql="select * from user,diary where user.id=diary.user_id and diary_id={$_GET['diary_id']}";
			}
			else{
				$sql="select * from user,reply where user.id=reply.user_id  and reply_id={$_GET['reply_id']}";
			}
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			?>
<!--			要修改的评论-->
				<!--				一级评论-->
			<p style="margin-top: 5%">您要修改的评论为：</p>
				<div class="Media">
					<img class="Media-figure" src="<?php echo $row['img_addr']?>" alt="默认头像"width="100" height="100">
<!--	            评论区楼层id-->
					<font color="#808080"><?php echo "#{$_GET['floor_id']}&nbsp;&nbsp;&nbsp;&nbsp;";?></font>
					<?php
					//					检测是否为管理员
					if($row['isadmin']=='true') {
						if($row['user_id']==$_SESSION['id']){
							echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
						}
						else{
							echo "<font color='red' size='4'>[管理员]</font>{$row['name']}({$row['username']}):";
						}
						
					}
//					检测是否为当前用户
					elseif($row['user_id']==$_SESSION['id']){
						echo "<font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
					}
					else{
						echo "{$row['name']}({$row['username']}):";
					}
					?>
					<p class="Media-body">
						<?php if($_GET['reply']=="pinglun")echo $row['content'];else echo $row['reply_content'];?>
						<br>
						<br>
						<br>
						<span style="float: left">		<?php echo $row['time']?></span>
					</p>
				</div>
				
<!--				修改评论框-->
			<div class="recommendTA pinglun">
				<form
					action="../PHP/updatePost_post.php?reply=<?php echo $_GET['reply'];?>&post_id=<?php if($_GET['reply']=='pinglun') echo $_GET['diary_id'];  else echo $_GET['reply_id'];?>&url=<?php echo urlencode($_SERVER['HTTP_REFERER']);?>"
					method="post">
					<textarea placeholder="请发表您的评论哦！" name="textarea"><?php if($_GET['reply']=="pinglun")echo $row['content'];else echo $row['reply_content'];?></textarea>
					<input type="submit" name="submit" value="修改评论" class="submit">
					<input type="reset" name="reset" value="重置评论" class="reset">
				</form>
			</div>
			
			
		</div>
	</div>
	
	
	
	
</div>
</body>
</html>
