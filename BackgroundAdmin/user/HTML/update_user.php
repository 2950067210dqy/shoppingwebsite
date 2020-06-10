<?php
session_start();
require '../../conn.php';
$sql = "select * from user where id={$_GET['id']}";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
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
		<span class="text-left"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>更新管理员</span>
		<span style="margin-left: 80%"><a style="display: inline" class=" btn btn-default text-right"
		                                  href="user.php">返回</a></span>
	</div>
	
	<div class="admininformation">
		<form method="post" action="../PHP/update_user_check.php?id=<?php echo $_GET['id'] ?>"
		      enctype="multipart/form-data" id="form">
			<table class="table table-hover table-striped ">
				<tr>
					<td>
						账号：
					</td>
					<td>
						<div class="form-group" id="username_group">
							<label class="control-label" for="username"> </label>
							<input type="text" name="username" id="username" class="form-control has-error "
							       placeholder="请输入账号" value="<?php echo $row['username'] ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>头像：</td>
					<td>
						<div class="form-group" id="head_img_group">
							<label class="control-label" for="head_img"></label>
							<input type="hidden" name="beforeheadimg" value="<?php echo $row['img_addr'] ?>">
							<img src="../../<?php echo $row['img_addr'] ?>" width="104" height="104"
							     style="border-radius: 10%">
							<input type="file" name="head_img" id="head_img" class="form-control" placeholder="你上传图片">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						邮箱：
					</td>
					<td>
						<div class="form-group" id="email_group">
							<label class="control-label" for="shop_name"> </label>
							<input type="text" name="email" id="email" class="form-control has-error "
							       placeholder="请输入邮箱" value="<?php echo $row['email'] ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						性别：
					</td>
					<td>
						<?php if ($row['email'] == "男") echo "男<input type=\"radio\" name=\"sex\" value=\"男\" checked>	女<input type=\"radio\" name=\"sex\" value=\"女\">";
						else echo "男<input type=\"radio\" name=\"sex\" value=\"男\" >	女<input type=\"radio\" name=\"sex\" value=\"女\" checked>" ?>
					</td>
				</tr>
				<tr>
					<td>
						电话：
					</td>
					<td>
						<div class="form-group" id="phone_group">
							<label class="control-label" for="phone"> </label>
							<input type="text" name="phone" id="phone" class="form-control has-error "
							       placeholder="请输入电话" value="<?php echo $row['phone'] ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						姓名：
					</td>
					<td>
						<div class="form-group" id="name_group">
							<label class="control-label" for="name"> </label>
							<input type="text" name="name" id="name" class="form-control has-error "
							       placeholder="请输入姓名" value="<?php echo $row['name'] ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						职业：
					</td>
					<td>
						<select name="caree" class="form-control">
							<?php
							if ($row['caree'] == "老师") {
								echo "<option value=\"老师\">老师</option>
									<option value=\"学生\">学生</option>
									<option value=\"其他\">其他</option>";
							} elseif ($row['caree'] == "学生") {
								echo "	<option value=\"学生\">学生</option>
										<option value=\"老师\">老师</option>
										<option value=\"其他\">其他</option>";
							} else {
								echo "		<option value=\"其他\">其他</option>
							<option value=\"老师\">老师</option>
							<option value=\"学生\">学生</option>
								";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>密码：</td>
					<td>
						<div class="form-group" id="password_group">
							<label class="control-label" for="password"></label>
							<input type="text" name="password" id="password" class="form-control" placeholder="请输入密码"
							       value="<?php echo $row['password'] ?>">
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
			if ($('#name').val() == "") {
				$('#name_group').addClass('has-error');
				$('#name_group').children('label').text('姓名不能为空');
				
			}
			
			
			if ($('#phone').val() == "") {
				$('#phone_group').addClass('has-error');
				$('#phone_group').children('label').text('电话号码不能为空');
				
			}
			if ($('#email').val() == "") {
				$('#email_group').addClass('has-error');
				$('#email_group').children('label').text('邮箱不能为空');
				
			}
			if ($('#username').val() == "") {
				$('#username_group').addClass('has-error');
				$('#username_group').children('label').text('账号不能为空');
				
			}
			if ($('#password').val() == "") {
				$('#password_group').addClass('has-error');
				$('#password_group').children('label').text('密码不能为空');
				
			}
			if ($('#name').val() && $('#username').val() && $('#password').val() && $('#phone').val() && $('#email').val()) {
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

