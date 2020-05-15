$(document).ready(function () {
	//当鼠标移入商品区域时，删除商品按钮显示
	var product_container = $('.product_container');
	product_container.each(function (i) {
		let t = this;
		$(this).on("mouseenter mouseleave", function (event) {
			if (event.type == "mouseenter") {
				$('.delete').eq(i).show('fast');
				
				//鼠标悬浮
			} else if (event.type == "mouseleave") {
				$('.delete').eq(i).hide('fast');
				//鼠标离开
			}
			
		});
	});
	
	$('#batch_opreation').on('click', function () {
		if ($(this).html() === "批量操作") {
			$(this).html("取消批量操作");
			$('.deletecheckbox').show('fast');
			$('#batch_checkbox').slideDown('fast');
			$('#batch_delete').slideDown('fast');
		} else if ($(this).html() === "取消批量操作") {
			$(this).html("批量操作");
			$('.deletecheckbox').hide('fast');
			$('#batch_checkbox').slideUp('fast');
			$('#batch_delete').slideUp('fast');
		}
		$(this).toggleClass('active');
		
	});
	
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
	
	var deletecheckbox = $('.deletecheckbox');
	deletecheckbox.each(function (i) {
		$(this).on('click', function () {
			if ($('.deletecheckbox:checked').eq(i - 1).val()) {
				$('.product_container').eq(i - 1).css("background-color", "#449d44");
			} else {
				$('.product_container').eq(i - 1).css("background-color", "inherit");
			}
			
		});
	});
});