<?php
session_start();
require 'conn.php';
//清空该用户的足迹
if (isset($_GET['allclean'])) {
	deleteWhereOne("history" , "user_id" , $_SESSION['id'] , $conn);
}
//单个商品删除
if (isset($_GET['id'])) {
	if (deleteWhereOne("history" , "id" , $_GET['id'] , $conn)) {
		echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
//全选商品删除
if (isset($_POST['choose'])) {
	$choose = $_POST['choose'];
	foreach ($choose as $key => $value) {
		$value = intval($value);
		if (!deleteWhereOne("history" , "id" , $value , $conn)) {
			echo "<script>alert('$value 出现错误');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
		
	}
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
} else {
	echo "<script>alert('请勾选商品！');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>
