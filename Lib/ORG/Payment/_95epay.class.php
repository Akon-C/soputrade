<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-12-21
 */
class _95epay {
	var $fields = array ();
	var $submit_url;
	var $sn;
	function _95epay($sn) {
		$this->submit_url="https://www.95epay.com/PayReduceRequestAction.action";	
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
		echo "<body onLoad=\"document.forms['pay_form'].submit();\">\n";
		echo "<body >\n";
		echo "<center><h2>Please remember your order number ".$this->sn.", and then click on the button below to make a payment!</h2></center>\n";
		echo "<center><h2>Please wait, your order is being processed and you";
		echo " will be redirected to the 95epay website.</h2></center>\n";
		echo "<form method=\"post\" name=\"pay_form\" ";
		echo "action=\"" . $this->submit_url . "\">\n";
		foreach ( $this->fields as $name => $value ) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
		}
		echo "<center><br/><br/>If you are not automatically redirected to ";
		echo "95epay within 5 seconds...<br/><br/>\n";
		echo "<input type=\"submit\" value=\"Pay by 95epay\"></center>\n";
		
		echo "</form>\n";
		echo "<script>function jump(){ document.forms[\"pay_form\"].submit();} setTimeout(\"jump()\", 5000);</script>";
		echo "</body></html>\n";
	}
	function submit_post_c() {
		echo "<html>\n";
		echo "<head><title>Processing Payment...</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>\n";
		echo "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
		echo "<form method=\"post\" name=\"paypal_form\" ";
		echo "action=\"".$this->submit_url."\">\n";
		foreach ($this->fields as $name => $value) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
		}
		echo "</form>\n";
		//  echo "<script>function jump(){ document.forms[\"paypal_form\"].submit();} jump();</script>";
		echo "</body></html>\n";
	}
}
?>