<?php
	
	//引用公共文件
	include("./comm/base.php");	
	
	//设置选择菜单
	Global $ect;
	$ect="digg";	

	//引用样式头部
	include("./comm/head.php");		
?>

	<div class="container pagecon">
		<!-- 排行榜 -->
		<div class="disslist center">
			<div class="are f">
				<?php //print_r($u -> Gdigg()); ?>
				<?php foreach( $u -> Gdigg() as $key => $Dv ){ //循环输出 用户金币排行榜 -------------------------  输出排行榜 开始 ?>
					<?php  if($ub -> IPniu($Dv['uid'])){ $ub -> ASniu($Dv['uid']); } 	//判断是否可以发放 圈子牛人 ?>
					<?php  if($u -> Ivip($Dv['uid'])){ $ub -> DSUvip($Dv['uid']); } 	//判断vip如果到期则撤销 ?>
					<div class="col f">
						<div class="gap">
							<div class="pic f">
								<a href="./list.php?uid=<?php echo $Dv['uid']; ?>" title=""><img src="<?php echo $Dv['icon']; ?>" alt="" width="160" /><i></i><em></em></a></div>
							<div class="name name_no<?php echo $key+1; ?> f"><em>NO.<?php echo $key+1; ?></em> <?php echo $Dv['name']; ?></div>
							<div class="cue">
								<div class="icon f">
									<a href="./list.php?uid=<?php echo $Dv['uid']; ?>" ><img src="<?php echo $Dv['icon']; ?>" alt="" /></a>
									<span></span>
								</div>
								<div class="names"><?php echo $Dv['name']; ?></div>
								<div class="price f"><em class="golds" n="<?php echo $Dv['plus']; ?>"></em><i></i></div>
								<div class="c"></div>
								<div class="depict"><?php echo $u -> Gdepict($Dv['uid']); ?></div>
								<div class="c"></div>
								<div class="glory" style="padding: 20px 35px 30px;">

									<?php if($ub -> Ibadge($Dv['uid'])){	//判断用户是否有图标 ?>
										<?php foreach ($ub -> Gbadge($Dv['uid']) as $k => $Bv) {	//输出用户的全部徽章 -------------------------------- 	?>
											<a class="<?php echo $Bv['icon']; ?>" href="javascript:;" title="<?php echo $Bv['name']; ?>"></a>
										<?php } //输出内容结束 -------------------------------- ?>
									<?php } ?>
									
								</div>
							</div>
							<div class="tip"></div>
						</div>
						<div class="c"></div>
					</div>
				<?php }	//------------------------------------- 输出排行榜 结束 ?>
				<div class="c"></div>
			</div>
			<!-- <div class="shade"></div> -->
			<div class="c"></div>
		</div>
	</div>
	<script type="text/javascript">

		/*====
		切换动画
		====*/
		(function(){

			var obj = $('.are'),
				col = $('.col');

			//获得当前每排的个数
			var num = parseInt( obj.width() / col.width() ),
				log = {x: 0, y: 0, i: 0 };

			console.log( num );

			col.mouseenter(function(){

				//基本参数
				var t = $(this),
					i = t.index(),
					y = parseInt(i / num),
					x = i - y * num,
					w = t.width(),
					h = t.height();

				//最终位置
				var init = { x: 0, y: 0 };

				//计算
				if( y > log.y ){
					init.y = -h;
				}else if( y < log.y ){
					init.y = h;
				}
				if( x > log.x ){
					init.x = -w;
				}else if( x < log.x ){
					init.x = w;
				}

				//动画
				col.eq( log.i ).find('.cue').stop().animate({ top: -init.y,left: -init.x }, 300, function(){ $(this).hide(); });
				t.find('.cue').css({ top: init.y, left: init.x }).show().stop().animate({ top: 0,left: 0 }, 300);

				//记录
				log.x = x;
				log.y = y;
				log.i = i;

			//初始化
			}).eq(0).mouseenter();

			// obj.mouseleave(function(){
			// 	col.find('.cue').fadeOut();
			// });

		})();

		//设置金额显示方式
		// $('.userInfoGold').each(function(){
		// 	goldShow($(this));
		// });

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

