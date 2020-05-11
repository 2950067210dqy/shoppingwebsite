<?php
switch ($_GET['id']) {
    case "index_signin":
        echo "<script>location.assign(\"../HTML/signin.php\");</script>";
        exit;
        break;
    case "index_logoin" :
        echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
        exit;
        break;
    case "index_user":
        echo "<script>location.assign(\"../HTML/user.php\");</script>";
        exit;
        break;
    default:
        echo "<script type='text/javascript'>alert('功能暂未开放');location.assign('../HTML/index.php');</script>";
}
?>
