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
	function Delete() {
		$id=$_REQUEST ['id'];
		if($id){
			$map ['id'] = array('in',$id);
			if($list=$this->dao->where ( $map )->findall ()){
				foreach($list as $k=>$v){
				$img=auto_charset($v['img_url'],'utf-8','gbk');
					if(file_exists($img)){
						unlink($img);
					}
				}
				$this->dao->where ( $map )->delete ();
			}
		}
		$this->success ( "删除成功！" );
	}
}
?>