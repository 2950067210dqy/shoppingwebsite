<?php
session_start();
require '../PHP/conn.php';
$shopcar_id = $_POST['shopcar_id'];
$product_num = $_POST['product_num'];
$sql = "";
updateOne("shopcar" , "product_num" , $product_num , "id" , $shopcar_id , $conn);
$arry = array();
?>
<?php
$sql = "select id,product_id,product_type,product_num from shopcar where user_id = {$_SESSION['id']} and id =$shopcar_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
if ($row) {
	$arry[] = $row;
}
echo json_encode($arry);
?>