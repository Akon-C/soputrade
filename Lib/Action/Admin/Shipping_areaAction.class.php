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
		foreach ($list as $k=>$v){
			$config=unserialize($list[0]['config']);
			foreach ((array)$config as $vo){
				$list[$k]['area'][]=get_region_name($vo);
			}
			$list[$k]['area']=implode(',',$list[$k]['area']);
		}
		$this->list=$list;
		
		$this->id=$_GET["id"];
		$this->display();
	}
	function edit() {
		$map ['id'] = $_GET ['id'];
		$list = $this->dao->where ( $map )->find ();
		if ($list) {
			$map1['type']=0;
			$this->country=D('Region')->where($map1)->findall();
			$this->config1=unserialize($list["config"]);
			$this->list = $list;
			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}
	}
	function add(){
		$this->id=$_GET['id'];
		$map['type']=0;
		$this->country=D('Region')->where($map)->findall();
		parent::add();
	}
	function Insert(){
		$_POST["config"]=serialize($_POST["config"]);
		parent::Insert();
	}
	function Update(){
		$_POST["config"]=serialize($_POST["config"]);
		$map['type']=0;
		$this->country=D('Region')->where($map)->findall();
		parent::Update ();
	}
}
?>