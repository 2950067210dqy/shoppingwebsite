<!--				一级评论-->
<div class="Media">
	<img class="Media-figure" src="<?php echo $row['img_addr'] ?>" alt="默认头像" width="100" height="100">
	<!--				一级评论区楼层-->
	<font color="#808080">#<?php echo ($page - 1) * $pageSize + $postid . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
	<?php
	//					检测是否为管理员
	if ($row['isadmin'] == 'true') {
		if (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
			echo "<a class='btn btn-success' href='javascript:void(0)'>管理员</a><a class='btn btn-warning' href='javascript:void(0)'>自己</a>{$row['name']}({$row['username']}):";
		} else {
			echo "<a class='btn btn-success' href='javascript:void(0)'>管理员</a>{$row['name']}({$row['username']}):";
		}
		
	} //					检测是否为当前用户
	elseif (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
		echo "<a class='btn btn-warning' href='javascript:void(0)'>自己</a>{$row['name']}({$row['username']}):";
	} else {
		echo "{$row['name']}({$row['username']}):";
	}
	?>
	
	<p class="Media-body text-center">
							<span class="text-right" style="display: block">
							<!--								一级评论(删除评论按钮)(修改评论按钮)当为管理员或当前用户才会显示-->
							<?php
							if (isset($_SESSION['id']) && ($_SESSION['isadmin'] == 'true' || $row['user_id'] == $_SESSION['id'])) {
								echo "
								<a href='../HTML/updatepost.php?diary_id={$row['diary_id']}&reply=pinglun&product_id=$id&floor_id=$postid&type={$_GET['type']}' class='btn btn-primary'>修改</a>
								<a href='../PHP/deletePost.php?diary_id={$row['diary_id']}&reply=pinglun' class='btn btn-danger'>X</a>
";
							}
							?>
						</span>
		<br>
		<br>
		<br>
		<?php echo $row['content'] ?>
		<br>
		<br>
		<br>
		<br>
		<span style="float: left">		<?php echo $row['time'] ?></span>
		<span style="float: right"> <a href="javascript:void(0)"
		                               id="setMessage<?php echo $row['diary_id'] ?>"
		                               class="btn btn-default setMessage">评论</a> </span>
	</p>
</div>


<?php
//		         查找多级评论		通过一级评论来查找是否有一级评论的回复评论
$sql2 = " select * from user u  join reply r on r.diary_id={$row['diary_id']} and r.user_id=u.id order by reply_id";
$result2 = $conn -> query($sql2);
$row2 = null;
if ($result2 -> num_rows > 0) {
	echo "<p class=\"tipOfReply\"><a   class='tipOfReplyShow' href='javascript:void(0)'>--------该楼还有{$result2->num_rows}条评论，请点击查看详情--------</a></p>
								<div class='replyMedia'>
";
	while ($row2 = $result2 -> fetch_assoc()) {
		
		?>
		<!--				多级评论-->
		<div class="reply">
			<img class="reply_img " src=" <?php echo $row2['img_addr'] ?>" alt="默认头像" width="50" height="50">
			<!--	            多级评论区楼层-->
			<font color="#808080"><?php echo "#$postinid&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
			<font color="#999999">
				<?php
				//					检测是否为管理员
				if ($row2['isadmin'] == 'true') {
					if ($row2['user_id'] == $_SESSION['id']) {
						echo "<a class='btn btn-success' href='javascript:void(0)'>管理员</a><a class='btn btn-warning' href='javascript:void(0)'>自己</a>{$row2['name']}({$row2['username']}):";
					} else {
						echo "<a class='btn btn-success' href='javascript:void(0)'>管理员</a>{$row2['name']}({$row2['username']}):";
					}
					
				} //					检测是否为当前用户
				elseif ($row2['user_id'] == $_SESSION['id']) {
					echo "<a class='btn btn-warning' href='javascript:void(0)'>自己</a>{$row2['name']}({$row2['username']}):";
				} else {
					echo "{$row2['name']}({$row2['username']}):";
				}
				?>
				
				<?php
				if ($row2['last_id'] != 0) {
					$sql3 = "select * from user where id = (select user_id from reply where reply_id={$row2['last_id']}) ";
					$result3 = $conn -> query($sql3);
					
					if ($result3 -> num_rows > 0) {
						$row3 = $result3 -> fetch_assoc();
						//检测是否为当前用户
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
					} else {
						echo '出错了！';
					}
					
					
				}
				
				?>
			</font>
			<div class="text-right">
				<!--					多级评论(删除评论按钮)（修改按钮）当为管理员或当前用户才会显示-->
				<?php
				if (isset($_SESSION['id']) && ($_SESSION['isadmin'] == 'true' || $row2['user_id'] == $_SESSION['id'])) {
					echo "
									<a href='../HTML/updatepost.php?reply_id={$row2['reply_id']}&reply=huifu&product_id=$id&floor_id=$postinid&type={$_GET['type']}' class='btn btn-primary'>修改</a>
										<a href='../PHP/deletePost.php?reply_id={$row2['reply_id']}&reply=huifu' class='btn btn-danger ' style='display: inline'>X</a>
								";
				}
				?>
			</div>
			<p class="reply_content ">
				<br>
				
				<?php
				for ($i = 0; $i < 2; $i ++) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}
				echo $row2['reply_content']
				
				?>
				
				<br>
				<br>
				<br>
				<span style="float: left">		 <?php echo $row2['time'] ?></span>
				<span style="float: right"> <a href="javascript:void(0)"
				                               class="btn btn-default setMessageIn"
				                               id="setMessageIn<?php echo $row2['reply_id'] ?>">回复</a>
			</p>
			<!--	回复框（多级）-->
			<div class="recommendTA huifus" id="multi<?php echo $row2['diary_id'] ?>">
				<form action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id= <?php echo $row2['diary_id'] ?>&last_id= <?php echo $row2['reply_id'] ?>&reply_id= <?php echo $row2['reply_id'] ?>&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>"
				      method="post">
					<textarea
							placeholder="回复层主   <?php echo $row2['name'] ?>(<?php echo $row2['username'] ?>):	   对      <?php if ($row3['name'] != '') echo "层主    @" . $row3['name']; else echo "楼主     @" . $row['name']; ?>(<?php if ($row3['username'] != '') echo $row3['username']; else echo $row['username']; ?>)：的回复
'<?php echo $row2['reply_content'] ?>'" name="textarea"></textarea>
					<input type="submit" name="submit" value="发表评论" class="submit">
					<input type="reset" name="reset" value="重置评论" class="reset">
				</form>
			</div>
			<div style="margin-top: 4%">
			
			</div>
		</div>
		<?php
		//		    多级评论区楼层自增
		$postinid ++;
	}
	echo "		</div>
			<a  class='tipOfReplyHiden tipOfReply Media text-right ' style='display: none;width: 20%;border: none;color: #0000ee;' href='javascript:void(0)'>----点击折叠评论----</a>";
}
?>


<!--	回复框(一级)-->
<div class="recommendTA huifu" id="single<?php echo $row['diary_id'] ?>">
	<form action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id=<?php echo $row['diary_id'] ?>&last_id=0&reply_id=null&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>"
	      method="post">
					<textarea placeholder="回复楼主   <?php echo $row['name'] ?>(<?php echo $row['username'] ?>):
			'<?php echo $row['content'] ?>'" name="textarea"></textarea>
		<input type="submit" name="submit" value="发表评论" class="submit">
		<input type="reset" name="reset" value="重置评论" class="reset">
	</form>
</div>
<div style="margin-top: 4%">
</div>