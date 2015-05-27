<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//引用样式头部
	include("./comm/head.php");		

	//判断是否提交成功
	if(isset($_GET['submit'])){
		$isAT = $t -> Atit( $_GET['titles'], $_GET['depict'], $_GET['types'], $_GET['money'], $_GET['nums'], $_GET['days'] );
	}else{
		$isAT =false;
	}

	//判断是否发布成功
	if(isset($_GET['ok'])){
		$isAT = $_GET['ok'];
	}
	// echo $isAT;

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
							<form class="formlist" method="get" onsubmit="return detection();" >
								<?php
								//判断是否有参数 并 判断是否有指定标题
								if( isset($_GET['id']) && titleIs($_GET['id']) ){
									$reviseId = $_GET['id'];
								}else{
									$reviseId = 0;
								}
								if( !$reviseId ){ ?>
								<div class="row">
									<div class="radio">
										<span class="names s1">选择类型</span>
										<label class="act"><input type="radio" name="types" value="1" checked />活动</label>
										<label><input type="radio" name="types" value="2" />专题</label>
										<label><input type="radio" name="types" value="3" />任务</label>
										<input id="typesVal" type="hidden" value="0" />		
									</div>
								</div>
								<div id="activity" >
									<div class="row">
										<div class="radio">
											<span class="names s2">有效时间</span>
											<label><input type="radio" name="days" value="1" />1天</label>
											<label class="act"><input type="radio" name="days" value="7" checked />7天</label>
											<label><input type="radio" name="days" value="15" />15天</label>
											<label><input type="radio" name="days" value="30" />30天</label>
											<label><input type="radio" name="days" value="90" />90天</label>
											<input id="daysVal" type="hidden" name="money" value="100" />		
										</div>
									</div>
									<div class="row">
										<div class="radio">
											<span class="names s3">第一名奖金</span>
											<label class="act"><input type="radio" name="nums" value="100" checked /><em>1.00</em> 元</label>
											<label><input type="radio" name="nums" value="1000" /><em>10.00</em> 元</label>
											<label><input type="radio" name="nums" value="3000" /><em>30.00</em> 元</label>
											<label><input type="radio" name="nums" value="5000" /><em>50.00</em> 元</label>
											<label><input type="radio" name="nums" value="10000" /><em>100.00</em> 元</label>
											<label><input type="radio" name="nums" value="30000" /><em>300.00</em> 元</label>
											<input id="numsVal" type="hidden" value="100" />		
										</div>
									</div>
								</div>
								<div class="link"></div>
								<?php } ?>
								<div class="row">
									<input id="titApply" class="tit" type="text" name="titles" value="" placeholder="标题名（请输入 5至30个字的标题）" />
									<span class="row-cue"></span>
									<a class="tip row-tip r" id="row-tit-tip" href="javascript:;" ><span></span><i></i></a>
								</div>
								<div class="row"><textarea id="txtApply" class="txt" name="depict" placeholder="描述（请填写 10 至 500 字的描述）" ></textarea></div>
								<div class="row" style="margin-top: 50px;">
									<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
									<input id="submitApply" class="sub f" type="submit" name="submit" value="提交申请" />				
									<?php if( !$reviseId ){ ?>
									<div class="tag r">需付： <input id="totalTote" type="text" value="0.00" readonly /> 元<em><i>！</i>你的金币不足</em></div>
									<?php } ?>
								</div>

								<!-- 修改信息 -->
								<?php if( $reviseId ){ 
								$RTrow = idGetTitle( $reviseId );
								$TLid 		= $RTrow['id'];
								$TLtitle	= $RTrow['title'];
								$TLcontent 	= $RTrow['content'];
								$TLtype		= $RTrow['type'];
								$TLdays		= $RTrow['days'];
								$TLreward	= $RTrow['reward'];
								$TLprice	= $RTrow['price']; 	?>
								<div id="reviseInfo" >
									<input type="hidden" id="reviseTypes" name="types" value="<?php echo $TLtype; ?>" />
									<input type="hidden" id="reviseDays" name="days" value="<?php echo $TLdays; ?>" />
									<input type="hidden" id="reviseDays" name="money" value="<?php echo $TLprice; ?>" />
									<input type="hidden" id="reviseNums" name="nums" value="<?php echo $TLreward; ?>" />
									<input type="hidden" id="reviseTitles" value="<?php echo $TLtitle; ?>" />
									<input type="hidden" id="reviseDepict" value="<?php echo $TLcontent; ?>" />
								</div>
								<input type="hidden" name="reviseInfo" value="<?php echo $TLid; ?>" />
								<?php } ?>
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

		//选择有效时间
		$("input[name='days']").click(function(){
			switch(parseInt($(this).val())){	//判断
				case 7 	: num = 100 ; break;
				case 15 : num = 200 ; break;
				case 30 : num = 400 ; break;
				case 90 : num = 1200; break;
				default	: num = 0 	; break;
			}
			$('#daysVal').val(num);		//输出
			amount();	//合计
		});

		//选择奖金
		$("input[name='nums']").click(function(){
			$('#numsVal').val(parseInt($(this).val()));		//输出
			amount();	//合计
		});

		//选择类型
		$("input[name='types']").click(function(){
			var type = parseInt($(this).val());

			//选择活动
			if ( type == 1 ) {
				$('#activity').show();
				amount();	//合计
			}
			
			//选择专题
			if ( type == 2 ) {
				$('#activity').hide();
				amount(100);	//合计
			}
			
			//选择任务
			if ( type == 3 ) {
				$('#activity').hide();
				amount(100);	//合计
			}
		});

		//输出金额
		function amount(n){

			//获取参数
			var types 	= parseInt($('#typesVal').val()),
				nums 	= parseInt($('#numsVal').val()),
				days 	= parseInt($('#daysVal').val());

			//计算
			var val 	= n ? n : types +nums +days,
				num 	= (val /100).toFixed(2);

			//输出
			$('#totalTote').val(num).attr('tote', val);
		}

		//初始化显示
		amount();

		//检测标题
		$('#titApply').keyup(function(){
			var a = $(this),
				b = a.val().length;
			if( b > 5 && b < 30 ){
				a.removeClass('cue_wrong');
			}
		}).blur(function(){
			doTitle();
		});

		//检测描述
		$('#txtApply').keyup(function(){
			var a = $(this),
				b = a.val().length;
			if( b > 10 && b < 500 ){
				a.removeClass('cue_wrong');
			}
		});

		//点击申请按钮
		function detection(){

			//获取元素
			var t = $('#titApply'),
				c = $('#txtApply');

			//获取参数
			var cv = c.val().replace(/\s/g,''),
				cl = cv.length;

			//初始化参数
			var a = true;

			//检测标题
			doTitle(function(is){
				if ( is ) {
					titleTip('可用！');
					console.log(1111);
				}else{
					titleTip('已被使用！');
				}
			});
			// a = titIs;

			//检测描述
			// if( cl < 10 || cl > 500 ){
			// 	c.addClass('cue_wrong').val(cv);
			// 	a = false;
			// }

			// console.log(a);

			//检测余额是否足够
			// if( parseInt($('#userGold').val()) < parseInt($('#totalTote').attr('tote')) ){
			// 	$('#tipApply').show();
			// 	a = false;
			// }

					console.log(222.);
			//返回
			return false; 
		}


		//判断是否为修改
		if( $('#reviseInfo').length > 0 ){
			$("input[name='types']").eq( $('#reviseTypes').val() ).click();
			$("input[name='days'][value='"+ $('#reviseDays').val() +"']").click();
			$("input[name='nums'][value='"+ $('#reviseNums').val() +"']").click();
			$("#titApply").val( $('#reviseTitles').val() );
			$("#txtApply").val( $('#reviseDepict').val() );
		}

		//申请页标题提示
		function titleTip(value){
			var tip = $('#row-tit-tip'),
				cue = tip.find('span').html('');
			if( value ){
				tip.show();
				cue.html(value);
			}else{
				tip.hide();
			}
			
		}

		//判断标题是否可用
		var titAppl = '',
			titIs = false;

		function doTitle(funs){
			var val = $('#titApply').val().replace(/\s/g,'');

			//判断标题是否为空
			if( val == '' ){
				titleTip('请填写标题名！');
				funs(false);
				return;
			}

			//判断文本框是否有修改
			if( titAppl == val ){
				funs(false);
				return;
			}

			//判断标题名称长度
			if( val.length < 5 ){
				titleTip('标题名最少五个字！');
				funs(false);
				return;
			}
			if( val.length > 30 ){
				titleTip('标题名最多三十个字！');
				funs(false);
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
					// console.log(fun);
					// titAppl = val;
					// if(!!parseInt(msg)){
					// 	cue.show().find('span').html('已被使用！');
					// }else{
					// 	titIs = true;
					// 	cue.show().find('span').html('可用！');
					// }
				}
			});
		}



	</script>

<?php include("./comm/footer.php");	//引用底部 	?>
