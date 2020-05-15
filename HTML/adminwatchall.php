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
	<div class="topnav">
		<div class="topnavin">
			<div class="place" onclick="">
				<a href="#">九江市</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='index.php' target='_self'>返回主页</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						总访问量<span class="visitsum" id="visitsum">
                            <?php
                            $count = "";
                            //数字输出网页计数器
                            $row = selectAllNoWhere("count" , 1 , $conn);
                            $count = (int)$row['num'];
                            if (!isset($_SESSION['connected'])) {
	                            $count ++;
	                            updateOne("count" , "num" , (string)$count , "num" , $row['num'] , $conn);
	                            $_SESSION['connected'] = true;
                            }
                            $countlen = strlen($count);
                            $num = null;
                            for ($i = 0; $i < $countlen; $i ++) {
	                            $num = $num . "<img src='../IMG/" . substr($count , $i , 1) . ".png' width='17' height='20'>";
                            }
                            echo $num;

                            ?>


                        </span>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						echo  date('Y-m-d', time());
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">  更多</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">   客户服务</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../BILIBILI/bilibili.php"> 会员俱乐部</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../../phpprojectplus/perinfor/index.php"> 我的订单</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="product_collected.php"> 我的收藏</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="javascript:void(0)" class="shopcar">
							我的购物车<?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
							else {
								$sql = "select id from shopcar where user_id = {$_SESSION['id']}";
								$result = $conn -> query($sql);
								echo $result -> num_rows;
							} ?></a>
					</li>
					<script>
						$(document).ready(function () {
							$('.shopcar').click(
								function () {
									if ($('#isLogin').val() == "no") {
										if (confirm('进入购物车需要登录哦？是否前往登录？')) {
											location.assign('../HTML/logoin.php');
										}
									} else {
										location.assign('../HTML/shopcar.php');
									}
								}
							);
						});
					</script>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php? id=index_signin"> 注册</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						
						if((isset($_SESSION['isadmin']))){
							echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>
										<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;'>
										&nbsp;&nbsp;&nbsp;&nbsp;<a  target='_self' onclick=\"location.assign('../PHP/update_userinfo.php?exit=true');\" href='javascript:void(0)'>退出登录</a>

						";
						}
						else{
							echo '<a href="../HTML/logoin.php" >请登录</a>';
						}
						?>
					
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	
	
    <div class="logo">
        <img src="../IMG/logo.png" alt="沁柚" height="70" >
        <div class="sublogo">
            <img height="60"  width="100" src="../IMG/logo2.png" alt="沁柚">
            <img height="60"  width="100" src="../IMG/logo3.png" alt="沁柚">
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
