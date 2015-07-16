<?php
	
	//引用公共文件
	include("../comm/base.php");		
	
	//判断激活码是否正常
	if (isset($_POST['CDK'])) {
		echo $u -> Icdk($_POST['CDK']);
	}

	//判断账户是否被注册
	if( isset($_POST['account']) ){
		echo $u -> Ientry($_POST['account']);
	}
 
	//删除话题 内容
	if( isset($_POST['delete']) ){
		echo $c -> Uclose($_POST['delete']);
	}

	//登录后判断用户密码是否正确
	if ( isset( $_POST['pwdIs'])) {
		echo $u -> Ipwd($_POST['pwdIs']);
	}

	//修改密码
	if( isset( $_POST['revisePwd']) ){
		echo $u -> Upwd( $_POST['revisePwd'] );
	}

	//修改邮箱
	if ( isset( $_POST['reviseEmail']) ) {
		echo reviseEmail( $_POST['reviseEmail'] );
	}

	//修改简介
	if ( isset( $_POST['reviseDescribe']) ) {
		echo $u -> Udepict($_POST['reviseDescribe']);
	}

	//修改头像
	if ( isset($_POST['reviseIcon']) ) {
		echo $u -> Uicon($_POST['reviseIcon']);
	}

	//给指定用户发生邮件验证码
	if( isset($_POST['userEmail']) ){
		echo $u -> GEyzm($_POST['userEmail']);
	}

	//登录
	//验证账户是否存在，以及密码是否正确
	if( isset($_POST['entry']) ){
		echo $u -> Ientry($_POST['entry'], $_POST['password']);
	}

	//注册用户
	if( isset($_POST['register']) ){
		echo $u -> Auser( $_POST['register'], md5($_POST['password']), $_POST['3q'], $_POST['cdk'] );
	}

	//记录兑换
	if( isset( $_POST["exchange"] ) ){
		echo $ue -> Aexchange($_POST["num"], $_POST['path'].'-'.$_POST['name']);
	}

	//判断是否关注过
	if( isset( $_POST['gzis'] ) ){
		echo isFollower( $_POST['gzis'] );
	}

	//关注指定用户
	if( isset( $_POST['guanzhu'] ) ){
		echo $u -> Afollow($_POST['guanzhu']);
	}

	//取消关注指定用户
	if( isset($_POST['nogz']) ){
		echo $u -> Dfollow($_POST['nogz']);
	}

	//获取可兑换金币总数量
	if( isset($_POST['surplus']) ){
		echo $ue -> Gsurplus();
	}











	//添加留言
	// if( isset($_POST['addMessage']) ){
	// 	echo $um -> addMessage();
	// }


	//发布留言（评论）
	if( isset($_POST['addMessage']) ){
		$fid = 0;
		if ( isset($_POST['huifu']) ) {
			$fid = $_POST['huifu'];
		}
		echo json_encode($um -> Amessage( $_POST['txt'], $_POST['cid'], $fid ));
	}

	//获取评论
	if ( isset($_POST['getM']) ) {
		echo json_encode($um -> GCmessage($_POST['cid'], $_POST['page']));
	}

	//评论点赞
	if ( isset($_POST['messageUp']) ) {
		echo $um -> Uup($_POST['mid']);
	}

	//评论点踩
	if ( isset($_POST['messageDown']) ) {
		echo $um -> Udown($_POST['mid']);
	}






	//点赞
	if( isset($_POST['praise']) ){
		echo $c -> Abuy($_POST['praise']);//praise();
	}

	//获取用户基本参数
	if( isset( $_POST['userinfo'] ) ){
		$row = userAllId($_POST['userinfo']);
		echo "{plus: '".$row['plus']."',issue: '".$row['issue']."',comments: '".$row['comments']."'}";
	}





	//添加竞猜
	// if( isset( $_POST['lockKey'] ) ){
	// 	echo madAdd( $_POST['lockKey'], $_POST['key'] );  
	// }

	// //获取参数
	// if ( isset( $_POST['madGetNum']) ) {
	// 	echo madTotal( $_POST['madGetNum'] );
	// }

	// //获取答案
	// if( isset( $_POST['madGetKey']) ){
	// 	echo madGetKey( $_POST['madGetKey'] );
	// }






	//申请标题
	// if( isset( $_POST['applyTitle'] ) ){
	// 	echo applyTitle();
	// }

	//设置标题状态
	if( isset( $_POST['titlePass']) ){
		echo titlePass( $_POST['titlePass'], $_POST['start'] );
	}

	//关注标题
	if( isset( $_POST['followTitle']) ){
		echo $t -> Afollow($_POST['followTitle']);
	}

	//取消关注标题
	if( isset( $_POST['cancelTitle'] ) ){
		echo $t -> Dfollow( $_POST['cancelTitle'] );
	}

	//获取用户关注的所有标题
	if( isset( $_POST['userTitleALL'] ) ){
		echo userTitleALL();
	} 

	//题主移除指定内容
	if( isset( $_POST['titRemoveContetn'] ) ){
		if( contentTitRemove( $_POST['titRemoveContetn'] )){
			$tid = $_POST['titleid'];
			$row = data_titleGetTitle( $tid );

			//刷新发布量
			data_titleSetNum( $tid, $row['number'] -1 );
			data_titleSetPrice( $tid, $row['price'] +4 );
		}
	}

	//搜索用户
	if ( isset($_POST['searchUser']) ) {
		echo searchUser();
	}

	//管理标题
	if( isset($_POST['titleAdmin']) ){
		echo $t -> Utit( $_POST['titleAdmin'], $_POST['shareglod'], $_POST['cue'], $_POST['modified'], $_POST['withholding'], $_POST['scale'], $_POST['reward'], $_POST['withdraw']);
	}

	//关闭标题
	if( isset($_POST['titleClose']) ){
		echo $t -> Uclose($_POST['titleClose']);
		// echo 1;
	}

	//检测是否超过申请数量 ： 2
	if ( isset( $_POST['titleTzNum']) && uis() ) {

		//判断用户是否已经创建了两个标题
		if( data_titleTzNum(uid()) >= 5 ){
			echo 0;
		}else{
			echo 1;
		}
	}

	//获取分享金




	//开通会员
	if( isset($_POST['becomeVip']) ){
		echo becomeVip();
	}


	//删除指定留言
	if( isset($_POST['messageDel']) ) {
		$u -> Dmessage($_POST['messageDel']);
	}



	// Main - User - Badge
	//------------------------------------------------
	// 用户 - 徽章功能

	//领取徽章
	if( isset($_POST['specialProvide']) ){
		echo $ub -> Aspecial( $_POST['specialProvide'] );
	}

	//刷新福利时间
	// if( isset($_POST['specialUserReceive']) ){
	// 	echo specialUserReceive($_POST['specialUserReceive']);
	// }

	//记录福利领取时间
	if( isset($_POST['UserReceiveLog']) ){
		echo $ub -> Ureceive($_POST['UserReceiveLog']);
	}




	//给广告加金
	if( isset($_POST['aidFinancially']) ){
		echo $a -> UAfinancially($_POST['aidFinancially'], $_POST['num']);
	}



	//设置指定 内容为 题主推荐
	if( isset($_POST['recommendSet']) ){
		echo $c -> UErecommend($_POST['recommendSet']);
	}



	//投资管理
	if(isset($_POST['shareManage'])){
		echo $t -> Uinvest($_POST['shareManage'], $_POST['number']);
	}

	//获取指定标题的投资用户列表
	if(isset($_POST['investList'])){
		print_r(json_encode($t -> Ginvest($_POST['investList'])));
	}


	//获取标签
	if (isset($_POST['getLabel'])) {
		echo json_encode($tl -> Glabel($_POST['tid']));
	}
	if (isset($_POST['tgl'])) {
		echo json_encode($tl -> Glabel($_POST['tgl']));
	}

	//添加标签
	if (isset($_POST['addLabel'])) {
		echo $tl -> Alabel($_POST['name'], $_POST['tid']);
	}

	//重命名标签
	if (isset($_POST['renameLabel'])) {
		echo $tl -> Uname($_POST['lid'], $_POST['name']);
	}

	//关闭标签
	if (isset($_POST['closeLabel'])) {
		echo $tl -> Uclose($_POST['lid']);
	}

	//判断指定标题名是否被使用（有效的标题）
	if (isset($_POST['do_title'])){
		$info = $t -> GTname($_POST['name']);
		print_r($info['id']);
	}


	//获取用户的最近金额记录
	if ( isset($_POST['UGlog']) ){
		echo json_encode($u -> Glog());
	}

	//获取指定内容的收支情况
	if ( isset($_POST['income']) ) {
		echo json_encode($c -> Gincome($_POST['cid']));
	}

	//游客收入
	if ( isset($_POST['visitorIncome']) ) {
		$sum = $u -> Gplus();
		$sum = $sum + 1;
		echo $uv -> Usum($_POST['uid'], $sum);
	}




	//用户情况报表
	if ( isset($_POST['userReport']) ) {
		echo json_encode($u -> Greport($_POST['uid']));
	}




?>