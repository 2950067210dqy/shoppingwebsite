<?php
require '../../conn.php';
$url = $_SERVER['HTTP_REFERER'];
echo "<script>if(!confirm('删除后评论不可恢复，是否删除？')){
	location.assign('$url'+'#refresh');
}</script>";
if ($_GET['reply'] == "huifu") {
	$reply_id = $_GET['reply_id'];
	if (deleteWhereOne('reply' , 'reply_id' , $reply_id , $conn)) {
		echo "<script>alert(\"删除成功!\");
			location.assign(\"$url\"+'#refresh');
</script>";
	} else {
		echo "<script>alert(\"删除失败!\");
			location.assign(\"$url\"+'#refresh');
</script>";
	}
} elseif ($_GET['reply'] == "pinglun") {
	$diary_id = $_GET['diary_id'];
	if (deleteWhereOne('reply' , 'diary_id' , $diary_id , $conn) && deleteWhereOne('diary' , 'diary_id' , $diary_id , $conn)) {
		echo "<script>alert(\"删除成功!\");
			location.assign(\"$url\"+'#refresh');
</script>";
	} else {
		echo "<script>alert(\"删除失败!\");
			location.assign(\"$url\"+'#refresh');
</script>";
	}
}


?>
