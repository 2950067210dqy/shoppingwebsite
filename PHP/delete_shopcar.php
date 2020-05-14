<?php
session_start();
require 'conn.php';
//单个商品删除
if (isset($_GET['id'])) {
	if (deleteWhereOne("shopcar" , "id" , $_GET['id'] , $conn)) {
		echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
//全选商品删除
if (isset($_POST['choose'])) {
	$choose = $_POST['choose'];
	foreach ($choose as $key => $value) {
		$value = intval($value);
		if (!deleteWhereOne("shopcar" , "id" , $value , $conn)) {
			echo "<script>alert('$value 出现错误');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
	}
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>