<?php
include '../CLASS/product.php';
session_start();
require 'conn.php';
$product = $_POST['Product'];
$result = selectOneWhereOneAnd("shopcar" , "id" , "product_id" , $product['product_id'] , "product_type" , $product['product_type'] , 0 , $conn);
if ($result -> num_rows > 0) {
	$row = $result -> fetch_array();
	if (updateOne("shopcar" , "product_num" , $product['count'] , "id" , $row[0] , $conn)) {
//		echo "更新成功";
	} else {
//		echo "更新失败";
	}
} else {
	$sql = "insert into shopcar values (null,{$product['product_id']},'{$product['product_type']}',{$_SESSION['id']},{$product['count']},null)";
	if ($conn -> query($sql)) {
//		echo "插入成功";
	} else {
//		echo "插入失败";
	}
}
$sql = "select id from shopcar where user_id={$_SESSION['id']}";
$result = $conn -> query($sql);
$_SESSION['shopnum'] = $result -> num_rows;
echo $result -> num_rows;

//cookie也不考虑了
//用session保存购物车信息（不考虑）
//if(!isset($_SESSION['product'])){
//	$_SESSION['product']=new product();
//}
//$_SESSION['product']->product_id[]=$product['product_id'];
//$_SESSION['product']->product_type[]=$product['product_type'];
//$_SESSION['product']->product_price[]=$product['price'];
//$_SESSION['product']->product_num[]=$product['count'];
//$_SESSION['product']->shopnum=$product['Shopnum'];
?>
