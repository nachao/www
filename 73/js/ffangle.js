jQuery.fn.extend({

	//排序
	jw13217:function(add){

		//获取元素
		var top = $(this),
			row = top.find(".row"),
			col = top.find(".col:not(.colDes)");

		//控制deleteCon
		var loop;

		//获取框架参数

		function rowHeight(){
			var arr = new Array();
			row.each(function(){
				arr.push($(this).height());
			});
			return arr;
		}

		//获取全部待添加图片数据
		function getImg(){
			return pa.children('.col');
		}

		//添加图片
		function addCon(){
			var temp = row.eq(jisCon()),
				obj = col.first();

			//判断并处理控件
			// var gui = obj.find('.gui');
			// if( gui.hasClass('gui_0') ){		//文字
			// 	gui.remove();
			// }else if( gui.hasClass('gui_1') ){	//图片
			// 	gui.find('embed').remove();
			// }else if( gui.hasClass('gui_2') ){	//视频
			// 	gui.find('.img,.mp3,.sawtooth,.bigimg').remove();
			// }else if( gui.hasClass('gui_3') ){	//音乐
			// 	gui.find('.img,.gif,.sawtooth,.bigimg').remove();
			// }
				
			// temp.height( temp.height() + obj.height() + 50 );
			
			//修改元素位置
			temp.append(obj.addClass('colDes').show());

			//重新获取未处理元素
			col = col.not('.colDes');

			//如果还有未排序的内容，则继续
			if( col.length > 0 ){
				addCon();
			}else{
				// row.each(function(){
				// 	$(this).css({ height: '' });
				// });
			}

			//如果已买则挂接查看事件
			// if( obj.hasClass('col_possess') ){
			// 	confirm(obj);
			// }
		}

		//获取离底部间距最大的一列
		function jisCon(){
			var n = rowHeight(),
				t = n[0],
				v = 0;
			for(var i=0; i<n.length; i++){
				if( n[i] < t ){
					t = n[i];
					v = i;
				}
			}
			return v;
		}

		//初始化列数
		function iniLie(){
			var bodyW = $('.contentList').width() +100,
				rowW = row.width() + 30,
				num = Math.round( bodyW / rowW )-1;
			for(var i=1; i<=num; i++){
				top.prepend( row.eq(0).clone() );
			}
			// top.width( num * rowW );
			row = top.find('.'+ row.attr('class') );
		}

		//初始化区域位置
		function iniSty(){
			// top.css({marginLeft:($('body').width() - top.width()) / 2 });
		}

		//重置
		function resetting(){
			row.each(function(){
				top.append($(this).children());
			});
			console.log( row.length );
			row = row.css({ height:'' }).eq(0);
			row.nextAll('.row').remove();

			col = top.find('.col');
			col.removeClass('colDes').hide();

			runFun();
		}

		//窗口改变大小时调整列数量
		$(window).resize(function(){
			// if( $('body').width() < top.width() || $('body').width() > (top.width() + row.width() +30) ){
			// 	clearTimeout(loop);
			// 	loop = setTimeout(function(){
			// 		resetting();
			// 	}, 1000);
			// }else{
			// 	iniSty();
			// }
		});

		//运行函数
		function runFun(){
			iniLie();
			iniSty();
			addCon();
		}

		//初始化
		add ? addCon() : runFun();

	},

	//购买 *******************************************************
	purchase: function(){
		$(this).click(function(){ 
			var obj = $(this),
				col = obj.parents('.col');
			if( !col.hasClass('col_possess') ){	//如果还没购买

				//获取参数
				var	cid = parseInt(col.attr('cid')),
					now = parseInt(col.find('.golds').attr('n'));

				//控制参数
				var loop;

				//获取当前浏览用户的余额
				var userGold = parseInt($('#userGold').val());

				//余额不足提示
				function tipGif(){
					var tip = col.find('.tip');
					tip.fadeIn();
					clearTimeout(loop);
					loop = setTimeout(function(){
						tip.fadeOut('slow');
					}, 3000);
				}

				//判断当前是否登录，登录状态且持有金币数量足够
				if( userGold > 0 ){
					
					//刷新用户金币数量
					$('#userGold').val(userGold-1);
					$('#headGold').html(userGold-1).golds();

					col.picture();	//查看图片事件
					col.writing();	//查看文本事件
					col.addClass('col_possess');	//确认已购买

					col.find('.confirmBtn').off('click').html('去评论').attr('href', col.find('.look').attr('href'));	//重置购买按钮

					//提交数据
					$.ajax({ type: "POST", url: "./ajax/ajax_user.php", data: "praise=" + cid, success: 
						function(msg){
							// console.log(msg);

							//修改显示数量
							col.find('.golds').attr('n', now+ parseInt(msg)).golds();
						}
					});

				}else{
					tipGif();
				}

				return false;
			}
		});
	},

	//查看图片 	*******************************************************
	picture: function(open){
		$(this).each(function(){

			//获取元素
			var col = $(this),
				obj = col.find('.gui_1'),
				tip = obj.find('.sawtooth'),
				big = obj.find('.bigimg'),
				img = obj.find('img');
		
			//主要的
			function main(){

				//获取参数
				var defH = 200,
					imgH = img.height();

				//清除多余元素
				obj.find('i,em').remove();

				//设置宽度
				if(obj.width() > img.width()){
					obj.width(img.width());
				}

				//判断图片是否需要展开
				if( imgH > defH ){

					//如果需要展开的话，则挂接事件
					img.click(function(){
						if( imgH > parseInt(obj.css('maxHeight')) ){
							obj.hover(function(){
								big.show();
							},function(){
								big.hide();
							});
							$(obj).stop().animate({ maxHeight:imgH },function(){ 
								tip.slideUp(100);
								big.show();
								img.css({ cursor:'default' });
							});
						}else{
							img.css({ cursor:'pointer' });
							tip.show();
							big.hide();
							$(obj).stop().animate({ maxHeight:defH }).off('mouseenter');
						}
					});

					if(open){
						img.click();	//默认打开
					}

				}else{
					tip.remove();
					big.show();
				}

				$('#temp').remove();
				$('body').append("<img src='"+ img.attr('src') +"' id='temp' />");
				big.attr('title', 'Natural: '+ $('#temp').width() +' x '+ $('#temp').height() +' pixels');
				$('#temp').remove();
			}

			if(img.height() > 0){	//判断图片是否已经被加载
				main();
			}else{
				img.load(function(){ main(); });	//图片加载完成后，挂接事件
			}
		});
	},

	//查看文本 	*******************************************************
	writing: function(){
		$(this).each(function(){

			//获取元素
			var	col = $(this),
				skip = col.find('.look'),
				text = col.find('.txt'),
				area = col.find('.are'),
				defH = parseInt(text.css('maxHeight'));

			//文字显示
			var t = {
				def: "展开",
				end: "收起"
			}

			//判断文字区域是否需要展开
			if( area.height() > defH ){

				//如果需要展开的话，则挂接事件
				skip.html(t.def).attr('href', 'javascript:;').click(function(){
					if( defH >= text.height() ){
						skip.html(t.end);
						text.stop().animate({ maxHeight:area.height() });
					}else{
						skip.html(t.def);
						text.stop().animate({ maxHeight:defH });
					}
				});
			}else{
				skip.hide();
			}
		});
	},

	//关注 和 取消关注 标题 	*******************************************************
	attention: function(){
		var loop,
			isLog = !!parseInt($('#userIs').val());
		function link( data, funs, obj ){	//链接后端
			console.log(data);
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: data,
				success: function(msg){ 
					// console.log( msg );
					// obj ? obj.slideUp() : null;
					funs ? funs(msg) : null; 
				}
			});
		}
		$(this).each(function(){
			var col = $(this),
				tid = parseInt(col.attr('tid'));
			function yes(tid, btn, str, funs){
				link( "followTitle="+ tid, funs);
				str = str ? str : '取消关注';
				btn.addClass('buy_follow').html(str);
				col.addClass('col_follow');
			}
			function no(tid, btn, str, funs){
				link( "cancelTitle="+ tid, funs);
				str = str ? str : '关注';
				btn.removeClass('buy_follow').html(str);
				col.removeClass('col_follow');
			}
			col.find('.follow').click(function(){
				var btn = $(this);
				if(isLog){	//判断是否有登录用户

					//如果是管理页面，则可以关注和取消关注
					if(col.hasClass('j_title_message')){
						if(!col.hasClass('col_follow') && !col.hasClass('type_2')){	
							yes(tid, $(this));	//点击关注
						}else{
							no(tid, $(this));	//取消关注
						}

					//标题页面 只能关注
					}else{
						if(!col.hasClass('col_follow')){
							if(!col.hasClass('type_2')){
								yes(tid, $(this), '去发布', function(){
									btn.attr('href', './userAdd.php?tid='+ parseInt(col.attr('tid')));
								});	//关注活动
							}else{
								$(this).hide();
								yes(tid, $(this), '', function(){ btn.remove(); }); 	//关注专题
							}
						}
					}
				}else{	//如果没有登录则提示
					var tip = $(this).prev('.tip').show();
					clearTimeout(loop);
					loop = setTimeout(function(){
						tip.fadeOut();
					}, 1000);
				}
			});
		});
	},

	//设置金币显示方式	*******************************************************
	golds: function(){

		if($(this).length == 1){
			return gg($(this));
		}else{
			$(this).each(function(){ gg($(this)); });
		}

		function gg(obj){
			var	val = $(obj),
				arr = [], 
				str = '', 
				len = 0,
				obj = typeof(val) == 'object' ? val : 0;

			//初始化
			val = val ? val : 0;
			
			//如果给的参数是对象的话
			if( typeof(val) == "object" ){

				//获取元素的参数
				val = !!$(val).attr('n') ? Number($(val).attr('n')) : Number($(val).html());
				val = val ? val : 0;
			
			//否则直接以字符串转换成数字
			}else{
				val = Number(val);
			}

			//如果小于 千位
			if( val < 1000 ){

				val = {
						num: (val/100).toFixed(2),
						unit: ''
					}

			}else{

				//获得数字长度
				len = String(val).length;

				//如果是 万位
				if( len > 10 ){
					val = {
						num: dh((val/10000000000).toFixed(2)),
						unit: '亿'
					}
				}else if( len > 9 ){
					val = {
						num: dh((val/1000000000).toFixed(2)),
						unit: '千万'
					}
				}else if( len > 6 ){
					val = {
						num: dh((val/1000000).toFixed(2)),
						unit: '万'
					}
				}else{
					val = {
						num: dh((val/100).toFixed(2)),
						unit: ''
					}
				}
			}

			//加逗号
			function dh( val ){
				var arr = String(val).split('.'),
					len = arr[0].length-1,
					str = '';

				//遍历
				for( var i=len; i>=0; i-- ){
					if( i!=len && (len-i)%3 == 0 ){
						str = arr[0][i] + ',' + str;
					}else{
						str = arr[0][i] + str;
					}
				}
				return str +'.'+ arr[1];
			}

			//设置
			if( typeof(obj) == 'object' ){
				if( obj.is('input') ){
					obj.val(val.num + (val.unit?val.unit:''));
				}else{
					if(obj.next('i').length){
						obj.html(val.num);
						obj.next('i').html(val.unit+ '元');
					}else{
						obj.html(val.num + (val.unit +'元'));
					}
				}
			}

			//返回数据
			return val;
		}
	},

	//删除指定内容  *******************************************************
	deleteCon: function(){
		$(this).each(function(){	
			$(this).find('.delete').click(function(){ $(this).hide().siblings('.affirm').show(); });
			$(this).find('.notDelete').click(function(){ $(this).parent().hide().siblings('.delete').show(); });
			$(this).find('.ackDelete').click(function(){
				var col = $(this).parents('.col');
				
				//提交数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "delete=" + col.attr('cid'),
					success: function(msg){
						console.log( msg );

						if( !!Number(msg) ){
							//刷新余额显示
							$(this).updateSum(parseInt(msg));
						}

						//隐藏内容
						col.slideUp();
					}
				});
			});
		});
	},

	//加载更多内容 *******************************************************
	loadmore: function(){
		var isGo = 1;
		$(this).click(function(){
			if(isGo){
				isGo = 0;

				//获取参数
				var begin = $('.contentList .colDes:not(.col-user)').length,
					uid = parseInt($(this).attr('uid')),
					tid = parseInt($(this).attr('tid'));

				// console.log("begin=" + begin +"&uid="+ uid +"&tid="+ tid);

				//提交数据
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_list.php",
					data: "begin=" + begin +"&uid="+ uid +"&tid="+ tid,
					success: function(msg){
						// console.log( msg );

						//插入元素
						$('.contentList').append( msg );

						//自动排序
						$('.contentList').jw13217(true);

						//挂接购买按钮
						$('.purchase').purchase();

						//挂接已购买的内容为可查看图片
						$('.col_possess').picture();

						//挂接已购买的内容为可查看文本
						$('.col_possess').writing();

						//金额显示
						$('.colDes .golds').golds();

						//判断是否还能加载
						if( $('.col').length >= parseInt($('.contentList').attr('tote')) ){
							$('#loadmore').hide();
						}

						isGo = 1;
					}
				});
			}
		});
	},

	//关注指定 用户UID *******************************************************
	followUser: function(funs){
		var obj = $(this),
			fid = parseInt($(this).attr('fid'));
		$.ajax({
			type: "POST",
			url: "../ajax/ajax_user.php",
			data: "guanzhu=" + fid,
			success: function(msg){
				// console.log(msg);

				funs ? funs(msg) : null;

				//转为已关注
				obj.html('取消关注').parents('.user-follow').addClass(' user-follow-has');
				obj.off('click').click(function(){ $(this).cancelFollowUser(); });
				obj.prev().find('span').remove();

				//刷新关注内容总数
				// $('#gzTota').attr({'tota' : parseInt(msg) });
			}
		});
	},

	//取消关注指定 用户UID *******************************************************
	cancelFollowUser: function(funs){
		var obj = $(this),
			fid = parseInt($(this).attr('fid'));
		$.ajax({
			type: "POST",
			url: "../ajax/ajax_user.php",
			data: "nogz=" + fid,
			success: function(msg){
				// console.log(msg);

				funs ? funs(msg) : null;

				//转为关注
				obj.html('关注此用户').parents('.user-follow').removeClass(' user-follow-has');
				obj.off('click').click(function(){ $(this).followUser(); });

				// obj.removeClass('act').html('❤关注');

				//刷新关注内容总数
				// $('#gzTota').attr({'tota' : parseInt(msg) });

				//删除取消关注用户的内容
				// if( $('#masterlist').attr('type') == 'love' ){
				// 	$(".master[userid='"+ userid +"']").slideUp(function(){
				// 		obj.remove();
				// 	});
				// }
			}
		});
	},

	//设置指定内容为推荐 *******************************************************
	recommend: function(){
		$(this).each(function(){
			var btn = $(this),
				cid = parseInt($(this).parents('.col').attr('cid'));
			btn.click(function(){
				$.ajax({
					type: "POST",
					url: "../ajax/ajax_user.php",
					data: "recommendSet=" + cid,
					success: function(msg){
						console.log(msg);

						//转为关注
						// obj.html('关注此用户').parents('.user-follow').removeClass(' user-follow-has');
						// obj.off('click').click(function(){ $(this).followUser(); });

						//样式转为推荐
						btn.removeClass('effects-recommend-set').addClass('effects-recommend').html('');
					}
				});
			});
		});
	},

	//删除指定留言 *******************************************************
	deleteMessage: function(){
		$(this).each(function(){

			//删除确认
			$(this).find('.operateDelete').click(function(){
				$(this).hide();
				$(this).siblings('.operateAffirm').show();
			});

			//取消删除
			$(this).find('.affirmCancel').click(function(){
				$(this).parent().hide().prev('.operateDelete').show();
			});

			//确认删除
			$(this).find('.affirmDelete').click(function(){
				var row = $(this).parents('.row');
				$.ajax({
					type: "POST",
					url: "./ajax/ajax_user.php",
					data: "messageDel="+ row.attr('mid'),
					success: function(msg){
						// console.log( msg );
						row.slideUp();

						if( row.hasClass('primary') ){
							row.nextUntil('.primary').slideUp();
						}
					}
				});
			});

		});
	},

	//刷新页面用户金额 *******************************************************
	updateSum: function(val){

		//获取元素
		var sideobj = $('#userInfoGold'),
			headobj = $('#headGold'),
			hidenum = $('#userGold');

		var number = parseInt(hidenum.val()) + val;

		//隐藏值
		hidenum.val(number);

		//头部
		headobj.attr('n', number);
		headobj.golds();

		//侧栏
		sideobj.attr('n', number);
		sideobj.golds();
	},

	//验证账号和密码 *******************************************************
	validate: function(account, pwd, funs){
		var val = {};
		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "entry="+ account +"&password="+ pwd,
			success: function(msg){
				// console.log( msg );
				val.k = msg;
				if( msg == 1 ){
					val.str = "登录成功";
				}else if( msg == 2 ){
					val.str = "密码错误";
				}else{
					val.str = "账号不存在";
				}
				funs ? funs(val) : null;
				return val;
			}
		});
	},

	//检查视频地址是否有效且做相应的地址处理，返回结果 *******************************************************
	isVideoAddress: function(input, funs){
		var value = input.val(),
			reply = false;
		if(value.replace(/\s+/g,"") != ""){
			if(value.indexOf('http://') >= 0){
				value = value.replace(/http:\/\//g, '');
			}

			//是否为播放文件
			if(value.indexOf('.swf') >= 0){
				value = 'http://'+ value;
				input.val(value);
				var v = value;

				//只支持指定网站的视频
				if((( v.indexOf('56.com') >= 0 || v.indexOf('youku.com') >= 0 ) || v.indexOf('tudou.com') >= 0 ) || v.indexOf('yinyuetai.com') >= 0 ){
					reply = value;
				}

				funs ? funs() : null;
			}
		}
		return reply;
	},

	//检查音乐地址是否有效且做相应的地址处理，返回结果 *******************************************************
	isMusicAddress: function(input, funs){
		var value = input.val(),
			reply = false;
		if(value.replace(/\s+/g,"") != ""){
			if(value.indexOf('http://') >= 0){
				value = value.replace(/http:\/\//g, '');
			}

			//是否为播放文件
			if(value.indexOf('.swf') >= 0){
				value = 'http://'+ value;
				input.val(value);
				console.log(input.val());
				var v = value;

				//只支持指定网站的视频
				if( v.indexOf('xiami.com') >= 0 ){
					reply = value;
				}

				funs ? funs() : null;
			}
		}
		return reply;
	}

});

