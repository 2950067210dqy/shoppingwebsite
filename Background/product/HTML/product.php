<?php
session_start();
require '../../conn.php';
if (isset($_GET['sel']) && isset($_GET['searchtext']) && trim($_GET['searchtext']) == "") {
	echo "<script>alert('输入不能为空');location.assign('product.php')</script>";
}


$pageSize = 60;
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
		
		/* 店铺展示*/
		.item {
			/*padding: 10px;*/
			box-shadow: 0px 0px 10px 5px #aaa;
			position: relative;
			border: 1px solid rgb(222, 222, 222);
			height: 250px;
			margin-top: 10%;
			width: auto;
			}
		
		.item:hover {
			border: 1px solid rgb(255, 68, 0);
			}
		
		
		.item p {
			margin-top: 10px;
			}
		
		.item img {
			width: 100%;
			height: 150px;
			}
		
		.item_title {
			color: #666666;
			font-size: 12px;
			}
		
		.item_title:hover {
			color: #e4393c;
			}
		
		.item_merchant {
			color: #999999;
			font-size: 12px;
			}
		
		.item_merchant:hover {
			color: #e4393c;
			}
		
		.item_merchant_place {
			
			color: #999999;
			font-size: 12px;
			}
	</style>
</head>
<body>

<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 2px silver solid;height: 50px;color: #5e5e5e">
		<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>商品
	</div>
	
	<div class="admininformation" style="background-color: rgb(245,245,245)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-left " style="font-size: 18px;">
						<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>店铺<span
								class="badge"><?php echo $RecordCount ?></span>
					</div>
					<form class="navbar-form navbar-left" method="get" action="productitem.php">
						<input name="id" value="all" type="hidden">
						<button type="submit" class="btn btn-default">所有商品</button>
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
							<button type="submit" class="btn btn-default"><span
										class="glyphicon glyphicon-search"></span> 查询
							</button>
							<?php
							if (isset($_GET['searchtext']) && isset($_GET['sel'])) {
								echo "<a href='product.php' class='btn btn-default'>返回</a>";
							}
							?>
						</div>
					</form>
				</div>
			</div>
			
			
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
				
				echo " <tr><td colspan='9' class='text-center'>您查询到的店铺名为'{$_GET['searchtext']}',共查询到{$RecordCount}条记录 </td></tr>";
			}
			$sql = $sql . " order by shop_sign_time desc limit $limitindex,$pageSize ";
			$result = $conn -> query($sql);
			$i = 1;
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					if ($i % 6 == 0) {
						echo "<div class=\"row\" >";
					}
					?>
					<div class="col-lg-2 col-md-3 col-ms-3 col-xs-6">
						<div class="item">
							<span style="position: absolute;top: 0;color:#4d88ff;font-size: 16px"><?php echo $row['shop_id'] ?></span>
							<a href="productitem.php?id=<?php echo $row['shop_id']; ?>"><img
										src="../../<?php echo $row['shop_img_addr']; ?>"></a>
							<p><a href="productitem.php?id=<?php echo $row['shop_id']; ?>"
							      class="item_title"><?php if (strlen($row['shop_name']) > 100) echo substr($row['shop_name'] , 0 , 100) . '....'; else echo $row['shop_name']; ?></a>
							</p>
							<p><a href="productitem.php?id=<?php echo $row['shop_id']; ?>" class="item_merchant"><font
											color="#4d88ff">●</font><?php echo $row['shop_text']; ?></a>
								<span class="item_merchant_place">店铺类型： <?php echo $row['shop_maintype']; ?></span>
							</p>
						</div>
					</div>
					<?php
					if ($i % 6 == 0) {
						echo "</div>";
					}
					$i ++;
				}
			} else {
				echo "<div class=\"col-lg-12 text-center\" style='font-size: 20px'>暂无店铺，快去添加吧</div>";
			}
			?>
		</div>
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
