<?php

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
class Comm_title
{	
}






/********************************************************************************************
* 数据操作
*/
class Data_title extends Config
{

	//创建私有变量
	private $titleId;


	/********************************************

	*/

	//创建标题	price = 金币池; $duration= 到期时间戳	reward = 奖励;
	protected function data_createNew( $uid=0, $tid=0 ,$tit='', $con='', $price=0, $duration=0, $reward=0, $type=0, $time=0  ){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."classify` (`id`, `tid`, `userid`, `title`, `content`, `price`, `duration`, `reward`, `applytime`, `start`, `type`) VALUES (NULL, '".$tid."','".$uid."','".$tit."', '".$con."', '".$price."', '".$duration."', '".$reward."', '".time()."', 1, '".$type."');";
		return mysql_query($sql);
	}



	/********************************************
	* 添加
	*/

	//添加指定 用户UID 关注指定的 标题ID
	protected function data_addUserFollowTit( $uid=0, $tid=0 ){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."logs_followtitle` (`id`, `time`, `uid`, `tid`) VALUES (NULL, ".time().", ".$uid.", ".$tid.");";
		return mysql_query($sql);
	}

	//添加指定 用户UID 投资指定 标题ID 的金额NUM
	protected function data_addUserInvestTit( $uid=0, $tid=0, $num=0 ){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."titleshare` (`id` , `tid` , `uid` , `sum` ) VALUES (NULL,  '".$tid."',  '".$uid."',  '".$num."');";
		return mysql_query($sql);
	}



	/********************************************
	* 删除
	*/

	//删除指定 用户UID 指定的 标题ID
	protected function data_deleteFollowTit( $uid=0, $tid=0 ){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."logs_followtitle` WHERE `".parent::Fn()."logs_followtitle`.`uid` = ".$uid." AND `".parent::Fn()."logs_followtitle`.`tid` = ".$tid." ;";
		return mysql_query($sql);
	}




	/********************************************
	* 查询
	*/

	//获取指定 标题ID 的信息
	protected function data_selectById($tid){
		$sql = "select * FROM `".parent::Fn()."classify` WHERE  `".parent::Fn()."classify`.`tid` ='".$tid."' LIMIT 1;";
		return parent::Ais($sql);
	}
	
	//获取 标题列表 	#开始数，页数
	// 参数说明
	// $begin= 当前页数（选）； $pages= 每页显示条数（选）；$type= 指定的标题类型（选，默认无） ； $grade = 购买次数标准（选，默认没有标准）
	protected function data_selectList( $begin=0, $pages=9, $type=0, $grade=0){
		$pages = $pages ? $pages : 9;
		$type = $type ? "AND  `type` =".$type : '';
		$sql = "select * FROM  `".parent::Fn()."classify` WHERE ((`duration` > ".time()." AND `type` =1 ) OR (`type` =2 AND `start` !=3 )) AND `click` >= ".$grade." ".$type." ORDER BY `id` DESC LIMIT ".$begin." , ".$pages;
		return mysql_query($sql);
	}

