<?php
session_start();
require '../PHP/conn.php';
$sql = "select * from add_user_message,user where user_id ={$_SESSION['id']} and add_user_message.send_user_id = user.id order by time asc";
$result = $conn -> query($sql);
$user_friend_nums = $result -> num_rows;
if ($user_friend_nums > 0) {
	while ($row = $result -> fetch_assoc()) {
		?>
		<div class="row rowcontainer" style="border-bottom: 2px solid silver">
			<div class="col-lg-1 text-right isread">
				<!--										存储当前信息的id-->
				<input type="hidden" value="<?php echo $row['add_user_message_id'] ?>"
				       class="add_user_message_id">
				<?php if ($row['isread'] === "false") { ?>
					<span class="btn btn-danger btn-block">未读</span>
				<?php } else { ?>
					<span class="btn btn-success btn-block">已读</span>
				<?php } ?>
			</div>
			<div class="col-lg-3">
				<div class="row">
					<div class="col-lg-12 text-center">
						<a href="user_other.php?id=<?php echo $row['id']; ?>"><img
									src="<?php echo $row['img_addr']; ?>"
									style="width: 50%;height: 50%;max-height: 50px;max-width: 50px;"></a>
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
								<input type="hidden" value="<?php echo $_SESSION['id'] ?>" class="agree_send_user_id">
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
							<a class="btn btn-block btn-default"
							   href="message.php?id=<?php echo $row['send_user_id'] ?>">
								已经同意了您的好友请求,赶快和他（她）去认识下吧！
							</a>
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
				<?php } elseif ($row['type'] === "delete_friend") { ?>
					<div class="row">
						<div class="col-lg-12 text-left">
							<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
								<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
							</a>
							把您从他（她）的好友列表中删除了哦！！！
						</div>
					</div>
				<?php } elseif ($row['type'] === "delete_message") { ?>
					<div class="row">
						<div class="col-lg-12 text-left">
							<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
								<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
							</a>
							<a class="btn btn-block btn-default"
							   href="message.php?id=<?php echo $row['send_user_id'] ?>">
								把你们之间的聊天记录全部删除了哦，快去联系他看看怎么了！</a>
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
