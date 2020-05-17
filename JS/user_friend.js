setInterval(function () {
	$.ajax({
		url: "../PRODUCTHTML/refresh_user_friend.php",
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
	//查找好友
	$('#search_btn').on('click', function () {
		if ($('#search_text').val() === "") {
			alert("输入不能为空！");
		} else {
			//获取是否选择了管理员
			let isadmin = "";
			var arr = document.getElementsByClassName('radios');
			for (var i = 0; i < arr.length; i++) {
				if (arr[0].checked) {
					isadmin = 'false';
				}
				if (arr[1].checked) {
					isadmin = 'true';
				}
			}
			$.ajax(
				{
					url: "../PRODUCTHTML/user_search.php",
					type: "post",
					data: {
						"sel": $('#search_sel').val(),
						"isadmin": isadmin,
						"search_text": $('#search_text').val(),
						"user_id": $('#login_user_id').val()
					},
					success: function (result) {
						$('#search_result').html(result);
						console.log(1);
					},
					error: function (xhr, status, p3) {
						// var err = "Error:" + status + "/" + p3;
						// alert(err);
					}
				}
			);
		}
	});
	
	//给动态添加的元素绑定事件(添加好友)
	$('#search_result').on('click', '.add_user_friend', function () {
		//获取动态元素的值
		$(this).children('.add_user_friend_btn').removeClass('btn-danger');
		$(this).children('.add_user_friend_btn').addClass('btn-success');
		$(this).children('.add_user_friend_btn').html('好友申请已发送');
		let user_id = $(this).children('.user_id').val();
		let send_user_id = $('#login_user_id').val();
		$.ajax({
			url: "../PRODUCTHTML/add_user_friend_message.php",
			type: "post",
			data: {
				"user_id": user_id,
				"send_user_id": send_user_id,
				"type": "add"
			},
			success: function (result) {
				console.log(1);
			},
			error: function (xhr, status, p3) {
				// var err = "Error:" + status + "/" + p3;
				// alert(err);
			}
			
		});
		
	});
	
	//当鼠标移入好友时，删除好友按钮显示
	$('#container').on("mouseenter mouseleave", ".col-lg-2", function (event) {
		if (event.type == "mouseenter") {
			//鼠标悬浮
			$(this).find('.delete').show('fast');
		} else if (event.type == "mouseleave") {
			//鼠标离开
			$(this).find('.delete').hide('fast');
		}
	});
	
});