		<div class="floatside">
			<?php if ( !$u -> Is() ) {	//如果是游客 ?>
			<a class="s4" id="visitorBtn" href="javascript:;" pop="pop-3" ><span><?php echo $u -> Gplus(); ?></span><i></i></a>
			<?php } ?>

			<?php if($u -> Guid()){	//登陆用户可反馈 ?>
			<a class="s2" id="feedback" href="javascript:;" title="反馈" pop="pop-1"></a>
			<?php } ?>
			<a class="s3" id="topBtn" href="javascript:;" title="" pop="pop-2"></a>
		</div>

		<?php if($u -> Guid()){	//登陆用户可反馈 ?>
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
		<?php } ?>
	
		<?php if ( !$u -> Is() ) {	//如果是游客 ?>
			<div class="pop" id="pop-3" >
				<div class="pop-bg"></div>
				<div class="pop-main">
					<h1 class="pop-title">游客中心</h1>
					<div class="pop-form">
						<div class="pop-form-info">
							<a class="pop-form-icon" href="javascript:;" ><img src="<?php echo $u -> Gicon(); ?>" alt="" /></a>
							<p><span class="pop-form-span">名称：</span>-</p>
							<p><span class="pop-form-span">IP：</span><?php echo $u -> Gip(); ?></p>
							<p><span class="pop-form-span">余额：</span><span id="visitorSum" class="golds" n="<?php echo $u -> Gplus(); ?>" ></span> <i></i></p>
							<p><span class="pop-form-span">喜欢：</span><span id="visitorTotal" ><?php echo $u -> Gzan(); ?></span> 条内容</p>
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
		<?php } ?>

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

		</script>
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

		<script type="text/javascript">
			$('.bigimg').lookbig();	//查看大图
		</script>
	</body>
</html>