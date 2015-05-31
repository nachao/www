<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//引用样式头部
	include("./comm/head.php");	

	$isAT = false;	

	//判断是否提交成功
	if(isset($_GET['submit'])){
		$isAT = $t -> Atit( $_GET['titles'], $_GET['depict'], $_GET['type'], $_GET['money'], $_GET['bonus'], $_GET['days'] );
	}

	//如果发布成功
	if ( $isAT && $isAT['status'] == 0 ) {
		$u -> UtoL('userTitle-Apply.php?ok='.$isAT['tid']);
	}else{
		$isAT = false;
	}

	//判断是否发布成功
	if(isset($_GET['ok'])){
		$isAT = $_GET['ok'];
	}


?>

	<div class="container pagecon">
	
		<!-- 主体 -->
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>
					
				<div class="leftarea f">
					
					<?php if( $isAT ){	//判断是否提交成功 ?>
						<div class="noContent applyMsg">
							<div class="are">
								<a class="confirm" href="./userTitle.php" title="">确认，并前往管理页面</a>
								<a class="stroll" href="./userTitle-Apply.php" >继续申请</a>
								<a class="stroll" href="./list.php" title="">去逛逛</a>
							</div>
						</div>
					<?php }else{ ?>
						<!-- 填写申请标题表单 -->
						<div class="commarea applyTitle">
							<div class="content">
								<div class="head">
									<div class="tit f"><em>申请标题</em></div>
									<div class="gap"><i></i></div>
								</div>
								<form id="formlist" class="formlist" method="get" action="" >
									<input id="typesVal" type="hidden" name="type" value="0" />
									<input id="daysVal" type="hidden" name="days" value="0" />	
									<input id="moneyVal" type="hidden" name="money" value="0" />	
									<input id="numsVal" type="hidden" name="bonus" value="0" />
									<input id="submit" type="submit" value="submit" name="submit" class="no" />
									<div class="row">
										<div class="radio" id="parameter-type">
											<span class="names s1">选择类型</span>
											<label class="act"><input type="radio" value="1" checked />活动</label>
											<label><input type="radio" value="2" />专题</label>
											<label><input type="radio" value="3" />任务</label>
											<label><input type="radio" value="4" />小组</label>
										</div>
									</div>
									<!-- 活动参数 -->
									<div id="activity" class="parameter" style="display: inline-block;" >
										<div class="row">
											<div class="radio" id="parameter-time">
												<span class="names s2">有效时间</span>
												<label><input type="radio" value="1" />1天</label>
												<label class="act"><input type="radio" value="7" checked />7天</label>
												<label><input type="radio" value="15" />15天</label>
												<label><input type="radio" value="30" />30天</label>
												<label><input type="radio" value="90" />90天</label>	
											</div>
										</div>
										<div class="row">
											<div class="radio" id="parameter-bonus">
												<span class="names s3">第一名奖金</span>
												<label class="act"><input type="radio" value="1000" checked /><em>1000</em> 分</label>
												<label><input type="radio" value="2000" /><em>2000</em> 分</label>
												<label><input type="radio" value="3000" /><em>3000</em> 分</label>
												<label><input type="radio" value="5000" /><em>5000</em> 分</label>
												<label><input type="radio" value="7000" /><em>7000</em> 分</label>
												<label><input type="radio" value="10000" /><em>10000</em> 分</label>		
											</div>
										</div>
									</div>
									<!-- 专题参数 -->
									<!-- <div id="special" class="parameter" >
										<div class="row">
											<div class="radio">
												<span class="names s3">金池默认金</span>
												<label class="act"><input type="radio" name="nums" value="100" checked /><em>100</em> 分</label>
												<label><input type="radio" name="nums" value="500" /><em>500</em> 分</label>
												<label><input type="radio" name="nums" value="1000" /><em>1000</em> 分</label>
												<label><input type="radio" name="nums" value="2000" /><em>2000</em> 分</label>
												<label><input type="radio" name="nums" value="5000" /><em>5000</em> 分</label>
												<label><input type="radio" name="nums" value="10000" /><em>10000</em> 分</label>		
											</div>
										</div>
									</div> -->
									<!-- 任务参数 -->
									<div id="assignment" class="parameter" >
										<!-- <div class="row">
											<div class="radio">
												<span class="names s3">采纳者奖励</span>
												<label class="act"><input type="radio" name="nums" value="100" checked /><em>100</em> 分</label>
												<label><input type="radio" name="nums" value="500" /><em>500</em> 分</label>
												<label><input type="radio" name="nums" value="1000" /><em>1000</em> 分</label>
												<label><input type="radio" name="nums" value="2000" /><em>2000</em> 分</label>
												<label><input type="radio" name="nums" value="5000" /><em>5000</em> 分</label>
												<label><input type="radio" name="nums" value="10000" /><em>10000</em> 分</label>	
											</div>
										</div> -->
										<!-- <div class="row">
											<div class="radio">
												<span class="names s2">有效时间</span>
												<label class="act"><input type="radio" name="days" value="3" checked />3天</label>
											</div>
										</div> -->
									</div>
									<!-- 小组参数 -->
									<!-- <div id="team" class="parameter" >
										<div class="row">
											<div class="radio">
												<span class="names s2">有效时间</span>
												<label><input type="radio" name="days" value="0" />不限</label>
											</div>
										</div>
									</div> -->
									<div class="link"></div>
									<div class="row">
										<input id="titApply" class="tit" type="text" name="titles" value="" placeholder="标题名（请输入 5至30个字的标题）" />
										<span class="row-cue"></span>
										<a class="tip row-tip r" id="row-tit-tip" href="javascript:;" ><span></span><i></i></a>
									</div>
									<div class="row">
										<textarea id="txtApply" class="txt" name="depict" placeholder="描述（请填写 10 至 500 字的描述）" ></textarea>
										<a class="tip row-tip row-depict-tip r" id="row-depict-tip" href="javascript:;" ><span></span><i></i></a>
									</div>
									<div class="row" style="margin-top: 50px;">
										<a id="tipApply" class="tip row-tip row-sum-tip r" href="javascript:;" title=""><span></span><i></i></a>
										<input id="submitApply" class="sub f" type="button" value="提交申请" />
										<div class="tag r">需付： <input id="totalTote" type="text" value="0.00" readonly /> <i></i></div>
									</div>
								</form>
								<div class="c"></div>
							</div>
							<div class="bottomSide"></div>
						</div>

						<!-- 标题简介 -->
						<div class="commarea applyTitleP">
							<div class="content">
								<div class="head">
									<div class="tit f"><em>说明</em></div>
									<div class="gap"><i></i></div>
								</div>
								<div class="text">
									<p><b>标题的金池</b></p>
									<p>活动：用于分担标题使用者们发布内容的消费，金池多少不会影响标题本身。</p>
									<p>专题：每日系统会金池中扣除维护费，当扣完时则自动关闭标题。</p>
									<p>创建者或者管理员可以在 “我的标题” 里对标题的金池 注入资金。</p><br />

									<p><b>活动标题</b></p>
									<p>1. 标题主可以移除捣乱的内容，会返回少量金币。</p>
									<p>2. 携带标题的内容被买后，“作者” 和 “标题的金池” 会平分收入。</p>
									<p>3. 标题到有效期后，金币池内的所有金币全归标题创建者（管理员）所有。</p>
									<p>4. 标题主可以邀请合伙人（管理员），更好的维护标题。</p><br />

									<p><b>专题标题</b></p>
									<p>1. 此类标题只属于创建者所有，其他用户只能查看内容，不能使用。</p>
									<p>2. 使用时间没有限制。但是作为无限使用的唯一条件就是，它会不停的消耗（金池）。</p><br />

									<p><b>提示</b></p>
									<p>1. 标题被停用的条件。①：创建者关闭；②：活动时间到期；③：专题的金币池扣完；</p>
									<p>2. 每个标题都是唯一的。 更多有趣的地方自己去发现吧。</p>
								</div>
								<div class="c"></div>
							</div>
							<div class="bottomSide"></div>
						</div>
					<?php } ?>
					<div class="c"></div>
				</div>
				<div class="rightarea r"><?php include("./comm/userSide.php");	//导入 用户页 - 右侧信息 	?></div>
				<div class="c"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		//申请页标题提示
		function titleTip(value){
			$('#row-tit-tip').tip(value);
		}

		//申请页描述提示
		function depictTip(value){
			$('#row-depict-tip').tip(value);
		}

		//申请页金额提示
		function sumTip(value){
			$('#tipApply').tip(value);
		}

		//输出应付金额
		function amount(sum){
			var bonus = parseInt($('#numsVal').val()),	//奖金
				days = parseInt($('#moneyVal').val());	//金池
			sum = sum ? sum : bonus + days;
			$('#totalTote').val(sum).attr('n', sum);
			$('#totalTote').golds();
		}

		//选择有效时间
		$("#parameter-time input").click(function(){
			switch(parseInt($(this).val())){	//判断
				case 7 	: num = 500 ; break;
				case 15 : num = 1000 ; break;
				case 30 : num = 2000 ; break;
				case 90 : num = 5000; break;
				default	: num = 0 	; break;
			}
			$('#daysVal').val($(this).val());
			$('#moneyVal').val(num);
			amount();	//合计
		});

		//选择奖金
		$("#parameter-bonus input").click(function(){
			$('#numsVal').val($(this).val());
			amount();	//合计
		});

		//选择类型
		$("#parameter-type input").click(function(){
			var type = parseInt($(this).val());
			$('#typesVal').val($(this).val());

			//隐藏参数选择
			$('.parameter').hide().find('.radio').each(function(){
				$(this).find('input:first').click();
			});

			//选择活动
			if ( type == 1 ) {
				$('#activity').show().find('input[name="days"]:eq(1)').click();
				amount();	//合计
			}
			
			//选择专题
			if ( type == 2 ) {
				$('#special').show();
				$('#numsVal').val(0);	//奖金
				$('#moneyVal').val(300);	//金池
				amount(300);	//合计
			}
			
			//选择任务
			if ( type == 3 ) {
				$('#assignment').show();
				$('#numsVal').val(100);	//奖金
				$('#moneyVal').val(0);	//金池
				amount(100);	//合计
			}
			
			//选择小组
			if ( type == 4 ) {
				$('#team').show();
				$('#numsVal').val(0);	//奖金
				$('#moneyVal').val(3000);	//金池
				amount(3000);	//合计
			}
		});

		//初始化显示
		$("#parameter-type input:eq(0)").click();
		$("#parameter-time input:eq(1)").click();
		$("#parameter-bonus input:eq(0)").click();


		//点击申请按钮
		function detection(sub){

			//获取元素
			var title = $('#titApply'),
				depict = $('#txtApply');

			//获取参数
			var titleLength = title.val().replace(/\s/g,'').length,
				depictLength = depict.val().replace(/\s/g,'').length;

			//默认隐藏所有提示标签
			titleTip();
			depictTip();
			sumTip();

			//检查是否有输入标题
			if ( titleLength < 5 ) { 
				titleTip('请输入 5至30个字的标题。');
				title.focus();
			}else{

				//检查标题是否可用
				doTitle(function(is){
					if ( is ) {
						titleTip('此标题已被使用！');
						title.focus();
					}else{

						//检测是否有输入描述
						if( depictLength < 10 || depictLength > 500 ){
							depictTip('请填写 10 至 500 字的描述。');
							depict.focus();
						}else{

							//检测余额是否足够
							if ( $.Usum() <= parseInt($('#totalTote').attr('n')) ){
								sumTip('您的金额不足。');
							}else{

								//提交表单
								$('#submit').click();
							}
						}
					}
				});
			}
			return false;
		}



		//判断标题是否可用
		var titAppl = '';
		function doTitle(funs){
			var val = $('#titApply').val().replace(/\s/g,'');

			//判断标题是否为空
			if( val == '' ){
				titleTip('请填写标题名！');
				funs ? funs(false) : null;
				return;
			}

			//判断文本框是否有修改
			if( titAppl == val ){
				funs ? funs(false) : null;
				return;
			}

			//判断标题名称长度
			if( val.length < 5 ){
				titleTip('标题名最少五个字！');
				funs ? funs(false) : null;
				return;
			}
			if( val.length > 30 ){
				titleTip('标题名最多三十个字！');
				funs ? funs(false) : null;
				return;
			}

			//提交数据
			$.g({
				name: 'do_title',
				data: { 
					'name': val 
				},
				result: function(msg){
					funs ? funs(msg) : null;
				}
			});
		}
			


		//点击提交申请
		$('#submitApply').click(function(){
			detection();
		});

	</script>

<?php include("./comm/footer.php");	//引用底部 	?>
