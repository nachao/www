



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
*  验证账号和密码，且登录
*
*  @param {string} account = 账号
*  @param {string} password = 密码
*  @param {function} callback = 回调
*  @return {object}	如果登录成功则返回 status =1，失败则 =0。成功的话返回此用户的基本信息。
*  @public
*/
User.prototype._entry = function( account, password, callback ){

	var param = {};

	if ( account && password ) {

		param['user'] = 'entry';
		param['account'] = account;
		param['password'] = password;

		this.get_( param, function(data){
			callback ? callback(data) : null;
		});
	}
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
User.prototype._register = function( callback ){

	var param = {};

	param['user'] = 'register';

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}


/*
*  保持用户信息
*
*  @param {object} param 
*  @public
*/
User.prototype.set = function( param ){
	this.data_ = param;
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
			message: ''
		};

	if ( account == '' ) {
		result.status = false;
		result.message = '请输入账号';

	} else if ( !/^[\u4e00-\u9fa5]+$/gi.test(account) ){
		result.status = false;
		result.message = '账号只能是由2-9个中文字组成';
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
			message: ''
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

	if ( param ) {

		// 刷新用户信息
		$('#userInfoIcon').attr('src', param.icon);
		$('#userInfoGold').attr('n', param.sum).golds();
		$('#userInfoName').html(param.name);

		// 刷新用户操作按钮
		$('#j_userOperate').show().removeClass('no').find('span').html(param.name);
		$('#j_userOperate em').attr('n', param.sum).golds();
		$('#j_userEntry').hide();
	}
}


/*
*  将制定用户信息保存至缓存
*
*  @param {object} account = 账号
*  @public
*/
User.prototype.cache = function( param ){

	param = param || this.data_;

}






na['user'] = new User();