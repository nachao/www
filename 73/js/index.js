
			/*
	        Highcharts.setOptions({                                                     
	            global: {                                                               
	                useUTC: false                                                       
	            }                                                                       
	        });                                                                         
                                                                    
	        // var chart;                                                                  
	        $('#container').highcharts({                                                
	            chart: {                                                                
	                type: 'spline',               
		            backgroundColor: 'rgba(0, 0, 0, 0)',
		            height: 200,
	                animation: Highcharts.svg, // don't animate in old IE               
	                marginRight: 10,                                                    
	                events: {                                                           
	                    load: function() {                                              
	                                                                                    
	                        // set up the updating of the chart each second             
	                        // var series = this.series[0];                                
	                        // setInterval(function() {                                    
	                        //     var x = (new Date()).getTime(), // current time         
	                        //         y = parseInt(Math.random() * 100);                                  
	                        //     series.addPoint([x, y], true, true);                    
	                        // }, 1000 );                                                   
	                    }                                                               
	                }                                                                   
	            },                                                                      
	            title: {                                                                
	                text: ''                                            
	            },                                                                      
	            xAxis: {                                                                
	                type: 'datetime',                                                   
	                tickPixelInterval: 150,                                              
	            },                                                                      
	            yAxis: {                                                                
	                title: {                                                            
	                    text: ''                                                   
	                },                                                                  
	                plotLines: [{                                                       
	                    value: 0,                                                       
	                    width: 1,                                                       
	                    color: '#808080'                                                
	                }]                                                                  
	            },
	            credits: {
	            	text: ''
	            },                                                                      
	            tooltip: {                                                              
	                formatter: function() {                                             
	                        return '<b>'+ this.series.name +'</b><br/>'+                
	                        Highcharts.dateFormat('%Y-%m-%d', this.x) +'<br/>'+ 
	                        this.y;
	                        // Highcharts.numberFormat(this.y);                         
	                }                                                                   
	            },                                                                      
	            legend: {                                                               
	                enabled: false                                                      
	            },                                                                      
	            exporting: {                                                            
	                enabled: false                                                      
	            },                                                                    
	            series: [{                                                              
	                name: '总积分',
	                pointInterval: 3600 * 1000, // 间隔1小时
	                data: []                                                              
	            },{                                                              
	                name: '日收入',
	                pointInterval: 3600 * 1000, // 间隔1小时
	                data: []                                                              
	            }]                                                                      
	        });                                                                       				

			var highcharts = $('#container').highcharts();
			*/			



			// 获取内容数据
			/*
			$.ajax({ 
				type: "POST", 
				url: './ajax/ajax_user.php', 
				data: JSON.stringify({ clist: '10' }),
				contentType:"application/json",
  				dataType:"json",
				success: function(response){
					// console.log( response );
					
					// 获取元素
					var templat = $('#contentTemplat'),
						temp = null,
						list = $('#contentList');

					// 循环遍历参数
					$(response).each(function(key, data){

						// console.log(data);
						temp = templat.clone();
						temp.removeAttr('id').removeClass('no').show();

						// 判断标示
						if ( data.biaoshi == '1' ) {
							temp.find('.effects-very').removeClass('no').siblings('.effects').remove();
						} else {
							temp.find('.effects').remove();
						}

						// 判断是否有标题
						if ( data.biaotiid == '0' ) {
							temp.find('.tit a').html(data.biaoti);
						} else {
							temp.find('.tit').remove();
						}

						// 作者
						temp.find('.icon-user').attr('href', './list.php?uid='+ data.uid);
						temp.find('.use-fc-name').html(data.zuozhe);

						// 绑定事件
						temp.find('.icon-user').attr('get', '0').mouseenter(function(){

							var are = $(this),
								get = $(this).attr('get');

							if ( get == '0' ) {

								$(this).attr('get', '1');	// 标记为正在获取数据

								na.user.get( data.uid, function(data){
									are.find('.use-fc-icon').attr('src', data.icon );
									are.find('.use-fc-name').html(data.name );

									are.find('.use-fc-param .icon-sum').next('em').html(data.sum );
									are.find('.use-fc-param .icon-content').next('em').html(data.content );
									are.find('.use-fc-param .icon-love').next('em').html(data.love );

									are.find('.use-fcon').removeClass('use-fcon-load');
								});
							}
						});

						// 判断类型
						temp.find('.gui').addClass('gui_' + data.type);
						if ( data.type == '1' ) {	// 图片
							temp.find('.j_image').siblings('.j_control').remove();
							temp.find('.j_image img').attr('src', data.zhuyao);
						} else if ( data.type == '0' ) {	// 文字
							temp.find('.j_text sawtooth').html(data.zhuyao);
							temp.find('.j_text').siblings('.j_control').remove();
						}

						// 得分
						temp.find('.golds').attr('n', data.score).golds();

						// 文本
						if ( data.text ) {
							temp.find('.are').html(data.text);
						}

						list.append(temp);
					});

					// $('#contentList').jw13217();	//自动排序
					$('.purchase').purchase();		//挂接购买按钮
					// $('.col').picture();	//挂接已购买的内容为可查看图片
					$('.j_image img').lookbig();	//查看大图
				}
			});
			*/


			// 获取焦点图信息
			/*
			$.ajax({ 
				type: "POST", 
				url: './ajax/ajax_user.php', 
				data: JSON.stringify({ banner: 'true' }),
				contentType:"application/json",
  				dataType:"json",
				success: function(response){
					
					// 获取元素
					var banner = $('#banner'),
						imgsTemplat = $('#bannerImgsTemplat'),
						imgstemp = null,
						imgslist = $('#bannerImgsList');
						textTemplat = $('#bannerTextTemplat'),
						texttemp = null,
						textlist = $('#bannerTextList');

					// 循环遍历参数
					$(response).each(function(key, data){
						imgstemp = imgsTemplat.clone();
						imgstemp.removeAttr('id').removeClass('no').show();

						imgstemp.find('img').attr('src', data.src);
						imgslist.append(imgstemp);



						texttemp = textTemplat.clone();
						texttemp.removeAttr('id').removeClass('no').hide().addClass('home-banner-col');

						texttemp.find('.tit a').html(data.title);
						texttemp.find('.cue').html(data.text);
						
						// 判断类型
						if ( data.type == '1' ) {	// 推荐内容
							texttemp.find('.time').html(data.time);
							texttemp.find('.money,.tit,.cue').remove();


						} else if ( data.type == '2' ) {	// 推荐标题

							if ( data.titleType == '1' ) {	// 活动
								texttemp.find('.time').html('剩余：' + data.time);
								texttemp.find('.golds').attr('n', data.bonus).golds();

							} else if ( data.type == '2' ) {	// 专题
								texttemp.find('.time').html('更新于：' + data.time);
								texttemp.find('.money').remove();
							}
						}

						textlist.append(texttemp);

						if ( texttemp.index() == '1' ) {
							texttemp.show();
						}
					});
				}
			});
            */


			//焦点图
			/*
			var banner = $('.home-banner');
			var key = banner.find('.key i');
			var now = 0;
			key.mouseenter(function(){
				var txt = banner.find('.home-banner-col');
				var i = $(this).index();
				key.removeClass('act').eq(i).addClass('act');
				banner.find('.con').stop().animate({ left: -banner.width() * i }, 1000);
				txt.hide().eq(i).show();
				now = i;
			}).eq(now).mouseenter();
			banner.find('.btn a:first').click(function(){
				var i = now - 1;
					i = i<0? key.length-1 : i;
				key.eq(i).mouseenter();
			});
			banner.find('.btn a:last').click(function(){
				var i = now + 1;
					i = i>key.length-1? 0 : i;
				key.eq(i).mouseenter();
			});
*/






