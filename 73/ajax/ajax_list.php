<?php
	
	//调用
	include('../comm/base.php');

	
	$begin = $_POST['begin'];
	$pages = $cf -> LPages;
	$norm = 1;

	$ist = isset($_POST['tid']) && $_POST['tid'];		//获取标题
	$isu = isset($_POST['uid']) && $_POST['uid'];		//获取指定用户

	$uid = 0;
	$tid = 0;

	if($ist){
		$tid = $_POST['tid'];
		$list = $c -> Glist($begin, $pages, $tid);			//获取内容列表，指定标题内容时没有显示标准
		$total = $c -> Gtotel(0, 0, $tid);					//获取此标题的内容总数

	}elseif($isu){
		$uid = $_POST['uid'];
		$list = $c -> GUlist($begin, $pages, 0, 0, $uid);	//获取内容列表，指定用户内容时没有显示标准
		$total = $c -> Gtotel(0, $uid);						//获取此用户的内容总数

	}else{
		$list = $c -> Glist($begin, $pages,0 ,$norm);		//获取内容列表
		$total = $c -> Gtotel($norm);						//获取内容总数
	}	
	

	//判断是否还有内容可供加载
	if( $begin + $pages > $total){
		$pages = $total - $begin;
		if( $begin == $pages ){
			return;
		}
	}


?>



	<?php foreach ($list as $k => $v) {	//输出内容，或者指定标题的内容 		?>
		<div class="col<?php echo $c -> Ibuy($v['cid']) ? ' col_possess' : ''; ?>" cid="<?php echo $v['cid']; ?>" now="<?php echo $v['plus']; ?>" style="display: block;" >

			<!-- 标示 -->
			<?php if($v['effects'] == 1){	//如果是顶 ?>
				<div class="effects effects-very" alt="作者顶贴" ></div>
			<?php } ?>

			<?php if($v['effects'] == 2){	//如果是推荐 ?>
				<div class="effects effects-recommend" alt="题主推荐" ></div>
			<?php } ?>

			<?php if($ist && isset($fcid) && $fcid == $v['cid']){	//如果是标题第一名的内容 ?>
				<div class="effects effects-first" alt="活动第一名" ></div>
			<?php } ?>
			
			<div class="head">

				<?php if(!$ist){	//判断是否有标题，则不显示标题 ?>
					<div class="tit <?php echo $v['titleid'] <= 0 ? 'no' : ''; ?>">
						<a href="./list.php?tid=<?php echo $v['titleid']; ?>" ><?php echo $t -> Gtitle($v['titleid']); ?></a>
					</div>
				<?php } ?>

				<div class="param-tag tag">
					<span class="name">BY：
						<a href="./list.php?uid=<?php echo $v['userid']; ?>" title="访问TA" ><?php echo $u -> Gname($v['userid']); ?></a>
					</span>
					<span class="time"><?php echo $o -> Cdate($v['base']); ?></span>
					<div class="c"></div>
				</div>
			</div>
			<div class="cont">
				<div class="gui gui_<?php echo $v['types']; ?>">
					<?php echo $c -> IGcontrol($v['cid']); ?>
					<i class="purchase">+</i><em></em>
					<div class="c"></div>
				</div>

				<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
					<div class="txt" <?php if($v['types'] ==0){ echo "style='max-height: 234px;'"; } ?>><div class="are"><?php echo $v['content']; ?></div></div>
				<?php } ?>
				
				<div class="use">
					<div class="num f"><span class="gold golds" n="<?php echo $v['plus']; ?>"></span> <i>元</i></div>
					
					<?php if($u -> Guid()){	//登录后显示的提示 ?>
						<a class="tip r" href="javascript:;" title="">您的金额不足！<i></i></a>
					<?php }else{			//未登录后显示的提示 ?>
						<a class="tip r" href="javascript:;" title="">登录后可购买！<i></i></a>
					<?php } ?>

					<?php if($c -> Ibuy($v['cid'])){		//如果可以查看 ?>
						<a class="buy confirmBtn purchase r" href="./detail.php?c=<?php echo $v['cid']; ?>" >去评论</a>
						
						<?php if($c -> Itxt($v['cid'])){	//如果有文本则显示展开按钮 ?>
							<a class="skip look r" href="javascript:;" >展开</a>
						<?php } ?>

					<?php }else{  //需要购买 ?>
						<a class="buy confirmBtn purchase r" href="javascript:;" >买买买</a>
						<a class="skip look r" href="./detail.php?c=<?php echo $v['cid']; ?>" >评论</a>
					<?php } ?>

				</div>
			</div>
		</div>
	<?php } ?>