<?php
require ("../PHP/conn.php");
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

<script src="../JS/index.js"></script>
<script src="../JS/index_jquery.js"></script>
<!--用来存储登录的状态-->
<input type="hidden" value="<?php
if (isset($_SESSION['id'])) {
	echo 'yes';
} else {
	echo 'no';
}
?>" id="isLogin">

<!--侧边栏-->
<div style="position: fixed;z-index: 99;top: 30%;right: 3%;height: auto;border: 1px silver solid;width: 6%;height: auto">
	<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse" aria-expanded="false"
	   aria-controls="collapse" style="width: 100%">
		&nbsp;&nbsp;&nbsp;&nbsp;男装&nbsp;&nbsp;&nbsp;&nbsp;
	</a>
	<div class="collapse" id="collapse">
		<div class="well">
			<ul>
				<li><a href="#container" id="boy_shirt" onclick="loadXMLDoc(this.id,1)">衬衫</a></li>
				<li><a href="#container" id="boy_yurongfu" onclick="loadXMLDoc(this.id,1)">羽绒服</a></li>
				<li><a href="#container" id="boy_jiake" onclick="loadXMLDoc(this.id,1)">夹克</a></li>
				<li><a href="#container" id="boy_xifu" onclick="loadXMLDoc(this.id,1)">西服套装</a></li>
				<li><a href="#container" id="boy_txue" onclick="loadXMLDoc(this.id,1)">T恤</a></li>
				<li><a href="#container" id="boy_xiuxianku" onclick="loadXMLDoc(this.id,1)">休闲裤</a></li>
			</ul>
		</div>
	</div>
	<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" style="width: 100%">
		&nbsp;&nbsp;&nbsp;&nbsp;女装&nbsp;&nbsp;&nbsp;&nbsp;
	</a>
	<div class="collapse" id="collapse2">
		<div class="well">
			<ul>
				<li><a href="#container" id="girl_lianyiqun" onclick="loadXMLDoc(this.id,1)">连衣裙</a></li>
				<li><a href="#container" id="girl_banshenqun" onclick="loadXMLDoc(this.id,1)">半身裙</a></li>
				<li><a href="#container" id="girl_duanwaitao" onclick="loadXMLDoc(this.id,1)">短外套</a></li>
				<li><a href="#container" id="girl_xiaoxizhuang" onclick="loadXMLDoc(this.id,1)">小西装</a></li>
				<li><a href="#container" id="girl_yangrongshan" onclick="loadXMLDoc(this.id,1)">羊绒衫</a></li>
				<li><a href="#container" id="girl_hunsha" onclick="loadXMLDoc(this.id,1)">婚纱</a></li>
			</ul>
		</div>
	</div>
	<a href="#" class="btn btn-danger text-center" style="width: 100%">&nbsp;返回顶部</a>
</div>