/*











		//挂接已购买的内容为可查看文本
		$('.col_possess').writing();

		//加载更多
		$('#loadmore').loadmore();

		//自动加载
		// $(window).scroll(function(){
		// 	if($(this).scrollTop() >= $('html,body').height() - $(window).height() - 100){
		// 		$('#loadmore').click();
		// 	}
		// });

		//设置内容为活动推荐
		$('.effects-recommend-set').recommend();

		//挂接关注和取消关注
		$('.describe').attention();

		//公告切换，此效果因为只在此页面使用，所有放在此处
		(function(){
			var cue = $('#notice-cue'),
				col = cue.find('p'),
				len = col.length;
			var current = 0;

			//主要的部分
			function go(){
				if(current >= len){
					current = 0;
				}
				if(current < 0){
					current = len-1;
				};
				cue.stop().animate({ top: -col.height() * current });
			}

			//自动执行
			var loop,
				time = 5000;
			function auto(){
				stop();
				loop = setTimeout(function(){
					auto();
					current++;
					go();
				}, time);
			}
			function stop() {
				clearTimeout(loop);
			}

			//挂接事件
			$('#notice-btn-left').click(function(){ current--; go(); });
			$('#notice-btn-right').click(function(){ current++; go(); });
			$('.notice').hover(function(){
				stop();
			},function(){
				auto();
			}).mouseleave();
		})();


		//获取指定内容的收支情况
		$('.col').income();


		//如果高度改变，重新排序瀑布
		// $('.contentList').resize(function(){
		// 	console.log($(this).height());
		// });
		//启动游客收入
		$(window).visitorIncome();

		*/


	// 切换界面 - 点击注册
	$('#loginLink').click(function(){
		
		//标题
		$('.pop-enter .head:first').stop().animate({ left: -400 });
		$('.pop-enter .head:last').stop().animate({ left: 0 });

		//密码确认
		// $('.confirm').stop().animate({ top: 0 });

		//输入验证码
		$('.content').removeClass('login-style');

		//按钮
		$('.register').show();
		$('.login').hide();

		//类型
		$('#account').attr('enter', 'register');

		//验证账号
		$('#account').blur();

		$('.entrybg').stop().animate({ left: 625 });

	});

	// 切换界面 - 点击登录
	$('#registerLink').click(function(){

		//标题
		$('.pop-enter .head:first').stop().animate({ left: 0 });
		$('.pop-enter .head:last').stop().animate({ left: 400 });

		//输入验证码
		$('.content').addClass('login-style');

		//密码确认
		// $('.confirm').stop().animate({ top: -50 });

		//按钮
		$('.register').hide();
		$('.login').show();

		//类型
		$('#account').attr('enter', 'login');

		//验证账号
		$('#account').blur();

		$('.entrybg').stop().animate({ left: 0 });

	});

	//转义
	function escaping( v ){
		v = v.replace(/\"/g, "&22");
		v = v.replace(/'/g, "&27");
		v = v.replace(/=/g, "&3D");
		return v;
	}

	//点击登陆按钮
	$('#loginAffirm').click(function(){

		var el = na.user.login.getEl(),
			str_account = el.account.val(),
			str_password = el.password.val();

		var	verify_account = na.user.verifyAccount(str_account),
			verify_password = na.user.verifyPwd(str_password);

		if ( !verify_account.status ) {
			na.user.login.prompt(verify_account.message);
			el.account.focus();

		} else if ( !verify_password.status ) {
			na.user.login.prompt(verify_password.message);
			el.password.focus();

		} else {
			na.user._entry( str_account, str_password, function(verify){	// 后台判断及登录
		
				if ( verify.status == '0' ) {			// 失败提示
					na.user.login.prompt(verify.message);

				} else if ( verify.status == '1' ) {	// 登录成功
					na.user.login.entrySuccess(verify);

					na.user.setUser(verify.basic);			// 保存用户信息
					na.user.refresh(verify.basic);			// 刷新显示
				}
			});
		}
	});


	// 点击注册按钮
	$('#registerAffirm').click(function(){

		var el = na.user.login.getEl(),
			str_account = el.account.val(),
			str_password = el.password.val();

		var	verify_account = na.user.verifyAccount(str_account),
			verify_password = na.user.verifyPwd(str_password);

		if ( !verify_account.status ) {
			na.user.login.prompt(verify_account.message);
			el.account.focus();

		} else if ( !verify_password.status ) {
			na.user.login.prompt(verify_password.message);
			el.password.focus();

		} else {
			na.user._register( str_account, str_password, function(verify){	// 后台判断及登录

				if ( verify.status == '0' ) {			// 密码错误
					na.user.login.prompt(verify.message);

				} else if ( verify.status == '1' ) {	// 登录成功
					na.user.login.registerSuccess(verify);

					na.user.setUser(verify.basic);			// 保存用户信息
					na.user.refresh(verify.basic);			// 刷新显示
				}
			});
		}
	});


	// 点击注销
	$('#j_logout').click(function(){
		na.user._logout(function(result){

			if ( result.status == '1' ) {			// 退出失败
				na.user.refresh();
			}
		});
	});


	// 判断当前是否
	na.user._getCache(function(data){

		if ( data.status == '1' ) {
			na.user.refresh(data.basic);
		}
	});

	// 获取内容
	na.content._get(function(result){

		var templat = $('#contentTemplat'),
			temp = null;

		if ( result.status == 1 ) {
			$(result.res).each(function( i, val ){
				temp = templat.clone();

				temp.removeClass('no').removeAttr('id').show();
				temp.find('.gui').hide();
				temp.find('.are').html(val.text);

				// 作者信息
				temp.find('.icon-user').attr('get', '0').mouseenter(function(){
					var are = $(this),
						get = $(this).attr('get');

					if ( get == '0' ) {
						$(this).attr('get', '1');	// 标记为正在获取数据
						na.user._get( val.uid, function(user){
							are.find('.use-fc-icon').attr('src', user.icon );
							are.find('.use-fc-name').html( user.nick || user.account );

							are.find('.use-fc-param .icon-sum').next('em').html(user.sum );
							// are.find('.use-fc-param .icon-content').next('em').html(user.content);
							// are.find('.use-fc-param .icon-love').next('em').html();

							are.find('.use-fcon').removeClass('use-fcon-load');
						});
					}
				});

				if ( val.zan == '0' ) {
					temp.find('.icon-good').attr('get', '0').click(function(){	// 点赞

						if ( !$(this).hasClass('praise-act') ) {
							$(this).addClass('praise-act');
							na.content._zan({
								cid: val.cid
							});
						}
					});

				} else {
					temp.find('.icon-good').addClass('praise-act');
				}

				if ( val.label ) {
					temp.find('.count-labels').empty();

					$(val.label).each(function( i, tag ){
						temp.find('.count-labels').append('<a href="javascript:;" class="label">'+ tag.name +'</a>');
					});
				}

				$('#contentList').append(temp);
			});
		}
	});

