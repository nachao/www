		<div class="floatside">
			<a class="s3 rotate" id="topBtn" href="javascript:;" title=""></a>
		</div>
		<script type="text/javascript">
		
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

			$('.golds').golds();

			//设置金额显示方式
			// goldShow($('#headGold'));

		</script>
		<div class="footer">
			<div class="center">
				<div class="info">All Rights Reserved ® LOGGER&nbsp;&nbsp;|&nbsp;&nbsp;By <a href="#" title="">ffangle.com</a></div>
				
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a></div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
			</div>
		</div>
	</body>
</html>