<?php
	
	//引用公共文件
	include("./comm/base.php");	

	//设置选择菜单
	Global $ect;
	$ect="user";	

	//引用样式头部
	include("./comm/head.php");	

	$page = 1;
	$number = 9;
	$total = $c -> Gtotel(0, $u -> Guid());

	if ( isset($_GET['page'])) {
		$page = $_GET['page'];	
	}


	// echo strtotime();
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
						
					<?php $Ulist = $c -> GUlist(($page - 1) * $number, $number, 0, 0, $u -> Ik() ? $u -> Gcid() : 0);					
					if(count($Ulist) > 0){ 	//如果有内容 ?>
						<div class="contentList" style="margin:0px;width: 100%;position: relative;top: -30px;">
							
							<?php foreach($Ulist as $k => $v) {	//输出内容，或者指定标题的内容 		?>
								<div class="f col<?php echo $c -> Ibuy($v['cid']) ? ' col_possess' : ''; ?> col-user" cid="<?php echo $v['cid']; ?>" now="<?php echo $v['plus']; ?>" style="display: block;" >
									<a href="javascript:;" name="<?php echo $v['cid']; ?>" class="user-cols-sign" ></a>

									<!-- 标示 -->
									<?php if($v['effects'] == 1){	//如果是顶 ?>
										<div class="effects effects-very" alt="作者顶贴" style="top: 33px;" ></div>
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
										<div class="txt txt-big" <?php if($v['types'] ==0){ echo "style='max-height: 234px;min-height: 234px;'"; } ?> >
											<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
											<div class="are"><?php echo $v['content']; ?></div>
											<?php }else{ ?>
											<div class="are-not">———— 没有描述 ————</div>
											<?php } ?>
										</div>
										<div class="use use-user">
											<div class="use-user-data">
												
												<?php if($v['label'] != 0){	//判断此内容是否有标签 ?>
												<p><a href="./list.php?tid=<?php echo $v['titleid']; ?>&label=<?php echo $v['label']; ?>"><?php echo $tl -> Gname($v['label']); ?></a></p>
												<?php } ?>

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
												<a class="skip" href="./userAdd-Edit.php?cid=<?php echo $v['cid']; ?>&#revise" >编辑内容</a>
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
							
							<!-- 分页 -->
							<div class="paging" total="<?php echo $total; ?>" number="<?php echo $number; ?>" current="<?php echo $page; ?>" >
								<div class="paging-use"></div>
								<div class="paging-link">
									<div class="paging-link-fill"></div>
								</div>
							</div>
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
	<!-- <div class="globalShade"><i></i><em>×</em><span></span></div> -->
	<?php } ?>

	<!-- 教程 - 注册成功 -->
	<div class="course course-user no">
		<div class="course-dialog"><i></i>
			<p>Good！你已经注册成功了自己的账户。</p>
			<p>这里是 <em>用户中心</em>，我们先从这里开始讲起吧。</p>
			<p class="tip">提示：您什么都没法，什么这里空空如也。</p>
			<div class="btn">
				<a href="javascript::">好的</a>
				<a href="javascript::">不</a>
			</div>
		</div>
		<div class="c"></div>
		<img class="course-figure" src="./course/2.gif" />
	</div>

	<!-- 教程 - 进入能力界面 -->
	<div class="course course-enterAbility no">
		<div class="course-dialog"><i></i>
			<p>点击 <em>我的能力</em>，跟我一起去个神奇的地方吧。</p>
			<p class="tip">提示：前方高能！这个位置 →</p>
			<div class="btn">
				<a href="javascript::">不</a>
			</div>
		</div>
		<div class="c"></div>
		<img class="course-figure" src="./course/3.gif" />
	</div>

	<!-- 教程 - 欢迎回来 -->
	<div class="course course-entry no">
		<div class="course-dialog"><i></i>
			<p>欢迎回来！小的恭候您多时了。</p>
			<p>请让我简单的给你汇报下，你离开的这1天里都发生了什么。</p>
			<p><b>新增收入：</b><em>1,253 分</em></p>
			<p><b>当前的神：</b><em>站长</em>，你排第 <em>42</em> 位，为土豪名列。</p>
			<p><b>新报道的后辈们：</b><em>301 位</p></p>
			<p class="tip">提示：点击不再提醒后，可以在个人设置中再次找到我。</p>
			<div class="btn">
				<a href="javascript::">知道了，谢谢</a>
				<a href="javascript::">不再提醒</a>
			</div>
		</div>
		<div class="c"></div>
		<img class="course-figure" src="./course/4.gif" />
	</div>

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
