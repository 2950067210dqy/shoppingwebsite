<?php
session_start();
require '../PHP/conn.php';
$sql = "select * from user_friend,user where user_id ={$_SESSION['id']} and user_friend.user_friend_id = user.id";
$result = $conn -> query($sql);
$user_friend_nums = $result -> num_rows;
if ($user_friend_nums > 0) {
	while ($row = $result -> fetch_assoc()) {
		?>
		<div class=" col-lg-2 text-left ">
			<div class=" product_container thumbnail"
			     style="position: relative;background-color: inherit;height: 170px">
				<a href="user_other.php?id=<?php echo $row['id']; ?>"><img
							src="<?php echo $row['img_addr']; ?>"
							style="width: 50%;height: 50%;max-height: 50px;max-width: 50px;"></a>
				<div class="caption">
					<p>
						<?php if ($row['sex'] == "男") echo "<span style='color: dodgerblue'>♂</span>"; else echo "<span style='color: deeppink'>♀</span>"; ?>
						<a class="btn" href="user_other.php?id=<?php echo $row['id']; ?>">
							<span><?php echo "{$row['name']}({$row['username']})"; ?></span>
						</a>
					</p>
					<p>
						<a class="btn btn-success btn-block" href="message.php?id=<?php echo $row['id']; ?>">聊天</a>
					</p>
					<span style="position: absolute;right: 0;top: 0;opacity:0.8;">
								<a href="../PHP/delete_history.php?id=<?php echo $row['id'] ?>"
								   class="btn btn-danger delete" style="display:none;">删除好友</a>
								</span>
					<span style="position: absolute;left: 0;top: 0;opacity:0.8;">
							<input style="width: 30px;height: 30px;display:none;" type='checkbox' id='choose'
							       class="deletecheckbox checkbox three_days_ago" name='choose[]'
							       value="<?php echo $row['id'] ?>">
						</span>
				</div>
			</div>
		</div>
		<?php
	}
} else {
	echo "<div class='row'><div class='col-lg-12 text-center' style='font-size: 22px'>当前暂无好友！</div></div>";
}
?>
