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
		$map=array();
		if(!empty($_REQUEST['sn'])){
			$map['sn']=array('like','%'.$_REQUEST['sn'].'%');
		}
		$this->sort = "dateline desc";
		$this->_list ($map);
		$this->display ();
	}
	function orders(){
		$id=intval($_GET['id']);
		$list=$this->dao->query("select a.*,b.*,c.bigimage,c.serial,if(b.products_pricespe,b.products_pricespe,b.products_price) as price from ".C('DB_PREFIX')."orders a left join ".C('DB_PREFIX')."orders_products b on a.id=b.orders_id left join ".C('DB_PREFIX')."products c on b.products_id = c.id where a.id='".$id."'");
		$this->products_total=reset(reset($this->dao->query("select sum(b.products_total) as products_total from ".C('DB_PREFIX')."orders a left join ".C('DB_PREFIX')."orders_products b on a.id=b.orders_id where a.id='".$id."'")));
		$weights=0;
		foreach ($list as $k=>$v){
			$list[$k]['products_model']=unserialize($v['products_model']);
			$weights+=$v['weight'];
		}
		$this->weights=$weights;
		$this->list=$list;
		$this->shippingInfo=$list[0];
		$this->count=count($list);
		$this->orders_total=$list[0]['orders_total'];
		if(ACTION_NAME=='orders'){
			$this->display();
		}
	}
	function delivery(){
		$this->orders();
		$this->display();
	}
	function express(){
		$this->orders();
		$this->display();
	}
	function ems(){
		$this->orders();
		$this->display();
	}
	public function edit() {
		$map ['id'] = $_GET ['id'];
		$list = $this->dao->where ( $map )->find ();
		import('ORG.Net.IpLocation');
		$ipLocatoin=IpLocation::getInstance();
		$result=$ipLocatoin->init(__ROOT__."./Public/ipdata/ip.dat")->getcity($list['ip_address']);
		$list['ip_area']=$result['country'].$result['area'];
		if ($list) {
			$this->list = $list;

			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}

	}
	function printall(){
		$ids=explode(",",$_REQUEST['id']);
		$count=count($ids);
		$i=0;
		$this->display('Orders-printall_header');
		foreach ($ids as $id){
			$list=$this->dao->query("select a.*,b.*,c.bigimage,c.serial,if(b.products_pricespe,b.products_pricespe,b.products_price) as price from ".C('DB_PREFIX')."orders a left join ".C('DB_PREFIX')."orders_products b on a.id=b.orders_id left join ".C('DB_PREFIX')."products c on b.products_id = c.id where a.id='".$id."'");
			$this->products_total=reset(reset($this->dao->query("select sum(b.products_total) as products_total from ".C('DB_PREFIX')."orders a left join ".C('DB_PREFIX')."orders_products b on a.id=b.orders_id where a.id='".$id."'")));
			$this->list=$list;
			$this->shippingInfo=$list[0];
			$this->orders_total=$list[0]['orders_total'];
			$this->display();
			$i++;
			if($i!=$count){
				echo "<br clear=all style='page-break-before:always;' >";
			}
		}
		$this->display('Orders-printall_footer');

	}
	/**
	 * 条形码
	 *
	 */
	function UPCAbarcode()
	{
		$code=substr($_GET['code'],0,11);
		import("ORG.Util.Image");
		Image::UPCA($code,'png',3);
	}
	function Delete() {
		$map ['orders_id'] = array('in',$_GET ['id']);
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
				$this->orders_status=orderstatus_convert(get_orders_status($_POST['id']));
				$this->orderlist=$orderlist;
				$this->memberlist=$memberlist;
				if(!empty($orderlist['express_method'])){
					$this->express_method="Express delivery:".$orderlist['express_method'];
				}
				$body=$this->fetch_skin("orderstatus","MailTpl");
				sendmail($sendto,GetSettValue('sitename')." on your order has been shipped",$body)	;
				$this->success ( '数据更新成功！' );
				//cleanCache ();
			} else {
				$this->error ( "没有更新任何数据!" );
			}
		} else {
			$this->error ( $this->dao->getError () );
		}
	}
	public function orders_status(){
		if($_REQUEST['id']){
			$map['id']=array('in',$_REQUEST['id']);
			$count=$this->dao->where($map)->count();
			$status=$this->dao->where($map)->setField('orders_status',$_REQUEST['orders_status']);
			$this->success('设置成功'.$count.'个订单');
		}
		$this->error('设置失败');
	}
	//2011/1/17 发货单功能
	public function sendgoods() {
		if (! GetSettValue ( 'sender_sname' )) {
			$this->jumpUrl=U('Setting/ShippingAddress');
			$this->error('请先完善您的发货地址！');
		}
		else{
			$map['id']=$_GET['id'];
			$list=$this->dao->where($map)->find();
			
			if (!$list){
				$this->error('对不起，没有该订单信息！');
			}
			self::$Model=D("Orders_shippingbills");
			
			$express=self::$Model->where(array('order_id'=>$list['id']))->find();
			if($express){
			$this->expressSN=$express['ExpressSN'];
			$this->id=$express['id'];
			
			}
			$this->list=$list;
			$this->display ();
		}

	}
	public function dosendgoods(){
		//dump($_POST);
		$_POST['dateline']=time();
		if (empty($_POST['ExpressSN'])){
			$this->error('请输入快递单编号！');
		}
		self::$Model=D("Orders_shippingbills");
		
		if (self::$Model->create()){
			$id=self::$Model->add();
			if(!$id){
				$id=self::$Model->save();
			}
			//修改订单状态
			$map['id']=$_POST['order_id'];
			$data['orders_status']='3';
			$data['shipping_method']=$_POST['Express'];
			$this->dao->where($map)->save($data);
			$this->jumpUrl=U('Orders/dispBills',array('id'=>$_POST['order_id']));
			$this->success ( '添加成功！' );
		}
		else{
			$this->error(self::$Model->getError());
		}
	}

	public function dispBills(){
		$map['order_id']=$_GET['id'];
		self::$Model=D("Orders_ShippingBills");
		$list=self::$Model->where($map)->find();
		if (!$list){
			$this->error('没有找到该发货单信息！');
		}
		else{
			self::$Model=D("Billsprintsetting");
			$map1['Express']=$list['Express'];
			$this->blist=self::$Model->where($map1)->findall();
			//$blist=self::$Model->where($map1)->find();
			//dump($blist);
			//echo self::$Model->getlastsql();
			$this->list=$list;
			$this->display();
		}
	}
}
?>