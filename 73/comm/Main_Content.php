<?php

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
class Comm_content extends Config
{	
}




/********************************************************************************************
* 数据操作
*/
class Data_content extends Comm_content
{

	//创建私有变量
	private $titleId;


	/********************************************
	* 添加
	*/

	//添加内容
	//#参数
	// $cid= 内容ID ；$uid=发布者ID； $tid=标题ID； $type=内容类型ID； $con=内容描述； $img=图片地址； $mp3= 音乐地址； $swf= 视频地址； $money= 消费；$share= 标题分担
	protected function data_addContent( $type=0, $cid=0, $uid=0, $tid=0, $con='', $img='', $mp3='', $gif='', $link='', $money='', $share=0 ){
		$sql = "insert into `".parent::Mn()."`.`".parent::Fn()."content` (`id`, `cid`, `userid`, `user`, `icon`, `titleid`, `title`, `content`, `image`, `link`, `music`, `video`, `select`, `base`, `weight`, `types`, `classify`, `consume`, `shareglod`) values('', '".$cid."', '".$uid."', '', '', '".$tid."', '', '".$con."', '".$img."', '".$link."', '".$mp3."', '".$gif."', '', '".time()."', ".time().", '".$type."', '".$tid."', '".$money."', ".$share.");";
		return mysql_query($sql);
	}

	//添加一条用户评论记录
	protected function data_addBuyLog($uid, $cid){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."logs_purchase` (`id` ,`time`, `uid`, `cid`)VALUES (NULL , ".time().", ".$uid.", ".$cid.") ;";
		return mysql_query($sql);
	}



	/********************************************
	* 查询
	*/

	//获取 指定ID 的内容
	protected function data_selectById($cid=0){
		if($cid){
			$sql = "select * FROM  `".parent::Fn()."content` WHERE  `id` =".$cid." LIMIT 0 , 30";
			return parent::Ais($sql);
		}
	}

	//获取 指定CID 的内容
	protected function data_selectByCid($cid=0){
		$sql = "select * FROM  `".parent::Fn()."content` WHERE  `cid` =".$cid." ;";
		return parent::Ais($sql);
	}

	//获取全部通过的内容，按 id 倒序排序
	// 参数说明
	// $begin= 当前页数（选）； $pages= 每页显示条数（选）；$tid= 显示指定标题的内容（选填，默认全部显示）； $grade = 得分标准（选，默认没有标准）
	protected function data_selectContent( $begin=0, $pages=9, $tid=0, $grade = 0, $uid=0 ){
		if($tid){
			$sql = "select * from `".parent::Fn()."content` WHERE `titleid` = '".$tid."' AND (`verify` = 0 AND `plus` >= ".$grade.") order by `id` desc LIMIT ".$begin." , ".$pages;
		}else{
			$sql = "select * from `".parent::Fn()."content` WHERE `verify` = 0 AND `plus` >= ".$grade." order by `id` desc LIMIT ".$begin." , ".$pages;
		}

		if($uid){
			$sql = "select * from `".parent::Fn()."content` WHERE (`verify` = 0 AND `userid` = ".$uid.") AND `plus` >= ".$grade." order by `id` desc LIMIT ".$begin." , ".$pages;
		}
		return mysql_query($sql);
	}

	//获取全部通过的内容，按 id 倒序排序	#开始条数，本次显示条数，标题id，
	// protected function data_selectList( $begin=0, $pages = 9, $titleid = '', $grade = 0 ){
	// 	$cf = new Config();	//获取配置

	// 	if( intval($titleid, 10) ){
	// 		$sql = "select * from ux73_content WHERE `titleid` = '".$titleid."' AND `verify` = ".$cf -> Verify." order by `id` desc LIMIT ".$begin." , ".$pages;
	// 	}else{
	// 		$sql = "select * from ux73_content WHERE `verify` = ".$cf -> Verify." AND `plus` >= ".$grade." order by `id` desc LIMIT ".$begin." , ".$pages;
	// 	}
	// 	return mysql_query($sql);
	// }
	
