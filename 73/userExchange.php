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

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f">
					<div class="exchange mb50">

						<div class="type">
							<a class="act" href="javascript:;" title="" style="background-image:url(./imgs/02.png);"><i></i></a>
							<a href="javascript:;" title="" style="background-image:url(./imgs/01.gif) ;"><i></i></a>
						</div>

						<div class="list">
							<div class="cue">请在选择兑换类型</div>

							<div class="form">
								<div class="figure" img="./imgs/4.png" col="100" value="998" ></div>

								<div class="col alipay" style="display: inline-block;">
									<div class="txt">
										<input class="account" type="text" value="" def="" placeholder="支付宝账号" />
										<input class="username" class="" type="text" value="" def="" placeholder="用户名" />
										<div class="c"></div>
										<div class="num">
											<span>兑换金额数量：</span>
											<a href="javascript:;" gold="100" >1元<i></i></a>
											<a href="javascript:;" gold="200" >2元<i></i></a>
											<a href="javascript:;" gold="500" >5元<i></i></a>
											<a href="javascript:;" gold="1000">10元<i></i></a>
											<a href="javascript:;" gold="3000">30元<i></i></a>
											<a href="javascript:;" gold="5000">50元<i></i></a>
											<a href="javascript:;" gold="10000">100元<i></i></a>
											<p class="hint">系统会在 19:00 至 24:00，人工处理当天所有兑换。</p>
											<input class="val" type="hidden" value="" />
										</div>
										<div class="total">
											<span>兑换金额：</span>
											<em>0</em> 元
											<p>当前拥有：<span class="gold golds" n="<?php echo $u -> Gplus(); ?>"></span> <i></i></p>
										</div>
										<a class="sub" id="alipay" href="javascript:;" title="">确认</a>
									</div>
									<div class="clear"></div>
								</div>

								<!-- LOL -->
								<div class="col lol">
									<div class="txt">
										<input class="qq" type="text" value="" def="" placeholder="兑换QQ号码" />
										<div class="choose">
											<div class="btn"><span placeholder="游戏大区">游戏大区</span><i></i></div>
											<ul class="con">
												<li><a title="艾欧尼亚  电信" href="javascript:void(0);">艾欧尼亚  电信</a></li>
												<li><a title="比尔吉沃特  网通" href="javascript:void(0);">比尔吉沃特  网通</a></li>
												<li><a title="祖安 电信" href="javascript:void(0);">祖安 电信</a></li>
												<li><a title="诺克萨斯  电信" href="javascript:void(0);">诺克萨斯  电信</a></li>
												<li><a title="德玛西亚 网通" href="javascript:void(0);">德玛西亚 网通</a></li>
												<li><a title="班德尔城 电信" href="javascript:void(0);">班德尔城 电信</a></li>
												<li><a title="皮尔特沃夫 电信" href="javascript:void(0);">皮尔特沃夫 电信</a></li>
												<li><a title="战争学院 电信" href="javascript:void(0);">战争学院 电信</a></li>
												<li><a title="弗雷尔卓德 网通" href="javascript:void(0);">弗雷尔卓德 网通</a></li>
												<li><a title="巨神峰 电信" href="javascript:void(0);">巨神峰 电信</a></li>
												<li><a title="雷瑟守备 电信" href="javascript:void(0);">雷瑟守备 电信</a></li>
												<li><a title="无畏先锋 网通" href="javascript:void(0);">无畏先锋 网通</a></li>
												<li><a title="裁决之地 电信" href="javascript:void(0);">裁决之地 电信</a></li>
												<li><a title="黑色玫瑰 电信" href="javascript:void(0);">黑色玫瑰 电信</a></li>
												<li><a title="暗影岛 电信" href="javascript:void(0);">暗影岛 电信</a></li>
												<li><a title="钢铁烈阳 电信" href="javascript:void(0);">钢铁烈阳 电信</a></li>
												<li><a title="恕瑞玛 网通" href="javascript:void(0);">恕瑞玛 网通</a></li>
												<li><a title="均衡教派 电信" href="javascript:void(0);">均衡教派 电信</a></li>
												<li><a title="水晶之痕 电信" href="javascript:void(0);">水晶之痕 电信</a></li>
												<li><a title="教育网专区" href="javascript:void(0);">教育网专区</a></li>
												<li><a title="影流 电信" href="javascript:void(0);">影流 电信</a></li>
												<li><a title="守望之海 电信" href="javascript:void(0);">守望之海 电信</a></li>
												<li><a title="扭曲丛林 网通" href="javascript:void(0);">扭曲丛林 网通</a></li>
												<li><a title="征服之海 电信" href="javascript:void(0);">征服之海 电信</a></li>
												<li><a title="卡拉曼达 电信" href="javascript:void(0);">卡拉曼达 电信</a></li>
												<li><a title="皮城警备 电信" href="javascript:void(0);">皮城警备 电信</a></li>
												<li><a title="巨龙之巢 网通" href="javascript:void(0);">巨龙之巢 网通</a></li>
											</ul>
											<input class="area" type="hidden" value="" />
										</div>
										<div class="c"></div>
										<div class="num">
											<span>兑换点券数量：</span>
											<a href="javascript:;" gold="100">100<i></i></a>
											<a href="javascript:;" gold="300">300<i></i></a>
											<a href="javascript:;" gold="500">500<i></i></a>
											<a href="javascript:;" gold="1000">1000<i></i></a>
											<a href="javascript:;" gold="3000">3000<i></i></a>
											<a href="javascript:;" gold="5000">5000<i></i></a>
											<a href="javascript:;" gold="10000">10000<i></i></a>
											<p class="hint">系统会在 19:00 至 24:00，人工处理当天所有兑换。</p>
											<input class="val" type="hidden" value="" />
											<div class="clear"></div>
										</div>
										<div class="total">
											<span>兑换金额：</span>
											<em>0</em> 元
											<p>当前拥有：<span class="gold golds" n="<?php echo $u -> Gplus(); ?>"></span> <i></i></p>
										</div>
										<a class="sub" id="lol" href="javascript:;" title="">确认</a>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
								</div>

							</div>
							<div class="c"></div>

							<!-- 支付宝 -->

						</div>
						<div class="c"></div>
					</div>
				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//如果登录状态
		// if( $('#floatmenu .info') ){
		// 	goldShow($('#floatmenu .info'));
		// }

		//编辑所有输入框激活效果
		function def(){
			var inp = $('input[def]');
			inp.each(function(){
				var s = $(this),
					def = s.attr('def');
				if(s.val() == ''){
					s.val(def);
				}
				s.focus(function(){
					if( s.val() == def )
						s.val('');
				}).blur(function(){
					if( s.val() == '' )
						s.val(def);
				});
			});

			//提交时清除默认提示语句
			$("a[class='sub']").mousedown(function(){
				$(this).parents('.form').find('input[def]').each(function(){
					if( $(this).val() == $(this).attr('def') ){
						$(this).val('');
					}
				})
			});

		}
		def();


		//提交 lol 兑换
		(function(){

			var p = $('.lol');
			
			//验证表单
			p.find('.qq').blur(function(){
			//	$(this).val(parseInt($(this).val()));
			});

			$('#lol').click(function(){

				var	qq = p.find('.qq').val(),
					area = p.find('.area').val(),
					val = p.find('.val').val(),
					user = $('#confirm').val(),
					cue = p.find('.hint');

				//初始化
				cue.removeClass('not ok wait');

				var pattern = /^([0-9.]+)$/;
				if( !qq || !pattern.test(qq) ){ 
					cue.html('请输入你的 QQ 账号。').addClass('not');
					def();
				}else if( !area ){
					cue.html('请选择大区。').addClass('not');
				}else if( !parseInt(val) ){
					cue.html('请选择需要兑换的数量。').addClass('not');
				}else if( parseInt(val) > $('#userGold').val() ){
					cue.html('你的金币不足').addClass('not');
				}else{
					cue.html('').removeClass('not').addClass('wait').animate({ height: 100 });
					setTimeout(function(){
						$.ajax({
							type: "POST",
							url: "./ajax/ajax_user.php",
							data: "exchange=" + user +"&path="+ area +"&name="+ qq +"&num="+ val,
							success: function(msg){
								console.log( msg );

								cue.animate({ height: 0 },function(){
									$(this).css({'height':''}).removeClass('wait');
							
									//处理返回数据
									if( !!parseInt(msg) ){

										//提示
										cue.html("提交成功! （系统会在 19:00 至 20:00，人工处理当天所有兑换。）").addClass('ok');

										console.log( parseInt($('.lol .gold').attr('n')) );

										//刷新页面用户金币数量
										$('.lol .gold').attr('n', parseInt($('.lol .gold').attr('n'))-val );

										//设置金币显示方式
										// goldShow( $('.lol .gold') );

									}else{

										//提示
										cue.html("条件不足!").addClass('not');
									}
								})
							}
						});
					}, 2000);
				}
				

			});

			//设置金币显示方式
			// goldShow( $('#gold') );
			

			$('#alipay').click(function(){

				var a = $(".alipay");

				var	account = a.find('.account').val(),
					username = a.find('.username').val(),
					number = a.find('.val').val(),
					cue = a.find('.hint'),
					user = $('#confirm').val();

				// console.log( account );

				if( !account ){ 
					cue.html('你的账号').addClass('not');
					def();
				}else if( !username ){
					cue.html('请输入账户的持有者姓名').addClass('not');
				}else if( !parseInt(number) ){
					cue.html('请选择需要兑换的数量').addClass('not');
				}else if( parseInt(number) > parseInt($('.alipay .gold').attr('n')) ){
					cue.html('你的金币不足').addClass('not');
				}else{
					cue.html('').removeClass('not').addClass('wait').animate({ height: 100 });
					setTimeout(function(){
					// cue.html('&nbsp;').removeClass('not');
						$.ajax({
							type: "POST",
							url: "./ajax/ajax_user.php",
							data: "exchange=" + user +"&path="+ account +"&name="+ username +"&num="+ number,
							success: function(msg){
								surplus();

								console.log( msg );

								cue.animate({ height: 0 },function(){
									$(this).css({'height':''}).removeClass('wait');
							
									//处理返回数据
									if( !!parseInt(msg) ){

										//提示
										cue.html("提交成功! （系统会在 19:00 至 20:00，人工处理当天所有兑换。）").addClass('ok');

										// console.log( parseInt($('.alipay .gold').attr('n')) );

										//刷新页面用户金币数量
										var n = parseInt($('.alipay .gold').attr('n'))- parseInt(number);
										$('.alipay .gold').attr('n', n );
										$('.alipay .gold').html( (n/100).toFixed(2) );
										$('#userInfoGold').html( (n/100).toFixed(2) );
										$('#headGold').html( (n/100).toFixed(2) );

										//设置金币显示方式
										// goldShow( $('.alipay .gold') );

									}else{

										//提示
										cue.html("条件不足!").removeClass('ok').addClass('not');
									}
								})
							}
						});
					}, 2000);
				}

			});

		})();


		//选择类型
		$('.type a').click(function(){
			$(this).addClass('act').siblings().removeClass('act');
			$('.col').hide().eq($(this).index()).show();
		});//.eq(0).click();


		//选择数量
		$('.num a').click(function(){
			$(this).toggleClass('act').siblings().removeClass('act');
			$(this).nextAll('.val').val( parseInt($(this).attr("gold")) );

			//显示兑换余额
			$(".total em").html( (parseInt($(this).attr("gold"))/100).toFixed(2) ); 
		});


		//下拉框效果
		(function(){

			var choose = $('.choose .con'),
				btn = $('.choose .btn');
			
			//点击显示和隐藏
			btn.click(function(e){
				$(this).next().toggle();

				//取消冒泡事件
				if(e && e.stopPropagation){
					e.stopPropagation();
				}else{
					window.event.cancelBubble = true;
				}
			});

			//点击激活当前
			$('.choose .con a').click(function(){
				$('.choose .btn span').html($(this).html());
				$('.choose .area').val($(this).html());
			});

			//点击 body 隐藏下拉框
			$('body,html').click(function(){
				choose.hide();
			});

		})();


		//修改数字
		jQuery.fn.extend({
			figure: function(val) {


				var dyn = $(this),
					arr = Array();

				//记录
				function jilu( val ){
					var a = val.split(''),
						b = Array();
					for( var i=1 ; i<=a.length ;i++ ){
						b[i-1] = a[ a.length-i ];
					}
					return b;
				}
			
				//动画
				function donghua(){
					var col = null;
					var obj = dyn.find('i');
					for( var i=0; i<arr.length ;i++ ){
						//判断是否存在
						if( obj.length-1 >= i ){
							//修改
							col = obj.eq( obj.length-1-i );
							col.animate({ backgroundPositionY: arr[i] * -100 }, Math.abs(col.attr('go') - arr[i]) * 200).attr('go', arr[i]);
						}else{
							//生成新的
							create().animate({ backgroundPositionY: arr[i] * -100 }, Math.abs(arr[i]) * 200, 'linear').attr('go', arr[i]);
						}
					}
					//多余的去掉
					if( obj.length > arr.length ){
						dyn.find("i").slice(0, obj.length - arr.length).each(function(){
							$(this).animate({ backgroundPositionY: 100 }, $(this).attr('go') * 200 ,function(){
								$(this).remove();
							});
						});
					}
				}

				//前置生成一个 数字
				function create( v ){
					var	width = 60,
						height = 100,
						src = dyn.attr('img'),
						left = -20,
						top = 0,
						style = "display: inline-block;width: "+ width +"px;height: "+ height +"px;background: url("+ src +") "+ left +"px "+ 100 +"px no-repeat";
					dyn.prepend("<i style='"+ style +"'></i>");
					return dyn.find('i:first');
				}

				arr = jilu(val);
				donghua();

			}
		});

		//获取可兑换金币总数量
		function surplus(){
			(function(){
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "surplus=true",
					success: function(msg){
						// console.log( msg );
						if( !!parseInt(msg.replace(/\s/g,'')) && !!msg.replace(/\s/g,'') ){
							$('.figure').figure( msg );
						}else{
							$('.figure').figure( '0' );
						}
					}
				});
			})();
			// setTimeout(function(){ surplus(); }, 1000);
		}

		surplus();

		




	</script>

<?php include("./comm/footer.php");	//引用底部 	?>

