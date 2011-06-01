<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-12-2
*/ 
class Products_attrModel extends Model{
	public function del_attrs($products_id){
		if($products_id){
			$map['products_id']=array('in',$products_id);
			$this->where ($map)->delete ();
		}
		
	}
}
?>