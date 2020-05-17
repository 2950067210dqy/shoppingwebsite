<?php
session_start();
require 'conn.php';
//清空信息的足迹
if (isset($_GET['allclean'])) {
	deleteWhereOne("add_user_message" , "user_id" , $_SESSION['id'] , $conn);
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
//单个信息删除
if (isset($_GET['id'])) {
	if (deleteWhereOne("add_user_message" , "add_user_message_id" , $_GET['id'] , $conn)
	) {
		echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
?>
