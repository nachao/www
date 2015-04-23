<?php

//引用逻辑层
// include("begin_user_exchange.php");	

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
// class Comm_user_exchange extends Config
// {	
// }



/********************************************************************************************
* 数据操作
*/
class Data_user_exchange extends Config
{


	//创建私有变量
	private $titleId;


	/********************************************
	* 添加
	*/

	//添加兑换列表
	protected function data_addExchange($uid=0, $val='', $num=0){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."exchange` (`id` , `userid`, `describe` ,`num` ,`key`, `time`)VALUES (NULL ,  '".$uid."', '".$val."',  '".$num."',  '', ".time().");";
		return mysql_query($sql);
	}


	/********************************************
	* 删除
	*/



	/********************************************
	* 查询
	*/
	
	//获取可兑换金币总数量
	protected function data_selectSurplus(){
		$sql = "select `num` FROM  `".parent::Fn()."exchange` WHERE  `id` =1 ";
		$row = parent::Ais($sql);
		return $row[0];
	}



	/********************************************
	* 刷新 update
	*/

	//刷新可以兑换数量
	protected function data_updateSurplus($num=0){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."exchange` SET  `num` =  '".$num."' WHERE  `".parent::Fn()."exchange`.`id` =  '1' LIMIT 1 ;";
		return mysql_query($sql);
	}



}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user_exchange extends Data_user_exchange
{


	/********************************************
	* 获取 get
	*/

	//初始化
	// public function __construct(){
	// }


	//获取可兑换金币总数量
	protected function event_getSurplus(){
		return parent::data_selectSurplus();
	}





	/********************************************
	* 刷新 update
	*/

	//刷新可以兑换数量
	protected function event_updateSurplus($num=0){
		return parent::data_updateSurplus($num);
	}




	/********************************************
	* 添加 add
	*/

	//添加兑换列表
	protected function event_addExchange($uid=0, $num=0, $val=''){
		return parent::data_addExchange($uid, $val, $num);
	}



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
class Users_exchange extends Event_user_exchange
{

	/********************************************
	* 获取 get
	*/

	//获取可兑换金币总数量
	public function Gsurplus(){
		return parent::event_getSurplus();
	}


	/********************************************
	* 判断 is
	*/
	



	/********************************************
	* 刷新 update
	*/

	//刷新指定 数量NUM 的扣除金额
	public function UDsum($num=0){
		$total = $this -> Gsurplus();
		if($num > $total){
			$num = $total;
		}
		return parent::event_updateSurplus($total -$num);
	}



	/********************************************
	* 添加 add
	*/

	//添加兑换记录
	public function Aexchange($num=0, $val='', $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$value = 0;
		$u = new Users();
		if($this -> Gsurplus() >= $num && $u -> Gplus() >= $num){	//判断 当前兑换数量必须小于总量 和 个人金币数量必须大于等于兑换数量
			if(parent::event_addExchange($uid, $num, $val)){		//记录至数据库中判断是否记录成功
				$u -> USplus($num);		//扣除金币
				$this -> UDsum($num);	//刷新总量
				$value = 1;				//提交成功
			}else{
				$value = 2;				//提交失败
			}
		}
		return $value;
	}


	/********************************************
	* 撤销 delete
	*/

	//删除指定 用户UID 的 徽章SID 领取记录
	public function DSuse($sid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		parent::event_deleteSpecialUse($uid, $sid);
	}




	/********************************************
	* 操作 use
	*/


	
}




//赋值数据
$ue = new Users_exchange();



?>