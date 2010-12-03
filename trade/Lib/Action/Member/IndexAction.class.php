<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-26
*/ 
class IndexAction extends MemberCommAction{
	public function index(){
		$this->redirect ( 'Index/Orders' );
	}
	public function Logout(){
		Session::set("memberID",0);
		$this->redirect ( 'Index/index' );
	}
	public function ShippingAddress(){
		$this->display();
	}
	public function doShippingAddress(){
		self::$Model=D("ShippingAddress");
		$list=self::$Model->where("id=".$this->memberID)->find();
		if (self::$Model->create()){
			if ($list){
				self::$Model->save();
			}
			else{
				self::$Model->add();
			}
			$this->redirect ( 'Index/ShippingAddress' );
		}
		else{
			$this->error(self::$Model->getError());
		}
	}
	
	public function ChangePWD(){
		$this->display();
	}
	public function doChangePWD(){
		self::$Model = D ( "Members" );
		$list=self::$Model->where("password='".md5($_POST['password'])."' and id=".$this->memberID)->find();
		if (!$list){
			$this->error ( "Password error!");
		}
		else{
			if ($_POST['new_password']==$_POST['re_password']){
				$data['password']=md5($_POST['new_password']);
				self::$Model->where("id=".$this->memberID)->save($data);
				//echo self::$Model->getlastsql();
				$this->redirect ( 'Index/ChangePWD' );
			}
			else{
				$this->error ( "Confirm password error!");
			}
		}
		
	}
	public function Orders(){
		self::$Model = D ( "Orders" );
		$map['member_id']=$this->memberID;
		$count = self::$Model->where ($map)->count ();
		import ( 'ORG.Util.Page' );
		$page = new Page ( $count, 20 );
		$this->orderslist=self::$Model->where($map)->order("dateline")->limit ( $page->firstRow . ',' . $page->listRows )->findall ();
		$this->show = $page->show ();
		$this->display();
	}
	function ConfirmOrders(){
		$id=$_GET['id'];
		$data['orders_status']=4;
		self::$Model = D ( "Orders" );
		self::$Model->where("id=".$id)->save($data);
		$this->success(L("DO_OK"));
	}
}
?>