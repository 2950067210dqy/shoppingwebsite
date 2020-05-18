<?php
require '../PHP/conn.php';
$id = $_POST['id'];
$sql = "update add_user_message set isread='true' where add_user_message_id ={$id}";
if ($conn -> query($sql)) {
	echo "已更新成已读";
} else {
	echo "更新已读失败";
}
?>
