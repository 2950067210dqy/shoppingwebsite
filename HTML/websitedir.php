<?php
require_once '../PHP/conn.php';
header("content-type:text/html;charset=utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index</title>
	<link rel="icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon" href="//www.bilibili.com/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="//static.hdslb.com/mobile/img/512.png">
	
	<script type="text/javascript" src="../JSLIB/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="../JSLIB/vue.js"></script>
	<script type="text/javascript" src="../JSLIB/vue-router.js"></script>
	<script type="text/javascript" src="../JSLIB/jquery-1.11.3.min.js"></script>
	<script src="../JSLIB/bootstrap.js"></script>
	<!--	引用框架-->
	<link href="../CSSLIB/bootstrap.css" rel="stylesheet">
	
	
	<link href="../CSS/index.css" rel="stylesheet" type="text/css">
	<style>
		table th {
			text-align: center;
			}
	</style>

</head>
<script src="../JS/index_jquery.js"></script>
<body>
<div class="main"
     style="background-image: url('../IMG/banner2.jpg');background-size: cover;background-repeat: no-repeat">
	
	
	<?php require_once 'top.php'; ?>
	
	
	<div class="infomation" style="opacity:0.7;">
		<p class="text-center" style="border-bottom: 3px black solid"><span style="font-size: 33px">沁柚网网站文件信息</span></p>
		<?php
		$dirnav = "";
		$num = 0;
		$dir = "";
		$dirname = "";
		if (isset($_GET['file']) && isset($_GET['lastdirname'])) {
			$dir = "../../{$_GET['lastdirname']}/{$_GET['file']}";
			$dir = iconv("UTF-8" , "gbk" , $dir);
			$dirname = substr(iconv("gbk" , "UTF-8" , $dir) , 6);
		} else {
			$dir = '../../phpproject2';
			$dir = iconv("UTF-8" , "gbk" , $dir);
			$dirname = substr(iconv("gbk" , "UTF-8" , $dir) , 6);
		}
		$dirh = opendir($dir);
		?>
		<table border="1" width="600" class="table table-hover table-bordered table-responsive text-center">
			<tr align="left" bgcolor="#cccccc">
				<th>
					序号
				</th>
				<th>
					所在文件目录
				</th>
				<th>
					文件名
				</th>
				<th>
					大小(字节)
				</th>
				<th>
					类型
				</th>
				<th>
					创建时间
				</th>
				<th>
					修改时间
				</th>
			</tr>
			<?php
			
			while ($file = readdir($dirh)) {
				
				if ($file != '.' && $file != "..") {
					$dirfile = $dir . "/" . $file;
					$num ++;
					$file = iconv("gbk" , "UTF-8" , $file);
					$filesize = filesize($dirfile);
					$filetype = filetype($dirfile);
					$fileupdatetime = date("Y-m-d h:m:s" , filemtime($dirfile));
					$filecreatetime = date("Y-m-d h:m:s" , filectime($dirfile));
					echo "<tr bgcolor='#1e90ff'>";
					echo "<td>$num</td>";
					echo "<td>$dirname</td>";
					if ($filetype === "dir") {
						echo "<td><a href='websitedir.php?file={$file}&lastdirname={$dirname}'>$file</a></td>";
					} else {
						echo "<td>$file</td>";
					}
					echo "<td>{$filesize}</td>";
					echo "<td>$filetype</td>";
					echo "<td>$filecreatetime</td>";
					echo "<td>$fileupdatetime</td>";
					echo "	</tr>";
					clearstatcache();
				}
			}
			closedir($dirh);
			?>
			<caption class="text-left"><span style="margin-left: 10%">注意:filesize（）不会告诉您目录中所有文件的大小，只是告诉您目录本身的大小。</span>
			</caption>
			<caption class="text-right"><a
						href="websitedir.php">返回最初目录</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php if (isset($_GET['file']) && isset($_GET['lastdirname'])) echo "<a class=\"\" href=\"{$_SERVER['HTTP_REFERER']}\">返回上次浏览的文件目录</a>"; ?>
			                                            &nbsp;&nbsp;&nbsp;&nbsp;
			</caption>
			<caption class="text-center"><b>目录<?php echo $dirname ?>中的内容</b></caption>
		</table>
		<div class="text-center">
			<span>在<b><?php echo $dirname ?></b>目录下的子目录和文件共有<b><?php echo $num ?>个</b></span>
		</div>
	</div>
	
	<div class="footer">
		<div style="color: #ababab;background-color:  rgb(246,249,250);text-align: center;margin: 0 auto;font-size: 13px">
			Copyright &nbsp;© &nbsp;
			2019-2020 &nbsp; qinyou.com， &nbsp;All &nbsp;Rights &nbsp; Reserved &nbsp;
			使用本网站即表示接受 &nbsp; 沁柚用户协议。版权所有 &nbsp; 九江学院31栋503沁柚工作室 邓亲优
			<br>
			九江学院 20180101981号 &nbsp; 赣ICP备（暂无） &nbsp;增值业务经营许可证： （暂无）&nbsp;网络文化经营许可证：（暂无）
			<br>
			自营主体经营证照（暂无） &nbsp; 风险监测信息（暂无） &nbsp; 互联网药品信息服务资格证书：（暂无）-学习性-（暂无）&nbsp; 网络交易第三方平台备案凭证：（暂无）
			<br>
			亲爱的学生老师，九江警方反诈劝阻电话“962110”系专门针对避免您财产被骗受损而设，请您一旦收到来电，立即接听。
			<br>
			公司名称：江西九江沁柚有限公司 | 公司地址：江西省九江市濂溪区九江学院主校区 | 电话：159-7067-4596
			<br>
			注明：本网站为学生于2019年12月制作的PHP大作业，未经本人同意请勿擅自将此网站商用,否则后果自负
		</div>
	</div>

</div>
</body>
</html>