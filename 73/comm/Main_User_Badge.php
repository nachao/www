<?php

//引用逻辑层
// include("begin_user_badge.php");	

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
// class Comm_user_badge extends Config
// {	
// }



/********************************************************************************************
* 数据操作
*/
class Data_user_badge extends Config
{


	//创建私有变量
	private $titleId;


	/********************************************
	* 添加
	*/

	//添加指定 用户UID 的徽章记录
	protected function data_addBadge($uid=0, $bid=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."logs_specialuse` (`id`, `uid`, `sid`, `time`, `receive`) VALUES ('', '".$uid."', '".$bid."', '".time()."', '0');";
		return mysql_query($sql);
	}


	/********************************************
	* 删除
	*/

	//删除指定 用户UID 的徽章领取记录
	protected function data_deleteSpecialUse($uid=0, $sid=0){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."logs_specialuse` WHERE `".parent::Fn()."logs_specialuse`.`sid` = ".$sid." AND `".parent::Fn()."logs_specialuse`.`uid` = ".$uid." ;";
		return mysql_query($sql);
	}

	//删除指定 徽章SID 的领取记录
	protected function data_deleteSpecialUseBySid($sid=0){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."logs_specialuse` WHERE `".parent::Fn()."logs_specialuse`.`sid` = ".$sid." ;";
	}



	/********************************************
	* 查询
	*/

	//获取全部 徽章
	protected function data_selectSpecial(){
		$sql = "select * FROM  `".parent::Fn()."special` LIMIT 0 , 30";
		return mysql_query($sql);
	}

	//获取指定 徽章BID 的信息
	protected function data_selectSpecialGetInfo($bid=0){
		$sql = "select * FROM  `".parent::Fn()."special` WHERE  `id` =".$bid;
		return parent::Ais($sql);
	}

	//获取指定 用户UID 的全部徽章信息
	protected function data_selectUserBadge($uid=0){
		$sql = "select  `s`. * FROM  `".parent::Fn()."special` AS  `s` ,  `".parent::Fn()."logs_specialuse` AS  `u` WHERE  `u`.`sid` =  `s`.`id` AND `u`.`uid` = ".$uid." ORDER BY  `u`.`time` ASC ;";
		return mysql_query($sql);
	}

	//获取指定 用户UID 的指定 徽章SID 的信息
	protected function data_selectBadgeInfo($uid=0, $sid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_specialuse` WHERE  `sid` =".$sid." AND `uid` =".$uid." ;";
		return parent::Ais($sql);
	}


	//获取指定 徽章SID 的领取信息
	protected function data_selectBadgeUse($sid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_specialuse` WHERE  `sid` =".$sid.";";
		return parent::Ais($sql);
	}



	/********************************************
	* 刷新 update
	*/


	//刷新指定 用户UID 领取指定 徽章SID 的领取时间
	protected function data_updateReceive($uid=0, $sid=0){
		$sql = "update `".parent::Mn()."`.`".parent::Fn()."logs_specialuse` SET  `receive` =  '".time()."' WHERE  `".parent::Fn()."logs_specialuse`.`sid` =".$sid." AND `uid` =".$uid." ;";
		return mysql_query($sql);
	}

