
$("input[title='站长统计']").hide();

// //刷新 状态
// (function(){
// 	if( $('#confirm').length > 0 ){
// 		au();
// 		var seat = $('#status').val();
// 		function au(){
// 			setTimeout(function(){ go() }, 1000 * 60);
// 		}
// 		function go(){
// 			$.ajax({
// 				type: "POST",
// 				url: "./ajax/ajax_user.php",
// 				data: "status=" + seat
// 			});
// 			au();
// 		}
// 	}
// })();

//js本地图片预览，兼容ie[6-9]、火狐、Chrome17+、Opera11+、Maxthon3
jQuery.fn.extend({
    previewImage:function(imgPreviewId,divPreviewId, saveVal ){
        var fileObj = $(this).context;
        var allowExtention=".jpg,.jpeg,.bmp,.gif,.png";//允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
        var extention=fileObj.value.substring(fileObj.value.lastIndexOf(".")+1).toLowerCase();            
        var browserVersion= window.navigator.userAgent.toUpperCase();
        var temp;
        if(allowExtention.indexOf(extention)>-1){ 
            if(fileObj.files){//HTML5实现预览，兼容chrome、火狐7+等
                if(window.FileReader){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        document.getElementById(imgPreviewId).setAttribute("src",e.target.result);
                        saveVal.val(1);
                    }  
                    reader.readAsDataURL(fileObj.files[0]);
                }else if(browserVersion.indexOf("SAFARI")>-1){
                    alert("不支持Safari6.0以下浏览器的图片预览!");
                }
            }else if (browserVersion.indexOf("MSIE")>-1){
                if(browserVersion.indexOf("MSIE 6")>-1){//ie6
                    document.getElementById(imgPreviewId).setAttribute("src",fileObj.value);
                    saveVal.val(1);
                }else{//ie[7-9]
                    fileObj.select();
                    if(browserVersion.indexOf("MSIE 9")>-1)
                        fileObj.blur();//不加上document.selection.createRange().text在ie9会拒绝访问
                    var newPreview =document.getElementById(divPreviewId+"New");
                    if(newPreview==null){
                        newPreview =document.createElement("div");
                        newPreview.setAttribute("id",divPreviewId+"New");
                        newPreview.style.width = document.getElementById(imgPreviewId).width+"px";
                        newPreview.style.height = document.getElementById(imgPreviewId).height+"px";
                        newPreview.style.border="solid 1px #d2e2e2";
                    }
                    document.getElementById(imgPreviewId).setAttribute("src", document.selection.createRange().text);
                    saveVal.val(1);
                   
                    newPreview.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";                            
                    var tempDivPreview=document.getElementById(divPreviewId);
                    tempDivPreview.parentNode.insertBefore(newPreview,tempDivPreview);
                    tempDivPreview.style.display="none";                    
                }
            }else if(browserVersion.indexOf("FIREFOX")>-1){//firefox
                var firefoxVersion= parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                if(firefoxVersion<7){//firefox7以下版本
                    // document.getElementById(imgPreviewId).setAttribute("src",fileObj.files[0].getAsDataURL());
                }else{//firefox7.0+                    
                    document.getElementById(imgPreviewId).setAttribute("src",window.URL.createObjectURL(fileObj.files[0]));
                    saveVal.val(1);
                }
            }else{
                document.getElementById(imgPreviewId).setAttribute("src",fileObj.value);
            }         
        }else{
            alert("仅支持"+allowExtention+"为后缀名的文件!");
            fileObj.value="";//清空选中文件
            if(browserVersion.indexOf("MSIE")>-1){                        
                fileObj.select();
                document.selection.clear();
            }                
            fileObj.outerHTML=fileObj.outerHTML;
            console.log( fileObj.outerHTML );
        }
    }
});

//设置金币显示方式
function goldShow2( obj ){
	var	g = $(obj);
	if( !!g.length ){
		var	d,l,s;
		if( g.attr('n') ){
			d = g.attr('n').split('');
		}else{
			d = d?d:g.html().split('');
		}
		
		l = d.length,
		s = '';

		for(var i=l-1; i>=0; i--){
			s = d[i] + s;
			if( i != 0 && (l-i)%3 <= 0 ){
				s = ',' + s;
			}
		}
		g.html(s);
	}
}


