<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-18
 */
class CateAction extends AdminCommAction {
	
	function catelist(){
		$this->display();
	}	
	function Delete() {
		$map ['pid'] = $_GET ['id'];	
		$i = $this->dao->where ( $map )->find ();
		if (! $i) {
			$map1['id']= $_GET ['id'];	
			$this->dao->where ( $map1 )->delete ();
			$this->success ( "删除成功！" );
			cleanCache ();
		}	
		else{
			$this->error('无法删除，还有下级分类！');
		}
		
	}

}
?>