<?php
/**
 * 下载
 *
 */
class DownAction extends CommAction {
	public function index(){	
		$dao=D('Down');
		$dao->_list($this->view,$map,'id',false);
		$this->display();
	} 
	
}


?>