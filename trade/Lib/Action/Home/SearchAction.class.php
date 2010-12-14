<?php
/**
 * 查找
 *
 */
class SearchAction extends CommAction {
	public function index(){
		$type=$_REQUEST['type'];
		$key=$_REQUEST['key'];

		if (!get_magic_quotes_gpc()) {
			$key = addslashes($key);
		}
		$sql=array();
		if(!empty($key) && !empty($type)){
			switch (true){
				case $type=='name':
					$sql['name']=array('like',"%$key%");//名称模糊查找
					break;
				case $type=='id':
					$sql['id']=intval($key);//名称模糊查找
					break;
				case $type=='brand':
					$sql['brand']=$key;//品牌查找
					break;
				case $type=='cateid':
					$sql['cateid']=$key;//类别查找
					break;
				case $type=='pricelt':
					$sql['price']=array('lt',$key);//价格小于
					break;
				case $type=='pricegt':
					$sql['price']=array('gt',$key);//价格大于
					break;
			}
		}elseif(!empty($key)){
			$sql['name']=array('like',"%$key%");//名称模糊查找
		}

		parent::$Model=D("Products");
		$_COOKIE['map']=$sql;
		$_COOKIE['map']['module']=MODULE_NAME;
		parent::$Model->_list($this->view,$sql,'name',false);
		$this->display();
	}



}
?>