	//刷新指定 徽章SID 的指定 字段STR 的指定 参数VAL
	protected function data_update($sid=0, $str='', $val=0){
		$sql = "update `".parent::Mn()."`.`".parent::Fn()."logs_specialuse` SET  `".$str."` =  '".$val."' WHERE  `".parent::Fn()."logs_specialuse`.`sid` =".$sid." AND `uid` =".$uid." ;";
		return mysql_query($sql);
	}

}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user_badge extends Data_user_badge
{


	/********************************************
	* 获取 get
	*/

	//初始化
	// public function __construct(){
	// }


	//获取指定 用户UID 的指定 徽章BID 信息
	protected function event_getBadgeInfo($uid=0, $bid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectBadgeInfo($uid, $bid);
	}

	//获取全部 权重图标
	protected function event_getSpecial(){
		$array = array();
		$query = parent::data_selectSpecial();
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 徽章BID 的系统信息
	protected function event_getSpecialInfo($bid=0){
		if($bid){
			return parent::data_selectSpecialGetInfo($bid);
		}
	}

	//获取指定 用户UID（选） 的全部徽章
	protected function data_selectBadge($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$query = parent::data_selectUserBadge($uid);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;	//返回
	}

	//获取指定 徽章SID 的领取信息
	protected function event_selectBadgeUse($sid=0){
		parent::data_selectBadgeUse($sid);
	}




	/********************************************
	* 刷新 update
	*/


	//刷新指定 用户UID 领取指定 徽章SID 的领取时间
	protected function event_updateReceive($sid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($sid){
			return parent::data_updateReceive($uid, $sid);
		}
	}

	//刷新指定 徽章SID 的拥有者
	protected function event_updateOwner($uid=0, $sid=0){
		if($sid && $uid){
			return parent::data_update($sid, 'uid', $uid);
		}
	}



	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID 的徽章记录
	protected function event_addBadge($bid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($bid){
			return parent::data_addBadge($uid, $bid);
		}
	}




	/********************************************
	* 删除 delete
	*/

	//删除指定 用户UID 的徽章领取记录
	protected function event_deleteSpecialUse($uid=0, $sid=0){
		if($sid && $uid){
			return parent::data_deleteSpecialUse($uid, $sid);
		}
	}

	//删除指定 徽章SID 的领取记录
	protected function event_deleteSpecialUseBySid($sid=0){
		if($sid){
			return parent::data_deleteSpecialUseBySid($sid);
		}
	}







	/********************************************
	* 操作 use
	*/

}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Users_badge extends Event_user_badge
{

	/********************************************
	* 获取 get
	*/

	//获取全部 系统徽章
	public function Gspecial(){
		return parent::event_getSpecial();
	}

	//获取指定 徽章SID 的全部信息
	public function GBinfo($sid=0){
		return parent::event_getSpecialInfo($sid);
	}

	//获取指定 用户UID 的所有徽章
	public function Gbadge($uid=0){
		return parent::data_selectBadge($uid);
	}

	//获取指定第一名的领取时间
	public function GOtime(){
		$info = parent::event_selectBadgeUse(4);
		return $info['time'];
	}


	/********************************************
	* 判断 is
	*/
	
	//判断指定 用户UID（选） 是否有徽章
	public function Ibadge($uid=0){
		return count(parent::data_selectBadge($uid));
	}

	//判断指定 用户UID（选） 是否拥有指定的 徽章Bid
	public function IBbe($bid=0, $uid=0){
		return parent::event_getBadgeInfo($uid, $bid) != 0;
	}

	//判断指定福利 是否已经领取过
	public function Ireceive($bid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$value = 0;
		if($bid){
			$row = parent::event_getBadgeInfo($uid, $bid);
			if( $row['receive'] > strtotime(date('Y-m-d')) ){
				$value = 1; 	//本日福利已领
			}
		}
		return $value;
	}

	//判断指定 徽章BID 是否需要购买
	public function IBPbuy($bid=0){
		$info = parent::event_getSpecialInfo($bid);
		$gain = $info['gain'];
		$purchase = $info['purchase'];
		if( $gain == '购买' ){	//判断
			$gain = sprintf("%.2f", $purchase/100).' 元';
		}
		return array(	
			'str' => $gain,
			'num' => $purchase
		);
	}

	//如果是免费的则可以直接领取，否则是 购买或者其他
	public function IBfree($str=''){
		return $str == '免费' ? "领取" : "购买";
	}

	//是需要购买还是领取的 样式
	public function IBFcn($str=''){
		
		if( $str == '自动发放' ){
			return "no";
		}

		if( $str == '免费' ) {
			return "cupid-green receiveBadge";
		}else{
			return "cupid-orange receiveBadge";
		}
	}

	//判断是否可以发放 第一名徽章
	public function IPone(){
		$info = parent::event_selectBadgeUse(4);
		return strtotime(date('Y-m-d')) > $info['time'];
	}

	//判断是否可以发放 第二名徽章
	public function IPtwo(){
		$info = parent::event_selectBadgeUse(7);
		return strtotime(date('Y-m-d')) > $info['time'];
	}

	//判断是否可以发放 第三名徽章
	public function IPthree(){
		$info = parent::event_selectBadgeUse(9);
		return strtotime(date('Y-m-d')) > $info['time'];
	}

	//判断指定 用户UID 是否可以发放 人际圈牛人徽章
	public function IPniu($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$u = new Users();
		$num = $u -> GInum($uid);
		return $num >= 3;
	}






	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户UID 领取指定 福利SID 的时间
	public function Ureceive($sid=0, $uid=0){
		$value = 0;
		if($this -> Ireceive($sid) == 0){
			$row = $this -> GBinfo($sid);
			$u = new Users();
			$u -> UAplus($row['welfare']);
			if(parent::event_updateReceive($sid)){
				$value = $row['welfare'];
			}
		}
		return $value;
	}

	//更新第一名
	public function Uone(){
		$sid = 4;
		$u = new Users();
		$info = $u -> Gdigg(0, 1);
		if($info){
			$this -> DBuse($sid);
			$this -> Aspecial($sid, $info[0]['uid']);
		}
	}

	//更新第二名
	public function Utwo(){
		$sid = 7;
		$u = new Users();
		$info = $u -> Gdigg(1, 1);
		if($info){
			$this -> DBuse($sid);
			$this -> Aspecial($sid, $info[0]['uid']);
		}
	}

	//更新第三名
	public function Uthree(){
		$sid = 9;
		$u = new Users();
		$info = $u -> Gdigg(2, 1);
		if($info){
			$this -> DBuse($sid);
			$this -> Aspecial($sid, $info[0]['uid']);
		}
	}




	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID 发布指定 徽章BID
	public function Aspecial($sid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$value = 0;
		$u = new Users();	
		if($this -> IBbe($sid, $uid) == 0){
			$info = parent::event_getSpecialInfo($sid);
			$u -> USplus(intval($info['purchase'], 10));	//扣除指定的费用
			if( $info['icon'] == "vip" ){		//如果是购买会员
				$u -> Uvip(strtotime('+7day'));	//则开通会员
			}
			$value = parent::event_addBadge($sid, $uid);
		}
		return $value;
	}

	//给指定 用户UID 发放 圈子牛人 徽章
	public function ASniu($uid=0){
		$this -> Aspecial(5, $uid);
	}


	/********************************************
	* 撤销 delete
	*/

	//删除指定 用户UID 的 徽章SID 领取记录
	public function DSuse($sid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::event_deleteSpecialUse($uid, $sid);
	}

	//删除指定 用户UID 的会员记录
	public function DSUvip($uid=0){
		return $this -> DSuse($uid, 2);
	}

	//删除指定 徽章SID 领取记录
	public function DBuse($sid=0){
		return parent::event_deleteSpecialUseBySid($sid);
	}




	/********************************************
	* 操作 use
	*/


	
}




//赋值数据
$ub = new Users_badge();



?>