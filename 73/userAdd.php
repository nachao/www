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

		//判断类型
		switch ($_POST['types']) {					//判断类型，并刷新描述内容
			case 0: $text = $_POST['depict'];		$control = '';					break;	//文字
			case 1: $text = $_POST['imgDepict']; 	$control = $_POST['beforeimg']; break;	//图片
			case 2: $text = $_POST['videoDepict']; 	$control = $_POST['video']; 	break;	//视频
			case 3: $text = $_POST['musicDepict']; 	$control = $_POST['music']; 	break;	//音乐
		}

		//提交数据
		$c -> Acon(array(
			'type' => $_POST['types'],			//类型
			'tid'  => $_POST['titleid'],		//标题id
			'text' => $text,					//文本描述
			'cont' => $control,					//控件
			'push' => $_POST['recommend-sum'],	//是否推送(1|0)
			'label'=> $_POST['titleLabel'],		//标签id
		));
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

					<!-- 发布成功 -->
					<div class="Ncon hint-success no" id="success">
						<div class="are">
							<h1>发布成功！</h1>
							<div class="cue">每天分享一两篇优质的内容，坐等收账！</div>
							<div class="btn">
								<a class="red" href="./detail.php?cid=0" title="">确认，前往详细页</a>
								<a href="./user.php#0" title="">个人中心</a>
								<a href="./userAdd.php" >继续发布</a>
							</div>
						</div>
					</div>

					<!-- 主界面 -->
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
								<input id="conTypes" type="hidden" name="types" value="0" />
								<div class="main">
									<div class="title no">
										<input id="conTitleShow" class="tit f" type="text" value="" readonly="readonly" />
										<input id="conTitleId" type="hidden" name="titleid" />
										<a id="orTitle" class="btn r" href="javascript:;" >加入标题</a>
										<a id="delTitle" class="btn no r" style="margin-right: 15px;" href="javascript:;" title="">去除标题</a>

										<!-- 输出用户 所有可用的标题（活动标题和个人专题） -->
										<div id="titleList" class="tags f" tid="0" >
											<a class="tits" href="javascript:;" tid="0" share="0" >-</a>

											<!--//判断用户是否还没有关注 活动标题，以及 个人专题 -->
											<div id="titleCue" class="tagsCue f">
												<span>你还没有关注任何 活动，也还没有属于个人的 专题！</span>&nbsp;&nbsp;&nbsp;
												<a href="./title.php" title="">去看看</a>&nbsp;&nbsp;&nbsp;
												<a href="./userTitle-Apply.php" title="">去申请</a>
											</div>

										</div>
										<div class="c"></div>
									</div>
									<div class="c"></div>

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
											//$number = $u -> GTPnum()+1;			//本日发布次数
											//$basic = $u -> Ivip() ? 3 : 7;		//基础值
											//$deduct = $basic * $number;			//发布消费金额
										  ?>
										<div class="tag r">需付： 
											<input id="totalTote" type="text" class="golds" n="" value="" readonly />
											元<em><i>！</i>你的金币不足</em>
										</div>
										<input type="hidden" id="deductApply" name="deductApply" value="" />
										<div class="c"></div>
										
										<!-- 应该金额计算公式 -->
										<div class="formula">
											<div class="formula-txt no r" id="basic-cue" >计算公式：会员基础金：3分  * 本日次数：0次</div>
											<div class="formula-txt r" id="basic-cue" style="display: block;">计算公式：基础消费：7分  * 本日次数：0	次</div>
											<div class="formula-txt no r" id="basic-tit-cue" >计算公式：（标准金：7分 - 分享金：6分） * 本日次数：0次</div>
										</div>

										<!-- 只用于前端 显示计算 -->
										<input type="hidden" id="number" value="0" />	
										<input type="hidden" id="standard" value="7" />			
										<input type="hidden" id="special" value="3" />			
										<input type="hidden" id="value-recommend" value="10" />
										<input type="hidden" id="basic" value="0" />		
										<input type="hidden" id="isvip" value="0" />
									</div>

									<!-- 选择标签 -->
									<div class="publish-label-list">
										<div id="publish-label-list">
											<a href="javascript:;" class="publish-label-col no" id="publish-label-col-templet" tid="0" >-</a>
										</div>
										<input type="hidden" name="titleLabel" id="titleLabel" value="0" />
										<div class="c"></div>
									</div>

								</div>
								<div class="c"></div>
						    </form>
							<!-- 发布信息 结束 -->

							<div class="c"></div>
						</div>
						<div class="bottomSide"></div>
					</div>

				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./js/comm.js" ></script>
	<script type="text/javascript" src="./js/xiuxiu.js"></script>
	<script type="text/javascript" src="./js/add.js" ></script>

<?php include("./comm/footer.php");	//引用底部 	?>