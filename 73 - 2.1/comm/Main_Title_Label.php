<?php

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
class Comm_advert
{	
	//获取当前登录用户的 ID
	//#调用方式 	
	// $uid = $uid ? $uid : parent::Eid();
	// protected function Eid(){
	// 	$u = new Users();
	// 	return $uid = $u -> Gid();
	// }

	// //判断
	// protected function Ais($sql){
	// 	$val = mysql_query($sql);
	// 	return $val ? mysql_fetch_array($val) : false;
	// }
}






/********************************************************************************************
* 数据操作
*/
class Data_label extends Config
{
	
	//初始化
	// function __construct(argument)
	// {
	// 	# code...
	// }



	/********************************************
	* 添加 add
	*/

	//添加标签
	// 参数说明
	protected function data_addLabel($lid=0, $uid=0, $tid=0, $name=''){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."label` (`id`, `lid`, `uid`, `tid`, `time`, `status`, `name`) VALUES (NULL, '".$lid."', '".$uid."', '".$tid."', '".time()."', '1', '".$name."');";
		return mysql_query($sql);
	}



	/********************************************
	* 查询 select
	*/

	//获取指定 标题TID 的全部标签
	protected function data_selectLabelList($tid=0){
		$sql = "select * FROM  `".parent::Fn()."label` WHERE  `tid` LIKE  '".$tid."' AND `status` =1 LIMIT 0 , 30";
		return mysql_query($sql);
	}

	//获取指定 标签LID 的全部信息
	protected function data_selectLabel($lid=0){
		$sql = "select * FROM  `".parent::Fn()."label` WHERE `lid` =".$lid." AND `status` =1 LIMIT 0 , 30";
		return parent::Ais($sql);
	}

	//
	protected function data_selectContentTotal($lid=0){
		$sql = "select count(`id`) FROM  `".parent::Fn()."content` WHERE  `label` =".$lid." LIMIT 1";
	 	$row = parent::Ais($sql);
	 	return $row[0];
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 标签AID 的指定 字段STR 的指定 参数VAL
	protected function data_update($lid=0, $str='', $val=0){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."label` SET  `".$str."` =  '".$val."' WHERE  `".parent::Fn()."label`.`lid` ='".$lid."' LIMIT 1 ;";
		return mysql_query($sql);
	}


}







/********************************************************************************************
* 逻辑层 
*/
class Event_label extends Data_label
{

	//默认私有变量
	private $info;
	private $userid;


	/********************************************
	* 获取 get
	*/

	//获取制定数据的列表
	protected function event_getList($query){
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}



	/********************************************
	* 刷新 update
	*/



	/********************************************
	* 新增 add
	*/


	/********************************************
	* 删除 delete
	*/






	/********************************************
	* 操作 use
	*/


}










/********************************************************************************************
* 输出层  	#只需根据页面需要，调用对应的逻辑层的对象方法
*/
class Label extends Event_label
{

	/********************************************
	* 获取 get
	*/

	//获取指定 标题TID 的全部标签信息
	public function Glabel($tid=0){
		$value = array();
		if($tid){
			$query = parent::data_selectLabelList($tid);
			$value = parent::event_getList($query);
		}
		return $value;
	}

	//获取指定 标签LID 的名称
	public function Gname($lid=0){
		$value = '';
		if($lid){
			$row = parent::data_selectLabel($lid);
			$value = $row['name'];
		}
		return $value;
	}

	//获取指定 标签LID 的相关信息
	public function Ginfo($lid=0){
		$value = '';
		if($lid){
			$row = parent::data_selectLabel($lid);
			$value = $row['name'];
		}
		return $value;
	}

	//获取指定 标签LID 的内容数量
	public function GCtotal($lid=0){
		$value = 0;
		if($lid){
			$value = parent::data_selectContentTotal($lid);
		}
		return $value;
	}




	/********************************************
	* 判断 is
	*/
	



	/********************************************
	* 刷新 update
	*/

	//刷新指定 标签AID 的名称
	public function Uname($lid=0, $name=''){
		$value = 0;
		if($lid && $name){
			parent::data_update($lid, 'name', $name);
			$value = $lid;
		}
		return $value;
	}

	//刷新指定 标签AID 的状态为关闭
	public function Uclose($lid=0){
		$value = 0;
		if($lid){
			parent::data_update($lid, 'status', time());
			$value = $lid;
		}
		return $value;
	}





	/********************************************
	* 新增 add
	*/

	//新增广告
	public function Alabel($name='', $tid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$value = 0;
		if($name && $tid){
			$lid = time().count($this -> Glabel($tid));
			parent::data_addLabel($lid, $uid, $tid, $name);
			$value = $lid;
		}
		return $value;
	}



	/********************************************
	* 操作 use
	*/

	
}




//赋值数据
$label = new Label();
$tl = new Label();



?>