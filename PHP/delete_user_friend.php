<?php
session_start();
require 'conn.php';
//清空该好友的足迹
if (isset($_GET['allclean'])) {
	$sql = "select user_friend_id from user_friend where user_id={$_SESSION['id']}";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
		while ($row = $result -> fetch_assoc()) {
			//	发送消息
			$sql = "insert into add_user_message values (null,{$row['user_friend_id']},{$_SESSION['id']},'delete_friend',null,null,null,'false')";
			$conn -> query($sql);
			deleteWhereOneAnd("user_friend" , "user_friend_id" , $row['user_friend_id'] , "user_id" , $_SESSION['id'] , $conn);
			deleteWhereOneAnd("user_friend" , "user_id" , $row['user_friend_id'] , "user_friend_id" , $_SESSION['id'] , $conn);
		}
	}
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	
}
//单个好友删除
if (isset($_GET['id'])) {
	if (deleteWhereOneAnd("user_friend" , "user_friend_id" , $_GET['id'] , "user_id" , $_SESSION['id'] , $conn) &&
		deleteWhereOneAnd("user_friend" , "user_id" , $_GET['id'] , "user_friend_id" , $_SESSION['id'] , $conn)
	) {
//		发送消息
		$sql = "insert into add_user_message values (null,{$_GET['id']},{$_SESSION['id']},'delete_friend',null,null,null,'false')";
		$conn -> query($sql);
		echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
?>
