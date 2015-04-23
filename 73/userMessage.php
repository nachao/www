<?php
	
	
	//设置选择菜单
	Global $ect;
	$ect="message";		

	//引用公共文件
	include("./comm/base.php");

	//引用样式头部
	include("./comm/head.php");


	//是否访问其他用户
	$suid = 0;
	$seeUid = '';
	if(isset($_GET['uid'])){
		$seeUid = '&uid='.$_GET['uid'];	
		$suid = $_GET['uid'];
	}

	//刷新用户查看时间
	if($u -> Guid() && !$suid){
		$u -> UNmessage();
	}

	//留言显示参数
	$begin = 1;
	$pages = 10;

	//获取分页
	if( isset($_GET['p']) && is_numeric($_GET['p']) ){
		$begin = $_GET['p'];
	}

	//获取列表信息
	$MLcon = $um -> Gmessage($begin-1, $pages, $u -> Gcid());

	//判断当前留言板的用户 ID
	$uid = $u -> Ik() ? $u -> Gcid() : $u -> Gid();
?>

	<div class="container pagecon">
			<?php

			// include("./comm/pageHead.php");	//导入内页头部及导航 	?>

			<!-- 主体 -->
			<div class="main">
				<div class="userpage center">

					<!-- 操作栏 -->
					<div class="actionbar">
						<?php if($suid){	//访问时可见 ?>
						<a class="cupid-red user-icon r" href="./list.php?uid=<?php echo $suid; ?>" style="margin-top: 27px;" title=""><?php echo $u -> Gname($suid); ?></a>
						<?php } ?>
					</div>
					<div class="leftarea f">
					
						<?php if( !!count($MLcon) ){	//判断是否有内容 	 ?>
							<div class="commarea publishHead">
								<div class="content">
									<div class="head">
										<div class="tit f"><em>TA 的留言</em></div>
										<div class="gap"><i></i></div>
									</div>
									<div class="messageList">

										<?php foreach ($MLcon as $MLkey => $MLv) { //输出内容开始 --------------------------------
											$HCid  = $MLv['id'];
											$HCuid = $MLv['userid'];	?>
											<div class="row <?php echo $MLv['huifuuid'] ? '' : 'primary'; ?>" mid="<?php echo $HCid; ?>" >
												<div class="link"></div>
												<div class="icon f">
													<a href="./userMessage.php?k=<?php echo $HCuid; ?>" >
														<img src="./effigy/<?php echo $u -> Gicon($MLv['userid']); ?>"/>
													</a>

													<?php if($MLv['originate'] && $MLv['originate'] != $uid ){	//如果是别人回复的 ?>
														<a class="source" href="./userMessage.php?k=<?php echo $MLv['originate']; ?>" title="来自 <?php echo $u -> Gname($MLv['originate']); ?> 的留言板" >
															<img src="./effigy/<?php echo $u -> Gicon($MLv['originate']); ?>" />
														</a>
													<?php } ?>

												</div>
												<div class="info">
													<div class="user f">
														<div class="name">
															<a class="promulgator" uid="<?php echo $HCuid; ?>" href="./userMessage.php?k=<?php echo $HCuid; ?>" ><?php echo $u -> Gname($MLv['userid']); ?></a>
															<?php //echo $MLv['originate'] ? " <a href='#' >@".$u -> Gname($uid)."</a>" : ''; ?>
															<?php echo $MLv['huifuuid'] ? " <a href='./userMessage.php?k=".$MLv['huifuuid']."' >@".$u -> Gname($MLv['huifuuid'])."</a>" : ''; ?>
														</div>
														<div class="time"><?php echo $o -> Cdate($MLv['lastdate'], 1); ?></div>
													</div>

													<?php if($u -> Gid() && $HCuid != $u -> Gid()){	//如果是别人的留言则可以回复 ?>
														<div class="reply operateReply r"><a href="javascript:;" title="">回复</a></div>
													<?php } ?>

													<?php if($u -> Gid() && (!$u -> Gcid() || $u -> Gcid() == $u -> Gid())){	//如果再个人留言板则可以删除留言 ?>
														<div class="reply delete operateDelete r" ><a href="javascript:;" >删除留言</a></div>
														<div class="reply affirm operateAffirm">
															<a href="javascript:;" class="affirmCancel" >取消</a>
															<a href="javascript:;" class="affirmDelete" >确认</a>
														</div>
													<?php } ?>

													<div class="text f"><?php echo $MLv['content']; ?></div>
													<div class="c"></div>
												</div>
												<div class="c"></div>
											</div>

											<?php  $HF = $u -> GHmessage($HCid);//输出 回复内容开始 --------------------------------
											if( !!count($HF) && 0 ){	?>
											<!-- 	<div class="hfAllMessage no">

													<?php foreach ($HF as $HFk => $HFv) {
														$HFid 		= $HFv['id'];
														$HFuid 		= $HFv['userid']; 
														$HFcontent 	= $HFv['content'];
														$HFreply	= $HFv['huifumid'] ? 'huifu' : '';
														$HFreplyTo	= $HFv['huifuuid'] ? " <a href='#' >@".uidGName($HFv['huifuuid'])."</a>" : ''; 		?>
														<div class="row <?php echo $HFreply; ?>" mid="<?php echo $HFid; ?>" >
															<div class="link"></div>
															<div class="icon f">
																<a href="./userMessage.php?k=<?php echo $HFuid; ?>" >
																	<img src="./effigy/<?php echo $u -> Gicon($HFv['userid']); ?>"/>
																</a>
															</div>
															<div class="info">
																<div class="user f">
																	<div class="name">
																		<a class="promulgator" uid="<?php echo $HFuid; ?>" href="./userMessage.php?k=<?php echo $HFuid; ?>" title=""><?php echo $u -> Gname($HFv['userid']); ?></a><?php echo $HFreplyTo; ?>
																	</div>
																	<div class="time"><?php echo $o -> Cdate($HFv['lastdate'], 1); ?></div>
																</div>

																<?php if($HFuid != $u -> Gid()){		//个人的留言板 ?>
																	<div class="reply operateReply r"><a href="javascript:;" title="">回复</a></div>
																<?php } ?>

																<?php if($u -> Gid() && !$u -> Ik()){	//登录状态，且非访问状态下 ?>
																	<div class="reply delete operateDelete r" ><a href="javascript:;" >删除留言</a></div>
																	<div class="reply affirm operateAffirm">
																		<a href="javascript:;" class="affirmCancel" >取消</a>
																		<a href="javascript:;" class="affirmDelete" >确认</a>
																	</div>
																<?php } ?>
																<div class="text f"><?php echo $HFcontent; ?></div>
															</div>
															<div class="c"></div>
														</div>
													<?php } ?>

												</div> -->
											<?php } ?>

											<?php  $HPtota = $u -> GMpage($HCid); //回复分页
											if( $HPtota > 1 ){ ?>
												<!-- <div class="pages hfpages"><?php echo $u -> GHPbtn($HPtota, isset($_GET['p']) ? $_GET['p'] : 0); ?></div> -->
											<?php } ?>

										<?php } ?>

									</div>
									<div class="c"></div>

									<?php if($u -> GMBnum($pages, $u -> Gcid())-1){  //判断是否有分页按钮 ?>
										<div class="pages"><?php echo $u -> GMbtn($begin, $pages, $u -> Gcid()); ?></div>
									<?php } ?>

								</div>
								<div class="bottomSide"></div>
							</div>

						<?php }else{ //如果没有内容 ?>
							<div class="Ncon messageNot">
								<div class="are">
									<h1>没有留言</h1>
									<div class="cue">
										<p>不吐不快！</p>
									</div>
									<div class="btn">
										<?php if(!$u -> Gid()){	//用户在自己的个人中心可以见此按钮 ?>
										<a href="./login.php" title="">登录后可留言</a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>


						<?php if($u -> Gid()){ ?>
							<!-- 发布留言 -->
							<div class="commarea publishHead" style="margin-top: 60px;">
								<div class="content">
									<div class="head">
										<div class="tit f"><em>给 TA 留言</em></div>
										<div class="gap"><i></i></div>
									</div>
									<div class="messageForm">

										<?php if( isset($_GET['addMessage']) && $_GET['addMessage'] ){	//提交留言
											if( isset($_GET['k']) && $_GET['k'] ){
												$aim = $_GET['k'];
											}else{
												$aim = $u -> Gid();
											}
											$um -> Amessage( $aim, $_GET['addMessage'], $_GET['p'], $_GET['huifuMid'], $_GET['huifuUid']);
										}
										$uid = $u -> Ik() ? $u -> Gcid() : $u -> Gid();  ?>

										<form method="get" onsubmit="tijiao();" >
											<div id="txtDiv" class="txt" contentEditable=true ></div>
											<textarea id="txtAre" class="no" name="addMessage"></textarea>
											<?php if($u -> Ik()){ ?><input type="hidden" name="k" value="<?php echo $uid; ?>" /><?php } ?>
											<input type="hidden" name="p" value="<?php echo $begin; ?>" />
											<input id="huifuMid" type="hidden" name="huifuMid" value="" />
											<input id="huifuUid" type="hidden" name="huifuUid" value="" />
											<input id="huifuSub" class="btn" type="submit" value="提交留言" />
										</form>
									</div>
									<div class="c"></div>
								</div>
								<div class="bottomSide"></div>
							</div>
						<?php } ?>

					</div>
					<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
					<div class="c"></div>
				</div>
			</div>
	</div>
	<script type="text/javascript" src="./js/comm.js" ></script>
	<script type="text/javascript">

		//提交留言处理
		function tijiao(){
			formatting();
			$('#txtAre').val($('#txtDiv').html());
			console.log( $('#txtAre').val() );
		}
		


		// //删除确认
		// $('.operateDelete').click(function(){
		// 	$(this).hide();
		// 	$(this).siblings('.operateAffirm').show();
		// });

		// //取消删除
		// $('.affirmCancel').click(function(){
		// 	$(this).parent().hide().prev('.operateDelete').show();
		// });

		// //确认删除
		// $('.affirmDelete').click(function(){
		// 	var row = $(this).parents('.row');
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "./ajax/ajax_user.php",
		// 		data: "messageDel="+ row.attr('mid'),
		// 		success: function(msg){
		// 			// console.log( msg );
		// 			row.slideUp();

		// 			if( row.hasClass('primary') ){
		// 				row.nextUntil('.primary').slideUp();
		// 			}
		// 		}
		// 	});
		// });

		//清除样式
		$('#txtDiv').blur(function(){
			formatting();
		});

		//格式化html
		function formatting(){
			var a = $('#txtDiv'),
				t = a.html();
			function x(){
				if( t.indexOf('<') >= 0 && t.indexOf('>') > t.indexOf('<') ){
					t = t.replace(t.substring(t.indexOf('<'), t.indexOf('>')+1), '');	//去除格式
					x();
				}else{
					a.html(t.replace(/\s/g,'').substr(0, 200));		//去除空格，只保留 200字以内
				}
			}
			x();
		}



		//回复
		$('.operateReply').click(function(){
			hf($(this));
		});
		function hf(obj){
			var row = obj.parents('.row'),
				are = row.parent('.hfAllMessage'),
				mid = row.attr('mid');

			//判断
			if( !row.hasClass('primary') ){
				mid = are.prev('.primary').attr('mid');
			}

			var	user = row.find('.promulgator'),
				name = user.html(),
				uid  = user.attr('uid');

			$('#txtDiv').html("回复 "+ name +"：");

			$('#huifuUid').val(uid);
			$('#huifuMid').val(mid);

			var top = 0;
			$('.publishHead:last').each(function(i){
				top = $(this).context.getBoundingClientRect().top + $(document).scrollTop();
			});


			$('html,body').stop().animate({ scrollTop:top - ($(window).height() - $('.publishHead:last').height()) + 30 });
		}


		//回复的分页
		$('.hfpages').each(function(){
			var mid = $(this).prevAll('.primary').attr('mid'),
				are = $(this).prev('.hfAllMessage'),
				row = are.find('.row:first').clone(),
				top = 0;

			$(this).prevAll('.primary').each(function(i){
				top = $(this).context.getBoundingClientRect().top + $(document).scrollTop();
			});


			$(this).find('a').click(function(){
				$(this).addClass('act').siblings().removeClass('act');
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_message.php",
					data: "hfPage="+ $(this).index() +"&mid="+ mid +"&k="+ $('.userInfo').attr('userid'),
					success: function(msg){
						var arr = eval('('+ msg +')');
						console.log( $(arr).length );

						if( top < document.body.scrollTop ){
							$('html,body').stop().animate({ scrollTop:top },function(){ x(); });
						}else{
							x();
						}
						function x(){
							are.empty();
							$(arr).each(function(i,v){
								var col = row.clone();
								console.log( v );
								col.find('.icon img').attr('src', './effigy/'+ v.uicon);
								col.find('.name .promulgator').html(v.uname);
								col.find('.name a:last').html(v.reply);
								col.find('.time').html(v.time);
								col.find('.text').html(v.txt);								
								col.find('.operateReply').remove();
								if( v.huifu ){
									col.find('.user').after('<div class="reply operateReply r"><a href="javascript:;" title="">回复</a></div>');
								}
								col.find('.operateReply').click(function(){ hf($(this)); });
								are.append(col);

							});
						}

					}
				});
			}).eq(0).addClass('act');
		});

		// 回车
		document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if( e.ctrlKey && e.keyCode == 13 ){	// ctrl+enter 键
            	$('#huifuSub').click();
            }
        }; 


	</script>

<?php include("./comm/footer.php");	//引用底部 	?>