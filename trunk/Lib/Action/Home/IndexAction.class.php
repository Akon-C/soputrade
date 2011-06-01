<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommAction {
	public function index() {
		$this->is_index=true;
		Session::set('back',null);
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
		give_member_points("20110310173333");
		//sendmail($sendto,"testemail","this is a testemail")	;	
		
	}
	
	
	
}
?>