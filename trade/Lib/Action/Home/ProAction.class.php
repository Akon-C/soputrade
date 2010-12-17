<?php
/**
 * 查找
 *
 */
class ProAction extends CommAction {
	public function index(){	
		self::$Model=D("Products");
		switch (true){
			case isset($_REQUEST['isnew']):
				$map['isnew']=1;
			case isset($_REQUEST['ishot']):
				$map['ishot']=1;
			case isset($_REQUEST['isrec']):
				$map['isrec']=1;
			case isset($_REQUEST['isprice']):
				$map['isprice']=1;
			default:
				$map=array();
		}
		$map['isuser']=0;
		self::$Model->_list($this->view,$map,'pid',false);
		$this->display();
	}
	
}


?>