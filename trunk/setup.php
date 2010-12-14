<?php
header("Content-type:text/html; charset=UTF-8"); 
if($_GET['action']=='del'){
	echo "<script language='JavaScript'>alert('安装程序已删除!');</script>";
	echo "<script language='JavaScript'>window.close();</script>";
}else{
	header("location:./setup/index.php");
}
?>
