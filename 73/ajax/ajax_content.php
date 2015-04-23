<?php
	
	//引用文件
	include("../comm/event.php");

	//获取内容数据
	if( isset($_POST['seat']) ){

		// echo 111111111;

		//判断是否获取单个内容
		if( isset($_POST['contentid']) && $_POST['contentid'] ){
			echo getAssignContent();
		}else{
			echo getContent();
		}
	}

	//获取关注总数
	if( isset( $_POST['gzNum'] ) ){
		echo contentGzNum( uid() );
	}


?>