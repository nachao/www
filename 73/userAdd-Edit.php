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

		if($type == 0){
			$depict = $_POST['depict'];		//文本类型，修改文本
		}
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
				$c -> Umusic($cid, $_POST['musicAddress']);		//修改音乐地址
			}	
		}
		if($depict != $info['content']){
			$c -> Utxt($cid, $o -> Chtml($depict));		//修改描述
		}

		$c -> URtime($cid); //刷新修改时间

		$u -> UtoL('userAdd-Edit.php?ok='.$cid);
	}

	//是否提交成功
	if(isset($_GET['ok'])){
		$reviseOk = $_GET['ok'];
	}

	//是否修改指定内容
	$Rcid = 0;
	if(isset($_GET['cid'])){
		if($u -> Guid() == $c -> Gauthor($_GET['cid'])){
			$Rcid = $_GET['cid'];
			$Rinfo = $c -> Ginfo($Rcid);
		}
	}


?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar">
					<a href="javascript:;" name="revise" class="actionbar-sign" ></a>
				</div>

				<div class="leftarea f">

					<?php if($reviseOk){ //判断是否修改成功	?> 
						<div class="Ncon hint-success">
							<div class="are">
								<h1>修改成功！</h1>
								<div class="cue">每次修改是收费的哦！</div>
								<div class="btn">
									<a class="red" href="./detail.php?cid=<?php echo $reviseOk; ?>" title="">确认，前往详细页</a>
									<a href="./user.php#<?php echo $reviseOk; ?>" title="">个人中心</a>
								</div>
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
											<textarea id="txtApply" class="cue txt conts" name="depict" placeholder="请输入内容" ><?php echo $o -> Ccode($Rinfo['content']); ?></textarea>
											<div class="c"></div>
										</div>
										<!-- 文字 -->

										<!-- 图片 start -->
										<div class="col extent picture">
											<div class="uploadPhoto" id="uploadPhoto">重新选择图片</div>
											<div class="tip">必选要选择一张图片<i></i></div>
											<div class="con">
												<div id="uploadPlugIn" style="height: 600px;display: none;" ><div id="altContent"></div></div>
												<img id="imgHeadPhoto" src="<?php echo $Rinfo['image']; ?>" />
												<div class="c"></div>
											</div>
											<div class="c"></div>
											<div class="are"><textarea id="imgDepict" class="cue" name="imgDepict" placeholder="描述（可以不写）" ><?php echo $o -> Ccode($Rinfo['content']); ?></textarea></div>
											<input class="conts" type="hidden" value="<?php echo $Rinfo['image']; ?>" name="beforeimg" id="beforeimg" />
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
												<input class="txt conts" id="j-vidsrc" type="text"  name="videoAddress"  value="" placeholder="请输入视频地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result" style="display: block;">
												<embed id="vidembed" src="<?php echo $Rinfo['video']; ?>" type="application/x-shockwave-flash" width="100%" height="350" allowfullscreen="true" allownetworking="all" allowscriptaccess="always">
												<div class="c"></div>
											</div>
											<div class="are"><textarea id="imgDepict" class="cue" name="videoDepict" placeholder="描述（可以不写）" ><?php echo $o -> Ccode($Rinfo['content']); ?></textarea></div>
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
												<input class="txt conts" id="j-mussrc" name="musicAddress" type="text"  value="<?php echo $Rinfo['music']; ?>" placeholder="请输入音乐地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result" style="display: block;">
												<embed id="musembed" src="<?php echo $Rinfo['music']; ?>" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent">
												<div class="c"></div>
											</div>
											<div class="are"><textarea id="imgDepict" class="cue" name="musicDepict" placeholder="描述（可以不写）" ><?php echo $o -> Ccode($Rinfo['content']); ?></textarea></div>
										</div>

										<!-- 提交  -->
										<div class="prompt" style="margin-top: 50px;">
											<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<input id="submitApply" class="sub f" type="submit" name="submit" value="确认修改" />	
											<a href="javascript:history.go(-1);" class="cancel" >取消修改</a>	
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


		//==========================
		//初始化事件

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

		//添加音乐
		$('#j-mussrc').blur(function(){
			var input = $(this);
				value = $(0).isMusicAddress(input),
				embed = $('#musembed');
			if(value){
				embed.attr('src', value).parent().show();
				input.removeClass('textyes');
			}else{
				embed.removeAttr('src').parent().hide();
				input.addClass('textyes');
			}
		});

		//类型选择
		function selectType(i){
			$('#classType').val(i);
			$('.main .col').hide().eq(i).show();
			$('#conTypes').val(i);
			$('.nav a').eq(i).addClass('act').siblings().removeClass('act');
		}
		selectType($('#conTypes').val());	//初始化选择


		//关闭和显示上传图片插件
		$('#uploadPhoto').click(function(){
			$('#uploadPlugIn').toggle();
		});


		//表单检测
		function check( obj ){

			//获取参数
			var type = $("input[name='types']").val();

			//获取指定的提示元素
			var col = $(".publish .col").eq(type),
				tip = col.find(".tip"),
				con = col.find('.conts');

			var loop;

			//遍历所有必要内容
			if( con.val() == '' ){
				tip.show();
				clearTimeout(loop);
				loop = setTimeout(function(){ tip.fadeOut(); }, 2000);
				return false;
			}

			console.log($('#j-mussrc').val());

			//检测用户余额是否足够
			if( parseInt($('#userGold').val()) < parseInt($('#totalTote').attr('n')) ){
				$('#tipApply').show();
				return false;	
			}

			// return false;

		}
		

		//加载图片上传控件 
		window.onload=function(){
		
			/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
			xiuxiu.embedSWF("altContent",2,"100%","100%");
			
			//修改为您自己的图片上传接口
			xiuxiu.setUploadURL("http://web.upload.meitu.com/image_upload.php");
			xiuxiu.setUploadType(2);
			xiuxiu.setUploadDataFieldName("upload_file");
			xiuxiu.onUploadResponse = function (data){
				data = eval('('+ data +')');

				//给表单赋值
				$('#imgHeadPhoto').attr('src',data.original_pic ).show();
				$('#beforeimg').val( data.original_pic );
			}
		}



	</script>

<?php include("./comm/footer.php");	//引用底部 	?>