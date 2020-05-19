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
//			发送消息
			$sql = "select user_id,product_id,product_type from diary where diary_id={$diary_id}";
			$result = $conn -> query($sql);
			$row = $result -> fetch_assoc();
			if ($last_id == 0) {
				$sql = "insert into add_user_message values (null,{$row['user_id']},{$user_id},'reply',null,{$row['product_id']},'{$row['product_type']}','false')";
				$conn -> query($sql);
				echo "<script>alert('1！')</script>";
			} else {
				$sql = "select  distinct r2.user_id from reply as r1,reply as r2  where r1.last_id={$last_id} and r1.last_id=r2.reply_id";
				$result = $conn -> query($sql);
				$row2 = $result -> fetch_assoc();
				$sql = "insert into add_user_message values (null,{$row2['user_id']},{$user_id},'reply',null,{$row['product_id']},'{$row['product_type']}','false')";
				$conn -> query($sql);
				
			}
			echo "<script>alert('评论成功！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		} else {
			echo "<script>alert('评论失败！');location.assign('{$_SERVER['HTTP_REFERER']}'+'#refresh')</script>";
		}
	} elseif ($_GET['reply'] == "pinglun") {
		$user_id = $_GET['user_id'];
		$textarea = $_POST['textarea'];
		$username = $_GET['username'];
		$product_id = $_GET['product_id'];
		$type = $_GET['type'];
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