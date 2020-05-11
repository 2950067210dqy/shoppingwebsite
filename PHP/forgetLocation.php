<?php
switch ($_GET['id']) {
    case "logoin_back":
    case "forget_logoin":
		echo "<script>location.assign(\"../HTML/logoin.php\");</script>";
        exit;
        break;
    case "forget_user":
	    echo "<script>location.assign(\"../HTML/user.php\");</script>";
        exit;
        break;
    case "index_back":
	    echo "<script>location.assign(\"../HTML/index.php\");</script>";
        exit;
        break;
}
?>