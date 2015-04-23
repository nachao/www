<?php
	
	//引用逻辑文件	
	include("../comm/base.php");	

	//获取留言
	if( isset($_POST['page']) ){
		echo getMessage();
	}

	//获取留言
	if( isset($_POST['hfPage']) ){
		echo getHuifuMessagePage( $_POST['k'], $_POST['mid'], $_POST['hfPage'] );
	}


	//发布留言
	if( isset($_POST['addMessage']) ){
		$cid = $_POST['addMessage'];		//内容id
		$aim = CT_contentGetUid($cid);		//此用户的留言板
		$con = $_POST['t'];
		echo addMessage( $aim, $con, null, null, null, $cid );
	}


?>

