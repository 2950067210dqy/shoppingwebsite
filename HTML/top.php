<?php


?>
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
					您是第<span class="visitsum" id="visitsum">
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
				<li style="color: rgb(157,157,157); font-weight: bold">
					/
				</li>
				<li>
					<?php
					if ((isset($_SESSION['isadmin'])) && $_SESSION['isadmin'] == 'merchant') {
						echo "<a href=\"../Background/main.php\"> 后台管理</a>";
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
					$sql = "select add_user_message_id from add_user_message where user_id ={$_SESSION['id']} and isread ='false'";
					$result = $conn -> query($sql);
					if ($result -> num_rows > 0) {
						echo "<li id='message_num'><a href='user_message.php'><span class='btn btn-danger'>您有{$result->num_rows}条新消息!</span><audio src='../MUSIC/tip.mp3' autoplay></audio></a></li>
								<li style=\"color: rgb(157,157,157); font-weight: bold\">
									/
									</li>";
					} else {
						echo "<li id='message_num'><a href='user_message.php'><a href='user_message.php'><span >我的消息</span></a></li>	<li style=\"color: rgb(157,157,157); font-weight: bold\">
									/
									</li>";
					}
				}
				?>
				<?php
				if ((isset($_SESSION['isadmin']))) {
					echo "<li ><a href='user_friend.php'>我的好友</a></li><li style=\"color: rgb(157,157,157); font-weight: bold\">
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
							class="badge"><?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
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
<?php
if ((isset($_SESSION['isadmin']))) {
	echo "<script src=\"../JS/refresh_message_num.js\"></script>";
}
?>

	

	
	