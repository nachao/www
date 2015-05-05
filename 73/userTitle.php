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
					<?php if($u -> Guid() && $uid == $u -> Guid()){ //登录后可见 ?>
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
											<em class="golds" n="<?php echo $price; ?>" ><?php echo $price; ?></em> <i></i>

											<?php if($t -> Iact($Tv['tid'])){ 	//如果是活动类则显示此参数（单次分享金） ?>
												<b>(<?php echo $Tv['shareglod']/100; ?>)</b>
											<?php } ?>

										</span>
										<span class="fabu"><em><?php echo $Tv['number']; ?></em> 条内容</span>

										<?php if($t -> Iact($Tv['tid'])){ 	//活动类显示参数 ?>
											<span class="time">剩余：<em><?php echo $t -> Gsurplus($Tv['tid']); ?></em></span>
											<span class="jine">奖金：<em class="golds"><?php echo $Tv['reward']; ?></em> <i></i></span>
											<?php if($t -> Gfirst($Tv['tid'])){ 	//如果有第一名则显示
												$t -> Ufirst($Tv['tid'], $t -> Gfirst($Tv['tid']));		//并刷新标记 ?>
												<span class="first">获胜者：<a href="./list.php?uid=<?php echo $t -> Gfirst($Tv['tid']); ?>"><?php echo $u -> Gname($t -> Gfirst($Tv['tid'])); ?></a></span>
											<?php  } ?>
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
										</div>
									<?php } ?>
									<div class="c"></div>
								</div>
								<div class="depict" style="display: none;">
									<div class="txt">
										<textarea class="cue"><?php echo $Tv['content']; ?></textarea>

										<?php if($t -> Iact($Tv['tid'])){	//如果是活动，则可以操作 ?>
										<div class="radio" selection="<?php echo $Tv['shareglod']; ?>" >
											<span class="names s1">单次分享金</span>
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
										<input class="confirm amend r" type="button" value="确认修改" />
										<div class="prompt"><div>修改成功</div></div>
										<div class="c"></div>
									</div>
								</div>
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

		//挂接关注和取消关注
		$('.titleCol').attention();
		
		/*====
		注入金币池
		====*/
		function scale( col ){

			var obj = col;

			var min = 0,
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
			scale( $(this) ); 
			$(this).find('.txt').blur(function(){
				console.log( $(this).val() );
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
		$('.amend').click(function(){
			var col = $(this).parents('.col'),
				tid = col.attr('tid'),
				cue = col.find('.cue').val(),
				num = col.find('input[name="money"]').val(),
				wit = col.find('input[name="withholding"]').val(),
				add = parseInt(col.find('.modified .txt').val()),
				gold = col.find('.gold b');

			//判断金币注入是否正确
			if(add && add > $('#userGold').val() ){
				col.find('.modifiedTip').fadeIn();
				setTimeout(function(){ col.find('.modifiedTip').hide(); }, 3000);
				return false;
			}
			tip = col.find('.prompt');
			tip.slideDown();
			console.log( "titleAdmin="+ tid +"&cue="+ cue +"&modified="+ add +"&shareglod="+ num +"&withholding="+ wit );
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "titleAdmin="+ tid +"&cue="+ cue +"&modified="+ add +"&shareglod="+ num +"&withholding="+ wit,
				success: function(msg){ 

					tip.find('div').show();
					gold.html('('+ parseInt(num)/100 +')');
					setTimeout(function(){
						tip.slideUp();
					}, 1000);

					//如果有注入金，则修改页面数量
					if( add > 0 ){
						var ug = parseInt($('#userGold').val());
							ug = ug - add;
						$('#userGold').val(ug);
						$('#userInfoGold').html( ug/100 );
						col.find('.modified').attr('max', ug);	//刷新最大值

						var titPrice = col.find('.head .gold em'),
							newPrice = parseInt(titPrice.attr('n')) + add;
						// console.log( Number() +','+ add );
						// console.log( Number(col.find('.head .gold em').html()) +','+ add );
						titPrice.attr('n', newPrice);
						titPrice.html(newPrice);
						goldShow(titPrice);

						// col.find('.head .gold em').html( ((Number(col.find('.head .gold em').html())*100 + add)/100).toFixed(2) );
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




	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

