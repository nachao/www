<?php

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
class Comm_content extends Config
{	


	// 添加内容
	protected function _uid(){
		$u = new Users();
		return $u -> Guid();
	}

	protected function _u(){
		return new Users();
	}

	protected function _a(){
		return new Label();
	}

}




/********************************************************************************************
* 数据操作
*/
class Data_content extends Comm_content
{

	// 添加内容	
	protected function _addContent( $uid =0, $text ='', $input ='', $type =0, $cid =0 ){
		$sql = "insert INTO `ux73`.`ux73_main_content` (".
				"`id_cid`, `id_uid`, `main_text`, `main_input`, `status_type`, `time_base`) VALUES (".
				$cid.", '".$uid."', '".$text."', '".$input."', '".$type."', '".time()."');";
		return mysql_query($sql);
	}

	// 添加内容
	protected function _addZan( $cid =0, $uid =0 ){
		$sql = "insert INTO `ux73`.`ux73_main_zan` (`id_cid`, `id_uid`, `time_zan`) VALUES ('".$cid."', '".$uid."', '".time()."');";
		return mysql_query($sql);
	}

	// 获取内容总数
	protected function _selectCount(){
		$sql = "select count(*) from `ux73_main_content`";
		$row = parent::Ais($sql);
		return $row ? $row[0] : '0';
	}

	// 获取赛选内容
	protected function _selectContent( $begin=0, $pages=9, $sum = 0 ){
		$sql = "select * from `ux73_main_content` WHERE `status_verify` = 0 AND `number_sum` >= ".$sum." order by `id_cid` desc LIMIT ".$begin." , ".$pages;
		return mysql_query($sql);
	}

	// 获取用户的点赞信息
	protected function _selectZan( $cid =0, $uid =0 ){
		$sql = "select *  FROM `ux73_main_zan` WHERE `id_cid` = ".$cid." AND `id_uid` = ".$uid;
		$row = parent::Ais($sql);
		return $row ? $row['time_zan'] : '0';
	}

	// 更新内容信息
	protected function _update( $cid=0, $name='', $val=0){
		$sql = "update  `ux73`.`ux73_main_content` SET  `".$name."` =  '".$val."' WHERE  `ux73_main_content`.`id_cid` = ".$cid." LIMIT 1 ;";
		return mysql_query($sql);
	}

















	//添加内容
	//#参数
	// $cid= 内容ID ；$uid=发布者ID； $tid=标题ID； $type=内容类型ID； $con=内容描述； $img=图片地址； $mp3= 音乐地址； $swf= 视频地址； $money= 消费；$share= 标题分担
	protected function data_addContent($data=0){
		$sql = "insert into `".parent::Mn()."`.`".parent::Fn()."content` ".
				"(`id`, `cid`, `userid`, `titleid`, `content`, `cont`, `plus`, `base`, `types`, `consume`, `shareglod`, `effects`, `label`)".
				" values".
				"('', '".$data['cid']."', '".$data['uid']."', '".$data['tid']."', '".$data['text']."', '".$data['cont']."', ".$data['plus'].", '".time()."', '".$data['type']."', '".$data['spend']."', ".$data['help'].", '".$data['push']."', '".$data['label']."');";

		$sql = "insert INTO `ux73`.`ux73_main_content` (`id_cid`, `id_uid`, `id_tid`, `main_text`, `main_input`, `number_consume`, `time_base`, `time_revise`, `status_type`) VALUES (NULL, '123', '0', '123123123', '123123', '0', '0', '0', '0');";
		return mysql_query($sql);
	}

	//添加一条用户评论记录
	// protected function data_addBuyLog($uid, $cid){
	// 	$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."logs_purchase` (`id` ,`time`, `uid`, `cid`)VALUES (NULL , ".time().", ".$uid.", ".$cid.") ;";
	// 	return mysql_query($sql);
	// }



	/********************************************
	* 查询
	*/


