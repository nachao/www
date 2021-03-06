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


	//创建私有变量
	private $titleId;


	/********************************************
	* 添加
	*/

	//添加指定 用户UID 的访问记录
	protected function data_addvisitorLogs($uid=0, $fuid=0){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."logs_Visitor` (`id` , `uid` , `fuid` , `time` ) VALUES (NULL ,  '".$uid."', '".$fuid."', '".$time()."' );";
		return mysql_query($sql);
	}

	//添加指定 用户UID 关注指定 用户FID
	protected function data_addFollower($uid=0, $fuid=0){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."logs_FollowUser` (`id` , `time` , `uid`, `fuid` ) VALUES (NULL , ".time().", ".$uid.", ".$fuid.");";
		return mysql_query($sql);
	}

	//添加指定 用户UID 的留言记录
	// 参数：$muid= 留言板拥有者UID； $con= 留言内容； $uid= 留言编写者UID； $huid= 回复对象UID, $from= 留言出自哪； $type= 0：留言板、n：对应的内容留言 
	// protected function data_addMessage($muid=0, $con='', $uid=0, $huid=0, $from=0, $type=0){
	// 	$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."zzzzzzzzzzzzzz_message_".$muid."` (`id` ,`content` ,`lastdate`, `huifumid`, `userid`, `originate`, `type`)VALUES (NULL , '".$con."', '".time()."', '".$huid."', '".$uid."', '".$from."', ".$type.");";
	// 	return mysql_query($sql);
	// }

	//添加指定 用户UID 的徽章记录
	protected function data_addBadge($uid=0, $bid=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."special_use` (`id`, `uid`, `sid`, `time`, `receive`) VALUES ('null', '".$uid."', '".$bid."', '".time()."');";
		return mysql_query($sql);
	}

	//激活码 --添加 激活码CDK 
	protected function data_addCdk($cdk=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."cdk` (`id`, `cdk`, `time`, `uid`, `status`) VALUES (NULL, '".$cdk."', '0', NULL, '1');"; 
		return mysql_query($sql);
	}

	//反馈 --添加反馈信息
	protected function data_addFeedback($uid=0, $txt=''){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."feedback` (`id`, `uid`, `time`, `content`) VALUES (NULL, '".$uid."', '".time()."', '".$txt."');";
		return mysql_query($sql);
	}


	//添加用户金额记录
	protected function data_addSumLog($in_uid=0, $out_uid=0, $source='-', $source_id=0, $types=1, $sum=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."logs_purchase` (`id`, `time`, `in_uid`, `out_uid`, `source`, `source_id`, `types`, `sum`) VALUES (NULL, '".time()."', '".$in_uid."', '".$out_uid."', '".$source."', '".$source_id."', '".$types."', '".$sum."');";
		return mysql_query($sql);
	}
 
	//创建新用户
	protected function data_addUser( $invited =0, $account ='', $pwd ='', $ip ='' ){
		// $sql = "insert into `".parent::Mn()."`.`".parent::Fn()."user` (`id` ,`uid` , `name`, `pwd`, `icon`, `lastdate`, `lastact`, `register_ip`, `register_time`, `invited`) values('',".$uid." ,'".$name."', '".$pwd."', '".$ico."', '".(time()-10000)."', '0', '".$ip."', '".time()."', '".$invited."')";
		// return mysql_query($sql);

		$sql = "insert INTO `ux73`.`ux73_main_user` (".
				"`id_uid`, `id_invited`, `text_account`, `text_pwd`, `text_register_ip`, `time_lastdate`, `time_lastskip`, `time_register`) VALUES (".
				"NULL, '".$invited."', '".$account."', '".$pwd."', '".$ip."', '".time()."', '".time()."', '".time()."')";
		return mysql_query($sql);
	}



	/********************************************
	* 删除
	*/

	//删除指定 用户UID 的关注用户数据里的指定 用户FID
	protected function data_deleteFollower($uid=0, $fid=0){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."logs_FollowUser` WHERE `".parent::Fn()."logs_FollowUser`.`uid` = ".$uid." AND `".parent::Fn()."logs_FollowUser`.`fuid` = ".$fid." LIMIT 1;";
		return mysql_query($sql);
	}
	

	/********************************************
	* 查询
	*/
	
	//获取当前用户的全部信息，根据ID
	protected function data_selectByUid( $uid =0, $visitor =1 ) {
		$sql = "select * FROM  `ux73_main_user` WHERE  `id_uid` = ".$uid." AND `status_visitor` =".$visitor;
		return parent::Ais($sql);
	}

	//获取指定 用户ID 是否关注过指定 标题ID
	protected function data_followTitleIs( $uid, $tid ){
		$sql = "select COUNT(*) FROM  `".parent::Fn()."zzzzzzzzzzzzzz_title_".$uid."` WHERE  `titleId` ='".$tid."' LIMIT 1";
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取指定 用户UID 当天的发布次数
	protected function data_userContentToadyNums($uid=0){
		$sql = "select COUNT(*) FROM  `".parent::Fn()."content` WHERE  `userid` =".$uid." AND  `base` >".mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取指定 排序方式TYPE（选，默认排序金额） 的用户列表
	protected function data_selectDigg($begin=0 ,$page=0, $type='plus'){
		$page = $page ? $page : 30;
		$sql = "select * FROM  `".parent::Fn()."user` ORDER BY  `".$type."` DESC LIMIT ".$begin." , ".$page;
		return mysql_query($sql);
	}

	//获取指定 排序方式TYPE（选，默认排序最近登录时间） 的用户关注的列表
	protected function data_selectFollow($uid=0, $begin=0 ,$page=0, $type='lastdate'){
		$page = $page ? $page : 99;
		$sql = "select `f`.* FROM `".parent::Fn()."logs_followuser` as `f`, `".parent::Fn()."user` as `u` WHERE `f`.`uid` = ".$uid." AND `f`.`fuid` = `u`.`uid` group by `f`.`fuid` ORDER BY `u`.`".$type."`  DESC LIMIT ".$begin." ,".$page;
		return mysql_query($sql);
	}

	//获取指定 用户UID 的关注用户表里的指定一位 用户FID
	protected function data_selectFollowUser($uid=0 ,$fuid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_FollowUser` WHERE `uid` = ".$uid." AND `fuid` =".$fuid." LIMIT 0 , 1";
		return parent::Ais($sql);
	}

	//获取指定 账号ACCOUNT 的用户信息
	protected function data_selectByAccount( $account='' ){
		$sql = "select * FROM  `ux73_main_user` WHERE  `text_account` LIKE  '".$account."'";
		$query = mysql_query($sql);
		return mysql_fetch_array($query);
	}

	//获取指定 用户名NAME 的用户信息
	protected function data_selectByName($name=''){
		$sql = "select * FROM  `".parent::Fn()."user` WHERE  `name` LIKE  '".$name."'";
		return parent::Ais($sql);
	}

	//获取指定 用户IP 当前注册的账号
	protected function data_selectGetIp( $ip=0, $time=0){
		$sql = "select * FROM  `".parent::Fn()."user` WHERE  `register_ip` =  '".$ip."' AND  `register_time` >=".$time." LIMIT 0 , 30";
		return mysql_query($sql);
	}

	//获取用户总数量
	protected function data_userTotal(){
		$sql = "select COUNT(*) FROM  `".parent::Fn()."user` WHERE 1"; 
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取最新用户的ID
	protected function data_selectNewUid(){
		$sql = "select `id` FROM  `".parent::Fn()."user` ORDER BY  `id` DESC  LIMIT 0 , 1";
		$row = parent::Ais($sql);
	}

	//获取用户的 最近访客
	protected function data_selectVisitorLogs($uid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_Visitor` WHERE `uid` =".$uid." ORDER BY  `time` DESC LIMIT 0 , 8";
		return mysql_query($sql);
	}

	//获取指定 用户UID 的邀请人数
	protected function data_selectInviteTotal($uid=0){
		$sql = "select COUNT(*) FROM  `".parent::Fn()."user` WHERE `invited` = ".$uid." ;"; 
		$row = parent::Ais($sql);
		return $row[0];
	}	

	//激活码 --获取指定 激活码CDK 信息
	protected function data_selectCdk($cdk=0){
		$sql = "select * FROM  `".parent::Fn()."cdk` WHERE `cdk` = '".$cdk."';"; 
		return parent::Ais($sql);
	}

	//激活码 --获取当前所有 激活码CDK 信息
	protected function data_selectCdkAll(){
		$sql = "select * FROM  `".parent::Fn()."cdk` ;"; 
		return mysql_query($sql);
	}

	//获取指定 用户UID 的指定 时间段TIME(一天) 内容的指定 类型TYPE 的变动总金额
	protected function data_selectSumlog($uid=0, $start=0, $end=0, $type=0){
		$sql = "select sum(`sum`) FROM  `".parent::Fn()."logs_purchase` WHERE  `time` > ".$start." AND `time` < ".$end." AND ";
		if($type){
			$sql = $sql." `in_uid` = ".$uid." AND `types` = ".$type." LIMIT 1";		//收入
		}else{	
			$sql = $sql." `out_uid` = ".$uid." AND `types` = ".$type." LIMIT 1";	//支出
		}
		$row = parent::Ais($sql);
		return $row[0] ? $row[0] : 0;
	}

	//获取指定 用户UID 的支出指定 类型TYPE 的总数量
	protected function data_selectPurchaseSum($uid=0, $source='cid'){
		$sql = "select count(`id`)  FROM `".parent::Fn()."logs_purchase` WHERE `out_uid` = ".$uid." AND  `source` LIKE  '".$source."'";
		$row = parent::Ais($sql);
		return $row[0];
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户UID 的指定 字段VAL 的 参数NUM
	protected function data_update($uid=0, $val='', $num=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."user` SET  `".$val."` =  '".$num."' WHERE  `".parent::Fn()."user`.`uid` =".$uid;
		return mysql_query($sql);
	}

	//刷新用户的金币数量
	protected function data_userPlusSet($uid=0, $num=0 ){
		if( $num < 0 ){
			$val = 0;
		}
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."user` SET  `plus` =  '".$num."' WHERE  `".parent::Fn()."user`.`uid` =".$uid;
		return mysql_query($sql);
	}

	//激活码 --刷新指定 激活码cdk 的信息
	protected function data_updateCdk($cdk=0, $uid=0){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."cdk` SET  `time` =  '".time()."', `uid` =  '".$uid."', `status` =  '0' WHERE  `".parent::Fn()."cdk`.`cdk` ='".$cdk."';";
		return mysql_query($sql);
	}


}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user extends Data_user
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

	//根据缓存判断是否有登录
	protected function event_uis(){
		// echo $this -> cookieName;
		return isset($_COOKIE["73userid"]);
	}

	//根据缓存获取用户 ID
	protected function event_uid(){
		$uid = '0';
		if ( $this -> event_uis() ) {
			$uid = $_COOKIE[self::CN];
		}
		if ( !$uid && isset($_COOKIE['73visitor']) ) {
			$uid = $_COOKIE['73visitor'];
			$uid = str_replace(':', '', $uid);	
		}
		if ( !$uid ) {
			$uid = '-1';
		}
		return $uid;
	}

	//获取用户信息
	protected function event_get($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$info = parent::data_selectByUid($uid, 1);
		$this -> info = $info;
		return $info;
	}

	//获取用户信息
	protected function event_getById($uid=0){
		return parent::data_selectByUid($uid);
	}

	//获取指定 用户UID 的全部信息
	protected function event_getInfo($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_selectByUid($uid, 1);
	}

	//获取 用户名 根据 用户ID（）
	protected function event_getName($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$info = $this -> event_get($uid);
		return $info['name'];
	}

	//根据用户 id 获取用户头像
	protected function event_getIcon($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$user = parent::data_selectByUid( $uid );
		return $user['icon'];
	}

	//根据用户 id 获取用余额
	protected function event_getA( $id ){
		if( $id ){
			$user = parent::data_selectByUid( $id );
			return $user['plus'];
		}
	}

	//根据用户 id 获取用户邮箱
	protected function event_getEmail( $id ){
		if( $id ){
			$user = parent::data_selectByUid( $id );
			return $user['email'];
		}
	}

	//根据 用户uid 获取用户邮箱
	protected function event_getId($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$user = parent::data_selectByUid($uid);
		return $user['id'];
	}

	//根据 用户UID（选填，默认登录用户） 获取用户的vip时间戳
	protected function event_getVip($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$user = parent::data_selectByUid($uid);
		return $user['vip'];
	}

	//获取指定 用户UID（选填）当天的发布次数
	protected function event_userContentToadyNums($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_userContentToadyNums($uid);
	}

	//获取指定 用户UID（选填）的发布总量
	protected function event_getIssue($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$user = parent::data_selectByUid($uid);
		return $user['issue'];
	}

	//获取用户的金额排行列表
	protected function event_getPlusDigg($begin=0 ,$page=0){
		$query = parent::data_selectDigg($begin ,$page);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;	//返回
	}


	//获取指定 排序方式TYPE（选，默认排序最近登录时间） 的用户关注的列表
	protected function event_selectFollow($uid=0, $begin=0 ,$page=0 ){
		$uid = $uid ? $uid : $this -> event_uid();
		$query = parent::data_selectFollow($uid, $begin, $page);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;	//返回
	}

	//获取指定 用户UID 的关注用户表里的指定一位 用户FID 的全部信息
	protected function event_selectFollowUser($uid=0 ,$fid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($fid){
			return parent::data_selectFollowUser($uid ,$fid);
		}
	}

	//获取指定 用户名NAME 的用户信息
	protected function event_getByName($name=''){
		if($name){
			return parent::data_selectByName($name);
		}
	}

	//获取指定时间内 指定IP的注册数量
	protected function event_getIpNum($ip=0, $time=0){
		if($ip && $time){
			return mysql_num_rows(parent::data_selectGetIp($ip, $time));
		}
	}

	//获取当前用户总数量
	protected function event_getUserTotal(){
		return parent::data_userTotal();
	}

	//获取最新用户的ID
	protected function event_getNewUid(){
		return parent::data_selectNewUid();
	}

	//获取指定 用户UID 的邀请人数
	protected function event_getInviteNum($uid=0){
		if($uid){
			return parent::data_selectInviteTotal($uid);
		}
	}

	//获取指定 用户UID 的访问记录
	protected function event_getVisitorLogs($uid=0){
		$array = array();
		$query = parent::data_selectVisitorLogs($uid);
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取随机头像
	protected function event_getRandomIcon(){
		return '../icon/'.rand(1,26).'.jpg';
	}

	//激活码 --获取指定 激活码CDK 信息
	protected function event_getCdk($cdk=0){
		return parent::data_selectCdk($cdk);
	}

	//激活码 --获取当前所有 激活码CDK 信息
	protected function event_getCdkAll(){
		$array = array();
		$query = parent::data_selectCdkAll();
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

	//刷新指定 用户ID（选填，默认为登录用户） 的 数量NUM 金币
	protected function event_updatePlus($num=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		$uv = new Users_visitor();
		if($num >= 0){
			//如果是游客
			// if ( !$this -> Is() ) {
			// 	return $uv -> Usum($uid, $num);
			// }
			parent::data_update($uid, 'plus', $num);
			return $num;
		}
	}

	//刷新指定 用户ID（选填） 的 发布量NUM
	protected function event_updateIssue($num=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($num >= 0){
			parent::data_update($uid, 'issue', $num);
		}
	}

	//刷新指定 用户ID（选填） 的 点评量NUM
	protected function event_updateComments($num=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($num >= 0){
			return parent::data_update($uid, 'comments', $num);
		}
	}

	//刷新指定 用户ID（选填） 的最近发布时间
	protected function event_updateRecentlyUseTime($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_update($uid, 'lastact', time());
	}

	//刷新指定 用户ID（选填） 的最近访问留言
	protected function event_updateNewMessage($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_update($uid, 'newMessage', time());
	}

	//刷新指定 用户ID（选填） 的最近登录时间
	protected function event_updateLastdate($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_update($uid, 'lastdate', time());
	}

	//刷新指定 用户ID（选填） 的会员信息
	protected function event_updateVip($time=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($time){
			return parent::data_update($uid, 'vip', $time);
		}
	}

	//刷新指定 用户ID（选填） 的描述
	protected function event_updateDescribe( $uid=0, $txt=''){
		$uid = $uid ? $uid : $this -> event_uid();
		if($txt){
			return parent::data_update($uid, 'describe', $txt);
		}
	}

	//刷新指定 用户ID（选填） 的密码
	protected function event_updatePwd( $uid=0, $pwd=''){
		$uid = $uid ? $uid : $this -> event_uid();
		if($pwd){
			return parent::data_update($uid, 'pwd', md5($pwd));
		}
	}

	//刷新指定 用户ID（选填） 的头像
	protected function event_updateIcon( $uid=0, $icon=''){
		$uid = $uid ? $uid : $this -> event_uid();
		if($icon){
			return parent::data_update($uid, 'icon', $icon);
		}
	}

	//刷新指定 用户UID 领取指定 徽章SID 的领取时间
	protected function data_updateReceive($sid=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($sid){
			return parent::data_updateReceive($uid, $sid);
		}
	}

	//激活码 --刷新指定 激活码cdk 的信息
	protected function event_updateCdk($cdk=0, $uid=0){
		return parent::data_updateCdk($cdk, $uid);
	}



	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID 关注指定 用户FID
	protected function event_addFollower($fid=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($fid){
			return parent::data_addFollower($uid, $fid);
		}
	}

	//添加指定 用户UID 的留言
	// protected function event_addMessage($muid=0, $con='', $uid=0, $huid=0, $form=0 , $type=0 ){
	// 	parent::data_addMessage( $muid, $con, $uid, $huid, $form, $type);
	// }

	//添加指定 用户UID 的徽章记录
	// protected function event_addBadge($bid=0, $uid=0){
	// 	$uid = $uid ? $uid : $this -> event_uid();
	// 	if($bid){
	// 		parent::data_addBadge($uid, $bid);
	// 	}
	// }

	//注册用户
	protected function event_addUser($uid=0, $account='', $password='', $icon='', $invited=0, $ip=0){
		parent::data_addUser($uid, $account, $password, $icon, $invited, $ip);		//添加此新增用户至数据库
		return $uid;
	}

	//激活码 --添加 激活码CDK 
	protected function event_addCdk($cdk){
		return parent::data_addCdk($cdk);
	}

	//反馈 --添加 反馈 
	protected function event_addFeedback($uid=0, $txt=''){
		if($txt){
			return parent::data_addFeedback($uid, $txt);
		}
	}




	/********************************************
	* 删除 delete
	*/

	//删除指定 用户UID 关注指定 用户FID
	protected function event_deleteFollower($fid=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($fid){
			return parent::data_deleteFollower($uid, $fid);
		}
	}






	/********************************************
	* 操作 use
	*/

	//跳转指定页面
	protected function event_useSkip($url){
		echo "<script type='text/javascript'>location.href='./".$url."';</script>";
	}

}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Users extends Event_user
{

	/********************************************
	* 获取 get
	*/

	//获取当前登录用户的 UID
	public function Guid(){
		return parent::event_uid();
	}

	//获取指定 用户Uid 的信息
	public function Guser($uid=0){
		$c = new Content();
		$info = parent::event_getById($uid);
		$array = array(
				'name' => $info['name'],
				'icon' => $info['icon'],
				'sum' => $info['plus'],
				'content' => $c -> GUtotal($uid),
				'love' => 0
			);

		return $array;
	}

	//获取指定 用户Uid 的信息
	public function GUbasie ( $uid =0 ) {

		if ( $uid ) {
			$c = new Content();
			$info = parent::data_selectByUid($uid);

			if ( $info ) {
				// 基本信息
				return array(
					'account' => $info['text_account'],
					'nick' => $info['text_nick'],
					'icon' => $info['text_icon'] ? $info['text_icon'] : parent::event_getRandomIcon(),
					'plus' => $info['number_sum']
				);
			}
		}
	}


	//获取指定 用户Uid 的唯一编码
	public function Gid($uid=0){
		return parent::event_getId($uid);
	}

	//获取当前 访问用户的 ID
	public function Gcid(){
		return isset($_GET['k']) ? $_GET['k'] : 0;
	}

	//根据 用户UID 获取用户头像
	public function Gicon($uid=0){
		$info = parent::event_get($uid);
		$icon = $info['icon'];
		return $icon;
	}

	//根据用户 id 获取用户名
	public function Gname($uid=0){
		$uv = new Users_visitor();
		$info = parent::event_get($uid);
		$name = $info['name'];
		if ( !$name ) {
			$name = $info['register_ip'];
		}
		return $name;
	}

	//根据指定 用户UID 的最近一次登录时间
	public function GLEtime($uid=0){
		$info = parent::event_get($uid);
		return $info['lastdate'];
	}

	// 获取指定 用户UID 上次查看留言的时间
	public function GLmessage($uid=0){
		$info = parent::event_get($uid);
		return $info['newMessage'];
	}

	//获取用户余额，根据 用户ID（选填，默认为登录用户）
	public function Gplus($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if( $uid ){	//判断是否有参数
			$info = parent::event_get($uid);
			return $info['plus'];
		}
	}

	//获取指定 用户UID（选填，默认登录用户） 的当天发布次数
	public function GTPnum($uid=0){
		return parent::event_userContentToadyNums($uid);
	}

	//获取指定 用户UID（选填）发布支付标准基础金
	public function GPigs($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if($this -> Ivip($uid)){	
			$num = 3;	//如果是VIP则基本消费为 3
		}else{
			$num = 7;	//普通会员发布基础金币数量，默认值
		}
		return $num;
	}

	//获取指定 用户UID（选填）发布内容支付金额
	public function GPPay($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return $this -> GPigs() * ($this -> GTPnum() +1);			//根据当天发布量刷新 支付  //pow($deduct*($TNums-1), 2);	// pow($deduct, $TNums);
	}

	//获取用户金额排行列表
	public function Gdigg($begin=0 ,$page=0){
		return parent::event_getPlusDigg($begin ,$page);
	}

	//获取用户点击头像跳转的页面
	public function GIskip(){
		// k = 访问用户中心
		// c = 查看别人内容
		// echo $_GET['k'].'--'.$this -> Guid();
		if(isset($_GET['k']) && ($_GET['k'] != $this -> Guid())){
			return './user.php?k='.$_GET['k'];
		}elseif(isset($_GET['c'])){
			return './user.php';
			// $c = new Content();
			// return './list.php?uid='.$c -> Gauthor($_GET['c']);
		}else{
			return './list.php?uid='.$u -> Guid();
			// return './userEffigy.php';
		}
	}

	//获取指定 用户UID 的关注用户的列表
	public function Gfollow($uid=0){
		return parent::event_selectFollow($uid);
	}

	//获取指定 用户UID（选） 的关注用户表里的指定一位 用户FID
	public function GFuser($fid=0 ,$uid=0){
		return parent::event_selectFollowUser($uid ,$fid);
	}

	//获取指定 用户UID 的关注用户表里的指定一位 用户FID 的关注时间
	public function GFtime($fid=0 ,$uid=0){
		$info = parent::event_selectFollowUser($uid ,$fid);
		if($info){
			$info = time() -$info['time'];
		}
		return $info;
	}

	//获取指定 用户UID 的描述
	public function Gdepict($uid=0){
		$info = parent::event_get($uid);
		$text = $info['describe'];
		return $text ? $text : "还没有个人介绍";
	}

	//获取指定 用户UID 的邮箱
	public function Gemail($uid=0){
		$info = parent::event_get($uid);
		return $info['email'];
	}

	//获取指定 用户UID 的密码
	public function Gpwd($uid=0){
		$info = parent::event_get($uid);
		return $info['pwd'];
	}

	//获取指定 用户UID 的点赞量
	public function Gzan($uid=0){
		$info = parent::event_get($uid);
		return $info['comments'];
	}

	//获取指定 用户UID 的注册IP
	public function Gip($uid=0){
		$info = parent::event_get($uid);
		return $info['register_ip'];
	}


	//获取判断且输出分页按钮
	//参数：总分页数
	public function GHPbtn($total=0, $pages=0){

		if($this -> Ik()){
			$Pk = "k=".$this -> Gcid();	//如果有访问用户
		}else{
			$Pk = '';
		}

		//获取当前分页
		$Pcurrent = 1;
		if( isset($pages) && is_numeric($pages) ){
			$Pcurrent = $pages;
		}

		//开始和结束索引
		$Pstart 	= $Pcurrent -5 <1 ? 1 : $Pcurrent -5;			//开始
		$Pfinish 	= $Pcurrent +5 >$total ? $total : $Pcurrent +5;	//结束

		$str = '';
		for( $Pi=$Pstart ; $Pi<=$Pfinish; $Pi++ ){
			if( $Pcurrent == $Pi ){
				$Pact = "class='act'";
			}else{
				$Pact = "";
			}
			$str = $str."<a href='?".$Pk."p=".$Pi."' ".$Pact." >".$Pi."</a>";
			// $str = $str."<a href='javascript:;' >".$Pi."</a>";
		}

		//返回
		return $str;
	}

	//获取指定 用户UID（选） 的留言板的分页按钮数量，确定每页的数量NUM
	public function GMBnum($num=0, $uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return ceil($this -> GFMcount($uid) / $num); 	//留言总条数 - 计算分页
	}
	
	//获取指定 用户UID（选） 的留言板的分页按钮，给出 当前页数BEGING 和每页显示的 条数NUMBER
	public function GMbtn($begin=0, $number=100, $uid=0){
		$param = $uid ? "k=".$uid."&" : "";
		$value = "";

		//间隔
		$interval = 5;
		$pages = $this -> GMBnum($number, $uid);

		//参数
		$Pcurrent 	= $begin;			//当前
		$Pstart 	= $Pcurrent -$interval <1 ? 1 : $Pcurrent -$interval;			//开始
		$Pfinish 	= $Pcurrent +$interval >$pages ? $pages : $Pcurrent +$interval;	//结束

		//循环输出
		for( $Pi=$Pstart ; $Pi<=$Pfinish; $Pi++ ){
			if( $Pcurrent == $Pi ){
				$Pact = "class='act'";
			}else{
				$Pact = "";
			}
			$value = $value."<a href='?".$param."p=".$Pi."' ".$Pact." >".$Pi."</a>";
		}

		return $value;
	}

	//获取指定 邮箱address 的邮件验证码
	public function GEyzm( $address ){

		require_once('../class/class.phpmailer.php');

		$mail = new PHPMailer(); //实例化

		$mail->IsSMTP(); // 启用SMTP
		$mail->Host = "smtp.163.com"; //SMTP服务器 以163邮箱为例子
		$mail->Port = 25;  //发送端口
		$mail->SMTPAuth   = true;  //启用SMTP认证

		$mail->CharSet  = "UTF-8"; //字符集
		$mail->Encoding = "base64"; //编码方式

		$mail->Username = "15680033681@163.com";  //你的邮箱
		$mail->Password = "nachao";  //你的密码
		$mail->Subject = "《方方乐》修改邮箱验证码"; //标题

		$mail->From = "15680033681@163.com";  //发件人地址（也就是你的邮箱）
		$mail->FromName = "方方乐";  //发件人姓名

		// $address = "357586693@qq.com";//收件人email
		$mail->AddAddress($address, "亲");//添加收件人（地址，昵称）

		// $mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
		$mail->IsHTML(true); //支持html格式内容
		// $mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片

		$yzm = md5(time());
		$mail->Body = '您好！<br />你在 <a href="ffangle.com" >方方乐</a> 进行的邮箱修改，请输入验证码：'.$yzm; //主体内容

		//发送
		if(!$mail->Send()) {
		  echo "发送失败: " . $mail->ErrorInfo;
		} else {
			// $_SESSION['ip'] = get_client_ip();
			// $_SESSION['time'] = time();
		  echo $yzm;
		}
	}

	//获取指定 用户UID 的访问记录
	public function GVlogs($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return parent::event_getVisitorLogs($uid);
	}

	//获取指定 用户UID 的邀请人数
	public function GInum($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return parent::event_getInviteNum($uid);
	}

	//获取发布内容的标准支付金
	public function GIsd(){
		return 7;
	}

	//获取指定 用户UID 发布内容的支付金
	public function Gsd($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		$value = 7;
		if($this -> Ivip($uid)){
			$value = 3;
		}
		return $value;
	}

	//激活码 --获取当前所有 激活码CDK 信息
	public function Gcdk(){
		return parent::event_getCdkAll();
	}


	//获取指定用户最近30天金额变动记录
	public function Glog( $uid=0, $len=30 ){
		$uid = $uid ? $uid : $this -> Guid();

		$day = 24 *60 *60;
		$begin = strtotime(date('Y-m-d',time())) + $day;
		$time = 0;

		$arr = array();
		$key = '';

		for($i=0; $i <= $len; $i++){
			$time = $begin - $day * $i;
			$key = date('Y-m-d', $time-1);
			$start = $time-$day;
			$end = $time -1;

			$arr[$key]['pay'] = parent::data_selectSumlog($uid, $start, $end);			//获取用户指定天数的支出总和
			$arr[$key]['income'] = parent::data_selectSumlog($uid, $start, $end, 1);	//获取用户指定天数的收入总和
		}
		return $arr;
	}

	//获取指定 用户UID 的点赞总次数
	public function GZtotal($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return parent::data_selectPurchaseSum($uid, 'cid');
	}

	//获取指定 用户UID 的报告
	public function Greport( $uid = 0 ){
		$uid = $uid ? $uid : $this -> Guid();
		return array(
				'time' => 1,
				'num' => 2,
				'first' => 3,
				'digg' => 4,
				'user' => 5
			);
	}


	/********************************************
	* 判断 is
	*/
	
	//判断指定 用户UID（选填）是否存在
	public function Ibe($uid=0){
		return count(parent::event_getInfo($uid));
	}
	
	//判断指定用户是否存在，根据找好
	public function IBaccount($uid=0){
		return count(parent::event_getInfo($uid));
	}
	
	//判断指定 用户(UID)（选填）是不是会员
	public function Ivip($uid=0){
		return parent::event_getVip($uid) > time();
	}
	
	//判断是否访问内容
	public function Ivisit(){
		return isset($_GET['c']);
	}
	
	//判断是否访问用户
	public function IVuser(){
		return isset($_GET['k']);
	}
	public function Ik(){
		return isset($_GET['k']);
	}

	public function Is(){
		return parent::event_uis();
	}

	//判断是否登录 没有登录则跳转至 内容列表页
	public function INtoL(){
		if(!parent::event_uis()){
			$this -> UtoL();
		}
	}

	//判断指定 用户账号和密码 是否存在，如果存在并验证密码是否正确	//登录
	public function Ientry( $account ='', $password ='' ){

		$c = new Content();
		$value = array();		//正好不存在
		$userInfo = parent::data_selectByAccount( $account );

		if ( $account =='' || $password == '' ){
			$value = array( 
					'status' => '0',
					'message' => '请填写完整'
				);

		} else if ( !$userInfo ) {
			$value = array( 
					'status' => '0',
					'message' => '账号不存在'
				);

		} else if ( $userInfo['text_pwd'] != MD5($password) ){
			$value = array( 
					'status' => '0',
					'message' => '密码错误'
				);

		} else {
			$uid = $userInfo['id_uid'];
			setcookie("73userid", $uid, time()+24*3600, "/");		//存入 - 有效时间 1 天
			parent::data_update($uid, 'time_lastdate', time());		//刷新登录时间

			// 新增数据
			$insert = array(
				'plus' => $userInfo['plus'],	// 积分
				'collect' => '0',			// 收藏
				'comment' => '0',			// 评论
				'follower' => '0' 			// 粉丝
			);

			// 基本信息
			$basic = array(
				'name' => $userInfo['name'],
				'icon' => $userInfo['icon'],
				'plus' => $userInfo['plus'],
				'content' => $c -> GUtotal($uid),
				'love' => '0',
			);

			$value = array(
				'status' => '1',
				'message' => '登录成功',

				'insert' => $insert,
				'basic' => $basic
			);
		}

		return $value;
	}

	//判断指定 用户UID（选） 是否关注了指定 用户FID
	public function Ifollow($fid=0 ,$uid=0){
		$value = parent::event_selectFollowUser($uid ,$fid);
		return !empty($value);
	}

	//判断是否第一次登录
	public function Ifirst(){
		$value = 0;
		if($this -> Guid()){	//登录状态下，并且是在 自己的 个人中心
			$info = parent::event_get();
			if($info['lastdate'] <= $info['register_time']){
				parent::event_updateLastdate();	//更新登录时间
				$value = 1;	
			}
		}
		return $value;	//返回值
	}

	//判断指定 用户UID 密码是否正确
	public function Ipwd($pwd='', $uid=0){
		$value = 0;
		if($pwd){
			$info = parent::event_get($uid);
			$value = md5($pwd) == $info['pwd'];
		}
		return $value;
	}

	//判断指定 用户UID 是否有访问记录
	public function IVlogs($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return count(parent::event_getVisitorLogs($uid));
	}

	//激活码  --判断指定 激活码cdk 是否可以使用
	public function Icdk($cdk=0){
		$o = new Tool();
		$value = 0;
		$info = parent::event_getCdk($o -> Chtml($cdk));
		if($info && $info['status']){
			$value = 1;
		}
		return $value;
	}


	// 判断是否为新用户
	public function Inew($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		$info = parent::event_getInfo($uid);
		if ( $info['lastskip'] <= 0 ) {
			return true;
		} else {
			return false;
		}
	}

	// 判断是否刚刚登陆
	public function Ilogin($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		$info = parent::event_getInfo($uid);
		if ( $info['lastdate'] >= $info['lastskip'] ) {
			return true;
		} else {
			return false;
		}
	}

	// 判断是否刚刚登陆
	public function Icache () {
		$uid = $this -> Guid();
		$value = array(
			'status' => 0,
			'message' => '-',
			'basic' => array()
		);

		if ( $uid ) {
			$basic = $this -> GUbasie($uid);

			// 返回参数
			$value = array(
				'status' => 1,
				'message' => '成功获取用户基本信息',
				'basic' => $basic
			);
		}

		return $value;
	}







	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户ID（选填，默认为登录用户） 的金币，添加指定 数量NUM（选填，默认为1） 的金额
	public function UAplus($num=1, $source='', $source_id=0, $uid=0 ){
		$uid = $uid ? $uid : $this -> event_uid();
		if ( parent::event_updatePlus($this -> Gplus($uid) +$num, $uid ) ){
			$this -> ASincome($uid, $source, $source_id, $num);		//进账记录
		}
		return $num;
	}

	//刷新指定 用户ID（选填） 的金币，扣除指定 数量NUM（选填，默认为1） 的金额
	public function USplus($num=1, $source='', $source_id=0, $uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		if ( parent::event_updatePlus($this -> Gplus($uid) -$num, $uid ) ){
			$this -> ASpay($uid, $source, $source_id, $num);		//支出记录
		}
		return $num;
	}

	//刷新指定 用户ID（选填） 的 发布量NUM（选填，默认为 1）
	public function UAissue($num=1, $uid=0){
		return parent::event_updateIssue(parent::event_getIssue($uid) +$num, $uid );
	}

	//刷新指定 用户ID（选填） 的添加指定的 点评量NUM（选填，默认为 1）
	public function UAclick($num=1, $uid=0){
		return parent::event_updateIssue(parent::event_getIssue($uid) +$num, $uid );
	}

	//刷新指定 用户ID（选填） 的最近发布时间
	public function URuse($uid=0){
		return parent::event_updateRecentlyUseTime($uid);
	}

	//刷新指定 用户ID（选填） 的最近访问留言
	public function UNmessage($uid=0){
		return parent::event_updateNewMessage($uid);
	}

	//刷新当前登录账户为注销
	public function Uout(){
		setcookie('73userid','',time()-3600);

		echo $_COOKIE['73userid'];

		//location首部使浏览器重定向到另一个页面
		header('Location:'.'./login.php');
		// echo "<script>location.href=location.href;</script>";
	}


	//刷新指定 用户UID 的描述
	public function Udepict($txt='', $uid=0){
		return parent::event_updateDescribe($uid, $txt);
	}

	//刷新指定 用户UID 的密码
	public function Upwd($pwd='', $uid=0){
		return parent::event_updatePwd($uid, $pwd);
	}

	//刷新指定 用户UID 的头像
	public function Uicon($icon='', $uid=0){
		parent::event_updateIcon($uid, $icon);
		return $icon;
	}

	//刷新指定 用户UID 为会员，指定有效时间
	public function Uvip($time=0, $uid=0){
		return parent::event_updateVip($time, $uid);
	}

	//刷新指定 用户UID 的最近登录时间
	public function Ulogin($time=0, $uid=0){
		return parent::event_updateVip($time, $uid);
	}

	//刷新指定 用户UID 的最近跳转时间
	public function Uskip($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_update($uid, 'lastskip', time());
	}




	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID（选）关注指定 用户FID
	public function Afollow($fid=0, $uid=0){
		return parent::event_addFollower($fid, $uid);
	}

	//添加指定 用户UID 的留言
	// public function Amessage($muid=0, $con='', $page=0, $huid=0, $fuid=0, $type=0){

	// 	$o = new Tool();
	// 	$uid = parent::event_uid();
	// 	$con = $o -> Chtml($con);

	// 	if($huid && $muid != $uid){		//如果有回复且浏览不在当前登录用户界面 则添加至回复者的留言板
	// 		parent::event_addMessage($huid, $con, $uid, $huid, $muid, $type);
	// 	}

	// 	return parent::event_addMessage($muid, $con, $uid, $huid, $muid, $type);	//添加当前留言板的留言数据
	// }

	//注册用户
	public function Auser( $account='', $password='', $invited=0, $cdk=0 ){

		//判断当前 IP 一天内是否注册达到 3个
		$o = new Tool();
		$ip = $o -> Gip();
		$value = array();

		// 判断参数是否存在且完整
		if ( $account == '' || $password == '' ) {

			// 返回参数
			$value = array( 
					'status' => '2',
					'message' => '参数不正确'
				);

		// 判断账号是否存在
		} else if ( parent::data_selectByAccount($account) ) {

			// 返回参数
			$value = array( 
					'status' => '3',
					'message' => '账号已存在'
				);

		} else {

			// 遍历参数
			$password = MD5($password);

			// 保存数据
			parent::data_addUser( $invited, $account, $password, $ip );

			// 基本信息
			$basic = array(
					'name' => $account,
					'icon' => parent::event_getRandomIcon(),
					'plus' => 0,
					'content' => 0,
					'love' => 0,
				);

			// 返回参数
			$value = array(
					'status' => '1',
					'message' => '注册成功',
					'basic' => $basic
				);

		}

		return $value;
	}

	//添加用户浏览器缓存
	public function Acache($uid=0, $type=''){
		$name = '73userid';
		if ( $type == 'visitor' ) {
			$name = '73visitor';
		}
		if ( $uid ) {
			setcookie( $name, $uid, time()+24*3600, "/");	//存入本地缓存 - 有效时间 1 天	
		} else {
			setcookie( $name, '', time()-3600);
		}
	}

	//激活码 --添加 激活码CDK 
	public function Acdk($num=0){
		while ($num--) {
			$val = md5(mt_rand(1,100)+time()+$num); 
			$val = substr($val, 0, 10);
			parent::event_addCdk($val);
		}
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

	//添加一条用户金额收入记录
	public function ASincome($uid, $source, $source_id, $sum){
		parent::data_addSumLog($uid, 0, $source, $source_id, 1, $sum);
	}

	//添加一条用户金额支出记录
	public function ASpay($uid, $source, $source_id, $sum){
		$t = new Title();
		$t = new Content();
		$in_uid = 0;

		//获取收入用户
		if($source == 'tid'){	//创建标题
			// $in_uid = $t -> Gcreator($source_id);
		}
		if($source == 'cid'){	//购买内容
			// $in_uid = $t -> Gauthor($source_id);
		}
		if($source == 'ccid'){	//创建内容
			$in_uid = 0;
		}
		if($source == 'csid'){	//购买徽章内容
			$in_uid = 0;
		}
		if($source == 'ctid'){	//创建标题
			$in_uid = 0;
		}
		if ( $sum ) { 
			return parent::data_addSumLog($in_uid, $uid, $source, $source_id, 0, $sum);
		}
	}


	/********************************************
	* 撤销 delete
	*/

	//撤销指定 用户UID（选）关注指定 用户FID
	public function Dfollow($fid=0, $uid=0){
		return parent::event_deleteFollower($fid, $uid);
	}





	/********************************************
	* 操作 use
	*/

	//跳转至 内容列表页
	public function UtoL($val='list.php'){
		return parent::event_useSkip($val);
	}
	
}




//赋值数据
$users = new Users();
$u = new Users();



?>