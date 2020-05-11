<?php
switch ($_GET['id']) {
    case "user_logoin":
	    echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
        header("Location:../HTML/logoin.php");
        exit;
        break;
    case "user_user":
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