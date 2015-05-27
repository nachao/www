<?php
	
	//判断是 访问还是 登录用户，访问优先  
	if($u -> Guid()){
		$suid = $u -> Guid();
	}else{
		// $u -> UtoL();
	}

?>

	<?php if(!$u -> Guid()){ ?>
		<!-- 快速登录 -->
		<div class="commarea sideFastentry" style="margin-top: 0px;">
			<div class="content">
				<div class="head">
					<div class="tit f"><em>快速登录</em><i>Fast Entry</i></div>
					<div class="gap"><i></i></div>
				</div>
				<input class="txt" id="sideAcccount" type="text" placeholder="用户名" />
				<input class="txt" id="sidePwd" type="password" placeholder="密码" />
				<input class="btn" id="sideEntry" type="submit" value="登录" />
				<div class="c"></div>
			</div>
			<div class="bottomSide"></div>
		</div>
		<script type="text/javascript">

			var Sacc = $('#sideAcccount'),
				Spwd = $('#sidePwd'),
				Sbtn = $('#sideEntry');
			Sacc.blur(function(){
				var val = 1;
				Sacc.removeClass('textajax textyes textno textgo');
				if(Sacc.val().replace(/[ ]/g, '').length > 0){
					Sacc.addClass('textajax');
					Sacc.validate(Sacc.val(), 1, function(value){
						Sacc.removeClass('textajax textyes textno textgo');
						if(value.k == 2){
							Sacc.addClass('textgo');
						}else{
							Sacc.addClass('textno');
						}
					});
				}else{
					Sbtn.removeAttr('readonly').removeClass('not');
					Sacc.addClass('textyes');
					val = 0;
				}
				$(this).attr('is', val);
			});
			Sbtn.click(function(){
				Sbtn.attr('readonly', 'readonly').addClass('not');
				Spwd.removeClass('textajax textyes textno textgo');
				if(parseInt(Sacc.blur().attr('is'))){
					Spwd.addClass('textajax');
					$(this).validate(Sacc.val(), Spwd.val(), function(value){
						Spwd.removeClass('textajax textyes textno textgo');
						if(value.k == 1){
							Spwd.addClass('textgo');
							location.href = location.href;
						}else if(value.k == 2){	
							Spwd.addClass('textno');
						}else{
							Spwd.addClass('textyes');
						}
						Sbtn.removeAttr('readonly').removeClass('not');
					});
				}
			});

		</script>
	<?php } ?>
	
	<?php if($u -> Guid()){ ?>
		<!-- 用户信息 -->
		<div class="userInfo" userid="<?php echo $suid; ?>" style="margin:0px;" >

			<?php if($u -> Guid() && !isset($_GET['c'])){ ?>
			<div class="withdraw"><a href="./userExchange.php" title=""></a></div>
			<?php } ?>

			<div class="icon f">
				<a href="./list.php?uid=<?php echo $u -> Guid(); ?>" >
					<img id="userInfoIcon" src="<?php echo $u -> Gicon(); ?>" alt="<?php echo $u -> Gname($suid); ?><" />
				</a>
				<span><?php echo $u -> Gname($suid); ?></span>
			</div>

			<div class="price f"><em id="userInfoGold" class="golds" n="<?php echo $u -> Gplus($suid); ?>"></em><i>元</i></div>
			<div class="c"></div>
			<div class="depict"><?php echo $u -> Gdepict($suid); ?></div>

			<div class="glory">

				<?php if($ub -> Ibadge($suid)){	//判断用户是否有图标 ?>
					<?php foreach ($ub -> Gbadge($suid) as $k => $Bv) {	//输出用户的全部徽章 -------------------------------- 	?>
						<?php if($Bv['id'] == 2 && !$u -> Ivip()){ $ub -> DSuse($Bv['id']); continue; }	//如果是会员，则判断会员是否过期，过期则不显示 ?>
						<a class="<?php echo $Bv['icon']; ?>" href="javascript:;" title="<?php echo $Bv['name']; ?>"></a>
					<?php } //输出内容结束 -------------------------------- ?>
				<?php } ?>

			</div>
			<div class="c"></div>
		</div>
	<?php } ?>
	
	<!-- 我的金额记录 -->
	<div class="commarea sideFondertit">
		<div class="content">
			<div class="head">
				<div class="tit f"><em>金额记录</em><i>Fonder Titles</i></div>
				<div class="gap"><i></i></div>
			</div>
			<div class="sumLog">

				<?php foreach ($u -> Glog() as $key => $value) {	//输出用户最近三十天的收支记录
					if ( $value['pay'] ) {
						$pay = '<br />支出：<span class="golds" n="'.$value['pay'].'"></span><i></i>';
					}else{
						$pay = '';
					}
					if ( $value['income'] ) {
						$income = '<br />收入：<span class="golds" n="'.$value['income'].'"></span><i></i>';
					}else{
						$income = '';
					}
					if ( $value['pay'] > $value['income'] ) {
						$type = 'pay';
						$val = (intval($value['pay']) + 20);
					}else{
						$type = 'income';
						$val = (intval($value['income']) + 20);
					}
					if ( $value['pay'] || $value['income'] ) {
						$val = $val > 100 ? 100 : $val;
						$val = $val/100;
						echo '<div class="item '.$type.'" ><div class="con" style="opacity: '.$val.';" ></div><span class="tip"><em></em>'.$key.$income.$pay.'</span></div>';
					}else{
						echo '<div class="item"><span class="tip"><i></i>'.$key.'</span></div>';
					}
				} ?>

			</div>
			<div class="c"></div>
		</div>
		<div class="bottomSide"></div>
	</div>
	
	<?php if($ect != "message" && 0){ //在留言板不显示此内容 ?>
		<!-- 最新留言 -->
		<div class="commarea sideNewMessage">
			<div class="content">
				<div class="head">
					<div class="tit f"><em>最新留言</em><i>New Message</i></div>
					<div class="gap"><i></i></div>
				</div>
				<div class="list">

					<?php if(count($u -> Gmessage(0, 5, $suid)) > 0){  ?>
						<?php foreach ($u -> Gmessage(0, 5, $suid) as $key => $SMv) { //输出内容开始 --------------------------------  ?>
							<div class="row" mid="<?php echo $SMv['id']; ?>">
								<div class="pic f"><a href="./user.php?id=<?php echo $SMv['userid']; ?>" title=""><img src="./effigy/<?php echo $u -> Gicon($SMv['userid']); ?>" alt="" height="100%" /></a></div>
								<div class="info r">
									<div class="tit"><a href="./user.php?id=<?php echo $SMv['userid']; ?>" title=""><?php echo $u -> Gname($SMv['userid']); ?></a></div>
									<div class="cue"><?php echo $SMv['content']; ?></div>
								</div>
								<div class="c"></div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="notFollow">
							<div class="tip">没有留言！</div>
						</div>
					<?php } ?>

					<div class="c"></div>
					<div class="newMessage"><a href="./userMessage.php<?php echo $u -> Ik() ? '?k='.$u -> Gcid() : ''; ?>" title="">去留言</a></div>
				</div>
				<div class="c"></div>
			</div>
			<div class="bottomSide"></div>
		</div>
	<?php } ?>
	
	<?php if($u -> Guid()){ ?>
		<!-- 我关注的标题 -->
		<div class="commarea sideFondertit">
			<div class="content">
				<div class="head">
					<div class="tit f"><em>我的标题</em><i>Fonder Titles</i></div>
					<div class="gap"><i></i></div>
				</div>
				<div class="list">

					<?php foreach ($t -> GUFlist(0, $suid) as $key => $TFv) {	//输出用户关注的标题 ?>
						<a class="one" href="./list.php?tid=<?php echo $TFv['tid']; ?>" ><?php echo $t -> ITval($TFv['type']).'#'.$TFv['title']; ?><span>(<?php echo $TFv['number']; ?>)</span><i>&gt;</i></a>
					<?php } ?>

				</div>

				<?php if(count($t -> GUFlist(0, $suid)) <= 0){	//如果没有关注的标题 ?>
					<div class="notFollow">
						<div class="tip">暂时还未关注标题！</div>

						<?php  if($u -> Guid()){	//如果用户是在自己的个人中心时候显示 ?>
							<a class="skip" href="./title.php" title="">逛标题</a>
							<a class="skip" href="./titleApply.php" title="">申请标题</a>
						<?php } ?>

					</div>
				<?php } //输出我关注的标题结束 -------------------------------------- ?>

				<div class="c"></div>
			</div>
			<div class="bottomSide"></div>
		</div>
	<?php } ?>
	
	<!-- 独家赞助 -->
	<div class="commarea sideSupport">
		<div class="content">
			<div class="head">
				<div class="tit f"><em>独家赞助</em><i>Support</i></div>
				<div class="gap"><i></i></div>
			</div>
			<?php $ad = $a -> GAnow(); ?>
			<div class="link">
				<a href="<?php echo $ad['link'] ? $ad['link'] : 'javascript:;'; ?>" title="《<?php echo $ad['cue']; ?>》独家赞助" >
					<img src="<?php echo $ad['imgs']; ?>" />
					<p><?php echo $ad['cue']; ?></p>
				</a>
			</div>
			<div class="c"></div>
		</div>
		<div class="bottomSide"></div>
	</div>
	
	<?php if($u -> IVlogs()){	//如果有访客记录 ?>
		<!-- 访客 -->
		<div class="commarea sideCaller">
			<div class="content">
				<div class="head">
					<div class="tit f"><em>最近访客</em><i>Caller</i></div>
					<div class="gap"><i></i></div>
				</div>
				<div class="list">
					<div class="area">
						<?php foreach ($u -> GVlogs() as $key => $VLv) { ?>
							<a class="link" href="./user.php?c=<?php echo $VLv['uid']; ?>" title="<?php echo $u -> Gname($VLv['uid']); ?>" >
								<img src="<?php echo $u -> Gicon($VLv['uid']); ?>" height="100%" />
							</a>
						<?php } ?>
						<div class="c"></div>
					</div>
				</div>
				<div class="c"></div>
			</div>
			<div class="bottomSide"></div>
		</div>
	<?php } ?>
	
	<!-- 菜单
	<div class="sideMenu no">
		<div class="link">
			<a class="act" href="#" title=""><span class="glyphicon glyphicon-pencil"></span> 发布</a>
			<a href="#" title=""><span class="glyphicon glyphicon-user"></span> 个人中心</a>
			<a href="#" title=""><span class="glyphicon glyphicon-barcode"></span> 提现</a>
			<a href="#" title=""><span class="glyphicon glyphicon-comment"></span> 留言板</a>
			<a href="#" title=""><span class="glyphicon glyphicon-th-list"></span> 我的标题</a>
			<a href="#" title=""><span class="glyphicon glyphicon-user"></span> 我的好友</a>
			<a href="#" title=""><span class="glyphicon glyphicon-sunglasses"></span> 关注的用户</a>
			<a href="#" title=""><span class="glyphicon glyphicon-heart-empty"></span> 收藏夹</a>
			<a href="#" title=""><span class="glyphicon glyphicon-user"></span> 徽章/福利</a>
			<a href="#" title=""><span class="glyphicon glyphicon-wrench"></span> 设置</a>
			<a href="#" title=""><span class="glyphicon glyphicon-off"></span> 注销</a>
		</div>
		<div class="c"></div>
	</div>
	 -->
	
	<!-- 搜索
	<div class="commarea sideSearch no">
		<div class="content">
			<div class="head">
				<div class="tit f"><em>搜索</em><i>Search</i></div>
				<div class="gap"><i></i></div>
			</div>
			<form>
				<input class="txt" type="text" value="" name="" placeholder="搜索此用户的相关内容" />
				<input class="btn" type="submit" value="立即搜索" />
			</form>
			<div class="c"></div>
		</div>
		<div class="bottomSide"></div>
	</div>
	 -->
	
	<!-- 我关注的用户
	<div class="commarea sideFonderuser">
		<div class="content">
			<div class="head">
				<div class="tit f"><em>关注的用户</em><i>Fonder Users</i></div>
				<div class="gap"><i></i></div>
			</div>
			<div class="list">
				<div class="row">
					<div class="pic f"><a href="#" title=""><img src="./images/2.jpg" alt="" height="100%;" /></a></div>
					<div class="info r">
						<div class="tit"><a href="#" title="">方方方</a></div>
						<div class="zi" >字：<a href="#" title="">子渊</a></div>
						<div class="time" title="最近发布时间">十二月 29, 2014</div>
					</div>
				</div>
				<div class="row">
					<div class="pic f"><a href="#" title=""><img src="./images/2.jpg" alt="" height="100%;" /></a></div>
					<div class="info r">
						<div class="tit"><a href="#" title="">方方方</a></div>
						<div class="zi" >字：<a href="#" title="">子渊</a></div>
						<div class="time" title="最近发布时间">十二月 29, 2014</div>
					</div>
				</div>
				<div class="row">
					<div class="pic f"><a href="#" title=""><img src="./images/2.jpg" alt="" height="100%;" /></a></div>
					<div class="info r">
						<div class="tit"><a href="#" title="">方方方</a></div>
						<div class="zi" >字：<a href="#" title="">子渊</a></div>
						<div class="time" title="最近发布时间">十二月 29, 2014</div>
					</div>
				</div>
			</div>
			<div class="c"></div>
		</div>
		<div class="bottomSide"></div>
	</div>
	 -->
	
	<!-- 我的图集
	<div class="commarea sideMyalbum">
		<div class="content">
			<div class="head">
				<div class="tit f"><em>我的图集</em><i>Fonder Users</i></div>
				<div class="gap"><i></i></div>
			</div>
			<div class="album">
				<a class="btn prev" href="#" >&lt;</a>
				<div class="con">
					<div  class="col"><a class="col" href="#" title=""><img src="./images/3.jpg" alt="" height="100%" /></a></div>
					<div  class="col"><a class="col" href="#" title=""><img src="./images/4.jpg" alt="" height="100%" /></a></div>
				</div>
				<a class="btn next" href="#" >&gt;</a>
			</div>
			<div class="c"></div>
		</div>
		<div class="bottomSide"></div>
	</div>
	 -->