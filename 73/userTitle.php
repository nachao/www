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

									<?php 
									$titStyleClass = '';
									if($t -> Itype($Tv['tid'] ,1)){	//如果是活动
										$titStyleClass = 'tit-activity';
									}
									if($t -> Itype($Tv['tid'] ,2)){	//如果是专题
										$titStyleClass = 'tit-special';
									} ?>
									<div class="tit <?php echo $titStyleClass; ?>" >
										<a href="./list.php?tid=<?php echo $Tv['tid']; ?>"><?php echo $title -> ITval($Tv['type'])."#". $Tv['title']; ?></a>
									</div>

									<!-- 我的标题列表	#参数们 -->
									<div class="param-tag tag f j-title-param">
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
											<span class="jine">奖金：<em class="golds j-title-reward" n="<?php echo $Tv['reward']; ?>"></em> <i></i></span>

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

									<?php if(!$t -> Ipass($Tv['tid'])){		//如果还是处于待审核状态，则不能操作标题 ?>
									<div class="use r  j-title-use">

										<?php if($Tv['userid'] == $u -> Guid()){ //如果查看用户为创建者，则可以管理	?>

											<?php if($t -> Ifail($Tv['tid'])){ 		//如果未通过审核 ?>
												<a class="buy r" href="./titleApply.php?id=<?php echo $Tv['tid']; ?>" >修改</a>
											<?php } ?>
											<?php echo time(); ?>
											<?php if($t -> IOact($Tv['tid'])){ 	//活动标题已结束 ?>
												<a class="buy closeTitle r use-btn-end j-btn-title-close" href="javascript:;" >确认结束活动</a>
											<?php } ?>
											
											<?php if($t -> Itype($Tv['tid'], 2) && !$t -> IWpay($Tv['tid'])){ 	//专题如果不能交纳维护费 ?>
												<a class="buy closeTitle r" href="javascript:;" >确认关闭专题</a>
											<?php } ?>

											<?php if($t -> GCtime($Tv['tid']) && !$t -> IOact($Tv['tid'])){  //正常状态下 ?>
												<a class="buy manage r j-btn-title-manage" href="javascript:;" >管理</a>
											<?php } ?>

										<?php }else{ //如果不是创建者，则可以关注此标题	?>
											<?php if(!$uid && isset($_GET['Ta'])){ ?>
											<a class="buy sh follow buy_follow r" href="javascript:;" >取消关注</a>
											<?php } ?>
										<?php } ?>

										<a class="skip sh r" href="./list.php?tid=<?php echo $Tv['tid']; ?>" >查看内容</a>
										
										<?php if(isset($_GET['Ta']) && $Tv['invest']){	//如果标题开启的金池共享，关注着则可以管理标题 ?>
										<div class="r" style="margin-right:15px;">
											<div class="use-invest" >

												<?php if($t -> IUinvest($Tv['tid'])){	//判断是否有投资过 ?>
													<?php $investInfo = $t -> GUinvest($Tv['tid']); ?>
													<span>拥有分享金：<i class="possess-invest-scale"><?php echo sprintf("%.2f", $investInfo['sum']/$t -> GTIsum($Tv['tid'])*100); ?></i>%</span>
												<?php }else{ ?>
													<span class="j-possess-invest-info">还未参加</span>
												<?php } ?>

											</div>
											<a class="use-invest-btn j-btn-share-manage" href="javascript:;" >共享管理</a>
										</div>
										<?php } ?>
									</div>
									<?php } ?>

									<div class="c"></div>
								</div>

								<?php if($Tv['userid'] == $u -> Guid() && $t -> GCtime($Tv['tid'])){ //如果当前访问者是题主且标题状态正常，则可以管理	?>
									<!-- 题主管理界面 -->
									<div class="depict j-title-manage" style="display: none;">
										<div class="txt">
											<textarea class="cue j-manage-depict" def="<?php echo $o -> Ccode($Tv['content']); ?>"><?php echo $o -> Ccode($Tv['content'], 1); ?></textarea>

											<?php if($t -> Iact($Tv['tid'])){	//如果是活动，则可以调整代付金额 ?>
												<div class="radio j-manage-assist-def" selection="<?php echo $Tv['shareglod']; ?>" >
													<span class="names s1">单次代付金</span>
													<label><input type="radio" name="days" value="1" /><em>0.01</em>元</label>
													<label><input type="radio" name="days" value="2" /><em>0.02</em>元</label>
													<label><input type="radio" name="days" value="3" /><em>0.03</em>元</label>
													<label><input type="radio" name="days" value="4" /><em>0.04</em>元</label>
													<label><input type="radio" name="days" value="5" /><em>0.05</em>元</label>
													<label><input type="radio" name="days" value="6" /><em>0.06</em>元</label>
													<input type="hidden" name="money" class="j-manage-assist" value="<?php echo $Tv['shareglod']; ?>" />		
												</div>
											<?php } ?>

											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 190px;">金池注入（单位：0.01 元）</span>
												<div class="modified" max="<?php echo  $u -> Gplus(); ?>">
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt j-manage-sum">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip j-tip-sum r" href="javascript:;" title="">您的金额不足！<i></i></a>
												<span class="radio-hint">从账户余额转入。</span>
											</div>

											<?php if($t -> Itype($Tv['tid'], 2)){	//专题标题可以将金池的金额提现至余额里 ?>
											<div class="radio">
												<span class="names s1" style="width: 190px;">金池提现（单位：0.01 元）</span>
												<div class="modified" max="<?php echo $price; ?>">
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt j-manage-withdraw">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip j-tip-withdraw r" href="javascript:;" title="">超出了金池里的金额！<i></i></a>
												<span class="radio-hint">将金池内的金额转至用户余额中。</span>
											</div>
											<?php } ?>
											
											<?php if($t -> Iact($Tv['tid'])){	//活动标题才可以添加奖金 ?>
											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 190px;">增加奖金（单位：0.01 元）</span>
												<div class="modified" max="<?php echo $price; ?>" min="0" >
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt j-manage-reward">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip j-tip-reward r" href="javascript:;" title="">金池金额不足！<i></i></a>
												<span class="radio-hint">从金池中转入。</span>
											</div>
											<?php } ?>
											
											<!-- 由于余额代扣逻辑比较复杂，暂时关闭
											<div class="radio" selection="<?php echo $Tv['withholding']; ?>" >
												<span class="names s1" style="width:120px;">余额代扣开启</span>
												<label><input type="radio" name="days" value="1" />关闭</label>
												<label><input type="radio" name="days" value="2" />开启</label>
												<input type="hidden" name="withholding" value="<?php echo $Tv['withholding']; ?>" />		
											</div>
											-->

											<?php if($t -> Iact($Tv['tid'])){	//活动标题才可以开启此功能 ?>
												<?php if($Tv['invest']){		//如果开启了金池共享 ?>
													<div class="radio" style="overflow: inherit;">
														<span class="names s1" style="width: 155px;">增加金池共享百分比</span>
														<div class="modified" max="80" min="<?php echo $Tv['invest']; ?>" >
															<input type="button" value="-" class="btn prev">
															<input type="text" value="<?php echo $Tv['invest']; ?>" class="txt j-manage-invest-scale" style="width: 50px;" readonly="readonly">
															<input type="button" value="+" class="btn next">
														</div>
														<a class="modifiedTip r" href="javascript:;" title="">您的金额不足！<i></i></a>	
														<span class="radio-hint">比例只能添加无法减少。</span>
													</div>
												<?php }else{ ?>
													<div class="radio" selection="1" >
														<span class="names s1" style="width:120px;">金池共享开启</span>
														<label><input type="radio" name="days" value="0" />关闭</label>
														<label><input type="radio" name="days" value="1" />开启</label>
														<input type="hidden" class="j-manage-invest" value="0" />		
														<span class="radio-hint">提示：开启后无法关闭</span>
													</div>
												<?php } ?>
											<?php } ?>

											<input class="confirm amend r j-title-manage-affirm" type="button" value="确认修改" />
											<a href="javascript:;" class="depict-link j-title-manage-close" >关闭</a>
											<div class="prompt"><div>修改成功</div></div>
											<div class="c"></div>
										</div>
									</div>
								<?php } ?>
								
								<?php if(isset($_GET['Ta']) && 1){	//如果当前访问者是关注者且标题开启了共享功能，则可以管理。 ?>
									<!-- 资助管理界面 -->
									<div class="depict j-share-manage" style="display: none;">
										<div class="txt">
											<div class="radio radio-data" style="margin-top: 0px;" >

												<?php //判断是否有投资过
												if($t -> IUinvest($Tv['tid'])){
													$investInfo = $t -> GUinvest($Tv['tid']);
													$investInput = $investInfo['sum'];
													$investIncome = intval($price *$Tv['invest'] /100 *($investInfo['sum'] /$t -> GTIsum($Tv['tid'])));
												}else{ 
													$investInput = 0;
													$investIncome = 0;
												} ?>
											
												<p class="input">已投入金额：<em n="<?php echo $investInput; ?>" class="golds possess-invest-input"></em> <i>元</i></p>
												<p class="income">预计回报：<em class="golds possess-invest-sum" n="<?php echo $investIncome; ?>"></em> <i>元</i></p>
											</div>
											<div class="radio" style="overflow: inherit;">
												<span class="names s1" style="width: 215px;">投资金额注入（单位：0.01 元）</span>
												<div class="modified" max="<?php echo  $u -> Gplus(); ?>">
													<input type="button" value="-" class="btn prev">
													<input type="text" value="0" class="txt j-possess-invest-add">
													<input type="button" value="+" class="btn next">
												</div>
												<a class="modifiedTip r j-tip-invest" href="javascript:;" >您的金额不足！<i></i></a>
											</div>
											<input class="confirm amend r j-share-manage-affirm" type="button" value="确认" />
											<a href="javascript:;" class="depict-link j-share-manage-close" >关闭</a>
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
		$('.j-btn-share-manage').click(function(){
			$(this).parents('.col').find('.j-share-manage').stop().slideToggle();
		});

		//关闭投资界面
		$('.j-share-manage-close').click(function(){
			$(this).parents('.col').find('.j-share-manage').slideUp();
		});

		//标题管理界面
		$('.j-btn-title-manage').click(function(){
			$(this).parents('.col').find('.j-title-manage').stop().slideToggle();
		});

		//关闭标题管理界面
		$('.j-title-manage-close').click(function(){
			$(this).parents('.col').find('.j-title-manage').slideUp();
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

		//修改记录
		$('.col').each(function(){
			var day = $(this).find('input[name="days"]'),
				num = $(this).find('input[name="money"]');
			day.click(function(){
				num.val( $(this).val() );
			});
		});

		//修改标题
		$('.j-title-manage-affirm').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid'),

				//获取管理界面的 标题描述
				MDepict = col.find('.j-manage-depict'),
				MDepictVal = MDepict.val(),

				//获取管理界面的修改 单次代付金
				MAssistNum = parseInt(col.find('.j-manage-assist').val()),

				//获取管理界面的是否开启 余额代付 ----此功能暂时关闭
				MwitNum = parseInt(col.find('input[name="withholding"]').val()),
				MwitNum = MwitNum ? MwitNum : 0;
				
				//获取管理界面的 金池比例 元素及数值
				MScaleInput = col.find('.j-manage-invest-scale'),
				MScaleNum = parseInt(MScaleInput.val()),

				//获取管理界面的 是否开启金池共享功能
				MInvest = col.find('.j-manage-invest').val(),

				//获取管理界面的 添加金池元素及金额
				MSumInput = col.find('.j-manage-sum'),
				MSum = parseInt(MSumInput.val()),

				//获取管理界面的 添加奖金元素及金额
				MRewardInput = col.find('.j-manage-reward'),
				MRewardNum = parseInt(MRewardInput.val()),

				//获取管理界面的 金池提现元素及金额
				MWithdrawInput = col.find('.j-manage-withdraw'),
				MWithdrawNum = parseInt(MWithdrawInput.val()),

				//获取用户余额
				userSum = $(1).ABalance();


			//获取标题金池元素及金额
			var TSum = col.find('.title-sum'),
				TSums = parseInt(TSum.attr('n'));

			//获取标题 金池代付金 元素及金额
			var TAssistObj = col.find('.j-title-shareglod'),
				TAssistNum = parseInt(TAssistObj.html());

			//获取标题奖金元素及金额
			var TReward = col.find('.j-title-reward'),
				TRewards = parseInt(TReward.attr('n'));

			//获取标题金池共享比例元素及数值
			var TScaleObj = col.find('.title-share-scale'),
				TScaleNum = parseInt(TScaleObj.html())/100;

			//获取标题金池共享金额元素及金额
			var TSharingObj = col.find('.title-share-sum'),
				TSharingNum = parseInt(TScaleNum*TSums);		//此数据如果修改后无法使用，但需要此公式


			//判断增加金池的金额是否大于账户余额
			if(MSum && MSum > $(1).ABalance()){
				var tip = col.find('.j-tip-sum').fadeIn();
				setTimeout(function(){ tip.hide(); }, 3000);
				return false;
			}

			//判断增加奖金的金额是否大于金池余额
			if(MRewardNum && MRewardNum > TSums){
				var tip = col.find('.j-tip-reward').fadeIn();
				setTimeout(function(){ tip.hide(); }, 3000);
				return false;
			}

			//判断是否有进行过操作
			var MOperate = 0;

			//判断是否修改过描述
			if(MDepictVal != MDepict.attr('def')){
				MOperate = 1;
			}

			//判断是否修改过单次代付金
			if(MAssistNum && MAssistNum != col.find('.j-manage-assist-def').attr('selection')){
				MOperate = 1;
			}

			//判断是否修增加了金池
			if(!!MSum){
				MOperate = 1;
			}

			//判断是否修增加了奖金
			if(!!MRewardNum){
				MOperate = 1;
			}

			//判断是否修金池提现
			if(!!MWithdrawNum){
				MOperate = 1;
			}

			//判断是开启了金池共享功能
			if(MInvest == 1){
				MOperate = 1;
				MScaleNum = 20;
			}

			//如果没有操作者终止提交
			if(MOperate == 0){
				return;
			}

			//以上判断都通过的话，切换成等待动画
			tip = col.find('.prompt');
			tip.slideDown();
			col.find('.modifiedTip').hide();	//隐藏所有提示框

			// console.log( "titleAdmin="+ tid +"&cue="+ cue +"&modified="+ addSum +"&shareglod="+ num +"&withholding="+ wit +"&scale="+ scale +"&reward="+ reward );
			
			//提交数据
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "titleAdmin="+ tid +"&cue="+ MDepictVal +"&modified="+ MSum +"&shareglod="+ MAssistNum +"&withholding="+ MwitNum +"&scale="+ MScaleNum +"&reward="+ MRewardNum +"&withdraw="+ MWithdrawNum,
				success: function(msg){ 
					// console.log(msg);

					//提示操作成功
					tip.find('div').show();
					setTimeout(function(){
						tip.slideUp();
					}, 1000);

					//如果开启了金池共享则刷新页面
					if(MInvest == 1){
						history.go(0);
					}

					//修改页面标题的数据	----------------------------------

					//如果操作了 修改单次代付金
					if(TAssistNum != MAssistNum){
						TAssistObj.html(MAssistNum/100);
					}

					//如果操作了 金池注入
					if(MSum){
						userSum = $().ABalance(-MSum);	//刷新用户金额
						TSums += MSum;
						TSum.attr('n', TSums).golds();								//刷新标题金池显示金额
						TSharingObj.attr('n', parseInt(TSums*TScaleNum)).golds();	//刷新标题金池共享金额

						MSumInput.parent('.modified').attr('max', userSum);			//刷新注入金额的上限
					}

					//如果操作了 添加奖金
					if(MRewardNum){
						TSums -= MRewardNum;
						TRewards += MRewardNum;
						TReward.attr('n', TRewards).golds();						//刷新标题 奖金 显示金额
						TSum.attr('n', TSums).golds();								//刷新标题 金池 显示金额
						TSharingObj.attr('n', parseInt(TSums*TScaleNum)).golds();	//刷新标题 金池共享 显示金额

						MRewardInput.parent('.modified').attr('max', TSums);		//刷新 添加奖金 的上限
					}

					//如果修改了 共享比例
					if(MScaleNum != TScaleNum*100){
						TScaleObj.html(MScaleNum);	
						TScaleNum = MScaleNum/100;									//刷新标题 金池共享比例
						TSharingObj.attr('n', parseInt(TSums*TScaleNum)).golds();	//刷新标题 金池共享 显示金额

						MScaleInput.parent('.modified').attr('min', MScaleNum);		//刷新修改 金池共享比例 的下限
					}

					//如果操作了 金池提现
					if(MWithdrawNum){
						userSum = $().ABalance(+MWithdrawNum);	//刷新用户金额
						TSums -= MWithdrawNum;
						TSum.attr('n', TSums).golds();								//刷新标题金池显示金额
						MWithdrawInput.parent('.modified').attr('max', TSums);		//刷新注入金额的上限
					}
				}
			});
		});

		//关闭标题
		$('.j-btn-title-close').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid');

			//显示关闭加载动画

			//去掉元素
			// col.css({ overflow: 'hidden' }).animate({ height: 100 });
			col.find('.head').animate({ height: 100 },function(){
				col.find('.j-title-use').hide();
				col.find('.j-title-param').hide();
			});

			// $.ajax({
			// 	type: "POST",
			// 	url: "./ajax/ajax_user.php",
			// 	data: "titleClose="+ tid,
			// 	success: function(msg){ 
			// 		// var num = parseInt($('#userGold').val()),
			// 		// 	add = parseInt(msg);
			// 		// $('#userGold').val(num+add);
			// 		// $('#userInfoGold').html(num+add).golds();
			// 		// $('#headGold').html(num+add).golds();
			// 		col.slideUp(function(){
			// 			$(this).remove();
			// 		});
			// 	}
			// });
		});

		//投资操作
		$('.j-share-manage-affirm').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid'),
				gold = col.find('.gold b'),

				//获取管理界面的 当前总投入 的元素和金额
				MInputObj = col.find('.possess-invest-input'),
				MInputNum = parseInt(MInputObj.attr('n')),

				//获取管理界面 预计收入金额 的元素和金额
				MIncomeObj = col.find('.possess-invest-sum'),
				MIncomeNum = parseInt(MIncomeObj.attr('n')),

				//获取管理界面的 投资金额注入 数值
				MinvestObj = col.find('.j-possess-invest-add'),
				MinvestNum = parseInt(MinvestObj.val());


			//获取用户余额
			var userSum = $(1).ABalance();

			//获取标题金池元素及金额
			var TSum = col.find('.title-sum'),
				TSums = parseInt(TSum.attr('n'));

			//获取标题金池共享比例元素及数值
			var TScaleObj = col.find('.title-share-scale'),
				TScaleNum = parseInt(TScaleObj.html())/100;

			//获取标题金池共享金额元素及金额
			var TSharingObj = col.find('.title-share-sum'),
				TSharingNum = parseInt(TScaleNum*TSums);		//此数据如果修改后无法使用，但需要此公式

			//获取标题的全部收到的投资
			var	TinvestObj = col.find('.title-invest-sum'),			//标题投资总金额
				TinvestNum = parseInt(TinvestObj.val()); 


			//判断注入投资的金额是否大于用户余额
			if(MinvestNum && MinvestNum > userSum){
				var tip = col.find('.j-tip-invest').fadeIn();
				setTimeout(function(){ tip.hide(); }, 3000);
				return false;
			}

			//判断是否有进行过操作
			if(MinvestNum <= 0){
				return false;
			}


			//以上判断都通过的话，切换成等待动画
			tip = col.find('.prompt');
			tip.slideDown();
			col.find('.modifiedTip').hide();	//隐藏所有提示框

			// console.log("shareManage="+ tid +"&number="+ MinvestNum);

			//提交后台数据
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "shareManage="+ tid +"&number="+ MinvestNum,
				success: function(msg){ 
					// console.log(msg);

					//提示操作成功
					tip.find('div').show();
					setTimeout(function(){
						tip.slideUp();
					}, 1000);

					//判断是否首次投资
					if(!MInputNum){

						//添加显示比例元素
						col.find('.j-possess-invest-info').html("拥有分享金：<i class='possess-invest-scale'>0</i>%");
					}

					//获取管理按钮的 拥有金池共享百分比 的元素及数值
					var MscaleObj = col.find('.possess-invest-scale'),
						MscaleNum = parseInt(MscaleObj.html());

					
					//修改页面标题的数据 ---------------------------

					//刷新金池
					TSums += MinvestNum;
					TSum.attr('n', TSums).golds();

					//刷新共享总金额
					TSharingNum = parseInt(TScaleNum*TSums);
					TSharingObj.attr('n', TSharingNum).golds();

					console.log(MInputNum);

					//刷新我的已投入总金额
					MInputNum += MinvestNum;
					MInputObj.attr('n', MInputNum).golds();

					//刷新总投资金额
					TinvestNum += MinvestNum;
					TinvestObj.val(TinvestNum);

					//刷新拥有分享金比例
					MscaleNum = (MInputNum/TinvestNum*100).toFixed(2);
					MscaleObj.html(MscaleNum);

					//刷新预计收入金额
					MIncomeNum = parseInt(TSharingNum*MscaleNum/100);
					MIncomeObj.attr('n', MIncomeNum).golds();
					
					//刷新可注入的最大金额	
					userSum = $().ABalance(-MinvestNum);
					MinvestObj.parent('.modified').attr('max', userSum);
				}
			});
		});



	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

