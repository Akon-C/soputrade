<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-15
*/ 
class SettingAction extends AdminCommAction{
	function Cache(){
		import("ORG.Io.Dir");
		if(file_exists('./Runtime')){
			Dir::delDir('./Runtime');
		}
		$this->success('清除成功！');
	}
	function base(){
		$this->display();
	}
	function doBase(){
		foreach(array_keys($_POST) as $key){
			//echo $_POST[$key];
			SetSettValue($key,$_POST[$key]);
		}
		cleanCache();
		$this->success('操作成功！');
		
	}
	function payment(){
		$model=D('payment');
		$this->list=$model->order('sort')->findAll();
		$this->display();
		
	}
	function addpayment(){
		$this->display();
	}
	function insertPayment() {
		$model = D ( 'payment' );
		if ($model->create ()) {
			$id = $model->add ();
			$this->success ( '添加成功！' );
		} else {
			$this->error ( $model->getError () );
		}
	}
	function editPayment(){
		$model = D ( 'payment' );
		$map['id']=$_GET['id'];
		$list=$model->where($map)->find();
		if($list){
			$this->list=$list;
			$this->display();
		}
		else{
			$this->error('没有数据！');
		}
		
	}
	function updatePayment(){
		$model=D('payment');
		if ($model->create ()) {
			$list = $model->save ();
			if ($list !== false) {
				$this->success ( '数据更新成功！' );
			} else {
				$this->error ( "没有更新任何数据!" );
			}
		} else {
			$this->error ( $model->getError () );
		}	
	}
	function setPayment(){
		$map['id']=$_GET['id'];
		$model=D('payment');
		$list=$model->where($map)->find();
		$varlist=explode(',',$list['var']);
		$this->status=$status=GetSettValue($list['name'].'_status');
		//dump($list);
		$this->list=$list;
		$this->varlist=$varlist;
		$this->display();
	}
	function mail(){
		$this->display();
	}
	function Money(){
		$this->display();
	}
}
?>