<!--用户之间聊天（将聊天消息插入对话数据库中）-->

<?php
session_start();
require '../PHP/conn.php';
$user_id = $_POST['user_id'];
$reply_user_id = $_POST['reply_user_id'];
if (isset($_POST['message'])) {
	$message = $_POST['message'];
	$sql = "insert into message values (null,$user_id,$reply_user_id,'$message',null)";
	$conn -> query($sql);
//	发送消息
	$sql = "insert into add_user_message values (null,$user_id,$reply_user_id,'message',null,null,null)";
	$conn -> query($sql);
}
?>


<?php
$sql = "select * from (select * from message where (reply_user_id={$reply_user_id} and user_id={$user_id} ) or (reply_user_id={$user_id} and user_id={$reply_user_id})) as m,user where m.reply_user_id = user.id order by m.time asc ";
$result = $conn -> query($sql);
while ($row = $result -> fetch_assoc()) {
	if ($row) {
		?>
		<div class="row" style="margin-bottom: 5%">
			<?php if ($row['reply_user_id'] == $reply_user_id) { ?>
				<div class="col-lg-2 col-lg-offset-2 text-right">
					<img src="<?php echo $row['img_addr'] ?>" width="50%" height="50%"
					     style="max-width: 70px;max-height: 70px">
				</div>
			<?php } ?>
			<div class="col-lg-6 <?php if ($row['reply_user_id'] != $reply_user_id) echo " col-lg-offset-4 "; ?>"
			     style="background-color:<?php if ($row['reply_user_id'] == $reply_user_id) echo "silver"; else echo "rgb(1,158,210)" ?>;
					     color: <?php if ($row['reply_user_id'] == $reply_user_id) echo "black"; else echo "white" ?>;border-radius: 30%;
					     ">
				<div class="row <?php if ($row['reply_user_id'] == $reply_user_id) echo " text-left"; else echo " text-right"; ?>"
				     style="background-color: inherit;color: inherit;border-radius:inherit">
					<div class="col-lg-12  " style="background-color: inherit;color: inherit;border-radius:inherit">
						<?php if ($row['reply_user_id'] == $reply_user_id) echo "{$row['name']}({$row['username']}):"; else echo ":({$row['username']}){$row['name']}" ?>
					</div>
				</div>
				<div class="row <?php if ($row['reply_user_id'] == $reply_user_id) echo " text-left"; else echo " text-right"; ?>"
				     style="margin-top: 5%;background-color: inherit;color: inherit;border-radius:inherit">
					<div class="col-lg-11 <?php if ($row['reply_user_id'] == $reply_user_id) echo "col-lg-offset-1"; ?>"
					     style="background-color: inherit;color: inherit;border-radius:inherit">
						<?php echo "{$row['message']}" ?>
					</div>
				</div>
				<div class="row  <?php if ($row['reply_user_id'] == $reply_user_id) echo " text-left"; else echo " text-right"; ?>"
				     style="margin-top: 5%;background-color: inherit;color: inherit;border-radius:inherit">
					<div class="col-lg-11 <?php if ($row['reply_user_id'] == $reply_user_id) echo "col-lg-offset-1"; ?>"
					     style="background-color: inherit;color: inherit;border-radius:inherit">
						<?php echo "{$row['time']}" ?>
					</div>
				</div>
			</div>
			<?php if ($row['reply_user_id'] != $reply_user_id) { ?>
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
