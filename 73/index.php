
	<!-- 导入头部 -->
	<?php include("./comm/head.php"); ?>

	<div class="container pagecon Lite">
		<div class="main">
			<div class="center">

				<!-- 操作栏 -->
				<div class="actionbar">
					<div class="actionbar-filter">
						<a href="javascript:;">热门</a>
						<a href="javascript:;">最新</a>
					</div>
					<div class="actionbar-filter">
						<input type="text" placeholder="标签" />
						<a href="javascript:;">搜索</a>
					</div>
					<div class="actionbar-filter">
						<input type="text" placeholder="用户" />
						<a href="javascript:;">搜索</a>
					</div>
				</div>

				<!-- 内容列表 -->
				<div class="contentList f" tote="" id="contentList" >
					<?php include("./comm/item.php"); ?>
				</div>

				<!-- 侧栏 -->
				<div class="userMain no r" id="userMain" >
					<?php include("./comm/side.php"); ?>
				</div>

				<div class="c"></div>

				<!-- 首页分页按钮 -->
				<div class="loadMore no">
					<a id="loadmore" href="javascript:;" uid="0" tid="0" >加载更多内容<i></i></a>
				</div>

				<div class="c"></div>
			</div>
		</div>
	</div>

	<!-- 导入所有弹出框 -->
	<?php include("./comm/pops.php"); ?>

	<!-- 导入底部 -->
	<?php include("./comm/footer.php"); ?>