//图片效果
function imgLook(obj){
	var cue = obj.find('.imghint'),
		mh = obj.find('img').height();
	if( mh >= 240 ){
		$(obj).click(function(){
			var h = parseInt($(obj).css('max-height'));
			if( h > 240 ){
				cue.show(500);
				$(obj).stop().animate({ maxHeight:240 });
			}
			if( h == 240 ){
				cue.hide(500);
				$(obj).stop().animate({ maxHeight:mh });
			}
		});
	}else{
		obj.height( mh );
		cue.remove();
	}
}

//内容显示
var lookAllTop = 0;
function lookAll(hide, con){

	//按钮
	var btn = hide.nextAll('.more');

	//显示
	if( hide.filter('.act').length ){

		//返回展开时的位置
		$('html,body').stop().animate({ scrollTop: lookAllTop });

		hide.removeClass('act').stop().animate({ height:72 });
    	btn.find('.look').html('展开全部');
	
	//隐藏
	}else{

		//记录展开时的位置
		lookAllTop = $(window).scrollTop();

		btn.find('.look').html('　　收起');
		hide.addClass('act').stop().animate({ height:con.height()+10 });
	}
}


//设置当前状态
// $('#floatmenu a').eq($('#exp_menu').val()).addClass('act');
// $('#usermenu a').eq($('#userinfo').attr('menu')).addClass('act');



//编辑所有输入框激活效果
(function(){
	var inp = $('input[def]');
	inp.each(function(){
		var s = $(this),
			def = s.attr('def');
		s.val(def).css({ color:'#ccc' });
		s.focus(function(){
			s.css({ color:'black' });
			if( s.val() == def )
				s.val('');
		}).blur(function(){
			if( s.val() == '' )
				s.val(def).css({ color:'#ccc' });
		});
	});
})();




//模板二的自动排序
jQuery.fn.extend({
	jw13217:function(val){
		var obj = $(this),
			are = val.are,	
			col = val.col,	//获取全部列表
			row = null,
			rowNum = 3;

		//获取每列的高度参数
		function getWin(){
			var v=new Array();
			for(var i=0; i<row.length; i++){
				v.push(row.eq(i).height());
			}
			return v;
		}

		//添加图片
		function addImg(){
			var actName = "jw13217_row_itemDes";
			for(var i=0; i<col.length; i++){
				if(!col.eq(i).hasClass(actName)){
					row.eq(jisImg()).append(col.eq(i));
				}
			}
		}

		//获取离底部间距最大的一列
		function jisImg(){
			var n=getWin(), t=n[0], v=0;
			for(var i=0;i<n.length;i++){
				if(n[i]<t){t=n[i]; v=i; }
			}
			return v;
		}

		//初始化列数
		function iniLie(){
			var className = "jw13217_row",
				rmr = 0;
			for(var i=0; i<rowNum; i++){ 
				are.prepend("<div class='"+ className +"'></div>"); 
			}
			row = are.find('.'+ className);
			rmr = parseInt(row.css('marginRight')) * (rowNum-1);
			row.width(parseInt((obj.width()-rmr) / rowNum));
		}

		//运行函数
		function runFun(){
			iniLie();
			addImg();
		}

		//初始化
		runFun();
	}

});




//获取用户信息
function getuserinfo(obj){

	var uid = $(obj).attr('userid');
	
	if( $(obj).length > 0 && !$(obj).attr('info') ){
		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "userinfo=" + uid,
			success: function(msg){

				// console.log( msg );

				var info = eval('('+ msg +')');
				var con = $(".master[userid='"+uid+"']");
					con.each(function(){
						var a = $(this).find('.head .par a');
							a.eq(0).html( info.plus ).attr('n', info.plus);
							a.eq(1).html( info.issue );
							a.eq(2).html( info.comments );							

						//重置金币显示
						goldShow( a.eq(0) );
						
					}).attr('info', true);
			}
		});
	}
}


//点赞
function god(obj, funs){
	var th = $(obj),
		_t = th.parent(),
		cid = th.parents('.master').attr('id'),
		num = _t.find('i');

	var userGold = parseInt($('#userGold').val());
	// console.log( userGold );

	if( userGold > 0 ){
		
		//刷新用户金币数量
		$('#userGold').val(userGold-1);

		//动画
		var n = parseInt(num.html());
		_t.addClass('godok');
		_t.find('span').append('<i>'+(n+1)+'</i>');
		_t.find('span').append('<i>'+(n+2)+'</i>');
		_t.find('span').animate({ top:-60 });

		//提交数据
		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "praise=" + cid,
			success: function(msg){
				// console.log( msg );
				// if( msg.replace(/\s/g,'') == 'gold' ){

				// 	alert( "你的金币不足！" );

				// }else{
					

					// var nums = msg.split(' ')[0],
					// 	gold = msg.split(' ')[1];

				// }
				funs ? funs() : null;
			}
		});
	}
}


