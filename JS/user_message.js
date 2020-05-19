setInterval(function () {
	$.ajax({
		url: "../PRODUCTHTML/refresh_add_user_friend_message.php",
		type: "post",
		success: function (result) {
			$('#container').html(result);
			console.log(1);
		},
		error: function (xhr, status, p3) {
			// var err = "Error:" + status + "/" + p3;
			// alert(err);
		}
	});
}, 3000);

$(document).ready(function () {
	//点击同意请求
	$('#container').on('click', '.agree', function () {
		let agree_user_id = $(this).children('.agree_user_id').val();
		let agree_send_user_id = $(this).children('.agree_send_user_id').val();
		let agree_add_user_message_id = $(this).children('.agree_add_user_message_id').val();
		
		$.ajax({
			url: "../PRODUCTHTML/user_friend_request.php",
			type: "post",
			data: {
				"type": "add_true",
				"user_id": agree_user_id,
				"send_user_id": agree_send_user_id,
				"add_user_message_id": agree_add_user_message_id
			},
			success: function (result) {
				console.log(1);
			},
			error: function (xhr, status, p3) {
				// var err = "Error:" + status + "/" + p3;
				// alert(err);
			}
		});
		$(this).parents('.result').html("<div class=\"col-lg-12 text-center\">\n" +
			"\t\t\t\t\t\t\t\t\t\t<a class=\"btn btn-success btn-block\" href=\"javascript:void(0)\">已经同意该请求</a>\n" +
			"\t\t\t\t\t\t\t\t\t</div>");
	});
	//点击不同意请求
	$('#container').on('click', '.disagree', function () {
		let disagree_user_id = $(this).children('.disagree_user_id').val();
		let disagree_send_user_id = $(this).children('.disagree_send_user_id').val();
		let disagree_add_user_message_id = $(this).children('.disagree_add_user_message_id').val();
		$.ajax({
			url: "../PRODUCTHTML/user_friend_request.php",
			type: "post",
			data: {
				"type": "add_false",
				"user_id": disagree_user_id,
				"send_user_id": disagree_send_user_id,
				"add_user_message_id": disagree_add_user_message_id
			},
			success: function (result) {
				console.log(1);
			},
			error: function (xhr, status, p3) {
				// var err = "Error:" + status + "/" + p3;
				// alert(err);
			}
		});
		$(this).parents('.result').html("<div class=\"col-lg-12 text-center\">\n" +
			"\t\t\t\t\t\t\t\t\t\t<a class=\"btn btn-danger btn-block\" href=\"javascript:void(0)\">已经拒绝该请求</a>\n" +
			"\t\t\t\t\t\t\t\t\t</div>");
	});
	
	
	//当鼠标移入好友时，删除好友按钮显示
	$('#container').on("mouseenter mouseleave", ".rowcontainer", function (event) {
		if (event.type == "mouseenter") {
			//鼠标悬浮
			//将信息未读更新成已读
			if ($(this).find('.isread').children('.btn-block').html() === "未读") {
				$(this).find('.isread').children('.btn-block').text('已读');
				$(this).find('.isread').children('.btn-block').removeClass('btn-danger');
				$(this).find('.isread').children('.btn-block').addClass('btn-success');
				//将信息的id传过去
				let id = $(this).find('.add_user_message_id').val();
				$.ajax({
					url: "../PRODUCTHTML/refresh_user_message_isread.php",
					type: "post",
					data: {"id": id},
					success: function (result) {
						console.log(result);
					},
					error: function (xhr, status, p3) {
						// var err = "Error:" + status + "/" + p3;
						// alert(err);
					}
				});
				
			}
			$(this).find('.delete').show('fast');
		} else if (event.type == "mouseleave") {
			//鼠标离开
			$(this).find('.delete').hide('fast');
		}
	});
});