<div class="main">
	<!--	获取顶部导航栏-->
	<?php require 'top.php' ?>
	
	
	<!--	logo-->
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
	                <img height="60" width="90" src="../IMG/logo3.png" alt="七天放心">
                </a>
	            <a href="#">
		            <img height="60" width="90" src="../IMG/logo4.png" alt="3亿会员">
	            </a>
            </div>
			<!--	        搜索框/购物车-->
			<div style="margin-top: 25px">
				<div class="search">
					<div class="searchinput_shopcarinput">
						<form action="index_select.php" method="get" id="search_form">
							<input type="text" max="10" placeholder="请输入你要查找的关键字,用空格隔开" name="searchtext"
							       id="search_text"
							       style="width: 50%">
							<select id="search_sel" name="sel">
								<option value="title">商品名</option>
								<option value="merchant">店铺名</option>
							</select>
							<input type="submit" name="search" value="">
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
						<script>
							$(document).ready(function () {
								//检测输入框得值是否违法
								$('#search_form').on('submit', function () {
									
									var search_text = $('#search_text').val();
									if (search_text) {
										return true;
									} else {
										alert("输入不能为空！");
										return false;
									}
								});
							});
						</script>
					</div>
				</div>
				<!-- recommend 为推荐的意思-->
				<div class="recommend">
					<ul>
						<li>
							<a href="product_all.php?type=boy_txue">
								T恤
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="product_all.php?type=boy_shirt">
								衬衫
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="product_all.php?type=girl_lianyiqun">
								女士连衣裙
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="product_all.php?type=girl_hunsha" style="color:  rgb(250,42,131)">
								婚纱
							</a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="product_all.php?type=boy_xifu" style="color: rgb(250,42,131)">
								男士西服套装
							</a>
						</li>
					
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- 菜单详情-->
    <div class="menu">
        <div style=" width: 70%;height: 100%;margin: 0 auto;">
            <a href="#" style=" background: rgb(241,1,128)">
                <div class="menu_category">
						
	                <li class="product_category">
                            商品分类
	                </li>
                    

                    <!-- category 为商品分类，此DIV是鼠标移到商品分类时显现的效果-->
                    <div   class="category" >
                        <ul>
	                        <li>
		                        商品分类
	                        </li>
                            <li id="category1">
                                <a href="#">
                                    女装/
                                    男装
                                    /内衣
                                </a>
                            </li>
                            <li id="category2">
                                <a href="#">
                                    女鞋/
                                    男鞋
                                    /箱包
                                </a>
                            </li>
                            <li id="category3">
                                <a href="#">
                                    护肤彩妆/
                                    个护
                                </a>
                            </li>
                            <li id="category4">
                                <a href="#">
                                    运动户外
                                </a>
                            </li>
                            <li id="category5">
                                <a href="#">
                                    家电数码
                                </a>
                            </li>
                            <li id="category6">
                                <a href="#">
                                    母婴童装
                                </a>
                            </li>
                            <li id="category7">
                                <a href="#">
                                    手表配饰
                                </a>
                            </li>
                            <li id="category8">
                                <a href="#">
                                    居家用品
                                </a>
                            </li>
                            <li id="category9">
                                <a href="#">
                                    唯美生活
                                </a>
                            </li>
                            <li id="category10">
                                <a href="#">
                                    唯品国际/
                                    唯品奢
                                </a>
                            </li>
                            <li id="category11">
                                <a href="#">
                                    医药健康
                                </a>
                            </li>
                            <li>
                                &nbsp;
                            </li>
                        </ul>
                    </div>
					
	                <div class="category1">
		                <ul><li></li></ul>
		               <ul>
			               <li>夏季热卖1</li>
			               <li>></li>
			               <li><a href="#">衬衫</a></li>
			               <li><a href="#">大衣</a></li>
			               <li><a href="#">羽绒服</a></li>
			               <li><a href="#">毛衣</a></li>
			               <li><a href="#">连衣裙</a></li>
		               </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
			                <li><a href="#">套头卫衣</a></li>
			                <li><a href="#"> Polo衫</a></li>
			                <li><a href="#">连帽卫衣 </a></li>
			                <li><a href="#"> 短袖T恤</a></li>
			                <li><a href="#">毛衣针织</a></li>
			                <li><a href="#"> 薄款卫衣</a></li>
			                <li><a href="#">加绒卫衣</a></li>
			                <li><a href="#"> Polo衫</a></li>
			                <li><a href="#">T恤衬衫 </a></li>
			                <li><a href="#">  保暖衬衫</a></li>
			                <li><a href="#">薄衬衫</a></li>
			                <li><a href="#"> 棉麻T恤 </a></li>
			                <li><a href="#"> 棉麻衬衫</a></li>
			                <li><a href="#">亚麻衬衫</a></li>
			                <li><a href="#"> V领T恤 </a></li>
			                <li><a href="#"> 格子衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category2">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖2</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category3">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖3</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category4">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖4</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category5">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖5</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category6">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖6</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category7">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖7</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category8">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖8</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category9">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖9</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category10">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖10</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category11">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖11</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>
	                <div class="category12">
		                <ul><li></li></ul>
		                <ul>
			                <li>东季热卖12</li>
			                <li>></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">羽绒服</a></li>
			                <li><a href="#">毛衣</a></li>
			                <li><a href="#">连衣裙</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li> 人气美衣</li>
			                <li>></li>
			                <li><a href="#">外套</a></li>
			                <li><a href="#">大衣</a></li>
			                <li><a href="#">牛仔裤</a></li>
			                <li><a href="#">羽绒</a></li>
			                <li><a href="#">棉衣</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>  百搭上衣</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 针织衫</a></li>
			                <li><a href="#">衬衫</a></li>
			                <li><a href="#"> 卫衣</a></li>
			                <li><a href="#"> T恤</a></li>
		                </ul>
		                <ul><li></li></ul>
		                <ul>
			                <li>    男式内搭</li>
			                <li>></li>
			                <li><a href="#">羊绒/羊毛衫</a></li>
			                <li><a href="#">毛衣 </a></li>
			                <li><a href="#"> 长袖T恤</a></li>
			                <li><a href="#">针织衫</a></li>
			                <li><a href="#"> 衬衫</a></li>
		                </ul>
	                </div>

	                
	                
                </div>
            </a>
            <ul class="menuul">
                <li style="margin-left:40px;">
                    <a href=" #" style="color: rgb(241,1,128); font-weight: bold" >
                        首页
                    </a>
                </li>
                <li>
                    <a href="#">
                        12.12预付
                    </a>
                </li>
                <li>
                    <a href="#">
                        最后疯抢
                    </a>
                </li>
                <li>
                    <a href="#">
                        唯品快抢
                    </a>
                </li>
                <li>
                    <a href="#">
                        女装
                    </a>
                </li>
                <li>
                    <a href="#">
                        母婴
                    </a>
                </li>
                <li>
                    <a href="#">
                        家电
                    </a>
                </li>
                <li>
                    <a href="#">
                        国际
                    </a>
                </li>
                <li>
                    <a href="#">
                        美妆
                    </a>
                </li>
                <li>
                    <a href="#">
                        鞋包
                    </a>
                </li>
                <li>
                    <a href="#">
                        预告
                    </a>
                </li>
                <li>
                    <a href="#">
                        更多
                    </a>
                </li>



            </ul>
        </div>
    </div>


