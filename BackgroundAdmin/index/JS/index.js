$(function () {
	$('#updateOK').on('click', function () {
		if ($(this).attr('type') == 'button') {
			alert('请先点击修改信息按钮,修改完信息再点本按钮哦！');
		}
	});
	$('#update').on('click', function () {
		console.log($('input').removeAttr('disabled'));
		$('#updateOK').attr('type', 'submit');
	});
	
	
});