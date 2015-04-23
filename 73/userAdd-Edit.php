<?php
	
	//引用公共文件
	include("./comm/base.php");	
	
	//设置选择菜单
	Global $ect;
	$ect="fabu";	

	//引用样式头部
	include("./comm/head.php");

	//没有登录则跳转至列表页
	if(!$u -> Guid()){
		$u -> UtoL();
	}

	//默认修改提示
	$reviseOk = 0;

	//是否提交表单
	if(isset($_POST['submit'])){
		$cid = $_POST['reviseCon'];
		$type = $_POST['types'];

		$info = $c -> Ginfo($cid);
		$depict = $info['content'];

		if($type == 1){
			$depict = $_POST['imgDepict'];
			if($_POST['beforeimg'] != $info['image']){
				$c -> Uimg($cid, $_POST['beforeimg']);		//修改图片地址
			}
		}
		if($type == 2){
			$depict = $_POST['videoDepict'];
			if($_POST['videoAddress'] != $info['video']){
				$c -> Uvideo($cid, $_POST['videoAddress']);		//修改视频地址
			}	
		}
		if($type == 3){
			$depict = $_POST['musicDepict'];
			if($_POST['musicAddress'] != $info['music']){
				$c -> Uvideo($cid, $_POST['musicAddress']);		//修改音乐地址
			}	
		}
		if($depict != $info['content']){
			$c -> Utxt($cid, $o -> Chtml($depict));		//修改描述
		}

		$c -> URtime($cid); //刷新修改时间
	}

	//是否提交成功
	// if(isset($_GET['ok'])){
	// 	$reviseOk = $_GET['ok'];
	// }

	//是否修改指定内容
	$Rcid = 0;
	if(isset($_GET['cid'])){
		if($u -> Guid() == $c -> Gauthor($_GET['cid'])){
			$Rcid = $_GET['cid'];
			$Rinfo = $c -> Ginfo($Rcid);
		}
	}


