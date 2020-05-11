<?php
require ('conn.php');

if(isset($_POST['update'])){
    $_POST['update']=false;
    $row=selectOneWhereOneAnd("user","id","username",$_POST['id'],"isadmin",$_POST['isadmin'],1,$conn);;
    if(updateAllExcpetImgAddr("user","username",$_POST['id'],"email",$_POST['email'],
                                         "sex",$_POST['sex'],"phone",$_POST['phone'],
                                          "name",$_POST['name'],"invite_code",$_POST['invitecode'],
                                          "caree",$_POST['career'],"password",$_POST['password'],
                                        "id",$row['id'],$conn)){
        $_SESSION['username']=$_POST['id'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['phone']=$_POST['phone'];
        $_SESSION['name']=$_POST['name'];
        $_SESSION['sex']=$_POST['sex'];
        $_SESSION['invitecode']=$_POST['invitecode'];
        $_SESSION['password']=$_POST['password'];
        $_SESSION['career']=$_POST['career'];
        echo '<script type="text/javascript"> alert("修改成功");
    location.assign("../HTML/user.php");
    </script>';
    }
    else{
        echo '<script type="text/javascript"> alert("修改失败");
    location.assign("../HTML/user.php");
    </script>';
    }
}


if(isset($_POST['exit'])||isset($_GET['exit'])){
    $_POST['exit']=false;
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['name']);
    unset($_SESSION['sex']);
    unset($_SESSION['invitecode']);
    unset($_SESSION['password']);
    unset($_SESSION['career']);
    unset($_SESSION['headimg']);
    unset($_SESSION['isadmin']);
    session_write_close();
	if(count(explode('http://localhost:63341/phpproject2/HTML/product.php',$_SERVER['HTTP_REFERER']))>1){
		//包含改网址
		echo "<script type='text/javascript'> alert('退出登录成功，正在跳转主页');
                          location.assign('{$_SERVER['HTTP_REFERER']}');
            </script>";
	}else{
		//不包含改网址
		echo "<script type='text/javascript'> alert('退出登录成功，正在跳转主页');
                          location.assign('../HTML/index.php');
            </script>";
	}
 

}


if(isset($_POST['watchall'])){
    $_POST['watchall']=false;
    echo "<script type='text/javascript'> alert('成功，正在跳转');
                          location.assign('../HTML/adminwatchall.php');
            </script>";
}
?>