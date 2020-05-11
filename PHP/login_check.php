<?php
require 'conn.php';
//不妨sql注入
$result=selectAllWhereTwoOrTwoAnd("user","username",$_POST['id'],
	"email",$_POST['id'],"phone",$_POST['id'],"password",$_POST['password'],"isadmin",$_POST['isadmin'],0,$conn);
if (mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);
	$_SESSION['id']=$row['id'];
	$_SESSION['username']=$row['username'];
	$_SESSION['email']=$row['email'];
	$_SESSION['phone']=$row['phone'];
	$_SESSION['name']=$row['name'];
	$_SESSION['sex']=$row['sex'];
	$_SESSION['invitecode']=$row['invite_code'];
	$_SESSION['password']=$row['password'];
	$_SESSION['career']=$row['caree'];
	$_SESSION['headimg']=$row['img_addr'];
//	$_SESSION['logoin']=$_POST['logoin'];
	$_SESSION['isadmin']=$row['isadmin'];
	$lasturl=$_GET['beforeAddre'];
	if(count(explode('http://localhost:63341/phpproject2/HTML/product.php',urldecode($lasturl)))>1){
		//包含改网址
	}else{
		//不包含改网址
		$lasturl='../HTML/index.php';
	}
	if($_POST['isadmin']=='false'){
		echo "<script type='text/javascript'> alert(\"亲爱的{$row['name']}用户好久不见，您终于来了，登录成功\");
        location.href= '$lasturl';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert(\"亲爱的{$row['name']}管理员好久不见，您终于来了，登录成功\");
        location.assign('$lasturl');</script>";
	}
	
}
else{
	echo "<script type='text/javascript'> alert('账号或密码错误，请重新输入');  location.assign('../HTML/logoin.php');</script>";
}

