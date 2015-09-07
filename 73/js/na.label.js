



/**
*  七十三号官方插件 - 标签功能
*
*  @author Na Chao
*  @version 1.0
**/
function Lable ( obj_option ) {

	obj_option = obj_option || {};


	/*
	*  @type {object}
	*  @private
	*/


	/*
	*  @init
	*/


}


/**
*  继承父级对象
**/
Label.prototype = new Na();


/*
*  获取指定标签的信息
*
*  @param {string} label = 指定键值
*  @param {function} callback = 回调
*  @return {object}
*  @private
*/
User.prototype.get = function( label, callback ){

	var param = {
			_label: label
		};

	this.get_( param, function(data){
		callback ? callback(data) : null;
	});
}





na['user'] = new User();