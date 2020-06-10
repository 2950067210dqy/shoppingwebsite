<?php
sleep(0.5);
require '../PHP/conn.php';
$type=$_GET['type'];
$typeName="";
switch ($type) {
	case    "boy_shirt":$typeName="男衬衫";	break;
	case    "boy_yurongfu":$typeName="男羽绒服";break;
	case    "boy_jiake":$typeName="男夹克";	break;
	case    "boy_xifu":$typeName="男西服套装";	break;
	case	"boy_txue":$typeName="男T恤";	break;
	case	"boy_xiuxianku":$typeName="男休闲裤";	break;
	case	"girl_lianyiqun":$typeName="女连衣裙";	break;
	case    "girl_banshenqun":$typeName="女半身裙";	break;
	case    "girl_duanwaitao":$typeName="女短外套";	break;
	case    "girl_xiaoxizhuang":$typeName="女小西装";	break;
	case    "girl_yangrongshan":$typeName="女羊绒衫";	break;
	case    "girl_hunsha":$typeName="女婚纱";	break;
	default:break;
}
?>

<?php
$result = $conn -> query("select id from products where type= '$type' ");
$random = mt_rand(0 , ($result -> num_rows) - 60);
$sql = "select products.id as p_id,user.id as u_id,img_addre,price,title,shop_id,img_addr,username,shop_name,type from products,shop,user where type='$type' and shop_id=merchant_id and user.id=user_id limit {$random},60";

//				$result =$conn->query('select * from boy_clothes_product where type=\'boy_shirt\' limit 0,60');
$i=1;
if($_GET['flag']=="false"){
	$result =$conn->query($sql);
	$rows = $result->fetch_assoc();
	echo "
<div class=\"row\" >
			<div class=\"col-lg-11 text-left\" id=\"product_type\" style=\" color: white;background-color:  rgb(1,158,210);font-size: 25px;box-shadow:0px 0px  10px 5px #aaa;\">
				$typeName
			</div>
			<div class=\"col-lg-1 text-right\"  style=\" color: white;background-color:  rgb(1,158,210);font-size: 25px;box-shadow:10px 0px  10px 5px #aaa;\">
				<a href=\"product_all.php?type=$type\" style=\"color: inherit\">更多-</a>
			</div>
<div class=\"row text-center\">
		<div class=\"col-lg-12\">
			<a  href=\"javascript:void(0)\" style=\"cursor: pointer;background-color: transparent;font-size: 12px;color: #999999;margin-top: 5%\" class=\"{$rows['type']}\" onclick=\"loadXMLDoc(this.className,1)\" id=\"refresh\">点击刷新...</a>
		</div>
	</div>";
}
$result =$conn->query($sql);
if ($result->num_rows> 0) {
	while ($row = $result->fetch_assoc()) {
		if ($i % 6 == 0) {
			echo "<div class=\"row\" >";
		}
		?>
		<div class="col-lg-2 col-md-3 col-ms-3 col-xs-6">
			<div class="item">
				<a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"><img
							src="<?php echo $row['img_addre']; ?>"></a>
				<span style="font-size: 20px;color: #e4393c;">￥<?php echo $row['price']; ?></span>
				<p><a href="product.php?id=<?php echo $row['p_id']; ?>&type=<?php echo $row['type']; ?>"
				      class="item_title"><?php if (strlen($row['title']) > 100) echo substr($row['title'] , 0 , 100) . '....'; else echo $row['title']; ?></a>
				</p>
				<p><a href="shop.php?id=<?php echo $row['shop_id'] ?>" class="item_merchant"><font
								color="#4d88ff">●</font><?php echo $row['shop_name']; ?></a><br>
					<span class="item_merchant_place"><a href="user_other.php?id=<?php echo $row['u_id'] ?>"> <img
									src="<?php echo $row['img_addr'] ?>"
									style="width: 30px;height: 30px;display: inline;border-radius: 50%"><?php echo $row['username'] ?></a></span>
				</p>
			</div>
		</div>
		<?php
		if ($i % 6 == 0) {
			echo "</div>";
		}
		$i ++;
	}}
?>