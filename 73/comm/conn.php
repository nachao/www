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

		public $LPages = 9;		//列表页 内容单次显示（加载）内容数量
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
			return $uid = $u -> Guid();
		}
	
	}


	

	// echo phpinfo();








?>