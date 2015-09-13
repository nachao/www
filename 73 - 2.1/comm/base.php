<?php

	//定义根目录边变量
	define("ROOT_PATH", dirname(__DIR__)."/");
	
	//配置文件
	include("conn.php");

	//引用公共功能
	include("Main_Comm.php");

	//引用用户功能
	include("Main_User.php");

	//引用用户 - 徽章功能
	include("Main_User_Badge.php");

	//引用用户 - 留言功能
	include("Main_User_Message.php");

	//引用用户 - 兑换功能
	include("Main_User_Exchange.php");

	//引用用户 - 游客功能
	include("Main_User_Visitor.php");

	//引用用户 - 教程功能
	include("Main_User_Course.php");

	//引用内容功能
	include("Main_Content.php");

	//引用标题功能
	include("Main_Title.php");

	//引用标题标签功能
	// include("Main_Title_Label.php");

	//引用标签功能
	include("Main_Label.php");

	//引用广告功能
	include("Main_Advert.php");

	//引用后台管理功能
	include("Main_Admin.php");
	


	//初始化默认页面
	$ect="";

?>
