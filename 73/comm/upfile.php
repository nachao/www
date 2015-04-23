<?php

	//引用公共文件
	include("base.php");	

	//获取 用户数据
	$uid 	= $u -> Gicon();
	$icon 	= md5($uid.time()).'.jpg';		//头像

	//删除原来的头像
	unlink( '../effigy/'.$u -> Gicon());

	//图片存储路径
	$savePath = '../effigy/'.$icon;

	//获取参数
	$pic = base64_decode($_POST['pic1']);

	//移动文件
	file_put_contents( $savePath, $pic);

	//刷新数据
	data_userSetIcon( $uid, $icon );

	//编辑参数
	$rs['status'] = 1;
	$rs['picUrl'] = $savePath;

	//返回数据
	print json_encode($rs);



?>
