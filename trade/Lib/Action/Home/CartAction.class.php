<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-25
 */
class CartAction extends CommAction {
	function add() {
		if (count ( $_POST ['count'] ) == 0) {
			$this->error ( "You did not select any product!" );
		}
		$dao = D ( "Cart" );
		self::$Model = D ( "Products" );
		$prolist = self::$Model->where ( "id=" . $_POST ['id'] )->find ();
		$attrlist = self::$Model->get_attrs ( $prolist ['cateid'], $_POST ['id'] );
		for($row = 0; $row < count ( $_POST ['count'] ); $row ++) {
			//if (empty ( $_POST ['count'] [$row] ) && $_POST ['count'] [$row] < 1) {
			$model = array ();
			$i = 0;
			foreach ( $attrlist as $key => $value ) {
				$model [$i] ['name'] = $value ['name'];
				$model [$i] ['value'] = $_POST [$value ['name']] [$row];
				$i ++;
			}
			$dao->add_item ( $this->sessionID, $_POST ['id'], $_POST ['count'] [$row], serialize ( $model ) );
			//}
		}
		//dump($dao->display_contents($this->sessionID));	
		$this->redirect ( 'Cart/disp' );
	}
	function disp() {
		$dao = D ( "Cart" );
		//dump($dao->display_contents ( $this->sessionID ));
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		$this->cart_total = $dao->cart_total ( $this->sessionID );
		$this->display ();
	}
	function delete() {
		$dao = D ( "Cart" );
		$dao->delete_item ( $this->sessionID, $_GET ['id'] );
		$this->redirect ( 'Cart/disp' );
	}
	function save() {
		$dao = D ( "Cart" );
		for($row = 0; $row < count ( $_POST ['pid'] ); $row ++) {
			$model=array();
			for ($ii=0;$ii<count($_POST['model_name_'.$_POST ['id'] [$row]]);$ii++){
				$model[$ii]['name']=$_POST['model_name_'.$_POST ['id'] [$row]][$ii];
				$model[$ii]['value']=$_POST['model_value_'.$_POST ['id'] [$row]][$ii];
			}
			$dao->modify_quantity ( $this->sessionID, $_POST ['id'] [$row], $_POST ['count'] [$row], serialize($model) );
		}
		$this->redirect ( 'Cart/disp' );
	}
	function checked_address() {
		//保存数据
		$dao = D ( "Cart" );
		for($row = 0; $row < count ( $_POST ['pid'] ); $row ++) {
			$model = array ();
			for($ii = 0; $ii < count ( $_POST ['model_name_' . $_POST ['id'] [$row]] ); $ii ++) {
				$model [$ii] ['name'] = $_POST ['model_name_' . $_POST ['id'] [$row]] [$ii];
				$model [$ii] ['value'] = $_POST ['model_value_' . $_POST ['id'] [$row]] [$ii];
			}
			$dao->modify_quantity ( $this->sessionID, $_POST ['id'] [$row], $_POST ['count'] [$row], serialize($model) );
		}
		if ($this->memberID <= 0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! $this->memberShippingAddress) {
			$this->redirect ( 'Member-Index/ShippingAddress' );
		}
		
		//读取订单信息
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		$this->cart_total = $dao->cart_total ( $this->sessionID );
		//支付方式列表
		self::$Model = D ( "Payment" );
		$this->paymentlist = self::$Model->getlist ();
		$this->display ();
	}
	public function OtherAddress() {
		$dao = D ( "Cart" );
		if ($this->memberID <= 0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! $this->memberShippingAddress) {
			$this->redirect ( 'Member-Index/ShippingAddress' );
		}
		
		//读取订单信息
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		$this->cart_total = $dao->cart_total ( $this->sessionID );
		self::$Model = D ( "Countries" );
		$this->countries = self::$Model->getlist ();
		//支付方式列表
		self::$Model = D ( "Payment" );
		$this->paymentlist = self::$Model->getlist ();
		
		$this->display ();
	}
	public function checkout() {
		if ($this->memberID <= 0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! isset ( $_POST ['payment_module_code'] )) {
			$this->redirect ( 'Cart/disp' );
		}
		//生成订单
		self::$Model = D ( "Orders" );
		if (self::$Model->create ()) {
			$orders_id = self::$Model->add ();
			//处理orders_products表
			self::$Model = D ( "Cart" );
			$dao = D ( "Orders_products" );
			$list = self::$Model->display_contents ( $this->sessionID );
			for($row = 0; $row < count ( $list ); $row ++) {
				$data ['orders_id'] = $orders_id;
				$data ['products_model'] = serialize($list [$row] ['model']);
				$data ['products_id'] = $list [$row] ['pid'];
				$data ['products_name'] = $list [$row] ['name'];
				$data ['products_price'] = $list [$row] ['price'];
				$data ['products_pricespe'] = $list [$row] ['pricespe'];
				$data ['products_quantity'] = $list [$row] ['count'];
				$data ['products_total'] = $list [$row] ['total'];
				$dao->add ( $data );
			}
			//清除购物车
			self::$Model->clear_cart ( $this->sessionID );
			$this->redirect ( 'Cart/Payment', array ('id' => $orders_id ) );
		
		} else {
			$this->error ( self::$Model->getError () );
		}
		//dump($_POST);
	}
	public function Payment() {
		if ($this->memberID <= 0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		$orders_id = $_GET ['id'];
		if (get_orders_status ( $orders_id ) == L ( "orders_status_2" )) {
			$this->error ( L ( "orders_error_paied" ) );
		}
		//读取支付代码
		self::$Model = D ( "Orders" );
		$list = self::$Model->where ( "id=" . $orders_id )->find ();
		if (! $list) {
			$this->redirect ( 'Index/index' );
		}
		$pname = $list ['payment_module_code'];
		import ( '@.ORG.Payment.' . $pname );
		$p = new $pname ();
		if ($pname == "Paypal") {
			$this_script = "http://{$_SERVER['HTTP_HOST']}";
			$p->add_field ( 'business', GetSettValue ( $pname . "_account" ) ); //收款人账号'402660_1224487424_biz@qq.com'
			$p->add_field ( 'return', $this_script . U ( 'Payment/success' ) );
			$p->add_field ( 'cancel_return', $this_script . U ( 'Payment/Cancel' ) );
			$p->add_field ( 'notify_url', $this_script . U ( 'Payment/Pin', array ("type" => "Paypal" ) ) );
			$p->add_field ( 'item_name', 'Porducts For SN:' . $list ['sn'] ); //产品名称
			$p->add_field ( 'item_number', $list ['sn'] ); //订单号码
			$p->add_field ( 'amount', $list ['orders_total'] ); //交易价格
			$p->add_field ( 'currency_code', $_SESSION ['currency'] ['symbol'] ? $_SESSION ['currency'] ['symbol'] : 'USD' ); //货币代码
			$p->submit_paypal_post ();
		}
	}
	
	public function disporders() {
		if ($this->memberID <= 0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		$orders_id = $_GET ['id'];
		self::$Model = D ( "Orders" );
		$this->list = self::$Model->where ( "id=" . $orders_id )->find ();
		self::$Model = D ( "Orders_products" );
		$plist = self::$Model->where ( "orders_id=" . $orders_id )->findall ();
		for ($row=0;$row<count($plist);$row++){
			$plist[$row]['products_model']=unserialize($plist[$row]['products_model']);
		}
		
		$this->plist=$plist;
		$this->display ();
	}
}
?>