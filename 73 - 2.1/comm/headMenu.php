<?php  
Global $ect; 
?>
	<!-- 菜单 -->
	<div class="menu f">
		<a <?php if( $ect == "index" ){	 ?>class="act"<?php } ?> href="./index.php" >世界</a>
		<a <?php if( $ect == "title" ){	 ?>class="act"<?php } ?> href="./title.php" >标题</a>
		<a <?php if( $ect == "ad" ){	 ?>class="act"<?php } ?> href="./ad.php" >广告</a>
		<a <?php if( $ect == "digg" ){	 ?>class="act"<?php } ?> href="./digg.php" >排行榜</a>
		<!-- <a href="./help.php" >了解这里</a> -->
	</div>