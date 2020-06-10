<?php
session_start();
require '../../conn.php';
if (isset($_GET['sel']) && isset($_GET['searchtext']) && trim($_GET['searchtext']) == "") {
	echo "<script>alert('输入不能为空');location.assign('user.php')</script>";
}


$pageSize = 4;
if (isset($_GET['Page']) && (int)$_GET['Page'] > 0) {
	$page = $_GET['Page'];
} else {
	$page = 1;
}
$sql = "select id from user where isadmin='false'";
//			根据搜索结果查询
if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
	if ($_GET['sel'] == 'id') {
		$sql = $sql . " and {$_GET['sel']} = {$_GET['searchtext']} ";
	} else {
		$sql = $sql . " and {$_GET['sel']} like '%{$_GET['searchtext']}%' ";
	}
}
$result = $conn -> query($sql);
$RecordCount = $result -> num_rows;
$page == 1 ? $limitindex = 0 : $limitindex = ($page - 1) * $pageSize;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>我的信息</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	
	<script type="text/javascript" src="../../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../../CSSLIB/bootstrap.css" rel="stylesheet">
	<style>
		table {
			font-size: 18px;
			
			}
	</style>

</head>
<body>

<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 2px silver solid;height: 50px;color: #5e5e5e">
		
		<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>所有用户 <span
			class="badge"><?php echo $RecordCount ?></span>
	</div>
	
	<div class="admininformation" style="background-color: rgb(245,245,245)">
		<form class="navbar-form navbar-left" action="add_user.php">
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 添加用户</button>
		</form>
		<form class="navbar-form navbar-right" style="margin-right: 2%;" action="" method="get">
			<div class="text-center" STYLE="position: relative">
				<input type="text" name="searchtext" class="form-control" placeholder="您输入要查找商家字段的名字">
				<select class="form-control" name="sel">
					<option value="id">序号</option>
					<option value="name">姓名</option>
					<option value="username">账号</option>
					<option value="email">邮箱</option>
					<option value="phone">电话</option>
					<option value="sex">性别</option>
					<option value="caree">职业</option>
					<option value="password">密码</option>
					<option value="invite_code">邀请码</option>
				</select>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> 查询
				</button>
				<?php
				if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
					echo "<a href='user.php' class='btn btn-default'>返回</a>";
				}
				?>
			</div>
		</form>
		
		<table class="table table-hover table-striped  text-center">
			<form action="../PHP/delete_user.php" method="post" id="form">
				<tr>
					<td>
						序号
					</td>
					<Td>
						头像
					</Td>
					<td>
						账号
					</td>
					<Td>
						邮箱
					</Td>
					<td>
						性别
					</td>
					<td>
						电话
					</td>
					<td>
						姓名
					</td>
					<td>
						职业
					</td>
					<td>
						邀请码
					</td>
					<td>
						密码
					</td>
					<td>
						创建时间
					</td>
					<td>
						更新
					</td>
					<td>
						删除
					</td>
					<td>
						权限
					</td>
					<td>
						
						<button type="submit" id="deleteall" class="btn btn-danger"><span
								class="glyphicon glyphicon-remove"></span>
							批量删除
						</button>
						<input style="width: 30px;height: 30px;" type='checkbox'
						       class="checkbox-inline deletecheckbox batch_choose" onclick="allok(this)"
						       name="allchecked">
					</td>
				</tr>
				<?php
				//			根据是否选择价钱排序查询
				
				//			根据搜索结果查询
				$sql = "select * from user where isadmin='false'";
				if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
					if ($_GET['sel'] == 'id') {
						$sql = $sql . " and {$_GET['sel']} = {$_GET['searchtext']} ";
					} else {
						$sql = $sql . " and {$_GET['sel']} like '%{$_GET['searchtext']}%' ";
					}
					
					echo " <tr><td colspan='14' class='text-center'>您想查询的是'{$_GET['searchtext']}',共查询到{$RecordCount}条记录 </td></tr>";
				}
				$sql = $sql . " order by sign_time desc limit $limitindex,$pageSize ";
				$result = $conn -> query($sql);
				if ($result -> num_rows > 0) {
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							?>
							<tr>
								<td>
									<em><?php echo $row['id'] ?></em>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><img src="../../<?php echo $row['img_addr'] ?>" width="86"
									                        height="86" style="border-radius: 10%"></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['username'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['email'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['sex'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['phone'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['name'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['caree'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['invite_code'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['password'] ?></a>
								</td>
								<td>
									<a href="../../../HTML/user_other.php?id=<?php echo $row['id'] ?>"
									   target="_blank"><?php echo $row['sign_time'] ?></a>
								</td>
								<td>
									<a href="update_user.php?id=<?php echo $row['id'] ?>"
									   class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> 更新</a>
								</td>
								<td>
									<a href="../PHP/delete_user.php?id=<?php echo $row['id'] ?>"
									   class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> 删除</a>
								</td>
								<td>
									<a href="../PHP/grant_user.php?id=<?php echo $row['id'] ?>"
									   class="btn btn-success"><span class="glyphicon glyphicon-chevron-up"></span>
										加权</a>
								</td>
								<td>
									<input style="width: 30px;height: 30px;margin-left: 66%" type='checkbox' id='choose'
									       class="deletecheckbox checkbox " name='choose[]'
									       value="<?php echo $row['id'] ?>">
								</td>
							</tr>
							<?php
						}
					}
				} else {
					if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
						echo "<tr><td colspan='14' class='text-center'>暂无结果，请换个关键词查询把！<td><tr>";
					} else {
						echo "<tr><td colspan='14' class='text-center'>暂无店铺，快去添加吧！<td><tr>";
					}
				}
				$result -> free_result();
				?>
				<tr>
					<Td colspan="13"></Td>
					<td>
						<button type="submit" id="jiaquan"
						        class="btn btn-success"><span class="glyphicon glyphicon-chevron-up"></span> 批量加权
						</button>
					</td>
					<td>
						
						<input style="width: 30px;height: 30px;" type='checkbox'
						       class="checkbox-inline deletecheckbox batch_choose" onclick="allok(this)"
						       name="allchecked">
					</td>
				</tr>
			</form>
			<tr>
				<td colspan="14" class="text-center">
					<!--		分页-->
					<nav class="text-center">
						<ul class="pagination">
							<?php
							if ($RecordCount > 0) {
								$url = $_SERVER['PHP_SELF'];//获取当前页的URL
								$PageCount = ceil($RecordCount / $pageSize);//总页数
								
								if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
									page($RecordCount , $pageSize , $page , $url , $_GET['searchtext'] , $_GET['sel']);
									echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
									echo " <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this.value,'{$url}','{$page}','{$PageCount}','{$_GET['searchtext']}','{$_GET['sel']}')\">/$PageCount 页";
								} else {
									page($RecordCount , $pageSize , $page , $url);
									echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
									echo " <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this.value,'{$url}','{$page}','{$PageCount}')\">/$PageCount 页";
								}
							}
							?>
							<script>
								
								function goPage(val, url, page, pagecount, searchtext = null, sel = null, from_price = null, to_price = null) {
									if (parseInt(val) <= 0) {
										document.getElementById('goPage').value = 1;
									}
									if (parseInt(val) > pagecount) {
										document.getElementById('goPage').value = pagecount;
									}
									if (sel && searchtext) {
										location.assign(url + '?Page=' + document.getElementById('goPage').value + '&sel=' + sel + '&searchtext=' + searchtext);
									} else {
										location.assign(url + '?Page=' + document.getElementById('goPage').value);
									}
									
									
								}
							</script>
						</ul>
					</nav>
				</td>
			</tr>
		</table>
	</div>

</div>
<script>
	function allok(choiceBtn) {
		var arr = document.getElementsByName("choose[]");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = choiceBtn.checked;//循环遍历看是否全选
		}
		var arr2 = document.getElementsByName("allchecked");
		for (var i = 0; i < arr2.length; i++) {
			arr2[i].checked = choiceBtn.checked;//循环遍历看是否全选
		}
	}
</script>
<script>
	$(function () {
		$('#form').on('submit', function (i) {
		});
		$('#jiaquan').on('click', function () {
			$('#form').attr('action', '../PHP/grant_user.php');
		});
		$('#deleteall').on('click', function () {
			$('#form').attr('action', '../PHP/delete_user.php');
		});
	})
</script>
</body>
</html>