	//获取指定 用户UID 是否购买指定的 内容(CID)
	protected function data_userIsBuy($uid=0, $cid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_purchase` WHERE  `cid` =".$cid." AND `uid` =".$uid.";";
		return parent::Ais($sql);
		return $row[0];
	}
	
	//获取内容的总数量
	protected function data_selectCount($norm=0, $uid=0, $tid=0){
		$add = "";
		if($uid){
			$add = " AND `userid` = ".$uid;
		}
		if($tid){
			$add = " AND `titleid` = ".$tid;
		}
		$sql = "select count(`id`) FROM  `".parent::Fn()."content` WHERE (`verify` = 0 AND `plus` >= ".$norm.") ".$add." ;";
		$row = parent::Ais($sql);
		return $row[0];
	}



	/********************************************
	* 更新 update
	*/


	//刷新指定 内容CID 的指定 字段NAME 的指定 参数VAL
	protected function data_update($cid=0, $name='', $val=0){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."content` SET  `".$name."` =  '".$val."' WHERE  `".parent::Fn()."content`.`cid` = ".$cid." LIMIT 1 ;";
		return mysql_query($sql);
	}

}












/********************************************************************************************
* 逻辑层 
*/
class Event_content extends Data_content
{
	
	/********************************************
	* 获取
	*/

	//获取有效的内容的总数量
	protected function event_getCount($norm=0, $uid=0, $tid=0){
		return parent::data_selectCount($norm, $uid, $tid);
	}

