<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//引用样式头部
	include("./comm/head.php");

	//如果没有参数则返回列表页
	$cid = 0;
	if( !isset($_GET['cid']) ){
		$u -> UtoL('./list.php');
		$cid = $_GET['cid'];
	}

	//当前位置
	$position = 'detail';
?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage detailpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f">

					<?php 
					//是否有参数，和 参数是否有指定 id 的内容 
					$cis = $_GET['cid'] && (isset($_GET['cid']) && $c -> Ibe($_GET['cid']));
					if($cis){ 
						//获取参数
						$cid = $_GET['cid'];
						$con = $c -> Ginfo($cid); 	?>
						<div class="contentList" style="margin:0px;" cid="<?php echo $cid; ?>" >
							<div class="col<?php echo $c -> Ibuy($con['cid']) ? ' col_possess' : ''; ?>" cid="<?php echo $con['cid']; ?>" now="<?php echo $con['plus']; ?>" style="display: block;" >

									<!-- 标示 -->
									<?php if($con['effects'] == 1){	//如果是顶 ?>
										<div class="effects effects-very" alt="作者顶贴" ></div>
									<?php } ?>

									<?php if($con['effects'] == 2){	//如果是推荐 ?>
										<div class="effects effects-recommend" alt="题主推荐" ></div>
									<?php } ?>

									<div class="head">
										<?php if(!isset($_GET['id'])){	//判断是否有标题，则不显示标题 ?>
											<div class="tit <?php echo $con['titleid'] <= 0 ? 'no' : ''; ?>">
												<a href="./list.php?tid=<?php echo $con['titleid']; ?>" ><?php echo $t -> Gtitle($con['titleid']); ?></a>
											</div>
										<?php } ?>
										<div class="param-tag tag">
											<span class="name">BY：
												<a href="./list.php?uid=<?php echo $con['userid']; ?>" title="访问TA" ><?php echo $u -> Gname($con['userid']); ?></a>
											</span>
											<span class="time"><?php echo $o -> Cdate($con['base']); ?></span>
											<span class="shoucang"><a href="javascript:;"  ><?php echo $con['click'] ? $con['click'] : 0; ?></a> 人喜欢</span>
											<span class="liuyan"><a href="javascript:;"  ><?php echo $um -> Gtotal($con['cid']); ?></a> 条留言</span>
											<div class="c"></div>
										</div>
									</div>
									<div class="cont">
										<div class="gui gui_<?php echo $con['types']; ?>" <?php if($con['types'] == 1){ echo "style='margin: 10px 10px 0  10px;'"; } ?>>
											<?php echo $c -> IGcontrol($con['cid']); ?>
											<i class="purchase">+</i><em></em>
											<div class="c"></div>
										</div>

										<?php if($c -> Itxt($con['cid'])){	//如果有文本则显示展开按钮 ?>
											<div class="txt" style="max-height: 78px;">
												<div class="are" style="font-size:14px;line-height: 26px;color: #333;"><?php echo $o -> Ccode($con['content']); ?></div>
											</div>
										<?php } ?>
										
										<div class="use">
											<div class="num f"><span class="gold golds" n="<?php echo $con['plus']; ?>"></span> <i></i></div>
										
											<?php if($u -> Guid()){	//登录后显示的提示 ?>
												<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<?php }else{			//未登录后显示的提示 ?>
												<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
											<?php } ?>

											<?php if($c -> Ibuy($con['cid'])){		//如果可以查看 ?>
												<?php if($c -> Itxt($con['cid'])){	//如果有文本则显示展开按钮 ?>
													<a class="skip look r" href="javascript:;" >展开</a>
												<?php } ?>
											<?php }else{  //需要购买 ?>
												<a class="buy confirmBtn purchase r" href="javascript:;" >买买买</a>
											<?php } ?>

										</div>
									</div>
								</div>
						</div>
						
						<!-- 分页 -->
						<div class="page">
							<a class="btn prev f" href="./list.php" title="" ><i>&lt;&lt;</i>返回世界</a>
							<!-- <a class="btn next r" href="#" title="" >下一篇<i>&gt;&gt;</i></a> -->
						</div>
						<div class="c"></div>

						<?php $kdescribe	= $u -> Gdepict($c -> Gauthor($_GET['cid']));
						if($kdescribe && 0){ 	?>
							<!-- 作者 -->
							<div class="commarea detailAuthor">
								<div class="content">
									<div class="head">
										<div class="tit f"><em>作者</em></div>
										<div class="gap"><i></i></div>
									</div>
									<div class="depict"><?php echo $kdescribe; ?></div>
									<div class="">
										<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
										<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
									</div>
									<div class="c"></div>
								</div>
								<div class="bottomSide"></div>
							</div>
						<?php } ?>

						<!-- 相关内容 -->
						<div class="commarea detailAuthor">
							<div class="content">
								<div class="head">
									<div class="tit f"><em>相关内容</em></div>
									<!-- 切换 -->
									<div class="TAGaround">
										<a class="prev" href="javascript:;" title="">&lt;</a>
										<a class="next" href="javascript:;" title="">&gt;</a>
									</div>
									<div class="gap"><i></i></div>
								</div>
								<div class="interrelated">
									<div class="area">
										<?php foreach ($c -> Ginterfix($cid) as $k => $con) {	//输出内容开始 --------------------------------
											$Atype		= $con['types']; ?>
										<div class="col">
											<a href="?cid=<?php echo $con['cid']; ?>" >
												<?php if($Atype==0){ ?><div class="con"><?php echo $con['content']; ?></div><?php } ?>
												<?php if($Atype==1){ ?>
													<div class="pic" style="background-image: url(<?php echo $c -> Gimage($con['cid']); ?>);"></div>
												<?php } ?>
												<?php if($Atype==2){ ?>
													<embed class="gif" src="<?php echo $c -> Gvideo($con['cid']); ?>" quality="high" wmode="Opaque" width="100%" height="100%" align="middle" allowscriptaccess="always" allowfullscreen="true" mode="transparent" type="application/x-shockwave-flash">
												<?php } ?>
												<?php if($Atype==3){ ?>
													<embed class="mp3" src="<?php echo $c -> Gmusic($con['cid']); ?>" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent" />
												<?php } ?>
												<div class="info">
													<div class="txt"><?php if( $Atype!=0 ){ echo $con['content']; } ?></div>
													<div class="ico">
														<span class="time"><?php echo $o -> Cdate($con['base']); ?></span>
														<span class="word"><i>99</i>条留言</span>
													</div>
												</div>
											</a>
										</div>
										<?php } ?>
										<div class="c"></div>
									</div>
								</div>
								<div class="c"></div>
							</div>
							<div class="bottomSide"></div>
						</div>
						
						<?php if(0 && $um -> ICmessage($_GET['cid'])){ ?>
							<!-- 显示全部留言 -->
							<div class="commarea detailAuthor">
								<div class="content">
									<div class="head">
										<div class="tit f"><em>留言</em></div>
										<div class="gap"><i></i></div>
									</div>

									<?php //留言显示

									//参数
									$begin = 1;
									$pages = 10;

									//获取分页
									if( isset($_GET['p']) && is_numeric($_GET['p']) ){
										$begin = $_GET['p'];
									} ?>
									<div class="messageList" id="messageList">
										<?php //输出内容开始 --------------------------------
										// $uid = kis() ? kid() : uid();
										foreach ($um -> GCmessage($_GET['cid']) as $MLkey => $MLv) {
											$HCid 		= $MLv['id'];
											$HCuid 		= $MLv['speaker'];
											$HCname 	= $u -> Gname($MLv['speaker']);
											$HCicon 	= $u -> Gicon($MLv['speaker']);
											$HCtime 	= $o -> Cdate($MLv['time'], 1);	
											$HCcontent 	= $MLv['content'];
											$HCreply	= '';//$MLv['huifuuid'] ? '' : 'primary';
											$HCcomeId	= '';//$MLv['originate'];
											$HChuifuMid	= '';//$MLv['huifumid'];
											$HCcomeIcon	= '';//uidGIcon($MLv['originate']);
											$HCcomeName = '';//uidGName($MLv['originate']);
											$HCcomeIcon	= '';//uidGIcon($MLv['originate']);
											$HCreplyTo	= '';//$MLv['originate'] ? " <a href='#' >@".uidGName($uid)."</a>" : '';
											// $HCreplyName= $MLv['huifu'];	?>
											<div class="row <?php echo $HCreply; ?>" mid="<?php echo $HCid; ?>" >
												<div class="link"></div>
												<div class="icon f">
													<a href="./userMessage.php?k=<?php echo $HCuid; ?>" ><img src="<?php echo $HCicon; ?>"/></a>
													<?php if( $HCcomeId && $HCcomeId != $uid ){ ?>
													<a class="source" href="./userMessage.php?k=<?php echo $HCcomeId; ?>" title="来自 <?php echo $HCcomeName; ?> 的留言板" ><img src="<?php echo $HCcomeIcon; ?>" /></a>
													<?php } ?>
												</div>
												<div class="info">
													<div class="user f">
														<div class="name"><a class="promulgator" uid="<?php echo $HCuid; ?>" href="./userMessage.php?k=<?php echo $HCuid; ?>" title=""><?php echo $HCname; ?></a><?php echo $HCreplyTo; ?></div>
														<div class="time"><?php echo $HCtime; ?></div>
													</div>

													<?php if($u -> Guid() && $HCuid != $u -> Guid()){	//如果不是本人的留言，则可以回复 ?>
														<div class="reply operateReply r"><a href="javascript:;" title="">回复</a></div>
													<?php } ?>

													<?php if($u -> Guid() && $u -> Guid() == $c -> Gauthor($_GET['cid'])){	//如果是发布者，则可删除留言 ?>
														<div class="reply delete operateDelete r" ><a href="javascript:;" >删除留言</a></div>
														<div class="reply affirm operateAffirm">
															<a href="javascript:;" class="affirmCancel" >取消</a>
															<a href="javascript:;" class="affirmDelete" >确认</a>
														</div>
													<?php } ?>

													<div class="text f"><?php echo $HCcontent; ?></div>
												</div>
												<div class="c"></div>
											</div>
											<?php //输出 回复内容开始 --------------------------------
											// $HF = getHuifuMessage($HCid);
											// echo count($HF);
											if( 0 && !!count($HF) ){	?>
											<div class="hfAllMessage">
											<?php
												foreach ($HF as $HFk => $HFv) {
												$HFid 		= $HFv['id'];
												$HFuid 		= $HFv['userid'];
												$HFname 	= uidGName($HFv['userid']);
												$HFicon 	= uidGIcon($HFv['userid']);
												$HFtime 	= dateChange($HFv['lastdate'], 1);	
												$HFcontent 	= $HFv['content'];
												$HFreply	= $HFv['huifumid'] ? 'huifu' : '';
												$HFreplyTo	= $HFv['huifuuid'] ? " <a href='#' >@".uidGName($HFv['huifuuid'])."</a>" : ''; 		?>
												<div class="row <?php echo $HFreply; ?>" mid="<?php echo $HFid; ?>" >
													<div class="link"></div>
													<div class="icon f"><a href="./userMessage.php?k=<?php echo $HFuid; ?>" ><img src="./effigy/<?php echo $HFicon; ?>"/></a></div>
													<div class="info">
														<div class="user f">
															<div class="name"><a class="promulgator" uid="<?php echo $HFuid; ?>" href="./userMessage.php?k=<?php echo $HFuid; ?>" title=""><?php echo $HFname; ?></a><?php echo $HFreplyTo; ?></div>
															<div class="time"><?php echo $HFtime; ?></div>
														</div>
														<?php if($HFuid != uid()){ ?>
														<div class="reply operateReply r"><a href="javascript:;" title="">回复</a></div>
														<?php } ?>
														<?php if( uis() && !kis()){ ?>
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
											</div>
											<?php } ?>

											<?php  //回复分页
											// $HPtota = hfPageNum($HCid);
											if( 0 &&$HPtota > 1 ){ ?>
												<div class="pages hfpages"><?php hfPageBtn($HPtota); ?></div>
											<?php } ?>

										<?php } ?>
									</div>
									<div class="c"></div>
								</div>
								<div class="bottomSide"></div>
							</div>
						<?php } ?>
						
						<!-- 添加留言
						<div class="commarea detailAuthor">
							<div class="content">
								<div class="head">
									<div class="tit f"><em>添加留言</em></div>
									<div class="gap"><i></i></div>
								</div>
								<div class="messageForm">
									<?php  if( isset($_GET['addMessage']) && $_GET['addMessage'] ){	//提交留言
										if($um -> Amessage($_GET['addMessage'], $u -> Guid(), $_GET['cid'])){
											$u -> UtoL("./detail.php?c=".$cid."&message=1");
										}
									} ?>

									<?php if(isset($_GET['message'])){  //如果留言成功 ?>
										<input type="hidden" value="1" id="addMessageOk" />
									<?php } ?>

									<form method="get" onsubmit="return tijiao();" style="position:relative;" >
										<textarea id="txtAre" class="txt" name="addMessage"></textarea>
										<input type="hidden" name="p" value="<?php echo 0; ?>" />
										<input id="huifuMid" type="hidden" name="huifuMid" value="" />
										<input id="huifuUid" type="hidden" name="huifuUid" value="" />
										<a class="prompt-tip f" id="messageNo" href="javascript:;" style="left: 15px;right: auto;top: 213px;">登录后，便可留言。<i></i></a>
										<input id="huifuSub" class="btn" type="submit" value="提交留言" />
										<input type="hidden" name="c" value="<?php echo $_GET['cid']; ?>" />
									</form>
								</div>
								<div class="c"></div>
							</div>
							<div class="bottomSide"></div>
						</div>
						 -->

					<?php }else{ ?>
					<div class="msgwu msgwu"></div>
					<?php } ?>

					<div class="c"></div>
				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//遍历所有内容
		// $('.col').each(function(){
		// 	var col = $(this);

		// 	//如果已买则挂接查看事件
		// 	if( col.hasClass('col_possess') ){
		// 		// confirm(col);
		// 	}

		// 	//判断并处理控件
		// 	var gui = col.find('.gui');
		// 	if( gui.hasClass('gui_0') ){		//文字
		// 		gui.remove();
		// 	}else if( gui.hasClass('gui_1') ){	//图片
		// 		gui.find('embed').remove();

		// 		//默认打开
		// 		gui.find('img').click();

		// 		//如果图片宽度不够，则显示图片尺寸
		// 		if( gui.find('img').width() < gui.width() ){
		// 			// gui.width( gui.find('img').width() );
		// 		}
		// 	}else if( gui.hasClass('gui_2') ){	//视频
		// 		gui.find('.img,.mp3,.sawtooth,.bigimg').remove();
		// 	}else if( gui.hasClass('gui_3') ){	//音乐
		// 		gui.find('.img,.gif,.sawtooth,.bigimg').remove();
		// 	}

		// });

	
		var loop;
		function tijiao(){
				
			//如果没有登录，则无法留言
			if($('#userIs').val() == 0){
				clearTimeout(loop);
				var tip = $('#messageNo');
				tip.show();
				loop = setTimeout(function(){
					tip.fadeOut();
				}, 3000);
				return false;
			}
		}

		//如果已购买则删除 查看详细按钮
		// $('.col_possess .buy').remove();

		//如果留言成功
		$(document).ready(function(){


			if($('#addMessageOk').length){
				var top = 0;
				$('#messageList').each(function(i){
					top = $(this).context.getBoundingClientRect().top;
				});
				console.log(top);
				$(window).scrollTop(top);
			}
		
		

			//挂接购买按钮
			$('.purchase').purchase();

			//挂接已购买的内容为可查看图片
			var open = $('#addMessageOk').length ? 0: 1;
			$('.col_possess').picture(open);

			//挂接已购买的内容为可查看文本
			$('.col_possess').writing();

			//删除留言
			$('#messageList').deleteMessage();
			
			//如果是购买的话，则赞开文字
			$('.col_possess .skip').click();

		});



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


		//发布留言
		$('#messagePBtn').click(function(){
			var cid = $('.contentList').attr('cid'),
				obj = $('#messagePText'),
				text = obj.val().replace(/\s/g, '');
			if( text != '' ){
				$.g({
					name: 'addMessage',
					data: { 'cid': cid, 'txt': text },
					result: function(value){
						obj.val('');
						$(window).commentIn(value);

						//如果是游客则刷新积分
						if ( $('#pop-3').length ) {
							$(window).updateSum(-1);
						}
					}
				});
			}
		});

		
		//获取指定内容的全部评论
		function messageList () {
			var cid = $('.contentList').attr('cid'),
				page = parseInt($('.message-current-num span').html());
			$.g({
				name: 'getM',
				data: { 'cid': cid, 'page': page },
				result: function(value){
					$(window).commentIn(value);

					//输出页数按钮
					value = JSON.parse(value);
					var total = value.total,
						number = value.number,
						page = Math.ceil(total / number);

					var contain = $('.message-current-use').empty(),
						message = $('.message-page');
					if ( page ) {
						for ( var i = 1; i <= page; i++ ) {
							contain.append('<a href="javascript:;" >'+ i +'</a>');
						}
						contain.find('a').click(function(){
							$('.message-current-num span').html($(this).html());
							messageList();
						});
						message.show();
					}
				}
			});
		}
		messageList();

		//选择评论页数



		//相关切换
		var TAGaround = 1;
		var width = $('.interrelated .col').length * 365 -730;
		$('.TAGaround .next').click(function(){
			if( TAGaround ){
				TAGaround = 0;
				var a = $('.interrelated .area'),
					v = parseInt(a.css('left'));
				v = -730 + v;
				v = v < -width ? -width : v;
				if( v <= -width ){
					$(this).addClass('act');
					$('.TAGaround .prev').removeClass('act');
				}
				a.stop().animate({ left: v },function(){
					TAGaround = 1;
				});
			}
		});
		$('.TAGaround .prev').click(function(){
			if( TAGaround ){
				TAGaround = 0;
				var a = $('.interrelated .area'),
					v = parseInt(a.css('left'));
				v = +730 + v;
				v = v >= 0 ? 0 : v;
				if( v >= 0 ){
					$(this).addClass('act');
					$('.TAGaround .next').removeClass('act');
				}
				a.stop().animate({ left: v },function(){
					TAGaround = 1;
				});
			}
		});

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>