<!--查询用户-->
<?php
session_start();
require '../PHP/conn.php';
$user_id = $_POST['user_id'];
$search_text = $_POST['search_text'];
$isadmin = $_POST['isadmin'];
$sel = $_POST['sel'];
$sql = "select * from user where $sel='$search_text' and isadmin='$isadmin'";
$result = $conn -> query($sql);
if ($result && $result -> num_rows > 0) {
	echo "<div class=\"col-lg-12 text-center\" style=\"font-size: 20px;border-bottom: 3px solid silver\">
			查询结果&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;共查询到 {$result->num_rows} 个结果！
		</div>";
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
					<p class="add_user_friend">
						<!--				查询 当前查询结果的用户是否已经是好友-->
						<?php
						$sql = "select user_friend_list_id from user_friend where user_id={$user_id} and user_friend_id={$row['id']}";
						$result2 = $conn -> query($sql);
						if ($result2 -> num_rows > 0) {
							echo "<a class=\"btn btn-success btn-block \" >用户已是您的好友</a>";
						} else {
							echo "<a class=\"btn btn-danger btn-block  add_user_friend_btn\" >加为好友</a>";
						}
						?>
						<!--			存储该用户的id-->
						<input type="hidden" value="<?php echo $row['id']; ?>" class="user_id">
					</p>
				
				</div>
			</div>
		</div>
		<?php
	}
} else {
	?>
	<div class="col-lg-12 text-center" style="font-size: 20px;border-bottom: 3px solid silver">
		查询结果
	</div>
	<div class=" col-lg-12 text-center ">
		暂无搜索结果，请更换查询关键字吧！
	</div>
	<?php
}
?>


