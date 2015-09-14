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

	// 当前用户UID
	protected function _uid(){
		$u = new Users();
		return $u -> Guid();
	}


	// 添加标签
	protected function _addLabel( $uid =0, $name ='' ){
		// $sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."logs_label` (`id`, `label_id`, `content_id`, `user_id`, `time`, `status`) VALUES (NULL, '".$lid."', '".$cid."', '".$uid."', '".time()."', '1');";

		$sql = "insert INTO `ux73`.`ux73_main_label` (`id_lid`, `id_uid`, `time_create`, `time_active`, `text_name`) VALUES (".
				"NULL, '".$uid."', '".time()."', '".time()."', '".$name."');";
		return mysql_query($sql);
	}


	// 添加使用记录
	protected function _addUse( $lid =0, $uid =0, $cid =0 ){
		// $sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."logs_label` (`id`, `label_id`, `content_id`, `user_id`, `time`, `status`) VALUES (NULL, '".$lid."', '".$cid."', '".$uid."', '".time()."', '1');";

		$sql = "insert INTO `ux73`.`ux73_log_label` (`id_lid`, `id_uid`, `id_cid`, `time_use`) VALUES ('".$lid."', '".$uid."', '".$cid."', '".time()."');";
		return mysql_query($sql);
	}


	// 获取标签，根据名称
	protected function _selectByName( $name ='' ) {
		$sql = "select *  FROM `ux73_main_label` WHERE `text_name` LIKE '".$name."'";
		return parent::Ais($sql);
	}


	// 获取标签，根据名称
	protected function _selectByLid( $lid ='' ) {
		$sql = "select *  FROM `ux73_main_label` WHERE `id_lid` = ".$lid;
		return parent::Ais($sql);
	}


	// 获取标签使用记录
	protected function _selectUse( $uid =0, $cid =0 ) {
		$sql = "select *  FROM `ux73_log_label` WHERE `id_uid` = ".$uid." AND `id_cid` = ".$cid;
		return mysql_query($sql);
	}










	//获取指定 标签LID 的全部信息
	protected function data_select($lid=0){
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


	//获取标签使用
	public function Guse( $cid =0, $uid =0 ){

		$uid = $uid ? $uid : parent::_uid();

		$array = array();
		$query = parent::_selectUse( $uid, $cid );
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				$info = parent::_selectByLid($row['id_lid']);
				$temp = array(
						'lid' => $info['id_lid'],
						'name' => $info['text_name'],
					);
				array_push($array, $temp);
			}
		}

		return $array;	//返回
	}




	// 获取标签
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

	// 新增标签
	public function Alabel( $name ='' ){
		$uid = parent::_uid();
		$value = array(
			'status' => 0,
			'message' => '-'
		);

		if ( $uid && $name ) {
			$label = parent::_selectByName($name);

			if ( !$label ) {
				parent::_addLabel( $uid, $name );
				$label = parent::_selectByName($name);
				$value = array(
					'status' => 1,
					'message' => '成功添加标签',
					'label' => $label
				);

			} else {
				$value = array(
					'status' => 1,
					'message' => '标签已存在',
					'label' => $label
				);
			}
		}

		return $value;
	}

	// 新增使用标签
	public function ALuse( $lid =0, $cid =0 ){
		$uid = parent::_uid();
		$value = array(
			'status' => 0,
			'message' => '-'
		);

		if ( $uid && $lid && $cid ) {
			if ( parent::_addUse( $lid, $uid, $cid ) ) {
				$value = array(
					'status' => 1,
					'message' => '标签标记成功'
				);
			}
		}

		return $value;
	}




	/********************************************
	* 操作 use
	*/

	
}




//赋值数据
$label = new Label();
$a = new Label();



?>