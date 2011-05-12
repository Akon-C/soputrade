<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommAction {
	public function index() {
		$this->is_index=true;
		/*if(F('Index_Cache')==''){
			$Index_Cache=array();
			self::$Model=D('Article_cate');
			$Index_Cache['gift_by_interest'] = self::$Model->get_article_by_cate('gift by interest',3);
			F('Index_Cache',$Index_Cache);
		}
		$this->assign(F('Index_Cache'));*/
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
	
	
	
}
?>