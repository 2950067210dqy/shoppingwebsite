<?php
session_start();
require '../../conn.php';
//单个店铺删除
if (isset($_GET['id'])) {
	if (deleteWhereOne("products" , "id" , $_GET['id'] , $conn)) {
		echo "<script>alert('删除成功');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
	}
}
//全选店铺删除
if (isset($_POST['choose'])) {
	$choose = $_POST['choose'];
	foreach ($choose as $key => $value) {
		$value = intval($value);
		if (!deleteWhereOne("products" , "id" , $value , $conn)) {
			echo "<script>alert('$value 出现错误');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
		
	}
	echo "<script>alert('删除成功');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
} else {
	echo "<script>alert('请勾选店铺！');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>
