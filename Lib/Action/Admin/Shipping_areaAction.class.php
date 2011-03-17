<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2011-3-15
*/ 
class Shipping_areaAction extends AdminCommAction{
	function index(){
		$list=$this->dao->where("shipping_id=".$_GET["id"])->findall();			
		$this->list=$list;	
		$this->id=$_GET["id"];
		$this->display();
	}
	function edit() {
		$map ['id'] = $_GET ['id'];
		$list = $this->dao->where ( $map )->find ();
		if ($list) {
			$this->config1=unserialize($list["config"]);
			$this->list = $list;
			
			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}
	}
	function add(){
		$this->id=$_GET['id'];
		parent::add();
	}
	function Insert(){
		$_POST["config"]=serialize($_POST["config"]);
		parent::Insert();
	}
	function Update(){
		$_POST["config"]=serialize($_POST["config"]);
		parent::Update ();
	}
}
?>