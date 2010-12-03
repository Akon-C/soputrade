<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-29
*/ 
class MembersAction extends AdminCommAction{
	function memberslist(){		
		$this->sort="createdate";
		$this->_list();
		$this->display ();
	}
	function Delete(){
		$map ['id'] = $_GET ['id'];
		$dao=D("ShippingAddress");
		$dao->where($map)->delete();
		parent::Delete();
	}
	function edit(){
		$map ['id'] = $_GET ['id'];
		$dao=D("ShippingAddress");
		$this->slist=$dao->where($map)->find();
		parent::edit();
	}
	function Update(){
		self::$Model=D("ShippingAddress");
		$list=self::$Model->where("id=".$_POST['id'])->find();
		if ($list){
			if (self::$Model->create()){
				self::$Model->save();
				parent::Update();
			}
			else{
				$this->error ( "没有更新任何数据!" );
			}
		}
		else{
		if (self::$Model->create()){
				self::$Model->add();
				parent::Update();
			}
			else{
				$this->error ( "没有更新任何数据!" );
			}
		}
	}
	function savePWD(){
		$data['password']=md5($_POST['newpassword']);
		self::$Model=D("Members");
		self::$Model->where("id=".$_POST['id'])->save($data);
		echo self::$Model->getlastsql();
	}
	
}
?>