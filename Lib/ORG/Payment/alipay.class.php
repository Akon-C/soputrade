<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-17
*/ 
class alipay{
	var $fields = array();           // array holds the fields to submit to paypal
	var $form='';					//表单
	var $submit_url;				//提交地址
	public function getsettarr(){
		return array('account','remark');
	}
	/**
	 * 新增
	 */
	function create_form($list) {
		$pname=get_class($this);
		$this_script = "http://{$_SERVER['HTTP_HOST']}";
		
		return '';
	}
	function submit(){
		if(!$delay){
			$this->form.= "<script>function jump(){ document.forms[\"pay_form\"].submit();} jump();</script>";
		}else{
			$delay*=1000;
			$this->form.= "<script>function jump(){ document.forms[\"pay_form\"].submit();} setTimeout('jump()',$delay);</script>";
		}
		return $this->form;
	}
}
?>