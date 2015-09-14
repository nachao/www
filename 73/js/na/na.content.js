



/**
*  七十三号官方插件 - 内容功能
*
*  @author Na Chao
*  @version 1.0
**/
function Content ( obj_option ) {

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
Content.prototype = new Na();


/*
*  添加内容
*
*  @param {object} param
*  @param {function} callback
*  @public
*/
Content.prototype._add = function( param, callback ){

	param = param || {};

	var that = this;

	param['content'] = 'add';

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}


/*
*  获取内容
*
*  @param {object} param
*  @param {function} callback
*  @public
*/
Content.prototype._get = function( callback, param ){

	param = param || {};

	var that = this;

	param['content'] = 'get';

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}


/*
*  点赞
*
*  @param {object} param
*  @param {function} callback
*  @public
*/
Content.prototype._zan = function( param, callback ){

	param = param || {};

	param['content'] = 'zan';

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}

