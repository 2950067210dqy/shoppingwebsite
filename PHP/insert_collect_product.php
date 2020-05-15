<?php
session_start();
require 'conn.php';
//单选收藏
//逻辑为 首先查找收藏夹数据库是否有这个商品的信息
//如果有的话 就不进行插入操作而是进行一个更新（更新时间）操作
//没有的话   就进行插入操作
//最后删除购物车数据库的商品记录
if (isset($_GET['product_id'])) {
	$result = selectOneWhereTwoAnd("product_collected" , "id" , "product_id" , $_GET['product_id'] , "product_type" , $_GET['product_type'] , "user_id" , $_SESSION['id'] , 0 , $conn);
	if ($result -> num_rows > 0) {
		$row = $result -> fetch_array();
		if (updateOne("product_collected" , "time" , 'null' , "id" , $row[0] , $conn)) {
//		echo "更新成功";
			deleteWhereOne("shopcar" , "id" , $_GET['shopcar_id'] , $conn);
			echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		} else {
//		echo "更新失败";
			echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
	} else {
		$sql = "insert into product_collected values (null,{$_GET['product_id']},'{$_GET['product_type']}',{$_SESSION['id']},null)";
		if ($conn -> query($sql)) {
			deleteWhereOne("shopcar" , "id" , $_GET['shopcar_id'] , $conn);
			echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
//		echo "插入成功";
		} else {
//		echo "插入失败";
			echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
		}
	}
} //多选收藏
elseif (isset($_POST['choose'])) {
	$choose = $_POST['choose'];
	foreach ($choose as $key => $value) {
		$value = intval($value);
		$sql = "select product_id,product_type from shopcar where id =$value";
		$row = $conn -> query($sql) -> fetch_assoc();
		$result = selectOneWhereTwoAnd("product_collected" , "id" , "product_id" , $row['product_id'] , "product_type" , $row['product_type'] , "user_id" , $_SESSION['id'] , 0 , $conn);
		if ($result -> num_rows > 0) {
			$row = $result -> fetch_array();
			if (updateOne("product_collected" , "time" , 'null' , "id" , $row[0] , $conn)) {
				//		echo "更新成功";
				deleteWhereOne("shopcar" , "id" , $value , $conn);
			} else {
				//		echo "更新失败";
			}
		} else {
			$sql = "insert into product_collected values (null,{$row['product_id']},'{$row['product_type']}',{$_SESSION['id']},null)";
			if ($conn -> query($sql)) {
				deleteWhereOne("shopcar" , "id" , $value , $conn);
				//		echo "插入成功";
			} else {
				//		echo "插入失败";
			}
		}
	}
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
} //商品详情页面点击收藏
else if (isset($_POST['Product'])) {
	$product = $_POST['Product'];
	$result = selectOneWhereTwoAnd("product_collected" , "id" , "product_id" , $product['product_id'] , "product_type" , $product['product_type'] , "user_id" , $_SESSION['id'] , 0 , $conn);
	if ($result -> num_rows > 0) {
		$row = $result -> fetch_array();
		if (updateOne("product_collected" , "time" , "null" , "id" , $row[0] , $conn)) {
//		echo "更新成功";
		} else {
//		echo "更新失败";
		}
	} else {
		$sql = "insert into product_collected values (null,{$product['product_id']},'{$product['product_type']}',{$_SESSION['id']},null)";
		if ($conn -> query($sql)) {
//		echo "插入成功";
		} else {
//		echo "插入失败";
		}
	}
} else {
	echo "<script>alert('请勾选商品！');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}


?>