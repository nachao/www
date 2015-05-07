<!doctype html>
<html lang="zh">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	    <!-- <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
		<title>七十三号馆</title>
        <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="0">

		<meta http-equiv="pragma"content="no-cache">
		<meta http-equiv="Cache-Control"content="no-cache, must-revalidate">
		<meta http-equiv="expires"content="Wed, 26 Feb 1997 08:21:57 GMT">
		<link rel="stylesheet" type="text/css" href="./css/common.css" />
		<link rel="stylesheet" type="text/css" href="./css/ffangle.css" />
        <link rel="icon" href="./myicon-ico.png" type="image/gif" >
		<script type="text/javascript" src="./js/jquery-1.11.0.min.js" ></script>
		<script type="text/javascript" src="./js/ffangle.js" ></script>
	</head>
	<body>
		
<?php 
	

	//判断是否更换广告
	if($a -> ICad()){ 
		$a -> UCad(); 	
	}
	
	//广告数据
	$ad = $a -> GAnow();

?>


		<div class="container">
		
			<!-- 头部 -->
			<div class="header">
				<div class="topgap"></div>
				<div class="center">
					<div class="row">

						<!-- LOGO -->
						<div class="logo f"><a href="./" ><em>七十三号馆</em><i>没有交易功能的微博不是一个好论坛</i></a></div>

						<!-- 广告 -->
						<div class="advert r">
							<a href="<?php echo $ad['link'] ? $ad['link'] : 'javascript:;'; ?>" title="《<?php echo $ad['cue']; ?>》独家赞助" >
								<img src="<?php echo $ad['longimgs']; ?>" />
							</a>
						</div>

						<div class="c"></div>
					</div>
					<div class="row">
						
						<!-- 菜单 -->
						<?php 
						//设置选择菜单
						// Global $ect;
						// $ect="index";

						include("./comm/headMenu.php"); ?>

						<!-- 搜索 及 注册按钮 -->
						<?php include("./comm/headMake.php"); ?>
						
						<div class="c"></div>
					</div>
				</div>
				<div class="bottomgap"></div>
			</div>
