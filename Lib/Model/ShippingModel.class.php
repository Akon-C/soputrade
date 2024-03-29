<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2011-3-15
*/ 
class ShippingModel extends  Model{


	//运费列表
	function get_shipping_list($countyid,$stateid,$city,$weight){
		$ShippingList=$this->where("status=1")->findall();
		foreach ($ShippingList as $k=>$v){
			$ShippingList[$k]['price']=$this->get_shipping_fee($v['id'],$countyid,$stateid,$city,$weight);
			$ShippingList[$k]['price']=$ShippingList[$k]['price']?$ShippingList[$k]['price']:$v['insure'];
		}
		return $ShippingList;
	}
	function get_insure($id){
		$list=$this->find($id);
		return $list['insure'];
	}
	function get_name($id){
		$list=$this->find($id);
		return $list['name'];
	}
	//获取运费
	function get_shipping_fee($shippingid,$countyid,$stateid,$city,$weight){
		$fee=array();
		$dao=D("Shipping_area");
		if(!is_numeric($city)){
			$cityid=get_region_id($city);
		}else{
			$cityid=$city;
		}
		
		$list=$dao->where("shipping_id=".$shippingid)->findall();
		if ($list){
			foreach ($list as $k=>$v){
				$config=unserialize ( $v["config"] );
				if(is_numeric($cityid) && $cityid && in_array ( $cityid,$config)) {
					return $this->shipping_fee($v,$weight);
				}elseif(is_numeric($stateid) && $stateid && in_array ( $stateid, $config )) {
					return $this->shipping_fee($v,$weight);
				}elseif(is_numeric($countyid) && $countyid && in_array ($countyid, $config )) {
					return $this->shipping_fee($v,$weight);
				}
			}
		}
		else{
			return 0;
		}
	}
	function shipping_fee($fee,$weight){
		if ($weight<=1){
			return $fee["base_fee"];
		}
		else{
			$r=$fee["base_fee"]+($weight-1)*$fee["step_fee"];
			if ($r<=$fee["free_money"]){
				return 0;
			}
			else{
				return $r;
			}
		}
		//return $fee["base_fee"];
	}
	function get_shipping_method($id){
		$list=$this->field('shipping_method')->find($id);
		return $list['shipping_method'];
	}
}
?>