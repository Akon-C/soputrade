<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-29
*/ 
class PaymentAction extends CommAction{
	public $paypal_c_url="http://qy.soupw.net";//跳回网址，原网站
	public function Pin(){
		$pname=$_GET['type'];
		import ( '@.ORG.Payment.' . $pname );
		$p = new $pname ();
		if ($pname == "Paypal") {
			self::$Model=D("Orders");
			$data['orders_status']="2";
			/*	if($p->validate_ipn()==true){
			self::$Model->where("sn=".$p->ipn_data['item_number'])->save($data);
			}*/
			if(strcasecmp($_POST['payer_status'],'verified')==0){
				if(!empty($_POST['item_number'])){
					self::$Model->where("sn=".$_POST['item_number'])->save($data);
					//赠送用户积分
					give_member_points($_POST['item_number']);
				}
			}
		}
	}
	public function Pin_c(){

		$pname=$_GET['type'];
		import ( '@.ORG.Payment.' . $pname );
		$p = new $pname ();
		if ($pname == "Paypal") {
			if($p->validate_ipn()){//验证ipn

				$post_string = '';
				foreach ($_POST as $field=>$value) {
					$post_string .= $field.'='.urlencode(stripslashes($value)).'&';
				}
				$ch = curl_init() ;
				//通知网址
				curl_setopt($ch, CURLOPT_URL,$this->paypal_c_url.U('Payment/Pin',array('type'=>'Paypal'))) ;
				curl_setopt($ch, CURLOPT_POST,count($_POST)) ;
				//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1) ;
				curl_setopt($ch, CURLOPT_POSTFIELDS,$post_string) ;
				$result = curl_exec($ch) ;
			}
		}
	}

	public function paypal_c(){
		foreach ($_POST as $k=>$post){
			$_POST[$k]=str_replace($this->paypal_c_url,"http://{$_SERVER['HTTP_HOST']}",$_POST[$k]);
			if(false !== strpos($_POST[$k])){
				$_POST[$k]=str_replace('Payment-Pin','Payment-Pin_c',$_POST[$k]);
			}
		}
		import ( '@.ORG.Payment.Paypal' );
		$p = new Paypal();
		$p->add_field ( 'business',$_POST['business']); //收款人账号'402660_1224487424_biz@qq.com'
		//$p->add_field ( 'return',$_POST['return'] );//网站中指定返回地址
		$p->add_field ( 'cancel_return', $_POST['cancel_return'] );
		$p->add_field ( 'notify_url', $_POST['notify_url'] );
		$p->add_field ( 'item_name', $_POST['item_name'] ); //产品名称
		$p->add_field ( 'item_number', $_POST['item_number'] ); //订单号码
		$p->add_field ( 'amount', $_POST['amount'] ); //交易价格
		$p->add_field ( 'currency_code', $_POST['currency_code'] ? $_POST['currency_code'] : 'USD' ); //货币代码
		$p->submit_paypal_post_c();//简洁提交
	}
	public function gspay_success(){
		echo "<html>";
		echo "<head><title>Payment successful!</title>\n";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		echo "<body >\n";
		echo "<center><h2>Payment successful!</h2></center>\n";
		echo "<center><h2>";
		echo "Transaction Amount:$".$_REQUEST['transactionAmount']."<br/>";
		echo "</h2></center>\n";
		echo "<center><a href=\"".__APP__."\">Go Home Page</a></center>\n";
		echo "</body></html>\n";
	}
	public function gspay_error(){
		echo "<html>";
		echo "<head><title>Payment Failure!</title>\n";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		echo "<body >\n";
		echo "<center><h2>Payment Failure!</h2></center>\n";
		echo "<center><h2>";
		echo "</h2></center>\n";
		echo "<center><a href=\"".__APP__."\">Go Home Page</a></center>\n";
		echo "</body></html>\n";
	}
	public function payeasy_return(){

		echo "<html>";
		echo "<head><title>Payment Return!</title>\n";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		echo "<body >\n";
		echo "<center><h2>Order SN:".$_GET['v_oid']."</h2></center>\n";
		if($_GET['v_pstatus']==20){
			echo "<center><h2>Payment successful!</h2></center>\n";
			echo "Transaction Amount:$".$_GET['v_amount']."<br/>";

		}elseif($_GET['v_pstatus']==30){
			echo "<center><h2>Payment Failure!<br/>".$_GET['v_pstring']."</h2></center>\n";
		}
		echo "<center><a href=\"".__APP__."\">Go Home Page</a></center>\n";
		echo "</body></html>\n";
	}
	public function ecpss_return(){

		echo "<html>";
		echo "<head><title>Payment Return!</title>\n";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		echo "<body >\n";
		if($_POST["Succeed"]=="19"){
			echo "Your payment is being processed .We will notify you of the final payment statement in 24 hours by an E-mail.";
		}else{
			echo "Your payment is being processed .We will notify you of the final payment statement in 24 hours by an E-mail.";
		}
		echo "<a href=\"".__APP__."\">Go Home Page</a>\n";
		echo "</body></html>\n";
	}
}
?>