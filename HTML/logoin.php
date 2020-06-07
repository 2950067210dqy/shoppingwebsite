<?php  require '../PHP/conn.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>logoin</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/logoin.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="main">
	<div class="logo">
		<img src="../IMG/logo.png" alt="沁柚" height="70">
		<div class="sublogo">
			<img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
			<img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
		</div>
    </div>
    <div class="information">
        <div class="position">
            <?php

            if(isset($_SESSION['isadmin'])&&!empty($_SESSION['isadmin'])){
                echo "<a href=\"../PHP/loginLocation.php? id=logoin_user\" >{$_SESSION['name']},你好</a>
					<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \">
				";
            }
            else{
	            echo '<a href="../PHP/loginLocation.php? id=logoin_logoin" >请登录</a>';
            }
            ?>
	
	        <span>您当前的位置:<a href="../PHP/loginLocation.php? id=index_back">首页</a></span><——登陆
        </div>
	    <div class="logoinformation" id="logoinformation">
		
		    <input name="admin" type="submit" id="admin" value="用户登录">
		    <input name="superadmin" type="submit" id="superadmin" value="管理员登录" style="border-bottom: none;">
		    <form id="form" method="post"
		          action="../PHP/login_check.php?beforeAddre=<?php echo urlencode($_SERVER['HTTP_REFERER']); ?>">
			    <input type="hidden" value="false" id="isadmin" name="isadmin">
			    <br>
			    <input type="text" maxlength="50" name="id" placeholder="手机号/账号/邮箱" id="id" onkeyup="check(this.name)">
			    <br>
			    <input type="password" maxlength="50" name="password" placeholder="密码（不大于10位）" id="password"
			           onkeyup="check(this.name)">
			    <br>
			    <input type="text" id="security_code" placeholder="请输入验证码" style="width: 50%">
			    <div class="security_code_img" style="display: inline;cursor: pointer" title="看不清，更换一张">
			
			    </div>
			    <br>
			    <a href="../PHP/loginLocation.php? id=logoin_signin" style="float: left;">免费注册</a>
			    <a href="../PHP/loginLocation.php? id=logoin_forgetpassword" style="float: right;">忘记密码</a>
			    <br>
			    <input type="submit" name="logoin" id="logoin" value="确定登录" disabled="false">
		    </form>
	    </div>
    </div>
	<div class="footer">
		Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
	</div>
</div>
<script type="text/javascript" src="../JS/logoin.js"></script>
</body>
</html>