$(document).ready(function(){
	$('.radio').each(function(){
		if(!$(this).hasClass('radio-notauto')){
			$(this).find('label').click(function(){
				$(this).addClass('act').siblings().removeClass('act');
				$(this).nextAll('input').val($(this).find('input').val());
			});
		}
	});
	$('.radio[selection]').each(function(){
		$(this).find('label').eq( parseInt($(this).attr('selection'))-1 ).addClass('act').find('input').attr('checked','checked');
	});
});


//设置金币显示方式
// function goldShow( val ){

// 	var	arr = [], 
// 		str = '', 
// 		len = 0,
// 		obj = typeof(val) == 'object' ? val : 0;

// 	//初始化
// 	val = val ? val : 0;
	
// 	//如果给的参数是对象的话
// 	if( typeof(val) == "object" ){

// 		//获取元素的参数
// 		val = !!$(val).attr('n') ? Number($(val).attr('n')) : Number($(val).html());
// 		val = val ? val : 0;
	
// 	//否则直接以字符串转换成数字
// 	}else{
// 		val = Number(val);
// 	}

// 	//如果小于 千位
// 	if( val < 1000 ){

// 		val = {
// 				num: (val/100).toFixed(2),
// 				unit: ''
// 			}

// 	}else{

// 		//获得数字长度
// 		len = String(val).length;

