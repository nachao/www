<?php
	
	//引用公共文件
	include("./comm/base.php");	

	//设置选择菜单
	Global $ect;
	$ect="ad";	

	//引用样式头部
	include("./comm/head.php");		
?>

	<div class="container pagecon">
		<?php

		//include("./comm/pageHead.php");	//导入内页头部及导航 	?>

		<!-- 广告页 -->
		<div class="advertisement center">

			<!-- 计时 -->
			<div class="reckonByTime">
				<span class="cue">距离竞价结束时间：</span>
				<span class="num"><?php echo $o -> Ctime($a -> Grange()); ?></span>
			</div>
			
			<?php $Av = $a -> Gfirst();	//输出第一名的广告信息  ?>
			<?php if(!empty($Av) && count($Av)){ ?>
				<div class="content adFirst">
					<div class="area">
						<div class="head">
							<div class="txt"><i></i><span>独家赞助商 - 竞价中</span></div>
							<div class="gap"><i></i></div>
						</div>
						<div class="cont">
							<div class="pic">
								<a href="<?php echo $Av['link'] ? 'http://'.$Av['link'] : 'javascript:;'; ?>" target="_blank" >
									<img src="<?php echo $Av['imgs']; ?>" alt="<?php echo $o -> Ccode($Av['cue']); ?>" />
								</a>
							</div>
							<div class="info">
								<div class="tag">
									<span class="name">BY：
										<a href="./list.php?uid=<?php echo $Av['userid']; ?>" title=""><?php echo $u -> Gname($Av['userid']); ?></a>
									</span>
									<span class="time"><?php echo $o -> Cdate($Av['lastdate'], 1); ?></span>
									<span class="help">资助 <em class="ad_goldShow golds" n="<?php echo $Av['subsidize']; ?>"></em> <i>元</i></span>
								</div>
								<div class="tit">
									<a href="<?php echo $Av['link'] ? 'http://'.$Av['link'] : 'javascript:;'; ?>" target="_blank" ><?php echo $o -> Ccode($Av['cue']); ?></a>
								</div>
								<div class="cue"><?php echo $o -> Ccode($Av['describe']); ?></div>
								<div class="num"><span class="ad_goldShow golds" n="<?php echo $Av['num']; ?>"></span> <i>元</i></div>
							</div>
						</div>
					</div>
					<div class="bottom"></div>
				</div>
			<?php }else{ ?>

				<!-- 无内容提示 -->
				<div class="noContent notAd"><div class="are"></div></div>
			<?php } ?>

			<!-- 其他广告 -->
			<?php if (count($a -> Glist($a -> Grange()))){	//判断是否有内容 ?>
				<div class="content adList">
					<div class="area">

						<?php foreach ($a -> Glist($a -> Grange()) as $k => $Av) { //输出内容开始 -------------------------------- ?>
						<div class="row" aid="<?php echo $Av['id']; ?>" >
							<div class="imgs">
								<img  class="pic"src="<?php echo $Av['longimgs']; ?>" />
								<a class="tit" href="<?php echo $Av['link'] ? $Av['link'] : 'javascript:;'; ?>" title=""><?php echo $o -> Ccode($Av['cue']); ?></a>
								<a class="btn" href="#" title="">助</a>
								<div class="aid">
									<div class="radio radio-notauto">
										<span class="names s3">资助</span>
										<label class="act"><input type="radio" name="nums" value="1" checked="checked"><em>0.01</em> 元</label>
										<label><input type="radio" name="nums" value="10"><em>0.10</em> 元</label>
										<label><input type="radio" name="nums" value="100"><em>1.00</em> 元</label>
										<label><input type="radio" name="nums" value="1000"><em>10.00</em> 元</label>
										<label><input type="radio" name="nums" value="10000"><em>100.00</em> 元</label>
										<input class="aidNums" type="hidden" value="1">		
									</div>
									<div class="confirm">
										<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
										<a class="not f" href="javascript:;" title="">取消</a>
										<a class="ack f" href="javascript:;" title="">确定</a>
									</div>
								</div>
								<div class="result"><span>√</span></div>
							</div>
							<div class="cont">
								<div class="tag">
									<span class="name">BY：<a href="./list.php?uid=<?php echo $ONE_uid; ?>" title=""><?php echo $u -> Gname($Av['userid']); ?></a></span>
									<span class="help">资助 <em class="ad_goldShow golds" n="?php echo intval($Av['subsidize'], 10); ?>"></em> <i>元</i></span>

									<?php if(!$a -> Iad($a -> Gbegin())){ 	//登录用户可以赞助 ?>
										<a class="btn" href="javascript:;" title="">助</a>
									<?php } ?>

								</div>
								<div class="num"><span class="ad_goldShow golds" n="<?php echo $Av['num']; ?>"></span> <i>元</i></div>
							</div>
							<div class="c"></div>
						</div>
						<?php }?>

					</div>
					<div class="bottom"></div>
				</div>
			<?php } ?>

			<?php 

			if($u -> Gid()){ //登录情况下可见

				//提交参数
				if(isset($_POST['submit'])){
					
					//判断修改还是添加
					if($a -> Iad($a -> Gbegin())){	
						if(isset($_POST['numsVal'])){		
							$a -> UAfinancially( $_POST['adId'], $_POST['numsVal'] );	//赞助 或竞价
						}
						$a -> Urevise($_POST['adId'], $o -> Chtml($_POST['interlinkage']), $o -> Chtml($_POST['sponsor']), $o -> Chtml($_POST['depict']), $_POST['valContent0'], $_POST['valContent1'] );	//修改资料
					}else{
						$a -> Anew( $_POST['numsVal'], $o -> Chtml($_POST['interlinkage']), $o -> Chtml($_POST['sponsor']), $o -> Chtml($_POST['depict']), $_POST['valContent0'], $_POST['valContent1'] );	//新增数据
					}
				}

				//获取用户是否有广告
				if($a -> Iad($a -> Gbegin())){ 
					$RE_row = $a -> GUad($a -> Gbegin(), $u -> Guid());
					$RE_aid = $RE_row['id'];
					$RE_img = $RE_row['imgs'];
					$RE_long= $RE_row['longimgs'];
					$RE_num = $RE_row['num'];
					$RE_link= $o -> Ccode($RE_row['link']);
					$RE_name= $o -> Ccode($RE_row['cue']);
					$RE_dep = $o -> Ccode($RE_row['describe']); 	
				}else{
					$RE_img = '';
					$RE_img = '';
					$RE_long= '';
					$RE_num = '';
					$RE_link= '';
					$RE_name= '';
					$RE_dep = ''; 
				}	?>

				<!-- 参与竞价 -->
				<div class="content adPartake" style="margin-top: 100px; margin-bottom: 900px;">
					<div class="area">
						<div class="head">
							<div class="txt"><i></i><span>我的广告</span></div>
							<div class="gap"><i></i></div>
						</div>
						<form class="formlist f" method="post" onsubmit="return detection();" >
							<div class="picture">
								<a class="display" id="picSquare" href="javascript:;" >
									<span>点击上传图片（规格一：380px*270px）</span>
									<img src="<?php echo $RE_img; ?>"/>
								</a>
								<a class="display" id="picOblong" href="javascript:;" >
									<span>点击上传图片（规格二：720px*90px）</span>
									<img src="<?php echo $RE_long; ?>"/>
								</a>
								<div class="control" id="picControl0"><div id="altContent0"></div></div>
								<div class="control" id="picControl1"><div id="altContent1"></div></div>
								<input type="hidden" id="valContent0" name="valContent0" value="<?php echo $RE_img; ?>" />
								<input type="hidden" id="valContent1" name="valContent1" value="<?php echo $RE_long; ?>" />
								<div class="c"></div>
							</div>

							<?php 
							if(!$a -> Ione()){ //不是第一名时显示 ?>
								<div id="activity" >
									<div class="row">
										<div class="radio radio-notauto f">
											<span class="names s3">竞价金额</span>
											<label class="act"><input type="radio" name="nums" value="1" checked /><em>0.01</em> 元</label>
											<label><input type="radio" name="nums" value="10" checked /><em>0.10</em> 元</label>
											<label><input type="radio" name="nums" value="100" checked /><em>1.00</em> 元</label>
											<label><input type="radio" name="nums" value="1000" /><em>10.00</em> 元</label>
											<label><input type="radio" name="nums" value="5000" /><em>50.00</em> 元</label>
											<label><input type="radio" name="nums" value="10000" /><em>100.00</em> 元</label>
											<input id="numsVal" name="numsVal" type="hidden" value="1" />	
										</div>
									</div>
								</div>
							<?php } ?>	

							<div class="link"></div>
							<div class="row">
								<input id="interlinkage" class="tit link" type="text" name="interlinkage" value="<?php echo $RE_link; ?>" placeholder="官网链接（可以不填）" />
							</div>
							<div class="row">
								<input id="sponsor" class="tit name" type="text" name="sponsor" value="<?php echo $RE_name; ?>" placeholder="赞助商名称（必填）" />
							</div>
							<div class="row">
								<textarea id="depict" class="txt" name="depict" placeholder="描述（请填写 10 至 500 字的描述）" ><?php echo $RE_dep; ?></textarea>
							</div>
							<div class="row" style="margin-top: 50px;">
								<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
								<input id="submitApply" class="sub f" type="submit" name="submit" value="提交申请" />

								<?php  if(!$a -> Ione()){ //如果不是第一名 ?>		
									<div class="tag r">已付&nbsp;
										<span class="ad_goldShow pdPaid"><?php echo intval($RE_num, 10); ?></span>&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;
										需付： <input id="totalTote" type="text" value="0.00" readonly /> 元
										<em id="totalToteNot"><i>！</i>你的金币不足</em>
									</div>
									<input type="hidden" id="beforeOne" value="<?php echo intval($a -> GFsum(), 10); ?>" />
									<input type="hidden" id="pdPaid" value="<?php echo intval($RE_num, 10); ?>" />
								<?php } ?>

								<input type="hidden" id="adId" name="adId" value="<?php echo isset($RE_aid) ? $RE_aid : 0; ?>" />
							</div>
							
							<!-- 修改信息 -->
							<!-- <div id="reviseInfo" >
								<input type="hidden" id="reviseImg"  value="<?php echo $RE_img; ?>" />
								<input type="hidden" id="reviseLongImg" value="<?php echo $RE_long; ?>" />
								<input type="hidden" id="reviseNums" value="<?php echo $RE_num; ?>" />
								<input type="hidden" id="reviseLinks" value="<?php echo $RE_link; ?>" />
								<input type="hidden" id="reviseSponsor" value="<?php echo $RE_name; ?>" />
								<input type="hidden" id="reviseDepict" value="<?php echo $RE_dep; ?>" />
								<input type="hidden" name="reviseInfo" value="1" />
							</div> -->
						</form>
						<div class="regulation r">
							<p>73的唯一广告位，采用竞价的方式，广告每周刷新一次，自会采用竞价最高的广告。并且显示在世界的头部，并注明为本周的独家赞助商。</p>
							<p>在竞价时每当你被挤下来的时候，竞价的金币将会自动返回给用户。</p>
						</div>
						<div class="c"></div>
					</div>
					<div class="bottom"></div>
				</div>
			<?php } ?>

		</div>
	</div>
	<script type="text/javascript" src="./js/comm.js" ></script>
	<script type="text/javascript" src="./js/xiuxiu.js"></script>
	<script type="text/javascript">

		//设置金额显示方式
		// $('.ad_goldShow').each(function(){
		// 	goldShow($(this));
		// });

		//判断是否有定位缓存
		var adScrollTop = checkCookie('73adScrollTop');
		if(adScrollTop){
			delCookie('73adScrollTop');
			$(window).scrollTop(adScrollTop);
		}


		//选择资助数量
		$('.radio label').click(function(){
			var num = $(this).nextAll('.aidNums');
				num.val($(this).find('input').val());

			$(this).addClass('act').siblings().removeClass('act');

			var n = parseInt($(this).find('input').val()),
				a = parseInt($('#beforeOne').val()),
				b = parseInt($('#pdPaid').val());
				b = b ? b : 0;

			// console.log(a-b+n);

			$('#numsVal').val(a-b+n);

			//刷新支付金额
			$('#totalTote').attr('n', a-b+n);
			$('#totalTote').golds();

		}).eq(0).click();

		//展开和隐藏赞助界面
		$('.adList .cont .btn').click(function(){
			var row = $(this).parents('.row');
			$('.aid').slideUp();
			row.find('.aid').slideToggle();
		});
		$('.adList .aid .not').click(function(){
			var row = $(this).parents('.row');
			row.find('.aid').slideUp();
		});
		$('.adList .aid .ack').click(function(){

			//获取元素
			var row = $(this).parents('.row'),
				aid = row.find('.aid');
				are = row.find('.confirm');
				ack = row.find('.result');
				tip = row.find('.confirm .tip');


			//获取参数
			var num = parseInt(row.find('.aidNums').val()),
				gold = parseInt($('#userGold').val());

			//判断用户金额是否足够
			if( gold < num ){
				tip.show();
			}else{

				//初始化
				aid.hide();
				ack.show();

				//提交数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "aidFinancially=" + row.attr('aid') +"&num="+ num,
					success: function(msg){

						//存入缓存
						setCookie("73adScrollTop" , $(window).scrollTop(), 1 );

						// console.log( msg );
						ack.find('span').show();
						setTimeout(function(){
							ack.slideUp(function(){
								ack.find('span').hide(function(){
									history.go(0);
								});
							});
						}, 1000);
					}
				});
			}
		});



		//==========================
		//缓存命名
		var cookieName = "F_"+ $('#userIs').val() +"_";




		//===============
		//表单验证
		
		function detection(){

			var f = $('.formlist');

			//规格一的图片
			if( f.find('#valContent0').val().replace(/\s/g,'') == '' ){
				f.find('#picSquare').click();
				return false;
			}

			//规格二的图片
			if( f.find('#valContent1').val().replace(/\s/g,'') == '' ){
				f.find('#picOblong').click();
				return false;
			}

			//链接
			$('#interlinkage').val($('#interlinkage').val().replace('http://',''));

			//赞助商
			if( f.find('#sponsor').val().replace(/\s/g,'') == '' ){
				f.find('#sponsor').focus();
				return false;
			}

			//描述
			if( f.find('#depict').val().replace(/\s/g,'') == '' ){
				f.find('#depict').focus();
				return false;
			}

			if( f.find('#depict').val().length > 200 ){
				f.find('#depict').val(f.find('#depict').val().substr(0 , 200));
			}

			//判断用户金额是否足够
			if( parseInt($('#numsVal').val()) > parseInt($('#userGold').val()) ){
				$('#tipApply').show();
				setTimeout(function(){ $('#tipApply').fadeOut(); }, 2000);
				return false;
			}
			
			//提交数据后删除所有缓存
			delCookie(cookieName + 'picControl0');
			delCookie(cookieName + 'picControl1');
			delCookie(cookieName + 'adLinks');
			delCookie(cookieName + 'adSponsor');
			delCookie(cookieName + 'adDepict');

			return true;
		}





		//==========================
		//图片上传控件
		window.onload=function(){
			var memory = null;
			$('#picSquare,#picOblong').click(function(){
				memory = $(this);
				$('#picControl'+ memory.index() ).show();
				var url = memory.css('backgroundImage');
				var s = memory.width()+"x"+memory.height();
		        xiuxiu.setLaunchVars("sizeTipVisible", 1);
		        xiuxiu.setLaunchVars("nav", "/edit");
		        xiuxiu.setLaunchVars("cropPresets", s );
				xiuxiu.embedSWF("altContent" + memory.index() , 1, "100%", "100%", s );
				// x();
			    //修改为您自己的图片上传接口
				xiuxiu.setUploadURL("http://web.upload.meitu.com/image_upload.php");
		        xiuxiu.setUploadType(2);
		        xiuxiu.setUploadDataFieldName("upload_file");
				console.log(111);
			});

			function x(s){
			    //修改为您自己的图片上传接口
				xiuxiu.setUploadURL("http://web.upload.meitu.com/image_upload.php");
		        xiuxiu.setUploadType(2);
		        xiuxiu.setUploadDataFieldName("upload_file");
			}
			xiuxiu.onBeforeUpload = function (data, id){
				var size = data.size;
				console.log(1);
				if( data.width != memory.width() && data.height != memory.height() ){ 
					alert("请裁剪指定的尺寸后确认。"); 
					return false; 
				}
				// return false; 
			}
			xiuxiu.onUploadResponse = function (data){
				data = eval('('+ data +')');
				if( memory ){
					memory.addClass('displayAct').find('img').attr('src', data.original_pic);
					$('#valContent'+ memory.index() ).val(data.original_pic);

					//存入缓存
					setCookie( cookieName + "picControl"+ memory.index() , data.original_pic, 1 );
	
				}
				$('.control').hide();	//关闭窗口
			}
			xiuxiu.onClose = function (id){
				$('.control').hide();
			}
		}

		//保存链接
		$('#interlinkage').blur(function(){
			if( $(this).val().length > 0 ){
				$(this).val($(this).val().replace('http://',''));
				setCookie( cookieName + "adLinks" , $(this).val(), 1 );	//存入缓存
			}
		});

		//保存赞助商名
		$('#sponsor').blur(function(){
			if( $(this).val().length > 0 ){
				setCookie( cookieName + "adSponsor" , $(this).val(), 1 );	//存入缓存
			}
		});

		//保存描述
		$('#depict').blur(function(){
			if( $(this).val().length > 0 ){
				setCookie( cookieName + "adDepict" , $(this).val(), 1 );	//存入缓存
			}
		});










		//======================
		//查询是否有缓存，如果有则导出

		//判断是否有图片
		var F_picControl0 = checkCookie(cookieName + 'picControl0'),
			F_picControl1 = checkCookie(cookieName + 'picControl1');
		if( F_picControl0 ){
			$('#picSquare').addClass('displayAct').find('img').attr('src',F_picControl0 );
			$('#valContent0' ).val(F_picControl0);
		}
		if( F_picControl1 ){
			$('#picOblong').addClass('displayAct').find('img').attr('src',F_picControl1 );
			$('#valContent1' ).val(F_picControl1);
		}

		//判断是否有链接
		var F_adLinks = checkCookie(cookieName + 'adLinks');
		if( F_adLinks ){
			$('#interlinkage' ).val(F_adLinks);
		}

		//判断是否有赞助商名
		var F_adSponsor = checkCookie(cookieName + 'adSponsor');
		if( F_adSponsor ){
			$('#sponsor' ).val(F_adSponsor);
		}

		//判断是否有描述
		var F_adDepict = checkCookie(cookieName + 'adDepict');
		if( F_adDepict ){
			$('#depict' ).val(F_adDepict);
		}







		//===================
		//如果已经有自己广告
		// if( $('#reviseInfo').length ){

			//如果有图片参数，则设置图片显示
			$('.display').each(function(){
				if( $(this).find('img').attr('src') ){
					$(this).addClass('displayAct');
				}
			});

			// 图片一
			// $('#valContent0').val($('#reviseImg').val())
			// $('#picSquare').addClass('displayAct').find('img').attr('src', $('#reviseImg').val());

			// //图片二
			// $('#valContent1').val($('#reviseLongImg').val())
			// $('#picOblong').addClass('displayAct').find('img').attr('src', $('#reviseLongImg').val());

			// //赞助商链接
			// $('#interlinkage').val('http://'+$('#reviseLinks').val());

			// //赞助商名称
			// $('#sponsor').val($('#reviseSponsor').val());

			// //赞助商简介
			// $('#depict').val($('#reviseDepict').val());

			// //当前金额
			// $('#numsVal').val($('#reviseNums').val());

			// //按钮
			// $('#submitApply').val('确认').removeClass('sub').addClass('cupid-green').css({ height: 35, width: 150 });
		
		// }


	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

