<?php   require '../PHP/conn.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>signin</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/sigin.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="../JS/signin.js"></script>
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

            if(isset($_SESSION['isadmin'])){
                echo "<a href=\"../PHP/signinLocation.php? id=signin_user\" >{$_SESSION['name']},你好</a>
					<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \" >
			";
            }
            else{
                echo '<a href="../PHP/signinLocation.php? id=signin_logoin" >请登录</a>';
            }
            ?>
	        <span>您当前的位置: <a href="../PHP/signinLocation.php? id=index_back">首页</a> <—— <a
				        href="../PHP/signinLocation.php? id=logoin_back">登陆</a><——注册</span>
        </div>
	    <div class="logoinformation">
		    <div style="width: 100%;text-align: center; color: rgb(241,1,128);border-bottom: 1px solid silver"><h3
					    style="margin-top: 7px">注册账号</h3></div>
		    <form method="post" action="../PHP/sigin_save.php" enctype="multipart/form-data" id="form">
			    <br>
			    <input type="file" name="headimg">
			    <br>
			    <p id="headimgwarn">请上传图片当做您的头像</p>
			    <input type="text" maxlength="10" minlength="4" name="id" id="id" placeholder="请输入账号 (由4-10位字母或符号组成)"
			           onkeyup="check(this.name)">
			    <br>
			    <p id="idwarn"></p>
			    <input type="text" name="email" minlength="7" maxlength="50" id="email" placeholder="请输入邮箱"
			           onkeyup="check(this.name)">
			    <br>
			    <p id="emailwarn"></p>
                <input type="number" maxlength="11" name="phone"  id="phone" placeholder="请输入手机号码(仅支持11位电话号码)" onkeyup="check(this.name)">
                <br>
                <p id="phonewarn" ></p>
                <input type="text" maxlength="10" name="name"    id="name" placeholder="请输入用户名" onkeyup="check(this.name)">
                <br>
                <p id="namewarn"></p>
                <select name="sex" id="sex" onfocusin="check(this.name)" >
                    <option value="">———————请选择你的性别———————</option>
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
                <br>
                <p id="sexwarn">请选择您的性别</p>
                <input type="number" maxlength="4" name="invitecode"   id="invitecode"  placeholder="请输入四位邀请码（可不填写）" onkeyup="check(this.name)">
                <br>
                <p  id="invitecodewarn"></p>
                <input type="password" maxlength="12" minlength="6" name="password"   id="password" placeholder="密码由6-12位字母，数字和符号组成" onkeyup="check(this.name)">
                <br>
                <p  id="passwordwarn"></p>
			    <input type="password" maxlength="12" minlength="6" name="passwordagain" id="passwordagain"
			           placeholder="再次输入上方的密码" onkeyup="check(this.name)">
			    <br>
			    <p id="passwordagainwarn"></p>
			    <select name="career" id="career" onfocusin="check(this.name)">
				    <option value="">———————请选择你的职业———————</option>
				    <option value="老师">老师</option>
				    <option value="学生">学生</option>
				    <option value="其他">其他</option>
			    </select>
			    <br>
			    <span style="13px;color: #999999;margin-left: 30px;">普通用户</span></pan><input type="radio" name="admin"
			                                                                                 checked="checked"
			                                                                                 value="false"> <span
					    style="13px;color:#999999;margin-left: 45px;">管理员</span><input type="radio" name="admin"
			                                                                           value="true"><br>
			    <input type="text" id="security_code" placeholder="请输入验证码" style="width: 50%">
			    <div class="security_code_img" style="display: inline;cursor: pointer" title="看不清，更换一张">
			
			    </div>
			    <input type="submit" name="signin" id="signin" value="请填写信息" disabled="false">
		    </form>
	    </div>
    </div>
	<div class="footer">
		Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
	</div>
</div>

</body>
</html>