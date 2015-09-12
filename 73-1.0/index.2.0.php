<!doctype html>
<html lang="zh">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
		<title>七十三号馆</title>

        <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="0">

		<meta http-equiv="pragma"content="no-cache">
		<meta http-equiv="Cache-Control"content="no-cache, must-revalidate">
		<meta http-equiv="expires"content="Wed, 26 Feb 1997 08:21:57 GMT">

		<meta http-equiv="Access-Control-Allow-Origin" content="*">

		<link rel="stylesheet" type="text/css" href="./css/common.css" />
		<link rel="stylesheet" type="text/css" href="./css/ffangle.css" />
        <link rel="icon" href="./icon-red.png" type="image/gif" >

		<script type="text/javascript" src="./js/jquery-1.11.0.min.js" ></script>
		<script src="./js/angular-1.0.1.min.js"></script>
		<script type="text/javascript" src="./js/ffangle.js" ></script>
	</head>
	<body>

	<div class="container" >
		
		<!-- 头部 -->
		<div class="header">
			<div class="topgap"></div>
			<div class="center">
				<div class="row">

					<!-- LOGO -->
					<div class="logo f"><a href="./" ><em>? 七十三号馆</em><i>没有交易功能的微博不是一个好论坛</i></a>
						<span class="version" title="内部测试版 2.0.1" >Alpha</span>
					</div>

					<!-- 菜单 -->
					<div class="menu f">
						<a href="./index.php" >世界</a>
						<a href="./title.php" >标题</a>
						<a href="./ad.php" >广告</a>
						<a href="./digg.php" >排行榜</a>
						<a href="./help.php" >了解这里</a>
					</div>

					<!-- 搜索 及 注册按钮 -->
					<div class="make r">
						<div class="operate f no" style="border-top-color: #e74c3c;" >
							<div class="icon"><a href="./user.php" ></a><i></i></div>
							<div class="link">
								<a href="javascript:;" class="price" >
									<span class="glyphicon glyphicon-fire"></span>
									<em id="headGold" class="golds" n="" ></em> <i></i>
								</a>
								<a class="fabu" href="./userAdd.php" ><span class="glyphicon glyphicon-pencil"></span>发布</a>
								<a href="./user.php" ><span class="glyphicon glyphicon-user"></span>个人中心</a>
								<a href="./userExchange.php" ><span class="glyphicon glyphicon-barcode"></span>提现</a>
								<a href="./userMessage.php" ><span class="glyphicon glyphicon-comment"></span>留言板 <i></i></a>
								<a href="./userTitle.php" ><span class="glyphicon glyphicon-th-list"></span>我的标题</a>
								<a href="./userFollow.php" ><span class="glyphicon glyphicon-ok"></span>关注的用户</a>
								<a href="./userWelfare.php" ><span class="glyphicon glyphicon-th-large"></span>我的能力</a>
								<a href="./userEffigy.php" ><span class="glyphicon glyphicon-cog"></span>个人设置</a>
								<a href="?out=1" ><span class="glyphicon glyphicon-off"></span>注销</a>
							</div>
						</div>
						<a class="login f" href="./login.php" >注册/登录</a>

						<!-- 用户信息 -->
						<input type="hidden" value="<?php echo $sum; ?>" id="userGold" />
						<input type="hidden" value="<?php echo $uid; ?>" id="userIs" />
					</div>
					
					<div class="c"></div>
				</div>
			</div>
			<div class="bottomgap"></div>
		</div>

		<div class="container pagecon Lite">

			<!-- 主体 -->
			<div class="main">
				<div class="center">

				
					<!-- 焦点图 -->
					<div class="home-banner" id="banner">
						<div class="con">
							<div class="are" id="bannerImgsList">
								<a class="no" id="bannerImgsTemplat" href="" ><img src="" width="100%" /></a>
							</div>
						</div>
						<div class="key" id="bannerBtn"><i></i><i></i><i></i></div>
						<div class="txt" id="bannerTextList">
							<div class="no" id="bannerTextTemplat">
								<div class="tit"><a href="./list.php?tid=" ></a></div>
								<div class="cue"></div>
								<div class="tag f">
									<div class="item user f">BY：
										<a href="./list.php?uid=" ></a>
									</div>
									<div class="item time f"></div>
									<div class="item money f">奖金：<a href="./userExchange.php" class="golds"></a> <i></i></div>
								</div>
								<div class="c"></div>
							</div>
						</div>
						<div class="btn">
							<a href="javascript:;" >&lt;</a>
							<a href="javascript:;" >&gt;</a>
						</div>
					</div>

					<!-- 公告 -->
					<div class="notice">
						<div class="tit">系统公告</div>
						<div class="con">
							<div class="cue f" id="notice-cue">
								<p><a href="javascript:;" ></a></p>
							</div>
							<div class="btn r">
								<a id="notice-btn-left" href="javascript:;" >&lt;</a>
								<a id="notice-btn-right" href="javascript:;" >&gt;</a>
							</div>
						</div>
					</div>
					
					<div class="home-left">

					
						<!-- 操作栏 -->
						<div class="home-slogan">这里会让一切变的有价值。<br />有很多网友还是很热心的我跟你说。</div>

						<!-- 赛选 -->
						<div class="home-filter">
							<a href="#" class="home-filter-select home-filter-active f" >热门</a>
							<a href="#" class="home-filter-select f" >最新</a>
							<a href="#" class="home-filter-select home-filter-follow r" >关注的</a>
						</div>

						<!-- 内容列表 -->
						<div class="contentList" tote="" style="overflow: inherit;width: 500px;display: inline-block;" id="contentList" >
							<!-- <div class="row"></div> -->
							<div class="col no" cid="" now="" id="contentTemplat" >

								<!-- 标示 -->
								<div class="effects effects-very no" alt="作者顶贴" ></div>
								<div class="effects effects-recommend no" alt="题主推荐" ></div>
								<div class="effects effects-first no" alt="活动第一名" ></div>

								<!-- 标题 及 作者信息 -->
								<div class="head">
									<div class="tit">
										<a href="./list.php?tid=" ></a>
									</div>
									<div class="param-tag tag">
										<span class="name">BY：
											<a class="j_anthor" href="./list.php?uid=" title="访问TA" ></a>
										</span>
										<span class="time"></span>
										<div class="c"></div>
									</div>
								</div>

								<div class="cont">
									<a href="./list.php?tid=&label=" class="label"></a>	
									<div class="gui gui_">
										<div class="fail"></div>
										<div class="j_control j_text">
											<div class='sawtooth'></div>
										</div>
										<div class="j_control j_image">
											<div class="loading"></div>
											<img class='img' src='' /><a class='bigimg' href='' title='Natural: 1100 x 687 pixels' target='_black'>查看大图</a>
											<div class='sawtooth'></div>
										</div>
										<div class="j_control j_video">
											<embed class='gif' src='' quality='high' wmode='Opaque' width='100%' height='100%' align='middle' allowscriptaccess='always' allowfullscreen='true' mode='transparent' type='application/x-shockwave-flash'>
										</div>
										<div class="j_control j_music">
											<embed class='mp3' src='' type='application/x-shockwave-flash' width='257' height='33' wmode='transparent' />
											<i class="purchase">+</i><em></em>
										</div>
										<div class="c"></div>
									</div>
									<div class="txt" ><div class="are"></div></div>
									<div class="use">
										<div class="num cols-sum f">
											<span class="gold golds" n="" title="内容目前的收入."></span> <i>元</i>
										</div>
										<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
										<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
										<a class="buy confirmBtn iconfont icon-detailed r" href="./detail.php?cid=" title="评论" ></a>
										<a class="buy confirmBtn purchase iconfont icon-good praise r" href="javascript:;" title="赞" ></a>
									</div>
								</div>
							</div>
						</div>
		

					</div>
					<div class="home-right">
						
						<!-- 用户信息 -->
						<h3>用户信息</h3>

						<!-- 拥有图标 -->
						<h3>-</h3>

						<!-- 实时收入 -->
						<h3>实时收入</h3>

						<!-- 我的标题 -->
						<h3>我的标题</h3>

						<!-- 留言板 -->
						<h3>留言板</h3>

						<!-- 福利 -->
						<h3>福利</h3>

						
					</div>

					
					<div class="c"></div>

					<!-- 用户操作 -->


					<div class="c"></div>
					<div class="loadMore"><a id="loadmore" href="javascript:;" uid="<?php echo $uid; ?>" tid="<?php echo $tid; ?>" >加载更多内容<i></i></a></div>
					<div class="c"></div>
				</div>
			</div>

		</div>
	
		<!-- 内容收情况 -->
		<ul class="income-detailed" id="incomeDetailed">
			<ol class="idd-item">
				<li class="idd-pillar"></li>
				<li class="idd-depict"><em></em><i></i></li>
			</ol>
		</ul>


		<div class="footer">
			<div class="center">
				<div class="info">All Rights Reserved ® LOGGER&nbsp;&nbsp;|&nbsp;&nbsp;By <a href="#" title="">ffangle.com</a></div>
				<!--
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a></div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
				-->
			</div>
		</div>

		<!-- 查看大图 -->
		<img class="artwork-image" />
		<div class="artwork-close">°</div>
		<div class="artwork-bg"></div>

		<div class="floatside">
			<!-- <a class="s4" id="visitorBtn" href="javascript:;" pop="pop-3" ><span></span><i></i></a> -->
			<a class="s2" id="feedback" href="javascript:;" title="反馈" pop="pop-1"></a>
			<a class="s3" id="topBtn" href="javascript:;" title="" pop="pop-2"></a>
		</div>

		<script type="text/javascript">


				// 获取内容数据
				$.ajax({ 
					type: "POST", 
					url: './ajax/ajax_user.php', 
					data: JSON.stringify({ clist: '30' }),
					contentType:"application/json",
	  				dataType:"json",
					success: function(response){
						// console.log( response );
						
						// 获取元素
						var templat = $('#contentTemplat'),
							temp = null,
							list = $('#contentList');

						// 循环遍历参数
						$(response).each(function(key, data){
							temp = templat.clone();
							temp.removeAttr('id').removeClass('no').show();

							// 判断标示
							if ( data.biaoshi == '1' ) {
								temp.find('.effects-very').removeClass('no').siblings('.effects').remove();
							} else {
								temp.find('.effects').remove();
							}

							// 判断是否有标题
							if ( data.biaotiid == '0' ) {
								temp.find('.tit a').html(data.biaoti);
							} else {
								temp.find('.tit').remove();
							}

							// 作者
							temp.find('.j_anthor').html(data.zuozhe);

							// 判断类型
							temp.find('.gui').addClass('gui_' + data.type);
							if ( data.type == '1' ) {	// 图片
								temp.find('.j_image').siblings('.j_control').remove();
								temp.find('.j_image img').attr('src', data.zhuyao);
								temp.find('.bigimg').attr('href', data.zhuyao);

							} else if ( data.type == '0' ) {	// 文字
								temp.find('.j_text sawtooth').html(data.zhuyao);
								temp.find('.j_text').siblings('.j_control').remove();
							}

							// 得分
							temp.find('.golds').attr('n', data.score).golds();

							// 文本
							if ( data.text ) {
								temp.find('.are').html(data.text);
							}

							list.append(temp);
						});

						// $('#contentList').jw13217();	//自动排序
						$('.purchase').purchase();		//挂接购买按钮
						$('.col').picture();			//挂接已购买的内容为可查看图片
						$('.bigimg').lookbig();			//查看大图
					}
				});


				// 获取焦点图信息
				$.ajax({ 
					type: "POST", 
					url: './ajax/ajax_user.php', 
					data: JSON.stringify({ banner: 'true' }),
					contentType:"application/json",
	  				dataType:"json",
					success: function(response){
						console.log( response );
						
						// 获取元素
						var banner = $('#banner'),
							imgsTemplat = $('#bannerImgsTemplat'),
							imgstemp = null,
							imgslist = $('#bannerImgsList');
							textTemplat = $('#bannerTextTemplat'),
							texttemp = null,
							textlist = $('#bannerTextList');

						// 循环遍历参数
						$(response).each(function(key, data){
							imgstemp = imgsTemplat.clone();
							imgstemp.removeAttr('id').removeClass('no').show();

							imgstemp.find('img').attr('src', data.src);
							imgslist.append(imgstemp);



							texttemp = textTemplat.clone();
							texttemp.removeAttr('id').removeClass('no').hide().addClass('home-banner-col');

							texttemp.find('.tit a').html(data.title);
							texttemp.find('.cue').html(data.text);
							
							// 判断类型
							if ( data.type == '1' ) {	// 推荐内容
								texttemp.find('.time').html(data.time);
								texttemp.find('.money,.tit,.cue').remove();


							} else if ( data.type == '2' ) {	// 推荐标题

								if ( data.titleType == '1' ) {	// 活动
									texttemp.find('.time').html('剩余：' + data.time);
									texttemp.find('.golds').attr('n', data.bonus).golds();

								} else if ( data.type == '2' ) {	// 专题
									texttemp.find('.time').html('更新于：' + data.time);
									texttemp.find('.money').remove();
								}
							}

							textlist.append(texttemp);

							if ( texttemp.index() == '1' ) {
								texttemp.show();
							}
						});




					}
				});


				//焦点图
				var banner = $('.home-banner');
				var key = banner.find('.key i');
				var now = 0;
				key.mouseenter(function(){
					var txt = banner.find('.home-banner-col');
					var i = $(this).index();
					key.removeClass('act').eq(i).addClass('act');
					banner.find('.con').stop().animate({ left: -banner.width() * i }, 1000);
					txt.hide().eq(i).show();
					now = i;
				}).eq(now).mouseenter();
				banner.find('.btn a:first').click(function(){
					var i = now - 1;
						i = i<0? key.length-1 : i;
					key.eq(i).mouseenter();
				});
				banner.find('.btn a:last').click(function(){
					var i = now + 1;
						i = i>key.length-1? 0 : i;
					key.eq(i).mouseenter();
				});




	/*











			//挂接已购买的内容为可查看文本
			$('.col_possess').writing();

			//加载更多
			$('#loadmore').loadmore();

			//自动加载
			// $(window).scroll(function(){
			// 	if($(this).scrollTop() >= $('html,body').height() - $(window).height() - 100){
			// 		$('#loadmore').click();
			// 	}
			// });

			//设置内容为活动推荐
			$('.effects-recommend-set').recommend();

			//挂接关注和取消关注
			$('.describe').attention();

			//公告切换，此效果因为只在此页面使用，所有放在此处
			(function(){
				var cue = $('#notice-cue'),
					col = cue.find('p'),
					len = col.length;
				var current = 0;

				//主要的部分
				function go(){
					if(current >= len){
						current = 0;
					}
					if(current < 0){
						current = len-1;
					};
					cue.stop().animate({ top: -col.height() * current });
				}

				//自动执行
				var loop,
					time = 5000;
				function auto(){
					stop();
					loop = setTimeout(function(){
						auto();
						current++;
						go();
					}, time);
				}
				function stop() {
					clearTimeout(loop);
				}

				//挂接事件
				$('#notice-btn-left').click(function(){ current--; go(); });
				$('#notice-btn-right').click(function(){ current++; go(); });
				$('.notice').hover(function(){
					stop();
				},function(){
					auto();
				}).mouseleave();
			})();


			//获取指定内容的收支情况
			$('.col').income();


			//如果高度改变，重新排序瀑布
			// $('.contentList').resize(function(){
			// 	console.log($(this).height());
			// });
			//启动游客收入
			$(window).visitorIncome();

			*/



			$(document).ready(function(){

				//弹出框初始化
				ncs.pop.init({
					funs: {
						'pop-1': function(pop){
							var txt = pop.find('.pop-form-textarea').val();
							if(txt.replace(/\s*/g, '') != ''){
								pop.hide();		//关闭弹出框
								ncs.ajax.set("feedback="+ txt);	//提交反馈信息后提交数据
							}
						},
						'pop-2': function(){
							ncs.ajax.set("feedback="+ $('.j-fankui').val());	//提交后执行
						}
					}
				});
			});

			//置顶
			(function(){
				var btn = $('#topBtn');
				btn.click(function(){
					$('body,html').animate({ scrollTop:0 }, 500 );
				});
				$(window).scroll(function(){
					if( $(window).scrollTop() > 300 ){
						btn.addClass('rotate');
					}else{
						btn.removeClass('rotate');
					}
				});
			})();

			$(document).ready(function(){
				$('.golds').golds();
			})

			//设置金额显示方式
			// goldShow($('#headGold'));

			//启动游客收入
			$(window).visitorIncome();



		</script>

		<!-- <div class="pop" id="pop-1" >
			<div class="pop-bg"></div>
			<div class="pop-main">
				<h1 class="pop-title">反馈信息</h1>
				<div class="pop-form">
					<div class="pop-form-col">
						<textarea class="pop-form-textarea" placeholder="请填写反馈信息，如果你的建议被采纳，我们将会给予奖励。" ></textarea>
					</div>
					<div class="pop-form-col">
						<input type="button" value="提交" class="pop-form-submit" />
						<a href="javascript:;" class="pop-form-close" >关闭窗口</a>
					</div>
				</div>
				<div class="pop-colse"></div>
			</div>
		</div> -->

		<!-- <div class="pop" id="pop-3" >
			<div class="pop-bg"></div>
			<div class="pop-main">
				<h1 class="pop-title">游客中心</h1>
				<div class="pop-form">
					<div class="pop-form-info">
						<a class="pop-form-icon" href="javascript:;" ><img src="" alt="" /></a>
						<p><span class="pop-form-span">名称：</span>-</p>
						<p><span class="pop-form-span">IP：</span></p>
						<p><span class="pop-form-span">余额：</span><span id="visitorSum" class="golds" n="" ></span> <i></i></p>
						<p><span class="pop-form-span">喜欢：</span><span id="visitorTotal" ></span> 条内容</p>
						<p><span class="pop-form-span">停留时长：</span><span id="" >-</span></p>
					</div>
					<div class="pop-form-col">
						<a href="javascript:;" class="pop-form-submit" >成为会员</a>
						<a href="javascript:;" class="pop-form-close" >关闭窗口</a>
					</div>
				</div>
				<div class="pop-colse"></div>
			</div>
		</div> -->


		</script>
	</body>
</html>