// 		//如果是 万位
// 		if( len > 10 ){
// 			val = {
// 				num: dh((val/10000000000).toFixed(2)),
// 				unit: '亿'
// 			}
// 		}else if( len > 9 ){
// 			val = {
// 				num: dh((val/1000000000).toFixed(2)),
// 				unit: '千万'
// 			}
// 		}else if( len > 6 ){
// 			val = {
// 				num: dh((val/1000000).toFixed(2)),
// 				unit: '万'
// 			}
// 		}else{
// 			val = {
// 				num: dh((val/100).toFixed(2)),
// 				unit: ''
// 			}
// 		}
// 	}

// 	//加逗号
// 	function dh( val ){
// 		var arr = String(val).split('.'),
// 			len = arr[0].length-1,
// 			str = '';

// 		//遍历
// 		for( var i=len; i>=0; i-- ){
// 			if( i!=len && (len-i)%3 == 0 ){
// 				str = arr[0][i] + ',' + str;
// 			}else{
// 				str = arr[0][i] + str;
// 			}
// 		}
// 		return str +'.'+ arr[1];
// 	}

// 	//设置
// 	if( typeof(obj) == 'object' ){
// 		if( obj.is('input') ){
// 			obj.val(val.num + (val.unit?val.unit:''));
// 		}else{
// 			obj.html(val.num + (val.unit?val.unit:''));
// 		}
// 	}

