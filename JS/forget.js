function check(name) {
    var password =document.getElementById('password').value;
    var passwordagain =document.getElementById('passwordagain').value;
 switch (name) {
     case "password":
         var str=password.toString();
         if(str.length<6){
             document.getElementById('alter').value = "密码格式错误，错误原因：密码必须为6-12位";
         }
         else{
             document.getElementById('alter').value= "修改";
             //将按钮变为可点击状态
             checkall();
         }
         if(str.length==0){
             document.getElementById('alter').value= "请输入数据";
         }
         break;
     case "passwordagain":{
         var str = password.toString();
         var str2 =passwordagain.toString();
         if(str==str2){
             document.getElementById('alter').value = "修改";
             //将按钮变为可点击状态
             checkall();
         }
         else{
             document.getElementById('alter').value = "两次密码不一样";
         }
         if(str2.length==0){
             document.getElementById('alter').value = "请输入数据";
         }
         break;
     }

 }
}
function checkall() {
    var password =document.getElementById('password').value;
    var passwordagain =document.getElementById('passwordagain').value;
    var alter = document.getElementById('alter').value;
    if( password.length!=0&&
        passwordagain.length!=0&&
        alter.length!=0
    )
    {

        document.getElementById('alter').value="确定修改";
        document.getElementById('alter').removeAttribute("disabled");

    }
    else{
        document.getElementById('alter').value="输入错误";
    }
}