//留言回复
function huifu(obj){
	var t = 0;
	$('#messages textarea').each(function(i){
		t = $(this).context.getBoundingClientRect().top + $(document).scrollTop();
	});
	var str = '回复 '+ $(obj).attr('user') +'：';
	if( t < $(window).scrollTop() ){
		$('html,body').animate({ scrollTop:t-30 },200,function(){
			$('#messages textarea').focus().val(str);
		});
	}else{
		$('#messages textarea').focus().val(str);
	}
}



//添加 留言
function messageAdd( value, novel ){

	//获取 登录用户 id 和 当前访问用户 id
	var eid = $('#entryid').val(),
		uid = $('#userid').val();

	//当前登录用户
	var userid = eid,
		newObj = null,
		str = '';

	//判断 如果当前 不是在自己的中心留言 或者 是新留言 的话，获取当前访问用户的 id
	if( eid != uid || novel ){
		userid = uid;
	}

	//判断 方向
	if( userid == value.userid ){

		//右侧显示内容
		newObj = $('#messageRight').clone(false).removeAttr('id');

		//判断 是否为回复内容
		if( value.huifu != 0 && value.huifu != null ){
			str = "回复 "+ value.huifu +"：";
		}

		//插入样式
		var str = "<em>"+ value.time +"</em>&nbsp;&nbsp;&nbsp;&nbsp;"+ str + value.content;

		//是否当前登陆用户，则可以删除留言
		if( eid == uid ){
			str =  "<a class='del' href='javascript:;'>删除</a>"+ str;
		}

		//添加内容
		newObj.find('p').html( str );

	}else{

		//左侧显示内容
		newObj = $('#messageLeft').clone(false);

		//用户登录状态，是否为登录状态，如果是，则可以回复指定的用户
		if( $('#confirm').val() ){
			str = "<a href='javascript:;' class='hf ml10' user='"+ value.name+"' >回复</a>";
		}

		//是否当前登陆用户，则可以删除留言
		if( eid == uid ){
			str =  str + "<a class='del' href='javascript:;'>删除</a>";
		}

		//添加内容
		newObj.find('p').html( value.name+"："+ value.content+"&nbsp;&nbsp;&nbsp;&nbsp;<em>"+ value.time+"</em>" + str );
	}

	//删除留言
	newObj.find('p .del').click(function(){
		if( confirm('确认删除此条留言吗？') ){
			$.ajax({
				type: "POST",
				url: "./ajax/ajax_user.php",
				data: "messageDel="+ value.id,
				success: function(msg){
					// console.log( msg );
					newObj.slideUp(function(){

						//刷新留言显示
						$('#messageMain').attr('tote', parseInt(msg));
						$('#messagesPage').attr('tote', parseInt(msg));

						//刷新后显示的页数
						var once = Math.ceil(parseInt(msg) / parseInt($('#messagesPage').attr('once'))) -1;
						if( parseInt($('#messagesPage').attr('act' )) < once ){
							once = parseInt($('#messagesPage').attr('act' ));
						}

			 			//生成留言分页
						pagess({
							obj: $('#messagesPage').empty(),
							end: function(index){
								masterGet({
									area: $('#messageMain'),
									begin: index
								});
							}
						}, once );

			 			//获取第一页的留言
						masterGet({
							area: $('#messageMain'),
							begin: once
						});

					});
				}
			});
		}
	});

	//修改头像
	newObj.find('.ico').attr( 'href', "./user.php?k="+ value.userid ); 
	newObj.find('.ico img').attr( 'src', "./effigy/"+ value.icon ); 

	//添加元素，如果是新留言则从头部添加，之前的留言的话则从底部添加
	if( novel ){
		$('#messageMain').append(newObj);
	}else{
		$('#messageMain').prepend(newObj.hide());
		$('#messageMain').find('.col:first').hide().slideDown('slow');
	}

	//回复按钮事件
	$('#words .col .hf').click(function(){
		huifu(this);
	});

}








