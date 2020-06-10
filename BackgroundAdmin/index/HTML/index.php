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
			font-size: 18px;
			}
	</style>
</head>
<body>

<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 3px silver solid;height: 50px;color: #5e5e5e">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>个人信息
	</div>
	
	<div class="admininformation">
		<form method="post" action="../PHP/update.php" enctype="multipart/form-data">
			<table class="table table-hover table-striped ">
				<tr>
					<td>
						序号
					</td>
					<td>
						<?php echo $_SESSION['id'] ?>
					</td>
				</tr>
				<tr>
					<td>头像</td>
					<td>
						<input type="hidden" name="beforeheadimg" value="<?php echo $_SESSION['headimg'] ?>">
						<img src="../../<?php echo $_SESSION['headimg'] ?>" width="94" height="94"
						     style="border-radius: 5%">
						<input type="file" name="headimg" disabled>
					
					
					</td>
				</tr>
				<tr>
					<td><span>账号：</span></td>
					<td><input disabled="false" type="text" name="id" id="id"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?>"
					           maxlength="30" minlength="4"></td>
				</tr>
				<tr>
					<td><span>邮箱：</span></td>
					<td><input disabled="false" type="text" name="email" id="email"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['email']; ?>"
					           minlength="7" maxlength="30"></td>
				</tr>
				<tr>
					<td><span>手机号码：</span></td>
					<td><input disabled="false" type="number" id="phone" name="phone"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['phone']; ?>"
					           minlength="5" maxlength="11"></td>
				</tr>
				<tr>
					<td><span>用户名：</span></td>
					<td><input disabled="false" type="text" id="name" name="name"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['name']; ?>"
					           minlength="1" maxlength="30"></td>
				</tr>
				<tr>
					<td><span>性别：</span></td>
					<td>
						
						<?php
						if (isset($_SESSION['id'])) {
							if ($_SESSION['sex'] == "男") {
								echo '   男:<input disabled="false"  id="sex" name="sex" type="radio" value="男" checked="checked"> 女:<input name="sex" type="radio" value="女" >';
							} elseif ($_SESSION['sex'] == "女") {
								echo '   男:<input disabled="false" id="sex" name="sex" type="radio" value="男"> 女:<input name="sex" type="radio" value="女" checked="checked">';
							}
						}
						?>
					
					</td>
				</tr>
				<tr>
					<td><span>邀请号：</span></td>
					<td><input disabled="false" type="text" id="invitecode" name="invitecode"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['invitecode']; ?>"
					           minlength="4" maxlength="4"></td>
				</tr>
				<tr>
					<td><span>密码：</span></td>
					<td><input disabled="false" id="password" type="password" name="password"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['password']; ?>"
					           maxlength="30" minlength="6"></td>
				</tr>
				<tr>
					<td><span>是否为管理员：</span></td>
					<td><input readonly type="text" name="isadmin"
					           value="<?php if (isset($_SESSION['id'])) echo $_SESSION['isadmin']; ?>"
					           maxlength="30" minlength="6"></td>
				</tr>
				<tr>
					<td><span>职业：</span></td>
					<td><input disabled="false" type="text" id="career" name="career" value="<?php
						if (isset($_SESSION['id'])) {
							if ($_SESSION['career'] == "") {
								echo "未知";
							} else {
								echo $_SESSION['career'];
							}
						}
						?>
                        " maxlength="30" minlength="5">
					</td>
				</tr>
				<tr>
					<td>
						注册时间
					</td>
					<td>
						<?php echo $_SESSION['sign_time'] ?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" class="btn btn-success" value="修改信息" id="update"
						       style="width: 100%;height: 50px">
					</td>
					<td>
						<input type="button" class="btn btn-danger" value="确定修改" id="updateOK"
						       style="width: 35%;height: 50px">
					</td>
				</tr>
			</table>
		</form>
	</div>

</div>
<script src="../JS/index.js"></script>
</body>
</html>