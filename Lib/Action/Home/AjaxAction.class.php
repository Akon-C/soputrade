<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2011-3-17
*/ 
class AjaxAction extends Action{
	function getRegion(){
		$dao=D("Region");
		$map['pid']=$_REQUEST["pid"];
		$map['type']=$_REQUEST["type"];
		$list=$dao->where($map)->findall();		
		echo json_encode($list);
		//echo "hello";
	}
	function getShippingFee(){
		$dao=D("Shipping");
		$list=$dao->where("code='".$_REQUEST["code"]."'")->find();
		$fee=get_orders_Fees($_REQUEST["total"]);
		//echo $dao->getlastsql();
		if ($list){
			$r=get_shipping_fee($list["id"],$_REQUEST["country"],$_REQUEST["state"],$_REQUEST["weight"]);
			
			$fee["Shipping_money"]=$r;
			$fee ["Shipping_money_str"] = getprice_str ( $r );
			$fee ['procuts_total'] = $_REQUEST["total"] + $r;
			
			if ($fee ['procuts_total'] <= GetSettValue ( "min_freepaymoney" )) {
				$fee ['procuts_total'] =  $fee ['insurance'] + $fee ['procuts_total'];
				$fee ['paymoney'] = number_format ( ( float ) $fee ['procuts_total'] * ( float ) GetSettValue ( "paymoney" ), 2, '.', '' );
			} else {
				$fee ['paymoney'] = 0;
			}
			//$fee ['procuts_total']=$f;
			
			$fee ['paymoney_str'] = getprice_str ( $fee ['paymoney'] );
			$fee ['procuts_total_str'] = getprice_str ( $fee ['procuts_total']+$fee["paymoney"] );
			$fee ['procuts_total'] =$fee ['procuts_total']+$fee["paymoney"] ;
			echo json_encode($fee);
		}
		else{
			echo json_encode("error");
		}
	}
}
?>