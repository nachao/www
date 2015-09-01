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
							<a href="#" title="那些非常欣赏的作者" >我的关注</a>
							<a href="#" title="那些特别喜欢的内容" >收藏夹</a>
							<a href="#" title="看看别人都给你说了些什么" >私信</a>
							<a href="#" title="在这里把你的积分变成RMB" >提现</a>
							<a href="#" title="这里总有你需要的答案" >帮助</a>
						</div>

						<!-- 搜索 及 注册按钮 -->
						<div class="make r">
							<a class="login f" href="javascript:;" pop="pop-4" >注册/登录</a>

							<!-- 用户信息 -->
							<input type="hidden" value="<?php echo $sum; ?>" id="userGold" />
							<input type="hidden" value="<?php echo $uid; ?>" id="userIs" />
						</div>
						
						<div class="c"></div>
					</div>
				</div>
				<div class="bottomgap"></div>
			</div>

	<?php
		
		//引用公共文件
		// include("./comm/base.php");		

		//设置选择菜单
		// Global $ect;
		// $ect="index";

		//引用样式头部
		// include("./comm/head.php");

		//内容参数
		// $page = $cf -> LPages;		//每页显示的数量
		// $norm = 1;		//内容显示最低标准（金额：0.01元为单位）

		// //获取标题
		// $ist = isset($_GET['tid']) && $_GET['tid'];
		// $isu = isset($_GET['uid']) && $_GET['uid'];

		// //初始化
		// $uid = 0;
		// $tid = 0;
		// $label = 0;

		// if($ist){
		// 	$tid = $_GET['tid'];

		// 	if(isset($_GET['label'])){
		// 		$label = $_GET['label'];
		// 	}

			// $list = $c -> Glist(0, $page, $tid, 0, $label);	//获取内容列表，指定标题内容时没有显示标准
		// 	$total = $c -> Gtotel(0, 0, $tid);				//获取此标题的内容总数

		// }elseif($isu){
		// 	$tid = 0;
		// 	$uid = $_GET['uid'];

		// 	$list = $c -> GUlist(0, $page, 0, 0, $uid);		//获取内容列表，指定用户内容时没有显示标准
		// 	$total = $c -> Gtotel(0, $uid);					//获取此用户的内容总数

		// }else{
		// 	$list = $c -> Glist(0, $page,0 ,$norm);		//获取内容列表
		// 	$total = $c -> Gtotel($norm);				//获取内容总数
		// }



	?>

		<div class="container pagecon">

			<!-- 主体 -->
			<div class="main">
				<div class="center">

					<!-- 操作栏 -->
					<div class="actionbar">
						<div class="iconfont icon-user actionbar-icon"></div>
						<div class="actionbar-info">
							<div class="actionbar-info-title">游客</div>
							<div class="actionbar-info-param">
								<div class="actionbar-info-span"><i class="iconfont icon-good"></i>关注：<em>51</em> 人</div>
								<div class="actionbar-info-span"><i class="iconfont icon-content"></i>内容：<em>23</em> 条</div>
								<div class="actionbar-info-span"><i class="iconfont icon-sum"></i>收益：<em>112</em> 分</div>
							</div>
							<div class="actionbar-info-param no">
								<div class="actionbar-info-span"><i class="iconfont icon-good"></i>关注：<em>51</em> 人</div>
								<div class="actionbar-info-span"><i class="iconfont icon-content"></i>内容：<em>23</em> 条</div>
								<div class="actionbar-info-span"><i class="iconfont icon-sum"></i>收益：<em>112</em> 分</div>
							</div>
						</div>
						<div class="actionbar-use">
							<a class="actionbar-use-btn actionbar-use-btnAct" href="javascript:;" ><i class="iconfont icon-good"></i>已关注</a>
						</div>
					</div>

					<div class="c"></div>

					<!-- 无内容提示 -->
					<div class="Ncon listNot no">
						<div class="are">
							<h1>抱歉！没有找到相关内容。</h1>
							<div class="cue">
								<p>关注此标题，主动了解最新信息。</p>
							</div>
							<div class="btn">
								<a class="stroll" href="./list.php" title="">更多其他内容</a>
							</div>
						</div>
					</div>
					<div class="c"></div>

					<!-- 内容列表 -->
					<div class="contentList" id="contentList" tote="" style="overflow: inherit;margin: 0 -15px;" >
						<div class="row"></div>
						<div class="row"></div>

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
									<a href="./list.php?tid=&label=" class="label">阿萨达速度</a>
									<a href="./list.php?tid=&label=" class="label">阿萨达速</a>
									<a href="./list.php?tid=&label=" class="label">阿萨</a>
								</div>
								<div class="use">
									<div class="num cols-sum f">
										<span class="gold golds" n="" title="内容目前的收入."></span> <i>元</i>
									</div>
									<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
									<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
									<a class="buy confirmBtn use-icon iconfont icon-user r" href="javascript:;" title="作者" >
										<div class="use-floating">
											<div class="use-fcon">
												<img class="use-fc-icon" src="./icon/26.jpg" alt="" >
												<div class="use-fc-name">游客</div>
												<div class="use-fc-param" >
													<span title="积分"><i class="iconfont icon-sum"></i> 123</span>
													<span title="发布的内容量"><i class="iconfont icon-content"></i> 123</span>
													<span title="被收藏次数"><i class="iconfont icon-love"></i>123</span>
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
						<div class="c"></div>
					</div>
					<div class="c"></div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="center">
				<div class="info">All Rights Reserved ® LOGGER&nbsp;&nbsp;|&nbsp;&nbsp;By <a href="#" title="">ffangle.com</a></div>
				<!--
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a></div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
				-->
			</div>
		</div>
		<script type="text/javascript">

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

					$('#contentList').jw13217();	//自动排序
					$('.purchase').purchase();		//挂接购买按钮
					// $('.col').picture();	//挂接已购买的内容为可查看图片
					$('.j_image img').lookbig();	//查看大图

				}
			});

			//自动排序
			// $('.contentList').jw13217();

			//挂接购买按钮
			// $('.purchase').purchase();

			//挂接已购买的内容为可查看图片
			// $('.col_possess').picture();

			//挂接已购买的内容为可查看文本
			// $('.col_possess').writing();

			//加载更多
			// $('#loadmore').loadmore();

			//自动加载
			// $(window).scroll(function(){
			// 	if($(this).scrollTop() >= $('html,body').height() - $(window).height() - 100){
			// 		$('#loadmore').click();
			// 	}
			// });

			//设置内容为活动推荐
			// $('.effects-recommend-set').recommend();

			//挂接关注和取消关注
			// $('.describe').attention();


		</script>
	</body>
</html>