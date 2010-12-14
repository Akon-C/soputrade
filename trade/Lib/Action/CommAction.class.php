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
		C('TMPL_ACTION_ERROR','Public:success_en'); // 默认错误跳转对应的模板文件
		C('TMPL_ACTION_SUCCESS','Public:success_en'); // 默认成功跳转对应的模板文件
		
		$this->catetree = get_indexcate_arr ();
		self::$Model=D('Products');
		$this->toptenviews=self::$Model->order("viewcount desc")->limit('0,10')->findall();
		$this->FeaturedPorducts=self::$Model->where("isrec=1")->order("sort desc")->limit('0,8')->findall();
		$this->HotPorducts=self::$Model->where("ishot=1")->order("sort desc")->limit('0,8')->findall();
		$this->NewPorducts=self::$Model->where("isnew=1")->order("sort desc")->limit('0,8')->findall();
		
		self::$Model=D('Cate');
		$this->HotClass=self::$Model->where("ishot=1")->order("sort desc")->limit('0,8')->findall();

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
		//调用购物车购买数量
		self::$Model = D ( "Cart" );
		$this->itemCount = self::$Model->get_item_count ( $this->sessionID );
		
		//首页大图
		self::$Model = D ( "Ad" );
		$this->IndexImage = self::$Model->where(array('remark'=>'首页大图'))->getField('img_url');
		$this->IndexContent = self::$Model->where(array('remark'=>'首页中间文本'))->getField('content');
		
	}
	/**
	 * 空操作
	 *
	 */
	protected function _empty(){
		C('TMPL_ACTION_ERROR','Public:404');
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		$this->error('404-Document Not Found');
	}
	/**
	 * 解析自定义模板
	 */
	protected function fetch_skin($name = ACTION_NAME, $mnane = MODULE_NAME, $charset = 'utf-8', $contentType = 'text/html') {
		return $this->fetch ( C ( 'DEFAULT_TEMPLATE' ) . '@' . $mnane . ':' . $name, $charset, $contentType );
	}
}
?>