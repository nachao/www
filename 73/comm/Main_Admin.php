<?php

//引用逻辑层
// include("begin_admin.php");	

//引用逻辑层
// include("begin_title.php");	

/********************************************************************************************
* 公共操作
*/
// class Comm_admin extends Config
// {	
// }



/********************************************************************************************
* 数据操作
*/
class Data_admin extends Config
{


	/********************************************
	* 添加
	*/

	//添加指定 用户UID 的徽章记录
	protected function data_addBanner($bid=0, $src='', $cid=0, $tid=0){
		$sql = "insert INTO `".parent::Mn()."`.`".parent::Fn()."banner` (`id`, `bid`, `time`, `src`, `cid`, `tid`) VALUES (NULL, ".$bid.", ".time().", '".$src."', '".$cid."', '".$tid."');";
		return mysql_query($sql);
	}


	/********************************************
	* 删除
	*/

	//删除指定 焦点图BID信息
	protected function data_delete($bid=0){
		$sql = "delete FROM `".parent::Mn()."`.`".parent::Fn()."banner` WHERE `".parent::Fn()."banner`.`bid` = ".$bid." ;";
	}



	/********************************************
	* 查询
	*/

	//获取全部 焦点图信息
	protected function data_selectAll(){
		$sql = "select * FROM  `".parent::Fn()."banner` LIMIT 0 , 30";
		return mysql_query($sql);
	}

	//获取指定 焦点图BID 的信息
	protected function data_selectOne($bid=0){
		$sql = "select * FROM  `".parent::Fn()."banner` WHERE  `bid` =".$bid;
		return parent::Ais($sql);
	}

	//获取指定 状态VAL 的全部焦点图列表
	protected function data_selectStatus($val=0){
		$sql = "select * FROM  `".parent::Fn()."banner` WHERE  `status` =".$val." ORDER BY  `order` ASC;";
		return mysql_query($sql);
	}



	/********************************************
	* 刷新 update
	*/

	//刷新指定 焦点图BID 的指定 字段STR 的指定 参数VAL 
	protected function data_updateBanner($bid=0, $str='', $val=0){
		$sql = "update `".parent::Mn()."`.`".parent::Fn()."banner` SET  `".$str."` =  '".$val."' WHERE `bid` =".$bid." ;";
		return mysql_query($sql);
	}


}







/********************************************************************************************
* 控制器 实现每个方法完全 独立，处理不同的数据需求，执行成功返回值，否则无反应
*/
class Event_admin extends Data_admin
{


	/********************************************
	* 获取 get
	*/


	//获取指定 用户UID 的指定 徽章BID 信息
	protected function event_getBadgeInfo($uid=0, $bid=0){
		$uid = $uid ? $uid : parent::Eid();
		return parent::data_selectBadgeInfo($uid, $bid);
	}

	//获取制定 状态VAL（默认为输出全部开启状态的） 的全部焦点图列表
	protected function event_getList($val=1){
		$c = new Content();
		$t = new Title();
		$array = array();
		$query = parent::data_selectStatus($val);
		if( !!$query && mysql_num_rows($query) > 0 ){	//遍历数据
			while( $row = mysql_fetch_array($query)){	//获取单个内容数
				$cid = $row['cid'];
				$tid = $row['tid'];

				$row['href'] = "javascript:;";

				//判断
				if($cid){ 
					$row['tid'] = $c -> Gtid($cid);
					$row['text'] = $c -> Gcon($cid); 
					$row['time'] = $c -> Gtime($cid);
					$row['href'] = "./detail.php?cid=".$cid;
					$row['author'] = $c -> Gauthor($cid);
				}
				if($tid){ 
					$row['text'] = $t -> Gcontent($tid); 
					$row['time'] = $t -> GUtime($tid);
					$row['href'] = "./list.php?tid=".$tid;
					$row['author'] = $t -> Gcreator($tid);
				}
				array_push($array, $row);
			}
		}
		return $array;
	}



	/********************************************
	* 刷新 update
	*/


	//刷新指定 焦点图BID 的状态（默认为关闭）
	protected function event_updateStatus($bid=0, $val=0){
		if($bid){
			parent::data_updateBanner($bid, 'status', $val);
			return $bid;
		}
	}
	//刷新指定 焦点图BID 的图片地址
	protected function event_updateAdderss($bid=0, $src=0){
		if($bid){
			parent::data_updateBanner($bid, 'src', $src);
			return $bid;
		}
	}



	/********************************************
	* 添加 add
	*/

	//添加指定焦点图
	protected function event_addBanner($src='', $cid=0, $tid=0){
		$bid = '73'+time();
		parent::data_addBanner($bid, $src, $cid, $tid);
		return $bid;
	}




	/********************************************
	* 删除 delete
	*/

	//删除指定 焦点图UID
	protected function event_delete($bid=0){
		parent::data_delete($bid);
		return $bid;
	}








	/********************************************
	* 操作 use
	*/

}










/********************************************************************************************
* 逻辑层 和 样式层  	#只需根据页面需要，调用对应的逻辑层的对象方法，只要 调用（可以同级，可以父级） 和 判断
*/
class Admin extends Event_admin
{

	/********************************************
	* 获取 get
	*/

	//获取全部开启的焦点图
	public function Gbanner(){
		return parent::event_getList();
	}


	/********************************************
	* 判断 is
	*/
	




	/********************************************
	* 刷新 update
	*/

	//刷新制定 焦点图BID 开启焦点图
	public function UBact($bid){
		return parent::event_updateStatus($bid, 1);
	}

	//刷新制定 焦点图BID 关闭焦点图
	public function UBclose($bid){
		return parent::event_updateStatus($bid);
	}

	//刷新制定 焦点图BID 的图片地址
	public function UBsrc($bid=0 ,$src=''){
		return parent::event_updateAdderss($bid, $src);
	}



	/********************************************
	* 添加 add
	*/

	//添加焦点图，默认状态为关闭
	public function Abanner($src='', $cid=0, $tid=0){
		return parent::event_addBanner($src, $cid, $tid);
	}


	/********************************************
	* 删除 delete
	*/

	//删除制定焦点图BID
	public function Dbanner($bid=0){
		return parent::event_delete($bid);
	}




	/********************************************
	* 操作 use
	*/


	
}




//赋值数据
$admin = new Admin();



?>