//添加留言
function addMessage(obj){
	var btn = $(obj),
		_t = btn.parent(),
		c = _t.find('textarea');

	//判断是否是回复
	var hf = c.val().indexOf('回复 ');
	var con = c.val();
	if( hf == 0 ){
		hf = c.val().substr(3, c.val().indexOf('：')-3);
		con = con.substr(con.indexOf('：')+1);
	}else{
		hf = false;
	}

	//去除空格
	con.replace(/\s/g,'');

	if( c.val() ){

		var str = '';
		if( hf ){
			str = "&huifu="+hf;
		}

		btn.attr('disabled', 'true').val('留言提交中...');

		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "addMessage=" + con +'&userid=' + $('#userid').val() + str,
			success: function(msg){

				// console.log( msg );

				if( !!msg ){
				
					//添加留言
					var value = eval('('+ msg +')')
					messageAdd( value );

					//清空留言框
					c.val('');

					//恢复按钮
					btn.removeAttr('disabled').val('留言');
				
					//刷新用户金币显示
					if( !$('#floatmenu .icon i').length && parseInt($('#userinfo').attr('userid')) != parseInt($('#floatmenu .icon').attr('userid')) ){
						goldShow( $('#floatmenu .info').attr('n', parseInt($('#floatmenu .info').attr('n'))-1 ) );
						messageIs();
					}

				}
			}
		});
	}
}


//关注和取消关注
function followUse( obj, afuns, bfuns ){
	var userid = obj.parents('.master').attr('userid');
	if( obj.hasClass('act') ){

		//取消关注
		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "nogz=" + userid,
			success: function(msg){
				afuns ? afuns( msg ) : null;

				//转为关注
				obj.removeClass('act').html('❤关注');

				//刷新关注内容总数
				$('#gzTota').attr({'tota' : parseInt(msg) });

				//删除取消关注用户的内容
				if( $('#masterlist').attr('type') == 'love' ){
					$(".master[userid='"+ userid +"']").slideUp(function(){
						obj.remove();
					});
				}
			}
		});
	}else{

		//关注此人
		$.ajax({
			type: "POST",
			url: "./ajax/ajax_user.php",
			data: "guanzhu=" + userid,
			success: function(msg){
				bfuns ? bfuns( msg ) : null;

				// console.log( msg );

				//转为已关注
				gzbtn.addClass('act').html('已关注');

				//刷新关注内容总数
				$('#gzTota').attr({'tota' : parseInt(msg) });
			}
		});
	}
}


