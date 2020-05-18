<?php
session_start();
require 'conn.php';
if (deleteWhereOneAnd("message" , "user_id" , $_SESSION['id'] , "reply_user_id" , $_GET['id'] , $conn) &&
	deleteWhereOneAnd("message" , "user_id" , $_GET['id'] , "reply_user_id" , $_SESSION['id'] , $conn)
) {
//	发消息
	$sql = "insert into add_user_message values (null,{$_GET['id']},{$_SESSION['id']},'delete_message',null,null,null,'false')";
	$conn -> query($sql);
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>
