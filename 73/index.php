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
		<script type="text/javascript" src="./js/angular-1.0.1.min.js"></script>

		<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<!-- 		<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script> -->

		<!-- <script type="text/javascript" src="./js/73-user.js" ></script> -->

		<script type="text/javascript" src="./js/ffangle.js" ></script>
		<script type="text/javascript" src="./js/na.js" ></script>
		<script type="text/javascript" src="./js/na.user.js" ></script>
	</head>
	<body>

	<div class="container" >
		
		<!-- 头部 -->
		<div class="header">
			<div class="topgap"></div>
			<div class="center">
				<div class="row">

					<!-- LOGO -->
					<div class="logo f"><a href="./" ><em>? 七十三号馆</em><i>让一切想法变的有价值.</i></a>
						<span class="version" title="2.0" >Alpha</span>
					</div>

					<!-- 菜单 -->
					<div class="menu f">
						<a href="#" title="最新最热门的内容都在这里" >首页</a>
						<a href="#" title="在这里查看和管理你发布的所有内容" >内容管理</a>
						<!-- <a href="#" title="那些非常欣赏的作者" >我的关注</a> -->
						<a href="#" title="那些特别喜欢的内容" >收藏夹</a>
						<!-- <a href="#" title="看看别人都给你说了些什么" >私信</a> -->
						<a href="#" title="在这里把你的积分变成RMB" >提现</a>
						<a href="#" title="这里总有你需要的答案" >帮助</a>
					</div>

					<!-- 搜索 及 注册按钮 -->
					<div class="make r">
						<a class="login f" href="javascript:;" id="j_userEntry" pop="pop-4" >注册/登录</a>
						<a class="login no f" href="javascript:;" id="j_userOperate" style="border-top-color: #e74c3c;" >注册/登录</a>

						<!-- <div class="operate f" style="border-top-color: #e74c3c;" >
							<div class="icon"><a href="./user.php" ></a><i></i></div>
							<div class="link">
								<a href="javascript:;" class="price" ><span class="glyphicon glyphicon-fire"></span><em id="headGold" class="golds" n="0" ></em> <i></i></a>
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
						</div> -->

						<!-- 用户信息
						<input type="hidden" value="" id="userGold" />
						<input type="hidden" value="" id="userIs" />
						 -->
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

					<!-- 公告 -->
					<div class="notice no">
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

					<!-- 焦点图 -->
					<div class="home-banner no" id="banner">
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

					<!-- 操作栏 -->
					<div class="home-slogan no">这里会让一切变的有价值。<br />有很多网友还是很热心的我跟你说。</div>
		
					<!-- 内容列表 -->
					<div class="contentList f" tote="" id="contentList" >
						<div class="row"  ></div>
						<div class="col no" cid="" now="" id="contentTemplat" >

							<!-- 标示 -->
							<div class="effects effects-very no" alt="作者顶贴" ></div>
							<div class="effects effects-recommend no" alt="题主推荐" ></div>
							<div class="effects effects-first no" alt="活动第一名" ></div>

							<div class="cont">
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
								<div class="count-labels">
									<a href="./list.php?label=123" class="label">阿萨达速度</a>
									<a href="./list.php?label=4123" class="label">阿萨达速</a>
									<a href="./list.php?label=4123123" class="label">阿萨</a>
								</div>
								<div class="use">
									<div class="num cols-sum f">
										<span class="gold golds" n="" title="内容目前的收入."></span> <i>元</i>
									</div>
									<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
									<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
									<a class="buy confirmBtn use-icon iconfont icon-user r" href="javascript:;" title="作者" >
										<div class="use-floating">
											<div class="use-fcon use-fcon-load">
												<img class="use-fc-icon" src="./icon/26.jpg" alt="" >
												<div class="use-fc-name">游客</div>
												<div class="use-fc-param" >
													<span title="积分"><i class="iconfont icon-sum"></i> <em>123</em></span>
													<span title="发布的内容量"><i class="iconfont icon-content"></i> <em>123</em></span>
													<span title="被收藏次数"><i class="iconfont icon-love"></i> <em>123</em></span>
												</div>
											</div>
										</div>
									</a>
									<a class="buy confirmBtn iconfont icon-detailed r" href="./detail.php?cid=" title="评论" ></a>
									<a class="buy confirmBtn purchase iconfont icon-good praise r" href="javascript:;" title="赞" ></a>
									<div class="c"></div>	
								</div>
							</div>

							<!-- 评论 -->
							<div class="cont-comment">
								<div class="message-list" id="messageList">
									<div class="message-title">全部评论</div>
									<div class="message-rows" id="messageTemplet" style="display: none;" >
										<div class="message-r-icon">
											<a href="javascript:;" ><img src="" /></a>
										</div>
										<div class="message-r-info">
											<div class="message-i-name">
												<a href="javascript:;" ></a>
											</div>
											<div class="message-i-text"></div>
											<div class="message-i-other">
												<div class="message-o-time"></div>
												<div class="message-o-use">
													<a class="message-u-good" href="javascript:;" title="" >赞 <span>0</span></a>
													<a class="message-u-bad" href="javascript:;" title="" >踩 <span>0</span></a>
													<a class="message-u-reply" href="javascript:;" title="" >回复</a>
												</div>
												<div class="c"></div>
											</div>
											<div class="message-i-reply">
												<textarea class="message-reply-text" id="messageReplyText" placeholder="请输入评论" ></textarea>
												<a class="message-reply-btn" id="messageReplyBtn" href="javascript:;">回复</a>
											</div>
											<div class="c"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
	
					<!-- 用户资料 -->
					<div class="userMain r">
						
						<!-- 基本信息 -->
						<div class="um-base">
							<div class="userInfo" >
								<div class="withdraw"><a href="#" title="修改资料" ></a></div>
								<div class="icon f">
									<a href="#" ><img id="userInfoIcon" src="<?php echo './icon/26.jpg'//u -> Gicon(); ?>" /></a>
								</div>
								<div class="info f">
									<div class="price">
										<em id="userInfoGold" class="golds" n="<?php echo '100'//$u -> Gplus(); ?>"></em><i>元</i>
									</div>
									<div class="name" id="userInfoName" >游客</div>
								</div>
								<div class="c"></div>
								<div class="depict no"><?php echo '暂无描述'//$u -> Gdepict(); ?></div>
								<div class="c"></div>
							</div>
						</div>

						<!-- 实时收入 -->
						<div class="um-cartogram" id="container" style="width: 100%;height:400px"></div>

						<!-- 最新评论 -->
						<div class="um-comment commarea">
							<div class="content">
								<div class="head">
									<div class="tit f"><i class="iconfont icon-kafeiting"></i><em>最新评论</em></div>
									<div class="gap"><i></i></div>
								</div>
								<div class="messageBoard">
									<div class="message-publish no">
										<textarea class="message-p-text" id="messagePText" placeholder="请输入评论" ></textarea>
										<a class="message-p-btn" id="messagePBtn" href="javascript:;">发布</a>
									</div>
									<div class="c"></div>
									<div class="message-loading no" id="messageLoading"></div>
									<div class="message-node" id="messageNot">没有内容</div>
									<div class="message-list" id="messageList">
										<div class="message-title">全部评论</div>
										<div class="message-rows" id="messageTemplet" style="display: none;" >
											<div class="message-r-icon">
												<a href="javascript:;" ><img src="" /></a>
											</div>
											<div class="message-r-info">
												<div class="message-i-name">
													<a href="javascript:;" ></a>
												</div>
												<div class="message-i-text"></div>
												<div class="message-i-other">
													<div class="message-o-time"></div>
													<div class="message-o-use">
														<a class="message-u-good" href="javascript:;" title="" >赞 <span>0</span></a>
														<a class="message-u-bad" href="javascript:;" title="" >踩 <span>0</span></a>
														<a class="message-u-reply" href="javascript:;" title="" >回复</a>
													</div>
													<div class="c"></div>
												</div>
												<div class="message-i-reply">
													<textarea class="message-reply-text" id="messageReplyText" placeholder="请输入评论" ></textarea>
													<a class="message-reply-btn" id="messageReplyBtn" href="javascript:;">回复</a>
												</div>
												<div class="c"></div>
											</div>
										</div>
									</div>
									<div class="message-page" >
										<a class="message-page-btn message-pa-next" href="javascript:;" >&gt;</a>
										<div class="message-page-current">
											<div class="message-current-use">
												<a href="javascript:;" >1</a>
												<a href="javascript:;" >2</a>
												<a href="javascript:;" >3</a>
											</div>
											<div class="message-current-num"><span>1</span><i></i></div>
										</div>
										<a class="message-page-btn message-page-prev" href="javascript:;" >&lt;</a>
									</div>
									<div class="c"></div>
								</div>
							</div>
							<div class="bottomSide"></div>
						</div>

					</div>

					<div class="c"></div>

					<div class="loadMore no"><a id="loadmore" href="javascript:;" uid="<?php echo $uid; ?>" tid="<?php echo $tid; ?>" >加载更多内容<i></i></a></div>
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

	<script type="text/javascript">

		// 实时收入
		$(function () {
		    $('#container').highcharts({
		        chart: {
		            type: 'spline',
		            backgroundColor: 'rgba(0, 0, 0, 0)'
		        },
		        title: {
		            text: ''
		        },
		        subtitle: {
		            text: ''
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: ''
		            }
		        },
		        tooltip: {
		            enabled: false,
		            formatter: function() {
		                return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'°C';
		            }
		        },
		        plotOptions: {
		            line: {
		                dataLabels: {
		                    enabled: true
		                },
		                enableMouseTracking: false
		            },
		            spline: {
		           		// allowPointSelect :true,//是否允许选中点  
						animation:true,//是否在显示图表的时候使用动画  
						cursor:'pointer',//鼠标移到图表上时鼠标的样式  
						// dataLabels:{  
						//   enabled :true,//是否在点的旁边显示数据  
						//    rotation:0  
						// },  
						enableMouseTracking:true,//鼠标移到图表上时是否显示提示框  
						events:{//监听点的鼠标事件  
						   click: function() {  
						   }  
						},  
						marker:{  
							enabled: true,//是否显示点  
							radius: 3,//点的半径  
						     // fillColor:"#888",
							// lineColor:"#000",
							// symbol: 'url(http://highcharts.com/demo/gfx/sun.png)',//设置点用图片来显示  
						   states:{  
						       hover:{  
						           enabled: true//鼠标放上去点是否放大  
						                                   },  
						       select:{  
						           enabled:false//控制鼠标选中点时候的状态  
						       }  
						   }  
						},  
						states:{  
						   hover:{  
						       enabled:true,//鼠标放上去线的状态控制  
						       lineWidth: 3 
						   }  
						},  
						// stickyTracking:true,//跟踪  
						// visible:true,  
						// lineWidth:2//线条粗细  
						// pointStart:100,
		            }
		        },
		        series: [{
		            name: '收入',
		            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		        }, {
		            name: '支出',
		            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
		        }]
		    });
		});				


			// 获取内容数据
			$.ajax({ 
				type: "POST", 
				url: './ajax/ajax_user.php', 
				data: JSON.stringify({ clist: '10' }),
				contentType:"application/json",
  				dataType:"json",
				success: function(response){
					console.log( response );
					
					// 获取元素
					var templat = $('#contentTemplat'),
						temp = null,
						list = $('#contentList');

					// 循环遍历参数
					$(response).each(function(key, data){

						// console.log(data);
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
						temp.find('.icon-user').attr('href', './list.php?uid='+ data.uid);
						temp.find('.use-fc-name').html(data.zuozhe);

						// 绑定事件
						temp.find('.icon-user').attr('get', '0').mouseenter(function(){

							var are = $(this),
								get = $(this).attr('get');

							if ( get == '0' ) {

								$(this).attr('get', '1');	// 标记为正在获取数据

								na.user.get( data.uid, function(data){
									are.find('.use-fc-icon').attr('src', data.icon );
									are.find('.use-fc-name').html(data.name );

									are.find('.use-fc-param .icon-sum').next('em').html(data.sum );
									are.find('.use-fc-param .icon-content').next('em').html(data.content );
									are.find('.use-fc-param .icon-love').next('em').html(data.love );

									are.find('.use-fcon').removeClass('use-fcon-load');
								});
							}
						});

						// 判断类型
						temp.find('.gui').addClass('gui_' + data.type);
						if ( data.type == '1' ) {	// 图片
							temp.find('.j_image').siblings('.j_control').remove();
							temp.find('.j_image img').attr('src', data.zhuyao);
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
					// $('.col').picture();	//挂接已购买的内容为可查看图片
					$('.j_image img').lookbig();	//查看大图
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

	</script>

		<div class="floatside">
			<!-- <a class="s4" id="visitorBtn" href="javascript:;" pop="pop-3" ><span></span><i></i></a> -->
			<a class="s2" id="feedback" href="javascript:;" title="反馈" pop="pop-1"></a>
			<a class="s3" id="topBtn" href="javascript:;" title="" pop="pop-2"></a>
			<!-- <a class="s1" id="topBtn" href="javascript:;" title="" pop="pop-4"></a> -->
		</div>

		<div class="pop" id="pop-1" >
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
		</div>

		<div class="pop" id="pop-3" >
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
						<!-- <a href="javascript:;" class="pop-form-submit" >成为会员</a> -->
						<a href="javascript:;" class="pop-form-close" >关闭窗口</a>
					</div>
				</div>
				<div class="pop-colse"></div>
			</div>
		</div>

		<div class="pop pop-enter" id="pop-4" >
			<div class="pop-bg"></div>
			<div class="pop-main">

				<div class="enter">
					<div class="head"><h5>登录</h5><p>log on</p></div>
					<div class="head" style="left: 400px;"><h5>注册</h5><p>register</p></div>
					<div class="content login-style">
						<div class="txt account"><input id="account" name="account" type="text" value="" enter="login" placeholder="账号" /></div>
						<div class="txt password"><input id="password" name="password" type="password" value="" placeholder="密码" /></div>
						<div class="txt CDK">
							<input id="CDK" name="CDK" type="text" placeholder="" />
							<a href="javascript:;" pop="pop-cdk" >获取邀请码</a>
						</div>
						<div class="c"></div>
						<div class="interval" id="intervalCue"></div>
						<div class="btn login">

							<div class="public-tip public-tip-right" id="loginAffirmTip" style="top: 6px;right: 110px;">
								<i></i><em>aasdasd</em>
							</div>

							<input class="affirm" id="loginAffirm" type="button" value="登 录" />
							<a id="loginLink" class="link" href="javascript:;" title="注册">立即注册</a>
							<!-- <a class="qq" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=357586693&site=qq&menu=yes" title="问题咨询"><img border="0" src="http://wpa.qq.com/pa?p=2:357586693:52" alt="点击这里给我发消息"/></a> -->
						</div>
						<div class="btn register" style="display: none;">
							<input class="affirm" type="button" value="注 册" />
							<a id="registerLink" class="link" href="javascript:;" title="登录">立即登录</a>
						</div>
						<div class="entry-loading" id="entryLoading" ></div>
						<div class="entry-success" id="entrySuccess" >
							<div class="entry-success-contain">
								<div class="entry-success-text">登录成功！</div>
								<div class="entry-success-user"><span id="entrySuccessName">xxxxx</span>，欢迎您回来。</div>
								<div class="entry-success-param">
									<p>您离开的这段时间里：</p>
									<p>新增收入：<span id="entrySuccessPlus">0</span>分</p>
									<p>新增收藏：<span id="entrySuccessCollect">0</span>次</p>
									<p>新增评论：<span id="entrySuccessComment">0</span>分</p>
									<p>新增粉丝：<span id="entrySuccessFollower">0</span>分</p>
								</div>
							</div>
						</div>
						<div class="c"></div>
					</div>
				</div>
				<a href="javascript:;" class="pop-close" >×</a>
				<div class="pop-colse"></div>
			</div>
		</div>

		<script type="text/javascript">

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



		//切换
		(function(){

			//点击注册
			$('#loginLink').click(function(){
				
				//标题
				$('.pop-enter .head:first').stop().animate({ left: -400 });
				$('.pop-enter .head:last').stop().animate({ left: 0 });

				//密码确认
				// $('.confirm').stop().animate({ top: 0 });

				//输入验证码
				$('.content').removeClass('login-style');

				//按钮
				$('.register').show();
				$('.login').hide();

				//类型
				$('#account').attr('enter', 'register');

				//验证账号
				$('#account').blur();

				$('.entrybg').stop().animate({ left: 625 });

			});

			//点击登录
			$('#registerLink').click(function(){


				
				//标题
				$('.pop-enter .head:first').stop().animate({ left: 0 });
				$('.pop-enter .head:last').stop().animate({ left: 400 });

				//输入验证码
				$('.content').addClass('login-style');

				//密码确认
				// $('.confirm').stop().animate({ top: -50 });

				//按钮
				$('.register').hide();
				$('.login').show();

				//类型
				$('#account').attr('enter', 'login');

				//验证账号
				$('#account').blur();

				$('.entrybg').stop().animate({ left: 0 });

			});

			//转义
			function escaping( v ){
				v = v.replace(/\"/g, "&22");
				v = v.replace(/'/g, "&27");
				v = v.replace(/=/g, "&3D");
				return v;
			}

			//不能为空
			function require(a,b){
				if( !a ){
					pointout("请填写账号");
					return false;
				}else if( !b ){
					pointout("请填写密码");
					return false;
				}else{
					return true;
				}
			}

			//点击
			$('#loginAffirm').click(function(){

				var account = $('#account').val(),
					password = $('#password').val(),
					interval = $('#loginAffirmTip'),
					verify = null;

				verify = na.user.verifyAccount(account);	// 判断账号

				if ( verify.status ) {
					verify = na.user.verifyPwd(password);	// 判断密码

					if ( verify.status ) {
						$('#entryLoading').slideDown();
						setTimeout(function(){

							na.user.entry( account, password, function(verify){	// 后台判断及登录
								$('#entryLoading').slideUp();

								if ( verify.status == '0' ) {			// 密码错误
									interval.stop().show().find('em').html( verify.message ).parent().delay(3000).fadeOut();

								} else if ( verify.status == '1' ) {	// 登录成功
									var success = $('#entrySuccess').slideDown();

									// 显示登录用户信息
									success.find('#entrySuccessName').html(verify.basic.name);
									success.find('#entrySuccessPlus').html(verify.insert.plus);
									success.find('#entrySuccessCollect').html(verify.insert.collect);
									success.find('#entrySuccessComment').html(verify.insert.comment);
									success.find('#entrySuccessFollower').html(verify.insert.follower);

									// 保存用户信息
									na.user.set(verify);

									// 开启缓存
									na.user.cache(verify);

									// 刷新显示
									na.user.refresh(verify);
								}
							});
						}, 1000);

					} else {
						interval.stop().show().find('em').html( verify.message ).parent().delay(3000).fadeOut();
						$('#password').focus();
					}
				} else {
					interval.stop().show().find('em').html( verify.message ).parent().delay(3000).fadeOut();
					$('#account').focus();
				}



				// var a = escaping($('#account').val()),
				// 	b = $('#password').val();
				// if( !/^[\u4e00-\u9fa5]+$/gi.test($('#account').val()) ){
				// 	pointout("账户只能是中文");
				// 	reg = false;
				// }else{
				// 	if( require(a,b) ){
				// 		verify(a, b);
				// 	}
				// }
			});

			// 回车
			// document.onkeydown = function(event){
	  //           var e = event || window.event || arguments.callee.caller.arguments[0];
	  //           console.log(e);
	  //           var type = $("#account").attr('enter');       
	  //           if(e && e.keyCode==13){ // enter 键
	  //           	if( type == "register" ){
	  //           		$('.register .affirm').click();
	  //           	}else{
	  //           		$('#loginAffirm').click();
	  //           	}
	  //           }
	  //       };

	        $(window).keydown(function(e){
				console.log(e.keyCode);

				if ( e && e.keyCode == 13 ) { // enter 键

					if( $("#account").attr('enter') == "login" ){
						$('#loginAffirm').click();		// 登录

					}else{
						$('.register .affirm').click();	// 注册
					}
				}
	        });

			//验证用户
			function verify( account, password ){
				var load = $('#entryLoading').stop().animate({ height: '100%' }),
					success = $('#entrySuccess').stop().css({ height: '0px' });
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					// data: "entry="+ a +"&password="+ b,
					data: JSON.stringify({ 'entry': account, 'password': password }),
					contentType:"application/json",
	  				dataType:"json",
					success: function(msg){
						load.stop().animate({ height: '0px' });

						if( msg.status == 1 ){

							success.stop().animate({ height: '100%' });
							success.stop().animate({ height: '100%' });

							// pointout("登录成功");	
							// skip();
						}else if( msg == 2 ){
							// pointout("密码错误");
						}else{
							// pointout("账号不存在");
						}
					}
				});
			}

		})();

		</script>
		<div class="footer no">
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

		<script type="text/javascript">
			$('.bigimg').lookbig();	//查看大图
		</script>
	</body>
</html>