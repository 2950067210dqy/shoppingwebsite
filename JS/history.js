$(document).ready(function () {
	//全部时间段展开
	
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
			$('.batch_checkbox').slideDown('fast');
			$('#batch_delete').slideDown('fast');
			$('#batch_show').slideDown('fast');
		} else if ($(this).html() === "取消批量操作") {
			$(this).html("批量操作");
			$('.deletecheckbox').hide('fast');
			$('.batch_checkbox').slideUp('fast');
			$('#batch_delete').slideUp('fast');
			$('#batch_show').slideUp('fast');
		}
		$(this).toggleClass('active');
		
	});
	//全部全选
	$('#batch_choose').on('click', function () {
		var arr = document.getElementsByName("choose[]");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose:checked').val();//循环遍历看是否全选
			document.getElementById('batch_choose_today').checked = $('#batch_choose:checked').val();
			document.getElementById('batch_choose_yesterday').checked = $('#batch_choose:checked').val();
			document.getElementById('batch_choose_threedaysago').checked = $('#batch_choose:checked').val();
			document.getElementById('batch_choose_aweekago').checked = $('#batch_choose:checked').val();
			document.getElementById('batch_choose_amonthago').checked = $('#batch_choose:checked').val();
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	//单个时间段全选
	$('#batch_choose_today').on('click', function () {
		var arr = document.getElementsByClassName("today");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose_today:checked').val();//循环遍历看是否全选
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose_today:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	$('#batch_choose_yesterday').on('click', function () {
		var arr = document.getElementsByClassName("today");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose_yesterday:checked').val();//循环遍历看是否全选
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose_yesterday:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	$('#batch_choose_threedaysago').on('click', function () {
		var arr = document.getElementsByClassName("today");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose_threedaysago:checked').val();//循环遍历看是否全选
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose_threedaysago:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	$('#batch_choose_aweekago').on('click', function () {
		var arr = document.getElementsByClassName("today");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose_aweekago:checked').val();//循环遍历看是否全选
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose_aweekago:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	$('#batch_choose_amonthago').on('click', function () {
		var arr = document.getElementsByClassName("today");
		for (var i = 0; i < arr.length; i++) {
			arr[i].checked = $('#batch_choose_amonthago:checked').val();//循环遍历看是否全选
			$('.product_container').css("background-color", "#449d44");
		}
		if (!$('#batch_choose_amonthago:checked').val()) {
			$('.product_container').css("background-color", "inherit");
		}
	});
	//单选
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
	//全部时间段展开
	$('#batch_show_opreation').on('click', function () {
		if ($(this).html() === "全部展开") {
			$(this).html("取消全部展开");
			$('#today_row').slideDown('fast');
			$('#yesterday_row').slideDown('fast');
			$('#three_days_ago_row').slideDown('fast');
			$('#a_week_ago_row').slideDown('fast');
			$('#a_month_ago_row').slideDown('fast');
		} else if ($(this).html() === "取消全部展开") {
			$(this).html("全部展开");
			$('#today_row').slideUp('fast');
			$('#yesterday_row').slideUp('fast');
			$('#three_days_ago_row').slideUp('fast');
			$('#a_week_ago_row').slideUp('fast');
			$('#a_month_ago_row').slideUp('fast');
		}
	});
	//单个时间段展开
	$('#today').on('click', function () {
		$('#today_row').slideToggle('fast');
		$('#yesterday_row').slideUp('fast');
		$('#three_days_ago_row').slideUp('fast');
		$('#a_week_ago_row').slideUp('fast');
		$('#a_month_ago_row').slideUp('fast');
	});
	$('#yesterday').on('click', function () {
		$('#today_row').slideUp('fast');
		$('#yesterday_row').slideToggle('fast');
		$('#three_days_ago_row').slideUp('fast');
		$('#a_week_ago_row').slideUp('fast');
		$('#a_month_ago_row').slideUp('fast');
	});
	$('#three_days_ago').on('click', function () {
		$('#today_row').slideUp('fast');
		$('#yesterday_row').slideUp('fast');
		$('#three_days_ago_row').slideToggle('fast');
		$('#a_week_ago_row').slideUp('fast');
		$('#a_month_ago_row').slideUp('fast');
	});
	$('#a_week_ago').on('click', function () {
		$('#today_row').slideUp('fast');
		$('#yesterday_row').slideUp('fast');
		$('#three_days_ago_row').slideUp('fast');
		$('#a_week_ago_row').slideToggle('fast');
		$('#a_month_ago_row').slideUp('fast');
	});
	$('#a_month_ago').on('click', function () {
		$('#today_row').slideUp('fast');
		$('#yesterday_row').slideUp('fast');
		$('#three_days_ago_row').slideUp('fast');
		$('#a_week_ago_row').slideUp('fast');
		$('#a_month_ago_row').slideToggle('fast');
	});
	
	
});