	//获取的内容列表，可以指定 标准得分NORM
	protected function event_getList($tid=0, $begin=0, $page=15, $norm=0 , $uid=0 ){
		$query = parent::data_selectContent( $begin, $page, $tid, $norm, $uid);
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据
				array_push($array, $row);
			}
		}
		return $array;	//返回
	}

	//获取指定 内容ID 的信息
	protected function event_getById($cid){
		return parent::data_selectById($cid);
	}

	//获取指定 内容CID 的信息
	protected function event_getByCid($cid=0){
		if($cid){
			return parent::data_selectByCid($cid);
		}
	}
	
	//获取详细页 相关内容
	protected function event_getInterfix($cid=0){
		$arr 	= array();
		$total 	= 0;

		$info = $this -> event_getByCid($cid);

		$tid = $info['titleid'];
		$uid = $info['userid'];

		//记录输出内容的 ID
		$conId 	= array();

		//要输出的数量
		$num 	= 11;

		//判断是否有标题
		if($tid){
			$query = parent::data_selectContent(0, $num, $tid);	
			$total = mysql_num_rows($query);

			//如果标题还有除了此内容之外的，则遍历
			if( $total > 1 ){
				while( $row = mysql_fetch_array($query)){	//获取单个内容数

					//如果内容不是当前页面的内容，则输出
					if( $cid != $row['cid'] ){
						array_push($arr, $row);
						array_push($conId, $row['cid']);
					}
				}
			}
		}
			
		//如果数量小于 7 个，则从用户内容里调
		if( count($conId) < $num ){
			$total = $num -count($conId);

			//获取用户的内容
			$query = parent::data_selectContent(0, $total, 0, 0, $uid);
			$tote  = mysql_num_rows($query);

			//如果用户有内容则遍历
			if( $total > 0 ){
				while( $row = mysql_fetch_array($query)){	//获取单个内容数

					//判断内容是否已经被遍历，且内容不是当前页面的内容，则输出
					if( !in_array( $row['cid'], $conId) && $cid != $row['cid'] ){
						array_push($arr, $row);
						array_push($conId, $row['cid']);
					}
				}
			}
		}

		//继续判断遍历的内容是否足够最低数量
		if( count($conId) < $num ){
			$total = $num -count($conId);
			$query = parent::data_selectContent(0, $total);

			$tote  = mysql_num_rows($query);

			//遍历所有 最新内容
			while( $row = mysql_fetch_array($query)){	//获取单个内容数

				//判断内容是否已经被遍历，且内容不是当前页面的内容，则输出
				if( !in_array( $row['cid'], $conId) && $cid != $row['cid'] ){
					array_push($arr, $row);
				}
			}
		}


		//返回
		return $arr;
	}

	//获取指定 用户(UID)（选填） 购买过指定的 内容(CID) 的记录信息
	protected function event_isBuy($cid=0, $uid=0){
		if($cid){
			return parent::data_userIsBuy($uid, $cid);
		}
	}

	//判断指定 用户UID（选填） 是否可以查看指定的 内容ID  
	// protected function event_isSee($cid=0, $uid=0){
	// }



	/********************************************
	* 新增 add
	*/

	//提交发布表单
	//#参数说明
	// 	$type= 内容类型； $tit= 标题名； $con= 描述； $img= 图片地址； $mp3= 音乐地址；$gif= 视频地址 
	protected function event_addContent( $type=0, $tid=0, $con='', $img='',$mp3='', $gif='' ,$uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$u = new Users();				
		$t = new Title();	
		$o = new Tool();

		//初始化参数
		$cid 	= $u -> Gid().time();
		$number = $u -> GTPnum() +1;	//获用户发布次数
		$standard = $u -> GIsd();		//获取标准支付金
		$share = 0;
		$deduct = $u -> Gsd();		//获取当前用户的基础支付金

		//如果有指定的标题
		if($tid){				
			$share = $t -> Gshare($tid);
			if($t -> IPSgold($tid)){				//如果分享金足够则支付
				$t -> Ushare($tid);
				$deduct = $standard - $share;
			}elseif($t -> IPFanother($tid)){			//否则，判断如果代付足够则代付支付
				$t -> USplus($share);
				$deduct = $standard - $share;
			}else{									//否则，转为普通支付（非标题支付）
				if($u -> Ivip()){					//判断如果为会员，刷新标准金
					$deduct = $u -> GVsd();
				}else{
					$deduct = $standard;
				}
			}
			$t -> UUtime($tid);	//刷新标题使用时间，time()
			$t -> Unum($tid);	//刷新标题内容数量，+1
		
		}

		$deduct = $number * $deduct;

		//判断用户余额是否足够
		if($u -> Gplus() >= $deduct){	
			$con= $o -> Chtml($con);			//编译描述

			//插入数据
			parent::data_Addcontent( $type, $cid ,$uid, $tid, $con, $img, $mp3, $gif, null, $deduct, $share );

			//刷新发布用户信息
			$u -> UAissue();		//刷新发布量
			$u -> URuse();			//刷新最新发布时间
			$u -> USplus($deduct);	//刷新余额，扣除指定金额

			return $cid;
		}
	}

	//添加指定 用户UID（选填，默认当前登录用户） 的评论指定 内容CID 的记录
	protected function event_addBuyLog($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($cid){
			return parent::data_addBuyLog($uid, $cid);
		}
	}




	/********************************************
	* 更新 update
	*/

	//更新指定 内容CID 的最近修改时间
	protected function event_updateReviseTime($cid=0){
		if($cid){
			return parent::data_update($cid, 'revise', time());
		}
	}

	//更新指定 内容CID 的 状态NUM（）
	protected function event_updateStatus($cid=0, $num=0){
		if($cid){
			return parent::data_update($cid, 'verify', $num);
		}
	}

	//更新指定 内容CID 的 金额NUM
	protected function event_updatePlus($cid=0, $num=0){
		if($cid && $num){
			return parent::data_update($cid, 'plus', $num);
		}
	}

	//更新指定 内容CID 的 标示VAL（默认为0=无，1=顶，2=推荐）
	protected function event_updateEffects($cid=0, $val=0){
		if($cid && $val){
			return parent::data_update($cid, 'effects', $val);
		}
	}

	//更新指定 内容CID 的购买量
	protected function event_updateClick($cid=0, $num=0){
		if($cid && $num){
			return parent::data_update($cid, 'click', $num);
		}
	}

	//更新指定 内容CID 的图片
	protected function event_updateImage($cid=0, $src=''){
		if($cid && $src){
			return parent::data_update($cid, 'image', $src);
		}
	}

	//更新指定 内容CID 的视频地址
	protected function event_updateVideo($cid=0, $src=''){
		if($cid && $src){
			return parent::data_update($cid, 'video', $src);
		}
	}

	//更新指定 内容CID 的视频音乐
	protected function event_updateMusic($cid=0, $src=''){
		if($cid && $src){
			return parent::data_update($cid, 'music', $src);
		}
	}

	//更新指定 内容CID 的描述
	protected function event_updateContent($cid=0, $txt=''){
		if($cid && $txt){
			return parent::data_update($cid, 'content', $txt);
		}
	}




	/********************************************
	* 删除 delete
	*/


	//删除指定的 内容CID 用户中心的内容
	// protected function event_deleteContent($cid=0){
	// }


}












/********************************************************************************************
*
* 输出层
*
*/
class Content extends Event_content
{
	
	/********************************************
	* 测试
	*/

	//唯一测试用
	public function test(){
		echo "内容功能正常！";
	}

	
	/********************************************
	* 获取 get
	*/

	//获取内容总数量
	public function Gtotel($norm=0, $uid=0, $tid=0){
		return parent::event_getCount($norm, $uid, $tid);
	}

