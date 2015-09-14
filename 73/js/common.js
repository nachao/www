

// 实例化功能
na['user'] = new User();
na['content'] = new Content();
na['user']['login'] = new Login();








/**
*  以下为 2.0 遗留事件	------------
**/



/*
* name: 弹出框
* anthor: nachao
* function: 初始化
* paramter: -
*/
var ncs = {};
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
			arr.close = arr.pop.find('.pop-close,.pop-bg,.pop-form-close');
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
}


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


//设置金币显示方式	*******************************************************
jQuery.fn.extend({
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
			if( val < 10000 ){

				val = {
						num: dh(val),
						unit: ''
					}

			}else{

				//获得数字长度
				len = String(val).length;

				//如果是 万位
				if( len > 10 ){
					val = {
						num: dh((val/100000000).toFixed(2)),
						unit: '亿'
					}
				}else if( len > 9 ){
					val = {
						num: dh((val/10000000).toFixed(2)),
						unit: '千万'
					}
				}else if( len >= 5 ){
					val = {
						num: dh((val/10000).toFixed(2)),
						unit: '万'
					}
				}else{
					val = {
						num: dh(val),
						unit: ''
					}
				}
			}

			//加逗号
			function dh( val ){
				var arr = String(val),
					len = arr.length-1,
					str = '';

				if(arr.indexOf('.') && arr.split('.')[0].length <= 3){
					return val;
				}else{
					//遍历
					for( var i=len; i>=0; i-- ){
						if( i!=len && (len-i)%3 == 0 ){
							str = arr[i] + ',' + str;
						}else{
							str = arr[i] + str;
						}
					}
					return str;
				}
			}

			//设置
			if( typeof(obj) == 'object' ){
				if(obj.next('i').length){
					obj.next('i').html(' ' + val.unit + '分');
				}
				if( obj.is('input') ){
					obj.val(val.num);
				}else{
					obj.html(val.num);
				}
			}

			//返回数据
			return val;
		}
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
// $('.bigimg').lookbig();	


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
    if(cval!=null){
    	document.cookie= name + "=;expires="+exp.toGMTString(); 
    }
} 