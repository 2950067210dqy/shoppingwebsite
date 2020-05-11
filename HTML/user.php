<?php
require('../PHP/conn.php');
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link rel="icon" href="//www.bilibili.com/favicon.ico">
    <link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
    <link href="../CSS/user.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../JS/update.js">
    </script>
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
					<li >
						总访问量<span class="visitsum" id="visitsum">
                            <?php

                            //数字输出网页计数器
                            $row = selectAllNoWhere("count",1,$conn);
                            $count=(int)$row['num'];
                            $count++;
                            echo $count;
                            if(updateOne("count","num",(string)$count,"num",$row['num'],$conn))
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
					<li >
						<a href="../BILIBILI/bilibili.php">  会员俱乐部</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/perinfor/index.php">   我的特卖</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/myBBS/index.php">    我的订单</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../BILIBILI/bilibili.php">   签到有礼</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php? id=index_signin">   注册</a>
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
            <img height="60" width="100" src="../IMG/logo2.png" alt="沁柚">
            <img height="60" width="100" src="../IMG/logo3.png" alt="沁柚">
            <img height="60" width="100" src="../IMG/logo4.png" alt="沁柚">
        </div>
    </div>
    <div class="information ">
        <div class="position">
            <?php

            if((isset($_SESSION['isadmin']))){
                echo "<a href=\"../PHP/userLocation.php? id=user_user\" >{$_SESSION['name']},你好</a>
					<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \"
";
            }
            else{
                echo '<a href="../PHP/userLocation.php? id=user_logoin" >请登录</a>';
            }
            ?>
            <span>您当前的位置: <a href="../PHP/userLocation.php? id=index_back">首页</a> <—— 个人信息</span>
        </div>
        <div class="logoinformation">
            <div class="biaoti">
                <div style="height: 100%;width: 20%;background-color:rgb(249,249,249);padding-left: 50px;border-bottom: 3px solid rgb(241,1,128)">
                    个人信息
                </div>
            </div>
            <div class="xinxi">
                <div class="touxiang">
                    <img src="<?php if (isset($_SESSION['id']))  echo "{$_SESSION['headimg']}";?>" width="84" height="84" alt="无头像">
                    <div class="touxiangword"><b><?php  if (isset($_SESSION['id']))  echo $_SESSION['name']."(".$_SESSION['phone'].")" ;      ?></b></div>
                </div>
                <form method="post" action="../PHP/update_userinfo.php">
                <table>
                    <tr>
                        <td ><span>账号：</span></td>
                        <td><input disabled="false" type="text" name="id" id="id" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['username'] ;  ?>" maxlength="10" minlength="4"> </td>
                    </tr>
                    <tr>
                        <td><span>邮箱：</span></td>
                        <td><input  disabled="false" type="text" name="email"  id="email" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['email'] ;  ?>"  minlength="7" maxlength="25"></td>
                    </tr>
                    <tr>
                        <td><span>手机号码：</span></td>
                        <td><input  disabled="false" type="number"  id="phone" name="phone" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['phone'] ;  ?>"  minlength="5" maxlength="11"></td>
                    </tr>
                    <tr>
                        <td><span>用户名：</span></td>
                        <td><input disabled="false" type="text"  id="name" name="name" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['name'] ;  ?>" minlength="1" maxlength="10"></td>
                    </tr>
                    <tr>
                        <td><span>性别：</span></td>
                        <td >
                            <span style="position: relative;left: -200px;top: 0px;">
                            <?php
                            if (isset($_SESSION['id'])) {
	                            if ($_SESSION['sex'] == "男") {
		                            echo '   男:<input disabled="false"  id="sex" name="sex" type="radio" value="男" checked="checked"> 女:<input name="sex" type="radio" value="女" >';
	                            } elseif ($_SESSION['sex'] == "女") {
		                            echo '   男:<input disabled="false" id="sex" name="sex" type="radio" value="男"> 女:<input name="sex" type="radio" value="女" checked="checked">';
	                            }
                            }
                            ?>
                            </span>
                            </td>
                    </tr>
                    <tr>
                        <td><span>邀请号：</span></td>
                        <td><input disabled="false" type="text"  id="invitecode" name="invitecode" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['invitecode'];?>" minlength="4" maxlength="4"></td>
                    </tr>
                    <tr>
                        <td><span>密码：</span></td>
                        <td><input disabled="false"  id="password" type="password" name="password" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['password'] ;  ?>" maxlength="12" minlength="6"></td>
                    </tr>
	                <tr>
		                <td><span>是否为管理员：</span></td>
		                <td><input readonly type="text"  name="isadmin" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['isadmin'] ;  ?>" maxlength="12" minlength="6"></td>
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
                        " maxlength="5" minlength="5">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            //查找session存储的账号是不是管理员账号，是的话就显示到管理员界面信息
                           if($_SESSION['isadmin']=="false"){
                               echo '<input type="submit" name="update"  id="update" value="提交信息" disabled="false"></td>';

                           }
                           else {
                               echo '<input type="submit" name="watchall"  id="watchall" value="查看所有用户信息"></td>';
                           }
                            ?>
                        <td>
                            <input type="submit" name="exit"  id="exit" value="退出登录" >
                            <?php
                            if($_SESSION['id']=='admin'){
                                echo '' ;
                            }
                            else{
                                echo ' <input type="button"  value="注销账号" onclick="
                                        if (confirm(\'您确定要注销账号，考虑清楚就点击确定！！\')){
                                          location.assign(\'../PHP/logooffuser.php\')
									}">
								<a href="#" onclick="update()" style="color: rgb(117,117,117);font-size: 15px;margin-left: 35px">修改信息</a>' ;
                            }
                            ?>
								
                        </td>
                    </tr>
                </table>
                </form>
            </div>
         </div>
    </div>
    <div class="footer">
        Copyright 2019-2020 qinyou.com，All Rights Reserved ICP证：赣 B2-20180101981
    </div>
</div>
</div>

</body>
</html>