<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//设置选择菜单
	Global $ect;
	$ect="index";

	//引用样式头部
	include("./comm/head.php");	

	//内容参数
	$page = $cf -> LPages;		//每页显示的数量
	$norm = 1;		//内容显示最低标准（金额：0.01元为单位）

	//获取标题
	$ist = isset($_GET['tid']) && $_GET['tid'];
	$isu = isset($_GET['uid']) && $_GET['uid'];

	//初始化
	$uid = 0;
	$tid = 0;
	$label = 0;

	if($ist){
		$tid = $_GET['tid'];

		if(isset($_GET['label'])){
			$label = $_GET['label'];
		}

		$list = $c -> Glist(0, $page, $tid, 0, $label);	//获取内容列表，指定标题内容时没有显示标准
		$total = $c -> Gtotel(0, 0, $tid);				//获取此标题的内容总数

	}elseif($isu){
		$tid = 0;
		$uid = $_GET['uid'];

		$list = $c -> GUlist(0, $page, 0, 0, $uid);		//获取内容列表，指定用户内容时没有显示标准
		$total = $c -> Gtotel(0, $uid);					//获取此用户的内容总数

	}else{
		$list = $c -> Glist(0, $page,0 ,$norm);		//获取内容列表
		$total = $c -> Gtotel($norm);				//获取内容总数
	}



