
	<!-- 导入头部 -->
	<?php include("./comm/head.php"); ?>

	<div class="container pagecon">
		<div class="main">
			<div class="userpage center">

				<!-- 操作栏 -->
				<div class="actionbar"></div>
				<div class="leftarea f">

					<!-- 发布成功 -->
					<div class="Ncon hint-success no" id="success">
						<div class="are">
							<h1>发布成功！</h1>
							<div class="cue">每天分享一两篇优质的内容，坐等收账！</div>
							<div class="btn">
								<a class="red" href="./detail.php?cid=0" title="">确认，前往详细页</a>
								<a href="./user.php#0" title="">个人中心</a>
								<a href="./userAdd.php" >继续发布</a>
							</div>
						</div>
					</div>

					<!-- 主界面 -->
					<div class="commarea publishHead">
						<div class="content">
							<div class="head">
								<div class="tit f"><em>发布 新的内容</em></div>
								<div class="gap"><i></i></div>
							</div>

							<!-- 发布信息 开始 -->
							<form class="publish" enctype="multipart/form-data" action="" method="post" name="upform" onsubmit="return check(this);">
								<div class="nav extent">
									<a href="javascript:;">文字</a>
									<a href="javascript:;"  class="act">图片</a>
									<a href="javascript:;">视频</a>
									<a href="javascript:;">音乐</a>
								</div>
								<input id="conTypes" type="hidden" name="types" value="0" />
								<div class="main">

									<!-- 文字 -->
									<div class="col extent writing">
										<div class="tip">请填写内容<i></i></div>
										<textarea id="textDepict" class="cue txt conts" name="depict" placeholder="请输入内容" ></textarea>
										<div class="c"></div>
									</div>
									<!-- 文字 -->

									<!-- 图片 start -->
									<div class="col extent picture">
										<div class="tip">必选要选择一张图片<i></i></div>
										<div class="con">
											<div id="uploadPlugIn" style="height: 350px;" >
												<div id="altContent"></div>
											</div>
											<img id="imgHeadPhoto" src="" style="display: none;" />
											<div class="c"></div>
										</div>
										<div class="c"></div>
										<div class="are"><textarea id="imgDepict" class="cue" name="imgDepict" placeholder="描述（可以不写）" ></textarea></div>
										<input class="conts" type="hidden" value="" name="beforeimg" id="beforeimg" />
									</div>
									<!-- 图片 end -->

									<!-- 视频 -->
									<div class="col video">
										<div class="tip">请输入视频地址<i></i></div>
										<div class="con">
											<div class="hint">
												<p>视频推荐网站：
													<a href="http://www.56.com" title="访问此网站" target="_blank" >56</a>&nbsp;&nbsp;&nbsp;
													<a href="http://www.youku.com" title="访问此网站" target="_blank" >优酷</a>&nbsp;&nbsp;&nbsp;
													<a href="http://www.tudou.com" title="访问此网站" target="_blank" >土豆</a>&nbsp;&nbsp;&nbsp;
												</p>
												<p>怎么找视频地址？不知道话，请点 <a class='co' href="#" title="" >这里</a>。</p>
											</div>
											<input class="txt conts" id="j-vidsrc" type="text"  name="video"  value="" placeholder="请输入视频地址，例如：www.ffangle.com/xxx.swf" />
											<div class="c"></div>
										</div>
										<div class="result">
											<embed id="vidembed" src="" type="application/x-shockwave-flash" width="100%" height="350" allowfullscreen="true" allownetworking="all" allowscriptaccess="always">
											<div class="c"></div>
										</div>
										<div class="are"><textarea id="videoDepict" class="cue" name="videoDepict" placeholder="描述（可以不写）" ></textarea></div>
									</div>
									<!-- 视频 -->

									<!-- 音乐 start  -->
									<div class="col video music">
										<div class="tip">请输音乐地址<i></i></div>
										<div class="con">
											<div class="hint">
												<p>当前只支持 <a href="http://www.xiami.com" title="访问此网站" target="_blank" >虾米网</a> 的音乐</p>
												<p>不知道怎么添加音乐，请点 <a class='co' href="#" title="" >这里</a>。</p>
											</div>
											<input class="txt conts" id="j-mussrc" name="music" type="text"  value="" placeholder="请输入音乐地址，例如：www.ffangle.com/xxx.swf" />
											<div class="c"></div>
										</div>
										<div class="result">
											<embed id="musembed" src="" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent">
											<div class="c"></div>
										</div>
										<div class="are"><textarea id="musicDepict" class="cue" name="musicDepict" placeholder="描述（可以不写）" ></textarea></div>
									</div>

									<!-- 标签  -->
									<div class="cue-label">
										<div class="cue-label-col no j-label-templet" lid="" > 
											<div class="label-rename">
												<input class="label-rename-input" type="text" value="" />
												<div class="cue-label-btn label-rename-yes">确认</div>
												<div class="cue-label-btn label-rename-no">取消</div>
											</div>
											<div class="label-normal">
												<div class="cue-label-name"></div>
												<div class="cue-label-btn cue-label-rename" title="修改"></div>
												<div class="cue-label-btn cue-label-close" title="删除"></div>
											</div>
										</div>
										
										<!-- <div class="cue-label-col" lid="1" > 
											<div class="label-rename">
												<input class="label-rename-input" type="text" value="1" />
												<div class="cue-label-btn label-rename-yes">确认修改</div>
												<div class="cue-label-btn label-rename-no">取消修改</div>
											</div>
											<div class="label-normal">
												<div class="cue-label-name">123</div>
												<div class="cue-label-btn cue-label-rename" title="修改"></div>
												<div class="cue-label-btn cue-label-close" title="删除"></div>
											</div>
										</div> -->

										<div class="cue-label-add">
											<input class="label-add-input" type="text" style="display: none;" />
											<a class="label-add-btn label-add-yes j-manage-add-label" href="javascript:;" >添加标签</a>
											<a class="label-add-btn label-add-no j-manage-add-label-cancel" href="javascript:;" style="display: none;" >取消</a> 
										</div>
										<div class="c"></div>
									</div>

									<!-- 提交  -->
									<div class="prompt j-add-prompt" style="margin-top: 50px;">
										<a id="tipApply" class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
										<a id="submitApply" class="sub f" href="javascript:;" >发布</a>
										<!-- <input type="submit" name="submit" value="" /> -->
										<input type="hidden" value="0" name="recommend-sum" id="is-recommend" />
										<div class="tag r">需付： 
											<input id="totalTote" type="text" class="golds" n="" value="" readonly />
											元<em><i>！</i>你的金币不足</em>
										</div>
										<input type="hidden" id="deductApply" name="deductApply" value="" />
										<div class="c"></div>
									</div>

									<!-- 选择标签 -->
									<div class="publish-label-list no">
										<div id="publish-label-list">
											<a href="javascript:;" class="publish-label-col no" id="publish-label-col-templet" tid="0" >-</a>
										</div>
										<input type="hidden" name="titleLabel" id="titleLabel" value="0" />
										<div class="c"></div>
									</div>

								</div>

								<!-- 发布提交等待提示 -->
								<div class="publish-loading" id="publishLoading" >
									<div class="publish-result" id="publishResult" >
										<p>添加成功</p>
									</div>
								</div>

								<div class="c"></div>
						    </form>
							<!-- 发布信息 结束 -->

							<div class="c"></div>
						</div>
						<div class="bottomSide"></div>
					</div>

				</div>

				<!-- 侧栏 -->
				<div class="userMain no r" id="userMain" >
					<?php include("./comm/side.php"); ?>
				</div>

				<div class="c"></div>
			</div>
		</div>
	</div>

	<?php include("./comm/footer.php");	//引用底部 	?>