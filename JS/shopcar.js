function allok(choiceBtn) {
	var arr = document.getElementsByName("choose[]");
	for (var i = 0; i < arr.length; i++) {
		arr[i].checked = choiceBtn.checked;//循环遍历看是否全选
	}
	var arr2 = document.getElementsByName("allchecked");
	for (var i = 0; i < arr2.length; i++) {
		arr2[i].checked = choiceBtn.checked;//循环遍历看是否全选
	}
	
	//全选按钮被选中所有价格和数量显示
	if ($(choiceBtn).is(':checked')) {
		var num = $('.product_num');
		let final_num = 0;
		num.each(function (i) {
			final_num += parseInt($(this).val());
		});
		$('.final_num').html(final_num);
		let final_price = 0;
		var price = $('.allprice');
		price.each(function (i) {
			final_price += parseInt($(this).html());
		});
		$('.final_price').html(final_price);
	} else {
		$('.final_num').html(0);
		$('.final_price').html(0);
	}
}