	//获取指定 数量的 的内容列表，可指定指定标题
	public function Glist($begin=0, $pages=15, $tid=0, $norm=0 )
	{
		return parent::event_getList($tid, $begin, $pages, $norm);
	}

	//获取指定 用户UID 的内容列表，可指定指定标题
	public function GUlist($begin=0, $pages=15, $tid=0, $norm=0, $uid=0 )
	{
		$uid = $uid ? $uid : parent::Eid();
		return parent::event_getList($tid, $begin, $pages, $norm, $uid);
	}

	//获取指定 内容ID 的全部信息
	public function Ginfo($cid)
	{
		return parent::event_getByCid($cid);
	}

	//获取指定 内容ID 的创建者ID
	public function Gauthor($cid)
	{
		$info = parent::event_getByCid($cid);
		return $info['userid'];
	}

	//获取指定 内容ID 的标题TID
	public function Gtid($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['titleid'];
	}

	//获取指定 内容ID 的描述
	public function Gcon($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['content'];
	}

	//获取指定 内容ID 的发布时间戳
	public function Gtime($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['base'];
	}

	//获取指定 内容ID 的购买量
	public function Gclick($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['click'];
	}

	//获取指定 内容ID 的金额
	public function Gplus($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['plus'];
	}

	//获取指定 内容ID 的分享金
	public function GSgold($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['shareglod'];
	}

	//获取指定 内容ID 的支付金
	public function GPgold($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['consume'];
	}

	//获取指定 内容ID 的分类
	public function Gtype($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['types'];
	}

	//获取指定 内容ID 的图片
	public function Gimage($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['image'];
	}

	//获取指定 内容ID 的音乐地址
	public function Gmusic($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['music'];
	}

	//获取指定 内容ID 的视频地址
	public function Gvideo($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['video'];
	}

	//获取指定 内容CID 的详细页的相关内容
	public function Ginterfix($cid=0){
		return parent::event_getInterfix($cid);
	}




	/********************************************
	* 判断 is
	*/

	//判断指定内容，当前登录用户是否可看
	// public function Isee($cid){
	// 	return parent::event_isSee($cid);
	// }

	//判断指定 用户UIU（选填） 是否是指定 内容(ID) 的发布者 
	public function Iauthor($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$value = 0;
		if($cid){
			if($this -> Gauthor($cid) == $uid){
				$value = 1;
			}
		}
		return $value;
	}

	//判断指定 用户(UID) 是否购买过指定的 内容(CID)，不指定用户，则默认为当前登录用户
	public function Ibuy($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		if($cid){
			return $this -> Iauthor($cid, $uid) || parent::event_isBuy($cid, $uid);
		}
	}

	//判断指定 内容(UID) 是否有文本描述
	public function Itxt($cid=0){
		if($cid){
			return $this -> Gcon($cid) != '';
		}
	}

	//判断指定 内容(UID) 是否存在
	public function Ibe($cid=0){
		return parent::event_getByCid($cid) != 0;
	}

	//判断指定 内容ID 的控件类型，并返回对应的html代码
	public function IGcontrol($cid=0)
	{
		$html = '';
		if($cid){
			$type = $this -> Gtype($cid);
			switch($type){
				case 0 : $html = "<div class='sawtooth'></div>"; break;		//文本
				case 1 : $html = "<img class='img' src='".$this -> Gimage($cid)."' /><a class='bigimg' href='".$this -> Gimage($cid)."' title='Natural: 1100 x 687 pixels' target='_black'>查看大图</a><div class='sawtooth'></div>"; break;		//图片
				case 2 : $html = "<embed class='gif' src='http://".$this -> Gvideo($cid)."' quality='high' wmode='Opaque' width='100%' height='100%' align='middle' allowscriptaccess='always' allowfullscreen='true' mode='transparent' type='application/x-shockwave-flash'>"; break;	//视频
				case 3 : $html = "<embed class='mp3' src='".$this -> Gmusic($cid)."' type='application/x-shockwave-flash' width='257' height='33' wmode='transparent' /> "; break;		//音乐
			}
		}
		return $html;
	}






	/********************************************
	* 添加 add
	*/

