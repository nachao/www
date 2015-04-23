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
		<?php

		// include("./comm/pageHead.php");	//导入内页头部及导航 	?>

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f" style="width: 800px;">
						
					<?php $Ulist = $c -> GUlist(0, 99, 0, 0, $u -> Ik() ? $u -> Gcid() : 0);					
					if(count($Ulist) > 0){ 	//如果有内容 ?>
						<div class="contentList" style="margin:0px;width: 100%;">
							
							<?php foreach($Ulist as $k => $v) {	//输出内容，或者指定标题的内容 		?>
								<div class="f col<?php echo $c -> Ibuy($v['cid']) ? ' col_possess' : ''; ?> col-user" cid="<?php echo $v['cid']; ?>" now="<?php echo $v['plus']; ?>" style="display: block;" >

									<!-- 标示 -->
									<?php if($v['effects'] == 1){	//如果是顶 ?>
										<div class="effects effects-very" alt="作者顶贴" ></div>
									<?php } ?>

									<?php if($v['effects'] == 2){	//如果是推荐 ?>
										<div class="effects effects-recommend" alt="题主推荐" ></div>
									<?php } ?>

									<div class="head">
										<div class="tit <?php echo $v['titleid'] <= 0 ? 'no' : ''; ?>">
											<a href="./list.php?tid=<?php echo $v['titleid']; ?>" ><?php echo $t -> Gtitle($v['titleid']); ?></a>
										</div>
										<div class="param-tag tag">
											<span class="name">BY：
												<a href="./list.php?uid=<?php echo $v['userid']; ?>" title="访问TA" ><?php echo $u -> Gname($v['userid']); ?></a>
											</span>
											<span class="time"><?php echo $o -> Cdate($v['base']); ?></span>
											<div class="c"></div>
										</div>
									</div>
									<div class="cont">
										<div class="gui gui_<?php echo $v['types']; ?>">
											<?php echo $c -> IGcontrol($v['cid']); ?>
											<i class="purchase">+</i><em></em>
											<div class="c"></div>
										</div>
										<div class="txt txt-big">
											<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
											<?php echo $v['content']; ?>
											<div class="are"><?php echo $v['content']; ?></div>
											<?php }else{ ?>
											<div class="are-not">———— 没有描述 ————</div>
											<?php } ?>
										</div>
										<div class="use use-user">
											<div class="use-user-data">
												<p>购买次数： <?php echo $v['click']; ?> 次</p>
												<p>获取收入： <span class="golds"><?php echo $v['plus']; ?></span> <i></i></p>
												<p>发布时间： <?php echo $o -> Cdate($v['base'], 1); ?></p>
												<?php if($v['revise']){ ?>
												<p>上次修改时间： <?php echo $o -> Cdate($v['revise'], 1); ?></p>
												<?php } ?>
											</div>
											<a class="buy confirmBtn purchase" href="./detail.php?cid=<?php echo $v['cid']; ?>" >去评论</a>
											<div class="special">
												<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
												<a class="skip look" href="javascript:;" >展开</a>
												<?php } ?>
												<?php if($u -> Guid() && !$u -> IVuser()){	//登录情况下，访问个人中心可以删除 ?>
												<a class="skip" href="./userAdd-Edit.php?cid=<?php echo $v['cid']; ?>" >编辑内容</a>
												<a class="skip delete" href="javascript:;" >删除</a>
												<div class="affirm">
													<a class="buy ackDelete" href="javascript:;" >确定</a>
													<a class="skip notDelete" href="javascript:;" >取消</a>
												</div>
												<?php } ?>
												<div class="c"></div>
											</div>
											<div class="c"></div>
										</div>
									</div>
								</div>
							<?php } //输出内容结束 -------------------------------- ?>

						</div>
					<?php }else{	//如果没有内容 ?>
						<div class="noContent userNot <?php if($u -> IVuser()){ echo "visitNot"; }	//如果访问他人	?>">
							<div class="are">
							
								<?php if($u -> Gid() && !$u -> IVuser()){	//用户在自己的个人中心可以见此按钮 ?>
									<a class="publish" href="./userAdd.php" title="">发<span>布</span></a>
								<?php } ?>

								<a class="stroll" href="./list.php" title="">去逛逛</a>
								<!-- <a class="stroll" href="javascript: history.go(-1);" >返回</a> -->
							</div>
						</div>
					<?php } ?>

				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	
	<?php if($u -> Ifirst()){ //判断是否首次登陆	?>
	<!-- 提示信息 -->
	<div class="globalShade"><i></i><em>×</em><span></span></div>
	<?php } ?>

	<script type="text/javascript">

	// if( a[i].childNodes() )
	// a[i].setAttribute('href', 'javascript:;');

		//支付按钮
		// $('.contentList .col .gui i').click(function(){
		// 	var obj = $(this),
		// 		col = obj.parents('.col');
		// 	god(obj, function(){ 
		// 		col.addClass('col_possess');
		// 		confirm(col); 
		// 	});
		// });
		// $('.contentList .col .confirmBtn').click(function(){ 
		// 	var obj = $(this),
		// 		col = obj.parents('.col');
		// 	if( !col.hasClass('col_possess') ){
		// 		god(obj, function(){ 
		// 			col.addClass('col_possess');
		// 			confirm(col);
		// 		});
		// 	}
		// });

		//遍历所有内容
		// $('.col img').load(function(){
		// 	var col = $(this).parents('.col');

		// 	//如果已买则挂接查看事件
		// 	if( col.hasClass('col_possess') ){
		// 		confirm(col);
		// 	}

		// 	//判断并处理控件
		// 	var gui = col.find('.gui');
		// 	if( gui.hasClass('gui_0') ){		//文字
		// 		gui.remove();
		// 	}else if( gui.hasClass('gui_1') ){	//图片
		// 		gui.find('embed').remove();

		// 		//默认打开
		// 		// gui.find('img').click();

		// 		//如果图片宽度不够，则显示图片尺寸
		// 		// gui.find('img').load(function(){
		// 			if( gui.find('img').width() < gui.width() ){
		// 				gui.width( gui.find('img').width() );
		// 			}
		// 		// });
		// 	}else if( gui.hasClass('gui_2') ){	//视频
		// 		gui.find('.img,.mp3,.sawtooth,.bigimg').remove();
		// 	}else if( gui.hasClass('gui_3') ){	//音乐
		// 		gui.find('.img,.gif,.sawtooth,.bigimg').remove();
		// 	}

		// });


		//修改查看按钮
		// $(document).ready(function(){
		// 	txtLook($('.col'));
		// });


		//购买按钮事件
		$('.purchase').purchase();

		//删除内容
		$('.col').deleteCon();

		//挂接已购买的内容为可查看图片
		$('.col_possess').picture();

		//挂接已购买的内容为可查看文本
		$('.col_possess').writing();



		

		// $('.delete').click(function(){ $(this).hide().next().show(); });
		// $('.notDelete').click(function(){ $(this).parent().hide().prev().show(); });
		// $('.ackDelete').click(function(){
		// 	var col = $(this).parents('.col');
			
		// 	//提交数据
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "./ajax/ajax_user.php",
		// 		data: "delete=" + col.attr('cid'),
		// 		success: function(msg){
		// 			// console.log( msg );

		// 			if( !!Number(msg) ){
		// 				//刷新余额显示
		// 				var gold = parseInt($('#userGold').val()) + parseInt(msg);
		// 				$('#userInfoGold').html( (gold /100).toFixed(2) );
		// 				$('#userGold').val(gold);
		// 			}

		// 			//隐藏内容
		// 			col.slideUp();
		// 		}
		// 	});
		// });





		//新手提示
		if( $('.globalShade').length > 0 ){
			$('.header .operate').addClass('operate_act');
			$('.header .operate .link a').eq(7).addClass('act');

			//关闭提示
			$('.globalShade em').click(function(){
				$('.globalShade').remove();
				$('.header .operate').removeClass('operate_act');
				$('.header .operate .link a').eq(7).removeClass('act');
			});
		}

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>
