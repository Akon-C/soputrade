<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class CommAction extends Action{
	protected static $Model=null;	//数据Model
	var $sessionID,$memberID,$memberInfo,$memberShippingAddress;
	function _initialize() {		
		$this->catetree = get_indexcate_arr ();
		//dump(get_indexcate_arr ());
		self::$Model=D('products');
		$this->toptenviews=self::$Model->order("viewcount desc")->limit('0,10')->findall();
		$this->FeaturedPorducts=self::$Model->where("isrec=1")->order("sort desc")->limit('0,8')->findall();
		$this->HotPorducts=self::$Model->where("ishot=1")->order("sort desc")->limit('0,8')->findall();
		$this->NewPorducts=self::$Model->where("isnew=1")->order("sort desc")->limit('0,8')->findall();
		
		//首页幻灯片
		$list=get_ad_arr("flash");
		for ($row=0;$row<count($list);$row++){
			$flashpic[$row]=__ROOT__."/".$list[$row]['img_url'];
			$flashlink[$row]=$list[$row]['link'];
			$flashremark[$row]=$list[$row]['remark'];
		}
		$this->flashpic=implode("|",$flashpic);
		$this->flashlink=implode("|",$flashlink);
		$this->flashremark=implode("|",$flashremark);
		$this->leftpic=get_ad_arr("topleft");
		//货币
		
		$this->currencies=get_currencies_arr();
			
		//生产一个唯一的session id
		$this->sessionID = Session::get ( 'sessionID' );
		if (! $this->sessionID ) {
			$this->sessionID  = md5 ( uniqid ( rand () ) );
			Session::set ( 'sessionID', $this->sessionID  );
		} 
		//读取用户id
		$this->memberID=Session::get('memberID');
		if (! $this->memberID ) {
			$this->memberID=0;
		}
		else{
			
			//读取用户信息
			$this->mid=$this->memberID;
			self::$Model=D("Members");
			$this->memberInfo=self::$Model->where("id=".$this->memberID)->find();
			$this->member_Info=$this->memberInfo;
			self::$Model=D("ShippingAddress");
			$this->memberShippingAddress=self::$Model->where("id=".$this->memberID)->find();
			$this->member_ShippingAddress=$this->memberShippingAddress;
			
		}
		
		
		
		
		
	}
}
?>