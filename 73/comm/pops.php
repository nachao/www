
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