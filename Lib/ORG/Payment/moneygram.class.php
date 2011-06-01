<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-12-21
 */
class moneygram {
	var $fields = array();           // array holds the fields to submit to paypal
	var $form='';					//表单
	var $submit_url;				//提交地址
	function moneygram() {
		$this->submit_url="";	
	}
	
	function add_field($field, $value) {
		
		// adds a key=>value pair to the fields array, which is what will be 
		// sent to paypal as POST variables.  If the value is already in the 
		// array, it will be overwritten.
		

		$this->fields ["$field"] = $value;
	}
	function submit_post() {
		echo "<html>";
		echo "<head><title>Processing Payment...</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		//echo "<body onLoad=\"document.forms['pay_form'].submit();\">\n";
		echo "<body >\n";
		echo "<center><h2>Please remember your order number ".$this->sn."!</h2></center>\n";
		echo "<center>".GetSettValue('MoneyGram_desc')."</center>";
		
		echo "</body></html>\n";
	}
	/**
	 * 新增
	 */
	function create_form($list) {
		$pname=get_class($this);
		$this_script = "http://{$_SERVER['HTTP_HOST']}";
		$this->form='';
		return $this->form;
	}
}
?>