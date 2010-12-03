<?php
/**
  * @author nanze
  * @link 
  * @todo 品牌管理
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-18
*/ 
class BrandAction extends AdminCommAction{
	public function brandlist(){
		$this->_list();
		$this->display();
	}
}
?>