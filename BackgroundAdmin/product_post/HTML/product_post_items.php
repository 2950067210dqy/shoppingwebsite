<?php
session_start();
require '../../conn.php';
$id = $_GET['id'];
$shop_id = $_GET['shop_id'];

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
			border-bottom: 2px silver solid;
			}
		
		/**
评论区
**/
		.shoppost {
			width: 100%;
			}
		
		.shoppost img {
			border-radius: 50%;
			}
		
		.huifu, .huifus {
			/*display: none;*/
			}
		
		.recommendTA {
			width: 50%;margin: 0 auto;
			}
		
		.recommendTA textarea {
			margin-top: 5%;
			width: 100%;
			height: 150px;
			border: 1px solid #00a1d6;
			background-color: #F4F5F7;
			}
		
		.recommendTA textarea::-webkit-input-placeholder {
			color: #333333;
			font-size: 17px;
			}
		
		.recommendTA textarea::-moz-placeholder {
			color: #333333;
			font-size: 17px;
			}
		
		.recommendTA textarea::-ms-input-placeholder {
			color: #333333;
			font-size: 17px;
			}
		
		.recommendTA input[type=submit], input[type=reset] {
			background-color: #00a1d6;
			width: 100%;
			height: 50px;
			color: white;
			font-size: 10px;
			}
		
		.recommendTA textarea:hover {
			background-color: white;
			border: 1px solid #e4393c;
			}
		
		.recommendTA input[type=submit]:hover, input[type=reset]:hover {
			background-color: #00a1a6;
			}
	
	
	</style>
