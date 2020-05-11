<?php
switch ($_GET['id']) {
    case "logoin_signin":
        echo "<script>location.assign(\"../HTML/signin.php\");</script>";
        exit;
        break;
    case "logoin_forgetpassword":
        echo "<script>location.assign(\"../HTML/forget.php\");</script>";
        exit;
        break;
    case "logoin_user":
        echo "<script>location.assign(\"../HTML/user.php\");</script>";
        exit;
        break;
    case "index_back":
        echo "<script>location.assign(\"../HTML/index.php\");</script>";
        exit;
        break;
    case "logoin_logoin":
        echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
        exit;
        break;
}
?>
