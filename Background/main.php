<?php
session_start();
if (!isset($_SESSION['username'])) {
	echo "<script>location.assign('../HTML/logoin.php')</script>";
}
//管理员前往管理员后台管理
if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 'true') {
	echo "<script>location.assign('../BackgroundAdmin/main.php')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>主页</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	<script>
		(function (doc, win) {
			var docEl = doc.documentElement,
				resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
				recalc = function () {
					var clientWidth = docEl.clientWidth;
					if (!clientWidth) return;
					if (clientWidth >= 640) {
						docEl.style.fontSize = '85px';
					} else {
						docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
					}
				};
			
			if (!doc.addEventListener) return;
			win.addEventListener(resizeEvt, recalc, false);
			doc.addEventListener('DOMContentLoaded', recalc, false);
		})(document, window);
	
	</script>
</head>

<frameset cols="14%,*">
	<frame src="left.php" name="left" noresize></frame>
	<frame src="right.php" name="right"></frame>
</frameset>

</html>

