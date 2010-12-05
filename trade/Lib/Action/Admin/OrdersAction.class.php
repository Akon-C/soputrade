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
	public function Update() {
		if ($this->dao->create ()) {
			$list = $this->dao->save ();
			if ($list !== false) {
				
				//获取订单用户email
				self::$Model=D("Orders");
				$orderlist=self::$Model->where("id=".$_POST['id'])->find();
				
				self::$Model=D("Members");
				$memberlist=self::$Model->where("id=".$orderlist['member_id'])->find();
				$sendto=array($memberlist['email'],GetSettValue('mailcopyTo'));
				$this->orders_status=get_orders_status($_POST['id']);
				$this->orderlist=$orderlist;
				$this->memberlist=$memberlist;
				$body=$this->fetch_skin("orderstatus","MailTpl");
				sendmail($sendto,"You have a new order!",$body)	;
				$this->success ( '数据更新成功！' );
				//cleanCache ();
			} else {
				$this->error ( "没有更新任何数据!" );
			}
		} else {
			$this->error ( $this->dao->getError () );
		}
	}
}
?>