<?php
	
	//引用公共文件
	include("./comm/base.php");		

	//引用样式头部
	// include("./comm/head.php");		
?>
<!doctype html>
<html lang="zh">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	    <!-- <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
		<title>首页</title>
        <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="0">

		<meta http-equiv="pragma"content="no-cache">
		<meta http-equiv="Cache-Control"content="no-cache, must-revalidate">
		<meta http-equiv="expires"content="Wed, 26 Feb 1997 08:21:57 GMT">
		<link rel="stylesheet" type="text/css" href="./css/ffangle.css" />
		<link rel="stylesheet" type="text/css" href="./css/comm.css" />
        <link rel="icon" href="./myicon-ico.png" type="image/gif" >
		<script type="text/javascript" src="./js/jquery-1.11.0.min.js" ></script>
		<script type="text/javascript" src="./js/ffangle.js" ></script>
	</head>
	<body>

		<?php 
		//首页
		if( !isset($_GET['go']) ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a class="act" href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
					<a href="?go=gidd" title="">更新</a>
				</div>
				<div class="main">
					<h1><span>快速入手</span><i>此网站的意义在于你的 点赞</i></h1>
					<div class="col">
						<h2><i>第一步</i>登录与注册</h2>
						<img src="./help/index-1.png" />
						<p>真正让你体验到方便与快捷。</p>
						<p>不管是登录还是注册，都只需输入账号和密码就可以进入了。</p>
						<p>首次登陆就送 金币。</p>
					</div>
					<div class="col">
						<h2><i>第二步</i>关注标题</h2>
						<img src="./help/index-2.png" />
						<p>进入<a class="?go=title" >标题</a>菜单，一键关注！</p>
						<p>参与自己感兴趣的任何 活动，专题，讨论等，还有机会赢取奖励。</p>
					</div>
					<div class="col">
						<h2><i>第三步</i>发布内容</h2>
						<img src="./help/index-3.png" />
						<p>可以直接<a class="?go=add" >发布</a>，也可以选择标题后发布。</p>
						<p>每次发布会消耗 7 枚金币，如果你选择标题发布的话，则只需要支付 3 枚（因为标题会帮你分担，如果它的金币池里还有金币的话）。</p>
					</div>
					<div class="col">
						<h2><i>第四步</i>世界与点评</h2>
						<img src="./help/index-4.png" />
						<p><a class="?go=world" >世界</a>里的内容，都是点赞过 百才能看到的比较好的内容。</p>
						<p>每次点赞，都会消耗 1 枚<a class="?go=plus">金币</a>。</p>
						<p>点赞后，作者会收获 金币。</p>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//世界
		if( isset($_GET['go']) && $_GET['go'] == 'world' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a class="act" href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>世界</span><i>Look at the world from here</i></h1>

					<div class="col">
						<h2><i>1.01.3.50209</i>2015年2月9日 更新内容</h2>
						<p>1.01.1-001.502091630</p>
						<p>添加反馈页面及功能，在个人管理下拉列表中可以找到。</p><br />
						<p>1.01.2-087.502092225</p>
						<p>用户侧栏信息中，添加了最近访问此用户的用户访问记录。</p><br />
						<p>1.01.3-003.502092322</p>
						<p>用户的个人设置中优化了更新个人描述。</p>
					</div>

					<div class="col">
						<h2><i>1.00.0.50208</i>2015年2月8日 更新内容</h2>
						<p>1.01.1-001.502091630</p>
						<p>添加反馈页面及功能，在个人管理下拉列表中可以找到。</p><br />
						<p>1.01.2-087.502092225</p>
						<p>用户侧栏信息中，添加了最近访问此用户的用户访问记录。</p><br />
						<p>1.01.3-003.502092322</p>
						<p>用户的个人设置中优化了更新个人描述。</p>
					</div>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>今天有什么有趣的事情去，来 73 的 “世界” 看看吧。</p>
						<p>这里只显示所有过 百 点赞的内容，你只需一直往下翻就可以了。</p>
						<p>当前最新版本：1.01.3.50209</p><br />
						<p>1.01.1-001.1630</p>
						<p>添加反馈页面及功能，在个人管理下拉列表中可以找到。</p><br />
						<p>1.01.2-087.2225</p>
						<p>用户侧栏信息中，添加了最近访问此用户的用户访问记录。</p><br />
						<p>1.01.3-003.2322</p>
						<p>用户的个人设置中优化了更新个人描述。</p>
					</div>

					<div class="col">
						<h2><i>使用</i></h2>
						<p>每天内容，可以查看发布者信息。如下：</p>
						<img src="./help/world-1.jpg"/>
						<p>鼠标放在作者头像图标时，会显示作者的详细信息。以及会显示一些操作按钮。</p>
						<p><b>访问</b>：直接跳转至作者的 <a href="?go=user" >个人中心</a> ,查看作者的详细信息，留言，或者查看作者的发布的 其他内容。</p>
						<p><b>关注</b>：关注用户后，在世界页面上方可以选择 “关注” 选项，系统会赛选出所有你关注用户发布的最新内容。</p><br />
						<p><b>点赞</b>：所有的内容，都不能发布评论，你唯一需要做的就只是，翻阅各种资讯、视频、音乐，遇到喜欢的点个赞。是的，就这么简单。</p>
						<p><b>点击标题</b>：你会看到所有此标题的内容。</p>

					</div>

					<div class="col">
						<h2><i>点赞</i></h2>

						<p><b>用户</b>：每当你点赞一条内容后，你会支付 1 枚金币给内容的作者，这枚<a href="?go=plus">金币</a>可以看做对作者的 认可或感谢。</p>
						<p><b>系统</b>：当你点赞后，系统也会支付 1 枚金币，如果点赞的内容附带标题，那么标题的金币池会得到这枚金币。如果内容没有标题，则作者会得到这枚金币。</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//标题
		if( isset($_GET['go']) && $_GET['go'] == 'title' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a class="act" href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>标题</span><i>Things of one kind come together</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>“标题的好坏是可以决定一篇文章成败，所以是不容小视的。”</p>
						<p>在 73 ，标题你可以看着，成一个 话题，一个活动，一件事情，以及一个圈子。这都由你来决定。</p>
					</div>

					<div class="col">
						<h2><i>使用</i></h2>
						<p>在标题界面你会看到很多各式各样的标题，找到你喜欢或者需要的，鼠标放在 “未关注” 上面，点击后就关注它了。</p>
						<img src="./help/index-2.png"/>
						<p><b>关注</b>：点击 “关注” 选项可以看到所有你关注过的标题。使用标题<a href="?go=add">发布内容</a>时，标题会帮你分担一半的消耗<a href="#">金币</a>。标题过期后就无法使用了，但是在标题的 “关注” 选项里依旧可以查看到，这时只要你取消关注，它就永远消失了。</p>
						<p><b>查看</b>：可以查看此标题的所有内容。在<a href="?go=world">世界</a>里查看内容，点击一个标题也能看到所有此标题的内容。</p>

					</div>

					<div class="col">
						<h2><i>创建</i>怎么拥有自己的标题？</h2>

						<p>进入标题页面后，点击申请创建，就可以看到下面的这个界面。</p>
						<img src="./help/title-1.jpg"  />
						<p>由 4 个参数，需要填写 标题和描述。有效时间 和 奖金只可以选择。</p>
						<p><b>有效时间</b>：标题从开始使用计时，超过有效时间后标题就无法使用，系统会自动收回标题。当然之后又可以再申请。标题收回后，使用此标题的所有内容依旧存在，并且任然可以点评。选择时间的不同需要支付的金币也就不同：1天 = 0枚金币、7天 = 100枚金币、15天 = 200枚金币、30天 = 400枚金币、90天 = 1200枚金币。</p>
						<p><b>奖金数量</b>：这里的奖金（金币），只是颁给所有使用此标题的内容，分数最高的内容作者。有效时间一到，系统会自动颁发。</p><br />
						
						<p><b>提示</b>：</p>

						<p>1、所有的标题申请都是人工审核，所以申请后需要等待 1个小时左右。在审核中，申请按钮为变成 “审核中” 的字样，审核通过后，则会显示回 “申请创建”。如果显示成，申请创建，但是在我的标题里，没有看到，则说明你的标题没有通过。</p>
						<p>2、普通用户只能拥有 2 个标题。vip 可以拥有 3 个。</p>
						<p>3、如果恶意的申请标题，比如：标题为 1111111111，这样是会受到处罚的。</p>
					</div>

					<div class="col">
						<h2><i>管理</i>标题里的小秘密！</h2>
						<p>拥有了属于自己的标题后，点击 “我的” 的按钮可以看到了。</p>
						<img src="./help/title-2.png" />
						<p>下面对各个参数进行说明。</p>
						<p><b>图标</b>：为标题创建者的头像。</p>
						<p><b>发布量</b>：此标题被使用过的次数。</p>
						<p><b>点评量</b>：使用此标题的内容被点评过的次数。</p>
						<p><b>金币池</b>：</p>
						<p>消耗：用户使用标题时候，会从标题的 金币池 抽出金币帮助用户分担一部分金币消耗，默认是 4 枚金币。</p>
						<p>收获：在标题的有效时间结束后，金币池内的所有金币归 创建者所有。</p>
						<p><b>剩余时间</b>：默认会显示天数，小于一天时，会显示还剩多少小时。</p>
						<p><b>奖金</b>：标题结束后，系统自动发放给使用此标题被赞的最多的内容的作者。</p><br /><br />

						<h2>我的标题</h2>
						<p>在标题菜单里，点击 “我的” 选项可以看到我的所有标题，每一个标题都有一个管理按钮。如下图</p>
						<img src="./help/title-3.jpg" /><br /><br />

						<h2>操作说明</h2>
						<p>打开管理界面，如下图所示。除了创建者可以打开管理页面，被邀请合作管理者也可以打开此页面。</p>
						<img src="./help/title-4.jpg" />
						<p><b>管理员</b>：创建者可以添加一名管理员，此管理员，可以进行的操作和 创建者完全一样，除了：创建者可以撤销管理者，一旦被邀请成为管理员，就不能退出，直到标题结束。</p>
						<p>管理人员，可以把使用此标题的内容，给移除（移除后会返回少量的金币至金币池中），所以邀请管理时请慎重。</p>
						<p><b>分享金单次数量</b>：用户使用此标题时，帮助用户分担金币消耗的数量控制。默认情况下用户发布一条内容需要支付 7 枚金币，而标题可以帮使用此标题的用户分担，至于每次帮助用户分担多少，有你决定。最少分担 1 枚，最多 6枚。</p>
						<p><b>金币池注入</b>：给金币池中添加金币。</p><br />

						<p>一个标题是否有吸引力，金币池的福利会起到不小的作用，合理的管理，会让创建者有所收获。</p><br /><br />

						<h2>结束标题</h2>
						<p>标题在有效时间后，就无法使用了，这时关注里可以看到，如果你是 创建者或者管理员，可以在管理界面看到下面的情景，标题结束界面：</p>
						<img src="./help/title-5.jpg" />
						<p>这里可以看到 两个 或 三个人的信息，分别是：标题创建者、管理员、使用此标题被赞最多的用户。</p>
						<p><b>提示</b>：只有创建者可以结束标题。</p>
						<p><b>收取金币池</b>：标题结束后，金币池内的所有金币归 创建者所有，如果有管理员的话，你可以分配这一笔金币，默认情况下系统会平分它。<p></p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//发布
		if( isset($_GET['go']) && $_GET['go'] == 'add' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a class="act" href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>发布</span><i>Share my everything</i></h1>

					<div class="col">
						<h2><i>介绍</i>今天你想说点什么？</h2>
						<p>在 73 你可以，发挥你的让你的一切想法，一张图片，一段视频，一首音乐，任何任何东西。只要你开心全部发出来吧。</p>
						<p>你发的所有东西，都会变的有价值，至于它到底值多少，大家说了算。</p>
					</div>

					<div class="col">
						<h2><i>使用</i></h2>
						<p>进入 “发布” 菜单后，你就能看到下面的界面。</p>
						<img src="./help/add-1.jpg"/>
						<p>你可以根据需要，分类 四个方式：文字、图片、视频、音乐。</p>
						<p>下面说明下发布的方式：</p>
						<p><b>文字</b>：文字字数暂时不予限制，所以你可以尽情的写任何你想写文章，以至于从网络上找到你感觉不错的内容。</p>
						<p><b>图片</b>：默认情况下显示的方式，图片总是会比较吸引人的眼球。</p>
						<p><b>视频</b>：填写示例：http://www.ux73.com/000/xxx.swf 。当前支持发布视频推荐网站：56、优酷、土豆。也是为了确保网站的打开速度，和视频质量。当然之后会开启上传的功能，以方便用户。</p>
						<p><b>音乐</b>：当前只支持 虾米网 的音乐，带来的不便请谅解，我们会尽快提供很好音乐上传功能。填写示例：http://www.xiami.com/000/xxx.swf。</p><br /><br />

						<h2>运用标题</h2>
						<p>在<a href="?go=title" >标题</a>页面关注标题后，就可以使用标题了。</p>
						<img src="./help/add-2.jpg" />

					</div>

					<div class="col">
						<h2><i>消耗</i></h2>

						<p><b>金币</b>：每次发布金币都会扣除，用户 7 枚金币。如果你使用标题发布内容的话，它会帮你分担 一部分的金币。</p>
						<p><b>时间</b>：发布完成后会有 1 分钟的时间需要等待，后才能再进行发布，因为考虑到无限制，为了禁止用户的无限的发布。vip 用户等待时间为 10 秒。</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//个人中心
		if( isset($_GET['go']) && $_GET['go'] == 'user' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a class="act" href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>个人中心</span><i>User Experience</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>简洁的界面，简单的数据，方便的操作。</p>
						<p>73 以用户体验为中心。</p>
					</div>

					<div class="col">
						<h2><i>基本信息</i>可以看到的就是这些</h2>
						<p>这里可以查看用户的所有 资料信息。</p>
						<img src="./help/user-1.jpg"/>
						<p><b>头像</b>：点击头像可以修改头像，以及修改密码等其他设置。</p>
						<p><b>ID</b>：每个用户的唯一编码，它会很多地方用到。</p>
						<p><b>金币</b>：显示当前用户拥有的全部金币数量。</p>
						<p><b>发布</b>：显示当前用户发布了的内容总数量。</p>
						<p><b>点评</b>：显示当前用户点赞的总次数。</p>
						<p><b>最近登录</b>：显示用户上次登录时间，时间格式为：月-日 时:分。</p><br /><br />
						
						<h2>留言</h2>
						<p>只有在登录情况下，才能够使用留言功能，但可以查看当前用户的全部留言。</p>
						<img src="./help/user-2.jpg" />
						<p>回复他人的留言后，被回复的人的个人中心的留言板里能够看到你的回复信息。</p><br /><br />
						
						<h2>全部内容</h2>
						<p>在个人中心可以看到用户发布的全部内容，以分页的方式展示。</p>
					</div>

					<div class="col">
						<h2><i>修改并设置个人信息</i>修改头像</h2>
						<img src="./help/user-3.jpg" />
						<p>上传个性并且专属的个人头像，当前暂不支持动态图片的头像。</p>
						<p><b>提示</b>：有时上传后，下方的预览效果没有反应，则是浏览器缓存问题，只刷新页面就可以了。之后我们会用更好的方式解决这个问题。</p>
						<img src="./help/user-4.jpg" />
						<p><b>返回</b>：返回至 个人中心 页面。</p><br /><br />

						<h2>修改密码</h2>
						<img src="./help/user-5.jpg" />
						<p>修改密码方式为：输入当前密码，然后输入两边 新密码。</p>
						<p>系统会自动检查，输入完成后，随便点击网页其他地方，会自动完成修改并提示用户。</p><br /><br />

						<h2>设置邮箱</h2>
						<img src="./help/user-6.jpg" />
						<p>用户默认因为没有填写邮箱，可以在这里填写上。为了忘记密码的时候找回密码使用。</p>
						<p>小提示：邮箱也可以作为账户登录。（这个功能会看情况开启）</p>
					</div>

					<div class="col">
						<h2><i>会员</i></h2>
						<p>在个人中心、排行榜、以至于内容里的用户信息都可以看到，一些用户头像上有 vip 的图标。就像下面这样：</p>
						<img src="./help/user-7.jpg" /><br /><br />

						<h2>成为会员</h2>
						<p>在个人中心 点击头像打开用户设置界面，里面可以看到购买会员，如果你的金币足够的话，你就可以随时成为一个会员。</p>
						<p>当前默认的 会员有效时间为 一周（7天）。你需要支付：1000 金币（测试期间只需要 100 金币）。</p>
						<img src="./help/user-8.jpg" />
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//金币
		if( isset($_GET['go']) && $_GET['go'] == 'plus' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a class="act" href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>金币</span><i>Let everything become valuable</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>比例为 100 金币 = 1RMB。</p>
						<p>支持用户提现至 支付宝、lol游戏币。</p>
						<img src="./help/plus-1.jpg" />
						<p>在个人中心可以看到您的金币数量。</p>
					</div>

					<div class="col">
						<h2><i>获取金币的方式</i></h2>
						<p><b>内容被赞</b>：你发布内容，通过标题、世界或者你的个人中心被看到，并且被点赞后，你会得到 一枚或 两枚的金币。</p>
						<p><b>首次登陆奖励</b>：注册账号后，系统会自动送你 10 个金币。</p>
						<p><b>新手每日福利</b>：如果你是 今日首次登陆，并且你的 金币数量小于 10个，那么会享受新手的奖励。供你每天的基本发布和点评。（首次登陆奖励就新手每日福利）</p>
						<p><b>拥有标题</b>：合理的管理、推广、维护标题，会有很丰厚的 收益。</p>
						<p><b>邀请好友注册</b>：使用 www.ux73.com/login.php?3q=xxx （xxx为你的 ID），当你的朋友注册成功后，你将会得到 10 个金币的奖励。</p>
						<p><b>回馈意见</b>：关注 “意见反馈箱” 标题，使用此标题发布你的意见，只要你的意见被采纳我们会给与金币回馈。</p>
						<p><b>转账</b>：尚未开通</p>
						<p><b>游戏</b>：尚未开通</p>
						<p><b>充值</b>：尚未开通</p>
					</div>

					<div class="col">
						<h2><i>支出</i></h2>
						<p><b>发布内容</b>：发布内容时候，会消耗 7 枚金币。如果使用了标题则根据标题的福利 支付金币。</p>
						<p><b>创建标题</b>：最低支出为 100 枚金币，创建标题需要支付的金币。</p>
						<p><b>点赞</b>：通过在 标题、世界或者个人中心 页面点赞 其他用户的内容，支付 1枚 金币，没有金币的时候，无法点赞。也无法点赞自己的内容。</p>
						<p><b>兑换</b>：把金币兑换成现金或者其他虚拟币。</p>
						<p><b>转账</b>：尚未开通</p>
						<p><b>游戏</b>：尚未开通</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//兑换
		if( isset($_GET['go']) && $_GET['go'] == 'exchange' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a class="act" href="?go=exchange" title="">兑换</a>
					<a href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>兑换</span><i>Loading...</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>在 73 金币可以兑换成 RMB 或者 游戏币，之后会考虑更多的方面。</p>
						<p>可兑换数量是有限的，对兑换总量会根据广告的收入情况而定，会不定时的刷新。</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//广告
		if( isset($_GET['go']) && $_GET['go'] == 'ad' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?" title="">怎么玩</a>
					<a href="?go=world" title="">世界</a>
					<a href="?go=title" title="">标题</a>
					<a href="?go=add" title="">发布</a>
					<a href="?go=user" title="">个人中心</a>
					<a href="?go=plus" title="">金币</a>
					<a href="?go=exchange" title="">兑换</a>
					<a class="act" href="?go=ad" title="">广告</a>
					<a href="?go=gidd" title="">排行榜</a>
				</div>
				<div class="main">
					<h1><span>广告</span><i>Loading...</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>73的唯一广告位，采用竞价的方式，广告每周刷新一次，自会采用竞价最高的广告。并且显示在世界的头部，并注明为本周的独家赞助商。</p>
						<p>在竞价时每当你被挤下来的时候，竞价的金币将会自动返回给用户。</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>




		<?php 
		//排行榜
		if( isset($_GET['go']) && $_GET['go'] == 'gidd' ){ ?>
		<div class="help">
			<div class="center">
				<div class="nav">
					<a href="./">返回</a>
					<a href="?">怎么玩</a>
					<a href="?go=world">世界</a>
					<a href="?go=title">标题</a>
					<a href="?go=add">发布</a>
					<a href="?go=user">个人中心</a>
					<a href="?go=plus">金币</a>
					<a href="?go=exchange">兑换</a>
					<a href="?go=ad">广告</a>
					<a class="act" href="?go=gidd">排行榜</a>
				</div>
				<div class="main">
					<h1><span>排行榜</span><i>Loading...</i></h1>

					<div class="col">
						<h2><i>介绍</i></h2>
						<p>排行的方式，是依照用户的金币持有数量依次排名。</p>
						<p>系统会实时刷新当前的前一百名用户。</p>
					</div>

				</div>
			</div>
		</div>
		<?php } ?>

        <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="./js/comm.js"></script>
		<script type="text/javascript">



		</script>
	</body>
</html>