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

	if($ist){
		$tid = $_GET['tid'];

		$list = $c -> Glist(0, $page, $tid);			//获取内容列表，指定标题内容时没有显示标准
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

	// $bnid = $admin -> Abanner('', './list.php?tid=291429104152', 0, 291429104152);
	// echo $admin -> Uact($bnid);

	// $admin -> UBsrc('731429112068', './images/1.jpg');
	// $admin -> UBact('731429112068');


	// $an -> Anotice("【新加入功能】发布内容时，可以选择“推送”，用户支付 1 元，内容随机分配0.60元至1.10元之间。");


?>

	<div class="container pagecon Lite">

		<!-- 主体 -->
		<div class="main">
			<div class="center">

				<!-- 公告 -->
				<div class="notice">
					<div class="tit">系统公告</div>
					<div class="con">
						<div class="cue f" id="notice-cue">
							<?php foreach ($an -> Gnotice() as $key => $val) { ?>
							
							<p><a href="<?php  echo !!$val['address'] ? './detail.php?cid='.$val['address'] : 'javascript:;'; ?>" ><?php echo $val['text'].' - '.$o -> Cdate($val['time']); ?></a></p>
							<?php } ?>
						</div>
						<div class="btn r">
							<a id="notice-btn-left" href="javascript:;" >&lt;</a>
							<a id="notice-btn-right" href="javascript:;" >&gt;</a>
						</div>
					</div>
				</div>

				<?php $blist = $admin -> Gbanner(); ?>
				<!-- 焦点图 -->
				<div class="home-banner">
					<div class="con">
						<div class="are">
							<?php foreach ($blist as $key => $Nval) { ?>
								<a href="<?php echo $Nval['href']; ?>" >
									<img src="<?php echo $Nval['src']; ?>" width="100%" />
								</a>
							<?php } ?>
						</div>
					</div>
					<div class="key">
						<?php foreach ($blist as $key => $Nval) { ?><i></i><?php } ?>
					</div>
					<div class="txt">
						<?php foreach ($blist as $key => $Nval) { ?>
							<?php if($Nval['cid'] || $Nval['tid']){ //如果有关联信息 ?>
								<div class="home-banner-col">
									<?php if($Nval['tid']){ //如果有标题则显示	?>
										<div class="tit"><a href="./list.php?tid=<?php echo $Nval['tid']; ?>" ><?php echo $t -> Gtitle($Nval['tid']); ?></a></div>
									<?php } ?>
									<?php if($Nval['text']){ ?>
										<div class="cue"><?php echo $Nval['text']; ?></div>
									<?php } ?>
									<div class="tag f">
										<div class="item user f">BY：
											<a href="./list.php?uid=<?php echo $Nval['author']; ?>" ><?php echo $u -> Gname($Nval['author']); ?></a>
										</div>
										<?php if($Nval['tid'] && $t -> Iact($Nval['tid'])){	//如果是活动，则显示奖金和剩余时间 ?>
										<div class="item time f">剩余：<?php echo $t -> Gsurplus($Nval['tid']); ?></div>
										<div class="item money f">奖金：<a href="./userExchange.php" class="golds"><?php echo $t -> Greward($Nval['tid']); ?></a> <i></i></div>

										<?php }else{ //不是活动的话，则显示使用或者发布日期 ?>
										<div class="item time f"><?php echo $o -> Cdate($Nval['time']); ?></div>
										<?php } ?>
									</div>
									<div class="c"></div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="btn">
						<a href="javascript:;" >&lt;</a>
						<a href="javascript:;" >&gt;</a>
					</div>
				</div>

				<!-- 操作栏 -->
				<div class="home-slogan">这里会让一切变的有价值。<br />有很多网友还是很热心的我跟你说。</div>
	
				<!-- 内容列表 -->
				<div class="contentList" tote="<?php echo $total; ?>" style="overflow: inherit;margin: 0 -15px;" >
					<div class="row"></div>
					<?php foreach ($list as $k => $v) {	//输出内容，或者指定标题的内容 		?>
						<?php $is_look = !$u -> Guid()?' col_possess':'';	//如果没有登录默认内容可以查看 ?>
						<div class="col col_possess<?php //echo $c -> Ibuy($v['cid']) ? ' col_possess' : ''; echo $is_look; ?>" cid="<?php echo $v['cid']; ?>" now="<?php echo $v['plus']; ?>" style="display: block;" >

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

								<?php if($v['label']){	//输出内容的标签  ?>
									<a href="./list.php?tid=<?php echo $v['titleid'] ?>&label=<?php echo $v['label'] ?>" class="label <?php if($v['types'] == 0){ echo ' label-txt'; } ?>"><?php echo $tl -> Gname($v['label']); ?></a>
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
									<div class="num cols-sum f">
										<span class="gold golds" n="<?php echo $v['plus']; ?>" title="内容目前的收入."></span> <i>元</i>
									</div>

									<?php if($u -> Guid()){	//登录后显示的提示 ?>
										<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
									<?php }else{			//未登录后显示的提示 ?>
										<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
									<?php } ?>

									<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
										<!-- <a class="skip look r" href="javascript:;" >展开</a> -->
									<?php } ?>

									<a class="buy confirmBtn iconfont icon-qipaoa r" href="./detail.php?cid=<?php echo $v['cid']; ?>" title="评论" ></a>
									<a class="buy confirmBtn purchase iconfont icon-zan praise <?php echo $c -> Ibuy($v['cid']) ? 'praise-act' : ''; ?> r" href="javascript:;" title="赞" ></a>
								</div>
							</div>
						</div>
					<?php } //输出内容结束 -------------------------------- ?>

					<div class="c"></div>

					<?php if($total > $page){	//如果内容超过一页则显示加载按钮 ?>
						<div class="loadMore"><a id="loadmore" class="loadmore-act" href="javascript:;" uid="<?php echo $uid; ?>" tid="<?php echo $tid; ?>" >加载更多内容<i></i></a></div>
					<?php } ?>

				</div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	
	<!-- 内容收情况 -->
	<ul class="income-detailed" id="incomeDetailed">
		<ol class="idd-item">
			<li class="idd-pillar"></li>
			<li class="idd-depict"><em></em><i></i></li>
		</ol>
	</ul>
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

		//公告切换，此效果因为只在此页面使用，所有放在此处
		(function(){
			var cue = $('#notice-cue'),
				col = cue.find('p'),
				len = col.length;
			var current = 0;

			//主要的部分
			function go(){
				if(current >= len){
					current = 0;
				}
				if(current < 0){
					current = len-1;
				};
				cue.stop().animate({ top: -col.height() * current });
			}

			//自动执行
			var loop,
				time = 5000;
			function auto(){
				stop();
				loop = setTimeout(function(){
					auto();
					current++;
					go();
				}, time);
			}
			function stop() {
				clearTimeout(loop);
			}

			//挂接事件
			$('#notice-btn-left').click(function(){ current--; go(); });
			$('#notice-btn-right').click(function(){ current++; go(); });
			$('.notice').hover(function(){
				stop();
			},function(){
				auto();
			}).mouseleave();
		})();

		//焦点图
		(function(){

			var banner = $('.home-banner');

			var con = banner.find('.con'),
				key = banner.find('.key i'),
				txt = banner.find('.home-banner-col'),
				left = banner.find('.btn a:first'),
				right = banner.find('.btn a:last');

			var now = 0;

			key.mouseenter(function(){
				var i = $(this).index();
				key.removeClass('act').eq(i).addClass('act');
				con.stop().animate({ left: -banner.width() * i }, 1000);
				txt.hide().eq(i).show();
				now = i;
			}).eq(now).mouseenter();

			left.click(function(){
				var i = now - 1;
					i = i<0? key.length-1 : i;
				key.eq(i).mouseenter();
			});

			right.click(function(){
				var i = now + 1;
					i = i>key.length-1? 0 : i;
				key.eq(i).mouseenter();
			});

		})();

		//获取指定内容的收支情况
		$('.col').income();


		//如果高度改变，重新排序瀑布
		// $('.contentList').resize(function(){
		// 	console.log($(this).height());
		// });

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>