<!--轮播图-->
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-ms-12 col-xs-12 ">
				<div class="banner_lunbo">
					<div class="outer">
						<ul class="img">
							<li><a><img src="../IMG/lunbo.png" class="img-responsive img-rounded"></a></li>
							<li><a><img src="../IMG/lunbo2.png" class="img-responsive img-rounded"></a></li>
							<li><a><img src="../IMG/lunbo3.png" class="img-responsive img-rounded"></a></li>
							<li><a><img src="../IMG/lunbo4.png" class="img-responsive img-rounded"></a></li>
						</ul>
						
						<ul class="num">
							<li class="current">1</li>
							<li>2</li>
							<li>3</li>
							<li>4</li>
						</ul>
						<div class="left_btn btn1"><</div>
						<div class="right_btn btn1">></div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!--商品展示区-->
	<div class="container" style="margin-top: 2%;background-color: rgb(1,158,210);border-radius: 5%;">
		<div class="row"
		     style="background-color:inherit;border: 1px rgb(1,158,210) solid;border-radius: 5%;box-shadow:0px 0px  10px 5px #aaa;">
			<div class="col-lg-6 col-lg-offset-3" style="border-radius: 5%;">
				
				<!--				商品类别-->
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"
				     style="border-radius: 5%;">
					<div class="panel panel-default" style="border-radius: 5%;">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title" style="border-radius: 5%;">
								<a style="border-radius: 5%;" role="button" data-toggle="collapse"
								   data-parent="#accordion" href="#collapseOne" aria-expanded="true"
								   aria-controls="collapseOne">
									男装
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
						     aria-labelledby="headingOne">
							<div class="panel-body" style="border-radius: 5%;">
								<a href="javascript:void(0)" id="boy_shirt" onclick="loadXMLDoc(this.id,1)">衬衫</a>
								<a href="javascript:void(0)" id="boy_yurongfu" onclick="loadXMLDoc(this.id,1)">羽绒服</a>
								<a href="javascript:void(0)" id="boy_jiake" onclick="loadXMLDoc(this.id,1)">夹克</a>
								<a href="javascript:void(0)" id="boy_xifu" onclick="loadXMLDoc(this.id,1)">西服套装</a>
								<a href="javascript:void(0)" id="boy_txue" onclick="loadXMLDoc(this.id,1)">T恤</a>
								<a href="javascript:void(0)" id="boy_xiuxianku" onclick="loadXMLDoc(this.id,1)">休闲裤</a>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title" style="border-radius: 5%;">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
								   href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									女装
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
						     aria-labelledby="headingTwo">
							<div class="panel-body" style="border-radius: 5%;">
								<a href="javascript:void(0)" id="girl_lianyiqun" onclick="loadXMLDoc(this.id,1)">连衣裙</a>
								<a href="javascript:void(0)" id="girl_banshenqun"
								   onclick="loadXMLDoc(this.id,1)">半身裙</a>
								<a href="javascript:void(0)" id="girl_duanwaitao"
								   onclick="loadXMLDoc(this.id,1)">短外套</a>
								<a href="javascript:void(0)" id="girl_xiaoxizhuang"
								   onclick="loadXMLDoc(this.id,1)">小西装</a>
								<a href="javascript:void(0)" id="girl_yangrongshan"
								   onclick="loadXMLDoc(this.id,1)">羊绒衫</a>
								<a href="javascript:void(0)" id="girl_hunsha" onclick="loadXMLDoc(this.id,1)">婚纱</a>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title" style="border-radius: 5%;">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
								   href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									暂未更新
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
						     aria-labelledby="headingThree">
							<div class="panel-body" style="border-radius: 5%;">
								暂未更新
							</div>
						</div>
					</div>
				</div>
			
			
			</div>
		</div>
	</div>
