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

	//是否提交表单
	if(isset($_POST['submit'])){
		$c -> Acon( $_POST['types'], $_POST['titleid'], $_POST['depict'], $_POST['beforeimg'], $_POST['imgDepict'], $_POST['music'], $_POST['musicDepict'], $_POST['video'], $_POST['videoDepict'] );
	}

	$addOk = 0;

	//是否提交成功
	if(isset($_GET['ok'])){
		$addOk = $_GET['ok'];
	}

	//默认显示分类
	$Dtype = 1;

	//是否有指定的标题
	if(isset($_GET['tid'])){
		$Itid = $_GET['tid'];
		$Dinfo = $t -> Ginfo($Itid);
		$Dtype = $Dinfo['recommend'];
	}else{
		$Itid = 0;
	}

?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f">

					<?php if($addOk){ //判断是否发布成功	?> 
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
									<div class="tit f"><em>发布 新的内容</em></div>
									<div class="gap"><i></i></div>
								</div>

								<!-- 发布信息 开始 -->
								<form class="publish" enctype="multipart/form-data" action="" method="post" name="upform" onsubmit="return check(this);">
									<div class="nav extent">
										<a href="javascript:;">文字</a>
										<a href="javascript:;"  class="act">图片</a>
										<a href="javascript:;">视频</a>
										<a href="javascript:;">音乐</a>
									</div>
									<input id="conTypes" type="hidden" name="types" value="<?php echo $Dtype; ?>" />
									<div class="main">
										<div class="title">
											<input id="conTitleShow" class="tit f" type="text" value="" readonly="readonly" />
											<input id="conTitleId" type="hidden" name="titleid" />
											<a id="orTitle" class="btn r" href="javascript:;" >加入标题</a>
											<a id="delTitle" class="btn no r" style="margin-right: 15px;" href="javascript:;" title="">去除标题</a>
											<div id="titleList" class="tags f" tid="<?php echo $Itid; ?>" >

												<?php foreach ($t-> GUFAlist() as $key => $Tv){	//输出用户 所有可用的标题（活动标题和个人专题） ?>
													<a class="tits" href="javascript:;" tid="<?php echo $Tv['tid']; ?>" share="<?php echo $Tv['shareglod']; ?>" ><?php echo $Tv['title']; ?></a>
												<?php } ?>

												<?php if(!$t -> IATfollow()){	 //判断用户是否还没有关注 活动标题，以及 个人专题 ?>
													<div id="titleCue" class="tagsCue f">
														<span>你还没有关注任何 活动，也还没有属于个人的 专题！</span>&nbsp;&nbsp;&nbsp;
														<a href="./title.php" title="">去看看</a>&nbsp;&nbsp;&nbsp;
														<a href="./userTitle-Apply.php" title="">去申请</a>
													</div>
												<?php } ?>

											</div>
											<div class="c"></div>
										</div>

										<!-- 文字 -->
										<div class="col extent writing">
											<div class="tip">请填写内容<i></i></div>
											<textarea id="txtApply" class="cue txt conts" name="depict" placeholder="请输入内容" ></textarea>
											<div class="c"></div>
										</div>
										<!-- 文字 -->

										<!-- 图片 start -->
										<div class="col extent picture">
											<div class="tip">必选要选择一张图片<i></i></div>
											<div class="con">
												<div id="uploadPlugIn" style="height: 600px;" >
													<div id="altContent"></div>
												</div>
												<img id="imgHeadPhoto" src="" style="display: none;" />
												<div class="c"></div>
											</div>
											<div class="c"></div>
											<div class="are"><textarea id="imgDepict" class="cue" name="imgDepict" placeholder="描述（可以不写）" ></textarea></div>

											<input class="conts" type="hidden" value="" name="beforeimg" id="beforeimg" />
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
												<input class="txt conts" id="j-vidsrc" type="text"  name="video"  value="" placeholder="请输入视频地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="vidembed" src="" type="application/x-shockwave-flash" width="100%" height="350" allowfullscreen="true" allownetworking="all" allowscriptaccess="always">
												<div class="c"></div>
											</div>
											<textarea class="no j-text" name="videoDepict"></textarea>
											<div class="cue j-describe" id="j-cue-video" contentEditable="true" placeholder="描述（可以不写）" title="描述（可以不写）" ></div>
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
												<input class="txt conts" id="mussrc" name="music" type="text"  value="" placeholder="请输入音乐地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="musembed" src="" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent">
												<div class="c"></div>
											</div>
											<div class="are"><textarea id="txtApply" class="cue" name="musicDepict" placeholder="描述（可以不写）" ></textarea></div>
										</div>

										<!-- 提交  -->
										<div class="prompt" style="margin-top: 50px;">
											<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<input id="submitApply" class="sub f" type="submit" name="submit" value="发布" />				
											<?php 
												$number = $u -> GTPnum()+1;			//本日发布次数
												$basic = $u -> Ivip() ? 3 : 7;		//基础值
												$deduct = $basic * $number;			//发布消费金额
											  ?>
											<div class="tag r">需付： 
												<input id="totalTote" type="text" class="golds" n="<?php echo $deduct; ?>" value="" readonly />
												元<em><i>！</i>你的金币不足</em>
											</div>
											<input type="hidden" id="deductApply" name="deductApply" value="<?php echo $deduct; ?>" />
											<div class="c"></div>
											
											<!-- 应该金额计算公式 -->
											<div class="formula">

												<?php if($u -> Ivip()){ ?>
													<div class="formula-txt r" id="basic-cue" style="display: block;" >计算公式：会员基础金：3分  * 本日次数：<?php echo $number; ?>次</div>
												<?php }else{ ?>
													<div class="formula-txt r" id="basic-cue" style="display: block;">计算公式：基础金：7分  * 本日次数：<?php echo $number; ?>	次</div>
												<?php } ?>

												<div class="formula-txt r" id="basic-tit-cue" >计算公式：（标准金：7分 - 分享金：6分） * 本日次数：<?php echo $number; ?>次</div>
											</div>

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
     

		//类型选择
		function selectType(i){
			$('#classType').val(i);
			$('.main .col').hide().eq(i).show();
			$('#conTypes').val(i);
			$('.nav a').eq(i).addClass('act').siblings().removeClass('act');
		}
		$('.nav a').click(function(){ selectType($(this).index()); });
		selectType($('#conTypes').val());	//初始化选择
     	
     	

		//清空描述样式
		$('.video .cue').blur(function(){
			$(this).find('*').removeAttr('style');
		});


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

		//打开和关闭标题列表
		$('#orTitle').click(function(){
			$('#titleList').toggle();
		});

		//选择标题
		$('#titleList .tits').click(function(){
			$('#titleList').hide();
			$('#conTitleShow').val($(this).html().replace(/\s/g, '')).show();
			$('#conTitleId').val($(this).attr('tid'));

			//刷新按钮显示
			$('#delTitle').removeClass('no');


			//获取金额参数
			var sharegold = parseInt($(this).attr('share')),
				standard = parseInt($('#standard').val()),
				initial = standard - sharegold,
				number = parseInt($('#number').val());

			//刷新公式
			$('#basic-cue').hide();
			$('#basic-tit-cue').show().html("计算公式：（标准金：7分 - 分享金："+ sharegold +"分） * 本日次数："+ number +"次");

			// var num = parseInt($('#totalTote').attr('n')) -parseInt($(this).attr('share'));
			// 	num = num < 0 ? 0 : num;

			//刷新应付金额
			var show = $('#totalTote');
			show.attr('n', initial * number);
			show.val(show.golds().num);
		});

		//删除标题
		$('#delTitle').click(function(){
			$('#conTitleShow').val('').hide();
			$('#conTitleVal').val('');

			//刷新按钮显示
			$('#delTitle').addClass('no');
			// $('#orTitle').removeClass('no');

			//刷新公式
			$('#basic-tit-cue').hide();
			$('#basic-cue').show();

			//获取金额参数
			var standard = parseInt($('#basic').val()),
				number = parseInt($('#number').val());

			//刷新应付金额
			var show = $('#totalTote');
			show.attr('n', standard * number);
			show.val(show.golds().num);
		});

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
			$('.j-text').val($('.j-describe').val());

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

		}

		//==========================
		//缓存命名
		var cookieName = "F_"+ $('#userIs').val() +"_";
		

		//加载图片上传控件 
		window.onload=function(){
		
			//第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高
			xiuxiu.embedSWF("altContent",2,"100%","100%");
			
			//修改为您自己的图片上传接口
			xiuxiu.setUploadURL("http://web.upload.meitu.com/image_upload.php");
			xiuxiu.setUploadType(2);
			xiuxiu.setUploadDataFieldName("upload_file");
			xiuxiu.onUploadResponse = function (data){
				data = eval('('+ data +')');

				// console.log( data.original_pic );  可以开启调试
				// xiuxiu.loadPhoto( data.original_pic );
				// console.log( $('#imgHeadPhoto').length );

				//给表单赋值
				$('#imgHeadPhoto').attr('src',data.original_pic ).show();
				$('#beforeimg').val( data.original_pic );

				//存入缓存
				setCookie( cookieName + "addImg" , data.original_pic, 1 );
			}
			xiuxiu.onClose = function(id){
				$('#imgHeadPhoto').removeAttr('src');
			}
		}

		



		//============================
		//提交数据后删除所有缓存
		if( $('.addContentMsg').length > 0 ){
			delCookie(cookieName + 'addImg');
			delCookie(cookieName + 'addImgDepict');
		}



		//======================
		//保存视频描述缓存
		$('#j-cue-video').blur(function(){
			setCookie(cookieName + "addVideoDepict" , $(this).html(), 1);
		});

		//保存图片描述缓存
		$('#imgDepict').blur(function(){
			setCookie( cookieName + "addImgDepict" , $(this).val(), 1 );
		});



		//======================
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