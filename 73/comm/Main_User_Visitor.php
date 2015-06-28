<?php

//引用逻辑层
// include("begin_user_message.php");	

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
// class Comm_user_message extends Config
// {	
// }



/********************************************************************************************
* 数据操作
*/
class Data_user_visitor extends Config
{


	/********************************************
	* 添加
	*/

	//添加指定 用户UID 的留言记录
	// 参数：firsttime= 第一次访问时间；lasttime= 最近一次访问时间
	protected function data_add($ip='', $sum=0, $uid=0, $icon=''){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."visitor` (`id`, `firsttime`, `lasttime`, `ip`, `sum`, `name`, `icon`, `status`, `uid`) VALUES (NULL, '".time()."', '".time()."', '".$ip."', '".$sum."', NULL, '".$icon."', '1', '".$uid."');";
		return mysql_query($sql);
	}



	/********************************************
	* 删除
	*/

	//删除指定留言
	protected function data_deleteMessageDel($uid=0, $mid=0){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."message` WHERE `".parent::Fn()."message`.`id` = ".$mid." AND `".parent::Fn()."message`.`uid` =".$uid." LIMIT 1;";
		return mysql_query($sql);
	}

	//删除指定留言下面的所有回复
	// protected function data_deleteMessageDelHf($uid=0, $hid=0){
	// 	$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."message` WHERE `".parent::Fn()."message`.`reply` = ".$hid" `".parent::Fn()."message`.`uid` =".$uid." LIMIT 1;";
	// 	return mysql_query($sql);
	// }


	/********************************************
	* 查询
	*/

	//获取指定 游客UID 信息 
	protected function data_selectByUid($uid=0){
		$sql = "select * FROM  `".parent::Fn()."visitor` WHERE  `uid` =".$uid." LIMIT 0 , 1";
		return parent::Ais($sql);
	}

	//获取指定 游客UID 的点赞总数
	protected function data_selectZjnbTotal($uid=0){
		$sql = "select count(`id`)  FROM `".parent::Fn()."logs_purchase` WHERE `out_uid` = ".$uid;
		$row = parent::Ais($sql);
		return $row[0];
	}


	/********************************************
	* 刷新 update
	*/

	//刷新指定 游客UID 的指定 字段VAL 的 参数NUM
	protected function data_update($uid=0, $val='', $num=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."visitor` SET  `".$val."` =  '".$num."' WHERE  `".parent::Fn()."visitor`.`uid` =".$uid;
		return mysql_query($sql);
	}

}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user_visitor extends Data_user_visitor
{

	//默认私有变量
	private $info;
	private $userid;

	const CN = "73userid";


	/********************************************
	* 获取 get
	*/

	//初始化
	// public function __construct(){
	// }

	//获取指定 用户UID 的指定 时间TIME 之后的留言信息
	protected function event_selectMessage($uid=0, $time=0, $begin=0, $pages=99){
		$uid = $uid ? $uid : parent::Eid();
		$query = parent::data_selectMessage($uid, $time, $begin, $pages);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;	//返回
	}




	/********************************************
	* 刷新 update
	*/


	/********************************************
	* 添加 add
	*/



	/********************************************
	* 删除 delete
	*/





	/********************************************
	* 操作 use
	*/


}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Users_visitor extends Event_user_visitor
{

	/********************************************
	* 获取 get
	*/

	//获取指定 用户UID 距上次查看留言之后的未读留言信息数量
	public function Gvisitor($uid=0){
		return parent::data_selectByUid($uid);
	}

	//获取当前游客的 UID
	// public function Guid(){
	// 	$uid = $uid ? $uid : parent::Eid();
	// 	$info = parent::data_selectByUid($uid);
	// 	$sum = 0;
	// 	if ( count($info) > 1 ) {
	// 		$sum = $info['sum'];
	// 	}
	// 	return $sum;
	// }

	//获取指定 游客UID 的金额
	public function Gsum($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$info = parent::data_selectByUid($uid);
		$sum = 0;
		if ( count($info) > 1 ) {
			$sum = $info['sum'];
		}
		return $sum;
	}

	//获取指定 游客UID 的点赞次数
	public function GZtotal($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectZjnbTotal($uid);
	}

	//获取指定 游客UID 的头像
	public function Gicon($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$info = parent::data_selectByUid($uid);
		$icon = $info['icon'];
		if ( !$icon ) {
			$icon = '../imgs/default.gif';
		}
		return $icon;
	}

	//获取指定 游客UID 的名称
	public function Gname($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$info = parent::data_selectByUid($uid);
		$name = $info['name'];
		if ( !$name ) {
			$name = $info['ip'];
		}
		return $name;
	}






	/********************************************
	* 判断 is
	*/
	
	//判断指定 内容CID 是否有留言
	public function ICmessage($cid=0){
		return count(parent::event_getContentOneMessage($cid)) > 0;
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户ID（选填） 的最近访问留言
	public function Usum($uid=0, $num=0){
		if($num >= 0){
			parent::data_update($uid, 'sum', $num);
			return $num;
		}
	}




	/********************************************
	* 添加 add
	*/

	//添加指定新的游客信息
	public function Anew(){
		$o = new Tool();
		$u = new Users();
		$ip = $o -> Gip();
		$sum = 24;
		$icon = '';
		$uid = str_replace(':', '', $ip);
		//判断新游客是否有数据记录
		if ( count(parent::data_selectByUid($uid)) == 1 ) {
			$icon = '../icon/'.rand(1,26).'.jpg';
			return parent::data_add($ip, $sum, $uid, $icon);
		}
		//缓存
		$u -> Acache($uid, 'visitor');
		if ( !isset($_COOKIE['73visitor']) ) {
			$u -> UtoL('index.php');
		}
	}



	/********************************************
	* 撤销 delete
	*/


	//删除留言 及下面的所有回复
	public function Dmessage($mid=0, $uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		parent::event_deleteMessageDel( $uid, $mid );
		parent::event_deleteMessageDelHf($uid, $mid);
		return count($this -> GHmessage());		//获取留言总数
	}




	/********************************************
	* 操作 use
	*/

	
}




//赋值数据
$uv = new Users_visitor();



?>