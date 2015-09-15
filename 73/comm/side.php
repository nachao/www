			
	<!-- 基本信息 -->
	<div class="um-base">
		<div class="userInfo" >
			<div class="withdraw"><a href="#" title="修改资料" ></a></div>
			<div class="icon f">
				<a href="#" ><img id="userInfoIcon" src="<?php echo './icon/26.jpg'//u -> Gicon(); ?>" /></a>
			</div>
			<div class="info f">
				<div class="price">
					<em id="userInfoGold" class="golds" n="<?php echo '100'//$u -> Gplus(); ?>"></em><i>元</i>
				</div>
				<div class="name" >
					<input class="name-edit-input" id="userInfoName" type="text" value="" readonly="true" />
					<a class="name-edit-btn name-edit-revise" id="nameEdit" href="javascript:;" >修改</a>
					<a class="name-edit-btn name-edit-yes" id="nameEditYes" href="javascript:;" >确认</a>
					<a class="name-edit-btn name-edit-no" id="nameEditNo" href="javascript:;" >取消</a>
				</div>
			</div>
			<div class="c"></div>
			<div class="depict no"><?php echo '暂无描述'//$u -> Gdepict(); ?></div>
			<div class="c"></div>
		</div>
	</div>

	<!-- 最新评论 -->
	<div class="um-comment commarea">
		<div class="content">
			<div class="head">
				<div class="tit f"><i class="iconfont icon-kafeiting"></i><em>最新评论</em></div>
				<div class="gap"><i></i></div>
			</div>
			<div class="messageBoard">
				<div class="message-publish no">
					<textarea class="message-p-text" id="messagePText" placeholder="请输入评论" ></textarea>
					<a class="message-p-btn" id="messagePBtn" href="javascript:;">发布</a>
				</div>
				<div class="c"></div>
				<div class="message-loading no" id="messageLoading"></div>
				<div class="message-node" id="messageNot">没有内容</div>
				<div class="message-list" id="messageList">
					<div class="message-title">全部评论</div>
					<div class="message-rows" id="messageTemplet" style="display: none;" >
						<div class="message-r-icon">
							<a href="javascript:;" ><img src="" /></a>
						</div>
						<div class="message-r-info">
							<div class="message-i-name">
								<a href="javascript:;" ></a>
							</div>
							<div class="message-i-text"></div>
							<div class="message-i-other">
								<div class="message-o-time"></div>
								<div class="message-o-use">
									<a class="message-u-good" href="javascript:;" title="" >赞 <span>0</span></a>
									<a class="message-u-bad" href="javascript:;" title="" >踩 <span>0</span></a>
									<a class="message-u-reply" href="javascript:;" title="" >回复</a>
								</div>
								<div class="c"></div>
							</div>
							<div class="message-i-reply">
								<textarea class="message-reply-text" id="messageReplyText" placeholder="请输入评论" ></textarea>
								<a class="message-reply-btn" id="messageReplyBtn" href="javascript:;">回复</a>
							</div>
							<div class="c"></div>
						</div>
					</div>
				</div>
				<div class="message-page" >
					<a class="message-page-btn message-pa-next" href="javascript:;" >&gt;</a>
					<div class="message-page-current">
						<div class="message-current-use">
							<a href="javascript:;" >1</a>
							<a href="javascript:;" >2</a>
							<a href="javascript:;" >3</a>
						</div>
						<div class="message-current-num"><span>1</span><i></i></div>
					</div>
					<a class="message-page-btn message-page-prev" href="javascript:;" >&lt;</a>
				</div>
				<div class="c"></div>
			</div>
		</div>
		<div class="bottomSide"></div>
	</div>