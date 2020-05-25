<?php
require ("../PHP/conn.php");
$url="";
if(!isset($_GET['price'])||$_GET['price']=="asc"){
	$url=$_SERVER["PHP_SELF"]."?type=".$_GET['type']."&price=desc";

}elseif($_GET['price']=="desc"){
	$url=$_SERVER["PHP_SELF"]."?type=".$_GET['type']."&price=random";
}elseif($_GET['price']=="random"){
	$url=$_SERVER["PHP_SELF"]."?type=".$_GET['type']."&price=asc";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	
	
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">

</head>
<body>
<a href="#" class="btn btn-danger text-center" style="position: fixed;z-index: 99;top: 30%;right: 3%;">返回顶部</a>
<div class="main">
	<!--用来存储登录的状态-->
	<input type="hidden" value="<?php
	if (isset($_SESSION['id'])) {
		echo 'yes';
	} else {
		echo 'no';
	}
	?>" id="isLogin">
	<!--	获取网页顶部导航栏-->
	<?php require 'top.php' ?>
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	
	<div style="width: 100%;height: 110px;">
		<div class="logo_search">
			<div class="logoleft">
				<a href="#">
					<img height="100" src="../IMG/logo.png" alt="唯品会">
				</a>
			</div>
			<div class="logoright">
				<a href="#" >
					<img height="60"  width="90" src="../IMG/logo2.png" alt="100%正品">
				</a>
				<a href="#" >
					<img height="60"  width="90" src="../IMG/logo3.png" alt="七天放心">
				</a>
				<a href="#">
					<img height="60" width="90" src="../IMG/logo4.png" alt="3亿会员">
				</a>
			
			
			</div>
			<!--			搜索框/购物车-->
			<div style="margin-top: 25px">
				<div class="search">
					<div class="searchinput_shopcarinput">
						<form action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" id="search_form">
							<input type="hidden" value="<?php echo $_GET['type']; ?>" name="type">
							<input type="text" placeholder="搜索商品" name="searchtext" style="display: inline;width: 30%"
							       id="search_text">
							<select id="search_sel" name="search_sel">
								<option value="product_name">商品名</option>
								<option value="product_price">价钱</option>
							</select>
							<span id="product_price" style="display: none">￥<input disabled type="number"
							                                                       name="from_price" id="from_price"
							                                                       style="width: 10%"><b>——</b>￥<input
										disabled type="number" name="to_price" id="to_price" style="width: 10%"></span>
							<input type="image" name="search" src="../IMG/search.png"
							       style="width: 50px;height:30px;display: inline" id="search_btn">
							<script>
								$(document).ready(function () {
									
									//点击价钱select时，价钱的input显示
									$('#search_sel').on("change", function () {
										document.getElementById('search_text').toggleAttribute("disabled");
										document.getElementById('from_price').toggleAttribute("disabled");
										document.getElementById('to_price').toggleAttribute("disabled");
										$('#search_text').toggle('fast');
										$('#product_price').toggle('fast');
										$('#product_price').css("display", "inline");
									});
									
									//检测输入框得值是否违法
									$('#search_form').on('submit', function () {
										if ($('#search_text').css("display") === "none") {
											var from_price = parseInt($('#from_price').val());
											var to_price = parseInt($('#to_price').val());
											if (from_price && to_price) {
												if (from_price >= 0 && to_price >= 0) {
													return true;
												} else {
													alert("价格不能为负数！");
													$('#from_price').val('');
													$('#to_price').val('')
													return false;
												}
											} else {
												alert("价格不能为空！");
												return false;
											}
										} else {
											var search_text = $('#search_text').val();
											if (search_text) {
												return true;
											} else {
												alert("输入不能为空！");
												return false;
											}
										}
										
									});
								});
							</script>
							
							<span class="shopcar">
                        <a href="javascript:void(0)" class="shopcar">
                            <span class="shopcar_img"><img src="../IMG/shopcar.png" width="25" height="25"> </span>
                            <span class="shopcar_word">购物车</span>
                            <span class="shopcar_msg"><?php if (!isset($_SESSION['id'])) echo 0; elseif (isset($_SESSION['shopnum'])) echo $_SESSION['shopnum'];
	                            else {
		                            $sql = "select id from shopcar where user_id = {$_SESSION['id']}";
		                            $result = $conn -> query($sql);
		                            echo $result -> num_rows;
	                            } ?></span>
                        </a>
                        </span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--	商品排列方式菜单-->
	<div class="container">
		<div class="row">
			<div class="col-lg-2 text-center">
				<a class="btn btn-info" href="<?php echo $url?>"><?php if(!isset($_GET['price'])||$_GET['price']=="asc")echo "按价钱从小到大排序";elseif($_GET['price']=="desc") echo "按价钱从大到小排序";else echo "随机排列"?></a>
			</div>
		</div>
	</div>
		<!--	商品信息-->
		<div class="container" style="margin-top: 1%">
<!--			商品类别-->
			<div class="row">
				<?php
				$type=$_GET['type'];
				$typeName="";
				switch ($type) {
					case    "boy_shirt":$typeName="男衬衫";	break;
					case    "boy_yurongfu":$typeName="男羽绒服";break;
					case    "boy_jiake":$typeName="男夹克";	break;
					case    "boy_xifu":$typeName="男西服套装";	break;
					case	"boy_txue":$typeName="男T恤";	break;
					case	"boy_xiuxianku":$typeName="男休闲裤";	break;
					case    "girl_lianyiqun":
						$typeName = "女连衣裙";
						break;
					case    "girl_banshenqun":
						$typeName = "女半身裙";
						break;
					case    "girl_duanwaitao":
						$typeName = "女短外套";
						break;
					case    "girl_xiaoxizhuang":
						$typeName = "女小西装";
						break;
					case    "girl_yangrongshan":
						$typeName = "女羊绒衫";
						break;
					case    "girl_hunsha":
						$typeName = "女婚纱";
						break;
					default:
						break;
				}
				?>
				<div class="col-lg-12 text-left" id="product_type"
				     style=" color: white;background-color:  rgb(1,158,210);font-size: 25px;box-shadow:0px 0px  10px 5px #aaa;">
					<?php
					echo $typeName;
					if (isset($_GET["searchtext"]) || (isset($_GET["from_price"]) && isset($_GET['to_price']))) {
						echo "<a class='btn btn-default' href='{$_SERVER['PHP_SELF']}?type={$_GET['type']}'>返回</a>";
					}
					?>
				</div>
				<!--			商品信息容器-->
				<?php
				$pageSize = 96;
				if (isset($_GET['Page']) && (int)$_GET['Page'] > 0) {
					$page = $_GET['Page'];
				} else {
					$page = 1;
				}
				$sql = "select id from {$_GET['type']}";
				//			根据搜索结果查询
				if (isset($_GET['searchtext'])) {
					$sql = $sql . " where title like '%{$_GET['searchtext']}%' ";
				} elseif (isset($_GET['from_price']) && isset($_GET['to_price'])) {
					$sql = $sql . " where price >= {$_GET['from_price']} and price <= {$_GET['to_price']}";
				}
				$result = $conn -> query($sql);
				$RecordCount = $result -> num_rows;
				$page == 1 ? $limitindex = 0 : $limitindex = ($page - 1) * $pageSize;
				//			根据是否选择价钱排序查询
				if (!isset($_GET['price']) || $_GET['price'] == "asc") {
					//			根据搜索结果查询
					$sql = "select id,type,img_addre,title,merchant_addre,merchant,merchant_place,price from {$_GET['type']}";
					if (isset($_GET['searchtext'])) {
						$sql = $sql . " where title like '%{$_GET['searchtext']}%' ";
						echo " <div class=\"col-lg-12 text-center\" style='font-size: 25px'>您查询到的商品名为'{$_GET['searchtext']}',共查询到{$RecordCount}条记录 </div>";
					} elseif (isset($_GET['from_price']) && isset($_GET['to_price'])) {
						$sql = $sql . " where price >= {$_GET['from_price']} and price <= {$_GET['to_price']} order by price asc";
						echo " <div class=\"col-lg-12 text-center\" style='font-size: 25px'>您查询的商品价格区间为￥{$_GET['from_price']}-￥{$_GET['to_price']},共查询到{$RecordCount}条记录 </div>";
					}
					$sql = $sql . "  limit $limitindex,$pageSize";
				} elseif ($_GET['price'] == "desc")
					$sql = "select id,type,img_addre,title,merchant_addre,merchant,merchant_place,price from {$_GET['type']} order by price asc limit $limitindex,$pageSize";
				elseif ($_GET['price'] == "random") {
					$sql = "select id,type,img_addre,title,merchant_addre,merchant,merchant_place,price from {$_GET['type']} order by price desc limit $limitindex,$pageSize";
				}
				$result = $conn -> query($sql);
				if ($result -> num_rows > 0) {
					while ($row = $result -> fetch_assoc()) {
						if ($row) {
							?>
							<div class="col-sm-4 col-xs-6 col-md-2">
								<div class="thumbnail" style="height: 380px">
									<a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"><img
												src="<?php echo $row['img_addre']; ?>"></a>
									<div class="caption">
										<span style="font-size: 20px;color: #e4393c;">￥<?php echo $row['price']; ?></span>
										<p>
											<a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"
											   class="item_title"><?php if (strlen($row['title']) > 150) echo substr($row['title'] , 0 , 150) . '....'; else echo $row['title']; ?></a>
										</p>
										<p><a href="<?php echo $row['merchant_addre']; ?>" class="item_merchant"><font
														color="#4d88ff">●</font><?php echo $row['merchant']; ?></a>
											<span class="item_merchant_place"> <?php echo $row['merchant_place']; ?></span>
										</p>
									</div>
								</div>
							</div>
							
							
							<?php
						}
					}
				} else {
					echo "<div class=\"col-lg-12 text-center\" style='font-size: 27px'>暂无结果，请换个关键词查询把！</div>";
				}
			$result->free_result();
			?>
			</div>
		</div>
		<!--		分页-->
		<nav class="text-center">
			<ul class="pagination">
				<?php
				if($RecordCount>0) {
					$url = $_SERVER['PHP_SELF'] . '?type=' . $_GET['type'];//获取当前页的URL
					$PageCount = ceil($RecordCount / $pageSize);//总页数
					
					if (isset($_GET['searchtext'])) {
						page($RecordCount , $pageSize , $page , $url , $_GET['searchtext']);
						echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
						echo " <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this.value,'{$url}','{$page}','{$PageCount}','{$_GET['searchtext']}')\">/$PageCount 页";
					} elseif (isset($_GET['from_price']) && isset($_GET['to_price'])) {
						page($RecordCount , $pageSize , $page , $url , null , null , $_GET['from_price'] , $_GET['to_price']);
						echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
						echo " <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this.value,'{$url}','{$page}','{$PageCount}',null,'{$_GET['from_price']}','{$_GET['to_price']}')\">/$PageCount 页";
					} else {
						page($RecordCount , $pageSize , $page , $url);
						echo " &nbsp;共{$RecordCount}条记录 &nbsp; ";
						echo " <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this.value,'{$url}','{$page}','{$PageCount}')\">/$PageCount 页";
					}
				}
				?>
				<script>
					function goPage(val, url, page, pagecount, searchtext = null, from_price = null, to_price = null) {
						if (parseInt(val) <= 0) {
							document.getElementById('goPage').value = 1;
						}
						if (parseInt(val) > pagecount) {
							document.getElementById('goPage').value = pagecount;
						}
						location.assign(url + '&Page=' + document.getElementById('goPage').value + "&searchtext=" + searchtext + "&from_price=" + from_price + "&to_price=" + to_price);
					}
				</script>
			</ul>
		</nav>
	
	<div class="footer">
		<div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
			Copyright &nbsp;© &nbsp;
			2019-2020 &nbsp; qinyou.com， &nbsp;All &nbsp;Rights &nbsp; Reserved &nbsp;
			使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
			<br>
			九江学院 20180101981号 &nbsp; 赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
			<br>
			自营主体经营证照（暂无） &nbsp; 风险监测信息（暂无） &nbsp; 互联网药品信息服务资格证书：（暂无）-学习性-（暂无）&nbsp; 网络交易第三方平台备案凭证：（暂无）
			<br>
			亲爱的学生老师，九江警方反诈劝阻电话“962110”系专门针对避免您财产被骗受损而设，请您一旦收到来电，立即接听。
			<br>
			公司名称：江西九江沁柚有限公司 | 公司地址：江西省九江市濂溪区九江学院主校区 | 电话：159-7067-4596
			<br>
			注明：本网站为学生于2019年12月制作的PHP大作业，未经本人同意请勿擅自将此网站商用,否则后果自负
		</div>
	</div>
</div>
<script src="../JS/index_jquery.js"></script>
</body>

</html>