// 	//返回数据
// 	return val;
// }




//缓存
function getCookie(c_name){
	if( document.cookie.length>0 ){ 
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1){ 
			c_start=c_start + c_name.length+1; 
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) 
				c_end=document.cookie.length
			return unescape(document.cookie.substring(c_start,c_end))
		} 
	}
	return ""
}

function setCookie(c_name,value,expiredays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : "; expires="+exdate.toGMTString());
}


function checkCookie(name){
	username = getCookie(name+'')
	if(username!=null && username!=""){
		return username;
	}else{
		return null;
		// username = prompt('Please enter your name:',"")
		// if (username!=null && username!=""){
		// 	setCookie('username',username,365)
		// }
	}
}

function delCookie(name){
    var exp = new Date(); 
    exp.setTime(exp.getTime() - 1); 
    var cval=getCookie(name); 
    if(cval!=null) 
    	document.cookie= name + "="+cval+";expires="+exp.toGMTString(); 
} 









//分页
// 分页需要
/*====

	参数：
	#	总条数		
	#	每页显示个数
		共显示多少页

	#	需要插入按钮（a标签）的范围对象
		全部生成的按钮（a标签）
		当前激活的按钮

	#	传输文件名 ajax ，参数：page 分页数，userid 用户 id
	#	输出样式的对象方法名称
	#	用户唯一编号 id


	# = 必填参数

	分页封装成对象，方便全站调用

====*/
//====
// 分页主要函数
//====
function pagess(v, defact){
	var area = v.obj,
		tote = v.obj.attr('tote'),
		once = v.obj.attr('once'),
		page = Math.ceil(tote/once),
		funs = v.end,
		act = defact ? defact : 0;

	//生成按钮（a标签）
	for( var i = 0; i < page; i++ ){
		area.append("<a href='javascript:;' value='"+ i +"' >"+ (i+1) +"</a>");
	}
	area.attr('act', act );
	area.find('a').show().eq( act ).addClass('act');

	//给按钮挂机事件，点击过的按钮无法点击
	area.find('a').click(function(){
		var act = $(this).parent().attr('act'),
			index = $(this).index();
		if( act != index ){
			act == index;
			$(this).parent().attr('act', index);
			$(this).addClass('act').siblings().removeClass('act');
			funs(index);
		}
	});
}







