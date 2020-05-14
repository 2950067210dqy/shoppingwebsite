
$(document).ready(
	function(){
		var postNum = 0;
		//商品图片放大显示
		$('.old_img').hover(
			function () {
				$('.new_img').show('fast');
			},
			function () {
				$('.new_img').hide('fast');
			}
		);
		//点击评论跳出评论框
		var setMessage = $('.setMessage');
		setMessage.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					if ($('.setMessage').eq(i).html() === "评论") {
						$('.setMessage').eq(i).html('隐藏评论框');
					} else {
						$('.setMessage').eq(i).html('评论');
					}
					$('.huifu').eq(i).slideToggle('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		//点击回复跳出回复框
		var setMessageIn = $('.setMessageIn');
		setMessageIn.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					if ($('.setMessageIn').eq(i).html() === "回复") {
						$('.setMessageIn').eq(i).html('隐藏回复框');
					} else {
						$('.setMessageIn').eq(i).html('回复');
					}
					$('.huifus').eq(i).slideToggle('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		
		//点击展开多级评论
		var tipOfReplyShow = $('.tipOfReplyShow');
		tipOfReplyShow.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					$('.replypost').eq(i).slideDown('fast');
					$('.tipOfReplyShow').eq(i).hide('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		//折叠展开多级评论
		var tipOfReplyHiden = $('.tipOfReplyHiden');
		tipOfReplyHiden.each(function (i) {
			let t = this;
			$(this).on('click', function () {
				if ($('#isLogin').val() === "yes") {
					$('.replypost').eq(i).slideUp('fast');
					$('.tipOfReplyShow').eq(i).show('fast');
				} else {
					if (confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")) {
						location.assign("../HTML/logoin.php");
					}
				}
			})
		});
		
		$('.shopcar').click(
			function () {
				if ($('#isLogin').val() == "no") {
					if (confirm('进入购物车需要登录哦？是否前往登录？')) {
						location.assign('../HTML/logoin.php');
					}
				} else {
					location.assign('../HTML/shopcar.php');
				}
			}
		);
		
		
	}
);