	//获取指定 标题ID 的内容总数
	protected function data_selectTitConTotal($tid=0){
		$cf = new Config();	//获取配置
		$sql = "select count(*) FROM  `".parent::Fn()."content` WHERE  `verify` = ".$cf -> Verify." AND `titleid` = ".$tid.";";
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取指定 用户UID 关注的所有 活动标题和专题标题 以及自己创建的所有标题 列表【用户侧栏我的标题，我关注的】
	protected function data_selectUserFollowList($uid=0, $begin=0 ,$pages=15 ){
		$sql = "select `t`. * FROM `".parent::Fn()."classify` AS `t` , `".parent::Fn()."logs_followtitle` as `u` WHERE (`t`.`start` = 1 AND ((`t`.`type` = 1 AND `t`.`duration` > ".time().") OR `t`.`type` =2)) AND (`t`.`tid` = `u`.`tid` AND `u`.`uid` = ".$uid.") GROUP BY  `t`.`id` ORDER BY `t`.`id` DESC LIMIT ".$begin." , ".$pages;
		return mysql_query($sql);
	}
	
	//获取指定 用户UID 的所有创建的 标题列表
	protected function data_selectFoundList( $begin=0, $pages=9, $uid=0 ){
		$sql = "select * FROM  `".parent::Fn()."classify` WHERE  `userid` =".$uid." AND  (`start` =0 OR  `start` =1 OR  `start` =2) ORDER BY  `useTime` DESC LIMIT ".$begin." , ".$pages;
		return mysql_query($sql);
	}

	//获取指定 用户UID 所有可以使用的 标题列表（包括活动（个人发布的活动和关注的活动）以及个人专题）【用于发布内容添加标题】
	protected function data_selectUsableList($uid=0, $begin=0 ,$pages=15 ){
		$sql = "select `t`. * FROM `".parent::Fn()."classify` AS `t` , `".parent::Fn()."logs_followtitle` as `u` WHERE (`t`.`start` = 1 AND ((`t`.`type` = 1 AND `t`.`duration` > ".time().") OR (`t`.`type` = 2 AND `t`.`userid` = ".$uid."))) AND (`t`.`tid` = `u`.`tid` AND `u`.`uid` = ".$uid.") GROUP BY  `t`.`id` ORDER BY `t`.`id` DESC LIMIT ".$begin." , ".$pages;
		return mysql_query($sql);
	}

	//获取指定 用户UID 关注的指定 标题TID 单条信息
	protected function data_selectUserFollowerInfo($uid=0, $tid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_followtitle` WHERE `uid` =".$uid." AND `tid` =".$tid;
		return parent::Ais($sql);
	}

	//获取指定 标题TID 里的被赞最多的一条内容信息
	protected function data_selectMaxPlusContent($tid=0){
		if($tid){
			$sql = "select * from `".parent::Fn()."content` where `plus`=(select max(`plus`) from `".parent::Fn()."content` WHERE  `titleid` =".$tid.") and `titleid` = ".$tid." ORDER BY  `id` DESC limit 1;";
			return parent::Ais($sql);
		}
	}

	//获取指定 标题TID 的关注人数
	protected function data_selectFollowTotal($tid=0){
		if($tid){
			$sql = "select count(`id`) FROM `".parent::Fn()."logs_followtitle` where `tid` = ".$tid;
			$row = parent::Ais($sql);
			return $row[0];
		}
	}

	//获取指定 用户UID 投资指定 标题ID 的信息
	protected function data_selectUserInvest( $uid=0, $tid=0){
		$sql = "select * FROM  `".parent::Fn()."titleshare` WHERE  `tid` =".$tid." AND  `uid` =".$uid." LIMIT 0 , 30";
		return parent::Ais($sql);
	}

	//获取指定 标题ID 的总投资金额
	protected function data_selectTitleInvestSum($tid=0){
		// $sql = "select * FROM  `".parent::Fn()."titleshare` WHERE  `tid` =".$tid." LIMIT 0 , 30";
		$sql = "select SUM(`sum`) FROM  `".parent::Fn()."titleshare` WHERE  `tid` =271430890209 LIMIT 0 , 30";
		$row = parent::Ais($sql);
		return $row[0];
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 标题ID 的参数(val)
	protected function data_update( $tid=0, $val='', $num=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."classify` SET  `".$val."` =  '".$num."' WHERE  `".parent::Fn()."classify`.`tid` =".$tid." LIMIT 1 ;";
		return mysql_query($sql);
	}

	//刷新指定 用户UID 投资指定 标题ID 的信息
	protected function data_updateInvest( $tid=0, $uid=0, $num=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."titleShare` SET  `sum` =  '".$num."' WHERE `tid` =".$tid." AND `uid` =".$uid." LIMIT 1 ;";
		return mysql_query($sql);
	}


}











/********************************************************************************************
* 逻辑层 	#获取指定参数，和插入数据，以及修改数据
*/
class Event_title extends Data_title
{
	
	/********************************************
	* 获取
	*/

