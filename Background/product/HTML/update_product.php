<?php
session_start();
require '../../conn.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>我的信息</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	
	<script type="text/javascript" src="../../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../../CSSLIB/bootstrap.css" rel="stylesheet">
	<style>
		table {
			font-size: 20px;
			}
	</style>
</head>
<body>

<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 3px silver solid;height: 50px;color: #5e5e5e;">
		<span class="text-left"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>更新商品</span>
		<span style="margin-left: 80%"><a style="display: inline" class=" btn btn-default text-right"
		                                  href="productitem.php">返回</a></span>
	</div>
	
	<div class="admininformation">
		<form method="post" action="../PHP/update_product_check.php" enctype="multipart/form-data" id="form">
			
			<table class="table table-hover table-striped ">
				<?php
				$sql = "select id,title,price,img_addre,time,type,shop_id,shop_name,shop_img_addr from products,shop where merchant_id = {$_GET['id']} and shop.shop_id=products.merchant_id";
				$result = $conn -> query($sql);
				$row = $result -> fetch_assoc();
				?>
				<input type="hidden" value="<?php echo $row['shop_id'] ?>" name="shop_id">
				<input type="hidden" value="<?php echo $row['id'] ?>" name="id">
				<tr>
					<td>
						所属店铺名：
					</td>
					<td>
						<?php echo $row['shop_name'] ?>
					</td>
				</tr>
				<tr>
					<td>
						所属店铺图标：
					</td>
					<td>
						<img src="../../<?php echo $row['shop_img_addr'] ?>" width="104" height="104">
					</td>
				</tr>
				<tr>
					<td>
						商品价格（￥）：
					</td>
					<td>
						<div class="form-group" id="price_group">
							<label class="control-label" for="price"> </label>
							<input type="text" name="price" id="price" class="form-control has-error "
							       placeholder="请输入商品价格" value="<?php echo $row['price'] ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>商品图片：</td>
					<td>
						<div class="form-group" id="img_addre_group">
							<input type="hidden" value="<?php echo $row['img_addre'] ?>" name="beforeimg">
							<label class="control-label" for="img_addre"></label>
							<img src="../../<?php echo $row['img_addre'] ?>" width="104" height="104">
							<input type="file" name="img_addre" id="img_addre" class="form-control" placeholder="请上传图片">
						</div>
					</td>
				</tr>
				
				<tr>
					<td>商品类型：</td>
					<td>
						<select name="type">
							<?php $sql = "select distinct type from products";
							$typearr = array();
							$result = $conn -> query($sql);
							while ($row2 = $result -> fetch_assoc()) {
								if ($row2['type'] == $row['type']) {
//									如果遍历的类型与当前商品的类型相等，将它加到数组头部，这样可以下拉列表一开始显示当前类型
									array_unshift($typearr , $row2['type']);
								} else {
									$typearr[] = $row2['type'];
								}
								
							}
							foreach ($typearr as $value) {
								echo "<option value=\"$value\">";
								getNameByType($value);
								echo "</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>商品简介：</td>
					<td>
						<div class="form-group" id="title_group">
							<label class="control-label" for="title"></label>
							<textarea name="title" id="title" class="form-control" rows="10"
							          placeholder="请输入商品简介"><?php echo $row['title'] ?></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="reset" class="btn btn-danger" value="重置信息" id="updateOK"
						       style="width: 35%;height: 50px">
					</td>
					<td>
						<input type="submit" class="btn btn-success" value="提交信息" id="update"
						       style="width: 100%;height: 50px">
					</td>
				</tr>
			</table>
		</form>
	</div>

</div>
<script>
	$(function () {
		$('#form').on('submit', function () {
			if ($('#title').val() == "") {
				$('#title_group').addClass('has-error');
				$('#title_group').children('label').text('店铺名不能为空');
				
			}
			
			
			if ($('#price').val() == "") {
				$('#price_group').addClass('has-error');
				$('#price_group').children('label').text('店铺简介不能为空');
				
			}
			if ($('#price').val() && $('#title').val()) {
				return true;
			} else {
				return false;
			}
		});
		
		$('input,textarea').each(function (i) {
			$(this).on('focus', function () {
				$(this).parent('div').removeClass('has-error');
				$(this).prev('label').text('');
			});
		})
	});
</script>
</body>
</html>
