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



?>

