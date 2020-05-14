var app = new Vue({
	el:'.main',
	data:function(){
		return {
			product: {
				//商品数量
				count: 1,
				//价格
				price: 0,
				//商品id
				product_id: 0,
				//商品类型
				product_type: "",
			},
			//购物车数量
			shopnum: 0,
			//控制数量加减按钮的disable，如果为1就不能按减号按钮，为99不能按加号按钮
			isabled: [false, false],
			msg: ""
		}
	},
	methods:{
		//数量加号按钮功能
		addCount:function () {
			if (parseInt(this.product.count) >= 99) {
				this.isabled[1] = true;
			} else {
				this.product.count = parseInt(this.product.count) + 1;
			}
			this.isabled[0] = false;
			
		},
		//数量减号按钮功能
		cutCount:function () {
			if (parseInt(this.product.count) <= 1) {
				this.isabled[0] = true;
			} else {
				this.product.count = parseInt(this.product.count) - 1;
			}
			this.isabled[1] = false;
			
		},
		//检查购买输入框是否违法
		check:function () {
			var reg = /[A-Za-z\u4e00-\u9fa5+\-!@#$%^&*()_=\\'";:/?.>,<，。、、‘；“：|？》《——}{【】\[\]  ）（\n]/;
			if (this.product.count.toString().match(reg) || parseInt(this.product.count) < 0) {
				this.product.count = 1;
			}
			if (parseInt(this.product.count) > 99) {
				this.count = 99;
			}
		},
		//检查购买数量是否为空
		checkAnother:function() {
			if (this.product.count == '') {
				this.product.count = 1;
			}
		},
		//加入购物车
		addShopNum:function () {
			if ($('#isLogin').val() == "no") {
				if (confirm("你暂未登录，无法加入购物车，是否登录？")) {
					location.assign('../HTML/logoin.php');
				}
			} else {
				if (confirm("你确定要加入购物车吗？")) {
					$.ajax({
						url: "../PHP/insert_shopcar.php",
						type: "post",
						data: {"Product": this.product, "Shopnum": this.shopnum},
						success: function (result) {
							console.log(result);
							$('.shopcar_msg').html(result);
						},
						error: function (xhr, status, p3) {
							// var err = "Error:" + status + "/" + p3;
							// alert(err);
						}
					});
				}
			}
		},
		//显示，隐藏更多评论
		hideMessage:function () {
			if($('#isLogin').val()==="yes"){
				$('.reply').slideToggle('fast');
				$('.tipOfReply').slideToggle('fast');
				$('.huifus').slideUp('fast');
				$('.huifu').slideUp('fast');
			}else{
				if(confirm("您暂未登录，不能查看详情哦，点击确定去登陆吧！！！")){
					location.assign("../HTML/logoin.php");
				}
			}
		
		}
		
	}
});