	//获取 标题列表
	protected function event_get($begin=0, $pages=0, $type=0, $grade=0){
		$query = parent::data_selectList($begin, $pages, $type, $grade);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 用户(ID) 创建的 全部标题列表
	protected function event_getUserList($uid=0, $begin=0, $pages=15){
		$uid = $uid ? $uid : parent::Eid();
		$query = parent::data_selectFoundList($begin, $pages, $uid);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有内容
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 用户(ID) 关注的全部 标题列表（包括不能使用的专题标题）
	protected function event_getUserFollowList($uid=0, $pass=0, $begin=0, $pages=15){
		$uid = $uid ? $uid : parent::Eid();
		$query = parent::data_selectUserFollowList($uid, $begin, $pages);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有内容
			while( $row = mysql_fetch_array($query)){	//遍历数据
				if($pass){								//判断过滤用户自己创建的 标题，默认为不过滤
					if($row['userid'] != $uid){
						array_push($array, $row);
					}
				}else{
					array_push($array, $row);
				}
			}
		}
		return $array;
	}

	//获取指定 用户(ID) 关注的所有可以使用的 【活动标题】列表
	// protected function event_getUserFollowActList($uid=0, $begin=0, $pages=15){
	// 	$uid = $uid ? $uid : parent::Eid();
	// 	$query = parent::data_selectUsableList($uid, $begin, $pages);
	// 	$array = array();
	// 	if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有内容
	// 		while( $row = mysql_fetch_array($query)){	//遍历数据
	// 			array_push($array, $row);
	// 		}
	// 	}
	// 	return $array;
	// }

	//获取指定 用户(ID) 所有可以使用的 标题列表（包括所有关注的活动和个人的专题）
	protected function event_getUsableList($uid=0, $begin=0, $pages=15){
		$uid = $uid ? $uid : parent::Eid();
		$query = parent::data_selectUsableList($uid, $begin, $pages);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有内容
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 标题ID 的到期时间戳，或者上次维护时间
	protected function event_getDuration($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['duration'];
		}
	}

	//获取指定 标题ID 的内容总数
	protected function event_getTitConTotal($tid=0){
		if($tid){
			return parent::data_selectTitConTotal($tid);
		}
	}

	//获取指定 标题ID 的类型
	protected function event_getType($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['type'];
		}
	}

	//获取指定 标题ID 的状态
	protected function event_getStart($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['start'];
		}
	}

