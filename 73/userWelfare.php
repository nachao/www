<?php
	
	//引用公共文件
	include("./comm/base.php");	
	
	//设置选择菜单
	Global $ect;
	$ect="user";

	//引用样式头部
	include("./comm/head.php");

	/*-------------------------------
	
	收益类：翻倍、推广牛人、每日福利、一呼百应、实时数据。

	
	------------------------------------*/
?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>
				<div class="badgeList ">

					<?php if(count($ub -> Gbadge())){ ?>
						<!-- 输出全部 我拥有的徽章 -->
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
										<div class="icon"><i class="iconfont <?php echo $img; ?>"></i></div>
										<div class="name"><?php echo $name; ?></div>
										<div class="progress">
											<span class="progress-txt">● 0%</span>
											<span class="progress-con"></span>
										</div>
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

					<?php }else{ ?>
						<!-- <div class="noContent badgeNot"></div> -->
					<?php } ?>

						<!-- 输出全部徽章 -->
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
								<div class="col col-full" bid="<?php echo $sid; ?>" >
									<div class="left">
										<div class="icon"><i class="iconfont <?php echo $img; ?>"></i></div>
										<div class="name"><?php echo $name; ?></div>
										<div class="progress">
											<span class="progress-txt">● 0%</span>
											<span class="progress-con"></span>
										</div>
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
				<div class="c"></div>
			</div>
		</div>
		
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