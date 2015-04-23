<?php

	//设置选择菜单
	Global $ect;
	$ect="userFollow";	
	
	//引用公共文件
	include("./comm/base.php");	

	//引用样式头部
	include("./comm/head.php");	

	//未登录不可见的页面
	// $u -> INtoL();

	//是否访问其他用户
	$uid = 0;
	$seeUid = '';
	if(isset($_GET['uid'])){
		$seeUid = '&uid='.$_GET['uid'];	
		$uid = $_GET['uid'];
	}



?>
	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="center">
			
				<!-- 操作栏 -->
				<div class="actionbar">
					<?php if($seeUid){	//访问时可见 ?>
					<a class="cupid-red user-icon r" href="./list.php?uid=<?php echo $uid; ?>" style="margin-top: 27px;" title=""><?php echo $u -> Gname($uid); ?></a>
					<?php } ?>
				</div>
				<div class="leftarea f">
					<?php if(!count($u -> Gfollow($uid))){ 	//如果用户没有标题  ?>
					<div class="Ncon followUserNot">
						<div class="are">
							<h1>没有关注的用户！</h1>
							<div class="cue">让我们来追随大神们的脚步。</div>
							<div class="btn">
								<a href="./digg.php" title="">去围观排行榜</a>
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="disslist disslist-follow center">
						<div class="are f">

							<?php foreach($u -> Gfollow($uid) as $key => $Uv){//输出全部关注用户	?>
								<div class="col f">
									<a href="./list.php?uid=<?php echo $Uv['fuid']; ?>" title="上次登录：<?php echo $o -> Ctime(time() - $u -> GLEtime($Uv['fuid'])); ?>前">
										<div class="pic f">
											<img src="<?php echo $u -> Gicon($Uv['fuid']); ?>" /><i></i><em></em>
											<div class="num"><em class="golds"><?php echo $u -> Gplus($Uv['fuid']); ?></em><i>元</i></div>
										</div>
										<div class="name f"><?php echo $u -> Gname($Uv['fuid']); ?></div>
									</a>
									<div class="c"></div>
								</div>
							<?php }	?>

							<div class="c"></div>
						</div>
						<!-- <div class="shade"></div> -->
						<div class="c"></div>
					</div>
				</div>
				<div class="rightarea r" ><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>

<?php include("./comm/footer.php");	//引用底部 	?>