<?php
session_start();
require 'conn.php';
//清空该好友的足迹
if (isset($_GET['allclean'])) {
	deleteWhereOne("user_friend" , "user_id" , $_SESSION['id'] , $conn);
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
//单个好友删除
if (isset($_GET['id'])) {
	if (deleteWhereOneAnd("user_friend" , "user_friend_id" , $_GET['id'] , "user_id" , $_SESSION['id'] , $conn) &&
		deleteWhereOneAnd("user_friend" , "user_id" , $_GET['id'] , "user_friend_id" , $_SESSION['id'] , $conn)
	) {
		echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
?>
