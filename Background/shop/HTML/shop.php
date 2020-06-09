<?php
session_start();
require '../../conn.php';
if (isset($_GET['sel']) && isset($_GET['searchtext']) && trim($_GET['searchtext']) == "") {
	echo "<script>alert('输入不能为空');location.assign('shop.php')</script>";
}


$pageSize = 5;
if (isset($_GET['Page']) && (int)$_GET['Page'] > 0) {
	$page = $_GET['Page'];
} else {
	$page = 1;
}
$sql = "select shop_id from shop where user_id = {$_SESSION['id']}";
//			根据搜索结果查询
if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
	if ($_GET['sel'] == 'shop_id') {
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
		
		<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>店铺 <span
				class="badge"><?php echo $RecordCount ?></span>
	</div>
	
	<div class="admininformation" style="background-color: rgb(245,245,245)">
		<form class="navbar-form navbar-left" action="add_shop.php">
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 添加店铺</button>
		</form>
		<form class="navbar-form navbar-right" style="margin-right: 2%;" action="" method="get">
			<div class="text-center" STYLE="position: relative">
				<input type="text" name="searchtext" class="form-control" placeholder="您输入要查找店铺字段的名字">
				<select class="form-control" name="sel">
					<option value="shop_id">序号</option>
					<option value="shop_name">店铺名</option>
					<option value="shop_maintype">店铺类型</option>
					<option value="shop_sign_time">创建时间</option>
				</select>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> 查询
				</button>
				<?php
				if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
					echo "<a href='shop.php' class='btn btn-default'>返回</a>";
				}
				?>
			</div>
		</form>
		
		<table class="table table-hover table-striped  text-center">
			<form action="../PHP/delete_shop.php" method="post">
				<tr>
					<td>
						序号
					</td>
					<td>
						店铺图标
					</td>
					<td>
						店铺名
					</td>
					<td>
						店铺介绍
					</td>
					<td>
						店铺主要类型
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
						<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
							批量删除
						</button>
						<input style="width: 30px;height: 30px;" type='checkbox' id='batch_choose'
						       class="checkbox-inline deletecheckbox">
					</td>
				</tr>
				<?php
				//			根据是否选择价钱排序查询
				
				//			根据搜索结果查询
				$sql = "select * from shop where user_id = {$_SESSION['id']}";
				if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
					if ($_GET['sel'] == 'shop_id') {
						$sql = $sql . " and {$_GET['sel']} = {$_GET['searchtext']} ";
					} else {
						$sql = $sql . " and {$_GET['sel']} like '%{$_GET['searchtext']}%' ";
					}
					
					echo " <tr><td colspan='9' class='text-center'>您想查询的是'{$_GET['searchtext']}',共查询到{$RecordCount}条记录 </td></tr>";
				}
				$sql = $sql . " order by shop_sign_time desc limit $limitindex,$pageSize ";
				$result = $conn -> query($sql);
				if ($result -> num_rows > 0) {
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							?>
							<tr>
								<td>
									<em><?php echo $row['shop_id'] ?></em>
								</td>
								<td>
									<a href="../../../HTML/shop.php?id=<?php echo $row['shop_id'] ?>"
									   target="_blank"><img src="../../<?php echo $row['shop_img_addr'] ?>" width="86"
									                        height="86" style="border-radius: 10%"></a>
								</td>
								<td>
									<a href="../../../HTML/shop.php?id=<?php echo $row['shop_id'] ?>"
									   target="_blank"><?php echo $row['shop_name'] ?></a>
								</td>
								<td>
									<?php echo $row['shop_text'] ?>
								</td>
								<td>
									<?php echo $row['shop_maintype'] ?>
								</td>
								<td>
									<?php echo $row['shop_sign_time'] ?>
								</td>
								<td>
									<a href="update_shop.php?id=<?php echo $row['shop_id'] ?>"
									   class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> 更新</a>
								</td>
								<td>
									<a href="../PHP/delete_shop.php?id=<?php echo $row['shop_id'] ?>"
									   class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> 删除</a>
								</td>
								<td>
									<input style="width: 30px;height: 30px;margin-left: 66%" type='checkbox' id='choose'
									       class="deletecheckbox checkbox " name='choose[]'
									       value="<?php echo $row['shop_id'] ?>">
								</td>
							</tr>
							<?php
						}
					}
				} else {
					if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
						echo "<tr><td colspan='9' class='text-center'>暂无结果，请换个关键词查询把！<td><tr>";
					} else {
						echo "<tr><td colspan='9' class='text-center'>暂无店铺，快去添加吧！<td><tr>";
					}
				}
				$result -> free_result();
				?>
			</form>
			<tr>
				<td colspan="7" class="text-center">
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
	$(function () {
		$('#batch_choose').on('click', function () {
			var arr = document.getElementsByName("choose[]");
			for (var i = 0; i < arr.length; i++) {
				arr[i].checked = $('#batch_choose:checked').val();//循环遍历看是否全选
				$('.product_container').css("background-color", "#449d44");
			}
			if (!$('#batch_choose:checked').val()) {
				$('.product_container').css("background-color", "inherit");
			}
		});
	})
</script>
</body>
</html>