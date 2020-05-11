<?php
switch ($_GET['id']) {
    case "user_back":
    case "adminwatchall_user":
        echo "<script>location.assign(\"../HTML/user.php\");</script>";
        break;
    case "adminwatchall_logoin":
	    echo "<script>alert(1);location.assign(\"../HTML/logoin.php\");</script>";
        break;
    case "index_back":
	    echo "<script>location.assign(\"../HTML/index.php\");</script>";
        break;
    default:
        echo "erro".$_GET['id'];
}
?>