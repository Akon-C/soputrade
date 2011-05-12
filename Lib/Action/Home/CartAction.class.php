<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-25
 */
class CartAction extends CommAction {
	function add() {
		if ( $_POST ['count'] == 0) {
			$this->error ( "You did not select any product!" );
		}
		if ($this->memberID <= 0 && GetSettValue('quickbuy')==0) {
			echo "<script>alert('Please Log on!');location.href='".U('Member-Public/Join')."';</script>";
			die;
		}
		$dao = D ( "Cart" );
		self::$Model = D ( "Products" );
		$prolist = self::$Model->where ( "id=" . $_POST ['id'] )->find ();
		$attrlist = self::$Model->get_attrs ( $prolist ['cateid'], $_POST ['id'] );

		$model = array ();
		$i=0;
		//属性列表
		$attributes=array_keys($_POST['attr']);
		$no_select=array();
		foreach ( $attrlist as $key => $value ) {
			if($value['input_type']==1 && in_array($value ['name'],$attributes)){
				$model [$i] ['name'] = $value ['name'];
				$attr_value=explode('__',$_POST ['attr'][$value ['name']]);
				$model [$i] ['value'] = $attr_value[0];
				$model [$i] ['attr_price'] = $attr_value[1];
				$i ++;
			}else{
				$no_select[]=$value ['name'];
			}
		}
		if (count($no_select)>0) {
			$this->error ( "Please select ".implode(',',$no_select).'!' );
		}
		$dao->add_item ( $this->sessionID, $_POST ['id'], $_POST ['count'], serialize ( $model ) );
		//dump($dao->display_contents($this->sessionID));
		$this->redirect ( 'Cart/disp' );
	}
	function disp() {
		$dao = D ( "Cart" );
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		//3.10修改

		$this->cart_total = $dao->cart_total ( $this->sessionID );
		$this->fees=get_orders_Fees($dao->cart_total ( $this->sessionID ));
		$this->fee_readme=GetSettValue('fee_readme');

		$this->display ();
	}
	function delete() {
		$dao = D ( "Cart" );
		$dao->delete_item ( $this->sessionID, $_GET ['id'] );
		$this->redirect ( 'Cart/disp' );
	}
	function save() {
		$dao = D ( "Cart" );
		for($row = 0; $row < count ( $_POST ['pid'] ); $row ++) {
			$dao->modify_quantity ( $this->sessionID, $_POST ['id'] [$row], $_POST ['count'] [$row]);
		}
		Session::set('step',null);
		if(isset($_REQUEST['step']) && $_REQUEST['step']=='checkout'){
			$minimum_money=GetSettValue('minimum_money');
			if($minimum_money>0 && $dao->cart_total ( $this->sessionID )<$minimum_money){
				$this->error("Not be less than $minimum_money minimum!");
			}
			//$this->redirect ( 'Cart/checked_address' );
			$this->redirect ( 'Cart/checked_payment' );
		}else{
			$this->redirect ( 'Cart/disp' );
		}

	}
	function checked_payment(){
		$map1['type'] = 0;
		$this->country = D ( 'Region' )->where ( $map1 )->findall ();
		$this->disp ();
	}
	function checked_address() {
		$dao = D ( "Cart" );
		if ($dao->get_item_count ( $this->sessionID ) < 1) {
			$this->jumpUrl=U('Index/index');
			$this->error("Your shopping cart does not have any products!");
		}

		if ($this->memberID <= 0 && GetSettValue('quickbuy')==0) {
			Session::set('step','Member-join');
			$this->redirect ( 'Member-Public/Join' );
		}

		if (! $this->memberShippingAddress && GetSettValue('quickbuy')==0) {
			Session::set('step','Member-ShippingAddress');
			$this->redirect ( 'Member-Index/ShippingAddress' );
		}elseif(GetSettValue('quickbuy')==1){
			//快速购物
			$this->redirect('Cart/OtherAddress');
		}

		Session::set('step',null);
		//读取订单信息
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		$this->Total_weight=$dao->cart_total_weight($this->sessionID );

		$this->cart_total = $dao->cart_total ( $this->sessionID );
		$this->fees=get_orders_Fees($dao->cart_total ( $this->sessionID ));
		$this->display ();
	}
	public function OtherAddress() {
		//获取国家列表
		self::$Model=D("Region");
		$this->Countries=self::$Model->where("type=0")->findall();
		$dao = D ( "Cart" );
		if ($dao->get_item_count ( $this->sessionID ) < 1) {
			$this->jumpUrl=U('Index/index');
			$this->error("Your shopping cart does not have any products!");
		}

		if ($this->memberID <= 0  && GetSettValue('quickbuy')==0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! $this->memberShippingAddress && GetSettValue('quickbuy')==0) {
			$this->redirect ( 'Member-Index/ShippingAddress' );
		}
		Session::set('step',null);
		//读取订单信息
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		$this->Total_weight=$dao->cart_total_weight($this->sessionID );
		//3.10修改
		$this->cart_total = $dao->cart_total ( $this->sessionID );
		$this->fees=get_orders_Fees($dao->cart_total ( $this->sessionID ));

		$this->display ();
	}
	public function clear_cart(){
		self::$Model=D('Cart');
		self::$Model->clear_cart($this->sessionID);
		$this->success('Clear Cart Item Success!');
	}
	public function shipping(){
		header("Content-Type:text/html; charset=utf-8");
		$dao = D ( "Cart" );
		if ($dao->get_item_count ( $this->sessionID ) < 1) {
			$this->jumpUrl=U('Index/index');
			$this->error("Your shopping cart does not have any products!");
		}

		if ($this->memberID <= 0 && GetSettValue('quickbuy')==0) {
			Session::set('step','Member-join');
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! isset ( $_POST ['shipping_id'] ) || empty($_POST ['shipping_id'])) {
			$this->error ( 'Please select SHIPPING METHOD! ' );
		}


		Session::set('step',null);

		//配送信息
		self::$Model=D('Shipping');
		$shipping_info=self::$Model->find($_POST['shipping_id']);
		self::$Model=D('Shipping_area');
		$shipping_info['info']=self::$Model->where('shipping_id='.$_POST['shipping_id'].' and (name="'.get_region_name($_POST['delivery_country']).'" or name="'.get_region_name($_POST['delivery_state']).'" or name="'.$_POST['delivery_city'].'")')->find();
		$this->shipping_info=$shipping_info;
		//运费
		$shipping_fee=get_shipping_fee($_POST["shipping_id"],$_POST['delivery_country'],$_POST['delivery_state'],$_POST['total_weight'],$_POST['delivery_city']);
		$this->ShippingFee=$shipping_fee;
		//读取订单信息
		$this->list = $dao->display_contents ( $this->sessionID );
		$this->itemCount = $dao->get_item_count ( $this->sessionID );
		//3.10修改
		$this->cart_total = $dao->cart_total ( $this->sessionID );
		$this->fees=get_orders_Fees($dao->cart_total ( $this->sessionID ),$shipping_fee);
		//地址信息
		self::$Model = D ( "Orders" );
		$this->orders_data=self::$Model->create ();
		//支付方式列表
		self::$Model = D ( "Payment" );
		$this->paymentlist = self::$Model->getlist ();
		$this->display ();
	}
	public function checkout() {
		header("Content-Type:text/html; charset=utf-8");
		$dao = D ( "Cart" );
		if ($dao->get_item_count ( $this->sessionID ) < 1) {
			$this->jumpUrl=U('Index/index');
			$this->error("Your shopping cart does not have any products!");
		}

		if ($this->memberID <= 0  && GetSettValue('quickbuy')==0) {
			Session::set('step','Member-join');
			$this->redirect ( 'Member-Public/Join' );
		}
		if (! isset ( $_POST ['shipping_id'] ) || empty($_POST ['shipping_id'])) {
			$this->error ( 'Please select SHIPPING METHOD! ' );
		}
		if (! isset ( $_POST ['payment_module_code'] ) || empty($_POST ['payment_module_code'])) {
			$this->error ( 'Please select PAYMENT METHOD! ' );
		}


		self::$Model = D ( "Cart" );
		//3.10修改
		$products_total=self::$Model->cart_total ( $this->sessionID );//产品价格
		//生成订单
		self::$Model = D ( "Orders" );
		if ($orders_data=self::$Model->create ()) {
			$fee=get_orders_Fees($products_total);
			$orders_data['shippingmoney']=get_shipping_fee($orders_data["shipping_id"],$orders_data['delivery_country'],$orders_data['delivery_state'],$orders_data['total_weight'],$orders_data['delivery_city']);
			$orders_data['paymoney']=$fee["paymoney"];
			$orders_data['insurance']=$fee["insurance"];
			$orders_data['orders_total'] = $fee["total"];
			$orders_data['products_total'] = $products_total;
			$orders_data['delivery_country']=get_region_name($orders_data['delivery_country']);
			$orders_data['delivery_state']=get_region_name($orders_data['delivery_state']);

			$orders_id = self::$Model->add ($orders_data);//订单id

			//处理orders_products表
			self::$Model = D ( "Cart" );
			$list = self::$Model->display_contents ( $this->sessionID );
			$dao = D ( "Orders_products" );
			for($row = 0; $row < count ( $list ); $row ++) {
				$data ['orders_id'] = $orders_id;
				$data ['products_model'] = serialize($list [$row] ['model']);
				$data ['products_id'] = $list [$row] ['pid'];
				$data ['products_name'] = $list [$row] ['name'];
				$data ['products_price'] = $list [$row] ['price'];
				$data ['products_pricespe'] = $list [$row] ['pricespe'];
				$data ['products_quantity'] = $list [$row] ['count'];
				$data ['currencies_code'] = $_SESSION ['currency']['code'];
				$data ['products_total'] = $list [$row] ['total'];
				$dao->add ( $data );
			}

			//清除购物车
			self::$Model->clear_cart ( $this->sessionID );

			//发送邮件

			$this->maildata=$orders_data;//订单数据
			$this->list=$list;//购物车产品
			$this->fee=$fee;


			$this->this_script = rtrim("http://{$_SERVER['HTTP_HOST']}","/");
			$sendto=array($orders_data['member_email'],GetSettValue('mailcopyTo'));
			$body=$this->fetch_skin("checkout","MailTpl");
			sendmail($sendto,GetSettValue('sitename')." - new order!",$body)	;
			//3.19修改，添加一个确认页面
			$this->orders_data=$orders_data;
			$this->display();
			$this->redirect ( 'Cart/Payment', array ('id' => $orders_id ) );

		} else {
			$this->error ( self::$Model->getError () );
		}
	}
	public function Payment() {
		header("Content-Type:text/html; charset=utf-8");
		if ($this->memberID <= 0  && GetSettValue('quickbuy')==0) {
			$this->redirect ( 'Member-Public/Join' );
		}
		$orders_id = $_GET ['id'];
		if (get_orders_status ( $orders_id ) == L ( "orders_status_2" )) {
			$this->error ( L ( "orders_error_paied" ) );
		}
		//读取支付代码
		self::$Model = D ( "Orders" );
		$list = self::$Model->where ( "id=" . $orders_id )->find ();
		if (! $list) {
			$this->redirect ( 'Index/index' );
		}

		$pname = $list ['payment_module_code'];
		import ( '@.ORG.Payment.' . $pname );
		$p = new $pname ($list['sn']);

		$this_script = "http://{$_SERVER['HTTP_HOST']}";
		if ($pname == "Paypal") {
			$p->add_field ( 'business', GetSettValue ( $pname . "_account" ) ); //收款人账号'402660_1224487424_biz@qq.com'
			$p->add_field ( 'return', $this_script );//不填的话，按网站设置返回
			$p->add_field ( 'cancel_return', $this_script  );
			$p->add_field ( 'notify_url', $this_script . U ( 'Payment/Pin', array ("type" => "Paypal" ) ) );
			$p->add_field ( 'item_name', 'Porducts For SN:' . $list ['sn'] ); //产品名称
			$p->add_field ( 'item_number', $list ['sn'] ); //订单号码
			$p->add_field ( 'amount', $list ['orders_total'] ); //交易价格
			$p->add_field ( 'currency_code', $_SESSION ['currency'] ['symbol'] ? $_SESSION ['currency'] ['symbol'] : 'USD' ); //货币代码
			$p->submit_paypal_post ();
		}elseif($pname=="Gspay"){
			$this_script = "http://{$_SERVER['HTTP_HOST']}";
			$p->add_field('siteID',GetSettValue ( $pname . "_Site_Id" ));
			$p->add_field('orderID',$list ['sn']);
			$p->add_field('Amount[1]',$list ['orders_total']);
			$p->add_field('ApproveURL',$this_script);
			$p->add_field('Qty[1]',1);
			$p->add_field('OrderDescription[1]',"The Order's Sn is".$list ['sn']);
			$p->add_field('customerFullName',$list['member_firstname']." ".$list['member_lastname']);
			$p->add_field('customerAddress',$list['member_address']);
			$p->add_field('customerCity',$list['member_city']);
			$p->add_field('customerZip',$list['member_zip']);
			$p->add_field('customerCountry',$list['member_country']);
			$p->add_field('customerEmail',$list['member_email']);
			$p->add_field('customerPhone',$list['member_telephone']);
			//$p->add_field('TransactionMode',"test");
			$p->add_field('ApproveURL',$this_script.U('Payment/gspay_success'));
			$p->add_field('DeclineURL',$this_script.U('Payment/gspay_error'));
			//$p->add_field('returnUrl',$this_script.U('Payment/gspay_return'));

			$p->submit_post();
		}elseif($pname=="_95epay"){
			$this_script = "http://{$_SERVER['HTTP_HOST']}";
			$p->add_field('MerNo',GetSettValue ( $pname . "_no" ));//商号
			$MD5key=GetSettValue ( $pname . "_key" );//私钥
			$p->add_field('Currency',1);
			$p->add_field('BillNo',$list ['sn']);
			$p->add_field('Amount',$list ['orders_total']);
			$p->add_field('ReturnURL',$this_script.U('Payment/return_95pay'));
			$p->add_field('Language','en');

			$p->add_field('MD5info',strtoupper(md5($p->fields['MerNo'].$p->fields['BillNo'].$p->fields['Currency'].$p->fields['Amount'].$p->fields['Language'].$p->fields['ReturnURL'].$MD5key)));
			$p->add_field('Remark',$list['BuyNote']);
			$p->add_field('MerWebsite',$this_script);
			$p->submit_post();
		}elseif(strcasecmp($pname,"Payeasy")>=0) {
			$p->add_field('v_mid',GetSettValue ( $pname . "_id" ));//商户编号
			$p->add_field('v_oid',date('Ymd').'-'.GetSettValue ( $pname . "_id" ).'-'.$list ['sn']);//订单编号
			$p->add_field('v_rcvname',$list['member_firstname']." ".$list['member_lastname']);//收货人姓名
			$p->add_field('v_rcvaddr',$list['member_address']);//收货人地址
			$p->add_field('v_rcvtel',$list['member_telephone']);//收货人电话
			$p->add_field('v_rcvpost',$list['member_zip']);//收货人邮编
			$p->add_field('v_amount',$list ['orders_total']);//订单总金额
			//$p->add_field('v_language','en');//订单语言
			$p->add_field('v_ymd',date('Ymd',$list['dateline']));//订单产生日期
			$p->add_field('v_orderstatus',1);//配货状态
			$p->add_field('v_ordername',$list['member_firstname']." ".$list['member_lastname']);//订货人姓名
			$p->add_field('v_moneytype',1);//币种,0为人民币,1为美元，2为欧元，3为英镑，4为日元，5为韩元，6为澳大利亚元
			$p->add_field('v_url',$this_script.U('Payment/payeasy_return'));//支付动作完成后返回到该url，支付结果以GET方式发送
			$p->add_field('v_md5info',bin2hex(mhash(MHASH_MD5,"1".date('Ymd',$list['dateline']).$list ['orders_total'].$list['member_firstname']." ".$list['member_lastname'].date('Ymd').'-'.GetSettValue ( $pname . "_id" ).'-'.$list ['sn'].GetSettValue ( $pname . "_id" ).$this_script.U('Payment/payeasy_return'),GetSettValue ( $pname . "_key" ))));//订单数字指纹
			$p->add_field('v_shipstreet',$list['member_address']);//送货街道地址
			$p->add_field('v_shipcity',$list['member_city']);//送货城市
			//$p->add_field('v_shipstate',$_POST['']);//送货省/州
			$p->add_field('v_shippost',$list['member_zip']);//送货邮编
			//$p->add_field('v_shipcountry','840');//送货国家
			$p->add_field('v_shipphone',$list['member_telephone']);//送货电话
			$p->add_field('v_shipemail',$list['member_email']);//送货Email
			$p->submit_post();
		}elseif($pname=="wedopay"){

			$this_script = "http://{$_SERVER['HTTP_HOST']}";
			$MD5key=GetSettValue ( $pname . "_Md5Key" );
			$MerNo=GetSettValue ( $pname . "_MerNo" );
			$BillNo=$list ['sn'];
			$Amount=$list ['orders_total'];
			$OrderDesc=$list ['BuyNote'];
			$Currency="1";
			$Language = "2";
			$ReturnURL=$this_script.U('Payment/wedopay_return');
			$md5src = $MerNo.$BillNo.$Currency.$Amount.$Language.$ReturnURL.$MD5key;		//校验源字符串
			$MD5info = strtoupper(md5($md5src));		//MD5检验结果

			$p->add_field('MerNo',$MerNo);
			$p->add_field('Currency',$Currency);
			$p->add_field('BillNo',$BillNo);
			$p->add_field('Amount',$Amount);
			$p->add_field('ReturnURL',$ReturnURL);
			$p->add_field('Language',$Language);
			$p->add_field('MD5info',$MD5info);
			$p->add_field('Remark','');
			$p->add_field('shippingFirstName',$list ['delivery_firstname']);
			$p->add_field('shippingLastName',$list ['delivery_lastname']);
			$p->add_field('shippingEmail',$list ['member_email']);
			$p->add_field('shippingPhone',$list ['delivery_telephone']);
			$p->add_field('shippingZipcode',$list ['delivery_zip']);
			$p->add_field('shippingAddress',$list ['delivery_address']);
			$p->add_field('shippingCity',$list ['delivery_city']);
			$p->add_field('shippingSstate',$list ['delivery_state']);
			$p->add_field('shippingCountry',$list ['delivery_country']);
			$p->add_field('products','products');
			$p->submit_post();
		}elseif(strcasecmp($pname,"BANKOFCHINA")==0) {
			$p->submit_post();
		}elseif(strcasecmp($pname,"WesternUnion")==0) {
			$p->submit_post();
		}elseif(strcasecmp($pname,"MoneyGram")==0) {
			$p->submit_post();
		}elseif(strcasecmp($pname,"ECPSS")==0) {
			$p->add_field('MerNo',GetSettValue ( $pname . "_MD5KEY" ));
			$p->add_field('MD5key',GetSettValue ( $pname . "_MER" ));
			$p->add_field('BillNo',$list ['sn']);
			$p->add_field('Amount',$list ['orders_total']);
			$p->add_field('Currency',1);
			$p->add_field('Language',2);
			$p->add_field('ReturnURL',$this_script.U('Payment/ecpss_return'));
			$p->add_field('shippingFirstName',$list['delivery_firstname']);
			$p->add_field('shippingLastName',$list['delivery_lastname']);
			$p->add_field('shippingEmail',$list['member_email']);
			$p->add_field('shippingPhone',$list['delivery_telephone']);
			$p->add_field('shippingZipcode',$list['delivery_zip']);
			$p->add_field('shippingAddress',$list['delivery_address']);
			$p->add_field('shippingCity',$list['delivery_city']);
			$p->add_field('shippingSstate',$list['delivery_state']);
			$p->add_field('shippingCountry',$list['delivery_country']);
			$p->add_field('MD5info',strtoupper(md5($p->fields['MerNo'].$p->fields['BillNo'].$p->fields['Currency'].$p->fields['Amount'].$p->fields['Language'].$p->fields['ReturnURL'].$p->fields['MD5key'])));
			$p->submit_post();
		}elseif(strcasecmp($pname,"IPS")==0) {

			$Version = '2.0.0';
			$pMerchantCode = trim(GetSettValue ( $pname . "_mer" ));
			$pMerchantKey = trim(GetSettValue ( $pname . "_key" ));

			$pMerchantTransactionTime = date('YmdHis');
			$pMerchantOrderNum = getOrderSN();
			$pLanguage='EN';
			$pOrderCurrency='CNY';
			$pOrderAmount=number_format($list ['orders_total']*GetSettValue ( $pname . "_rate" ), 2, '.', '');
			$pDisplayAmount='$'.$list ['orders_total'];

			$pProductName="Products";
			$pProductDescription = '';
			$pAttach = '';
			$pSuccessReturnUrl=$this_script;
			$pS2SReturnUrl=$this_script.U('Index/Index');
			$pResHashArithmetic=12;
			$pResType=1;
			$pEnableFraudGuard=1;
			$pICPayReq = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><IPSReqRoot><ICPay><Version><![CDATA[$Version]]></Version><StandardPaymentReq><pMerchantOrderNum><![CDATA[$pMerchantOrderNum]]></pMerchantOrderNum><pOrderAmount><![CDATA[$pOrderAmount]]></pOrderAmount><pDisplayAmount><![CDATA[$pDisplayAmount]]></pDisplayAmount><pMerchantTransactionTime><![CDATA[$pMerchantTransactionTime]]></pMerchantTransactionTime><pOrderCurrency><![CDATA[$pOrderCurrency]]></pOrderCurrency><pLanguage><![CDATA[$pLanguage]]></pLanguage><pSuccessReturnUrl><![CDATA[$pSuccessReturnUrl]]></pSuccessReturnUrl><pFailReturnUrl><![CDATA[$pFailReturnUrl]]></pFailReturnUrl><pErrorReturnUrl><![CDATA[$pErrorReturnUrl]]></pErrorReturnUrl><pS2SReturnUrl><![CDATA[$pS2SReturnUrl]]></pS2SReturnUrl><pResType><![CDATA[$pResType]]></pResType><pResHashArithmetic><![CDATA[$pResHashArithmetic]]></pResHashArithmetic><pProductName><![CDATA[$pProductName]]></pProductName><pProductDescription><![CDATA[$pProductDescription]]></pProductDescription><pAttach><![CDATA[$pAttach]]></pAttach><pEnableFraudGuard><![CDATA[$pEnableFraudGuard]]></pEnableFraudGuard></StandardPaymentReq></ICPay></IPSReqRoot>";
			$pICPayReqB64 = base64_encode($pICPayReq);
			$pICPayReqHashValue = md5($pICPayReq . $pMerchantKey);//00518847228994856151214381286034373160268923638865209509623755128452179689329064232083487454640280528679651027955842303507571503
			$p->add_field('pMerchantCode',$pMerchantCode);//222378
			$p->add_field('pICPayReq',$pICPayReqB64);
			$p->add_field('pICPayReqHashValue',$pICPayReqHashValue);
			//反欺诈验证信息：
			//持卡人信息
			$pAccID             =  '';
			$pAccEMail          =  '';
			$pAccLoginIP        =  '';
			$pAccLoginDate      =  '';
			$pAccLoginDevice    =  '';
			$pAccRegisterDate   =  '';
			$pAccRegisterDevice =  '';
			$pAccRegisterIP     =  '';

			//帐单信息
			$pBillFName         =  $_POST['pBillFName'];
			$pBillMName         =  $_POST['pBillMName'];
			$pBillLName         =  $_POST['pBillLName'];
			$pBillStreet        =  $_POST['pBillStreet'];
			$pBillCity          =  $_POST['pBillCity'];
			$pBillState         =  $_POST['pBillState'];
			$pBillCountry       =  strtolower($_POST['pBillCountry']); //请使用国家/地区的小写二字英文代码
			$pBillZIP           =  $_POST['pBillZIP'];
			$pBillEmail         =  $_POST['pBillEmail'];
			$pBillPhone         =  $_POST['pBillPhone'];

			//产品信息
			$pProductData1      =  $_POST['pProductData1'];
			$pProductData2      =  $_POST['pProductData2'];
			$pProductData3      =  $_POST['pProductData3'];
			$pProductData4      =  $_POST['pProductData4'];
			$pProductData5      =  $_POST['pProductData5'];
			$pProductData6      =  $_POST['pProductData6'];
			$pProductType       =  $_POST['pProductType'];

			//货运信息
			$pShipFName         =  $_POST['pShipFName'];
			$pShipMName         =  $_POST['pShipMName'];
			$pShipLName         =  $_POST['pShipLName'];
			$pShipStreet        =  $_POST['pShipStreet'];
			$pShipCity          =  $_POST['pShipCity'];
			$pShipState         =  $_POST['pShipState'];
			$pShipCountry       =  strtolower($_POST['pShipCountry']); //请使用国家/地区的小写二字英文代码
			$pShipZIP           =  $_POST['pShipZIP'];
			$pShipEmail         =  $_POST['pShipEmail'];
			$pShipPhone         =  $_POST['pShipPhone'];

			//使用接口版本号(*):请固定使用“1.0.0”
			$fVersion = '1.0.0';

			//指定使用验证规则库的编号,默认为1
			$pCheckRuleBaseID = '1';

			//反欺诈信息按接口文档中格式写成XML(*)
			$pAFSReq = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><IPSReqRoot><AFS><Version><![CDATA[$fVersion]]></Version><cBasicParameters><pCheckRuleBaseID><![CDATA[$pCheckRuleBaseID]]></pCheckRuleBaseID></cBasicParameters><StandardPaymentReq><cBillParameters><pBillFName><![CDATA[$pBillFName]]></pBillFName><pBillMName><![CDATA[$pBillMName]]></pBillMName><pBillLName><![CDATA[$pBillLName]]></pBillLName><pBillStreet><![CDATA[$pBillStreet]]></pBillStreet><pBillCity><![CDATA[$pBillCity]]></pBillCity><pBillState><![CDATA[$pBillState]]></pBillState><pBillCountry><![CDATA[$pBillCountry]]></pBillCountry><pBillZIP><![CDATA[$pBillZIP]]></pBillZIP><pBillEmail><![CDATA[$pBillEmail]]></pBillEmail><pBillPhone><![CDATA[$pBillPhone]]></pBillPhone></cBillParameters><cShipParameters><pShipFName><![CDATA[$pShipFName]]></pShipFName><pShipMName><![CDATA[$pShipMName]]></pShipMName><pShipLName><![CDATA[$pShipLName]]></pShipLName><pShipStreet><![CDATA[$pShipStreet]]></pShipStreet><pShipCity><![CDATA[$pShipCity]]></pShipCity><pShipState><![CDATA[$pShipState]]></pShipState><pShipCountry><![CDATA[$pShipCountry]]></pShipCountry><pShipZIP><![CDATA[$pShipZIP]]></pShipZIP><pShipEmail><![CDATA[$pShipEmail]]></pShipEmail><pShipPhone><![CDATA[$pShipPhone]]></pShipPhone></cShipParameters><cProductParameters><pProductType><![CDATA[$pProductType]]></pProductType><pProductName><![CDATA[$pProductName]]></pProductName><pProductData1><![CDATA[$pProductData1]]></pProductData1><pProductData2><![CDATA[$pProductData2]]></pProductData2><pProductData3><![CDATA[$pProductData3]]></pProductData3><pProductData4><![CDATA[$pProductData4]]></pProductData4><pProductData5><![CDATA[$pProductData5]]></pProductData5><pProductData6><![CDATA[$pProductData6]]></pProductData6></cProductParameters><cAccountParameters><pAccID><![CDATA[$pAccID]]></pAccID><pAccEMail><![CDATA[$pAccEMail]]></pAccEMail><pAccRegisterIP><![CDATA[$pAccRegisterIP]]></pAccRegisterIP><pAccLoginIP><![CDATA[$pAccLoginIP]]></pAccLoginIP><pAccRegisterDate><![CDATA[$pAccRegisterDate]]></pAccRegisterDate><pAccLoginDate><![CDATA[$pAccLoginDate]]></pAccLoginDate><pAccRegisterDevice><![CDATA[$pAccRegisterDevice]]></pAccRegisterDevice><pAccLoginDevice><![CDATA[$pAccLoginDevice]]></pAccLoginDevice></cAccountParameters></StandardPaymentReq></AFS></IPSReqRoot>";

			//对反欺诈信息进行base64_encode(*)
			$pAFSReqB64 = base64_encode($pAFSReq);

			//反欺诈签名验证串(*)：MD5原文=反欺诈信息+商户证书
			$pAFSReqHashValue = md5($pAFSReq . $pMerchantKey);
			$p->add_field('pAFSReq',$pAFSReqB64);
			$p->add_field('pAFSReqHashValue',$pAFSReqHashValue);
			$p->submit_post();
		}else{
			$this->error('Please Select Payment!');
		}
	}

}
?>