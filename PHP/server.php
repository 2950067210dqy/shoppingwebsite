<?php
header("content-type:text/html;charset=utf8");
//搜索
if(isset($_POST['search'])){
    if($_POST['searchtext']=="登录"){
        echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
    }
    elseif ($_POST['searchtext']=="注册"){
        echo "<script>location.assign(\"../HTML/signin.php\");</script>";
    }
    else{
        echo '<script type="text/javascript">alert("输入无效");
                location.assign("../HTML/index.php");</script>';
    }
}

?>





