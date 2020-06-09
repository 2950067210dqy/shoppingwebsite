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
		<span class="text-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加店铺</span>
		<span style="margin-left: 80%"><a style="display: inline" class=" btn btn-default text-right"
		                                  href="shop.php">返回</a></span>
	</div>
	
	<div class="admininformation">
		<form method="post" action="../PHP/add_shop_check.php" enctype="multipart/form-data" id="form">
			<table class="table table-hover table-striped ">
				<tr>
					<td>
						店铺名：
					</td>
					<td>
						<div class="form-group" id="shop_name_group">
							<label class="control-label" for="shop_name"> </label>
							<input type="text" name="shop_name" id="shop_name" class="form-control has-error "
							       placeholder="请输入店铺名">
						</div>
					</td>
				</tr>
				<tr>
					<td>店铺图标：</td>
					<td>
						<div class="form-group" id="shop_img_group">
							<label class="control-label" for="shop_img"></label>
							<input type="file" name="shop_img" id="shop_img" class="form-control" placeholder="你上传图片">
						</div>
					</td>
				</tr>
				
				<tr>
					<td>店铺类型：</td>
					<td>
						<div class="form-group" id="shop_maintype_group">
							<label class="control-label" for="shop_maintype"></label>
							<input type="text" name="shop_maintype" id="shop_maintype" class="form-control">
						</div>
					</td>
				</tr>
				<tr>
					<td>店铺简介：</td>
					<td>
						<div class="form-group" id="shop_text_group">
							<label class="control-label" for="shop_text"></label>
							<textarea name="shop_text" id="shop_text" class="form-control" rows="10"></textarea>
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
			if ($('#shop_name').val() == "") {
				$('#shop_name_group').addClass('has-error');
				$('#shop_name_group').children('label').text('店铺名不能为空');
				
			}
			if ($('#shop_img').val() == "") {
				$('#shop_img_group').addClass('has-error');
				$('#shop_img_group').children('label').text('请上传图片');
				
			}
			
			if ($('#shop_maintype').val() == "") {
				$('#shop_maintype_group').addClass('has-error');
				$('#shop_maintype_group').children('label').text('店铺类型不能为空');
				
			}
			if ($('#shop_text').val() == "") {
				$('#shop_text_group').addClass('has-error');
				$('#shop_text_group').children('label').text('店铺简介不能为空');
				
			}
			if ($('#shop_text').val() && $('#shop_maintype').val() && $('#shop_img').val() && $('#shop_name').val()) {
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