	//获取指定 标题ID 的金币池
	protected function event_getPrice($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['price'];
		}
	}

	//获取指定 标题ID 的单次分享金
	protected function event_getSharegold($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['shareglod'];
		}
	}

	//获取指定 标题ID 的内容数量
	protected function event_getNumber($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['number'];
		}
	}

	//获取指定 标题ID 的购买次数
	protected function event_getClick($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['click'];
		}
	}

	//获取指定 标题ID 的创建者UID
	protected function event_getCreator($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['userid'];
		}
	}

	//获取指定 标题TID 的标记获胜者
	protected function event_getFirst($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['first'];
		}
	}

	//获取指定 标题TID 的奖金
	protected function event_getReward($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['reward'];
		}
	}

	//获取指定 标题TID 的得分最高的 内容CID
	protected function event_getPlusMax($tid=0){
		if($tid){
			$info = parent::data_selectMaxPlusContent($tid);
			if($info){
				return $info['cid'];
			}
		}
	}

	//获取指定 标题TID 的得分最高的用户UID
	protected function event_getMaxPlusUid($tid=0){
		if($tid){
			$info = parent::data_selectMaxPlusContent($tid);
			if($info){
				return $info['userid'];
			}
		}
	}

	//获取指定 标题TID 的描述
	protected function event_getContent($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['content'];
		}
	}

	//获取指定 标题TID 的标题
	protected function event_getTitle($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['title'];
		}
	}

	//获取指定 标题TID 的生效时间
	protected function event_getUseTime($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['useTime'];
		}
	}

	//获取指定 标题TID 的是否开启代扣
	protected function event_getWithholding($tid=0){
		if($tid){
			$info = parent::data_selectById($tid);
			return $info['withholding'];
		}
	}

	//获取指定 标题TID 的全部信息
	protected function event_getInfo($tid=0){
		if($tid){
			return parent::data_selectById($tid);
		}
	}

	//获取指定 用户UID（选填） 关注指定 标题TID 的时间
	protected function event_getUserFollowerTime($tid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($tid){
			$info = parent::data_selectUserFollowerInfo($uid, $tid);
			return $info['time'];
		}
	}

	//获取指定 标题TID 的关注人数
	protected function event_getFollowTotal($tid=0){
		return parent::data_selectFollowTotal($tid);
	}

	//获取指定 用户UID 投资指定 标题ID 的信息
	protected function event_getUserInvest($uid=0, $tid=0){
		if($tid && $uid){
			return parent::data_selectUserInvest($uid, $tid);
		}
	}

	//获取指定 标题ID 的总投资金额
	protected function event_getTitleInvestSum($tid=0){
		if($tid){
			return parent::data_selectTitleInvestSum($tid);
		}
	}




	/********************************************
	* 添加
	*/


	//创建新标题 提交表单
	//#参数备注		
	// $tit= 标题名称； $con= 标题描述； $type= 标题类型（1=活动、2=专题）； $price= 金币池； $reward= 奖金； $days= 有效时间
	protected function event_addNewTitle( $tit='', $con='', $type=0, $price=0, $reward=0, $days=0){
		if( $tit != '' && $con != '' ){			//判断是否有参数
			$u = new Users();
			if($price +$reward < $u -> Gplus()){	//判断余额是否足够
				if( $type == 2 ){				//如果是专题类型，则刷新参数
					$price 	= 100;
					$reward = 0;
					$duration = time();
				}else{
					$duration = strtotime("+".$days." day");		//到期的时间戳
				}
				$o = new Tool();
				$con = $o -> Chtml($con);	//编译
				$tid = $u -> Gid().time();	//标题自定义 ID(*重要参数)
				$this -> event_addUserFollowTit($tid);		//关注用户自己创建的标题
				parent::data_createNew($u -> Guid(), $tid, $tit, $con, $price, $duration, $reward, $type );	//提交数据
				return $tid;
			}
		}
	}

	//添加指定 用户ID（选填，默认为登录用户） 关注指定的 标题ID
	protected function event_addUserFollowTit( $tid=0, $uid=0 ){
		if($tid){
			$uid = $uid ? $uid : parent::Eid();
			return parent::data_addUserFollowTit( $uid, $tid );
		}
	}


	//添加指定 用户UID 投资指定 标题ID 的金额NUM
	protected function event_addUserInvestTit( $tid=0, $uid=0, $num=0 ){
		if($tid && $num){
			return parent::data_addUserInvestTit( $uid, $tid, $num );
		}
	}




	/********************************************
	* 删除
	*/

	//删除指定 用户UID 指定的 标题ID
	protected function event_deleteFollowTit( $uid=0, $tid=0 ){
		if($uid && $tid){
			return parent::data_deleteFollowTit($uid, $tid);
		}
	}


	/********************************************
	* 更新
	*/

	//更新指定 标题ID 的单次分享金
	// protected function event_reviseShareglod($tid){
	// 	return parent::data_titleSetShareglod( $tid=0, $shareglod=0 ,$depict='' ,$price=0 );
	// }

	//更新参数 结束标题，返回金池数量
	protected function event_EndTit($tid=0){
		$this -> event_updateStatus($tid, 3);	//修改标题状态为 已经结束：3
		$u = new Users();
		$u -> UAplus($this -> event_getReward($tid), $this -> event_getFirst($tid));		//给获胜者奖金
		$u -> UAplus($this -> event_getPrice($tid));		//将金池全部返还给创建者
		return $this -> event_getPrice($tid);
	}

	//更新参数 管理标题
	protected function event_titleAdmin( $tid=0, $shareglod=0 ,$depict='' ,$append=0, $withholding=0, $scale=0 ){

		//修改管理员
		// if( isset($_POST['adminId']) ){
		// 	return data_titleSetAdmin( $tid, $_POST['adminId'] );
		// }
		$info = $this -> event_getInfo($tid);

		if($shareglod && $shareglod != $info['shareglod']) {
			parent::data_update( $tid, 'shareglod',$shareglod );	//修改 分享金
		}
		if($depict) {
			$this -> event_updateContent( $tid, $depict );			//修改 描述
		}
		if($withholding && withholding != $info['withholding']){
			$this -> event_updateWithholding($tid, $withholding);	//修改代扣
		}
		$u = new Users();
		if($append && $u -> Gplus() >= $append ){	//个人余额是否充足	
			$glod = $this -> event_getPrice($tid);	//获取标题当前的金池数量
			parent::data_update( $tid, 'price', $glod +$append );		//注入金币池
			$u -> USplus($append);		//扣除用户的余额		
		}
		if($scale && $scale != $info['invest']){
			parent::data_update( $tid, 'invest', $scale );	//修改 金池共享比例
		}
	}

	//更新指定 标题ID 的金币池
	protected function event_updatePrice($tid=0, $num=0){
		if($tid){
			parent::data_update($tid, 'price', $num);
			return $num;
		}
	}

	//更新指定 标题ID 的 描述STR（选填，默认设置为空）
	protected function event_updateContent($tid=0, $str=''){
		if($tid){
			return parent::data_update($tid, 'content', $str);
		}
	}

	//更新指定 标题ID 的内容总数量 参数NUM
	protected function event_updateNumber($tid=0, $num=0){
		if($tid && $num){
			return parent::data_update($tid, 'number', $num);
		}
	}

	//更新指定 标题ID 的内容购买 次数NUM
	protected function event_updateClick($tid=0, $num=0){
		if($tid && $num){
			return parent::data_update($tid, 'click', $num);
		}
	}

	//更新指定 标题ID 的最近使用时间
	protected function event_updateUseTime($tid=0){
		if($tid){
			date_default_timezone_set('PRC');
			return parent::data_update($tid, 'useTime', time());
		}
	}

	//更新指定 标题ID 的维护时间
	protected function event_updateDurationTime($tid=0, $time=0){
		if($tid){
			date_default_timezone_set('PRC');
			return parent::data_update($tid, 'duration', $time ? $time : time());
		}
	}

	//更新指定 标题TID 的 状态VAL（选填，0=未审核；1=正常（默认）；2=未通过；3=关闭）
	protected function event_updateStatus($tid=0, $val=1){
		if($tid){
			return parent::data_update($tid, 'start', $val);
		}
	}

	//更新指定 标题ID 的指定 获胜者UID
	protected function event_updateFirsrUser($tid=0, $uid=0){
		if($tid && $uid){
			date_default_timezone_set('PRC');
			return parent::data_update($tid, 'first', $uid);
		}
	}

	//更新指定 标题TID 是否VAL（选填，0=否（默认）；1=是） 开启余额代扣
	protected function event_updateWithholding($tid=0, $val=0){
		if($tid){
			return parent::data_update($tid, 'withholding', $val);
		}
	}

	//更新指定 用户UID 投资的指定 标题TID 的金额NUM
	protected function event_updateUserInvest($tid=0, $uid=0, $num=0){
		if($tid && $num){
			return parent::data_updateInvest($tid, $uid, $num);
		}
	}


}






















