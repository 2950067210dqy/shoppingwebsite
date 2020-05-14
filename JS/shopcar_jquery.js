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
					
					$('#final_num').html(parseInt($('#final_num').html()) + 1);
					$('#final_price').html(parseInt($('#final_price').html()) + parseInt($('.price').eq(i).html()));
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
					$('#final_num').html(parseInt($('#final_num').html()) - 1);
					$('#final_price').html(parseInt($('#final_price').html()) - parseInt($('.price').eq(i).html()));
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
				$('#final_num').html(parseInt($('#final_num').html()) + (parseInt($('.product_num').eq(i).val()) - beforenum));
				$('#final_price').html(parseInt($('#final_price').html()) + (parseInt($('.allprice').eq(i).html()) - beforeallprice));
			},
			error: function (xhr, status, p3) {
				var err = "Error:" + status + "/" + p3;
				alert(err);
			}
		});
	});
});