//功能化
var ncs = new Object();


/*
* name: 弹出框
* anthor: nachao
* function: 初始化
* paramter: -
*/
ncs.ajax = {
	url: "./ajax/ajax_user.php",

	//初始化
	init: function(file){
		if(file){
			this.url = "./ajax/"+ file;	//重置数据文件
		}
	},

	//输出地址
	log: function(){
		return this.url;
	},

	//提交数据
	set: function(val, funs){
		$.ajax({
			type: "POST",
			url: this.url,
			data: val,
			success: function(msg){
				funs? funs(msg): null;
			}
		});
	},

	//获取数据
	get: function(val, funs){
		$.ajax({
			type: "POST",
			url: this.url,
			data: val,
			success: function(msg){
				funs? funs(msg): null;
			}
		});
	}
}


/*
* name: 弹出框
* anthor: nachao
* function: 初始化
* paramter: -
*/
ncs.pop = {
	// obj: [{
	// 	pop: null,	//弹出框
	// 	open: null,	//打开弹出框按钮
	// 	close: null	//关闭弹出框按钮
	// }],
	obj :[],
	funs: [],	//提交弹出框表单后执行的方法

	//初始化
	init: function(val){
		if(val.funs){
			this.funs = val.funs;
		}
		this.gets();
		this.event();
	},

	//获取全部元素
	gets: function(){
		var obj = this.obj,
			funs = this.funs;
		$('*[pop]').each(function(){	//遍历所有弹出框按钮
			var arr = {};
			arr.open = $(this);
			arr.pop = $('#'+ $(this).attr('pop'));
			arr.close = arr.pop.find('.pop-colse,.pop-bg,.pop-form-close');
			arr.submit = arr.pop.find('.pop-form-submit');
			arr.textarea = arr.pop.find('.pop-form-textarea');
			arr.funs = funs['pop-1'];
			if(arr.pop.length){		//如果有对应的弹出框的话则存入数据
				obj.push(arr);
			}
		});
	},

	//挂接事件
	event: function() {
		var obj = this.obj;
		$(obj).each(function(i, val){	//遍历绑定所有有效的弹出框事件
			val.open.click(function(){ val.pop.show(); }); 	//打开弹出框
			val.close.click(function(){ val.pop.hide(); });	//关闭弹出框
			val.submit.click(function(){	//提交表单后执行，反馈对应的弹出框元素
				val.funs(val.pop); 	
				val.textarea.val('');
			});
		});
	}

	//获取表单数据

}