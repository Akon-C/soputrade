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
		if ($dao->create()){
			$id=$dao->add();
			Session::set('memberID',$id);
			if ($_SESSION['step']==1){
				$this->redirect ( 'Home-Cart/checked_address' );
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
	public function doLogin(){
		if ($this->memberID>0){
			$this->redirect ( 'Index/index' );
		}
		$dao=D("Members");
		$list=$dao->where("email ='".$_POST['email']."'")->find();
		if (!$list){
			$this->error ( "email error, do not have this account!");
		}
		else{
			if (md5($_POST['password'])!=$list['password']){
				$this->error ( "Password error!");
			}
			else{
				Session::set('memberID',$list['id']);
				$data['lastlogindate']=time();
				$data['lastloginip']=get_client_ip();
				$list=$dao->where("id ='".$list['id']."'")->save($data);
				if ($_SESSION['step']==1){
					$this->redirect ( 'Home-Cart/checked_address' );
				}
				$this->jumpUrl=U('Index/index');
				$this->success("Login Successful!");
			}
		}
	}
}
?>