	// 获取内容信息，根据CID
	protected function _selectCid( $cid =0 ) {
		$sql = "select * FROM  `ux73_main_content` WHERE  `id_cid` =".$cid." ;";
		return parent::Ais($sql);
	}





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
	protected function data_selectContent( $begin=0, $pages=9, $tid=0, $grade = 0, $uid=0, $label=0 ){
		if($tid){
			if($label){
				$labelSql = "AND `label`=".$label;
			}else{
				$labelSql = "";
			}
			$sql = "select * from `".parent::Fn()."content` WHERE `titleid` = '".$tid."' AND (`verify` = 0 AND `plus` >= ".$grade.") ".$labelSql." order by `id` desc LIMIT ".$begin." , ".$pages;
		}else{
			$sql = "select * from `".parent::Fn()."content` WHERE `verify` = 0 AND `plus` >= ".$grade." order by `id` desc LIMIT ".$begin." , ".$pages;
		}

		if($uid){
			$sql = "select * from `".parent::Fn()."content` WHERE (`verify` = 0 AND `userid` = ".$uid.") AND `plus` >= ".$grade." order by `id` desc LIMIT ".$begin." , ".$pages;
		}
		echo $sql;
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
	
	//获取指定 用户UID 是否购买指定的 内容(CID)
	protected function data_userIsBuy($uid=-1, $cid=0){
		$sql = "select * FROM  `".parent::Fn()."logs_purchase` WHERE  `source_id` =".$cid." AND `out_uid` =".$uid.";";
		$row = parent::Ais($sql);
		return $row[0];
	}

	//获取指定 内容CID 的指定 时间段TIME(一天) 内容的收入总金额
	protected function data_selectSumlog($cid=0, $start=0, $end=0 ){
		$sql = "select sum(`sum`) FROM  `".parent::Fn()."logs_purchase` WHERE  `time` > ".$start." AND `time` < ".$end." AND `source_id` = ".$cid." AND `types` = 1 AND `source` = 'cid' LIMIT 1";
		$row = parent::Ais($sql);
		return $row[0] ? $row[0] : 0;
	}

	//获取指定 用户UID 的内容总数
	protected function data_selectUserTotal( $uid=0 ){
		$sql = "select COUNT( * ) FROM  `".parent::Fn()."content` WHERE  `userid` LIKE  '".$uid."'";
		$row = parent::Ais($sql);
		return $row[0] ? $row[0] : 0;
	}


	/********************************************
	* 更新 update
	*/


	//刷新指定 内容CID 的指定 字段NAME 的指定 参数VAL
	protected function data_update( $cid=0, $name='', $val=0){
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

	// 遍历数据
	protected function ergodicList_( $query ){
		$a = new Label();
		$array = array();
		if( !!$query && mysql_num_rows($query) > 0 ){	//查询是否有数据
			while( $row = mysql_fetch_array($query)){	//遍历数据

				$temp = array(
						'cid' => $row['id_cid'],
						'uid' => $row['id_uid'],
						'sum' => $row['number_sum'],
						'zan' => parent::_selectZan( $row['id_cid'], parent::_uid() ),
						'text'	=> $row['main_text'],	// 文本
						'input'	=> $row['main_input'],	// 控件
						'type'	=> $row['status_type'],	// 类型
						'label' => $a -> Guse( $row['id_cid'], $row['id_uid'] )
					);
				array_push($array, $temp);
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
	// protected function event_isBuy($cid=0, $uid=0){
	// 	if($cid){
	// 		return parent::data_userIsBuy($uid, $cid);
	// 	}
	// }

	//判断指定 用户UID（选填） 是否可以查看指定的 内容ID  
	// protected function event_isSee($cid=0, $uid=0){
	// }



	/********************************************
	* 新增 add
	*/

	// //添加指定 用户UID（选填，默认当前登录用户） 的评论指定 内容CID 的记录
	// protected function event_addBuyLog($cid=0, $uid=0){
	// 	$uid = $uid ? $uid : parent::Eid();
	// 	if($cid){
	// 		return parent::data_addBuyLog($uid, $cid);
	// 	}
	// }




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
			return parent::_update($cid, 'number_sum', $num);
		}
	}

	//更新指定 内容CID 的 点赞量
	protected function event_updateZan($cid=0, $num=0){
		if($cid && $num){
			return parent::_update($cid, 'number_zan', $num);
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
		if($cid){
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
	
	// 获取指定分数的内容列表
	public function GBsum(){

		$value = array(
			'status' => 0,
			'message' => '-'
		);

		$query = parent::_selectContent();
		$array = parent::ergodicList_($query);

		if ( $array ) {
			$value = array(
				'status' => 1,
				'message' => '成功获取列表数据',
				'res' => $array
			);
		}

		return $value;
	}








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

	// 获取内容信息
	public function Gcontent( $cid =0 ){

		$info = parent::_selectCid($cid);

		$content = array();
		$value = array(
			'status' => 0,
			'message' => '-',
			'content' => $content
		);

		if ( $info ) {
			$content = array(
					'cid' => $info['id_cid'],
					'uid' => $info['id_uid'],
					'sum' => $info['number_sum'],
					'zan' => parent::_selectZan( $info['id_cid'], parent::_uid() ),
					'text'	=> $info['main_text'],	// 文本
					'input'	=> $info['main_input'],	// 控件
					'type'	=> $info['status_type'],	// 类型
					'label' => parent::_a() -> Guse( $info['id_cid'], $info['id_uid'] )
				);
			$value = array(
				'status' => 1,
				'message' => '成功获取内容信息',
				'content' => $content
			);
		}

		return $value;
	}






	//获取内容总数量
	public function Gtotel($norm=0, $uid=0, $tid=0){
		return parent::event_getCount($norm, $uid, $tid);
	}

	//获取指定 数量的 的内容列表，可指定指定标题
	public function Glist($begin=0, $pages=15, $tid=0, $norm=0, $label=0 )
	{
		return parent::event_getList($tid, $begin, $pages, $norm, 0, $label);
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
		if($info['cont']){
			return $info['cont'];
		}
		return $info['image'];
	}

	//获取指定 内容ID 的音乐地址
	public function Gmusic($cid=0)
	{
		$info = parent::event_getByCid($cid);
		if($info['cont']){
			return $info['cont'];
		}
		return $info['music'];
	}

	//获取指定 内容ID 的视频地址
	public function Gvideo($cid=0)
	{
		$info = parent::event_getByCid($cid);
		if($info['cont']){
			return $info['cont'];
		}
		return $info['video'];
	}

	//获取指定 内容ID 的控件
	public function Gcontrol($cid=0)
	{
		$info = parent::event_getByCid($cid);
		return $info['cont'];
	}

	//获取指定 内容CID 的详细页的相关内容
	public function Ginterfix($cid=0){
		return parent::event_getInterfix($cid);
	}

	//获取指定 内容CID 的收支情况
	public function Gincome($cid=0){
		$day = 24 *60 *60;
		$begin = strtotime(date('Y-m-d',time())) + $day;
		$time = 0;

		$arr = array();
		$key = '';

		for($i=0; $i<=6; $i++){
			$time = $begin - $day * $i;
			$key = date('Y-m-d', $time-1);
			$start = $time-$day;
			$end = $time -1;

			// $arr[$key]['pay'] = parent::data_selectSumlog($cid, $start, $end);			//获取用户指定天数的支出总和
			$arr[$key]['income'] = parent::data_selectSumlog($cid, $start, $end);	//获取用户指定天数的收入总和
		}
		return $arr;
	}

	// 获取指定 用户（uid） 的内容总数
	public function GUtotal($uid=0){
		return parent::data_selectUserTotal($uid);
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
			return $this -> Iauthor($cid, $uid) || parent::data_userIsBuy($uid, $cid);
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
				case 2 : $html = "<embed class='gif' src='".$this -> Gvideo($cid)."' quality='high' wmode='Opaque' width='100%' height='100%' align='middle' allowscriptaccess='always' allowfullscreen='true' mode='transparent' type='application/x-shockwave-flash'>"; break;	//视频
				case 3 : $html = "<embed class='mp3' src='".$this -> Gmusic($cid)."' type='application/x-shockwave-flash' width='257' height='33' wmode='transparent' /> "; break;		//音乐
			}
		}
		return $html;
	}






	/********************************************
	* 添加 add
	*/

	

	//提交发布表单
	public function Acon( $text ='', $input ='', $type =0, $label =0 ){

		$a = new Label();

		$uid = parent::_uid();
		$cid = parent::_selectCount() + 1;
		$run = parent::_addContent( $uid, $text, $input, $type, $cid );

		if ( $run ) {

			if ( $label ) {
				foreach( $label as $i => $tag ) {
					$label = $a -> Alabel($tag);
					$a -> ALuse( $label['label']['id_lid'], $cid );
				}
			}
			$value = array(
				'status' => 1,
				'message' => '发布成功'
			);

		} else {
			$detail = array(
				'uid' => $uid,
				'cid' => $cid,
				// 'sql' = $run
			);
			$value = array(
				'status' => 0,
				'message' => '发布失败',
				'detail' => $detail
			);
		}

		return $value;
	}

	//提交发布表单
	public function Acon2($data=0, $type=0, $tid=0, $con='', $img='', $imgcon='', $mp3='', $mp3con='', $gif='', $gifcon='', $recommend=0, $label=0){
		$u = new Users();				
		$t = new Title();	
		$o = new Tool();

		//初始化局域计算参数
		$cid 	= $u -> Gid().time();	//生成CID
		$number = $u -> GTPnum() +1;	//获取户发布次数
		$standard = $u -> GIsd();		//获取标准支付金
		$deduct = $u -> Gsd();			//获取当前用户的基础支付金
		$share 	= 0;					//默认分享金
		$plus = 0; 						//默认标示类型

		//遍历出必要的参数
		$uid 	= parent::Eid();	
		$tid 	= isset($data['tid']) ? $data['tid'] : 0;
		$type 	= isset($data['type']) ? $data['type'] : 0;
		$text 	= isset($data['text']) ? $data['text'] : '';
		$cont 	= isset($data['cont']) ? $data['cont'] : '';
		$push 	= isset($data['push']) ? $data['push'] : 0;
		$label 	= isset($data['label']) ? $data['label'] : 0;

		//如果有指定的标题
		if($tid){				
			$share = $t -> Gshare($tid);
			if( $t -> IPSgold($tid)){				//如果分享金足够则支付
				$t -> Ushare($tid);
				$deduct = $standard - $share;
			}elseif($t -> IPFanother($tid)){		//否则，判断如果代付足够则代付支付
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

		//如果有推荐
		if($push){
			$plus = rand(60,110);				//生成内容默认金额，随机数
			$deduct = $deduct + (100 * 0.1);		//扣除 1.00 元（当前1折）
		}

		//判断用户余额是否足够
		if($u -> Gplus() >= $deduct){	
			$text= $o -> Chtml($text);			//编译描述

			//插入数据
			parent::data_Addcontent(array(
					'type' 	=> $type,
					'cid'	=> $cid,
					'uid'	=> $uid,
					'tid'	=> $tid,
					'text' 	=> $text,
					'cont'	=> $cont,

					'sum'	=> $plus,		//默认金额
					'spend'	=> $deduct,		//消费数额（含推送费）
					'help'	=> $share,		//标题代付数额
					'push'	=> $push,		//是否开启了推送
					'label'	=> $label,		//标签
				));

			//刷新发布用户信息
			$u -> UAissue();					//刷新用户发布量
			$u -> URuse();						//刷新用户最新发布时间
			$u -> USplus($deduct, 'ccid', $cid);	//刷新用户余额，扣除指定金额
		}

		//发布成功后跳转
		$u -> UtoL('userAdd.php?ok='.$cid);
	}

	// 点赞
	public function Azan( $cid =0 ){

		$uid = parent::_uid();
		$con = $this -> Gcontent($cid)['content'];

		if ( parent::_selectZan( $cid, $uid ) ) {
			$value = array(
				'status' => 0,
				'message' => '已经赞过此内容'
			);

		} else {
			parent::_addZan( $cid, $uid );
			parent::_update( $cid, 'number_zan', $con['zan'] + 1 );
			parent::_update( $cid, 'number_sum', $con['sum'] + 2 );
			$add = parent::_u() -> UAplus( 2, $con['uid'] );

			$value = array(
				'status' => 1,
				'message' => '点赞成功',
				'detail' => $add
			);
		}

		return $value;
	}

	//添加指定 用户UID（选填） 购买指定 内容CID 
	public function Abuy($cid=0, $uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$u = new Users();
		$t = new Title();
		$value = 0;
		if($cid){
			$num = 2;
			if ( $u -> Is() ) {
				$num = $num *5;			//作者默认收获，0.02 元吗，测试期间三倍收入。
			} else {
				$num = 1;
			}
			if($u -> Gplus() >= 1){			//如果用户金额足够
				if($u -> Is()){				//登录用户才能操作
					$u -> UAclick();					//用户刷新点评量
					$u -> USplus(1, 'cid', $cid);		//用户刷新的余额
					
					$tid = $this -> Gtid($cid);
					if($tid){
						$num = $num -1;			//作者刷新获得的金额，分享 1分给标题
						$t -> UAda($tid);		//标题刷新的金池，默认收入 1 分。
						$t -> Ubuy($tid);		//标题刷新的购买次数
					}
				} else {	//游客
					$u -> USplus(1, 'cid', $cid);		//用户刷新的余额
				}

				$u -> UAplus($num, 'cid', $cid, $this -> Gauthor($cid));	//作者刷新的余额

				$this -> Uplus($cid, $num);	//刷新内容金额
				$this -> UAclick($cid);		//内容刷新购买次数
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
			$info = $this -> Gcontent($cid);
			$num = $info['sum'] + $num;
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
			$u -> UAplus($value, 'dcid', $cid);	//返还发布所消耗的支付金
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

	//修改指定 内容CID 的所属标签
	public function Ulabel($cid=0, $lid=0){
		$value = 0;
		if($cid){
			$value = parent::data_update($cid, 'label', $lid);
		}
		return $value;
	}


	
}


	
//初始化全局变量
$content = new Content();
$c = new Content();



?>