/**
 * Created by syzx on 2019/12/10.
 */
//验证码
$(function () {
	//验证码
	let randomnum = [];
	drawCodeImg(randomnum);
	$(".security_code_img,#superadmin,#admin,#merchant").on('click', function () {
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
    switch (name) {
        case 'id':
            var str = document.getElementById('id').value.toString();
            if (document.getElementById('id').value == "") {
                document.getElementById('logoin').value = '帐号不能为空！';
            } else {
                checkall('admin');
            }
            if(str.length==0){
                document.getElementById('logoin').value = "请输入数据";
            }
            break;
        case 'password':
            var str=document.getElementById('password').value.toString();
            if(document.getElementById('password').value==""){
                document.getElementById('logoin').value='帐号不能为空！';
            }
            else{
                checkall('admin');
            }
            if(str.length==0){
                document.getElementById('logoin').value = "请输入数据";
            }
            break;
        case 'superid':
            var str=document.getElementById('superid').value.toString();
            if(document.getElementById('superid').value==""){
                document.getElementById('superlogoin').value='管理员帐号不能为空！';
            }
            else{
                checkall('superadmin');
            }
            if(str.length==0){
                document.getElementById('superlogoin').value = "请输入数据";
            }
            break;
        case 'superpassword':
            var str=document.getElementById('superpassword').value.toString();
            if(document.getElementById('superpassword').value==""){
                document.getElementById('superlogoin').value='管理员密码不能为空！';
            }
            else{
                checkall('superadmin');
            }
            if(str.length==0){
                document.getElementById('superlogoin').value = "请输入数据";
            }
            break;


    }
}
function checkall(type) {
    if(type =='admin') {
        var id = document.getElementById('id').value;
        var password = document.getElementById('password').value;
        if (id.length != 0 && document.getElementById('logoin').value == '登录' &&
            password.length != 0
        ) {

            document.getElementById('logoin').value = "确定登录";
            document.getElementById('logoin').removeAttribute("disabled");

        } else {
            document.getElementById('logoin').value = "登录";
        }
    }
    else if(type=='superadmin'){
        console.log("asdasd");
        var id = document.getElementById('superid').value;
        var password = document.getElementById('superpassword').value;
        if (id.length != 0 && document.getElementById('superlogoin').value == '登录' &&
            password.length != 0
        ) {
	
	        document.getElementById('superlogoin').value = "确定登录";
	        document.getElementById('superlogoin').removeAttribute("disabled");
	
        } else {
	        document.getElementById('superlogoin').value = "登录";
        }
    }
}

document.getElementById('superadmin').addEventListener('click', Alltab2);
document.getElementById('merchant').addEventListener('click', Alltab3);

function Alltab1() {
	tab('admin');
}

function Alltab2() {
	tab('superadmin');
}

function Alltab3() {
	tab('merchant');
}

function tab(name) {
	switch (name) {
		case "admin":
			
			document.getElementById('isadmin').value = 'false';
			document.getElementById('superadmin').style.borderBottom = "none";
			document.getElementById('merchant').style.borderBottom = "none";
			document.getElementById(name).style.borderBottom = " 5px solid  rgb(241,1,128)";
			document.getElementById(name).removeEventListener('click', Alltab1);
			document.getElementById('superadmin').addEventListener('click', Alltab2);
			document.getElementById('merchant').addEventListener('click', Alltab3);
			break;
		case "superadmin":
			document.getElementById('isadmin').value = 'true';
			document.getElementById('admin').style.borderBottom = "none";
			document.getElementById('merchant').style.borderBottom = "none";
			document.getElementById(name).style.borderBottom = " 5px solid  rgb(241,1,128)";
			document.getElementById(name).removeEventListener('click', Alltab2);
			document.getElementById('admin').addEventListener('click', Alltab1);
			document.getElementById('merchant').addEventListener('click', Alltab3);
			break;
		case "merchant":
			document.getElementById('isadmin').value = 'merchant';
			document.getElementById('admin').style.borderBottom = "none";
			document.getElementById('superadmin').style.borderBottom = "none";
			document.getElementById(name).style.borderBottom = " 5px solid  rgb(241,1,128)";
			document.getElementById(name).removeEventListener('click', Alltab2);
			document.getElementById('admin').addEventListener('click', Alltab1);
			document.getElementById('superadmin').addEventListener('click', Alltab2);
	}
	
	
}