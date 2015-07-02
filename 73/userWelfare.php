<?php
	
	//引用公共文件
	include("./comm/base.php");	
	
	//设置选择菜单
	Global $ect;
	$ect="user";

	//引用样式头部
	include("./comm/head.php");
?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>
				<div class="leftarea f">

					<!-- 我拥有的徽章 -->
					<div class="commarea badgeHead">
						<div class="content">
							<div class="head">
								<div class="tit f"><em>我的徽章 / 福利</em></div>
								<div class="gap"><i></i></div>
							</div>
							<div class="c"></div>
						</div>
						<div class="bottomSide"></div>
					</div>

					<?php if(count($ub -> Gbadge())){ ?>
						<!-- 输出全部 我拥有的徽章 -->
						<div class="badgeList ">
							<?php foreach($ub -> Gbadge() as $BLk => $BLv ){ //输出内容开始 --------------------------------  
								$bid = $BLv['sid'];
								$img = $BLv['icon'];
								$name = $BLv['name'];
								$cue = $BLv['depict'];
								$num = $BLv['welfare'];
								$btn = $BLv['icon'] != "new" || $u -> Gplus() < 10;		//如果是新手福利则进行判断，用户条件是否足够
								$can = !$ub -> Ireceive($BLv['sid']) ? 'no' :'';		//判断是否可以领取
							?>
								<div class="col" bid="<?php echo $bid; ?>" >
									<div class="left">
										<div class="icon"><i class="<?php echo $img; ?>"></i></div>
										<div class="name"><?php echo $name; ?></div>
									</div>
									<div class="text"><?php echo $cue; ?></div>
									<div class="right">
										<div class="price">
											<span><em class="golds"><?php echo $num; ?></em> 分</span>
										</div>
										<?php if( $can ){ ?>
											<div class="btn"><a class="cupid-green theirBenefits" href="javascript:;" >领取</a></div>
										<?php } ?>
									</div>
									<div class="received <?php echo $can; ?>" ></div>
								</div>
							<?php } //输出内容结束 -------------------------------- ?>
						</div>
					<?php }else{ ?>
						<div class="noContent badgeNot"></div>
					<?php } ?>

					<!-- 全部徽章 -->
					<div class="commarea badgeHead" style="margin-top: 90px;">
						<div class="content">
							<div class="head">
								<div class="tit f"><em>未获得的徽章</em></div>
								<div class="gap"><i></i></div>
							</div>
							<div class="c"></div>
						</div>
						<div class="bottomSide"></div>
					</div>

					<!-- 输出全部徽章 -->
					<div class="badgeList">
						<?php foreach ($ub -> Gspecial() as $k => $v) { //输出内容开始 --------------------------------
							$is = !$ub -> IBbe($v['sid']);
							$sid = $v['sid'];
							$img = $v['icon'];
							$name = $v['name'];
							$cue = $v['depict'];
							$BLgain	= $ub -> IBPbuy($v['sid']);	//判断是的需要购买
							$style = $ub -> IBFcn($v['gain']);
							$num = $BLgain['num'];
							$txt = $ub -> IBfree($v['gain']);
							if ( $is ) { ?>
								<div class="col" bid="<?php echo $sid; ?>" >
									<div class="left">
										<div class="icon"><i class="<?php echo $img; ?>"></i></div>
										<div class="name"><?php echo $name; ?></div>
									</div>
									<div class="text">
										<?php echo $cue; ?>
										<div class="tip">
											<div class="result">恭喜！领取成功。<p><a href="javascript:history.go(0);" title="">刷新页面</a> 后领取福利</p></div>
										</div>
									</div>
									<div class="right">
										<div class="price"><span><?php echo $BLgain['str']; ?></span></div>
										<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
										<div class="btn">
											<a class="<?php echo $style; ?>" href="javascript:;" gain="<?php echo $num; ?>" ><?php echo $txt; ?></a>
										</div>
									</div>
								</div>
						<?php }
						} //输出内容结束 -------------------------------- ?>
					</div>
				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>

	<!-- 教程 - 能力篇 -->
	<div class="course course-user no">
		<div class="course-dialog"><i></i>
			<p>能力篇</p>
			<p>这里的一切，您随便掌握一门就能变成高能。</p>
			<p>所有的能力都可以根据自己的需要购买，不过有些技能是有限制的。</p>
			<p>但是，</p>
			<p>看您我也是有缘人，今天就让免费送你一个技能。</p>
			<p class="tip">提示：技能经常使用能提升技能等级和对应的效果。</p>
			<div class="btn">
				<a href="javascript::">选哪个好呢</a>
				<a href="javascript::">知道了</a>
			</div>
		</div>
		<div class="c"></div>
		<img class="course-figure" src="./course/5.gif" />
	</div>

	<!-- 教程 - 选哪个好呢 -->
	<div class="course course-user">
		<div class="course-dialog"><i></i>
			<p>每个技能都有详细说明，不过这么多还是会眼花缭乱。</p>
			<p>淡定，让我们先想想要在这怎么玩？</p>

			<p>赚钱路线：学习收益类技能，例如：
				每日福利：每天领取相应的福利(100)；
				推广牛人：发布内容时，可以支付相应的金额让自己的内容上首页(100)；
				翻倍：短时间内指定的内容收入翻倍，每天可以使用相应的次数(100)；
				一呼百应：邀请好友，当好友成文平民后得到相应的奖励（100）
				账单数据：在查看自己的最近30天的收入情况，以及发布内容的详细数据(100)等。</p>

			<p>娱乐路线：学习特效类技能，例如：
				变脸：可以更换表情(100)；
				雇员：可以更换提现信息人物(100)；
				皮肤：可以更换背景(100)；
				收藏夹：可以查看自己所有点赞过的内容；(100)；
				体验：体验最近的功能(100)等。</p>

			<p>疯狂路线：学习破坏类技能，例如：
				陨石：首页相应数量的内容扣相应百分比的分(200)；
				静止：短时间内容指定内容无法被点赞(100)；
				盗窃：短时间指定内容的收入为自己所有(100)；
				禁言：短时内用户无法评论(100)；
				失足：短时间内发布内容消耗增高(100)等。</p>

			<p>自由路线：学习保护类技能，例如：
				翅膀：用户永久免除静止、盗窃伤害(100)；
				单挑：指定一个用户如果对方接受两人开启挑战指定时间内得分比拼，赢家得两人收入(100)；
				芳芳的朋友：不定时的可以领取福利或者其他什么惊喜。(100)；
				朋友圈：可以关注指定的用户（100）；
				牛仔：用户永久免除禁言、失足伤害(100)等。</p>

			<p>团队路线：学习群体类技能，例如：
				守护：指定数量用户短时间内容免除陨石、静止、盗窃伤害(300);
				分享：指定数量用户短时间拥有自己的所有技能（除了分享）(200)、
				战旗：指定数量用户短时间消费减少相应数量(200)、
				祝福：指定数量用户短时间内收入得到相应的百分比增长(200)、
				组团：组建一个队伍，可以邀请和移除成员，每周需缴纳维护费，按人数收费(300)等</p>

			<p>热门玩法就推荐这么多，刚来到此处可以参考这些。当你了解了这里以后，就可以玩出自己的特色。</p>
			<p class="tip">提示：每个用户最多只能拥有7种不同的能力。</p>
			<div class="btn">
				<a href="javascript::">好的</a>
				<a href="javascript::">不</a>
			</div>
		</div>
		<div class="c"></div>
		<img class="course-figure" src="./course/6.gif" />
	</div>

	<script type="text/javascript">

		//可领取的徽章 前置
		// $('.receiveBadge').each(function(){
		// 	$(this).parents('.col').prependTo( $(this).parents('.badgeList') );
		// });

		//获得徽章 事件及动画
		function getBadge( col ){

			//获取元素
			var col = col,
				tip = col.find('.tip');

			var glory = $('.glory');

			console.log("specialProvide="+ col.attr('bid'));

			//交互数据
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "specialProvide="+ col.attr('bid'),
				success: function(msg){
					console.log( msg );
					if(msg != 1){	//如果没有领取成功
						col.find('.receiveBadge').html('领取失败');

					}else{

						//加载数据
						tip.slideDown();
						
						//显示结果
						tip.find('.result').fadeIn();

						//动画
						var are = col.find('.icon'),
							ico = are.find('i').clone();
							are.append(ico);

						//初始化
						var target = { top:0, left:0 },
							object = { top:0, left:0 };

						//获取元素参数
						glory.each(function(i){
							target.top = $(this).context.getBoundingClientRect().top + $(document).scrollTop();
							target.left = $(this).context.getBoundingClientRect().left + $(document).scrollLeft();
						});
						ico.each(function(i){
							object.top = $(this).context.getBoundingClientRect().top + $(document).scrollTop();
							object.left = $(this).context.getBoundingClientRect().left + $(document).scrollLeft();
						});

						//执行动画
						ico.animate({top: (target.top - object.top + 20), left: (target.left - object.left + 250), width: 10, height: 10, opacity: 1, border:" 1px solid white" }, 1000,function(){

							var iconame = ico.attr('class');

							//添加图标
							glory.append("<a class='"+ iconame +"' href='javascript:;'' title='"+ name +"' ></a>");
							glory.find('.'+ iconame).hide().show('slow');

							//隐藏动画
							ico.remove();
						});
					}
				}
			});
		}

		//点击领取
		$('.receiveBadge').click(function(){

			//获取元素
			var btn = $(this),
				col = $(this).parents('.col'),
				tip = col.find('.tip');

			var glory = $('.glory');

			//获取参数
			var icon = col.find('.icon i').attr('class'),
				name = col.find('.name').html();

			//如果是购买的话，则扣除 样式余额
			if( $(this).html() == "购买" ){

				//获取参数元素
				var userGold = $('#userGold'),
					userSide = $('#userInfoGold');

				//获取卖价
				var sellingPrice = parseInt($(this).attr('gain'));

				var number = parseInt(userGold.val());
					number = number - parseInt($(this).attr('gain'));

				if( number >= 0 ){

					userSide.attr('n', number);
					userSide.golds();
					userGold.val(number);

					// $('#userGold').val(gold);
					// $('#userInfoGold').html(gold/100);

					getBadge(col);
				}else{
					$(this).parent().prev().show();
				}
			}

			//如果是免费领取的
			if( $(this).html() == "领取" ){
				getBadge(col);
			}

			//隐藏结果
			// setTimeout(function(){
			// 	tip.slideUp();
			// }, 5000);

		});


		//领取福利
		$('.theirBenefits').click(function(){

			//获取元素
			var btn = $(this),
				col = $(this).parents('.col'),
				cue = col.find('.received');

			//提示
			btn.html('领取中...');

			//交互数据
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "UserReceiveLog="+ col.attr('bid'),
				success: function(msg){
					// console.log( msg );

					var num = parseInt(msg);

					if( num > 0 ){

						//样式提示
						btn.html('领取成功');
						cue.removeClass('no');

						//获取参数元素
						var userGold = $('#userGold'),
							userSide = $('#userInfoGold');

						//获取参数
						var number = parseInt(userGold.val()) + num;

						userSide.attr('n', number);
						userSide.golds();
						userGold.val(number);

					}else{
						btn.html('已领取过');
					}
				}
			});

		});



		//成为会员
		$('#becomeVip').click(function(){
			if( $('#userplus').val() > 100 ){
				if( confirm("确认开通会员吗？") ){
					$('#becomevipLoad').slideDown();
					$.ajax({
						type: "POST",
						url: "./ajax/ajax_user.php",
						data: "becomeVip=true",
						success: function(msg){
							// console.log( msg );
							$('#becomeVip').hide().after("<p class='isvip'>你已经成为会员。</p>");
							$('#becomevipLoad').find('.ok').fadeIn(function(){
								setTimeout(function(){
									$('#becomevipLoad').slideUp();
								},2000);
							});
						}
					});
				}
			}else{
				alert("你的金币不足！");
			}
		});

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>