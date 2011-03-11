<?php
/**
  * @author nanze
  * @link 
  * @todo  产品问答
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-18
*/ 
class Products_askAction extends AdminCommAction{
	
	public function index(){
		$this->_list();
		$this->display();
	}
}
?>