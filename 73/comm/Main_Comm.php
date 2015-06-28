<?php
	
/**
* 公共工具
*/
class Tool
{
	
	// function __construct(argument=0)
	// {
	// 	# code...
	// }


	//转换 ***************************************************


	//日期切换
	public function Cdate($v=0, $x=0){
		date_default_timezone_set('PRC');
		$k = date("m", $v);
		switch($k) {
		    case 1: $k = "一月";break;
		    case 2: $k = "二月";break;
		    case 3: $k = "三月";break;
		    case 4: $k = "四月";break;
		    case 5: $k = "五月";break;
		    case 6: $k = "六月";break;
		    case 7: $k = "七月";break;
		    case 8: $k = "八月";break;
		    case 9: $k = "九月";break;
		    case 10: $k = "十月";break;
		    case 11: $k = "十一月";break;
		    case 12: $k = "十二月";break;
		}

		//判断是否需要详细的
		if( $x ){
			return $k." ".date("d, Y", $v)." - ".date('H:i', $v);
		}else{
			return $k." ".date("d, Y", $v);
		}
	}

	//时间戳转文字
	public function Ctime($time=0){
		if($time>0){
			if($time < 60){
				$time = $time .'秒';
			}elseif( $time/60 <= 60 ){
				$time = round($time/60) .'分钟';
			}elseif( $time/60/60 <= 24 ){
				$time = round($time/60/60).'小时';
			}elseif(  $time/60/60/24 <= 365  ){
				$time = round($time/60/60/24) .'天';
			}else{
				$time = round($time/60/60/24/365) .'年';
			}
		}
		return $time;
	}

	//获取指定时间戳距现在的时间
	public function Crange($time=0){
		$time = time() - $time;
		if ( $time > 0 ) {
			if($time < 60){
				$text = '刚刚';
			}elseif( $time/60 <= 60 ){
				$text = round($time/60) .'分钟前';
			}elseif( $time/60/60 <= 24 ){
				$text = round($time/60/60).'小时前';
			}elseif(  $time/60/60/24 <= 365  ){
				$text = round($time/60/60/24) .'天前';
			}else{
				$text = round($time/60/60/24/365) .'年前';
			}
		}
		return $text;
	}

	//页面文本转换 编码
	public function Chtml($str=''){
		$str = str_replace("<", "&lt;", $str);
		$str = str_replace("'", "&27", $str);
		$str = str_replace("\n", "<br />", $str);
		return $str;
	}

	//编码 转换成也页面文本
	public function Ccode($str='', $type=0){
		$str = str_replace("&lt;", "<", $str);
		$str = str_replace("&27", "'", $str);
		if($type == 1){
			$str = str_replace("<br />", "", $str);
		}
		if($type == 2){
			$str = str_replace("<br />", "\n", $str);
		}
		return $str;
	}



	//判断 **************************************************

	//判断当前是否为星期一
	public function IMon(){
		echo date("N",time());//星期 

		
	}





	//获取 **************************************************

	//获取 用户所有网络的 IP
	public function Gip(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){//check ip from share internet
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){//to check ip is pass from proxy
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	//获取当前用户 ip
	// public function Gip() { 
	// 	if (getenv('HTTP_CLIENT_IP')) { 
	// 		$ip = getenv('HTTP_CLIENT_IP'); 
	// 	} elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
	// 		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
	// 	} elseif (getenv('HTTP_X_FORWARDED')) { 
	// 		$ip = getenv('HTTP_X_FORWARDED'); 
	// 	} elseif (getenv('HTTP_FORWARDED_FOR')) { 
	// 		$ip = getenv('HTTP_FORWARDED_FOR'); 
	// 	} elseif (getenv('HTTP_FORWARDED')) { 
	// 		$ip = getenv('HTTP_FORWARDED'); 
	// 	} else { 
	// 		$ip = $_SERVER['REMOTE_ADDR']; 
	// 	} 
	// 	return $ip; 
	// } 

	//获取 今天 0点的时间戳
	public function GNtime(){
		return strtotime(date('Y-m-d'));
	}

}



//初始化全局变量
$tool = new Tool();
$o = new Tool();




?>