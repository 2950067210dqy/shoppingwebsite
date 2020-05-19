setInterval(function () {
	$.ajax({
		url: "../PRODUCTHTML/refresh_message_num.php",
		type: "post",
		success: function (result) {
			$('#message_num').html(result);
			console.log(result);
		},
		error: function (xhr, status, p3) {
			// var err = "Error:" + status + "/" + p3;
			// alert(err);
		}
	});
}, 5000);