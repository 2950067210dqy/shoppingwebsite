<!--查询是否有新消息，有的话就提醒-->
<?php
session_start();
require '../PHP/conn.php';
$sql = "select  add_user_message_id from add_user_message where user_id={$_SESSION['id']}";
$result = $conn -> query($sql);
$message_num = $result -> num_rows;
if (!isset($_SESSION['message_num'])) {
	$_SESSION['message_num'] = $message_num;
	echo "<a href='user_message.php'><span >我的消息$message_num</span></a>";
} elseif ($message_num > $_SESSION['message_num']) {
	$_SESSION['message_num'] = $message_num;
	echo "<a href='user_message.php'><span class='btn btn-danger'>new！(您有新消息)$message_num</span><audio src='../MUSIC/tip.mp3' autoplay></audio></a>";
} else {
	$_SESSION['message_num'] = $message_num;
	echo "<a href='user_message.php'><span >我的消息$message_num</span></a>";
}
?>
