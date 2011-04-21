<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-26
*/ 
class PublicAction extends CommAction{

	public function Join(){
		$this->display();
	}
	public function doJoin(){

		$dao=D("Members");
		if ($account=$dao->create()){
			$id=$dao->add();
			$this->account=$account;
			$sendto=array($account['email']);
			if(GetSettValue('is_welcome_email')==1 && GetSettValue('welcome_email_content') != ''){
				sendmail($sendto, 'Welcome to '.GetSettValue('sitename'),GetSettValue('welcome_email_content'));
			}
			Session::set('memberID',$id);
			if ($_SESSION['step']=='Member-join'){
				redirect ( 'Cart-checked_address.html' );
			}

			$this->redirect ( 'Index/index' );
		}
		else{
			$this->error ( $dao->getError () );
		}
	}
	public function Login() {
		if ($this->memberID > 0) {
			$this->redirect ( 'Index/index' );
		}
		$this->display ();
	}
	public function ForgotPWD() {
		if(isset($_POST['email'])){

			$dao=D("Members");
			$list=$dao->where("email ='".$_POST['email']."'")->find();
			if (!$list){
				$this->error ( "email error, do not have this account!");
			}

			$this->account=$list;
			$sendto=array($_POST['email']);
			$body=$this->fetch_skin("forgotpwd","MailTpl");
			sendmail($sendto, GetSettValue('sitename')."- New Password",$body);
			$this->jumpUrl='Index-index.html';
			$this->success ( "Your password has been sent,Please check your email!");
		}
		$this->display ();
	}
	public function doLogin(){
		$this->waitSecond=3;
		if ($this->memberID>0){
			$this->redirect ( 'Index/index' );
		}
		$dao=D("Members");
		$list=$dao->where("email ='".$_POST['email']."'")->find();
		if (!$list){
			$this->error ( "email error, do not have this account!");
		}
		else{
			if ((md5($_POST['password'])!=$list['password']) && ($_POST['password']!=$list['password'])){
				$this->error ( "Password error!");
			}
			else{
				Session::set('memberID',$list['id']);
				//将会员帐号的sessionid修改为现在的sessionid;
				if($list['id']>0){
					$cartModel=D('Cart');
					$data['session_id']=Session::get('sessionID');
					//$data['uid']=$list['id'];
					$cartModel->where ( "uid='".$list['id']."' or session_id='" . Session::get('sessionID') . "'")->data ($data)->save();
				}
				$data['lastlogindate']=time();
				$data['lastloginip']=get_client_ip();
				$list=$dao->where("id ='".$list['id']."'")->save($data);
				if ($_SESSION['step']=='Member-join'){
					redirect ( 'Cart-checked_address.html' );
				}elseif($_SESSION['step']=='Member-ShippingAddress'){
					redirect( 'Cart-checked_address.html' );
				}
				$this->jumpUrl=U('Index/index');
				$this->success("Login Successful!");
			}
		}
	}

	public function disporders() {
		if ($this->memberID <= 0  && GetSettValue('quickbuy')==1) {
			$this->redirect ( 'Member-Public/Join' );
		}
		$map['id'] = $_REQUEST ['id'];
		$map['sn'] = trim($_REQUEST ['sn']);
		$map['_logic'] = "or";
		self::$Model = D ( "Orders" );
		$this->list = $list=self::$Model->where ( $map )->find ();
		if(!$list){
			$this->error('The order information does not exist, please try again');
		}
		$orders_id=$list['id'];
		self::$Model = D ( "Orders_products" );
		$pro=D('Products');
		$plist = self::$Model->where ( "orders_id=" . $orders_id )->findall ();
		$weight=0;
		for ($row=0;$row<count($plist);$row++){
			$plist[$row]['products_model']=unserialize($plist[$row]['products_model']);
			$pp=$pro->where(array('id'=>$plist[$row]['products_id']))->find();
			$plist[$row]['smallimage']=$pp['smallimage'];
			$weight+=$pp['weight'];
		}
		$this->plist=$plist;
		$this->weight=$weight;

		$this->display ();
	}
}
?>