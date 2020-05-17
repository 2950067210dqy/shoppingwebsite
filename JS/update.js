function update() {
if (confirm("确认要修改信息吗，确认后即可修改")) {
	document.getElementById('id').removeAttribute("disabled");
	document.getElementById('email').removeAttribute("disabled");
	document.getElementById('phone').removeAttribute("disabled");
	document.getElementById('name').removeAttribute("disabled");
	document.getElementById('sex').removeAttribute("disabled");
	document.getElementById('invitecode').removeAttribute("disabled");
	document.getElementById('password').removeAttribute("disabled");
	document.getElementById('career').removeAttribute("disabled");
	document.getElementById('update').removeAttribute("disabled");
}

}

$(document).ready(
	function () {
		//给动态添加的元素绑定事件(添加好友)
		$('.add_user_friend_btn').on('click', function () {
			//获取动态元素的值
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).html('好友申请已发送');
			let user_id = $('#user_id').val();
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
					console.log(result);
				},
				error: function (xhr, status, p3) {
					// var err = "Error:" + status + "/" + p3;
					// alert(err);
				}
				
			});
			
		})
	}
);