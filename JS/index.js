$(document).ready(
    function () {
        /*定义位置：由于图片个数与下侧顺序按钮数量一致，可通过位置进行关联*/
        var index = 0;
        /*当鼠标放到顺序按钮上时：
		1.将当前这个顺序按钮增加样式为红色背景
		2.移除周围其他同级元素红色背景样式
		3.获取当前顺序按钮的index
		4.通过index获取该位置图片
		5.一秒钟渐入该图片
		6.一秒钟渐出其他相邻图片
		7.防止移动过快导致的效果闪现，使用stop方法
		*/
        $(".num li").mousemove(function () {
            $(this).addClass("current").siblings().removeClass("current");
            index = $(this).index();
            $(".img li").eq(index).stop().slideDown('fast').siblings().stop().slideUp('fast');
        });
        /*设置每一秒钟自动轮播：
		1.获取当前位置序号：自加操作；当超过图片最大序号时序号设置为0
		2.设置下侧顺序按钮及轮播图显示
		*/
        var time = setInterval(move1, 4000);
    
        function move1() {
            index++;
            if (index == 4) {
                index = 0
            }
            $(".num li").eq(index).addClass("current").siblings().removeClass("current");
            $(".img li").eq(index).stop().show("slow").siblings().stop().hide("slow");
        };
        /*当鼠标划入、划出轮播图区域时：
		1.划入时停止自动轮播
		2.划出时继续自动轮播
		*/
        $(".outer").hover(
            function () {
                clearInterval(time);
            },
            function () {
                time = setInterval(move1, 4000);
            });
        /*点击右侧按钮时执行*/
        $(".right_btn").click(function () {
            move1();
        });
    
        /*点击左侧按钮时执行*/
        function moveL() {
            index--;
            if (index == -1) {
                index = 3
            }
            $(".num li").eq(index).addClass("current").siblings().removeClass("current");
            $(".img li").eq(index).stop().show("slow").siblings().stop().hide("slow");
        }
    
        $(".left_btn").click(function () {
            moveL();
        });
    });
// function lunbostart(){
//
//     var a= setInterval(function() {lunbo();}, 4000);
//
//
//
//
// }
//
//
// function lunbo(){
//    var lunboimg=document.getElementById("lunboimg");
//     var huakuaileft =document.getElementsByClassName("huakuaileft");
//     var huakuairight =document.getElementsByClassName("huakuairight");
//
//     if(parseInt(lunboimg.style.left)>-1065)
//     {
//         var newleft=parseInt(lunboimg.style.left)-1065;
//         lunboimg.style.left=newleft+'px';
//      huakuaileft[0].style="border-bottom: none";
//         huakuairight[0].style="border-bottom: 5px solid  rgb(241,1,128)";
//     }
//
//     else{
//         lunboimg.style.left=0+'px';
//         huakuaileft[0].style="border-bottom: 5px solid  rgb(241,1,128)";
//         huakuairight[0].style="border-bottom: none";
//     }
// }
//
//
// function lunbobutton(id) {
//     var lunboimg=document.getElementById("lunboimg");
//     var huakuaileft =document.getElementsByClassName("huakuaileft");
//     var huakuairight =document.getElementsByClassName("huakuairight");
//     temp=0,temp2=0;
//     if(id=="lunbo1button"){
//         lunboimg.style.left=0+'px';
//         huakuaileft[0].style="border-bottom: 5px solid  rgb(241,1,128)";
//         huakuairight[0].style="border-bottom: none";
//     }
//    else if(id="lunbo2button"){
//
//         lunboimg.style.left=-1065+'px';
//         huakuaileft[0].style="border-bottom: none";
//         huakuairight[0].style="border-bottom: 5px solid  rgb(241,1,128)";
//     }
//
// }








