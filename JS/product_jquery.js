
$(document).ready(
	function(){
		var postNum=0;
		//商品图片放大显示
	$('.old_img').hover(
		function () {
		$('.new_img').show('fast');
		},
		function () {
			$('.new_img').hide('fast');
		}
	);
	$('.setMessage').click(
		function () {
			if($('#isLogin').val()==="yes"){
				if($('.setMessage').val()==="评论"){
					$('.setMessage').val('隐藏评论框');
				}else{
					$('.setMessage').val('评论');
				}
				$('.huifu').slideToggle('fast');
			}
			else {
				if(confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")){
					location.assign("../HTML/logoin.php");
				}
			}
		}
	);
	$('.setMessageIn').click(
		function () {
			if($('.setMessageIn').val()==="回复"){
				$('.setMessageIn').val('隐藏回复框');
			}else{
				$('.setMessageIn').val('回复');
			}
			$('.huifus').slideToggle('fast');
		}
	);
	}
);