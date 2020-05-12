<?php
include '../CLASS/product.php';
session_start();
require 'conn.php';
$product = $_POST['Product'];
$sql = "insert into shopcar values (null,{$product['product_id']},'{$product['product_type']}',{$_SESSION['id']},{$product['count']},null)";
if ($conn -> query($sql)) {
	$_SESSION['shopnum'] = $product['shopnum'];
	echo 1;
} else {
	echo 0;
}
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
