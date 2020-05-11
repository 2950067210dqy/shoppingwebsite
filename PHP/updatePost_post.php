<?php
require 'conn.php';
$result=null;
if($_GET['reply']=='pinglun'){
	$result=updateTwo('diary','content',$_POST['textarea'],'time','null','diary_id',$_GET['post_id'],$conn);
}else{
	$result=updateTwo('reply','reply_content',$_POST['textarea'],'time','null','reply_id',$_GET['post_id'],$conn);
}
if($result){
	echo "<script>alert(\"修改成功!\");
			location.assign(\"{$_GET['url']}#refresh\");
</script>";
}
else{
	echo "<script>alert(\"修改失败!\");
			location.assign(\"{$_GET['url']}#refresh\");
</script>";
}
?>
