<?php
//require '../PHP/conn.php';
//set_time_limit(0);
//$arraylist=array(
//	"boy_shirt",
//	"boy_yurongfu",
//	"boy_jiake",
//	"boy_xifu",
//	"boy_txue",
//	"boy_xiuxianku",
//	"girl_lianyiqun",
//	"girl_banshenqun",
//	"girl_duanwaitao",
//	"girl_xiaoxizhuang",
//	"girl_yangrongshan",
//	"girl_hunsha"
//
//);
//foreach ($arraylist as $value) {
//	$sql="update $value set type='$value'";
//	if($conn->query($sql)){
//		echo 1;
//	}
////	$sql = "select * from boy_clothes_product where type ='$value'";
////	$result = $conn -> query($sql);
////	while ($row = $result -> fetch_assoc()) {
////		$sql = "insert into $value(title,price,merchant,merchant_place,merchant_addre,img_addre,product_addre,time) values ('{$row['title']}',{$row['price']},'{$row['merchant']}','{$row['merchant_place']}','{$row['merchant_addre']}','{$row['img_addre']}','{$row['product_addre']}','{$row['time']}')";
////		echo "$sql<br>";
////		echo $conn -> query($sql);
////	}
//}
$x = 1;
$a = 0;
$b = 0;
switch ($x) {
	case 0:
		$b ++;
	case 1:
		$a ++;
	case 2:
		$a ++;
		$b ++;
}
echo $a . "   " . $b;
?>