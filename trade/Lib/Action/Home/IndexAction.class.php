<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommAction {
	public function index() {
		$this->display ();
	}
	public function Currencies() {
		$currencies=get_currencies_arr();
		for($row = 0; $row < count ( $currencies ); $row ++) {
			if ($currencies [$row] ['symbol'] == $_POST['Currencies']) {
				$_SESSION ['currency'] = $currencies [$row];
			}
		}
		//print_r($_SESSION ['currency']);
		//echo "<script>history.go(-1);</script>";
		header('location: '.$_SERVER['HTTP_REFERER']);
		
	}
	public function test() {
		$sendto=array("pcicn.com@gmail.com","811046@qq.com");
		sendmail($sendto,"testemail","this is a testemail")	;	
		
	}
	
	
	
}
?>