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
if (isset($_SESSION['id'])){
	echo 'yes';
}else{
	echo 'no';
}
?>" id="isLogin">
<!--网页主体-->
<div class="main" >
	<div class="topnav">
		<div class="topnavin">
			<div class="place" onclick="">
				<a href="#">九江市</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='index.php' target='_self' >返回主页</a>
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
						
						if((isset($_SESSION['isadmin']))){
							echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>
										<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;'>
										&nbsp;&nbsp;&nbsp;&nbsp;<a  target='_self' onclick=\"location.assign('../PHP/update_userinfo.php?exit=true');\" href='javascript:void(0)'>退出登录</a>
						";
						}
						else{
							echo '<a href="../PHP/indexLocation.php? id=index_logoin" >请登录</a>';
						}
						?>
					
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70" >
		<div class="sublogo">
			<img height="60"  width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60"  width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
	</div>
	
	<div class="update_tittle" >修改评论<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" target="_self">返回评论</a></div>
	
	<!--	商品详情信息-->
	<?php
	if (isset($_GET['product_id'])){
		$product_id=intval($_GET['product_id']);
	}
	$result=$conn->query("select * from {$_GET['type']} where id = $product_id");
	$row=$result->fetch_assoc();
	?>
	<div class="product_information">
		<div class="product_img">
			<img src="<?php echo $row['img_addre'];?> "  width="350" height="450" class="old_img">
			<img src="<?php echo $row['img_addre'];?> "  width="500" height="620" class="new_img" >
		</div>
		<div class="information">
			<div class="product_title">
				<?php echo $row['title'];?>
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
