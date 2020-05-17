<?php
session_start();
require 'conn.php';
if (deleteWhereOneAnd("message" , "user_id" , $_SESSION['id'] , "reply_user_id" , $_GET['id'] , $conn) &&
	deleteWhereOneAnd("message" , "user_id" , $_GET['id'] , "reply_user_id" , $_SESSION['id'] , $conn)
) {
	echo "<script>location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
}
?>
