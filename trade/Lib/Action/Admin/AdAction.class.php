<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class AdAction extends AdminCommAction{
	function adlist(){
		$this->_list();
		$this->display();
	}
}
?>