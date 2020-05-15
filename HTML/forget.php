<?php
require ("../PHP/conn.php");
$_SESSION['name']="";
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>forget</title>
		<link rel="icon" href="//www.bilibili.com/favicon.ico">
		<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
		<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
		<link href="../CSS/forget.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
		<script type="text/javascript" src="../JSLIB/vue.js"></script>
		<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
		<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
		<script src="../JSLIB/bootstrap.js"></script>
		<!--	引用框架-->
		<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
		<script type="text/javascript" src="../JS/forget.js"></script>
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

            if((isset($_SESSION['isadmin']))){
                echo "<a href=\"../PHP/forgetLocation.php? id=forgetl_user\" >{$_SESSION['name']},你好</a>
					<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \">
";
            }
            else{
                echo '<a href="../PHP/forgetLocation.php? id=forget_logoin" >请登录</a>';
            }
            ?>
            <span>您当前的位置: <a href="../PHP/forgetLocation.php? id=index_back">首页</a> <—— <a href="../PHP/forgetLocation.php? id=logoin_back">登陆</a><——找回密码</span>
        </div>
            <div class="forget">
            <div class="title">
            修改密码
            </div>
                <div>
                    <form method="post" action="forget.php">
                        <?php
                        if(isset($_POST['search'])) {
                            $result=selectAllWhereTwoOrTwoAnd("user","username",$_POST['id'],"email",$_POST['id'],
                                                                        "phone",$_POST['id'],"name",$_POST['name'],"isadmin",$_POST['admin'],0,$conn);
                            if (mysqli_num_rows($result)>0){
                                    $_SESSION['id']=$_POST['id'];
                                    $_SESSION['name']=$_POST['name'];
									$_SESSION['isadmin']=$_POST['admin'];
                                    echo "<script type='text/javascript'>alert(\"验证成功，请修改密码吧\");</script>";
                                                    echo ' 
                                     <input type="password" name="password" id="password" placeholder="请输入新密码" onkeyup="check(this.name)">
                                     <input type="password" name="passwordagain" id="passwordagain" placeholder="请再次输入新密码" onkeyup="check(this.name)">
                                     <input type="submit" name="alter" id="alter" value="确定修改" disabled="disabled">';
                            }
                            else{
                                    echo "<script type='text/javascript'>alert(\"账号用户名错误\");location.assign('../HTML/forget.php');</script>";
                                }

                        }
                        else{
                            echo ' 
                                     <input type="text" name="id" id="id" placeholder="账号/手机号/邮箱">
                                     <input type="text" name="name" id="name" placeholder="用户名">
                                       <span style="13px;color:#999999;margin-left: 30px;">普通用户</span></pan><input type="radio" name="admin" checked="checked" value="false" >
                                       <span style="13px;color:#999999;margin-left: 45px;">管理员</span><input type="radio" name="admin" value="true"  >
                                     <input type="submit" name="search" id="search" value="验证">
                                     ';
                        }
                        ?>

                    </form>
                </div>
            </div>


    </div>

    <div class="footer">
        Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
    </div>
</div>
</body>
</html>
<?php
if(isset($_POST['alter'])){
                 $_POST['search']=true;
                 $row=selectAllWhereTwoOrTwoAnd("user","username",$_SESSION['id'],"email",$_SESSION['id'],
                     "phone",$_SESSION['id'],"name",$_SESSION['name'],"isadmin",$_SESSION['isadmin'],1,$conn);
                 if (updateOne("user","password",$_POST['password'],"id",$row['id'],$conn)) {
//                     unset($_SESSION['id']);
//                     unset($_SESSION['name']);
//                     session_write_close();
                     echo '<script type="text/javascript"> alert("修改成功");  location.assign("logoin.php");</script>';
                 }
                 else{
                     echo '<script type="text/javascript"> alert("修改失败");  location.assign("logoin.php");</script>';
                 }


}




?>