?>

	<div class="container pagecon">
		<?php

		//nclude("./comm/pageHead.php");	//导入内页头部及导航 	?>

		<!-- 主体 -->
		<div class="main">
			<div class="center">

				<!-- 操作栏 -->
				<div class="actionbar">
				</div>
	
				<?php if($ist){ $Tv = $t -> Ginfo($tid);	//如果有指定的标题 ?>
				<!-- 标题描述 -->
				<div class="describe f <?php if($t -> Ifollow($Tv['tid'])){ echo 'col_follow'; } //是否已关注 ?>" tid="<?php echo $Tv['tid']; ?>" style="width: 760px;border-right: 1px dashed #ddd;padding: 20px 30px 0 0;margin-bottom: 50px;" >
					<a href="?tid=<?php echo $tid; ?>"><h1 class="f"><?php echo $t -> Gtype($tid).'#'.$t -> Gtitle($tid); ?></h1></a>
					<?php if($Tv['tid'] == '291429156432'){		//指定内容播放音乐 ?>
						<object data="./swf/dewplayer.swf" width="200" height="20" name="dewplayer" id="dewplayer" type="application/x-shockwave-flash" style="float: right;margin-top: 15px;" >
							<param name="movie" value="./mp3/dewplayer.swf" />
							<param name="flashvars" value="mp3=mp3/001.mp3&amp;autostart=1" />
							<param name="wmode" value="transparent" />
						</object>
					<?php } ?>
					<div class="c"></div>
					<p><?php echo $t -> Gcontent($tid); ?></p>
					<p>
						<?php //foreach ($tl -> Glabel($tid) as $key => $value) { //输出全部标签
							//if($tl -> GCtotal($value['lid'])){ ?>
							<!-- <a href="?tid=<?php echo $tid; ?>&label=<?php echo $value['lid']; ?>"><em class="<?php if(isset($_GET['label']) && $value['lid'] == $_GET['label']){ echo "act"; } ?>"><?php echo $value['name']; ?></em></a> -->
							<?php //} } ?>
					</p>
					<!-- 标题列表 - 参数 -->
					<div class="param-tag f" style="width: 670px;">
						<span class="creator">创建者：
							<a href="./list.php?uid=<?php echo $Tv['userid']; ?>" ><?php echo $u -> Gname($Tv['userid']); ?></a>
						</span>
						<span class="fabu"><em><?php echo $t -> GTCcount($Tv['tid']); ?></em> 条内容</span>
						<?php if($t -> Iact($Tv['tid'])){ 	//活动标题参数 ?>
							<span class="time">剩余：<em><?php echo $t -> Gsurplus($Tv['tid']); ?></em></span>
							<span class="jine">奖金：<em class="golds"><?php echo $Tv['reward']; ?></em> <i>元</i></span>
							<?php echo $t -> ISnormal($Tv['tid']); ?>
							<span class="gold">金池：<em class="golds"><?php echo $Tv['price']; ?></em> <i>元</i> (<b><?php echo $Tv['shareglod']/100;?></b>) </span>
						
							<?php if($Tv['invest']){		//如果标题开启了金池共享，则显示 ?>
							<span class="fenxiang">金池分享：<i class="title-share-scale"><?php echo $Tv['invest']; ?></i>% </span>
							<?php } ?>

							<?php if($t -> Gfirst($Tv['tid'])){		//如果有第一名则显示
								$fcid = $t -> GFcid($Tv['tid']);	//获取第一名的内容CID  ?>
								<span class="first">获胜者：
									<a href="./list.php?uid=<?php echo $t -> Gfirst($Tv['tid']); ?>"><?php echo $u -> Gname($t -> Gfirst($Tv['tid'])); ?></a>
								</span>
							<?php }else{ $fcid = 0; } ?>

						<?php }else{	//专题参数 ?>
						<span class="goumai"><em><?php echo $Tv['click']; ?></em> 次买账</span>
						<?php } ?>
					</div>

					<!-- 标题列表 - 操作 -->
					<div class="use-btn r">
						<?php if(($t -> INact($tid) || $t -> Itype($tid, 2)) && !$t -> Icreator($tid)){	//有效的活动或者专题 且非创建者 则可关注和取消关注 ?>
							<a class="tip r" style="top:-33px;" href="javascript:;" note="提示语" >请登录！<i style="left: 25px;"></i></a>

							<?php if($t -> Ifollow($Tv['tid'])){	//判断是否关注 ?>
								<?php if($t -> Iact($Tv['tid'])){	//已关注的活动显示内容 ?>
									<a class="buy follow buy_follow r" href="./userAdd.php?tid=<?php echo $Tv['tid']; ?>" >去发布</a>
								<?php } ?>
							<?php }else{ ?>
								<a class="buy follow r" href="javascript:;" >关注</a>
							<?php } ?>
						<?php } ?>
					</div>

					<div class="c"></div>
				</div>
				<?php } ?>
				
				<?php if($ist){ ?>
				<!-- 推荐标题 -->
				<div class="recommend r">
					<?php foreach ($t -> Ghot($tid) as $key => $value) { ?>
						<a class="recommend-col" href="?tid=<?php echo $value['tid']; ?>" >
							<img src="<?php echo $u -> Gicon($value['uid']); ?>" />
							<span><?php echo $value['title']; ?></span>
						</a>
					<?php } ?>
				</div>
				<?php } ?>
				
				<div class="c"></div>

				<?php if($ist && !$t -> Icon($tid)){	//如果没有标题的内容则给提示 ?>
				<!-- 无内容提示 -->
				<div class="Ncon listNot">
					<div class="are">
						<h1>抱歉！没有找到相关内容。</h1>
						<div class="cue">
							<p>关注此标题，主动了解最新信息。</p>
						</div>
						<div class="btn">
							<a class="stroll" href="./list.php" title="">更多其他内容</a>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="c"></div>

				<!-- 内容列表 -->
				<div class="contentList" tote="<?php echo $total; ?>" style="overflow: inherit;margin: 0 -15px;" >
					<div class="row"></div>
	
					<?php if($isu){		//如果是查看用户内容则显示用户信息 ?>
						<!-- 用户信息 -->
						<div class="col col-user">
							<div class="userInfo" style="margin-top:0px;" >
								<div class="icon f">
									<a href="javascript:;" style="cursor: default;" >
										<img id="userInfoIcon" src="<?php echo $u -> Gicon($uid); ?>" alt="<?php echo $u -> Gname($uid); ?><" />
									</a>
								</div>
								<div class="price f">
									<span><?php echo $u -> Gname($uid); ?></span>
									<em class="golds" n="<?php echo $u -> Gplus($uid); ?>" ></em><i>元</i>
									<div class="c"></div>
								</div>
								<div class="c"></div>
								<div class="depict"><?php echo $u -> Gdepict($uid); ?></div>
								<div class="c"></div>
								<div class="glory">

									<?php if($ub -> Ibadge($uid)){	//判断用户是否有图标 ?>
										<?php foreach ($ub -> Gbadge($uid) as $k => $Bv) {	//输出用户的全部徽章 -------------------------------- 	?>
											<a class="<?php echo $Bv['icon']; ?>" href="javascript:;" title="<?php echo $Bv['name']; ?>"></a>
										<?php } //输出内容结束 -------------------------------- ?>
									<?php } ?>
									
								</div>
							</div>
							<div class="c"></div>
							
							<!-- 用户操作 -->
							<div class="col-user-menu">
								<a class="col-user-mbtn col-user-mbtn-01" href="./userTitle.php?uid=<?php echo $uid; ?>" ><span>TA的标题<i></i></span></a>
								<a class="col-user-mbtn col-user-mbtn-02" href="./userFollow.php?uid=<?php echo $uid; ?>" ><span>TA的关注<i></i></span></a>
								<a class="col-user-mbtn col-user-mbtn-03" href="./userMessage.php?uid=<?php echo $uid; ?>" ><span>留言板<i></i></span></a>
								<a class="col-user-mbtn col-user-mbtn-04" href="javascript:alert('此功能尚未开启！');" ><span>举报<i></i></span></a>
							</div>
							<div class="c"></div>
								
							<?php if($isu && ($u -> Guid() && ($u -> Guid() != $uid))){ //登录后可见，其他用户可见 ?>
								<!-- 关注用户 -->
								<?php if($u -> Ifollow($uid)){ 	//如果关注过此用户 ?>
									<div class="user-follow user-follow-has">
										<span class="user-follow-cue">你已经关注此用户 <span class="color-red"><?php echo $o -> Ctime($u -> GFtime($uid)); ?></span></span>
										<a class="user-follow-btn" id="user-cancel-btn" href="javascript:;" fid="<?php echo $uid; ?>">取消关注</a>
									</div>	

								<?php }else{	//未关注此用户 ?>
									<div class="user-follow">
										<span class="user-follow-cue">你已经关注此用户</span>
										<a class="user-follow-btn" id="user-follow-btn" href="javascript:;" fid="<?php echo $uid; ?>" >关注此用户</a>
									</div>
								<?php } ?>	
								<script type="text/javascript">
									$('#user-follow-btn').click(function(){ $(this).followUser(); });			//关注用户
									$('#user-cancel-btn').click(function(){ $(this).cancelFollowUser(); });		//取消关注用户
								</script>
							<?php } ?>	

						</div>
					<?php } ?>

					<?php foreach ($list as $k => $v) {	//输出内容，或者指定标题的内容 		?>
						<div class="col<?php echo $c -> Ibuy($v['cid']) ? ' col_possess' : ''; ?>" cid="<?php echo $v['cid']; ?>" now="<?php echo $v['plus']; ?>" style="display: block;" >

							<!-- 标示 -->
							<?php if($v['effects'] == 1){	//如果是顶 ?>
								<div class="effects effects-very" alt="作者顶贴" ></div>
							<?php } ?>

							<?php if($v['effects'] == 2){	//如果是推荐 ?>
								<div class="effects effects-recommend" alt="题主推荐" ></div>
							<?php } ?>

							<?php if($ist && isset($fcid) && $fcid == $v['cid']){	//如果是标题第一名的内容 ?>
								<div class="effects effects-first" alt="活动第一名" ></div>
							<?php } ?>

							<?php 
							if($ist && (((intval($v['effects'],  10) == 0 && $v['plus'] > 100)) && $Tv['userid'] == $u -> Gid()) && $u -> Gplus() > 10000){	//题主且活动有效的话，则可以设置推荐 ?>
								<a href="javascript:;" class="effects effects-recommend-set" title="将支付 100.00 元给此内容的发布者作为奖励" >设为推荐</a>
							<?php } ?>

							<div class="head">
								<?php if(!$ist){	//判断是否有标题，则不显示标题 ?>
									<div class="tit <?php echo $v['titleid'] <= 0 ? 'no' : ''; ?>">
										<a href="./list.php?tid=<?php echo $v['titleid']; ?>" ><?php echo $t -> Gtitle($v['titleid']); ?></a>
									</div>
								<?php } ?>
								<div class="param-tag tag">
									<span class="name">BY：
										<a href="./list.php?uid=<?php echo $v['userid']; ?>" title="访问TA" ><?php echo $u -> Gname($v['userid']); ?></a>
									</span>
									<span class="time"><?php echo $o -> Cdate($v['base']); ?></span>
									<div class="c"></div>
								</div>
							</div>
							<div class="cont">

								<?php if($v['label']){	//输出内容的标签 ?>
									<?php if($label && $v['label'] == $label){	//判断是否为当前查看的标签 ?>
									<span class="label label-act <?php if($v['types'] == 0){ echo ' label-txt'; } ?>"><?php echo $tl -> Gname($v['label']); ?></span>
									<?php }else{ ?>
									<a href="?tid=<?php echo $v['titleid'] ?>&label=<?php echo $v['label'] ?>" class="label <?php if($v['types'] == 0){ echo ' label-txt'; } ?>"><?php echo $tl -> Gname($v['label']); ?></a>
									<?php } ?>
								<?php } ?>

								<div class="gui gui_<?php echo $o -> Ccode($v['types']); ?>">
									<?php echo $c -> IGcontrol($v['cid']); ?>
									<i class="purchase">+</i><em></em>
									<div class="c"></div>
								</div>

								<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
									<div class="txt" <?php if($v['types'] ==0){ echo "style='max-height: 198px;'"; } ?>><div class="are"><?php echo $v['content']; ?></div></div>
								<?php } ?>
								
								<div class="use">
									<div class="num f"><span class="gold golds" n="<?php echo $v['plus']; ?>"></span> <i>元</i></div>

									<?php if($u -> Guid()){	//登录后显示的提示 ?>
										<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
									<?php }else{			//未登录后显示的提示 ?>
										<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
									<?php } ?>

									<?php if($c -> Ibuy($v['cid'])){		//如果可以查看 ?>
										<a class="buy confirmBtn r" href="./detail.php?cid=<?php echo $v['cid']; ?>" >去评论</a>
										<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
											<a class="skip look r" href="javascript:;" >展开</a>
										<?php } ?>
									<?php }else{  //需要购买 ?>
										<a class="buy confirmBtn purchase r" href="javascript:;" >买买买</a>
										<a class="skip look r" href="./detail.php?cid=<?php echo $v['cid']; ?>" >评论</a>
									<?php } ?>

								</div>
							</div>
						</div>
					<?php } //输出内容结束 -------------------------------- ?>

					<div class="c"></div>

					<?php if($total > $page){	//如果内容超过一页则显示加载按钮 ?>
						<div class="loadMore"><a id="loadmore" href="javascript:;" uid="<?php echo $uid; ?>" tid="<?php echo $tid; ?>" >加载更多内容</a></div>
					<?php } ?>

				</div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//自动排序
		$('.contentList').jw13217();

		//挂接购买按钮
		$('.purchase').purchase();

		//挂接已购买的内容为可查看图片
		$('.col_possess').picture();

		//挂接已购买的内容为可查看文本
		$('.col_possess').writing();

		//加载更多
		$('#loadmore').loadmore();

		//自动加载
		// $(window).scroll(function(){
		// 	if($(this).scrollTop() >= $('html,body').height() - $(window).height() - 100){
		// 		$('#loadmore').click();
		// 	}
		// });

		//设置内容为活动推荐
		$('.effects-recommend-set').recommend();

		//挂接关注和取消关注
		$('.describe').attention();


	</script>

<?php include("./comm/footer.php");	//引用底部 	?>