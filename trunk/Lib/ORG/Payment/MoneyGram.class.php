<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-12-21
 */
class MoneyGram {
	var $fields = array ();
	var $submit_url;
	var $sn;
	function MoneyGram($sn) {
		$this->submit_url="";	
		$this->sn=$sn;
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
}
?>