<!--	商品容器-->
	<div class="container" id="container" style="margin-top: 2%">
				<?php
				$result = $conn->query("select id from boy_shirt ");
				$random=mt_rand(0,($result->num_rows)-60);
				$sql="select * from boy_shirt limit {$random},60";
				$result =$conn->query($sql);
				$rows = $result->fetch_assoc();
				$result =$conn->query($sql);
//				$result =$conn->query('select * from boy_clothes_product where type=\'boy_shirt\' limit 0,60');
				$i=1;?>
		<div class="row">
			<div class="col-lg-11 text-left" id="product_type"
			     style=" color: white;background-color:  rgb(1,158,210);font-size: 25px;box-shadow:0px 0px  10px 5px #aaa;">
				男士衬衫
			</div>
			<div class="col-lg-1 text-right"
			     style=" color: white;background-color:  rgb(1,158,210);font-size: 25px;box-shadow:10px 0px  10px 5px #aaa;">
				<a href="product_all.php?type=boy_shirt" style="color: inherit">更多</a>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-lg-12">
				<a href="javascript:void(0)"
				   style="cursor: pointer;background-color: transparent;font-size: 12px;color: #999999;margin-top: 5%"
				   class="<?php echo $rows['type']?>" onclick="loadXMLDoc(this.className,1)" id="refresh">点击刷新...</a>
			</div>
		</div>
		<?php
				if ($result->num_rows> 0) {
					while ($row = $result->fetch_assoc()) {
						if($i%6==0){
							echo "<div class=\"row\" >";
						}
							?>
							<div class="col-lg-2 col-md-3 col-ms-3 col-xs-6">
								<div class="item">
									<a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"><img
											src="<?php echo $row['img_addre']; ?>"></a>
									<span style="font-size: 20px;color: #e4393c;">￥<?php echo $row['price']; ?></span>
									<p><a href="product.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>"
									      class="item_title"><?php if(strlen($row['title'])>100) echo substr($row['title'],0,100).'....';else echo $row['title']; ?></a></p>
									<p><a href="<?php echo $row['merchant_addre']; ?>" class="item_merchant"><font
												color="#4d88ff">●</font><?php echo $row['merchant']; ?></a>
										<span class="item_merchant_place"> <?php echo $row['merchant_place']; ?></span>
									</p>
								</div>
							</div>
							<?php
						if($i%6==0){
							echo "</div>";
						}
						$i++;
						}}
				?>
		</div>
	
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12">
				<a href="javascript:void(0)" style="cursor: pointer;background-color: transparent;font-size: 12px;color: #999999" class="<?php echo $rows['type']?>"
				   onclick="getType();loadXMLDoc(this.className,2)" id="reload">点击加载更多...</a>
			</div>
		</div>
	</div>

<!--	异步更新数据-->
	<script>
		function getType() {
			document.getElementById('reload').className = document.getElementById('refresh').className;
		}
		
		function loadXMLDoc(id, flag) {
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
					if (flag == 1) {
						document.getElementById("container").innerHTML = xmlhttp.responseText;
					}
					if (flag == 2) {
						document.getElementById("container").innerHTML += xmlhttp.responseText;
					}
					
				}
			}
			if (flag == 1) {
				xmlhttp.open("GET", "../PRODUCTHTML/product_category.php?type=" + id + "&flag=false", true);
			}
			if (flag == 2) {
				xmlhttp.open("GET", "../PRODUCTHTML/product_category.php?type=" + id + "&flag=true", true);
			}
			
			xmlhttp.send();
		}
	</script>
	
	
	<div class="footer">
		<div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
			Copyright &nbsp;© &nbsp;
			2019-2020 &nbsp; qinyou.com， &nbsp;All &nbsp;Rights &nbsp; Reserved &nbsp;
			使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
		        <br>
		        九江学院 20180101981号 &nbsp;   赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
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
</body>


<!--<script src="../JS/index_vue.js"></script>-->
</html>

