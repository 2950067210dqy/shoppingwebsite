<?php
require '../PHP/conn.php';
//	评论区楼层
$postid=1;
$postinid=1;
$id=$_GET['id'];
$limit=$_GET['limit'];
?>
<?PHP
//		查找一级评论
$sql="select * from user,diary where user.id=diary.user_id and boy_clothes_id=$id limit $limit,5 ";
$result=$conn->query($sql);
if($result->num_rows>0){
	while ($row=$result->fetch_assoc()) {
		?>
		<!--				一级评论-->
		<div class="Media">
			<img class="Media-figure" src="<?php echo $row['img_addr']?>" alt="默认头像"width="100" height="100">
			<!--				一级评论区楼层-->
			<font color="#808080"><?php echo "#$postid&nbsp;&nbsp;&nbsp;&nbsp;";?></font>
			<?php
			//					检测是否为管理员
			if($row['isadmin']=='true') {
				if(isset($_SESSION['id'])&&$row['user_id']==$_SESSION['id']){
					echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
				}
				else{
					echo "<font color='red' size='4'>[管理员]</font>{$row['name']}({$row['username']}):";
				}
				
			}
//					检测是否为当前用户
			elseif(isset($_SESSION['id'])&&$row['user_id']==$_SESSION['id']){
				echo "<font color='#8a2be2' size='4'>[自己]</font>{$row['name']}({$row['username']}):";
			}
			else{
				echo "{$row['name']}({$row['username']}):";
			}
			?>
			<p class="Media-body">
				<?php echo $row['content']?>
				<!--								一级评论(删除评论按钮)(修改评论按钮)当为管理员或当前用户才会显示-->
				<?php
				if (isset($_SESSION['id'])&&($_SESSION['isadmin']=='true'||$row['user_id']==$_SESSION['id'])){
					echo "
<input  type='submit' value='X' onclick='location.assign(\"../PHP/deletePost.php?diary_id={$row['diary_id']}&reply=pinglun\");'>
<input  type='submit' value='修改' onclick='location.assign(\"../HTML/updatepost.php?diary_id={$row['diary_id']}&reply=pinglun&boy_clothes_id=$id&floor_id=$postid\")'>
";
				}
				?>
				<br>
				<br>
				<br>
				<span style="float: left">		<?php echo $row['time']?></span>
				<span style="float: right"> <input type="button" value="评论" class="setMessage" id="setMessage<?php echo $row['diary_id']?>" > </span>
			</p>
		</div>
		
		
		<?php
//		         查找多级评论		通过一级评论来查找是否有一级评论的回复评论
		$sql2=" select * from user u  join reply r on r.diary_id={$row['diary_id']} and r.user_id=u.id ";
		$result2=$conn->query($sql2);
		$row2=null;
		if($result2->num_rows>0) {
			echo "<p class=\"tipOfReply\"><a  @click=\"hideMessage\" href='javascript:void(0)'>--------该楼还有{$result2->num_rows}条评论，请点击查看详情--------</a></p>";
			while ($row2=$result2->fetch_assoc())
			{
				
				?>
				<!--				多级评论-->
				<div class="reply Media" >
					<img class="reply_img Media-figure" src=" <?php echo $row2['img_addr']?>" alt="默认头像" width="50" height="50">
					<!--	            多级评论区楼层-->
					<font color="#808080"><?php echo "#$postinid&nbsp;&nbsp;&nbsp;&nbsp;";?></font>
					<font color="#999999">
						<?php
						//					检测是否为管理员
						if($row2['isadmin']=='true') {
							if($row2['user_id']==$_SESSION['id']){
								echo "<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row2['name']}({$row2['username']}):";
							}else{
								echo "<font color='red' size='4'>[管理员]</font>{$row2['name']}({$row2['username']}):";
							}
							
						}
//					检测是否为当前用户
						elseif($row2['user_id']==$_SESSION['id']){
							echo "<font color='#8a2be2' size='4'>[自己]</font>{$row2['name']}({$row2['username']}):";
						}
						else{
							echo "{$row2['name']}({$row2['username']}):";
						}
						?>
						
						<?php
						if ($row2['last_id']!=0){
							$sql3="select * from user where id = (select user_id from reply where reply_id={$row2['last_id']}) ";
							$result3=$conn->query($sql3);
							
							if($result3->num_rows>0){
								$row3=$result3->fetch_assoc();
								//检测是否为当前用户
								if($row3['isadmin']=='true') {
									if(isset($_SESSION['id'])&&$row3['id']==$_SESSION['id']){
										echo "回复@<font color='red' size='4'>[管理员]</font><font color='#8a2be2' size='4'>[自己]</font>{$row3['name']}({$row3['username']}):";
									}else{
										echo "回复@<font color='red' size='4'>[管理员]</font>{$row3['name']}({$row3['username']}):";
									}
								}
//					检测是否为当前用户
								elseif(isset($_SESSION['id'])&&$row3['id']==$_SESSION['id']){
									echo "回复@<font color='#8a2be2' size='4'>[自己]</font>{$row3['name']}({$row3['username']}):";
								}
								else{
									echo "回复@{$row3['name']}({$row3['username']}):";
								}
								echo "";
							}
							else{
								echo '出错了！';
							}
							
							
							
						}
						
						?>
					</font>
					<p class="reply_content Media-body">
						<br>
						<!--					多级评论(删除评论按钮)（修改按钮）当为管理员或当前用户才会显示-->
						<?php
						if (isset($_SESSION['id'])&&($_SESSION['isadmin']=='true'||$row2['user_id']==$_SESSION['id'])){
							echo "
								<input  type='submit' value='X' onclick='location.assign(\"../PHP/deletePost.php?reply_id={$row2['reply_id']}&reply=huifu\")'>
								<input  type='submit' value='修改' onclick='location.assign(\"../HTML/updatepost.php?reply_id={$row2['reply_id']}&reply=huifu&boy_clothes_id=$id&floor_id=$postinid\")'>
								";
						}
						?>
						<?php
						for($i=0;$i<2;$i++){
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						}
						echo $row2['reply_content']
						
						?>
						
						<br>
						<br>
						<br>
						<span style="float: left">		 <?php echo  $row2['time'] ?></span>
						<span style="float: right"> <input type="button" value="回复" class="setMessageIn" id="setMessageIn<?php echo $row2['reply_id']?>"> </span>
					</p>
				</div>
				<!--	回复框（多级）-->
				<div class="recommendTA huifus" id="multi<?php echo $row2['diary_id']?>">
					<form action="../PHP/insertPost.php?user_id=<?php echo $_SESSION['id']?>&diary_id= <?php echo $row2['diary_id']?>&last_id= <?php echo $row2['reply_id']?>&reply_id= <?php echo $row2['reply_id']?>&reply=huifu&username=<?php echo $_SESSION['username']?>&product_id=<?php echo $id?>" method="post">
					<textarea placeholder= "回复层主   <?php echo $row2['name']?>(<?php echo $row2['username']?>):	   对      <?php  if($row3['name']!='') echo "层主    @".$row3['name']; else echo "楼主     @".$row['name'];?>(<?php  if($row3['username']!='') echo $row3['username']; else echo $row['username'];?>)：的回复
'<?php echo $row2['reply_content']?>'" name="textarea"></textarea>
						<input type="submit" name="submit" value="发表评论" class="submit">
						<input type="reset" name="reset" value="重置评论" class="reset">
					</form>
				</div>
				<div style="margin-top: 4%">
				
				</div>
				<?php
				//		    多级评论区楼层自增
				$postinid++;
			}
			echo "			<a @click=\"hideMessage()\" class='tipOfReply Media text-right' style='display: none;width: 20%;border: none;color: #0000ee;' href='javascript:void(0)'>----点击折叠评论----</a>";
		}
		?>
		
		
		
		
		
		
		<!--	回复框(一级)-->
		<div class="recommendTA huifu" id="single<?php echo $row['diary_id']?>">
			<form  action="../PHP/insertPost.php?user_id=<?php echo $_SESSION['id']?>&diary_id=<?php echo $row['diary_id']?>&last_id=0&reply_id=null&reply=huifu&username=<?php echo $_SESSION['username']?>&product_id=<?php echo $id?>" method="post">
					<textarea placeholder="回复楼主   <?php echo $row['name']?>(<?php echo $row['username']?>):
			'<?php echo $row['content']?>'" name="textarea"></textarea>
				<input type="submit" name="submit" value="发表评论" class="submit">
				<input type="reset" name="reset" value="重置评论" class="reset">
			</form>
		</div>
		<div style="margin-top: 4%">
		</div>
		
		
		
		<?php
//				一级评论区楼层自增
		$postid++;
//				多级评论区楼层置1
		$postinid=1;
	}}
?>
