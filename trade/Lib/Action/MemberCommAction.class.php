<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-26
*/ 
class MemberCommAction extends Action{
	protected static $Model=null;	//数据Model
	var $sessionID, $memberID;
	function _initialize() {
		//货币
		
		$this->currencies=get_currencies_arr();
		//生产一个唯一的session id
		$this->sessionID = Session::get ( 'sessionID' );
		if (! $this->sessionID) {
			$this->sessionID = md5 ( uniqid ( rand () ) );
			Session::set ( 'sessionID', $this->sessionID );
		}
		self::$Model=D("Countries");
		$this->countries=self::$Model->getlist();
	    //读取用户id
		$this->memberID = Session::get ( 'memberID' );
		if (! $this->memberID) {
			$this->memberID = 0;
			$this->redirect("Public/Login");
		} else {
			
			//读取用户信息
			$this->mid=$this->memberID;
			self::$Model = D ( "Members" );
			$this->memberInfo = self::$Model->where ( "id=" . $this->memberID )->find ();
			self::$Model = D ( "ShippingAddress" );
			$this->memberShippingAddress = self::$Model->where ( "id=" . $this->memberID )->find ();
		
		}
		
	}
}
?>