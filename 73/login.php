<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//引用样式头部
	include("./comm/head.php");		

	// $u -> Acdk(30);
?>
		
	<div class="container pagecon">
		<div class="entrycenter">
			<div class="entrybg"style="background: transparent;">

				<!-- 教程 -->
				<div class="course course-register">
					<div class="course-dialog"><i></i>
						<p>Hi，欢迎来到七十三号馆！</p>
						<p>你只需要输入 <em>“账号”</em> 和 <em>“密码”</em> 就可以完成注册了。</p>
						<p class="tip">提示：账号只能是中文，密码没有限制（密码为 1 也是可以的）。</p>
					</div>
					<div class="c"></div>
					<img class="course-figure" src="./course/1.gif" />
				</div>
				
			</div>
			<div class="enter">
				<div class="head"><h5>登录</h5><p>log on</p></div>
				<div class="head" style="left: 400px;"><h5>注册</h5><p>register</p></div>
				<div class="content login-style">
					<div class="txt account"><input id="account" name="account" type="text" value="" enter="login" placeholder="" /></div>
					<div class="txt password"><input id="password" name="password" type="password" value="" placeholder="" /></div>
					<div class="txt CDK">
						<input id="CDK" name="CDK" type="text" placeholder="" />
						<a href="javascript:;" pop="pop-cdk" >获取邀请码</a>
					</div>
					<div class="c"></div>
					<div class="interval">
						<div class="cue" id="cue">提示：密码不正确</div>
					</div>
					<div class="btn login">
						<input class="affirm" type="button" value="登 录" />
						<a class="link" href="javascript:;" title="注册">立即注册</a>
						<!-- <a class="qq" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=357586693&site=qq&menu=yes" title="问题咨询"><img border="0" src="http://wpa.qq.com/pa?p=2:357586693:52" alt="点击这里给我发消息"/></a> -->
					</div>
					<div class="btn register" style="display: none;">
						<input class="affirm" type="button" value="注 册" />
						<a class="link" href="javascript:;" title="登录">立即登录</a>
					</div>
					<div class="c"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- 邀请码 -->
	<div class="pop" id="pop-cdk">
		<div class="pop-main">
			<a class="pop-close" href="javascript:;" >×</a>
			<h1 class="pop-title f">全部邀请码</h1>
			<div class="c"></div>
			<div class="pop-list">
				<?php foreach ($u -> Gcdk() as $key => $value) { ?>
					<?php if($value['status']){ ?>
					<span class="yes"><?php echo $value['cdk']; ?></span>				
					<?php }else{ ?>
					<span class="not"><?php echo $value['cdk']; ?></span>	
					<?php } ?>
				<?php }?>
				<div class="c"></div>
			</div>
		</div>
		<div class="pop-bg"></div>
	</div>
	<script type="text/javascript">

		//弹出框
		$('.pop-close,.pop-bg').click(function(){
			$(this).parents('.pop').hide();
		});

		//打开弹出框
		$('*[pop]').click(function(){
			$('#'+$(this).attr('pop')).show();
		});

		//弹出框选择参数
		$('#pop-cdk .pop-list .yes').click(function(){
			$('#CDK').val($(this).html());

			//关闭弹出框
			$(this).parents('.pop').find('.pop-close').click();
		});
		

		//切换
		(function(){

			//点击注册
			$('.login .link').click(function(){
				
				//标题
				$('.head:first').stop().animate({ left: -400 });
				$('.head:last').stop().animate({ left: 0 });

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

			});

			//点击登录
			$('.register .link').click(function(){
				
				//标题
				$('.head:first').stop().animate({ left: 0 });
				$('.head:last').stop().animate({ left: 400 });

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

			});

		})();


		//内容处理

		//转义
		function escaping( v ){
			v = v.replace(/\"/g, "&22");
			v = v.replace(/'/g, "&27");
			v = v.replace(/=/g, "&3D");
			return v;
		}

		//提示
		function pointout(s){
			$('#cue').html("提示："+ s).show();
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

		//跳转
		function skip(){
			location.href = './user.php';
		}


		//登录
		(function(){

			//点击
			$('.login .affirm').click(function(){
				var a = escaping($('#account').val()),
					b = $('#password').val();
				if( !/^[\u4e00-\u9fa5]+$/gi.test($('#account').val()) ){
					pointout("账户只能是中文");
					reg = false;
				}else{
					if( require(a,b) ){
						verify(a, b);
					}
				}
			});

			//验证用户
			function verify(a,b){
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "entry="+ a +"&password="+ b,
					success: function(msg){
						console.log( msg );
						if( msg == 1 ){
							pointout("登录成功");
							skip();
						}else if( msg == 2 ){
							pointout("密码错误");
						}else{
							pointout("账号不存在");
						}
					}
				});
			}

		})();

		//注册
		(function(){

			//是否可注册
			reg = false;

			//验证账户是否已被注册
			// $('#account').blur(function(){ isreg($(this).val()); });
			function isreg(val ,funs){
				if(val.replace(/[ ]/g,"").length == 0){
					pointout("请填写账号");
					$('#account').focus();
				}
				if( !/^[\u4e00-\u9fa5]+$/gi.test(val) ){
					pointout("账户只能是中文");
					$('#account').focus();
				}else{
					var a = escaping(val);
					$.ajax({
						type: "POST",
						url: "./ajax/ajax_user.php",
						data: "account=" + a,
						success: function(msg){
							console.log(msg);
							if( parseInt(msg) == 3 ){
								funs ? funs() : null;	
							}else{
								pointout("此账户已经被注册");
								$('#account').focus();
							}
						}
					});
				}
			}

			//判断验证码是否正常或被使用
			// $('#CDK').blur(function(){ CDK($(this).val()); });
			function CDK(val, funs){
				if(val.replace(/[ ]/g,"").length){
					$.ajax({
						type: "POST",
						url: "./ajax/ajax_user.php",
						data: "CDK=" + val,
						success: function(msg){
							if( !!parseInt(msg) ){
								funs ? funs() : null;
							}else{
								pointout("此激活码不可以");
								$('#CDK').focus();
							}
						}
					});
				}else{
					pointout("请输入邀请码！");
					$('#CDK').focus();
				}
			}

			//点击注册
			$('.register .affirm').click(function(){
				isreg($('#account').val(), function(){		//验证账号
					if($('#password').val().replace(/[ ]/g,"").length > 0){		//验证密码
						CDK($('#CDK').val(), function(){	//验证激活码		
							register();
						});
					}else{
						pointout("请输入密码！");
						$('#password').focus();
					}
				});	
			});

			//注册用户
			function register(a,b){
				var a = $('#account').val(),
					b = $('#password').val();
					c = $('#CDK').val()
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "register="+ a +"&password="+ b +"&3q="+ parseInt(location.search.split('=')[1]) +"&cdk="+ c,
					success: function(msg){
						console.log( msg );
						if( msg == 'overproof' ){
							pointout("请明天再来注册！");
						}else if( !!msg ){
							pointout("注册成功");
							skip();
						}else{
							pointout("注册失败");
						}
					}
				});
			}

		})();

		// 回车
		document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            var type = $("#account").attr('enter');       
            if(e && e.keyCode==13){ // enter 键
            	if( type == "register" ){
            		$('.register .affirm').click();
            	}else{
            		$('.login .affirm').click();
            	}
            }
        }; 


	</script>

<?php include("./comm/footer.php");	//引用底部 	?>