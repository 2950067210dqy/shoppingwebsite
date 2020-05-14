<?php
require ("conn.php");
if(isset($_POST['yes'])){
    $_POST['yes']=false;


    if (isset($_POST['jiaquan']) && !empty($_POST['jiaquan'])) {
	    $jiaquan_id = $_POST['jiaquan'];
	    $bool = true;
	    $result = null;
	    foreach ($jiaquan_id as $key => $value) {
		    $value = intval($value);
		    $row = selectOneWhereOne("user" , "id" , "id" , $value , 1 , $conn);
		    if (updateOne('user' , 'isadmin' , 'true' , 'id' , $row['id'] , $conn)) {
		    } else {
			    echo "<script>alert('加权失败'); location.assign('../HTML/adminwatchall.php')</script>";
		    }
	    }
	    echo "<script>alert('{$row['id']}加权操作！！');
                             alert('加权所有操作成功！！');
                              location.assign('../HTML/adminwatchall.php')</script>";
    }
	
	
	if (isset($_POST['jiangquan']) && !empty($_POST['jiangquan'])) {
		$jiangquan_id = $_POST['jiangquan'];
		$bool = true;
		$result = null;
		foreach ($jiangquan_id as $key => $value) {
			$value = intval($value);
			$row = selectOneWhereOneAnd("user" , "id" , "username" , "admin" , "isadmin" , "true" , 1 , $conn);
			if ($value == $row['id']) {
				echo "<script>alert('您不能将超级管理员降权！！！')</script>";
				if (count($row) == 1) {
					echo "<script> location.assign('../HTML/adminwatchall.php')</script>";
		        }
		        continue;
	        }
	        $row = selectOneWhereOne("user" , "id" , "id" , $value , 1 , $conn);
	        if (updateOne('user' , 'isadmin' , 'false' , 'id' , $row['id'] , $conn)) {
	        } else {
		        echo "<script>alert('加权失败'); location.assign('../HTML/adminwatchall.php')</script>";
	        }
        }
	    echo "<script>alert('{$row['id']}降权操作！！');
                             alert('降权所有操作成功！！');
                              location.assign('../HTML/adminwatchall.php')</script>";
    }



    if((empty($_POST['jiangquan']))&&(empty($_POST['jiaquan']))){
        echo "<script>alert('未选中用户进行操作！！！！'); location.assign('../HTML/adminwatchall.php')</script>";
    }
}





if(isset($_POST['dele'])){

    $_POST['dele']=false;
	if (isset($_POST['delete']) && !empty($_POST['delete'])) {
		$delete1_id = $_POST['delete'];
		$bool = true;
		foreach ($delete1_id as $key => $value) {
			$value = intval($value);
			if (!deleteWhereOne("user" , "id" , $value , $conn)) {
				$bool = false;
				echo "<script>alert('普通用户删除失败！！');
        location.assign('../HTML/adminwatchall.php')</script>";
				break;
			}
        }
        if($bool){
            
            echo "<script>alert('普通用户删除成功！！');
    location.assign('../HTML/adminwatchall.php')</script>";
        }
    }
	
	if (isset($_POST['delete2']) && !empty($_POST['delete2'])) {
		$delete2_id = $_POST['delete2'];
		$bool = true;
		foreach ($delete2_id as $key => $value) {
			$value = intval($value);
			$row = selectOneWhereOneAnd("user" , "id" , "name" , "admin" , "isadmin" , "true" , 1 , $conn);
			if ($value == $row['sid']) {
				echo "<script>alert('您不能删除超级管理员！！！')</script>";
				if (count($row) == 1) {
					echo "<script> location.assign('../HTML/adminwatchall.php')</script>";
				}
                continue;
            }
            if(!deleteWhereOne("user","id",$value,$conn)){
                $bool=false;
                echo "<script>alert('管理员用户删除失败！！');
        location.assign('../HTML/adminwatchall.php')</script>";
                break;
            }
        }
        if($bool){
            echo "<script>alert('管理员用户删除成功！！');
    location.assign('../HTML/adminwatchall.php')</script>";
        }
    }

    if((empty($_POST['delete2']))&&(empty($_POST['delete']))){
        echo "<script>alert('未选中用户进行操作！！！！'); location.assign('../HTML/adminwatchall.php')</script>";
    }
}
?>
