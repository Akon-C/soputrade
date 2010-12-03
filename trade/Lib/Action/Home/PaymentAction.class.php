<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-29
*/ 
class PaymentAction extends CommAction{
	public function Pin(){
		$pname=$_GET['type'];		
		import ( '@.ORG.Payment.' . $pname );
		$p = new $pname ();
		if ($pname == "Paypal") {
			self::$Model=D("Orders");
			$data['orders_status']="2";
			self::$Model->where("sn=".$p->ipn_data['item_number'])->save($data);
		}
	}
}
?>