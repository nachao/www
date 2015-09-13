<?php
	
	//判断是否登录
	if($u -> Guid() && isset($_GET['out'])){
		$u -> Uout();
	}

	//如果是游客
	if ( !$u -> Is() ) {
		$uv -> Anew();
		// $uid = $o -> Gip();
		// $u -> Acache($uid, 'visitor');
		// $sum = 24;			//默认
	}

	//获取参数
	$uid = $u -> Guid();
	$sum = $u -> Gplus();

?>

<!-- 搜索 及 注册按钮 -->
<div class="make r">
	<?php if($u -> Is()){ //判断是的登录	------------------------------ ?>
		<div class="operate f" <?php if($ect == 'user'){ ?> style="border-top-color: #e74c3c;" <?php } ?> >
			<div class="icon"><a href="./user.php" ><?php echo $u -> Gname(); ?></a><i></i></div>
			<div class="link">
				<a href="javascript:;" class="price" ><span class="glyphicon glyphicon-fire"></span><em id="headGold" class="golds" n="<?php echo $u -> Gplus(); ?>" ></em> <i></i></a>
				<a class="fabu <?php if( $ect == "fabu" ){ ?>act<?php } ?>" href="./userAdd.php" ><span class="glyphicon glyphicon-pencil"></span>发布</a>
				<a href="./user.php" ><span class="glyphicon glyphicon-user"></span>个人中心</a>
				<a href="./userExchange.php" ><span class="glyphicon glyphicon-barcode"></span>提现</a>
				<a href="./userMessage.php" ><span class="glyphicon glyphicon-comment"></span>留言板 <i><?php echo $um -> GMnum() ? $um -> GMnum() : ''; ?></i></a>
				<a href="./userTitle.php" ><span class="glyphicon glyphicon-th-list"></span>我的标题</a>
				<a href="./userFollow.php" ><span class="glyphicon glyphicon-ok"></span>关注的用户</a>
				<!-- <a <?php if( $ect == "collect" ){	 ?>class="act"<?php } ?> href="javascript:;" ><span class="glyphicon glyphicon-star"></span>收藏夹</a> -->
				<!-- <a <?php if( $ect == "friends" ){	 ?>class="act"<?php } ?> href="javascript:;" ><span class="glyphicon glyphicon-heart"></span>我的好友</a> -->
				<a href="./userWelfare.php" ><span class="glyphicon glyphicon-th-large"></span>我的能力</a>
				<a href="./userEffigy.php" ><span class="glyphicon glyphicon-cog"></span>个人设置</a>
				<a href="?out=1" ><span class="glyphicon glyphicon-off"></span>注销</a>
			</div>
		</div>
	<?php }else{ ?>
		<a class="login f" href="./login.php" >注册/登录</a>
	<?php } //---------------------------------------- ?>
	<!-- 用户信息 -->
	<input type="hidden" value="<?php echo $sum; ?>" id="userGold" />
	<input type="hidden" value="<?php echo $uid; ?>" id="userIs" />
</div>