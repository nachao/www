<?php

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/






/********************************************************************************************
* 数据操作
*/
class Data_advert extends Config
{
	
	//初始化
	// function __construct(argument)
	// {
	// 	# code...
	// }



	/********************************************
	* 添加 add
	*/

	//添加广告
	// 参数说明
	// $num= 金额 ； $link= 链接 ； $name= 名称 ； $depict= 描述 ；$uid= 用户ID ；$imgs= 方图地址 ；$longimgs= 长图地址
	protected function data_addAdvert($uid=0, $num=0, $link='', $name='', $depict='', $imgs='', $longimgs=''){
		$sql = "insert INTO  `".parent::Mn()."`.`".parent::Fn()."ad` (`id` , `icon` , `link` , `cue` , `num` , `user`, `userid`, `describe`, `imgs`, `longimgs`, `lastdate` ) VALUES (NULL ,  NULL,  '".$link."',  '".$name."',  '".$num."',  NULL,  '".$uid."', '".$depict."', '".$imgs."', '".$longimgs."', '".time()."'); ";
		return mysql_query($sql);
	}



	/********************************************
	* 查询 select
	*/

	//获取指定 广告AID 的全部信息
	protected function data_selectAdvert($aid=0){
		$sql = "select * FROM  `".parent::Fn()."ad` WHERE  `id` LIKE  '".$aid."' LIMIT 0 , 1";
		return parent::Ais($sql);
	}

	//获取竞价第一名资料
	protected function data_selectFirst($time=0){
		$sql = "select * FROM  `".parent::Fn()."ad` WHERE `id` != 1 AND `lastdate` > ".$time." ORDER BY  `num` DESC LIMIT 0 , 1";
		return parent::Ais($sql);
	}

	//获取前 30 个竞价记录，不包含第一名
	protected function data_selectList($bpa=0, $time=0, $num=30){
		$sql = "select * FROM  `".parent::Fn()."ad` WHERE  `id` !=".$bpa." AND (`id` != 1 AND `lastdate` > ".$time.") ORDER BY  `num` DESC LIMIT 0 , ".$num;
		return mysql_query($sql);
	}

	//获取指定 用户UID 的竞价一条广告信息
	protected function data_selectUserAdvert($uid=0, $time=0){
		$sql = "select * FROM  `".parent::Fn()."ad` WHERE  `userid` LIKE  ".$uid." AND `lastdate` > ".$time." ORDER BY  `id` DESC LIMIT 0 , 1";
		return parent::Ais($sql);
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 广告AID 的指定 字段STR 的指定 参数VAL
	protected function data_update($aid=0, $str='', $val=0){
		$sql = "update  `".parent::Mn()."`.`".parent::Fn()."ad` SET  `".$str."` =  '".$val."' WHERE  `".parent::Fn()."ad`.`id` ='".$aid."' LIMIT 1 ;";
		return mysql_query($sql);
	}

	//刷新当前广告参数初始化
	protected function data_updateInit(){
		$sql = "update `".parent::Mn()."`.`".parent::Fn()."ad` SET  `link` =  '', `cue` =  '', `num` =  '', `userid` =  '', `describe` =  '', `imgs` =  '', `longimgs` =  '', `subsidize` =  '' WHERE  `".parent::Fn()."ad`.`id` =1;";
		return mysql_query($sql);
	}


}







/********************************************************************************************
* 逻辑层 
*/
class Event_advert extends Data_advert
{

	//默认私有变量
	private $info;
	private $userid;


	/********************************************
	* 获取 get
	*/

	//获取指定 广告AID 的信息
	protected function event_getAdvert($aid=0){
		if($aid){
			return parent::data_selectAdvert($aid);
		}
	}

	//获取第一名的广告信息
	protected function event_getFirst($time=0){
		return parent::data_selectFirst($time);
	}

