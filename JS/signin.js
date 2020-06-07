$(function () {
	//验证码
	let randomnum = [];
	drawCodeImg(randomnum);
	$(".security_code_img").on('click', function () {
		drawCodeImg(randomnum);
	});
	
	$("#form").on('submit', function () {
		var inputcode = $('#security_code').val();
		var savecode = randomnum.join("");
		if (inputcode == savecode) {
			$('#security_code').val('');
			return true;
		} else {
			alert('验证码错误！');
			$('#security_code').val('');
			drawCodeImg(randomnum);
			return false;
		}
	});
	
	function drawCodeImg(randomnums) {
		$(".security_code_img").html('');
		for (let i = 0; i < 4; i++) {
			let num = Math.floor(Math.random() * 10);
			randomnums[i] = num;
			$(".security_code_img").html($(".security_code_img").html() + "<img src='../IMG/" + num + ".png' width='30' height='40'>");
		}
	}
	
	
});


function check(name) {
	
	var id = document.getElementById('id').value;
	var email = document.getElementById('email').value;
	var phone = document.getElementById('phone').value;
	var yourname = document.getElementById('name').value;
	// var sex=document.getElementById('sex').value;
	var invitecode = document.getElementById('invitecode').value;
	var password = document.getElementById('password').value;
	var passwordagain = document.getElementById('passwordagain').value;
	// var idwarn = document.getElementById('idwarn').innerText;
	// var emailwarn =document.getElementById('emailwarn').innerText;
	// var phonewarn =document.getElementById('phonewarn').innerText;
	// var yournamewarn =document.getElementById('namewarn').innerText;
	// var sexwarn =document.getElementById('sexwarn').innerText;
	// var invitecodewarn =document.getElementById('invitecodewarn').innerText;
	// var passwordwarn =document.getElementById('passwordwarn').innerText;
	// var passwordagainwarn =document.getElementById('passwordagainwarn').innerText;
	switch (name) {
		case "id" :
			var str = id.toString();
			if (str.indexOf("0") == -1
				&&
				str.indexOf("1") == -1
				&&
				str.indexOf("2") == -1
				&&
				str.indexOf("3") == -1
				&&
				str.indexOf("4")==-1
				&&
				str.indexOf("5")==-1
				&&
				str.indexOf("6")==-1
				&&
				str.indexOf("7")==-1
				&&
				str.indexOf("8")==-1
				&&
				str.indexOf("9")==-1
			) {
				
				if (str.length < 4) {
					document.getElementById('idwarn').innerText = "账号必须为4位以上哦！";
				} else {
					document.getElementById('idwarn').innerText = "";
					//将按钮变为可点击状态
					checkall();
				}
			} else{
				document.getElementById('idwarn').innerText = "账号必须为字母或符号哦！";
			}
			if(str.length==0){
				document.getElementById('idwarn').innerText = "请输入数据";
			}
			break;
		case "email":
			
			var str=email.toString();
			//首位不能是@
			if(str.charAt(0)!="@") {
				//@只出现1次
				if (str.split("@").length == 2) {
					//@后面不能直接接"."
					if (str.substring(str.indexOf("@") + 1, str.indexOf("@") + 2).indexOf(".") == -1) {
						//.可以出现1或2次
						if (str.split(".").length == 3 || str.split(".").length == 2) {
							//字符串末尾检索com/cn/net，并且他们的位置必须在末尾
							if (str.lastIndexOf("com") == str.length - 3 || str.lastIndexOf("cn") == str.length - 2 ||
								str.lastIndexOf("net") == str.length - 3) {
								document.getElementById('emailwarn').innerText = "";
								//将按钮变为可点击状态
								checkall();
							} else {
								document.getElementById('emailwarn').innerText = "邮箱格式错误，错误原因：末尾必须为com/net/cn";
							}
						} else {
							document.getElementById('emailwarn').innerText = "邮箱格式错误，错误原因：“.”必须且只能出现1次或2次";
						}
					} else {
						document.getElementById('emailwarn').innerText = "邮箱格式错误，错误原因：“@”后面一位不能出现“.”";
					}
				}else {
					document.getElementById('emailwarn').innerText="邮箱格式错误，错误原因：“@”必须且只能出现1次";
				}
			} else{
				document.getElementById('emailwarn').innerText="邮箱格式错误，错误原因：“@”不能出现在邮箱第一位";
			}
			if(str.length==0){
				document.getElementById('emailwarn').innerText = "请输入数据";
			}
			break;
		case "phone":
			var str=phone.toString();
			//第一位必须是1
			if(str.charAt(0)=="1") {
				//必须为11位
				if (str.length < 11) {
					document.getElementById('phonewarn').innerText = "电话号码错误，错误原因：电话号码应为11位";
				} else {
					document.getElementById('phonewarn').innerText = "";
					//将按钮变为可点击状态
					checkall();
				}
			}else{
				document.getElementById('phonewarn').innerText = "电话号码错误，错误原因：电话号码第一位应是1";
			}
			if(str.length==0){
				document.getElementById('phonewarn').innerText = "请输入数据";
			}
		case "name":
			//将按钮变为可点击状态
			checkall();
			if(yourname.length==0){
				document.getElementById('namewarn').innerText = "请输入数据";
			} else{
				document.getElementById('namewarn').innerText = "";
			}
			break;
		case "sex":
			document.getElementById('sex').innerHTML=' <option value="男">男</option>\n' +
				'  <option value="女">女</option>\n' ;
			document.getElementById('sexwarn').innerText="";
			break;
		case "invitecode":
			var str=invitecode.toString();
			if(str.length<4){
				document.getElementById('invitecodewarn').innerText = "邀请码错误，错误原因：邀请码为4位";
			} else{
				document.getElementById('invitecodewarn').innerText = "";
				//将按钮变为可点击状态
				checkall();
			}
			if(str.length==0){
				document.getElementById('invitecodewarn').innerText = "";
			}
			break;
		case "password":
			var str=password.toString();
			if(str.length<6){
				document.getElementById('passwordwarn').innerText = "密码格式错误，错误原因：密码必须为6-12位";
			} else{
				document.getElementById('passwordwarn').innerText = "";
				//将按钮变为可点击状态
				checkall();
			}
			if(str.length==0){
				document.getElementById('passwordwarn').innerText = "请输入数据";
			}
			break;
		case "passwordagain":{
			var str = password.toString();
			var str2 =passwordagain.toString();
			if(str==str2){
				document.getElementById('passwordagainwarn').innerText = "";
				//将按钮变为可点击状态
				checkall();
			} else{
				document.getElementById('passwordagainwarn').innerText = "两次密码不一样";
			}
			if(str2.length==0){
				document.getElementById('passwordagainwarn').innerText = "请输入数据";
			}
			break;
		}
		case "career":
			document.getElementById('career').innerHTML=' <option value="老师">老师</option>\n' +
				'  <option value="学生">学生</option>\n' +
				'  <option value="其他">其他</option>';
			break;
		
		default:
			break;
	}
}
//将按钮变为可点击状态
function checkall() {
	var id = document.getElementById('id').value;
	var email =document.getElementById('email').value;
	var phone =document.getElementById('phone').value;
	var yourname =document.getElementById('name').value;
	var sex=document.getElementById('sex').value;
	var invitecode =document.getElementById('invitecode').value;
	var password =document.getElementById('password').value;
	var passwordagain =document.getElementById('passwordagain').value;
	var idwarn = document.getElementById('idwarn').innerText;
	var emailwarn =document.getElementById('emailwarn').innerText;
	var phonewarn =document.getElementById('phonewarn').innerText;
	var yournamewarn =document.getElementById('namewarn').innerText;
	var sexwarn =document.getElementById('sexwarn').innerText;
	var invitecodewarn =document.getElementById('invitecodewarn').innerText;
	var passwordwarn =document.getElementById('passwordwarn').innerText;
	var passwordagainwarn =document.getElementById('passwordagainwarn').innerText;
	if(id.length!=0&&idwarn.length==0&&
		email.length!=0&&emailwarn.length==0&&
		phone.length!=0&&phonewarn.length==0&&
		yourname.length!=0&&yournamewarn.length==0&&
		sex.length!=0&&sexwarn.length==0&&
		invitecodewarn.length==0&&
		password.length!=0&&passwordwarn.length==0&&
		passwordagain.length!=0&&passwordagainwarn.length==0
	) {
		
		document.getElementById('signin').value="确定注册";
		document.getElementById('signin').removeAttribute("disabled");
		
	} else{
		document.getElementById('signin').value="当前还有信息未输入或输入错误";
	}
	
	
}

