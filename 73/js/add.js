
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

		//类型选择
		function selectType(i){
			$('#classType').val(i);
			$('.main .col').hide().eq(i).show();
			$('#conTypes').val(i);
			$('.nav a').eq(i).addClass('act').siblings().removeClass('act');

			//类型存入缓存
			// setCookie( cookieName + "selectType" , i, 1 );
		}

		$('.nav a').click(function(){ selectType($(this).index()); }).eq(0).click();
     
		/*
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



		var defType = $('#conTypes').val();
		// if( F_selectType ){
		// 	defType = F_selectType;
		// }
		selectType(defType);	//初始化选择

		//打开和关闭标题列表
		$('#orTitle').click(function(){
			$('#titleList').toggle();
		});

		//选择标题
		$('#titleList .tits').click(function(){
			$('#titleList').hide();
			$('#conTitleShow').val($(this).html().replace(/\s/g, '')).show();

			var tid = $(this).attr('tid');
			$('#conTitleId').val(tid);

			//获取和显示此标题的标签
			var labelRange = $('#publish-label-list'),
				labelTemp = $('#publish-label-col-templet'),
				labelObj = null;
			$.titleGetLebel(tid, function(arr){
				$(arr).each(function(key, value){
					labelObj = labelTemp.clone().removeAttr('id').addClass('publish-label-col-temp').removeClass('no');
					labelRange.append(labelObj);
					labelObj.html(value.name);
					labelObj.attr('lid', value.lid);
					labelObj.click(function(){
						var input = $('#titleLabel');
						if($(this).hasClass('act')){
							input.val(0);
							$(this).removeClass('act');
						}else{
							console.log($(this).attr('lid'));
							input.val($(this).attr('lid'));
							$(this).addClass('act').siblings('a').removeClass('act');
						}
					});
				});
			});

					

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

		*/

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

			//检测用户余额是否足够
			if( parseInt($('#userGold').val()) < parseInt($('#totalTote').attr('n')) ){
				$('#tipApply').show();
				return false;	
			}

			//显示提交动画
			$('.j-add-prompt').addClass('j-prompt-submit-ajax').find('*').hide();

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
		// if( $('#success').length > 0 ){
		// 	delCookie(cookieName + 'addImg');
		// 	delCookie(cookieName + 'imgDepict');
		// 	delCookie(cookieName + 'textDepict');
		// 	delCookie(cookieName + 'musicDepict');
		// 	delCookie(cookieName + 'videoDepict');
		// 	delCookie(cookieName + 'selectType');
		// 	delCookie(cookieName + 'musicSrc');
		// 	delCookie(cookieName + 'videoSrc');
		// }



		//======================
		//保存音乐描述缓存
		// $('#musicDepict').blur(function(){
		// 	setCookie(cookieName + "musicDepict" , $(this).val(), 1);
		// });

		//保存视频描述缓存
		// $('#videoDepict').blur(function(){
		// 	setCookie(cookieName + "videoDepict" , $(this).val(), 1);
		// });

		//保存图片描述缓存
		// $('#imgDepict').blur(function(){
		// 	setCookie( cookieName + "imgDepict" , $(this).val(), 1 );
		// });

		//保存文本
		// $('#textDepict').blur(function(){
		// 	setCookie( cookieName + "textDepict" , $(this).val(), 1 );
		// });

	// 初始化图片插件
	$('#xiuxiuEditor').append('<param name="wmode" value="transparent" />');


	// 发布
	$('#submitApply').click(function(){

		var param = {},
			tags = [];

		param['type'] = $('.extent a[class=act]').index();

		if ( param.type == '0' ) {
			param['text'] = $('#textDepict').val();
			param['input'] = '';
		} else if ( param.type == '1' ) {
			param['text'] = $('#imgDepict').val();
			param['input'] = '';
		} else if ( param.type == '2' ) {
			param['text'] = $('#videoDepict').val();
			param['input'] = $('#j-vidsrc').val();
		} else if ( param.type == '3' ) {
			param['text'] = $('#musicDepict').val();
			param['input'] = $('#j-mussrc').val();
		}

		// 获取所有便签
		$('.cue-label-name').each(function( i, el ){
			if ( $(el).html() != '' ) {
				tags.push($(el).html());
			}
		});

		param['tags'] = tags;

		$('#publishLoading').slideDown();

		na.content._add( param, function(result){
			$('#publishResult').show().find('p').html(result.message);

			if ( result.status == 0 ) {
				setTimeout(function(){
					$('#publishLoading').slideUp();
				}, 1000);
			}
			console.log(result);
		});
	});



	//标签管理 *********************************************

	//展开添加标签面板
	$('.j-manage-add-label').click(function(){
		var label = $(this).parent(),
			input = label.find('.label-add-input');

		var col = label.parents('.col'),
			cue = label.parents('.cue-label');

		//判断添加数量是否上限
		if(cue.find('.cue-label-col').length-1 >= 5){
			alert('此标题的标签达到上限（5个）。');
			return;
		}

		//判断是否展开
		if(label.hasClass('j-add-label')){
			var name = input.val();

			//判断命名是否规范
			if(name.replace(/\s/g, '').length <= 0){
				return;
			}

			// 判断是否和其他重命名
			if ( isNameRepeat(name) ) {
				alert('命名重复');
				return;
			}

			//重置添加面板
			input.val('');

			//添加页面元素
			var fresh = cue.find('.j-label-templet').clone(true);
			fresh.removeClass('no j-label-templet');
			fresh.find('.cue-label-name').html(name);
			fresh.find('.label-rename-input').val(name);
			manageLabel(fresh);
			cue.find('.cue-label-add').before(fresh);

		}else{
			label.addClass('j-add-label');
			label.find('.label-add-no').show();
			label.find('.label-add-yes').css({ borderRadius: 0 });
			input.width(0).show().stop().animate({ width: 120, paddingLeft: 12, paddingRight: 12 },function(){
				$(this).attr('placeholder', '标签名');
			});
		}
	});

	// 判断是否有重复名称
	function isNameRepeat(name){
		var is = false;
		$('.cue-label-name').each(function( i, el ){
			if ( $(el).html() == name ) {
				is = true;
				return false;
			}
		});
		return is;
	}

	//取消添加
	$('.j-manage-add-label-cancel').click(function(){
		var label = $(this).parent();
			label.removeClass('j-add-label');
			label.find('.label-add-yes').animate({ borderRadius: 3 });
			label.find('.label-add-input').removeAttr('placeholder').stop().animate({ width: 0, padding: 0 });
			label.find('.label-add-no').hide();
	});

	// 标签修改名称 - 显示面板
	function renameLabel(col){
		var label = col.parent();
		label.find('.label-normal').show();
		label.find('.label-rename').hide();
		col.find('.label-normal').hide();
		col.find('.label-rename').show();
	}

	// 标签确认重命名
	function renameLabelYes(col){
		col.find('.label-normal').hide();
		col.find('.label-rename').show();

		var name = col.find('.label-rename-input').val();

		//判断命名是否规范
		if(name.replace(/[]/g, '').length <= 0 && name == col.find('.cue-label-name').html()){
			return;
		}

		// 判断是否和其他重命名
		if ( isNameRepeat(name) ) {
			alert('命名重复');
			return;
		}

		col.find('.label-normal').show();
		col.find('.label-rename').hide();
		col.find('.cue-label-name').html(col.find('.label-rename-input').val());	//修改页面参数
	}

	//标签取消重命名
	function renameLabelNo(col){
		col.find('.label-normal').show();
		col.find('.label-rename').hide();
	}

	//标签删除
	function closeLabel(col){
		col.animate({ width: 0, marginRight: 0 }, 500, function(){
			col.remove();
		});
	}

	//挂接每个标签管理的事件
	function manageLabel(col){
		col.find('.cue-label-rename').click(function(){	renameLabel(col); });		//修改标签名称		
		col.find('.label-rename-yes').click(function(){ renameLabelYes(col); });	//确认重命名
		col.find('.label-rename-no').click(function(){ renameLabelNo(col); });	//取消重命名
		col.find('.cue-label-close').click(function(){ closeLabel(col); });	//删除标签
	}
	// $('.cue-label-col').each(function(){
		// manageLabel($(this));
	// });
