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
}
?>