<?php
require 'conn.php';
echo "<script>alert('暂未开通');location.assign('{$_SERVER['HTTP_REFERER']}')</script>";
?>
