



/**
*  七十三号官方插件 - 用户功能
*
*  @author Na Chao
*  @version 1.0
**/
function User ( obj_option ) {

	obj_option = obj_option || {};


	/*
	*  @type {object}
	*  @private
	*/
	this.data_ = null;


	/*
	*  @init
	*/

}


/**
*  继承父级对象
**/
User.prototype = new Na();


/*
*  获取指定用户的信息
*
*  @param {string} uid = 指定键值
*  @param {function} callback = 回调
*  @return {object}
*  @public
*/
User.prototype._get = function( uid, callback ){

	var param = {},
		that = this;

	param['user'] = 'get';
	param['uid'] = uid;

	this.get_( param, function(data){
		callback ? callback(data) : null;

		that.set(data);
	});
}


/*
*  获取指定账号的每天的收入详细
*
*  @param {string} uid = 账号
*  @param {string} day = 指定天数内容，默认 7 天
*  @param {function} callback = 回调
*  @public
*/
User.prototype._income = function( uid, callback, day ){

	var param = {};

	if ( uid ) {

		param['user'] = 'income';
		param['uid'] = uid;
		param['day'] = day || 7;

		this.get_( param, function(data){
			callback ? callback(data) : null;
		});
	}
}


/*
*  判断当前是否有账号登录
*
*  @param {function} callback = 回调
*  @public
*/
User.prototype._getCache = function( callback ){

	var param = {};

	param['user'] = 'exist';

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}


/*
*  获取指定用户的信息
*
*  @return {object}
*  @public
*/
User.prototype.get = function(){
	return this.data_;
}


/*
*  验证账号格式是否正确
*
*  @param {string} account = 账号
*  @return {object} 正确返回 status =true，错误返回 =false
*  @public
*/
User.prototype.verifyAccount = function( account ){

	account = this.delBlank_(account);

	var result = {
			status: true,
			message: '-'
		};

	if ( account == '' ) {
		result.status = false;
		result.message = '请输入账号';

	// } else if ( !/^[\u4e00-\u9fa5]+$/gi.test(account) ){
	// 	result.status = false;
	// 	result.message = '账号只能是由2-9个中文字组成';
	}

	return result;
}


/*
*  验证密码格式是否正确
*
*  @param {string} password = 密码
*  @return {object} 正确返回 status =true，错误返回 =false
*  @public
*/
User.prototype.verifyPwd = function( password ){

	password = this.delBlank_(password);

	var result = {
			status: true,
			message: '-'
		};

	if ( password == '' ) {
		result.status = false;
		result.message = '请输入密码';

	}

	return result;
}


/*
*  页面显示当前登录用户信息
*
*  @param {object} account = 账号
*  @public
*/
User.prototype.refresh = function( param ){

	param = param || this.data_;

	console.log(param);

	if ( param ) {

		// 刷新用户信息
		$('#userInfoIcon').attr('src', param.icon);
		$('#userInfoGold').attr('n', param.plus).golds();
		$('#userInfoName').html(param.nick || param.account);

		// 刷新用户操作按钮
		$('#j_userEntry').hide();
		$('#j_userOperate').removeClass('no');
		$('#j_userOperateName').html( param.nick || param.account );
		$('#headGold').attr('n', param.plus ).golds();
	}
}


/*
*  将制定用户信息保存至缓存
*
*  @param {object} account = 账号
*  @public
*/
User.prototype.setCache = function( param ){

	param = param || this.data_;

}


/*
*  保持用户信息
*
*  @param {object} param 
*  @public
*/
User.prototype.setUser = function( param ){
	this.data_ = param;
}


/*
*  注册账号
*
*  @param {string} account = 账号
*  @param {string} password = 密码
*  @param {function} callback = 回调
*  @return {object}	如果登录成功则返回 status =1，失败则 =0。成功的话返回此用户的基本信息。
*  @public
*/
User.prototype._register = function( account, password, callback ){

	var param = {},
		login = this.login;

	if ( account && password ) {

		param['user'] = 'register';
		param['account'] = account;
		param['password'] = password;

		login.loading(true);
		this.get_( param, function(data){
			login.loading(false);

			callback ? callback(data) : null;
		});
	}
}


/*
*  验证账号和密码，且登录
*
*  @param {string} account = 账号
*  @param {string} password = 密码
*  @param {function} callback = 回调
*  @return {object}	如果登录成功则返回 status =1，失败则 =0。成功的话返回此用户的基本信息。
*  @public
*/
User.prototype._entry = function( account, password, callback ){

	var param = {},
		login = this.login;

	if ( account && password ) {

		param['user'] = 'entry';
		param['account'] = account;
		param['password'] = password;

		login.loading(true);
		this.get_( param, function(data){
			login.loading(false);
			callback ? callback(data) : null;
		}); 
	}
}









/**
*  登陆注册弹出框
**/

function Login (){

	// 声明
	this.el_ = {};

	// 初始化
	this.el_['account'] = $('#account');
	this.el_['password'] = $('#password');
	this.el_['tip'] = $('#loginAffirmTip');
	this.el_['loading'] = $('#entryLoading');
}



/*
*  获取元素
*
*  @public
*/
Login.prototype.getEl = function(){
	return this.el_;
}


/*
*  显示等待界面
*
*  @param {boolean} open = true 打开，false 关闭（默认）
*  @public
*/
Login.prototype.loading = function(open){

	if ( open ) {
		this.el_.loading.slideDown();
	} else {
		this.el_.loading.slideUp();
	}
}


/*
*  提示错误信息
*
*  @param {boolean} msg = 有信息的时候则打开，没有信息则隐藏
*  @public
*/
Login.prototype.prompt = function(msg){

	if ( msg ) {
		this.el_.tip.show().find('em').html(msg);
		this.el_.tip.delay(3000).fadeOut();
	} else {
		this.el_.tip.hide();
	}
}


/*
*  显示登录成功信息
*
*  @param {boolean} data = 有信息的时候则打开，没有信息则隐藏
*  @public
*/
Login.prototype.entrySuccess = function(data){

	if ( data ) {
		var success = $('#entrySuccess').slideDown();

		// 显示登录用户信息
		success.find('#entrySuccessName').html(data.basic.name);
		success.find('#entrySuccessPlus').html(data.insert.plus);
		success.find('#entrySuccessCollect').html(data.insert.collect);
		success.find('#entrySuccessComment').html(data.insert.comment);
		success.find('#entrySuccessFollower').html(data.insert.follower);
	}
}


/*
*  显示登录成功信息
*
*  @param {boolean} data = 有信息的时候则打开，没有信息则隐藏
*  @public
*/
Login.prototype.registerSuccess = function(data){

	if ( data ) {
		var success = $('#registerSuccess').slideDown();

		// 显示登录用户信息
		success.find('#entrySuccessName').html(data.basic.name);
	}
}

