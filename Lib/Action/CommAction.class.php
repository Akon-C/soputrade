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
	protected $theme;
	var $sessionID,$memberID,$memberInfo,$memberShippingAddress;
	function _initialize() {
		L('_OPERATION_SUCCESS_',"Operation Success");
		L('_OPERATION_FAIL_','Operation Fail');
		//是否关闭网站
		if(GetSettValue('close_site')==1){
			die(GetSettValue('close_site_content'));
		}
		//IP封锁
		if(isset($_COOKIE['ipblock']) && $_COOKIE['ipblock']==0){

		}elseif((isset($_COOKIE['ipblock']) && $_COOKIE["ipblock"] ==1) || (GetSettValue('ipblock') == 1 && GetSettValue('ipblock_pwd') != '')) {
			import('@.Action.Home.IpblockAction');
			$ipblock=new IpblockAction();
			$ipblock->index();
		}
		
		//主题
		if($this->theme=GetSettValue('theme')){

		}else{
			$this->theme='default';
		}
		$this->product_history=product_history();
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
			self::$Model=D("Shippingaddress");
			$this->memberShippingAddress=self::$Model->where("id=".$this->memberID)->find();
			$this->member_ShippingAddress=$this->memberShippingAddress;
			$this->_365call="
			<script type=\"text/javascript\">
			//<![CDATA[  
			var _365call_memberID  = \"{$this->memberInfo['email']}\"; //  char(20)  账号(会员号)   
			var _365call_clientName= \"{$this->memberInfo['firstname']}{$this->memberInfo['lastname']}\"; //  char(50)  用户名(姓名)
			var _365call_email     = \"{$this->memberInfo['email']}\"; //  char(50)  邮件地址
			var _365call_phone     = \"{$this->memberShippingAddress['telphone']}\"; //  char(20)  联系电话
			var _365call_msn       = \"\"; //  char(50)  MSN
			var _365call_qq        = \"\"; //  char(20)  QQ
			var _365call_note      = \"{$this->memberShippingAddress['address']}\"; //  char(100) 其他
			//]]>      
			</script>";
		}
		$today=getdate();
		$this->month=$today['month'];
		//获取配送方式列表
		self::$Model=D("Shipping");
		$this->ShippingList=self::$Model->where("status=1")->findall();
		self::$Model=D("Cart");
		$this->Total_weight=self::$Model->cart_total_weight($this->sessionID);
		//会员等级
		$this->memberGropuInfo=get_members_group($this->memberID);
		if (get_members_group($this->memberID)){
			$this->isVip=1;
		}
		else{
			$this->isVip=0;
		}
		/**
		 * bof缓存模板变量
		 */
		if(F('Common_Cache')==''){
			$Common_Cache=array();
			$Common_Cache['catetree'] = get_indexcate_arr ();

			self::$Model=D('Products');
			$Common_Cache['toptenviews']=self::$Model->order("viewcount desc")->limit('0,10')->findall();
			if(!$newpro_num=GetSettValue('newpro_num')){
				$newpro_num=9;
			}
			if(!$recpro_num=GetSettValue('recpro_num')){
				$recpro_num=9;
			}
			if(!$hotpro_num=GetSettValue('hotpro_num')){
				$hotpro_num=9;
			}
			if(!$spepro_num=GetSettValue('spepro_num')){
				$spepro_num=9;
			}
			
			$Common_Cache['FeaturedPorducts']=self::$Model->where("isrec=1")->order("id desc")->limit("0,$recpro_num")->findall();
			$Common_Cache['HotPorducts']=self::$Model->where("ishot=1")->order("id desc")->limit("0,$hotpro_num")->findall();
			$Common_Cache['NewPorducts']=self::$Model->where("isnew=1")->order("id desc")->limit("0,$newpro_num")->findall();
			$Common_Cache['SpePorducts']=self::$Model->where("isprice=1")->order("id desc")->limit("0,$spepro_num")->findall();
			self::$Model=D('Cate');
			$Common_Cache['HotClass']=self::$Model->where("ishot=1")->order("id desc")->limit('0,8')->findall();
			//首页幻灯片
			$list=get_ad_arr("flash");
			for ($row=0;$row<count($list);$row++){
				$flashpic[$row]=__ROOT__."/".$list[$row]['img_url'];
				$flashlink[$row]=$list[$row]['link'];
				$flashremark[$row]=$list[$row]['remark'];
			}
			$Common_Cache['flashpic']=implode("|",$flashpic);
			$Common_Cache['flashlink']=implode("|",$flashlink);
			$Common_Cache['flashremark']=implode("|",$flashremark);
			$Common_Cache['leftpic']=get_ad_arr("topleft");

			self::$Model = D ( "Brand" );
			$Common_Cache['brandlist']=self::$Model->order('sort desc')->findall();

			//首页大图
			self::$Model = D ( "Ad" );
			$Common_Cache['IndexImage'] = self::$Model->where(array('remark'=>'首页大图'))->getField('img_url');
			$Common_Cache['IndexContent'] = self::$Model->where(array('remark'=>'首页中间文本'))->getField('content');
			$Common_Cache['leftad'] = self::$Model->where(array('code'=>'leftad'))->find();
			$Common_Cache['link'] = $list=get_ad_arr("link");

			self::$Model=D('Article_cate');
			$News_cateid=self::$Model->where(array('article_catename'=>'新闻中心'))->getField("article_cateid");
			self::$Model= D('Article');
			$Common_Cache['Footer'] = self::$Model->where(array('article_title'=>'底部版权'))->getField('article_content');
			$Common_Cache['News'] = self::$Model->where(array('article_cateid'=>$News_cateid,'status'=>1))->limit(10)->order('sort desc')->findall();
			$Common_Cache['footcode'] = GetSettValue('footcode');

			F('Common_Cache',$Common_Cache);
		}
		$this->assign(F('Common_Cache'));
		/**
		 * eof缓存模板变量
		 */

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

	protected function display($name = ACTION_NAME, $mnane = MODULE_NAME, $charset = 'utf-8', $contentType = 'text/html') {

		if(substr_count($name,'success')>0 || substr_count($name,'Home')>0 || substr_count($name,'404')>0){
			return $this->view->display($name);
		}
		return $this->view->display ( $this->theme . '@'.GROUP_NAME.':' . $mnane . '-' . $name, $charset, $contentType );
	}


}
?>