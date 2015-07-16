<?php
	
	//引用公共文件
	include("./comm/base.php");	

	//设置选择菜单
	Global $ect;
	$ect="user";

	//引用样式头部
	include("./comm/head.php");
?>

	<?php if($u -> Gid()){ ?>
		<!-- 用户信息 -->
		<input type="hidden" id="userplus" value="<?php echo $plus; ?>" />
		<!-- 用户信息 -->
	<?php } ?>



	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea userEffigy f">

					<!-- 图片上传插件 -->
				<!--	<div class="comm">
				 		<div id="altContent">
							<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" WIDTH="500" HEIGHT="450" id="myMovieName">
								<PARAM NAME=movie VALUE="./swf/avatar.swf">
								<PARAM NAME=quality VALUE=high>
								<PARAM NAME=bgcolor VALUE=#FFFFFF>
								<param name="flashvars" value="imgUrl=./img/default.gif&uploadUrl=./comm/upfile.php&uploadSrc=false" />
								<EMBED src="./swf/avatar.swf" quality=high bgcolor=#FFFFFF WIDTH="650" HEIGHT="450" wmode="transparent" flashVars="imgUrl=./img/default.gif&uploadUrl=./comm/upfile.php&uploadSrc=false" NAME="myMovieName" ALIGN="" TYPE="application/x-shockwave-flash" allowScriptAccess="always" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
								</EMBED>
							</OBJECT>
						</div>
						<div id="avatar_priview"></div>
					</div> -->
					<!-- 图片上传插件 -->
					
					<div style="height: 520px;padding: 20px;" class="comm">
						<div id="altContent"></div>
					</div>

					<!-- 修改描述 -->
					<div class="comm settings mt20">
						<div class="tip">个人简介</div>
						<div class="are">
							<div class="loading" id="DLoad"><span></span></div>
							<textarea class="description" def="<?php echo $u -> Gdepict(); ?>" placeholder="尚无个人简介" ><?php echo $u -> Gdepict(); ?></textarea>
						</div>
						<div class="c"></div>
					</div>

					<!-- 修改密码 -->
					<div class="comm settings mt20">
						<div class="tip">修改密码</div>
						<div class="are">
							<div class="loading" id="pwdLoad"><span></span></div>
							<div class="col">
								<span>当前密码：</span>
								<input type="password" class="txt bay" id="nowPwd" placeholder="旧密码" />
							</div>
							<div class="col">
								<span>新的密码：</span>
								<input type="password" class="txt bay" id="newPwd" placeholder="新密码" />
								<input type="password" class="txt bay ml20" id="repeatPwd" style="margin: 20px 0 0 130px;" placeholder="重复新密码" />
							</div>
							<p>虽然密码没有任何规则限制，但建议设置复杂些，以确保安全。</p>
						</div>
						<div class="c"></div>
					</div>
					<!-- 修改密码 -->

					<!-- 修改邮箱 -->
					<div class="comm settings mt20">
						<div class="tip">修改邮箱</div>
						<div class="are">
							<div class="loading" id="emailLoad"><span></span></div>
							<div class="col">
								<span>邮箱地址：</span>
								<input type="text" id="email" name="email" maxlength="30" onblur="return emailCheck('email', 'email')" class="txt bay w300" now="<?php echo $u -> Gemail(); ?>" value="<?php echo $u -> Gemail(); ?>" />
								<input type="button" class="btn" id="emailDelivery" value="发生验证码" readonly="readonly" />
							</div>
							<div class="col no">
								<span>验证码：</span>
								<input type="text" id="emailYzm" class="txt bay w300" now="<?php echo $u -> Gemail(); ?>" value="" />
							</div>
							<p id="emailCue">在你忘记密码的时候，它能派上用场。</p>
						</div>
						<div class="c"></div>
					</div>
					<!-- 修改邮箱 -->

					<!-- 修改邮箱 -->
					<div class="comm settings mt20">
						<div class="tip">邀请地址</div>
						<div class="are">
							<div class="loading" id="emailLoad"><span></span></div>
							<p id="emailCue">http://73.com/login.php?3q=<?php echo $u -> Guid(); ?></p>
							<p id="emailCue">每邀请一个用户，则可以得到 30 分的奖励</p>
						</div>
						<div class="c"></div>
					</div>
					<!-- 修改邮箱 -->

					<!-- 功能设置 -->
					<div class="comm settings mt20">
						<div class="tip">功能设置</div>
						<div class="are settings-function">
							<div class="sf-col">
								<div class="sf-txt">提现</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="0" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">留言板</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="0" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">我的标题</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">关注的用户</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">徽章/福利</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
						</div>
						<div class="c"></div>
					</div>

					<!-- 用户中心设置 -->
					<div class="comm settings mt20">
						<div class="tip">用户中心设置</div>
						<div class="are settings-function">
							<div class="sf-col">
								<div class="sf-txt">金额记录</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">我的标题</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
							<div class="sf-col">
								<div class="sf-txt">独家赞助</div>
								<div class="sf-switch"><i>关闭</i></div>
								<input type='hidden' value="1" class="sf-switch-value" />
							</div>
						</div>
						<div class="c"></div>
					</div>

					<!-- 设置个人中心模板
					<div class="comm settings mt20">
						<div class="tip">个人中心模板</div>
						<div class="are">
							<div class="loading" id="becomevipLoad"><div class="ok">开通成功</div></div>
							<div class="col">
								<div class="selection">
									<label><input type="radio" name="days" value="1" checked /><i>1天</i></label>
									<label class="act"><input type="radio" name="days" value="7" checked /><i>7天</i></label>
									<label><input type="radio" name="days" value="15" /><i>15天</i></label>
									<label><input type="radio" name="days" value="30" /><i>30天</i></label>
									<label><input type="radio" name="days" value="90" /><i>90天</i></label>
								</div>
							</div>
						</div>
						<div class="c"></div>
					</div> -->

				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
    <script type="text/javascript" src="./js/comm.js" ></script>
    <script type="text/javascript" src="./js/xiuxiu.js" ></script>
    <script type="text/javascript">

    	//图片预览
		// function uploadevent(status,picUrl,callbackdata){
		// 	alert(picUrl); //后端存储图片
		// 	// alert(callbackdata); //后端返回数据
		// 	status += ''; 
		// 	switch(status){
		// 		case '1':
		// 			// var time = new Date().getTime();
		// 			// 	picUrl = picUrl.replace('..', '.');
		// 			// $('.pic img').attr('src', picUrl );
		// 			$('#userInfoIcon').attr('src', picUrl );
		// 			break;
		// 		case '-1':
		// 			window.location.reload();
		// 			break;
		// 		default:
		// 			window.location.reload();
		// 	} 
		// }

		window.onload=function(){
			/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
			xiuxiu.embedSWF("altContent",5,"100%","100%");
			//修改为您自己的图片上传接口
			xiuxiu.setUploadURL("http://web.upload.meitu.com/image_upload.php");
			xiuxiu.setUploadType(2);
			xiuxiu.setUploadDataFieldName("upload_file");
			xiuxiu.onInit = function ()
			{
				xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");
			}	
			xiuxiu.onUploadResponse = function (data)
			{	
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "reviseIcon="+ eval('('+ data +')').original_pic,
					success: function(msg){
						$('#userInfoIcon').attr('src', msg);
					}
				});
				// alert("上传响应" + data);  可以开启调试
			}
		}






		/*====
		修改密码
		====*/

		//判断当前密码是的正确
		$('#nowPwd').blur(function(){
			var cue = $(this).parent().nextAll('.cue'),
				txt = $(this),
				val = txt.val();
			if( val != '' )
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "pwdIs="+ val,
				success: function(msg){
					console.log(msg);
					var n = parseInt(msg);
					if( msg == 1 ){
						// cue.html('当前密码正确。').removeClass('red').addClass('green');
						txt.removeClass('textyes').addClass('textgo');
						revisePwd();
					}else{
						// cue.html('当前密码不正确！').removeClass('green').addClass('red');
						txt.removeClass('textgo').addClass('textyes');
					}
				}
			});
		});

		//新密码
		$('#newPwd').blur(function(){
			var txt = $('#newPwd'),
				rep = $('#repeatPwd'),
				now = $('#nowPwd');
			if( txt.val() != '' ){
				
				//判断新密码是否输入了两次
				if( rep.val() == txt.val() && txt.val() != now.val() ){
					txt.removeClass('textyes').addClass('textgo');
					rep.removeClass('textyes').addClass('textgo');
					revisePwd();
				}else{
					txt.removeClass('textgo').addClass('textyes');
					rep.removeClass('textgo').addClass('textyes');
				}
			}
		});

		//确认密码
		$('#repeatPwd').blur(function(){
			$('#newPwd').blur();
		});

		//确认修改密码
		function revisePwd(){
			var now = $('#nowPwd').hasClass('textgo'),
				pwd = $('#newPwd').hasClass('textgo'),
				load = $('#pwdLoad');
			if( now && pwd ){

				//显示加载动画
				load.removeClass('loadingOk').css({ left: -load.width(), opacity: 1 }).show().animate({ left: 0 }, 500);

				//执行数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "revisePwd="+ $('#newPwd').val(),
					success: function(msg){
						console.log( msg );
						
						setTimeout(function(){

							//完成后动画
							load.addClass('loadingOk');
							setTimeout(function(){
								load.animate({ opacity: 0 }, 500,function(){
									load.hide();
								});
							}, 1000);

						}, 1000);

						//清空
						$('#nowPwd').val('').removeClass('textgo');
						$('#newPwd').val('').removeClass('textgo');
						$('#repeatPwd').val('').removeClass('textgo');

					}
				});
			}
		}





		/*====
		修改简介
		====*/
		$('.description').blur(function(){
			var load= $('#DLoad');
			var obj = $(this);

			$(this).val($(this).val().substr(0, 100));

			if( $(this).attr('def') != $(this).val() ){

				//显示加载动画
				load.removeClass('loadingOk').css({ left: -load.width(), opacity: 1 }).show().animate({ left: 0 }, 500);

				//执行数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "reviseDescribe="+ $(this).val(),
					success: function(msg){
						console.log( msg );
						// window.location.reload();

						//刷新页面
						obj.attr('def', obj.val());
						$('.userInfo .depict').html(obj.val());

						//完成后动画
						load.addClass('loadingOk');
						setTimeout(function(){
							load.animate({ opacity: 0 }, 500,function(){
								load.hide();
							});
						}, 1000);
					}
				});
			}
		});




		/*====
		修改邮箱
		====*/
		var emailYzmGo = true;
		function emailCheck(obj, labelName) {  
			var objName = eval("document.all."+obj);  
			var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;  
			if( $('#email').val() != $('#email').attr('now') ){
				if (!pattern.test(objName.value) ) {  
					// alert("");  
					$('#emailCue').html('请输入正确的邮箱地址。').addClass('cred');
					objName.focus();  
					return false;  
				}else{
					$('#emailCue').html('请输入验证码。').removeClass('cred').addClass('cgreen');
					$('#email').parent().next().removeClass('no');

					//挂接事件
					$('#emailDelivery').addClass('cupid-green').click(function(){
						sendEmailYzm();
					});
				}
			}
		}

		//发生邮箱验证码
		function sendEmailYzm(){

			//判断是否可以发送
			if( emailYzmGo ){

				//冻结按钮
				$('#emailDelivery').removeClass('cupid-green');
				refreshTime($('#emailDelivery'));
				emailYzmGo = false;

				//发生验证码
				sendEmailYzm();
						
				// 发送验证码
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "userEmail="+ $('#email').val(),
					success: function(msg){
						console.log( msg );

						$('#emailYzm').blur(function(){
							if( $('#emailYzm').val() == msg ){

								//隐藏验证框
								$('#email').parent().next().addClass('no');
								$('#emailCue').html('邮箱地址正确，修改中。').removeClass('cred').addClass('cgreen');

								$('#emailDelivery').val("发生验证码");
								clearTimeout(refreshLoop);

								//修改数据
								reviseEmail($('#email'));
							}
						});
					}
				});

			}
		}

		//修改邮箱数据
		function reviseEmail(obj){
			var load = $('#emailLoad'),
				def = $(obj).attr('now'),
				txt = $(obj).val();

				txt = txt.replace(/\s/g,'');
			if( txt != '' && def != txt ){

				//显示加载动画
				load.removeClass('loadingOk').css({ left: -load.width(), opacity: 1 }).show().animate({ left: 0 }, 500);

				//执行数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "reviseEmail="+ txt,
					success: function(msg){
						// console.log( msg );

						//提示
						$('#emailCue').html('在你忘记密码的时候，它能派上用场。').removeClass('cred cgreen');

						//冻结按钮
						$('#emailDelivery').removeClass('cupid-green');
						emailYzmGo = false;
						
						//延时执行
						setTimeout(function(){

							//完成后动画
							load.addClass('loadingOk');
							setTimeout(function(){
								load.animate({ opacity: 0 }, 500,function(){
									load.hide();
								});
							}, 1000);

						}, 1000);

						//重置
						$('#email').attr('now', txt);

					}
				});
			}
		}

		//刷新时间
		var refreshSec = 60,
			refreshLoop;
		function refreshTime(obj){
			obj.val( refreshSec + " 秒后可重发");
			if( refreshSec > 0 ){
				refreshLoop = setTimeout(function(){
					refreshSec -= 1;
					refreshTime(obj);
				}, 1000);
			}else{
				obj.val("发生验证码").addClass('cupid-green');
				emailYzmGo = true;
			}
		}


		//成为会员
		$('#becomeVip').click(function(){
			if( $('#userplus').val() > 100 ){
				if( confirm("确认开通会员吗？") ){
					$('#becomevipLoad').slideDown();
					$.ajax({
						type: "POST",
						url: "./ajax/ajax_user.php",
						data: "becomeVip=true",
						success: function(msg){
							// console.log( msg );
							$('#becomeVip').hide().after("<p class='isvip'>你已经成为会员。</p>");
							$('#becomevipLoad').find('.ok').fadeIn(function(){
								setTimeout(function(){
									$('#becomevipLoad').slideUp();
								},2000);
							});
						}
					});
				}
			}else{
				alert("你的金币不足！");
			}
		});


		//功能开关
		$('.sf-switch').click(function(){
			var cn = 'sf-switch-act';
			if ( $(this).hasClass(cn) ) {
				$(this).removeClass(cn).find('i').html('关闭');
			} else {
				$(this).addClass(cn).find('i').html('开启');
			}
		});

		//初始化控制
		$('.sf-switch-value').each(function(){
			if ( $(this).val() == 1 ) {
				$(this).prev('.sf-switch').click();
			}
		});

    </script>

<?php include("./comm/footer.php");	//引用底部 	?>
