<?php
if (!session_id()) session_start();
date_default_timezone_set('PRC');//临时设置中国时区
header("content-type:text/html;charset=utf8");
$url = "localhost";
$password = "";
$conn = mysqli_connect($url , "root" , $password , "shopping" , 3306);
mysqli_query($conn , "set names 'UTF8'");
function selectAllNoWhere($table , $flag , $conn)
{
	
	$sql = "select * from {$table} ";
	if ($flag == 1) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} elseif ($flag == 2) {
		return mysqli_fetch_array(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectAllWhereOne($table , $index , $string , $flag , $conn)
{
	$sql = "";
	if (is_string($string)) {
		$sql = "select * from {$table} where   {$index} = '{$string}'";
	} else {
		$sql = "select * from {$table} where   {$index} = {$string}";
	}
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
	
}

function selectAllWhereTwoOr($table , $index1 , $string1 , $index2 , $string2 , $index3 , $string3 , $flag , $conn)
{
	$sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or  {$string3} = '{$index3}' ";
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectAllWhereTwoOrOneAnd($table , $index1 , $string1 , $index2 , $string2 , $index3 , $string3 , $index4 , $string4 , $flag , $conn)
{
	$sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or {$index3} = '{$string3}' and {$index4} = '{$string4}' ";
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectAllWhereTwoOrTwoAnd($table , $index1 , $string1 , $index2 , $string2 , $index3 , $string3 , $index4 , $string4 , $index5 , $string5 , $flag , $conn)
{
	$sql = "select * from {$table} where {$index1} = '{$string1}' or {$index2} = '{$string2}' or {$index3} = '{$string3}' and {$index4}
		= '{$string4}' and {$index5} = '{$string5}'   ";
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectOneWhereOne($table , $num , $index , $string , $flag , $conn)
{
	$sql = "select {$num} from {$table} where {$index} = '{$string}'";
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectOneWhereOneAnd($table , $num , $index , $string , $index2 , $string2 , $flag , $conn)
{
	if (is_string($string)) {
		$sql = "select {$num} from {$table} where {$index} = '{$string}' and  {$index2} = '{$string2}' ";
	} else {
		$sql = "select {$num} from {$table} where {$index} = {$string} and  {$index2} = '{$string2}' ";
	}
	
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function selectOneWhereTwoAnd($table , $num , $index , $string , $index2 , $string2 , $index3 , $string3 , $flag , $conn)
{
	if (is_string($string)) {
		$sql = "select {$num} from {$table} where {$index} = '{$string}' and  {$index2} = '{$string2}' and {$index3} ={$string3} ";
	} else {
		$sql = "select {$num} from {$table} where {$index} = {$string} and  {$index2} = '{$string2}' and {$index3} ={$string3}";
	}
	
	if ($flag) {
		return mysqli_fetch_assoc(mysqli_query($conn , $sql));
	} else {
		return mysqli_query($conn , $sql);
	}
}

function insertAll($table , $num1 , $num2 , $num3 , $num4 , $num5 , $num6 , $num7 , $num8 , $num9 , $num10 , $num11 , $conn)
{
	$sql = "insert into {$table} values ('" . $num1 . "','" . (string)$num2 .
		"','" . (string)$num3 . "','" . (string)$num4 . "','" .
		(string)$num5 . "','" . (string)$num6 . "','" .
		(string)$num7 . "','" . (string)$num8 . "','" . (string)$num9 .
		"','" . (string)$num10 . "','" . (string)$num11 . "')";
	return mysqli_query($conn , $sql);
}

function deleteWhereOne($table , $index , $string , $conn)
{
	$sql = "delete from {$table} where {$index}={$string}";
	return mysqli_query($conn , $sql);
}

function deleteWhereOneAnd($table , $index , $string , $index2 , $string2 , $conn)
{
	$sql = "delete from {$table} where {$index}={$string} and {$index2} = '{$string2}'";
	return mysqli_query($conn , $sql);
}

function updateAllExcpetImgAddr($table , $index1 , $string1 , $index2 , $string2 , $index3 , $string3 , $index4 , $string4 ,
                                $index5 , $string5 , $index6 , $string6 , $index7 , $string7 , $index8 , $string8 ,
                                $indexwhere , $stringwhere , $conn)
{
	
	$sql = "update {$table} set  {$index1}='{$string1}',
    {$index2}='{$string2}',{$index3}='{$string3}',
    {$index4}='{$string4}',{$index5}='{$string5}',
    {$index6}='{$string6}',{$index7}='{$string7}',
    {$index8}='{$string8}'  where {$indexwhere}={$stringwhere}";
	return mysqli_query($conn , $sql);
}

function updateAll($table , $index1 , $string1 , $index2 , $string2 , $index3 , $string3 , $index4 , $string4 ,
                   $index5 , $string5 , $index6 , $string6 , $index7 , $string7 , $index8 , $string8 , $index9 , $string9 ,
                   $indexwhere , $stringwhere , $conn)
{
	
	$sql = "update {$table} set  {$index1}='{$string1}',
    {$index2}='{$string2}',{$index3}='{$string3}',
    {$index4}='{$string4}',{$index5}='{$string5}',
    {$index6}='{$string6}',{$index7}='{$string7}',
    {$index8}='{$string8}',{$index9}='{$string9}'  where {$indexwhere}={$stringwhere}";
	return mysqli_query($conn , $sql);
}

function updateOne($table , $index , $string , $indexwhere , $stringwhere , $conn)
{
	if (is_string($string)) {
		if ($string === "null") {
			$sql = "update {$table} set {$index} = {$string} where  {$indexwhere} = {$stringwhere}";
		} else {
			$sql = "update {$table} set {$index} = '{$string}' where  {$indexwhere} = {$stringwhere}";
		}
		
	} else {
		$sql = "update {$table} set {$index} = {$string} where  {$indexwhere} = {$stringwhere}";
	}
	return mysqli_query($conn , $sql);
}

function updateTwo($table , $index , $string , $index2 , $string2 , $indexwhere , $stringwhere , $conn)
{
	$sql = "update {$table} set {$index} = '{$string}',{$index2} = {$string2} where  {$indexwhere} = {$stringwhere}";
	return mysqli_query($conn , $sql);
}

//分页
function page($RecordCount , $PageSize , $Page , $url , $searchtext = null , $sel = null , $from_price = null , $to_price = null)
{
	$PageCount = ceil($RecordCount / $PageSize);//总页数
	$page_previous = ($Page <= 1) ? 1 : $Page - 1;//计算上一页的页数
	$page_next = ($Page >= $PageCount) ? $PageCount : $Page + 1;//计算下一页的页数
	$page_start = ($Page - 5 > 0) ? $Page - 5 : 0;//只显示本页的前5页的页面
	$page_end = ($page_start + 10 < $PageCount) ? $page_start + 10 : $PageCount;//后五页
	$page_start = $page_end - 10;
//	有搜索内容
	if (!is_null($searchtext) && !is_null($sel)) {
		if ($page_start < 0) {
			$page_start = 0;//若当前页面不合法，更正
		}
		$parse_url = parse_url($url);//判断url是否含有字符串
		if (empty($parse_url['query'])) {
			$url = $url . '?';//若不存在，在url后面添加?
		} else {
			$url = $url . '&';//若存在，在后面添加&
		}
		
		if ($Page == 1) {
			$str = "<li class=\"disabled\">
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
		} else
			$str = "<li >
					<a href=\"{$url}Page=1&searchtext={$searchtext}&sel={$sel}#refresh\" >
						首页
					</a>
				</li>
					<li>
					<a href=\"{$url}Page={$page_previous}&searchtext={$searchtext}&sel={$sel}#refresh\" aria-label=\"Previous\">
						<span aria-hidden=\"true\">&laquo;</span>
					</a>
				</li>";
		for ($i = $page_start; $i < $page_end; $i ++) {
			$j = $i + 1;
			if ($Page == $j) {
				$str = $str . "<li class='active'><a href=\"javascript:void(0)\">$Page</a></li>";
				continue;
			}
			$str = $str . "<li><a href=\"{$url}Page={$j}&searchtext={$searchtext}&sel={$sel}#refresh\">$j</a></li>";
		}
		if ($Page == $PageCount)
			$str = $str . "<li class='disabled'>
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
			$str = $str . "<li>
					<a href=\"{$url}Page={$page_next}&searchtext={$searchtext}&sel={$sel}#refresh\" aria-label=\"Next\">
						<span aria-hidden=\"true\">&raquo;</span>
					</a>
				</li>
				<li>
					<a href=\"{$url}Page={$PageCount}&searchtext={$searchtext}&sel={$sel}#refresh\" >
						末页
					</a>
				</li>
				";
		echo $str;
	} //	有价格区间
	elseif (!is_null($from_price) && !is_null($to_price)) {
		if ($page_start < 0) {
			$page_start = 0;//若当前页面不合法，更正
		}
		$parse_url = parse_url($url);//判断url是否含有字符串
		if (empty($parse_url['query'])) {
			$url = $url . '?';//若不存在，在url后面添加?
		} else {
			$url = $url . '&';//若存在，在后面添加&
		}
		
		if ($Page == 1) {
			$str = "<li class=\"disabled\">
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
		} else
			$str = "<li >
					<a href=\"{$url}Page=1&from_price={$from_price}&to_price={$to_price}#refresh\" >
						首页
					</a>
				</li>
					<li>
					<a href=\"{$url}Page={$page_previous}&from_price={$from_price}&to_price={$to_price}#refresh\" aria-label=\"Previous\">
						<span aria-hidden=\"true\">&laquo;</span>
					</a>
				</li>";
		for ($i = $page_start; $i < $page_end; $i ++) {
			$j = $i + 1;
			if ($Page == $j) {
				$str = $str . "<li class='active'><a href=\"javascript:void(0)\">$Page</a></li>";
				continue;
			}
			$str = $str . "<li><a href=\"{$url}Page={$j}&from_price={$from_price}&to_price={$to_price}#refresh\">$j</a></li>";
		}
		if ($Page == $PageCount)
			$str = $str . "<li class='disabled'>
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
			$str = $str . "<li>
					<a href=\"{$url}Page={$page_next}&from_price={$from_price}&to_price={$to_price}#refresh\" aria-label=\"Next\">
						<span aria-hidden=\"true\">&raquo;</span>
					</a>
				</li>
				<li>
					<a href=\"{$url}Page={$PageCount}&from_price={$from_price}&to_price={$to_price}#refresh\" >
						末页
					</a>
				</li>
				";
		echo $str;
	} //	默认
	else {
		if ($page_start < 0) {
			$page_start = 0;//若当前页面不合法，更正
		}
		$parse_url = parse_url($url);//判断url是否含有字符串
		if (empty($parse_url['query'])) {
			$url = $url . '?';//若不存在，在url后面添加?
		} else {
			$url = $url . '&';//若存在，在后面添加&
		}
		
		if ($Page == 1) {
			$str = "<li class=\"disabled\">
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
		} else
			$str = "<li >
					<a href=\"{$url}Page=1#refresh\" >
						首页
					</a>
				</li>
					<li>
					<a href=\"{$url}Page={$page_previous}#refresh\" aria-label=\"Previous\">
						<span aria-hidden=\"true\">&laquo;</span>
					</a>
				</li>";
		for ($i = $page_start; $i < $page_end; $i ++) {
			$j = $i + 1;
			if ($Page == $j) {
				$str = $str . "<li class='active'><a href=\"javascript:void(0)\">$Page</a></li>";
				continue;
			}
			$str = $str . "<li><a href=\"{$url}Page={$j}#refresh\">$j</a></li>";
		}
		if ($Page == $PageCount)
			$str = $str . "<li class='disabled'>
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
			$str = $str . "<li>
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
}

function getNameByType($value)
{
	switch ($value) {
		case "boy_jiake":
			echo "男夹克";
			break;
		case "boy_xifu":
			echo "男西服";
			break;
		case "boy_txue":
			echo "男体恤";
			break;
		case "boy_yurongfu":
			echo "男羽绒服";
			break;
		case "boy_xiuxianku":
			echo "男休闲裤";
			break;
		case "boy_shirt":
			echo "男衬衫";
			break;
		case "girl_banshenqun":
			echo "女半身裙";
			break;
		case "girl_lianyiqun":
			echo "女连衣裙";
			break;
		case "girl_hunsha":
			echo "女婚纱";
			break;
		case "girl_xiaoxizhuang":
			echo "女西装";
			break;
		case "girl_duanwaitao":
			echo "女短外套";
			break;
		case "girl_yangrongshan":
			echo "女羊绒衫";
			break;
		default:
			echo "其他";
			break;
	}
	
}

function getadminType($value)
{
	switch ($value) {
		case "true":
			if ($_SESSION['name'] == 'admin' && $_SESSION['username'] == 'admin' && $_SESSION['email'] == "admin" && $_SESSION['phone'] == "admin") {
				echo "超级管理员";
			} else {
				echo "管理员";
			}
			break;
		case "merchant":
			echo "商家";
			break;
		case "false":
			echo "普通用户";
			break;
	}
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