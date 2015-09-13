
	// 实例化功能
	na['user'] = new User();
	na['user']['login'] = new Login();


	//弹出框初始化
	ncs.pop.init({
		funs: {
			'pop-1': function(pop){
				var txt = pop.find('.pop-form-textarea').val();
				if(txt.replace(/\s*/g, '') != ''){
					pop.hide();		//关闭弹出框
					ncs.ajax.set("feedback="+ txt);	//提交反馈信息后提交数据
				}
			},
			'pop-2': function(){
				ncs.ajax.set("feedback="+ $('.j-fankui').val());	//提交后执行
			}
		}
	});

	// 置顶按钮
	var btn = $('#topBtn');
	btn.click(function(){
		$('body,html').animate({ scrollTop:0 }, 500 );
	});
	$(window).scroll(function(){
		if( $(window).scrollTop() > 300 ){
			btn.addClass('rotate');
		}else{
			btn.removeClass('rotate');
		}
	});


	//设置金额显示方式
	$('.golds').golds();

	//启动游客收入
	// $(window).visitorIncome();

	// 按钮
    $(window).keydown(function(e){

    	// 如果登陆注册窗口打开状态
    	if ( $('#pop-4').is(':visible') ) {
			if ( e && e.keyCode == 13 ) { // enter 键

				if( $("#account").attr('enter') == "login" ){
					$('#loginAffirm').click();		// 登录

				}else{
					$('.register .affirm').click();	// 注册
				}
			}
		}
    });

	//查看大图
	$('.bigimg').lookbig();	