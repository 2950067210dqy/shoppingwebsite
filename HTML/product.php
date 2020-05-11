<?php
require '../PHP/conn.php';
$row3=null;
//切换数据库位置
if(isset($_POST['online'])){
	if($_POST['onlinevalue']=='false'){
		$_SESSION['online']='true';
	}
	else{
		$_SESSION['online']='false';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	<link href="../CSS/product.css" rel="stylesheet" type="text/css">
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">

	
</head>
<body >

<!--
			存储数据
-->
<!--用来存储登录的状态-->
<input type="hidden" value="<?php
if (isset($_SESSION['id'])){
	echo 'yes';
}else{
	echo 'no';
}
?>" id="isLogin">
<!--用来存储这个商品的多级评论条数-->
<input type="hidden" value="
<?php
$RecordCounts=null;
if(isset($_GET['id'])){
	$sql="select * from reply where diary_id in (select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}')";
	$result=$conn->query($sql);
	$RecordCounts=$result->num_rows;
	echo $RecordCounts;
}
?>" id="multiNums">
<!--用来存储这个商品的一级评论条数-->
<input type="hidden" value="
<?php
//一级评论数
$RecordCount=null;
if (isset($_GET['id'])){
	$sql="select diary_id from diary where product_id = {$_GET['id']} and product_type='{$_GET['type']}'";
	$result=$conn->query($sql);
	$RecordCount=$result->num_rows;
	echo $RecordCount;
}
?>" id="singleNums">
<!--用来存储评论的从哪显示-->
<!--<input type="hidden" value="5" id="postNum">-->
<!--用来存储当前商品的ID-->
<input type="hidden" value="<?php echo $_GET['id']?>" id="productid">



<!--网页主体-->
<div class="main" >
	<div class="topnav">
		<div class="topnavin">
			<div class="place" onclick="">
				<a href="#">九江市</a>
			</div>
			<div class="nav">
				<ul class="topnavul">
					<li>
						<a href='index.php' target='_self' >返回主页</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						总访问量<span class="visitsum" id="visitsum">
                            <?php
							
                            //数字输出网页计数器
                            $row = selectAllNoWhere("count",1,$conn);
                            $count=(int)$row['num'];
                            $count++;
                            echo $count;
                            if(updateOne("count","num",(string)$count,"num",$row['num'],$conn))
                            ?>


                        </span>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						echo  date('Y-m-d', time());
						?>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">  更多</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../PHP/indexLocation.php">   客户服务</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../BILIBILI/bilibili.php">  会员俱乐部</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/perinfor/index.php">   我的特卖</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../../phpprojectplus/myBBS/index.php">    我的订单</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li >
						<a href="../BILIBILI/bilibili.php">   签到有礼</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<a href="../PHP/indexLocation.php? id=index_signin">   注册</a>
					</li>
					<li style="color: rgb(157,157,157); font-weight: bold">
						/
					</li>
					<li>
						<?php
						
						if((isset($_SESSION['isadmin']))){
							echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>
										<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;'>
										&nbsp;&nbsp;&nbsp;&nbsp;<a  target='_self' onclick=\"location.assign('../PHP/update_userinfo.php?exit=true');\" href='javascript:void(0)'>退出登录</a>
						";
						}
						else{
							echo '<a href="../HTML/logoin.php" >请登录</a>';
						}
						?>
					
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	
	<a href="#" class="btn btn-danger text-center" style="position: sticky;z-index: 99;top: 50%;left: 100%;">返回顶部</a>
	
	<div style="width: 100%;height: 110px;">
		<div class="logo_search">
			<div class="logoleft">
				<a href="#" >
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
				<a href="#" >
					<img height="60"  width="90" src="../IMG/logo4.png" alt="3亿会员">
				</a>
			
			
			</div>
<!--			搜索框/购物车-->
			<div style="margin-top: 25px">
				<div class="search">
					<div class="searchinput_shopcarinput">
						<form action="../PHP/server.php" method="post">
							<input type="text" max="10" placeholder="请输入你要查找的商品" name="searchtext">
							<input type="submit" name="search"  value="">
							<span class="shopcar">
                        <a href="#">
                            <span class="shopcar_img"><img src="../IMG/shopcar.png" width="25" height="25"> </span>
                            <span class="shopcar_word">购物车</span>
                            <span class="shopcar_msg">{{shopnum}}</span>
                        </a>
                    </span>
						
						</form>
					</div>
				</div>
				<!-- recommend 为推荐的意思-->
				<div class="recommend">
					<ul>
						<li>
							<a href="#">
								女靴
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#">
								皮衣/皮草
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#">
								女士羽绒服
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="#"  style="color:  rgb(250,42,131)">
								斯维奇
							</a>
						</li>
						<li>
							|
						</li>
						<li >
							<a href="#" style="color: rgb(250,42,131)">
								年终预付&nbsp;&nbsp;一件免邮
							</a>
						</li>
					
					</ul>
				</div>
			</div>
		</div>
	</div>
	

<!--	商品详情信息-->
	<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	}
	$result=$conn->query("select * from {$_GET['type']} where id = $id");
	$row=$result->fetch_assoc();
	?>
	<div class="product_information">
		<div class="product_img ">
			<img src="<?php echo $row['img_addre'];?> "  width="350" height="450" class="old_img">
			<img src="<?php echo $row['img_addre'];?> "  width="500" height="620" class="new_img" >
		</div>
		<div class="information">
			<div class="product_title">
				<?php echo $row['title'];?>
			</div>
			<div class="product_title">
				<font size="2px" color="#999999"><a href="<?php echo $row['merchant_addre']?>">❥<?php echo $row['merchant'];?></a></font>
			</div>
			<div class="sale_price">
				<div class="price">
					<font size="2px" color="#999999">沁&nbsp;&nbsp;柚&nbsp;&nbsp;价</font>
					<font style="margin-left: 2%;" color="#e4393c" size="6px" id="price">
						￥
						{{price=<?php echo intval($row['price']);?>}}
					</font>
				</div>
				<div class="sale">
					<font size="2px" color="#999999">促&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;销</font>
					<font style="margin-left: 3%;">暂无促销</font>
				</div>
			</div>
			
			
				<div class="num">
					<font size="2px" color="#999999">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量</font>
					<input type="button" value="-" @click="cutCount" :disabled="isabled[0]">
					<input type="tel" v-model="count" @keyup="check" @blur="checkAnother">
					<input type="button" value="+" @click="addCount" :disabled="isabled[1]">
					<br>
					<br>
					<br>
					<font size="2px" color="#999999" >总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</font>
					<font style="margin-left: 2%;" color="#e4393c" size="6px">
						￥{{price*count}}
					</font>
				</div>
				
			<div class="buy_shopcar">
				<button type="button">立即购买</button>
				<button type="button" @click="addShopNum">加入购物车</button>
			</div>
			
			<div class="tip">
				<font size="2px" color="#999999">温馨提示</font>
				<font style="margin-left: 2%;" color="#999999" size="2px">
				·支持7天无理由退货
				</font>
			</div>
			
		</div>
	</div>
	
<!--	推荐区-->
	<div class="shopRecommend text-center" id="container">
		<table >
			<tr>
				<th colspan="5"> <div class="text-center">猜你喜欢<a  href="javascript:void(0)" style="cursor: pointer;background-color: transparent;font-size: 12px;color: white" id="<?php echo $_GET['type']?>" onclick="loadXMLDoc(this.id)">点击刷新...</a></div></th>
			</tr>
			<?php
			//随机生成10个推荐，并显示出来
			$sql="select id from {$_GET['type']}";
			$result =$conn->query($sql);
			$num=$result->num_rows;
			$random=mt_rand(0,$num-15);
			$sql="select * from {$_GET['type']}  limit {$random},15";
			$result =$conn->query($sql);
			$i=1;
			if ($result->num_rows> 0) {
				while ($row = $result->fetch_assoc()) {
					if($i%5==1){
						echo "<tr>";
					}
					?>
					<td>
						<div class="shopItem text-left">
							<a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"><img src="<?php echo $row['img_addre']; ?>"></a>
							<span style="font-size: 20px;color: #e4393c;">￥&nbsp;&nbsp;<?php echo $row['price']; ?></span>
							<p><a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"
							      class="item_title"><?php if(strlen($row['title'])>80) echo substr($row['title'],0,80).'....';else echo $row['title']; ?></a></p>
							<p><a href="<?php echo $row['merchant_addre']; ?>" class="item_merchant"><font
										color="#4d88ff">●</font><?php echo $row['merchant']; ?></a>
								<span class="item_merchant_place"> <?php echo $row['merchant_place']; ?></span>
							</p>
						</div>
					</td>
					<?php
					if($i%10==0){
						echo "</tr>";
					}
					$i++;
				}}
			?>
		</table>
		
	</div>
	
<!--	刷新猜你喜欢-->
	<div class="text-center" id="refresh">
	<a  href="javascript:void(0)" style="cursor: pointer" id="<?php echo $_GET['type']?>" onclick="loadXMLDoc(this.id)">点击刷新...</a>
	</div>
	
	
	
<!--	评论区-->
	<?php
//	评论区楼层
	$postid=1;
	$postinid=1;
	?>
	<div class="shoppost" >
		<div class="shoppost_title">商品评价</div>
<!--		评价容器 异步请求获取-->
		<div id="postcontainer" >
			<?PHP
			$pageSize=8;
			if(isset($_GET['Page'])&&(int)$_GET['Page']>0){
				$page=$_GET['Page'];
			}
			else{
				$page=1;
			}
			//		查找一级评论
			$sql="select * from user,diary where user.id=diary.user_id and product_id=$id and product_type='{$_GET['type']}' order by diary_id";
			$result=$conn->query($sql);
			$result->data_seek(($page-1)*$pageSize);
			for ($j=0;$j<$pageSize;$j++)
			{
				$row=$result->fetch_assoc();
				if ($row){
					?>
					<!--				一级评论-->
					<div class="Media">
						<img class="Media-figure" src="<?php echo $row['img_addr']?>" alt="默认头像"width="100" height="100">
						<!--				一级评论区楼层-->
						<font color="#808080">#<?php echo ($page-1)*$pageSize+$postid."&nbsp;&nbsp;&nbsp;&nbsp;";?></font>
						<?php
						//					检测是否为管理员
						if($row['isadmin']=='true') {
							if(isset($_SESSION['id'])&&$row['user_id']==$_SESSION['id']){
								echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
							}
							else{
								echo "<font color='red' size='4'>[管理员]</font>{$row['name']}({$row['username']}):";
							}
							
						}
//					检测是否为当前用户
						elseif(isset($_SESSION['id'])&&$row['user_id']==$_SESSION['id']){
							echo "<font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
						}
						else{
							echo "{$row['name']}({$row['username']}):";
						}
						?>
						<p class="Media-body">
							<?php echo $row['content']?>
							<!--								一级评论(删除评论按钮)(修改评论按钮)当为管理员或当前用户才会显示-->
							<?php
							if (isset($_SESSION['id'])&&($_SESSION['isadmin']=='true'||$row['user_id']==$_SESSION['id'])){
								echo "
<input  type='submit' value='X' onclick='location.assign(\"../PHP/deletePost.php?diary_id={$row['diary_id']}&reply=pinglun\");'>
<input  type='submit' value='修改' onclick='location.assign(\"../HTML/updatepost.php?diary_id={$row['diary_id']}&reply=pinglun&product_id=$id&floor_id=$postid&type={$_GET['type']}\")'>
";
							}
							?>
							<br>
							<br>
							<br>
							<span style="float: left">		<?php echo $row['time']?></span>
							<span style="float: right"> <input type="button" value="评论" class="setMessage" id="setMessage<?php echo $row['diary_id']?>" > </span>
						</p>
					</div>
					
					
					<?php
//		         查找多级评论		通过一级评论来查找是否有一级评论的回复评论
					$sql2=" select * from user u  join reply r on r.diary_id={$row['diary_id']} and r.user_id=u.id order by reply_id";
					$result2=$conn->query($sql2);
					$row2=null;
					if($result2->num_rows>0) {
						echo "<p class=\"tipOfReply\"><a  @click=\"hideMessage\" href='javascript:void(0)'>--------该楼还有{$result2->num_rows}条评论，请点击查看详情--------</a></p>";
						while ($row2=$result2->fetch_assoc())
						{
							
							?>
							<!--				多级评论-->
							<div class="reply Media" >
								<img class="reply_img Media-figure" src=" <?php echo $row2['img_addr']?>" alt="默认头像" width="50" height="50">
								<!--	            多级评论区楼层-->
								<font color="#808080"><?php echo "#$postinid&nbsp;&nbsp;&nbsp;&nbsp;";?></font>
								<font color="#999999">
									<?php
									//					检测是否为管理员
									if($row2['isadmin']=='true') {
										if($row2['user_id']==$_SESSION['id']){
											echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row2['name']}({$row2['username']}):";
										}else{
											echo "<font color='red' size='4'>[管理员]</font>{$row2['name']}({$row2['username']}):";
										}
										
									}
//					检测是否为当前用户
									elseif($row2['user_id']==$_SESSION['id']){
										echo "<font color='#8a2be2' size='4'>[自己]</font>{$row2['name']}({$row2['username']}):";
									}
									else{
										echo "{$row2['name']}({$row2['username']}):";
									}
									?>
									
									<?php
									if ($row2['last_id']!=0){
										$sql3="select * from user where id = (select user_id from reply where reply_id={$row2['last_id']}) ";
										$result3=$conn->query($sql3);
										
										if($result3->num_rows>0){
											$row3=$result3->fetch_assoc();
											//检测是否为当前用户
											if($row3['isadmin']=='true') {
												if(isset($_SESSION['id'])&&$row3['id']==$_SESSION['id']){
													echo "回复@<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row3['name']}({$row3['username']}):";
												}else{
													echo "回复@<font color='red' size='4'>[管理员]</font>{$row3['name']}({$row3['username']}):";
												}
											}
//					检测是否为当前用户
											elseif(isset($_SESSION['id'])&&$row3['id']==$_SESSION['id']){
												echo "回复@<font color='#8a2be2' size='4'>[自己]</font>{$row3['name']}({$row3['username']}):";
											}
											else{
												echo "回复@{$row3['name']}({$row3['username']}):";
											}
											echo "";
										}
										else{
											echo '出错了！';
										}
										
										
										
									}
									
									?>
								</font>
								<p class="reply_content Media-body">
									<br>
									<!--					多级评论(删除评论按钮)（修改按钮）当为管理员或当前用户才会显示-->
									<?php
									if (isset($_SESSION['id'])&&($_SESSION['isadmin']=='true'||$row2['user_id']==$_SESSION['id'])){
										echo "
								<input  type='submit' value='X' onclick='location.assign(\"../PHP/deletePost.php?reply_id={$row2['reply_id']}&reply=huifu\")'>
								<input  type='submit' value='修改' onclick='location.assign(\"../HTML/updatepost.php?reply_id={$row2['reply_id']}&reply=huifu&product_id=$id&floor_id=$postinid&type={$_GET['type']}\")'>
								";
									}
									?>
									<?php
									for($i=0;$i<2;$i++){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
									echo $row2['reply_content']
									
									?>
									
									<br>
									<br>
									<br>
									<span style="float: left">		 <?php echo  $row2['time'] ?></span>
									<span style="float: right"> <input type="button" value="回复" class="setMessageIn" id="setMessageIn<?php echo $row2['reply_id']?>"> </span>
								</p>
							</div>
							<!--	回复框（多级）-->
							<div class="recommendTA huifus" id="multi<?php echo $row2['diary_id']?>">
								<form action="../PHP/insertPost.php?user_id=<?php if (isset($_SESSION['id'])) echo $_SESSION['id']?>&diary_id= <?php echo $row2['diary_id']?>&last_id= <?php echo $row2['reply_id']?>&reply_id= <?php echo $row2['reply_id']?>&reply=huifu&username=<?php if (isset($_SESSION['username']))echo $_SESSION['username']?>&product_id=<?php echo $id?>&type=<?php echo $_GET['type']?>" method="post">
					<textarea placeholder= "回复层主   <?php echo $row2['name']?>(<?php echo $row2['username']?>):	   对      <?php  if($row3['name']!='') echo "层主    @".$row3['name']; else echo "楼主     @".$row['name'];?>(<?php  if($row3['username']!='') echo $row3['username']; else echo $row['username'];?>)：的回复
'<?php echo $row2['reply_content']?>'" name="textarea"></textarea>
									<input type="submit" name="submit" value="发表评论" class="submit">
									<input type="reset" name="reset" value="重置评论" class="reset">
								</form>
							</div>
							<div style="margin-top: 4%">
							
							</div>
							<?php
							//		    多级评论区楼层自增
							$postinid++;
						}
						echo "			<a @click=\"hideMessage()\" class='tipOfReply Media text-right' style='display: none;width: 20%;border: none;color: #0000ee;' href='javascript:void(0)'>----点击折叠评论----</a>";
					}
					?>
					
					
					
					
					
					
					<!--	回复框(一级)-->
					<div class="recommendTA huifu" id="single<?php echo $row['diary_id']?>">
						<form  action="../PHP/insertPost.php?user_id=<?php if(isset($_SESSION['id'])) echo $_SESSION['id']?>&diary_id=<?php echo $row['diary_id']?>&last_id=0&reply_id=null&reply=huifu&username=<?php if(isset($_SESSION['username'])) echo $_SESSION['username']?>&product_id=<?php echo $id?>&type=<?php echo $_GET['type']?>" method="post">
					<textarea placeholder="回复楼主   <?php echo $row['name']?>(<?php echo $row['username']?>):
			'<?php echo $row['content']?>'" name="textarea"></textarea>
							<input type="submit" name="submit" value="发表评论" class="submit">
							<input type="reset" name="reset" value="重置评论" class="reset">
						</form>
					</div>
					<div style="margin-top: 4%">
					</div>
					
					
					
					<?php
//				一级评论区楼层自增
					$postid++;
//				多级评论区楼层置1
					$postinid=1;
				}}
			$result->free_result();
			?>
			
		</div>
		
<!--		分页-->
		<nav class="text-center">
			<ul class="pagination">
				<?php
				if($RecordCount>0){
					$url=$_SERVER['PHP_SELF'].'?id='.$_GET['id'].'&type='.$_GET['type'];//获取当前页的URL
					page($RecordCount,$pageSize,$page,$url);
					$PageCount=ceil($RecordCount/$pageSize);
					$PageCountadd=$RecordCounts+$RecordCount;
					echo " &nbsp;共{$PageCountadd}条记录 &nbsp;  <input type='number' id='goPage' value='$page' style='width: 50px' onblur=\"goPage(this . value , '{$url}' , '{$page}' , '{$PageCount}')\">/$PageCount 页";
				}
				?>
				<script>
					//	跳转页数
					function goPage(val,url,page,pagecount) {
						if(parseInt(val)<=0){
							document.getElementById('goPage').value=1;
						}
						if(parseInt(val)>pagecount){
							document.getElementById('goPage').value=pagecount;
						}
						if(document.getElementById('goPage').value!=parseInt(page))
							location.assign(url+'&Page='+document.getElementById('goPage').value+'#refresh');
					}
				</script>
			</ul>
		</nav>
		
		
<!--		返回评论顶部-->
		<?php
		if($RecordCount>0){
			echo "	<div class=\"container text-center\" >
<!--			<a href=\"javascript:void(0);\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\" onclick=\"changePostNum();loadXMLDoc_post(parseInt(document.getElementById('productid').value),2,parseInt(document.getElementById('postNum').value));putscript()\" id=\"reonload\">加载更多...</a>-->
<!--			<a href=\"javascript:void(0);\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\"></a>-->
<!--			返回评论顶部-->
			<a href=\"#refresh\"  style=\"color: #999999;font-size: 12px;cursor: pointer;\">返回评论顶部</a>
		</div>";
		}
		else{
			echo "	<div class=\"container text-center\" ><a href=\"javascript:void(0)\"  style=\"color: #999999;font-size: 20px;cursor: pointer;\">暂无评论,等着您来评价哦！！！！</a></div>";
		}
		?>
<!--	主评论框-->
<!--		必须登录才会显示主评论框，否则提示登录-->
		<?php
		if(isset($_SESSION['id'])) {
			?>
			<div class="recommendTA pinglun">
				<p>你想说点什么呢?</p>
				<form
					action="../PHP/insertPost.php?user_id=<?php if(isset($_SESSION['id'])) echo $_SESSION['id'] ?>&reply=pinglun&username=<?php if(isset($_SESSION['username'])) echo $_SESSION['username'] ?>&product_id=<?php echo $id ?>&type=<?php echo $_GET['type']?>"
					method="post">
					<textarea placeholder="请发表您的评论哦！" name="textarea" id="mainpinglun"></textarea>
					<input type="submit" name="submit" value="发表评论" class="submit">
					<input type="reset" name="reset" value="重置评论" class="reset">
				</form>
			</div>
			<div style="margin-top: 4%"></div>
			<?php
		}
		else{
			?>
			<div style="width: 67%;margin: auto auto;border-top: 2px solid black;text-align: center;">还没有登录不能评论哦，快去<a href="logoin.php" target="_self" style="color: #0000ee;font-size: 22px;" class="table-hover">登录</a>吧--.</div>
			<?php
		}
		?>
	</div>
	

	<div class="footer">
		<div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
			Copyright &nbsp;©  &nbsp;
			2019-2020  &nbsp; qinyou.com， &nbsp;All  &nbsp;Rights &nbsp; Reserved &nbsp;
			使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
			<br>
			九江学院 20180101981号 &nbsp;   赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
			<br>
			自营主体经营证照（暂无）  &nbsp; 风险监测信息（暂无）  &nbsp; 互联网药品信息服务资格证书：（暂无）-学习性-（暂无）&nbsp; 网络交易第三方平台备案凭证：（暂无）
			<br>
			亲爱的学生老师，九江警方反诈劝阻电话“962110”系专门针对避免您财产被骗受损而设，请您一旦收到来电，立即接听。
			<br>
			公司名称：江西九江沁柚有限公司 | 公司地址：江西省九江市濂溪区九江学院主校区 | 电话：159-7067-4596
			<br>
			注明：本网站为学生于2019年12月制作的PHP大作业，未经本人同意请勿擅自将此网站商用,否则后果自负
		</div>
	</div>
</div>

</body>
</html>
<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js" id="js1"></script>
<script type="text/javascript" src="../JSLIB/vue.js" id="js2"></script>
<script type="text/javascript" src="../JSLIB/vue-router.js" id="js3"></script>
<script src="../JSLIB/bootstrap.js" id="js4"></script>
<script src="../JS/index.js" id="js5"></script>
<script src="../JS/product_vue.js" id="js6"></script>
<script src="../JS/product_jquery.js" id="js7"></script>
<script>

	//	因为我们的评论是用limit，点击展开limit就要+5，所有点击按钮之后就要把我们存在input的数据+5
	function changePostNum() {
		document.getElementById('postNum').value=parseInt(document.getElementById('postNum').value)+5;
		//当值大于一级评论的个数时，就不能加载了。把加载按钮display：none
		if(parseInt(document.getElementById('postNum').value)>=parseInt(document.getElementById('singleNums').value)){
			document.getElementById('reonload').nextElementSibling.innerHTML="已经到底了！";
			document.getElementById('reonload').style.display='none';
		}
	}
	//window.onload=loadXMLDoc_post(<?php //echo $_GET['id']?>//,1,0);
	function loadXMLDoc(id) {
		var xmlhttp;
		if (window.XMLHttpRequest) {
			//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
			xmlhttp = new XMLHttpRequest();
		} else {
			// IE6, IE5 浏览器执行代码
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("container").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "../PRODUCTHTML/product_like.php?type="+id, true);
		xmlhttp.send();
	}
	// 	function loadXMLDoc_post(id,flag,limit) {
	// 		var xmlhttp;
	// 		if (window.XMLHttpRequest) {
	// 			//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
	// 			xmlhttp = new XMLHttpRequest();
	// 		} else {
	// 			// IE6, IE5 浏览器执行代码
	// 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	// 		}
	// 		xmlhttp.onreadystatechange = function () {
	// 			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	// 				if(flag==1){
	// 					document.getElementById("postcontainer").innerHTML = xmlhttp.responseText;
	// 				}
	// 				if(flag==2){
	// 					document.getElementById("postcontainer").innerHTML += xmlhttp.responseText;
	// 				}
	//
	// 			}
	// 		}
	// 		xmlhttp.open("GET", "../PRODUCTHTML/product_post.php?id="+id+"&limit="+limit, true);
	// 		xmlhttp.send();
	// 	}
	// 	//因为异步评论信息导致其中的jquery和vue无法加载所以点击异步的时候我们要重新加载js
	// 	function putscript() {
	// 		//需要重新加载的js文件列表
	// 		var scriptList=[
	// 			{src:"../JSLIB/jquery-3.5.0.js",id:"js1"},
	// 			{src:"../JSLIB/vue.js",id:"js2"},
	// 			{src:"../JSLIB/vue-router.js",id:"js3"},
	// 			{src:"../JSLIB/bootstrap.js",id:"js4"},
	// 			{src:"../JS/index.js",id:"js5"},
	// 			{src:"../JS/product_vue.js",id:"js6"},
	// 			{src:"../JS/product_jquery.js",id:"js7"}
	// 		]
	// 		scriptList.forEach(x=>{
	// 			loadJs(x.src,x.id);
	//
	// 		});
	//
	// 	}
	// //重新加载js
	// function loadJs(file,id)
	// {
	//
	// 	$("#"+id).remove();
	// 	$("<scri"+"pt >"+"</scr"+"ipt>").attr({id:id,src:file,type:'text/javascript'}).appendTo($('body'));
	// }

</script>