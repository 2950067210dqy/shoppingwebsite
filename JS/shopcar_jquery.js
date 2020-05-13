var add = $('.add');

add.each(function (i) {
	let t = this;
	$(this).on('click', function () {
		$.ajax({
			url: "../PRODUCTHTML/product_shopcar.php",
			type: "post",
			dataType: "json",
			data: {"shopcar_id": t.title, "product_num": parseInt($('.product_num').eq(i).val()) + 1},
			success: function (data) {
				$('.product_num').eq(i).val(data[0]['product_num']);
				$('.allprice').eq(i).html(parseInt(data[0]['product_num']) * parseInt($('.price').eq(i).html()));
			},
			error: function (xhr, status, p3) {
				var err = "Error:" + status + "/" + p3;
				alert(err);
			}
		});
		// $('.product_num').eq(i).val(parseInt($('.product_num').eq(i).val())+1);
	})
	
});
var subtract = $('.subtract');

subtract.each(function (i) {
	let t = this;
	$(this).on('click', function () {
		$.ajax({
			url: "../PRODUCTHTML/product_shopcar.php",
			type: "post",
			dataType: "json",
			data: {"shopcar_id": t.title, "product_num": parseInt($('.product_num').eq(i).val()) - 1},
			success: function (data) {
				$('.product_num').eq(i).val(data[0]['product_num']);
				$('.allprice').eq(i).html(parseInt(data[0]['product_num']) * parseInt($('.price').eq(i).html()));
			},
			error: function (xhr, status, p3) {
				var err = "Error:" + status + "/" + p3;
				alert(err);
			}
		});
	})
	
});