/********************************************************************************************
* 输出层 		#主要负责判断返回值
*/
class Title extends Event_title
{
	
	/********************************************
	* 获取 get
	*/

	//获取 标题列表
	public function Glist($begin=0, $pages=0, $type=0, $grade=0){
		return parent::event_get($begin, $pages, $type, $grade);
	}

	//获取指定 用户(UID)（选填，默认为当前登录用户） 创建的 标题列表 
	public function GUlist($uid=0, $begin=0, $pages=15){
		return parent::event_getUserList($uid, $begin, $pages);
	}

	//获取指定 用户(UID)（选填，默认为当前登录用户） 关注的所有的 标题列表，选择是否显示指定 用户（默认为登录用户）的PASS（默认为是） 标题
	public function GUFlist($pass=0, $uid=0){
		return parent::event_getUserFollowList($uid, $pass);
	}

	//获取指定 用户(UID)（选填，默认为当前登录用户） 所有能使用的 标题列表（关注的及创建的活动，和个人专题）
	public function GUFAlist($uid=0){
		return parent::event_getUsableList($uid);
	}

	//获取指定 标题ID 的内容，的前三条
	public function GTlist($tid){
		$c = new Content();
		return $c -> Glist(0, 3, $tid);
	}

	//获取指定 标题ID 的全部参数
	public function Ginfo($tid=0){
		if($tid){
			return parent::data_selectById($tid);
		}
	}

	//获取指定 标题ID 的内容总数
	public function GTCcount($tid=0){
		if($tid){
			return parent::event_getTitConTotal($tid);
		}
	}

	//获取指定 标题ID 的金池
	public function Gprice($tid=0){
		$num = 0;
		if($tid){
			$num = parent::event_getPrice($tid);
		}
		return $num < 0 ? 0 : $num;
	}

	//获取指定 标题ID 的分享金
	public function Gshare($tid=0){
		if($tid){
			return parent::event_getSharegold($tid);
		}
	}
	
	//获取指定 标题TID 的生效时间
	public function GUtime($tid=0){
		return parent::event_getUseTime($tid);
	}
	
	//获取指定 活动标题ID 的剩余日期
	public function Gsurplus($tid=0){
		if($tid){
			if(parent::event_getType($tid) == 1){	//必须为活动标题
				$end = parent::event_getDuration($tid);
				$current = time();
				if( $end <= $current){
					$time = "已结束";
				}else{
					$time = round(($end -$current)/60);
					if( $time <= 60 ){
						$time = $time .'分钟';
					}elseif( $time/60 <= 24 ){
						$time = round($time/60).'小时';
					}else{
						$time = round($time/60/24) .'天';
					}
				}
				return $time;
			}
		}
	}