	//提交发布表单
	public function Acon( $type=0, $tid=0, $con='', $img='', $imgcon='', $mp3='', $mp3con='', $gif='', $gifcon=''){
		switch ($type) {					//判断类型，并刷新描述内容
			case 1: $con = $imgcon; $mp3 = ''; $gif = ''; break;	//图片
			case 2: $con = $mp3con; $img = ''; $gif = ''; break;	//音乐
			case 3: $con = $gifcon; $img = ''; $mp3 = ''; break;	//视频
			default: $con = $con; $img = ''; $mp3 = ''; $gif = ''; break;	//文字
		}
		$cid = parent::event_addContent( $type, $tid, $con, $img, $mp3, $gif );
		if($cid){
			$u = new Users();
			$u -> UtoL('userAdd.php?ok='.$cid);
		}
	}

	//添加指定 用户UID（选填） 购买指定 内容CID 
	public function Abuy($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$u = new Users();
		$t = new Title();
		$value = 0;
		if($cid){
			$num = 2 *5;			//作者默认收获，0.02 元吗，测试期间三倍收入。
			if($u -> Guid()){					//登录用户才能操作
				if($u -> Gplus() >= 1){			//如果用户金额足够
					$u -> UAclick();				//用户刷新点评量
					$u -> USplus();					//用户刷新的余额
					parent::event_addBuyLog($cid);	//用户添加的购买记录
					$tid = $this -> Gtid($cid);
					if($tid){
						$num = $num -1;			//作者刷新获得的金额，分享 1分给标题
						$t -> UAda($tid);		//标题刷新的金池，默认收入 1 分。
						$t -> Ubuy($tid);		//标题刷新的购买次数
					}
					$u -> UAplus($num, $this -> Gauthor($cid));	//作者刷新的余额
					$this -> Uplus($cid, $num);	//刷新内容金额
					$this -> UAclick($cid);	//内容刷新购买次数
				}
			}
			$value = $num;//$cid;
		}
		return $value;
	}



	/********************************************
	* 更新 update
	*/

	//修改指定 内容CID 添加指定的 金额NUM（选填，默认为 2），返回修改后的金额
	public function Uplus($cid=0, $num=2){
		if($cid && $num){
			$num = $this -> Gplus($cid) + $num;
			parent::event_updatePlus($cid, $num);
			return $num;
		}
	}

	//修改指定 内容CID 的标示为顶，给内容添加指定数量的金额NUM（选，默认100）
	public function UEvery($cid=0, $num=100){
		if($cid){
			parent::event_updateEffects($cid, 1);
			$this -> Uplus($cid, $num);	//加
		}
	}

	//修改指定 内容CID 的标示为题主推荐，给内容添加指定数量的金额NUM（选，默认10000）
	public function UErecommend($cid=0, $num=10000){
		if($cid){
			$u = new Users();
			if($u -> Gplus() > $num){	//如果用户金额足够的话
				parent::event_updateEffects($cid, 2);
				$u -> USplus($num);			//扣除题主
				$u -> UAplus($num, $this -> Gauthor($cid));		//给作者加
				// return $this -> Uplus($cid, $num);				//给内容加
			}
		}
	}

	//修改指定 内容CID 的购买量，给内容添加指定数量NUM（选，默认1）
	public function UAclick($cid=0, $num=1){
		if($cid){
			parent::event_updateClick($cid, $this -> Gclick($cid) +$num);
		}
	}

	//修改指定 内容CID 的状态为，关闭
	public function Uclose($cid=0){
		$u = new Users();
		$t = new Title();
		$value = 0;
		if($cid){
			parent::event_updateStatus($cid, 2);		//更新为关闭状态
			$tid  = $this -> Gtid($cid);
			if($tid){										//如果有标题的话
				$t -> UAda($tid, $this -> GSgold($cid));	//返回标题的分享金
				$t -> Unum($tid, -1);						//刷新标题的内容数量
			}
			$value = $this -> GPgold($cid);
			$u -> UAplus($value);	//返还发布所消耗的支付金
		}
		return $value;
	}

	//修改指定 内容CID 的图片
	public function Uimg($cid=0, $src=''){
		return parent::event_updateImage($cid, $src);
	}

	//修改指定 内容CID 的视频地址
	public function Uvideo($cid=0, $src=''){
		return parent::event_updateVideo($cid, $src);
	}

	//修改指定 内容CID 的音乐地址
	public function Umusic($cid=0, $src=''){
		return parent::event_updateMusic($cid, $src);
	}

	//修改指定 内容CID 的描述
	public function Utxt($cid=0, $txt=''){
		return parent::event_updateContent($cid, $txt);
	}

	//修改指定 内容CID 的更新时间
	public function URtime($cid=0){
		return parent::event_updateReviseTime($cid);
	}


	
}


	
//初始化全局变量
$content = new Content();
$c = new Content();



?>