//判断是否已经关注
function isFollow(){
	
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



/*====			
输出分页返回的数据
====*/
var pagesHtml = {
		obj: null,
		end: null,
		yes: true,
		message: function(msg){		//留言分页页面输出样式
			// console.log( msg );

			//json 转 数组
			var arr = eval('('+ msg +')');

			//重置留言内容
			$('#messageMain').empty();
			$(arr).each(function(index, value){
				messageAdd( value, true );
			});
		
		},
		content: function(msg){		//内容分页

			// console.log( msg );
			// console.log( "--------------------------------------------------------------" );

			// var loop;
			// clearTimeout( loop );


			var arr = eval('('+ msg +')'),
				objs = Array();

			// console.log( arr );

			var obj = $('#templet').clone(false),
				add = null;
			var idd = 0; 

			//清空
			var con = $('.contentlist');
				con.css({ 'minHeight': con.height() }).empty();

			var uis = !!$('#confirm').val(),	//判断用户是否 登录 以及在自己的个人中心
				uid = $('#entryid').val();

			var titleid = $('#titleid').val();	//获取是否查看指定的标题 

			// console.log( uid );
			// console.log( titis );

			loadeder = true;
			addCon(0);

			//一次性输出
			var disposable = false;	//如果为 true 表示第一次输出。

			function addCon(){

				var i = idd;

				if( i >= arr.length-1 ){
					pagesHtml.end ? pagesHtml.end() : null;
				}

				//复制元素
				add = obj.clone(false).hide().removeAttr('id');

				//重置内容
				add.hide();
				add.attr('id', arr[i].id );
				add.attr('userid', arr[i].userid );
				add.find('.mall').attr( 'style', "background-image: url(./effigy/"+arr[i].icon+");"); 
				add.find('.user .cd').attr( 'style', "background-image: url(./effigy/"+arr[i].icon+");").attr('href','./user.php?k='+arr[i].userid);
				add.find('.user .see').attr('href','./user.php?k='+arr[i].userid);
				add.find('.tit h5').html(arr[i].title);
				add.find('.tit a').attr( 'href', './index.php?title='+ arr[i].titleid );
				add.find('.head .cue span.time').html(arr[i].time);
				add.find('.head .cue span:last em').html(arr[i].name);	//来自
				add.find('.head .name').html(arr[i].name);	//来自
				add.find('.con span').html(arr[i].content);
				add.find('.god span i').html(arr[i].plus);

				add.find('.more .skip').attr( "href", "./index.php?id="+ arr[i].id );	//跳转

				//判断是否是 vip
				if( !arr[i].vip ){
					add.find('.user .cd').empty();
					add.find('.user .name').removeClass('namered');
				}

				//如果没有 文字描述，则删除模块
				if( !arr[i].content ){
					add.find('.con').remove();
				}

				//是否显示个人信息中的按钮
				if( arr[i].me ){
					// add.find('.head .btn').remove();
				}

				//关注按钮
				var gzbtn = add.find('.head .uinfo .love');

				//用户基本信息查看
				add.find('.icon').mouseenter(function(){
					$(this).find('.user').stop().show(100);
					getuserinfo($(this).parents('.master'));
					
					//判断是否已经关注
					var userid = $(this).parents('.master').attr('userid');
					$.ajax({
						type: "POST",
						url: "./ajax/ajax_user.php",
						data: "gzis=" + userid,
						success: function(msg){
							// console.log( msg );

							//转为已关注
							if( parseInt(msg) ){
								gzbtn.addClass('act').html('已关注');
							}
						}
					});

				}).mouseleave(function(){
					$(this).find('.user').stop().hide(100);
				});

				// console.log( uid );

				//关注
				if( !!uid && uid != arr[i].userid ){
					gzbtn.click(function(){
						followUse( $(this) );
					});
				}else{
					gzbtn.remove();
				}

				//图片
				if( arr[i].image != '' ){
					add.find('.imgs').show().find('img').attr('src', './images/' + arr[i].image);
				}else{
					add.find('.imgs').remove();
				}

				//音乐
				if( arr[i].music != '' ){
					add.find('.mp3').show().find('embed').attr('src', arr[i].music);
				}else{
					add.find('.mp3').remove();
				}

				//视频
				if( arr[i].video != '' ){
					add.find('.video').show().find('embed').attr('src', arr[i].video);
				}else{
					add.find('.video').remove();
				}

				//链接
				if( arr[i].link != '' ){
					add.find('.link').show().html(arr[i].link);
				}else{
					add.find('.link').remove();
				}

				//添加元素
				$('#masterlist').append(add);

				//操作
            	var hide = add.find('.hide'),
            		cons = add.find('.hide span');

            	//如果没有登录，则跳转至登录页面
				if( !uid ){
					add.find('.god').click(function(){ 
						location.href='./login.php'; 
					});
				}

				//模板3样式
				if( !!$('.templet3').length ){
					if( arr[i].image != '' && arr[i].content != '' ){
						add.addClass('master_s3');
					}else if( arr[i].content != '' ){
						add.addClass('master_s2');
					}
				}

				//动画
				objs[i] = add;
				// setTimeout(function(){

					//图片加载完成后获取高度，并判断是否显示查看全部效果按钮
					var isAE = !!arr[i].image;

					objs[i].show();
					objs[i].show(function(){

		        		//是否有查看全部内容按钮
		        		var isAC = cons.height() > hide.height();
						if( isAC ){
							objs[i].find('.more .look').addClass('na');
							
							//显示点赞提示文字
							objs[i].find('.head .hint').show();

						}else{
							objs[i].find('.more .look').remove();

							//删除点赞提示文字
							objs[i].find('.head .hint').hide();
						}

						//可查看完整内容，文字和图片的
						function goCE(){

							//删除图片遮罩层，并图片添加查看全部效果
							objs[i].find('.imgs em').remove();

							objs[i].find('.imgs img').load(function(){
								imgLook(objs[i].find('.imgs'));
								objs[i].find('.imgs').width( objs[i].find('.imgs img').width() );
							});

			        		//查看全部内容按钮
							if( isAC ){
								objs[i].find('.more .look').removeClass('na').addClass('ok').animate({ top: 0 }).click(function(){
									lookAll(hide ,cons);
								});
							}

							//删除点赞提示文字
							objs[i].find('.head .hint').remove();

							//点赞按钮显示为数字
							objs[i].find('.god').addClass('godok');
						}

						// console.log( parseInt(arr[i].comments) );

						//是否显示点赞按钮
						if( parseInt(arr[i].comments) ){
							objs[i].find('.god').find('a').click(function(){ 
								god($(this), goCE); 
							});
						}else{

							//判断是否登录
							if( !!uid ){
								// console.log( objs[i].find('.head .hint').length );

								//删除点赞提示文字
								// objs[i].find('.head .hint').remove();

								//点赞按钮显示为数字
								// objs[i].find('.god').addClass('godok');

								goCE();
							}
						}

						//如果是查看指定内容，默认为打开
						if( parseInt($('#masterlist').attr('contentid')) > 0 && parseInt($('#masterlist').attr('tote')) > 0 ){
							objs[i].find('.more .skip').remove();

			        		//查看全部内容按钮
							if( isAC ){
								objs[i].find('.more .look').click();
							}

							//默认显示全部操作
							objs[i].find('.more .btn a').css({ display:'inline-block' });
						}

					});
			
				// }, 100*i);

				//删除
				if( uis ){
					add.find('.more .del').click(function(){ 
						var obj = $(this).parents('.master');
						if( window.confirm("提示：删除后无法再找回！") ){
							$.ajax({
								type: "POST", 
								url: "./ajax/ajax_user.php", 
								data: "delete=" + obj.attr('id'), 
								success: function(msg){
									// console.log( msg );

									//删除内容
									obj.slideUp(function(){
										$(this).remove();
									});

									//重置用户金币数量
									var d = parseInt(msg),
										n = parseInt($('#gold').attr('n')) + d,
										g = $('#gold');
										g.attr('n', n);
										g.html(n);
									goldShow(g);
								}
							});
						}
					});
				}else{
					add.find('.more .del').remove();
				}

				//移除
				if( !!arr[i].tz ){
					add.find('.more .not').click(function(){
						var obj = $(this).parents('.master');
						if( confirm('确定把该内容从此标题中移除？') ){
							$.ajax({
								type: "POST", 
								url: "./ajax/ajax_user.php", 
								data: "titRemoveContetn=" + obj.attr('id') + "&titleid="+ titleid, 
								success: function(msg){

									//删除内容
									obj.slideUp(function(){
										$(this).remove();
									});

								}
							});
						}
					});
				}else{
					add.find('.more .not').remove();
				}

				//循环
				idd += 1;
				if( idd < arr.length ){
					addCon();
				}else{
					$('.contentlist').css({ 'minHeight':'auto' });

					//调用内容自动排序]
					if( $('.templet2').length > 0 ){
						$('#contentArea').jw13217({ col: $('.master'), are: $('#masterlist') });
					}
				}

			}

			
		}

	}



// 调用获取新的内容参数
/*====
	
		用户id

	#	内容总条数
	#	开始条数
	#	每次输出条数

		类型：最新，热门

	#	位置
	#	输出函数名
	

====*/
function masterGet(v){
	var userid = v.userid || v.area.attr('userid'),					//查看目标用户的 ID

		tote = parseInt(v.tote) || parseInt(v.area.attr('tote')),		//总条数
		page = parseInt(v.page) || parseInt(v.area.attr('page')),		//每页条数
		begin = parseInt(v.begin) || parseInt(v.area.attr('begin')),		//当前页数

		html = v.html ||  v.area.attr('html'),	//页面输出函数名

		titleid = v.area.attr('titleid') || '' ,	//获取标题 
		contentid = v.area.attr('contentid') || '',	//获取指定内容

		type = v.area.attr('type') || 'new',		//类型
		seat = v.area.attr('seat') || 'index';		//位置

	pagesHtml.obj = v.area;
	pagesHtml.end = v.end;

	//是否默认输出
	pagesHtml.first = v.first;


	// console.log( begin +","+ tote );
	// console.log( "./ajax/ajax_"+ html +".php" );
	// console.log( "userid="+ userid +"&begin="+ (begin * page) +"&page="+ page +"&type="+ type +"&seat="+ seat +"&titleid="+ titleid +"&contentid="+ contentid );

	if( begin * page < tote ){
		// console.log(html);
		$.ajax({
			type: "POST",
			url: "../ajax/ajax_"+ html +".php",
			data: "userid="+ userid +"&begin="+ (begin * page) +"&page="+ page +"&type="+ type +"&seat="+ seat +"&titleid="+ titleid +"&contentid="+ contentid,
			success: function(msg){
				
				// console.log( msg );

				if( !!msg.replace(/\s/g,'') ){
					pagesHtml[html](msg);
				}
			}
		});
	}
}



