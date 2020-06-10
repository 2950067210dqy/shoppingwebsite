<?php
session_start();
require '../../conn.php';
//单个权限操作
if (isset($_GET['id'])) {
	if (intval($_GET['id']) == 1) {
		echo "<script>alert('超级管理员不能降权');location.assign('../HTML/useradmin.php')</script>";
	} elseif (updateOne("user" , "isadmin" , 'false' , "id" , $_GET['id'] , $conn)) {
		echo "<script>alert('降权成功');location.assign('../HTML/useradmin.php')</script>";
	}
}
//全选权限操作
if (isset($_POST['choose'])) {
	$choose = $_POST['choose'];
	foreach ($choose as $key => $value) {
		$value = intval($value);
		if ($value == 1) {
			continue;
		}
		if (!updateOne("user" , "isadmin" , 'false' , "id" , $value , $conn)) {
			echo "<script>alert('$value 出现错误');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
		
	}
	echo "<script>alert('降权成功');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
} else {
	echo "<script>alert('请勾选管理员！');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>


