<!--
	好友请求消息队列执行流程：
	1.如果发过来的请求类型（type）为add_true（也就是同意好友请求）
		（1）将该用户和请求好友的用户id插入到好友数据库中
		（2）将当前的好友请求消息的请求类型（type）置为add_true
		（3）在发一条请求消息请求类型（type）为send_true给加好友的用户，提示该用户已经同意加好友
	2.如果发过来的请求类型（type）为add_false（也就是拒绝好友请求）
		（1）将当前的好友请求消息的请求类型（type）置为add_false
		（2）在发一条请求消息请求类型（type）为send_false给加好友的用户，提示该用户已经拒绝加好友
		-->
<?php
require '../PHP/conn.php';
$type = $_POST['type'];
$user_id = $_POST['user_id'];
$send_user_id = $_POST['send_user_id'];
$add_user_message_id = $_POST['add_user_message_id'];
if ($type === "add_true") {
//	插入数据到好友数据库
	$sql = "insert into user_friend values (null,{$send_user_id},{$user_id},null)";
	$conn -> query($sql);
	$sql = "insert into user_friend values (null,{$user_id},{$send_user_id},null)";
	$conn -> query($sql);
//	将当前的好友请求消息的请求类型（type）置为add_true
	$sql = "update add_user_message set type='{$type}' where add_user_message_id={$add_user_message_id}";
	$conn -> query($sql);
//	在发一条请求消息请求类型（type）为send_true给加好友的用户，提示该用户已经同意加好友
	$sql = "insert into add_user_message values (null,{$user_id},{$send_user_id},'send_true',null,null,null,'false')";
	$conn -> query($sql);
} elseif ($type = "add_false") {
//	将当前的好友请求消息的请求类型（type）置为add_false
	$sql = "update add_user_message set type='{$type}' where add_user_message_id={$add_user_message_id}";
	$conn -> query($sql);
	//	在发一条请求消息请求类型（type）为send_true给加好友的用户，提示该用户已经拒绝加好友
	$sql = "insert into add_user_message values (null,{$user_id},{$send_user_id},'send_false',null,null,null,'false')";
	$conn -> query($sql);
}
?>
