<?php
require 'conn.php';

if(empty($_POST['textarea'])||(strlen($_POST['textarea'])==1&&($_POST['textarea']==" "||$_POST['textarea']==" "))){
	echo "<script>
alert('{$_POST['textarea']}');
		alert('您的输入非法');
		location.assign('{$_SERVER['HTTP_REFERER']}');
</script>";
}else {
	if ($_GET['reply'] == "huifu") {
		$user_id = $_GET['user_id'];
		$diary_id = $_GET['diary_id'];
		$reply_id = $_GET['reply_id'];
		$textarea = $_POST['textarea'];
		$last_id = $_GET['last_id'];
		$username = $_GET['username'];
		$product_id = $_GET['product_id'];
		$type=$_GET['type'];
		//加入评论
		$sql = "insert into reply values (null,{$diary_id},{$user_id},'$username','$textarea',null,{$last_id})";
		if ($conn -> query($sql)) {
			echo "<script>alert('评论成功！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		} else {
			echo "<script>alert('评论失败！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		}
	} elseif ($_GET['reply'] == "pinglun") {
		$user_id = $_GET['user_id'];
		$textarea = $_POST['textarea'];
		$username = $_GET['username'];
		$product_id = $_GET['product_id'];
		$type=$_GET['type'];
		//加入评论
		$sql = "insert into diary values (null,{$user_id},'$username','$textarea',null,{$product_id},'$type')";
		if ($conn -> query($sql)) {
			echo "<script>alert('评论成功！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		} else {
			echo "<script>alert('评论失败！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		}
	}
}
?>