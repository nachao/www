<?php

	//引用公共文件
	include("./comm/base.php");		
	
	//设置选择菜单
	Global $ect;
	$ect="user";

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
					<?php if($seeUid && $u -> Ibe($uid)){	//访问，且访问的用户存在时可见 ?>
						<a class="cupid-red user-icon f" href="./list.php?uid=<?php echo $uid; ?>" style="margin: 28px 30px 0 0;line-height: 33px;" title=""><?php echo $u -> Gname($uid); ?></a>
					<?php } ?>
					<?php if($u -> Guid() && (($uid && $uid == $u -> Guid()) || !$uid)){ //登录后，访问别人或访问自己可见；或登录且非访问他人情况下可见 ?>
					<a class="cupid-green apply r" href="./userTitle-Apply.php" title="">申请 & 标题</a>
					<?php } ?>
					<a class="option <?php if(!isset($_GET['Ta'])){ echo "optionAct"; } ?>" href="?Me<?php echo $seeUid; ?>" >创建的</a>
					<a class="option <?php if(isset($_GET['Ta'])){ echo "optionAct"; } ?>" href="?Ta<?php echo $seeUid; ?>" >关注的</a>
				</div>

				<div class="leftarea f">
					<?php if(!$t -> IUThas($uid) && !isset($_GET['Ta'])){ 	//如果用户没有标题  ?>
						<div class="Ncon titleNot">
							<div class="are">
								<h1>此用户还没有创建标题！</h1>
								<div class="cue">发起活动：导演一场个性的骚动；<br />个人专题：创建一个专属频道。</div>
								<div class="btn">
									<?php if($u -> Guid()){ //登录后可见 ?>
									<a class="red" href="./userTitle-Apply.php" title="">立即申请</a>
									<?php } ?>
									<a href="./title.php" title="">更多标题</a>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if(!$t -> IHfollow(1, $uid) && isset($_GET['Ta'])){ 	//如果没有关注任何标题  ?>
						<div class="Ncon followNot">
							<div class="are">
								<h1>此用户没有关注的标题！</h1>
								<div class="cue">
									<p>参与别人发起的活动，分享发布消费，还能赢取丰厚奖金。</p>
									<p>关注喜欢的专题，每天都有五花八门的内容。</p>
								</div>
								<div class="btn">
									<?php if($u -> Guid()){ //登录后可见 ?>
									<a class="red" href="./userTitle-Apply.php" title="">立即申请</a>
									<?php } ?>
									<a href="./title.php" title="">更多标题</a>
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- 内容列表 -->
					<div class="contentList titleList titleManage" tote="<?php // echo contentNum(); ?>" >
						<?php  
						if(isset($_GET['Ta'])){				
							$list = $t -> GUFlist(1, $uid);		//获取用户关注的 全部标题，不显示用户自己创建的标题
						}else{
							$list = $t -> GUlist($uid);			//获取用户创建的 全部标题
						} ?>
						<?php foreach ($list as $key => $Tv) { 	//输出 全部标题 	?>

							<?php if($t -> Gcost($Tv['tid']) > 0){  	//判断是否需要维护
									if(!$t -> USMcharges($Tv['tid'])){	//如果没有维护成功
										if($t -> Gcost($Tv['tid']) > 300){	//如果连续超过3天无法维护
											$t -> Uclose($Tv['tid']);		//则系统关闭专题
											continue;
										}
									}
							} ?>

							<div class="col titleCol col_follow j_title_message sh" tid="<?php echo $Tv['tid']; ?>" >
								<div class="head">
									<div class="tit">
										<a href="./list.php?tid=<?php echo $Tv['tid']; ?>"><?php echo $title -> ITval($Tv['type'])."#". $Tv['title']; ?></a>
									</div>

									<!-- 我的标题列表	#参数们 -->
									<div class="param-tag tag f">
										<span class="creator">创建者：<a href="./list.php?uid=<?php echo $Tv['userid']; ?>" ><?php echo $users -> Gname($Tv['userid']); ?></a></span>

										<span class="gold">池：
											<?php $price = $t -> Gprice($Tv['tid']) ? $t -> Gprice($Tv['tid']) : 0; ?>
											<em class="golds title-sum" n="<?php echo $price; ?>" ><?php echo $price; ?></em> <i></i>

											<?php if($t -> Iact($Tv['tid'])){ 	//如果是活动类则显示此参数（单次分享金） ?>
												(<b class="j-title-shareglod"><?php echo $Tv['shareglod']/100; ?></b>)
											<?php } ?>

										</span>
										<span class="fabu"><em><?php echo $Tv['number']; ?></em> 条内容</span>

										<?php if($t -> Iact($Tv['tid'])){ 	//活动类显示参数 ?>
											<span class="time">剩余时间：<em><?php echo $t -> Gsurplus($Tv['tid']); ?></em></span>
											<span class="jine">奖金：<em class="golds"><?php echo $Tv['reward']; ?></em> <i></i></span>

											<?php if($t -> Gfirst($Tv['tid'])){ 	//如果有第一名则显示
												$t -> Ufirst($Tv['tid'], $t -> Gfirst($Tv['tid']));		//并刷新标记 ?>
												<span class="first">获胜者：<a href="./list.php?uid=<?php echo $t -> Gfirst($Tv['tid']); ?>"><?php echo $u -> Gname($t -> Gfirst($Tv['tid'])); ?></a></span>
											<?php  } ?>

											<?php if($Tv['invest']){		//如果标题开启了金池共享，则显示 ?>
											<span class="fenxiang">金池分享：<i class="title-share-scale"><?php echo $Tv['invest']; ?></i>% （<em class="golds title-share-sum" n="<?php echo intval($price*$Tv['invest']/100); ?>"></em> <i></i>）</span>
											<?php } ?>
											<input type="hidden" class="title-invest-sum" value="<?php echo $t -> GTIsum($Tv['tid']); ?>" />

										<?php }else{ 	//专题显示参数 ?>									
											<span class="goumai"><em><?php echo $Tv['click']; ?></em> 人买</span>
										<?php } ?>

										<?php if($t -> Ipass($Tv['tid'])){	//判断是否通过审核 ?>
											<div class="iOs"></div>
										<?php } ?>

										<?php if($t -> Ifail($Tv['tid'])){	//判断是否未通过 ?>
											<div class="notPass">
												<div class="ico">!</div>
												<div class="tip">未通过！<br />原因：标题名你随便写的吧！</div>
												<!-- <a class="cupid-orange" href="#" title="">修改</a> -->
											</div>
										<?php } ?>

									</div>

									<?php
									 if(!$t -> Ipass($Tv['tid'])){		//如果还是处于待审核状态，则不能操作标题 ?>
										<div class="use r">

											<?php if($Tv['userid'] == $u -> Guid()){ //如果查看用户为创建者，则可以管理	?>

												<?php if($t -> Ifail($Tv['tid'])){ 		//如果未通过审核 ?>
													<a class="buy r" href="./titleApply.php?id=<?php echo $Tv['tid']; ?>" >修改</a>
												<?php } ?>
												
												<?php if($t -> IOact($Tv['tid']) || ($t -> Itype($Tv['tid'], 2) && !$t -> IWpay($Tv['tid']))){ 	//活动标题已结束 或者 专题如果不能交纳维护费 ?>
													<a class="buy closeTitle r" href="javascript:;" >关闭 (<?php echo $o -> Ctime($t -> GCtime($Tv['tid'])); ?>后自动关闭)</a>
												<?php } ?>

												<?php if($t -> GCtime($Tv['tid'])){  //正常状态下 ?>
													<a class="buy manage r" href="javascript:;" >管理</a>
												<?php } ?>

											<?php }else{ //如果不是创建者，则可以关注此标题	?>
												<?php if(!$uid && isset($_GET['Ta'])){ ?>
												<a class="buy sh follow buy_follow r" href="javascript:;" >取消关注</a>
												<?php } ?>
											<?php } ?>

											<a class="skip sh r" href="./list.php?tid=<?php echo $Tv['tid']; ?>" >查看内容</a>
											
											<?php if(isset($_GET['Ta']) && 1){	//如果标题开启的金池共享，关注着则可以管理标题 ?>
												<!-- 投资金额 -->
												<div class="r" style="margin-right:15px;">
												<?php if($t -> IUinvest($Tv['tid'])){	//如果用户有投资则显示数据 ?>
													<?php $investInfo = $t -> GUinvest($Tv['tid']); ?>
													<div class="use-invest">
														<span title="投入的越多占的比例越大">拥有分享金：<i class="possess-invest-scale"><?php echo sprintf("%.2f", $investInfo['sum']/$t -> GTIsum($Tv['tid'])*100); ?></i>%</span>
													</div>
													<a class="use-invest-btn" id="btn-share-manage" href="javascript:;" >管理</a>
												<?php }else{ ?>
													<div class="use-invest">
														<span>尚未参与</span>
													</div>
													<a class="use-invest-btn" id="btn-share-manage" href="javascript:;" >参与金池共享</a>
												<?php } ?>
												</div>
											<?php } ?>
										</div>
									<?php } ?>
									<div class="c"></div>
								</div>

								<?php if($Tv['userid'] == $u -> Guid() && $t -> GCtime($Tv['tid'])){ //如果当前访问者是题主且标题状态正常，则可以管理	?>
									<div class="depict" style="display: none;">
										<div class="txt">
											<textarea class="cue"><?php echo $Tv['content']; ?></textarea>

											<?php if($t -> Iact($Tv['tid'])){	//如果是活动，则可以调整代付金额 ?>
												<div class="radio" selection="<?php echo $Tv['shareglod']; ?>" >
													<span class="names s1">单次代付金</span>
													<label><input type="radio" name="days" value="1" /><em>0.01</em>元</label>
													<label><input type="radio" name="days" value="2" /><em>0.02</em>元</label>
													<label><input type="radio" name="days" value="3" /><em>0.03</em>元</label>
													<label><input type="radio" name="days" value="4" /><em>0.04</em>元</label>
													<label><input type="radio" name="days" value="5" /><em>0.05</em>元</label>
													<label><input type="radio" name="days" value="6" /><em>0.06</em>元</label>
													<input type="hidden" name="money" value="<?php echo $Tv['shareglod']; ?>" />		
												</div>
											<?php } ?>

											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 190px;">金池注入（单位：0.01 元）</span>
												<div class="modified" max="<?php echo  $u -> Gplus(); ?>">
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											</div>
											<div class="radio" selection="<?php echo $Tv['withholding']; ?>" >
												<span class="names s1" style="width:120px;">余额代扣开启</span>
												<label><input type="radio" name="days" value="1" />否</label>
												<label><input type="radio" name="days" value="2" />是</label>
												<input type="hidden" name="withholding" value="<?php echo $Tv['withholding']; ?>" />		
											</div>

											<?php if($Tv['invest']){		//如果开启了金池共享 ?>
												<div class="radio" style="overflow: inherit;">
													<span class="names s1" style="width: 155px;">增加金池共享百分比</span>
													<div class="modified" max="80" min="<?php echo $Tv['invest']; ?>" >
														<input type="button" value="-" class="btn prev">
														<input type="text" value="<?php echo $Tv['invest']; ?>" class="txt j-manage-invest-scale" style="width: 50px;" readonly="readonly">
														<input type="button" value="+" class="btn next">
													</div>
													<a class="modifiedTip r" href="javascript:;" title="">您的金额不足！<i></i></a>
												</div>
											<?php } ?>

											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 100px;">增加奖金</span>
												<div class="modified" max="<?php echo $price; ?>" min="0" >
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt j-manage-moneyAward" readonly="readonly">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											</div>

											<input class="confirm amend r" id="title-manage-affirm" type="button" value="确认修改" />
											<div class="prompt"><div>修改成功</div></div>
											<div class="c"></div>
										</div>
									</div>
								<?php } ?>
								
								<?php if(isset($_GET['Ta']) && 1){	//如果当前访问者是关注者且标题开启了共享功能，则可以管理。 ?>
									<div class="depict" id="share-manage" style="display: none;">
										<div class="txt">
											<div class="radio radio-data" style="margin-top: 0px;" >
												<p class="input">已投入金额：<em n="<?php echo $investInfo['sum']; ?>" class="golds possess-invest-input"></em> <i>元</i></p>
												<p class="income">预计回报：<em class="golds possess-invest-sum" n="<?php echo intval($price *$Tv['invest'] /100 *($investInfo['sum'] /$t -> GTIsum($Tv['tid']))); ?>"></em> <i>元</i></p>
											</div>
											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 215px;">投资金额注入（单位：0.01 元）</span>
												<div class="modified" max="<?php echo  $u -> Gplus(); ?>">
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											</div>
											<input class="confirm amend r" id="share-manage-affirm" type="button" value="确认" />
											<div class="prompt"><div>操作成功</div></div>
											<div class="c"></div>
										</div>
									</div>
								<?php } ?>

							</div>
						<?php } //输出内容结束 -------------------------------- ?>
						<div class="c"></div>
						<!-- <div class="loadMore"><a id="loadmore" href="javascript:;" >加载更多内容</a></div> -->
					</div>
				</div>
				<div class="rightarea r" ><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//操作共享界面
		$('#btn-share-manage').click(function(){
			$('#share-manage').toggle();
		});

		//挂接关注和取消关注
		$('.titleCol').attention();
		
		/*====
		注入金币池
		====*/
		function scale( col ){

			var obj = col;

			var min = obj.attr('min') ? obj.attr('min') : 0,
				max = obj.attr('max');

			var go;

			var arr = Array();

			function a( t, i ){var n = parseInt(t.val()) - 1; if( n >= min ){if( i >= 0 ){} }else{n = min; } t.val(n); }	//减
			function b(t, i){var n = parseInt(t.val()) + 1; if( n <= max ){if( i >= 0 ){} }else{n = max; } t.val(n); }	//加

			//快速选择
			function aa(t, i){ a(t, i); go = setTimeout(function(){ aa(t, i); }, 10); }
			function bb(t, i){ b(t, i); go = setTimeout(function(){ bb(t, i); }, 10); }
			function cc(){ clearTimeout( go ); }

			//刷新最大值
			function m(obj){
				max = parseInt(obj.parents('.modified').attr('max'));
				min = obj.parents('.modified').attr('min') ? parseInt(obj.parents('.modified').attr('min')) : 0;
			}


			obj.each(function(i){
				$(this).find("input[type='button']:first").mousedown(function(){ 
					var t = $(this).next();
					cc(); 
					m($(this));
					go = setTimeout(function(){ aa(t , i); }, 500); 
				}).mouseup(function(){
					cc(); 
					a( $(this).next(), i );
				}).mouseleave(function(){ 
					cc(); 
				});
				$(this).find("input[type='button']:last").mousedown(function(){ 
					var t = $(this).prev();
					cc(); 
					m($(this));
					go = setTimeout(function(){ bb(t , i); }, 500); 
				}).mouseup(function(){ 
					cc(); 
					b($(this).prev() , i ); 
				}).mouseleave(function(){ 
					cc(); 
				});
			});
		}

		//设置数量
		$('.modified').each(function(){
			scale($(this)); 
			$(this).find('.txt').blur(function(){
				$(this).val(parseInt($(this).val()));
			});
		});

		//显示管理
		$('.manage').click(function(){
			var col = $(this).parents('.col'),
				con = col.find('.depict');
			if( con.css('display') == "none" ){
				con.show();
			}else{
				con.hide();
			}
		});

		//修改记录
		$('.col').each(function(){
			var day = $(this).find('input[name="days"]'),
				num = $(this).find('input[name="money"]');
			day.click(function(){
				num.val( $(this).val() );
			});
		});

		//修改标题
		$('#title-manage-affirm').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid'),
				cue = col.find('.cue').val(),
				num = col.find('input[name="money"]').val(),
				wit = col.find('input[name="withholding"]').val(),
				add = parseInt(col.find('.modified .txt').val()),
				scale = parseInt(col.find('.j-manage-invest-scale').val()),
				gold = col.find('.j-title-shareglod');

			//判断金币注入是否正确
			if(add && add > $('#userGold').val() ){
				col.find('.modifiedTip').fadeIn();
				setTimeout(function(){ col.find('.modifiedTip').hide(); }, 3000);
				return false;
			}
			tip = col.find('.prompt');
			tip.slideDown();
			// console.log( "titleAdmin="+ tid +"&cue="+ cue +"&modified="+ add +"&shareglod="+ num +"&withholding="+ wit +"&scale="+ scale );
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "titleAdmin="+ tid +"&cue="+ cue +"&modified="+ add +"&shareglod="+ num +"&withholding="+ wit +"&scale="+ scale,
				success: function(msg){ 

					//提示操作成功
					tip.find('div').show();
					setTimeout(function(){
						tip.slideUp();
					}, 1000);

					//修改页面标题的数据
					//如果修改了代付金
					if(parseInt(gold.html()) != parseInt(num)){
						gold.html(parseInt(num)/100);
					}

					//如果修改金池
					var TSum = col.find('.title-sum'),
						TSums = parseInt(TSum.attr('n'));

					//如果修改了共享比例
					var SScale = col.find('.title-share-scale'),
						SScales = parseInt(SScale.html());
					if(scale != SScales){
						SScales = scale;
						SScale.html(SScales);
						col.find('.title-share-sum').attr('n', parseInt(TSums*(SScales/100))).golds();
						$('.j-manage-invest-scale').parent().attr('min', SScales);
					}

					//如果有注入金，则修改页面数量
					if( add > 0 ){
						var ug = parseInt($('#userGold').val());
							ug = ug - add;
						$('#userGold').val(ug);
						$('#userInfoGold').html( ug/100 );
						col.find('.modified').attr('max', ug);	//刷新最大值

						var titPrice = col.find('.head .gold em'),
							newPrice = parseInt(titPrice.attr('n')) + add;
						titPrice.attr('n', newPrice);
						titPrice.html(newPrice);
						goldShow(titPrice);
					}
				}
			});
		});

		//关闭标题
		$('.closeTitle').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid');
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "titleClose="+ tid,
				success: function(msg){ 
					var num = parseInt($('#userGold').val()),
						add = parseInt(msg);
					$('#userGold').val(num+add);
					$('#userInfoGold').html(num+add).golds();
					$('#headGold').html(num+add).golds();
					col.slideUp(function(){
						$(this).remove();
					});
				}
			});
		});

		//投资操作
		$('#share-manage-affirm').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid'),
				num = parseInt(col.find('.modified .txt').val()),
				gold = col.find('.gold b');

			//判断金币注入是否正确
			if(num && num > $('#userGold').val() ){		//如果金额不足则提示
				col.find('.modifiedTip').fadeIn();
				setTimeout(function(){ col.find('.modifiedTip').hide(); }, 3000);
				return false;
			}

			//显示数据交互中提示
			tip = col.find('.prompt');
			tip.slideDown();

			//提交后台数据
			// console.log("shareManage="+ tid +"&number="+ num);
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "shareManage="+ tid +"&number="+ num,
				success: function(msg){ 
					// console.log(msg);
					if(parseInt(msg) == 1){

						//提示操作成功
						tip.find('div').show();
						setTimeout(function(){
							tip.slideUp();
						}, 1000);

						//修改页面标题的数据
						//获取元素
						var sum 	= col.find('.title-sum'),					//当前标题的金池
							share 	= col.find('.title-share-scale'),			//标题共享比例
							total 	= col.find('.title-share-sum'),				//标题共享总金额
							invest 	= col.find('.title-invest-sum'),			//标题投资总金额
							input 	= col.find('.possess-invest-input'),		//当前投入总金额
							income 	= col.find('.possess-invest-sum'),			//预计收入金额
							scale 	= col.find('.possess-invest-scale');		//当前拥有分享金比例
						

						//获取参数
						var titSum	= parseInt(sum.attr('n')) +num,
							titScale = parseInt(share.html()) /100,

							investSum = parseInt(invest.val()) +num,	//所有用户投资总金额
							mySum = parseInt(input.attr('n')) +num,		//我的投资总金额

							incomeScale	= 0,				//我的收入比例，用户计算预计收入
							shareScale = mySum/investSum;	//我的投资占总投资金额的百分比，用户显示我的份额


						//输出在页面指定位置
						invest.val(investSum);									//刷新标题的投资总金额
						sum.attr('n', titSum).golds();							//刷新标题的金池
						total.attr('n', parseInt(titScale *titSum)).golds();	//刷新标题的共享总金额

						input.attr('n', mySum).golds();										//刷新我的投资总金额
						scale.html((shareScale*100).toFixed(2));							//刷新我的份额百分比
						income.attr('n', parseInt(shareScale *titScale *titSum)).golds();	//刷新我的预计收入


						//如果有注入金，则修改页面数量
						// if( add > 0 ){
						// 	var ug = parseInt($('#userGold').val());
						// 		ug = ug - add;
						// 	$('#userGold').val(ug);
						// 	$('#userInfoGold').html( ug/100 );
						// 	col.find('.modified').attr('max', ug);	//刷新最大值

						// 	var titPrice = col.find('.head .gold em'),
						// 		newPrice = parseInt(titPrice.attr('n')) + add;
						// 	titPrice.attr('n', newPrice);
						// 	titPrice.html(newPrice);
						// 	goldShow(titPrice);
						// }
					}
				}
			});
		});




	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

