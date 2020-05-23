
$(document).ready(
	function(){
		//商品图片放大显示
		$('.old_img').hover(
			function () {
				$('.new_img').show('fast');
			},
			function () {
				$('.new_img').hide('fast');
			}
		);
		
		
		//商品+按钮点击事件
		$('#add').on('click', function () {
			if (parseInt($('#product_num').val()) >= 99) {
				$(this).attr('disabled', 'disabled');
			} else {
				$('#product_num').val(parseInt($('#product_num').val()) + 1);
				$('#all_price').html(parseInt($('#product_num').val()) * parseInt($('#price').html()));
			}
			$('#cut').removeAttr('disabled');
		});
		
		
		//商品-按钮点击
		$('#cut').on('click', function () {
			if (parseInt($('#product_num').val()) <= 1) {
				$(this).attr('disabled', 'disabled');
			} else {
				$('#product_num').val(parseInt($('#product_num').val()) - 1);
				$('#all_price').html(parseInt($('#product_num').val()) * parseInt($('#price').html()));
			}
			$('#add').removeAttr('disabled');
		});
		
		
		//商品数量输入框检查输入合法性并让总价的值显示
		$('#product_num').on('keyup', function () {
			var reg = /[A-Za-z\u4e00-\u9fa5+\-!@#$%^&*()_=\\'";:/?.>,<，。、、‘；“：|？》《——}{【】\[\]  ）（\n]/;
			if ($(this).val().toString().match(reg) || parseInt($(this).val()) < 0) {
				$(this).val(1);
			}
			if (parseInt($(this).val()) > 99) {
				$(this).val(99);
			}
			if ($(this).val() == "") {
				$(this).val(1);
			}
			$('#all_price').html(parseInt($(this).val()) * parseInt($('#price').html()));
		});
		
		
		//收藏按钮点击
		$('#isCollect').on('click', function () {
			if ($('#isLogin').val() == "no") {
				if (confirm("你暂未登录，无法加入收藏，是否登录？")) {
					location.assign('../HTML/logoin.php');
				}
			} else {
				if (confirm("你确定要加入收藏吗？")) {
					let count = $('#product_num').val();
					let price = $('#price').val();
					let product_id = $('#productid').val();
					let product_type = $('#producttype').val();
					$.ajax({
						url: "../PHP/insert_collect_product.php",
						type: "post",
						data: {
							"Product": {
								'count': count,
								'price': price,
								"product_id": product_id,
								"product_type": product_type
							}
						},
						success: function (result) {
							console.log(result);
						},
						error: function (xhr, status, p3) {
							// var err = "Error:" + status + "/" + p3;
							// alert(err);
						}
					});
					this.iscollected = false;
					$('#isCollect').html("已收藏");
					$('#isCollect').removeClass("btn-success");
					$('#isCollect').addClass("btn-warning");
				}
			}
		});
		
		
		//加入购物车点击
		$('#addShopCar').on('click', function () {
			if ($('#isLogin').val() == "no") {
				if (confirm("你暂未登录，无法加入购物车，是否登录？")) {
					location.assign('../HTML/logoin.php');
				}
			} else {
				if (confirm("你确定要加入购物车吗？")) {
					let count = $('#product_num').val();
					let price = $('#price').val();
					let product_id = $('#productid').val();
					let product_type = $('#producttype').val();
					let shopnum = $('.shopcar_msg').eq(0).html();
					$.ajax({
						url: "../PHP/insert_shopcar.php",
						type: "post",
						data: {
							"Product": {
								'count': count,
								'price': price,
								"product_id": product_id,
								"product_type": product_type
							}, "Shopnum": shopnum
						},
						success: function (result) {
							console.log(result);
							$('.shopcar_msg').html(result);
						},
						error: function (xhr, status, p3) {
							// var err = "Error:" + status + "/" + p3;
							// alert(err);
						}
					});
					
					$('#isShopcar').html("已加入购物车");
					$('#isShopcar').removeClass("btn-danger");
					$('#isShopcar').addClass("btn-warning");
				}
			}
		});
		
		
		//点击评论跳出评论框
		var setMessage = $('.setMessage');
		setMessage.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					if ($('.setMessage').eq(i).html() === "评论") {
						$('.setMessage').eq(i).html('隐藏评论框');
					} else {
						$('.setMessage').eq(i).html('评论');
					}
					$('.huifu').eq(i).slideToggle('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		//点击回复跳出回复框
		var setMessageIn = $('.setMessageIn');
		setMessageIn.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					if ($('.setMessageIn').eq(i).html() === "回复") {
						$('.setMessageIn').eq(i).html('隐藏回复框');
					} else {
						$('.setMessageIn').eq(i).html('回复');
					}
					$('.huifus').eq(i).slideToggle('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		
		//点击展开多级评论
		var tipOfReplyShow = $('.tipOfReplyShow');
		tipOfReplyShow.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					$('.replypost').eq(i).slideDown('fast');
					$('.tipOfReplyShow').eq(i).hide('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		//折叠展开多级评论
		var tipOfReplyHiden = $('.tipOfReplyHiden');
		tipOfReplyHiden.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					$('.replypost').eq(i).slideUp('fast');
					$('.tipOfReplyShow').eq(i).show('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		
		$('.shopcar').click(
			function () {
				if ($('#isLogin').val() == "no") {
					if (confirm('进入购物车需要登录哦？是否前往登录？')) {
						location.assign('../HTML/logoin.php');
					}
				} else {
					location.assign('../HTML/shopcar.php');
				}
			}
		);
		
		
	}
);