	//获取指定 标题ID 剩余自动关闭时间戳
	public function GCtime($tid=0){
		date_default_timezone_set('PRC');
		$end = parent::event_getDuration($tid);
		$day = strtotime('+1day') -strtotime('now');
		$off = $end + $day*3 - strtotime('now');
		return $off < 0 ? 0 : $off;
	}

	//获取指定 标题TID 的得分最高的用户UID
	public function Gfirst($tid=0){
		return parent::event_getMaxPlusUid($tid);
	}

	//获取指定 标题TID 的标题
	public function Gtitle($tid=0){
		return parent::event_getTitle($tid);
	}

	//获取指定 标题TID 的描述
	public function Gcontent($tid=0){
		return parent::event_getContent($tid);
	}

	//获取指定 标题TID 的创建者ID
	public function Gcreator($tid=0){
		return parent::event_getCreator($tid);
	}

	//获取指定 标题TID 的奖金
	public function Greward($tid=0){
		return parent::event_getReward($tid);
	}

	//获取指定 标题TID 是否开启金池余额代扣
	public function GIhelp($tid=0){
		return parent::event_getWithholding($tid) == 2;
	}

	//获取指定 标题TID 的类型，可以选择方式TYPE（选填，0= 返回文字；1= 类型ID）
	public function Gtype($tid=0, $type=0){
		if($tid){
			$typeid = parent::event_getType($tid);
			if($type){
				$value = $typeid;
			}else{
				if( $typeid == 1 ){
					$value = '活动';
				}else{
					$value = '专题';
				}
			}
		}
		return $value;
	}

	//获取指定 专题标题TID 应该扣的维护费
	public function Gcost($tid=0){
		$val = 0;
		if($tid){
			if($this -> Itype($tid, 2)){	//是否为专题
				$time = parent::event_getDuration($tid);
				$last = strtotime(date('Y', $time).'-'.date('m', $time).'-'.date('d', $time));
				$val = intval((strtotime(date('Y-m-d')) -$last)/60/60/24) *100;
			}
		}
		return $val;
	}

	//获取指定 标题TID 的最高金额内容CID
	public function GFcid($tid=0){
		return parent::event_getPlusMax($tid);
	}

	//获取指定 标题TID 的关注人数
	public function GFtotal($tid=0){
		return parent::event_getFollowTotal($tid);
	}

	//获取指定 用户UID 投资指定 标题ID 的信息
	public function GUinvest($tid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::event_getUserInvest($uid, $tid);
	}

	//获取指定 标题ID 的总投资金额
	public function GTIsum($tid=0){
		return parent::event_getTitleInvestSum($tid);
	}



	/********************************************
	* 判断 is
	*/

	//判断指定 用户(UID)（选填，默认为当前登录用户） 是否有拥有的 自己创建的标题
	public function IUThas($uid=0){
		return count(parent::event_getUserList($uid)) > 0;
	}

	//判断指定 用户(UID)（选填） 是否关注的有 任何标题，选择是否包含 用户自己创建的，默认为是
	public function IHfollow($pass=0, $uid=0){
		return count(parent::event_getUserFollowList($uid, $pass)) > 0;
	}

	//判断指定 用户(UID)（选填） 是否有可使用的 标题
	public function IATfollow($uid=0){
		return count(parent::event_getUsableList($uid)) > 0;
	}

	//判断指定 用户UID 是否可以关注指定 标题TID
	public function Ifollow($tid=0, $uid=0){
		if($tid){
			return !!parent::event_getUserFollowerTime($tid, $uid);	
		}
	}

	//判断指定 用户UID（选填） 是否为指定 标题TID 的创建者
	public function Icreator($tid=0, $uid=0){
		if($tid){
			$uid = $uid ? $uid : parent::Eid();
			return parent::event_getCreator($tid) == $uid;	
		}
	}

	//判断指定 标题ID 的类型，类型参数ID（选填）。1=活动（默认），2=专题
	public function Itype($tid=0, $type=1){
		if($tid){
			$source = parent::event_getType($tid);
			return $source == $type;
		}
	}

	//判断是否有被使用
	public function Iuse(){
		return count(parent::event_get());
	}

	//判断指定 标题TID 是否有内容
	public function Icon($tid=0){
		if($tid){
			return parent::event_getTitConTotal($tid);
		}
	}

