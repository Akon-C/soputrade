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

		header("Content-Type:text/html; charset=utf-8");
		L('_OPERATION_SUCCESS_',"Operation Success");
		L('_OPERATION_FAIL_','Operation Fail');
		//是否关闭网站
		if(GetSettValue('close_site')==1){
			header("HTTP/1.1 500 Internal Server Error");
			header("Status: 500 Internal Server Error");
			die('<div style="margin: 10px; text-align: center; font-size: 14px"><p>The temporary closure of this site, you can not access!</p><p>' . GetSettValue('close_site_content') . '</p></div>');
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
			Session::set('memberShippingAddress',$this->memberShippingAddress);
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

			//热门类别
			self::$Model=D('Cate');
			$Common_Cache['HotClass']=self::$Model->where("ishot=1")->order("id desc")->limit('0,5')->findall();
			//首页幻灯片
			$list=get_ad_arr("flash");
			for ($row=0;$row<count($list);$row++){
				$flashpic[$row]=__ROOT__."/".$list[$row]['img_url'];
				$flashlink[$row]=$list[$row]['link'];
				$flashremark[$row]=$list[$row]['remark'];
			}
			$Common_Cache['flashpic']=implode("|",$flashpic);
			$Common_Cache['flashlink']=implode("|",$flashlink);
			//$Common_Cache['flashremark']=implode("|",$flashremark);//是否显示幻灯片描述
			$Common_Cache['brandlist']=get_brand_tree();

			/**
			 * 广告部分
			 */
			//调用方法img_url图片content文字//remark标题get_ad('leftad','img_url');
			//$Common_Cache['leftad'] = get_ad('leftad');//单个
			//$Common_Cache['link'] = get_ad_arr("link");//广告组

			self::$Model=D('Article_cate');
			$News_cateid=self::$Model->where(array('name'=>'新闻中心'))->getField("id");

			self::$Model= D('Article');
			$Common_Cache['Footer'] = self::$Model->where(array('title'=>'底部版权'))->getField('content');
			$Common_Cache['News'] = self::$Model->where(array('pid'=>$News_cateid,'status'=>1))->limit(10)->order('sort desc')->findall();
			$Common_Cache['footcode'] = GetSettValue('footcode');
			$Common_Cache['tel'] = GetSettValue('tel');
			$Common_Cache['Hotmail'] = GetSettValue('Hotmail');
			$Common_Cache['Yahoo'] = GetSettValue('Yahoo');
			$Common_Cache['Skype'] = GetSettValue('Skype');

			F('Common_Cache',$Common_Cache);
		}
		$this->assign(F('Common_Cache'));

		self::$Model=D('Products');
		if(F('Products_Cache')==''){
			$Products_Cache['toptenviews']=self::$Model->order("viewcount desc")->limit('0,10')->findall();
			$newpro_num=GetSettValue('newpro_num')?GetSettValue('newpro_num'):9;
			$recpro_num=GetSettValue('recpro_num')?GetSettValue('recpro_num'):9;
			$hotpro_num=GetSettValue('hotpro_num')?GetSettValue('hotpro_num'):9;
			$spepro_num=GetSettValue('spepro_num')?GetSettValue('spepro_num'):9;

			$Products_Cache['FeaturedPorducts']=self::$Model->where("isrec=1 and isdown!=1")->order("id desc")->limit("0,$recpro_num")->findall();
			$Products_Cache['HotPorducts']=self::$Model->where("ishot=1 and isdown!=1")->order("id desc")->limit("0,$hotpro_num")->findall();
			$Products_Cache['NewPorducts']=self::$Model->where("isnew=1 and isdown!=1")->order("id desc")->limit("0,$newpro_num")->findall();
			$Products_Cache['SpePorducts']=self::$Model->where("isprice=1 and isdown!=1")->order("id desc")->limit("0,$spepro_num")->findall();
			F('Products_Cache',$Products_Cache);
		}else{
			$Products_Cache=F('Products_Cache');
		}
		$Products_Cache['FeaturedPorducts']=self::$Model->rand($Products_Cache['FeaturedPorducts']);
		$Products_Cache['HotPorducts']=self::$Model->rand($Products_Cache['HotPorducts']);
		$Products_Cache['NewPorducts']=self::$Model->rand($Products_Cache['NewPorducts']);
		$Products_Cache['SpePorducts']=self::$Model->rand($Products_Cache['SpePorducts']);
		$this->assign($Products_Cache);

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
	


}
?>