	//获取除了第一名之外的，前三十名资料
	protected function event_getList($time=0, $num=30, $fid=0){
		$array = array();
		if(!$fid){
			$first = $this -> data_selectFirst($time);
			if($first){
				$fid = $first['id'];
			}else{
				$fid = 0;
			}
		}
		$query = parent::data_selectList($fid, $time, $num);
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				array_push($array, $row);
			}
		}
		return $array;
	}

	//获取指定 用户UID 的广告信息
	protected function event_getUserAdvert($uid=0, $time=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectUserAdvert($uid, $time);
	}

	//获取指定 当前的广告信息
	protected function event_getNowAdvert(){
		return parent::data_selectAdvert(1);
	}

	//获取指定 上次更新广告时间
	protected function event_getLastTime(){
		$info = parent::data_selectAdvert(1);
		return $info['lastdate'];
	}





	/********************************************
	* 刷新 update
	*/

	//刷新指定 广告AID 的 金额NUM
	protected function event_updateSum($aid=0, $num=0){
		if($aid){
			return parent::data_update($aid, 'num', $num);		
		}
	}

	//刷新指定 广告AID 的 资助金额NUM
	protected function event_updateSubsidize($aid=0, $num=0){
		if($aid){
			return parent::data_update($aid, 'subsidize', $num);		
		}
	}

	//刷新指定 广告AID 的 链接HREF
	protected function event_updateLink($aid=0, $href=''){
		if($aid){
			return parent::data_update($aid, 'link', $href);		
		}
	}

	//刷新指定 广告AID 的 名称NAME
	protected function event_updateName($aid=0, $name=''){
		if($aid){
			return parent::data_update($aid, 'cue', $name);		
		}
	}

	//刷新指定 广告AID 的 描述depict
	protected function event_updateDepict($aid=0, $depict=''){
		if($aid){
			$o = new Tool();
			return parent::data_update($aid, 'describe', $o -> Chtml($depict));		
		}
	}

	//刷新指定 广告AID 的 方图SRC
	protected function event_updateImgs($aid=0, $src=''){
		if($aid){
			return parent::data_update($aid, 'imgs', $src);		
		}
	}

	//刷新指定 广告AID 的 长图SRC
	protected function event_updateLongimgs($aid=0, $src=''){
		if($aid){
			return parent::data_update($aid, 'longimgs', $src);		
		}
	}

	//刷新站广告
	protected function event_updateRenewalAd(){
		$info = $this -> event_getFirst(time());
		if($info){
			parent::data_update(1, 'cue', $info['cue']);
			parent::data_update(1, 'num', $info['num']);
			parent::data_update(1, 'userid', $info['userid']);
			parent::data_update(1, 'describe', $info['describe']);
			parent::data_update(1, 'imgs', $info['imgs']);
			parent::data_update(1, 'longimgs', $info['longimgs']);
			parent::data_update(1, 'subsidize', $info['subsidize']);
		}else{
			parent::data_update(1, 'longimgs', './imgs/not-ad.png');
		}
		parent::data_update(1, 'lastdate', time());
		return 	time();	
	}

	//刷新初始化显示广告
	protected function event_updateInit(){
		return parent::data_updateInit();
	}


	/********************************************
	* 新增 add
	*/

	//新增广告
	protected function event_addAdvert($num=0, $link='', $name='', $describe='', $imgs='', $longimgs='' ){
		$first = $this -> Gfirst();

		//如果有第一名的话
		// if($first){
			// $num = $first['num'] + $num;
		// }
		$u = new Users();
		$o = new Tool();

		parent::data_addAdvert($u -> Guid(), $num, $o -> Chtml($link), $o -> Chtml($name), $o -> Chtml($describe), $imgs, $longimgs );	//新增

		$u -> USplus($num);		//刷新用户的金币数量

		//刷新页面
		$u -> UtoL('./ad.php');

		// if( $first ){
		// 	//退回之前第一名的金币
		// 	$fuser = userAllId( $fuid );
		// 	$fplus = $fuser['plus'];
		// 	userPlusSet( $fplus + $fnum, $fuid );
		// }
	}


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
class Advert extends Event_advert
{

	/********************************************
	* 获取 get
	*/

	//获取指定 广告AID 的信息
	public function Gad($aid=0){
		return parent::event_getAdvert($aid);
	}

	//获取指定 用户UID 最新的一条广告信息
	public function GUad($time=0, $uid=0){
		return parent::event_getUserAdvert($uid, $time);
	}

	//获取本周第一名广告
	public function Gfirst(){
		return parent::event_getFirst($this -> Gbegin());
	}

	//获取本周第一名的 广告金额
	public function GFsum(){
		$info = parent::event_getFirst($this -> Gbegin());
		return $info['num'];
	}

	//获取本周 前指定位数NUM（默认前30位） 的广告资料，可选择是否显示第一名（默认不显示）
	public function Glist($num=30, $isone=0){
		return parent::event_getList($this -> Gbegin(), $num, $isone);
	}

	//获取本周竞价开始的时间戳
	public function Gbegin(){
		date_default_timezone_set('PRC');		//时间标准	
		return strtotime(date('Y-m-d', strtotime('-'.(date("N",time()) -1).'day')));
	}

	//获取今天距离下周一的时间戳
	// public function Grange(){
	// 	date_default_timezone_set('PRC');		//时间标准	
	// 	$week = date("N",time());				//今天的星期 
	// 	$aday = strtotime('+1day') - time();	//一天的时间戳
	// 	$now  = strtotime(date('Y-m-d'));		//当前时间
	// 	return $now +((8 -$week) *$aday) -time();
	// 	// return (parent::event_getLastTime() + 7 * (strtotime('+1day') - time())) -time();
	// 	// return date('Y-m-d H:m:s', $now +((8 -$week) *$aday));
	// }

