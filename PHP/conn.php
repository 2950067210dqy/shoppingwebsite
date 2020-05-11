<?php
if (!session_id()) session_start();
date_default_timezone_set('PRC');//临时设置中国时区
header("content-type:text/html;charset=utf8");
global $conn;
$url="47.94.164.171";
$password="2591215997as";
//$url="localhost";
//$password="";
$conn=mysqli_connect($url,"root",$password,"shopping",3306);
mysqli_query($conn,"set names 'UTF8'");
function selectAllNoWhere($table,$flag,$conn){
   
    $sql = "select * from {$table} ";
    if($flag==1){
        return mysqli_fetch_assoc(mysqli_query($conn,$sql));
    }
    elseif ($flag==2){
        return mysqli_fetch_array(mysqli_query($conn,$sql));
    }
    else{
        return mysqli_query($conn,$sql);
    }
}
function selectAllWhereOne($table,$index,$string,$flag,$conn){
	if(is_string($string)){
		$sql = "select * from {$table} where   {$index} = '{$string}'";
	}else{
		$sql = "select * from {$table} where   {$index} = {$string}";
	}
    if($flag){
        return mysqli_fetch_assoc(mysqli_query($conn,$sql));
    }
    else{
        return mysqli_query($conn,$sql);
    }

}
function selectAllWhereTwoOr($table,$index1,$string1,$index2,$string2,$index3,$string3,$flag,$conn){
    $sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or  {$string3} = '{$index3}' ";
    if($flag){
        return mysqli_fetch_assoc(mysqli_query($conn,$sql));
    }
    else{
        return mysqli_query($conn,$sql);
    }
}
function selectAllWhereTwoOrOneAnd($table,$index1,$string1,$index2,$string2,$index3,$string3,$index4,$string4,$flag,$conn){
    $sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or {$index3} = '{$string3}' and {$index4} = '{$string4}' ";
    if($flag){
        return mysqli_fetch_assoc(mysqli_query($conn,$sql));
    }
    else{
        return mysqli_query($conn,$sql);
    }
}
function selectAllWhereTwoOrTwoAnd($table,$index1,$string1,$index2,$string2,$index3,$string3,$index4,$string4,$index5,$string5,$flag,$conn){
	$sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or {$index3} = '{$string3}' and {$index4}
		= '{$string4}' and {$index5} = '{$string5}'   ";
	if($flag){
		return mysqli_fetch_assoc(mysqli_query($conn,$sql));
	}
	else{
		return mysqli_query($conn,$sql);
	}
}
function selectOneWhereOne($table,$num,$index,$string,$flag,$conn){
    $sql = "select {$num} from {$table} where {$index} = '{$string}'";
    if($flag){
        return mysqli_fetch_assoc(mysqli_query($conn,$sql));
    }
    else{
        return mysqli_query($conn,$sql);
    }
}
function selectOneWhereOneAnd($table,$num,$index,$string,$index2,$string2,$flag,$conn){
	$sql = "select {$num} from {$table} where {$index} = '{$string}' and  {$index2} = '{$string2}' ";
	if($flag){
		return mysqli_fetch_assoc(mysqli_query($conn,$sql));
	}
	else{
		return mysqli_query($conn,$sql);
	}
}
function insertAll($table,$num1,$num2,$num3,$num4,$num5,$num6,$num7,$num8,$num9,$num10,$num11,$conn){
    $sql = "insert into {$table} values ('" . $num1 . "','" . (string)$num2 .
        "','" . (string)$num3 . "','" . (string)$num4 . "','" .
        (string)$num5 . "','" . (string)$num6 . "','" .
        (string)$num7 . "','" . (string)$num8 . "','" . (string)$num9 .
        "','" . (string)$num10 . "','" . (string)$num11 ."')";
    return mysqli_query($conn,$sql);
}
function deleteWhereOne($table,$index,$string,$conn){
    $sql = "delete from {$table} where {$index}={$string}";
    return mysqli_query($conn,$sql);
}
function deleteWhereOneAnd($table,$index,$string,$index2,$string2,$conn){
	$sql = "delete from {$table} where {$index}={$string} and {$index2} = '{$string2}'";
	return mysqli_query($conn,$sql);
}
function updateAllExcpetImgAddr($table,$index1,$string1,$index2,$string2,$index3,$string3,$index4,$string4,
                                    $index5,$string5,$index6,$string6,$index7,$string7,$index8,$string8,
                                $indexwhere,$stringwhere,$conn){
   
    $sql = "update {$table} set  {$index1}='{$string1}',
    {$index2}='{$string2}',{$index3}='{$string3}',
    {$index4}='{$string4}',{$index5}='{$string5}',
    {$index6}='{$string6}',{$index7}='{$string7}',
    {$index8}='{$string8}'  where {$indexwhere}={$stringwhere}";
    return mysqli_query($conn,$sql);
}
function updateOne($table,$index,$string,$indexwhere,$stringwhere,$conn){
    $sql="update {$table} set {$index} = '{$string}' where  {$indexwhere} = {$stringwhere}";
    return mysqli_query($conn,$sql);
}
function updateTwo($table,$index,$string,$index2,$string2,$indexwhere,$stringwhere,$conn){
	$sql="update {$table} set {$index} = '{$string}',{$index2} = {$string2} where  {$indexwhere} = {$stringwhere}";
	return mysqli_query($conn,$sql);
}

