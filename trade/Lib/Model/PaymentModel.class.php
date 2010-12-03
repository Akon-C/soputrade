<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class PaymentModel extends Model{
	public function getlist(){
		$list=$this->findAll();
		for ($row=0;$row<count($list);$row++){
			$list[$row]['status']=GetSettValue($list[$row]['name']."_status");
		}
		return $list;
		
	}
}
?>