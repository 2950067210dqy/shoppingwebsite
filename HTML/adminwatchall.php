<?php
require ("../PHP/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>adminwatchall</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/adminwatchall.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="../JS/adminwatchall.js"></script>
</head>
<body>
<div class="main">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
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

            if((isset($_SESSION['logoin'])&&!empty($_SESSION['logoin'])||isset($_SESSION['superlogoin'])&&!empty($_SESSION['superlogoin']))){
                echo "<a href=\"../PHP/adminwatchallLocation.php? id=adminwatchall_user\" >{$_SESSION['name']},你好</a>
						<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \">

";
            }
            else{
                echo '<a href="../PHP/adminwatchallLocation.php?id=adminwatchall_logoin" >请登录</a>';
            }
            ?>
            <span>您当前的位置: <a href="../PHP/adminwatchallLocation.php? id=index_back">首页</a> <—— <a href="../PHP/adminwatchallLocation.php? id=user_back">个人信息</a><—— 查看所有用户信息</span>
        </div>
        <div class="title">
            沁柚网用户注册信息表格
        </div>
        <form method="post" action="../PHP/userlevel.php" style="background: transparent">
        <table border="1">
            <tr>
                <td colspan="12"><h3>用户</h3></td>
            </tr>
            <tr>
                            <td>
                                id
                            </td>
                             <td>
                            头像
                            </td>
                             <td>
                            账号
                            </td>
                            <td>
                             邮箱
                            </td>
                            <td>
                            电话号码
                            </td>
                            <td>
                            用户名
                            </td>
                            <td>
                            性别
                            </td>
                            <td>
                            邀请码
                            </td>
                            <td>
                            密码
                            </td>
                             <td>
                            职业
                            </td>
                            <td>
                            加权降权
                            </td>
                             <td>
                            删除操作
                            </td>
                        </tr>
            <?php
            $result=selectAllWhereOne("user","isadmin","false",0,$conn);
            if((mysqli_num_rows($result))>0){
            while ($row= mysqli_fetch_array($result)) {
                echo "<tr>
                            <td>  {$row['id']} </td>
                            <td>"?>
                            <?php echo "<img  src=\"{$row['img_addr']}\" alt='无头像'  width='20' height='20' alt='无头像' style='border-radius: 15px;' >".
                            "</td>".
                               "<td>".
                                 $row['username'].
                                 "</td>".
                            "<td>".
                             $row['email'].
                            "</td>".
                            "<td>".
                              $row['phone'].
                            "</td>".
                           "<td>".
                              $row['name'].
                            "</td>".
                           "<td>".
                            $row['sex'].
                           "</td>".
                           "<td>".
                             $row['invite_code'].
                           "</td>".
                             "<td>".
                             $row['password'].
                            "</td>".
                             "<td>".
                             $row['caree'].
                          "</td>".
                             "<td>".
                            " <input type='checkbox' id=\"jiaquan\" name=\"jiaquan[]\" value=\"{$row['id']}\">".
                           "</td>".
                          "<td>".
                        " <input type='checkbox' id=\"delete\" name=\"delete[]\" value=\"{$row['id']}\">".
                         "</td>".
                        " </tr>";
            }
            }
            ?>
            <?php
            echo "<tr>
                    <td colspan='12'><h3>管理员</h3></td>
                    </tr>";
            //如果管理员为超级管理员就显示出所有成员信息包括管理员
            if($_SESSION['username']=="admin"&&$_SESSION['isadmin']=='true') {
	
	            $result=selectAllWhereOne("user","isadmin","true",0,$conn);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>
                            <td>  {$row['id']} </td>
                            <td>" ?>
                        <?php echo "<img  src=\"{$row['img_addr']}\" alt='无头像'  width='20' height='20' alt='无头像' style='border-radius: 15px;' >" .
                            "</td>" .
                            "<td>" .
                            $row['username'] .
                            "</td>" .
                            "<td>" .
                            $row['email'] .
                            "</td>" .
                            "<td>" .
                            $row['phone'] .
                            "</td>" .
                            "<td>" .
                            $row['name'] .
                            "</td>" .
                            "<td>" .
                            $row['sex'] .
                            "</td>" .
                            "<td>" .
                            $row['invite_code'] .
                            "</td>" .
                            "<td>" .
                            $row['password'] .
                            "</td>" .
                            "<td>" .
                            $row['caree'] .
                            "</td>" .
                            "<td>" .
                            " <input type='checkbox' id=\"jiangquan\" name=\"jiangquan[]\" value=\"{$row['id']}\">" .
                            "</td>" .
                            "<td>" .
                            " <input type='checkbox' id=\"delete2\" name=\"delete2[]\" value=\"{$row['id']}\">" .
                            "</td>" .
                            " </tr>";
                    }
                }
            }

        echo "<tr>
                 <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                 <td><input type='submit' name='yes' value='确定'>&nbsp;&nbsp;&nbsp;<input onclick='allok(this)' type='checkbox'>全选</td>
                 <td><input type='submit' name='dele' value='删除'>&nbsp;&nbsp;&nbsp;&nbsp;<input onclick='alldelete(this)' type='checkbox'>全选</td>
            </tr>"

            ?>





        </table>
        </form>
        <br style="clear:both;" />
    </div>

    <div class="footer">
        Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
    </div>
</div>

</body>
</html>
