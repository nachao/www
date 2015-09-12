

/*
*  用户功能
*
*  @constructor
*/
function User(){

	/*
	*  (string)
	*/
	this.account = null;
	


}


/*
*  验证用户是否存在
*
*  @private
*/
User.prototype.isBe_ = function(){

	//验证用户
	$.ajax({
		type: "POST",
		url: "./ajax/ajax_user.php",
		data: "entry="+ a +"&password="+ b,
		success: function(msg){
			console.log( msg );
			
			if( msg == 1 ){
				console.log("登录成功");
			
			} else if( msg == 2 ){
				console.log("密码错误");
			
			} else if ( msg == 3 ) {
				console.log("账号不存在");
			
			} else{
				console.log("验证失败");
			}
		}
	});
}


/*
*  获取指定
*
*  @private
*/
User.prototype.isBe_ = function(){

	//验证用户
	$.ajax({
		type: "POST",
		url: "./ajax/ajax_user.php",
		data: "entry="+ a +"&password="+ b,
		success: function(msg){
			console.log( msg );
			
			if( msg == 1 ){
				console.log("登录成功");
			
			} else if( msg == 2 ){
				console.log("密码错误");
			
			} else if ( msg == 3 ) {
				console.log("账号不存在");
			
			} else{
				console.log("验证失败");
			}
		}
	});
}