</head>
<body>
<!--用来存储这个商品的多级评论条数-->
<input type="hidden" value="
<?php
$sql = "";
$RecordCounts = null;
if (isset($_GET['id'])) {
	$sql = "select * from reply where diary_id in (select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}')";
	$result = $conn -> query($sql);
	$RecordCounts = $result -> num_rows;
	echo $RecordCounts;
}
?>" id="multiNums">
<!--用来存储这个商品的一级评论条数-->
<input type="hidden" value="
<?php
//一级评论数
$RecordCount = null;
if (isset($_GET['id'])) {
	$sql = "select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}'";
	$result = $conn -> query($sql);
	$RecordCount = $result -> num_rows;
	echo $RecordCount;
}
?>" id="singleNums">
<div class="information">
	<div class="modal-title"
	     style="font-size: 25px;width: 100%;border-bottom: 2px silver solid;height: 50px;color: #5e5e5e">
		<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>商品评论<span
			class="badge"><?php echo $RecordCount + $RecordCounts ?></span>
	</div>
	
	<div class="admininformation" style="background-color: rgb(245,245,245)">
		<form class="navbar-form navbar-left">
			<a href="#foot" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 添加评论</psan></a>
		</form>
		<form class="navbar-form navbar-right" style="margin-right: 2%;" action="search_post.php" method="get">
			<div class="text-center" STYLE="position: relative">
				<input type="hidden" value="<?php echo $id ?>" name="id">
				<input type="hidden" value="<?php echo $shop_id ?>" name="shop_id">
				<input type="hidden" value="<?php echo $_GET['type'] ?>" name="type">
				<input type="text" name="searchtext" class="form-control" placeholder="您输入要查找字段的名字">
				<select class="form-control" name="sel">
					<option value="username">账号</option>
					<option value="name">用户名</option>
					<option value="content">评论内容</option>
					<option value="time">评论时间</option>
				</select>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> 查询
				</button>
				<?php
				echo "<a href='product_post_item.php?id={$shop_id}&user_id={$_GET['user_id']}' class='btn btn-default'>返回</a>";
				?>
			</div>
		</form>
		
		<!--		展示该评论区的商品-->
		<?php
		//			(不是显示全部评论才显示当前评论区商品商品)
		if ($_GET['id'] != "all") {
			
			?>
			<table class="table table-hover table-striped  text-center">
				<tr>
					<td>
						序号
					</td>
					<td>
						商品图片
					</td>
					<td>
						商品价格
					</td>
					<td>
						商品介绍
					</td>
					<tD>
						商品类型
					</tD>
					<td>
						店铺名
					</td>
					<td>
						店铺图标
					</td>
					<td>
						创建时间
					</td>
				</tr>
				<?php
				$sql = "select id,title,price,img_addre,time,type,shop_id,shop_name,shop_img_addr from products,shop where id = {$id} and shop.shop_id=products.merchant_id";
				$sql = $sql . " order by time desc ";
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
									<a target="_blank"
									   href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><img
												src="<?php if (substr($row['img_addre'] , 0 , 1) == ".") echo "../../" . $row['img_addre']; else echo $row['img_addre'] ?>"
												width="86" height="86" style="border-radius: 10%"></a>
								</td>
								<td>
									<span style="color: orangered">￥<?php echo $row['price'] ?></span>
								</td>
								<td>
									<a target="_blank"
									   href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php echo $row['title'] ?></a>
								</td>
								<td>
									<a target="_blank"
									   href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php getNameByType($row['type']); ?></a>
								</td>
								<td>
									<a target="_blank"
									   href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><?php echo $row['shop_name'] ?></a>
								</td>
								<td>
									<a target="_blank"
									   href="../../../HTML/product.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><img
												src="../../<?php echo $row['shop_img_addr'] ?>" width="86" height="86"
												style="border-radius: 10%"></a></a>
								</td>
								<td>
									<?php echo $row['time'] ?>
								</td>
							</tr>
							<?php
						}
					}
				}
				$result -> free_result();
				?>
				<tr>
					<td colspan="8" class="text-center">
						该商品的评论区
					</td>
				</tr>
			</table>
		<?php } ?>
		<!--	评论区-->
		<!--		--><?php
		//		//	评论区楼层
		//		$postid=1;
		//		$postinid=1;
		//		?>
		<div class="shoppost">
			<!--		评价容器 异步请求获取-->
			<div id="postcontainer" class="container" style="width: 80%">
				<?PHP
				//			页码
				$pageSize = 5;
				if (isset($_GET['Page']) && (int)$_GET['Page'] > 0) {
					$page = $_GET['Page'];
				} else {
					$page = 1;
				}
				//		查找一级评论
				$sql = "select * from user,diary where user.id=diary.user_id and product_id=$id and product_type='{$_GET['type']}' order by diary_id";
				$result = $conn -> query($sql);
				$result -> data_seek(($page - 1) * $pageSize);
				for ($j = 0; $j < $pageSize; $j ++) {
					$row = $result -> fetch_assoc();
					if ($row) {
						?>
						<div class="row text-left" style="border-bottom: 1px solid silver">
							<!--						一级评论楼层号-->
							<div class="col-lg-1 col-lg-offset-1">
								<font
									color="#808080">#<?php echo $row['diary_id'] . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
							</div>
							<!--						一级评论头像图-->
							<div class="col-lg-2">
								<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id']) echo 'user.php'; else echo "user_other.php?id={$row['id']}" ?>">
									<img src="../../<?php echo $row['img_addr'] ?>" alt="默认头像" width="100" height="100">
								</a>
							</div>
							<div class="col-lg-8">
								<div class="row">
									<!--								一级评论用户名-->
									<div class="col-lg-6">
										<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['id']) echo '../../../HTML/user.php'; else echo "../../../HTML/user_other.php?id={$row['id']}" ?>"
										   target="_blank">
											<?php
											//					检测是否为管理员
											if ($row['isadmin'] == 'true') {
												if (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
													echo "<span class='btn btn-success' >管理员</span><span class='btn btn-warning' href='javascript:void(0)'>自己</span>{$row['name']}({$row['username']}):";
												} else {
													echo "<span class='btn btn-success' >管理员</span>{$row['name']}({$row['username']}):";
												}
												
											} //					检测是否为当前用户
											elseif (isset($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
												echo "<span class='btn btn-warning' >自己</span>{$row['name']}({$row['username']}):";
											} else {
												echo "{$row['name']}({$row['username']}):";
											}
											?>
										</a>
									</div>
									<!--								一级评论删除评论和修改评论按钮-->
									<div class="col-lg-offset-2 col-lg-4 text-right">
										<!--								一级评论(删除评论按钮)(修改评论按钮)当为管理员或当前用户才会显示-->
										<?php
										echo "
								<a href='../HTML/updatepost.php?diary_id={$row['diary_id']}&reply=pinglun&product_id=$id&floor_id={$row['diary_id']}&type={$_GET['type']}&shop_id=$shop_id' class='btn btn-primary'><span class='glyphicon glyphicon-refresh'></span>修改</a>
								<a href='../PHP/deletePost.php?diary_id={$row['diary_id']}&reply=pinglun' class='btn btn-danger'>X删除</a>
";
										?>
									</div>
								</div>
								<!--						一级评论用户评论内容-->
								<div class="row text-center" style="margin-top: 5%">
									<div class="col-lg-12">
										<?php echo $row['content'] ?>
									</div>
								</div>
								<!--						一级评论用户评论时间和回复按钮-->
								<div class="row" style="margin-top: 5%">
									<div class="col-lg-4 col-lg-offset-2">
										<?php echo $row['time'] ?>
									</div>
									<div class="col-lg-offset-4 col-lg-2 text-right">
										<a href="javascript:void(0)"
										   id="setMessage<?php echo $row['diary_id'] ?>"
										   class="btn btn-default setMessage">评论</a>
									</div>
								</div>
								<!--						展示这条一级评论有多少条多级评论	-->
								<?php
								//		         查找多级评论		通过一级评论来查找是否有一级评论的回复评论
								$sql2 = " select * from user u  join reply r on r.diary_id={$row['diary_id']} and r.user_id=u.id order by reply_id";
								$result2 = $conn -> query($sql2);
								$row2 = null;
								if ($result2 -> num_rows > 0) {
									echo "	<div class=\"row text-center\" style='margin-top: 3%;margin-bottom: 3%'>
								<div class=\"col-lg-12\">
									<a   class='tipOfReplyShow' href='javascript:void(0)' >--------该楼还有{$result2->num_rows}条评论，请点击查看详情--------</a>
								</div>
							</div>
							<div class=\"replypost container\" style=\"display: none;width: 100%\" >
							";
								} ?>
								<!--					多级评论-->
								
								<?php
								if ($result2 -> num_rows > 0) {
									while ($row2 = $result2 -> fetch_assoc()) {
										?>
										<div class="row text-left" style="border-top: 1px solid silver;">
											<!--						多级评论楼层-->
											<div class="col-lg-1 col-lg-offset-1">
												<font
													color="#808080">#<?php echo $row2['reply_id'] . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></font>
											</div>
											<!--						多级评论头像图-->
											<div class="col-lg-2">
												<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row2['id']) echo 'user.php'; else echo "user_other.php?id={$row2['id']}" ?>">
													<img src="../../<?php echo $row2['img_addr'] ?>" alt="默认头像"
													     width="50"
													     height="50">
												</a>
											</div>
											<div class="col-lg-8">
												<div class="row">
													<!--	多级评论用户名-->
													<div class="col-lg-8 text-left">
														<a target="_blank"
														   href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row2['id']) echo '../../../HTML/user.php'; else echo "../../../HTML/user_other.php?id={$row2['id']}" ?>">
															<?php
															//					检测是否为管理员
															if ($row2['isadmin'] == 'true') {
																if ($row2['user_id'] == $_SESSION['id']) {
																	echo "<span class='btn btn-success' >管理员</span><span class='btn btn-warning' >自己</span>{$row2['name']}({$row2['username']}):";
																} else {
																	echo "<span class='btn btn-success' >管理员</span>{$row2['name']}({$row2['username']}):";
																}
																
															} //					检测是否为当前用户
															elseif ($row2['user_id'] == $_SESSION['id']) {
																echo "<span class='btn btn-warning' >自己</span>{$row2['name']}({$row2['username']}):";
															} else {
																echo "{$row2['name']}({$row2['username']}):";
															}
															?>
														</a>
														<?php
														if ($row2['last_id'] != 0) {
															$sql3 = "select * from user where id = (select user_id from reply where reply_id={$row2['last_id']}) ";
															$result3 = $conn -> query($sql3);
															
															if ($result3 -> num_rows > 0) {
																$row3 = $result3 -> fetch_assoc();
																?>
																<a href="<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row3['id']) echo 'user.php'; else echo "user_other.php?id={$row3['id']}" ?>">
																	<?php
																	//检测是否为管理员
																	if ($row3['isadmin'] == 'true') {
																		if (isset($_SESSION['id']) && $row3['id'] == $_SESSION['id']) {
																			echo "回复<a class='btn btn-success' href='javascript:void(0)'>管理员</a><a class='btn btn-warning' href='javascript:void(0)'>自己</a>@{$row3['name']}({$row3['username']}):";
																		} else {
																			echo "回复<a class='btn btn-success' href='javascript:void(0)'>管理员</a>@{$row3['name']}({$row3['username']}):";
																		}
																	} //					检测是否为当前用户
																	elseif (isset($_SESSION['id']) && $row3['id'] == $_SESSION['id']) {
																		echo "回复<a class='btn btn-warning' href='javascript:void(0)'>自己</a>@{$row3['name']}({$row3['username']}):";
																	} else {
																		echo "回复@{$row3['name']}({$row3['username']}):";
																	}
																	echo "";
																	?>
																</a>
																<?php
															} else {
																echo '出错了！';
															}
														}
														?>
													</div>
													<!--								多级评论删除评论和修改评论按钮-->
													<div class="col-lg-4 text-right">
														<!--					多级评论(删除评论按钮)（修改按钮）当为管理员或当前用户才会显示-->
														<?php
														echo "
													<a href='../HTML/updatepost.php?reply_id={$row2['reply_id']}&reply=huifu&product_id=$id&floor_id={$row2['reply_id']}&type={$_GET['type']}&shop_id=$shop_id' class='btn btn-primary'><span class='glyphicon glyphicon-refresh'></span>修改</a>
													<a href='../PHP/deletePost.php?reply_id={$row2['reply_id']}&reply=huifu' class='btn btn-danger ' style='display: inline'>X删除</a>";
														?>
													</div>
												</div>
												<!--多级评论用户评论内容-->
												<div class="row text-center" style="margin-top: 9%">
													<div class="col-lg-12">
														<?php echo $row2['reply_content'] ?>
													</div>
												</div>
												<!--多级评论用户评论时间和回复按钮-->
												<div class="row" style="margin-top: 5%">
													<div class="col-lg-5 col-lg-offset-1" style="margin-top: 5%">
														<?php echo $row2['time'] ?>
													</div>
													<div class="col-lg-offset-4 col-lg-2 text-right">
														<a href="javascript:void(0)"
														   class="btn btn-default setMessageIn"
														   id="setMessageIn<?php echo $row2['reply_id'] ?>">回复</a>
													</div>
												</div>
												<div class="huifus recommendTA row" style="display: none;">
													<!--回复框（多级）-->
													<form method="post"
													      action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id= <?php echo $row2['diary_id'] ?>&last_id= <?php echo $row2['reply_id'] ?>&reply_id= <?php echo $row2['reply_id'] ?>&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>">
														<div class="col-lg-12">
													<textarea
														placeholder="回复层主   <?php echo $row2['name'] ?>(<?php echo $row2['username'] ?>):	   对      <?php if (isset($row3['name']) && $row3['name'] != '') echo "层主    @" . $row3['name']; else echo "楼主     @" . $row['name']; ?>(<?php if (isset($row3['username']) && $row3['username'] != '') echo $row3['username']; else echo $row['username']; ?>)：的回复
														'<?php echo $row2['reply_content'] ?>'"
														name="textarea"></textarea>
														</div>
														<div class="col-lg-6">
															<input class="btn-block" type="submit" name="submit"
															       value="发表评论" class="submit">
														</div>
														<div class="col-lg-6">
															<input class="btn-block" type="reset" name="reset"
															       value="重置评论"
															       class="reset">
														</div>
													</form>
												</div>
											
											</div>
										</div>
										<?php
//										//		    多级评论区楼层自增
//										$postinid ++;
									}
									echo "
	<!--							折叠多级评论-->
								<div class=\"row text-center\">
									<div class=\"col-lg-12\">
										<a  class='tipOfReplyHiden tipOfReply Media text-right ' style='width: 20%;border: none;color: #0000ee;' href='javascript:void(0)'>----点击折叠评论----</a>
									</div>
								</div>
							</div>
						";
								} ?>
							
							</div>
							<div class="huifu recommendTA" style="display: none">
								<!--	                回复框（一级）-->
								<form
									action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&diary_id=<?php echo $row['diary_id'] ?>&last_id=0&reply_id=null&reply=huifu&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>"
									method="post">
									<div class="col-lg-12 text-center">
							<textarea placeholder="回复楼主   <?php echo $row['name'] ?>(<?php echo $row['username'] ?>):
								'<?php echo $row['content'] ?>'" name="textarea"></textarea>
									</div>
									<div class="col-lg-6">
										<input class="btn-block" type="submit" name="submit" value="发表评论"
										       class="submit">
									</div>
									<div class="col-lg-6">
										<input class="btn-block" type="reset" name="reset" value="重置评论" class="reset">
									</div>
								</form>
							</div>
						</div>
						
						
						<?php
					}
				}
				$result -> free_result();
				?>
			
			</div>
			<!--		分页-->
			<nav class="text-center">
				<ul class="pagination">
					<?php
					if ($RecordCount > 0) {
						$url = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&shop_id=" . $shop_id . "&type=" . $_GET['type'];//获取当前页的URL
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
			<!--	主评论框-->
			<!--		必须登录才会显示主评论框，否则提示登录-->
			<?php
			if (isset($_SESSION['id'])) {
				?>
				<div class="recommendTA pinglun" id="foot">
					<p>你想说点什么呢?</p>
					<form
						action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id'] ?>&reply=pinglun&username=<?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>"
						method="post">
					<textarea placeholder="请发表您的评论哦！" name="textarea" id="mainpinglun" class="form-control"
					          rows="8"></textarea>
						<input type="submit" name="submit" value="发表评论" class="submit">
						<input type="reset" name="reset" value="重置评论" class="reset">
					</form>
				</div>
				<div style="margin-top: 4%"></div>
				<?php
			} else {
				?>
				<div style="width: 67%;margin: auto auto;border-top: 2px solid black;text-align: center;">
					还没有登录不能评论哦，快去<a href="logoin.php" target="_self" style="color: #0000ee;font-size: 22px;"
					                class="table-hover">登录</a>吧--.
				</div>
				<?php
			}
			?>
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
			
			
			//点击评论跳出评论框
			var setMessage = $('.setMessage');
			setMessage.each(function (i) {
				let t = this;
				$(this).on('click', function () {
					if ($('.setMessage').eq(i).html() === "评论") {
						$('.setMessage').eq(i).html('隐藏评论框');
					} else {
						$('.setMessage').eq(i).html('评论');
					}
					$('.huifu').eq(i).slideToggle('fast');
				});
			});
			//点击回复跳出回复框
			var setMessageIn = $('.setMessageIn');
			setMessageIn.each(function (i) {
				let t = this;
				$(this).on('click', function () {
					if ($('.setMessageIn').eq(i).html() === "回复") {
						$('.setMessageIn').eq(i).html('隐藏回复框');
					} else {
						$('.setMessageIn').eq(i).html('回复');
					}
					$('.huifus').eq(i).slideToggle('fast');
				});
			});
			
			//点击展开多级评论
			var tipOfReplyShow = $('.tipOfReplyShow');
			tipOfReplyShow.each(function (i) {
				let t = this;
				$(this).on('click', function () {
					$('.replypost').eq(i).slideDown('fast');
					$('.tipOfReplyShow').eq(i).hide('fast');
				});
			});
			//折叠展开多级评论
			var tipOfReplyHiden = $('.tipOfReplyHiden');
			tipOfReplyHiden.each(function (i) {
				let t = this;
				$(this).on('click', function () {
					$('.replypost').eq(i).slideUp('fast');
					$('.tipOfReplyShow').eq(i).show('fast');
				});
			});
		})
	</script>
</body>
</html>

