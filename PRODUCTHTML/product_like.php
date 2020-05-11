<?php require '../PHP/conn.php';
?>
<table >
	<tr>
		<th colspan="5"> <div class="text-center">猜你喜欢<a  href="javascript:void(0)" style="cursor: pointer;background-color: transparent;font-size: 12px;color: white" id="<?php echo $_GET['type']?>" onclick="loadXMLDoc(this.id)">点击刷新...</a></div></th>
	</tr>
	<?php
	//随机生成10个推荐，并显示出来
	$result = $conn->query("select id from {$_GET['type']} ");
	$num=$result->num_rows;
	$random=mt_rand(0,$num-15);
	$sql="select * from {$_GET['type']}  limit {$random},15";
	$result =$conn->query($sql);
	
	$i=1;
	if ($result->num_rows> 0) {
		while ($row = $result->fetch_assoc()) {
			if($i%5==1){
				echo "<tr>";
			}
			?>
			<td>
				<div class="shopItem text-left">
					<a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"><img src="<?php echo $row['img_addre']; ?>"></a>
					<span style="font-size: 20px;color: #e4393c;">￥&nbsp;&nbsp;<?php echo $row['price']; ?></span>
					<p><a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"
					      class="item_title"><?php if(strlen($row['title'])>80) echo substr($row['title'],0,80).'....';else echo $row['title']; ?></a></p>
					<p><a href="<?php echo $row['merchant_addre']; ?>" class="item_merchant"><font
								color="#4d88ff">●</font><?php echo $row['merchant']; ?></a>
						<span class="item_merchant_place"> <?php echo $row['merchant_place']; ?></span>
					</p>
				</div>
			</td>
			<?php
			if($i%10==0){
				echo "</tr>";
			}
			$i++;
		}}
	?>
</table>
