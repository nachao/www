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
class Data_user_message extends Config
{


	/********************************************
	* 添加
	*/

	//添加指定 用户UID 的留言记录
	// 参数：$muid= 留言板拥有者UID； $con= 留言内容； $uid= 留言编写者UID； $huid= 回复对象UID, $from= 留言出自哪； $type= 0：留言板、n：对应的内容留言 
	protected function data_addMessage($con='', $uid=0, $mid=0, $hmid=0){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."message` (`id` ,`content` ,`time`, `speaker`, `position`, `reply`)VALUES (NULL , '".$con."', '".time()."', '".$uid."', '".$mid."', '".$hmid."');";
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

	//获取指定 用户UID 的指定 时间TIME 之后的留言信息
	protected function data_selectMessage($uid=0, $time=0, $begin=0, $pages=10){
		$sql = "select * FROM  `".parent::Fn()."message` WHERE  `lastdate` >".$time." AND `uid` =".$uid." ORDER BY  `id` DESC LIMIT ".$begin*$pages." ,".$pages;
		return mysql_query($sql);
	}

	//获取指定 用户UID 的留言的全部回复
	protected function data_selectmessageHuifuUser( $uid=0, $mid=0, $begin=0 ,$page=0, $type=0 ){
		$sql = "select * FROM  `".parent::Fn()."message` WHERE  `reply` ='".$mid."' AND (`type` =".$type." AND `uid` =".$uid.") order by `id` desc LIMIT ".$begin." , ".$page;
		return mysql_query($sql);
	}

	//获取指定用户的留言总数，不包含回复
	protected function data_selectFirstMessage($uid=0){
		$sql = "select * FROM  `".parent::Fn()."message` WHERE  `reply` =0 AND `uid` = ".$uid." LIMIT 1;";
		return mysql_query($sql);
	}

	//获取指定 目标UID 的全部一级回复，（不含回复）
	protected function data_selectOneMessageList( $mid=0, $begin=0 ,$page=0){
		$sql = "select * FROM  `".parent::Fn()."message` WHERE  `position` ='".$mid."' order by `id` desc LIMIT ".$begin." , ".$page;
		return mysql_query($sql);
	}

	//获取指定 目标UID 的全部留言总数
	protected function data_selectMessageTotal( $mid=0, $begin=0 ,$page=0){
		$sql = "select count(`id`) FROM  `".parent::Fn()."message` WHERE  `position` ='".$mid."' ;";
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取评论总数
	protected function data_selectTotal(){
		$sql = "select count(`id`) FROM  `".parent::Fn()."message`";
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取指定 评论ID 的信息
	protected function data_selectById( $mid=0 ){
		$sql = "select * FROM  `".parent::Fn()."message` WHERE  `id` ='".$mid."' ;";
		return parent::Ais($sql);
	}

	//获取指定 用户UID 的指定 内容CID 的评论信息总数
	protected function data_selectUserTotal( $uid=0, $mid=0 ){
		$sql = "select count(`id`) FROM  `".parent::Fn()."message` WHERE  `speaker` ='".$uid."' AND `position` ='".$mid."';";
		$row = parent::Ais($sql);
		return $row[0];
	}


	/********************************************
	* 刷新 update
	*/
	protected function data_update( $mid=0, $key='up', $val=0 ){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."message` SET  `".$key."` =  '".$val."' WHERE  `".parent::Fn()."message`.`id` =".$mid.";";
		return mysql_query($sql);
	}

}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_user_message extends Data_user_message
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

	//获取指定 用户UID 的留言的全部回复
	protected function event_getHuifuMessage( $uid=0, $mid=0, $begin=0 ,$page=99 ){
		$array = array();
		$query = parent::data_selectmessageHuifuUser( $uid, $mid, $begin, $page );	//最新
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 用户UID 的指定 内容CID 的全部留言
	protected function event_getConMessage( $uid=0, $cid=0, $begin=0 ,$page=99, $mid=0 ){
		$array = array();
		$query = parent::data_selectmessageHuifuUser( $uid, $mid, $begin, $page, $cid );	//最新
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定用户的留言总数，不包含回复
	protected function event_getFirstMessage($uid=0, $begin=0, $page=99){
		$array = array();
		$query = parent::data_selectFirstMessage( $uid, $begin, $page );	//最新
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 内容CID 的全部一级留言，不包含回复
	protected function event_getContentOneMessage($cid=0, $begin=0, $page=10){
		$u = new Users();
		$o = new Tool();
		$array = array();
		if ( $begin != 0 ) {
			$begin = $begin + $page - 1;
		}
		$query = parent::data_selectOneMessageList($cid, $begin, $page );	//最新
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				$row['icon'] = $u -> Gicon($row['speaker']);
				$row['name'] = $u -> Gname($row['speaker']);
				$row['range'] = $o -> Crange($row['time']);
				if ( $row['reply'] ) {
					$info = parent::data_selectById($row['reply']);
					$row['reply'] = array(
							'name' => $u -> Gname($info['speaker']),
							'uid' => $info['speaker'],
							'text' => $info['content']
						);
				}
				array_push($array, $row);
			}
		}
		$data = array(
				'status' => '1101',	//输出默认显示内容
				'total' => parent::data_selectMessageTotal($cid),
				'number' => $page,		//每页显示的评论数量
				'page' => $begin,
				'res' =>  $array
			);
		return $data;
	}

	//获取指定 目标MID 留言总数
	protected function event_getMessageTotal($mid=0){
		if($mid){
			return parent::data_selectMessageTotal($mid);
		}
	} 



	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户ID（选填） 的最近访问留言
	protected function event_updateNewMessage($uid=0){
		$uid = $uid ? $uid : $this -> event_uid();
		return parent::data_update($uid, 'newMessage', time());
	}



	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID 的留言
	// protected function event_addMessage($con='', $uid=0, $mid=0, $hmid=0){
	// 	if($con && $mid){
	// 		$o = new Tool();
	// 		return parent::data_addMessage($o -> Chtml($con), $uid, $mid, $hmid);
	// 	}
	// }



	/********************************************
	* 删除 delete
	*/

	//删除指定留言
	protected function event_deleteMessageDel($uid=0, $mid=0){
		if($mid){
			return parent::data_deleteMessageDel($uid, $mid);
		}
	}

	//删除指定留言下面的所有回复
	protected function event_deleteMessageDelHf($uid=0, $hid=0){
		if($hid){
			return parent::event_deleteMessageDelHf($uid, $hid);
		}
	}







	/********************************************
	* 操作 use
	*/


}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Users_message extends Event_user_message
{

	/********************************************
	* 获取 get
	*/

	//获取指定 用户UID 距上次查看留言之后的未读留言信息数量
	public function GMnum($uid=0){
		$u = new Users();
		return count(parent::event_selectMessage($uid ,$u -> GLmessage($uid), 0, 99));
	}

	//获取指定 用户UID 的留言信息
	public function Gmessage( $begin=0, $pages=0, $uid=0){
		return parent::event_selectMessage($uid, 0 ,$begin, $pages);
	}

	//获取指定留言 的全部回复
	public function GHmessage($uid=0, $mid=0, $begin=0, $pages=10 ){
		$uid = $uid ? $uid : $this -> Guid();
		$uid = $this -> Ik() ? $this -> Gcid(): $uid;	//如果是访问别人
		return parent::event_getHuifuMessage($uid, $mid, $begin, $pages);
	}

	//获取指定留言发回复 分页数
	public function GMpage($uid=0, $mid=0){
		$uid = $uid ? $uid : $this -> Guid();
		$mtotal = count(parent::event_getHuifuMessage($uid, $mid)); 	//总数
		if($mtotal){
			$pages  = 10;							//每页显示数量
			return ceil($mtotal/$pages);
		}else{
			return 0;
		}
	}

	//获取指定 用户UID 的指定 内容CID 的全部留言
	public function GUCmessage($cid=0, $uid=0){

		$c = new Content();
		$uid = $c -> Gauthor($cid);
		return parent::event_getConMessage($uid, $cid);
	}

	//获取指定 内容CID 的全部留言
	public function GCmessage($cid=0, $begin=0){
		return parent::event_getContentOneMessage($cid, $begin);
	}

	//获取指定用户的留言总数，不包含回复
	public function GFMcount($uid=0){
		$uid = $uid ? $uid : $this -> Guid();
		return count(parent::event_getFirstMessage($uid));
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

	//获取指定 目标MID 的留言总数
	public function Gtotal($mid=0){
		return parent::data_selectMessageTotal($mid);
	}




	/********************************************
	* 判断 is
	*/
	
	//判断指定 内容CID 是否有留言
	public function ICmessage($cid=0){
		return count(parent::event_getContentOneMessage($cid)) > 0;
	}
	
	//判断指定 用户UID 是否有参与过指定的 内容CID 的评论
	public function IUmessage($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectUserTotal( $uid, $cid ) > 0;
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 用户ID（选填） 的最近访问留言
	// public function UNmessage($uid=0){
	// 	return parent::event_updateNewMessage($uid);
	// }

	//刷新指定 评论MID 的赞
	public function Uup($mid=0){
		$info = parent::data_selectById($mid);
		return parent::data_update($mid, 'up', $info['up'] + 1);
	}

	//刷新指定 评论MID 的踩
	public function Udown($mid=0){
		$info = parent::data_selectById($mid);
		return parent::data_update($mid, 'down', $info['down'] + 1);
	}




	/********************************************
	* 添加 add
	*/

	//添加指定 用户UID 的留言
	public function Amessage($con='', $mid=0, $hmid=0, $uid=0 ){
		$uid = $uid ? $uid : parent::Eid();
		$o = new Tool();
		$u = new Users();

		$con = $o -> Chtml($con);
		// if($huid && $muid != $uid){		//如果有回复且浏览不在当前登录用户界面 则添加至回复者的留言板
		// 	parent::event_addMessage($con, $uid, $huid, $hmid);
		// }
		parent::data_addMessage($con, $uid, $mid, $hmid);

		//如果是游客，评论则会扣分
		if ( !$u -> Is() ) {
			$u -> USplus(1, 'comment', $mid);
		}

		//如果是回复
		$reply = '0';
		if ( $hmid ) {
			$info = parent::data_selectById($hmid);
			$reply = array(
				'name' => $u -> Gname($info['speaker']),
				'uid' => $info['speaker'],
				'text' => $info['content']
			);
		}
		
		$row = Array(
				'id' => parent::data_selectTotal() + 1,
				'icon' => $u -> Gicon(),
				'name' => $u -> Gname(),
				'content' => $con,
				'range' => '刚刚',
				'reply' => $reply
			);
		$array = array();
		array_push($array, $row);
		$data = array(
				'status' => '1102',	//输出新增内容
				'res' =>  $array
			);
		return $data;

		// if(parent::event_addMessage($con, $uid, $mid)){		//添加当前留言板的留言数据
			// return 1;
			// $u -> UtoL("?c=".$mid."&message=1");
		// }
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
$um = new Users_message();



?>