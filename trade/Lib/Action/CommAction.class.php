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



		/**
		 * bof缓存模板变量
		 */
		if(F('Common_Cache')==''){
			$Common_Cache=array();
			$Common_Cache['catetree'] = get_indexcate_arr ();

			self::$Model=D('Products');
			$Common_Cache['toptenviews']=self::$Model->order("viewcount desc")->limit('0,10')->findall();
			$Common_Cache['FeaturedPorducts']=self::$Model->where("isrec=1")->order("sort desc")->limit('0,8')->findall();
			$Common_Cache['HotPorducts']=self::$Model->where("ishot=1")->order("sort desc")->limit('0,8')->findall();
			$Common_Cache['NewPorducts']=self::$Model->where("isnew=1")->order("sort desc")->limit('0,8')->findall();
			self::$Model=D('Cate');
			$Common_Cache['HotClass']=self::$Model->where("ishot=1")->order("sort desc")->limit('0,8')->findall();
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

			//首页大图
			self::$Model = D ( "Ad" );
			$Common_Cache['IndexImage'] = self::$Model->where(array('remark'=>'首页大图'))->getField('img_url');
			$Common_Cache['IndexContent'] = self::$Model->where(array('remark'=>'首页中间文本'))->getField('content');

			//首页菜单,前两级
			self::$Model = D ( "Cate" );
			$topclass=self::$Model->where(array('pid'=>0))->findall();
			foreach ($topclass as $k=>$v){
				$topclass[$k]['subclass']=self::$Model->where(array('pid'=>$v['id']))->findall();
			}
			$Common_Cache['topTwoClass']=$topclass;

			self::$Model= D('Article');
			$Common_Cache['Footer'] = self::$Model->where(array('article_title'=>'底部版权'))->getField('article_content');
			F('Cache',$Common_Cache);
		}
		$this->assign(F('Cache'));
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
}
?>