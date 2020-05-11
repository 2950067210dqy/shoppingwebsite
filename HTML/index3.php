<?php
require '../PHP/conn.php';
set_time_limit(0);
$sql="select * from boy_clothes_product";
$result=$conn->query($sql);
$i=1;
while ($row=$result->fetch_assoc()){
	$newprice=intval(substr($row['price'],3));
	$sql="update boy_clothes_product set price='$newprice' where id = {$row['id']}";
	$result2=$conn->query($sql);
	echo "更新成功{$row['id']}";
}

?>