	//判断指定 标题ID 是否属于活动
	public function Iact($tid){
		return $this->Itype($tid);
	}

	//判断标题分类根据 类型ID 返回对应类型文字
	public function ITval($typeid){
		$value = '';
		if( $typeid == 1 ){
			$value = '活动';
		}else{
			$value = '专题';
		}
		return $value;
	}

	//判断指定 标题ID 是处于未审核状态
	public function Ipass($tid=0){
		if($tid){
			return parent::event_getStart($tid) == 0;
		}
	}

	//判断指定 标题ID 是处于可使用状态
	public function Inormal($tid=0){
		if($tid){
			return parent::event_getStart($tid) == 1;
		}
	}

	//判断指定 标题ID 是否处于未通过审核状态
	public function Ifail($tid=0){
		if($tid){
			return parent::event_getStart($tid) == 3;
		}
	}

	//判断指定 活动标题ID 是否为已经结束了的活动
	public function IOact($tid=0){
		if($tid){
			if($this -> Itype($tid)){	//是否为活动
				return parent::event_getDuration($tid) <= time();	
			}
		}
	}

	//判断指定 活动标题ID 是否为有效时间内
	public function INact($tid=0){
		$val = 0;
		if($tid){
			if($this -> Itype($tid)){	//是否为活动
				$val = parent::event_getDuration($tid) > time();
			}
		}
		return $val;
	}

	//判断指定 专题标题TID 是否逾期超过三天
	public function ISnormal($tid=0){
		if($tid){
			if($this -> Itype($tid, 2)){	//是否为专题
				$time = parent::event_getDuration($tid);
				$last = strtotime(date('Y', $time).'-'.date('m', $time).'-'.date('d', $time));
				return intval((strtotime(date('Y-m-d')) -$last)/60/60/24) *100 < $this -> Gprice($tid);
			}
		}
	}

	//判断指定 专题标题TID 是否能够支付 维护费，返回 true=能，false=不能
	public function IWpay($tid=0){
		$val = 0;
		if($tid){
			if($this -> Itype($tid, 2)){		//必须为专题
				if($this -> GIhelp($tid)){		//如果开启了代付
					$u = new Users();
					if($this -> Gcost($tid) <= ($u -> Gplus() + $this -> Gprice($tid))){	//如果拥有的金额能够支付
						$val = 1;
					}
				}else{							//如果没有开启
					if($this -> Gcost($tid) <= $this -> Gprice($tid)){
						$val = 1;
					}
				}
			}
		}
		return $val;
	}

	//判断指定 标题TID 是否能够支付分享金
	public function IPSgold($tid=0){
		$value = 0;
		if($tid){				
			$price = $this -> Gprice($tid);
			$share = $this -> Gshare($tid);
			if($price >= $share){			//如果金币池还有金币的话
				$value = 1;
			}
		}
		return $value;
	}

	//判断指定 标题TID 的创建者是否能支付代付
	public function IPFanother($tid=0){
		$value = 0;
		if($tid){				
			if($this -> GIhelp($tid)){
				$share = $this -> Gshare($tid);
				$u = new Users();
				if($u -> Gplus($this -> Gcreator($tid)) >= $share){		//创建者余额足够
					$value = 1;
				}
			}
		}
		return $value;
	}

	//判断指定 标题TID 的创建者是否能支付代付
	public function IUinvest($tid=0, $uid=0){
		$value = 0;
		$uid = $uid ? $uid : parent::Eid();
		if($tid){
			$value = parent::event_getUserInvest($uid, $tid);
		}
		return $value;
	}
	



	/********************************************
	* 添加 add
	*/

	//添加新标题 提交表单
	public function Atit( $tit='', $con='', $type=0, $gold=0, $award=0, $days=0){
		if( $tit !=  '' && $con != '' ){
			$tid = parent::event_addNewTitle( $tit, $con, $type, $gold, $award, $days);
			if($tid){
				$u = new Users();
				$u -> UtoL('userTitle-Apply.php?ok='.$tid);
			}
		}
	}

	//添加指定 用户ID 关注指定 标题TID
	public function Afollow( $tid=0, $uid=0){
		if($tid){
			return parent::event_addUserFollowTit( $tid, $uid );
		}
	}





	/********************************************
	* 删除 delete
	*/

	//删除指定 用户UID 关注的指定 标题TID 
	