	//获取广告是否超过有效期(一个星期)
	public function Grange(){
		date_default_timezone_set('PRC');		//时间标准	
		$week = date("N",time());				//今天的星期 
		$aday = strtotime('+1day') - time();	//一天的时间戳
		$now  = strtotime(date('Y-m-d'));		//当前时间
		// return $now +((8 -$week) *$aday) -time();
		// return ((8 -$week) *$aday);

		return time() -parent::event_getLastTime() -((8 -$week) *$aday) > 0;
		// return (parent::event_getLastTime() + 7 * (strtotime('+1day') - time())) -time();
		// return date('Y-m-d H:m:s', $now +((8 -$week) *$aday));
	}

	//获取当前广告的全部信息
	public function GAnow(){
		return parent::event_getNowAdvert();
	}

	//获取当前广告的 方广告
	public function GAsquare(){
		$info = parent::event_getNowAdvert();
		return $info['imgs'];
	}

	//获取当前广告的 方广告
	public function GAoblong(){
		$info = parent::event_getNowAdvert();
		return $info['longimgs'];
	}




	/********************************************
	* 判断 is
	*/
	
	//判断指定 用户UID（选） 是否有广告，可选本周TIME（选，默认为不限时间）
	public function Iad($time=0, $uid=0){
		$value = parent::event_getUserAdvert($uid, $time);
		return !empty($value);
	}
	
	//判断指定 用户UID（选） 是否为本周第一名
	public function Ione($uid=0){
		$uid = $uid ? $uid : parent::Eid();
		$info = $this -> Gfirst($this -> Gbegin());
		return $info['userid'] == $uid;
	}

	//判断是否达到更换广告标准
	// public function ICad(){
	// 	return time() > time() +$this -> Grange();
	// 	// return time() > parent::event_getLastTime() + 7 * (strtotime('+1day') - time());
	// }




	/********************************************
	* 刷新 update
	*/

	//刷新指定 广告AID ，用户添加自己的广告的竞价 金额NUM
	public function UAsum($aid=0, $num=0){
		if($aid){
			$u = new Users();
			$info = $this -> Gad($aid);

			//判断用户余额是否足够
			if($u -> Gplus() > $num){
				$u -> USplus($num);		//扣除金额
				return bididingAidSet($aid, $num + $info['num']);	//刷新广告总金额
			}
		}
	}

	//刷新指定 广告AID 资助 金额NUM
	public function UAfinancially($aid=0, $num=0){
		if($aid){
			$u = new Users();
			$info = $this -> Gad($aid);

			//判断余额是否足够
			if($u -> Gplus() > $num){
				$u -> USplus($num);			//扣除用户金额
				parent::event_updateSubsidize($aid, $num + $info['subsidize']);	//刷新资助金额
				return parent::event_updateSum( $aid, $num + $info['num']);		//刷新总金额
			}
		}
	}

	//刷新指定 广告AID 对应表单的信息
	public function Urevise($aid=0, $link='', $name='', $depict='', $imgs='', $longimgs=''){
		$info = $this -> Gad($aid);
		if($link && $link != $info['link']){
			parent::event_updateLink($aid, $link);	//修改链接
		}
		if($name && $name != $info['cue']){
			parent::event_updateName($aid, $name);	//修改广告名称
		}
		if($depict && $depict != $info['describe']){
			parent::event_updateDepict($aid, $depict);	//修改广告描述
		}
		if($imgs && $imgs != $info['imgs']){
			parent::event_updateImgs($aid, $imgs);	//修改方图片
		}
		if($longimgs && $longimgs != $info['longimgs']){
			parent::event_updateLongimgs($aid, $longimgs);	//修改长图片
		}

		redirect('../ad.php');	//刷新页面
	}

	//刷新更换广告时间
	public function UCad(){
		return parent::event_updateRenewalAd();
	}

	//初始化广告位
	public function Uinit(){
		return parent::event_updateRenewalAd();
	}




	/********************************************
	* 新增 add
	*/

	//新增广告
	public function Anew($num=0, $link='', $name='', $describe='', $imgs='', $longimgs='' ){
		return parent::event_addAdvert( $num, $link, $name, $describe, $imgs, $longimgs );	//新增
	}



	/********************************************
	* 操作 use
	*/

	//跳转至 内容列表页
	public function UtoL(){
		return parent::event_useSkip('list.php');
	}
	
}




//赋值数据
$advert = new Advert();
$a = new Advert();



?>