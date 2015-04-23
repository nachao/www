<?php
	
	//判断是否登录
	if($u -> Guid() && isset($_GET['out'])){
		$u -> Uout();
	}

	//发放第一名徽章
	if($ub -> IPone()){
		$ub -> Uone();
	}

	//发放第二名徽章
	if($ub -> IPtwo()){
		$ub -> Utwo();
	}

	//发放第三名徽章
	if($ub -> IPthree()){
		$ub -> Uthree();
	}

	//判断登录用户是否可以发放 圈子牛人
	if($ub -> IPniu()){
		$ub -> Aspecial(5);
	}


?>

<!-- 搜索 及 注册按钮 -->
<div class="make r">
	<?php if($u -> Guid()){ //判断是的登录	------------------------------ ?>
		<div class="operate f">
			<div class="icon"><a href="./user.php" ><?php echo $u -> Gname(); ?></a><i></i></div>
			<div class="link">
				<a href="javascript:;" class="price" ><span class="glyphicon glyphicon-fire"></span><em id="headGold" class="golds" n="<?php echo $u -> Gplus(); ?>" ></em></a>
				<a class="fabu <?php if( $ect == "fabu" ){ ?>act<?php } ?>" href="./userAdd.php" ><span class="glyphicon glyphicon-pencil"></span>发布</a>
				<a <?php if( $ect == "user" && !$u -> Ik()){	 	?>class="act"<?php } ?> href="./user.php" ><span class="glyphicon glyphicon-user"></span>个人中心</a>
				<a <?php if( $ect == "chang" ){	 	?>class="act"<?php } ?> href="./userExchange.php" ><span class="glyphicon glyphicon-barcode"></span>提现</a>
				<a <?php if( $ect == "message" ){ 	?>class="act"<?php } ?> href="./userMessage.php" ><span class="glyphicon glyphicon-comment"></span>留言板 <i><?php echo $um -> GMnum() ? $um -> GMnum() : ''; ?></i></a>
				<a <?php if( $ect == "userTitle" ){	?>class="act"<?php } ?> href="./userTitle.php" ><span class="glyphicon glyphicon-th-list"></span>我的标题</a>
				<a <?php if( $ect == "userFollow" ){?>class="act"<?php } ?> href="./userFollow.php" ><span class="glyphicon glyphicon-ok"></span>关注的用户</a>

				<!-- <a <?php if( $ect == "collect" ){	 ?>class="act"<?php } ?> href="javascript:;" ><span class="glyphicon glyphicon-star"></span>收藏夹</a> -->
				<!-- <a <?php if( $ect == "friends" ){	 ?>class="act"<?php } ?> href="javascript:;" ><span class="glyphicon glyphicon-heart"></span>我的好友</a> -->

				<a <?php if( $ect == "welfare" ){	?>class="act"<?php } ?> href="./userWelfare.php" ><span class="glyphicon glyphicon-th-large"></span>徽章/福利</a>
				<a <?php if( $ect == "effigy" ){	?>class="act"<?php } ?> href="./userEffigy.php" ><span class="glyphicon glyphicon-cog"></span>个人设置</a>
				<a <?php if( $ect == "logOff" ){	?>class="act"<?php } ?> href="?out=1" ><span class="glyphicon glyphicon-off"></span>注销</a>
			</div>
		</div>
	<?php }else{ ?>
		<a class="login f" href="./login.php" >注册/登录</a>
	<?php } //---------------------------------------- ?>
	<!-- 用户信息 -->
	<input type="hidden" value="<?php echo $u -> Gplus(); ?>" id="userGold" />
	<input type="hidden" value="<?php echo $u -> Guid(); ?>" id="userIs" />
</div>