



/**
*  七十三号官方插件
*
*  @author Na Chao
*  @version 1.0
*  @declare:
*
*	此插件由七十三号开发和特定使用，如果你需要的话可随意使用和修改。
*
*	--by 2015
**/
function Na ( obj_option ) {

	obj_option = obj_option || {};


	/*
	*  @type {object}
	*  @private
	*/
	this.url = {};


	/*
	*  @init
	*/
	this.url.param = this.urlParam_();


}


/*
*  获取当前地址的参数
*
*  @return {object}
*  @private
*/
Na.prototype.urlParam_ = function(){

	var param = location.search.replace('?', '').split('&'),
		result = {};

	$(param).each(function( i, val ){
		val = val.split('=');

		result[val[0]] = val[1];
	});

	return result;
}


/*
*  调用AJAX，获取指定后台的数据
*
*  @param {object} param = 对应参数
*  @param {function} callback = 回调
*  @return {object}
*  @private
*/
Na.prototype.get_ = function( param, callback ){

	param['_'] = new Date().getTime();

	$.ajax({ 
		type: "POST", 
		url: './ajax/ajax_user.php', 
		contentType:"application/json",
		dataType:"json",
		data: JSON.stringify(param),
		success: function(data){
			callback ? callback(data) : null;
		}
	});
}


/*
*  去除指定字符串的空格
*
*  @param {string} val = 值
*  @return {string}
*  @private
*/
Na.prototype.delBlank_ = function( val ){
	return val.replace(/\s*/g, '');
}





var na = new Na();