$(document).scroll(function() {
	var scroH = $(document).scrollTop();  //滚动高度
	var viewH = $(window).height();  //可见高度
	var contentH = $(document).height();  //内容高度
	
	if(scroH >100){  //距离顶部大于100px时
		// alert("距离顶部大于100px");
	}
	if (contentH - (scroH + viewH) <= 40){  //距离底部高度小于100px
		// alert("距离底部小于100px");
		loadXMLDoc(document.getElementById('reload').className,2)
		getType();
	}
	if (contentH == (scroH + viewH)){  //滚动条滑到底部啦

	}
	
});

$(document).ready(
	function () {
		
		$('#shopcar').click(
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
		
		//商品HOVER
		$(".product_category").hover(
			function () {
				$(".category").stop().slideDown("slow");
			},
			function () {
			}
		);
		$(".category").hover(
			function () {
			},
			function () {
				$(".category").stop().slideUp("slow");
			}
		);
		
		
		
		
		$("#category1").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==1){
						$(".category1").show("slow");
					}else
						$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category1").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category2").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==2){
						$(".category2").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category2").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category3").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==3){
						$(".category3").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category3").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category4").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==4){
						$(".category4").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category4").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category5").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==5){
						$(".category5").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category5").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category6").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==6){
						$(".category6").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category6").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category7").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==7){
						$(".category7").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category7").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category8").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==8){
						$(".category8").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category8").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category9").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==9){
						$(".category9").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category9").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category10").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==10){
						$(".category10").show("slow");
					}else
					$(".category"+i).hide("slow");
				}
			},
			function () {
			}
		);
		$(".category10").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).hide("slow");
				}
			}
		);
		$("#category11").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==11){
						$(".category11").fadeIn("slow");
					}else
					$(".category"+i).fadeOut("slow");
				}
			},
			function () {
			}
		);
		$(".category11").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).fadeOut("slow");
				}
			}
		);
		$("#category12").hover(
			function () {
				for (var i=1;i<=12;i++){
					if(i==12){
						$(".category12").fadeIn("slow");
					}else
					$(".category"+i).fadeOut("slow");
				}
			},
			function () {
			}
		);
		$(".category12").hover(
			function () {
			},
			function () {
				for (var i=1;i<=12;i++){
					$(".category"+i).fadeOut("slow");
				}
			}
		);
		
		$("#category_hide").click(
			function () {
				$("#category").slideUp('slow');
				$("#category_hide").hide('fast');
			}
		);
		
		
		
		
		
	}
);