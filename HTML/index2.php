<?php session_start();
require ("../PHP/conn.php");
date_default_timezone_set('PRC');//临时设置中国时区
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <link href="../CSS/index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../JS/index.js">
    </script>
</head>
<body onload="lunbostart()">
<!-- 灯笼1 -->
<div class="deng-box">
    <div class="deng">
        <div class="xian"></div>
        <div class="deng-a">
            <div class="deng-b"><div class="deng-t">节</div></div>
        </div>
        <div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
    </div>
</div>

<!-- 灯笼2 -->
<div class="deng-box1" >
    <div class="deng">
        <div class="xian"></div>
        <div class="deng-a">
            <div class="deng-b"><div class="deng-t">春</div></div>
        </div>
        <div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
    </div>
</div>
<div class="main" >
    <div class="topnav">
        <div class="topnavin">
            <div class="place" onclick="">
                <a href="#">九江市</a>
            </div>
            <div class="nav">
                <ul class="topnavul">
                    <li >
                        总访问量<span class="visitsum" id="visitsum">
                            <?php

                            //数字输出网页计数器
                            $row = selectAllNoWhere("count",1,$conn);
                            $count=(int)$row['num'];
                            $count++;
                            echo $count;
                            if(updateOne("count","num",(string)$count,"num",$row['num'],$conn))
                            ?>


                        </span>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li>
                        <?php
                        echo  date('Y-m-d', time());
                        ?>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">  更多</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">   手机版</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">   客户服务</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">  会员俱乐部</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">   我的特卖</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">    我的订单</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li >
                        <a href="../PHP/indexLocation.php">   签到有礼</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li>
                        <a href="../PHP/indexLocation.php? id=index_signin">   注册</a>
                    </li>
                    <li style="color: rgb(157,157,157); font-weight: bold">
                        /
                    </li>
                    <li>
                        <?php

                        if((isset($_SESSION['logoin'])&&!empty($_SESSION['logoin'])||isset($_SESSION['superlogoin'])&&!empty($_SESSION['superlogoin']))){
                            echo "<a href=\"../PHP/indexLocation.php? id=index_user\" >{$_SESSION['name']},你好</a>";
                        }
                        else{
                            echo '<a href="../PHP/indexLocation.php? id=index_logoin" >请登录</a>';
                        }
                        ?>


                    </li>
                    <li>
                        <?php
                        if((isset($_SESSION['logoin'])&&!empty($_SESSION['logoin'])||isset($_SESSION['superlogoin'])&&!empty($_SESSION['superlogoin']))){
                            echo "<img src=\"{$_SESSION['headimg']}\" width='20' height='20' alt='无头像' style='border-radius: 15px;' \">";
                        }
                        ?>


                    </li>

                </ul>
            </div>
        </div>
    </div>


    <div style="width: 100%;height: 110px;">
        <div class="logo_search">
            <div class="logoleft">
                <a href="#" >
                    <img height="100" src="../IMG/logo.png" alt="唯品会">
                </a>
            </div>
            <div class="logoright">
                <a href="#" >
                    <img height="60"  width="90" src="../IMG/logo2.png" alt="100%正品">
                </a>
                <a href="#" >
                    <img height="60"  width="90" src="../IMG/logo3.png" alt="七天放心">
                </a>
                <a href="#" >
                    <img height="60"  width="90" src="../IMG/logo4.png" alt="3亿会员">
                </a>


            </div>
            <div style="margin-top: 25px">
                <div class="search">
                    <div class="searchinput_shopcarinput">
                        <form action="../PHP/server.php" method="post">
                            <input type="text" max="10" placeholder="请输入你要查找的商品" name="searchtext">
                            <input type="submit" name="search"  value="">
                    <span class="shopcar">
                        <a href="#">
                            <span class="shopcar_img"><img src="../IMG/shopcar.png" width="25" height="25"> </span>
                            <span class="shopcar_word">购物车</span>
                            <span class="shopcar_msg">0</span>
                        </a>
                    </span>

                        </form>
                    </div>
                </div>
                <!-- recommend 为推荐的意思-->
                <div class="recommend">
                    <ul>
                        <li>
                            <a href="#">
                                女靴
                            </a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="#">
                                皮衣/皮草
                            </a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="#">
                                女士羽绒服
                            </a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="#"  style="color:  rgb(250,42,131)">
                                斯维奇
                            </a>
                        </li>
                        <li>
                            |
                        </li>
                        <li >
                            <a href="#" style="color: rgb(250,42,131)">
                                年终预付&nbsp;&nbsp;一件免邮
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>



    <div class="menu">
        <div style=" width: 70%;height: 100%;margin: 0 auto;">
            <a href="#" style=" background: rgb(241,1,128)">
                <div class="menu_category">

                      <span style="background-color: rgb(241,1,128);color: white;font-size: 13px;height: 100%">
                            商品分类
                      </span>

                    <!-- category 为商品分类，此DIV是鼠标移到商品分类时显现的效果-->
                    <div class="category">
                        <ul>
                            <li>
                                <a href="#">
                                    商品分类
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    女装/
                                </a>
                                <a href="#">
                                    男装
                                </a>
                                <a href="#">
                                    /内衣
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    女鞋/
                                </a>
                                <a href="#">
                                    男鞋
                                </a>
                                <a href="#">
                                    /箱包
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    护肤彩妆/
                                </a>
                                <a href="#">
                                    个护
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    运动户外
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    家电数码
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    母婴童装
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    手表配饰
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    居家用品
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    唯美生活
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    唯品国际/
                                </a>
                                <a href="#">
                                    唯品奢
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    医药健康
                                </a>
                            </li>
                            <li>
                                &nbsp;
                            </li>
                        </ul>
                    </div>



                </div>
            </a>
            <ul class="menuul">
                <li style="margin-left:40px;">
                    <a href=" #" style="color: rgb(241,1,128); font-weight: bold" >
                        首页
                    </a>
                </li>
                <li>
                    <a href="#">
                        12.12预付
                    </a>
                </li>
                <li>
                    <a href="#">
                        最后疯抢
                    </a>
                </li>
                <li>
                    <a href="#">
                        唯品快抢
                    </a>
                </li>
                <li>
                    <a href="#">
                        女装
                    </a>
                </li>
                <li>
                    <a href="#">
                        母婴
                    </a>
                </li>
                <li>
                    <a href="#">
                        家电
                    </a>
                </li>
                <li>
                    <a href="#">
                        国际
                    </a>
                </li>
                <li>
                    <a href="#">
                        美妆
                    </a>
                </li>
                <li>
                    <a href="#">
                        鞋包
                    </a>
                </li>
                <li>
                    <a href="#">
                        预告
                    </a>
                </li>
                <li>
                    <a href="#">
                        更多
                    </a>
                </li>



            </ul>
        </div>
    </div>












    <div class="banner_lunbo">
        <div class="lunbo" >
            <ul style="left: 0px" id="lunboimg">
                <li>
                    <img src="../IMG/luobo.png" width="1065px" height="395px" alt="超享优惠" >
                </li>
                <li>
                    <img src="../IMG/luobo2.png"   width="1065px" height="395px"  alt="双十二">
                </li>
            </ul>
        </div>
    </div>





    <div style=" ">
        <div class="information">


            <div class="lunboextend">
                <div class="huakuai">
                    <a href="#"  id="lunbo1button" onmousemove="lunbobutton(this.id)" >
                        <div class="huakuaileft" style=" border-bottom: 5px solid  rgb(241,1,128)" >
                            <span>12.8预付抢先定</span>
                        </div>
                    </a>
                    <a href="#"  id="lunbo2button" onmousemove="lunbobutton(this.id)">
                        <div class="huakuairight" style=" border-bottom: none" >
                            菲尼迪品牌特卖日&nbsp;全场五折
                        </div>
                    </a>
                </div>
            </div>


            <a href="#">
                <div class="onsaleimg">
                </div>
            </a>

            <div style="width: 100%; height: 350px; margin: 0 auto;">
                <a href="#">
                    <div class="onsaleimg2">

                    </div>
                </a>
                <a href="#">
                    <div class="onsaleimg3">

                    </div>
                </a>

                <a href="#">
                    <div class="onsaleimg4">

                    </div>
                </a>
            </div>

            <div style="width: 100%;height: 100px;margin-top: 12%" >


            </div>


            <div class="bjtop">
                <div class="bj1">
                    <a href="#">
                        <img src="../IMG/bj1_1.jpg">
                    </a>
                    <a href="#">
                        <img src="../IMG/bj1_2.jpg">
                    </a>
                    <a href="#">
                        <img src="../IMG/bj1_3.jpg">
                    </a>
                    <div class="bj1word">
                        <span style="border-radius: 25%;background-color:rgb(241,1,128);color: white;font-size: 13px;margin-left: 30px">疯狂抢</span>
                        <span style="color: black;font-size: 14px;margin-left: 2px;font-weight: bold">InJu￥299</span>
                        <span style="border-radius: 25%;background-color:rgb(241,1,128);color: white;font-size: 13px;margin-left: 25px">疯狂抢</span>
                        <span style="color: black;font-size: 14px;margin-left: 2px;font-weight: bold">victory&vera￥1640</span>
                        <span style="border-radius: 25%;background-color:rgb(241,1,128);color: white;font-size: 13px;margin-left: 18px">疯狂抢</span>
                        <span style="color: black;font-size: 14px;margin-left: 2px;font-weight: bold">LAPORA￥149</span>
                    </div>
                </div>
                <div class="bj2">
                    <a href="#">
                        <img src="../IMG/bj2_1.jpg">
                    </a>
                    <a href="#">
                        <img src="../IMG/bj2_2.jpg">
                    </a>
                    <a href="#">
                        <img src="../IMG/bj2_3.jpg">
                    </a>
                    <div class="bj2word">

                        <span style="color: rgb(48,48,48);font-size: 13px;margin-left: 70px;text-align: center;background-color: rgb(242,242,242);font-weight: bold">
                            女靴</span>

                        <span style="color: rgb(48,48,48);font-size: 13px;margin-left: 120px;text-align: center;background-color: rgb(242,242,242);font-weight: bold">
                            女童羽绒服</span>

                        <span style="color: rgb(48,48,48);font-size: 13px;margin-left: 80px;text-align: center;background-color: rgb(242,242,242);font-weight: bold">
                            婴幼羽绒服/棉服</span>
                    </div>
                </div>
            </div>
            <div class="bjtbottom">
                <a href="#">
                    <img src="../IMG/bj3_1.jpg">
                </a>
                <a href="#">
                    <img src="../IMG/bj3_2.jpg">
                </a>
                <a href="#">
                    <img src="../IMG/bj3_3.jpg">
                </a>
                <a href="#">
                    <img src="../IMG/bj3_4.jpg">
                </a>
                <a href="#">
                    <img src="../IMG/bj3_5.jpg">
                </a>
                <a href="#">
                    <img src="../IMG/bj3_6.jpg">
                </a>
                <div class="bj3word">
                    <span  style="color: black;font-size: 14px;margin-left: 50px;font-weight: bold">完美日记￥59</span>
                    <span  style="color: black;font-size: 14px;margin-left: 100px;font-weight: bold">优理氏￥89</span>
                    <span  style="color: black;font-size: 14px;margin-left:  80px;font-weight: bold">ZMC植美村￥58</span>
                    <span  style="color: black;font-size: 14px;margin-left:  90px;font-weight: bold">LOVO￥69</span>
                    <span  style="color: black;font-size: 14px;margin-left:  80px;font-weight: bold">BIOEDRMA￥159</span>
                    <span style="color: black;font-size: 14px;margin-left:  80px;font-weight: bold">精选品牌￥79</span>
                </div>
            </div>


        </div>




        <div class="footer">
            <div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
                Copyright &nbsp;©  &nbsp;
                2019-2020  &nbsp; qinyou.com， &nbsp;All  &nbsp;Rights &nbsp; Reserved &nbsp;
                使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
                <br>
                九江学院 20180101981号 &nbsp;   赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
                <br>
                自营主体经营证照（暂无）  &nbsp; 风险监测信息（暂无）  &nbsp; 互联网药品信息服务资格证书：（暂无）-学习性-（暂无）&nbsp; 网络交易第三方平台备案凭证：（暂无）
                <br>
                亲爱的学生老师，九江警方反诈劝阻电话“962110”系专门针对避免您财产被骗受损而设，请您一旦收到来电，立即接听。
                <br>
                公司名称：江西九江沁柚有限公司 | 公司地址：江西省九江市濂溪区九江学院主校区 | 电话：159-7067-4596
                <br>
                注明：本网站为学生于2019年12月制作的PHP大作业，未经本人同意请勿擅自将此网站商用,否则后果自负
            </div>
        </div>
    </div>
</div>



</body>
</html>