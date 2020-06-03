$(function () {
//商品数量加号按钮功能
	var add = $('.add');
	add.each(function (i) {
		let t = this;
		$(this).on('click', function () {
			if (parseInt($('.product_num').eq(i).val()) < 99) {
				$.ajax({
					url: "../PRODUCTHTML/product_shopcar.php",
					type: "post",
					dataType: "json",
					data: {"shopcar_id": t.title, "product_num": parseInt($('.product_num').eq(i).val()) + 1},
					success: function (data) {
						$('.product_num').eq(i).val(data[0]['product_num']);
						$('.allprice').eq(i).html(parseInt(data[0]['product_num']) * parseInt($('.price').eq(i).html()));
						
						$('.final_num').each(function (j) {
							$(this).html(parseInt($(this).html()) + 1);
						});
						$('.final_price').each(function (j) {
							$(this).html(parseInt($(this).html()) + parseInt($('.price').eq(i).html()));
						});
					},
					error: function (xhr, status, p3) {
						var err = "Error:" + status + "/" + p3;
						alert(err);
					}
				});
			}
			
			// $('.product_num').eq(i).val(parseInt($('.product_num').eq(i).val())+1);
		})
		
	});
//商品数量减号功能
	var subtract = $('.subtract');
	subtract.each(function (i) {
		let t = this;
		$(this).on('click', function () {
			if (parseInt($('.product_num').eq(i).val()) > 1) {
				$.ajax({
					url: "../PRODUCTHTML/product_shopcar.php",
					type: "post",
					dataType: "json",
					data: {"shopcar_id": t.title, "product_num": parseInt($('.product_num').eq(i).val()) - 1},
					success: function (data) {
						$('.product_num').eq(i).val(data[0]['product_num']);
						$('.allprice').eq(i).html(parseInt(data[0]['product_num']) * parseInt($('.price').eq(i).html()));
						$('.final_num').each(function (j) {
							$(this).html(parseInt($(this).html()) - 1);
						});
						$('.final_price').each(function (j) {
							$(this).html(parseInt($(this).html()) - parseInt($('.price').eq(i).html()));
						});
					},
					error: function (xhr, status, p3) {
						var err = "Error:" + status + "/" + p3;
						alert(err);
					}
				});
			}
			
		})
	});

//商品数量用户输入功能
	var product_num = $('.product_num');
	product_num.each(function (i) {
		let beforenum = 0;
		let beforeallprice = 0;
		$(this).on('focus', function () {
			beforenum = parseInt($('.product_num').eq(i).val());
			beforeallprice = parseInt($('.allprice').eq(i).html());
		});
		$(this).on('keyup', function () {
			var reg = /[A-Za-z\u4e00-\u9fa5+\-!@#$%^&*()_=\\'";:/?.>,<，。、、‘；“：|？》《——}{【】\[\]  ）（\n]/;
			if ($('.product_num').eq(i).val().toString().match(reg) || parseInt($('.product_num').eq(i).val()) < 0) {
				$('.product_num').eq(i).val(1);
			}
			if (parseInt($('.product_num').eq(i).val()) > 99) {
				$('.product_num').eq(i).val(99);
			}
		});
		
		$(this).on('blur', function () {
			let t = this;
			if ($('.product_num').eq(i).val() == '') {
				$('.product_num').eq(i).val(1);
			}
			$.ajax({
				url: "../PRODUCTHTML/product_shopcar.php",
				type: "post",
				dataType: "json",
				data: {"shopcar_id": t.title, "product_num": $('.product_num').eq(i).val()},
				success: function (data) {
					$('.product_num').eq(i).val(data[0]['product_num']);
					$('.allprice').eq(i).html(parseInt(data[0]['product_num']) * parseInt($('.price').eq(i).html()));
					$('.final_num').each(function (j) {
						$(this).html(parseInt($(this).html()) + (parseInt($('.product_num').eq(i).val()) - beforenum));
					});
					$('.final_price').each(function (j) {
						$(this).html(parseInt($(this).html()) + (parseInt($('.allprice').eq(i).html()) - beforeallprice));
					});
					
				},
				error: function (xhr, status, p3) {
					var err = "Error:" + status + "/" + p3;
					alert(err);
				}
			});
		});
	});

//	点击checkbox 总价总数量变更
	
	var choose = $('.chooseProduct');
	choose.each(function (i) {
		$(this).on('click', function () {
			if ($(this).is(":checked")) {
				var num = parseInt($(this).parents('tr').find('.product_num').val());//获取这选取的这一行的商品的数量
				$('.final_num').html(parseInt($('.final_num').html()) + num);//将这一行的商品数量加到总数量里
				var price = parseInt($(this).parents('tr').find('.allprice').html());//获取这选取的这一行的商品的总价钱
				$('.final_price').html(parseInt($('.final_price').html()) + price);//将这一行的商品数量加到总数量里
			} else {
				//一旦将复选框的其中一个框取消选中状态时，将全选框得选中状态变为false
				var allchecked = document.getElementsByName("allchecked");
				for (var i = 0; i < allchecked.length; i++) {
					allchecked[i].checked = false;
					
				}
				
				var num = parseInt($(this).parents('tr').find('.product_num').val());//获取这选取的这一行的商品的数量
				$('.final_num').html(parseInt($('.final_num').html()) - num);//将这一行的商品数量从总数量里减去
				var price = parseInt($(this).parents('tr').find('.allprice').html());//获取这选取的这一行的商品的总价钱
				$('.final_price').html(parseInt($('.final_price').html()) - price);//将这一行的商品数量从总数量里减去
			}
		});
	});
	
	
});