?>

	<script type="text/javascript" src="./js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="./js/ueditor/ueditor.all.js"></script>
	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f">

					<?php if($reviseOk){ //判断是否修改成功	?> 
						<div class="noContent addContentMsg">
							<div class="are">
								<a class="confirm" href="./detail.php?cid=<?php echo $addOk; ?>" title="">确认，前往详细页</a>
								<a class="stroll" href="./userAdd.php" >继续发布</a>
								<a class="stroll" href="./user.php" title="">个人中心</a>
							</div>
						</div>
					<?php }else{ ?>
						<div class="commarea publishHead">
							<div class="content">
								<div class="head">
									<div class="tit f"><em>修改内容</em></div>
									<div class="gap"><i></i></div>
								</div>

								<!-- 发布信息 开始 -->
								<form class="publish" enctype="multipart/form-data" action="" method="post" name="upform" onsubmit="return check(this);">

									<!-- 用户后台数据处理 -->
									<input type="hidden" value="<?php echo $Rcid; ?>" id="reviseCon" name="reviseCon" />
									<input id="conTypes" type="hidden" name="types" value="<?php echo $Rinfo['types']; ?>" />
									<div class="main">
										<?php if($Rinfo['titleid']){ ?>
										<div class="title">
											<input id="conTitleShow" class="tit f" type="text" value="<?php echo $t -> Gtitle($Rinfo['titleid']); ?>" readonly="readonly" style="display: block;" />
											<input id="conTitleId" type="hidden" name="titleid" value="<?php echo $Rinfo['titleid']; ?>" />
											<div class="c"></div>
										</div>
										<?php } ?>

										<!-- 文字 -->
										<div class="col extent writing">
											<div class="tip">请填写内容<i></i></div>
											<textarea id="txtApply" class="cue txt conts" name="depict" placeholder="请输入内容" ></textarea>
											<div class="c"></div>
										</div>
										<!-- 文字 -->

										<!-- 图片 start -->
										<div class="col extent picture">
											<div class="uploadPhoto" id="uploadPhoto">重新选择</div>
											<div class="tip">必选要选择一张图片<i></i></div>
											<div class="con">
												<div id="uploadPlugIn" style="height: 600px;display: none;" ><div id="altContent"></div></div>
												<img id="imgHeadPhoto" src="<?php echo $Rinfo['image']; ?>" />
												<div class="c"></div>
											</div>
											<div class="c"></div>
											<textarea class="no j-text" name="imgDepict"></textarea>
											<div class="cue j-describe" id="j-cue-image" contentEditable="true" ><?php echo $Rinfo['content']; ?></div>
											<input class="conts" type="hidden" value="<?php if($Rcid){ echo $Rinfo['image']; } ?>" name="beforeimg" id="beforeimg" />
											
										    <script type="text/plain" id="editor" style="width: 300px;height: 100px;"></script>
										</div>
										<!-- 图片 end -->

										<!-- 视频 -->
										<div class="col video">
											<div class="tip">请输入视频地址<i></i></div>
											<div class="con">
												<div class="hint">
													<p>视频推荐网站：
														<a href="http://www.56.com" title="访问此网站" target="_blank" >56</a>&nbsp;&nbsp;&nbsp;
														<a href="http://www.youku.com" title="访问此网站" target="_blank" >优酷</a>&nbsp;&nbsp;&nbsp;
														<a href="http://www.tudou.com" title="访问此网站" target="_blank" >土豆</a>&nbsp;&nbsp;&nbsp;
													</p>
													<p>怎么找视频地址？不知道话，请点 <a class='co' href="#" title="" >这里</a>。</p>
												</div>
												<span class="tit">Http://</span>
												<input class="txt conts" id="j-vidsrc" type="text"  name="videoAddress"  value="" placeholder="请输入视频地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="vidembed" src="<?php echo $Rinfo['video']; ?>" type="application/x-shockwave-flash" width="100%" height="350" allowfullscreen="true" allownetworking="all" allowscriptaccess="always">
												<div class="c"></div>
											</div>
											<textarea class="no j-text" name="videoDepict"></textarea>
											<div class="cue j-describe" id="j-cue-video" contentEditable="true" ><?php echo $Rinfo['content']; ?></div>
										</div>
										<!-- 视频 -->

										<!-- 音乐 start  -->
										<div class="col video music">
											<div class="tip">请输音乐地址<i></i></div>
											<div class="con">
												<div class="hint">
													<p>当前只支持 <a href="http://www.xiami.com" title="访问此网站" target="_blank" >虾米网</a> 的音乐</p>
													<p>不知道怎么添加音乐，请点 <a class='co' href="#" title="" >这里</a>。</p>
												</div>
												<span class="tit">Http://</span>
												<input class="txt conts" id="mussrc" name="musicAddress" type="text"  value="" placeholder="请输入音乐地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="musembed" src="" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent">
												<div class="c"></div>
											</div>
											<textarea class="no j-text" name="musicDepict"></textarea>
											<div class="cue j-describe" id="j-cue-music" contentEditable="true" title="描述（可以不写）" ><?php echo $Rinfo['content']; ?></div>
										</div>

										<!-- 提交  -->
										<div class="prompt" style="margin-top: 50px;">
											<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<input id="submitApply" class="sub f" type="submit" name="submit" value="确认修改" />	
											<a href="./user.php" class="cancel" >取消修改</a>	
											<div class="c"></div>

											<!-- 只用于前端 显示计算 -->
											<input type="hidden" id="number" value="<?php echo $number; ?>" />	
											<input type="hidden" id="standard" value="7" />			
											<input type="hidden" id="basic" value="<?php echo $basic; ?>" />		
										</div>
									</div>
									<div class="c"></div>
							    </form>
								<!-- 发布信息 结束 -->

								<div class="c"></div>
							</div>
							<div class="bottomSide"></div>
						</div>
					<?php } ?>

				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./js/comm.js" ></script>
	<script type="text/javascript" src="./js/xiuxiu.js"></script>
	<script type="text/javascript">


        
	    //实例化编辑器
	    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
	    UE.getEditor('editor', {
	        toolbars:[['FullScreen', 'fontfamily', 'Undo', 'Redo','Bold','test']],
	    });

		//清空描述样式
		$('.video .cue').blur(function(){
			// $(this).html($(this).text());
			$(this).find('*').removeAttr('style class href target');
		});


		//类型选择
		function selectType(i){
			$('#classType').val(i);
			$('.main .col').hide().eq(i).show();
			$('#conTypes').val(i);
			$('.nav a').eq(i).addClass('act').siblings().removeClass('act');
		}
		$('.nav a').click(function(){ selectType($(this).index()); });
		selectType($('#conTypes').val());	//初始化选择


		//关闭和显示上传图片插件
		$('#uploadPhoto').click(function(){
			$('#uploadPlugIn').toggle();
		});

		
		//添加视频
		$('#j-vidsrc').blur(function(){
			var input = $(this);
				value = $(0).isVideoAddress(input),
				embed = $('#vidembed');
			if(value){
				embed.attr('src', value).parent().show();
				input.removeClass('textyes');
			}else{
				embed.removeAttr('src').parent().hide();
				input.addClass('textyes');
			}
		});
		
		//添加视频
		// (function(){
		// 	var src 	= $('#vidsrc'),
		// 		done 	= $('#vidembed'),
		// 		url 	= $('#vidrefer');
		// 	src.blur(function(){
		// 		var v 	= $(this).val(),
		// 			a 	= v.indexOf('http:'),
		// 			b 	= v.indexOf('.swf');
		// 		if( v != '' ){
		// 			if( a>-1 && b>-1 ){
		// 				v = v.substr(a,b-a+4);
		// 				$(this).val(v);
		// 					if((( v.indexOf('56.com') >= 0 || v.indexOf('youku.com') >= 0 ) || v.indexOf('tudou.com') >= 0 ) || v.indexOf('yinyuetai.com') >= 0 ){
		// 						var temp = done.clone();
		// 							temp.attr('src', v).parent().show();
		// 						$('.video:first .result').show().empty().append(temp);
		// 						url.val(v);
		// 						// $('.video .hint p:first').html('可以发布。').css({ color:'green' });
		// 					}else{
		// 						src.val('抱歉暂时还不支持此网站的 视频！');
		// 						url.val('');
		// 					}
		// 			}else{
		// 				src.val('不可用！');
		// 				url.val('');
		// 			}
		// 		}else{
		// 			url.val('');
		// 		}
		// 	}).blur();
		// })();

		//添加音乐
		(function(){
			var src = $('#mussrc'),
				done = $('#musembed'),
				url = $('#musrefer');
			src.blur(function(){
				var v = $(this).val(),
					a = v.indexOf('http:'),
					b = v.indexOf('.swf');
				v = v.substr(a+7,b-a+4);
				$(this).val(v);
				if( v != '' ){
					if( v.indexOf('xiami.com') >= 0 && v.indexOf('.swf') >= 0 ){
						// done.attr('src', v).parent().show();
						// url.val(v);

						var temp = done.clone();
							temp.attr('src', 'http://'+v).parent().show();
						$('.music .result').show().empty().append(temp);
						src.val('http://'+v);

						//提示
						// $('.music .hint p:first').html('可是发布。').css({ color:'green' });
					}else{
						src.val('抱歉暂时还不支持此网站的 音乐！');
						url.val('');
					}
				}else{
					url.val('');
				}
			}).blur();
		})();

		//默认打开标题
		var at = $('#titleList'),
			dat = at.attr('tid');
		if(dat){
			$('#titleList .tits[tid='+ dat +']').click();
		}


		//表单检测
		function check( obj ){

			//获取参数
			var type = $("input[name='types']").val();

			//获取指定的提示元素
			var col = $(".publish .col").eq(type),
				tip = col.find(".tip"),
				con = col.find('.conts');

			var loop;

			//将编辑DIV里的描述转移至文本域中
			$('.j-text').val($('.j-describe').html());

			//遍历所有必要内容
			if( con.val() == '' ){
				tip.show();
				clearTimeout(loop);
				loop = setTimeout(function(){ tip.fadeOut(); }, 2000);
				return false;
			}

			//检测用户余额是否足够
			if( parseInt($('#userGold').val()) < parseInt($('#totalTote').attr('n')) ){
				$('#tipApply').show();
				return false;	
			}


			// if( type == 2 ){	//检测视频

			// 	//获取元素
			// 	var video 	= $('#vidsrc'),
			// 		done 	= $('#vidembed'),
			// 		url 	= $('#vidrefer');

			// 	//获取参数
			// 	var val 	= $(this).val(),
			// 		http 	= val.indexOf('http:'),
			// 		swf 	= val.indexOf('.swf');

			// 	//判断是否有内容
			// 	if( val.replace(/\s/g,'') != '' && http > -1 && swf  >-1 ){
			// 		val = val.substr( http, swf -http +4 );

			// 		//重置参数
			// 		video.val( val );

			// 		//判断地址
			// 		if((( v.indexOf('56.com') >= 0 || v.indexOf('youku.com') >= 0 ) || v.indexOf('tudou.com') >= 0 ) || v.indexOf('yinyuetai.com') >= 0 ){
			// 			var temp = done.clone();
			// 				temp.attr('src', v).parent().show();
			// 			$('.video .result').show().empty().append(temp);
			// 			url.val(v);
			// 		}else{
			// 			src.val('抱歉暂时还不支持此网站的 视频！');
			// 			url.val('');
			// 		}
			// 	}else{
			// 		return false;
			// 	}
			// }


		}
		//==========================
		//缓存命名
		var cookieName = "F_"+ $('#userIs').val() +"_";


		//加载图片上传控件 
		window.onload=function(){
		
			/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
			xiuxiu.embedSWF("altContent",2,"100%","100%");
			
			//修改为您自己的图片上传接口
			xiuxiu.setUploadURL("http://localhost/comm/upfile.php");
			xiuxiu.setUploadType(2);
			xiuxiu.setUploadDataFieldName("upload_file");
		
			xiuxiu.onInit = function(){
				// xiuxiu.loadPhoto("./images/5070bd98fb184bd7bf577a371a801d86.jpeg");
			}	
			xiuxiu.onUploadResponse = function (data){
				console.log(data);
				data = eval('('+ data +')');
				// console.log( data.original_pic );  可以开启调试
				// xiuxiu.loadPhoto( data.original_pic );
				// console.log( $('#imgHeadPhoto').length );

				//给表单赋值
				// $('#imgHeadPhoto').attr('src',data.original_pic ).show();
				// $('#beforeimg').val( data.original_pic );

				// //存入缓存
				// setCookie( cookieName + "addImg" , data.original_pic, 1 );

			}
		}



		//保存视频描述缓存
		$('#j-cue-video').blur(function(){
			setCookie(cookieName + "addVideoDepict" , $(this).html(), 1);
		});

		//保存描述缓存
		$('#j-cue-image').blur(function(){
			if( !$('#reviseCon').length ){	//判断是否有内容 和 是否为修改（修改内容则不做保存）

				//存入缓存
				setCookie( cookieName + "addImgDepict" , $(this).val(), 1 );
			}
		});



		//============================
		//提交数据后删除所有缓存
		if( $('.addContentMsg').length > 0 ){
			delCookie(cookieName + 'addImg');
			delCookie(cookieName + 'addImgDepict');
		}



		//======================
		//查询是否有缓存

		//判断是否有图片
		var F_addImg = checkCookie(cookieName + 'addImg');
		if( F_addImg ){
			$('#imgHeadPhoto').attr('src',F_addImg ).show();
			$('#beforeimg').val( F_addImg );
		}

		//判断是否有图片描述
		var F_addImgDepict = checkCookie(cookieName + 'addImgDepict');
		if( F_addImgDepict ){
			$('#imgDepict').val( F_addImgDepict );
		}

		//判断是否有视频地址
		var F_addVideoSrc = checkCookie(cookieName + 'addVideoSrc');
		if( F_addVideoSrc ){
			$('#j-vidsrc').val(F_addVideoSrc).blur();
		}

		//判断是否有视频描述
		var F_addVideoDepict = checkCookie(cookieName + 'addVideoDepict');
		if( F_addVideoDepict ){
			$('#j-cue-video').html(F_addVideoDepict);
		}

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>