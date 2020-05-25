<?php
require('conn.php');

//不妨sql注入
if($_POST['admin']=="false"){
    $result=selectAllWhereTwoOrOneAnd("user","username",$_POST['id'],"email",$_POST['email'],"phone",$_POST['phone'],"isadmin","false",0,$conn);
}
else if($_POST['admin']=="true"){
    $result=selectAllWhereTwoOrOneAnd("user","username",$_POST['id'],"email",$_POST['email'],"phone",$_POST['phone'],"isadmin","true",0,$conn);
}

if (mysqli_num_rows($result)>0){
    echo "<script type='text/javascript'> alert('信息已被注册，请重新输入');  location.assign('../HTML/signin.php');</script>";
}
else{
	// 允许上传的图片后缀
	$allowedExts = array("gif", "jpeg", "jpg", "png","PNG","JPG","JPEG","GIF");
	$temp = explode(".", $_FILES["headimg"]["name"]);
	$extension = end($temp);     // 获取文件后缀名
	if ((($_FILES["headimg"]["type"] == "image/gif")
			|| ($_FILES["headimg"]["type"] == "image/jpeg")
			|| ($_FILES["headimg"]["type"] == "image/jpg")
			|| ($_FILES["headimg"]["type"] == "image/jpeg")
			|| ($_FILES["headimg"]["type"] == "image/x-png")
			|| ($_FILES["headimg"]["type"] == "image/png"))
		&& ($_FILES["headimg"]["size"] < 204800*1024*6)   // 小于 12 Mb
		&& in_array($extension, $allowedExts))
	{
		if ($_FILES["headimg"]["error"] > 0)
		{
			echo "<script>alert('头像上传错误{$_FILES["headimg"]["error"]}')</script>";
		}
		else
		{
			echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
			echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
			echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
			// 判断当前目录下的 upload 目录是否存在该文件
			// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
			if (file_exists("../headimg/" . $_FILES["headimg"]["name"]))
			{
				echo $_FILES["headimg"]["name"] . " 文件已经存在。 ";
			}
			else
			{
				// 如果 upload 目录不存在该文件则将文件上传到 headimg 目录下
				$ext = pathinfo($_FILES["headimg"]["name"] , PATHINFO_EXTENSION);//提取上传文件的拓展名
				$uniName = md5(uniqid(microtime(true) , true)) . ".$ext";//md5加密，uniqid产生唯一id，microtime做前缀
				chmod("../headimg/" , 777);
				move_uploaded_file($_FILES["headimg"]["tmp_name"] , "../headimg/" . $uniName);
				echo "文件存储在: " . "../headimg/" . $uniName;
			}
		}
	}
	else
	{
		echo "<script>alert('头像上传错误：非法的文件格式')</script>";
	}
	$imgname = "../headimg/" . $uniName;
	siginok(insertAll("user" , null , $_POST['id'] , $_POST['email'] , $_POST['sex'] , $_POST['phone'] , $_POST['name'] , $_POST['invitecode'] , $_POST['career'] , $imgname , $_POST['password'] , $_POST['admin'] , $conn));
}
function siginok($bool){
    if($bool){
        echo "<script type='text/javascript'>
            alert('添加成功！！');   
            alert(\"注册成功\\n \"+
                                                        \" 您的账号类型为{$_POST['admin']}\\n\"+
                                                        \"头像存储在:../headimg/{$_FILES["headimg"]["name"]}\"+
                                                         \" 您的账号为{$_POST['id']}\\n\"+
                                                          \" 您的邮箱为{$_POST['email']}\\n\"+
                                                            \" 您的手机号码为{$_POST['phone']}\\n\"+
                                                            \" 您的用户名为{$_POST['name']}\\n\"+
                                                              \" 您的性别为{$_POST['sex']}\\n\"+
                                                                \" 您的邀请码为{$_POST['invitecode']}\\n\"+
                                                                \" 您的密码为{$_POST['password']}\\n\"+
                                                               \" 您的职业为{$_POST['career']}\\n\");
              	    		    location.assign('../HTML/logoin.php'); </script>";

    }
    else{
        echo "<script>alert('添加失败')</script>";
    }
}


