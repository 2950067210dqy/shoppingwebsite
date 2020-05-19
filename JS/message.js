setInterval(function () {
	$.ajax({
		url: "../PRODUCTHTML/user_message.php",
		type: "post",
		data: {"reply_user_id": $('#reply_user_id').val(), "user_id": $('#user_id').val()},
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
	$('#send').on('click', function () {
		if ($('#textarea').val() == "") {
			alert('您输入为空！请重新输入')
		} else {
			let message = $('#textarea').val();
			$('#textarea').val('');
			$.ajax({
				url: "../PRODUCTHTML/user_message.php",
				type: "post",
				data: {
					"reply_user_id": $('#reply_user_id').val(),
					"user_id": $('#user_id').val(),
					"message": message
				},
				success: function (result) {
					$('#container').html(result);
					console.log(1);
				},
				error: function (xhr, status, p3) {
					// var err = "Error:" + status + "/" + p3;
					// alert(err);
				}
			});
		}
	});
	
	
	//当鼠标移入信息时，信息已读
	$('#container').on("mouseenter", ".rowcontainer", function () {
		//鼠标悬浮
		//将信息未读更新成已读
		if ($(this).find('.btn').text() === "未读") {
			$(this).find('.btn').text('已读');
			$(this).find('.btn').removeClass('btn-danger');
			$(this).find('.btn').addClass('btn-success');
			//将信息的id传过去
			let id = $(this).find('.message_id').val();
			$.ajax({
				url: "../PRODUCTHTML/user_message_isread_update.php",
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
		
	});
});