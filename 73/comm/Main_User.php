<?php

//引用逻辑层
// include("begin_user.php");	

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
// class Comm_user extends Config
// {	
// }



/********************************************************************************************
* 数据操作
*/
class Data_user extends Config
{
 
	//创建用户
	protected function _addUser( $invited =0, $account ='', $pwd ='', $ip ='' ){
		$sql = "insert INTO `ux73`.`ux73_main_user` (".
				"`id_uid`, `id_invited`, `text_account`, `text_pwd`, `text_register_ip`, `time_lastdate`, `time_lastskip`, `time_register`) VALUES (".
				"NULL, '".$invited."', '".$account."', '".$pwd."', '".$ip."', '".time()."', '".time()."', '".time()."')";
		return mysql_query($sql);
	}

	//获取用户信息，根据账号
	protected function _byAccount( $account ='' ){
		$sql = "select * FROM  `ux73_main_user` WHERE  `text_account` LIKE  '".$account."'";
		$query = mysql_query($sql);
		$info = mysql_fetch_array($query);

		if ( $info ) {
			return array(
				'uid' => $info['id_uid'],
				'account' => $info['text_account'],
				'pwd' => $info['text_pwd'],
				'nick' => $info['text_nick'],
				'icon' => $info['text_icon'],
				'email' => $info['text_email'],
				'depict' => $info['text_describe'],
				'sum' => $info['number_sum'],
				'vip' => $info['status_vip']
			);
		}
	}

	//获取用户信息，根据UID
	protected function _byUid( $uid =0 ){
		$sql = "select * FROM  `ux73_main_user` WHERE  `id_uid` = '".$uid."'";
		$query = mysql_query($sql);
		$info = mysql_fetch_array($query);

		if ( $info ) {
			return array(
				'uid' => $info['id_uid'],
				'account' => $info['text_account'],
				'pwd' => $info['text_pwd'],
				'nick' => $info['text_nick'],
				'icon' => $info['text_icon'],
				'email' => $info['text_email'],
				'depict' => $info['text_describe'],
				'sum' => $info['number_sum'],
				'vip' => $info['status_vip']
			);
		}
	}

	//更新用户信息
	protected function _update($uid=0, $val='', $num=0 ){
		$sql = "update  `ux73`.`ux73_main_user` SET  `".$val."` =  '".$num."' WHERE  `ux73_main_user`.`id_uid` =".$uid;
		return mysql_query($sql);
	}
}







/********************************************************************************************
* 私用
*/
class Event_user extends Data_user
{

	// 用户UID
	public function uid_() {

		if ( isset($_COOKIE["73"]) ) {
			$uid = $_COOKIE['73'];
		} else {
			$uid = 0;
		}

		return $uid;
	}

	// 用户总积分
	public function sum_() {
	}

}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Users extends Event_user
{

	//获取UID
	public function Guid() {
		return parent::uid_();
	}

	//获取用户信息，根据UID
	public function Guser( $target =0 ) {

		$info = parent::_byUid($target);

		if ( !$info ) {
			$info = parent::_byAccount($target);
		}

		$randomIcon = '../icon/'.rand(1,26).'.jpg';

		return array(
			'account' => $info['account'],
			'nick' => $info['nick'],
			'icon' => $info['icon'] ? $info['icon'] : $randomIcon,
			'uid' => intval($info['uid']),
			'sum' => intval($info['sum'])
		);
	}

	//判断用户是否存在
	public function Ibe($uid=0){
		return count(parent::event_getInfo($uid));
	}

	//判断指定 用户账号和密码 是否存在，如果存在并验证密码是否正确	//登录
	public function Ientry( $account ='', $password ='' ){

		// $c = new Content();
		$value = array();
		$user = parent::_byAccount( $account );

		if ( $account =='' || $password == '' ){
			$value = array( 
					'status' => '0',
					'message' => '请填写完整'
				);

		} else if ( !$user ) {
			$value = array( 
					'status' => '0',
					'message' => '账号不存在'
				);

		} else if ( $user['pwd'] != MD5($password) ){
			$value = array( 
					'status' => '0',
					'message' => '密码错误'
				);

		} else {
			$uid = $user['uid'];
			$this -> Acache($uid);
			parent::_update( $uid, 'time_lastdate', time());	//刷新登录时间
			$value = array(
				'status' => 1,
				'message' => '登录成功',
				'basic' => $this -> Guser($uid)
			);
		}

		return $value;
	}

	// 获取缓存信息
	public function Gcache () {
		$uid = parent::uid_();
		$value = array(
			'status' => 0,
			'message' => '无缓存账号'
		);

		if ( $uid ) {
			$value = array(
				'status' => 1,
				'message' => '成功获取用户基本信息',
				'basic' => $this -> Guser($uid)
			);
		}

		return $value;
	}

	//添加用户积分
	public function UAplus( $num =1 ){
		return parent::_update( parent::sum_() +$num, parent::uid_() );
	}

	//扣除用户积分
	public function USplus( $num=1 ) {
		return parent::_update( parent::sum_() -$num, parent::uid_() );
	}

	//注册用户
	public function Auser( $account='', $password='', $invited=0, $cdk=0 ){
		// $o = new Tool();
		// $ip = $o -> Gip();
		$value = array();

		if ( $account == '' || $password == '' ) {		// 判断参数是否存在且完整
			$value = array( 
				'status' => '2',
				'message' => '参数不正确'
			);

		} else if ( parent::_byAccount($account) ) {	// 判断账号是否存在
			$value = array( 
				'status' => '3',
				'message' => '账号已存在'
			);

		} else {
			parent::_addUser( $invited, $account, MD5($password) );	// 保存数据
			$user = $this -> Guser($account);
			$this -> Acache($user['uid']);
			$value = array(
				'status' => 1,
				'message' => '注册成功',
				'basic' => $user
			);
		}

		return $value;
	}

	//添加用户浏览器缓存
	public function Acache( $uid =0 ) {

		if ( $uid ) {
			setcookie( '73', $uid, time()+24*3600, "/");	//存入本地缓存 - 有效时间 1 天	

			$value = array(
				'status' => 1,
				'message' => '缓存成功'
			);
		} else {
			setcookie( '73', '', time()-3600, "/");

			$value = array(
				'status' => 1,
				'message' => '清除缓存'
			);
		}

		return $value;
	}

	//提交反馈信息
	public function Afeedback($txt=''){
		$u = new Users();
		$value = 0;
		if($u -> Guid()){
			$value = parent::event_addFeedback($u -> Guid(), $txt); 
		}
		return $value;
	}
}


//赋值数据
$u = new Users();

?>