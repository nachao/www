<?php

	//本地测试
	$dname = "ux73";
	$daddress = "localhost";
	$daccount = "root";
	$dpwd = "";


	//服务器
	// $dname = "ux73";
	// $daddress = "ux73.gotoftp2.com";
	// $daccount = "ux73";
	// $dpwd = "22xs5kpfux73";


	//表单规则
	$dfrom = "ux73_";

	//链接
	$conn = @ mysql_connect($daddress, $daccount, $dpwd);
	mysql_select_db($dname, $conn);
	mysql_query("SET NAMES 'UTF8'"); 



	//配置信息
	class Config{

		public $HGrade = 10;	//首页内容的最低分
		public $PGrade = 5;		//首页内容的最低分

		public $Verify = 0;		//显示指定状态的内容，所有内容发布后默认显示为 0；

		public $LPages = 30;		//列表页 内容单次显示（加载）内容数量
		
		public $UPages = 9;		//用户页 内容单次显示（加载）内容数量
		public $TLists = 9;		//标题页 内容单次显示（加载）内容数量


		//判断
		protected function Ais($sql){
			$val = mysql_query($sql);
			return $val ? mysql_fetch_array($val) : false;
		}

		//数据库名
		protected  function Mn(){
			global $dname;
			return $dname;
		}

		//数据库名
		protected  function Fn(){
			global $dfrom;
			return $dfrom;
		}

		//获取当前登录用户的 ID
		//#调用方式 	
		// $uid = $uid ? $uid : parent::Eid();
		protected function Eid(){
			$u = new Users();
			return $u -> Guid();
		}

		//获取指定的数据列表，可以遍历所需字段
		protected function Garr($query, $funs){
			$array = array();
			if( !!$query && mysql_num_rows($query) > 0 ){	//判断是否有内容
				while( $row = mysql_fetch_array($query)){	//遍历数据
					$row = $funs($row);
					array_push($array, $row);
				}
			}
			return $array;
		}

		//判断是否有值
		protected function Is($val ,$default=0){
			if(isset($val) && $val){
				$val = $val;
			}else{
				$val = $default;
			}
			return $val;
		}

		//获取系统Status值说明
		public function log($key){
			switch ($key) {
				case 0: $msg = '操作成功'; break;
				
				case 1000: $msg = '参数不完整'; break;

				case 1100: $msg = '余额不足'; break;

				case 1200: $msg = 'SQL执行失败'; break;

				case 1300: $msg = '标题已存在'; break;
				
				default: $msg = '未知错误'; break;
			}
			return $msg;
		}
	
	}



	//获取配置参数
	$cf = new Config();
	

	// echo phpinfo();








?>