	public function Dfollow($tid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::event_deleteFollowTit($uid, $tid);
	}



	/********************************************
	* 更新 updata
	*/

	//更新指定 标题 参数
	public function Utit( $tid=0, $shareglod=0, $depict='', $append=0, $withholding=0, $scale=0 ){
		if($tid){
			return parent::event_titleAdmin( $tid, $shareglod, $depict, $append, $withholding, $scale );
		}
	}

	//更新指定 标题ID 的内容 参数NUM（选填，默认为 +1）
	public function Unum($tid=0, $num=0){
		$num = $num ? $num : 1;
		if($tid){
			return parent::event_updateNumber( $tid, parent::event_getNumber($tid) +$num );
		}
	}

	//更新指定 标题ID 的购买 次数NUM（选填，默认为 +1）
	public function Ubuy($tid=0, $num=1){
		if($tid){
			return parent::event_updateClick( $tid, parent::event_getNumber($tid) +$num );
		}
	}

	//更新指定 标题ID 的金池，添加指定 数量NUM（选填，默认为 1）
	public function UAda($tid=0, $num=1){
		if($tid && $num){
			return parent::event_updatePrice( $tid, parent::event_getPrice($tid) +$num );
		}
	}

	//更新指定 标题ID 的金池，扣除指定 数量NUM（选填，默认为全扣），返回扣除的数量
	public function USda($tid=0, $num=0){
		if($tid){
			$num = $num ? $num : parent::event_getPrice($tid);
			parent::event_updatePrice( $tid, parent::event_getPrice($tid) -$num );
			return $num;
		}
	}

	//更新指定 标题ID 的金池，扣除指定分享金
	public function Ushare($tid=0){
		if($tid){
			$price = parent::event_getPrice($tid);
			$share = parent::event_getSharegold($tid);
			if($price >= $share){
				return parent::event_updatePrice($tid, $price -$share);
			}
		}
	}

	//更新指定 标题ID 的最近使用时间
	public function UUtime($tid=0){
		if($tid){
			return parent::event_updateUseTime( $tid);
		}
	}

	//更新指定 专题标题ID 的维护时间
	public function UMtime($tid=0, $time=0){
		$val = 0;
		if($tid && $this -> Itype($tid, 2)){
			$val = parent::event_updateDurationTime($tid, $time);
		}
		return $val;
	}

	//更新指定 专题标题TID 扣除维护费，返回值，是否维护成功
	public function USMcharges($tid=0){
		$value = 0;
		if($tid){
			if($this-> Itype($tid, 2) && $this -> Gcost($tid) > 0){	//判断是否需要交纳维护费
				if($this -> Gcost($tid) <= $this -> Gprice($tid)){	//如果金池是否足够交纳
					$this -> USda($tid, $this -> Gcost($tid));		//则从金池直接扣除
					$this -> UMtime($tid);							//并刷新标题的维护时间
					$value = 1;
					
				}else{											//如果金池金额不足
					$u = new Users();
					if($this -> GIhelp($tid) && $this -> Gprice($tid) + $u -> Gplus() >= $this -> Gcost($tid)){ 	//如果开了代扣，且钱够
						$u -> USplus($this -> Gcost($tid) - $this -> USda($tid));		//则金池扣完后，余额付剩余部分
						$this -> UMtime($tid);											//并刷新标题的维护时间
						$value = 1;
					}
				}
			}
		}
		return $value;
	}

	//更新指定 标题TID 的 获得者UID
	public function Ufirst($tid=0, $uid=0){
		if($tid && $uid){
			return parent::event_updateFirsrUser($tid, $uid);
		}
	}

	//更新指定 标题TID 为关闭
	public function Uclose($tid=0){
		return parent::event_EndTit($tid);
	}

	//更新指定 用户UID 投资的指定 标题TID 的金额NUM
	public function Uinvest($tid=0 ,$num=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($tid && $num){
			if(!!parent::event_getUserInvest($uid, $tid)){
				$info = parent::event_getUserInvest($uid, $tid);
				$this -> UAda($tid, $num);		//刷新标题金池
				return parent::event_updateUserInvest($tid, $uid, $num + $info['sum']);	//如果用户已经投资则修改金额
			}else{
				return parent::event_addUserInvestTit($tid, $uid, $num);	//如果用户没有投资过则创建新数据
			}
		}
	} 

	
	
}


	
//初始化全局变量
$title = new Title();
$t = new Title();



?>