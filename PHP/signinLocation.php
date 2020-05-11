<?php
switch ($_GET['id']) {
    case "logoin_back":
    case "signin_logoin":
        echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
        exit;
        break;
    case "signin_user":
        echo "<script>location.assign(\"../HTML/user.php\");</script>";
        exit;
        break;
    case "index_back":
        echo "<script>location.assign(\"../HTML/index.php\");</script>";
//        header("Location:../HTML/index.php");
        exit;
        break;
}
?>
