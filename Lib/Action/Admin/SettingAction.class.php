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
		$this->success('更新缓存成功！');
	}
	function base(){
		$this->ImgWater=GetSettValue('ImgWater');
		$this->ImgWaterPos=GetSettValue('ImgWaterPos');
		$this->ImgWaterType=GetSettValue('ImgWaterType');
		$this->isBigimg=GetSettValue('isBigimg');
		$this->theme=GetSettValue('theme');
		$this->close_site=GetSettValue('close_site');
		$this->quickbuy=GetSettValue('quickbuy');
		$this->is_only_proimg_water=GetSettValue('is_only_proimg_water');
		$dirs=glob(__ROOT__."./Tpl/*");
		$themes=array();
		foreach ($dirs as $v){
			if(is_dir($v)){
				$themes[]=basename($v);
			}
		}
		$this->themes=$themes;
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
	function Payment(){
		$model=D('Payment');
		$this->list=$model->order('sort')->findAll();
		$this->display();

	}
	function addPayment(){
		$this->display();
	}
	function insertPayment() {
		$model = D ( 'Payment' );
		if ($model->create ()) {
			$id = $model->add ();
			$this->success ( '添加成功！' );
		} else {
			$this->error ( $model->getError () );
		}
	}
	function editPayment(){
		$model = D ( 'Payment' );
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
		$model=D('Payment');
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
		$model=D('Payment');
		$list=$model->where($map)->find();
		if(!empty($list['var'])){
			$varlist=explode(',',$list['var']);
			$this->varlist=$varlist;
		}
		$this->status=$status=GetSettValue($list['name'].'_status');
		$this->list=$list;
		$this->display();
	}
	function mail(){
		$this->display();
	}
	function Money(){
		$this->no_shipping=GetSettValue('no_shipping');
		$this->display();
	}
}
?>