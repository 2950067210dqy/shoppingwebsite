<?php
//将聊天信息变为已读
require_once '../PHP/conn.php';
$id = $_POST['id'];
$sql = "update message set isread='true' where message_id ={$id}";
if ($conn -> query($sql)) {
	echo "更新已读成功";
} else {
	echo "更新已读失败";
}
?>