// var app = new Vue({
// 	el:'.main',
// 	data:function () {
// 		return{
// 			product:{
// 				//商品数量
// 				count: 1,
// 				//价格
// 				price: 0,
// 				//商品id
// 				product_id: 0,
// 				//商品类型
// 				product_type: "",
// 			},
// 			//购物车数量
// 			shopnum:0,
// 			allprice:0,
// 			finalprice:[],
// 			shopnum: 0,
// 			//控制数量加减按钮的disable，如果为1就不能按减号按钮，为99不能按加号按钮
// 			isabled: [false, false],
// 			msg: ""
// 		}
// 	},
// 	computed:{
// 		getAllprice:function(){
// 			this.allprice=this.product.price*this.product.count;
// 			this.finalprice.push(this.allprice);
// 			// alert(this.finalprice);
// 			return this.allprice;
// 		},
// 		getFinalprice:function () {
// 			var finalprice=0;
// 			for (var i=0;i<this.shopnum;i++){
// 				finalprice+=this.finalprice[i];
// 			}
// 			return finalprice;
// 		}
// 	},
// });