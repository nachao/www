<?php
	
	//引用公共文件
	include("./comm/base.php");	
	
	//设置选择菜单
	Global $ect;
	$ect="user";	

	//引用样式头部
	include("./comm/head.php");

	//没有登录则跳转至列表页
	if(!$u -> Guid()){
		$u -> UtoL();
	}

	//是否提交表单
	if(isset($_POST['submit'])){
		$c -> Acon( $_POST['types'], $_POST['titleid'], $_POST['depict'], $_POST['beforeimg'], $_POST['imgDepict'], $_POST['music'], $_POST['musicDepict'], $_POST['video'], $_POST['videoDepict'], $_POST['recommend-sum'] );
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
		// $Dinfo = $t -> Ginfo($Itid);
		// $Dtype = $Dinfo['recommend'];
	}else{
		$Itid = 0;
	}

	// $arr = range(1,10); 
	// print_r(rand(70,120)); 

?>

	<div class="container pagecon">

		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>

				<div class="leftarea f">

					<?php if($addOk){ //判断是否发布成功	?> 
						<div class="Ncon hint-success" id="success">
							<div class="are">
								<h1>发布成功！</h1>
								<div class="cue">每天分享一两篇优质的内容，坐等收账！</div>
								<div class="btn">
									<a class="red" href="./detail.php?cid=<?php echo $addOk; ?>" title="">确认，前往详细页</a>
									<a href="./user.php#<?php echo $addOk; ?>" title="">个人中心</a>
									<a href="./userAdd.php" >继续发布</a>
								</div>
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
											<textarea id="textDepict" class="cue txt conts" name="depict" placeholder="请输入内容" ></textarea>
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
												<input class="txt conts" id="j-vidsrc" type="text"  name="video"  value="" placeholder="请输入视频地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="vidembed" src="" type="application/x-shockwave-flash" width="100%" height="350" allowfullscreen="true" allownetworking="all" allowscriptaccess="always">
												<div class="c"></div>
											</div>
											<div class="are"><textarea id="videoDepict" class="cue" name="videoDepict" placeholder="描述（可以不写）" ></textarea></div>
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
												<input class="txt conts" id="j-mussrc" name="music" type="text"  value="" placeholder="请输入音乐地址，例如：www.ffangle.com/xxx.swf" />
												<div class="c"></div>
											</div>
											<div class="result">
												<embed id="musembed" src="" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent">
												<div class="c"></div>
											</div>
											<div class="are"><textarea id="musicDepict" class="cue" name="musicDepict" placeholder="描述（可以不写）" ></textarea></div>
										</div>

										<!-- 提交  -->
										<div class="prompt j-add-prompt" style="margin-top: 50px;">
											<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
											<input id="submitApply" class="sub f" type="submit" name="submit" value="发布" />
											<a href="javascript:;" class="recommend" id="btn-recommend">推送【1折】</a>
											<input type="hidden" value="0" name="recommend-sum" id="is-recommend" />
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
											<input type="hidden" id="special" value="3" />			
											<input type="hidden" id="value-recommend" value="10" />
											<input type="hidden" id="basic" value="<?php echo $basic; ?>" />		
											<input type="hidden" id="isvip" value="<?php echo $u -> Ivip(); ?>" />
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
		//缓存命名
		var cookieName = "F_"+ $('#userIs').val() +"_";

		//计算和刷新应支付金额
		function payable(){

			//获取相关参数
			var isTit = $('#conTitleId').val(),			//是有选择标题
				isVip = $('#isvip').val(),				//是否为VIP
				isRecommend = $('#is-recommend').val(),	//是否推送

				PFAnother = parseInt($('#titleList a[tid="'+ isTit +'"]').attr('share')),		//标题代付金额
				standard = parseInt($('#standard').val()),			//标准基础支付金额
				special	= parseInt($('#special').val()),			//会员基础支付金额
				number = parseInt($('#number').val()),				//今日发布的次数
				recommend = parseInt($('#value-recommend').val()),	//推送应支付的金额
				initial = 0;	//计算后的基础金额

			//根据当前条件返回公式基础金
			//判断是否有标题
			if(isTit){
				base = "（标准基础金："+ standard +"分 - 分享金："+ PFAnother +"分）";
				initial = standard - PFAnother;
			}else{

				//判断是否为会员
				if(isVip){
					base = "会员基础金："+ special +"分";
					initial = special;
				}else{
					base = "标准基础金："+ standard +"分";
					initial = standard;
				}
			}
			
			//计算默认应付金额
			initial = initial * number;

			//判断是否推送内容
			if(!!parseInt(isRecommend)){
				initial = initial + recommend;
			}

			//计算公式提示
			$('#basic-cue').show().html("计算公式："+ base +" * 本日次数："+ number +"次");
			$('#basic-tit-cue').hide();

			//刷新应付金额
			var show = $('#totalTote');
				show.attr('n', initial);
				show.val(show.golds().num);
		}


		//=======================
		//推送
		$('#btn-recommend').click(function(){
			if($(this).hasClass('recommend-act')){
				$(this).removeClass('recommend-act');
				$('#is-recommend').val(0);
			}else{
				$(this).addClass('recommend-act');
				$('#is-recommend').val(1);
			}
			payable();
		});


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

			//保存视频地址
			setCookie( cookieName + "videoSrc" , $(this).val(), 1 );
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

			//保存视频地址
			setCookie( cookieName + "musicSrc" , $(this).val(), 1 );
		});


     

		//======================
		//判断是否有图片
		var F_addImg = checkCookie(cookieName + 'addImg');
		if( F_addImg ){
			$('#imgHeadPhoto').attr('src',F_addImg ).show();
			$('#beforeimg').val( F_addImg );
		}

		//判断是否有图片描述
		var F_imgDepict = checkCookie(cookieName + 'imgDepict');
		if( F_imgDepict ){
			$('#imgDepict').val( F_imgDepict );
		}

		//判断是否有文本
		var F_textDepict = checkCookie(cookieName + 'textDepict');
		if( F_textDepict ){
			$('#textDepict').val( F_textDepict );
		}

		//判断是否有音乐描述
		var F_musicDepict = checkCookie(cookieName + 'musicDepict');
		if( F_musicDepict ){
			$('#musicDepict').val( F_musicDepict ).blur();
		}

		//判断是否有音乐地址
		var F_musicDepict = checkCookie(cookieName + 'musicSrc');
		if( F_musicDepict ){
			$('#j-mussrc').val( F_musicDepict ).blur();
		}

		//判断是否有视频描述
		var F_videoDepict = checkCookie(cookieName + 'videoDepict');
		if( F_videoDepict ){
			$('#videoDepict').val( F_videoDepict );
		}

		//判断是否有视频地址
		var F_addVideoSrc = checkCookie(cookieName + 'videoSrc');
		if( F_addVideoSrc ){
			$('#j-vidsrc').val(F_addVideoSrc).blur();
		}

		//判断是否有记录选择类型
		var F_selectType = checkCookie(cookieName + 'selectType');



		//类型选择
		function selectType(i){
			$('#classType').val(i);
			$('.main .col').hide().eq(i).show();
			$('#conTypes').val(i);
			$('.nav a').eq(i).addClass('act').siblings().removeClass('act');

			//类型存入缓存
			setCookie( cookieName + "selectType" , i, 1 );
		}
		$('.nav a').click(function(){ selectType($(this).index()); });
		var defType = $('#conTypes').val();
		if( F_selectType ){
			defType = F_selectType;
		}
		selectType(defType);	//初始化选择

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
			$('#conTitleId').val('');

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

			//显示提交动画
			$('.j-add-prompt').addClass('j-prompt-submit-ajax').find('*').hide();

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

			//检测用户余额是否足够
			if( parseInt($('#userGold').val()) < parseInt($('#totalTote').attr('n')) ){
				$('#tipApply').show();
				return false;	
			}

		}
		

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
		if( $('#success').length > 0 ){
			delCookie(cookieName + 'addImg');
			delCookie(cookieName + 'imgDepict');
			delCookie(cookieName + 'textDepict');
			delCookie(cookieName + 'musicDepict');
			delCookie(cookieName + 'videoDepict');
			delCookie(cookieName + 'selectType');
			delCookie(cookieName + 'musicSrc');
			delCookie(cookieName + 'videoSrc');
		}



		//======================
		//保存音乐描述缓存
		$('#musicDepict').blur(function(){
			setCookie(cookieName + "musicDepict" , $(this).val(), 1);
		});

		//保存视频描述缓存
		$('#videoDepict').blur(function(){
			setCookie(cookieName + "videoDepict" , $(this).val(), 1);
		});

		//保存图片描述缓存
		$('#imgDepict').blur(function(){
			setCookie( cookieName + "imgDepict" , $(this).val(), 1 );
		});

		//保存文本
		$('#textDepict').blur(function(){
			setCookie( cookieName + "textDepict" , $(this).val(), 1 );
		});




	</script>

<?php include("./comm/footer.php");	//引用底部 	?>