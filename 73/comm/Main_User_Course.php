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
class Data_user_course extends Config
{


	/********************************************
	* 添加
	*/

	//创建指定 用户UID 完成的指定 教程CID 记录
	protected function data_add($uid=0, $cid=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."course` (`id`, `uid`, `course_id`, `time`) VALUES (NULL, '".$uid."', '".$cid."', '".time()."');";
		return mysql_query($sql);
	}



	/********************************************
	* 删除
	*/


	//删除指定留言下面的所有回复
	// protected function data_deleteMessageDelHf($uid=0, $hid=0){
	// 	$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."message` WHERE `".parent::Fn()."message`.`reply` = ".$hid" `".parent::Fn()."message`.`uid` =".$uid." LIMIT 1;";
	// 	return mysql_query($sql);
	// }


	/********************************************
	* 查询
	*/

	//获取指定 用户UID 是否完成了指定的 教程CID 
	protected function data_selectIs($uid=0, $cid=0){
		$sql = "select count(`id`)  FROM `".parent::Fn()."course` WHERE `uid` = ".$uid." AND `course_id` = ".$cid;
		$row = parent::Ais($sql);
		return $row[0];
	}


	/********************************************
	* 刷新 update
	*/

	//刷新指定 游客UID 的指定 字段VAL 的 参数NUM
	protected function data_update($uid=0, $val='', $num=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."user` SET  `".$val."` =  '".$num."' WHERE  `".parent::Fn()."user`.`uid` =".$uid;
		return mysql_query($sql);
	}

}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user_course extends Data_user_course
{


	/********************************************
	* 获取 get
	*/



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
class Users_course extends Event_user_course
{

	/********************************************
	* 获取 get
	*/


	//获取指定 游客UID 的点赞次数
	public function GZtotal($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectZjnbTotal($uid);
	}






	/********************************************
	* 判断 is
	*/

	//获取指定 用户UID 是否完成了指定的 教程CID ，如果没有则添加记录，并返回是否显示教程
	public function Ifinish($seat='', $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		switch ( $seat ) {
			case 'user': 		$cid = 1; break;	//用户中心页面
			case 'ability': 	$cid = 2; break;	//能力页面
			case 'title': 		$cid = 3; break;	//标题列表
			case 'publish': 	$cid = 4; break;	//发布内容页
			case 'detail': 		$cid = 5; break;	//内容详细页
			case 'withdraw': 	$cid = 6; break;	//提现页面
			case 'home': 		$cid = 7; break;	//首页
			default: 			$cid = 0; break;
		}
		$is = false;
		if ( $cid != 0 ) {
			$is = parent::data_selectIs($uid, $cid) == 0;
			if ( $is ) {
				parent::data_add($uid, $cid);
			}
		}
		return $is;
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

	//创建指定 用户UID 完成的指定 教程CID 记录
	public function Alog($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_add($uid, $cid);
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
$uc = new Users_course();



?>