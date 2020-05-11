<?php
require 'conn.php';

if(deleteWhereOne('user','id',$_SESSION['id'],$conn)){
	echo "<script>alert('注销成功')</script>";
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
	echo "<script>location.assign('../HTML/index.php')</script>";
}
else{
	echo "<script>alert('erro！注销出问题了！')</script>";
	echo "<script>location.assign('../HTML/index.php')</script>";
}




?>
