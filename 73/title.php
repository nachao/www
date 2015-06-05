<?php
	
	//引用公共文件
	include("./comm/base.php");	

	//设置选择菜单
	Global $ect;
	$ect="title"; 	

	//引用样式头部
	include("./comm/head.php");	

	//类型
	$type = 0;

	//获取指定类型
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
	}


	$page = 1;		//当前默认打开页数
	$number = 9;	//每页显示数量
	$total = $t -> Gtotal($type);
	$total = $total <= 0 ? 1 : $total;

	if ( isset($_GET['page'])) {
		$page = $_GET['page'];	
	}


?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="center">

				<!-- 操作栏 -->
				<div class="actionbar">
					<!-- 分类 -->
					<div class=	"actionbar-type">
						<a class="actionbar-btn actionbar-s0 <?php echo $type == 0 ? 'actionbar-btn-act actionbar-s0-act' : ''; ?>" href="?#">全部</a>
						<a class="actionbar-btn actionbar-s1 <?php echo $type == 1 ? 'actionbar-btn-act actionbar-s1-act' : ''; ?>" href="?type=1">活动</a>
						<a class="actionbar-btn actionbar-s2 <?php echo $type == 2 ? 'actionbar-btn-act actionbar-s2-act' : ''; ?>" href="?type=2">专题</a>
						<a class="actionbar-btn actionbar-s3 <?php echo $type == 3 ? 'actionbar-btn-act actionbar-s3-act' : ''; ?>" href="?type=3">任务</a>
					</div>
					<!-- 赛选 -->
				</div>

				<?php if(!$t -> Iuse($type, ($page - 1) * $number, $number)){ ?>
					<!-- 没有标题时的提示 -->
					<div class="Ncon notTit">
						<h1>抱歉没有找到相关内容！</h1>
						<p>你可以去申请属于自己专属的 “个人专题”；</p>
						<p>也可以申请让大家参与进来的 “活动标题”；</p>
						<p>以及发布任务。</p>
						
						<?php if($u -> Guid()){ ?>
						<div class="btn">
							<a href="./userTitle-Apply.php" class="red" >去申请创建新标题</a>
						</div>
						<?php } ?>
					</div>
				<?php } ?>

				<!-- 标题列表 -->
				<?php

				if(1){   //判断是否有标题内容，如果有标题内容则输出  ?>
				<div class="contentList titleList" style="width: 100%;overflow: initial;" >

					<?php foreach($t -> Glist($type, ($page - 1) * $number, $number) as $key => $Tv) {	//循环输出全部标题 ?>

						<?php if($t -> Gcost($Tv['tid']) > 0){  		//判断是否需要维护
								if(!$t -> USMcharges($Tv['tid'])){		//如果没有维护成功
									if($t -> Gcost($Tv['tid']) > 300){	//如果连续超过3天无法维护
										$t -> Uclose($Tv['tid']);		//则系统关闭专题
										continue;
									}
								}
						} ?> 
						<div class="col titleCol <?php if($t -> Ifollow($Tv['tid'])){ echo 'col_follow'; } //是否已关注 ?> type_<?php echo $Tv['type']; ?> sh" tid="<?php echo $Tv['tid']; ?>" >
							<div class="icon-type <?php if($t -> Itype($Tv['tid'], 2)){ echo 'icon-type-e'; } if($Tv['tid'] == 3){ echo 'icon-type-task'; } ?>"></div>
							<div class="head">
								<!-- 标题列表 - 标题 -->
								<div class="tit">
									<a href="./list.php?tid=<?php echo $Tv['tid']; ?>" ><?php echo $t -> ITval($Tv['type']).'#'.$Tv['title']; ?></a>
								</div>
								<!-- 标题列表 - 参数 -->
								<div class="param-tag tag f">
									<span class="creator">创建者：
										<a href="./list.php?uid=<?php echo $Tv['userid']; ?>" ><?php echo $users -> Gname($Tv['userid']); ?></a>
									</span>
									<span class="fabu"><em><?php echo $t -> GTCcount($Tv['tid']); ?></em> 条内容</span>

									<?php if($t -> Iact($Tv['tid'])){ 	//活动标题参数 ?>
										<span class="time">剩余：<em><?php echo $t -> Gsurplus($Tv['tid']); ?></em></span>
										<span class="jine">奖金：<em class="golds"><?php echo $Tv['reward']; ?></em> <i>元</i></span>
										<?php echo $t -> ISnormal($Tv['tid']); ?>
										<span class="gold">金池：<em class="golds"><?php echo $Tv['price']; ?></em> <i></i> <b>(<?php echo $Tv['shareglod']/100;?>) </b></span>

										<?php if($Tv['invest']){		//如果标题开启了金池共享，则显示 ?>
										<span class="fenxiang">金池分享：<i class="title-share-scale"><?php echo $Tv['invest']; ?></i>% </span>
										<?php } ?>
									
										<?php if($t -> Gfirst($Tv['tid'])){	//如果有第一名则显示 ?>
											<!-- <span class="first">获胜者：<a href="./list.php?uid=<?php echo $t -> Gfirst($Tv['tid']); ?>"><?php echo $u -> Gname($t -> Gfirst($Tv['tid'])); ?></a></span> -->
										<?php } ?>

									<?php }else{	//专题参数 ?>
									<!-- <span class="shoucang"><em><?php echo $Tv['click']; ?></em> 人喜欢</span> -->
									<span class="guanzhu"><em><?php echo $t -> GFtotal($Tv['tid']); ?></em> 人关注</span>
									<?php } ?>

								</div>
								<!-- 标题列表 - 操作 -->
								<div class="use r">
									
									<?php if(($t -> INact($Tv['tid']) || $t -> Itype($Tv['tid'], 2)) && !$t -> Icreator($Tv['tid'])){	//有效的活动或者专题 且非创建者 则可关注和取消关注 ?>
										<a class="tip r" style="top:-33px;" href="javascript:;" note="提示语" >请登录！<i style="left: 25px;"></i></a>

										<?php if($t -> Ifollow($Tv['tid'])){ ?>
											<?php if($t -> Iact($Tv['tid'])){ 	//活动标题 ?>
												<a class="buy follow buy_follow r" href="./userAdd.php?tid=<?php echo $Tv['tid']; ?>" >去发布</a>
											<?php } ?>
										<?php }else{ ?>
											<?php if($t -> Iact($Tv['tid'])){ 	//活动标题 ?>
												<a class="buy follow r" href="javascript:;" >参与活动</a>
											<?php }else{	//专题 ?>
												<a class="buy follow r" href="javascript:;" >关注专题</a>
											<?php } ?>
										<?php } ?>
									<?php } ?>

									<a class="skip sh r" href="./list.php?tid=<?php echo $Tv['tid']; ?>" >全部内容</a>
								</div>
								<div class="c"></div>
								<div class="depict"><?php echo $Tv['content']; ?></div>
							</div>
						</div>
						<div class="c"></div>

						<!-- 标题列表 - 相关内容列表 -->
						<?php if($t -> Icon($Tv['tid'])){	//判断此标题是否有内容 	 ?>
						<div class="contentList" style="margin: 0 -15px 100px;" >

							<?php  foreach($t -> GTlist($Tv['tid']) as $key => $Cv){	//输出内容开始 	?>
								<div class="col<?php echo $c -> Ibuy($Cv['cid']) ? ' col_possess' : ''; ?> sh" style="width: 370px;margin: 0 15px;" cid="<?php echo $Cv['cid']; ?>" now="<?php echo $Cv['plus']; ?>" style="display: block;" >
									<div class="head">
										<div class="param-tag tag">
											<span class="name">BY：
												<a href="./list.php?uid=<?php echo $Cv['userid']; ?>" title="访问TA" ><?php echo $u -> Gname($Cv['userid']); ?></a>
											</span>
											<span class="time"><?php echo $o -> Cdate($Cv['base']); ?></span>
											<div class="c"></div>
										</div>
									</div>
									<div class="cont">
										<div class="gui gui_<?php echo $Cv['types']; ?>">
											<?php echo $c -> IGcontrol($Cv['cid']); ?>
											<i class="purchase">+</i><em></em>
											<div class="c"></div>
										</div>

										<?php if($c -> Itxt($Cv['cid'])){	//如果有文本则显示展开按钮 ?>
										<div class="txt" <?php if($Cv['types'] ==0){ echo "style='max-height: 198px;'"; } ?>>
											<div class="are"><?php echo $Cv['content']; ?></div>
										</div>
										<?php } ?>

										<div class="use">
											<div class="num f"><span class="gold golds" n="<?php echo $Cv['plus']; ?>"></span> <i>元</i></div>
										
											<?php if($u -> Guid()){	//登录后显示的提示 ?>
												<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<?php }else{			//未登录后显示的提示 ?>
												<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
											<?php } ?>

											<?php if($c -> Ibuy($Cv['cid'])){		//如果可以查看 ?>
												<a class="buy confirmBtn purchase r" href="./detail.php?cid=<?php echo $Cv['cid']; ?>" >去评论</a>
												<?php if($c -> Itxt($Cv['cid'])){	//如果有文本则显示展开按钮 ?>
													<a class="skip look r" href="javascript:;" >展开</a>
												<?php } ?>
											<?php }else{  //需要购买 ?>
												<a class="buy confirmBtn purchase r" href="javascript:;" >买买买</a>
												<a class="skip look r" href="./detail.php?cid=<?php echo $Cv['cid']; ?>" >评论</a>
											<?php } ?>	

										</div>
									</div>
								</div>
							<?php } //输出内容结束 -------------------------------- ?>

							<div class="c"></div>
						</div>
						<?php } ?>
					<?php } //输出内容结束 -------------------------------- ?>
				</div>
				<div class="c"></div>
				<?php } ?>

				<!-- 分页 -->
				<div class="paging" total="<?php echo $total; ?>" number="<?php echo $number; ?>" current="<?php echo $page; ?>" >
					<div class="paging-use"></div>
					<div class="paging-link">
						<div class="paging-link-fill"></div>
					</div>
				</div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//挂接关注和取消关注
		$('.titleCol').attention();

		//挂接购买按钮
		$('.purchase').purchase();

		//挂接已购买的内容为可查看图片
		$('.col_possess').picture();

		//挂接已购买的内容为可查看文本
		$('.col_possess').writing();

		//修改 余额显示
		$('.amount').each(function(){
			var val = goldShow($(this));
			$(this).html( val.num +' '+ val.unit );
		});

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

