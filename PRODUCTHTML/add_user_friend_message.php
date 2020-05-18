<!--发送添加好友请求-->
<?php
session_start();
require '../PHP/conn.php';
$user_id = null;
$send_user_id = null;
$type = null;
$user_id = $_POST['user_id'];
$send_user_id = $_POST['send_user_id'];
$type = $_POST['type'];
$sql = "select add_user_message_id from add_user_message where user_id= {$user_id} and send_user_id={$send_user_id} and type ='{$type}'";

$result = $conn -> query($sql);
if ($result -> num_rows > 0) {
	$row = $result -> fetch_assoc();
	$sql = "update add_user_message set time = null where add_user_message_id={$row['add_user_message_id']}";
	$conn -> query($sql);
} else {
	$sql = "insert into add_user_message values (null,{$user_id},{$send_user_id},'{$type}',null,null,null,'false')";
	echo $sql;
	$conn -> query($sql);
}
?>