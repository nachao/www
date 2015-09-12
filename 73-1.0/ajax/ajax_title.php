<?php
	
	//引用文件
	include("../comm/event.php");


	//获取最新标题
	if( isset($_POST['getTitleList']) ){
		echo getTitleList();
	}

?>