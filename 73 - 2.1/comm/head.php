<!doctype html>
<html lang="zh">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
		<title>七十三号馆</title>

        <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="0">

		<meta http-equiv="pragma"content="no-cache">
		<meta http-equiv="Cache-Control"content="no-cache, must-revalidate">
		<meta http-equiv="expires"content="Wed, 26 Feb 1997 08:21:57 GMT">

		<meta http-equiv="Access-Control-Allow-Origin" content="*">

		<link rel="stylesheet" type="text/css" href="./css/common.css" />
		<link rel="stylesheet" type="text/css" href="./css/ffangle.css" />
        <link rel="icon" href="./icon-red.png" type="image/gif" >

		<script type="text/javascript" src="./js/jquery-1.11.0.min.js" ></script>
		<script type="text/javascript" src="./js/angular-1.0.1.min.js"></script>

		<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<!-- 		<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script> -->

		<!-- <script type="text/javascript" src="./js/73-user.js" ></script> -->

		<script type="text/javascript" src="./js/ffangle.js" ></script>

		<!-- 引用NA功能插件 -->
		<script type="text/javascript" src="./js/na/na.js" ></script>
		<script type="text/javascript" src="./js/na/na.user.js" ></script>
	</head>
	<body>

	<div class="container" >
		
		<!-- 头部 -->
		<div class="header">
			<div class="topgap"></div>
			<div class="center">
				<div class="row">

					<!-- LOGO -->
					<div class="logo f"><a href="./" ><em>? 七十三号馆</em><i>让一切想法变的有价值.</i></a>
						<span class="version" title="2.0" >Alpha</span>
					</div>

					<!-- 菜单 -->
					<div class="menu f">
						<a href="#" title="最新最热门的内容都在这里" >首页</a>
						<!-- <a href="#" title="那些非常欣赏的作者" >我的关注</a> -->
						<a href="#" title="那些特别喜欢的内容" >收藏夹</a>
						<!-- <a href="#" title="看看别人都给你说了些什么" >私信</a> -->
						<a href="#" title="在这里把你的积分变成RMB" >提现</a>
						<a href="#" title="这里总有你需要的答案" >帮助</a>
					</div>

					<!-- 搜索 及 注册按钮 -->
					<div class="make r">
						<a class="login f" href="javascript:;" id="j_userEntry" pop="pop-4" >注册/登录</a>
						<div class="operate no f" id="j_userOperate" style="border-top-color: #e74c3c;" >
							<div class="icon"><a href="./user.php" id="j_userOperateName" ></a><i></i></div>
							<div class="link">
								<a href="javascript:;" class="price" ><span class="glyphicon glyphicon-fire"></span><em id="headGold" class="golds" n="0" ></em> <i></i></a>
								<a class="fabu" href="./userAdd.php" ><span class="glyphicon glyphicon-pencil"></span>我要发布</a>
								<a href="./user.php" title="在这里查看和管理你发布的所有内容" ><span class="glyphicon glyphicon-user"></span>内容管理</a>
								<!-- <a href="./userExchange.php" ><span class="glyphicon glyphicon-barcode"></span>提现</a> -->
								<!-- <a href="./userMessage.php" ><span class="glyphicon glyphicon-comment"></span>留言板 <i></i></a> -->
								<!-- <a href="./userTitle.php" ><span class="glyphicon glyphicon-th-list"></span>我的标题</a> -->
								<!-- <a href="./userFollow.php" ><span class="glyphicon glyphicon-ok"></span>关注的用户</a> -->
								<!-- <a href="./userWelfare.php" ><span class="glyphicon glyphicon-th-large"></span>我的能力</a> -->
								<a href="./userEffigy.php" ><span class="glyphicon glyphicon-cog"></span>个人设置</a>
								<a href="?out=1" ><span class="glyphicon glyphicon-off"></span>注销</a>
							</div>
						</div>

						<!-- 用户信息
						<input type="hidden" value="" id="userGold" />
						<input type="hidden" value="" id="userIs" />
						 -->
					</div>
					
					<div class="c"></div>
				</div>
			</div>
			<div class="bottomgap"></div>
		</div>