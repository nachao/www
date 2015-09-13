<?php 

	//引用样式头部
	include("./comm/head.php");
?>

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
					<div class="userMain r" id="userMain" ><?php include("./comm/side.php"); ?></div>
					<div class="c"></div>
					<div class="loadMore no">
						<a id="loadmore" href="javascript:;" uid="0" tid="0" >加载更多内容<i></i></a>
					</div>
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
							<input class="affirm" id="registerAffirm" type="button" value="注 册" />
							<a id="registerLink" class="link" href="javascript:;" title="登录">立即登录</a>
						</div>
						<div class="entry-loading" id="entryLoading" ></div>
						<div class="entry-success" id="entrySuccess" >
							<div class="entry-success-contain">
								<div class="entry-success-text">登录成功！</div>
								<div class="entry-success-user"><span id="entrySuccessName">xxxxx</span>，欢迎您回来。</div>
							</div>
						</div>
						<div class="entry-success" id="registerSuccess" >
							<div class="entry-success-contain">
								<div class="entry-success-text">注册成功！</div>
								<div class="entry-success-user"><span id="entrySuccessName">xxxxx</span>，欢迎您的加入。</div>
							</div>
						</div>
						<div class="c"></div>
					</div>
				</div>
				<a href="javascript:;" class="pop-close" >×</a>
				<div class="pop-colse"></div>
			</div>
		</div>
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

		<!-- 应用运行的js文件 -->
		<script type="text/javascript" src="./js/common.js" ></script>
		<script type="text/javascript" src="./js/index.js" ></script>
	</body>
</html>