//分页
function page($RecordCount,$PageSize,$Page,$url,$keyword=null,$sel=null){
	$PageCount=ceil($RecordCount/$PageSize);//总页数
	$page_previous=($Page<=1)?1:$Page-1;//计算上一页的页数
	$page_next=($Page>=$PageCount)?$PageCount:$Page+1;//计算下一页的页数
	$page_start=($Page-5>0)?$Page-5:0;//只显示本页的前5页的页面
	$page_end=($page_start+10<$PageCount)?$page_start+10:$PageCount;//后五页
	$page_start=$page_end-10;
	if ($page_start<0){
		$page_start=0;//若当前页面不合法，更正
	}
	$parse_url=parse_url($url);//判断url是否含有字符串
	if(empty($parse_url['query'])){
		$url=$url.'?';//若不存在，在url后面添加?
	}
	else{
		$url=$url.'&';//若存在，在后面添加&
	}
	
		if($Page==1){
			$str="<li class=\"disabled\">
					<a href=\"javascript:void(0)\" >
						首页
					</a>
				</li>
				<li class=\"disabled\">
					<a href=\"javascript:void(0)\" aria-label=\"Previous\">
						<span aria-hidden=\"true\">&laquo;</span>
					</a>
				</li>
			";
		}
		else
			$str="<li >
					<a href=\"{$url}Page=1#refresh\" >
						首页
					</a>
				</li>
					<li>
					<a href=\"{$url}Page={$page_previous}#refresh\" aria-label=\"Previous\">
						<span aria-hidden=\"true\">&laquo;</span>
					</a>
				</li>";
		for ($i=$page_start;$i<$page_end;$i++){
			$j=$i+1;
			if($Page==$j){
				$str=$str."<li class='active'><a href=\"javascript:void(0)\">$Page</a></li>";
				continue;
			}
			$str=$str."<li><a href=\"{$url}Page={$j}#refresh\">$j</a></li>";
		}
		if ($Page==$PageCount)
			$str=$str."<li class='disabled'>
					<a href=\"javascript:void(0)\" aria-label=\"Next\">
						<span aria-hidden=\"true\">&raquo;</span>
					</a>
				</li>
				<li class='disabled'>
					<a href=\"javascript:void(0)\" >
						末页
					</a>
				</li>
				";
		else
			$str=$str."<li>
					<a href=\"{$url}Page={$page_next}#refresh\" aria-label=\"Next\">
						<span aria-hidden=\"true\">&raquo;</span>
					</a>
				</li>
				<li>
					<a href=\"{$url}Page={$PageCount}#refresh\" >
						末页
					</a>
				</li>
				";
	echo $str;
}
//
////因为用户删除或加权操作会导致id值跳跃，所以要更新id值，否则找不到谁发的评论(更新reply)
//if(isset($_SESSION['id'])){
//	$sql="select * from user";
//	$result=$conn->query($sql);
//	if($result->num_rows>0) {
//		while ($row = $result -> fetch_assoc()) {
//			if($_SESSION['username']==$row['username']){
//				$_SESSION['id']=$row['id'];
//			}
//			$sql="select user_id from reply where user_username='{$row['username']}'";
//			$result2=$conn->query($sql);
//			if($result2->num_rows>0){
//				$row2=$result2->fetch_assoc();
//				$sql="update reply set user_id={$row['id']} where user_id = {$row2['user_id']}";
//				$conn->query($sql);
//			}
//		}
//	}
////因为用户删除或加权操作会导致id值跳跃，所以要更新id值，否则找不到谁发的评论（更新diary）
//	$sql="select * from user";
//	$result=$conn->query($sql);
//	if($result->num_rows>0) {
//		while ($row = $result -> fetch_assoc()) {
//			if($_SESSION['username']==$row['username']){
//				$_SESSION['id']=$row['id'];
//			}
//			$sql="select user_id from diary where user_username='{$row['username']}'";
//			$result2=$conn->query($sql);
//			if($result2->num_rows>0){
//				$row2=$result2->fetch_assoc();
//				$sql="update diary set user_id={$row['id']} where user_id = {$row2['user_id']}";
//				$conn->query($sql);
//			}
//		}
//	}
//}

?>