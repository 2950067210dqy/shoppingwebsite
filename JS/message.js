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
			$.ajax({
				url: "../PRODUCTHTML/user_message.php",
				type: "post",
				data: {
					"reply_user_id": $('#reply_user_id').val(),
					"user_id": $('#user_id').val(),
					"message": $('#textarea').val()
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
});