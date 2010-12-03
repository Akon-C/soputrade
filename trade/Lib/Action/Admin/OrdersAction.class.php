<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-30
*/ 
class OrdersAction extends AdminCommAction{
	function orderslist() {
		$this->sort = "dateline desc";
		$this->_list ();
		$this->display ();
	}
	function Delete() {
		$map ['orders_id'] = $_GET ['id'];
		$dao = D ( "Orders_products" );
		$dao->where ( $map )->delete ();
		parent::Delete ();
	}
}
?>